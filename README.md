# I Love Comedy Tour

A walking-tour-plus-comedy-show booking site for the I Love Comedy Tour in
Greenwich Village, NYC. A 30-minute guided walk led by working comedians,
ending at a real NYC comedy club for a live stand-up show (2 drink tickets
included).

This is a **design-stage prototype**. The UI is complete and the data
model is production-shaped, but there is no real backend yet. See
[Dev-ready notes](#dev-ready-notes) below.

---

## Tech stack

- **PHP 8+** — view layer + routing (no framework, no Composer)
- **Alpine.js 3** — client reactivity (via CDN)
- **Tailwind CSS 3** — styling utilities (via CDN, plus `css/custom.css`)
- **Lucide icons** — SVG icon pack (via CDN)
- **Montserrat** — typeface (Google Fonts)

No Node/npm. No build step. Serve the directory with any PHP-capable web
server and it runs.

---

## Quick start

```sh
# From project root
php -S localhost:8000
```

Open http://localhost:8000. That's it.

---

## Project layout

```
.
├── index.php                      # Front controller / router
├── data.php                       # Loads data/tours.json, builds $instances
│                                  # + $shows legacy alias
├── helpers.php                    # component(), getTour(),
│                                  # getUpcomingInstances(),
│                                  # generateInstances(), etc.
│
├── data/
│   ├── tours.json                 # Authored tour catalog
│   ├── bookings.sample.json       # Reference shape for dev handoff
│   │                              #  (never read or written by the app)
│   └── SCHEMA.md                  # Data contract + DB migration notes
│
├── views/                         # One file per route
│   ├── home.php                   # ?view=home (landing)
│   ├── about.php                  # ?view=about
│   ├── tour.php                   # ?view=tour — calendar + date detail
│   ├── contact.php                # ?view=contact
│   ├── addons.php                 # ?view=addons  (booking step 2)
│   ├── checkout.php               # ?view=checkout (step 3)
│   ├── thank-you.php              # ?view=thank-you (confirmation)
│   └── design-system.php          # ?view=design-system (dev reference)
│
├── components/
│   ├── tour-list.php              # Reusable list of upcoming dates
│   ├── view-switcher.php          # Dev tool: mobile-frame preview toggle
│   └── layout/
│       ├── head.php               # <head>, CDN loads, Tailwind config
│       ├── nav.php                # Fixed header, transparent-on-home-hero
│       ├── footer.php             # Dark footer w/ social + email
│       ├── newsletter.php         # "Subscribe" block shown on most views
│       └── design-system-button.php  # Dev tool: floating link to /design-system
│
├── css/
│   └── custom.css                 # ~110 lines: design tokens for
│                                  #  cc-* classes (button, sticker, modal,
│                                  #  hero gradient, nav bg, mascot float,
│                                  #  view-fade, nav-bar clearance)
│
└── assets/
    └── ilct-logo.png              # Mascot / wordmark asset
```

---

## Routes

```
?view=home                             Landing with hero + upcoming list
?view=about                            Full tour description
?view=tour&tour=ilct-nyc               Calendar view (pick a date)
?view=tour&tour=X&date=YYYY-MM-DD      Date detail (pick time + guests)
?view=tour&tour=X&date=…&slot=INST_ID  Date detail w/ pre-selected slot
?view=addons&show=INSTANCE_ID&tickets=g:N,p:0,v:0
?view=checkout&show=…&tickets=…&addons=…
?view=thank-you&show=…&tickets=…&addons=…
?view=contact
?view=design-system                    Living style-guide (dev-only)
```

Invalid routes fall through to `home`.

Cart state is **URL-carried** end to end — there is no server session,
no cookies, nothing persisted.

---

## Data model

Three entities, documented fully in `data/SCHEMA.md`:

| Entity      | Where it lives                   | Who writes it     |
|-------------|----------------------------------|-------------------|
| **Tour**    | `data/tours.json` (authored)     | Content team     |
| **Instance** | In-memory, from `scheduleRule`  | `data.php` at runtime |
| **Booking** | `data/bookings.sample.json` (docs only) | Nothing yet |

`data.php` also emits a **`$shows` legacy alias** — one entry per
instance, shaped like the old ticket format — so the booking-flow views
(`addons / checkout / thank-you`) keep working without refactor. Fields
in `$shows` are documented in `SCHEMA.md`.

---

## CSS

Only one local stylesheet: `css/custom.css`. Tailwind utilities handle
~95% of styling.

Custom classes (all prefixed `cc-`):

- `.cc-btn-primary` — the cartoon-sticker pill button (red + brown
  drop), with `[disabled]` + `.is-disabled` states
- `.cc-sticker` / `.cc-sticker-sm` — page / inline badge pills (brown
  outline + solid drop)
- `.cc-modal-panel` — success-modal panel shadow/border
- `.cc-hero-gradient` — the home hero's warm gradient (red/violet/
  yellow on burgundy base)
