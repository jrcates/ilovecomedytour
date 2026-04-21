<?php
// ─── Tour page — two stages ───────────────────────
// Stage A: ?view=tour&tour=ilct-nyc              → month calendar (pick a date)
// Stage B: ?view=tour&tour=ilct-nyc&date=YYYY-MM-DD → day detail (pick time + guests)

$tourId    = isset($_GET['tour']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['tour']) : 'ilct-nyc';
$dateParam = isset($_GET['date']) ? preg_replace('/[^0-9\-]/', '', $_GET['date']) : '';
$slotParam = isset($_GET['slot']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['slot']) : '';

$tour = getTour($tourId);
if (!$tour):
?>
<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <h1 class="text-4xl font-extrabold text-neutral-900 mb-4 tracking-tight">Tour Not Found</h1>
  <a href="?view=home" class="cc-btn-primary text-sm tracking-[0.14em] px-8 py-3">Back to Home</a>
</div>
<?php return; endif;

// ── Pricing (10% service fee baked in to match existing checkout math) ──
$basePrice     = (float)$tour['pricePerGuest'];
$feeRatePct    = 10;
$totalPerGuest = round($basePrice * 1.10, 2);

// ── Upcoming instances grouped by YYYY-MM-DD ──
$upcoming = getUpcomingInstances($tourId);
$byDate   = [];
foreach ($upcoming as $inst) {
  $d = substr($inst['dateTime'], 0, 10);
  if (!isset($byDate[$d])) $byDate[$d] = [];
  $byDate[$d][] = $inst;
}

// ── Decide stage ──
$selectedDate      = ($dateParam && isset($byDate[$dateParam])) ? $dateParam : null;
$selectedInstances = $selectedDate ? $byDate[$selectedDate] : [];

$meetingName = $tour['meetingPoint']['name']     ?? '';
$meetingAddr = $tour['meetingPoint']['address']  ?? '';
$endName     = $tour['endPoint']['name']         ?? '';
$endAddr     = $tour['endPoint']['address']      ?? '';
?>

<?php if (!$selectedDate): ?>
<!-- ═════════════════════════════════════════════════════
     STAGE A — Calendar view
     ═════════════════════════════════════════════════════ -->

<!-- ─── Calendar ─── -->
<?php
// Build month data for Alpine (only months that contain at least one valid future-day cell)
$monthsToShow = 4;
$monthStart   = new DateTime('first day of this month');
$todayStr     = (new DateTime('today'))->format('Y-m-d');
$monthsData   = [];

for ($m = 0; $m < $monthsToShow; $m++) {
  $year        = (int)$monthStart->format('Y');
  $monthNum    = (int)$monthStart->format('n');
  $firstDayDow = (int)$monthStart->format('w');
  $daysInMonth = (int)$monthStart->format('t');

  $cells = [];
  for ($i = 0; $i < $firstDayDow; $i++) $cells[] = ['empty' => true];

  for ($day = 1; $day <= $daysInMonth; $day++) {
    $dateStr   = sprintf('%04d-%02d-%02d', $year, $monthNum, $day);
    $dayInsts  = $byDate[$dateStr] ?? [];
    $isPast    = $dateStr < $todayStr;
    $isToday   = $dateStr === $todayStr;

    $totalSpots = 0; $allSold = !empty($dayInsts);
    foreach ($dayInsts as $i) {
      $totalSpots += max(0, (int)$i['spotsRemaining']);
      if ($i['spotsRemaining'] > 0) $allSold = false;
    }

    if      ($isPast)             $state = 'past';
    elseif  (empty($dayInsts))    $state = 'unavailable';
    elseif  ($allSold)            $state = 'soldout';
    elseif  ($totalSpots <= 4)    $state = 'low';
    else                          $state = 'available';

    // Pre-format details for the list view (Alpine-rendered below)
    $slotList = [];
    foreach ($dayInsts as $i) {
      $slotList[] = [
        'id'      => $i['id'],
        'time'    => date('g:iA', strtotime($i['dateTime'])),
        'spots'   => (int)$i['spotsRemaining'],
        'soldOut' => $i['spotsRemaining'] <= 0,
      ];
    }
    $dtObj = new DateTime($dateStr);

    $cells[] = [
      'empty'       => false,
      'day'         => $day,
      'date'        => $dateStr,
      'state'       => $state,
      'spots'       => $totalSpots,
      'isToday'     => $isToday,
      'weekday'     => strtoupper($dtObj->format('D')),
      'weekdayFull' => $dtObj->format('l'),
      'monthShort'  => strtoupper($dtObj->format('M')),
      'monthFull'   => $dtObj->format('F'),
      'slots'       => $slotList,
    ];
  }

  $monthsData[] = [
    'label' => strtoupper($monthStart->format('F Y')),
    'cells' => $cells,
  ];
  $monthStart->modify('first day of next month');
}
?>

