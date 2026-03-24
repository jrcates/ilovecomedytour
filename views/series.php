<?php
$seriesName = isset($_GET['name']) ? trim($_GET['name']) : null;

// Find all shows in this series
$seriesShows = [];
$seriesImage = '';
foreach ($shows as $s) {
  if (isset($s['series']) && $s['series'] === $seriesName) {
    $seriesShows[] = $s;
    if (!$seriesImage) $seriesImage = $s['image'];
  }
}

if (!$seriesName || empty($seriesShows)) {
  echo '<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen text-center">';
  echo '<h1 class="text-4xl font-bold mb-4">Series Not Found</h1>';
  echo '<p class="text-neutral-400 mb-8">The show series you\'re looking for doesn\'t exist.</p>';
  echo '<a href="?view=calendar" class="px-8 py-3 bg-white text-black font-bold rounded-[10px] hover:bg-neutral-200 transition-colors">View Schedule</a>';
  echo '</div>';
  return;
}

// Series metadata
$firstShow = $seriesShows[0];
$dayOfWeek = date('l', strtotime($firstShow['date']));
$showTime  = $firstShow['time'];
$totalShows = count($seriesShows);

// Series descriptions
$seriesDescriptions = [
  'Monday Prime-Time Comedy in Brooklyn!' => [
    'tagline' => 'The best way to start your week.',
    'about'   => 'Every Monday night, the club lights up with our signature Prime-Time show. Featuring a rotating lineup of the city\'s best up-and-coming comedians and seasoned pros, this weekly showcase is the perfect cure for the Monday blues. Grab a drink, settle in, and let the finest comedians turn your week around.',
    'extra'   => 'Monday Prime-Time has become a staple of the local comedy scene, drawing both regulars and newcomers week after week. With a laid-back atmosphere and world-class talent, it\'s the kind of show that makes you look forward to Mondays.',
  ],
  'Comedy Spotlight' => [
    'tagline' => 'Where rising stars shine brightest.',
    'about'   => 'Every Tuesday, our Comedy Spotlight puts the focus on the freshest voices in comedy. This intimate showcase in our Lounge is where careers are launched and legends are born. You never know who might drop in to test new material or surprise the crowd.',
    'extra'   => 'Comedy Spotlight has a track record of featuring comedians before they blow up. If you want to say "I saw them when," this is the show for you. The relaxed Tuesday vibe makes it perfect for a casual night out with big laughs.',
  ],
  'Comedy Loves Ya' => [
    'tagline' => 'Mid-week therapy, Brooklyn style.',
    'about'   => 'Wednesday nights belong to Comedy Loves Ya — our mid-week showcase that proves comedy really does love you back. A stacked lineup of established headliners and fan favorites makes this the perfect way to break up the work week with wall-to-wall laughs.',
    'extra'   => 'Comedy Loves Ya has earned its reputation as one of the most consistent shows on the comedy circuit. Whether you\'re a first-timer or a regular, you\'ll leave feeling the love — and probably with sore abs from laughing.',
  ],
  'Weekend Warmup comedy in Brooklyn!' => [
    'tagline' => 'The weekend starts here.',
    'about'   => 'Every Friday at 7:00 PM, Weekend Warmup kicks off the weekend with raw, unfiltered comedy from the hottest performers. This high-energy show sets the tone for your entire weekend with no-holds-barred stand-up that will have you rolling.',
    'extra'   => 'Weekend Warmup is the show that gets you fired up for Friday night. Come early, grab your drinks, and get ready for a lineup that hits hard and fast. It\'s the perfect pre-game for whatever your weekend has in store.',
  ],
  'TGIF Comedy in Brooklyn!' => [
    'tagline' => 'Thank God It\'s Funny.',
    'about'   => 'Following the Weekend Warmup every Friday at 7:30 PM, TGIF Comedy brings a different energy — edgier, louder, and just as hilarious. Celebrate the end of the work week with a night of pure comedy gold alongside your crew.',
    'extra'   => 'TGIF is the go-to Friday night comedy experience. The later slot means a crowd that\'s warmed up and ready to go, and our comedians bring their A-game every single week. Bring your friends — this one\'s a party.',
  ],
  'Saturday Standup Live!' => [
    'tagline' => 'The biggest night in comedy.',
    'about'   => 'Saturday Standup Live is our flagship show — the crown jewel of the weekly lineup. Every Saturday at 8:00 PM, the Main Stage hosts the biggest names and the best talent for a premium comedy experience. This is THE night out.',
    'extra'   => 'Saturday nights here are legendary. From surprise drop-ins to headliner sets that go viral, Saturday Standup Live consistently delivers unforgettable nights. Dress up, show up, and laugh it up — this is the main event.',
  ],
  'Guy\'z Nite Comedy' => [
    'tagline' => 'Round up the boys. Sunday nights are for laughs.',
    'about'   => 'Every Sunday at 8:00 PM, Guy\'z Nite takes over the Lounge for an evening of raw, unfiltered comedy. Kick back with your crew, cold drinks in hand, and enjoy a lineup of comedians who keep it real and keep it hilarious.',
    'extra'   => 'Guy\'z Nite has become a Sunday tradition. It\'s the perfect way to end the weekend — relaxed atmosphere, great company, and non-stop laughs. Everyone\'s welcome, but the vibe is strictly good times.',
  ],
];

