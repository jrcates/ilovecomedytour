<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6"
     x-data="{ submitted: false, submittedName: '' }"
     @keydown.escape.window="submitted = false">

  <!-- ─── Header ─── -->
  <div class="relative mb-10 md:mb-24">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[280px] font-black text-white/[0.04] select-none leading-none pointer-events-none">01</span>
    <div class="inline-flex mb-5 md:mb-0 md:absolute md:top-0 md:right-12 rotate-[6deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2 border-2 border-black" style="box-shadow: 4px 4px 0 #000;">
      Hard To Reach
    </div>
    <h1 class="relative text-5xl md:text-7xl lg:text-8xl font-extrabold tracking-tight leading-[0.9]">Contact.</h1>
  </div>

  <!-- ─── Pull Quote ─── -->
  <div class="mb-12 md:mb-28 grid md:grid-cols-12 gap-4 md:gap-6">
    <div class="md:col-span-1 md:col-start-1">
      <span aria-hidden="true" class="block text-[#f9dda9] text-[120px] md:text-[160px] leading-[0.7] select-none" style="font-family: Georgia, serif;">&ldquo;</span>
    </div>
    <p class="md:col-span-10 md:col-start-2 text-xl md:text-3xl lg:text-4xl font-bold text-white leading-snug tracking-tight">
      Because I am famous it is difficult to contact me directly. Please try your luck with the contacts below.
    </p>
  </div>

  <!-- ─── Contact Cards ─── -->
  <section class="mb-12 md:mb-28">
    <p class="text-[#e85a5f] text-xs font-extrabold tracking-[0.3em] uppercase mb-6">The Team</p>

    <div class="grid md:grid-cols-3 rounded-xl overflow-hidden bg-[#1e1e1e] border border-white/10">

      <!-- Management -->
      <div class="group relative p-8 md:p-10 border-b md:border-b-0 md:border-r border-white/10 hover:bg-white/[0.03] transition-colors">
        <span aria-hidden="true" class="absolute top-6 right-6 text-[#f9dda9]/15 text-4xl font-black leading-none tracking-tight">N°01</span>
        <p class="text-[#e85a5f] text-[11px] font-extrabold tracking-[0.24em] uppercase mb-6">Management</p>
        <h3 class="text-2xl md:text-3xl font-extrabold text-white leading-tight mb-1">Joel Zadak</h3>
        <p class="text-sm text-neutral-400 mb-6">Artists First</p>
        <a href="mailto:allzadak@artistsfirst-la.com" class="group/link inline-flex items-center gap-2 text-sm text-white hover:text-[#f9dda9] transition-colors break-all">
          allzadak@artistsfirst-la.com
          <svg class="w-3.5 h-3.5 shrink-0 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>

      <!-- Agent -->
      <div class="group relative p-8 md:p-10 border-b md:border-b-0 md:border-r border-white/10 hover:bg-white/[0.03] transition-colors">
        <span aria-hidden="true" class="absolute top-6 right-6 text-[#f9dda9]/15 text-4xl font-black leading-none tracking-tight">N°02</span>
        <p class="text-[#e85a5f] text-[11px] font-extrabold tracking-[0.24em] uppercase mb-6">Agent</p>
        <h3 class="text-2xl md:text-3xl font-extrabold text-white leading-tight mb-1">Max Burgos</h3>
        <p class="text-sm text-neutral-400 mb-6">Independent Artist Group (IAG)</p>
        <a href="mailto:mburgos@independentartistgroup.com" class="group/link inline-flex items-center gap-2 text-sm text-white hover:text-[#f9dda9] transition-colors break-all">
          mburgos@independentartistgroup.com
          <svg class="w-3.5 h-3.5 shrink-0 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>

      <!-- Publicist -->
      <div class="group relative p-8 md:p-10 hover:bg-white/[0.03] transition-colors">
        <span aria-hidden="true" class="absolute top-6 right-6 text-[#f9dda9]/15 text-4xl font-black leading-none tracking-tight">N°03</span>
        <p class="text-[#e85a5f] text-[11px] font-extrabold tracking-[0.24em] uppercase mb-6">Publicist</p>
        <h3 class="text-2xl md:text-3xl font-extrabold text-white leading-tight mb-1">Sam Srinivasan</h3>
        <p class="text-sm text-neutral-400 mb-6">Sechel PR</p>
        <a href="mailto:sam@sechelpr.com" class="group/link inline-flex items-center gap-2 text-sm text-white hover:text-[#f9dda9] transition-colors break-all">
          sam@sechelpr.com
          <svg class="w-3.5 h-3.5 shrink-0 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>

    </div>
  </section>

  <!-- ─── Form ─── -->
  <section class="grid md:grid-cols-12 gap-6 md:gap-12">

    <!-- Intro column -->
    <div class="md:col-span-4 md:sticky md:top-48 md:self-start">
      <p class="text-[#e85a5f] text-xs font-extrabold tracking-[0.3em] uppercase mb-5">Or</p>
      <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-[0.95] mb-6">
        Drop us <br>a line.
      </h2>
      <p class="text-neutral-400 text-sm md:text-base leading-relaxed max-w-sm">
        Not urgent? The form's fine. Fans, long-shot pitches, corrections — we read them all. Probably.
      </p>
      <div class="mt-8 pt-8 border-t border-white/10 hidden md:block">
        <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#f9dda9] mb-2">Typical response</p>
        <p class="text-white text-lg font-bold">Within a week — ish.</p>
      </div>
    </div>

    <!-- Form column -->
    <form class="md:col-span-8"
          @submit.prevent="submittedName = $event.target.querySelector('input[name=first_name]').value; submitted = true; $event.target.reset()">

      <div class="grid md:grid-cols-2 gap-x-8 gap-y-8 mb-12">
        <div>
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-3">
            <span>First Name</span>
            <span class="text-[#d12027] text-base leading-none">*</span>
          </label>
          <input required type="text" name="first_name" placeholder="First"
                 class="w-full bg-transparent border-b-2 border-white/15 focus:border-[#f9dda9] py-3 text-white text-base placeholder:text-white/25 focus:outline-none transition-colors" />
        </div>

        <div>
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-3">
            <span>Last Name</span>
            <span class="text-[#d12027] text-base leading-none">*</span>
          </label>
          <input required type="text" name="last_name" placeholder="Last"
                 class="w-full bg-transparent border-b-2 border-white/15 focus:border-[#f9dda9] py-3 text-white text-base placeholder:text-white/25 focus:outline-none transition-colors" />
        </div>

        <div class="md:col-span-2">
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-3">
            <span>Email</span>
            <span class="text-[#d12027] text-base leading-none">*</span>
          </label>
          <input required type="email" name="email" placeholder="you@somewhere.com"
                 class="w-full bg-transparent border-b-2 border-white/15 focus:border-[#f9dda9] py-3 text-white text-base placeholder:text-white/25 focus:outline-none transition-colors" />
        </div>

        <div class="md:col-span-2">
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-3">
            <span>Message</span>
            <span class="text-[#d12027] text-base leading-none">*</span>
          </label>
          <textarea required name="message" rows="5" placeholder="Say something…"
                    class="w-full bg-transparent border-b-2 border-white/15 focus:border-[#f9dda9] py-3 text-white text-base placeholder:text-white/25 focus:outline-none transition-colors resize-none"></textarea>
        </div>
      </div>

      <button type="submit" class="cc-btn-primary text-sm tracking-[0.24em] px-12 py-4">
        Send Message
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </button>
    </form>

  </section>

  <!-- ─── Success Modal ─── -->
  <div x-cloak x-show="submitted"
       x-transition.opacity
       @click.self="submitted = false"
       class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
    <div x-show="submitted"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         class="relative w-full max-w-[480px] bg-[#1e1e1e] border-2 border-black rounded-xl p-8 md:p-10 text-center"
         style="box-shadow: 8px 8px 0 #000;">

      <!-- Close button -->
      <button type="button" @click="submitted = false" aria-label="Close"
              class="absolute top-3 right-3 w-9 h-9 flex items-center justify-center rounded-full bg-white/5 border border-white/10 hover:bg-[#f9dda9] hover:text-black hover:border-[#f9dda9] text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <!-- Rotated red sticker -->
      <div class="flex justify-center mb-6">
        <div class="inline-flex items-center gap-2 bg-[#d12027] text-white text-[10px] font-extrabold uppercase tracking-[0.3em] px-4 py-2 -rotate-2 border-2 border-black" style="box-shadow: 4px 4px 0 #000;">
          <span aria-hidden="true">★</span>
          Message Received
        </div>
      </div>

      <!-- Headline -->
      <h3 class="text-[#f9dda9] text-3xl md:text-4xl font-extrabold tracking-tight leading-[0.95] mb-4">
        Thanks<span x-show="submittedName">, <span x-text="submittedName"></span></span>.
      </h3>

      <!-- Body copy — matches the pull quote's voice -->
      <p class="text-white/80 text-sm md:text-base leading-relaxed mb-2">
        Your note is now in the queue, somewhere behind a million others.
      </p>
      <p class="text-white/60 text-xs md:text-sm leading-relaxed mb-8">
        Someone on the team will read it and — if the stars align — get back to you within a week-ish. Probably. No promises.
      </p>

      <!-- CTA -->
      <button type="button" @click="submitted = false"
              class="cc-btn-primary w-full text-sm tracking-[0.24em] px-6 py-4">
        Got It
      </button>
    </div>
  </div>

</div>
