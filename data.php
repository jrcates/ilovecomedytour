<?php
// ─────────────────────────────────────────────
//  Comedy Craft Beer – Shared Data
//  Shows generated: today + 3 months
// ─────────────────────────────────────────────

$siteName = 'Comedy Club';

$logoImg        = 'assets/logo-white.png';
$logoImgAlt     = 'assets/logo-white.png';

// Series definitions keyed by day of week (0=Sun … 6=Sat)
// 'week_parity' => 0 = even weeks only, 1 = odd weeks only, omit = every week
$seriesDefs = [
  5 => [ // Friday
    [ // Friday 7:00PM — even weeks
      'title'    => 'Comedy Night at Crystal Ridge Winery',
      'time'     => '19:00:00',
      'display'  => '07:00 PM',
      'series'   => 'Comedy Night at Crystal Ridge Winery',
      'location' => 'Crystal Ridge Winery, 257 Belltown Rd., South Glastonbury, CT',
      'type'     => 'standup',
      'week_parity' => 0,
      'prices'   => [25, 30, 25, 30, 25, 30],
      'images'   => [
        'https://images.unsplash.com/photo-1649772308558-db37c0dfae7e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1641903806973-17eaf2d2634f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
      ],
      'descriptions' => [
        'Join us for a night of laughs at Crystal Ridge Winery! Enjoy great wine, beautiful views, and top-tier comedy.',
        'Friday nights at Crystal Ridge just got funnier. Grab a glass and settle in for non-stop laughs.',
        'Comedy meets wine country! An unforgettable evening of stand-up at one of CT\'s most scenic vineyards.',
      ],
      'lineups' => [
        ['Host: Sarah Johnson', 'Mike Smith', 'Jenny Jones', 'Special Guest'],
        ['Host: Joe List', 'Mark Normand', 'Sam Morril'],
        ['Host: Big Jay Oakerson', 'Dan Soder', 'Rosebud Baker'],
      ],
    ],
    [ // Friday 7:00PM — odd weeks
      'title'    => 'Comedy Night at The Farm at Carter Hill',
      'time'     => '19:00:00',
      'display'  => '07:00 PM',
      'series'   => 'Comedy Night at The Farm at Carter Hill',
      'location' => 'The Farm At Carter Hill, 86 E Hampton Rd., Marlborough, CT',
      'type'     => 'standup',
      'week_parity' => 1,
      'prices'   => [25, 25, 30, 25, 30, 25],
      'images'   => [
        'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Comedy Night at The Farm at Carter Hill — where farm-fresh fun meets stand-up comedy!',
        'Escape to Marlborough for a Friday night of laughs in a rustic, charming setting.',
        'Great food, great drinks, and even greater comedy. The Farm at Carter Hill delivers every time.',
      ],
      'lineups' => [
        ['Host: Shane Gillis', 'Tim Dillon', 'Special Guest'],
        ['Host: Mark Normand', 'Sam Morril', 'Guest Comedians'],
        ['Host: Dan Soder', 'Jessica Kirson', 'Rotating Guests'],
      ],
    ],
    [ // Friday 7:30PM — even weeks
      'title'    => 'Comedy Night at Water\'s Edge',
      'time'     => '19:30:00',
      'display'  => '07:30 PM',
      'series'   => 'Comedy Night at Water\'s Edge',
      'location' => 'Waters Edge Resort and Spa, 1525 Boston Post Road., Westbrook, CT',
      'type'     => 'standup',
      'week_parity' => 0,
      'prices'   => [20, 25, 20, 25, 20, 25],
      'images'   => [
        'https://images.unsplash.com/photo-1641903806973-17eaf2d2634f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1527224857830-43a7acc85260?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Oceanside laughs at Water\'s Edge! A night of comedy with stunning waterfront views in Westbrook.',
        'Start your weekend right — great comedy, great cocktails, and the beautiful Long Island Sound.',
        'Comedy on the coast! Join us at Water\'s Edge Resort for a Friday night you won\'t forget.',
      ],
      'lineups' => [
        ['Host: Dave Miller', 'Various Artists'],
        ['Host: Jessica Kirson', 'Rotating Lineup'],
        ['Host: Matteo Lane', 'Special Guests'],
      ],
    ],
    [ // Friday 7:30PM — odd weeks
      'title'    => 'Comedy Night at Brignole Vineyards',
      'time'     => '19:30:00',
      'display'  => '07:30 PM',
      'series'   => 'Comedy Night at Brignole Vineyards',
      'location' => 'Brignole Vineyards, 103 Hartford Ave., East Granby, CT',
      'type'     => 'standup',
      'week_parity' => 1,
      'prices'   => [20, 25, 20, 25, 20, 25],
      'images'   => [
        'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1649772308558-db37c0dfae7e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Comedy and wine — the perfect pairing! Laugh the night away at Brignole Vineyards.',
        'Friday night at Brignole means great wine and even better comedy. Don\'t miss it!',
        'An intimate evening of stand-up surrounded by beautiful East Granby vineyards.',
      ],
      'lineups' => [
        ['Host: Ari Shaffir', 'Shane Gillis', 'Tim Dillon'],
        ['Host: Big Jay Oakerson', 'Stavros Halkias', 'Guest Comedians'],
        ['Host: Whitney Cummings', 'Taylor Tomlinson', 'Iliza Shlesinger'],
      ],
    ],
    [ // Friday 8:00PM — every week
      'title'    => 'Comedy Night at Brew Ha Ha at River',
      'time'     => '20:00:00',
      'display'  => '08:00 PM',
      'series'   => 'Comedy Night at Brew Ha Ha at River',
      'location' => 'River: A Waterfront Restaurant and Bar, 100 Great Meadow Rd, Wethersfield, CT',
      'type'     => 'standup',
      'prices'   => [25, 30, 25, 30, 25, 30],
      'images'   => [
        'https://images.unsplash.com/photo-1730791480843-12ef754c5123?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1527224857830-43a7acc85260?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Brew Ha Ha is back! Live comedy on the river with craft beers and waterfront vibes in Wethersfield.',
        'Friday nights at River just got a whole lot funnier. Craft brews, great food, and top-notch stand-up.',
        'The best way to kick off the weekend — comedy, cocktails, and the Connecticut River.',
      ],
      'lineups' => [
        ['Host: Rosebud Baker', 'Shane Gillis', 'Special Guest'],
        ['Host: Ali Wong', 'Chris Rock', 'Guest Comedians'],
        ['Host: Colin Quinn', 'Joe List', 'Mark Normand'],
      ],
    ],
  ],
  6 => [ // Saturday
    [ // Saturday 7:00PM — every week
      'title'    => 'Comedy Night at Priam Vineyards',
      'time'     => '19:00:00',
      'display'  => '07:00 PM',
      'series'   => 'Comedy Night at Priam Vineyards',
      'location' => 'Priam Vineyards and Winery, 11 Shailor Hill Rd., Colchester, CT',
      'type'     => 'standup',
      'prices'   => [25, 30, 25, 30, 25, 30],
      'images'   => [
        'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1525268771113-32d9e9021a97?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Saturday night at Priam Vineyards — award-winning wine and laugh-out-loud comedy in Colchester.',
        'An evening of stand-up comedy at one of Connecticut\'s most celebrated vineyards.',
        'Wine, laughs, and a beautiful Colchester sunset. Saturday nights at Priam are unforgettable.',
      ],
      'lineups' => [
        ['Host: Ronny Chieng', 'Hasan Minhaj', 'Michelle Wolf'],
        ['Host: Matteo Lane', 'Judy Gold'],
        ['Surprise Headliner', 'Regular Favorites'],
      ],
    ],
    [ // Saturday 8:00PM — even weeks
      'title'    => 'Comedy Night at Brew Ha Ha at River',
      'time'     => '20:00:00',
      'display'  => '08:00 PM',
      'series'   => 'Comedy Night at Brew Ha Ha at River',
      'location' => 'River: A Waterfront Restaurant and Bar, 100 Great Meadow Rd, Wethersfield, CT',
      'type'     => 'standup',
      'week_parity' => 0,
      'prices'   => [30, 35, 35, 40, 30, 35],
      'images'   => [
        'https://images.unsplash.com/photo-1730791480843-12ef754c5123?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Saturday night Brew Ha Ha at River! Double the fun with comedy and craft brews on the water.',
        'Back for more! Saturday\'s lineup at River brings the heat with non-stop stand-up.',
        'The weekend\'s not over yet — catch another night of Brew Ha Ha comedy on Saturday!',
      ],
      'lineups' => [
        ['Host: Big Jay Oakerson', 'Dan Soder', 'Rosebud Baker'],
        ['Host: Joe List', 'Mark Normand', 'Sam Morril'],
        ['Host: Shane Gillis', 'Tim Dillon', 'Special Guest'],
      ],
    ],
    [ // Saturday 8:00PM — odd weeks
      'title'    => 'Comedy Night at The Garde Arts Center',
      'time'     => '20:00:00',
      'display'  => '08:00 PM',
      'series'   => 'Comedy Night at The Garde Arts Center',
      'location' => 'The Oasis Room at The Garde Arts Center, 325 State St., New London, CT',
      'type'     => 'standup',
      'week_parity' => 1,
      'prices'   => [30, 35, 30, 35, 30, 35],
      'images'   => [
        'https://images.unsplash.com/photo-1649772308558-db37c0dfae7e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1641903806973-17eaf2d2634f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Comedy Night at The Garde Arts Center — New London\'s premier comedy experience in The Oasis Room!',
        'Saturday at The Garde means world-class comedy in a historic venue. An evening you won\'t forget.',
        'The Oasis Room comes alive with laughter every Saturday. Top comedians, intimate setting, unforgettable night.',
      ],
      'lineups' => [
        ['Host: Colin Quinn', 'Joe List', 'Mark Normand'],
        ['Host: Stavros Halkias', 'Guest Comedians'],
        ['Host: Jessica Kirson', 'Rotating Lineup'],
      ],
    ],
  ],
  0 => [[ // Sunday 5:00PM — every week
    'title'    => 'Comedy Night at Aquila\'s Nest Vineyard',
    'time'     => '17:00:00',
    'display'  => '05:00 PM',
    'series'   => 'Comedy Night at Aquila\'s Nest Vineyard',
    'location' => 'Aquila\'s Nest Vineyard, 56 Pole Bridge Rd, Sandy Hook, CT',
    'type'     => 'standup',
    'prices'   => [20, 20, 25, 20, 25, 20],
    'images'   => [
      'https://images.unsplash.com/photo-1525268771113-32d9e9021a97?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
    ],
    'descriptions' => [
      'Sunday afternoon comedy at Aquila\'s Nest Vineyard — wind down the weekend with wine and laughs in Sandy Hook.',
      'The perfect Sunday: vineyard views, great wine, and a lineup of comedians that\'ll leave you smiling all week.',
      'End the weekend on a high note at Aquila\'s Nest. Comedy, wine, and Connecticut\'s beautiful countryside.',
    ],
    'lineups' => [
      ['Host: Matteo Lane', 'Judy Gold'],
      ['Host: Joe List', 'Mark Normand'],
      ['Host: Stavros Halkias', 'Guest Comedians'],
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
