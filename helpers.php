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
