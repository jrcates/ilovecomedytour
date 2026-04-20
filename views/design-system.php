<!-- Mobile: placeholder -->
<div class="md:hidden pt-24 pb-24 max-w-md mx-auto px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-4">Desktop Only</p>
  <h1 class="text-4xl font-extrabold text-white mb-4 tracking-tight">Design System</h1>
  <p class="text-neutral-400 text-sm leading-relaxed mb-8">This reference is built for wider screens. Open it on a desktop browser to see the tokens, components, and patterns that power the site.</p>
  <a href="?view=home" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-[#f9dda9] transition-colors">Back to Home</a>
</div>

<!-- Desktop: full design system -->
<div class="hidden md:block pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6 min-h-screen">

  <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-3 tracking-tight">Design System</h1>
  <p class="text-neutral-400 text-sm mb-16 max-w-2xl">Tokens, components, and patterns used across the Ronny Chieng site — derived from the homepage, tour-dates list, and footer.</p>

  <!-- ─── Colors ─── -->
  <section class="mb-20">
    <h2 class="text-2xl font-bold text-white mb-2 border-b border-white/10 pb-3">Colors</h2>
    <p class="text-neutral-500 text-sm mb-6">Dark base, single cream accent, plus status colors for the tour list.</p>

    <h3 class="text-xs font-bold text-[#f9dda9] uppercase tracking-[0.2em] mb-4">Brand &amp; Surface</h3>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
      <div>
        <div class="h-20 rounded-lg bg-[#f9dda9] mb-2"></div>
        <p class="text-xs font-bold text-white">Accent Cream</p>
        <p class="text-xs text-neutral-500 font-mono">#f9dda9</p>
      </div>
      <div>
        <div class="h-20 rounded-lg bg-[#d12027] mb-2"></div>
        <p class="text-xs font-bold text-white">Brand Red</p>
        <p class="text-xs text-neutral-500 font-mono">#d12027</p>
      </div>
      <div>
        <div class="h-20 rounded-lg bg-[#e85a5f] mb-2"></div>
        <p class="text-xs font-bold text-white">Coral</p>
        <p class="text-xs text-neutral-500 font-mono">#e85a5f</p>
      </div>
      <div>
        <div class="h-20 rounded-lg bg-[#101010] border border-white/10 mb-2"></div>
        <p class="text-xs font-bold text-white">Page BG</p>
        <p class="text-xs text-neutral-500 font-mono">#101010</p>
      </div>
      <div>
        <div class="h-20 rounded-lg bg-[#1e1e1e] border border-white/10 mb-2"></div>
        <p class="text-xs font-bold text-white">Surface / Footer</p>
        <p class="text-xs text-neutral-500 font-mono">#1e1e1e</p>
      </div>
      <div>
        <div class="h-20 rounded-lg bg-black border border-white/10 mb-2"></div>
        <p class="text-xs font-bold text-white">True Black</p>
        <p class="text-xs text-neutral-500 font-mono">#000000</p>
      </div>
    </div>

    <h3 class="text-xs font-bold text-[#f9dda9] uppercase tracking-[0.2em] mb-4">Status</h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
      <div>
        <div class="h-16 rounded-lg bg-[#2fb03c] mb-2 flex items-center justify-center text-white text-[11px] font-extrabold tracking-[0.2em]">JUST ANNOUNCED</div>
        <p class="text-xs text-neutral-500 font-mono">#2fb03c</p>
      </div>
      <div>
        <div class="h-16 rounded-lg bg-[#6b2a9a] mb-2 flex items-center justify-center text-white text-[11px] font-extrabold tracking-[0.2em]">RESCHEDULED</div>
        <p class="text-xs text-neutral-500 font-mono">#6b2a9a</p>
      </div>
      <div>
        <div class="h-16 rounded-lg bg-[#e83a2f] mb-2 flex items-center justify-center text-white text-[11px] font-extrabold tracking-[0.2em]">LOW</div>
        <p class="text-xs text-neutral-500 font-mono">#e83a2f</p>
      </div>
      <div>
        <div class="h-16 rounded-lg bg-neutral-500 mb-2 flex items-center justify-center text-white text-[11px] font-extrabold tracking-[0.2em]">SOLD / SOLD OUT</div>
        <p class="text-xs text-neutral-500 font-mono">neutral-500</p>
      </div>
    </div>

    <h3 class="text-xs font-bold text-[#f9dda9] uppercase tracking-[0.2em] mb-4">Text</h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-white flex-shrink-0"></div>
        <div><p class="text-xs font-bold text-white">white</p><p class="text-xs text-neutral-500">Body / Details</p></div>
      </div>
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-neutral-400 flex-shrink-0"></div>
        <div><p class="text-xs font-bold text-white">neutral-400</p><p class="text-xs text-neutral-500">Supporting</p></div>
      </div>
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-neutral-500 flex-shrink-0"></div>
        <div><p class="text-xs font-bold text-white">neutral-500</p><p class="text-xs text-neutral-500">Metadata</p></div>
      </div>
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-[#f9dda9] flex-shrink-0"></div>
        <div><p class="text-xs font-bold text-white">#f9dda9</p><p class="text-xs text-neutral-500">Accents / Hover</p></div>
      </div>
    </div>
  </section>

  <!-- ─── Typography ─── -->
  <section class="mb-20">
    <h2 class="text-2xl font-bold text-white mb-2 border-b border-white/10 pb-3">Typography</h2>
    <p class="text-neutral-500 text-sm mb-8">
      Single font family: <span class="text-white font-bold">Montserrat</span> — weights 400, 500, 600, 700, 800, 900. Tight tracking for titles, widely-tracked uppercase for labels.
    </p>

    <div class="space-y-8">
      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8 pb-6 border-b border-white/5">
        <span class="text-xs text-neutral-500 w-[220px] flex-shrink-0 font-mono">Page Title (H1)<br>text-4xl md:text-6xl font-extrabold tracking-tight</span>
        <span class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-[0.95]">Tour Dates</span>
      </div>

      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8 pb-6 border-b border-white/5">
        <span class="text-xs text-neutral-500 w-[220px] flex-shrink-0 font-mono">City (H2)<br>text-2xl md:text-[32px] font-extrabold tracking-tight</span>
        <span class="text-2xl md:text-[32px] font-extrabold text-white tracking-tight leading-[1.1]">New York, NY</span>
      </div>

      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8 pb-6 border-b border-white/5">
        <span class="text-xs text-neutral-500 w-[220px] flex-shrink-0 font-mono">Venue (title row)<br>text-lg md:text-2xl font-extrabold</span>
        <span class="text-lg md:text-2xl font-extrabold text-[#f9dda9] tracking-tight">Town Hall</span>
      </div>

      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8 pb-6 border-b border-white/5">
        <span class="text-xs text-neutral-500 w-[220px] flex-shrink-0 font-mono">Description<br>text-sm md:text-base</span>
        <span class="text-sm md:text-base font-medium text-neutral-400">The Love to Hate It Tour</span>
      </div>

      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8 pb-6 border-b border-white/5">
        <span class="text-xs text-neutral-500 w-[220px] flex-shrink-0 font-mono">Pill / Badge label<br>text-[11px] font-extrabold tracking-[0.18em] uppercase</span>
        <span class="text-[11px] font-extrabold text-white tracking-[0.18em] uppercase">Just Announced</span>
      </div>

      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8 pb-6 border-b border-white/5">
        <span class="text-xs text-neutral-500 w-[220px] flex-shrink-0 font-mono">Button label<br>font-extrabold tracking-[0.12em] uppercase</span>
        <span class="text-sm font-extrabold text-white tracking-[0.12em] uppercase">Fri, Dec. 12th 7:00 PM</span>
      </div>

      <div class="flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8 pb-6 border-b border-white/5">
        <span class="text-xs text-neutral-500 w-[220px] flex-shrink-0 font-mono">Footer section label<br>text-[10px] font-extrabold tracking-[0.3em] uppercase</span>
        <span class="text-[10px] font-extrabold text-[#f9dda9] tracking-[0.3em] uppercase">Navigate</span>
      </div>
    </div>
  </section>

  <!-- ─── Pills &amp; Badges ─── -->
  <section class="mb-20">
    <h2 class="text-2xl font-bold text-white mb-2 border-b border-white/10 pb-3">Pills &amp; Badges</h2>
    <p class="text-neutral-500 text-sm mb-6">All pills share <span class="font-mono text-white">h-7 px-3 rounded-[5px] text-[11px] font-extrabold tracking-[0.18em] uppercase</span>.</p>

    <div class="flex flex-wrap items-center gap-2 p-6 bg-[#1e1e1e] rounded-lg border border-white/5">
      <span class="inline-flex items-center h-7 px-3 bg-[#2fb03c] text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]">Just Announced</span>
      <span class="inline-flex items-center h-7 px-3 bg-[#6b2a9a] text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]">Rescheduled!</span>
      <span class="inline-flex items-center h-7 px-3 bg-neutral-500 text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]">Sold Out</span>
      <span class="inline-flex items-center h-7 px-3 bg-black text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]">Dec 12th - Dec 13th</span>
      <span class="inline-flex items-center justify-center h-7 px-3 bg-[#e83a2f] text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]">Low</span>
      <span class="inline-flex items-center justify-center h-7 px-3 bg-neutral-500 text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]">Sold</span>
    </div>
  </section>

  <!-- ─── Buttons ─── -->
  <section class="mb-20">
    <h2 class="text-2xl font-bold text-white mb-2 border-b border-white/10 pb-3">Buttons</h2>
    <p class="text-neutral-500 text-sm mb-8">Primary uses white → cream on hover. Time-slot uses cream with 5px radius. Ghost uses muted surface.</p>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <div class="bg-[#1e1e1e] rounded-xl p-6 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-4">Primary</p>
        <a href="#" class="inline-block px-6 py-2.5 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-[#f9dda9] transition-colors">Buy Tickets</a>
        <p class="mt-4 text-xs text-neutral-500 font-mono leading-relaxed">bg-white<br>text-black font-bold text-sm<br>rounded-[10px] px-6 py-2.5<br>hover:bg-[#f9dda9]</p>
      </div>

      <div class="bg-[#1e1e1e] rounded-xl p-6 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-4">Primary Wide</p>
        <a href="#" class="block w-full text-center py-4 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-[#f9dda9] transition-colors">Send Message</a>
        <p class="mt-4 text-xs text-neutral-500 font-mono leading-relaxed">block w-full py-4<br>hover:bg-[#f9dda9]</p>
      </div>

      <div class="bg-[#1e1e1e] rounded-xl p-6 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-4">Ghost</p>
        <a href="#" class="inline-block px-6 py-2.5 bg-white/5 text-white font-bold text-sm rounded-[10px] hover:bg-white/10 border border-white/10 transition-colors">Back</a>
        <p class="mt-4 text-xs text-neutral-500 font-mono leading-relaxed">bg-white/5 text-white<br>border border-white/10<br>hover:bg-white/10</p>
      </div>

      <div class="bg-[#1e1e1e] rounded-xl p-6 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-4">Time Slot</p>
        <a href="#" class="block text-center px-5 py-3 bg-[#f9dda9] hover:bg-[#fbe6bb] text-neutral-900 font-extrabold text-sm tracking-[0.12em] uppercase rounded-[5px] transition-colors">Fri, Dec. 12th 7:00 PM</a>
        <p class="mt-4 text-xs text-neutral-500 font-mono leading-relaxed">bg-[#f9dda9]<br>text-neutral-900 font-extrabold<br>tracking-[0.12em] uppercase<br>rounded-[5px]</p>
      </div>

      <div class="bg-[#1e1e1e] rounded-xl p-6 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-4">Time Slot — Sold</p>
        <span class="block text-center px-5 py-3 bg-[#f9dda9]/40 text-neutral-500 font-extrabold text-sm tracking-[0.12em] uppercase rounded-[5px] cursor-not-allowed">Fri, Dec. 12th 9:30 PM</span>
        <p class="mt-4 text-xs text-neutral-500 font-mono leading-relaxed">bg-[#f9dda9]/40<br>text-neutral-500<br>cursor-not-allowed</p>
      </div>

      <div class="bg-[#1e1e1e] rounded-xl p-6 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-4">Icon Square</p>
        <div class="flex gap-2.5">
          <a href="#" class="w-11 h-11 flex items-center justify-center bg-white/5 hover:bg-[#f9dda9] hover:text-black text-white border border-white/10 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
          </a>
          <a href="#" class="w-11 h-11 flex items-center justify-center bg-white/5 hover:bg-[#f9dda9] hover:text-black text-white border border-white/10 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
        </div>
        <p class="mt-4 text-xs text-neutral-500 font-mono leading-relaxed">w-11 h-11<br>bg-white/5 border border-white/10<br>hover:bg-[#f9dda9] hover:text-black</p>
      </div>

    </div>
  </section>

  <!-- ─── Form Inputs ─── -->
  <section class="mb-20">
    <h2 class="text-2xl font-bold text-white mb-2 border-b border-white/10 pb-3">Form Inputs</h2>
    <p class="text-neutral-500 text-sm mb-8">Two variants: boxed (default forms) and underline-only (newsletter).</p>

    <div class="grid lg:grid-cols-2 gap-6">
      <div class="bg-[#1e1e1e] rounded-xl p-5 md:p-8 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-4">Boxed (Contact / Gift)</p>
        <div class="space-y-2 mb-4">
          <label class="text-sm font-bold text-neutral-400 ml-1">Email</label>
          <input type="email" placeholder="your@email.com" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-4 text-white focus:ring-2 focus:ring-[#f9dda9] focus:border-transparent outline-none placeholder:text-neutral-500" />
        </div>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">bg-white/5 border border-white/10<br>rounded-[10px] p-4<br>focus:ring-2 focus:ring-[#f9dda9]</p>
      </div>

      <div class="bg-[#1e1e1e] rounded-xl p-5 md:p-8 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-4">Underline (Newsletter)</p>
        <div class="mb-4">
          <label class="block text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-3">Email</label>
          <input type="email" placeholder="you@somewhere.com" class="w-full bg-transparent border-b-2 border-white/15 focus:border-[#f9dda9] py-3 text-white placeholder:text-white/25 focus:outline-none transition-colors" />
        </div>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">bg-transparent<br>border-b-2 border-white/15<br>focus:border-[#f9dda9]</p>
      </div>
    </div>
  </section>

  <!-- ─── Tour Date Row ─── -->
  <section class="mb-20">
    <h2 class="text-2xl font-bold text-white mb-2 border-b border-white/10 pb-3">Tour Date Row</h2>
    <p class="text-neutral-500 text-sm mb-6">The core content unit of the site — shared by the homepage and calendar. See <span class="font-mono text-white">components/tour-dates.php</span>.</p>

    <article class="py-6 md:py-10 grid grid-cols-1 md:grid-cols-[1fr_minmax(300px,380px)] gap-5 md:gap-10 items-start border-y border-white/10">
      <div>
        <div class="flex flex-wrap items-center gap-2 mb-4">
          <span class="inline-flex items-center h-7 px-3 bg-[#2fb03c] text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]">Just Announced</span>
          <span class="inline-flex items-center h-7 px-3 bg-black text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none rounded-[5px]">Jan 30th - Jan 31st</span>
        </div>
        <h2 class="text-2xl md:text-[32px] font-extrabold text-white tracking-tight leading-[1.1] mb-2">Timonium, MD</h2>
        <div class="text-lg md:text-2xl font-extrabold text-[#f9dda9] tracking-tight mb-2">Magoobys Jokehouse</div>
        <div class="text-sm md:text-base font-medium text-neutral-400 leading-relaxed">I Never Promised You A Rose Garden Tour</div>
      </div>
      <div class="flex flex-col gap-2">
        <div class="flex items-stretch gap-2">
          <span class="flex items-center justify-center w-16 md:w-20 bg-[#e83a2f] text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none shrink-0 rounded-[5px]">Low</span>
          <a href="#" class="flex-1 px-4 md:px-5 py-3 bg-[#f9dda9] hover:bg-[#fbe6bb] text-neutral-900 font-extrabold text-xs md:text-sm tracking-[0.12em] uppercase text-center transition-colors rounded-[5px]">Fri, Jan. 30th 7:00 PM</a>
        </div>
        <div class="flex items-stretch gap-2">
          <span class="w-16 md:w-20 shrink-0"></span>
          <a href="#" class="flex-1 px-4 md:px-5 py-3 bg-[#f9dda9] hover:bg-[#fbe6bb] text-neutral-900 font-extrabold text-xs md:text-sm tracking-[0.12em] uppercase text-center transition-colors rounded-[5px]">Sat, Jan. 31st 7:00 PM</a>
        </div>
        <div class="flex items-stretch gap-2">
          <span class="flex items-center justify-center w-16 md:w-20 bg-neutral-500 text-white text-[11px] font-extrabold tracking-[0.18em] uppercase leading-none shrink-0 rounded-[5px]">Sold</span>
          <span class="flex-1 px-4 md:px-5 py-3 bg-[#f9dda9]/40 text-neutral-500 font-extrabold text-xs md:text-sm tracking-[0.12em] uppercase text-center cursor-not-allowed rounded-[5px]">Sat, Jan. 31st 9:30 PM</span>
        </div>
      </div>
    </article>
  </section>

  <!-- ─── Radii ─── -->
  <section class="mb-20">
    <h2 class="text-2xl font-bold text-white mb-2 border-b border-white/10 pb-3">Radii</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
      <div>
        <div class="h-20 bg-white/5 border border-white/10 rounded-[5px] mb-2"></div>
        <p class="text-xs font-bold text-white">rounded-[5px]</p>
        <p class="text-xs text-neutral-500">Pills, time-slot buttons, status badges</p>
      </div>
      <div>
        <div class="h-20 bg-white/5 border border-white/10 rounded-[10px] mb-2"></div>
        <p class="text-xs font-bold text-white">rounded-[10px]</p>
        <p class="text-xs text-neutral-500">Primary buttons, inputs, boxed cards</p>
      </div>
      <div>
        <div class="h-20 bg-white/5 border border-white/10 rounded-xl mb-2"></div>
        <p class="text-xs font-bold text-white">rounded-xl (12px)</p>
        <p class="text-xs text-neutral-500">Larger surfaces (contact card, footer sections)</p>
      </div>
      <div>
        <div class="h-20 bg-white/5 border border-white/10 rounded-full mb-2"></div>
        <p class="text-xs font-bold text-white">rounded-full</p>
        <p class="text-xs text-neutral-500">Social icons in mobile drawer</p>
      </div>
    </div>
  </section>

  <!-- ─── Layout ─── -->
  <section class="mb-20">
    <h2 class="text-2xl font-bold text-white mb-2 border-b border-white/10 pb-3">Layout</h2>
    <div class="space-y-6">
      <div class="bg-[#1e1e1e] rounded-xl p-6 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-3">Content Width</p>
        <p class="text-white font-mono text-sm">max-w-[1400px]</p>
        <p class="text-neutral-500 text-xs mt-1">All pages and components. Carousel stretches to <span class="font-mono text-white">max-w-[1600px]</span>.</p>
      </div>
      <div class="bg-[#1e1e1e] rounded-xl p-6 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-3">Horizontal Padding</p>
        <p class="text-white font-mono text-sm">px-4 md:px-6</p>
      </div>
      <div class="bg-[#1e1e1e] rounded-xl p-6 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-3">Section Padding</p>
        <p class="text-white font-mono text-sm">py-16 &middot; py-20 &middot; py-14 md:py-32</p>
        <p class="text-neutral-500 text-xs mt-1">Regular / marketing / hero newsletter.</p>
      </div>
      <div class="bg-[#1e1e1e] rounded-xl p-6 border border-white/10">
        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider mb-3">Main Top Padding</p>
        <p class="text-white font-mono text-sm">main &rarr; padding-top: 180px / 160px (mobile)</p>
        <p class="text-neutral-500 text-xs mt-1">Clears the fixed nav + marquee. Defined in <span class="font-mono text-white">css/custom.css</span>.</p>
      </div>
    </div>
  </section>

  <!-- ─── Navigation Patterns ─── -->
  <section class="mb-20">
    <h2 class="text-2xl font-bold text-white mb-2 border-b border-white/10 pb-3">Navigation</h2>
    <div class="bg-[#1e1e1e] rounded-xl border border-white/10 overflow-hidden">
      <div class="bg-[#f9dda9] text-black text-sm font-bold px-5 py-2">Marquee &mdash; <span class="font-normal">bg-[#f9dda9] text-black</span></div>
      <div class="px-6 py-5 border-t border-white/5 flex items-center gap-6">
        <a href="#" class="text-base font-bold text-[#f9dda9]">Tour Dates <span class="text-xs text-neutral-500 font-normal ml-1">(active)</span></a>
        <a href="#" class="text-base font-bold text-neutral-300 hover:text-[#f9dda9]">Netflix</a>
        <a href="#" class="text-base font-bold text-neutral-300 hover:text-[#f9dda9]">Store</a>
        <a href="#" class="text-base font-bold text-neutral-300 hover:text-[#f9dda9]">Contact</a>
      </div>
      <div class="px-6 py-4 bg-black/40 border-t border-white/5">
        <p class="text-xs text-neutral-500 font-mono">text-base font-bold | active &amp; hover: text-[#f9dda9]</p>
      </div>
    </div>
  </section>

</div>
