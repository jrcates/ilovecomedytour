<?php
$showId = isset($_GET['show']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['show']) : '';
$ticketsParam = isset($_GET['tickets']) ? preg_replace('/[^a-z0-9:,]/', '', $_GET['tickets']) : '';

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

$tickets   = parseQtyParam($ticketsParam);
$basePrice = (float)$show['priceValue'];
$tierInfo = [
  'g' => ['label' => 'General Admission',  'price' => round($basePrice * 1.10, 2)],
  'p' => ['label' => 'Front Row Seats',    'price' => round(($basePrice + 20) * 1.10, 2)],
  'v' => ['label' => 'Gold Front Row VIP', 'price' => round(($basePrice + 30) * 1.10, 2)],
];

$ticketQty = 0; $ticketTotal = 0;
foreach ($tickets as $k => $qty) {
  if (isset($tierInfo[$k])) {
    $ticketQty   += $qty;
    $ticketTotal += $qty * $tierInfo[$k]['price'];
  }
}

// If no tickets selected, bounce back
if ($ticketQty === 0):
?>
<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <h1 class="text-4xl font-extrabold text-white mb-4 tracking-tight">Pick tickets first.</h1>
  <a href="?view=event&show=<?= urlencode($showId) ?>" class="cc-btn-primary text-sm tracking-[0.14em] px-8 py-3">Back to Tickets</a>
</div>
<?php return; endif;

$addonCatalog = [
  ['key' => 'ts', 'icon' => 'shirt',       'label' => 'Tour T-Shirt',         'desc' => 'Black tee, tour cities on the back.',           'price' => 35],
  ['key' => 'po', 'icon' => 'award',       'label' => 'Signed Poster',        'desc' => 'Numbered, signed, limited to 500.',             'price' => 45],
  ['key' => 'pk', 'icon' => 'parking-circle','label' => 'VIP Parking',        'desc' => 'Reserved spot, close to the venue.',            'price' => 20],
  ['key' => 'dk', 'icon' => 'glass-water', 'label' => 'Drink Voucher (x2)',   'desc' => 'Two drink tokens. Bar opens at 6.',             'price' => 30],
];

$d         = formatShowDate($show['date']);
$cityState = parseCityState($show['location']);
$venue     = parseVenue($show['location']);
?>

