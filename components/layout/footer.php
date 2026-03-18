<!-- ─── Footer ─── -->
<footer class="relative bg-[#171C1C] pt-24 pb-12">
  <div class="absolute bottom-0 left-0 w-full pointer-events-none z-0 overflow-hidden" style="height: 900px">
    <div class="absolute bottom-[-200px] left-[35%] w-[450px] h-[450px] rounded-full bg-[#8B7CBC] opacity-20 blur-[120px]"></div>
    <div class="absolute bottom-[-250px] left-1/2 -translate-x-1/2 w-[600px] h-[600px] rounded-full bg-[#20ffff] opacity-25 blur-[120px]"></div>
    <div class="absolute bottom-[-200px] right-[35%] w-[450px] h-[450px] rounded-full bg-[#B19139] opacity-15 blur-[120px]"></div>
  </div>
  <div class="max-w-[1200px] mx-auto px-6 relative z-10">
    <div class="grid md:grid-cols-[300px_1fr] gap-12 lg:gap-24 mb-20">
      <!-- Logo & Socials -->
      <div class="space-y-6">
        <img src="<?= $logoImg ?>" alt="Comedy Club" class="h-12 object-contain" />
        <p class="text-neutral-400 text-xs leading-relaxed max-w-xs">Your home for live comedy, culture, and unforgettable nights of entertainment.</p>
        <div class="flex gap-4">
          <a href="#" class="w-8 h-8 rounded-full bg-neutral-800 flex items-center justify-center text-white hover:bg-[#24CECE] hover:text-black transition-all">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="#" class="w-8 h-8 rounded-full bg-neutral-800 flex items-center justify-center text-white hover:bg-[#24CECE] hover:text-black transition-all">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="#" class="w-8 h-8 rounded-full bg-neutral-800 flex items-center justify-center text-white hover:bg-[#24CECE] hover:text-black transition-all">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
        </div>
      </div>
      <!-- Navigation Links -->
      <div class="w-full">
        <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-8 border-b border-[#42B2B4] pb-4">Navigation</h4>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-4 gap-x-8">
          <?php foreach ([
            ['Home','home'],['About Us','about'],['Private Events','private'],['Calendar','schedule'],
            ['Open Mic','openmic'],['Gift Certificates','gift'],['Gallery','gallery'],
            ['Drinks &amp; Snack Menu','menu'],['Comedians','comedians'],['Contact','contact'],
          ] as [$label, $link]): ?>
          <a href="?view=<?= $link ?>" class="text-xs text-neutral-400 font-medium hover:text-[#24CECE] transition-colors"><?= $label ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] text-neutral-400 font-bold uppercase tracking-widest">
      <p>&copy; <?= date('Y') ?> Comedy Club &ndash; All Rights Reserved</p>
      <div class="flex gap-6">
        <a href="#" class="hover:text-white transition-colors">Terms &amp; Conditions</a>
      </div>
    </div>
  </div>
</footer>
