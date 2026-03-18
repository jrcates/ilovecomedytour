<?php
$showsByDate = [];
foreach ($shows as $show) {
  $dateKey = date('Y-m-d', strtotime($show['date']));
  $showsByDate[$dateKey][] = $show;
}
$showDatesJson = json_encode(array_keys($showsByDate));
?>

<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen">
  <?php component('page-header', ['title' => 'Upcoming Comedy Shows', 'description' => "Book your seats for Brooklyn's finest comedy.", 'centered' => true]); ?>
  <?php component('calendar-filter', ['shows' => $shows, 'showDatesJson' => $showDatesJson]); ?>
</div>
