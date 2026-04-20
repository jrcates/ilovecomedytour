<?php
$showId = isset($_GET['show']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['show']) : '';
$show = null;
foreach ($shows as $s) {
  if ($s['id'] === $showId) { $show = $s; break; }
}

if (!$show):
?>
<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <h1 class="text-4xl font-extrabold text-white mb-4 tracking-tight">Show Not Found</h1>
  <a href="?view=calendar" class="cc-btn-primary text-sm tracking-[0.14em] px-8 py-3">View Tour Dates</a>
</div>
<?php return; endif;

$d         = formatShowDate($show['date']);
$cityState = parseCityState($show['location']);
$venue     = parseVenue($show['location']);
$basePrice = (float)$show['priceValue'];

// Each tier: base price + 10% service fee displayed upfront (legal pricing)
$feeRate = 0.10;
$tiers = [
  [
    'key'     => 'general',
    'label'   => 'General Admission',
    'desc'    => 'Standard seating',
    'base'    => $basePrice,
    'min'     => 1,  // at least 1 GA required
    'default' => 1,
  ],
  [
    'key'     => 'premium',
    'label'   => 'Front Row Seats',
    'desc'    => 'Guaranteed front row seating',
    'base'    => round($basePrice + 20),
    'min'     => 0,
    'default' => 0,
  ],
  [
    'key'     => 'vip',
    'label'   => 'Gold Front Row VIP',
    'desc'    => 'VIP front row with priority check-in',
    'base'    => round($basePrice + 30),
    'min'     => 0,
    'default' => 0,
  ],
];
foreach ($tiers as &$tier) {
  $tier['fee']   = round($tier['base'] * $feeRate, 2);
  $tier['total'] = round($tier['base'] + $tier['fee'], 2);
}
unset($tier);

// Prev / Next show — navigate by unique venue in chronological order
$uniqueStops   = [];
$seenLocations = [];
foreach ($shows as $s) {
  if (!in_array($s['location'], $seenLocations)) {
    $seenLocations[] = $s['location'];
    $uniqueStops[]   = $s;
  }
}
$currentStopIdx = -1;
foreach ($uniqueStops as $i => $v) {
  if ($v['location'] === $show['location']) { $currentStopIdx = $i; break; }
}
$prevShow = $currentStopIdx > 0 ? $uniqueStops[$currentStopIdx - 1] : null;
$nextShow = ($currentStopIdx !== -1 && $currentStopIdx < count($uniqueStops) - 1) ? $uniqueStops[$currentStopIdx + 1] : null;
?>

