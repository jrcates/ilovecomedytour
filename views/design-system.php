<!-- ═══════════════════════════════════════════════════════
     Design System — living reference of tokens, components,
     and patterns actually used across the ILCT site.
     Pulls everything from the current state of custom.css and
     real component markup — update this file when the system
     itself changes.
     ═══════════════════════════════════════════════════════ -->
<div class="pt-4 pb-16 md:pt-8 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6">

  <!-- ─── Header ─── -->
  <div class="relative mb-10 md:mb-16">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[260px] font-black text-black/[0.04] select-none leading-none pointer-events-none tracking-tight">DS</span>
    <div class="cc-sticker mb-5 md:mb-0 md:absolute md:top-0 md:right-12 rotate-[-3deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2">
      Living Reference
    </div>
    <p class="relative text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-4">Dev Reference</p>
    <h1 class="relative text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[0.9] text-neutral-900">Design System.</h1>
    <p class="relative mt-6 md:mt-8 text-neutral-700 text-base md:text-lg max-w-2xl leading-relaxed">
      Colors, typography, components, and layout patterns pulled from the actual
      site. Montserrat everywhere, light palette with warm red + brown + cream
      accents, cartoon-sticker buttons. Updated: <?= date('M j, Y') ?>.
    </p>
  </div>

  <!-- ─── Colors ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Colors</h2>

    <!-- Brand -->
    <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4 mt-6">Brand</p>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-10">
      <div>
        <div class="h-24 rounded-xl bg-[#d12027] mb-2"></div>
        <p class="text-sm font-extrabold text-neutral-900">Brand Red</p>
        <p class="text-xs text-neutral-500 font-mono">#d12027</p>
        <p class="text-xs text-neutral-500 mt-1">CTAs, eyebrows, accents, active states</p>
      </div>
      <div>
        <div class="h-24 rounded-xl bg-[#2d1712] mb-2"></div>
        <p class="text-sm font-extrabold text-neutral-900">Outline Brown</p>
        <p class="text-xs text-neutral-500 font-mono">#2d1712</p>
        <p class="text-xs text-neutral-500 mt-1">Button / sticker outlines + solid drop shadows</p>
      </div>
      <div>
        <div class="h-24 rounded-xl bg-[#f9dda9] mb-2"></div>
        <p class="text-sm font-extrabold text-neutral-900">Cream Accent</p>
        <p class="text-xs text-neutral-500 font-mono">#f9dda9</p>
        <p class="text-xs text-neutral-500 mt-1">Ticket-stub band, headline accent on dark bg</p>
      </div>
      <div>
        <div class="h-24 rounded-xl bg-[#e62a31] mb-2"></div>
        <p class="text-sm font-extrabold text-neutral-900">Hover Red</p>
        <p class="text-xs text-neutral-500 font-mono">#e62a31</p>
        <p class="text-xs text-neutral-500 mt-1">Primary button :hover only</p>
      </div>
    </div>

    <!-- Status -->
    <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Status</p>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
      <div>
        <div class="h-16 rounded-xl bg-[#2fb03c] mb-2 flex items-center justify-center text-white text-[11px] font-extrabold tracking-[0.2em]">SUCCESS</div>
        <p class="text-xs text-neutral-500 font-mono">#2fb03c</p>
        <p class="text-xs text-neutral-500 mt-1">Tickets Sent, confirmations</p>
      </div>
      <div>
        <div class="h-16 rounded-xl bg-[#6b2a9a] mb-2 flex items-center justify-center text-white text-[11px] font-extrabold tracking-[0.2em]">PURPLE</div>
        <p class="text-xs text-neutral-500 font-mono">#6b2a9a</p>
        <p class="text-xs text-neutral-500 mt-1">Rescheduled (reserved)</p>
      </div>
      <div>
        <div class="h-16 rounded-xl bg-[#e83a2f] mb-2 flex items-center justify-center text-white text-[11px] font-extrabold tracking-[0.2em]">LOW</div>
        <p class="text-xs text-neutral-500 font-mono">#e83a2f</p>
        <p class="text-xs text-neutral-500 mt-1">Low availability (calendar list)</p>
      </div>
      <div>
        <div class="h-16 rounded-xl bg-neutral-300 mb-2 flex items-center justify-center text-neutral-600 text-[11px] font-extrabold tracking-[0.2em]">SOLD</div>
        <p class="text-xs text-neutral-500 font-mono">neutral-200/300</p>
        <p class="text-xs text-neutral-500 mt-1">Sold out states</p>
      </div>
    </div>

    <!-- Neutrals -->
    <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Neutrals</p>
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4 mb-10">
      <?php foreach (['white'=>'#ffffff','neutral-50'=>'#fafafa','neutral-100'=>'#f5f5f5','neutral-200'=>'#e5e5e5','neutral-500'=>'#737373','neutral-700'=>'#404040','neutral-900'=>'#171717','black'=>'#000000'] as $label => $hex): ?>
      <div>
        <div class="h-16 rounded-lg border border-black/10" style="background: <?= $hex ?>"></div>
        <p class="text-xs font-extrabold text-neutral-900 mt-2"><?= $label ?></p>
        <p class="text-xs text-neutral-500 font-mono"><?= $hex ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Gradients -->
    <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Gradients (hero / nav only)</p>
    <div class="grid md:grid-cols-2 gap-4">
      <div>
        <div class="cc-hero-gradient h-32 rounded-xl mb-2"></div>
        <p class="text-sm font-extrabold text-neutral-900">.cc-hero-gradient</p>
        <p class="text-xs text-neutral-500 mt-1">Home hero. Yellow + violet + orange + red glows over burgundy (<span class="font-mono">#1a0a0e → #3a1518</span>).</p>
      </div>
      <div>
        <div class="cc-nav-bg h-32 rounded-xl mb-2"></div>
        <p class="text-sm font-extrabold text-neutral-900">.cc-nav-bg</p>
        <p class="text-xs text-neutral-500 mt-1">Fixed nav on non-home routes (<span class="font-mono">#14070a → #1e0a10</span>). Tones match the hero base.</p>
      </div>
    </div>
  </section>

  <!-- ─── Typography ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Typography</h2>
    <p class="text-neutral-700 text-base mb-8">
      One family: <span class="font-extrabold">Montserrat</span>. Weights 400 / 500 / 600 / 700 / 800 / 900. Tight tracking on large type, widely-tracked uppercase on labels and microtext.
    </p>

    <div class="divide-y divide-black/10">
      <div class="py-6 grid md:grid-cols-[260px_1fr] gap-3 md:gap-8 items-center">
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">Hero headline<br><span class="text-neutral-700">text-[11vw] sm:text-[9vw] md:text-[6vw] lg:text-[5.5rem] xl:text-[6.5rem]</span><br>font-extrabold · tracking-tight · leading-[0.88]<br><span class="text-neutral-500">Home only. Multi-line with cream accent on the last line. Shown here inside the real .cc-hero-gradient.</span></p>
        <div class="cc-hero-gradient rounded-xl p-5 md:p-8 overflow-hidden">
          <p class="text-white font-extrabold text-[11vw] sm:text-[9vw] md:text-[6vw] lg:text-[5.5rem] xl:text-[6.5rem] tracking-tight leading-[0.88]">
            I Love<br>Comedy<br><span class="text-[#f9dda9]">Tour.</span>
          </p>
        </div>
      </div>
      <div class="py-6 grid md:grid-cols-[260px_1fr] gap-3 md:gap-8 items-baseline">
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">Page headline (H1)<br><span class="text-neutral-700">text-4xl md:text-6xl lg:text-7xl</span><br>font-extrabold · tracking-tight · leading-[0.9]<br><span class="text-neutral-500">Used on About, Contact, Book, and Stage B. Can span multiple lines with <span class="text-neutral-700">&lt;br&gt;</span> + inline red accent on the last line.</span></p>
        <p class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-neutral-900 tracking-tight leading-[0.9]">Walking tour.<br>Comedy show.<br><span class="text-[#d12027]">100% New York.</span></p>
      </div>
      <div class="py-6 grid md:grid-cols-[260px_1fr] gap-3 md:gap-8 items-baseline">
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">Section heading (H2)<br><span class="text-neutral-700">text-xl md:text-2xl · font-extrabold</span><br>with <span class="text-neutral-700">border-b-[3px] border-neutral-900 inline-block</span> accent</p>
        <h3 class="text-xl md:text-2xl font-extrabold text-neutral-900 pb-2 border-b-[3px] border-neutral-900 inline-block">What's Included:</h3>
      </div>
      <div class="py-6 grid md:grid-cols-[260px_1fr] gap-3 md:gap-8 items-baseline">
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">Eyebrow label<br><span class="text-neutral-700">text-[10px] font-extrabold<br>uppercase tracking-[0.3em]<br>text-[#d12027]</span></p>
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027]">Pick Your Date</p>
      </div>
      <div class="py-6 grid md:grid-cols-[260px_1fr] gap-3 md:gap-8 items-baseline">
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">Body text<br><span class="text-neutral-700">text-base md:text-lg<br>text-neutral-800 · leading-relaxed</span></p>
        <p class="text-base md:text-lg text-neutral-800 leading-relaxed">A quick-hit introduction to the place where modern comedy was born. Guided by working comedians.</p>
      </div>
      <div class="py-6 grid md:grid-cols-[260px_1fr] gap-3 md:gap-8 items-baseline">
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">Muted supporting<br><span class="text-neutral-700">text-sm text-neutral-600</span></p>
        <p class="text-sm text-neutral-600">107 MacDougal St, New York, NY 10012</p>
      </div>
      <div class="py-6 grid md:grid-cols-[260px_1fr] gap-3 md:gap-8 items-baseline">
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">Button label<br><span class="text-neutral-700">font-extrabold · uppercase<br>tracking-[0.22em] · text-xs</span></p>
        <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-neutral-900">Book a Tour</p>
      </div>
      <div class="py-6 grid md:grid-cols-[260px_1fr] gap-3 md:gap-8 items-baseline">
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">Watermark (editorial header)<br><span class="text-neutral-700">text-[220px] · font-black<br>text-black/[0.04] · tracking-tight</span></p>
        <p class="text-[120px] md:text-[160px] font-black text-black/[0.04] leading-none tracking-tight">BOOK</p>
      </div>
    </div>
  </section>

  <!-- ─── Buttons ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Buttons</h2>

    <div class="grid md:grid-cols-2 gap-6">

      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">.cc-btn-primary</p>
        <div class="flex flex-wrap gap-4 mb-6">
          <a href="#" onclick="return false" class="cc-btn-primary text-xs tracking-[0.22em] px-7 py-3">
            Book a Tour
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
          <a href="#" onclick="return false" class="cc-btn-primary is-disabled text-xs tracking-[0.22em] px-7 py-3">
            Disabled
          </a>
        </div>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">
          bg-[#d12027] · text-white · border-3 border-[#2d1712]<br>
          rounded-full · shadow-[0_6px_0_0_#2d1712]<br>
          hover: −3px + rotate-[-1.5deg] · shadow grows<br>
          <span class="text-neutral-700">.is-disabled</span> → 45% opacity, no lift
        </p>
      </div>

      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">Time-slot pill <span class="text-neutral-500 normal-case font-semibold tracking-normal">(inline style, small)</span></p>
        <div class="flex flex-wrap gap-2 mb-6">
          <a href="#" onclick="return false" class="inline-flex items-center justify-center px-4 py-2.5 bg-[#d12027] text-white border-2 border-[#2d1712] rounded-full text-[11px] font-extrabold uppercase tracking-[0.18em] shadow-[0_3px_0_0_#2d1712] hover:-translate-y-0.5 hover:shadow-[0_5px_0_0_#2d1712] transition-all">5:00PM</a>
          <a href="#" onclick="return false" class="inline-flex items-center justify-center px-4 py-2.5 bg-[#d12027] text-white border-2 border-[#2d1712] rounded-full text-[11px] font-extrabold uppercase tracking-[0.18em] shadow-[0_3px_0_0_#2d1712] hover:-translate-y-0.5 hover:shadow-[0_5px_0_0_#2d1712] transition-all">7:00PM</a>
          <span class="inline-flex items-center justify-center px-4 py-2.5 bg-neutral-200 text-neutral-500 border-2 border-neutral-300 rounded-full text-[11px] font-extrabold uppercase tracking-[0.18em] line-through cursor-not-allowed">9:00PM</span>
        </div>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">
          Same visual language as primary, just smaller.<br>
          Used on the tour list view + the tour-list component.<br>
          Sold: bg-neutral-200 · line-through · cursor-not-allowed
        </p>
      </div>
    </div>
  </section>

  <!-- ─── Stickers / Badges ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Stickers &amp; Badges</h2>

    <div class="grid md:grid-cols-2 gap-6 mb-6">
      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">.cc-sticker <span class="text-neutral-500 normal-case font-semibold tracking-normal">(page-header badges)</span></p>
        <div class="flex flex-wrap items-center gap-4 mb-6">
          <div class="cc-sticker bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2 rotate-[-3deg]">
            Our Story
          </div>
          <div class="cc-sticker gap-2 bg-[#2fb03c] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2 -rotate-[4deg]">
            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
            Tickets Sent
          </div>
          <div class="cc-sticker bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2 rotate-[6deg]">
            Say Hello
          </div>
        </div>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">
          border-3 border-[#2d1712] · rounded-full<br>
          shadow-[0_4px_0_0_#2d1712] · line-height: 1<br>
          bg = any accent color (red / green / purple / etc.)
        </p>
      </div>

      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">.cc-sticker-sm <span class="text-neutral-500 normal-case font-semibold tracking-normal">(smaller scale)</span></p>
        <div class="flex flex-wrap items-center gap-4 mb-6">
          <div class="cc-sticker-sm gap-2 bg-[#d12027] text-white text-[10px] font-extrabold uppercase tracking-[0.3em] px-4 py-2 -rotate-1">
            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
            A Walking Tour
          </div>
          <span class="cc-sticker-sm bg-[#e83a2f] text-white text-[9px] font-extrabold tracking-[0.18em] uppercase px-2.5 py-1.5">LOW</span>
          <span class="cc-sticker-sm bg-neutral-500 text-white text-[9px] font-extrabold tracking-[0.18em] uppercase px-2.5 py-1.5">SOLD</span>
        </div>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">
          border-2 border-[#2d1712] · shadow-[0_3px_0_0_#2d1712]<br>
          Used for hero eyebrow (with pulsing dot),<br>
          inline status tags, drawer "don't miss" badge
        </p>
      </div>
    </div>
  </section>

  <!-- ─── Forms ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Form Inputs</h2>
    <p class="text-neutral-700 text-base mb-6">One unified pill style across the site: contact, checkout, newsletter. Inputs are <span class="font-extrabold">rounded-full</span>; textareas are <span class="font-extrabold">rounded-2xl</span>.</p>

    <div class="grid md:grid-cols-2 gap-6">

      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">Text input</p>
        <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
          <span>Email</span><span class="text-[#d12027] text-base leading-none">*</span>
        </label>
        <input type="email" placeholder="you@somewhere.com"
               class="w-full bg-white border-2 border-black/15 focus:border-[#d12027] rounded-full px-5 py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors mb-5" />
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">
          bg-white · border-2 border-black/15<br>
          rounded-full · px-5 py-3<br>
          focus:border-[#d12027]<br>
          placeholder:text-neutral-400
        </p>
      </div>

      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">Textarea</p>
        <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
          <span>Message</span><span class="text-[#d12027] text-base leading-none">*</span>
        </label>
        <textarea rows="3" placeholder="Say something…"
                  class="w-full bg-white border-2 border-black/15 focus:border-[#d12027] rounded-2xl px-5 py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors resize-none mb-5"></textarea>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">
          Same as text input, just <span class="text-neutral-700">rounded-2xl</span><br>
          + <span class="text-neutral-700">resize-none</span>. Used on the contact Message field.
        </p>
      </div>

      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">Inline form (newsletter)</p>
        <div class="flex flex-col sm:flex-row gap-3 mb-5">
          <input type="email" placeholder="you@somewhere.com"
                 class="flex-1 bg-white border-2 border-black/15 focus:border-[#d12027] rounded-full px-5 py-3 text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none transition-colors" />
          <button onclick="return false" class="cc-btn-primary text-xs tracking-[0.22em] px-5 py-3 shrink-0">Subscribe</button>
        </div>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed">
          Pill input + .cc-btn-primary side-by-side.<br>
          Stacks on mobile, row on sm+.
        </p>
      </div>

      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-5">Stepper (guest count · addon qty)</p>
        <div x-data="{ n: 2 }" class="flex items-center justify-between">
          <div>
            <p class="text-sm text-neutral-900 font-semibold">Guests</p>
            <p class="text-xs text-neutral-500">Max 10 per booking</p>
          </div>
          <div class="flex items-center gap-1 bg-black/5 border border-black/10 rounded-[10px] p-1">
            <button type="button" @click="n = Math.max(1, n - 1)"
                    :class="n <= 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-black/10'"
                    class="w-9 h-9 flex items-center justify-center text-neutral-900 rounded-[6px] transition-colors text-lg">−</button>
            <span class="w-10 text-center text-neutral-900 font-extrabold" x-text="n"></span>
            <button type="button" @click="n = Math.min(10, n + 1)"
                    :class="n >= 10 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-black/10'"
                    class="w-9 h-9 flex items-center justify-center text-neutral-900 rounded-[6px] transition-colors text-lg">+</button>
          </div>
        </div>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed mt-4">
          bg-black/5 container · rounded-[10px] p-1<br>
          Segments: w-9 h-9 · rounded-[6px]<br>
          Disabled states: opacity-30
        </p>
      </div>
    </div>
  </section>

  <!-- ─── Cards & Panels ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Cards &amp; Panels</h2>

    <div class="grid md:grid-cols-2 gap-6">

      <div>
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Info card <span class="text-neutral-500 normal-case font-semibold tracking-normal">(about aside, tour booking panel)</span></p>
        <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
          <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">What You Get</p>
          <div class="text-3xl font-extrabold text-neutral-900 tracking-tight leading-none mb-2">$49 <span class="text-sm font-medium text-neutral-500">/ guest</span></div>
          <p class="text-sm text-neutral-500">$45 + 10% service fee</p>
        </div>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed mt-3">
          bg-neutral-50 · border border-black/10<br>
          rounded-2xl · p-6 md:p-8
        </p>
      </div>

      <div>
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">.cc-modal-panel <span class="text-neutral-500 normal-case font-semibold tracking-normal">(success modals)</span></p>
        <div class="cc-modal-panel bg-neutral-50 rounded-xl p-8 text-center">
          <div class="flex justify-center mb-4">
            <div class="cc-sticker gap-2 bg-[#d12027] text-white text-[10px] font-extrabold uppercase tracking-[0.3em] px-4 py-2 -rotate-2">
              <span>★</span> You're In
            </div>
          </div>
          <h3 class="text-2xl font-extrabold text-[#d12027] tracking-tight">Thanks.</h3>
        </div>
        <p class="text-xs text-neutral-500 font-mono leading-relaxed mt-3">
          border-3 border-[#2d1712]<br>
          shadow-[0_8px_0_0_#2d1712, 0_12px_32px_-8px_rgba(0,0,0,0.35)]
        </p>
      </div>

      <div class="md:col-span-2">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Ticket stub <span class="text-neutral-500 normal-case font-semibold tracking-normal">(thank-you page)</span></p>
        <article class="bg-neutral-50 border border-black/10 rounded-xl overflow-hidden">
          <div class="bg-[#f9dda9] text-black px-6 py-3 flex items-center justify-between border-b-2 border-black">
            <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase">Admit 2</span>
            <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase">Order ILCT-260425-A3F9B2</span>
          </div>
          <div class="p-5 md:p-8 grid md:grid-cols-3 gap-6 items-start">
            <div>
              <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-3">When</p>
              <div class="text-5xl font-extrabold text-neutral-900 leading-none tracking-tight">25</div>
              <div class="mt-2 text-sm font-extrabold uppercase tracking-[0.18em] text-[#d12027]">APR 2026</div>
              <div class="mt-4 text-sm text-neutral-900 font-bold">Sat · 7:00PM</div>
            </div>
            <div class="md:col-span-2 md:border-l md:border-dashed md:border-black/15 md:pl-8">
              <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-3">Where</p>
              <h3 class="text-2xl font-extrabold text-neutral-900 tracking-tight leading-[1.05] mb-2">New York, NY</h3>
              <div class="text-base font-extrabold text-[#d12027] tracking-tight mb-2">The Grisly Pear</div>
              <p class="text-sm text-neutral-600 leading-relaxed">107 MacDougal St, New York, NY 10012</p>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- ─── Breadcrumbs ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Breadcrumbs</h2>
    <p class="text-neutral-700 text-base mb-6">Used on the booking flow (addons / checkout / thank-you). Current step in brand red, past steps are neutral links, separators use <span class="font-mono text-neutral-700">/</span> in <span class="font-mono text-neutral-700">text-black/20</span>.</p>

    <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8 space-y-4">
      <div class="flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-[0.3em]">
        <a href="#" onclick="return false" class="text-neutral-500 hover:text-[#d12027] transition-colors">Book</a>
        <span class="text-black/20">/</span>
        <span class="text-[#d12027]">Add-ons</span>
        <span class="text-black/20">/</span>
        <span class="text-neutral-500">Checkout</span>
      </div>
      <div class="flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-[0.3em]">
        <a href="#" onclick="return false" class="text-neutral-500 hover:text-[#d12027] transition-colors">Book</a>
        <span class="text-black/20">/</span>
        <a href="#" onclick="return false" class="text-neutral-500 hover:text-[#d12027] transition-colors">Add-ons</a>
        <span class="text-black/20">/</span>
        <span class="text-[#d12027]">Checkout</span>
      </div>
      <div class="flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-[0.3em]">
        <span class="text-neutral-500">Book</span>
        <span class="text-black/20">/</span>
        <span class="text-neutral-500">Add-ons</span>
        <span class="text-black/20">/</span>
        <span class="text-neutral-500">Checkout</span>
        <span class="text-black/20">/</span>
        <span class="text-[#d12027]">Done</span>
      </div>
    </div>
  </section>

  <!-- ─── Numbered list pattern ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Numbered List</h2>
    <p class="text-neutral-700 text-base mb-6">Editorial-style listings with <span class="font-mono text-neutral-700">01 / 02 / 03</span> accents. Used on the dark newsletter benefits panel and the footer columns.</p>

    <div class="grid md:grid-cols-2 gap-6">
      <!-- Dark bg variant (newsletter) -->
      <div class="bg-neutral-900 text-white rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-6">What You Get</p>
        <ul class="space-y-4">
          <li class="flex items-start gap-4">
            <span class="font-extrabold text-[#f9dda9]/70 text-xs tracking-[0.2em] shrink-0 w-7 pt-1">01</span>
            <div class="flex-1">
              <div class="font-extrabold text-lg tracking-tight leading-tight mb-1">Preview tour invites</div>
              <div class="text-white/55 text-sm leading-relaxed">Walk new routes before they go public.</div>
            </div>
          </li>
          <li class="flex items-start gap-4">
            <span class="font-extrabold text-[#f9dda9]/70 text-xs tracking-[0.2em] shrink-0 w-7 pt-1">02</span>
            <div class="flex-1">
              <div class="font-extrabold text-lg tracking-tight leading-tight mb-1">First access to tickets</div>
              <div class="text-white/55 text-sm leading-relaxed">Book before the public launch window.</div>
            </div>
          </li>
        </ul>
      </div>

      <!-- Bullet-style on light bg (why/included) -->
      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <h3 class="text-xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Why This Tour:</h3>
        <ul class="space-y-4">
          <li class="flex items-start gap-3">
            <span aria-hidden="true" class="w-2.5 h-2.5 bg-[#d12027] mt-2 flex-shrink-0"></span>
            <p class="text-base text-neutral-800 leading-relaxed"><strong class="text-neutral-900">Led by actual comedians</strong>, not actors or tour guides.</p>
          </li>
          <li class="flex items-start gap-3">
            <span aria-hidden="true" class="w-2.5 h-2.5 bg-[#d12027] mt-2 flex-shrink-0"></span>
            <p class="text-base text-neutral-800 leading-relaxed"><strong class="text-neutral-900">Short, high-energy</strong>, easy to fit into your night.</p>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <!-- ─── Date block / ticket-stub style ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Date Block</h2>
    <p class="text-neutral-700 text-base mb-6">The signature cream-bg date badge used on the tour-list rows and inside the ticket stub. Cream fill + black border + brown drop. The list-row version is full-width horizontal on mobile, w-24 vertical on desktop.</p>

    <div class="grid md:grid-cols-2 gap-6">
      <!-- List-row style -->
      <div class="bg-white border border-dashed border-black/20 rounded-2xl p-6">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">List row (tour-list)</p>
        <div class="flex md:flex-col items-center md:justify-center gap-4 md:gap-0 bg-[#f9dda9] border-2 border-black rounded-xl w-full md:w-24 py-3 px-4 md:px-0 md:text-center" style="box-shadow: 3px 3px 0 #2d1712;">
          <span class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-900">SAT</span>
          <span class="text-3xl md:text-4xl font-extrabold text-neutral-900 leading-none tracking-tight">25</span>
          <span class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-neutral-900">APR</span>
        </div>
      </div>

      <!-- Ticket stub top band -->
      <div class="bg-white border border-dashed border-black/20 rounded-2xl p-6">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Ticket-stub band</p>
        <div class="bg-[#f9dda9] text-black px-6 py-3 flex items-center justify-between border-b-2 border-black rounded-t-xl">
          <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase">Admit 2</span>
          <span class="text-[10px] font-extrabold tracking-[0.3em] uppercase">Order ILCT-260425-A3F9B2</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── Editorial header pattern ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Editorial Header Pattern</h2>
    <p class="text-neutral-700 text-base mb-6">Used on about / contact / book / addons / checkout / thank-you. Giant faded watermark + rotated sticker + red eyebrow + big black headline + subtitle.</p>

    <div class="bg-white border border-dashed border-black/20 rounded-2xl p-6 md:p-12">
      <div class="relative">
        <span aria-hidden="true" class="hidden md:block absolute -top-6 -left-4 text-[140px] font-black text-black/[0.05] select-none leading-none pointer-events-none tracking-tight">ABOUT</span>
        <div class="cc-sticker mb-5 md:mb-0 md:absolute md:top-0 md:right-6 rotate-[-3deg] bg-[#d12027] text-white text-[10px] font-extrabold uppercase tracking-[0.22em] px-4 py-2">
          Our Story
        </div>
        <p class="relative text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-3">About The Tour</p>
        <h1 class="relative text-3xl md:text-5xl font-extrabold tracking-tight leading-[0.9] text-neutral-900">Walking tour.<br>Comedy show.<br><span class="text-[#d12027]">100% New York.</span></h1>
        <p class="relative mt-4 text-neutral-700 text-base max-w-xl leading-relaxed">Subtitle follows the headline. One-liner introducing the page.</p>
      </div>
    </div>
  </section>

  <!-- ─── Layout tokens ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Layout</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="bg-neutral-50 border border-black/10 rounded-xl p-5">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-2">Max Width</p>
        <p class="text-neutral-900 font-extrabold">max-w-[1400px]</p>
        <p class="text-xs text-neutral-500 mt-1">All pages. Newsletter block uses the same.</p>
      </div>
      <div class="bg-neutral-50 border border-black/10 rounded-xl p-5">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-2">Horizontal padding</p>
        <p class="text-neutral-900 font-extrabold">px-4 md:px-6</p>
        <p class="text-xs text-neutral-500 mt-1">16 / 24px.</p>
      </div>
      <div class="bg-neutral-50 border border-black/10 rounded-xl p-5">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-2">Section padding</p>
        <p class="text-neutral-900 font-extrabold">py-12 md:py-20</p>
        <p class="text-xs text-neutral-500 mt-1">Typical content section.</p>
      </div>
      <div class="bg-neutral-50 border border-black/10 rounded-xl p-5">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-2">Main top padding</p>
        <p class="text-neutral-900 font-extrabold">96px · 84px (mobile)</p>
        <p class="text-xs text-neutral-500 mt-1">Clears the fixed nav. Defined in <span class="font-mono text-neutral-700">main</span> rule of custom.css.</p>
      </div>
      <div class="bg-neutral-50 border border-black/10 rounded-xl p-5">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-2">Grid</p>
        <p class="text-neutral-900 font-extrabold">md:grid-cols-12</p>
        <p class="text-xs text-neutral-500 mt-1">7/5 or 8/4 asymmetric splits for content + aside.</p>
      </div>
      <div class="bg-neutral-50 border border-black/10 rounded-xl p-5">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-2">Responsive break</p>
        <p class="text-neutral-900 font-extrabold">md: 768px</p>
        <p class="text-xs text-neutral-500 mt-1">Primary break. lg at 1024, xl at 1280.</p>
      </div>
    </div>
  </section>

  <!-- ─── Radii + Shadows ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Radii &amp; Shadows</h2>

    <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Border radius</p>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
      <div>
        <div class="h-20 bg-neutral-50 border border-black/10 rounded-[6px]"></div>
        <p class="text-xs font-extrabold text-neutral-900 mt-2">rounded-[6px]</p>
        <p class="text-xs text-neutral-500">Stepper button segments</p>
      </div>
      <div>
        <div class="h-20 bg-neutral-50 border border-black/10 rounded-[10px]"></div>
        <p class="text-xs font-extrabold text-neutral-900 mt-2">rounded-[10px]</p>
        <p class="text-xs text-neutral-500">Stepper container, hamburger button</p>
      </div>
      <div>
        <div class="h-20 bg-neutral-50 border border-black/10 rounded-xl"></div>
        <p class="text-xs font-extrabold text-neutral-900 mt-2">rounded-xl (12px)</p>
        <p class="text-xs text-neutral-500">Ticket stub, stat pills, action cards</p>
      </div>
      <div>
        <div class="h-20 bg-neutral-50 border border-black/10 rounded-2xl"></div>
        <p class="text-xs font-extrabold text-neutral-900 mt-2">rounded-2xl (16px)</p>
        <p class="text-xs text-neutral-500">Large surfaces: info cards, benefits panel, calendar card</p>
      </div>
      <div>
        <div class="h-20 bg-neutral-50 border border-black/10 rounded-full"></div>
        <p class="text-xs font-extrabold text-neutral-900 mt-2">rounded-full</p>
        <p class="text-xs text-neutral-500">All buttons, stickers, social icons, nav prev/next</p>
      </div>
    </div>

    <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Brown drop shadow scale <span class="text-neutral-500 normal-case font-semibold tracking-normal">(the signature)</span></p>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
      <div>
        <div class="h-16 bg-[#d12027] rounded-full border-2 border-[#2d1712]" style="box-shadow: 0 3px 0 0 #2d1712;"></div>
        <p class="text-xs font-extrabold text-neutral-900 mt-3">3px · sm sticker</p>
        <p class="text-xs text-neutral-500 font-mono">0 3px 0 0 #2d1712</p>
      </div>
      <div>
        <div class="h-16 bg-[#d12027] rounded-full border-[3px] border-[#2d1712]" style="box-shadow: 0 4px 0 0 #2d1712;"></div>
        <p class="text-xs font-extrabold text-neutral-900 mt-3">4px · sticker</p>
        <p class="text-xs text-neutral-500 font-mono">0 4px 0 0 #2d1712</p>
      </div>
      <div>
        <div class="h-16 bg-[#d12027] rounded-full border-[3px] border-[#2d1712]" style="box-shadow: 0 6px 0 0 #2d1712;"></div>
        <p class="text-xs font-extrabold text-neutral-900 mt-3">6px · button</p>
        <p class="text-xs text-neutral-500 font-mono">0 6px 0 0 #2d1712</p>
      </div>
      <div>
        <div class="h-16 bg-neutral-50 rounded-xl border-[3px] border-[#2d1712]" style="box-shadow: 0 8px 0 0 #2d1712, 0 12px 32px -8px rgba(0,0,0,0.35);"></div>
        <p class="text-xs font-extrabold text-neutral-900 mt-3">8px · modal</p>
        <p class="text-xs text-neutral-500 font-mono">0 8px 0 0 #2d1712<br>+ ambient</p>
      </div>
    </div>
  </section>

  <!-- ─── Animations ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Animations</h2>
    <div class="grid md:grid-cols-3 gap-4">
      <div class="bg-neutral-50 border border-black/10 rounded-xl p-5">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-2">cc-view-fade</p>
        <p class="text-xs text-neutral-500 mt-1">0.3s fade + 8px upward slide on every page load. Applied to <span class="font-mono text-neutral-700">&lt;main&gt;</span>.</p>
      </div>
      <div class="bg-neutral-50 border border-black/10 rounded-xl p-5">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-2">cc-mascot-float</p>
        <p class="text-xs text-neutral-500 mt-1">6s idle bob with −3deg tilt. Home hero mascot only.</p>
      </div>
      <div class="bg-neutral-50 border border-black/10 rounded-xl p-5">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-2">Button lift on hover</p>
        <p class="text-xs text-neutral-500 mt-1">0.18s translateY + box-shadow growth. Native CSS — no JS.</p>
      </div>
    </div>
  </section>

  <!-- ─── Tech reference ─── -->
  <section class="mb-20">
    <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 mb-6 pb-2 border-b-[3px] border-neutral-900 inline-block">Stack &amp; Conventions</h2>

    <div class="grid md:grid-cols-2 gap-6">
      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Tech</p>
        <ul class="space-y-2 text-sm text-neutral-800">
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span>PHP 8+ · no framework</li>
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span>Alpine.js 3 (CDN)</li>
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span>Tailwind CSS 3 (CDN)</li>
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span>Lucide icons (CDN)</li>
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span>Montserrat (Google Fonts)</li>
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span>No build step. <span class="font-mono text-neutral-700">php -S localhost:8000</span></li>
        </ul>
      </div>

      <div class="bg-neutral-50 border border-black/10 rounded-2xl p-6 md:p-8">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Where to look</p>
        <ul class="space-y-2 text-sm text-neutral-800">
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span><span class="font-mono text-neutral-700">css/custom.css</span> — all <span class="font-mono text-neutral-700">.cc-*</span> class definitions (~110 lines)</li>
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span><span class="font-mono text-neutral-700">components/layout/head.php</span> — Tailwind config (only <span class="font-mono">fontFamily: Montserrat</span>; colors used inline as <span class="font-mono">text-[#d12027]</span>)</li>
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span><span class="font-mono text-neutral-700">data/tours.json</span> — tour copy + pricing + schedule</li>
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span><span class="font-mono text-neutral-700">data/SCHEMA.md</span> — data contract + DB migration notes</li>
          <li class="flex items-start gap-3"><span class="w-2 h-2 bg-[#d12027] mt-2 flex-shrink-0"></span><span class="font-mono text-neutral-700">README.md</span> — project setup + dev-ready notes</li>
        </ul>
      </div>
    </div>
  </section>

</div>
