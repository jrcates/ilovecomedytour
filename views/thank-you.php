<?php
$showId       = isset($_GET['show'])    ? preg_replace('/[^a-z0-9\-]/', '', $_GET['show'])    : '';
$ticketsParam = isset($_GET['tickets']) ? preg_replace('/[^a-z0-9:,]/', '', $_GET['tickets']) : '';
$addonsParam  = isset($_GET['addons'])  ? preg_replace('/[^a-z0-9:,]/', '', $_GET['addons'])  : '';

$show = null;
foreach ($shows as $s) {
  if ($s['id'] === $showId) { $show = $s; break; }
}
if (!$show):
?>
<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <h1 class="text-4xl font-extrabold text-white mb-4 tracking-tight">Order Not Found</h1>
  <a href="?view=home" class="cc-btn-primary text-sm tracking-[0.14em] px-8 py-3">Back to Home</a>
</div>
<?php return; endif;

$basePrice = (float)$show['priceValue'];
$tierInfo = [
  'g' => ['label' => 'General Admission',  'price' => round($basePrice * 1.10, 2)],
  'p' => ['label' => 'Front Row Seats',    'price' => round(($basePrice + 20) * 1.10, 2)],
  'v' => ['label' => 'Gold Front Row VIP', 'price' => round(($basePrice + 30) * 1.10, 2)],
];
$addonInfo = [
  'ts' => ['label' => 'Tour T-Shirt',          'price' => 35],
  'po' => ['label' => 'Signed Poster',          'price' => 45],
  'pk' => ['label' => 'VIP Parking',            'price' => 20],
  'dk' => ['label' => 'Drink Voucher (x2)',     'price' => 30],
];

$tickets = parseQtyParam($ticketsParam);
$addons  = parseQtyParam($addonsParam);

$ticketTotal = 0; $ticketQty = 0;
foreach ($tickets as $k => $qty) {
  if (isset($tierInfo[$k])) { $ticketTotal += $qty * $tierInfo[$k]['price']; $ticketQty += $qty; }
}
$addonTotal = 0; $addonQty = 0;
foreach ($addons as $k => $qty) {
  if (isset($addonInfo[$k])) { $addonTotal += $qty * $addonInfo[$k]['price']; $addonQty += $qty; }
}

$promoCode = isset($_GET['promo']) ? trim(preg_replace('/[^A-Za-z0-9]/', '', $_GET['promo'])) : '';
$giftCode  = isset($_GET['gift'])  ? trim(preg_replace('/[^A-Za-z0-9]/', '', $_GET['gift']))  : '';
$promoApplied = $promoCode === '1111';
$giftApplied  = $giftCode === '2222';

// Service fee is baked into each ticket price; only sales tax is added.
$subtotal    = $ticketTotal + $addonTotal;
$promoDisc   = $promoApplied ? $subtotal * 0.10 : 0;
$taxable     = $subtotal - $promoDisc;
$salesTaxPct = 8.875;
$tax         = $taxable * ($salesTaxPct / 100);
$preGift     = $taxable + $tax;
$giftUse     = $giftApplied ? min(25, $preGift) : 0;
$total       = max(0, $preGift - $giftUse);
$fees        = $tax;

$orderId = 'RC' . date('ymd') . '-' . strtoupper(substr(md5($showId . $ticketsParam . $addonsParam . time()), 0, 6));

$dt        = new DateTime($show['date']);
$d         = formatShowDate($show['date']);
$cityState = parseCityState($show['location']);
$venue     = parseVenue($show['location']);

$startDt = clone $dt;
$endDt   = (clone $dt)->modify('+2 hours');
$gcalUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE'
         . '&text=' . urlencode('Ronny Chieng — ' . $venue)
         . '&dates=' . $startDt->format('Ymd\THis') . '/' . $endDt->format('Ymd\THis')
         . '&location=' . urlencode($show['location'])
         . '&details=' . urlencode('Your tickets have been confirmed. Order #' . $orderId);
?>

