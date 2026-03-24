<?php
$success = isset($_POST['checkout_submitted']) && $_POST['checkout_submitted'] === '1';
$showId = isset($_GET['show']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['show']) : null;
$promoCode = isset($_GET['promo']) ? preg_replace('/[^A-Za-z0-9]/', '', $_GET['promo']) : '';
$addonsTotal = isset($_GET['addons']) ? floatval($_GET['addons']) : 0;
$addonItems = [];
if (isset($_GET['addon_items']) && $_GET['addon_items'] !== '') {
  foreach (explode('|', $_GET['addon_items']) as $item) {
    $parts = explode(':', $item);
    if (count($parts) === 3) {
      $addonItems[] = ['name' => $parts[0], 'qty' => intval($parts[1]), 'price' => floatval($parts[2])];
    }
  }
}

$show = null;
foreach ($shows as $s) {
  if ($s['id'] === $showId) {
    $show = $s;
    break;
  }
}

// Parse ticket types from URL: tickets=general:1|frontrow:0|vip:0
$ticketTypeInfo = [
  'general'  => ['name' => 'General Admission',  'price' => $show ? floatval($show['priceValue']) : 15],
  'frontrow' => ['name' => 'Front Row Seats',     'price' => 45],
  'vip'      => ['name' => 'Gold Front Row VIP',  'price' => 55],
];
$ticketItems = [];
$ticketsParam = isset($_GET['tickets']) ? $_GET['tickets'] : 'general:1';
foreach (explode('|', $ticketsParam) as $part) {
  $pieces = explode(':', $part);
  if (count($pieces) === 2 && isset($ticketTypeInfo[$pieces[0]])) {
    $qty = max(0, intval($pieces[1]));
    if ($qty > 0) {
      $ticketItems[] = [
        'key'   => $pieces[0],
        'name'  => $ticketTypeInfo[$pieces[0]]['name'],
        'price' => $ticketTypeInfo[$pieces[0]]['price'],
        'qty'   => $qty,
      ];
    }
  }
}
if (empty($ticketItems)) {
  $ticketItems[] = ['key' => 'general', 'name' => 'General Admission', 'price' => $ticketTypeInfo['general']['price'], 'qty' => 1];
}

$subtotal = 0;
$totalTicketCount = 0;
foreach ($ticketItems as $ti) {
  $subtotal += $ti['price'] * $ti['qty'];
  $totalTicketCount += $ti['qty'];
}
$serviceFee = $subtotal * 0.10;
$tax = ($subtotal + $addonsTotal) * 0.08875;
$total = $subtotal + $addonsTotal + $tax + $serviceFee;
?>

<?php
if ($success):
  $d = $show ? formatShowDate($show['date']) : null;
