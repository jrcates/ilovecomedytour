<!-- View Switcher — floating toggle for demo presentations -->
<!-- Hidden when inside an iframe (the mobile preview) -->
<div x-data="{ devicePreview: 'desktop', isEmbed: window.self !== window.top }"
     x-show="!isEmbed"
     x-effect="if (devicePreview === 'mobile' && !isEmbed) document.body.style.overflow = 'hidden'; else document.body.style.overflow = '';">

  <!-- Toggle buttons — centered above the phone frame in mobile mode -->
  <div :class="devicePreview === 'mobile' ? 'fixed top-2 left-1/2 -translate-x-1/2 z-[90]' : 'fixed top-4 left-4 z-[90]'"
       class="flex items-center gap-1 bg-black/90 backdrop-blur-sm rounded-full p-1 border border-white/10 shadow-lg transition-all duration-300">
    <button
      @click="devicePreview = 'desktop'"
      :class="devicePreview === 'desktop' ? 'bg-[#d12027] text-white' : 'text-neutral-400 hover:text-white'"
      class="w-9 h-9 flex items-center justify-center rounded-full transition-colors"
      title="Desktop view"
    >
      <i data-lucide="monitor" class="w-4 h-4"></i>
    </button>
    <button
      @click="devicePreview = 'mobile'"
      :class="devicePreview === 'mobile' ? 'bg-[#d12027] text-white' : 'text-neutral-400 hover:text-white'"
      class="w-9 h-9 flex items-center justify-center rounded-full transition-colors"
      title="Mobile view"
    >
      <i data-lucide="smartphone" class="w-4 h-4"></i>
    </button>
  </div>

  <!-- Mobile iframe overlay -->
  <template x-if="devicePreview === 'mobile'">
    <div class="cc-view-switcher-backdrop">
      <div class="cc-view-switcher-frame">
        <iframe src="<?= htmlspecialchars('?' . http_build_query($_GET)) ?>" class="w-full h-full border-0"></iframe>
      </div>
    </div>
  </template>

</div>