<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen">

  <!-- Breadcrumb -->
  <div class="flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-[0.3em] mb-6">
    <span class="text-neutral-500">Tickets</span>
    <span class="text-white/20">/</span>
    <span class="text-neutral-500">Add-ons</span>
    <span class="text-white/20">/</span>
    <span class="text-neutral-500">Checkout</span>
    <span class="text-white/20">/</span>
    <span class="text-[#f9dda9]">Done</span>
  </div>

  <!-- ─── Header ─── -->
  <div class="relative mb-8 md:mb-16">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[260px] font-black text-white/[0.04] select-none leading-none pointer-events-none tracking-tight">✓</span>
    <p class="relative text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-4">Order <?= $orderId ?> · Confirmed</p>
    <div class="inline-flex mb-5 md:mb-0 md:absolute md:top-0 md:right-12 -rotate-[4deg] bg-[#2fb03c] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2 border-2 border-black" style="box-shadow: 4px 4px 0 #000;">
      <span class="inline-flex items-center gap-2">
        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
        Tickets Sent
      </span>
    </div>
    <h1 class="relative text-5xl md:text-7xl font-extrabold tracking-tight leading-[0.9]">You're Going.</h1>
    <p class="relative mt-6 text-neutral-400 text-base md:text-lg max-w-xl">
      We've emailed <?= $ticketQty ?> ticket<?= $ticketQty > 1 ? 's' : '' ?> to you. Bring the confirmation (digital is fine) to the door.
    </p>
  </div>

  <div class="grid md:grid-cols-12 gap-5 md:gap-10 items-start">

    <!-- ─── Ticket stub ─── -->
    <div class="md:col-span-8">
      <article class="relative bg-[#1e1e1e] border border-white/10 rounded-xl overflow-hidden">

        <!-- Top band -->
        <div class="bg-[#f9dda9] text-black px-6 py-3 flex items-center justify-between border-b-2 border-black">
          <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase">Admit <?= $ticketQty ?></span>
          <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase">Order <?= $orderId ?></span>
        </div>

        <!-- When / Where -->
        <div class="p-5 md:p-10 grid md:grid-cols-3 gap-6 items-start">
          <div class="md:col-span-1">
            <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-3">When</p>
            <div class="text-5xl md:text-6xl font-extrabold text-white leading-none tracking-tight"><?= $d['day'] ?></div>
            <div class="mt-2 text-sm font-extrabold uppercase tracking-[0.18em] text-[#f9dda9]"><?= $d['month'] ?> <?= $d['year'] ?></div>
            <div class="mt-4 flex items-center gap-2 text-sm text-white font-bold">
              <svg class="w-3.5 h-3.5 text-[#f9dda9]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <?= $d['weekday'] ?> · <?= $d['time'] ?>
            </div>
          </div>

          <div class="md:col-span-2 md:border-l md:border-dashed md:border-white/15 md:pl-8">
            <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-3">Where</p>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-[1.05] mb-2"><?= htmlspecialchars($cityState) ?></h2>
            <div class="text-lg font-extrabold text-[#f9dda9] tracking-tight mb-4"><?= htmlspecialchars($venue) ?></div>
            <p class="text-sm text-neutral-400 leading-relaxed"><?= htmlspecialchars($show['location']) ?></p>
          </div>
        </div>

        <!-- Order breakdown -->
        <div class="border-t border-dashed border-white/15 px-6 md:px-10 py-6 space-y-4">

          <div>
            <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-3">Tickets</p>
            <div class="space-y-2">
              <?php foreach ($tickets as $k => $qty):
                if (!isset($tierInfo[$k]) || $qty <= 0) continue;
              ?>
              <div class="flex items-center justify-between text-sm">
                <span class="text-white"><?= $qty ?> × <?= htmlspecialchars($tierInfo[$k]['label']) ?></span>
                <span class="text-white font-bold">$<?= number_format($qty * $tierInfo[$k]['price'], 0) ?></span>
              </div>
              <?php endforeach; ?>
            </div>
          </div>

          <?php if ($addonQty > 0): ?>
          <div class="pt-3 border-t border-white/10">
            <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-3">Extras</p>
            <div class="space-y-2">
              <?php foreach ($addons as $k => $qty):
                if (!isset($addonInfo[$k]) || $qty <= 0) continue;
              ?>
              <div class="flex items-center justify-between text-sm">
                <span class="text-white"><?= $qty ?> × <?= htmlspecialchars($addonInfo[$k]['label']) ?></span>
                <span class="text-white font-bold">$<?= number_format($qty * $addonInfo[$k]['price'], 0) ?></span>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>

          <div class="pt-3 border-t border-white/10 space-y-1">
            <div class="flex items-center justify-between text-sm">
              <span class="text-neutral-400">Subtotal</span>
              <span class="text-white font-bold">$<?= number_format($subtotal, 2) ?></span>
            </div>
            <?php if ($promoApplied): ?>
            <div class="flex items-center justify-between text-sm">
              <span class="text-[#f9dda9] font-semibold">Promo (10% off)</span>
              <span class="text-[#f9dda9] font-bold">− $<?= number_format($promoDisc, 2) ?></span>
            </div>
            <?php endif; ?>
            <div class="flex items-center justify-between text-sm">
              <span class="text-neutral-400">Sales Tax</span>
              <span class="text-white font-bold">$<?= number_format($fees, 2) ?></span>
            </div>
            <?php if ($giftApplied): ?>
            <div class="flex items-center justify-between text-sm">
              <span class="text-[#f9dda9] font-semibold">Gift Certificate</span>
              <span class="text-[#f9dda9] font-bold">− $<?= number_format($giftUse, 2) ?></span>
            </div>
            <?php endif; ?>
          </div>

          <div class="pt-3 border-t border-white/10 flex items-end justify-between">
            <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9]">Total Charged</span>
            <span class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">$<?= number_format($total, 2) ?></span>
          </div>
        </div>

        <!-- Barcode -->
        <div class="bg-black/40 border-t border-white/10 px-6 md:px-10 py-4 flex items-center gap-4">
          <div class="flex gap-[2px]">
            <?php for ($i = 0; $i < 40; $i++): $h = [14, 20, 24, 18][($i * 3 + 1) % 4]; ?>
            <span class="block w-[2px] bg-white/80" style="height: <?= $h ?>px"></span>
            <?php endfor; ?>
          </div>
          <p class="text-[10px] font-extrabold tracking-[0.24em] uppercase text-white/60 font-mono"><?= $orderId ?></p>
        </div>

      </article>
    </div>

    <!-- Actions -->
    <aside class="md:col-span-4 space-y-3">
      <a href="<?= $gcalUrl ?>" target="_blank" rel="noopener" class="group flex items-center justify-between gap-3 p-5 bg-[#1e1e1e] border border-white/10 hover:border-[#f9dda9] rounded-xl transition-colors">
        <div class="flex items-center gap-3">
          <span class="w-10 h-10 rounded-lg bg-[#f9dda9] text-black flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          </span>
          <div>
            <p class="text-white font-extrabold text-sm">Save to Calendar</p>
            <p class="text-xs text-neutral-500">Don't miss it</p>
          </div>
        </div>
        <svg class="w-4 h-4 text-neutral-500 group-hover:text-[#f9dda9] group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>

      <button type="button"
              onclick="if (navigator.share) { navigator.share({ title: 'Ronny Chieng — <?= addslashes($venue) ?>', text: 'I\'m going to see Ronny Chieng live. Come with?', url: window.location.origin }); } else { navigator.clipboard.writeText(window.location.origin); this.querySelector('.share-label').textContent = 'Link Copied'; }"
              class="group w-full flex items-center justify-between gap-3 p-5 bg-[#1e1e1e] border border-white/10 hover:border-[#f9dda9] rounded-xl transition-colors text-left">
        <div class="flex items-center gap-3">
          <span class="w-10 h-10 rounded-lg bg-[#d12027] text-white flex items-center justify-center flex-shrink-0">
            <i data-lucide="share-2" class="w-5 h-5"></i>
          </span>
          <div>
            <p class="text-white font-extrabold text-sm share-label">Share With Friends</p>
            <p class="text-xs text-neutral-500">Make them jealous</p>
          </div>
        </div>
        <svg class="w-4 h-4 text-neutral-500 group-hover:text-[#f9dda9] group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </button>

      <div class="pt-4 border-t border-white/10 space-y-3 mt-6">
        <a href="?view=calendar" class="cc-btn-primary w-full text-sm tracking-[0.14em] px-6 py-3.5">See Other Dates</a>
        <a href="?view=home" class="block text-center text-sm text-neutral-400 hover:text-[#f9dda9] transition-colors">← Back to home</a>
      </div>
    </aside>

  </div>
</div>
