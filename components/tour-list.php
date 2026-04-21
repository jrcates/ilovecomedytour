<?php
// ─── tour-list.php ─────────────────────────────────────
// Compact list of upcoming tour dates. One row per day, time
// slots as pill buttons inside each row. Clicking a slot
// deep-links to Stage B with the slot pre-selected.
//
// Expects (optional):
//   $tour  — tour array; defaults to getTour('ilct-nyc')
//   $limit — max number of days to show; defaults to 5
// ───────────────────────────────────────────────────────

$tlTour  = isset($tour)  ? $tour  : getTour('ilct-nyc');
$tlLimit = isset($limit) ? (int)$limit : 5;

if (!$tlTour) return;

$tlTourId = $tlTour['id'];
$tlUpcoming = getUpcomingInstances($tlTourId);

$tlByDate = [];
foreach ($tlUpcoming as $inst) {
  $d = substr($inst['dateTime'], 0, 10);
  if (!isset($tlByDate[$d])) $tlByDate[$d] = [];
  $tlByDate[$d][] = $inst;
}

$tlDates = array_slice(array_keys($tlByDate), 0, $tlLimit);
if (empty($tlDates)) return;
?>

<div class="divide-y divide-black/10">
  <?php foreach ($tlDates as $tlDate):
    $tlDt       = new DateTime($tlDate);
    $tlWeekday  = strtoupper($tlDt->format('D'));
    $tlWeekFull = $tlDt->format('l');
    $tlMonth    = strtoupper($tlDt->format('M'));
    $tlDayNum   = $tlDt->format('j');
    $tlMonthFull = $tlDt->format('F');

    $tlSlots = $tlByDate[$tlDate];
    $tlTotalSpots = 0;
    foreach ($tlSlots as $i) $tlTotalSpots += max(0, (int)$i['spotsRemaining']);
  ?>
  <article class="py-5 md:py-7 grid grid-cols-1 md:grid-cols-[auto_1fr_auto] gap-5 md:gap-8 items-center">

    <!-- Date block (ticket-stub style) -->
    <div class="flex md:flex-col items-center md:justify-center gap-4 md:gap-0 bg-[#f9dda9] border-2 border-black rounded-xl w-full md:w-24 py-3 px-4 md:px-0 shrink-0 md:text-center" style="box-shadow: 3px 3px 0 #2d1712;">
      <span class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-900"><?= $tlWeekday ?></span>
      <span class="text-3xl md:text-4xl font-extrabold text-neutral-900 leading-none tracking-tight"><?= $tlDayNum ?></span>
      <span class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-900"><?= $tlMonth ?></span>
    </div>

    <!-- Info -->
    <div class="min-w-0">
      <h3 class="text-xl md:text-2xl font-extrabold text-neutral-900 tracking-tight leading-tight mb-1">
        <?= htmlspecialchars($tlWeekFull) ?>, <?= htmlspecialchars($tlMonthFull) ?> <?= $tlDayNum ?>
      </h3>
      <p class="text-sm text-neutral-600">
        <?= count($tlSlots) ?> time<?= count($tlSlots) > 1 ? 's' : '' ?> ·
        <?php if ($tlTotalSpots === 0): ?>
          <span class="text-neutral-500 font-semibold">Sold out</span>
        <?php else: ?>
          <span class="text-[#d12027] font-bold"><?= $tlTotalSpots ?> spots</span> available
        <?php endif; ?>
      </p>
    </div>

    <!-- Time slot buttons -->
    <div class="flex flex-wrap gap-2 md:justify-end">
      <?php foreach ($tlSlots as $tlInst):
        $tlSold = $tlInst['spotsRemaining'] <= 0;
        $tlTime = date('g:iA', strtotime($tlInst['dateTime']));
        $tlHref = '?view=tour&tour=' . urlencode($tlTourId)
                . '&date=' . urlencode($tlDate)
                . '&slot=' . urlencode($tlInst['id']);
      ?>
        <?php if ($tlSold): ?>
        <span class="inline-flex items-center justify-center px-4 py-2.5 bg-neutral-200 text-neutral-500 border-2 border-neutral-300 rounded-full text-[11px] font-extrabold uppercase tracking-[0.18em] line-through cursor-not-allowed"><?= $tlTime ?></span>
        <?php else: ?>
        <a href="<?= htmlspecialchars($tlHref) ?>"
           class="inline-flex items-center justify-center px-4 py-2.5 bg-[#d12027] text-white border-2 border-[#2d1712] rounded-full text-[11px] font-extrabold uppercase tracking-[0.18em] shadow-[0_3px_0_0_#2d1712] hover:-translate-y-0.5 hover:shadow-[0_5px_0_0_#2d1712] transition-all"><?= $tlTime ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

  </article>
  <?php endforeach; ?>
</div>
