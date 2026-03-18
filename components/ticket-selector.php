<?php
/**
 * Ticket Selector Component (Alpine.js)
 * Matches original EastVille "Purchase Tickets" card-based UI.
 *
 * Props:
 *   $show      - array with 'id', 'priceValue', etc.
 *   $promoCode - string, promo code from URL
 */
$priceValue = $show['priceValue'];
$isPromoFlat2 = strtoupper($promoCode) === 'EE001';
?>
<div x-data="{
  maxQty: 10,
  promoFlat2: <?= $isPromoFlat2 ? 'true' : 'false' ?>,
  general: { qty: 1, price: <?= $priceValue ?> },
  frontrow: { qty: 0, price: 45 },
  vip: { qty: 0, price: 55 },
  get totalQty() { return this.general.qty + this.frontrow.qty + this.vip.qty; },
  get grandTotal() {
    let total = (this.general.price * 1.10 * this.general.qty) + (this.frontrow.price * 1.10 * this.frontrow.qty) + (this.vip.price * 1.10 * this.vip.qty);
    if (this.promoFlat2) total -= 2 * this.totalQty;
    return Math.max(0, total);
  },
  get checkoutUrl() {
    return '?view=addons&show=<?= urlencode($show['id']) ?>&tickets=general:' + this.general.qty + '|frontrow:' + this.frontrow.qty + '|vip:' + this.vip.qty + '<?= $promoCode ? "&promo=" . urlencode($promoCode) : "" ?>';
  },
  increment(key) {
    if (this[key].qty < this.maxQty) {
      ['general','frontrow','vip'].forEach(k => { if (k !== key) this[k].qty = 0; });
      this[key].qty++;
    }
  },
  decrement(key) {
    if (this[key].qty > 1) this[key].qty--;
  }
}">

  <!-- General Admission -->
  <div class="rounded-[8px] p-5 transition-all duration-200"
       :class="general.qty > 0 ? 'border-2 border-[#24CECE] bg-[#F0FDFD]' : 'border border-neutral-200'">
    <div class="flex items-center justify-between">
      <span class="font-bold text-black text-lg">General Admission</span>
      <span class="text-xl font-black text-black" x-text="'$' + (general.price * 1.10).toFixed(2)"></span>
    </div>
    <div class="flex items-center justify-between mt-1">
      <div>
        <p class="text-sm text-neutral-400" x-text="'$' + general.price.toFixed(2) + ' + $' + (general.price * 0.10).toFixed(2) + ' Service Fee'"></p>
        <p class="text-sm text-neutral-400">Standard seating</p>
      </div>
      <div class="inline-flex items-center border border-neutral-200 rounded-[8px] overflow-hidden shrink-0 ml-4">
        <button @click="decrement('general')" class="w-10 h-10 flex items-center justify-center text-neutral-500 hover:bg-neutral-100 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
        </button>
        <span class="w-12 text-center font-bold text-lg text-black border-l border-r border-neutral-200" x-text="general.qty"></span>
        <button @click="increment('general')" class="w-10 h-10 flex items-center justify-center text-neutral-500 hover:bg-neutral-100 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Front Row Seats -->
  <div class="rounded-[8px] p-5 transition-all duration-200 mt-4"
       :class="frontrow.qty > 0 ? 'border-2 border-[#24CECE] bg-[#F0FDFD]' : 'border border-neutral-200'">
    <div class="flex items-center justify-between">
      <span class="font-bold text-black text-lg">Front Row Seats</span>
      <span class="text-xl font-black text-black">$49.50</span>
    </div>
    <div class="flex items-center justify-between mt-1">
      <div>
        <p class="text-sm text-neutral-400">$45.00 + $4.50 Service Fee</p>
        <p class="text-sm text-neutral-400">Guaranteed front row seating</p>
      </div>
      <div class="inline-flex items-center border border-neutral-200 rounded-[8px] overflow-hidden shrink-0 ml-4">
        <button @click="decrement('frontrow')" class="w-10 h-10 flex items-center justify-center text-neutral-500 hover:bg-neutral-100 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
        </button>
        <span class="w-12 text-center font-bold text-lg text-black border-l border-r border-neutral-200" x-text="frontrow.qty"></span>
        <button @click="increment('frontrow')" class="w-10 h-10 flex items-center justify-center text-neutral-500 hover:bg-neutral-100 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Gold Front Row VIP -->
  <div class="rounded-[8px] p-5 transition-all duration-200 mt-4"
       :class="vip.qty > 0 ? 'border-2 border-[#24CECE] bg-[#F0FDFD]' : 'border border-neutral-200'">
    <div class="flex items-center justify-between">
      <span class="font-bold text-black text-lg">Gold Front Row VIP</span>
      <span class="text-xl font-black text-black">$60.50</span>
    </div>
    <div class="flex items-center justify-between mt-1">
      <div>
        <p class="text-sm text-neutral-400">$55.00 + $5.50 Service Fee</p>
        <p class="text-sm text-neutral-400">VIP front row with priority check-in</p>
      </div>
      <div class="inline-flex items-center border border-neutral-200 rounded-[8px] overflow-hidden shrink-0 ml-4">
        <button @click="decrement('vip')" class="w-10 h-10 flex items-center justify-center text-neutral-500 hover:bg-neutral-100 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
        </button>
        <span class="w-12 text-center font-bold text-lg text-black border-l border-r border-neutral-200" x-text="vip.qty"></span>
        <button @click="increment('vip')" class="w-10 h-10 flex items-center justify-center text-neutral-500 hover:bg-neutral-100 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Promo Discount Row -->
  <template x-if="promoFlat2">
    <div class="flex items-center justify-between text-sm text-green-600 px-1 mt-4">
      <span x-text="'Promo EE001 ($2 x ' + totalQty + ')'"></span>
      <span x-text="'-$' + (2 * totalQty).toFixed(2)"></span>
    </div>
  </template>

  <!-- Grand Total -->
  <div class="border-t border-neutral-200 pt-4 mt-4">
    <div class="flex items-center justify-between">
      <span class="text-lg font-black text-black uppercase">Total</span>
      <span class="text-2xl font-black text-black" x-text="'$' + grandTotal.toFixed(2)"></span>
    </div>
  </div>

  <!-- Promo banner or note -->
  <?php if ($isPromoFlat2): ?>
  <div class="bg-[#F26522]/10 border border-[#F26522] rounded-[8px] p-3 text-center mt-4">
    <p class="text-[#F26522] font-bold text-sm">
      <i data-lucide="sparkles" class="w-4 h-4 inline-block align-middle mr-1"></i>
      Promo EE001 applied &mdash; $2 off per ticket!
    </p>
  </div>
  <?php else: ?>
  <p class="text-xs text-neutral-400 text-center mt-4">* Promo codes can be added in the next step</p>
  <?php endif; ?>

  <!-- Checkout Button -->
  <a :href="checkoutUrl" class="block w-full py-4 bg-[#24CECE] text-black font-black text-base uppercase tracking-wider rounded-[8px] hover:bg-[#20B8B8] transition-colors text-center mt-4">Checkout</a>

</div>
