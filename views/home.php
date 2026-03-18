<?php
$heroShows    = array_slice($shows, 0, 3);
$upcomingShows = array_slice($shows, 3, 6);

$galleryImages = [
  "assets/newgal-img1.jpg",
  "assets/newgal-img12.jpg",
  "assets/newgal-img3.jpg",
  "assets/newgal-img4.jpg",
  "assets/newgal-img5.jpg",
  "assets/newgal-img6.jpg",
  "assets/newgal-img9.jpg",
];
?>

<?php component('carousel', ['shows' => $heroShows]); ?>

<?php component('show-grid', ['shows' => $upcomingShows, 'title' => 'Upcoming Comedy Shows', 'linkText' => 'View Entire Schedule', 'linkUrl' => '?view=schedule']); ?>

<!-- Our Menu Section -->
<section class="py-16 bg-[#171C1C]">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-12">
      <div>
        <h2 class="text-3xl font-bold uppercase tracking-wide mb-2">Our Menu</h2>
        <p class="text-neutral-500 text-sm">There is a 2-drink minimum at all of our shows</p>
      </div>
      <a href="?view=menu" class="px-6 py-2 bg-[#24CECE] text-black font-bold rounded-full uppercase tracking-wider text-xs hover:bg-[#20B8B8] transition-colors shrink-0">View Menu</a>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
      <?php foreach ([
        ['SPECIALTY COCKTAILS', 'assets/specialty-cocktail.jpg', 'Eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'specialty-cocktails'],
        ['BEERS', 'assets/beers.jpg', 'Dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor..', 'beers'],
        ['NON-ALCOHOLIC', 'assets/non-alcoholic.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod..', 'non-alcoholic'],
      ] as [$title, $img, $desc, $anchor]): ?>
      <a href="?view=menu#<?= $anchor ?>" class="bg-white rounded-[5px] overflow-hidden group border border-transparent hover:border-[#24CECE]/50 transition-all duration-300 block">
        <div class="h-[300px] relative">
          <img src="<?= $img ?>" alt="<?= $title ?>" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-gradient-to-t from-white via-white/10 to-transparent"></div>
        </div>
        <div class="p-8 bg-white -mt-1 relative z-10">
          <h3 class="text-2xl font-black uppercase tracking-tight text-black mb-4"><?= $title ?></h3>
          <p class="text-neutral-500 text-sm leading-relaxed mb-8"><?= $desc ?></p>
          <span class="inline-block px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full text-sm hover:bg-[#20B8B8] transition-colors shadow-lg shadow-[#24CECE]/20">View Menu</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Gallery Preview: Super Fun Nights -->
<section class="py-16 bg-[#171C1C]">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="mb-12">
      <h2 class="text-3xl font-bold uppercase tracking-wide mb-2">Super Fun Nights</h2>
      <p class="text-neutral-500 text-sm">Laughter makes sleep can those many nights.</p>
    </div>
    <!-- Desktop: 6-col mosaic -->
    <div class="hidden md:grid grid-cols-6 gap-3 auto-rows-[200px]">
      <div class="col-span-3 row-span-2 rounded-[10px] overflow-hidden"><img src="<?= $galleryImages[0] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="col-span-3 row-span-2 rounded-[10px] overflow-hidden"><img src="<?= $galleryImages[1] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="col-span-4 row-span-2 rounded-[10px] overflow-hidden"><img src="<?= $galleryImages[2] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="col-span-2 row-span-2 rounded-[10px] overflow-hidden"><img src="<?= $galleryImages[3] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="col-span-2 row-span-2 rounded-[10px] overflow-hidden"><img src="<?= $galleryImages[4] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="col-span-2 row-span-2 rounded-[10px] overflow-hidden"><img src="<?= $galleryImages[5] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="col-span-2 row-span-2 rounded-[10px] overflow-hidden"><img src="<?= $galleryImages[6] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
    </div>
    <!-- Mobile: single column -->
    <div class="grid md:hidden grid-cols-2 gap-3">
      <div class="rounded-[10px] overflow-hidden h-[200px]"><img src="<?= $galleryImages[0] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="rounded-[10px] overflow-hidden h-[200px]"><img src="<?= $galleryImages[1] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="col-span-2 rounded-[10px] overflow-hidden h-[220px]"><img src="<?= $galleryImages[2] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="rounded-[10px] overflow-hidden h-[200px]"><img src="<?= $galleryImages[3] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="rounded-[10px] overflow-hidden h-[200px]"><img src="<?= $galleryImages[4] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="col-span-2 rounded-[10px] overflow-hidden h-[220px]"><img src="<?= $galleryImages[5] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
      <div class="col-span-2 rounded-[10px] overflow-hidden h-[220px]"><img src="<?= $galleryImages[6] ?>" alt="Comedy club moment" class="w-full h-full object-cover" /></div>
    </div>
  </div>
</section>
