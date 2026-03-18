<?php
$success = isset($_POST['checkout_submitted']) && $_POST['checkout_submitted'] === '1';
$showId = isset($_GET['show']) ? $_GET['show'] : null;
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
<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen flex flex-col items-center justify-center text-center">

  <!-- Check Icon -->
  <div class="w-20 h-20 bg-[#1E2E23] rounded-[10px] flex items-center justify-center mb-8">
    <i data-lucide="circle-check" class="w-10 h-10 text-green-500"></i>
  </div>

  <!-- Heading -->
  <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tight text-white mb-4">You're Going!</h1>
  <p class="text-lg text-neutral-400 max-w-lg mb-10">Your tickets have been confirmed. We've sent the receipt and details to your email.</p>

  <!-- Event Card -->
  <?php if ($show && $d): ?>
  <div class="w-full max-w-[560px] bg-[#1E2323] rounded-[10px] overflow-hidden border-t-4 border-[#24CECE] text-left">
    <div class="p-8">
      <!-- Title Row -->
      <div class="flex items-start justify-between gap-4 mb-6">
        <div>
          <h2 class="text-2xl font-black uppercase tracking-tight text-white leading-tight mb-1"><?= htmlspecialchars($show['title']) ?></h2>
          <span class="text-[#24CECE] font-bold text-sm"><?= htmlspecialchars($show['location']) ?></span>
        </div>
        <div class="border border-neutral-600 rounded-[5px] pt-1.5 pb-1 px-3 text-center shrink-0">
          <div class="text-xs font-bold text-neutral-400 leading-none uppercase"><?= $d['month'] ?></div>
          <div class="text-2xl font-black text-white leading-none mt-0.5"><?= $d['day'] ?></div>
        </div>
      </div>

      <!-- Details -->
      <div class="space-y-4 mb-8">
        <div class="flex items-center gap-3 text-neutral-300">
          <i data-lucide="calendar" class="w-5 h-5 text-[#94A0AF] shrink-0"></i>
          <div>
            <div class="font-bold text-white text-sm"><?= date('l', strtotime($show['date'])) ?>, <?= $d['time'] ?></div>
            <div class="text-xs text-[#94A0AF]">Doors open 1 hour before</div>
          </div>
        </div>
        <div class="flex items-center gap-3 text-neutral-300">
          <i data-lucide="map-pin" class="w-5 h-5 text-[#94A0AF] shrink-0"></i>
          <div>
            <div class="font-bold text-white text-sm">Comedy Club</div>
            <div class="text-xs text-[#94A0AF]">487 Atlantic Ave, Brooklyn, NY</div>
          </div>
        </div>
      </div>

      <!-- Dotted Divider -->
      <div class="border-t border-dashed border-neutral-700 mb-6"></div>

      <!-- Action Buttons -->
      <div class="flex gap-3">
        <button onclick="return false;" class="flex-1 flex items-center justify-center gap-2 bg-neutral-800 hover:bg-neutral-700 text-white font-bold text-sm py-3 rounded-[8px] transition-colors">
          <i data-lucide="download" class="w-4 h-4"></i>
          Save to Calendar
        </button>
        <button onclick="return false;" class="flex-1 flex items-center justify-center gap-2 bg-neutral-800 hover:bg-neutral-700 text-white font-bold text-sm py-3 rounded-[8px] transition-colors">
          <i data-lucide="share-2" class="w-4 h-4"></i>
          Share
        </button>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Back to Home -->
  <a href="?view=home" class="mt-10 inline-block px-12 py-4 bg-[#24CECE] text-black font-black text-base uppercase tracking-wider rounded-[8px] hover:bg-[#20B8B8] transition-colors">Back to Home</a>

</div>
<?php else: ?>

