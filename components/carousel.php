<?php
$totalSlides = count($slides);
?>

<style>
  .cc-carousel-wrap {
    position: relative;
    margin: 0 auto;
    aspect-ratio: 16 / 9;
    width: 100%;
    max-width: 1920px;
    overflow: hidden;
    background: #000;
  }
  .cc-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.9s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .cc-slide.active {
    opacity: 1;
    pointer-events: auto;
  }
  .cc-slide > a,
  .cc-slide > div.cc-card {
    display: block;
    width: 100%;
    height: 100%;
  }
  .cc-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transform: scale(1.1);
    transition: transform 10s linear;
  }
  .cc-slide.active img {
    transform: scale(1);
  }

  /* Progress bar — hairline cream, at the very top of the carousel */
  .cc-progress {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: rgba(255,255,255,0.08);
    z-index: 5;
  }
  .cc-progress-bar {
    position: absolute;
    top: 0; left: 0;
    height: 100%;
    width: 0%;
    background: #f9dda9;
  }

  /* Bottom gradient for chrome legibility */
  .cc-carousel-wrap::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 110px;
    background: linear-gradient(to top, rgba(0,0,0,0.55), transparent);
    pointer-events: none;
    z-index: 3;
  }

  /* Edge arrows (desktop) */
  .cc-edge-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 52px; height: 52px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: rgba(0,0,0,0.35);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.15);
    color: #fff;
    opacity: 0;
    transition: opacity 0.3s ease, background 0.2s ease;
    z-index: 6;
    cursor: pointer;
  }
  .cc-carousel-wrap:hover .cc-edge-arrow { opacity: 1; }
  .cc-edge-arrow:hover { background: #f9dda9; color: #000; border-color: #f9dda9; }
  .cc-edge-prev { left: 20px; }
  .cc-edge-next { right: 20px; }
  @media (max-width: 768px) {
    .cc-edge-arrow { display: none; }
  }

  /* Bottom-right counter + arrows pill */
  .cc-chrome {
    position: absolute;
    bottom: 20px; right: 20px;
    display: flex; align-items: center;
    gap: 10px;
    z-index: 6;
    color: #fff;
    font-variant-numeric: tabular-nums;
  }
  .cc-counter {
    display: inline-flex; align-items: baseline; gap: 4px;
    padding: 8px 14px;
    background: rgba(0,0,0,0.45);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 999px;
    font-size: 12px; font-weight: 700;
    letter-spacing: 0.2em;
  }
  .cc-counter .current { color: #f9dda9; }
  .cc-counter .sep { opacity: 0.5; margin: 0 2px; }
  .cc-counter .total { opacity: 0.7; }

  /* Mobile prev/next fallback (next to counter since edge arrows hidden) */
  .cc-chrome-arrows { display: none; gap: 6px; }
  @media (max-width: 768px) {
    .cc-chrome-arrows { display: flex; }
  }
  .cc-chrome-arrows button {
    width: 36px; height: 36px; border-radius: 50%;
    background: rgba(0,0,0,0.45);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    color: #fff;
    display: inline-flex; align-items: center; justify-content: center;
  }
</style>

<section class="relative pt-[110px] md:pt-[80px] pb-0">
  <div class="cc-carousel-wrap" id="ccTrack">

    <?php foreach ($slides as $i => $sd): ?>
    <div class="cc-slide<?= $i === 0 ? ' active' : '' ?>" data-index="<?= $i ?>">
      <?php if (!empty($sd['href'])):
        $isExternal = preg_match('#^https?://#', $sd['href']);
      ?>
      <a href="<?= htmlspecialchars($sd['href']) ?>"<?= $isExternal ? ' target="_blank" rel="noopener"' : '' ?>>
        <img src="<?= htmlspecialchars($sd['image']) ?>" alt="" />
      </a>
      <?php else: ?>
      <div class="cc-card">
        <img src="<?= htmlspecialchars($sd['image']) ?>" alt="" />
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>

    <!-- Top progress bar -->
    <div class="cc-progress"><div class="cc-progress-bar" id="ccProgress"></div></div>

    <!-- Edge arrows (hover to reveal on desktop) -->
    <button class="cc-edge-arrow cc-edge-prev" id="ccPrev" aria-label="Previous slide">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button class="cc-edge-arrow cc-edge-next" id="ccNext" aria-label="Next slide">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5l7 7-7 7"/></svg>
    </button>

    <!-- Bottom-right counter + mobile arrows -->
    <div class="cc-chrome">
      <div class="cc-chrome-arrows">
        <button id="ccPrevM" aria-label="Previous slide">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button id="ccNextM" aria-label="Next slide">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
      </div>
      <div class="cc-counter">
        <span class="current" id="ccCurrent">01</span>
        <span class="sep">/</span>
        <span class="total" id="ccTotal"><?= str_pad((string)$totalSlides, 2, '0', STR_PAD_LEFT) ?></span>
      </div>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var track = document.getElementById('ccTrack');
  if (!track) return;
  var slides = Array.from(track.querySelectorAll('.cc-slide'));
  var total = slides.length;
  if (total === 0) return;
  var current = 0;
  var DURATION = 9000;
  var progressStart = performance.now();
  var autoTimer;
  var progressBar = document.getElementById('ccProgress');
  var counterCurrent = document.getElementById('ccCurrent');

  function render() {
    slides.forEach(function(sl, i) {
      sl.classList.toggle('active', i === current);
    });
    counterCurrent.textContent = String(current + 1).padStart(2, '0');
  }

  function go(idx) {
    var next = ((idx % total) + total) % total;
    if (next === current) return;
    current = next;
    render();
    progressStart = performance.now();
    resetAuto();
  }

  function tickProgress(now) {
    var pct = Math.min(100, ((now - progressStart) / DURATION) * 100);
    progressBar.style.width = pct + '%';
    requestAnimationFrame(tickProgress);
  }
  requestAnimationFrame(tickProgress);

  function resetAuto() {
    clearInterval(autoTimer);
    autoTimer = setInterval(function() { go(current + 1); }, DURATION);
  }
  resetAuto();

  ['ccPrev','ccPrevM'].forEach(function(id) {
    var el = document.getElementById(id);
    if (el) el.addEventListener('click', function(e) { e.preventDefault(); go(current - 1); });
  });
  ['ccNext','ccNextM'].forEach(function(id) {
    var el = document.getElementById(id);
    if (el) el.addEventListener('click', function(e) { e.preventDefault(); go(current + 1); });
  });

  document.addEventListener('keydown', function(e) {
    if (e.key === 'ArrowLeft') go(current - 1);
    if (e.key === 'ArrowRight') go(current + 1);
  });

  // Touch
  var sx = 0;
  track.addEventListener('touchstart', function(e) { sx = e.changedTouches[0].screenX; }, { passive: true });
  track.addEventListener('touchend', function(e) {
    var d = sx - e.changedTouches[0].screenX;
    if (Math.abs(d) > 50) { go(current + (d > 0 ? 1 : -1)); }
  });

  render();
});
</script>
