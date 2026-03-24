<?php
// ─────────────────────────────────────────────
//  Comedy Break In – Shared Data
//  Shows generated: today + 3 months
// ─────────────────────────────────────────────

$siteName = 'Comedy Break In';

// Series definitions keyed by day of week (0=Sun … 6=Sat)
// 'week_parity' => 0 = even weeks only, 1 = odd weeks only, omit = every week
$seriesDefs = [
  5 => [ // Friday
    [ // Friday 7:00PM — even weeks
      'title'    => 'Comedy Title 1 at Location Center 1',
      'time'     => '19:00:00',
      'display'  => '07:00 PM',
      'series'   => 'Comedy Title 1 at Location Center 1',
      'location' => 'Location Center 1, 257 Main St., Birmingham, AL',
      'type'     => 'standup',
      'week_parity' => 0,
      'prices'   => [25, 30, 25, 30, 25, 30],
      'images'   => [
        'https://images.unsplash.com/photo-1649772308558-db37c0dfae7e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1641903806973-17eaf2d2634f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
      ],
      'descriptions' => [
        'Join us for a night of laughs at Location Center 1! Enjoy great drinks and top-tier comedy.',
        'Friday nights at Location Center 1 just got funnier. Grab a drink and settle in for non-stop laughs.',
        'An unforgettable evening of stand-up at Location Center 1.',
      ],
      'lineups' => [
        ['Host: Comedian A', 'Comedian B', 'Comedian C', 'Special Guest'],
        ['Host: Comedian D', 'Comedian E', 'Comedian F'],
        ['Host: Comedian G', 'Comedian H', 'Comedian I'],
      ],
    ],
    [ // Friday 7:00PM — odd weeks
      'title'    => 'Comedy Title 2 at Location Center 2',
      'time'     => '19:00:00',
      'display'  => '07:00 PM',
      'series'   => 'Comedy Title 2 at Location Center 2',
      'location' => 'Location Center 2, 86 Oak Ave., Huntsville, AL',
      'type'     => 'standup',
      'week_parity' => 1,
      'prices'   => [25, 25, 30, 25, 30, 25],
      'images'   => [
        'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Comedy Title 2 at Location Center 2 — where great vibes meet stand-up comedy!',
        'Escape for a Friday night of laughs in a charming setting at Location Center 2.',
        'Great food, great drinks, and even greater comedy at Location Center 2.',
      ],
      'lineups' => [
        ['Host: Comedian J', 'Comedian K', 'Special Guest'],
        ['Host: Comedian L', 'Comedian M', 'Guest Comedians'],
        ['Host: Comedian N', 'Comedian O', 'Rotating Guests'],
      ],
    ],
    [ // Friday 7:30PM — even weeks
      'title'    => 'Comedy Title 3 at Location Center 3',
      'time'     => '19:30:00',
      'display'  => '07:30 PM',
      'series'   => 'Comedy Title 3 at Location Center 3',
      'location' => 'Location Center 3, 1525 Harbor Rd., Montgomery, AL',
      'type'     => 'standup',
      'week_parity' => 0,
      'prices'   => [20, 25, 20, 25, 20, 25],
      'images'   => [
        'https://images.unsplash.com/photo-1641903806973-17eaf2d2634f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1527224857830-43a7acc85260?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Laughs at Location Center 3! A night of comedy with stunning views.',
        'Start your weekend right — great comedy and great cocktails at Location Center 3.',
        'Join us at Location Center 3 for a Friday night you won\'t forget.',
      ],
      'lineups' => [
        ['Host: Comedian P', 'Various Artists'],
        ['Host: Comedian Q', 'Rotating Lineup'],
        ['Host: Comedian R', 'Special Guests'],
      ],
    ],
    [ // Friday 7:30PM — odd weeks
      'title'    => 'Comedy Title 4 at Location Center 4',
      'time'     => '19:30:00',
      'display'  => '07:30 PM',
      'series'   => 'Comedy Title 4 at Location Center 4',
      'location' => 'Location Center 4, 103 Elm St., Mobile, AL',
      'type'     => 'standup',
      'week_parity' => 1,
      'prices'   => [20, 25, 20, 25, 20, 25],
      'images'   => [
        'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1649772308558-db37c0dfae7e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Comedy and good times — the perfect pairing! Laugh the night away at Location Center 4.',
        'Friday night at Location Center 4 means great vibes and even better comedy.',
        'An intimate evening of stand-up at Location Center 4.',
      ],
      'lineups' => [
        ['Host: Comedian S', 'Comedian T', 'Comedian U'],
        ['Host: Comedian V', 'Comedian W', 'Guest Comedians'],
        ['Host: Comedian X', 'Comedian Y', 'Comedian Z'],
      ],
    ],
    [ // Friday 8:00PM — every week
      'title'    => 'Comedy Title 5 at Location Center 5',
      'time'     => '20:00:00',
      'display'  => '08:00 PM',
      'series'   => 'Comedy Title 5 at Location Center 5',
      'location' => 'Location Center 5, 100 River Rd., Tuscaloosa, AL',
      'type'     => 'standup',
      'prices'   => [25, 30, 25, 30, 25, 30],
      'images'   => [
        'https://images.unsplash.com/photo-1730791480843-12ef754c5123?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1527224857830-43a7acc85260?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Live comedy at Location Center 5 with craft beers and great vibes.',
        'Friday nights at Location Center 5 just got a whole lot funnier.',
        'The best way to kick off the weekend — comedy and cocktails at Location Center 5.',
      ],
      'lineups' => [
        ['Host: Comedian A1', 'Comedian B1', 'Special Guest'],
        ['Host: Comedian C1', 'Comedian D1', 'Guest Comedians'],
        ['Host: Comedian E1', 'Comedian F1', 'Comedian G1'],
      ],
    ],
  ],
  6 => [ // Saturday
    [ // Saturday 7:00PM — every week
      'title'    => 'Comedy Title 6 at Location Center 6',
      'time'     => '19:00:00',
      'display'  => '07:00 PM',
      'series'   => 'Comedy Title 6 at Location Center 6',
      'location' => 'Location Center 6, 11 Hill Rd., Hoover, AL',
      'type'     => 'standup',
      'prices'   => [25, 30, 25, 30, 25, 30],
      'images'   => [
        'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1525268771113-32d9e9021a97?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Saturday night at Location Center 6 — great drinks and laugh-out-loud comedy.',
        'An evening of stand-up comedy at Location Center 6.',
        'Saturday nights at Location Center 6 are unforgettable.',
      ],
      'lineups' => [
        ['Host: Comedian H1', 'Comedian I1', 'Comedian J1'],
        ['Host: Comedian K1', 'Comedian L1'],
        ['Surprise Headliner', 'Regular Favorites'],
      ],
    ],
    [ // Saturday 8:00PM — even weeks
      'title'    => 'Comedy Title 7 at Location Center 7',
      'time'     => '20:00:00',
      'display'  => '08:00 PM',
      'series'   => 'Comedy Title 7 at Location Center 7',
      'location' => 'Location Center 7, 100 Lake Rd., Auburn, AL',
      'type'     => 'standup',
      'week_parity' => 0,
      'prices'   => [30, 35, 35, 40, 30, 35],
      'images'   => [
        'https://images.unsplash.com/photo-1730791480843-12ef754c5123?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Saturday night at Location Center 7! Double the fun with comedy and craft brews.',
        'Back for more! Saturday\'s lineup at Location Center 7 brings the heat with non-stop stand-up.',
        'The weekend\'s not over yet — catch another night of comedy at Location Center 7!',
      ],
      'lineups' => [
        ['Host: Comedian M1', 'Comedian N1', 'Comedian O1'],
        ['Host: Comedian P1', 'Comedian Q1', 'Comedian R1'],
        ['Host: Comedian S1', 'Comedian T1', 'Special Guest'],
      ],
    ],
    [ // Saturday 8:00PM — odd weeks
      'title'    => 'Comedy Title 8 at Location Center 8',
      'time'     => '20:00:00',
      'display'  => '08:00 PM',
      'series'   => 'Comedy Title 8 at Location Center 8',
      'location' => 'Location Center 8, 325 State St., Dothan, AL',
      'type'     => 'standup',
      'week_parity' => 1,
      'prices'   => [30, 35, 30, 35, 30, 35],
      'images'   => [
        'https://images.unsplash.com/photo-1649772308558-db37c0dfae7e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1641903806973-17eaf2d2634f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Comedy Title 8 at Location Center 8 — a premier comedy experience!',
        'Saturday at Location Center 8 means world-class comedy in an intimate venue.',
        'Location Center 8 comes alive with laughter every Saturday. Top comedians, unforgettable night.',
      ],
      'lineups' => [
        ['Host: Comedian U1', 'Comedian V1', 'Comedian W1'],
        ['Host: Comedian X1', 'Guest Comedians'],
        ['Host: Comedian Y1', 'Rotating Lineup'],
      ],
    ],
  ],
  0 => [[ // Sunday 5:00PM — every week
    'title'    => 'Comedy Title 9 at Location Center 9',
    'time'     => '17:00:00',
    'display'  => '05:00 PM',
    'series'   => 'Comedy Title 9 at Location Center 9',
    'location' => 'Location Center 9, 56 Park Rd., Florence, AL',
    'type'     => 'standup',
    'prices'   => [20, 20, 25, 20, 25, 20],
    'images'   => [
      'https://images.unsplash.com/photo-1525268771113-32d9e9021a97?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
    ],
    'descriptions' => [
      'Sunday afternoon comedy at Location Center 9 — wind down the weekend with laughs.',
      'The perfect Sunday: great views, great drinks, and a lineup of comedians that\'ll leave you smiling all week.',
      'End the weekend on a high note at Location Center 9. Comedy and good times await.',
    ],
    'lineups' => [
      ['Host: Comedian Z1', 'Comedian A2'],
      ['Host: Comedian B2', 'Comedian C2'],
      ['Host: Comedian D2', 'Guest Comedians'],
    ],
  ]],
];

