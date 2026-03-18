<style>
  .cc-hero-carousel { overflow: visible; position: relative; }
  .cc-hero-track { display: flex; transition: transform 0.5s ease; gap: 0; }
  .cc-hero-slide {
    flex: 0 0 1200px; display: flex; justify-content: center;
    transition: opacity 0.5s ease;
    opacity: 0.5;
  }
  .cc-hero-slide.active { opacity: 1; }
  .cc-hero-card { width: 1200px; height: 660px; display: flex; background: white; border-radius: 0; overflow: hidden; position: relative; }
  .cc-hero-slide.active .cc-hero-card { border-radius: 5px; }
  @media (max-width: 1280px) {
    .cc-hero-slide { flex: 0 0 70vw; }
    .cc-hero-card { width: 70vw; height: auto; flex-direction: column; }
  }
  @media (max-width: 768px) {
    .cc-hero-slide { flex: 0 0 88vw; }
    .cc-hero-card { width: 88vw; flex-direction: column; }
  }
  .cc-carousel-prev, .cc-carousel-next {
    position: absolute; top: 50%; z-index: 20;
    width: 50px; height: 50px; background: white; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3); cursor: pointer; transform: translateY(-50%);
    border: none;
  }
  .cc-carousel-prev { left: calc(50% - 600px - 25px); }
  .cc-carousel-next { right: calc(50% - 600px - 25px); }
  @media (max-width: 1280px) {
    .cc-carousel-prev { left: calc(50% - 35vw - 25px); }
    .cc-carousel-next { right: calc(50% - 35vw - 25px); }
  }
  @media (max-width: 768px) {
    .cc-carousel-prev { left: 4px; width: 40px; height: 40px; }
    .cc-carousel-next { right: 4px; width: 40px; height: 40px; }
  }
</style>

<section class="relative pt-[150px] pb-0 flex flex-col items-center justify-center overflow-hidden">
  <div class="w-full relative" x-data x-init="$nextTick(() => { new CCCarousel($el) })">
    <div class="cc-hero-carousel">
      <div class="cc-hero-track">
        <?php foreach ($shows as $slide):
          $d = formatShowDate($slide['date']);
        ?>
        <div class="cc-hero-slide">
          <div class="cc-hero-card">
            <!-- Left Content -->
            <div class="w-full md:w-[678px] h-full p-8 md:p-16 md:pl-20 flex flex-col justify-between gap-6 md:gap-10 bg-white text-neutral-900 relative z-10">
              <!-- Date Badge -->
              <div class="flex flex-col items-center w-fit">
                <div class="border border-black rounded-[5px] pt-2 pb-1 px-4 text-center min-w-[80px] bg-white">
                  <div class="text-sm font-bold text-black leading-none"><?= htmlspecialchars($d['weekday']) ?></div>
                  <div class="text-5xl font-black leading-none text-black my-1"><?= $d['day'] ?></div>
                  <div class="text-sm font-bold text-black leading-none"><?= htmlspecialchars($d['month']) ?></div>
                </div>
                <div class="bg-black text-white text-xs px-3 py-1 mt-1 font-medium rounded-[5px] tracking-wide w-full text-center"><?= htmlspecialchars($d['time']) ?></div>
              </div>
              <div class="space-y-4 md:space-y-5 max-w-lg mb-4 md:mb-8 relative z-10">
                <h2 class="text-3xl md:text-5xl font-black uppercase leading-[0.9] tracking-tight text-black"><?= htmlspecialchars($slide['title']) ?></h2>
                <p class="text-neutral-500 text-base md:text-lg leading-relaxed font-normal"><?= htmlspecialchars($slide['description']) ?></p>
                <a href="?view=event&show=<?= urlencode($slide['id']) ?>" class="inline-block px-8 py-3 bg-[#24CECE] hover:bg-[#20B8B8] text-black font-bold rounded-full text-base transition-all mt-2 hover:-translate-y-0.5">Buy Tickets</a>
              </div>
            </div>
            <!-- Mobile Image -->
            <div class="block md:hidden w-full h-[200px] overflow-hidden">
              <img src="<?= htmlspecialchars($slide['image']) ?>" alt="<?= htmlspecialchars($slide['title']) ?>" class="w-full h-full object-cover" />
            </div>
            <!-- Desktop Image -->
            <div class="hidden md:block absolute top-1/2 right-12 -translate-y-1/2 w-[460px] h-[480px] rounded-[5px] overflow-hidden shadow-2xl">
              <img src="<?= htmlspecialchars($slide['image']) ?>" alt="<?= htmlspecialchars($slide['title']) ?>" class="w-full h-full object-cover" />
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <button class="cc-carousel-prev"><i data-lucide="chevron-left" class="w-8 h-8 text-black"></i></button>
    <button class="cc-carousel-next"><i data-lucide="chevron-right" class="w-8 h-8 text-black"></i></button>
  </div>
</section>

<script>
class CCCarousel {
  constructor(el) {
    this.el = el;
    this.track = el.querySelector('.cc-hero-track');
    this.slides = Array.from(this.track.children);
    this.total = this.slides.length;
    this.isTransitioning = false;

    // Clone all slides and append/prepend for infinite loop
    this.slides.forEach(s => this.track.appendChild(s.cloneNode(true)));
    this.slides.forEach(s => this.track.insertBefore(s.cloneNode(true), this.track.firstChild));

    this.allSlides = Array.from(this.track.children);
    this.current = this.total; // start at first original slide

    this.position(false);
    this.bindEvents();
    this.autoplay = setInterval(() => this.next(), 5000);

    // Re-init Lucide icons for cloned slides
    if (typeof lucide !== 'undefined') lucide.createIcons();
  }

  position(animate) {
    const slideW = this.allSlides[0].offsetWidth;
    const viewW = window.innerWidth;
    const offset = -this.current * slideW + (viewW - slideW) / 2;

    this.track.style.transition = animate ? 'transform 0.5s ease' : 'none';
    this.track.style.transform = `translateX(${offset}px)`;

    this.allSlides.forEach((s, i) => s.classList.toggle('active', i === this.current));
  }

  goTo(idx) {
    if (this.isTransitioning) return;
    this.isTransitioning = true;
    this.current = idx;
    this.position(true);
  }

  next() { this.goTo(this.current + 1); }
  prev() { this.goTo(this.current - 1); }

  bindEvents() {
    this.track.addEventListener('transitionend', () => {
      this.isTransitioning = false;
      if (this.current >= this.total * 2) {
        this.current -= this.total;
        this.position(false);
      }
      if (this.current < this.total) {
        this.current += this.total;
        this.position(false);
      }
    });

    this.el.querySelector('.cc-carousel-prev').addEventListener('click', () => this.prev());
    this.el.querySelector('.cc-carousel-next').addEventListener('click', () => this.next());

    // Touch swipe
    let startX = 0;
    this.track.addEventListener('touchstart', e => { startX = e.changedTouches[0].screenX; }, { passive: true });
    this.track.addEventListener('touchend', e => {
      const diff = startX - e.changedTouches[0].screenX;
      if (Math.abs(diff) > 50) diff > 0 ? this.next() : this.prev();
    });

    window.addEventListener('resize', () => this.position(false));
  }
}
</script>
