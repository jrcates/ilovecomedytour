<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen">

  <!-- ─── Header ─── -->
  <div class="relative mb-10 md:mb-20">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[280px] font-black text-white/[0.04] select-none leading-none pointer-events-none">26</span>
    <div class="inline-flex mb-5 md:mb-0 md:absolute md:top-0 md:right-12 -rotate-[5deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2 border-2 border-black" style="box-shadow: 4px 4px 0 #000;">
      Live &amp; In Person
    </div>
    <h1 class="relative text-5xl md:text-7xl lg:text-8xl font-extrabold tracking-tight leading-[0.9]">Tour Dates.</h1>
    <p class="relative mt-6 md:mt-8 text-neutral-400 text-base md:text-lg max-w-lg">
      New cities added throughout the year. Tickets go fast — low and sold-out dates are called out below.
    </p>
  </div>

  <?php component('tour-dates', ['shows' => $shows]); ?>

</div>
