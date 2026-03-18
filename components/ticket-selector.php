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
  tickets: {
    general: { key: 'general', name: 'General Admission', desc: 'Standard seating', price: <?= $priceValue ?>, qty: 1 },
    frontrow: { key: 'frontrow', name: 'Front Row Seats', desc: 'Guaranteed front row seating', price: 45, qty: 0 },
    vip: { key: 'vip', name: 'Gold Front Row VIP', desc: 'VIP front row with priority check-in', price: 55, qty: 0 }
  },
  get totalQty() { return Object.values(this.tickets).reduce((s, t) => s + t.qty, 0); },
  get grandTotal() {
    let total = Object.values(this.tickets).reduce((s, t) => s + (t.price * 1.10 * t.qty), 0);
    if (this.promoFlat2) total -= 2 * this.totalQty;
    return Math.max(0, total);
  },
  get checkoutUrl() {
    let parts = Object.entries(this.tickets).map(([k, t]) => k + ':' + t.qty);
    return '?view=addons&show=<?= urlencode($show['id']) ?>&tickets=' + parts.join('|') + '<?= $promoCode ? "&promo=" . urlencode($promoCode) : "" ?>';
  },
  increment(key) {
    if (this.tickets[key].qty < this.maxQty) {
      // Reset all other types to 0
      Object.keys(this.tickets).forEach(k => { if (k !== key) this.tickets[k].qty = 0; });
      this.tickets[key].qty++;
    }
  },
  decrement(key) {
    if (this.tickets[key].qty > 1) this.tickets[key].qty--;
  }
}" x-init="$nextTick(() => { if (typeof lucide !== 'undefined') lucide.createIcons() })">

  <!-- Ticket cards -->
  <template x-for="[key, t] in Object.entries(tickets)" :key="key">
    <div class="rounded-[8px] p-5 transition-all duration-200 mb-4"
         :class="t.qty > 0 ? 'border-2 border-[#24CECE] bg-[#F0FDFD]' : 'border border-neutral-200'">
      <div class="flex items-center justify-between">
        <span class="font-bold text-black text-lg" x-text="t.name"></span>
        <span class="text-xl font-black text-black" x-text="'$' + (t.price * 1.10).toFixed(2)"></span>
      </div>
      <div class="flex items-center justify-between mt-1">
        <div>
          <p class="text-sm text-neutral-400" x-text="'$' + t.price.toFixed(2) + ' + $' + (t.price * 0.10).toFixed(2) + ' Service Fee'"></p>
          <p class="text-sm text-neutral-400" x-text="t.desc"></p>
        </div>
        <div class="inline-flex items-center border border-neutral-200 rounded-[8px] overflow-hidden shrink-0 ml-4">
          <button @click="decrement(key)" class="w-10 h-10 flex items-center justify-center text-neutral-500 hover:bg-neutral-100 transition-colors">
            <i data-lucide="minus" class="w-4 h-4"></i>
          </button>
          <span class="w-12 text-center font-bold text-lg text-black border-l border-r border-neutral-200" x-text="t.qty"></span>
          <button @click="increment(key)" class="w-10 h-10 flex items-center justify-center text-neutral-500 hover:bg-neutral-100 transition-colors">
            <i data-lucide="plus" class="w-4 h-4"></i>
          </button>
        </div>
      </div>
    </div>
  </template>

  <!-- Promo Discount Row -->
  <template x-if="promoFlat2">
    <div class="flex items-center justify-between text-sm text-green-600 px-1">
      <span x-text="'Promo EE001 ($2 x ' + totalQty + ')'"></span>
      <span x-text="'-$' + (2 * totalQty).toFixed(2)"></span>
    </div>
  </template>

  <!-- Grand Total -->
  <div class="border-t border-neutral-200 pt-4">
    <div class="flex items-center justify-between">
      <span class="text-lg font-black text-black uppercase">Total</span>
      <span class="text-2xl font-black text-black" x-text="'$' + grandTotal.toFixed(2)"></span>
    </div>
  </div>

  <!-- Promo banner or note -->
  <template x-if="promoFlat2">
    <div class="bg-[#F26522]/10 border border-[#F26522] rounded-[8px] p-3 text-center">
      <p class="text-[#F26522] font-bold text-sm">
        <i data-lucide="sparkles" class="w-4 h-4 inline-block align-middle mr-1"></i>
        Promo EE001 applied — $2 off per ticket!
      </p>
    </div>
  </template>
  <template x-if="!promoFlat2">
    <p class="text-xs text-neutral-400 text-center">* Promo codes can be added in the next step</p>
  </template>

  <!-- Checkout Button -->
  <a :href="checkoutUrl" class="block w-full py-4 bg-[#24CECE] text-black font-black text-base uppercase tracking-wider rounded-[8px] hover:bg-[#20B8B8] transition-colors text-center">Checkout</a>
</div>
