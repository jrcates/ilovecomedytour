<?php
/**
 * Cart Summary Component (server-rendered)
 *
 * Props:
 *   $ticketItems - array of ['name' => string, 'price' => float, 'qty' => int]
 *   $addonItems  - array of ['name' => string, 'price' => float, 'qty' => int]
 *   $show        - array with 'title', 'date', 'location', etc.
 *   $promoCode   - string, promo code
 */

$isPromo = strtoupper($promoCode) === 'EE001';
$ticketSubtotal = 0;
$totalQty = 0;
foreach ($ticketItems as $item) {
  $ticketSubtotal += $item['price'] * $item['qty'];
  $totalQty += $item['qty'];
}
$promoDiscount = $isPromo ? ($totalQty * 2) : 0;
$addonTotal = 0;
foreach ($addonItems as $item) {
  $addonTotal += $item['price'] * $item['qty'];
}
$serviceFee = $totalQty * 2.50;
$grandTotal = $ticketSubtotal - $promoDiscount + $addonTotal + $serviceFee;
$d = formatShowDate($show['date']);
?>
<div class="bg-white rounded-[10px] p-8 text-black">

  <!-- Show Info -->
  <div class="mb-6 pb-6 border-b border-neutral-200">
    <h3 class="text-xl font-bold tracking-tight text-black mb-2"><?= htmlspecialchars($show['title']) ?></h3>
    <div class="text-sm text-neutral-500">
      <?= $d['weekday'] ?>, <?= $d['month'] ?> <?= $d['day'] ?> &middot; <?= $d['time'] ?>
    </div>
    <div class="text-sm text-neutral-500"><?= htmlspecialchars($show['location'] ?? 'Comedy Club') ?></div>
  </div>

  <!-- Ticket Line Items -->
  <?php foreach ($ticketItems as $item): ?>
  <div class="flex items-center justify-between py-3">
    <div>
      <div class="font-bold text-black"><?= htmlspecialchars($item['name']) ?></div>
      <div class="text-xs text-neutral-400"><?= $item['qty'] ?> x $<?= number_format($item['price'], 2) ?></div>
    </div>
    <span class="cc-dotted-line"></span>
    <span class="font-bold text-black">$<?= number_format($item['price'] * $item['qty'], 2) ?></span>
  </div>
  <?php endforeach; ?>

  <!-- Addon Line Items -->
  <?php if (!empty($addonItems)): ?>
  <div class="border-t border-neutral-200 mt-2 pt-2">
    <?php foreach ($addonItems as $item): ?>
    <div class="flex items-center justify-between py-3">
      <div>
        <div class="font-bold text-black"><?= htmlspecialchars($item['name']) ?></div>
        <div class="text-xs text-neutral-400"><?= $item['qty'] ?> x $<?= number_format($item['price'], 2) ?></div>
      </div>
      <span class="cc-dotted-line"></span>
      <span class="font-bold text-black">$<?= number_format($item['price'] * $item['qty'], 2) ?></span>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <!-- Promo Discount -->
  <?php if ($isPromo): ?>
  <div class="flex items-center justify-between py-3 text-green-600">
    <span class="text-sm font-medium">Promo EE001 ($2 x <?= $totalQty ?>)</span>
    <span class="cc-dotted-line"></span>
    <span class="font-bold">-$<?= number_format($promoDiscount, 2) ?></span>
  </div>
  <?php endif; ?>

  <!-- Service Fee -->
  <div class="flex items-center justify-between py-3 text-neutral-500">
    <span class="text-sm">Service Fee ($2.50 x <?= $totalQty ?>)</span>
    <span class="cc-dotted-line"></span>
    <span class="text-sm font-medium">$<?= number_format($serviceFee, 2) ?></span>
  </div>

  <!-- Grand Total -->
  <div class="border-t-2 border-neutral-200 mt-4 pt-4">
    <div class="flex items-center justify-between">
      <span class="text-lg font-bold uppercase text-black">Total</span>
      <span class="text-2xl font-bold text-black">$<?= number_format($grandTotal, 2) ?></span>
    </div>
  </div>

</div>
