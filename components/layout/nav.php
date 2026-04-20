<!-- ─── Navigation ─── -->
<div x-data="{ mobileOpen: false }"
     x-effect="document.body.style.overflow = mobileOpen ? 'hidden' : ''">

  <header id="cc-main-nav"
          class="fixed top-0 w-full z-50 bg-black">
<!-- Full-width marquee banner -->
    <div class="w-full relative z-10 border-b border-black/20 bg-[#d12027]">
      <div class="flex items-center gap-3 px-5 py-2 overflow-hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="flex-1 overflow-hidden">
          <div class="inline-flex whitespace-nowrap text-sm font-bold text-white animate-[marquee_60s_linear_infinite]">
            <span class="pr-12">Get ready for a hilarious night out filled with non-stop laughs and unforgettable moments at Ronny Chieng! Whether you're looking for the perfect date night, a fun outing with friends, or just a reason to laugh until your sides hurt, we've got the comedy, the craft beer, the wine, and so much more. Don't wait — secure your tickets today and treat yourself to an evening of world-class comedy and great drinks you won't want to miss!</span>
            <span aria-hidden="true" class="pr-12">Get ready for a hilarious night out filled with non-stop laughs and unforgettable moments at Ronny Chieng! Whether you're looking for the perfect date night, a fun outing with friends, or just a reason to laugh until your sides hurt, we've got the comedy, the craft beer, the wine, and so much more. Don't wait — secure your tickets today and treat yourself to an evening of world-class comedy and great drinks you won't want to miss!</span>
          </div>
        </div>
      </div>
    </div>

    <div class="max-w-[1400px] mx-auto px-6 pt-3 pb-3 relative">

      <!-- Desktop Layout -->
      <div class="hidden md:flex md:flex-col">

        <!-- Row: Left nav + Logo + Right nav -->
        <div class="grid grid-cols-3 items-center py-3 relative z-10">
          <!-- Left nav links -->
          <?php
          // Each link: 'view' → internal route (?view=X), OR 'href' → external URL.
          // TODO(dev): replace Store href with the real merch store URL.
          $leftLinks = [
            ['view' => 'calendar', 'label' => 'Tour Dates'],
            ['view' => 'netflix',  'label' => 'Netflix'],
          ];
          $rightLinks = [
            ['href' => '#',        'label' => 'Store', 'external' => true],
            ['view' => 'contact',  'label' => 'Contact'],
          ];
          $renderNavLink = function($link) use ($currentView) {
            $href     = isset($link['href']) ? $link['href'] : '?view=' . $link['view'];
            $isActive = isset($link['view']) && $currentView === $link['view'];
            $target   = !empty($link['external']) ? ' target="_blank" rel="noopener"' : '';
            $cls      = $isActive ? 'cc-nav-active text-[#f9dda9]' : 'text-neutral-300 hover:text-[#f9dda9]';
            echo '<a href="' . htmlspecialchars($href) . '"' . $target . ' class="cc-nav-link relative text-base font-bold transition-colors ' . $cls . '">' . htmlspecialchars($link['label']) . '</a>';
          };
          ?>
          <div class="flex items-center gap-7 justify-self-start">
            <?php foreach ($leftLinks as $link) $renderNavLink($link); ?>
          </div>

          <!-- Center logo -->
          <a href="?view=home" class="justify-self-center hover:opacity-90 transition-opacity">
            <img src="assets/rc-logo.png" alt="Ronny Chieng" class="h-[64px] w-auto object-contain" />
          </a>

          <!-- Right nav links -->
          <div class="flex items-center gap-7 justify-self-end">
            <?php foreach ($rightLinks as $link) $renderNavLink($link); ?>
          </div>
        </div>

      </div>

      <!-- Mobile Layout -->
      <div class="md:hidden flex items-center justify-between py-3">
        <a href="?view=home" class="hover:opacity-90 transition-opacity">
          <img src="assets/rc-logo.png" alt="Ronny Chieng" class="h-[40px] w-auto object-contain" />
        </a>
        <button @click="mobileOpen = true" aria-label="Open menu" class="w-11 h-11 flex items-center justify-center rounded-[10px] bg-white/10 border border-white/10 text-white hover:bg-white/20 transition-colors">
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
       class="fixed top-0 right-0 h-full w-full bg-[#101010] text-neutral-100 z-[70] shadow-2xl overflow-y-auto transition-transform duration-300 md:hidden flex flex-col">

    <!-- Header row -->
    <div class="flex justify-between items-center px-6 py-5 border-b border-white/10">
      <div class="flex items-center gap-2.5">
        <span class="w-1.5 h-1.5 rounded-full bg-[#d12027] animate-pulse"></span>
        <span class="text-[10px] font-extrabold tracking-[0.3em] text-[#f9dda9] uppercase">Menu</span>
      </div>
      <button @click="mobileOpen = false" aria-label="Close menu" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 border border-white/10 hover:bg-[#f9dda9] hover:text-black hover:border-[#f9dda9] transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    </div>

    <!-- Logo -->
    <div class="flex justify-center px-6 pt-8 pb-4">
      <a href="?view=home" @click="mobileOpen = false" class="hover:opacity-90 transition-opacity">
        <img src="assets/rc-logo.png" alt="Ronny Chieng" class="h-[80px] w-auto object-contain" />
      </a>
    </div>

    <!-- Editorial nav list -->
    <nav class="flex-1 px-6 pt-6 pb-6">
      <div class="flex items-center gap-3 mb-6">
        <span class="text-[10px] font-extrabold tracking-[0.3em] text-[#f9dda9] uppercase">Explore</span>
        <span class="flex-1 h-px bg-white/10"></span>
      </div>

      <?php
      // TODO(dev): replace Store href with the real merch store URL.
      $mobileLinks = [
        ['view' => 'calendar', 'label' => 'Tour Dates'],
        ['view' => 'netflix',  'label' => 'Netflix'],
        ['href' => '#',        'label' => 'Store', 'external' => true],
        ['view' => 'contact',  'label' => 'Contact'],
      ];
      foreach ($mobileLinks as $idx => $ml):
        $href     = isset($ml['href']) ? $ml['href'] : '?view=' . $ml['view'];
        $isActive = isset($ml['view']) && $currentView === $ml['view'];
        $target   = !empty($ml['external']) ? ' target="_blank" rel="noopener"' : '';
        $num = str_pad((string)($idx + 1), 2, '0', STR_PAD_LEFT);
      ?>
      <a href="<?= htmlspecialchars($href) ?>"<?= $target ?> @click="mobileOpen = false" class="group flex items-center gap-4 py-5 border-b border-white/10 transition-colors">
        <span class="text-[10px] font-extrabold tracking-[0.24em] text-[#f9dda9]/50 uppercase w-12">N°<?= $num ?></span>
        <span class="flex-1 text-3xl font-extrabold tracking-tight <?= $isActive ? 'text-[#f9dda9]' : 'text-white group-hover:text-[#f9dda9]' ?> transition-colors"><?= htmlspecialchars($ml['label']) ?></span>
        <svg class="w-5 h-5 <?= $isActive ? 'text-[#f9dda9]' : 'text-white/30 group-hover:text-[#f9dda9] group-hover:translate-x-1' ?> transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
      <?php endforeach; ?>
    </nav>

    <!-- Bottom panel: sticker + follow + copyright -->
    <div class="px-6 pt-8 pb-10 bg-[#161616] border-t border-white/10">

      <!-- Rotated red sticker -->
      <div class="flex justify-start mb-6">
        <div class="inline-flex items-center gap-2 bg-[#d12027] text-white text-[10px] font-extrabold uppercase tracking-[0.22em] px-3 py-1.5 border-2 border-black -rotate-2" style="box-shadow: 3px 3px 0 #000;">
          <span aria-hidden="true">★</span>
          Don't Miss A Thing
        </div>
      </div>

      <!-- Follow -->
      <p class="text-[10px] font-extrabold tracking-[0.3em] text-[#f9dda9] uppercase mb-4">Follow Along</p>
      <div class="flex flex-wrap gap-2 mb-8">
        <a href="#" aria-label="Facebook" class="w-11 h-11 flex items-center justify-center bg-white/5 hover:bg-[#f9dda9] hover:text-black text-white border border-white/10 transition-colors">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
        </a>
        <a href="#" aria-label="Instagram" class="w-11 h-11 flex items-center justify-center bg-white/5 hover:bg-[#f9dda9] hover:text-black text-white border border-white/10 transition-colors">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
        </a>
        <a href="#" aria-label="X" class="w-11 h-11 flex items-center justify-center bg-white/5 hover:bg-[#f9dda9] hover:text-black text-white border border-white/10 transition-colors">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        </a>
        <a href="#" aria-label="YouTube" class="w-11 h-11 flex items-center justify-center bg-white/5 hover:bg-[#f9dda9] hover:text-black text-white border border-white/10 transition-colors">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
        </a>
      </div>

      <p class="text-[10px] text-white/30 tracking-[0.14em] uppercase">© <?= date('Y') ?> Ronny Chieng</p>
    </div>
  </div>

</div>
