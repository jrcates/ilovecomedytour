<!-- ─── Navigation ─── -->
<div x-data="{ mobileOpen: false, drawerOpen: false }"
     x-effect="document.body.style.overflow = (mobileOpen || drawerOpen) ? 'hidden' : ''">

  <header id="cc-main-nav"
          class="fixed top-0 w-full z-50 bg-black">
    <!-- Gradient glow (desktop only) -->
    <div class="hidden md:block absolute top-0 left-0 w-full h-[600px] pointer-events-none overflow-hidden">
      <div class="absolute -top-[500px] left-1/2 -translate-x-1/2 ml-[-400px] w-[700px] h-[700px] rounded-full bg-[#d12027] opacity-50 blur-[130px]"></div>
      <div class="absolute -top-[550px] left-1/2 -translate-x-1/2 ml-[-200px] w-[650px] h-[700px] rounded-full bg-[#b81d23] opacity-45 blur-[130px]"></div>
      <div class="absolute -top-[600px] left-1/2 -translate-x-1/2 w-[700px] h-[700px] rounded-full bg-[#7f1318] opacity-40 blur-[130px]"></div>
      <div class="absolute -top-[600px] left-1/2 -translate-x-1/2 ml-[200px] w-[600px] h-[700px] rounded-full bg-[#3d1015] opacity-35 blur-[130px]"></div>
      <div class="absolute -top-[600px] left-1/2 -translate-x-1/2 ml-[400px] w-[600px] h-[700px] rounded-full bg-[#383839] opacity-30 blur-[130px]"></div>
      <div class="absolute -top-[550px] left-1/2 -translate-x-1/2 ml-[300px] w-[650px] h-[700px] rounded-full bg-[#f4a3a6] opacity-20 blur-[130px]"></div>
      <div class="absolute -top-[500px] left-1/2 -translate-x-1/2 ml-[600px] w-[700px] h-[700px] rounded-full bg-[#d4d4d4] opacity-15 blur-[130px]"></div>
    </div>
    <div class="max-w-[1200px] mx-auto px-6 pt-3 pb-3 relative">

      <!-- Desktop Layout -->
      <div class="hidden md:flex md:flex-col">

        <!-- Row 1: Contact info + Social icons -->
        <div class="flex justify-between items-center py-2 border-b border-white/10">
          <div class="flex items-center gap-6 text-sm text-neutral-300">
            <a href="mailto:comedybreakin205@gmail.com" class="flex items-center gap-2 hover:text-white transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d12027]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              comedybreakin205@gmail.com
            </a>
            <a href="tel:0000000000" class="flex items-center gap-2 hover:text-white transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d12027]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              (000) 000-0000
            </a>
          </div>
          <div class="flex items-center gap-2">
            <a href="#" aria-label="Facebook" class="w-7 h-7 rounded-full bg-white text-black flex items-center justify-center hover:bg-neutral-200 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
            </a>
            <a href="#" aria-label="Instagram" class="w-7 h-7 rounded-full bg-white text-black flex items-center justify-center hover:bg-neutral-200 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
            <a href="#" aria-label="X" class="w-7 h-7 rounded-full bg-white text-black flex items-center justify-center hover:bg-neutral-200 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <a href="#" aria-label="YouTube" class="w-7 h-7 rounded-full bg-white text-black flex items-center justify-center hover:bg-neutral-200 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            </a>
          </div>
        </div>

        <!-- Row 2: Left nav + Logo + Right nav + More -->
        <div class="flex items-center justify-between py-3 relative z-10">
          <!-- Left nav links -->
          <div class="flex items-center gap-6">
            <?php
            $leftLinks = [
              ['view' => 'about', 'label' => 'About'],
              ['view' => 'calendar', 'label' => 'Calendar'],
              ['view' => 'comedians', 'label' => 'Comedians'],
            ];
            foreach ($leftLinks as $link):
              $isActive = ($currentView === $link['view']);
            ?>
            <a href="?view=<?= $link['view'] ?>" class="text-base font-bold transition-colors <?= $isActive ? 'text-[#d12027]' : 'text-neutral-300 hover:text-white' ?>"><?= $link['label'] ?></a>
            <?php endforeach; ?>
          </div>

          <!-- Center logo -->
          <a href="?view=home" class="hover:opacity-90 transition-opacity">
            <img src="assets/comedybreakinn-logo-white.png" alt="Comedy Break In" class="h-[140px] w-auto object-contain" />
          </a>

          <!-- Right nav links + More -->
          <div class="flex items-center gap-6">
            <a href="?view=gift" class="text-base font-bold transition-colors <?= $currentView === 'gift' ? 'text-[#d12027]' : 'text-neutral-300 hover:text-white' ?>">Gift Certificates</a>
            <!-- Contact with dropdown -->
            <div class="relative" x-data="{ open: false, sub: false }" @click.outside="open = false; sub = false">
              <button @click="open = !open" class="text-base font-bold transition-colors flex items-center gap-1 <?= $currentView === 'contact' ? 'text-[#d12027]' : 'text-neutral-300 hover:text-white' ?>">
                Contact
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
              </button>
              <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1" class="absolute top-full right-0 mt-2 w-52 bg-black border border-white/10 rounded-[10px] py-2 shadow-xl">
                <a href="?view=contact" class="block px-4 py-2 text-sm text-neutral-300 hover:text-white hover:bg-white/5 transition-colors">Contact</a>
                <a href="#" class="block px-4 py-2 text-sm text-neutral-300 hover:text-white hover:bg-white/5 transition-colors">Dropdown Test 2</a>
                <a href="#" class="block px-4 py-2 text-sm text-neutral-300 hover:text-white hover:bg-white/5 transition-colors">Dropdown Test 3</a>
                <a href="#" class="block px-4 py-2 text-sm text-neutral-300 hover:text-white hover:bg-white/5 transition-colors">Dropdown Test 4</a>
                <!-- Dropdown Test 5 with sub-dropdown -->
                <div class="relative" @mouseenter="sub = true" @mouseleave="sub = false">
                  <button @click="sub = !sub" class="w-full flex items-center justify-between px-4 py-2 text-sm text-neutral-300 hover:text-white hover:bg-white/5 transition-colors">
                    Dropdown Test 5
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                  </button>
                  <div x-cloak x-show="sub" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-x-1" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-1" class="absolute top-0 right-full mr-1 w-48 bg-black border border-white/10 rounded-[10px] py-2 shadow-xl">
                    <a href="#" class="block px-4 py-2 text-sm text-neutral-300 hover:text-white hover:bg-white/5 transition-colors">Dropdown Test 5-1</a>
                    <a href="#" class="block px-4 py-2 text-sm text-neutral-300 hover:text-white hover:bg-white/5 transition-colors">Dropdown Test 5-2</a>
                    <a href="#" class="block px-4 py-2 text-sm text-neutral-300 hover:text-white hover:bg-white/5 transition-colors">Dropdown Test 5-3</a>
                  </div>
                </div>
              </div>
            </div>
            <button @click="drawerOpen = true" class="text-base font-bold text-neutral-300 hover:text-white transition-colors flex items-center gap-1.5">
              More
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
            </button>
          </div>
        </div>

        <!-- Row 3: Marquee banner -->
        <div class="flex items-stretch gap-4 py-2">
          <div class="flex-1 flex items-center gap-3 bg-black rounded-[10px] px-5 py-3 border border-white/10 overflow-hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-neutral-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="flex-1 overflow-hidden">
              <span class="inline-block whitespace-nowrap text-sm font-bold text-neutral-300 animate-[marquee_60s_linear_infinite]">Get ready for a hilarious night out filled with non-stop laughs and unforgettable moments at Comedy Break In! Whether you're looking for the perfect date night, a fun outing with friends, or just a reason to laugh until your sides hurt, we've got the comedy, the craft beer, the wine, and so much more. Don't wait — secure your tickets today and treat yourself to an evening of world-class comedy and great drinks you won't want to miss!</span>
            </div>
          </div>
        </div>

      </div>

      <!-- Mobile Layout -->
      <div class="md:hidden flex items-center justify-between py-3">
        <a href="?view=home" class="hover:opacity-90 transition-opacity">
          <img src="assets/comedybreakinn-logo-white.png" alt="Comedy Break In" class="h-[100px] w-auto object-contain" />
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
       class="fixed top-0 right-0 h-full w-full bg-black text-neutral-100 z-[70] shadow-2xl overflow-y-auto transition-transform duration-300 md:hidden">
    <div class="p-8">
      <div class="flex justify-between items-center mb-10">
        <span class="text-white font-bold text-lg">Menu</span>
        <button @click="mobileOpen = false" aria-label="Close menu" class="w-10 h-10 flex items-center justify-center rounded-[10px] bg-white/10 hover:bg-white/20 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
      </div>
      <!-- Logo -->
      <div class="flex justify-center mb-10">
        <a href="?view=home" class="hover:opacity-90 transition-opacity">
          <img src="assets/comedybreakinn-logo-white.png" alt="Comedy Break In" class="h-[120px] w-auto object-contain" />
        </a>
      </div>
      <nav class="space-y-4">
        <?php
        $mobileLinks = [
          ['view' => 'home', 'label' => 'Home'],
          ['view' => 'about', 'label' => 'About'],
          ['view' => 'calendar', 'label' => 'Calendar'],
          ['view' => 'comedians', 'label' => 'Comedians'],
          ['view' => 'clips', 'label' => 'Comedy Clips'],
          ['view' => 'gift', 'label' => 'Gift Certificates'],
        ];
        foreach ($mobileLinks as $ml):
          $isActive = ($currentView === $ml['view']);
        ?>
        <a href="?view=<?= $ml['view'] ?>" @click="mobileOpen = false" class="block text-base font-medium transition-colors <?= $isActive ? 'text-[#d12027]' : 'hover:text-[#d12027]' ?>"><?= $ml['label'] ?></a>
        <?php endforeach; ?>
        <!-- Contact with sub-items always visible -->
        <span class="block text-base font-medium text-white">Contact</span>
        <div class="pl-4 mt-1 space-y-2 border-l border-white/10">
          <a href="?view=contact" @click="mobileOpen = false" class="block text-sm transition-colors py-1 <?= $currentView === 'contact' ? 'text-[#d12027]' : 'text-neutral-300 hover:text-white' ?>">Contact</a>
          <a href="#" @click="mobileOpen = false" class="block text-sm text-neutral-300 hover:text-white transition-colors py-1">Dropdown Test 2</a>
          <a href="#" @click="mobileOpen = false" class="block text-sm text-neutral-300 hover:text-white transition-colors py-1">Dropdown Test 3</a>
          <a href="#" @click="mobileOpen = false" class="block text-sm text-neutral-300 hover:text-white transition-colors py-1">Dropdown Test 4</a>
          <span class="block text-sm text-neutral-300">Dropdown Test 5</span>
          <div class="pl-4 space-y-1 border-l border-white/10">
            <a href="#" @click="mobileOpen = false" class="block text-sm text-neutral-400 hover:text-white transition-colors py-1">Dropdown Test 5-1</a>
            <a href="#" @click="mobileOpen = false" class="block text-sm text-neutral-400 hover:text-white transition-colors py-1">Dropdown Test 5-2</a>
            <a href="#" @click="mobileOpen = false" class="block text-sm text-neutral-400 hover:text-white transition-colors py-1">Dropdown Test 5-3</a>
          </div>
        </div>
      </nav>
      <div class="mt-8 pt-6 border-t border-white/10 space-y-3">
        <a href="mailto:comedybreakin205@gmail.com" class="flex items-center gap-2 text-sm text-neutral-400 hover:text-white transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          comedybreakin205@gmail.com
        </a>
        <a href="tel:0000000000" class="flex items-center gap-2 text-sm text-neutral-400 hover:text-white transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          (000) 000-0000
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
    </div>
  </div>

  <!-- ─── Desktop "More" Drawer Backdrop ─── -->
  <div x-cloak :class="drawerOpen ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'"
       @click="drawerOpen = false"
       class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] hidden md:block transition-opacity duration-300"></div>

  <!-- ─── Desktop "More" Drawer ─── -->
  <div x-cloak :class="drawerOpen ? 'translate-x-0' : 'translate-x-full'"
       class="fixed top-0 right-0 h-full w-[400px] bg-black text-neutral-100 z-[70] shadow-2xl overflow-y-auto transition-transform duration-300 hidden md:block">
    <div class="p-8">
      <div class="flex justify-between items-center mb-10">
        <span class="text-white font-bold text-lg">Menu</span>
        <button @click="drawerOpen = false" aria-label="Close menu" class="w-10 h-10 flex items-center justify-center rounded-[10px] bg-white/10 hover:bg-white/20 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
      </div>
      <!-- Logo -->
      <div class="flex justify-center mb-10">
        <a href="?view=home" class="hover:opacity-90 transition-opacity">
          <img src="assets/comedybreakinn-logo-white.png" alt="Comedy Break In" class="h-[120px] w-auto object-contain" />
        </a>
      </div>
      <nav class="space-y-4">
        <?php
        $drawerLinks = [
          ['view' => 'home', 'label' => 'Home'],
          ['view' => 'about', 'label' => 'About'],
          ['view' => 'calendar', 'label' => 'Calendar'],
          ['view' => 'comedians', 'label' => 'Comedians'],
          ['view' => 'clips', 'label' => 'Comedy Clips'],
          ['view' => 'gift', 'label' => 'Gift Certificates'],
        ];
        foreach ($drawerLinks as $dl):
          $isActive = ($currentView === $dl['view']);
        ?>
        <a href="?view=<?= $dl['view'] ?>" @click="drawerOpen = false" class="block text-base font-medium transition-colors <?= $isActive ? 'text-[#d12027]' : 'hover:text-[#d12027]' ?>"><?= $dl['label'] ?></a>
        <?php endforeach; ?>
        <!-- Contact with sub-items always visible -->
        <span class="block text-base font-medium text-white">Contact</span>
        <div class="pl-4 mt-1 space-y-2 border-l border-white/10">
          <a href="?view=contact" @click="drawerOpen = false" class="block text-sm transition-colors py-1 <?= $currentView === 'contact' ? 'text-[#d12027]' : 'text-neutral-300 hover:text-white' ?>">Contact</a>
          <a href="#" @click="drawerOpen = false" class="block text-sm text-neutral-300 hover:text-white transition-colors py-1">Dropdown Test 2</a>
          <a href="#" @click="drawerOpen = false" class="block text-sm text-neutral-300 hover:text-white transition-colors py-1">Dropdown Test 3</a>
          <a href="#" @click="drawerOpen = false" class="block text-sm text-neutral-300 hover:text-white transition-colors py-1">Dropdown Test 4</a>
          <span class="block text-sm text-neutral-300">Dropdown Test 5</span>
          <div class="pl-4 space-y-1 border-l border-white/10">
            <a href="#" @click="drawerOpen = false" class="block text-sm text-neutral-400 hover:text-white transition-colors py-1">Dropdown Test 5-1</a>
            <a href="#" @click="drawerOpen = false" class="block text-sm text-neutral-400 hover:text-white transition-colors py-1">Dropdown Test 5-2</a>
            <a href="#" @click="drawerOpen = false" class="block text-sm text-neutral-400 hover:text-white transition-colors py-1">Dropdown Test 5-3</a>
          </div>
        </div>
      </nav>
      <div class="mt-8 pt-6 border-t border-white/10 space-y-3">
        <a href="mailto:comedybreakin205@gmail.com" class="flex items-center gap-2 text-sm text-neutral-400 hover:text-white transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          comedybreakin205@gmail.com
        </a>
        <a href="tel:0000000000" class="flex items-center gap-2 text-sm text-neutral-400 hover:text-white transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          (000) 000-0000
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
    </div>
  </div>

</div>
