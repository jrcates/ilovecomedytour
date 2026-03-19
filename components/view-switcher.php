<!-- View Switcher — floating toggle for demo presentations -->
<div class="fixed top-4 right-4 z-[80] flex items-center gap-1 bg-black/90 backdrop-blur-sm rounded-full p-1 border border-white/10 shadow-lg">
  <button
    @click="devicePreview = 'desktop'"
    :class="devicePreview === 'desktop' ? 'bg-[#F15A29] text-white' : 'text-neutral-400 hover:text-white'"
    class="w-9 h-9 flex items-center justify-center rounded-full transition-colors"
    title="Desktop view"
  >
    <i data-lucide="monitor" class="w-4 h-4"></i>
  </button>
  <button
    @click="devicePreview = 'mobile'"
    :class="devicePreview === 'mobile' ? 'bg-[#F15A29] text-white' : 'text-neutral-400 hover:text-white'"
    class="w-9 h-9 flex items-center justify-center rounded-full transition-colors"
    title="Mobile view"
  >
    <i data-lucide="smartphone" class="w-4 h-4"></i>
  </button>
</div>