?>
<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center text-center">

  <!-- Check Icon -->
  <div class="w-20 h-20 bg-green-500/10 rounded-xl flex items-center justify-center mb-8">
    <i data-lucide="circle-check" class="w-10 h-10 text-green-500"></i>
  </div>

  <!-- Heading -->
  <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-white mb-4">You're Going!</h1>
  <p class="text-lg text-neutral-400 max-w-lg mb-10">Your tickets have been confirmed. We've sent the receipt and details to your email.</p>

  <!-- Event Card -->
  <?php if ($show && $d): ?>
  <div class="w-full max-w-[600px] bg-[#1e1e1e] rounded-xl overflow-hidden text-left">
    <div class="p-8 space-y-5">
      <h2 class="text-2xl font-bold tracking-tight text-white"><?= htmlspecialchars($show['title']) ?></h2>
      <p class="text-neutral-400 text-sm leading-relaxed"><?= htmlspecialchars($show['description']) ?></p>
      <div class="flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1.5 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          <?= $d['weekday'] ?>, <?= $d['day'] ?> <?= $d['month'] ?> <?= $d['year'] ?>
        </span>
        <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1.5 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <?= $d['time'] ?>
        </span>
      </div>
      <div class="inline-flex items-center gap-1.5 bg-[#383838] text-neutral-300 text-xs font-medium px-3 py-1.5 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        <?= htmlspecialchars($show['location']) ?>
      </div>
      <?php if ($show):
        $startDt = new DateTime($show['date']);
        $endDt = clone $startDt;
        $endDt->modify('+2 hours');
        $gcalStart = $startDt->format('Ymd\THis');
        $gcalEnd = $endDt->format('Ymd\THis');
        $gcalTitle = urlencode($show['title']);
        $gcalLocation = urlencode($show['location']);
        $gcalDetails = urlencode('Comedy Break In - ' . $show['title']);
        $gcalUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE&text={$gcalTitle}&dates={$gcalStart}/{$gcalEnd}&location={$gcalLocation}&details={$gcalDetails}";
      ?>
      <div class="border-t border-dashed border-white/10 pt-5 flex gap-3"
           x-data="{ shared: false, shareTitle: <?= htmlspecialchars(json_encode($show['title']), ENT_QUOTES) ?>, shareLocation: <?= htmlspecialchars(json_encode($show['location']), ENT_QUOTES) ?> }">
        <a href="<?= $gcalUrl ?>" target="_blank" class="flex-1 flex items-center justify-center gap-2 bg-white/5 hover:bg-white/10 text-white font-bold text-sm py-3 rounded-[10px] border border-white/10 transition-colors">
          <i data-lucide="calendar" class="w-4 h-4"></i>
          Save to Calendar
        </a>
        <button @click="
          if (navigator.share) {
            navigator.share({ title: shareTitle, text: 'I am going to ' + shareTitle + ' at ' + shareLocation + '!', url: window.location.href });
          } else {
            navigator.clipboard.writeText(window.location.href);
            shared = true;
            setTimeout(() => { shared = false }, 2000);
          }
        " class="flex-1 flex items-center justify-center gap-2 bg-white/5 hover:bg-white/10 text-white font-bold text-sm py-3 rounded-[10px] border border-white/10 transition-colors">
          <i :data-lucide="shared ? 'check' : 'share-2'" class="w-4 h-4"></i>
          <span x-text="shared ? 'Link Copied!' : 'Share'"></span>
        </button>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <a href="?view=home" class="mt-10 inline-block px-12 py-4 bg-white text-black font-bold text-base uppercase tracking-wider rounded-[10px] hover:bg-neutral-200 transition-colors">Back to Home</a>

</div>
<?php else: ?>