<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen"
     x-data="{
        tickets: { general: 1, premium: 0, vip: 0 },
        prices: { general: <?= $tiers[0]['total'] ?>, premium: <?= $tiers[1]['total'] ?>, vip: <?= $tiers[2]['total'] ?> },
        increment(tier) {
          if (this.tickets[tier] >= 10) return;
          // Only one tier active at a time — reset others to 0
          Object.keys(this.tickets).forEach(k => { if (k !== tier) this.tickets[k] = 0; });
          this.tickets[tier]++;
        },
        decrement(tier) {
          // Don't let the active tier go below 1; inactive tiers stay at 0
          if (this.tickets[tier] > 1) this.tickets[tier]--;
        },
        get totalQty() { return this.tickets.general + this.tickets.premium + this.tickets.vip; },
        get grand()    { return this.tickets.general*this.prices.general + this.tickets.premium*this.prices.premium + this.tickets.vip*this.prices.vip; },
        get continueUrl() {
          return '?view=addons&show=<?= urlencode($showId) ?>&tickets=g:' + this.tickets.general + ',p:' + this.tickets.premium + ',v:' + this.tickets.vip;
        }
     }">

  <!-- ─── Breadcrumb ─── -->
  <div class="flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-[0.3em] mb-6">
    <a href="?view=calendar" class="text-neutral-500 hover:text-[#f9dda9] transition-colors">Tour Dates</a>
    <span class="text-white/20">/</span>
    <span class="text-[#f9dda9]">Step 01 · Tickets</span>
    <span class="text-white/20">/</span>
    <span class="text-neutral-500">Add-ons</span>
    <span class="text-white/20">/</span>
    <span class="text-neutral-500">Checkout</span>
  </div>

  <!-- ─── Header ─── -->
  <div class="relative mb-8 md:mb-16">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[260px] font-black text-white/[0.04] select-none leading-none pointer-events-none tracking-tight">01</span>
    <div class="inline-flex mb-5 md:mb-0 md:absolute md:top-0 md:right-12 -rotate-[4deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2 border-2 border-black" style="box-shadow: 4px 4px 0 #000;">
      Grab It Now
    </div>
    <h1 class="relative text-5xl md:text-7xl font-extrabold tracking-tight leading-[0.9]">Pick Your Seats.</h1>
  </div>

  <div class="grid md:grid-cols-12 gap-6 md:gap-12 items-start">

    <!-- ─── Top show info (meta + city/venue) ─── -->
    <div class="md:col-span-7 md:order-1 order-1 space-y-8">

      <!-- Meta pills -->
      <div class="flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center h-7 px-3 bg-white/10 border border-white/15 text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]"><?= $d['weekday'] ?>, <?= $d['month'] ?> <?= $d['day'] ?><?= ordinalSuffix((int)$d['day']) ?></span>
        <span class="inline-flex items-center h-7 px-3 bg-[#f9dda9] border border-[#f9dda9] text-black text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]"><?= $d['time'] ?></span>
      </div>

      <!-- City / venue -->
      <div>
        <h2 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-[1.05] mb-2"><?= htmlspecialchars($cityState) ?></h2>
        <div class="text-2xl md:text-3xl font-extrabold text-[#f9dda9] tracking-tight mb-3"><?= htmlspecialchars($venue) ?></div>
        <p class="text-sm text-neutral-400"><?= htmlspecialchars($show['location']) ?></p>
      </div>
    </div>

    <!-- ─── Ticket selector (mobile: middle / desktop: right, spans rows) ─── -->
    <aside class="md:col-span-5 md:row-span-2 order-2 md:order-2">
      <div class="md:sticky md:top-44 bg-[#1e1e1e] border border-white/10 rounded-xl p-6 md:p-8">

        <h3 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight mb-6">Purchase Tickets</h3>

        <div class="space-y-4 mb-6">
          <?php foreach ($tiers as $tier):
            $key = $tier['key'];
          ?>
          <div
            class="rounded-xl p-5 border-2 transition-colors"
            :class="tickets.<?= $key ?> > 0 ? 'border-[#d12027] bg-[#d12027]/[0.06]' : 'border-white/10 hover:border-white/20'">
            <!-- Title + total price -->
            <div class="flex items-start justify-between gap-3 mb-2">
              <h4 class="text-base md:text-xl font-extrabold text-white tracking-tight leading-tight"><?= htmlspecialchars($tier['label']) ?></h4>
              <span class="text-base md:text-xl font-extrabold text-white tracking-tight leading-none whitespace-nowrap">$<?= number_format($tier['total'], 2) ?></span>
            </div>
            <!-- Info + stepper row (side-by-side on all screens) -->
            <div class="flex items-center justify-between gap-4">
              <div class="flex-1 min-w-0">
                <p class="text-sm text-neutral-500 leading-snug">$<?= number_format($tier['base'], 2) ?> + $<?= number_format($tier['fee'], 2) ?> Service Fee</p>
                <p class="text-sm text-neutral-400 leading-snug"><?= htmlspecialchars($tier['desc']) ?></p>
              </div>
              <div class="shrink-0">
                <div class="flex items-center gap-1 bg-black/40 border border-white/10 rounded-[10px] p-1">
                  <button type="button" @click="decrement('<?= $key ?>')" :class="tickets.<?= $key ?> <= 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-white/10'" class="w-9 h-9 flex items-center justify-center text-white rounded-[6px] transition-colors" aria-label="Decrease">−</button>
                  <span class="w-9 text-center text-white font-extrabold" x-text="tickets.<?= $key ?>"></span>
                  <button type="button" @click="increment('<?= $key ?>')" :class="tickets.<?= $key ?> >= 10 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-white/10'" class="w-9 h-9 flex items-center justify-center text-white rounded-[6px] transition-colors" aria-label="Increase">+</button>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Total -->
        <div class="pt-5 border-t border-white/10 flex items-end justify-between mb-4">
          <span class="text-xl font-extrabold text-white">Total</span>
          <span class="text-2xl md:text-3xl font-extrabold text-white tracking-tight" x-text="'$' + grand.toFixed(2)"></span>
        </div>

        <p class="text-[11px] text-neutral-500 italic mb-5">* Promo codes can be added in the next step.</p>

        <a :href="continueUrl"
           :class="totalQty > 0 ? '' : 'is-disabled'"
           class="cc-btn-primary w-full text-sm tracking-[0.24em] px-6 py-4">
          Continue
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>

        <a href="?view=calendar" class="mt-4 block text-center w-full text-sm text-neutral-400 hover:text-[#f9dda9] transition-colors">← Back to Tour Dates</a>
      </div>
    </aside>

    <!-- ─── Bottom show info (about / lineup / restrictions) ─── -->
    <div class="md:col-span-7 md:order-3 order-3 space-y-8">

      <?php if (!empty($show['description'])): ?>
      <div class="pt-6 border-t border-white/10">
        <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-3">About The Show</p>
        <p class="text-base md:text-lg text-white/85 leading-relaxed"><?= htmlspecialchars($show['description']) ?></p>
      </div>
      <?php endif; ?>

      <?php if (!empty($show['lineup'])): ?>
      <div class="pt-6 border-t border-white/10">
        <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-3">Line-up</p>
        <ul class="flex flex-wrap gap-2">
          <?php foreach ($show['lineup'] as $i => $act): ?>
          <li class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/5 border border-white/10 rounded-full text-sm text-white">
            <span class="text-[10px] text-[#f9dda9] font-extrabold"><?= str_pad((string)($i+1), 2, '0', STR_PAD_LEFT) ?></span>
            <?= htmlspecialchars($act) ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>

      <!-- Restrictions & Requirements -->
      <div class="pt-6 border-t border-white/10">
        <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-4">Restrictions &amp; Requirements</p>
        <ul class="space-y-3 text-sm">
          <li class="flex items-start gap-3">
            <i data-lucide="clock" class="w-4 h-4 text-[#f9dda9] mt-0.5 flex-shrink-0"></i>
            <p class="text-white/85 leading-relaxed"><strong class="text-white">Arrive 30 mins before showtime</strong> as seating is on a first-come basis.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="check-circle-2" class="w-4 h-4 text-[#f9dda9] mt-0.5 flex-shrink-0"></i>
            <p class="text-white/85 leading-relaxed">There is a <strong class="text-white">2-drink minimum</strong> for all shows.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="alert-triangle" class="w-4 h-4 text-[#f9dda9] mt-0.5 flex-shrink-0"></i>
            <p class="text-white/85 leading-relaxed"><strong class="text-white uppercase tracking-wider">Line-ups subject to change.</strong> Tickets are for a comedy show, not for any specific performer.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="check-circle-2" class="w-4 h-4 text-[#f9dda9] mt-0.5 flex-shrink-0"></i>
            <p class="text-white/85 leading-relaxed"><strong class="text-white">All ages welcome.</strong> Shows may contain adult content but there are no age restrictions for admission.</p>
          </li>
        </ul>
      </div>
    </div>

  </div>

  <!-- ─── Prev / Next Show ─── -->
  <?php if ($prevShow || $nextShow): ?>
  <nav class="mt-10 md:mt-20 pt-8 border-t border-white/10 grid grid-cols-1 md:grid-cols-2 gap-8">
    <?php if ($prevShow):
      $pDt = formatShowDate($prevShow['date']);
      $pCity = parseCityState($prevShow['location']);
      $pVenue = parseVenue($prevShow['location']);
    ?>
    <a href="?view=event&show=<?= urlencode($prevShow['id']) ?>" class="group block">
      <div class="flex items-center gap-2 text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-2">
        <svg class="w-3 h-3 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Previous
      </div>
      <p class="text-sm md:text-base font-bold text-white group-hover:text-[#f9dda9] transition-colors leading-snug">
        <?= htmlspecialchars($pCity) ?> <span class="text-neutral-500 font-normal">·</span> <?= htmlspecialchars($pVenue) ?>
      </p>
      <p class="text-xs text-neutral-500 mt-1"><?= $pDt['weekday'] ?>, <?= $pDt['month'] ?> <?= $pDt['day'] ?><?= ordinalSuffix((int)$pDt['day']) ?></p>
    </a>
    <?php else: ?>
    <div></div>
    <?php endif; ?>

    <?php if ($nextShow):
      $nDt = formatShowDate($nextShow['date']);
      $nCity = parseCityState($nextShow['location']);
      $nVenue = parseVenue($nextShow['location']);
    ?>
    <a href="?view=event&show=<?= urlencode($nextShow['id']) ?>" class="group block md:text-right">
      <div class="flex items-center md:justify-end gap-2 text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-2">
        Next
        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </div>
      <p class="text-sm md:text-base font-bold text-white group-hover:text-[#f9dda9] transition-colors leading-snug">
        <?= htmlspecialchars($nCity) ?> <span class="text-neutral-500 font-normal">·</span> <?= htmlspecialchars($nVenue) ?>
      </p>
      <p class="text-xs text-neutral-500 mt-1"><?= $nDt['weekday'] ?>, <?= $nDt['month'] ?> <?= $nDt['day'] ?><?= ordinalSuffix((int)$nDt['day']) ?></p>
    </a>
    <?php endif; ?>
  </nav>
  <?php endif; ?>

</div>

