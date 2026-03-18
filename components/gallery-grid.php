<?php
/**
 * Gallery Grid Component (with Alpine.js lightbox)
 *
 * Props:
 *   $images  - array of image paths
 *   $layout  - optional array of [cols, rows] pairs for desktop grid
 */
?>
<div x-data="{ lightboxOpen: false, lightboxSrc: '' }"
     x-init="$watch('lightboxOpen', () => { $nextTick(() => lucide.createIcons()) })"
     @keydown.escape.window="lightboxOpen = false">

  <!-- Lightbox overlay -->
  <div x-show="lightboxOpen" x-transition.opacity
       class="fixed inset-0 z-[60] bg-black/95 backdrop-blur-xl flex items-center justify-center p-4"
       @click.self="lightboxOpen = false" style="display: none;">
    <button @click="lightboxOpen = false" class="absolute top-6 right-6 text-neutral-400 hover:text-white transition-colors">
      <i data-lucide="x" class="w-8 h-8"></i>
    </button>
    <img :src="lightboxSrc" alt="Gallery image" class="max-w-full max-h-[90vh] object-contain shadow-2xl" style="border-radius:5px;" />
  </div>

  <!-- Desktop Gallery Grid (4-col) -->
  <div class="hidden md:grid grid-cols-4 gap-4 auto-rows-[220px]">
    <?php foreach ($images as $i => $img):
      $cols = isset($layout[$i]) ? $layout[$i][0] : 1;
      $rows = isset($layout[$i]) ? $layout[$i][1] : 1;
    ?>
    <button type="button" @click="lightboxSrc = '<?= htmlspecialchars($img) ?>'; lightboxOpen = true"
            class="cc-gallery-item relative group cursor-zoom-in overflow-hidden bg-neutral-900 border border-neutral-800 col-span-<?= $cols ?> row-span-<?= $rows ?>"
            style="border-radius:5px;">
      <img src="<?= htmlspecialchars($img) ?>" alt="Gallery moment <?= $i + 1 ?>" class="w-full h-full object-cover block transition-transform duration-700 group-hover:scale-105" loading="lazy" />
      <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
        <i data-lucide="zoom-in" class="w-10 h-10 text-[#24CECE] scale-0 group-hover:scale-100 transition-transform duration-300"></i>
      </div>
    </button>
    <?php endforeach; ?>
  </div>

  <!-- Mobile Gallery Grid (2-col) -->
  <div class="grid md:hidden grid-cols-2 gap-3">
    <?php foreach ($images as $i => $img): ?>
    <button type="button" @click="lightboxSrc = '<?= htmlspecialchars($img) ?>'; lightboxOpen = true"
            class="cc-gallery-item relative group cursor-zoom-in overflow-hidden bg-neutral-900 border border-neutral-800 <?= ($i % 3 === 2) ? 'col-span-2 h-[220px]' : 'h-[200px]' ?>"
            style="border-radius:5px;">
      <img src="<?= htmlspecialchars($img) ?>" alt="Gallery moment <?= $i + 1 ?>" class="w-full h-full object-cover block" loading="lazy" />
    </button>
    <?php endforeach; ?>
  </div>
</div>