- `.cc-nav-bg` — dark burgundy gradient used by the fixed nav on
  non-home routes
- `.cc-mascot-float` — 6-second idle float animation on the home mascot
- `.cc-view-fade` — subtle fade-in on page transitions
- `.cc-view-switcher-backdrop` / `.cc-view-switcher-frame` — dev-only
  iframe mobile preview
- `main { padding-top }` — clears the fixed nav (96 / 84 responsive)

Only one `!important` in the whole file: `[x-cloak]` — required by
Alpine.

---

## Dev-ready notes

What's already solid and what to wire up when backend work starts.

### ✅ Ready
- Full UI across all pages
- Data model normalized and documented (`SCHEMA.md`)
- JSON-backed tour catalog — edit `tours.json` and the site updates
- Instance generation from a schedule rule (DoW + time slots + horizon)
- Deterministic demo `spotsRemaining` so the calendar shows realistic
  variation without real bookings
- Clean URL contract: instance IDs are URL-safe slugs
  (`ilct-nyc-YYYYMMDD-HHMM`)
- Multi-tour-ready schema (currently one tour, but array structure is
  already there)

### 🔌 What the backend team plugs in

1. **Persist bookings** — replace the URL round-trip in `checkout.php →
   thank-you.php` with: (a) INSERT a `bookings` row keyed by instance
   id + customer, (b) THANKS page reads `?order=ID` instead of
   re-deriving from `tickets=…&addons=…` params. `bookings.sample.json`
   has the exact shape.
2. **Real `spotsRemaining`** — swap the crc32 stub in
   `helpers.php :: generateInstances()` for
   `capacity − SUM(booking.guestCount WHERE instanceId = …)`.
   Enforce `>= 0` at the DB level to prevent oversell.
3. **Payment** — the checkout form currently submits GET to
   `?view=thank-you`. Replace with a real payment gateway (Stripe
   Checkout, etc.); on success callback, write the booking row.
4. **Email confirmation** — nothing is sent today. Hook into the
   booking INSERT.
5. **Promo / gift codes** — currently validated client-side against the
   literals `1111` and `2222` as a demo. Replace with a real lookup.
6. **Meeting point** — `tours.json` has `meetingPoint.address = "TBD"`.
   Update when confirmed; no code change required.

### 🧹 What's orphaned but kept

- `views/design-system.php` — intentional dev reference (not linked
  from nav)
- `components/view-switcher.php` + `components/layout/design-system-button.php`
  — dev tools only; remove when handing off to production

### 🗑️ What was already cleaned up

- Removed: `views/calendar.php`, `views/event.php`, `views/netflix.php`
  (old Ronny Chieng tour-stop flow)
- Removed: `components/carousel.php`, `components/tour-dates.php`
- Removed: `samples/` directory (design prototypes)
- Removed: dead `@keyframes marquee`, unused `.cc-nav-link::after`
  rules, broken `assets/rc-img*.jpg` references, dead fields in the
  `$shows` alias (`image`, `lineup`, `type`, `status`, `featured`,
  `series`)

---

## Editing content

Most content is in two places:

1. **`data/tours.json`** — tour copy, pricing, schedule, addons, why /
   what's-included bullets, meeting point, end point
2. **`components/layout/nav.php`** and **`components/layout/footer.php`** —
   static nav labels and footer blurb / social links

About / Contact / Tour pages all pull from `tours.json`. Change the
data, the UI updates.

---

## Conventions

- Views are **top-level PHP files**, included by `index.php` via the
  `component()` pattern or `include`
- Alpine `x-data` blocks are inline in the markup; no external JS
  modules
- Buttons are all `.cc-btn-primary` with Tailwind padding/tracking
  classes for variation
- Sticker badges are `.cc-sticker` / `.cc-sticker-sm` with a Tailwind
  `rotate-[…deg]` for playful tilt
- All brand colors live on literals: `#d12027` (brand red), `#2d1712`
  (brown outline/drop), `#f9dda9` (cream accent)

---

## Credits

Tech scaffolding: PHP + Alpine + Tailwind. No build tooling.
Mascot illustration and tour concept: I Love Comedy Tour.
