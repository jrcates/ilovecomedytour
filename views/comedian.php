<?php
// ─── Regenerate comedian data (same logic as comedians.php) ───
$firstNames = ["James","Sarah","Michael","Jessica","David","Emily","Robert","Jennifer","William","Elizabeth","Joseph","Maria","Thomas","Lisa","Charles","Ashley"];
$lastNames  = ["Chen","Johnson","Smith","Williams","Brown","Jones","Garcia","Miller","Davis","Rodriguez","Martinez","Hernandez","Lopez","Gonzalez","Wilson","Anderson"];
$images     = [
  "https://images.unsplash.com/photo-1580188928585-0ef5c1a5c4dd?auto=format&fit=crop&q=80&w=800",
  "https://images.unsplash.com/photo-1726222959627-08918486e0c4?auto=format&fit=crop&q=80&w=800",
  "https://images.unsplash.com/photo-1766532573885-8bd94537f1c4?auto=format&fit=crop&q=80&w=800",
  "https://images.unsplash.com/photo-1719437364589-17a545612428?auto=format&fit=crop&q=80&w=800",
  "https://images.unsplash.com/photo-1657771072153-878f8b0ce74a?auto=format&fit=crop&q=80&w=800",
  "https://images.unsplash.com/photo-1745848413113-4f39bdad5769?auto=format&fit=crop&q=80&w=800",
];
$bios = [
  "Regular at The Comedy Cellar and seen on The Tonight Show.",
  "Featured on Netflix's 'The Standups' and Comedy Central.",
  "Winner of the New York Comedy Festival's Funniest Stand-up.",
  "Writer for Saturday Night Live and touring headliner.",
  "Host of the popular 'Brooklyn Laughs' podcast.",
  "Seen on HBO's 'Crashing' and Late Night with Seth Meyers.",
  "Just for Laughs New Face and club regular.",
  "Top touring act performing across the country.",
];

$allComedians = [];
for ($i = 0; $i < 160; $i++) {
  $allComedians[] = [
    'id'         => $i,
    'name'       => $firstNames[$i % count($firstNames)] . ' ' . $lastNames[(int)floor($i / count($firstNames)) % count($lastNames)],
    'image'      => $images[$i % count($images)],
    'bio'        => $bios[$i % count($bios)],
    'isHeadliner'=> ($i % 5 === 0),
  ];
}

// ─── Find the requested comedian ───
$comedianId = isset($_GET['id']) ? intval($_GET['id']) : -1;
$comedian = null;
foreach ($allComedians as $c) {
  if ($c['id'] === $comedianId) {
    $comedian = $c;
    break;
  }
}

if (!$comedian) {
  echo '<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen text-center">';
  echo '<h1 class="text-4xl font-bold mb-4">Comedian Not Found</h1>';
  echo '<p class="text-neutral-400 mb-8">We couldn\'t find the comedian you\'re looking for.</p>';
  echo '<a href="?view=comedians" class="px-8 py-3 bg-white text-black font-bold rounded-[10px] hover:bg-neutral-200 transition-colors">Back to Comedians</a>';
  echo '</div>';
  return;
}

// ─── Match comedian to shows ───
function matchesComedian($lineupName, $comedianName) {
  $clean = preg_replace('/^(Host:\s*|Opener:\s*)/i', '', $lineupName);
  return stripos(trim($clean), $comedianName) !== false;
}

$appearances = [];
foreach ($shows as $show) {
  foreach ($show['lineup'] as $performer) {
    if (matchesComedian($performer, $comedian['name'])) {
      $appearances[] = $show;
      break;
    }
  }
}

// If no real matches, assign shows deterministically so the page always has content
if (empty($appearances)) {
  $showCount = count($shows);
  $offset = $comedian['id'] % $showCount;
  for ($i = 0; $i < 3; $i++) {
    $appearances[] = $shows[($offset + $i) % $showCount];
  }
}

$firstName = explode(' ', $comedian['name'])[0];