// Status rotation: most are available, some selling fast, rare sold out
$statusPool = ['Tickets Available','Tickets Available','Tickets Available','Selling Fast','Tickets Available','Tickets Available','Selling Fast','Tickets Available','Tickets Available','Sold Out'];

// Generate shows: today + 3 months
$shows = [];
$current = new DateTime('today');
$end     = (new DateTime('today'))->modify('+3 months');
$num     = 1;

while ($current <= $end) {
  $dow = (int) $current->format('w'); // 0=Sun … 6=Sat
  if (isset($seriesDefs[$dow])) {
    $weekNum = (int) $current->format('W'); // ISO week number
    foreach ($seriesDefs[$dow] as $tpl) {
      // Skip shows that don't match the week parity
      if (isset($tpl['week_parity']) && ($weekNum % 2) !== $tpl['week_parity']) {
        continue;
      }
      $idx   = ($num - 1); // running index for rotation
      $cnt   = count($tpl['images']);
      $price = $tpl['prices'][$idx % count($tpl['prices'])];
      $shows[] = [
        'id'          => 'show-' . $num,
        'title'       => $tpl['title'],
        'date'        => $current->format('Y-m-d') . 'T' . $tpl['time'],
        'time'        => $tpl['display'],
        'location'    => $tpl['location'],
        'price'       => '$' . $price,
        'priceValue'  => $price,
        'image'       => $tpl['images'][$idx % $cnt],
        'description' => $tpl['descriptions'][$idx % count($tpl['descriptions'])],
        'lineup'      => $tpl['lineups'][$idx % count($tpl['lineups'])],
        'type'        => $tpl['type'],
        'status'      => $statusPool[$idx % count($statusPool)],
        'featured'    => ($idx % 3 === 0),
        'series'      => $tpl['series'],
      ];
      $num++;
    }
  }
  $current->modify('+1 day');
}

// ─────────────────────────────────────────────
//  Helper: format date parts from ISO string
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
