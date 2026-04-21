<div class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1400px] mx-auto px-4 md:px-6"
     x-data="{ submitted: false, submittedName: '' }"
     @keydown.escape.window="submitted = false">

  <!-- ─── Header ─── -->
  <div class="relative mb-10 md:mb-20">
    <span aria-hidden="true" class="hidden md:block absolute -top-10 -left-4 text-[220px] lg:text-[280px] font-black text-black/[0.04] select-none leading-none pointer-events-none">HI</span>
    <div class="cc-sticker mb-5 md:mb-0 md:absolute md:top-0 md:right-12 rotate-[6deg] bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.22em] px-4 py-2">
      Say Hello
    </div>
    <p class="relative text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-4">Get In Touch</p>
    <h1 class="relative text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[0.9] text-neutral-900">Contact.</h1>
    <p class="relative mt-6 md:mt-8 text-neutral-700 text-lg md:text-xl max-w-2xl leading-relaxed">
      Questions about a booking, press, group bookings, or anything that feels too long for a form — drop us a line.
    </p>
  </div>

  <!-- ─── Form + Email ─── -->
  <section class="grid md:grid-cols-12 gap-8 md:gap-16">

    <!-- Left: email + intro -->
    <div class="md:col-span-5 md:sticky md:top-32 md:self-start">
      <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Email Us Directly</p>
      <a href="mailto:touradmin@ilovecomedytour.com"
         class="inline-flex items-baseline gap-2 text-lg md:text-xl font-extrabold text-neutral-900 hover:text-[#d12027] tracking-tight leading-tight break-all transition-colors mb-8">
        touradmin@ilovecomedytour.com
      </a>

      <div class="pt-8 border-t border-black/10">
        <p class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-[#d12027] mb-2">Typical response</p>
        <p class="text-neutral-900 text-base md:text-lg font-bold leading-relaxed">Within a week — ish.</p>
      </div>
    </div>

    <!-- Right: form -->
    <form class="md:col-span-7"
          @submit.prevent="submittedName = $event.target.querySelector('input[name=first_name]').value; submitted = true; $event.target.reset()">

      <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-6">Or Send Us A Message</p>

      <div class="grid md:grid-cols-2 gap-x-8 gap-y-8 mb-10">
        <div>
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
            <span>First Name</span>
            <span class="text-[#d12027] text-base leading-none">*</span>
          </label>
          <input required type="text" name="first_name" placeholder="First"
                 class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
        </div>

        <div>
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
            <span>Last Name</span>
            <span class="text-[#d12027] text-base leading-none">*</span>
          </label>
          <input required type="text" name="last_name" placeholder="Last"
                 class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
        </div>

        <div class="md:col-span-2">
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
            <span>Email</span>
            <span class="text-[#d12027] text-base leading-none">*</span>
          </label>
          <input required type="email" name="email" placeholder="you@somewhere.com"
                 class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
        </div>

        <div class="md:col-span-2">
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-3">
            <span>Message</span>
            <span class="text-[#d12027] text-base leading-none">*</span>
          </label>
          <textarea required name="message" rows="5" placeholder="Say something…"
                    class="w-full bg-transparent border-b-2 border-black/15 focus:border-[#d12027] py-3 text-neutral-900 text-base placeholder:text-neutral-400 focus:outline-none transition-colors resize-none"></textarea>
        </div>
      </div>

      <button type="submit" class="cc-btn-primary text-sm tracking-[0.24em] px-10 md:px-12 py-4">
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
         class="cc-modal-panel relative w-full max-w-[480px] bg-neutral-50 rounded-xl p-8 md:p-10 text-center">

      <button type="button" @click="submitted = false" aria-label="Close"
              class="absolute top-3 right-3 w-9 h-9 flex items-center justify-center rounded-full bg-black/5 border border-black/10 hover:bg-[#f9dda9] hover:text-black hover:border-[#f9dda9] text-neutral-900 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <div class="flex justify-center mb-6">
        <div class="cc-sticker gap-2 bg-[#d12027] text-white text-[10px] font-extrabold uppercase tracking-[0.3em] px-4 py-2 -rotate-2">
          <span aria-hidden="true">★</span>
          Message Received
        </div>
      </div>

      <h3 class="text-[#d12027] text-3xl md:text-4xl font-extrabold tracking-tight leading-[0.95] mb-4">
        Thanks<span x-show="submittedName">, <span x-text="submittedName"></span></span>.
      </h3>

      <p class="text-neutral-700 text-sm md:text-base leading-relaxed mb-8">
        We've got your message. Someone on the team will read it and get back to you within a week-ish.
      </p>

      <button type="button" @click="submitted = false"
              class="cc-btn-primary w-full text-sm tracking-[0.24em] px-6 py-4">
        Got It
      </button>
    </div>
  </div>

</div>
