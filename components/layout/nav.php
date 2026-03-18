<!-- ─── Navigation ─── -->
<div x-data="{ drawerOpen: false }"
     x-effect="document.body.style.overflow = drawerOpen ? 'hidden' : ''">

  <nav id="cc-main-nav"
       x-data="{ scrolled: false }"
       @scroll.window="scrolled = (window.scrollY > 50)"
       :class="scrolled ? 'cc-nav-scrolled py-4' : 'py-[50px]'"
       class="fixed top-0 w-full z-50">
    <div class="max-w-[1200px] mx-auto px-6 flex justify-between items-center">
      <a href="?view=home" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
        <img src="<?= $logoImg ?>" alt="Logo" class="h-12 object-contain" />
      </a>

      <!-- Desktop Nav -->
      <div class="hidden md:flex items-center gap-8">
        <a href="?view=schedule" class="text-sm font-bold uppercase tracking-wider text-neutral-400 hover:text-white transition-colors">Calendar</a>
        <a href="?view=contact" class="text-sm font-bold uppercase tracking-wider text-neutral-400 hover:text-white transition-colors">Contact</a>
        <button @click="drawerOpen = true" class="px-6 py-2 bg-[#24CECE] text-black font-bold rounded-full hover:bg-[#20B8B8] transition-colors uppercase tracking-wider text-xs">More</button>
      </div>

      <!-- Mobile Menu Button -->
      <button @click="drawerOpen = true" class="md:hidden text-neutral-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
      </button>
    </div>
  </nav>

  <!-- ─── Drawer Backdrop ─── -->
  <div id="cc-drawer-backdrop"
       :class="drawerOpen ? 'cc-drawer-open' : ''"
       @click="drawerOpen = false"
       class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60]"></div>

  <!-- ─── Navigation Drawer ─── -->
  <div id="cc-nav-drawer"
       :class="drawerOpen ? 'cc-drawer-open' : ''"
       class="fixed top-0 right-0 h-full w-full md:w-[400px] bg-white text-neutral-900 z-[70] shadow-2xl overflow-y-auto">
    <div class="p-8">
      <div class="flex justify-between items-center mb-12">
        <img src="<?= $logoImgAlt ?>" alt="Logo" class="h-10 object-contain" />
        <button @click="drawerOpen = false" class="p-2 hover:bg-neutral-100 rounded-[5px] transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
      </div>
      <nav class="space-y-6">
        <a href="?view=home" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Home</a>
        <div class="space-y-3">
          <div class="font-bold text-lg">About</div>
          <div class="pl-6 space-y-3 border-l-2 border-neutral-100 ml-1">
            <a href="?view=about" class="block text-neutral-600 hover:text-[#24CECE] font-medium transition-colors">About Us</a>
            <a href="?view=private" class="block text-neutral-600 hover:text-[#24CECE] font-medium transition-colors">Private Events</a>
          </div>
        </div>
        <a href="?view=schedule" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Calendar</a>
        <a href="?view=openmic" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Open Mics</a>
        <a href="?view=gift" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Gift Certificates</a>
        <a href="?view=gallery" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Gallery</a>
        <a href="?view=menu" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Drink &amp; Snack Menu</a>
        <a href="?view=comedians" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Comedians</a>
        <div class="space-y-3">
          <div class="font-bold text-lg">Contact</div>
          <div class="pl-6 space-y-3 border-l-2 border-neutral-100 ml-1">
            <a href="?view=contact&tab=contact" class="block text-neutral-600 hover:text-[#24CECE] font-medium transition-colors">Contact Us</a>
            <a href="?view=contact&tab=talent" class="block text-neutral-600 hover:text-[#24CECE] font-medium transition-colors">New Talent</a>
            <a href="?view=contact&tab=producers" class="block text-neutral-600 hover:text-[#24CECE] font-medium transition-colors">Comedy Show Producers</a>
          </div>
        </div>
      </nav>
    </div>
  </div>

</div>