$meta = isset($seriesDescriptions[$seriesName]) ? $seriesDescriptions[$seriesName] : [
  'tagline' => 'A recurring show at our Comedy Break In.',
  'about'   => 'Join us for this weekly showcase at the Comedy Break In.',
  'extra'   => 'Check below for all upcoming dates and grab your tickets.',
];
?>

<!-- ─── Header ─── -->
<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen">

  <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
    <div>
      <span class="text-[#d12027] text-sm font-bold uppercase tracking-widest mb-3 block">Recurring Show</span>
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Show Series</h1>
    </div>
    <a href="?view=calendar" class="flex items-center gap-1.5 text-sm text-neutral-400 hover:text-white transition-colors px-4 py-2 rounded-[10px] border border-white/10 hover:border-white/20">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Back to Schedule
    </a>
  </div>

  <!-- ─── Series Profile Card ─── -->
  <div class="rounded-xl overflow-hidden mb-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 items-center">
      <!-- Image -->
      <div class="lg:col-span-5">
        <div class="aspect-[3/4] w-full">
          <img src="<?= htmlspecialchars($seriesImage) ?>" alt="<?= htmlspecialchars($seriesName) ?>" class="w-full h-full object-cover" />
        </div>
      </div>
      <!-- Info -->
      <div class="lg:col-span-7 p-8 md:p-12 lg:p-16 flex flex-col justify-center">
        <div class="flex flex-wrap gap-2 mb-6">
          <span class="inline-block px-3 py-1 bg-[#d12027]/20 text-[#d12027] text-xs font-bold uppercase tracking-widest rounded-[5px]">Every <?= htmlspecialchars($dayOfWeek) ?></span>
          <span class="inline-block px-3 py-1 bg-white/10 text-neutral-400 text-xs font-bold uppercase tracking-widest rounded-[5px]"><?= htmlspecialchars($showTime) ?></span>
        </div>

        <h2 class="text-2xl sm:text-4xl md:text-6xl font-bold tracking-tight mb-6"><?= htmlspecialchars($seriesName) ?></h2>

        <!-- Quick Stats -->
        <div class="flex flex-wrap gap-6 mb-8">
          <div class="flex items-center gap-2 text-neutral-400">
            <i data-lucide="calendar" class="w-4 h-4 text-[#d12027]"></i>
            <span class="text-sm font-medium"><?= $totalShows ?> upcoming shows</span>
          </div>
          <div class="flex items-center gap-2 text-neutral-400">
            <i data-lucide="map-pin" class="w-4 h-4 text-[#d12027]"></i>
            <span class="text-sm font-medium"><?= htmlspecialchars($firstShow['location']) ?></span>
          </div>
          <div class="flex items-center gap-2 text-neutral-400">
            <i data-lucide="ticket" class="w-4 h-4 text-[#d12027]"></i>
            <span class="text-sm font-medium">From <?= htmlspecialchars($firstShow['price']) ?></span>
          </div>
        </div>

        <!-- Tagline & Description -->
        <p class="text-white font-bold text-lg mb-4"><?= htmlspecialchars($meta['tagline']) ?></p>
        <p class="text-neutral-400 leading-relaxed mb-4"><?= htmlspecialchars($meta['about']) ?></p>
        <p class="text-neutral-400 leading-relaxed mb-8"><?= htmlspecialchars($meta['extra']) ?></p>

        <!-- CTA -->
        <div class="flex flex-wrap gap-3">
          <a href="#upcoming" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-black rounded-[10px] font-bold text-sm uppercase tracking-wider hover:bg-neutral-200 transition-colors">
            <i data-lucide="ticket" class="w-4 h-4"></i>
            View All Dates
          </a>
          <button class="inline-flex items-center gap-2 px-6 py-3 bg-white/5 text-white rounded-[10px] font-bold text-sm uppercase tracking-wider hover:bg-white/10 transition-colors">
            <i data-lucide="share-2" class="w-4 h-4"></i>
            Share
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- ─── All Upcoming Shows ─── -->
  <div id="upcoming" class="mb-12">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
      <div>
        <h2 class="text-3xl font-bold tracking-wide mb-2 text-white">All Upcoming Dates</h2>
        <p class="text-neutral-400">Every <?= htmlspecialchars($dayOfWeek) ?> at <?= htmlspecialchars($showTime) ?></p>
      </div>
      <a href="?view=calendar" class="px-6 py-2 bg-white text-black font-bold rounded-[10px] uppercase tracking-wider text-xs hover:bg-neutral-200 transition-colors">View Full Calendar</a>
    </div>

    <div class="space-y-4">
      <?php foreach ($seriesShows as $show):
        $isSoldOut = $show['status'] === 'Sold Out';
        $sd = formatShowDate($show['date']);
      ?>
      <div class="bg-white/5 rounded-xl border border-white/10 shadow-md p-5 flex flex-col md:flex-row md:items-center gap-5">
        <div class="w-20 h-20 rounded-full overflow-hidden flex-shrink-0 border-2 border-white/5">
          <img src="<?= htmlspecialchars($show['image']) ?>" alt="<?= htmlspecialchars($show['title']) ?>" class="w-full h-full object-cover" />
        </div>
        <div class="flex-1 min-w-0">
          <h3 class="text-lg font-bold text-white mb-1"><?= htmlspecialchars($show['title']) ?></h3>
          <p class="text-neutral-400 text-sm leading-relaxed mb-3"><?= htmlspecialchars($show['description']) ?></p>
          <div class="flex flex-wrap items-center gap-2">
            <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              <?= $sd['weekday'] ?>, <?= $sd['day'] ?> <?= $sd['month'] ?> <?= $sd['year'] ?>
            </span>
            <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <?= $sd['time'] ?>
            </span>
            <span class="inline-flex items-center gap-1.5 bg-white/5 text-neutral-400 text-xs font-medium px-3 py-1 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              <?= htmlspecialchars($show['location']) ?>
            </span>
          </div>
        </div>
        <?php if ($isSoldOut): ?>
        <button disabled class="px-6 py-2.5 bg-white/10 text-neutral-400 font-bold text-sm rounded-[10px] cursor-not-allowed whitespace-nowrap flex-shrink-0">Sold Out</button>
        <?php else: ?>
        <a href="?view=event&show=<?= urlencode($show['id']) ?>" class="px-6 py-2.5 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-neutral-200 transition-colors whitespace-nowrap flex-shrink-0">Buy Tickets</a>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
