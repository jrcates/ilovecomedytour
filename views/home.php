<?php
$heroSlides = [
  ['image' => 'assets/rc-img1.jpg', 'href' => '?view=calendar'],
  ['image' => 'assets/rc-img2.jpg', 'href' => 'https://www.netflix.com/title/81267396'],
  ['image' => 'assets/rc-img3.jpg', 'href' => 'https://www.netflix.com/title/81267202'],
  ['image' => 'assets/rc-img4.jpg', 'href' => 'https://www.netflix.com/title/81070659'],
];
// Home shows the same full list as the calendar page
$upcomingShows = $shows;
?>

<div class="-mt-[110px] md:-mt-[80px] text-neutral-100 bg-black relative">
  <?php component('carousel', ['slides' => $heroSlides]); ?>
</div>

<section class="max-w-[1400px] mx-auto px-4 md:px-6 py-12 md:py-20">

  <!-- ─── Header ─── -->
  <div class="relative mb-10 md:mb-20">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[260px] font-black text-white/[0.04] select-none leading-none pointer-events-none tracking-tight">NOW</span>
    <div class="inline-flex mb-5 md:mb-0 md:absolute md:top-0 md:right-12 rotate-[4deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2 border-2 border-black" style="box-shadow: 4px 4px 0 #000;">
      On Sale Now
    </div>
    <h1 class="relative text-5xl md:text-7xl lg:text-8xl font-extrabold tracking-tight leading-[0.9]">Upcoming Shows.</h1>
    <p class="relative mt-6 md:mt-8 text-neutral-400 text-base md:text-lg max-w-lg">
      The next cities on the list. Grab a seat before your friends do.
    </p>
  </div>

  <?php component('tour-dates', ['shows' => $upcomingShows]); ?>
</section>
