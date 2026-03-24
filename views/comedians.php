<?php
// Generate comedian data server-side
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
  "Just for Laughs New Face and Comedy Break In regular.",
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

$searchRaw   = isset($_GET['q']) ? trim($_GET['q']) : '';
$search      = htmlspecialchars($searchRaw);
$page        = max(1, intval($_GET['page'] ?? 1));
$perPage     = 12;

$filtered = array_filter($allComedians, fn($c) => !$searchRaw || stripos($c['name'], $searchRaw) !== false);
$filtered = array_values($filtered);
$total    = count($filtered);
$totalPages = max(1, (int)ceil($total / $perPage));
$page = min($page, $totalPages);
$current = array_slice($filtered, ($page - 1) * $perPage, $perPage);
?>

<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen">

  <!-- Header & Search -->
  <div class="flex flex-col gap-8 mb-20">
    <div>
      <?php component('page-header', ['title' => 'Our Comedians']); ?>
    </div>

    <!-- Search -->
    <form method="GET" action="?view=comedians" class="w-full">
      <input type="hidden" name="view" value="comedians" />
      <div class="relative flex items-center bg-white/5 border border-white/10 rounded-xl p-2 shadow-md focus-within:border-[#d12027] transition-all group">
        <i data-lucide="search" class="ml-3 md:ml-5 w-5 h-5 md:w-6 md:h-6 text-neutral-400 group-focus-within:text-[#d12027] transition-colors shrink-0"></i>
        <input type="text" name="q" value="<?= $search ?>" placeholder="Search by name..." class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-base md:text-lg px-3 md:px-4 text-white placeholder:text-neutral-400 h-10 md:h-12 min-w-0" />
        <button type="submit" class="bg-white text-black font-bold py-2.5 md:py-3 px-5 md:px-8 rounded-[10px] hover:bg-neutral-200 transition-all shrink-0 text-sm md:text-base">Search</button>
      </div>
    </form>
  </div>

  <!-- Grid -->
  <?php if (count($current) > 0): ?>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12 mb-16">
    <?php foreach ($current as $comedian): ?>
      <?php component('comedian-card', ['comedian' => $comedian]); ?>
    <?php endforeach; ?>
  </div>
  <?php else: ?>
  <div class="text-center py-20 bg-white/5 rounded-xl border border-white/10">
    <p class="text-3xl font-bold mb-2 text-white">No comedians found</p>
    <p class="text-neutral-400 mb-8 text-lg">We couldn't find anyone matching "<?= $search ?>".</p>
    <a href="?view=comedians" class="px-8 py-3 bg-white text-black hover:bg-neutral-200 font-bold rounded-[10px] transition-colors">Clear search</a>
  </div>
  <?php endif; ?>

  <!-- Pagination -->
  <?php if ($totalPages > 1): ?>
  <div class="flex items-center justify-center gap-1 mt-16 flex-wrap">
    <?php if ($page > 1): ?>
    <a href="?view=comedians&q=<?= urlencode($searchRaw) ?>&page=<?= $page - 1 ?>" class="w-10 h-10 flex items-center justify-center text-neutral-400 hover:text-white transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
    </a>
    <?php else: ?>
    <span class="w-10 h-10 flex items-center justify-center text-neutral-500">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
    </span>
    <?php endif; ?>

    <?php for ($p = 1; $p <= $totalPages; $p++):
      // On mobile show: first, last, current, and neighbors
      if ($totalPages > 7 && abs($p - $page) > 2 && $p !== 1 && $p !== $totalPages) continue;
    ?>
    <a href="?view=comedians&q=<?= urlencode($searchRaw) ?>&page=<?= $p ?>"
       class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center rounded-full text-sm font-medium transition-colors <?= $p === $page ? 'bg-[#d12027] text-white' : 'text-neutral-400 hover:text-white' ?>">
      <?= $p ?>
    </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
    <a href="?view=comedians&q=<?= urlencode($searchRaw) ?>&page=<?= $page + 1 ?>" class="w-10 h-10 flex items-center justify-center text-neutral-400 hover:text-white transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
    </a>
    <?php else: ?>
    <span class="w-10 h-10 flex items-center justify-center text-neutral-500">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
    </span>
    <?php endif; ?>
  </div>
  <?php endif; ?>
</div>
