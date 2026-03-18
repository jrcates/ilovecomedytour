<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/data.php';

$view = isset($_GET['view']) ? preg_replace('/[^a-z\-]/', '', $_GET['view']) : 'home';
$validViews = ['home','calendar','comedians','comedian',
               'about','contact','gift','event','hotel','management',
               'addons','checkout','thank-you','series','promodates','design-system'];
if (!in_array($view, $validViews)) $view = 'home';
?>
<!DOCTYPE html>
<html lang="en">
<?php component('layout/head'); ?>
<body class="min-h-screen bg-white text-neutral-900 overflow-x-hidden">
<div class="overflow-x-hidden w-full">
  <?php component('layout/nav', ['currentView' => $view]); ?>
  <main class="cc-view-fade<?= $view !== 'home' ? ' cc-inner-page' : '' ?>">
    <?php
      $viewFile = __DIR__ . "/views/{$view}.php";
      if (file_exists($viewFile)) {
        include $viewFile;
      } else {
        include __DIR__ . '/views/home.php';
      }
    ?>
  </main>
  <?php component('layout/promo-button'); ?>
  <?php component('layout/newsletter'); ?>
  <?php component('layout/footer'); ?>
</div>
</body>
</html>
