<?php
$success = isset($_POST['form_submitted']) && $_POST['form_submitted'] === '1';
?>

<?php if ($success): ?>
<div class="pt-[130px] md:pt-[250px] pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <div class="w-24 h-24 bg-green-500/10 rounded-xl flex items-center justify-center mb-8">
    <i data-lucide="circle-check" class="w-12 h-12 text-green-500"></i>
  </div>
  <h1 class="text-3xl md:text-4xl font-bold mb-3">Message Sent!</h1>
  <p class="text-xl text-neutral-600 max-w-lg mb-8">Thanks for reaching out. We've received your submission and will get back to you soon.</p>
  <a href="?view=contact" class="px-8 py-4 bg-black text-white font-bold rounded-[10px] hover:bg-neutral-800 transition-colors">Send Another</a>
</div>
<?php else: ?>

<div class="pt-[130px] md:pt-[250px] pb-24 max-w-[1200px] mx-auto px-4 md:px-6">

  <!-- Header -->
  <div class="mb-12">
    <h1 class="text-3xl md:text-4xl font-extrabold mb-3 tracking-tight">Contact Us</h1>
  </div>

  <div class="grid lg:grid-cols-2 gap-12 max-w-6xl items-start">

    <!-- Left Column: Info -->
    <div class="relative bg-[#1e1e1e] p-10 rounded-xl shadow-2xl overflow-hidden">
      <div class="relative z-10 space-y-8">
        <div>
          <h3 class="text-3xl font-bold text-white mb-4">Get in Touch</h3>
          <p class="text-neutral-400 leading-relaxed">For information about shows, booking the club for a private event or any other questions please use the contact form.</p>
        </div>
        <ul class="space-y-4">
          <li class="flex gap-4 items-start p-4 rounded-xl bg-white/5 border border-white/5">
            <div class="shrink-0 w-10 h-10 rounded-[10px] flex items-center justify-center text-[#F15A29]">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 01-2.06 0L2 7"/></svg>
            </div>
            <div>
              <h4 class="text-white font-bold">Email</h4>
              <p class="text-neutral-400 text-sm">ryan@comixcomedy.com</p>
            </div>
          </li>
          <li class="flex gap-4 items-start p-4 rounded-xl bg-white/5 border border-white/5">
            <div class="shrink-0 w-10 h-10 rounded-[10px] flex items-center justify-center text-[#F15A29]">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            </div>
            <div>
              <h4 class="text-white font-bold">Phone</h4>
              <p class="text-neutral-400 text-sm">(954) 729-6282</p>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- Right Column: Form -->
    <div class="bg-white pt-0 pb-8 px-8 md:px-10 rounded-xl border border-neutral-200 shadow-xl">
      <form method="POST" action="?view=contact" class="space-y-6">
        <input type="hidden" name="form_submitted" value="1" />

        <h2 class="text-2xl font-bold mb-8 text-black flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#F15A29]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="m22 2-7 20-4-9-9-4z"/><path d="M22 2 11 13"/></svg>
          Send us a Message
        </h2>

        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1">Name</label>
          <input required type="text" name="name" placeholder="Your name" class="w-full bg-neutral-50 border border-neutral-200 rounded-[10px] p-4 text-black focus:ring-2 focus:ring-[#F15A29] focus:border-transparent outline-none placeholder:text-neutral-400" />
        </div>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1">Email</label>
          <input required type="email" name="email" placeholder="your@email.com" class="w-full bg-neutral-50 border border-neutral-200 rounded-[10px] p-4 text-black focus:ring-2 focus:ring-[#F15A29] focus:border-transparent outline-none placeholder:text-neutral-400" />
        </div>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1">Message</label>
          <textarea required name="message" rows="6" placeholder="How can we help you?" class="w-full bg-neutral-50 border border-neutral-200 rounded-[10px] p-4 text-black focus:ring-2 focus:ring-[#F15A29] focus:border-transparent outline-none placeholder:text-neutral-400 resize-none"></textarea>
        </div>

        <button type="submit" class="w-full py-4 bg-black text-white font-bold text-lg rounded-[10px] hover:bg-neutral-800 transition-colors shadow-lg mt-4">Submit</button>
      </form>
    </div>

  </div>
</div>
<?php endif; ?>
