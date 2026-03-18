<div class="pt-[130px] md:pt-[250px] pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen">

  <h1 class="text-3xl md:text-4xl font-extrabold text-black mb-3 tracking-tight">Design System</h1>
  <p class="text-neutral-500 text-sm mb-16">A reference guide for all UI patterns, tokens, and components used across Comedy Craft Beer.</p>

  <!-- ─── Colors ─── -->
  <section class="mb-16">
    <h2 class="text-2xl font-bold text-black mb-6 border-b border-neutral-200 pb-3">Colors</h2>

    <h3 class="text-sm font-bold text-neutral-400 uppercase tracking-wider mb-4">Primary</h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
      <div>
        <div class="h-20 rounded-xl bg-[#F15A29] mb-2"></div>
        <p class="text-xs font-bold text-black">Orange</p>
        <p class="text-xs text-neutral-500">#F15A29</p>
      </div>
      <div>
        <div class="h-20 rounded-xl bg-[#E99474] mb-2"></div>
        <p class="text-xs font-bold text-black">Salmon</p>
        <p class="text-xs text-neutral-500">#E99474</p>
      </div>
      <div>
        <div class="h-20 rounded-xl bg-black mb-2"></div>
        <p class="text-xs font-bold text-black">Black</p>
        <p class="text-xs text-neutral-500">#000000</p>
      </div>
      <div>
        <div class="h-20 rounded-xl bg-white border border-neutral-200 mb-2"></div>
        <p class="text-xs font-bold text-black">White</p>
        <p class="text-xs text-neutral-500">#FFFFFF</p>
      </div>
    </div>

    <h3 class="text-sm font-bold text-neutral-400 uppercase tracking-wider mb-4">Backgrounds</h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
      <div>
        <div class="h-20 rounded-xl bg-black mb-2"></div>
        <p class="text-xs font-bold text-black">Dark BG</p>
        <p class="text-xs text-neutral-500">#000000</p>
      </div>
      <div>
        <div class="h-20 rounded-xl bg-[#1e1e1e] mb-2"></div>
        <p class="text-xs font-bold text-black">Card Dark</p>
        <p class="text-xs text-neutral-500">#1E1E1E</p>
      </div>
      <div>
        <div class="h-20 rounded-xl bg-[#383838] mb-2"></div>
        <p class="text-xs font-bold text-black">Gray Pill</p>
        <p class="text-xs text-neutral-500">#383838</p>
      </div>
      <div>
        <div class="h-20 rounded-xl bg-neutral-100 mb-2"></div>
        <p class="text-xs font-bold text-black">Light Gray</p>
        <p class="text-xs text-neutral-500">neutral-100</p>
      </div>
    </div>

    <h3 class="text-sm font-bold text-neutral-400 uppercase tracking-wider mb-4">Text</h3>
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-black flex-shrink-0"></div>
        <div><p class="text-xs font-bold text-black">Black</p><p class="text-xs text-neutral-500">Headings</p></div>
      </div>
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-neutral-400 flex-shrink-0"></div>
        <div><p class="text-xs font-bold text-black">neutral-400</p><p class="text-xs text-neutral-500">Icons</p></div>
      </div>
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-neutral-500 flex-shrink-0"></div>
        <div><p class="text-xs font-bold text-black">neutral-500</p><p class="text-xs text-neutral-500">Body text</p></div>
      </div>
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-neutral-600 flex-shrink-0"></div>
        <div><p class="text-xs font-bold text-black">neutral-600</p><p class="text-xs text-neutral-500">Descriptions</p></div>
      </div>
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-white border border-neutral-200 flex-shrink-0"></div>
        <div><p class="text-xs font-bold text-black">White</p><p class="text-xs text-neutral-500">On dark BG</p></div>
      </div>
    </div>
  </section>

  <!-- ─── Typography ─── -->
  <section class="mb-16">
    <h2 class="text-2xl font-bold text-black mb-6 border-b border-neutral-200 pb-3">Typography</h2>
    <p class="text-neutral-500 text-xs mb-8">Font: <span class="text-black font-bold">Montserrat</span> &mdash; Weights: 400, 500, 600, 700, 800, 900</p>

    <div class="space-y-6">
      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8">
        <span class="text-xs text-neutral-500 w-[160px] flex-shrink-0">Page Title (H1)</span>
        <span class="text-3xl md:text-4xl font-extrabold text-black leading-tight">Heading One</span>
      </div>
      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8">
        <span class="text-xs text-neutral-500 w-[160px] flex-shrink-0">Section Title (H2)</span>
        <span class="text-3xl md:text-4xl font-bold text-black">Heading Two</span>
      </div>
      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8">
        <span class="text-xs text-neutral-500 w-[160px] flex-shrink-0">Card Title (H3)</span>
        <span class="text-lg font-bold text-black">Heading Three</span>
      </div>
      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8">
        <span class="text-xs text-neutral-500 w-[160px] flex-shrink-0">Subsection (H4)</span>
        <span class="text-lg font-bold text-black">Heading Four</span>
      </div>
      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8">
        <span class="text-xs text-neutral-500 w-[160px] flex-shrink-0">Body (14px)</span>
        <span class="text-sm text-neutral-600 leading-relaxed">The quick brown fox jumps over the lazy dog. Body text for descriptions and general content.</span>
      </div>
      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8">
        <span class="text-xs text-neutral-500 w-[160px] flex-shrink-0">Caption (12px)</span>
        <span class="text-xs text-neutral-500">Small text used in pills, badges, and metadata.</span>
      </div>
    </div>
  </section>

  <!-- ─── Buttons ─── -->
  <section class="mb-16">
    <h2 class="text-2xl font-bold text-black mb-6 border-b border-neutral-200 pb-3">Buttons</h2>
    <p class="text-neutral-500 text-xs mb-8">All buttons use <span class="text-black font-bold">rounded-[10px]</span> (10px border radius), <span class="text-black font-bold">font-bold</span>, <span class="text-black font-bold">text-sm</span></p>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Black Button -->
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Primary (Black)</p>
        <a href="#" class="inline-block px-6 py-2.5 bg-black text-white font-bold text-sm rounded-[10px] hover:bg-neutral-800 transition-colors">Buy Tickets</a>
        <div class="mt-4 text-xs text-neutral-500 space-y-1">
          <p>BG: <span class="text-black">bg-black</span></p>
          <p>Text: <span class="text-black">text-white</span></p>
          <p>Hover: <span class="text-black">bg-neutral-800</span></p>
          <p>Padding: <span class="text-black">px-6 py-2.5</span></p>
        </div>
      </div>

      <!-- White Button -->
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Secondary (White)</p>
        <a href="#" class="inline-block px-6 py-2.5 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-neutral-200 transition-colors border border-neutral-200">Buy Tickets</a>
        <div class="mt-4 text-xs text-neutral-500 space-y-1">
          <p>BG: <span class="text-black">bg-white</span></p>
          <p>Text: <span class="text-black">text-black</span></p>
          <p>Hover: <span class="text-black">bg-neutral-200</span></p>
          <p>Padding: <span class="text-black">px-6 py-2.5</span></p>
        </div>
      </div>

      <!-- Salmon Button -->
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Accent (Salmon)</p>
        <a href="#" class="inline-block px-6 py-2.5 bg-[#E99474] text-black font-bold text-sm rounded-[10px] hover:bg-[#D4845F] transition-colors">View Menu</a>
        <div class="mt-4 text-xs text-neutral-500 space-y-1">
          <p>BG: <span class="text-black">#E99474</span></p>
          <p>Text: <span class="text-black">text-black</span></p>
          <p>Hover: <span class="text-black">#D4845F</span></p>
          <p>Padding: <span class="text-black">px-6 py-2.5</span></p>
        </div>
      </div>

      <!-- Orange Button -->
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Orange (CTA)</p>
        <a href="#" class="inline-block px-6 py-2.5 bg-[#F15A29] text-white font-bold text-sm rounded-[10px] hover:bg-[#D94E22] transition-colors">Promo Dates</a>
        <div class="mt-4 text-xs text-neutral-500 space-y-1">
          <p>BG: <span class="text-black">#F15A29</span></p>
          <p>Text: <span class="text-black">text-white</span></p>
          <p>Hover: <span class="text-black">#D94E22</span></p>
          <p>Padding: <span class="text-black">px-6 py-2.5</span></p>
        </div>
      </div>

      <!-- Full Width Button -->
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200 sm:col-span-2">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Full Width</p>
        <a href="#" class="block w-full py-4 bg-black text-white font-bold text-center rounded-[10px] hover:bg-neutral-800 transition-colors text-sm">See Full Calendar</a>
        <div class="mt-4 text-xs text-neutral-500 space-y-1">
          <p>BG: <span class="text-black">bg-black</span> &middot; Width: <span class="text-black">w-full</span> &middot; Padding: <span class="text-black">py-4</span></p>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── Pills & Badges ─── -->
  <section class="mb-16">
    <h2 class="text-2xl font-bold text-black mb-6 border-b border-neutral-200 pb-3">Pills &amp; Badges</h2>
    <p class="text-neutral-500 text-xs mb-8">All pills use <span class="text-black font-bold">rounded-full</span>, <span class="text-black font-bold">text-xs</span>, with icon + text layout</p>

    <div class="flex flex-wrap gap-4 mb-6">
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-3">Date Pill</p>
        <span class="inline-flex items-center gap-1.5 bg-[#F15A29] text-white text-xs font-semibold px-3 py-1 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          Fri, 21 Nov 2026
        </span>
        <p class="mt-3 text-xs text-neutral-500">bg-[#F15A29] &middot; px-3 py-1</p>
      </div>

      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-3">Time Pill</p>
        <span class="inline-flex items-center gap-1.5 bg-[#F15A29] text-white text-xs font-semibold px-3 py-1 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          07:00PM
        </span>
        <p class="mt-3 text-xs text-neutral-500">bg-[#F15A29] &middot; px-3 py-1</p>
      </div>

      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-3">Location Pill (Light)</p>
        <span class="inline-flex items-center gap-1.5 bg-neutral-100 text-neutral-600 text-xs font-medium px-3 py-1.5 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          Crystal Ridge Winery
        </span>
        <p class="mt-3 text-xs text-neutral-500">bg-neutral-100 &middot; px-3 py-1.5</p>
      </div>

      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-3">Location Pill (Dark)</p>
        <span class="inline-flex items-center gap-1.5 bg-[#383838] text-neutral-300 text-xs font-medium px-3 py-1.5 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          Crystal Ridge Winery
        </span>
        <p class="mt-3 text-xs text-neutral-500">bg-[#383838] &middot; px-3 py-1.5</p>
      </div>
    </div>
  </section>

  <!-- ─── Border Radius ─── -->
  <section class="mb-16">
    <h2 class="text-2xl font-bold text-black mb-6 border-b border-neutral-200 pb-3">Border Radius</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
      <div class="text-center">
        <div class="w-20 h-20 mx-auto bg-[#F15A29] rounded-[5px] mb-3"></div>
        <p class="text-xs font-bold text-black">5px</p>
        <p class="text-xs text-neutral-500">rounded-[5px]</p>
        <p class="text-xs text-neutral-400">Tabs, date badges</p>
      </div>
      <div class="text-center">
        <div class="w-20 h-20 mx-auto bg-[#F15A29] rounded-[10px] mb-3"></div>
        <p class="text-xs font-bold text-black">10px</p>
        <p class="text-xs text-neutral-500">rounded-[10px]</p>
        <p class="text-xs text-neutral-400">Buttons, inputs</p>
      </div>
      <div class="text-center">
        <div class="w-20 h-20 mx-auto bg-[#F15A29] rounded-xl mb-3"></div>
        <p class="text-xs font-bold text-black">12px</p>
        <p class="text-xs text-neutral-500">rounded-xl</p>
        <p class="text-xs text-neutral-400">Cards</p>
      </div>
      <div class="text-center">
        <div class="w-20 h-20 mx-auto bg-[#F15A29] rounded-full mb-3"></div>
        <p class="text-xs font-bold text-black">Full</p>
        <p class="text-xs text-neutral-500">rounded-full</p>
        <p class="text-xs text-neutral-400">Pills, avatars, icons</p>
      </div>
    </div>
  </section>

  <!-- ─── Pagination ─── -->
  <section class="mb-16">
    <h2 class="text-2xl font-bold text-black mb-6 border-b border-neutral-200 pb-3">Pagination</h2>
    <p class="text-neutral-500 text-xs mb-8">Minimal style with circular active state. No borders or backgrounds on inactive pages.</p>

    <div class="bg-neutral-50 rounded-xl p-8 border border-neutral-200">
      <div class="flex items-center justify-center gap-1">
        <span class="w-10 h-10 flex items-center justify-center text-neutral-400 hover:text-black transition-colors cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        </span>
        <span class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium bg-[#F15A29] text-white">1</span>
        <span class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium text-neutral-500">2</span>
        <span class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium text-neutral-500">3</span>
        <span class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium text-neutral-500">4</span>
        <span class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium text-neutral-500">5</span>
        <span class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium text-neutral-500">6</span>
        <span class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium text-neutral-500">7</span>
        <span class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium text-neutral-500">8</span>
        <span class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium text-neutral-500">9</span>
        <span class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium text-neutral-500">10</span>
        <span class="w-10 h-10 flex items-center justify-center text-neutral-400 hover:text-black transition-colors cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
        </span>
      </div>
      <div class="mt-6 text-xs text-neutral-500 space-y-1 text-center">
        <p>Active: <span class="text-black font-bold">bg-[#F15A29] text-white rounded-full</span></p>
        <p>Inactive: <span class="text-black font-bold">text-neutral-500</span> (no background)</p>
        <p>Arrows: <span class="text-black font-bold">text-neutral-400 hover:text-black</span></p>
        <p>Size: <span class="text-black font-bold">w-10 h-10</span></p>
      </div>
    </div>
  </section>

  <!-- ─── Shadows ─── -->
  <section class="mb-16">
    <h2 class="text-2xl font-bold text-black mb-6 border-b border-neutral-200 pb-3">Shadows</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
      <div class="bg-white rounded-xl p-6 shadow-md border border-neutral-100">
        <p class="text-sm font-bold text-black mb-1">shadow-md</p>
        <p class="text-xs text-neutral-500">Cards (grid &amp; list)</p>
      </div>
      <div class="bg-white rounded-xl p-6 shadow-lg border border-neutral-100">
        <p class="text-sm font-bold text-black mb-1">shadow-lg</p>
        <p class="text-xs text-neutral-500">Buttons, floating elements</p>
      </div>
      <div class="bg-white rounded-xl p-6 border border-neutral-100" style="box-shadow: 0 20px 40px rgba(233,148,116,0.2);">
        <p class="text-sm font-bold text-black mb-1">Salmon Glow</p>
        <p class="text-xs text-neutral-500">shadow-lg shadow-[#E99474]/20</p>
      </div>
    </div>
  </section>

  <!-- ─── Spacing ─── -->
  <section class="mb-16">
    <h2 class="text-2xl font-bold text-black mb-6 border-b border-neutral-200 pb-3">Spacing &amp; Layout</h2>

    <div class="grid sm:grid-cols-2 gap-8">
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Container</p>
        <div class="text-sm text-neutral-600 space-y-2">
          <p>Max width: <span class="text-black font-bold">1200px</span></p>
          <p>Horizontal padding: <span class="text-black font-bold">px-6</span> (24px)</p>
          <p>Centered: <span class="text-black font-bold">mx-auto</span></p>
        </div>
      </div>
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Sections</p>
        <div class="text-sm text-neutral-600 space-y-2">
          <p>Vertical padding: <span class="text-black font-bold">py-16</span> (64px)</p>
          <p>Title margin: <span class="text-black font-bold">mb-10</span> (40px)</p>
          <p>Between sections: <span class="text-black font-bold">mb-16</span> (64px)</p>
        </div>
      </div>
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Cards</p>
        <div class="text-sm text-neutral-600 space-y-2">
          <p>Grid gap: <span class="text-black font-bold">gap-6</span> (24px)</p>
          <p>Card padding: <span class="text-black font-bold">p-5</span> (20px)</p>
          <p>Content gaps: <span class="text-black font-bold">gap-3</span> to <span class="text-black font-bold">gap-5</span></p>
        </div>
      </div>
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Buttons</p>
        <div class="text-sm text-neutral-600 space-y-2">
          <p>Standard: <span class="text-black font-bold">px-6 py-2.5</span></p>
          <p>Large: <span class="text-black font-bold">px-8 py-3</span></p>
          <p>Full width: <span class="text-black font-bold">py-4</span></p>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── Borders ─── -->
  <section class="mb-16">
    <h2 class="text-2xl font-bold text-black mb-6 border-b border-neutral-200 pb-3">Borders</h2>
    <div class="grid sm:grid-cols-2 gap-8">
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Light Theme (White BG)</p>
        <div class="text-sm text-neutral-600 space-y-2">
          <p>Cards: <span class="text-black font-bold">border-neutral-200</span></p>
          <p>Dividers: <span class="text-black font-bold">border-neutral-200</span></p>
          <p>Hover: <span class="text-black font-bold">border-neutral-400</span></p>
        </div>
      </div>
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Dark Theme (Dark BG)</p>
        <div class="text-sm text-neutral-600 space-y-2">
          <p>Cards: <span class="text-black font-bold">border-white/10</span></p>
          <p>Inputs: <span class="text-black font-bold">border-white/30</span></p>
          <p>Subtle: <span class="text-black font-bold">rgba(255,255,255,0.08)</span></p>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── Transitions ─── -->
  <section class="mb-16">
    <h2 class="text-2xl font-bold text-black mb-6 border-b border-neutral-200 pb-3">Transitions &amp; Animations</h2>
    <div class="grid sm:grid-cols-2 gap-8">
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Standard</p>
        <div class="text-sm text-neutral-600 space-y-2">
          <p>Color changes: <span class="text-black font-bold">transition-colors</span></p>
          <p>All properties: <span class="text-black font-bold">transition-all 0.3s ease</span></p>
          <p>Hover lift: <span class="text-black font-bold">translateY(-2px)</span></p>
        </div>
      </div>
      <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4">Special</p>
        <div class="text-sm text-neutral-600 space-y-2">
          <p>Image zoom: <span class="text-black font-bold">scale(1.05) / 0.5s ease</span></p>
          <p>Fade in: <span class="text-black font-bold">fadeIn 0.3s ease</span></p>
          <p>Marquee: <span class="text-black font-bold">15s linear infinite</span></p>
        </div>
      </div>
    </div>
  </section>

</div>
