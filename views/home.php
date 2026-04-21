<!-- ─── Hero ─── -->
<section class="cc-hero-gradient relative overflow-hidden -mt-[84px] md:-mt-[96px]">

  <div class="max-w-[1400px] mx-auto px-6 md:px-10 w-full min-h-[620px] md:min-h-[920px] grid md:grid-cols-12 gap-8 md:gap-12 items-center pt-28 md:pt-64 pb-16 md:pb-40">

    <!-- Left: text -->
    <div class="md:col-span-7 relative z-10">
      <div class="cc-sticker-sm gap-2 bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.3em] px-4 py-2 -rotate-1 mb-7">
        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
        A Walking Tour of NYC
      </div>

      <h1 class="text-white font-extrabold text-[11vw] sm:text-[9vw] md:text-[6vw] lg:text-[5.5rem] xl:text-[6.5rem] leading-[0.88] tracking-tight mb-8">
        I Love<br>
        Comedy<br>
        <span class="text-[#f9dda9]">Tour.</span>
      </h1>

      <p class="text-base md:text-lg text-white/80 mb-10 max-w-md leading-relaxed">
        Two hours, twelve venues, a hundred years of comedy history — walked through the streets of Manhattan.
      </p>

      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 md:gap-6">
        <a href="?view=tour&tour=ilct-nyc" class="cc-btn-primary text-xs md:text-sm px-8 md:px-10 py-4 tracking-[0.25em]">
          Book a Tour
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
        <a href="?view=about" class="inline-flex items-center gap-2 text-[11px] md:text-xs font-extrabold uppercase tracking-[0.25em] text-white/80 hover:text-white transition-colors">
          Learn More
          <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>

    <!-- Right: mascot -->
    <div class="md:col-span-5 flex justify-center md:justify-end">
      <div class="relative">
        <div aria-hidden="true" class="absolute inset-0 bg-[#f9dda9]/25 blur-[80px] rounded-full"></div>
        <img src="assets/ilct-logo.png" alt="I Love Comedy"
             class="cc-mascot-float relative w-[280px] sm:w-[360px] md:w-[380px] lg:w-[460px] xl:w-[540px] h-auto drop-shadow-[0_25px_60px_rgba(0,0,0,0.45)]" />
      </div>
    </div>

  </div>

  <!-- Bottom meta strip -->
  <div class="relative border-t border-white/10 bg-black/25 backdrop-blur-sm">
    <div class="max-w-[1400px] mx-auto px-6 md:px-10 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-[10px] font-extrabold uppercase tracking-[0.3em] text-white/60">
      <span>Thu · Fri · Sat · Sun · Greenwich Village · ~2hr</span>
      <span class="hidden sm:inline">est. 2024 · NYC</span>
    </div>
  </div>
</section>

<!-- ─── Upcoming Dates ─── -->
<section class="max-w-[1400px] mx-auto px-4 md:px-6 py-14 md:py-24">

  <!-- Editorial header -->
  <div class="relative mb-10 md:mb-16">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[260px] font-black text-black/[0.04] select-none leading-none pointer-events-none tracking-tight">NEXT</span>
    <div class="cc-sticker mb-5 md:mb-0 md:absolute md:top-0 md:right-12 rotate-[4deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2">
      On Sale Now
    </div>
    <p class="relative text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-4">Upcoming Tours</p>
    <h2 class="relative text-5xl md:text-7xl lg:text-8xl font-extrabold tracking-tight leading-[0.9] text-neutral-900">Grab a spot.</h2>
    <p class="relative mt-6 md:mt-8 text-neutral-600 text-base md:text-lg max-w-lg">
      Pick from the next few dates. Each tour runs rain or shine and wraps up at the Grisly Pear with a live stand-up show.
    </p>
  </div>

  <!-- List -->
  <?php component('tour-list', ['limit' => 5]); ?>

  <!-- See all CTA -->
  <div class="mt-10 md:mt-14 flex justify-center">
    <a href="?view=tour" class="cc-btn-primary text-xs md:text-sm px-8 md:px-10 py-4 tracking-[0.25em]">
      See Full Calendar
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </a>
  </div>

</section>

