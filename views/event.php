<?php
$showId = isset($_GET['show']) ? $_GET['show'] : null;
$promoCode = isset($_GET['promo']) ? preg_replace('/[^A-Za-z0-9]/', '', $_GET['promo']) : '';
$show = null;

foreach ($shows as $s) {
  if ($s['id'] === $showId) {
    $show = $s;
    break;
  }
}

if (!$show) {
  echo '<div class="pt-[130px] md:pt-[250px] pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen text-center">';
  echo '<h1 class="text-4xl font-bold mb-4">Event Not Found</h1>';
  echo '<p class="text-neutral-500 mb-8">The event you\'re looking for doesn\'t exist.</p>';
  echo '<a href="?view=calendar" class="px-8 py-3 bg-black text-white font-bold rounded-[10px] hover:bg-neutral-800 transition-colors">View Schedule</a>';
  echo '</div>';
  return;
}

$d = formatShowDate($show['date']);
$isSoldOut = $show['status'] === 'Sold Out';
$priceValue = $show['priceValue'];
$isPromoFlat2 = strtoupper($promoCode) === 'EE001';

// Generate initials from performer name
function getInitials(string $name): string {
  $clean = preg_replace('/^(Host:\s*|Opener:\s*)/i', '', $name);
  $words = explode(' ', trim($clean));
  if (count($words) >= 2) {
    return strtoupper(mb_substr($words[0], 0, 1) . mb_substr($words[1], 0, 1));
  }
  return strtoupper(mb_substr($clean, 0, 2));
}

$avatarColors = ['#C084FC', '#9CA3AF', '#F59E0B', '#6B7280', '#EC4899', '#34D399', '#F97316', '#60A5FA'];

// Generate comedian lookup for linking performers
$cfn = ["James","Sarah","Michael","Jessica","David","Emily","Robert","Jennifer","William","Elizabeth","Joseph","Maria","Thomas","Lisa","Charles","Ashley"];
$cln = ["Chen","Johnson","Smith","Williams","Brown","Jones","Garcia","Miller","Davis","Rodriguez","Martinez","Hernandez","Lopez","Gonzalez","Wilson","Anderson"];
$comedianLookup = [];
for ($ci = 0; $ci < 160; $ci++) {
  $cname = $cfn[$ci % count($cfn)] . ' ' . $cln[(int)floor($ci / count($cfn)) % count($cln)];
  $comedianLookup[strtolower($cname)] = $ci;
}

function findComedianId(string $performer, array $lookup): ?int {
  $clean = preg_replace('/^(Host:\s*|Opener:\s*)/i', '', $performer);
  $clean = strtolower(trim($clean));
  return isset($lookup[$clean]) ? $lookup[$clean] : null;
}
?>

