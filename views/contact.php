<?php
$success = isset($_POST['form_submitted']) && $_POST['form_submitted'] === '1';
?>

<?php if ($success): ?>
<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <div class="w-24 h-24 bg-green-500/10 rounded-xl flex items-center justify-center mb-8">
    <i data-lucide="circle-check" class="w-12 h-12 text-green-500"></i>
  </div>
  <h1 class="text-3xl md:text-4xl font-bold mb-3">Message Sent!</h1>
  <p class="text-xl text-neutral-400 max-w-lg mb-8">Thanks for reaching out. We've received your submission and will get back to you soon.</p>
  <a href="?view=contact" class="px-8 py-4 bg-[#d12027] text-white font-bold rounded-[10px] hover:bg-[#a91a20] transition-colors">Send Another</a>
</div>
<?php else: ?>

<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6">

  <!-- Header -->
  <div class="mb-12">
    <h1 class="text-3xl md:text-4xl font-extrabold mb-3 tracking-tight">Contact Us</h1>
  </div>

  <div class="grid lg:grid-cols-2 gap-12 max-w-6xl items-start">

    <!-- Left Column: Info -->
    <div class="relative bg-[#1e1e1e] p-6 md:p-10 rounded-xl shadow-2xl overflow-hidden">
      <div class="relative z-10 space-y-8">
        <div>
          <h3 class="text-3xl font-bold text-white mb-4">Ready to Team Up?</h3>
          <p class="text-neutral-400 leading-relaxed">Drop us your details and we'll reach out to you soon. We're excited to chat with you!</p>
        </div>

        <!-- Email & Phone -->
        <div class="space-y-3">
          <a href="mailto:comedybreakin205@gmail.com" class="flex items-center gap-3 p-4 rounded-xl bg-white/5 border border-white/5 hover:border-white/10 transition-colors group min-w-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#d12027] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 01-2.06 0L2 7"/></svg>
            <div class="min-w-0">
              <h4 class="text-white font-bold">Email</h4>
              <p class="text-neutral-400 text-sm group-hover:text-neutral-300 transition-colors break-all">comedybreakin205@gmail.com</p>
            </div>
          </a>
          <a href="tel:0000000000" class="flex items-center gap-3 p-4 rounded-xl bg-white/5 border border-white/5 hover:border-white/10 transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#d12027] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            <div>
              <h4 class="text-white font-bold">Phone</h4>
              <p class="text-neutral-400 text-sm group-hover:text-neutral-300 transition-colors">(000) 000-0000</p>
            </div>
          </a>
        </div>

        <!-- What We Offer -->
        <div class="space-y-4">
          <div class="border-t border-white/10 pt-6">
            <p class="text-neutral-400 text-sm leading-relaxed">We also offer event pricing, show production, small intimate shows, as well as bigger productions. We have a mass of over 100 comics of all levels ready to make your event or night out well worth the time.</p>
          </div>

          <div class="flex items-center gap-3 p-4 rounded-xl bg-[#d12027]/10 border border-[#d12027]/20">
            <i data-lucide="calendar" class="w-5 h-5 text-[#d12027] flex-shrink-0"></i>
            <p class="text-sm text-white font-bold">Summer calendar is booking now.</p>
          </div>

          <div class="flex items-center gap-3 p-4 rounded-xl bg-white/5 border border-white/5">
            <i data-lucide="music" class="w-5 h-5 text-[#d12027] flex-shrink-0"></i>
            <p class="text-sm text-neutral-300">Now offering DJ, Karaoke, and event hosting as well as Comedy.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column: Form -->
    <div x-data="{
      inquiry: 'contact',
      open: false,
      options: [
        { value: 'contact', label: 'Contact Us', icon: 'message-circle', desc: 'Questions about shows, private events, or anything else — we\'d love to hear from you.' },
        { value: 'hack-and-forth', label: 'Hack and Forth', icon: 'zap', desc: 'Hack and Forth is a Fast Paced Panel style comedy show, available for booking now.' },
        { value: 'production', label: 'Let Us Bring the Production to You', icon: 'music', desc: 'Do you want more than Comedy? We also offer DJ, Emcee, Karaoke, and Full event hosting. For parties, Weddings, and more.' },
        { value: 'comedy-showcase', label: 'Comedy Showcase', icon: 'mic', desc: 'Does your bar, venue, or event space want to book a comedy show that could last anywhere from 30 minutes to 2 hours? Look no further — we have a wide array of comics at all price ranges.' }
      ],
      get selected() { return this.options.find(o => o.value === this.inquiry) },
      get selectedDesc() { return this.selected ? this.selected.desc : '' }
    }" @click.away="open = false" class="bg-[#1e1e1e] pt-0 pb-8 px-5 md:px-10 rounded-xl border border-white/10 shadow-xl">
      <form method="POST" action="?view=contact" class="space-y-6">
        <input type="hidden" name="form_submitted" value="1" />

        <h2 class="text-2xl font-bold mb-2 text-white flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#d12027]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="m22 2-7 20-4-9-9-4z"/><path d="M22 2 11 13"/></svg>
          Send us a Message
        </h2>

        <!-- Inquiry Type Selection -->
        <div class="space-y-2 relative">
          <label class="text-sm font-bold text-neutral-400 ml-1">What can we help you with?</label>
          <input type="hidden" name="inquiry" :value="inquiry" />

          <!-- Custom Select Trigger -->
          <button type="button" @click="open = !open"
                  class="w-full bg-white/5 border border-white/10 rounded-[10px] p-4 text-left text-white flex items-center gap-3 hover:border-white/20 transition-colors"
                  :class="open && 'ring-2 ring-[#d12027] border-transparent'">
            <div class="w-8 h-8 rounded-lg bg-[#d12027]/15 flex items-center justify-center flex-shrink-0">
              <i :data-lucide="selected?.icon" class="w-4 h-4 text-[#d12027]"></i>
            </div>
            <span class="flex-1 font-medium truncate" x-text="selected?.label || 'Select an inquiry type'"></span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-neutral-500 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
          </button>

          <!-- Dropdown Options -->
          <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
               class="absolute z-30 left-0 right-0 mt-2 bg-[#1a1a1a] border border-white/10 rounded-[10px] overflow-hidden shadow-2xl">
            <template x-for="opt in options" :key="opt.value">
              <button type="button"
                      @click="inquiry = opt.value; open = false; $nextTick(() => { lucide.createIcons() })"
                      class="w-full flex items-start gap-3 px-4 py-3.5 text-left hover:bg-white/5 transition-colors border-b border-white/5 last:border-0"
                      :class="inquiry === opt.value && 'bg-[#d12027]/10'">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5"
                     :class="inquiry === opt.value ? 'bg-[#d12027]/20' : 'bg-white/5'">
                  <i :data-lucide="opt.icon" class="w-4 h-4" :class="inquiry === opt.value ? 'text-[#d12027]' : 'text-neutral-500'"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <span class="block text-sm font-bold" :class="inquiry === opt.value ? 'text-white' : 'text-neutral-300'" x-text="opt.label"></span>
                  <span class="block text-xs text-neutral-500 mt-0.5 leading-relaxed" x-text="opt.desc"></span>
                </div>
                <div x-show="inquiry === opt.value" class="flex-shrink-0 mt-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#d12027]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg>
                </div>
              </button>
            </template>
          </div>
        </div>

        <!-- Inquiry Description -->
        <div x-show="inquiry" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
          <div class="rounded-[10px] bg-[#d12027]/10 border border-[#d12027]/20 px-5 py-4">
            <p class="text-sm text-neutral-300 leading-relaxed" x-text="selectedDesc"></p>
          </div>
        </div>

        <!-- Name Fields -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-2">
            <label class="text-sm font-bold text-neutral-400 ml-1">First Name</label>
            <input required type="text" name="first_name" placeholder="First name" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-4 text-white focus:ring-2 focus:ring-[#d12027] focus:border-transparent outline-none placeholder:text-neutral-500" />
          </div>
          <div class="space-y-2">
            <label class="text-sm font-bold text-neutral-400 ml-1">Last Name</label>
            <input required type="text" name="last_name" placeholder="Last name" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-4 text-white focus:ring-2 focus:ring-[#d12027] focus:border-transparent outline-none placeholder:text-neutral-500" />
          </div>
        </div>

        <!-- Email -->
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-400 ml-1">Email</label>
          <input required type="email" name="email" placeholder="your@email.com" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-4 text-white focus:ring-2 focus:ring-[#d12027] focus:border-transparent outline-none placeholder:text-neutral-500" />
        </div>

        <!-- Message -->
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-400 ml-1">Message</label>
          <textarea required name="message" rows="5" placeholder="How can we help you?" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-4 text-white focus:ring-2 focus:ring-[#d12027] focus:border-transparent outline-none placeholder:text-neutral-500 resize-none"></textarea>
        </div>

        <!-- City & State -->
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-400 ml-1">City and State <span class="font-normal text-neutral-600">— for tailored offers</span></label>
          <input type="text" name="city_state" placeholder="e.g. Huntsville, AL" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-4 text-white focus:ring-2 focus:ring-[#d12027] focus:border-transparent outline-none placeholder:text-neutral-500" />
        </div>

        <button type="submit" class="w-full py-4 bg-white text-black font-bold text-lg rounded-[10px] hover:bg-neutral-200 transition-colors shadow-lg mt-4">Send Message</button>
      </form>
    </div>

  </div>
</div>
<?php endif; ?>
