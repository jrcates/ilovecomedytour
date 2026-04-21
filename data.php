<?php
// ─────────────────────────────────────────────
//  I Love Comedy Tour — data loader
//
//  Loads authored tours from data/tours.json, generates scheduled
//  instances at runtime from each tour's scheduleRule, and exposes
//  a legacy $shows array (one entry per instance, in the old ticket
//  shape) so existing views keep rendering unchanged.
//
//  See data/SCHEMA.md for full details.
//
//  When real backend persistence lands: replace json_decode with a
//  DB query, remove the $shows alias once views are migrated.
// ─────────────────────────────────────────────

$siteName = 'I Love Comedy Tour';

// ─── 1. Load tour catalog ──────────────────────
$toursFile = __DIR__ . '/data/tours.json';
$tours     = [];
if (file_exists($toursFile)) {
    $raw = json_decode(file_get_contents($toursFile), true);
    if (is_array($raw) && isset($raw['tours']) && is_array($raw['tours'])) {
        $tours = $raw['tours'];
    }
}

// ─── 2. Generate instances for every active tour ──
$instances = [];
foreach ($tours as $tour) {
    if (empty($tour['isActive'])) continue;
    foreach (generateInstances($tour) as $inst) {
        $instances[] = $inst;
    }
}
usort($instances, function ($a, $b) { return strcmp($a['dateTime'], $b['dateTime']); });

// ─── 3. Legacy $shows alias ────────────────────
//  One legacy show per instance, keyed by instance id. Views that
//  iterate $shows and look up by id continue to work unchanged.
//  When a view migrates to use $tours/$instances directly, the
//  corresponding entries here become unreferenced.
$shows = [];
foreach ($instances as $inst) {
    $tour = null;
    foreach ($tours as $t) {
        if (($t['id'] ?? null) === $inst['tourId']) { $tour = $t; break; }
    }
    if (!$tour) continue;

    $ts          = strtotime($inst['dateTime']);
    $timeDisplay = date('g:iA', $ts);

    // Legacy "location" — comma-delimited so parseVenue() / parseCityState()
    // still split cleanly into venue + city/state.
    $mp       = $tour['meetingPoint'] ?? [];
    $locParts = [];
    if (!empty($mp['name']))            $locParts[] = $mp['name'];
    if (!empty($tour['neighborhood']))  $locParts[] = $tour['neighborhood'];
    if (!empty($tour['city']))          $locParts[] = $tour['city'];
    if (!empty($tour['state']))         $locParts[] = $tour['state'];
    $location = implode(', ', $locParts);

    // Legacy $shows alias — slim shape kept for addons / checkout / thank-you,
    // which look up by id and read only: date, description, location, priceValue.
    // Plus tourId / instanceId / capacity / spotsRemaining for forward-looking code.
    $shows[] = [
        'id'             => $inst['id'],
        'date'           => $inst['dateTime'],
        'time'           => $timeDisplay,
        'location'       => $location,
        'priceValue'     => (float)$tour['pricePerGuest'],
        'description'    => $tour['tagline'] ?? ($tour['shortDescription'] ?? ''),
        'tourId'         => $tour['id'],
        'instanceId'     => $inst['id'],
        'capacity'       => $inst['capacity'],
        'spotsRemaining' => $inst['spotsRemaining'],
    ];
}

// ─────────────────────────────────────────────
//  Legacy helper kept here — used by many views.
//  Do NOT move during Stage 1 (views rely on load order).
// ─────────────────────────────────────────────
function formatShowDate(string $isoDate): array {
    $ts = strtotime($isoDate);
    return [
        'weekday' => date('D', $ts),
        'day'     => date('j', $ts),
        'month'   => date('M', $ts),
        'year'    => date('Y', $ts),
        'time'    => date('g:iA', $ts),
    ];
}
