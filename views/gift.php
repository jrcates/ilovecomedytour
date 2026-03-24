<?php
$success = isset($_POST['gift_submitted']) && $_POST['gift_submitted'] === '1';
?>

<?php if ($success): ?>
<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <div class="w-24 h-24 bg-green-500/10 rounded-xl flex items-center justify-center mb-8">
    <i data-lucide="circle-check" class="w-12 h-12 text-green-500"></i>
  </div>
  <h1 class="text-3xl md:text-4xl font-bold mb-3">Thank You!</h1>
  <p class="text-xl text-neutral-400 max-w-lg mb-8">Your gift certificate purchase was successful. We've sent a confirmation email with the certificate attached.</p>
  <a href="?view=gift" class="px-8 py-4 bg-white text-black font-bold rounded-[10px] hover:bg-neutral-200 transition-colors">Purchase Another</a>
</div>
<?php else: ?>

<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6" x-data="{ amount: 50 }">
  <!-- Header -->
  <div class="mb-16">
    <h1 class="text-3xl md:text-4xl font-extrabold mb-3 tracking-tight">Gift Certificates</h1>
  </div>

  <div class="grid lg:grid-cols-12 gap-12">

    <!-- Info Side -->
    <div class="lg:col-span-5 space-y-8">
      <div class="relative bg-[#1e1e1e] p-10 rounded-xl shadow-2xl overflow-hidden">
        <div class="relative z-10 space-y-6">
          <h2 class="text-2xl font-bold text-white">How it works</h2>
          <div class="space-y-4 text-neutral-400">
            <p>You can purchase a gift certificate here for tickets to the club! We will email you a copy of the gift certificate and then you can use it or send it to the person you are gifting it to.</p>
            <div class="p-4 bg-[#d12027]/10 border border-[#d12027]/20 rounded-xl text-[#d12027] text-sm">
              <strong>Please note:</strong> Gift certificates only cover purchase of tickets. We do not offer gift certificates for drinks/food online.
            </div>
          </div>
        </div>
      </div>

      <!-- Certificate Preview -->
      <div class="relative aspect-[1.586/1] bg-gradient-to-br from-neutral-800 to-neutral-900 rounded-xl overflow-hidden border border-[#d12027]/30 shadow-2xl" style="transform:rotate(1deg);transition:transform .5s ease;" onmouseenter="this.style.transform='rotate(0deg)'" onmouseleave="this.style.transform='rotate(1deg)'">
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#d12027]/10 rounded-full blur-2xl"></div>
        <div class="relative h-full p-8 flex flex-col justify-between">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="text-2xl font-bold text-white tracking-wider">Gift Certificate</h3>
              <p class="text-[#d12027] text-sm font-semibold tracking-widest mt-1">COMEDY BREAK INN</p>
            </div>
            <i data-lucide="gift" class="w-8 h-8 text-[#d12027]/80"></i>
          </div>
          <div class="space-y-2">
            <div class="text-4xl font-bold text-white">$<span x-text="amount ? parseFloat(amount).toFixed(2) : '0.00'"></span></div>
            <div class="h-px w-full bg-neutral-700"></div>
            <div class="flex justify-between text-xs text-neutral-400 uppercase tracking-wider">
              <span>Valid for Tickets Only</span>
              <span>No Expiration</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Side -->
    <div class="lg:col-span-7">
      <form method="POST" action="?view=gift" class="bg-neutral-900 pt-0 pb-8 px-8 md:px-10 rounded-xl border border-white/10 shadow-xl space-y-8 text-white">
        <input type="hidden" name="gift_submitted" value="1" />

        <!-- Amount -->
        <div>
          <h3 class="text-xl font-bold mb-6 flex items-center gap-2 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d12027" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg> Gift Amount</h3>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
            <button type="button" @click="amount = 25" :class="amount === 25 ? 'bg-[#d12027] text-white border-[#d12027]' : 'bg-white/5 text-neutral-400 border-white/10 hover:border-[#d12027]/50'" class="cc-amount-btn py-3 rounded-[10px] font-bold border transition-all">$25</button>
            <button type="button" @click="amount = 50" :class="amount === 50 ? 'bg-[#d12027] text-white border-[#d12027]' : 'bg-white/5 text-neutral-400 border-white/10 hover:border-[#d12027]/50'" class="cc-amount-btn py-3 rounded-[10px] font-bold border transition-all">$50</button>
            <button type="button" @click="amount = 75" :class="amount === 75 ? 'bg-[#d12027] text-white border-[#d12027]' : 'bg-white/5 text-neutral-400 border-white/10 hover:border-[#d12027]/50'" class="cc-amount-btn py-3 rounded-[10px] font-bold border transition-all">$75</button>
            <button type="button" @click="amount = 100" :class="amount === 100 ? 'bg-[#d12027] text-white border-[#d12027]' : 'bg-white/5 text-neutral-400 border-white/10 hover:border-[#d12027]/50'" class="cc-amount-btn py-3 rounded-[10px] font-bold border transition-all">$100</button>
          </div>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-400">$</span>
            <input type="number" name="amount" x-model.number="amount" min="1" placeholder="Custom Amount" class="w-full bg-white/5 border border-white/10 rounded-[10px] py-3 pl-8 pr-4 text-white focus:ring-2 focus:ring-[#d12027] focus:border-transparent outline-none placeholder:text-neutral-400" required />
          </div>
        </div>

        <!-- Personal Info -->
        <div>
          <h3 class="text-xl font-bold mb-6 flex items-center gap-2 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d12027" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Personal Information</h3>
          <div class="grid md:grid-cols-2 gap-4">
            <div class="space-y-2"><label class="text-sm text-neutral-400 ml-1 font-semibold">First Name</label><input type="text" name="first_name" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-3 text-white focus:ring-2 focus:ring-[#d12027] outline-none" required /></div>
            <div class="space-y-2"><label class="text-sm text-neutral-400 ml-1 font-semibold">Last Name</label><input type="text" name="last_name" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-3 text-white focus:ring-2 focus:ring-[#d12027] outline-none" required /></div>
            <div class="space-y-2 md:col-span-2"><label class="text-sm text-neutral-400 ml-1 font-semibold">Email</label><input type="email" name="email" placeholder="good@friend.com" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-3 text-white focus:ring-2 focus:ring-[#d12027] outline-none" required /></div>
            <div class="space-y-2 md:col-span-2"><label class="text-sm text-neutral-400 ml-1 font-semibold">Phone</label><input type="tel" name="phone" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-3 text-white focus:ring-2 focus:ring-[#d12027] outline-none" required /></div>
          </div>
        </div>

        <!-- Payment Info -->
        <div>
          <h3 class="text-xl font-bold mb-6 flex items-center gap-2 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d12027" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg> Payment Information</h3>
          <div class="space-y-4">
            <div class="space-y-2"><label class="text-sm text-neutral-400 ml-1 font-semibold">Card Number</label><input type="text" name="card" placeholder="0000 0000 0000 0000" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-3 text-white focus:ring-2 focus:ring-[#d12027] outline-none" required /></div>
            <div class="grid grid-cols-2 gap-4">
              <div class="space-y-2"><label class="text-sm text-neutral-400 ml-1 font-semibold">Expiration</label><input type="text" name="exp" placeholder="MM/YY" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-3 text-white focus:ring-2 focus:ring-[#d12027] outline-none" required /></div>
              <div class="space-y-2"><label class="text-sm text-neutral-400 ml-1 font-semibold">CVC</label><input type="text" name="cvc" placeholder="123" class="w-full bg-white/5 border border-white/10 rounded-[10px] p-3 text-white focus:ring-2 focus:ring-[#d12027] outline-none" required /></div>
            </div>
          </div>
        </div>

        <button type="submit" class="w-full py-4 bg-white text-black font-bold text-lg rounded-[10px] hover:bg-neutral-200 transition-colors shadow-lg mt-8">Purchase Gift Certificate</button>
        <p class="text-center text-xs text-neutral-400 mt-4 flex items-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> Secure 256-bit SSL Encrypted Payment</p>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>
