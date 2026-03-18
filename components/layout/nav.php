<!-- ─── Navigation ─── -->
<div x-data="{ mobileOpen: false }"
     x-effect="document.body.style.overflow = mobileOpen ? 'hidden' : ''">

  <header id="cc-main-nav"
          x-data="{ scrolled: false }"
          @scroll.window="scrolled = (window.scrollY > 50)"
          :class="scrolled ? 'cc-nav-scrolled' : ''"
          class="fixed top-0 w-full z-50 bg-black <?= (isset($currentView) && $currentView !== 'home') ? 'overflow-hidden' : '' ?>"
    <!-- Gradient glow (desktop only) -->
    <div class="hidden md:block absolute top-0 left-0 w-full h-[600px] pointer-events-none overflow-hidden">
      <div class="absolute -top-[500px] left-1/2 -translate-x-1/2 ml-[-400px] w-[700px] h-[700px] rounded-full bg-[#F15A29] opacity-50 blur-[130px]"></div>
      <div class="absolute -top-[550px] left-1/2 -translate-x-1/2 ml-[-200px] w-[650px] h-[700px] rounded-full bg-[#ee4211] opacity-45 blur-[130px]"></div>
      <div class="absolute -top-[600px] left-1/2 -translate-x-1/2 w-[700px] h-[700px] rounded-full bg-[#7a2e10] opacity-40 blur-[130px]"></div>
      <div class="absolute -top-[600px] left-1/2 -translate-x-1/2 ml-[200px] w-[600px] h-[700px] rounded-full bg-[#3d1a0e] opacity-35 blur-[130px]"></div>
      <div class="absolute -top-[600px] left-1/2 -translate-x-1/2 ml-[400px] w-[600px] h-[700px] rounded-full bg-[#342b28] opacity-30 blur-[130px]"></div>
    </div>
    <div class="max-w-[1200px] mx-auto px-6 pt-3 pb-4 relative md:min-h-[190px]">

      <!-- Logo - overlaps all rows (desktop only) -->
      <a href="?view=home" class="hidden md:block absolute top-3 left-6 z-10 hover:opacity-90 transition-opacity">
        <img src="assets/logohead.png" alt="Comedy Craft Beer" class="h-[180px] w-auto object-contain" />
      </a>

      <!-- Desktop Layout -->
      <div class="hidden md:flex md:flex-col md:justify-between pl-[210px] min-h-[175px]">

        <!-- Row 1: Site name + Contact info -->
        <div class="flex justify-between items-center py-3 border-b border-white/10">
          <span class="text-sm font-semibold tracking-wide text-neutral-200">Comedy Craft Beer & Wine & More</span>
          <div class="flex items-center gap-6 text-sm text-neutral-300">
            <a href="mailto:ryan@comixcomedy.com" class="flex items-center gap-2 hover:text-white transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#F15A29]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              ryan@comixcomedy.com
            </a>
            <a href="tel:9547296282" class="flex items-center gap-2 hover:text-white transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#F15A29]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              (954) 729-6282
            </a>
          </div>
        </div>

        <!-- Row 2: Navigation links -->
        <div class="flex items-center justify-between py-3">
          <?php
          $navLinks = [
            ['view' => 'about', 'label' => 'About'],
            ['view' => 'calendar', 'label' => 'Calendar'],
            ['view' => 'comedians', 'label' => 'Comedians'],
            ['view' => '', 'label' => 'Comedy in the Oasis Room', 'href' => '#'],
            ['view' => 'gift', 'label' => 'Gift Certificates'],
            ['view' => 'hotel', 'label' => 'Hotel Info'],
            ['view' => 'contact', 'label' => 'Contact'],
            ['view' => 'management', 'label' => 'Management'],
          ];
          foreach ($navLinks as $link):
            $href = isset($link['href']) ? $link['href'] : '?view=' . $link['view'];
            $isActive = ($currentView === $link['view']) || ($currentView === explode('&', $link['view'])[0] && strpos($link['view'], '&') !== false);
            $activeClass = $isActive ? ' text-[#F15A29]' : '';
          ?>
          <a href="<?= $href ?>" class="text-sm font-medium transition-colors <?= $isActive ? 'text-[#F15A29]' : 'text-neutral-300 hover:text-white' ?>"><?= $link['label'] ?></a>
          <?php endforeach; ?>
        </div>

        <!-- Row 3: Announcement + Social icons -->
        <div class="flex items-stretch gap-4 py-3">
          <div class="flex-1 flex items-center gap-3 bg-black rounded-[10px] px-5 border border-white/10 overflow-hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-neutral-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="flex-1 overflow-hidden">
              <span class="inline-block whitespace-nowrap text-sm font-bold text-neutral-300 animate-[marquee_60s_linear_infinite]">Get ready for a hilarious night out filled with non-stop laughs and unforgettable moments at Comedy Craft Beer &amp; Wine &amp; More! Whether you're looking for the perfect date night, a fun outing with friends, or just a reason to laugh until your sides hurt, we've got the comedy, the craft beer, the wine, and so much more. Don't wait — secure your tickets today and treat yourself to an evening of world-class comedy and great drinks you won't want to miss!</span>
            </div>
          </div>
          <div class="flex items-center gap-2 bg-black rounded-[10px] px-3 py-3 border border-white/10">
            <a href="#" class="w-7 h-7 rounded-full bg-white text-black flex items-center justify-center hover:bg-neutral-200 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
            </a>
            <a href="#" class="w-7 h-7 rounded-full bg-white text-black flex items-center justify-center hover:bg-neutral-200 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
            <a href="#" class="w-7 h-7 rounded-full bg-white text-black flex items-center justify-center hover:bg-neutral-200 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
          </div>
        </div>

      </div>

      <!-- Mobile Layout -->
      <div class="md:hidden flex items-center justify-between py-3">
        <a href="?view=home" class="text-white font-extrabold text-xl uppercase tracking-wide leading-tight">
          Comedy Craft Beer<br />&amp; Wine &amp; More
        </a>
        <button @click="mobileOpen = true" class="w-11 h-11 flex items-center justify-center rounded-[10px] bg-white/10 border border-white/10 text-white hover:bg-white/20 transition-colors">
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
  <div x-cloak :class="mobileOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed top-0 left-0 h-full w-full bg-black text-neutral-100 z-[70] shadow-2xl overflow-y-auto transition-transform duration-300 md:hidden">
    <div class="p-6">
      <div class="flex justify-between items-center mb-8">
        <a href="?view=home" class="text-white font-extrabold text-xl uppercase tracking-wide leading-tight">Comedy Craft Beer<br />&amp; Wine &amp; More</a>
        <button @click="mobileOpen = false" class="w-10 h-10 flex items-center justify-center rounded-[10px] bg-white/10 hover:bg-white/20 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
      </div>
      <nav class="space-y-4">
        <a href="?view=home" class="block text-base font-medium hover:text-[#F15A29] transition-colors">Home</a>
        <a href="?view=about" class="block text-base font-medium hover:text-[#F15A29] transition-colors">About</a>
        <a href="?view=calendar" class="block text-base font-medium hover:text-[#F15A29] transition-colors">Calendar</a>
        <a href="?view=comedians" class="block text-base font-medium hover:text-[#F15A29] transition-colors">Comedians</a>
        <a href="#" class="block text-base font-medium hover:text-[#F15A29] transition-colors">Comedy in the Oasis Room</a>
        <a href="?view=gift" class="block text-base font-medium hover:text-[#F15A29] transition-colors">Gift Certificates</a>
        <a href="?view=hotel" class="block text-base font-medium hover:text-[#F15A29] transition-colors">Hotel Info</a>
        <a href="?view=contact" class="block text-base font-medium hover:text-[#F15A29] transition-colors">Contact</a>
        <a href="?view=management" class="block text-base font-medium hover:text-[#F15A29] transition-colors">Management</a>
      </nav>
      <div class="mt-8 pt-6 border-t border-white/10 space-y-3">
        <a href="mailto:ryan@comixcomedy.com" class="flex items-center gap-2 text-sm text-neutral-400 hover:text-white transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          ryan@comixcomedy.com
        </a>
        <a href="tel:9547296282" class="flex items-center gap-2 text-sm text-neutral-400 hover:text-white transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          (954) 729-6282
        </a>
      </div>
      <div class="mt-6 flex items-center gap-3">
        <a href="#" class="w-9 h-9 rounded-full bg-white text-black flex items-center justify-center hover:bg-neutral-200 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
        </a>
        <a href="#" class="w-9 h-9 rounded-full bg-white text-black flex items-center justify-center hover:bg-neutral-200 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
        </a>
        <a href="#" class="w-9 h-9 rounded-full bg-white text-black flex items-center justify-center hover:bg-neutral-200 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        </a>
      </div>
      <!-- Logo at bottom -->
      <div class="mt-10 pt-6 border-t border-white/10 flex justify-center">
        <img src="assets/logofoot.png" alt="Comedy Craft Beer" class="w-48 object-contain" />
      </div>
    </div>
  </div>

</div>
