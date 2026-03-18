<?php
$heroShows    = array_slice($shows, 0, 3);
$upcomingShows = array_slice($shows, 3, 6);
?>

<div class="text-neutral-100 bg-black relative">
  <?php component('carousel', ['shows' => $heroShows]); ?>
</div>

<?php component('show-grid', ['shows' => $upcomingShows, 'title' => 'Upcoming Shows', 'linkText' => 'See Full Calendar', 'linkUrl' => '?view=calendar']); ?>
