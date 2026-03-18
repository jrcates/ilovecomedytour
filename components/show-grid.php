<section class="py-16 bg-[#171C1C] relative overflow-hidden">
  <div class="max-w-[1200px] mx-auto px-6 relative z-10">
    <?php if (isset($title)): ?>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-12">
      <h2 class="text-3xl font-bold uppercase tracking-wide"><?= htmlspecialchars($title) ?></h2>
      <?php if (isset($linkUrl)): ?>
        <a href="<?= $linkUrl ?>" class="px-6 py-2 bg-[#24CECE] text-black font-bold rounded-full uppercase tracking-wider text-xs hover:bg-[#20B8B8] transition-colors shrink-0"><?= htmlspecialchars($linkText ?? 'View All') ?></a>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="space-y-4">
      <?php foreach ($shows as $show): ?>
        <?php component('show-card', ['show' => $show]); ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
