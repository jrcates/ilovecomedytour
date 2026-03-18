<?php
// Filter shows that have promo pricing
$promoShows = $shows; // All shows eligible for promo in template

$showsByDate = [];
foreach ($promoShows as $show) {
  $dateKey = date('Y-m-d', strtotime($show['date']));
  $showsByDate[$dateKey][] = $show;
}
$showDatesJson = json_encode(array_keys($showsByDate));
?>

<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen">
  <?php component('page-header', ['title' => 'Promo Dates', 'description' => 'Use code EE001 for $2 off every ticket!', 'centered' => true]); ?>

  <!-- Promo code banner -->
  <div class="mb-8 p-6 bg-[#F26522]/10 border border-[#F26522]/30 rounded-[5px] text-center">
    <p class="text-white font-bold text-lg">Discount Code: <span class="text-[#F26522] font-black text-2xl">EE001</span></p>
    <p class="text-neutral-400 text-sm mt-2">$2 off every ticket — applied automatically at checkout</p>
  </div>

  <?php component('calendar-filter', ['shows' => $promoShows, 'showDatesJson' => $showDatesJson]); ?>
</div>
