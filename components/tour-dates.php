<?php
// Expects: $shows (array of show objects)
$tdShows = isset($shows) ? $shows : [];

// Group by venue + ISO week
$groups = [];
foreach ($tdShows as $show) {
  $dt = new DateTime($show['date']);
  $key = $show['location'] . '|' . $dt->format('o-W');
  if (!isset($groups[$key])) {
    $groups[$key] = [
      'location'    => $show['location'],
      'venue'       => parseVenue($show['location']),
      'cityState'   => parseCityState($show['location']),
      'description' => $show['description'],
      'shows'       => [],
    ];
  }
  $groups[$key]['shows'][] = $show;
}

$groups = array_values($groups);
foreach ($groups as &$g) {
  usort($g['shows'], function($a, $b) { return strcmp($a['date'], $b['date']); });
  $first = new DateTime($g['shows'][0]['date']);
  $last  = new DateTime(end($g['shows'])['date']);
  $startLabel = formatRangeDate($first);
  $endLabel   = formatRangeDate($last);
  $g['dateRange'] = $startLabel === $endLabel ? $startLabel : $startLabel . ' - ' . $endLabel;
  $g['_sortKey']  = $g['shows'][0]['date'];
}
unset($g);
usort($groups, function($a, $b) { return strcmp($a['_sortKey'], $b['_sortKey']); });

// Demo-only: sprinkle synthetic JUST ANNOUNCED / RESCHEDULED badges.
// SOLD OUT takes precedence when every slot in the group is sold out.
foreach ($groups as $i => &$g) {
  $allSold = !empty($g['shows']) && array_reduce($g['shows'], function($carry, $s) {
    return $carry && (($s['status'] ?? '') === 'Sold Out');
  }, true);

  if ($allSold) {
    $g['tag'] = ['label' => 'SOLD OUT', 'cls' => 'bg-neutral-500 text-white'];
  } elseif ($i % 6 === 0) {
    $g['tag'] = ['label' => 'JUST ANNOUNCED', 'cls' => 'bg-[#2fb03c] text-white'];
  } elseif ($i % 9 === 0) {
    $g['tag'] = ['label' => 'RESCHEDULED!', 'cls' => 'bg-[#6b2a9a] text-white'];
  } else {
    $g['tag'] = null;
  }
}
unset($g);
?>

<div class="divide-y divide-white/10">
  <?php foreach ($groups as $g): ?>
  <article class="py-6 md:py-10 grid grid-cols-1 md:grid-cols-[1fr_minmax(300px,380px)] gap-5 md:gap-10 items-start">

    <!-- LEFT: info -->
    <div>
      <div class="flex flex-wrap items-center gap-2 mb-4">
        <?php if ($g['tag']): ?>
        <span class="inline-flex items-center h-7 px-3 <?= $g['tag']['cls'] ?> text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]"><?= $g['tag']['label'] ?></span>
        <?php endif; ?>
        <span class="inline-flex items-center h-7 px-3 bg-white/10 border border-white/15 text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]"><?= htmlspecialchars($g['dateRange']) ?></span>
      </div>

      <h2 class="text-2xl md:text-[32px] font-extrabold text-white tracking-tight leading-[1.1] mb-2"><?= htmlspecialchars($g['cityState']) ?></h2>
      <div class="text-lg md:text-2xl font-extrabold text-[#f9dda9] tracking-tight mb-2"><?= htmlspecialchars($g['venue']) ?></div>
      <?php if (!empty($g['description'])): ?>
      <div class="text-sm md:text-base font-medium text-neutral-400 leading-relaxed"><?= htmlspecialchars($g['description']) ?></div>
      <?php endif; ?>
    </div>

    <!-- RIGHT: time slots -->
    <div class="flex flex-col gap-3 pr-1 pb-1">
      <?php foreach ($g['shows'] as $show):
        $dt = new DateTime($show['date']);
        $label = formatSlotLabel($dt);
        $status = $show['status'] ?? '';
        $isSold = $status === 'Sold Out';
        $isLow  = $status === 'Selling Fast';
      ?>
      <?php
        $tagCls = $tagLabel = null;
        if ($isLow)       { $tagCls = 'bg-[#e83a2f]';   $tagLabel = 'LOW'; }
        elseif ($isSold)  { $tagCls = 'bg-neutral-500'; $tagLabel = 'SOLD'; }
      ?>
      <div class="relative">
        <?php if ($tagLabel): ?>
        <span class="absolute -top-1.5 -left-1.5 z-10 px-1.5 py-1 md:px-2 md:py-1.5 <?= $tagCls ?> border-2 border-black text-white text-[9px] md:text-[10px] font-extrabold tracking-[0.18em] uppercase leading-none shadow-[2px_2px_0_#000]"><?= $tagLabel ?></span>
        <?php endif; ?>

        <?php if ($isSold): ?>
        <span class="cc-btn-primary is-disabled w-full px-4 md:px-5 py-3 text-xs md:text-sm tracking-[0.12em]"><?= $label ?></span>
        <?php else: ?>
        <a href="?view=event&show=<?= urlencode($show['id']) ?>"
           class="cc-btn-primary w-full px-4 md:px-5 py-3 text-xs md:text-sm tracking-[0.12em]"><?= $label ?></a>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>

  </article>
  <?php endforeach; ?>
</div>
