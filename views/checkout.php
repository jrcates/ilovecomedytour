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
  <h1 class="text-4xl font-extrabold text-neutral-900 mb-4 tracking-tight">Show Not Found</h1>
  <a href="?view=tour&tour=ilct-nyc" class="cc-btn-primary text-sm tracking-[0.14em] px-8 py-3">Back to Booking</a>
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

if ($ticketQty === 0):
?>
<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <h1 class="text-4xl font-extrabold text-neutral-900 mb-4 tracking-tight">Pick a date first.</h1>
  <a href="?view=tour&tour=ilct-nyc" class="cc-btn-primary text-sm tracking-[0.14em] px-8 py-3">Back to Booking</a>
</div>
<?php return; endif;

// Service fee is already baked into each ticket price (10%) per legal pricing.
// At checkout we only add sales tax on top.
$subtotal    = $ticketTotal + $addonTotal;
$salesTaxPct = 8.875;
$taxRate     = $salesTaxPct / 100;
$tax         = $subtotal * $taxRate;
$total       = $subtotal + $tax;

$dt        = new DateTime($show['date']);
$d         = formatShowDate($show['date']);
$cityState = parseCityState($show['location']);
$venue     = parseVenue($show['location']);
?>

<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen"
     x-data='{
        subtotal: <?= $subtotal ?>,
        taxRate: <?= $taxRate ?>,
        promoCode: "",
        promoApplied: false,
        promoMsg: "",
        promoMsgKind: "",
        giftCode: "",
        giftApplied: false,
        giftMsg: "",
        giftMsgKind: "",
        showPromo: false,
        useGift: false,
        mobileStep: 1,
        get discount()    { return this.promoApplied ? this.subtotal * 0.10 : 0; },
        get taxable()     { return this.subtotal - this.discount; },
        get tax()         { return this.taxable * this.taxRate; },
        get preGiftTotal(){ return this.taxable + this.tax; },
        get giftUse()     { return this.giftApplied ? Math.min(25, this.preGiftTotal) : 0; },
        get total()       { return Math.max(0, this.preGiftTotal - this.giftUse); },
        fmt(v) { return "$" + v.toFixed(2); },
        applyPromo() {
          if (this.promoCode.trim() === "1111") {
            this.promoApplied = true;
            this.promoMsg = "Promo applied — 10% off";
            this.promoMsgKind = "ok";
          } else {
            this.promoApplied = false;
            this.promoMsg = "That code is not valid";
            this.promoMsgKind = "err";
          }
        },
        applyGift() {
          if (this.giftCode.trim() === "2222") {
            this.giftApplied = true;
            this.giftMsg = "Gift certificate applied — $25 credit";
            this.giftMsgKind = "ok";
          } else {
            this.giftApplied = false;
            this.giftMsg = "That code is not valid";
            this.giftMsgKind = "err";
          }
        }
     }'
     x-init="
        $watch('showPromo', v => { if (!v) { promoApplied = false; promoCode = ''; promoMsg = ''; promoMsgKind = ''; } });
        $watch('useGift',   v => { if (!v) { giftApplied  = false; giftCode  = ''; giftMsg  = ''; giftMsgKind  = ''; } });
     ">

  <!-- Breadcrumb -->
  <div class="flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-[0.3em] mb-8">
    <a href="?view=tour&tour=ilct-nyc" class="text-neutral-500 hover:text-[#d12027] transition-colors">Book</a>
    <span class="text-black/20">/</span>
    <a href="?view=addons&show=<?= urlencode($showId) ?>&tickets=<?= urlencode($ticketsParam) ?>" class="text-neutral-500 hover:text-[#d12027] transition-colors">Add-ons</a>
    <span class="text-black/20">/</span>
    <span class="text-[#d12027]">Step 03 · Checkout</span>
  </div>

  <!-- ─── Header ─── -->
  <div class="relative mb-8 md:mb-16">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[260px] font-black text-black/[0.04] select-none leading-none pointer-events-none tracking-tight">03</span>
    <div class="cc-sticker mb-5 md:mb-0 md:absolute md:top-0 md:right-12 rotate-[4deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2">
      Secure &amp; Quick
    </div>
    <h1 class="relative text-5xl md:text-7xl font-extrabold tracking-tight leading-[0.9]">Checkout.</h1>
  </div>

  <form action="?view=thank-you" method="get" class="grid lg:grid-cols-2 gap-6 lg:gap-8">
    <input type="hidden" name="view"    value="thank-you" />
    <input type="hidden" name="show"    value="<?= htmlspecialchars($showId) ?>" />
    <input type="hidden" name="tickets" value="<?= htmlspecialchars($ticketsParam) ?>" />
    <input type="hidden" name="addons"  value="<?= htmlspecialchars($addonsParam) ?>" />

    <!-- ─── LEFT COLUMN ─── -->
    <div class="space-y-8" :class="{'hidden lg:block': mobileStep !== 1}">

      <!-- Event Details -->
      <div>
        <div class="flex flex-wrap items-center gap-2 mb-5">
          <span class="inline-flex items-center h-7 px-3 bg-black/5 border border-black/15 text-neutral-900 text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]"><?= $d['weekday'] ?>, <?= $d['month'] ?> <?= $d['day'] ?><?= ordinalSuffix((int)$d['day']) ?></span>
          <span class="inline-flex items-center h-7 px-3 bg-[#f9dda9] border border-[#f9dda9] text-black text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]"><?= $d['time'] ?></span>
        </div>

        <h2 class="text-3xl md:text-5xl font-extrabold text-neutral-900 tracking-tight leading-[1.05] mb-2"><?= htmlspecialchars($cityState) ?></h2>
        <div class="text-xl md:text-2xl font-extrabold text-[#d12027] tracking-tight mb-3"><?= htmlspecialchars($venue) ?></div>
        <?php if (!empty($show['description'])): ?>
        <p class="text-sm md:text-base text-neutral-600 leading-relaxed mb-3"><?= htmlspecialchars($show['description']) ?></p>
        <?php endif; ?>
        <p class="text-sm text-neutral-500"><?= htmlspecialchars($show['location']) ?></p>
      </div>

      <!-- Order Summary -->
      <div class="pt-6 border-t border-black/10">
        <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-5">Order Summary</p>

        <!-- Line items -->
        <div class="space-y-4 mb-5">
          <?php foreach ($tickets as $k => $qty):
            if (!isset($tierInfo[$k]) || $qty <= 0) continue;
            $line = $qty * $tierInfo[$k]['price'];
          ?>
          <div class="flex items-start justify-between gap-4">
            <div>
              <div class="text-neutral-900 font-extrabold"><?= htmlspecialchars($tierInfo[$k]['label']) ?></div>
              <div class="text-xs text-neutral-500 mt-0.5"><?= $qty ?> × $<?= number_format($tierInfo[$k]['price'], 2) ?></div>
            </div>
            <div class="text-neutral-900 font-extrabold">$<?= number_format($line, 2) ?></div>
          </div>
          <?php endforeach; ?>

          <?php foreach ($addons as $k => $qty):
            if (!isset($addonInfo[$k]) || $qty <= 0) continue;
            $line = $qty * $addonInfo[$k]['price'];
          ?>
          <div class="flex items-start justify-between gap-4">
            <div>
              <div class="text-neutral-900 font-extrabold"><?= htmlspecialchars($addonInfo[$k]['label']) ?></div>
              <div class="text-xs text-neutral-500 mt-0.5"><?= $qty ?> × $<?= number_format($addonInfo[$k]['price'], 2) ?></div>
            </div>
            <div class="text-neutral-900 font-extrabold">$<?= number_format($line, 2) ?></div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Tax / Discounts -->
        <div class="pt-4 border-t border-black/10 space-y-2 mb-4">
          <div x-show="promoApplied" class="flex justify-between text-sm">
            <span class="text-[#d12027] font-semibold">Promo (10% off)</span>
            <span class="text-[#d12027] font-bold" x-text="'− ' + fmt(discount)"></span>
          </div>
          <div class="flex justify-between text-sm">
            <span class="text-neutral-600">Sales Tax (<?= $salesTaxPct ?>%)</span>
            <span class="text-neutral-900" x-text="fmt(tax)"></span>
          </div>
          <p class="text-[10px] text-neutral-500 italic pt-1">Service fees are included in each ticket price.</p>
          <div x-show="giftApplied" class="flex justify-between text-sm">
            <span class="text-[#d12027] font-semibold">Gift Certificate</span>
            <span class="text-[#d12027] font-bold" x-text="'− ' + fmt(giftUse)"></span>
          </div>
        </div>

        <!-- Total -->
        <div class="flex items-center justify-between pt-4 border-t border-black/10">
          <span class="text-xl font-extrabold text-neutral-900">Total</span>
          <span class="text-xl font-extrabold text-neutral-900" x-text="fmt(total)"></span>
        </div>

        <!-- Promo code -->
        <div class="mt-6 pt-6 border-t border-black/10">
          <label class="flex items-center gap-3 cursor-pointer select-none">
            <input type="checkbox" x-model="showPromo" class="w-4 h-4 rounded border-black/20 bg-black/5 text-[#d12027] focus:ring-[#d12027] focus:ring-offset-0" />
            <span class="text-sm text-neutral-900 font-semibold">I have a promo code</span>
            <span x-show="promoApplied" class="inline-flex items-center gap-1 text-[10px] font-extrabold tracking-[0.2em] uppercase text-[#d12027]">
              <i data-lucide="check" class="w-3 h-3"></i> Applied
            </span>
          </label>
          <div x-show="showPromo" x-transition class="mt-4 space-y-2">
            <div class="flex items-end gap-4">
              <input type="text" name="promo" x-model="promoCode" @keydown.enter.prevent="applyPromo()" placeholder="Try 1111"
                     class="flex-1 bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none transition-colors" />
              <button type="button" @click="applyPromo()" class="shrink-0 pb-3 text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] hover:text-neutral-900 transition-colors">Apply</button>
            </div>
            <p x-show="promoMsg" x-transition :class="promoMsgKind === 'ok' ? 'text-[#d12027]' : 'text-[#ff6b6b]'" class="text-xs font-semibold" x-text="promoMsg"></p>
          </div>
        </div>

        <div class="flex items-center justify-between text-[11px] text-neutral-500 mt-4">
          <span>* All sales are final</span>
        </div>

        <!-- Mobile-only Continue to Payment -->
        <div class="lg:hidden mt-6">
          <button type="button" @click="mobileStep = 2; window.scrollTo({ top: 0, behavior: 'smooth' })"
                  class="cc-btn-primary w-full text-sm tracking-[0.24em] px-6 py-4">
            Continue to Payment
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </button>
        </div>
      </div>

      <!-- Restrictions & Requirements -->
      <div class="pt-6 border-t border-black/10">
        <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-4">Restrictions &amp; Requirements</p>
        <ul class="space-y-3 text-sm">
          <li class="flex items-start gap-3">
            <i data-lucide="clock" class="w-4 h-4 text-[#d12027] mt-0.5 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed"><strong class="text-neutral-900">Arrive 30 mins before showtime</strong> as seating is on a first-come basis.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="check-circle-2" class="w-4 h-4 text-[#d12027] mt-0.5 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed">There is a <strong class="text-neutral-900">2-drink minimum</strong> for all shows.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="alert-triangle" class="w-4 h-4 text-[#d12027] mt-0.5 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed"><strong class="text-neutral-900 uppercase tracking-wider">Line-ups subject to change.</strong> Tickets are for a comedy show, not for any specific performer.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="check-circle-2" class="w-4 h-4 text-[#d12027] mt-0.5 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed"><strong class="text-neutral-900">All ages welcome.</strong> Shows may contain adult content but there are no age restrictions for admission.</p>
          </li>
        </ul>
      </div>

    </div>

    <!-- ─── RIGHT COLUMN ─── -->
    <aside :class="{'hidden lg:block': mobileStep !== 2}">
      <!-- Mobile back link -->
      <button type="button" @click="mobileStep = 1; window.scrollTo({ top: 0, behavior: 'smooth' })"
              class="lg:hidden inline-flex items-center gap-2 text-sm font-bold text-[#d12027] hover:text-neutral-900 transition-colors mb-5">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Back to Summary
      </button>
      <div class="lg:sticky lg:top-44 bg-neutral-50 rounded-xl border border-black/10 overflow-hidden">
      <div class="p-5 md:p-8 space-y-6 md:space-y-8">

        <!-- Customer Information -->
        <div>
          <header class="flex items-center gap-3 pb-5 mb-6 border-b border-black/10">
            <span class="w-10 h-10 rounded-lg bg-[#d12027]/10 border border-[#d12027]/20 flex items-center justify-center flex-shrink-0">
              <i data-lucide="user" class="w-5 h-5 text-[#d12027]"></i>
            </span>
            <h2 class="text-lg font-extrabold text-neutral-900">Customer Information</h2>
          </header>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">
            <div>
              <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
                <span>First Name</span>
                <span class="text-[#d12027] text-base leading-none">*</span>
              </label>
              <input required type="text" name="first_name" placeholder="First"
                     class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
            </div>
            <div>
              <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
                <span>Last Name</span>
                <span class="text-[#d12027] text-base leading-none">*</span>
              </label>
              <input required type="text" name="last_name" placeholder="Last"
                     class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
            </div>
            <div class="sm:col-span-2">
              <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
                <span>Email</span>
                <span class="text-[#d12027] text-base leading-none">*</span>
              </label>
              <input required type="email" name="email" placeholder="you@somewhere.com"
                     class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
            </div>
            <div class="sm:col-span-2">
              <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
                <span>Phone</span>
              </label>
              <input type="tel" name="phone" placeholder="(555) 555-5555"
                     class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
            </div>
          </div>
        </div>

        <!-- Payment Information -->
        <div>
          <header class="flex items-center gap-3 pb-5 mb-6 border-b border-black/10">
            <span class="w-10 h-10 rounded-lg bg-[#d12027]/10 border border-[#d12027]/20 flex items-center justify-center flex-shrink-0">
              <i data-lucide="credit-card" class="w-5 h-5 text-[#d12027]"></i>
            </span>
            <h2 class="text-lg font-extrabold text-neutral-900">Payment Information</h2>
          </header>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">
            <div class="sm:col-span-2">
              <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
                <span>Card Number</span>
                <span class="text-[#d12027] text-base leading-none">*</span>
              </label>
              <input required type="text" inputmode="numeric" name="card" placeholder="0000 0000 0000 0000"
                     class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
            </div>
            <div>
              <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
                <span>Expiration</span>
                <span class="text-[#d12027] text-base leading-none">*</span>
              </label>
              <input required type="text" name="expiry" placeholder="MM / YY"
                     class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
            </div>
            <div>
              <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
                <span>CVC</span>
                <span class="text-[#d12027] text-base leading-none">*</span>
              </label>
              <input required type="text" inputmode="numeric" name="cvc" placeholder="123"
                     class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
            </div>
          </div>

          <!-- Gift certificate -->
          <label class="flex items-center gap-3 mt-6 cursor-pointer select-none">
            <input type="checkbox" x-model="useGift" class="w-4 h-4 rounded border-black/20 bg-black/5 text-[#d12027] focus:ring-[#d12027] focus:ring-offset-0" />
            <span class="text-sm text-neutral-900 font-semibold">Use Gift Certificate</span>
            <span x-show="giftApplied" class="inline-flex items-center gap-1 text-[10px] font-extrabold tracking-[0.2em] uppercase text-[#d12027]">
              <i data-lucide="check" class="w-3 h-3"></i> Applied
            </span>
          </label>
          <div x-show="useGift" x-transition class="mt-4 space-y-2">
            <div class="flex items-end gap-4">
              <input type="text" name="gift" x-model="giftCode" @keydown.enter.prevent="applyGift()" placeholder="Try 2222"
                     class="flex-1 bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none transition-colors" />
              <button type="button" @click="applyGift()" class="shrink-0 pb-3 text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] hover:text-neutral-900 transition-colors">Apply</button>
            </div>
            <p x-show="giftMsg" x-transition :class="giftMsgKind === 'ok' ? 'text-[#d12027]' : 'text-[#ff6b6b]'" class="text-xs font-semibold" x-text="giftMsg"></p>
          </div>
        </div>

        <!-- You will be charged -->
        <div class="flex items-center justify-between px-5 py-4 border-2 border-[#d12027] rounded-[10px] bg-[#d12027]/[0.04]">
          <span class="text-[11px] font-extrabold uppercase tracking-[0.2em] text-[#d12027]">You will be charged</span>
          <span class="text-2xl font-extrabold text-neutral-900" x-text="fmt(total)"></span>
        </div>

        <!-- Purchase button + back link grouped so back sits closer to the button -->
        <div>
          <button type="submit" class="cc-btn-primary w-full text-sm tracking-[0.24em] px-6 py-4">
            Purchase Tickets
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </button>

          <a href="?view=addons&show=<?= urlencode($showId) ?>&tickets=<?= urlencode($ticketsParam) ?>" class="mt-4 block text-center w-full text-sm text-neutral-600 hover:text-[#d12027] transition-colors">← Back to Add-ons</a>
        </div>

      </div>

      <!-- Footer strip with Secure Transaction (flush to card bottom) -->
      <div class="bg-black/5 border-t border-black/10 px-6 md:px-8 py-5">
        <div class="flex items-center gap-2 justify-center text-[11px] text-neutral-500">
          <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
          Secure Transaction
        </div>
      </div>

      </div>
    </aside>

  </form>

</div>
