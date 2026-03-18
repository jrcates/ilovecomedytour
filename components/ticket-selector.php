<?php
/**
 * Ticket Selector Component (Alpine.js)
 *
 * Props:
 *   $show      - array with 'id', 'priceValue', etc.
 *   $promoCode - string, promo code from URL
 */
?>
<div x-data="{
  tickets: {
    general: { qty: 1, price: <?= $show['priceValue'] ?>, name: 'General Admission' },
    frontrow: { qty: 0, price: 45, name: 'Front Row Seats' },
    vip: { qty: 0, price: 55, name: 'Gold Front Row VIP' }
  },
  promoCode: '<?= htmlspecialchars($promoCode) ?>',
  get promoDiscount() { return this.promoCode.toUpperCase() === 'EE001' ? 2 : 0; },
  get totalQty() { return Object.values(this.tickets).reduce((sum, t) => sum + t.qty, 0); },
  get subtotal() {
    return Object.values(this.tickets).reduce((sum, t) => sum + (t.qty * (t.price - this.promoDiscount)), 0);
  },
  get checkoutUrl() {
    let parts = Object.entries(this.tickets).filter(([k, t]) => t.qty > 0).map(([k, t]) => k + ':' + t.qty);
    let url = '?view=addons&show=<?= urlencode($show['id']) ?>&tickets=' + parts.join('|');
    if (this.promoCode) url += '&promo=' + this.promoCode;
    return url;
  }
}">
  <!-- Ticket types -->
  <template x-for="[key, ticket] in Object.entries(tickets)" :key="key">
    <div class="flex items-center justify-between py-4 border-b border-neutral-200">
      <div>
        <div class="font-bold text-black" x-text="ticket.name"></div>
        <div class="text-neutral-500 text-sm">$<span x-text="ticket.price"></span> per ticket</div>
      </div>
      <div class="flex items-center gap-3">
        <button @click="ticket.qty = Math.max(0, ticket.qty - 1)" class="w-8 h-8 rounded-full bg-neutral-200 flex items-center justify-center text-black font-bold hover:bg-neutral-300">-</button>
        <span x-text="ticket.qty" class="w-8 text-center font-bold text-black"></span>
        <button @click="ticket.qty++" class="w-8 h-8 rounded-full bg-[#24CECE] flex items-center justify-center text-black font-bold hover:bg-[#20B8B8]">+</button>
      </div>
    </div>
  </template>

  <!-- Promo discount note -->
  <template x-if="promoDiscount > 0">
    <div class="mt-4 p-3 bg-green-50 rounded-[5px] text-green-700 text-sm font-medium">
      Promo code applied: $<span x-text="promoDiscount"></span> off per ticket
    </div>
  </template>

  <!-- Subtotal + Get Tickets button -->
  <div class="mt-6 pt-4 border-t border-neutral-200">
    <div class="flex justify-between items-center mb-4">
      <span class="font-bold text-black text-lg">Subtotal</span>
      <span class="font-black text-black text-2xl">$<span x-text="subtotal.toFixed(2)"></span></span>
    </div>
    <a :href="checkoutUrl" class="block w-full text-center px-8 py-4 bg-[#24CECE] text-black font-bold rounded-full hover:bg-[#20B8B8] transition-colors text-lg"
       x-show="totalQty > 0">
      Get Tickets
    </a>
  </div>
</div>
