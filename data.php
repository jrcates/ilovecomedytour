<?php
// ─────────────────────────────────────────────
//  Ronny Chieng – Tour Schedule
//  One comedian, one venue per date.
// ─────────────────────────────────────────────

$siteName = 'Ronny Chieng';

// Slot presets
$slots_2 = [['19:00:00', '07:00 PM'], ['21:30:00', '09:30 PM']];
$slots_1early = [['19:00:00', '07:00 PM']];
$slots_1late  = [['20:00:00', '08:00 PM']];

// Tour schedule: each stop is a city/venue run (Fri+Sat or single night).
// Ordered chronologically; one stop gets scheduled per weekend starting from next Friday.
$tourStops = [
  [
    'venue'       => 'Fox Theatre',
    'address'     => '660 Peachtree St NE',
    'city'        => 'Atlanta',
    'state'       => 'GA',
    'days'        => 2,
    'slots'       => $slots_2,
    'description' => 'The Love to Hate It Tour',
    'priceValue'  => 48,
  ],
  [
    'venue'       => 'Colonial Theatre',
    'address'     => '227 Bridge St',
    'city'        => 'Phoenixville',
    'state'       => 'PA',
    'days'        => 1,
    'slots'       => $slots_1early,
    'description' => '',
    'priceValue'  => 38,
  ],
  [
    'venue'       => 'Magoobys Jokehouse',
    'address'     => '9603 Deereco Rd',
    'city'        => 'Timonium',
    'state'       => 'MD',
    'days'        => 2,
    'slots'       => $slots_2,
    'description' => 'I Never Promised You A Rose Garden Tour',
    'priceValue'  => 42,
  ],
  [
    'venue'       => 'The Lab at Zanies',
    'address'     => '209 10th Ave S',
    'city'        => 'Nashville',
    'state'       => 'TN',
    'days'        => 2,
    'slots'       => $slots_2,
    'description' => '',
    'priceValue'  => 40,
  ],
  [
    'venue'       => 'Zanies Chicago',
    'address'     => '1548 N Wells St',
    'city'        => 'Chicago',
    'state'       => 'IL',
    'days'        => 2,
    'slots'       => $slots_2,
    'description' => 'The Love to Hate It Tour',
    'priceValue'  => 45,
  ],
  [
    'venue'       => 'Paramount Theatre',
    'address'     => '713 Congress Ave',
    'city'        => 'Austin',
    'state'       => 'TX',
    'days'        => 2,
    'slots'       => $slots_2,
    'description' => 'Keep Austin Laughing',
    'priceValue'  => 50,
  ],
  [
    'venue'       => 'Town Hall',
    'address'     => '123 W 43rd St',
    'city'        => 'New York',
    'state'       => 'NY',
    'days'        => 2,
    'slots'       => $slots_2,
    'description' => '',
    'priceValue'  => 68,
    'forceStatus' => 'Sold Out',
  ],
  [
    'venue'       => 'The Fonda Theatre',
    'address'     => '6126 Hollywood Blvd',
    'city'        => 'Los Angeles',
    'state'       => 'CA',
    'days'        => 2,
    'slots'       => $slots_2,
    'description' => 'The Love to Hate It Tour',
    'priceValue'  => 55,
  ],
  [
    'venue'       => 'Neptune Theatre',
    'address'     => '1303 NE 45th St',
    'city'        => 'Seattle',
    'state'       => 'WA',
    'days'        => 1,
    'slots'       => $slots_1late,
    'description' => 'A special one-night-only set',
    'priceValue'  => 44,
  ],
  [
    'venue'       => 'Warfield',
    'address'     => '982 Market St',
    'city'        => 'San Francisco',
    'state'       => 'CA',
    'days'        => 2,
    'slots'       => $slots_2,
    'description' => '',
    'priceValue'  => 60,
  ],
  [
    'venue'       => 'Wilbur Theatre',
    'address'     => '246 Tremont St',
    'city'        => 'Boston',
    'state'       => 'MA',
    'days'        => 2,
    'slots'       => $slots_2,
    'description' => 'The Love to Hate It Tour',
    'priceValue'  => 52,
  ],
  [
    'venue'       => 'Empire Comedy Club',
    'address'     => '575 Congress St',
    'city'        => 'Portland',
    'state'       => 'ME',
    'days'        => 2,
    'slots'       => $slots_2,
    'description' => 'An evening with Ronny Chieng',
    'priceValue'  => 40,
  ],
];

// Status pool — mix available / selling fast / sold out
$statusPool = [
  'Tickets Available','Tickets Available','Tickets Available',
  'Selling Fast','Tickets Available','Selling Fast',
  'Tickets Available','Tickets Available','Sold Out','Tickets Available',
];

// Generate: one tour stop per weekend, starting next Friday from today
$current = new DateTime('today');
while ((int)$current->format('w') !== 5) { // 5 = Friday
  $current->modify('+1 day');
}
$endDate = (new DateTime('today'))->modify('+3 months');

$shows = [];
$num = 1;
foreach ($tourStops as $stopIdx => $stop) {
  if ($current > $endDate) break;
  $location = $stop['venue'] . ', ' . $stop['address'] . ', ' . $stop['city'] . ', ' . $stop['state'];

  for ($day = 0; $day < $stop['days']; $day++) {
    $showDate = (clone $current)->modify("+{$day} days");
    foreach ($stop['slots'] as $slot) {
      list($time, $display) = $slot;
      $idx = $num - 1;
      $shows[] = [
        'id'          => 'show-' . $num,
        'title'       => 'Ronny Chieng at ' . $stop['venue'],
        'date'        => $showDate->format('Y-m-d') . 'T' . $time,
        'time'        => $display,
        'location'    => $location,
        'price'       => '$' . $stop['priceValue'],
        'priceValue'  => $stop['priceValue'],
        'image'       => 'assets/rc-img1.jpg',
        'description' => $stop['description'],
        'lineup'      => ['Ronny Chieng', 'Special Guests'],
        'type'        => 'standup',
        'status'      => $stop['forceStatus'] ?? $statusPool[$idx % count($statusPool)],
        'featured'    => ($stopIdx === 0),
        'series'      => $stop['venue'] . ' — ' . $stop['city'],
      ];
      $num++;
    }
  }

  // Advance to next Friday (one tour stop per weekend)
  $current->modify('+7 days');
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
