<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/data.php';

$view = isset($_GET['view']) ? preg_replace('/[^a-z\-]/', '', $_GET['view']) : 'home';
$validViews = ['home','about','tour','contact','addons','checkout','thank-you','design-system'];
if (!in_array($view, $validViews)) $view = 'home';
?>
<!DOCTYPE html>
<html lang="en">
<?php component('layout/head'); ?>
<body class="min-h-screen bg-white text-neutral-900 overflow-x-hidden">
<?php component('view-switcher'); ?>
<div class="overflow-x-hidden w-full">
  <?php component('layout/nav', ['currentView' => $view]); ?>
  <main class="cc-view-fade">
    <?php
      $viewFile = __DIR__ . "/views/{$view}.php";
      if (file_exists($viewFile)) {
        include $viewFile;
      } else {
        include __DIR__ . '/views/home.php';
      }
    ?>
  </main>
  <?php if (!in_array($view, ['event', 'addons', 'checkout'])) component('layout/newsletter'); ?>
  <?php component('layout/footer'); ?>
  <?php component('layout/design-system-button'); ?>
</div>
</body>
</html>
