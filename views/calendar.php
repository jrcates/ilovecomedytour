<?php
$showsByDate = [];
foreach ($shows as $show) {
  $dateKey = date('Y-m-d', strtotime($show['date']));
  $showsByDate[$dateKey][] = $show;
}
$showDatesJson = json_encode(array_keys($showsByDate));
?>

<div class="pt-12 pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen">

  <div x-data="ccCalendarPage()" x-init="init()">

    <!-- Header: Title + Filter + Grid/List toggle -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
      <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">All Shows</h1>
      <div class="flex items-center gap-3 w-full md:w-auto">
        <!-- Filter by Date button -->
        <div class="relative w-full md:w-auto">
          <button @click.stop="calendarOpen = !calendarOpen"
                  :class="(activeDate || calendarOpen) ? 'border-[#d12027] text-[#d12027] bg-[#d12027]/5' : 'border-white/10 text-white hover:border-white/20'"
                  class="flex items-center justify-center gap-2 px-5 py-2.5 rounded-[10px] border font-bold text-sm transition-colors w-full md:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <span x-text="activeDate ? formatDateLabel(activeDate) : 'Filter by Date'"></span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
          </button>

          <!-- Calendar Popup -->
          <div x-show="calendarOpen"
               x-transition
               @click.outside="calendarOpen = false"
               class="absolute right-0 top-full mt-2 bg-neutral-900 border border-white/10 rounded-xl shadow-lg p-5 w-[300px] z-50">

            <!-- Month navigation -->
            <div class="flex items-center justify-between mb-4">
              <button @click="calPrevMonth()" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-white/5 text-neutral-400 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
              </button>
              <span class="text-white font-bold text-sm" x-text="monthNames[calMonth] + ' ' + calYear"></span>
              <button @click="calNextMonth()" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-white/5 text-neutral-400 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
              </button>
            </div>

            <!-- Day name headers -->
            <div class="grid grid-cols-7 gap-1 mb-1">
              <template x-for="dn in ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']" :key="dn">
                <div class="text-center text-xs font-medium text-neutral-400 py-1" x-text="dn"></div>
              </template>
            </div>

            <!-- Day grid -->
            <div class="grid grid-cols-7 gap-1">
              <template x-for="n in calendarOffset" :key="'blank-'+n">
                <div></div>
              </template>
              <template x-for="cell in calendarDays" :key="cell.key">
                <button @click="onCalendarDayClick(cell)"
                        :class="[
                          cell.isSelected ? 'bg-[#d12027] text-white font-bold' : '',
                          !cell.isSelected && cell.hasShows ? 'bg-[#d12027]/10 text-[#d12027] font-bold hover:bg-[#d12027]/20' : '',
                          !cell.isSelected && !cell.hasShows ? 'text-neutral-400 hover:bg-white/5' : ''
                        ]"
                        class="w-9 h-9 flex items-center justify-center rounded-full text-sm transition-colors">
                  <span x-text="cell.day"></span>
                </button>
              </template>
            </div>

            <!-- Legend -->
            <div class="mt-3 flex items-center gap-2 text-xs text-neutral-400">
              <div class="w-3 h-3 rounded-full bg-[#d12027]/20 border border-[#d12027]/30"></div>
              Event Scheduled
            </div>

            <!-- Clear filter -->
            <template x-if="activeDate">
              <button @click="clearFilter()" class="mt-3 w-full py-2 text-xs font-bold text-neutral-400 hover:text-white transition-colors">Clear Filter</button>
            </template>
          </div>
        </div>

        <!-- Grid/List toggle (desktop only) -->
        <div class="hidden md:flex items-center gap-1 border-l border-white/10 pl-3 ml-1">
          <button @click="viewMode = 'grid'" :class="viewMode === 'grid' ? 'bg-[#d12027]/10 text-[#d12027] border-[#d12027]' : 'bg-neutral-900 text-neutral-400 border-white/10 hover:border-white/20'" class="w-10 h-10 rounded-lg border flex items-center justify-center transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
          </button>
          <button @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-[#d12027]/10 text-[#d12027] border-[#d12027]' : 'bg-neutral-900 text-neutral-400 border-white/10 hover:border-white/20'" class="w-10 h-10 rounded-lg border flex items-center justify-center transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/><circle cx="4" cy="6" r="1" fill="currentColor"/><circle cx="4" cy="12" r="1" fill="currentColor"/><circle cx="4" cy="18" r="1" fill="currentColor"/></svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Empty state -->
    <template x-if="filteredShows.length === 0">
      <div class="text-center py-16 text-neutral-400">
        <p class="text-lg font-medium">No shows on this date</p>
        <button @click="clearFilter()" class="mt-4 px-6 py-2.5 bg-white text-black font-bold rounded-[10px] text-sm hover:bg-neutral-200 transition-colors">View All Shows</button>
      </div>
    </template>

    <!-- Grid View (desktop only) -->
    <div x-show="viewMode === 'grid' && visibleShows.length > 0" x-transition class="hidden md:grid md:grid-cols-3 gap-6">
      <template x-for="show in visibleShows" :key="show.id">
        <div class="bg-neutral-900 rounded-xl border border-white/10 shadow-md overflow-hidden flex flex-col">
          <div class="h-[220px] overflow-hidden">
            <img :src="show.image" :alt="show.title" class="w-full h-full object-cover" />
          </div>
          <div class="p-5 flex flex-col flex-1">
            <h3 class="text-lg font-bold text-white mb-3 line-clamp-2 min-h-[3.5rem]" x-text="show.title"></h3>
            <div class="flex flex-wrap items-center gap-2 mb-3">
              <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span x-text="formatPill(show.date, 'date')"></span>
              </span>
              <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span x-text="formatPill(show.date, 'time')"></span>
              </span>
            </div>
            <div class="inline-flex items-center gap-1.5 bg-white/5 text-neutral-400 text-xs font-medium px-3 py-1.5 rounded-full max-w-full overflow-hidden mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              <span class="truncate" x-text="show.location"></span>
            </div>
            <p class="text-neutral-400 text-sm leading-relaxed line-clamp-3 mb-4" x-text="show.description"></p>
            <div class="mt-auto">
              <template x-if="show.status !== 'Sold Out'">
                <a :href="'?view=event&show=' + show.id" class="inline-block px-6 py-2.5 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-neutral-200 transition-colors">Buy Tickets</a>
              </template>
              <template x-if="show.status === 'Sold Out'">
                <button disabled class="px-6 py-2.5 bg-white/10 text-neutral-400 font-bold text-sm rounded-[10px] cursor-not-allowed">Sold Out</button>
              </template>
            </div>
          </div>
        </div>
      </template>
    </div>

    <!-- List View (always on mobile, toggle on desktop) -->
    <div :class="viewMode === 'list' ? '' : 'md:hidden'" class="space-y-4">
      <template x-for="show in visibleShows" :key="show.id">
        <div class="bg-neutral-900 rounded-xl border border-white/10 shadow-md p-5 flex flex-col md:flex-row md:items-center gap-5">
          <div class="w-20 h-20 rounded-full overflow-hidden flex-shrink-0 border-2 border-white/10">
            <img :src="show.image" :alt="show.title" class="w-full h-full object-cover" />
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="text-lg font-bold text-white mb-1" x-text="show.title"></h3>
            <p class="text-neutral-400 text-sm leading-relaxed mb-3" x-text="show.description"></p>
            <div class="flex flex-wrap items-center gap-2">
              <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span x-text="formatPill(show.date, 'date')"></span>
              </span>
              <span class="inline-flex items-center gap-1.5 bg-[#d12027] text-white text-xs font-semibold px-3 py-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span x-text="formatPill(show.date, 'time')"></span>
              </span>
              <span class="inline-flex items-center gap-1.5 bg-white/5 text-neutral-400 text-xs font-medium px-3 py-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span x-text="show.location"></span>
              </span>
            </div>
          </div>
          <template x-if="show.status !== 'Sold Out'">
            <a :href="'?view=event&show=' + show.id" class="w-full md:w-auto text-center px-6 py-2.5 bg-white text-black font-bold text-sm rounded-[10px] hover:bg-neutral-200 transition-colors whitespace-nowrap flex-shrink-0">Buy Tickets</a>
          </template>
          <template x-if="show.status === 'Sold Out'">
            <button disabled class="w-full md:w-auto text-center px-6 py-2.5 bg-white/10 text-neutral-400 font-bold text-sm rounded-[10px] cursor-not-allowed whitespace-nowrap flex-shrink-0">Sold Out</button>
          </template>
        </div>
      </template>
    </div>

    <!-- Show More button -->
    <template x-if="hasMore">
      <div class="mt-10">
        <button @click="showMore()" class="block w-full py-4 bg-white text-black font-bold text-center rounded-[10px] hover:bg-neutral-200 transition-colors text-sm">Show More</button>
      </div>
    </template>

  </div>
</div>

<script>
function ccCalendarPage() {
  return {
    allShows: <?= json_encode(array_values($shows)) ?>,
    showDates: <?= $showDatesJson ?>,
    calMonth: new Date().getMonth(),
    calYear: new Date().getFullYear(),
    activeDate: null,
    calendarOpen: false,
    viewMode: 'grid',
    showLimit: 12,

    monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'],
    shortMonths: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    dayNames: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],

    init() {},

    pad(n) { return n < 10 ? '0' + n : '' + n; },

    dateStr(d) {
      return d.getFullYear() + '-' + this.pad(d.getMonth() + 1) + '-' + this.pad(d.getDate());
    },

    hasShow(d) {
      return this.showDates.indexOf(this.dateStr(d)) !== -1;
    },

    get calendarOffset() {
      return new Date(this.calYear, this.calMonth, 1).getDay();
    },

    get calendarDays() {
      const daysInMonth = new Date(this.calYear, this.calMonth + 1, 0).getDate();
      const today = new Date();
      const todayStr = this.dateStr(today);
      const cells = [];
      for (let day = 1; day <= daysInMonth; day++) {
        const d = new Date(this.calYear, this.calMonth, day);
        const ds = this.dateStr(d);
        cells.push({
          key: ds,
          day: day,
          isSelected: this.activeDate === ds,
          isToday: ds === todayStr,
          hasShows: this.hasShow(d)
        });
      }
      return cells;
    },

    get filteredShows() {
      if (this.activeDate) {
        return this.allShows.filter(s => s.date.startsWith(this.activeDate));
      }
      return this.allShows;
    },

    get visibleShows() {
      return this.filteredShows.slice(0, this.showLimit);
    },

    get hasMore() {
      return this.filteredShows.length > this.showLimit;
    },

    showMore() {
      this.showLimit = this.filteredShows.length;
    },

    formatPill(isoDate, part) {
      const d = new Date(isoDate);
      const days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
      const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
      if (part === 'date') {
        return days[d.getDay()] + ', ' + d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
      }
      if (part === 'time') {
        let h = d.getHours(); let m = d.getMinutes();
        let ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12 || 12;
        return (m === 0 ? h + ':00' : h + ':' + this.pad(m)) + ampm;
      }
    },

    formatDateLabel(ds) {
      const d = new Date(ds + 'T00:00:00');
      const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
      return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
    },

    onCalendarDayClick(cell) {
      if (this.activeDate === cell.key) {
        this.activeDate = null;
        this.showLimit = 12;
      } else {
        this.activeDate = cell.key;
        this.showLimit = 100;
      }
      this.calendarOpen = false;
    },

    clearFilter() {
      this.activeDate = null;
      this.showLimit = 12;
      this.calendarOpen = false;
    },

    calPrevMonth() {
      let m = this.calMonth - 1;
      let y = this.calYear;
      if (m < 0) { m = 11; y--; }
      this.calMonth = m;
      this.calYear = y;
    },

    calNextMonth() {
      let m = this.calMonth + 1;
      let y = this.calYear;
      if (m > 11) { m = 0; y++; }
      this.calMonth = m;
      this.calYear = y;
    }
  }
}
</script>
