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

$addons = [
  [
    'key'   => 'drink_voucher',
    'name'  => '2-Drink Voucher',
    'price' => 18,
    'desc'  => 'Skip the line — two drinks of your choice, redeemable at the bar anytime during the show.',
    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 22h8"/><path d="M7 10h10"/><path d="M12 15v7"/><path d="M12 15a5 5 0 0 0 5-5c0-2-.5-4-2-8H9c-1.5 4-2 6-2 8a5 5 0 0 0 5 5Z"/></svg>',
  ],
  [
    'key'   => 'cocktail_pack',
    'name'  => 'Premium Cocktail Pack',
    'price' => 45,
    'desc'  => '4 handcrafted cocktails for your group. Choose from our signature menu on arrival.',
    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg>',
  ],
  [
    'key'   => 'bottle_service',
    'name'  => 'Bottle Service',
    'price' => 120,
    'desc'  => 'A full bottle of your choice (vodka, tequila, or whiskey) with mixers and a dedicated server.',
    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 11h1a3 3 0 0 1 0 6h-1"/><path d="M9 12v6"/><path d="M13 12v6"/><path d="M14 7.5c-1 0-1.44.5-3 .5s-2-.5-3-.5-1.72.5-2.5.5a2.5 2.5 0 0 1 0-5c.78 0 1.57.5 2.5.5S9.44 3 11 3s2 .5 3 .5 1.72-.5 2.5-.5a2.5 2.5 0 0 1 0 5c-.78 0-1.5-.5-2.5-.5Z"/><path d="M5 8v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V8"/></svg>',
  ],
  [
    'key'   => 'snack_platter',
    'name'  => 'Snack Platter for 2',
    'price' => 22,
    'desc'  => 'A curated spread of our best bites — wings, sliders, and loaded nachos.',
    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/><path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/></svg>',
  ],
  [
    'key'   => 'date_night',
    'name'  => 'Date Night Bundle',
    'price' => 35,
    'desc'  => '2 signature cocktails + a shareable snack platter. The perfect combo for two.',
    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>',
  ],
];
?>

<div class="pt-[140px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen" x-data="{
  addons: {
    <?php foreach ($addons as $addon): ?>
    <?= $addon['key'] ?>: { name: '<?= $addon['name'] ?>', price: <?= $addon['price'] ?>, qty: 0 },
    <?php endforeach; ?>
  },
  get total() { return Object.values(this.addons).reduce((s, a) => s + a.price * a.qty, 0); },
  get selectedItems() { return Object.values(this.addons).filter(a => a.qty > 0); },
  get checkoutUrl() {
    let items = Object.values(this.addons).filter(a => a.qty > 0).map(a => a.name + ':' + a.qty + ':' + a.price).join('|');
    let url = '?view=checkout&show=<?= urlencode($showId) ?>&tickets=<?= urlencode($ticketsParam) ?>&addons=' + this.total;
    if (items) url += '&addon_items=' + encodeURIComponent(items);
    url += '<?= $promoCode ? "&promo=" . urlencode($promoCode) : "" ?>';
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
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
      Back to Event
    </a>
  </div>

  <div class="border-b border-neutral-800 mb-10"></div>

  <!-- Two Column Layout -->
  <div class="grid lg:grid-cols-12 gap-10">

    <!-- Left: Add-on Items -->
    <div class="lg:col-span-7 space-y-4">
      <?php foreach ($addons as $addon): ?>
      <div class="bg-neutral-900 rounded-[8px] border border-neutral-800 p-6">
        <div class="flex items-start gap-4">
          <!-- Icon -->
          <div class="w-12 h-12 rounded-full bg-neutral-800 flex items-center justify-center text-neutral-400 shrink-0">
            <?= $addon['icon'] ?>
          </div>
          <!-- Content -->
          <div class="flex-1">
            <div class="flex items-start justify-between gap-4 mb-2">
              <h3 class="text-base font-bold text-white"><?= htmlspecialchars($addon['name']) ?></h3>
              <span class="text-[#24CECE] font-bold text-base whitespace-nowrap">$<?= $addon['price'] ?></span>
            </div>
            <p class="text-neutral-500 text-sm leading-relaxed mb-4"><?= htmlspecialchars($addon['desc']) ?></p>
            <!-- Quantity Controls -->
            <div class="flex items-center gap-3">
              <button @click="addons.<?= $addon['key'] ?>.qty = Math.max(0, addons.<?= $addon['key'] ?>.qty - 1)" class="w-8 h-8 rounded-[6px] bg-neutral-800 flex items-center justify-center text-neutral-500 hover:bg-neutral-700 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
              </button>
              <span x-text="addons.<?= $addon['key'] ?>.qty" class="text-base font-bold text-white w-6 text-center"></span>
              <button @click="addons.<?= $addon['key'] ?>.qty = Math.min(10, addons.<?= $addon['key'] ?>.qty + 1)" class="w-8 h-8 rounded-[6px] bg-[#24CECE] flex items-center justify-center text-black hover:bg-[#20B8B8] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Right: Order Summary -->
    <div class="lg:col-span-5">
      <div class="bg-white p-8 rounded-[10px] shadow-xl sticky top-32 text-black space-y-6">

        <h2 class="text-xl font-black text-black flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-neutral-500"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
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
        <a :href="checkoutUrl" class="block w-full py-4 bg-[#24CECE] text-black font-black text-base uppercase tracking-wider rounded-[8px] hover:bg-[#20B8B8] transition-colors text-center">Continue to Checkout</a>

        <p class="text-xs text-neutral-400 text-center flex items-center justify-center gap-1.5">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          Secure Transaction
        </p>

      </div>
    </div>

  </div>
</div>
