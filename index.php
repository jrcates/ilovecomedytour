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
<div class="overflow-x-hidden w-full"
     x-data="{ devicePreview: 'desktop' }"
     :class="{ 'cc-force-mobile': devicePreview === 'mobile' }"
     x-effect="
       document.body.style.background = devicePreview === 'mobile' ? '#111' : '';
       $el.style.opacity = '0';
       if (devicePreview === 'mobile') {
         tailwind.config.theme.screens = { sm: '9999px', md: '9999px', lg: '9999px', xl: '9999px', '2xl': '9999px' };
       } else {
         tailwind.config.theme.screens = { sm: '640px', md: '768px', lg: '1024px', xl: '1280px', '2xl': '1536px' };
       }
       document.querySelector('style[type=&quot;text/tailwindcss&quot;]').textContent += ' ';
       setTimeout(() => { $el.style.opacity = '1'; lucide.createIcons(); }, 150);
     ">
  <?php component('view-switcher'); ?>
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
