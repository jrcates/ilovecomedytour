# Data Schema — I Love Comedy Tour

This is a design/prototype site. There is no database yet. The files here
document the **shape** of data so whoever wires up the real backend has a
clear contract to implement.

## Files

| File | Purpose | Read by | Written by |
|------|---------|---------|-----------|
| `tours.json` | Authored tour catalog | `data.php` on every request | Content editors (manual) |
| `bookings.sample.json` | Reference sample only | **Nothing** (docs only) | **Nothing** |

At runtime, `data.php` loads `tours.json` and generates a list of
**instances** (scheduled departures) in memory from each tour's
`scheduleRule`. Instances are never persisted to disk in this codebase.

For back-compat with the existing `home / calendar / event / addons /
checkout / thank-you` views, `data.php` also exposes a `$shows` array —
one entry per instance, in the old ticket shape. That alias will go away
once the views are migrated.

---

## Entities

### Tour
A reusable product. Each tour has pricing, copy, a meeting point, and a
schedule that produces many instances.

```jsonc
{
  "id": "ilct-nyc",                // stable slug, used in URLs
  "slug": "i-love-comedy-tour",    // human-friendly slug (reserved)
  "title": "I Love Comedy Tour",
  "tagline": "…",                  // short one-liner, used in listings
  "shortDescription": "…",         // mid-length, used on cards
  "description": "…",              // long, used on the tour page
  "pricePerGuest": 45,             // number, in currency units
  "currency": "USD",
  "durationMinutes": 120,
  "defaultCapacity": 15,           // used when generating instances
  "neighborhood": "Greenwich Village",
  "city": "New York",
  "state": "NY",
  "image": "assets/rc-img1.jpg",
  "meetingPoint": {
    "name": "Meeting Point (TBD)",
    "address": "Greenwich Village, New York, NY",
    "lat": null, "lng": null,
    "notes": "…"
  },
  "endPoint": {
    "name": "Greenwich Village Comedy Club (TBD)",
    "address": "…",
    "includesShow": true,
    "notes": "…"
  },
  "scheduleRule": {
    "daysOfWeek": [4, 5, 6, 0],    // 0=Sun … 6=Sat
    "timeSlots": ["17:00","19:00","21:00"],
    "horizonDays": 90
  },
  "addons": [
    { "id": "ts", "label": "Tour T-Shirt",  "description": "…", "price": 35 },
    { "id": "po", "label": "Signed Poster", "description": "…", "price": 45 }
  ],
  "featured": true,
  "isActive": true,
  "createdAt": "2026-04-21"
}
```

### Instance (generated, in-memory)
One scheduled departure of a tour. Computed from `scheduleRule`:

```jsonc
{
  "id": "ilct-nyc-20260424-1900",  // {tourId}-{YYYYMMDD}-{HHmm}, URL-safe
  "tourId": "ilct-nyc",
  "dateTime": "2026-04-24T19:00:00",
  "capacity": 15,
  "spotsRemaining": 12,             // see note below
  "isActive": true
}
```

> **`spotsRemaining` note**: in this prototype the value is derived
> deterministically from a hash of the instance id (so the listings show a
> realistic spread of Available / Selling Fast / Sold Out without any
> real bookings). When bookings become persistent, compute
> `spotsRemaining = capacity − SUM(booking.guestCount WHERE instanceId = …)`.

### Booking (future)
What a customer actually buys. **Not currently persisted** — the cart is
URL-carried and `thank-you.php` re-derives totals from params.

See `bookings.sample.json` for the full shape. Key fields:

```jsonc
{
  "id": "ILCT-260424-A3F9B2",       // human-readable; current app generates
                                    //   RC{yymmdd}-{6hex} in thank-you.php
  "instanceId": "ilct-nyc-…",
  "tourId": "ilct-nyc",
  "guestCount": 4,
  "addons": { "ts": 1, "po": 0 },   // qty per addon id
  "customer": { firstName, lastName, email, phone },
  "pricing": {
    "currency", "subtotal",
    "promoCode", "promoDiscount",
    "giftCode",  "giftDiscount",
    "taxRatePct", "tax", "total"
  },
  "status": "confirmed" | "cancelled" | "refunded",
  "createdAt": "ISO8601",
  "notes": "…"
}
```

---

## Path to a real database

1. Define `tours` and `tour_instances` tables matching the JSON keys 1:1
   (instance rows can be generated on insert from `scheduleRule`, or
   generated lazily at query time — team's call).
2. Define a `bookings` table using the shape in `bookings.sample.json`.
3. In `data.php`, replace the `json_decode(file_get_contents(...))` calls
   with `SELECT` queries. Nothing else in the PHP needs to change.
4. In `checkout.php` (form submit) and `thank-you.php`, replace the
   URL-param round-trip with an `INSERT` on submit and a `SELECT … WHERE
   id = ?` on thank-you. The existing UI stays the same.
5. Decrement `spotsRemaining` in the same transaction as the booking
   INSERT. Enforce `spotsRemaining >= 0` at the DB level (CHECK
   constraint) to prevent oversell under concurrent writes.

---

## Helpers

`helpers.php` exposes (read-only):

- `getTour(string $tourId): ?array`
- `getUpcomingInstances(?string $tourId = null, ?int $limit = null): array`
- `findInstance(string $instanceId): ?array`
- `generateInstances(array $tour): array`
- `instanceStatusLabel(array $instance): string` → "Tickets Available" / "Selling Fast" / "Sold Out"

No helper currently writes or mutates data — persistence isn't wired up.
