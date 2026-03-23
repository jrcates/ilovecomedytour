<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center justify-center text-center">

  <!-- Animated Check Icon -->
  <div class="relative mb-12">
    <div class="absolute inset-0 bg-[#d12027] blur-3xl opacity-20 rounded-full animate-pulse"></div>
    <div class="relative w-32 h-32 bg-[#d12027]/10 rounded-full border-2 border-[#d12027] flex items-center justify-center shadow-2xl">
      <i data-lucide="circle-check" class="w-16 h-16 text-[#d12027]"></i>
    </div>
  </div>

  <h1 class="text-3xl md:text-4xl font-extrabold mb-3 tracking-tight">
    You're In!
  </h1>

  <p class="text-xl text-neutral-400 max-w-2xl mx-auto mb-4 leading-relaxed">
    Your tickets are confirmed. Get ready to laugh — we'll see you at the club!
  </p>
  <p class="text-neutral-400 mb-12">A confirmation email has been sent to your inbox.</p>

  <!-- Key Info -->
  <div class="grid md:grid-cols-3 gap-6 max-w-3xl w-full mb-16">
    <?php foreach ([
      ['📅', 'Date', 'Check your confirmation email'],
      ['🕗', 'Doors Open', '1 hour before showtime'],
      ['📍', 'Location', 'See your ticket for venue details'],
    ] as [$icon, $title, $detail]): ?>
    <div class="bg-white/5 p-6 rounded-xl border border-white/10 text-center">
      <div class="text-3xl mb-2"><?= $icon ?></div>
      <h3 class="font-bold text-white text-sm tracking-wide mb-1"><?= $title ?></h3>
      <p class="text-neutral-400 text-sm"><?= $detail ?></p>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Important Reminder -->
  <div class="bg-[#d12027]/10 border border-[#d12027]/30 rounded-xl p-6 max-w-xl w-full mb-12 text-left">
    <h4 class="text-[#d12027] font-bold text-sm tracking-wide mb-2">Friendly Reminder</h4>
    <p class="text-neutral-400 text-sm leading-relaxed">Arrive 30 minutes early — seating is first come, first served. There is a 2-drink minimum for all shows.</p>
  </div>

  <div class="flex flex-col sm:flex-row gap-4">
    <a href="?view=home" class="px-8 py-4 bg-white text-black font-bold rounded-[10px] hover:bg-neutral-200 transition-colors">Back to Home</a>
    <a href="?view=calendar" class="px-8 py-4 bg-white/5 text-white font-bold rounded-[10px] hover:bg-white/10 transition-colors border border-white/10">View More Shows</a>
  </div>
</div>
