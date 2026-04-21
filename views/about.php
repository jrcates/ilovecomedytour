<?php
// Pull authored content from tours.json
$tour = getTour('ilct-nyc');

if (!$tour):
?>
<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <h1 class="text-4xl font-extrabold text-neutral-900 mb-4 tracking-tight">Tour Not Found</h1>
  <a href="?view=home" class="cc-btn-primary text-sm tracking-[0.14em] px-8 py-3">Back to Home</a>
</div>
<?php return; endif;

$basePrice     = (float)$tour['pricePerGuest'];
$totalPerGuest = round($basePrice * 1.10, 2);

$walkingMin    = (int)($tour['walkingMinutes'] ?? 30);
$showMin       = (int)($tour['showMinutes'] ?? 90);
$totalMin      = (int)($tour['durationMinutes'] ?? ($walkingMin + $showMin));
$capacity      = (int)($tour['defaultCapacity'] ?? 15);
$drinks        = (int)($tour['includesDrinks'] ?? 2);
$walkMiles     = $tour['walkDistanceMiles'] ?? 1;

$meetingName   = $tour['meetingPoint']['name']    ?? '';
$meetingAddr   = $tour['meetingPoint']['address'] ?? '';
$endName       = $tour['endPoint']['name']        ?? '';
$endAddr       = $tour['endPoint']['address']     ?? '';
?>

