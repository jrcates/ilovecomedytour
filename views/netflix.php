<?php
$specials = [
  [
    'num'   => '01',
    'title' => 'Love to Hate It',
    'year'  => 2024,
    'runtime' => '1h 1m',
    'tagline' => 'His latest — sharper, angrier, funnier.',
    'image' => 'assets/rc-img2.jpg',
    'href'  => 'https://www.netflix.com/title/81267396',
  ],
  [
    'num'   => '02',
    'title' => 'Speakeasy',
    'year'  => 2022,
    'runtime' => '55m',
    'tagline' => 'Unscripted. Unfiltered. Unforgettable.',
    'image' => 'assets/rc-img3.jpg',
    'href'  => 'https://www.netflix.com/title/81267202',
  ],
  [
    'num'   => '03',
    'title' => 'Asian Comedian Destroys America!',
    'year'  => 2019,
    'runtime' => '1h 2m',
    'tagline' => 'The one that started it all.',
    'image' => 'assets/rc-img4.jpg',
    'href'  => 'https://www.netflix.com/title/81070659',
  ],
];
?>

<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen">

  <!-- ─── Header ─── -->
  <div class="relative mb-10 md:mb-20">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[280px] font-black text-white/[0.04] select-none leading-none pointer-events-none tracking-tight">N</span>
    <div class="inline-flex mb-5 md:mb-0 md:absolute md:top-0 md:right-12 -rotate-[4deg] bg-[#e50914] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2 border-2 border-black" style="box-shadow: 4px 4px 0 #000;">
      Now Streaming
    </div>
    <h1 class="relative text-5xl md:text-7xl lg:text-8xl font-extrabold tracking-tight leading-[0.9]">Netflix.</h1>
    <p class="relative mt-6 md:mt-8 text-neutral-400 text-base md:text-lg max-w-xl">
      Three specials, one angry guy with a mic. Pour a drink, hit play, and ignore your group chat for an hour.
    </p>
  </div>

  <!-- ─── Specials Stack ─── -->
  <section class="flex flex-col gap-12 md:gap-20">
    <?php foreach ($specials as $i => $s):
      $flip = ($i % 2 === 1); // alternate sides
    ?>
    <article class="grid grid-cols-1 md:grid-cols-12 gap-5 md:gap-10 items-center">

      <!-- Image -->
      <a href="<?= htmlspecialchars($s['href']) ?>" target="_blank" rel="noopener"
         class="group relative block md:col-span-7 <?= $flip ? 'md:order-2' : '' ?>">
        <div class="relative overflow-hidden bg-black rounded-xl border border-white/10">
          <img src="<?= htmlspecialchars($s['image']) ?>" alt="<?= htmlspecialchars($s['title']) ?>"
               class="w-full h-auto object-contain transition-transform duration-[1.2s] ease-out group-hover:scale-[1.02]" />
          <span class="absolute top-4 right-4 inline-flex items-center justify-center w-9 h-9 bg-[#e50914] font-black text-white leading-none rounded-sm" style="font-family: 'Arial Black', sans-serif; font-size: 20px;">N</span>
        </div>
      </a>

      <!-- Info -->
      <div class="md:col-span-5 <?= $flip ? 'md:order-1' : '' ?>">
        <div class="flex items-center gap-4 mb-6">
          <span class="text-[#f9dda9] text-sm font-extrabold tracking-[0.3em] uppercase">N°<?= $s['num'] ?></span>
          <span class="flex-1 h-px bg-white/10"></span>
          <div class="flex items-center gap-3 text-[11px] font-extrabold tracking-[0.24em] uppercase text-neutral-400">
            <span><?= $s['year'] ?></span>
            <span class="w-1 h-1 rounded-full bg-neutral-500"></span>
            <span><?= $s['runtime'] ?></span>
          </div>
        </div>

        <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[0.95] mb-4"><?= htmlspecialchars($s['title']) ?></h2>

        <p class="text-base md:text-lg text-neutral-400 leading-relaxed mb-8 max-w-md"><?= htmlspecialchars($s['tagline']) ?></p>

        <a href="<?= htmlspecialchars($s['href']) ?>" target="_blank" rel="noopener"
           class="group inline-flex items-center gap-3 bg-[#e50914] hover:bg-[#f71c26] text-white font-extrabold uppercase text-sm tracking-[0.2em] px-8 py-4 rounded-[10px] transition-colors">
          Watch on Netflix
          <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>

    </article>
    <?php endforeach; ?>
  </section>

</div>
