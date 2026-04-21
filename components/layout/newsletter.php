<!-- ─── Subscribe ─── -->
<section class="relative z-10 overflow-hidden bg-neutral-100 py-16 md:py-24"
         x-data="{ submitted: false, submittedEmail: '' }"
         @keydown.escape.window="submitted = false">

  <div class="relative max-w-[1400px] mx-auto px-5 md:px-8">
    <div class="grid md:grid-cols-12 gap-10 md:gap-14 items-center">

      <!-- Left: heading + form -->
      <div class="md:col-span-7">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#d12027] mb-4">Newsletter</p>
        <h2 class="text-neutral-900 font-extrabold tracking-tight leading-[0.95] text-5xl md:text-6xl lg:text-7xl mb-5">Subscribe.</h2>
        <p class="text-neutral-700 text-base md:text-lg mb-8 max-w-lg leading-relaxed">
          Hear about tour launches and preview events before they go public. One short email when there's something worth saying.
        </p>

        <!-- Email + Subscribe form -->
        <form class="max-w-[560px]"
              @submit.prevent="submittedEmail = $event.target.querySelector('input[type=email]').value; submitted = true; $event.target.reset()">
          <div class="flex flex-col sm:flex-row gap-3">
            <input type="email" required placeholder="you@somewhere.com" aria-label="Email"
                   class="flex-1 bg-white border-2 border-black/15 focus:border-[#d12027] rounded-full px-6 py-3.5 text-neutral-900 text-sm md:text-base placeholder:text-neutral-400 focus:outline-none transition-colors" />
            <button type="submit" class="cc-btn-primary text-xs md:text-sm tracking-[0.22em] px-8 py-3.5 shrink-0">
              Subscribe
            </button>
          </div>
          <p class="text-[11px] text-neutral-500 mt-4">No spam. Unsubscribe anytime.</p>
        </form>
      </div>

      <!-- Right: benefits panel -->
      <div class="md:col-span-5">
        <div class="relative bg-neutral-900 text-white rounded-2xl p-7 md:p-9 overflow-hidden">
          <!-- Decorative dot pattern -->
          <div aria-hidden="true" class="absolute inset-0 opacity-[0.06] pointer-events-none" style="background-image: radial-gradient(circle, rgba(255,255,255,0.9) 1px, transparent 1.5px); background-size: 22px 22px;"></div>
          <!-- Warm corner glow -->
          <div aria-hidden="true" class="absolute -top-16 -right-16 w-48 h-48 rounded-full bg-[#d12027]/25 blur-3xl pointer-events-none"></div>

          <div class="relative">
            <div class="flex items-center gap-3 mb-7">
              <span class="w-1.5 h-1.5 rounded-full bg-[#f9dda9] animate-pulse"></span>
              <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9]">What You Get</p>
            </div>

            <ul class="space-y-5">
              <li class="flex items-start gap-5">
                <span class="font-extrabold text-[#f9dda9]/70 text-xs tracking-[0.2em] shrink-0 w-7 pt-1">01</span>
                <div class="flex-1 pb-5 border-b border-white/10">
                  <div class="font-extrabold text-lg md:text-xl tracking-tight leading-tight mb-1">Preview tour invites</div>
                  <div class="text-white/55 text-sm leading-relaxed">Walk new routes before they go public.</div>
                </div>
              </li>
              <li class="flex items-start gap-5">
                <span class="font-extrabold text-[#f9dda9]/70 text-xs tracking-[0.2em] shrink-0 w-7 pt-1">02</span>
                <div class="flex-1 pb-5 border-b border-white/10">
                  <div class="font-extrabold text-lg md:text-xl tracking-tight leading-tight mb-1">First access to tickets</div>
                  <div class="text-white/55 text-sm leading-relaxed">Book before the public launch window.</div>
                </div>
              </li>
              <li class="flex items-start gap-5">
                <span class="font-extrabold text-[#f9dda9]/70 text-xs tracking-[0.2em] shrink-0 w-7 pt-1">03</span>
                <div class="flex-1">
                  <div class="font-extrabold text-lg md:text-xl tracking-tight leading-tight mb-1">Early-bird pricing</div>
                  <div class="text-white/55 text-sm leading-relaxed">Discounts reserved for the list.</div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- ─── Success Modal ─── -->
  <div x-cloak x-show="submitted"
       x-transition.opacity
       @click.self="submitted = false"
       class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
    <div x-show="submitted"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         class="cc-modal-panel relative w-full max-w-[460px] bg-neutral-50 rounded-xl p-8 md:p-10 text-center">

      <!-- Close button -->
      <button type="button" @click="submitted = false" aria-label="Close"
              class="absolute top-3 right-3 w-9 h-9 flex items-center justify-center rounded-full bg-black/5 border border-black/10 hover:bg-[#f9dda9] hover:text-black hover:border-[#f9dda9] text-neutral-900 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <!-- Sticker -->
      <div class="flex justify-center mb-6">
        <div class="cc-sticker gap-2 bg-[#d12027] text-white text-[10px] font-extrabold uppercase tracking-[0.3em] px-4 py-2 -rotate-2">
          <span aria-hidden="true">★</span>
          You're In
        </div>
      </div>

      <!-- Headline -->
      <h3 class="text-[#d12027] text-3xl md:text-4xl font-extrabold tracking-tight leading-[0.95] mb-4">
        You're subscribed.
      </h3>

      <!-- Body copy -->
      <p class="text-neutral-700 text-sm md:text-base leading-relaxed mb-8">
        A confirmation is on its way to
        <span class="text-[#d12027] font-bold break-all" x-text="submittedEmail"></span>.
        Check your inbox to finish signing up.
      </p>

      <!-- CTA -->
      <button type="button" @click="submitted = false"
              class="cc-btn-primary w-full text-sm tracking-[0.24em] px-6 py-4">
        Got It
      </button>
    </div>
  </div>

</section>