<section class="max-w-[1400px] mx-auto px-4 md:px-6 py-14 md:py-20"
         x-data='{
           monthIdx: 0,
           months: <?= json_encode($monthsData) ?>,
           tourHref: "?view=tour&tour=<?= urlencode($tourId) ?>&date=",
           get current() { return this.months[this.monthIdx] || null; },
           get hasPrev() { return this.monthIdx > 0; },
           get hasNext() { return this.monthIdx < this.months.length - 1; },
           get currentListRows() {
             if (!this.current) return [];
             return this.current.cells.filter(c => !c.empty && c.slots && c.slots.length > 0);
           },
           slotHref(date, slotId) { return this.tourHref + date + "&slot=" + slotId; },
           prev() { if (this.hasPrev) this.monthIdx--; },
           next() { if (this.hasNext) this.monthIdx++; }
         }'>

  <!-- ─── Editorial header (matches about / contact style) ─── -->
  <div class="relative mb-10 md:mb-20">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[260px] font-black text-black/[0.04] select-none leading-none pointer-events-none tracking-tight">BOOK</span>
    <div class="cc-sticker mb-5 md:mb-0 md:absolute md:top-0 md:right-12 rotate-[-4deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2">
      Let's Walk
    </div>
    <p class="relative text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-4">Pick Your Date</p>
    <h1 class="relative text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[0.9] text-neutral-900">When would you like<br class="hidden md:block">to go?</h1>
    <p class="relative mt-6 md:mt-8 text-neutral-600 text-base md:text-lg max-w-lg">
      Click a highlighted date to pick a time. Use the arrows to browse other months.
    </p>
  </div>

  <!-- ─── Calendar ─── -->
  <div x-cloak class="bg-neutral-50 border border-black/10 rounded-2xl p-3 md:p-10">

    <!-- Month header with prev/next -->
    <div class="flex items-center justify-between mb-6 md:mb-8">
      <button type="button" @click="prev()" :disabled="!hasPrev"
              :class="hasPrev ? 'bg-white border-black/10 text-neutral-900 hover:border-[#d12027] hover:text-[#d12027]' : 'bg-white border-black/5 text-neutral-300 cursor-not-allowed'"
              class="w-11 h-11 md:w-12 md:h-12 flex items-center justify-center rounded-full border-2 transition-colors"
              aria-label="Previous month">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
      </button>

      <h3 class="text-xl md:text-3xl font-extrabold text-neutral-900 tracking-tight" x-text="current?.label"></h3>

      <button type="button" @click="next()" :disabled="!hasNext"
              :class="hasNext ? 'bg-white border-black/10 text-neutral-900 hover:border-[#d12027] hover:text-[#d12027]' : 'bg-white border-black/5 text-neutral-300 cursor-not-allowed'"
              class="w-11 h-11 md:w-12 md:h-12 flex items-center justify-center rounded-full border-2 transition-colors"
              aria-label="Next month">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </button>
    </div>

    <!-- Day-of-week header -->
    <div class="grid grid-cols-7 gap-2 mb-2">
      <?php foreach (['S','M','T','W','T','F','S'] as $d): ?>
      <div class="text-center text-[10px] font-extrabold uppercase tracking-[0.2em] text-neutral-500 py-2"><?= $d ?></div>
      <?php endforeach; ?>
    </div>

    <!-- Day grid -->
    <div class="grid grid-cols-7 gap-2">
      <template x-for="(cell, idx) in (current?.cells || [])" :key="idx">
        <div>
          <!-- Empty leading cell -->
          <template x-if="cell.empty">
            <div class="aspect-[5/4]"></div>
          </template>

          <!-- Past day -->
          <template x-if="!cell.empty && cell.state === 'past'">
            <div class="aspect-[5/4] flex items-center justify-center text-neutral-300 text-sm font-extrabold" x-text="cell.day"></div>
          </template>

          <!-- No tour scheduled -->
          <template x-if="!cell.empty && cell.state === 'unavailable'">
            <div class="aspect-[5/4] flex items-center justify-center rounded-lg border border-dashed border-black/10 text-neutral-400 text-sm font-extrabold" x-text="cell.day"></div>
          </template>

          <!-- Sold out -->
          <template x-if="!cell.empty && cell.state === 'soldout'">
            <div class="aspect-[5/4] flex flex-col items-center justify-center rounded-lg bg-neutral-200 text-neutral-500 cursor-not-allowed">
              <span class="text-base md:text-lg font-extrabold line-through decoration-[1.5px]" x-text="cell.day"></span>
              <span class="hidden md:inline-block text-[8px] font-extrabold uppercase tracking-[0.14em] mt-0.5">Sold</span>
            </div>
          </template>

          <!-- Low availability -->
          <template x-if="!cell.empty && cell.state === 'low'">
            <a :href="tourHref + cell.date"
               :class="cell.isToday ? 'ring-2 ring-[#f9dda9] ring-offset-2 ring-offset-neutral-50' : ''"
               class="aspect-[5/4] flex flex-col items-center justify-center rounded-lg bg-white border-2 border-[#d12027] text-[#d12027] hover:bg-[#d12027] hover:text-white hover:border-[#2d1712] hover:shadow-[0_3px_0_0_#2d1712] transition-all">
              <span class="text-base md:text-xl font-extrabold leading-none" x-text="cell.day"></span>
              <span class="hidden md:inline-block text-[8px] font-extrabold uppercase tracking-[0.14em] mt-1" x-text="cell.spots + ' left'"></span>
            </a>
          </template>

          <!-- Available -->
          <template x-if="!cell.empty && cell.state === 'available'">
            <a :href="tourHref + cell.date"
               :class="cell.isToday ? 'ring-2 ring-[#f9dda9] ring-offset-2 ring-offset-neutral-50' : ''"
               class="aspect-[5/4] flex flex-col items-center justify-center rounded-lg bg-[#d12027] text-white border-2 border-[#2d1712] shadow-[0_3px_0_0_#2d1712] hover:-translate-y-0.5 hover:shadow-[0_5px_0_0_#2d1712] transition-all">
              <span class="text-base md:text-xl font-extrabold leading-none" x-text="cell.day"></span>
              <span class="hidden md:inline-block text-[8px] font-extrabold uppercase tracking-[0.14em] mt-1 opacity-85" x-text="cell.spots + ' open'"></span>
            </a>
          </template>
        </div>
      </template>
    </div>

    <!-- Legend -->
    <div class="flex flex-wrap items-center justify-center gap-4 md:gap-6 mt-8 pt-6 border-t border-black/10 text-[11px] font-extrabold uppercase tracking-[0.2em] text-neutral-700">
      <span class="inline-flex items-center gap-2">
        <span class="w-3 h-3 rounded bg-[#d12027]"></span>
        Available
      </span>
      <span class="inline-flex items-center gap-2">
        <span class="w-3 h-3 rounded border-2 border-[#d12027] bg-white"></span>
        Few Left
      </span>
      <span class="inline-flex items-center gap-2">
        <span class="w-3 h-3 rounded bg-neutral-300"></span>
        Sold Out
      </span>
      <span class="inline-flex items-center gap-2">
        <span class="w-3 h-3 rounded border border-dashed border-black/20 bg-transparent"></span>
        No Tour
      </span>
    </div>

  </div>

  <!-- ─── List for current month (Alpine — mirrors calendar's month) ─── -->
  <div x-cloak class="mt-12 md:mt-16">

    <div class="flex items-baseline justify-between mb-6">
      <h3 class="text-xl md:text-2xl font-extrabold text-neutral-900 tracking-tight">
        Dates in <span x-text="current?.label"></span>
      </h3>
      <p class="text-sm text-neutral-500">
        <span x-text="currentListRows.length"></span>
        date<span x-show="currentListRows.length !== 1">s</span> available
      </p>
    </div>

    <!-- Empty state -->
    <template x-if="currentListRows.length === 0">
      <div class="py-14 md:py-16 text-center text-neutral-500 text-sm border-t border-black/10">
        No scheduled dates this month. Use the arrows above to check another month.
      </div>
    </template>

    <!-- List rows -->
    <div class="divide-y divide-black/10">
      <template x-for="row in currentListRows" :key="row.date">
        <article class="py-5 md:py-7 grid grid-cols-1 md:grid-cols-[auto_1fr_auto] gap-5 md:gap-8 items-center">

            <!-- Date block (ticket-stub style) -->
            <div class="flex md:flex-col items-center md:justify-center gap-4 md:gap-0 bg-[#f9dda9] border-2 border-black rounded-xl w-full md:w-24 py-3 px-4 md:px-0 shrink-0 md:text-center" style="box-shadow: 3px 3px 0 #2d1712;">
              <span class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-900" x-text="row.weekday"></span>
              <span class="text-3xl md:text-4xl font-extrabold text-neutral-900 leading-none tracking-tight" x-text="row.day"></span>
              <span class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-900" x-text="row.monthShort"></span>
            </div>

            <!-- Info -->
            <div class="min-w-0">
              <h4 class="text-xl md:text-2xl font-extrabold text-neutral-900 tracking-tight leading-tight mb-1"
                  x-text="row.weekdayFull + ', ' + row.monthFull + ' ' + row.day"></h4>
              <p class="text-sm text-neutral-600">
                <span x-text="row.slots.length"></span> time<span x-show="row.slots.length !== 1">s</span> ·
                <template x-if="row.spots === 0">
                  <span class="text-neutral-500 font-semibold">Sold out</span>
                </template>
                <template x-if="row.spots > 0">
                  <span><span class="text-[#d12027] font-bold" x-text="row.spots"></span> spots available</span>
                </template>
              </p>
            </div>

            <!-- Time slot buttons -->
            <div class="flex flex-wrap gap-2 md:justify-end">
              <template x-for="slot in row.slots" :key="slot.id">
                <template x-if="true">
                  <div>
                    <template x-if="slot.soldOut">
                      <span class="inline-flex items-center justify-center px-4 py-2.5 bg-neutral-200 text-neutral-500 border-2 border-neutral-300 rounded-full text-[11px] font-extrabold uppercase tracking-[0.18em] line-through cursor-not-allowed" x-text="slot.time"></span>
                    </template>
                    <template x-if="!slot.soldOut">
                      <a :href="slotHref(row.date, slot.id)"
                         class="inline-flex items-center justify-center px-4 py-2.5 bg-[#d12027] text-white border-2 border-[#2d1712] rounded-full text-[11px] font-extrabold uppercase tracking-[0.18em] shadow-[0_3px_0_0_#2d1712] hover:-translate-y-0.5 hover:shadow-[0_5px_0_0_#2d1712] transition-all"
                         x-text="slot.time"></a>
                    </template>
                  </div>
                </template>
              </template>
            </div>

          </article>
      </template>
    </div>
  </div>

</section>

<?php else: ?>
<!-- ═════════════════════════════════════════════════════
     STAGE B — Date detail + booking
     ═════════════════════════════════════════════════════ -->
<?php
  $dt = new DateTime($selectedDate);
  $weekdayFull = $dt->format('l');
  $monthShort  = strtoupper($dt->format('M'));
  $dayNum      = $dt->format('j');
  $yearNum     = $dt->format('Y');

  // Build JS-friendly slot list for this date
  $slotsData = [];
  $preselectedSlot = '';
  foreach ($selectedInstances as $inst) {
    $slotsData[] = [
      'id'      => $inst['id'],
      'time'    => date('g:iA', strtotime($inst['dateTime'])),
      'spots'   => (int)$inst['spotsRemaining'],
      'soldOut' => $inst['spotsRemaining'] <= 0,
    ];
    if ($slotParam !== '' && $inst['id'] === $slotParam && $inst['spotsRemaining'] > 0) {
      $preselectedSlot = $inst['id'];
    }
  }
?>

<!-- ─── Editorial header (date) ─── -->
<section class="max-w-[1400px] mx-auto px-4 md:px-6 pt-6 md:pt-10 pb-0">

  <a href="?view=tour&tour=<?= urlencode($tourId) ?>" class="inline-flex items-center gap-2 text-neutral-500 hover:text-[#d12027] text-[11px] font-extrabold uppercase tracking-[0.25em] mb-8 transition-colors">
    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    Pick A Different Date
  </a>

  <div class="relative mb-4 md:mb-12">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[260px] font-black text-black/[0.04] select-none leading-none pointer-events-none tracking-tight"><?= $monthShort ?></span>
    <div class="cc-sticker mb-5 md:mb-0 md:absolute md:top-0 md:right-12 rotate-[-3deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2">
      You're Booking For
    </div>
    <p class="relative text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-4"><?= strtoupper($weekdayFull) ?></p>
    <h1 class="relative text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[0.9] text-neutral-900">
      <?= $monthShort ?> <?= $dayNum ?><span class="text-[#d12027]">.</span>
    </h1>
    <p class="relative mt-6 md:mt-8 text-neutral-700 text-lg md:text-xl max-w-2xl leading-relaxed">
      I Love Comedy Tour · Greenwich Village · <?= $yearNum ?>
    </p>
  </div>
</section>

<!-- ─── Why + Included + Booking ─── -->
<section class="max-w-[1400px] mx-auto px-4 md:px-6 py-8 md:py-12"
         x-data='{
           selectedInstanceId: <?= $preselectedSlot !== '' ? json_encode($preselectedSlot) : 'null' ?>,
           guests: 1,
           pricePerGuest: <?= $totalPerGuest ?>,
           slots: <?= json_encode($slotsData) ?>,

           get selectedSlot() { return this.slots.find(s => s.id === this.selectedInstanceId) || null; },
           get subtotal()     { return this.guests * this.pricePerGuest; },
           get maxGuests()    { return Math.min(10, this.selectedSlot?.spots ?? 10); },
           get canContinue()  { return !!this.selectedInstanceId && this.guests >= 1 && !(this.selectedSlot?.soldOut); },
           get continueUrl()  {
             if (!this.canContinue) return "#";
             return "?view=addons&show=" + encodeURIComponent(this.selectedInstanceId) + "&tickets=g:" + this.guests + ",p:0,v:0";
           },
           pickTime(id) {
             this.selectedInstanceId = id;
             if (this.guests > this.maxGuests) this.guests = this.maxGuests;
           },
           fmt(v) { return "$" + v.toFixed(2); }
         }'>

  <div class="grid md:grid-cols-12 gap-8 md:gap-16 items-start">

    <!-- ─── LEFT: Why + Included + Meeting ─── -->
    <div class="md:col-span-7 order-2 md:order-1">

      <!-- Why / Included side-by-side -->
      <div class="grid md:grid-cols-2 gap-8 md:gap-12 mb-10 md:mb-14">

        <!-- Why This Tour -->
        <div>
          <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">
            Why This Tour:
          </h2>
          <ul class="space-y-4 mb-5">
            <?php foreach (($tour['whyThisTour'] ?? []) as $item):
              $hl   = $item['headline'] ?? '';
              $body = $item['body'] ?? '';
            ?>
            <li class="flex items-start gap-3">
              <span aria-hidden="true" class="w-2.5 h-2.5 bg-[#d12027] mt-2 flex-shrink-0"></span>
              <p class="text-base md:text-lg text-neutral-800 leading-relaxed">
                <strong class="text-neutral-900"><?= htmlspecialchars($hl) ?></strong><?= $body !== '' ? ' ' . htmlspecialchars($body) : '' ?>
              </p>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php if (!empty($tour['whyThisTourFooter'])): ?>
          <p class="text-base md:text-lg text-neutral-800 leading-relaxed"><?= htmlspecialchars($tour['whyThisTourFooter']) ?></p>
          <?php endif; ?>
        </div>

        <!-- What's Included -->
        <div>
          <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">
            What's Included:
          </h2>
          <p class="text-base md:text-lg text-neutral-800 mb-5">Each ticket includes:</p>
          <ul class="space-y-4">
            <?php foreach (($tour['whatsIncluded'] ?? []) as $item):
              $lbl  = $item['label'] ?? '';
              $body = $item['body'] ?? '';
            ?>
            <li class="flex items-start gap-3">
              <span aria-hidden="true" class="w-2.5 h-2.5 bg-[#d12027] mt-2 flex-shrink-0"></span>
              <p class="text-base md:text-lg text-neutral-800 leading-relaxed">
                <strong class="text-neutral-900"><?= htmlspecialchars($lbl) ?></strong><?= $body !== '' ? ' ' . htmlspecialchars($body) : '' ?>
              </p>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <!-- Meeting + End Point -->
      <div class="pt-10 border-t border-black/10 grid sm:grid-cols-2 gap-8">
        <div>
          <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">Starts</p>
          <h3 class="text-lg md:text-xl font-extrabold text-neutral-900 mb-1 leading-tight"><?= htmlspecialchars($meetingName) ?></h3>
          <p class="text-sm text-neutral-600 leading-relaxed"><?= htmlspecialchars($meetingAddr) ?></p>
        </div>
        <div>
          <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">Ends At</p>
          <h3 class="text-lg md:text-xl font-extrabold text-neutral-900 mb-1 leading-tight"><?= htmlspecialchars($endName) ?></h3>
          <p class="text-sm text-neutral-600 leading-relaxed"><?= htmlspecialchars($endAddr) ?></p>
        </div>
      </div>

      <!-- Good to know -->
      <div class="pt-10 mt-10 border-t border-black/10">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">Good To Know</p>
        <ul class="space-y-3 text-sm">
          <li class="flex items-start gap-3">
            <i data-lucide="clock" class="w-4 h-4 text-[#d12027] mt-0.5 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed"><strong class="text-neutral-900">Arrive 10 min early</strong> at the meeting point. We roll out on time.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="umbrella" class="w-4 h-4 text-[#d12027] mt-0.5 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed"><strong class="text-neutral-900">Rain or shine.</strong> Dress for the weather.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="alert-triangle" class="w-4 h-4 text-[#d12027] mt-0.5 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed">The comedy club is a separate business — <strong class="text-neutral-900">line-ups may change.</strong></p>
          </li>
        </ul>
      </div>
    </div>

    <!-- ─── RIGHT: Booking panel ─── -->
    <aside class="md:col-span-5 order-1 md:order-2">
      <div class="md:sticky md:top-32 bg-neutral-50 border border-black/10 rounded-xl overflow-hidden">

        <!-- Date banner -->
        <div class="bg-[#f9dda9] text-black px-6 py-3 flex items-center justify-between border-b-2 border-black">
          <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase"><?= strtoupper($weekdayFull) ?></span>
          <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase"><?= $monthShort ?> <?= $dayNum ?>, <?= $yearNum ?></span>
        </div>

        <!-- Price header -->
        <div class="p-6 md:p-7 border-b border-black/10">
          <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-2">Book Your Spot</p>
          <div class="flex items-baseline gap-2">
            <span class="text-4xl md:text-5xl font-extrabold text-neutral-900 tracking-tight">$<?= number_format($totalPerGuest, 0) ?></span>
            <span class="text-sm text-neutral-500 font-medium">/ guest</span>
          </div>
          <p class="text-xs text-neutral-500 mt-1.5">$<?= number_format($basePrice, 2) ?> + <?= $feeRatePct ?>% service fee</p>
        </div>

        <!-- Step 2 — Time -->
        <div class="p-6 md:p-7 border-b border-black/10">
          <div class="flex items-center gap-2 mb-4">
            <span class="w-5 h-5 rounded-full bg-[#d12027] text-white text-[10px] font-extrabold flex items-center justify-center">2</span>
            <h4 class="text-[11px] font-extrabold uppercase tracking-[0.3em] text-neutral-900">Pick a Time</h4>
          </div>
          <div class="grid grid-cols-3 gap-2">
            <template x-for="slot in slots" :key="slot.id">
              <button type="button" @click="pickTime(slot.id)" :disabled="slot.soldOut"
                      :class="slot.soldOut
                        ? 'opacity-40 cursor-not-allowed bg-white border-black/10 text-neutral-900'
                        : (selectedInstanceId === slot.id
                            ? 'bg-[#d12027] text-white border-[#2d1712] shadow-[0_3px_0_0_#2d1712]'
                            : 'bg-white text-neutral-900 border-black/10 hover:border-[#d12027]/40')"
                      class="flex flex-col items-center justify-center py-3 rounded-xl border-2 transition-all">
                <span class="text-sm font-extrabold" x-text="slot.time"></span>
                <span class="text-[9px] font-extrabold uppercase tracking-[0.2em] mt-0.5 opacity-80"
                      x-text="slot.soldOut ? 'Sold Out' : (slot.spots + ' left')"></span>
              </button>
            </template>
          </div>
        </div>

        <!-- Step 3 — Guests -->
        <div class="p-6 md:p-7 border-b border-black/10" x-show="selectedSlot" x-transition>
          <div class="flex items-center gap-2 mb-4">
            <span class="w-5 h-5 rounded-full bg-[#d12027] text-white text-[10px] font-extrabold flex items-center justify-center">3</span>
            <h4 class="text-[11px] font-extrabold uppercase tracking-[0.3em] text-neutral-900">How Many Guests?</h4>
          </div>
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-neutral-900 font-semibold">Guests</p>
              <p class="text-xs text-neutral-500">Max <span x-text="maxGuests"></span> per booking</p>
            </div>
            <div class="flex items-center gap-1 bg-black/5 border border-black/10 rounded-[10px] p-1">
              <button type="button" @click="guests = Math.max(1, guests - 1)"
                      :class="guests <= 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-black/10'"
                      class="w-9 h-9 flex items-center justify-center text-neutral-900 rounded-[6px] transition-colors text-lg" aria-label="Decrease">−</button>
              <span class="w-10 text-center text-neutral-900 font-extrabold" x-text="guests"></span>
              <button type="button" @click="guests = Math.min(maxGuests, guests + 1)"
                      :class="guests >= maxGuests ? 'opacity-30 cursor-not-allowed' : 'hover:bg-black/10'"
                      class="w-9 h-9 flex items-center justify-center text-neutral-900 rounded-[6px] transition-colors text-lg" aria-label="Increase">+</button>
            </div>
          </div>
        </div>

        <!-- Summary + CTA -->
        <div class="p-6 md:p-7">
          <div class="flex items-baseline justify-between mb-5">
            <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027]">Subtotal</span>
            <span class="text-2xl font-extrabold text-neutral-900 tracking-tight" x-text="fmt(subtotal)"></span>
          </div>
          <a :href="continueUrl"
             :class="canContinue ? '' : 'is-disabled'"
             class="cc-btn-primary w-full text-sm tracking-[0.24em] px-6 py-4">
            Continue
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
          <p class="text-[11px] text-neutral-500 text-center mt-3">Add-ons and payment in the next step.</p>
        </div>
      </div>
    </aside>

  </div>
</section>

<?php endif; ?>
