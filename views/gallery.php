<?php
$galleryImages = [
  "assets/newgal-img1.jpg", "assets/newgal-img2.jpg", "assets/newgal-img3.jpg",
  "assets/newgal-img4.jpg", "assets/newgal-img5.jpg", "assets/newgal-img6.jpg",
  "assets/newgal-img7.jpg", "assets/newgal-img8.jpg", "assets/newgal-img9.jpg",
  "assets/newgal-img10.jpg", "assets/newgal-img11.jpg", "assets/newgal-img12.jpg",
];
$layout = [
  [2,2],[1,1],[1,1],[1,1],[1,1],[1,2],[1,1],[2,2],[1,1],[1,1],[1,1],[1,1],
];
?>

<section class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen" aria-label="Photo gallery">
  <?php component('page-header', ['title' => 'THE <span class="text-[#24CECE]">VIBE</span>', 'description' => 'Capturing the laughter, the lights, and the unforgettable nights.', 'centered' => true]); ?>
  <?php component('gallery-grid', ['images' => $galleryImages, 'layout' => $layout]); ?>
</section>
