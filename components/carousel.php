<?php
$slideData = [];
foreach ($shows as $i => $slide) {
  $d = formatShowDate($slide['date']);
  $slideData[] = ['index' => $i, 'slide' => $slide, 'date' => $d];
}
$totalSlides = count($slideData);
?>

<style>
  #ccTrack {
    display: flex;
    gap: 16px;
    align-items: center;
    transition: transform 0.4s cubic-bezier(0.25, 0.1, 0.25, 1);
  }
  .cc-slide { flex-shrink: 0; overflow: hidden; }
</style>

<section class="relative pt-[130px] md:pt-[210px] pb-8" style="overflow:hidden;">
  <div style="overflow:hidden;">
    <div id="ccTrack">
      <?php foreach ($slideData as $sd): $isFirst = $sd['index'] === 0; ?>
      <div class="cc-slide" data-index="<?= $sd['index'] ?>" style="width:<?= $isFirst ? '100%' : '470px' ?>; opacity:<?= $isFirst ? '1' : '0.5' ?>;">

        <!-- Card view -->
        <div class="cc-card" style="<?= $isFirst ? '' : 'display:none;' ?> background:#1e1e1e; border-radius:10px; border:1px solid rgba(255,255,255,0.08); overflow:hidden; display:<?= $isFirst ? 'flex' : 'none' ?>;">
          <!-- Mobile: text first, image below -->
          <div class="flex flex-col md:hidden w-full">
            <div class="p-5 pb-4 flex flex-col gap-3">
              <h2 class="text-xl font-bold text-white leading-tight"><?= htmlspecialchars($sd['slide']['title']) ?></h2>
              <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 bg-[#F15A29] text-white text-xs font-semibold px-3 py-1 rounded-full">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  <?= $sd['date']['weekday'] ?>, <?= $sd['date']['day'] ?> <?= $sd['date']['month'] ?> <?= $sd['date']['year'] ?>
                </span>
                <span class="inline-flex items-center gap-1.5 bg-[#F15A29] text-white text-xs font-semibold px-3 py-1 rounded-full">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                  <?= htmlspecialchars($sd['date']['time']) ?>
                </span>
              </div>
              <div class="inline-flex items-center gap-1.5 bg-[#383838] text-neutral-300 text-xs font-medium px-3 py-1.5 rounded-full max-w-full w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="truncate"><?= htmlspecialchars($sd['slide']['location']) ?></span>
              </div>
              <a href="?view=event&show=<?= urlencode($sd['slide']['id']) ?>" class="inline-block px-6 py-2.5 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-neutral-200 transition-colors w-fit">Buy Tickets</a>
            </div>
            <div class="w-full h-[300px] px-3 pb-3">
              <img src="<?= htmlspecialchars($sd['slide']['image']) ?>" alt="<?= htmlspecialchars($sd['slide']['title']) ?>" class="w-full h-full object-cover rounded-lg" />
            </div>
          </div>
          <!-- Desktop: side-by-side layout -->
          <div class="hidden md:flex w-full" style="height:520px;">
            <div style="width:50%; padding:40px; display:flex; flex-direction:column; justify-content:flex-end; gap:14px;">
              <h2 class="text-3xl md:text-4xl font-bold text-white leading-tight"><?= htmlspecialchars($sd['slide']['title']) ?></h2>
              <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 bg-[#F15A29] text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  <?= $sd['date']['weekday'] ?>, <?= $sd['date']['day'] ?> <?= $sd['date']['month'] ?> <?= $sd['date']['year'] ?>
                </span>
                <span class="inline-flex items-center gap-1.5 bg-[#F15A29] text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                  <?= htmlspecialchars($sd['date']['time']) ?>
                </span>
              </div>
              <div class="inline-flex items-center gap-1.5 bg-[#383838] text-neutral-300 text-xs font-medium px-3 py-1.5 rounded-full max-w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="truncate"><?= htmlspecialchars($sd['slide']['location']) ?></span>
              </div>
              <p class="text-neutral-500 text-xs leading-relaxed line-clamp-3"><?= htmlspecialchars($sd['slide']['description']) ?></p>
              <div>
                <a href="?view=event&show=<?= urlencode($sd['slide']['id']) ?>" class="inline-block px-6 py-2.5 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-neutral-200 transition-colors">Buy Tickets</a>
              </div>
            </div>
            <div style="width:50%; padding:14px 14px 14px 0;">
              <img src="<?= htmlspecialchars($sd['slide']['image']) ?>" alt="<?= htmlspecialchars($sd['slide']['title']) ?>" style="width:100%; height:100%; object-fit:cover; border-radius:10px;" />
            </div>
          </div>
        </div>

        <!-- Thumb view -->
        <div class="cc-thumb" style="display:<?= $isFirst ? 'none' : 'flex' ?>; height:520px; border-radius:10px; overflow:hidden; background:#1e1e1e; border:1px solid rgba(255,255,255,0.08); padding:14px; align-items:center; justify-content:center;">
          <img src="<?= htmlspecialchars($sd['slide']['image']) ?>" alt="<?= htmlspecialchars($sd['slide']['title']) ?>" style="width:100%; height:100%; object-fit:cover; border-radius:10px;" />
        </div>

      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Bottom bar -->
  <div class="max-w-[1200px] mx-auto px-6 flex justify-between items-center mt-6">
    <div id="ccDots" class="flex items-center gap-2"></div>
    <div class="flex items-center gap-2">
      <button id="ccPrev" aria-label="Previous slide" class="w-9 h-9 rounded-full bg-neutral-700 hover:bg-neutral-600 flex items-center justify-center transition-colors border border-white/10">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      </button>
      <button id="ccNext" aria-label="Next slide" class="w-9 h-9 rounded-full bg-neutral-700 hover:bg-neutral-600 flex items-center justify-center transition-colors border border-white/10">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </button>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var track  = document.getElementById('ccTrack');
  if (!track) return;
  var slides = Array.from(track.querySelectorAll('.cc-slide'));
  var total  = slides.length;
  var current = 0;
  var busy = false;
  var prevOff = 0;
  var gap = 16;

  // Content width matches the site (1200px max, centered)
  var isMobile = window.innerWidth < 768;
  function contentWidth() { return Math.min(1200, window.innerWidth - (isMobile ? 32 : 48)); }
  function contentLeft() { return Math.max(isMobile ? 16 : 24, (window.innerWidth - contentWidth()) / 2); }
  var thumbW = isMobile ? 0 : (window.innerWidth < 1024 ? 380 : 470);

  // Dots
  var dots = [];
  var dotsBox = document.getElementById('ccDots');
  for (var i = 0; i < total; i++) {
    var d = document.createElement('button');
    (function(idx) { d.addEventListener('click', function() { go(idx); }); })(i);
    dotsBox.appendChild(d);
    dots.push(d);
  }

  function render(animate) {
    var cw = contentWidth();
    var cl = contentLeft();

    // 1. Set each slide's width: active = content width, inactive = thumb
    slides.forEach(function(sl, i) {
      var card  = sl.querySelector('.cc-card');
      var thumb = sl.querySelector('.cc-thumb');
      sl.style.display = '';
      if (i === current) {
        sl.style.width = cw + 'px';
        sl.style.opacity = '1';
        card.style.display = 'block';
        thumb.style.display = 'none';
      } else if (isMobile) {
        sl.style.display = 'none';
      } else {
        sl.style.width = thumbW + 'px';
        sl.style.opacity = '0.5';
        card.style.display = 'none';
        thumb.style.display = 'flex';
      }
    });

    // 2. Calculate translateX to align active slide with content area
    var before = 0;
    if (!isMobile) {
      for (var i = 0; i < current; i++) {
        before += thumbW + gap;
      }
    }
    var offset = isMobile ? cl : cl - before;

    if (!animate) {
      track.style.transition = 'none';
      track.style.transform = 'translateX(' + offset + 'px)';
    } else {
      // Spring bounce: overshoot, bounce back, settle
      var dir = offset > prevOff ? 1 : -1;
      var overshoot = 30 * dir;

      track.style.transition = 'transform 0.25s cubic-bezier(0.2, 0, 0.5, 1)';
      track.style.transform = 'translateX(' + (offset + overshoot) + 'px)';

      setTimeout(function() {
        track.style.transition = 'transform 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
        track.style.transform = 'translateX(' + (offset - overshoot * 0.3) + 'px)';
      }, 260);

      setTimeout(function() {
        track.style.transition = 'transform 0.15s cubic-bezier(0.4, 0, 0.2, 1)';
        track.style.transform = 'translateX(' + offset + 'px)';
      }, 470);
    }
    prevOff = offset;

    // 3. Dots
    dots.forEach(function(d, i) {
      d.className = i === current
        ? 'w-8 h-2.5 rounded-full bg-white transition-all duration-300'
        : 'w-2.5 h-2.5 rounded-full bg-neutral-600 transition-all duration-300';
    });
  }

  function go(idx) {
    if (busy || idx < 0 || idx >= total || idx === current) return;
    busy = true;
    current = idx;
    render(true);
    setTimeout(function() { busy = false; }, 650);
  }

  document.getElementById('ccNext').addEventListener('click', function() {
    clearInterval(auto);
    go(current < total - 1 ? current + 1 : 0);
  });
  document.getElementById('ccPrev').addEventListener('click', function() {
    clearInterval(auto);
    go(current > 0 ? current - 1 : total - 1);
  });

  var sx = 0;
  track.addEventListener('touchstart', function(e) { sx = e.changedTouches[0].screenX; }, { passive: true });
  track.addEventListener('touchend', function(e) {
    var d = sx - e.changedTouches[0].screenX;
    if (Math.abs(d) > 50) { clearInterval(auto); d > 0 ? go(current<total-1?current+1:0) : go(current>0?current-1:total-1); }
  });

  window.addEventListener('resize', function() { isMobile = window.innerWidth < 768; thumbW = isMobile ? 0 : (window.innerWidth < 1024 ? 380 : 470); render(false); });

  // Init
  render(false);
  var auto = setInterval(function() { go(current<total-1?current+1:0); }, 5000);
});
</script>
