<div class="<?= isset($centered) && $centered ? 'text-center' : '' ?> mb-8">
  <h1 class="text-4xl md:text-5xl font-black text-white mb-3 uppercase tracking-tight"><?= $title ?></h1>
  <?php if (isset($description)): ?>
    <p class="text-white text-xl max-w-2xl <?= isset($centered) && $centered ? 'mx-auto' : '' ?>"><?= htmlspecialchars($description) ?></p>
  <?php endif; ?>
</div>
