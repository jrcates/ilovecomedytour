<?php
$showId = isset($_GET['show']) ? $_GET['show'] : null;
$promoCode = isset($_GET['promo']) ? preg_replace('/[^A-Za-z0-9]/', '', $_GET['promo']) : '';
$show = null;

foreach ($shows as $s) {
  if ($s['id'] === $showId) {
    $show = $s;
    break;
  }
}

// Parse ticket types from URL: tickets=general:1|frontrow:0|vip:0
$ticketPrices = [
  'general'  => $show ? $show['priceValue'] : 15,
  'frontrow' => 45,
  'vip'      => 55,
];
$ticketData = [];
$ticketsParam = isset($_GET['tickets']) ? $_GET['tickets'] : 'general:1';
foreach (explode('|', $ticketsParam) as $part) {
  $pieces = explode(':', $part);
  if (count($pieces) === 2 && isset($ticketPrices[$pieces[0]])) {
    $ticketData[$pieces[0]] = max(0, intval($pieces[1]));
  }
}
if (empty($ticketData)) {
  $ticketData['general'] = 1;
}

$ticketSubtotal = 0;
foreach ($ticketData as $key => $qty) {
  $ticketSubtotal += $ticketPrices[$key] * $qty;
}
?>

<div class="pt-[140px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen" x-data="{
  addons: {
    nachos: { name: 'Loaded Nachos', price: 12, qty: 0, img: 'assets/beers.jpg' },
    wings: { name: 'Buffalo Wings', price: 14, qty: 0, img: 'assets/specialty-cocktail.jpg' },
    sliders: { name: 'Mini Sliders', price: 15, qty: 0, img: 'assets/non-alcoholic.jpg' },
    fries: { name: 'Truffle Fries', price: 10, qty: 0, img: 'assets/beers.jpg' },
    water: { name: 'Premium Water', price: 5, qty: 0, img: 'assets/non-alcoholic.jpg' },
    cocktail: { name: 'Signature Cocktail', price: 16, qty: 0, img: 'assets/specialty-cocktail.jpg' }
  },
  get total() { return Object.values(this.addons).reduce((s, a) => s + a.price * a.qty, 0); },
  get selectedItems() { return Object.values(this.addons).filter(a => a.qty > 0); },
  buildUrl() {
    let items = Object.values(this.addons).filter(a => a.qty > 0).map(a => a.name + ':' + a.qty + ':' + a.price).join('|');
    let url = '?view=checkout&show=<?= urlencode($showId) ?>&tickets=<?= urlencode($ticketsParam) ?>&promo=<?= urlencode($promoCode) ?>&addons=' + this.total;
    if (items) url += '&addon_items=' + encodeURIComponent(items);
    return url;
  }
}">

  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
    <div>
      <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight">ENHANCE YOUR NIGHT</h1>
      <p class="text-neutral-400 text-base mt-2">Add food &amp; drinks to your order — or skip ahead to complete your purchase.</p>
    </div>
    <a href="?view=event&show=<?= urlencode($showId) ?><?= $promoCode ? '&promo=' . urlencode($promoCode) : '' ?>" class="flex items-center gap-2 text-sm font-bold text-neutral-400 hover:text-white bg-neutral-900 hover:bg-neutral-800 px-5 py-3 rounded-[5px] transition-all border border-neutral-800 whitespace-nowrap">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Back to Event
    </a>
  </div>

  <div class="border-b border-neutral-800 mb-10"></div>

  <!-- Two Column Layout -->
  <div class="grid lg:grid-cols-12 gap-10">

    <!-- Left: Add-on Items -->
    <div class="lg:col-span-7 space-y-4">
      <template x-for="[key, addon] in Object.entries(addons)" :key="key">
        <div class="cc-addon-card bg-neutral-900 rounded-[8px] border border-neutral-800 overflow-hidden">
          <!-- Addon Image -->
          <div class="w-full h-40 overflow-hidden">
            <img :src="addon.img" :alt="addon.name" class="w-full h-full object-cover" />
          </div>
          <!-- Content -->
          <div class="p-6">
            <div class="flex items-start justify-between gap-4 mb-2">
              <h3 class="text-base font-bold text-white" x-text="addon.name"></h3>
              <span class="text-[#24CECE] font-bold text-base whitespace-nowrap">$<span x-text="addon.price"></span></span>
            </div>
            <!-- Quantity Controls -->
            <div class="flex items-center gap-3 mt-4">
              <button @click="addon.qty = Math.max(0, addon.qty - 1)" class="cc-addon-minus w-8 h-8 rounded-[6px] bg-neutral-800 flex items-center justify-center text-neutral-500 hover:bg-neutral-700 hover:text-white transition-colors">
                <i data-lucide="minus" class="w-4 h-4"></i>
              </button>
              <span x-text="addon.qty" class="cc-addon-qty text-base font-bold text-white w-6 text-center"></span>
              <button @click="addon.qty++" class="cc-addon-plus w-8 h-8 rounded-[6px] bg-[#24CECE] flex items-center justify-center text-black hover:bg-[#20B8B8] transition-colors">
                <i data-lucide="plus" class="w-4 h-4"></i>
              </button>
            </div>
          </div>
        </div>
      </template>
    </div>

    <!-- Right: Order Summary -->
    <div class="lg:col-span-5">
      <div class="bg-white p-8 rounded-[10px] shadow-xl sticky top-32 text-black space-y-6">

        <h2 class="text-xl font-black text-black flex items-center gap-2">
          <i data-lucide="circle-check" class="w-5 h-5 text-neutral-500"></i>
          Order Summary
        </h2>

        <p x-show="selectedItems.length === 0" class="text-sm text-neutral-400 italic">No add-ons selected yet.</p>

        <!-- Summary Line Items -->
        <div x-show="selectedItems.length > 0" class="space-y-2">
          <template x-for="item in selectedItems" :key="item.name">
            <div class="flex justify-between text-sm">
              <span class="text-neutral-600" x-text="item.name + ' x' + item.qty"></span>
              <span class="text-neutral-800 font-medium" x-text="'$' + (item.price * item.qty).toFixed(2)"></span>
            </div>
          </template>
        </div>

        <!-- Totals -->
        <div class="border border-neutral-200 rounded-[8px] p-4 space-y-3">
          <div class="flex justify-between text-sm text-neutral-500">
            <span>Add-ons Subtotal</span>
            <span x-text="'$' + total.toFixed(2)"></span>
          </div>
          <div class="flex justify-between text-base font-bold text-black">
            <span>Add-ons Total</span>
            <span class="text-black" x-text="'$' + total.toFixed(2)"></span>
          </div>
        </div>

        <!-- Continue to Checkout -->
        <a :href="buildUrl()" class="block w-full py-4 bg-[#24CECE] text-black font-black text-base uppercase tracking-wider rounded-[8px] hover:bg-[#20B8B8] transition-colors text-center">Continue to Checkout</a>

        <p class="text-xs text-neutral-400 text-center flex items-center justify-center gap-1.5">
          <i data-lucide="lock" class="w-3.5 h-3.5"></i>
          Secure Transaction
        </p>

      </div>
    </div>

  </div>
</div>