<div class="pt-[150px] pb-24 container mx-auto px-6 max-w-[1200px]" x-data="{
  step: 1,
  isMobile: window.innerWidth < 1024,
  baseTotal: <?= $total ?>,
  totalTicketCount: <?= $totalTicketCount ?>,
  promoApplied: <?= strtoupper($promoCode) === 'EE001' ? \"'flat2'\" : 'false' ?>,
  giftApplied: false,
  promoOpen: <?= strtoupper($promoCode) === 'EE001' ? 'true' : 'false' ?>,
  promoInput: '<?= strtoupper($promoCode) === 'EE001' ? 'EE001' : '' ?>',
  promoMsg: <?= strtoupper($promoCode) === 'EE001' ? \"'Promo code applied! $2 off per ticket.'\" : \"''\" ?>,
  promoMsgType: <?= strtoupper($promoCode) === 'EE001' ? \"'success'\" : \"''\" ?>,
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
}" @resize.window="isMobile = window.innerWidth < 1024">

  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-12 border-b border-neutral-800 pb-8">
    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight">CHECKOUT</h1>
    <a href="?view=schedule" class="flex items-center gap-2 text-sm font-bold text-neutral-400 hover:text-white bg-neutral-900 hover:bg-neutral-800 px-5 py-3 rounded-[5px] transition-all border border-neutral-800">
      <i data-lucide="arrow-left" class="w-5 h-5"></i>
      Back to Schedule
    </a>
  </div>

  <div class="grid lg:grid-cols-12 gap-12">

    <!-- Left Column: Order Summary -->
    <div class="lg:col-span-7 space-y-8 order-2 lg:order-1" x-show="!isMobile || step === 1">

      <!-- Cart Summary Component -->
      <?php component('cart-summary', ['ticketItems' => $ticketItems, 'addonItems' => $addonItems, 'show' => $show, 'promoCode' => $promoCode]); ?>

      <!-- Promo Code -->
      <section class="bg-[#3A4655] rounded-[5px] border border-neutral-800 p-8">
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" x-model="promoOpen" @change="if (!promoOpen) { promoInput = ''; promoMsg = ''; promoApplied = false; }" class="w-4 h-4 accent-[#24CECE] cursor-pointer" />
          <span class="text-sm font-medium text-[#94A0AF]">I have a promo code</span>
        </label>
        <div x-show="promoOpen" x-cloak class="mt-3">
          <div class="flex gap-2">
            <input type="text" x-model="promoInput" placeholder="Enter code" class="flex-1 bg-white text-black border border-neutral-200 rounded-[5px] px-4 py-3 focus:ring-2 focus:ring-[#24CECE] outline-none uppercase placeholder:capitalize text-sm" />
            <button type="button" @click="applyPromo()" class="px-5 py-3 bg-neutral-800 hover:bg-neutral-700 text-white font-bold rounded-[5px] transition-colors text-sm">Apply</button>
          </div>
          <p x-show="promoMsg" x-text="promoMsg" :class="promoMsgType === 'success' ? 'text-green-400' : 'text-red-500'" class="text-xs mt-2"></p>
        </div>
      </section>

      <!-- Discount Summary -->
      <section class="bg-[#3A4655] rounded-[5px] border border-neutral-800 p-8 space-y-3">
        <div x-show="promoApplied" class="flex justify-between text-sm text-green-400">
          <span x-text="promoApplied === 'percent5' ? 'Promo Code 1111 (5%)' : 'Promo Code EE001 ($2 x ' + totalTicketCount + ')'"></span>
          <span x-text="'-$' + promoDiscount.toFixed(2)"></span>
        </div>
        <div x-show="giftApplied" class="flex justify-between text-sm text-green-400">
          <span>Gift Certificate (5%)</span>
          <span x-text="'-$' + giftDiscount.toFixed(2)"></span>
        </div>
        <div class="flex justify-between text-lg font-bold text-white">
          <span>Total</span>
          <span class="text-[#24CECE]" x-text="'$' + finalTotal.toFixed(2)"></span>
        </div>
        <div class="flex justify-between items-center text-xs text-[#94A0AF] italic">
          <span>* All sales are final</span>
          <span>NY Sales Tax (8.875%)</span>
        </div>

        <!-- Mobile Continue Button -->
        <button type="button" @click="step = 2; window.scrollTo({ top: 0, behavior: 'smooth' })" class="lg:hidden w-full py-4 bg-[#24CECE] text-black font-bold text-lg rounded-[5px] hover:bg-[#20B8B8] transition-colors mt-6">Continue to Payment</button>
      </section>

      <!-- Restrictions -->
      <section class="bg-[#3A4655] rounded-[5px] border border-neutral-800 p-8">
        <h2 class="text-lg font-bold flex items-center gap-2 mb-6">
          <i data-lucide="alert-triangle" class="w-5 h-5 text-[#24CECE]"></i>
          Restrictions &amp; Requirements
        </h2>
        <ul class="space-y-4 text-sm font-medium text-neutral-400">
          <li class="flex items-start gap-3"><i data-lucide="clock" class="w-5 h-5 text-[#94A0AF] shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">Arrive 30 mins before showtime</strong> as seating is on a first-come basis.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="circle-check" class="w-5 h-5 text-[#94A0AF] shrink-0 mt-0.5"></i><span>There is a <strong class="text-neutral-300">2-drink minimum</strong> for all shows.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="alert-triangle" class="w-5 h-5 text-[#94A0AF] shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">LINE-UPS SUBJECT TO CHANGE.</strong> Tickets are for a comedy show, not for any specific performer.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="circle-check" class="w-5 h-5 text-[#94A0AF] shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">All ages welcome.</strong> Shows may contain adult content but there are no age restrictions for admission.</span></li>
        </ul>
      </section>
    </div>

    <!-- Right Column: Form & Total -->
    <div class="lg:col-span-5 space-y-8 order-1 lg:order-2" x-show="!isMobile || step === 2" x-cloak>
      <div class="bg-white pt-0 pb-8 px-8 rounded-[5px] border border-neutral-200 shadow-xl sticky top-32 text-black">
        <!-- Mobile Back Button -->
        <button type="button" @click="step = 1; window.scrollTo({ top: 0, behavior: 'smooth' })" class="lg:hidden flex items-center gap-2 text-sm font-bold text-neutral-400 hover:text-black py-4 transition-colors">
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
          Back to Order Summary
        </button>
        <form method="POST" action="?view=checkout&show=<?= urlencode($showId) ?>" class="space-y-8">
          <input type="hidden" name="checkout_submitted" value="1" />

          <!-- Customer Info -->
          <div>
            <h3 class="text-xl font-bold mb-4 text-black flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#24CECE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Customer Information</h3>
            <div class="grid grid-cols-2 gap-4">
              <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">First Name</label><input required type="text" name="first_name" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">Last Name</label><input required type="text" name="last_name" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">Email</label><input required type="email" name="email" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">Phone</label><input required type="tel" name="phone" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
            </div>
          </div>

          <!-- Payment Info -->
          <div>
            <h3 class="text-xl font-bold mb-4 text-black flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#24CECE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg> Payment Information</h3>
            <div class="space-y-4">
              <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">Card Number</label><input required type="text" name="card" placeholder="0000 0000 0000 0000" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] py-3 px-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">Expiration</label><input required type="text" name="exp" placeholder="MM/YY" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
                <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">CVC</label><input required type="text" name="cvc" placeholder="123" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              </div>
            </div>
          </div>

          <!-- Gift Certificate -->
          <div>
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="checkbox" x-model="giftOpen" @change="if (!giftOpen) { giftInput = ''; giftMsg = ''; giftApplied = false; }" class="w-5 h-5 accent-[#24CECE] cursor-pointer" />
              <h3 class="text-xl font-bold text-black flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#24CECE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8V4"/><path d="M12 12v8"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/></svg> Use Gift Certificate</h3>
            </label>
            <div x-show="giftOpen" x-cloak class="mt-4">
              <div class="flex gap-2">
                <input type="text" x-model="giftInput" name="gift_code" placeholder="Enter certificate code" class="flex-1 bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none placeholder:text-neutral-400" />
                <button type="button" @click="applyGift()" class="px-6 py-3 bg-black text-white font-bold rounded-[5px] hover:bg-neutral-800 transition-colors">Apply</button>
              </div>
              <p x-show="giftMsg" x-text="giftMsg" :class="giftMsgType === 'success' ? 'text-green-600' : 'text-red-500'" class="text-xs mt-2"></p>
            </div>
          </div>

          <!-- You Will Be Charged -->
          <div class="rounded-[5px] p-5 border-2 border-[#24CECE]">
            <div class="flex justify-between items-center">
              <span class="text-sm font-bold text-neutral-600 uppercase tracking-wider">You will be charged</span>
              <span class="text-2xl font-extrabold text-black" x-text="'$' + finalTotal.toFixed(2)"></span>
            </div>
          </div>

          <button type="submit" class="w-full py-4 bg-[#24CECE] text-white font-bold text-lg rounded-[5px] hover:bg-[#20B8B8] transition-colors shadow-lg">Purchase Tickets</button>
          <p class="text-center text-xs text-[#94A0AF] flex justify-center items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> Secure Transaction</p>
        </form>
      </div>
    </div>

  </div>
</div>
<?php endif; ?>
