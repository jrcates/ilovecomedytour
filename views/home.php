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

<div class="text-neutral-100 bg-black relative">
  <?php component('carousel', ['shows' => $heroShows]); ?>
</div>

<?php component('show-grid', ['shows' => $upcomingShows, 'title' => 'Upcoming Shows', 'linkText' => 'See Full Calendar', 'linkUrl' => '?view=calendar']); ?>
