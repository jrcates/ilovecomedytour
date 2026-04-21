<!-- ─── Navigation ─── -->
<?php $isHome = isset($currentView) && $currentView === 'home'; ?>
<div x-data="{
       mobileOpen: false,
       scrolled: false,
       isHome: <?= $isHome ? 'true' : 'false' ?>,
       get solid() { return !this.isHome || this.scrolled; }
     }"
     x-init="
       const onScroll = () => { scrolled = window.scrollY > 60 };
       window.addEventListener('scroll', onScroll, { passive: true });
       onScroll();
     "
     x-effect="document.body.style.overflow = mobileOpen ? 'hidden' : ''">

  <header id="cc-main-nav"
          :class="solid ? 'cc-nav-bg border-b border-white/5' : 'bg-transparent'"
          class="fixed top-0 w-full z-50 transition-colors duration-300">
    <div class="max-w-[1400px] mx-auto px-6 md:px-10 relative">

      <!-- Desktop -->
      <div class="hidden md:flex items-center justify-between py-6 gap-6">

        <!-- Left: wordmark -->
        <a href="?view=home" class="flex items-center gap-2.5 font-extrabold tracking-tight text-white hover:opacity-90 transition-opacity">
          <span class="text-lg leading-none">i</span>
          <svg viewBox="0 0 24 24" fill="#d12027" class="w-6 h-6"><path d="M12 21s-7-4.5-7-10a4.5 4.5 0 0 1 8-2.9A4.5 4.5 0 0 1 19 11c0 5.5-7 10-7 10z"/></svg>
          <span class="text-sm tracking-[0.18em] uppercase">Comedy Tour</span>
        </a>

        <!-- Right: links -->
        <?php
        $navLinks = [
          ['view' => 'home',     'label' => 'Home'],
          ['view' => 'about',    'label' => 'About'],
          ['view' => 'tour',     'label' => 'Book'],
          ['view' => 'contact',  'label' => 'Contact'],
        ];
        ?>
        <nav class="flex items-center gap-8 lg:gap-10 text-[11px] font-extrabold uppercase tracking-[0.3em]">
          <?php foreach ($navLinks as $link):
            $href = '?view=' . $link['view'];
            $isActive = $currentView === $link['view'];
          ?>
            <a href="<?= $href ?>" class="transition-colors <?= $isActive ? 'text-white border-b-2 border-[#f9dda9] pb-1' : 'text-white/70 hover:text-[#f9dda9]' ?>"><?= htmlspecialchars($link['label']) ?></a>
          <?php endforeach; ?>
        </nav>
      </div>

      <!-- Mobile -->
      <div class="md:hidden flex items-center justify-between py-5">
        <a href="?view=home" class="flex items-center gap-2 font-extrabold tracking-tight text-white">
          <span class="text-base leading-none">i</span>
          <svg viewBox="0 0 24 24" fill="#d12027" class="w-5 h-5"><path d="M12 21s-7-4.5-7-10a4.5 4.5 0 0 1 8-2.9A4.5 4.5 0 0 1 19 11c0 5.5-7 10-7 10z"/></svg>
          <span class="text-xs tracking-[0.18em] uppercase">Comedy Tour</span>
        </a>
        <button @click="mobileOpen = true" aria-label="Open menu"
                class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 border border-white/20 text-white hover:bg-white/20 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
        </button>
      </div>

    </div>
  </header>

  <!-- ─── Mobile Drawer Backdrop ─── -->
  <div x-cloak :class="mobileOpen ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'"
       @click="mobileOpen = false"
       class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] transition-opacity duration-300 md:hidden"></div>

  <!-- ─── Mobile Drawer ─── -->
  <div x-cloak :class="mobileOpen ? 'translate-x-0' : 'translate-x-full'"
       class="fixed top-0 right-0 h-full w-full bg-white text-neutral-900 z-[70] shadow-2xl overflow-y-auto transition-transform duration-300 md:hidden flex flex-col">

    <!-- Header row -->
    <div class="flex justify-between items-center px-6 py-5 border-b border-black/10">
      <a href="?view=home" @click="mobileOpen = false" class="flex items-center gap-2 font-extrabold tracking-tight text-neutral-900">
        <span class="text-base leading-none">i</span>
        <svg viewBox="0 0 24 24" fill="#d12027" class="w-5 h-5"><path d="M12 21s-7-4.5-7-10a4.5 4.5 0 0 1 8-2.9A4.5 4.5 0 0 1 19 11c0 5.5-7 10-7 10z"/></svg>
        <span class="text-xs tracking-[0.18em] uppercase">Comedy Tour</span>
      </a>
      <button @click="mobileOpen = false" aria-label="Close menu" class="w-10 h-10 flex items-center justify-center rounded-full bg-black/5 border border-black/10 hover:bg-[#f9dda9] hover:text-black hover:border-[#f9dda9] transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    </div>

    <!-- Mascot -->
    <div class="flex justify-center px-6 pt-8 pb-4">
      <img src="assets/ilct-logo.png" alt="I Love Comedy Tour" class="h-[140px] w-auto object-contain" />
    </div>

    <!-- Nav list -->
    <nav class="px-6 pt-2 pb-4">
      <?php foreach ($navLinks as $idx => $ml):
        $href     = '?view=' . $ml['view'];
        $isActive = $currentView === $ml['view'];
        $num = str_pad((string)($idx + 1), 2, '0', STR_PAD_LEFT);
      ?>
      <a href="<?= htmlspecialchars($href) ?>" @click="mobileOpen = false"
         class="group flex items-center gap-5 py-4 border-b border-black/10 transition-colors">
        <span class="font-extrabold tracking-[0.2em] text-xs w-7 <?= $isActive ? 'text-[#d12027]' : 'text-[#d12027]/40' ?>"><?= $num ?></span>
        <span class="flex-1 text-2xl font-extrabold tracking-tight leading-none <?= $isActive ? 'text-[#d12027]' : 'text-neutral-900 group-hover:text-[#d12027]' ?> transition-colors"><?= htmlspecialchars($ml['label']) ?></span>
        <svg class="w-4 h-4 transition-transform <?= $isActive ? 'text-[#d12027]' : 'text-neutral-400 group-hover:text-[#d12027] group-hover:translate-x-1' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
      <?php endforeach; ?>
    </nav>

    <!-- Book CTA -->
    <div class="px-6 pt-4">
      <a href="?view=tour&tour=ilct-nyc" @click="mobileOpen = false" class="cc-btn-primary w-full text-xs tracking-[0.22em] px-6 py-4">
        Book a Tour
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>

    <!-- Bottom: contact + social + copyright -->
    <div class="mt-auto px-6 pt-10 pb-10 text-center">

      <p class="text-[10px] font-extrabold tracking-[0.3em] text-[#d12027] uppercase mb-3">Get In Touch</p>
      <a href="mailto:touradmin@ilovecomedytour.com" class="block text-sm font-semibold text-neutral-900 hover:text-[#d12027] transition-colors mb-6 break-all">touradmin@ilovecomedytour.com</a>

      <div class="flex justify-center gap-2 mb-6">
        <a href="#" aria-label="Facebook" class="w-10 h-10 flex items-center justify-center rounded-full bg-black/5 border border-black/10 text-neutral-700 hover:bg-[#f9dda9] hover:text-black hover:border-[#f9dda9] transition-colors">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
        </a>
        <a href="#" aria-label="Instagram" class="w-10 h-10 flex items-center justify-center rounded-full bg-black/5 border border-black/10 text-neutral-700 hover:bg-[#f9dda9] hover:text-black hover:border-[#f9dda9] transition-colors">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
        </a>
        <a href="#" aria-label="X" class="w-10 h-10 flex items-center justify-center rounded-full bg-black/5 border border-black/10 text-neutral-700 hover:bg-[#f9dda9] hover:text-black hover:border-[#f9dda9] transition-colors">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        </a>
        <a href="#" aria-label="YouTube" class="w-10 h-10 flex items-center justify-center rounded-full bg-black/5 border border-black/10 text-neutral-700 hover:bg-[#f9dda9] hover:text-black hover:border-[#f9dda9] transition-colors">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
        </a>
      </div>

      <p class="text-[10px] text-neutral-500 tracking-[0.14em] uppercase">© <?= date('Y') ?> I Love Comedy Tour</p>
    </div>
  </div>

</div>
