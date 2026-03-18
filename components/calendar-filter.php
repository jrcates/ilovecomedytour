<?php
/**
 * Calendar Filter Component (Alpine.js Reactive)
 *
 * Replaces the jQuery calendar filtering with an Alpine.js reactive approach.
 * Shows are passed as JSON and rendered via x-for instead of PHP loops + jQuery show/hide.
 *
 * Props:
 *   $shows          – Full shows array from data.php
 *   $showDatesJson  – JSON string of date keys like '["2026-03-18","2026-03-19",...]'
 */
?>
<div x-data="ccCalendarFilter()" x-init="init()">
  <!-- Filter bar -->
  <div class="mb-10 sticky top-20 z-40">
    <div class="bg-neutral-950/90 backdrop-blur-md border border-neutral-800 rounded-[8px] shadow-2xl relative">
      <div class="flex flex-col md:flex-row md:items-center gap-0 p-3">

        <!-- All Shows + Month Picker row -->
        <div class="grid grid-cols-2 md:flex md:items-center gap-3 shrink-0">
          <button @click="clearFilter()"
                  :class="!activeDate ? 'bg-[#24CECE] text-neutral-900' : 'bg-neutral-800 text-neutral-300 hover:bg-neutral-700'"
                  class="px-5 py-3 rounded-[5px] font-bold text-sm uppercase tracking-wider transition-colors whitespace-nowrap text-center">
            All Shows
          </button>

          <div class="relative">
            <select x-model="activeMonth" @change="onMonthChange()"
                    class="appearance-none bg-neutral-800 text-white px-5 py-3 pr-10 rounded-[5px] font-bold text-sm uppercase tracking-wider cursor-pointer w-full">
              <template x-for="m in months" :key="m.value">
                <option :value="m.value" x-text="m.label" :selected="m.value === activeMonth"></option>
              </template>
            </select>
          </div>
        </div>

        <!-- Week strip -->
        <div class="flex items-center gap-2 flex-1 mt-3 md:mt-0 md:ml-3">
          <button @click="prevWeek()" class="p-2 bg-neutral-800 rounded-[5px] hover:bg-neutral-700 transition-colors shrink-0">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
          </button>

          <div class="flex gap-2 overflow-x-auto cc-no-scrollbar flex-1 px-1">
            <template x-for="day in weekDays" :key="day.key">
              <button @click="filterByDate(day.key)"
                      :class="activeDate === day.key ? 'bg-[#24CECE] text-black' : (day.hasShows ? 'bg-neutral-800 text-neutral-300 hover:bg-neutral-700' : 'bg-neutral-900 text-neutral-600')"
                      class="px-4 py-3 rounded-[5px] font-bold text-xs uppercase tracking-wider transition-colors flex flex-col items-center min-w-[70px] shrink-0">
                <span x-text="day.weekday" class="text-[10px]"></span>
                <span x-text="day.day" class="text-lg font-black"></span>
              </button>
            </template>
          </div>

          <button @click="nextWeek()" class="p-2 bg-neutral-800 rounded-[5px] hover:bg-neutral-700 transition-colors shrink-0">
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Show list (Alpine-rendered) -->
  <div class="space-y-4">
    <template x-if="filteredShows.length === 0">
      <div class="text-center py-16 text-neutral-500">
        <p class="text-lg font-medium">No shows on this date</p>
        <button @click="clearFilter()" class="mt-4 px-6 py-2 bg-[#24CECE] text-black font-bold rounded-full text-sm hover:bg-[#20B8B8] transition-colors">View All Shows</button>
      </div>
    </template>

    <template x-for="show in filteredShows" :key="show.id">
      <div class="cc-show-card bg-white rounded-[5px] p-6 flex flex-col md:flex-row items-center gap-8 transition-all border border-neutral-800">
        <!-- Date badge (inline since it's Alpine-rendered, not PHP) -->
        <div class="flex flex-col items-center flex-shrink-0">
          <div class="border border-black rounded-[5px] pt-2 pb-1 px-4 text-center cc-date-badge bg-white">
            <div class="text-sm font-bold text-black leading-none" x-text="formatDate(show.date, 'weekday')"></div>
            <div class="text-4xl font-black leading-none text-black my-1" x-text="formatDate(show.date, 'day')"></div>
            <div class="text-sm font-bold text-black leading-none" x-text="formatDate(show.date, 'month')"></div>
          </div>
          <div class="bg-black text-white text-xs px-3 py-1 mt-1 font-medium rounded-[5px] tracking-wide w-full text-center" x-text="formatDate(show.date, 'time')"></div>
        </div>
        <!-- Image -->
        <div class="w-full md:w-[220px] h-[140px] rounded-[5px] overflow-hidden flex-shrink-0">
          <img :src="show.image" :alt="show.title" class="cc-show-card-img w-full h-full object-cover" />
        </div>
        <!-- Content -->
        <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left self-center">
          <h3 class="text-[20px] font-extrabold text-black uppercase mb-3" x-text="show.title"></h3>
          <p class="text-neutral-500 text-sm leading-relaxed line-clamp-2" x-text="'Join us for Comedy Night at ' + show.location + '.'"></p>
        </div>
        <!-- Status badge + Buy button -->
        <div class="flex flex-col items-center gap-2 flex-shrink-0">
          <span x-show="show.status === 'Selling Fast'" class="text-orange-500 text-xs font-bold uppercase">Selling Fast</span>
          <span x-show="show.status === 'Sold Out'" class="text-red-500 text-xs font-bold uppercase">Sold Out</span>
          <a :href="'?view=event&show=' + show.id"
             x-show="show.status !== 'Sold Out'"
             class="px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full text-sm hover:bg-[#20B8B8] transition-colors whitespace-nowrap cc-hover-lift shadow-lg shadow-[#24CECE]/20">
            Buy Tickets
          </a>
          <span x-show="show.status === 'Sold Out'" class="px-8 py-3 bg-neutral-300 text-neutral-500 font-bold rounded-full text-sm cursor-not-allowed">Sold Out</span>
        </div>
      </div>
    </template>
  </div>
</div>

<script>
function ccCalendarFilter() {
  return {
    allShows: <?= json_encode(array_values($shows)) ?>,
    showDates: <?= $showDatesJson ?>,
    activeMonth: null,
    activeDate: null,
    weekStart: null,
    months: [],
    weekDays: [],

    init() {
      // Build unique months from show dates
      const monthSet = new Map();
      this.showDates.forEach(d => {
        const date = new Date(d + 'T00:00:00');
        const key = d.substring(0, 7); // YYYY-MM
        if (!monthSet.has(key)) {
          monthSet.set(key, date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' }));
        }
      });
      this.months = Array.from(monthSet, ([value, label]) => ({ value, label }));

      // Set initial month
      const today = new Date().toISOString().substring(0, 10);
      const currentMonth = today.substring(0, 7);
      this.activeMonth = this.months.find(m => m.value >= currentMonth)?.value || this.months[0]?.value;

      this.buildWeekStrip();

      // Re-init Lucide after Alpine renders
      this.$nextTick(() => { if (typeof lucide !== 'undefined') lucide.createIcons(); });
    },

    get filteredShows() {
      if (!this.activeDate) return this.allShows;
      // IMPORTANT: activeDate is YYYY-MM-DD format, show dates are YYYY-MM-DDTHH:MM:SS
      return this.allShows.filter(s => s.date.startsWith(this.activeDate));
    },

    formatDate(isoDate, part) {
      const d = new Date(isoDate);
      const days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
      const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
      switch(part) {
        case 'weekday': return days[d.getDay()];
        case 'day': return d.getDate();
        case 'month': return months[d.getMonth()];
        case 'time': return d.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
      }
    },

    buildWeekStrip() {
      // Find first day of the active month
      const [year, month] = this.activeMonth.split('-').map(Number);
      if (!this.weekStart) {
        // Start from today if in current month, otherwise first of month
        const today = new Date();
        if (today.getFullYear() === year && today.getMonth() === month - 1) {
          this.weekStart = new Date(today);
        } else {
          this.weekStart = new Date(year, month - 1, 1);
        }
        // Align to start of week (Monday)
        const dayOfWeek = this.weekStart.getDay();
        const diff = dayOfWeek === 0 ? -6 : 1 - dayOfWeek;
        this.weekStart.setDate(this.weekStart.getDate() + diff);
      }

      const days = [];
      const showDateSet = new Set(this.showDates);
      for (let i = 0; i < 7; i++) {
        const d = new Date(this.weekStart);
        d.setDate(d.getDate() + i);
        const key = d.toISOString().substring(0, 10);
        const dayNames = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
        days.push({
          key: key,
          weekday: dayNames[d.getDay()],
          day: d.getDate(),
          hasShows: showDateSet.has(key)
        });
      }
      this.weekDays = days;
    },

    filterByDate(dateKey) {
      this.activeDate = dateKey;
    },

    clearFilter() {
      this.activeDate = null;
    },

    onMonthChange() {
      this.weekStart = null; // reset so buildWeekStrip recalculates
      this.activeDate = null;
      this.buildWeekStrip();
      this.$nextTick(() => { if (typeof lucide !== 'undefined') lucide.createIcons(); });
    },

    prevWeek() {
      this.weekStart = new Date(this.weekStart);
      this.weekStart.setDate(this.weekStart.getDate() - 7);
      this.buildWeekStrip();
      this.$nextTick(() => { if (typeof lucide !== 'undefined') lucide.createIcons(); });
    },

    nextWeek() {
      this.weekStart = new Date(this.weekStart);
      this.weekStart.setDate(this.weekStart.getDate() + 7);
      this.buildWeekStrip();
      this.$nextTick(() => { if (typeof lucide !== 'undefined') lucide.createIcons(); });
    }
  }
}
</script>
