<?php
function component($name, $props = []) {
    $render = function() use ($name, $props) {
        extract($props);
        include __DIR__ . "/components/{$name}.php";
    };
    $render();
}

// ──────────────────────────────────────────────────────────
//  Tour-date formatting helpers (shared by calendar + home)
// ──────────────────────────────────────────────────────────
function parseCityState(string $loc): string {
    $parts = array_map('trim', explode(',', $loc));
    $c = count($parts);
    if ($c >= 2) return $parts[$c-2] . ', ' . $parts[$c-1];
    return $loc;
}
function parseVenue(string $loc): string {
    $parts = array_map('trim', explode(',', $loc));
    return $parts[0] ?? $loc;
}
function ordinalSuffix(int $day): string {
    $n100 = $day % 100;
    if ($n100 >= 11 && $n100 <= 13) return 'TH';
    switch ($day % 10) {
        case 1: return 'ST';
        case 2: return 'ND';
        case 3: return 'RD';
        default: return 'TH';
    }
}
function formatRangeDate(DateTime $d): string {
    $day = (int)$d->format('j');
    return strtoupper($d->format('M')) . ' ' . $day . ordinalSuffix($day);
}
function formatSlotLabel(DateTime $d): string {
    $day = (int)$d->format('j');
    return strtoupper($d->format('D') . ', ' . $d->format('M') . '. ' . $day) . ordinalSuffix($day) . ' ' . ltrim($d->format('g:i A'), '0');
}
// Parse "k1:v1,k2:v2" URL param → [k1 => v1 (int), k2 => v2 (int)]
function parseQtyParam(string $param): array {
    $out = [];
    foreach (explode(',', $param) as $pair) {
        $parts = explode(':', $pair);
        if (count($parts) === 2) $out[trim($parts[0])] = max(0, (int)trim($parts[1]));
    }
    return $out;
}

// ──────────────────────────────────────────────────────────
//  Tour / instance helpers (new data model — see data/SCHEMA.md)
//  Read-only. Persistence is not wired up in this codebase.
// ──────────────────────────────────────────────────────────

/** Find a tour by id from the loaded catalog. */
function getTour(string $tourId): ?array {
    global $tours;
    if (empty($tours)) return null;
    foreach ($tours as $t) {
        if (($t['id'] ?? null) === $tourId) return $t;
    }
    return null;
}

/**
 * Generate scheduled instances for a tour from its scheduleRule.
 * Instances are computed in-memory; they are never persisted.
 * `spotsRemaining` is deterministic-pseudo for demo — replace with a
 * real count once bookings are persisted.
 */
function generateInstances(array $tour): array {
    $rule = $tour['scheduleRule'] ?? null;
    if (!$rule) return [];

    $days        = $rule['daysOfWeek']  ?? [];
    $slots       = $rule['timeSlots']   ?? [];
    $horizonDays = (int)($rule['horizonDays'] ?? 90);
    $capacity    = (int)($tour['defaultCapacity'] ?? 15);

    $out   = [];
    $today = new DateTime('today');
    for ($i = 0; $i <= $horizonDays; $i++) {
        $d = (clone $today)->modify("+{$i} days");
        $dow = (int)$d->format('w'); // 0=Sun..6=Sat
        if (!in_array($dow, $days, true)) continue;

        foreach ($slots as $slot) {
            $time     = strlen($slot) === 5 ? $slot . ':00' : $slot; // HH:MM → HH:MM:SS
            $dateTime = $d->format('Y-m-d') . 'T' . $time;
            $ymd      = $d->format('Ymd');
            $hm       = str_replace(':', '', substr($time, 0, 5));
            $id       = $tour['id'] . '-' . $ymd . '-' . $hm;

            // Demo-only deterministic "spots" so listings show variety.
            $hash  = crc32($id);
            $faked = $hash % ($capacity + 2);
            $spots = max(0, $capacity - $faked);

            $out[] = [
                'id'             => $id,
                'tourId'         => $tour['id'],
                'dateTime'       => $dateTime,
                'capacity'       => $capacity,
                'spotsRemaining' => $spots,
                'isActive'       => true,
            ];
        }
    }
    return $out;
}

/** Find an instance by id. */
function findInstance(string $instanceId): ?array {
    global $instances;
    if (empty($instances)) return null;
    foreach ($instances as $inst) {
        if (($inst['id'] ?? null) === $instanceId) return $inst;
    }
    return null;
}

/**
 * Upcoming instances, optionally filtered by tour, optionally limited.
 * Returns instances sorted ascending by dateTime.
 */
function getUpcomingInstances(?string $tourId = null, ?int $limit = null): array {
    global $instances;
    if (empty($instances)) return [];
    $out = [];
    foreach ($instances as $inst) {
        if ($tourId && ($inst['tourId'] ?? null) !== $tourId) continue;
        $out[] = $inst;
    }
    usort($out, function ($a, $b) { return strcmp($a['dateTime'], $b['dateTime']); });
    if ($limit) $out = array_slice($out, 0, $limit);
    return $out;
}

/** Human status label derived from spotsRemaining. */
function instanceStatusLabel(array $instance): string {
    $s = (int)($instance['spotsRemaining'] ?? 0);
    if ($s <= 0) return 'Sold Out';
    if ($s <= 3) return 'Selling Fast';
    return 'Tickets Available';
}