// Extended bio paragraphs
$extendedBio = [
  "With over a decade of experience performing in venues across the nation, " . $comedian['name'] . " has built a reputation for sharp, observational humor that resonates with audiences of all backgrounds. Their unique perspective on everyday life, relationships, and modern culture has earned them a dedicated following.",
  "When not on stage, " . $comedian['name'] . " can be found writing new material, mentoring up-and-coming comedians, and making appearances on popular podcasts. Their commitment to the craft of comedy is evident in every performance, bringing fresh energy and authentic storytelling to each show.",
];
?>

<!-- ─── Header ─── -->
<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen">

  <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
    <div>
      <span class="text-[#d12027] text-sm font-bold uppercase tracking-widest mb-3 block">Artist Spotlight</span>
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Comedian Profile</h1>
    </div>
    <a href="?view=comedians" class="flex items-center gap-1.5 text-sm text-neutral-400 hover:text-white transition-colors px-4 py-2 rounded-[10px] border border-white/10 hover:border-white/20">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Back
    </a>
  </div>

  <!-- ─── Profile Card ─── -->
  <div class="rounded-xl overflow-hidden mb-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 items-center">
      <!-- Photo -->
      <div class="lg:col-span-5">
        <div class="aspect-[3/4] w-full">
          <img src="<?= htmlspecialchars($comedian['image']) ?>" alt="<?= htmlspecialchars($comedian['name']) ?>" class="w-full h-full object-cover" />
        </div>
      </div>
      <!-- Info -->
      <div class="lg:col-span-7 p-6 md:p-12 lg:p-16 flex flex-col justify-center">
        <span class="inline-block px-3 py-1 bg-white/10 text-neutral-400 text-xs font-bold uppercase tracking-widest rounded-[5px] w-fit mb-6">Stand-Up Comic</span>

        <h2 class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-6"><?= htmlspecialchars($comedian['name']) ?></h2>

        <!-- Social Icons -->
        <div class="flex gap-3 mb-8">
          <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black hover:bg-neutral-200 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black hover:bg-neutral-200 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black hover:bg-neutral-200 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
          </a>
          <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black hover:bg-neutral-200 transition-colors">
            <i data-lucide="globe" class="w-4 h-4"></i>
          </a>
        </div>

        <!-- Bio -->
        <p class="text-white font-bold text-lg mb-4"><?= htmlspecialchars($comedian['bio']) ?></p>
        <?php foreach ($extendedBio as $paragraph): ?>
        <p class="text-neutral-400 leading-relaxed mb-4"><?= htmlspecialchars($paragraph) ?></p>
        <?php endforeach; ?>

        <!-- Share Button -->
        <div class="mt-6">
          <button class="inline-flex items-center gap-2 px-6 py-3 bg-white/5 text-white rounded-[10px] font-bold text-sm uppercase tracking-wider hover:bg-white/10 transition-colors border border-white/10">
            <i data-lucide="share-2" class="w-4 h-4"></i>
            Share Profile
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- ─── Upcoming Appearances ─── -->
  <div class="mb-12">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
      <div>
        <h2 class="text-3xl font-bold tracking-wide mb-2 text-white">Upcoming Appearances</h2>
        <p class="text-neutral-400">Catch <?= htmlspecialchars($firstName) ?> at these upcoming shows</p>
      </div>
      <a href="?view=calendar" class="px-6 py-2 bg-white text-black font-bold rounded-[10px] uppercase tracking-wider text-xs hover:bg-neutral-200 transition-colors">View Full Calendar</a>
    </div>

    <div class="space-y-4">
      <?php foreach ($appearances as $show):
        $sd = formatShowDate($show['date']);
      ?>
      <div class="bg-neutral-900 rounded-xl border border-white/10 shadow-md p-5 flex flex-col md:flex-row md:items-center gap-5">
        <div class="w-20 h-20 rounded-full overflow-hidden flex-shrink-0 border-2 border-white/10">
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
        <a href="?view=event&show=<?= urlencode($show['id']) ?>" class="w-full md:w-auto text-center px-6 py-2.5 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-neutral-200 transition-colors whitespace-nowrap flex-shrink-0">Buy Tickets</a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
