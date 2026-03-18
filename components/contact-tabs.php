<?php
/**
 * Contact Tabs Component
 *
 * Props:
 *   $activeTab - string, the currently active tab ID
 *   $tabs      - array of [id, label] pairs
 */
?>
<div class="w-full mb-16 sticky top-24 z-30">
  <div class="w-full grid grid-cols-<?= count($tabs) ?> gap-4">
    <?php foreach ($tabs as [$id, $label]): ?>
    <a href="?view=contact&tab=<?= $id ?>"
       class="cc-tab-btn px-3 md:px-6 py-3 md:py-4 font-bold flex items-center justify-center transition-colors w-full text-xs md:text-sm <?= $activeTab === $id ? 'bg-[#24CECE] text-black' : 'bg-[#0E1414] text-[#6A7474] hover:text-white' ?>">
      <?= htmlspecialchars($label) ?>
    </a>
    <?php endforeach; ?>
  </div>
</div>