<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6" x-data="{
  step: 1,
  isMobile: window.innerWidth < 1024,
  baseTotal: <?= $total ?>,
  totalTicketCount: <?= $totalTicketCount ?>,
  promoApplied: <?php echo strtoupper($promoCode) === 'EE001' ? "'flat2'" : 'false'; ?>,
  giftApplied: false,
  promoOpen: <?php echo strtoupper($promoCode) === 'EE001' ? 'true' : 'false'; ?>,
  promoInput: '<?php echo strtoupper($promoCode) === 'EE001' ? 'EE001' : ''; ?>',
  promoMsg: <?php echo strtoupper($promoCode) === 'EE001' ? "'Promo code applied! \$2 off per ticket.'" : "''"; ?>,
  promoMsgType: <?php echo strtoupper($promoCode) === 'EE001' ? "'success'" : "''"; ?>,
  giftOpen: false,
  giftInput: '',
  giftMsg: '',
  giftMsgType: '',
  get promoDiscount() {
    if (this.promoApplied === 'percent5') return this.baseTotal * 0.05;
    if (this.promoApplied === 'flat2') return 2 * this.totalTicketCount;
    return 0;
  },
  get giftDiscount() {
    return this.giftApplied ? this.baseTotal * 0.05 : 0;
  },
  get finalTotal() {
    let t = this.baseTotal - this.promoDiscount - this.giftDiscount;
    return t < 0 ? 0 : t;
  },
  applyPromo() {
    let code = this.promoInput.trim().toUpperCase();
    if (code === '1111') {
      this.promoApplied = 'percent5';
      this.promoMsg = 'Promo code applied! 5% discount.';
      this.promoMsgType = 'success';
    } else if (code === 'EE001') {
      this.promoApplied = 'flat2';
      this.promoMsg = 'Promo code applied! $2 off per ticket.';
      this.promoMsgType = 'success';
    } else {
      this.promoApplied = false;
      this.promoMsg = 'Invalid promo code. Please try again.';
      this.promoMsgType = 'error';
    }
  },
  applyGift() {
    if (this.giftInput.trim() === '1111') {
      this.giftApplied = true;
      this.giftMsg = 'Gift certificate applied! 5% discount.';
      this.giftMsgType = 'success';
    } else {
      this.giftApplied = false;
      this.giftMsg = 'Invalid certificate code. Please try again.';
      this.giftMsgType = 'error';
    }
  }
}" @resize.window="isMobile = window.innerWidth < 1024; if (!isMobile) { step = 1 }">

  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-12 border-b border-white/10 pb-8">
    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-white">Checkout</h1>
    <a href="?view=calendar" class="flex items-center gap-2 text-sm font-bold text-neutral-400 hover:text-white bg-white/5 hover:bg-white/10 px-5 py-3 rounded-[10px] transition-all border border-white/10">
      <i data-lucide="arrow-left" class="w-5 h-5"></i>
      Back to Schedule
    </a>
  </div>

  <div class="grid lg:grid-cols-12 gap-12">

    <!-- Left Column: Order Summary -->
    <div class="lg:col-span-7 space-y-8 order-2 lg:order-1" x-show="!isMobile || step === 1">

      <!-- Event Details -->
      <section class="bg-white/5 rounded-xl border border-white/10 shadow-md p-8">
        <h2 class="text-lg font-bold mb-6 flex items-center gap-3 pb-4 border-b border-white/10">
          <div class="w-8 h-8 rounded-full bg-[#d12027] flex items-center justify-center flex-shrink-0">
            <i data-lucide="ticket" class="w-4 h-4 text-white"></i>
          </div>
          Event Details
        </h2>
        <div class="space-y-4">
          <h3 class="text-xl font-bold text-white"><?= $show ? htmlspecialchars($show['title']) : 'Comedy Show' ?></h3>
          <p class="text-neutral-400 text-sm leading-relaxed"><?= $show ? htmlspecialchars($show['description']) : '' ?></p>
          <div class="flex flex-wrap items-center gap-2 pt-2">
            <?php if ($show):
              $cd = formatShowDate($show['date']);
            ?>
            <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1.5 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              <?= $cd['weekday'] ?>, <?= $cd['day'] ?> <?= $cd['month'] ?> <?= $cd['year'] ?>
            </span>
            <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1.5 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <?= $cd['time'] ?>
            </span>
            <?php endif; ?>
          </div>
          <?php if ($show): ?>
          <div class="inline-flex items-center gap-1.5 bg-white/5 text-neutral-400 text-xs font-medium px-3 py-1.5 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <?= htmlspecialchars($show['location']) ?>
          </div>
          <?php endif; ?>
        </div>
      </section>

      <!-- Order Summary -->
      <section class="bg-white/5 rounded-xl border border-white/10 shadow-md p-8">
        <h2 class="text-lg font-bold mb-6 flex items-center gap-3 pb-4 border-b border-white/10">
          <div class="w-8 h-8 rounded-full bg-[#d12027] flex items-center justify-center flex-shrink-0">
            <i data-lucide="receipt" class="w-4 h-4 text-white"></i>
          </div>
          Order Summary
        </h2>

        <!-- Tickets -->
        <?php foreach ($ticketItems as $ti): ?>
        <div class="flex items-center justify-between py-4 border-b border-white/10">
          <div>
            <div class="font-bold text-white"><?= htmlspecialchars($ti['name']) ?></div>
            <div class="text-xs text-neutral-400 mt-0.5"><?= $ti['qty'] ?> x $<?= number_format($ti['price'], 2) ?></div>
          </div>
          <span class="font-bold text-white">$<?= number_format($ti['price'] * $ti['qty'], 2) ?></span>
        </div>
        <?php endforeach; ?>

        <!-- Add-ons -->
        <?php if (!empty($addonItems)): ?>
        <div class="py-4 border-b border-white/10 space-y-2">
          <?php foreach ($addonItems as $addon): ?>
          <div class="flex justify-between text-sm text-neutral-400">
            <span><?= htmlspecialchars($addon['name']) ?> x<?= $addon['qty'] ?></span>
            <span>$<?= number_format($addon['price'] * $addon['qty'], 2) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Fees -->
        <div class="py-4 border-b border-white/10 space-y-2">
          <div class="flex justify-between text-sm text-neutral-400"><span>Tax</span><span>$<?= number_format($tax, 2) ?></span></div>
          <div class="flex justify-between text-sm text-neutral-400"><span>Service Fee</span><span>$<?= number_format($serviceFee, 2) ?></span></div>
        </div>

        <!-- Total + Discounts -->
        <div class="py-4 border-b border-white/10 space-y-2">
          <div x-show="promoApplied" class="flex justify-between text-sm text-green-600">
            <span x-text="promoApplied === 'percent5' ? 'Promo Code 1111 (5%)' : 'Promo Code EE001 ($2 x ' + totalTicketCount + ')'"></span>
            <span x-text="'-$' + promoDiscount.toFixed(2)"></span>
          </div>
          <div x-show="giftApplied" class="flex justify-between text-sm text-green-600">
            <span>Gift Certificate (5%)</span>
            <span x-text="'-$' + giftDiscount.toFixed(2)"></span>
          </div>
          <div class="flex justify-between text-lg font-bold text-white">
            <span>Total</span>
            <span x-text="'$' + finalTotal.toFixed(2)"></span>
          </div>
        </div>

        <!-- Promo Code -->
        <div class="py-4">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" x-model="promoOpen" @change="if (!promoOpen) { promoInput = ''; promoMsg = ''; promoApplied = false; }" class="w-4 h-4 accent-[#d12027] cursor-pointer" />
            <span class="text-sm font-medium text-neutral-400">I have a promo code</span>
          </label>
          <div x-show="promoOpen" x-cloak class="mt-3">
            <div class="flex gap-2">
              <input type="text" x-model="promoInput" placeholder="Enter code" class="flex-1 bg-white/5 text-white border border-white/10 rounded-[10px] px-4 py-3 focus:ring-2 focus:ring-[#d12027] outline-none uppercase placeholder:capitalize text-sm" />
              <button type="button" @click="applyPromo()" class="px-5 py-3 bg-white text-black hover:bg-neutral-200 font-bold rounded-[10px] transition-colors text-sm">Apply</button>
            </div>
            <p x-show="promoMsg" x-text="promoMsg" :class="promoMsgType === 'success' ? 'text-green-600' : 'text-red-500'" class="text-xs mt-2"></p>
          </div>
        </div>

        <div class="flex justify-between items-center text-xs text-neutral-400 italic">
          <span>* All sales are final</span>
          <span>Sales Tax (8.875%)</span>
        </div>

        <!-- Mobile Continue Button -->
        <button type="button" @click="step = 2; window.scrollTo({ top: 0, behavior: 'smooth' })" class="lg:hidden w-full py-4 bg-white text-black font-bold text-lg rounded-[10px] hover:bg-neutral-200 transition-colors mt-6">Continue to Payment</button>

      </section>

      <!-- Restrictions -->
      <section class="bg-white/5 rounded-xl border border-white/10 shadow-md p-8">
        <h2 class="text-lg font-bold flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
          <div class="w-8 h-8 rounded-full bg-[#d12027] flex items-center justify-center flex-shrink-0">
            <i data-lucide="alert-triangle" class="w-4 h-4 text-white"></i>
          </div>
          Restrictions &amp; Requirements
        </h2>
        <ul class="space-y-4 text-sm font-medium text-neutral-400">
          <li class="flex items-start gap-3"><i data-lucide="clock" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">Arrive 30 mins before showtime</strong> as seating is on a first-come basis.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="circle-check" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i><span>There is a <strong class="text-neutral-300">2-drink minimum</strong> for all shows.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="alert-triangle" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">LINE-UPS SUBJECT TO CHANGE.</strong> Tickets are for a comedy show, not for any specific performer.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="circle-check" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">All ages welcome.</strong> Shows may contain adult content but there are no age restrictions for admission.</span></li>
        </ul>
      </section>
    </div>

    <!-- Right Column: Form & Total -->
    <div class="lg:col-span-5 space-y-8 order-1 lg:order-2" x-show="!isMobile || step === 2" x-cloak>
      <div class="bg-white/5 pt-0 pb-8 px-8 rounded-xl border border-white/10 shadow-xl sticky top-32 text-white">
        <!-- Mobile Back Button -->
        <button type="button" @click="step = 1; window.scrollTo({ top: 0, behavior: 'smooth' })" class="lg:hidden flex items-center gap-2 text-sm font-bold text-neutral-400 hover:text-white py-4 transition-colors">
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
          Back to Order Summary
        </button>
        <form method="POST" action="?view=checkout&show=<?= urlencode($showId) ?>" class="space-y-8">
          <input type="hidden" name="checkout_submitted" value="1" />

          <!-- Customer Info -->
          <div>
            <h3 class="text-lg font-bold mb-4 text-white flex items-center gap-3 pb-4 border-b border-white/10">
              <div class="w-8 h-8 rounded-full bg-[#d12027] flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
              </div>
              Customer Information
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="space-y-2"><label class="text-xs font-bold text-neutral-400 uppercase">First Name</label><input required type="text" name="first_name" class="w-full bg-white/5 border border-white/10 text-white rounded-[10px] p-3 focus:ring-2 focus:ring-[#d12027] outline-none" /></div>
              <div class="space-y-2"><label class="text-xs font-bold text-neutral-400 uppercase">Last Name</label><input required type="text" name="last_name" class="w-full bg-white/5 border border-white/10 text-white rounded-[10px] p-3 focus:ring-2 focus:ring-[#d12027] outline-none" /></div>
              <div class="space-y-2"><label class="text-xs font-bold text-neutral-400 uppercase">Email</label><input required type="email" name="email" class="w-full bg-white/5 border border-white/10 text-white rounded-[10px] p-3 focus:ring-2 focus:ring-[#d12027] outline-none" /></div>
              <div class="space-y-2"><label class="text-xs font-bold text-neutral-400 uppercase">Phone</label><input required type="tel" name="phone" class="w-full bg-white/5 border border-white/10 text-white rounded-[10px] p-3 focus:ring-2 focus:ring-[#d12027] outline-none" /></div>
            </div>
          </div>

          <!-- Payment Info -->
          <div>
            <h3 class="text-lg font-bold mb-4 text-white flex items-center gap-3 pb-4 border-b border-white/10">
              <div class="w-8 h-8 rounded-full bg-[#d12027] flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
              </div>
              Payment Information
            </h3>
            <div class="space-y-4">
              <div class="space-y-2"><label class="text-xs font-bold text-neutral-400 uppercase">Card Number</label><input required type="text" name="card" placeholder="0000 0000 0000 0000" class="w-full bg-white/5 border border-white/10 text-white rounded-[10px] py-3 px-3 focus:ring-2 focus:ring-[#d12027] outline-none" /></div>
              <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2"><label class="text-xs font-bold text-neutral-400 uppercase">Expiration</label><input required type="text" name="exp" placeholder="MM/YY" class="w-full bg-white/5 border border-white/10 text-white rounded-[10px] p-3 focus:ring-2 focus:ring-[#d12027] outline-none" /></div>
                <div class="space-y-2"><label class="text-xs font-bold text-neutral-400 uppercase">CVC</label><input required type="text" name="cvc" placeholder="123" class="w-full bg-white/5 border border-white/10 text-white rounded-[10px] p-3 focus:ring-2 focus:ring-[#d12027] outline-none" /></div>
              </div>
            </div>
          </div>

          <!-- Gift Certificate -->
          <div>
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="checkbox" x-model="giftOpen" @change="if (!giftOpen) { giftInput = ''; giftMsg = ''; giftApplied = false; }" class="w-4 h-4 accent-[#d12027] cursor-pointer" />
              <span class="text-sm font-medium text-neutral-400">Use Gift Certificate</span>
            </label>
            <div x-show="giftOpen" x-cloak class="mt-4">
              <div class="flex gap-2">
                <input type="text" x-model="giftInput" name="gift_code" placeholder="Enter certificate code" class="flex-1 bg-white/5 border border-white/10 text-white rounded-[10px] p-3 focus:ring-2 focus:ring-[#d12027] outline-none placeholder:text-neutral-400" />
                <button type="button" @click="applyGift()" class="px-6 py-3 bg-white text-black font-bold rounded-[10px] hover:bg-neutral-200 transition-colors">Apply</button>
              </div>
              <p x-show="giftMsg" x-text="giftMsg" :class="giftMsgType === 'success' ? 'text-green-600' : 'text-red-500'" class="text-xs mt-2"></p>
            </div>
          </div>

          <!-- You Will Be Charged -->
          <div class="rounded-xl p-5 border-2 border-[#d12027]">
            <div class="flex justify-between items-center">
              <span class="text-sm font-bold text-neutral-400 uppercase tracking-wider">You will be charged</span>
              <span class="text-2xl font-bold text-white" x-text="'$' + finalTotal.toFixed(2)"></span>
            </div>
          </div>

          <button type="submit" class="w-full py-4 bg-white text-black font-bold text-lg rounded-[10px] hover:bg-neutral-200 transition-colors shadow-lg">Purchase Tickets</button>
          <p class="text-center text-xs text-neutral-400 flex justify-center items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> Secure Transaction</p>
        </form>
      </div>
    </div>

  </div>
</div>
<?php endif; ?>