<div class="pt-[130px] md:pt-[250px] pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen" x-data="{ aboutExpanded: false }">

  <!-- Tab Navigation -->
  <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div class="flex flex-wrap items-center gap-2">
      <a href="#about-section" class="cc-event-tab text-sm font-medium px-4 py-2 rounded-[5px] border border-neutral-300 bg-white text-black transition-colors">About</a>
      <a href="#restrictions-section" class="cc-event-tab text-xs md:text-sm font-medium px-3 md:px-4 py-2 rounded-[5px] border border-neutral-300 bg-white text-black transition-colors">Restrictions</a>
    </div>
    <a href="?view=calendar" class="flex items-center gap-1.5 text-sm text-neutral-500 hover:text-black transition-colors px-4 py-2 rounded-[10px] border border-neutral-300 hover:border-neutral-400">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Back
    </a>
  </div>

  <!-- Hero Banner -->
  <div class="mb-12">
    <div class="bg-[#1e1e1e] rounded-xl overflow-hidden flex flex-col md:flex-row items-stretch md:h-[378px]">
      <!-- Left Content -->
      <div class="flex-1 p-6 md:pb-10 md:px-14 md:pt-0 flex flex-col justify-end gap-4">
        <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight"><?= htmlspecialchars($show['title']) ?></h2>
        <div class="flex flex-wrap items-center gap-2">
          <span class="inline-flex items-center gap-1.5 bg-[#F15A29] text-white text-xs font-semibold px-3 py-1.5 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <?= $d['weekday'] ?>, <?= $d['day'] ?> <?= $d['month'] ?> <?= $d['year'] ?>
          </span>
          <span class="inline-flex items-center gap-1.5 bg-[#F15A29] text-white text-xs font-semibold px-3 py-1.5 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <?= $d['time'] ?>
          </span>
        </div>
        <div class="inline-flex items-center gap-1.5 bg-[#383838] text-neutral-300 text-xs font-medium px-3 py-1.5 rounded-full w-fit">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <?= htmlspecialchars($show['location']) ?>
        </div>
      </div>
      <!-- Right Image -->
      <div class="w-full md:w-[380px] h-[220px] md:h-full flex-shrink-0 p-4 md:p-6">
        <img src="<?= htmlspecialchars($show['image']) ?>" alt="<?= htmlspecialchars($show['title']) ?>" class="w-full h-full object-cover rounded-xl" />
      </div>
    </div>
  </div>

  <!-- Two Column Layout -->
  <div class="grid lg:grid-cols-12 gap-12">

    <!-- Left Column -->
    <div class="lg:col-span-7 space-y-10 order-2 lg:order-1">

      <!-- ABOUT -->
      <div id="about-section">
        <h2 class="text-lg font-bold tracking-wide text-black mb-4">About</h2>
        <div :class="aboutExpanded ? '' : 'line-clamp-3'" class="cc-about-text text-neutral-600 text-base leading-relaxed">
          <p><?= htmlspecialchars($show['description']) ?> Join us at <?= htmlspecialchars($show['location']) ?> for an unforgettable night of live entertainment. Our intimate venue offers the perfect setting to experience comedy up close and personal, with excellent sightlines from every seat in the house. Whether you're a seasoned comedy fan or a first-timer, this show promises non-stop laughs from start to finish. Doors open one hour before showtime — arrive early to grab a drink and settle into the best seats.</p>
        </div>
        <button @click="aboutExpanded = !aboutExpanded" class="text-[#F15A29] text-sm font-bold mt-3 hover:text-[#D94E22] transition-colors" x-text="aboutExpanded ? 'Read Less' : 'Read More...'">Read More...</button>
      </div>

      <!-- FEATURING (only comedians with profiles, min 3) -->
      <?php
        $profiledPerformers = [];
        $usedIds = [];
        if (!empty($show['lineup'])) {
          foreach ($show['lineup'] as $i => $performer) {
            $cId = findComedianId($performer, $comedianLookup);
            if ($cId !== null) {
              $profiledPerformers[] = ['name' => $performer, 'id' => $cId, 'index' => $i];
              $usedIds[] = $cId;
            }
          }
        }
        $minFeatured = 3;
        if (count($profiledPerformers) < $minFeatured) {
          $showSeed = crc32($show['id']);
          $allIds = array_keys($comedianLookup);
          $allNames = array_flip($comedianLookup);
          $needed = $minFeatured - count($profiledPerformers);
          $offset = abs($showSeed) % 160;
          for ($fi = 0; $fi < 160 && $needed > 0; $fi++) {
            $candidateId = ($offset + $fi) % 160;
            if (!in_array($candidateId, $usedIds)) {
              $cname = $cfn[$candidateId % count($cfn)] . ' ' . $cln[(int)floor($candidateId / count($cfn)) % count($cln)];
              $profiledPerformers[] = ['name' => $cname, 'id' => $candidateId, 'index' => count($profiledPerformers)];
              $usedIds[] = $candidateId;
              $needed--;
            }
          }
        }
      ?>
      <?php if (!empty($profiledPerformers)): ?>
      <div>
        <h2 class="text-lg font-bold tracking-wide text-black mb-6">Featuring</h2>
        <div class="flex flex-wrap gap-5">
          <?php foreach ($profiledPerformers as $p):
            $initials = getInitials($p['name']);
            $bgColor = $avatarColors[$p['index'] % count($avatarColors)];
          ?>
          <a href="?view=comedian&id=<?= $p['id'] ?>" class="flex flex-col items-center gap-2 w-[100px] md:w-[130px] group">
            <div class="w-[100px] h-[100px] md:w-[130px] md:h-[130px] rounded-xl flex items-center justify-center group-hover:ring-2 group-hover:ring-[#F15A29] transition-all" style="background-color: <?= $bgColor ?>">
              <span class="text-4xl font-bold text-white tracking-wider"><?= $initials ?></span>
            </div>
            <span class="text-sm font-bold text-black text-center leading-tight group-hover:text-[#F15A29] transition-colors"><?= htmlspecialchars($p['name']) ?></span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- SERIES BANNER -->
      <?php if (!empty($show['series'])): ?>
      <a href="?view=series&name=<?= urlencode($show['series']) ?>" class="block w-full bg-[#F26522] hover:bg-[#D9551A] transition-colors text-white font-semibold text-center py-3.5 px-6 rounded-[10px] text-sm md:text-base">
        This event is part of: <?= htmlspecialchars($show['series']) ?>!
      </a>
      <?php endif; ?>

      <!-- RESTRICTIONS & REQUIREMENTS -->
      <div id="restrictions-section" class="bg-white rounded-xl border border-neutral-200 p-8">
        <h2 class="text-lg font-bold tracking-wide text-black mb-6 flex items-center gap-2">
          <i data-lucide="info" class="w-5 h-5 text-neutral-500"></i>
          Restrictions &amp; Requirements
        </h2>
        <ul class="space-y-5 text-sm text-neutral-600">
          <li class="flex items-start gap-3">
            <i data-lucide="clock" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i>
            <span><strong class="text-black">Arrive 30 mins before showtime</strong> as seating is on a first-come basis. Those arriving late are not guaranteed seats as we begin seating standby customers. If reservations are missed, tickets may be used another time without penalty.</span>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="circle-check" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i>
            <span>There is a <strong class="text-black">2-drink minimum</strong> for all shows.</span>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="alert-triangle" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i>
            <span><strong class="text-black">LINE-UPS SUBJECT TO CHANGE.</strong> If you're coming to see a specific performer, please note they might not be in the lineup. Rosters are current at time of posting but may get switched around. Tickets are for a comedy show, not for any specific performer.</span>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="circle-check" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i>
            <span><strong class="text-black">All ages welcome.</strong> Shows may contain adult content but there are no age restrictions for admission.</span>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="list" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i>
            <span><strong class="text-black">'Front Row' and 'Gold Front Row VIP'</strong> tickets guarantee stage-side seats and expedited check-in. General admission seating is first-come. 'Front Row' tickets are a way to secure patrons' seats of choice.</span>
          </li>
        </ul>
        <div class="mt-6 pt-4 border-t border-neutral-200">
          <span class="inline-block text-xs font-bold uppercase tracking-wider text-neutral-500 border border-neutral-300 px-3 py-1.5 rounded-[5px]">All Sales Are Final</span>
        </div>
      </div>
    </div>

    <!-- Right Column: Purchase Tickets -->
    <div class="lg:col-span-5 order-1 lg:order-2">
      <div class="bg-white p-8 rounded-xl shadow-xl sticky top-32 text-black space-y-6 border border-neutral-200">

        <h2 class="text-2xl font-bold tracking-tight text-black">Purchase Tickets</h2>

        <?php if (!$isSoldOut): ?>
          <?php component('ticket-selector', ['show' => $show, 'promoCode' => $promoCode]); ?>
        <?php else: ?>
        <!-- Sold Out State -->
        <div class="pt-4 border-t border-neutral-200 text-center">
          <button disabled class="w-full py-4 bg-neutral-200 text-neutral-500 font-bold text-base tracking-wider rounded-[10px] cursor-not-allowed">Sold Out</button>
          <p class="text-xs text-neutral-400 mt-3">This show is sold out. Check our calendar for other available shows.</p>
        </div>
        <?php endif; ?>

        <p class="text-xs text-neutral-400 text-center flex items-center justify-center gap-1.5">
          <i data-lucide="lock" class="w-3.5 h-3.5"></i>
          Secure Checkout powered by Stripe
        </p>

      </div>
    </div>

  </div>
</div>
