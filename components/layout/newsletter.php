<!-- ─── Newsletter / Mailing List ─── -->
<section class="relative z-10 overflow-hidden bg-[#161616]"
         x-data="{ submitted: false, submittedEmail: '' }"
         @keydown.escape.window="submitted = false">

  <!-- Top divider strip (static, non-scrolling) -->
  <div class="bg-[#f9dda9] text-black border-y-2 border-black py-2.5 flex items-center justify-center gap-5 text-xs md:text-sm font-extrabold uppercase tracking-[0.3em]">
    <span aria-hidden="true">★</span>
    <span>Mailing List</span>
    <span aria-hidden="true">★</span>
  </div>

  <div class="py-20 md:py-28 relative max-w-[1100px] mx-auto px-4 md:px-6">

    <!-- Rotated sticker badge -->
    <div class="flex justify-center mb-6">
      <div class="inline-flex items-center gap-2 bg-[#d12027] text-white text-[10px] md:text-xs font-extrabold uppercase tracking-[0.3em] px-4 py-2 -rotate-2 border-2 border-black" style="box-shadow: 4px 4px 0 #000;">
        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
        No Algorithms · Just Inbox
      </div>
    </div>

    <!-- Title -->
    <h2 class="text-center text-[#f9dda9] font-extrabold tracking-tight leading-[0.95] mb-3 text-4xl sm:text-5xl md:text-6xl lg:text-7xl">
      Ronny's Mailing List
    </h2>

    <!-- Tagline -->
    <p class="text-center text-white/50 text-xs md:text-sm uppercase tracking-[0.4em] font-semibold mb-12">Tour dates · Specials · Random thoughts</p>

    <!-- Body copy -->
    <div class="max-w-[760px] mx-auto mb-10">
      <p class="text-white/85 text-[15px] md:text-[17px] leading-[1.8] text-center">
        Instead of figuring out how to game these horrible social media algorithms by flooding my followers with dumb content, I'm trying to actually <span class="text-[#f9dda9] font-bold">respect my audience</span> for once by creating an email list to contact you only when I want something from you — a tour stop in your city, a new special dropping, or whatever the comedy platform of the future turns out to be. Sign up below, unsubscribe any time.
      </p>
    </div>

    <!-- Form -->
    <form class="max-w-[820px] mx-auto mb-10"
          @submit.prevent="submittedEmail = $event.target.querySelector('input[type=email]').value; submitted = true; $event.target.reset()">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8 mb-12">

        <div class="group">
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-3">
            <span>Email</span>
            <span class="text-[#d12027] text-base leading-none">*</span>
          </label>
          <input type="email" required placeholder="you@somewhere.com" aria-label="Email"
                 class="w-full bg-transparent border-b-2 border-white/15 focus:border-[#f9dda9] py-3 text-white text-base placeholder:text-white/25 focus:outline-none transition-colors" />
        </div>

        <div class="group">
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-3">
            <span>Postal Code</span>
            <span class="text-[#d12027] text-base leading-none">*</span>
          </label>
          <input type="text" required placeholder="90210" aria-label="Postal Code"
                 class="w-full bg-transparent border-b-2 border-white/15 focus:border-[#f9dda9] py-3 text-white text-base placeholder:text-white/25 focus:outline-none transition-colors" />
        </div>

        <div class="group">
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-3">
            <span>Name</span>
          </label>
          <input type="text" placeholder="Your name" aria-label="Name"
                 class="w-full bg-transparent border-b-2 border-white/15 focus:border-[#f9dda9] py-3 text-white text-base placeholder:text-white/25 focus:outline-none transition-colors" />
        </div>

        <div class="group">
          <label class="flex items-center justify-between text-[10px] font-extrabold uppercase tracking-[0.3em] text-[#f9dda9] mb-3">
            <span>Phone</span>
          </label>
          <input type="tel" placeholder="(555) 555-5555" aria-label="Phone"
                 class="w-full bg-transparent border-b-2 border-white/15 focus:border-[#f9dda9] py-3 text-white text-base placeholder:text-white/25 focus:outline-none transition-colors" />
        </div>

      </div>

      <!-- Big 3D-shadow button -->
      <div class="flex justify-center">
        <button type="submit" class="cc-btn-primary text-sm md:text-base tracking-[0.3em] px-16 md:px-24 py-5">
          Sign Me Up
        </button>
      </div>
    </form>

    <!-- Alternative channels -->
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 text-sm">
      <p class="text-white/50 uppercase tracking-[0.2em] text-[11px] font-semibold">Or follow along:</p>
      <div class="flex items-center gap-5">
        <a href="#" class="group inline-flex items-center gap-2 text-white hover:text-[#f9dda9] transition-colors">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          WhatsApp Channel
        </a>
        <span class="w-1 h-1 rounded-full bg-white/20"></span>
        <a href="#" class="group inline-flex items-center gap-2 text-white hover:text-[#f9dda9] transition-colors">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          Instagram
        </a>
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
          You're In
        </div>
      </div>

      <!-- Headline -->
      <h3 class="text-[#f9dda9] text-3xl md:text-4xl font-extrabold tracking-tight leading-[0.95] mb-4">
        Welcome to the list.
      </h3>

      <!-- Body copy -->
      <p class="text-white/80 text-sm md:text-base leading-relaxed mb-2">
        A confirmation is on its way to
        <span class="text-[#f9dda9] font-bold break-all" x-text="submittedEmail"></span>.
      </p>
      <p class="text-white/60 text-xs md:text-sm leading-relaxed mb-8">
        Check your inbox (and maybe spam) to finish subscribing. You'll only hear from me when I actually have something worth saying — tour stops, new specials, big announcements. Unsubscribe any time.
      </p>

      <!-- CTA -->
      <button type="button" @click="submitted = false"
              class="cc-btn-primary w-full text-sm tracking-[0.24em] px-6 py-4">
        Got It
      </button>
    </div>
  </div>

</section>
