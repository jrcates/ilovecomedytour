<?php
/**
 * Comedian Card Component
 *
 * Props:
 *   $comedian - array with keys: id, name, image, bio, isHeadliner
 */
?>
<a href="?view=comedian&id=<?= $comedian['id'] ?>" class="group block">
  <div class="relative overflow-hidden rounded-xl mb-4 bg-neutral-100 aspect-[3/4]">
    <img src="<?= htmlspecialchars($comedian['image']) ?>" alt="<?= htmlspecialchars($comedian['name']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
    <?php if ($comedian['isHeadliner']): ?>
      <div class="absolute top-3 left-3 px-3 py-1 bg-[#F15A29] text-white text-xs font-bold rounded-full uppercase tracking-wider">Headliner</div>
    <?php endif; ?>
  </div>
  <h3 class="font-bold text-black group-hover:text-[#F15A29] transition-colors"><?= htmlspecialchars($comedian['name']) ?></h3>
  <p class="text-neutral-500 text-sm mt-1 line-clamp-2"><?= htmlspecialchars($comedian['bio']) ?></p>
</a>
