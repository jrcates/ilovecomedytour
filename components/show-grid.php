<section class="py-16 relative overflow-hidden" x-data="{ viewMode: 'grid' }">
  <div class="max-w-[1200px] mx-auto px-4 md:px-6 relative z-10">
    <?php if (isset($title)): ?>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
      <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight"><?= htmlspecialchars($title) ?></h2>
      <div class="hidden md:flex items-center gap-1 border-l border-white/10 pl-4 ml-4">
        <button @click="viewMode = 'grid'" :class="viewMode === 'grid' ? 'bg-[#d12027]/10 text-[#d12027] border-[#d12027]' : 'bg-white/5 text-neutral-400 border-white/10 hover:border-white/20'" class="w-10 h-10 rounded-lg border flex items-center justify-center transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        </button>
        <button @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-[#d12027]/10 text-[#d12027] border-[#d12027]' : 'bg-white/5 text-neutral-400 border-white/10 hover:border-white/20'" class="w-10 h-10 rounded-lg border flex items-center justify-center transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/><circle cx="4" cy="6" r="1" fill="currentColor"/><circle cx="4" cy="12" r="1" fill="currentColor"/><circle cx="4" cy="18" r="1" fill="currentColor"/></svg>
        </button>
      </div>
    </div>
    <?php endif; ?>

    <!-- Grid View (desktop only) -->
    <div x-show="viewMode === 'grid'" x-transition class="hidden md:grid md:grid-cols-3 gap-6">
      <?php foreach ($shows as $i => $show):
        $d = formatShowDate($show['date']);
      ?>
      <div class="bg-white/5 rounded-xl border border-white/10 shadow-md overflow-hidden flex flex-col">
        <!-- Mobile: text first, image below (like carousel) -->
        <div class="flex flex-col md:hidden">
          <div class="p-5 pb-3 flex flex-col gap-3">
            <h3 class="text-lg font-bold text-white"><?= htmlspecialchars($show['title']) ?></h3>
            <div class="flex flex-wrap items-center gap-2">
              <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <?= $d['weekday'] ?>, <?= $d['day'] ?> <?= $d['month'] ?> <?= $d['year'] ?>
              </span>
              <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?= htmlspecialchars($d['time']) ?>
              </span>
            </div>
            <div class="inline-flex items-center gap-1.5 bg-white/5 text-neutral-400 text-xs font-medium px-3 py-1.5 rounded-full max-w-full overflow-hidden">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              <span class="truncate"><?= htmlspecialchars($show['location']) ?></span>
            </div>
            <a href="?view=event&show=<?= urlencode($show['id']) ?>" class="inline-block px-6 py-2.5 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-neutral-200 transition-colors w-fit">Buy Tickets</a>
          </div>
          <div class="px-3 pb-3 h-[220px]">
            <img src="<?= htmlspecialchars($show['image']) ?>" alt="<?= htmlspecialchars($show['title']) ?>" class="w-full h-full object-cover rounded-lg" />
          </div>
        </div>
        <!-- Desktop: image on top, content below -->
        <div class="hidden md:flex md:flex-col flex-1">
          <div class="h-[220px] overflow-hidden">
            <img src="<?= htmlspecialchars($show['image']) ?>" alt="<?= htmlspecialchars($show['title']) ?>" class="w-full h-full object-cover" />
          </div>
          <div class="p-5 flex flex-col flex-1">
            <h3 class="text-lg font-bold text-white mb-3 line-clamp-2 min-h-[3.5rem]"><?= htmlspecialchars($show['title']) ?></h3>
            <div class="flex flex-wrap items-center gap-2 mb-3">
              <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <?= $d['weekday'] ?>, <?= $d['day'] ?> <?= $d['month'] ?> <?= $d['year'] ?>
              </span>
              <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?= htmlspecialchars($d['time']) ?>
              </span>
            </div>
            <div class="inline-flex items-center gap-1.5 bg-white/5 text-neutral-400 text-xs font-medium px-3 py-1.5 rounded-full max-w-full overflow-hidden mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              <span class="truncate"><?= htmlspecialchars($show['location']) ?></span>
            </div>
            <p class="text-neutral-400 text-sm leading-relaxed line-clamp-3 mb-4"><?= htmlspecialchars($show['description']) ?></p>
            <div class="mt-auto">
              <a href="?view=event&show=<?= urlencode($show['id']) ?>" class="inline-block px-6 py-2.5 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-neutral-200 transition-colors">Buy Tickets</a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- List View (always on mobile, toggle on desktop) -->
    <div :class="viewMode === 'list' ? '' : 'md:hidden'" class="space-y-4">
      <?php foreach ($shows as $i => $show):
        $d = formatShowDate($show['date']);
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
              <?= $d['weekday'] ?>, <?= $d['day'] ?> <?= $d['month'] ?> <?= $d['year'] ?>
            </span>
            <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <?= htmlspecialchars($d['time']) ?>
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

    <?php if (isset($linkUrl)): ?>
    <div class="mt-10">
      <a href="<?= $linkUrl ?>" class="block w-full py-4 bg-white text-black font-bold text-center rounded-[10px] hover:bg-neutral-200 transition-colors text-sm"><?= htmlspecialchars($linkText ?? 'See Full Calendar') ?></a>
    </div>
    <?php endif; ?>
  </div>
</section>
