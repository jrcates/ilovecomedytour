<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/data.php';

$view = isset($_GET['view']) ? preg_replace('/[^a-z\-]/', '', $_GET['view']) : 'home';
$validViews = ['home','schedule','comedians','comedian','gallery','menu',
               'about','contact','openmic','private','gift','event',
               'addons','checkout','thank-you','series','promodates'];
if (!in_array($view, $validViews)) $view = 'home';
?>
<!DOCTYPE html>
<html lang="en">
<?php component('layout/head'); ?>
<body class="min-h-screen bg-[#171C1C] text-neutral-100 overflow-x-hidden">
<div class="overflow-x-hidden w-full">
  <?php component('layout/header-glow'); ?>
  <?php component('layout/nav', ['logoImg' => $logoImg, 'logoImgAlt' => $logoImgAlt]); ?>
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
  <?php component('layout/footer', ['logoImg' => $logoImg]); ?>
</div>
</body>
</html>