<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen"
     x-data='{
        addons: { ts: 0, po: 0, pk: 0, dk: 0 },
        prices: <?= json_encode(array_column($addonCatalog, "price", "key")) ?>,
        ticketTotal: <?= $ticketTotal ?>,
        get addonsTotal() { return this.addons.ts*this.prices.ts + this.addons.po*this.prices.po + this.addons.pk*this.prices.pk + this.addons.dk*this.prices.dk; },
        get addonsQty() { return this.addons.ts + this.addons.po + this.addons.pk + this.addons.dk; },
        get grand() { return this.ticketTotal + this.addonsTotal; },
        get continueUrl() {
          return "?view=checkout&show=<?= urlencode($showId) ?>&tickets=<?= urlencode($ticketsParam) ?>&addons=ts:" + this.addons.ts + ",po:" + this.addons.po + ",pk:" + this.addons.pk + ",dk:" + this.addons.dk;
        },
        get skipUrl() {
          return "?view=checkout&show=<?= urlencode($showId) ?>&tickets=<?= urlencode($ticketsParam) ?>";
        }
     }'>

  <!-- Breadcrumb -->
  <div class="flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-[0.3em] mb-6">
    <a href="?view=calendar" class="text-neutral-500 hover:text-[#f9dda9] transition-colors">Tour Dates</a>
    <span class="text-white/20">/</span>
    <a href="?view=event&show=<?= urlencode($showId) ?>" class="text-neutral-500 hover:text-[#f9dda9] transition-colors">Tickets</a>
    <span class="text-white/20">/</span>
    <span class="text-[#f9dda9]">Step 02 · Add-ons</span>
    <span class="text-white/20">/</span>
    <span class="text-neutral-500">Checkout</span>
  </div>

  <!-- ─── Header ─── -->
  <div class="relative mb-8 md:mb-16">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[260px] font-black text-white/[0.04] select-none leading-none pointer-events-none tracking-tight">02</span>
    <div class="inline-flex mb-5 md:mb-0 md:absolute md:top-0 md:right-12 rotate-[4deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2 border-2 border-black" style="box-shadow: 4px 4px 0 #000;">
      Optional
    </div>
    <h1 class="relative text-5xl md:text-7xl font-extrabold tracking-tight leading-[0.9]">Round It Out.</h1>
    <p class="relative mt-6 text-neutral-400 text-base max-w-lg">
      Make the night even better. These are optional — skip if you're just here for the comedy.
    </p>
  </div>

  <div class="grid md:grid-cols-12 gap-6 md:gap-12 items-start">

    <!-- ─── Add-ons grid ─── -->
    <div class="md:col-span-7">
      <div class="grid sm:grid-cols-2 gap-4">
        <?php foreach ($addonCatalog as $addon):
          $k = $addon['key'];
        ?>
        <div class="group relative bg-[#1e1e1e] border border-white/10 hover:border-[#f9dda9]/40 rounded-xl p-5 transition-colors"
             :class="addons.<?= $k ?> > 0 ? 'ring-2 ring-[#f9dda9]/40 border-[#f9dda9]/40' : ''">
          <div class="flex items-start gap-4 mb-4">
            <span class="shrink-0 w-11 h-11 flex items-center justify-center rounded-lg bg-[#f9dda9]/10 border border-[#f9dda9]/20 text-[#f9dda9]">
              <i data-lucide="<?= $addon['icon'] ?>" class="w-5 h-5"></i>
            </span>
            <div class="flex-1 min-w-0">
              <div class="flex items-baseline gap-2 mb-1">
                <h3 class="text-base font-extrabold text-white"><?= htmlspecialchars($addon['label']) ?></h3>
                <span class="text-[#f9dda9] font-extrabold text-sm">+$<?= number_format($addon['price'], 0) ?></span>
              </div>
              <p class="text-xs text-neutral-400 leading-snug"><?= $addon['desc'] ?></p>
            </div>
          </div>
          <div class="flex items-center justify-between gap-3">
            <span class="text-[10px] font-extrabold tracking-[0.24em] uppercase text-neutral-500">Quantity</span>
            <div class="flex items-center gap-1 bg-black/40 border border-white/10 rounded-[10px] p-1">
              <button type="button" @click="addons.<?= $k ?> = Math.max(0, addons.<?= $k ?> - 1)" class="w-8 h-8 flex items-center justify-center text-white hover:bg-white/10 rounded-[6px] transition-colors" aria-label="Decrease">−</button>
              <span class="w-8 text-center text-white font-extrabold text-sm" x-text="addons.<?= $k ?>"></span>
              <button type="button" @click="addons.<?= $k ?> = Math.min(10, addons.<?= $k ?> + 1)" class="w-8 h-8 flex items-center justify-center text-white hover:bg-white/10 rounded-[6px] transition-colors" aria-label="Increase">+</button>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- ─── Summary ─── -->
    <aside class="md:col-span-5">
      <div class="md:sticky md:top-44 bg-[#1e1e1e] border border-white/10 rounded-xl overflow-hidden">

        <!-- Show summary -->
        <div class="p-5 md:p-8 border-b border-dashed border-white/15">
          <div class="flex flex-wrap items-center gap-2 mb-4">
            <span class="inline-flex items-center h-7 px-3 bg-white/10 border border-white/15 text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]"><?= $d['weekday'] ?>, <?= $d['month'] ?> <?= $d['day'] ?><?= ordinalSuffix((int)$d['day']) ?></span>
            <span class="inline-flex items-center h-7 px-3 bg-[#f9dda9] border border-[#f9dda9] text-black text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]"><?= $d['time'] ?></span>
          </div>
          <h2 class="text-xl md:text-2xl font-extrabold tracking-tight leading-[1.1] text-white mb-1"><?= htmlspecialchars($cityState) ?></h2>
          <div class="text-base font-extrabold text-[#f9dda9] tracking-tight"><?= htmlspecialchars($venue) ?></div>
        </div>

        <!-- Tickets breakdown -->
        <div class="p-5 md:p-8 border-b border-white/10">
          <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-4">Your Tickets</p>
          <div class="space-y-2">
            <?php foreach ($tickets as $k => $qty):
              if (!isset($tierInfo[$k]) || $qty <= 0) continue;
            ?>
            <div class="flex items-center justify-between text-sm">
              <span class="text-neutral-400"><?= $qty ?> × <?= htmlspecialchars($tierInfo[$k]['label']) ?></span>
              <span class="text-white font-bold">$<?= number_format($qty * $tierInfo[$k]['price'], 0) ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Total -->
        <div class="p-6 md:p-8">
          <div class="space-y-2 mb-4">
            <div class="flex items-center justify-between text-sm">
              <span class="text-neutral-400">Tickets subtotal</span>
              <span class="text-white font-bold">$<?= number_format($ticketTotal, 0) ?></span>
            </div>
            <div class="flex items-center justify-between text-sm">
              <span class="text-neutral-400"><span x-text="addonsQty"></span> add-on<span x-show="addonsQty !== 1">s</span></span>
              <span class="text-white font-bold" x-text="'$' + addonsTotal.toFixed(0)"></span>
            </div>
          </div>
          <div class="h-px bg-white/10 mb-4"></div>
          <div class="flex items-end justify-between mb-6">
            <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9]">Running Total</span>
            <span class="text-3xl font-extrabold text-white tracking-tight" x-text="'$' + grand.toFixed(0)"></span>
          </div>

          <a :href="continueUrl" class="cc-btn-primary w-full text-sm tracking-[0.24em] px-6 py-4">
            Continue To Checkout
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>

          <a href="?view=event&show=<?= urlencode($showId) ?>" class="mt-4 block text-center w-full text-sm text-neutral-400 hover:text-[#f9dda9] transition-colors">← Back to Tickets</a>
        </div>
      </div>
    </aside>

  </div>
</div>
