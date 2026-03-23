<?php
/**
 * Calendar Filter Component (Alpine.js Reactive)
 *
 * Replicates the EastVille schedule page UI exactly:
 * - Month picker button with calendar popup (not a <select>)
 * - Week strip with orange dots for show days, dimmed out-of-month days
 * - Shows grouped by date with teal bar date headers
 * - Show cards with actual descriptions and title + Sold Out flex row
 *
 * Props:
 *   $shows          – Full shows array from data.php
 *   $showDatesJson  – JSON string of date keys like '["2026-03-18","2026-03-19",...]'
 */
?>
<div x-data="ccCalendarFilter()" x-init="init()" @click.away="">

  <!-- Filter bar -->
  <div class="mb-10 sticky top-4 z-40">
    <div class="bg-neutral-950/90 backdrop-blur-md border border-neutral-800 rounded-xl shadow-2xl relative">

      <!-- Controls -->
      <div class="flex flex-col md:flex-row md:items-center gap-0 p-3">

        <!-- All Shows + Month Picker -->
        <div class="grid grid-cols-2 md:flex md:items-center gap-3 shrink-0">
          <button @click="clearFilter()"
                  :class="!activeDate ? 'bg-[#d12027] text-white' : 'text-neutral-400 bg-transparent hover:bg-neutral-800'"
                  class="px-5 py-3 rounded-[5px] font-bold text-sm uppercase tracking-wider transition-colors whitespace-nowrap text-center">
            All Shows
          </button>

          <button @click.stop="calendarOpen = !calendarOpen"
                  class="flex items-center justify-center gap-2 px-4 py-3 rounded-[5px] bg-neutral-800 text-white font-bold text-sm hover:bg-neutral-700 transition-colors whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <span x-text="shortMonths[calMonth] + ' ' + calYear"></span>
          </button>
        </div>

        <!-- Week Strip -->
        <div class="flex-1 flex items-center mt-3 md:mt-0 md:ml-4 overflow-hidden">
          <button @click="prevWeek()"
                  :class="weekAtStart ? 'opacity-30 pointer-events-none' : ''"
                  class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-neutral-800 text-neutral-500 hover:text-white transition-colors shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
          </button>

          <div class="flex-1 flex items-center justify-around overflow-hidden">
            <template x-for="day in weekDays" :key="day.key">
              <button @click="onWeekDayClick(day)"
                      :class="[
                        !day.inMonth ? 'opacity-25 cursor-default' : 'cursor-pointer',
                        day.inMonth && activeDate === day.key ? 'bg-[#d12027]' : '',
                        day.inMonth && activeDate !== day.key && day.isToday ? 'bg-neutral-800' : '',
                        day.inMonth && activeDate !== day.key && !day.isToday ? 'hover:bg-neutral-800' : ''
                      ]"
                      class="flex flex-col items-center py-2 px-1.5 md:px-3 rounded-[10px] transition-colors min-w-0 md:min-w-[60px] flex-1">
                <div class="text-[10px] font-bold tracking-wider"
                     :class="activeDate === day.key && day.inMonth ? 'text-white' : 'text-neutral-500'"
                     x-text="day.weekday"></div>
                <div class="text-xl font-bold"
                     :class="activeDate === day.key && day.inMonth ? 'text-white' : (day.inMonth ? 'text-white' : 'text-neutral-400')"
                     x-text="day.day"></div>
                <div class="w-1.5 h-1.5 mt-1"
                     :class="day.hasShows && day.inMonth ? 'rounded-full bg-[#d12027]' : ''"></div>
              </button>
            </template>
          </div>

          <button @click="nextWeek()"
                  :class="weekAtEnd ? 'opacity-30 pointer-events-none' : ''"
                  class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-neutral-800 text-neutral-500 hover:text-white transition-colors shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
          </button>
        </div>
      </div>

      <!-- Calendar Dropdown Popup -->
      <div x-show="calendarOpen"
           x-transition
           @click.outside="calendarOpen = false"
           class="absolute left-1/2 -translate-x-1/2 md:left-3 md:translate-x-0 top-full mt-1 bg-[#1E2323] border border-neutral-700 rounded-xl shadow-2xl p-5 w-[calc(100%-24px)] max-w-[300px] md:w-[300px] z-50">

        <!-- Month navigation -->
        <div class="flex items-center justify-between mb-4">
          <button @click="calPrevMonth()" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-neutral-700 text-neutral-400 hover:text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
          </button>
          <span class="text-white font-bold text-base" x-text="monthNames[calMonth] + ' ' + calYear"></span>
          <button @click="calNextMonth()" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-neutral-700 text-neutral-400 hover:text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
          </button>
        </div>

        <!-- Day name headers -->
        <div class="grid grid-cols-7 gap-1 mb-2">
          <div class="text-center text-xs font-bold text-neutral-500 py-1">SU</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">MO</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">TU</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">WE</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">TH</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">FR</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">SA</div>
        </div>

        <!-- Day grid -->
        <div class="grid grid-cols-7 gap-1">
          <!-- Empty cells for offset -->
          <template x-for="n in calendarOffset" :key="'blank-'+n">
            <div></div>
          </template>
          <!-- Day cells -->
          <template x-for="cell in calendarDays" :key="cell.key">
            <button @click="onCalendarDayClick(cell)"
                    :class="[
                      cell.isSelected ? 'bg-[#d12027] text-white font-bold' : '',
                      !cell.isSelected && cell.isToday ? 'border border-[#d12027] text-white font-bold' : '',
                      !cell.isSelected && !cell.isToday && cell.hasShows ? 'text-[#d12027] font-bold hover:bg-neutral-700' : '',
                      !cell.isSelected && !cell.isToday && !cell.hasShows ? 'text-neutral-400 hover:bg-neutral-700' : ''
                    ]"
                    class="flex flex-col items-center justify-center py-1.5 rounded-full text-sm cursor-pointer transition-colors">
              <span x-text="cell.day"></span>
              <template x-if="cell.hasShows">
                <div class="w-1 h-1 rounded-full bg-[#d12027] mt-0.5"></div>
              </template>
            </button>
          </template>
        </div>
      </div>

    </div>
  </div>

  <!-- Show list (grouped by date) -->
  <div class="space-y-12">
    <template x-if="groupedShows.length === 0">
      <div class="text-center py-16 text-neutral-400">
        <p class="text-lg font-medium">No shows on this date</p>
        <button @click="clearFilter()" class="mt-4 px-6 py-2 bg-white text-black font-bold rounded-[10px] text-sm hover:bg-neutral-200 transition-colors">View All Shows</button>
      </div>
    </template>

    <template x-for="group in groupedShows" :key="group.label">
      <div>
        <!-- Date header with teal bar -->
        <div class="flex items-center gap-4 mb-6 mt-8">
          <div class="w-2 h-8 bg-[#d12027] rounded-full"></div>
          <h2 class="text-[22px] font-bold text-white tracking-tighter" x-text="group.label"></h2>
        </div>

        <!-- Show cards -->
        <div class="flex flex-col gap-4">
          <template x-for="show in group.shows" :key="show.id">
            <div class="cc-show-card group bg-white/5 rounded-xl p-6 flex flex-col md:flex-row items-center gap-8 transition-all border border-white/10">
              <!-- Date Badge -->
              <div class="flex flex-col items-center flex-shrink-0">
                <div class="border border-white/10 rounded-[5px] pt-2 pb-1 px-4 text-center cc-date-badge bg-white/5">
                  <div class="text-sm font-bold text-white leading-none" x-text="formatDate(show.date, 'weekday')"></div>
                  <div class="text-4xl font-bold leading-none text-white my-1" x-text="formatDate(show.date, 'day')"></div>
                  <div class="text-sm font-bold text-white leading-none" x-text="formatDate(show.date, 'month')"></div>
                </div>
                <div class="bg-white/10 text-white text-xs px-3 py-1 mt-1 font-medium rounded-[5px] tracking-wide w-full text-center" x-text="formatDate(show.date, 'time')"></div>
              </div>
              <!-- Image -->
              <div class="w-full md:w-[220px] h-[140px] rounded-[5px] overflow-hidden flex-shrink-0">
                <img :src="show.image" :alt="show.title" class="cc-show-card-img w-full h-full object-cover" />
              </div>
              <!-- Content -->
              <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left self-center">
                <div class="flex flex-wrap justify-between items-start w-full mb-3 gap-2">
                  <h3 class="text-[20px] font-bold text-white" x-text="show.title"></h3>
                  <span x-show="show.status === 'Sold Out'" class="text-xs font-bold uppercase tracking-wider text-red-500 border border-red-500 px-2 py-1 rounded whitespace-nowrap">Sold Out</span>
                </div>
                <p class="text-neutral-400 text-sm leading-relaxed line-clamp-2" x-text="show.description"></p>
              </div>
              <!-- Button -->
              <template x-if="show.status === 'Sold Out'">
                <button disabled class="px-8 py-3 rounded-[10px] text-sm font-bold whitespace-nowrap flex-shrink-0 bg-neutral-800 text-neutral-500 cursor-not-allowed">Sold Out</button>
              </template>
              <template x-if="show.status !== 'Sold Out'">
                <a :href="'?view=event&show=' + show.id"
                   class="px-8 py-3 bg-white text-black font-bold rounded-[10px] text-sm hover:bg-neutral-200 transition-colors whitespace-nowrap flex-shrink-0 cc-hover-lift shadow-lg shadow-black/10">
                  Buy Tickets
                </a>
              </template>
            </div>
          </template>
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
    calMonth: new Date().getMonth(),
    calYear: new Date().getFullYear(),
    activeDate: null,
    weekStart: null,
    calendarOpen: false,
    weekDays: [],

    dayNames: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    shortMonths: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

    init() {
      this.weekStart = this.getFirstWeekStart(this.calMonth, this.calYear);

      // If today is in the current month, start the week strip from today's week
      const today = new Date();
      if (today.getMonth() === this.calMonth && today.getFullYear() === this.calYear) {
        const ws = new Date(today);
        ws.setDate(today.getDate() - today.getDay());
        this.weekStart = ws;
      }

      this.buildWeekStrip();
    },

    pad(n) { return n < 10 ? '0' + n : '' + n; },

    dateStr(d) {
      return d.getFullYear() + '-' + this.pad(d.getMonth() + 1) + '-' + this.pad(d.getDate());
    },

    hasShow(d) {
      return this.showDates.indexOf(this.dateStr(d)) !== -1;
    },

    getFirstWeekStart(m, y) {
      const first = new Date(y, m, 1);
      const ws = new Date(first);
      ws.setDate(first.getDate() - first.getDay());
      return ws;
    },

    getLastWeekStart(m, y) {
      const last = new Date(y, m + 1, 0);
      const ws = new Date(last);
      ws.setDate(last.getDate() - last.getDay());
      return ws;
    },

    get weekAtStart() {
      if (!this.weekStart) return true;
      const firstWS = this.getFirstWeekStart(this.calMonth, this.calYear);
      return this.weekStart.getTime() <= firstWS.getTime();
    },

    get weekAtEnd() {
      if (!this.weekStart) return true;
      const lastWS = this.getLastWeekStart(this.calMonth, this.calYear);
      return this.weekStart.getTime() >= lastWS.getTime();
    },

    buildWeekStrip() {
      const days = [];
      const today = new Date();
      const todayStr = this.dateStr(today);

      for (let i = 0; i < 7; i++) {
        const d = new Date(this.weekStart);
        d.setDate(this.weekStart.getDate() + i);
        const key = this.dateStr(d);
        const inMonth = d.getMonth() === this.calMonth && d.getFullYear() === this.calYear;

        days.push({
          key: key,
          weekday: this.dayNames[d.getDay()],
          day: d.getDate(),
          hasShows: this.hasShow(d),
          inMonth: inMonth,
          isToday: key === todayStr
        });
      }
      this.weekDays = days;
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

    get groupedShows() {
      const shows = this.activeDate
        ? this.allShows.filter(s => s.date.startsWith(this.activeDate))
        : this.allShows.filter(s => {
            const d = new Date(s.date);
            return d.getMonth() === this.calMonth && d.getFullYear() === this.calYear;
          });

      const groups = {};
      shows.forEach(s => {
        const d = new Date(s.date);
        const label = d.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric' }).toUpperCase();
        const key = s.date.substring(0, 10);
        if (!groups[key]) groups[key] = { label, shows: [] };
        groups[key].shows.push(s);
      });
      return Object.values(groups);
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

    onWeekDayClick(day) {
      if (!day.inMonth) return;
      if (this.activeDate === day.key) {
        // Deselect — show all in month
        this.activeDate = null;
      } else {
        this.activeDate = day.key;
      }
      this.buildWeekStrip();
    },

    onCalendarDayClick(cell) {
      this.activeDate = cell.key;

      // Move week strip to contain this date
      const sel = new Date(cell.key + 'T00:00:00');
      const ws = new Date(sel);
      ws.setDate(sel.getDate() - sel.getDay());
      this.weekStart = ws;

      this.buildWeekStrip();
      this.calendarOpen = false;
    },

    clearFilter() {
      this.activeDate = null;
      this.buildWeekStrip();
    },

    calPrevMonth() {
      let m = this.calMonth - 1;
      let y = this.calYear;
      if (m < 0) { m = 11; y--; }
      this.setMonth(m, y);
    },

    calNextMonth() {
      let m = this.calMonth + 1;
      let y = this.calYear;
      if (m > 11) { m = 0; y++; }
      this.setMonth(m, y);
    },

    setMonth(m, y) {
      this.calMonth = m;
      this.calYear = y;
      this.activeDate = null;
      this.weekStart = this.getFirstWeekStart(m, y);
      this.buildWeekStrip();
    },

    prevWeek() {
      if (this.weekAtStart) return;
      this.weekStart = new Date(this.weekStart);
      this.weekStart.setDate(this.weekStart.getDate() - 7);
      this.buildWeekStrip();
    },

    nextWeek() {
      if (this.weekAtEnd) return;
      this.weekStart = new Date(this.weekStart);
      this.weekStart.setDate(this.weekStart.getDate() + 7);
      this.buildWeekStrip();
    }
  }
}
</script>