<section class="max-w-[1400px] mx-auto px-4 md:px-6 py-12 md:py-20">

  <!-- ─── Header ─── -->
  <div class="relative mb-10 md:mb-20">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[260px] font-black text-black/[0.04] select-none leading-none pointer-events-none tracking-tight">ABOUT</span>
    <div class="cc-sticker mb-5 md:mb-0 md:absolute md:top-0 md:right-12 rotate-[-3deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2">
      Our Story
    </div>
    <p class="relative text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-4">About The Tour</p>
    <h1 class="relative text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[0.9] text-neutral-900">Walking tour.<br>Comedy show.<br><span class="text-[#d12027]">100% New York.</span></h1>
    <p class="relative mt-6 md:mt-8 text-neutral-700 text-lg md:text-xl max-w-2xl leading-relaxed">
      A walking tour celebrating <span class="font-extrabold text-[#d12027]">NYC's Comedy Legends</span>.
    </p>
  </div>

  <!-- ─── Body ─── -->
  <div class="grid md:grid-cols-12 gap-8 md:gap-16">

    <!-- LEFT: narrative + why / included -->
    <div class="md:col-span-7 space-y-10 md:space-y-16">

      <!-- Description -->
      <div>
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">The Experience</p>
        <div class="space-y-5 text-base md:text-lg text-neutral-800 leading-[1.75]">
          <?php foreach (explode("\n\n", $tour['description']) as $para):
            if (trim($para) === '') continue;
          ?>
          <p><?= htmlspecialchars(trim($para)) ?></p>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Why / Included side-by-side -->
      <div class="grid md:grid-cols-2 gap-8 md:gap-12 pt-10 border-t border-black/10">

        <!-- Why This Tour -->
        <div>
          <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">
            Why This Tour:
          </h2>
          <ul class="space-y-4 mb-5">
            <?php foreach (($tour['whyThisTour'] ?? []) as $item):
              $hl   = $item['headline'] ?? '';
              $body = $item['body'] ?? '';
            ?>
            <li class="flex items-start gap-3">
              <span aria-hidden="true" class="w-2.5 h-2.5 bg-[#d12027] mt-2 flex-shrink-0"></span>
              <p class="text-base md:text-lg text-neutral-800 leading-relaxed">
                <strong class="text-neutral-900"><?= htmlspecialchars($hl) ?></strong><?= $body !== '' ? ' ' . htmlspecialchars($body) : '' ?>
              </p>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php if (!empty($tour['whyThisTourFooter'])): ?>
          <p class="text-base md:text-lg text-neutral-800 leading-relaxed"><?= htmlspecialchars($tour['whyThisTourFooter']) ?></p>
          <?php endif; ?>
        </div>

        <!-- What's Included -->
        <div>
          <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">
            What's Included:
          </h2>
          <p class="text-base md:text-lg text-neutral-800 mb-5">Each ticket includes:</p>
          <ul class="space-y-4">
            <?php foreach (($tour['whatsIncluded'] ?? []) as $item):
              $lbl  = $item['label'] ?? '';
              $body = $item['body'] ?? '';
            ?>
            <li class="flex items-start gap-3">
              <span aria-hidden="true" class="w-2.5 h-2.5 bg-[#d12027] mt-2 flex-shrink-0"></span>
              <p class="text-base md:text-lg text-neutral-800 leading-relaxed">
                <strong class="text-neutral-900"><?= htmlspecialchars($lbl) ?></strong><?= $body !== '' ? ' ' . htmlspecialchars($body) : '' ?>
              </p>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <!-- Meeting + End point -->
      <div class="pt-10 border-t border-black/10 grid sm:grid-cols-2 gap-8">
        <div>
          <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">Starts</p>
          <h3 class="text-lg md:text-xl font-extrabold text-neutral-900 mb-1 leading-tight"><?= htmlspecialchars($meetingName) ?></h3>
          <p class="text-sm text-neutral-600 leading-relaxed"><?= htmlspecialchars($meetingAddr) ?></p>
        </div>
        <div>
          <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">Ends At</p>
          <h3 class="text-lg md:text-xl font-extrabold text-neutral-900 mb-1 leading-tight"><?= htmlspecialchars($endName) ?></h3>
          <p class="text-sm text-neutral-600 leading-relaxed"><?= htmlspecialchars($endAddr) ?></p>
        </div>
      </div>

      <!-- Good to know -->
      <div class="pt-10 border-t border-black/10">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">Good To Know</p>
        <ul class="space-y-3 text-sm md:text-base">
          <li class="flex items-start gap-3">
            <i data-lucide="clock" class="w-4 h-4 text-[#d12027] mt-1 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed"><strong class="text-neutral-900">Arrive 10 min early.</strong> We roll out on time — the club won't hold the doors for us.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="umbrella" class="w-4 h-4 text-[#d12027] mt-1 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed"><strong class="text-neutral-900">Rain or shine.</strong> Dress for the weather — we walk regardless.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="check-circle-2" class="w-4 h-4 text-[#d12027] mt-1 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed"><strong class="text-neutral-900"><?= $drinks ?> drink tickets included</strong> — covers the club's 2-drink minimum.</p>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="alert-triangle" class="w-4 h-4 text-[#d12027] mt-1 flex-shrink-0"></i>
            <p class="text-neutral-800 leading-relaxed">The comedy club is a separate business. <strong class="text-neutral-900">Line-ups may change</strong> and are never guaranteed.</p>
          </li>
        </ul>
      </div>
    </div>

    <!-- RIGHT: sticky aside with Quick Facts + CTA -->
    <aside class="md:col-span-5">
      <div class="md:sticky md:top-32 space-y-5">

        <!-- Quick Facts -->
        <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
          <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-6">Quick Facts</p>
          <div class="grid grid-cols-2 gap-y-6 gap-x-4">
            <div>
              <p class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-500 mb-1.5">Walk</p>
              <p class="text-xl md:text-2xl font-extrabold text-neutral-900 tracking-tight leading-none"><?= $walkingMin ?> <span class="text-sm font-semibold text-neutral-500">min</span></p>
              <p class="text-xs text-neutral-500 mt-1"><?= $walkMiles ?> mile · Greenwich Village</p>
            </div>
            <div>
              <p class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-500 mb-1.5">Show</p>
              <p class="text-xl md:text-2xl font-extrabold text-neutral-900 tracking-tight leading-none"><?= $showMin ?> <span class="text-sm font-semibold text-neutral-500">min</span></p>
              <p class="text-xs text-neutral-500 mt-1">Live stand-up</p>
            </div>
            <div>
              <p class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-500 mb-1.5">Total Time</p>
              <p class="text-xl md:text-2xl font-extrabold text-neutral-900 tracking-tight leading-none">~<?= round($totalMin / 60, 1) ?> <span class="text-sm font-semibold text-neutral-500">hrs</span></p>
              <p class="text-xs text-neutral-500 mt-1">Walk + Show</p>
            </div>
            <div>
              <p class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-500 mb-1.5">Group Size</p>
              <p class="text-xl md:text-2xl font-extrabold text-neutral-900 tracking-tight leading-none">Up to <?= $capacity ?></p>
              <p class="text-xs text-neutral-500 mt-1">Max per tour</p>
            </div>
            <div>
              <p class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-500 mb-1.5">From</p>
              <p class="text-xl md:text-2xl font-extrabold text-neutral-900 tracking-tight leading-none">$<?= number_format($totalPerGuest, 0) ?></p>
              <p class="text-xs text-neutral-500 mt-1">Per guest · incl. fees</p>
            </div>
            <div>
              <p class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-500 mb-1.5">Drinks</p>
              <p class="text-xl md:text-2xl font-extrabold text-neutral-900 tracking-tight leading-none"><?= $drinks ?> <span class="text-sm font-semibold text-neutral-500">incl.</span></p>
              <p class="text-xs text-neutral-500 mt-1">At the club</p>
            </div>
          </div>
        </div>

        <!-- CTA -->
        <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
          <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Ready to go?</p>
          <h2 class="text-2xl md:text-3xl font-extrabold text-neutral-900 tracking-tight leading-[1.1] mb-3">
            Book a tour before<br>your friends do.
          </h2>
          <p class="text-sm text-neutral-600 leading-relaxed mb-5">
            Tours run Thursday through Sunday. Grab a spot while they last.
          </p>
          <a href="?view=tour&tour=<?= urlencode($tour['id']) ?>" class="cc-btn-primary text-sm tracking-[0.22em] px-7 py-4 w-full justify-center">
            Book a Tour
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
          <a href="?view=contact" class="mt-3 block text-center text-[11px] font-extrabold uppercase tracking-[0.24em] text-neutral-700 hover:text-[#d12027] transition-colors py-3">
            Got questions? Contact Us →
          </a>
        </div>

      </div>
    </aside>
  </div>
</section>
