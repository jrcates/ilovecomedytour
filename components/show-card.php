<div class="cc-show-card bg-white rounded-[5px] p-6 flex flex-col md:flex-row items-center gap-8 transition-all border border-neutral-800">
  <?php component('date-badge', ['date' => $show['date']]); ?>
  <div class="w-full md:w-[220px] h-[140px] rounded-[5px] overflow-hidden flex-shrink-0">
    <img src="<?= htmlspecialchars($show['image']) ?>" alt="<?= htmlspecialchars($show['title']) ?>" class="cc-show-card-img w-full h-full object-cover" />
  </div>
  <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left self-center">
    <h3 class="text-[20px] font-extrabold text-black uppercase mb-3"><?= htmlspecialchars($show['title']) ?></h3>
    <p class="text-neutral-500 text-sm leading-relaxed line-clamp-2">Join us for Comedy Night at <?= htmlspecialchars($show['location']) ?>.</p>
  </div>
  <a href="?view=event&show=<?= urlencode($show['id']) ?>" class="px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full text-sm hover:bg-[#20B8B8] transition-colors whitespace-nowrap flex-shrink-0 cc-hover-lift shadow-lg shadow-[#24CECE]/20">Buy Tickets</a>
</div>
