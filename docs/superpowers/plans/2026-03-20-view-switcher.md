# View Switcher Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Add a floating view-switcher component that lets stakeholders toggle between mobile and desktop views during client demos.

**Architecture:** A new Alpine.js-powered component toggles a CSS class on the root wrapper and neutralizes all Tailwind CDN breakpoints via JavaScript, forcing the site into its mobile-first layout at 390px width with a device frame appearance.

**Tech Stack:** PHP components, Alpine.js, Tailwind CSS CDN, Lucide Icons, vanilla CSS

**Spec:** `docs/superpowers/specs/2026-03-20-view-switcher-design.md`

---

## File Map

| Action | File | Responsibility |
|--------|------|---------------|
| Create | `components/view-switcher.php` | Floating toggle UI with Lucide icons |
| Modify | `index.php:15` | Add Alpine state, class binding, x-effect, component include |
| Modify | `css/custom.css` (append) | `.cc-force-mobile` styles + body dark backdrop via `:has()` fallback |

---

### Task 1: Add `.cc-force-mobile` CSS styles

**Files:**
- Modify: `css/custom.css` (append after line 34)

- [ ] **Step 1: Add the `.cc-force-mobile` ruleset to `css/custom.css`**

Append the following at the end of the file:

```css
/* View Switcher — forced mobile preview */
.cc-force-mobile {
  max-width: 390px;
  margin: 0 auto;
  border-radius: 20px;
  border: 2px solid rgba(255,255,255,0.1);
  box-shadow: 0 0 60px rgba(0,0,0,0.5);
  overflow: hidden;
  min-height: 100vh;
  transition: max-width 0.3s ease, opacity 0.15s ease;
}
```

- [ ] **Step 2: Commit**

```bash
git add css/custom.css
git commit -m "feat: add cc-force-mobile CSS styles for view switcher"
```

---

### Task 2: Create the view-switcher component

**Files:**
- Create: `components/view-switcher.php`

- [ ] **Step 1: Create `components/view-switcher.php`**

```php
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
```

- [ ] **Step 2: Commit**

```bash
git add components/view-switcher.php
git commit -m "feat: create view-switcher floating toggle component"
```

---

### Task 3: Wire up `index.php` with Alpine state and breakpoint neutralization

**Files:**
- Modify: `index.php:14-16`

This is the core integration. The root `<div>` on line 15 gets Alpine.js state, class binding, and an `x-effect` that handles body background and Tailwind breakpoint neutralization.

- [ ] **Step 1: Modify `index.php`**

Replace lines 14-16:

```php
<body class="min-h-screen bg-white text-neutral-900 overflow-x-hidden">
<div class="overflow-x-hidden w-full">
  <?php component('layout/nav', ['currentView' => $view]); ?>
```

With:

```php
<body class="min-h-screen bg-white text-neutral-900 overflow-x-hidden">
<div class="overflow-x-hidden w-full"
     x-data="{ devicePreview: 'desktop' }"
     :class="{ 'cc-force-mobile': devicePreview === 'mobile' }"
     x-effect="
       document.body.style.background = devicePreview === 'mobile' ? '#111' : '';
       $el.style.opacity = '0';
       if (devicePreview === 'mobile') {
         tailwind.config.theme.screens = { sm: '9999px', md: '9999px', lg: '9999px', xl: '9999px', '2xl': '9999px' };
       } else {
         tailwind.config.theme.screens = { sm: '640px', md: '768px', lg: '1024px', xl: '1280px', '2xl': '1536px' };
       }
       document.querySelector('style[type=&quot;text/tailwindcss&quot;]').textContent += ' ';
       setTimeout(() => { $el.style.opacity = '1'; lucide.createIcons(); }, 150);
     ">
  <?php component('view-switcher'); ?>
  <?php component('layout/nav', ['currentView' => $view]); ?>
```

**Key details:**
- `x-data="{ devicePreview: 'desktop' }"` — Alpine state, named to avoid collision with existing `viewMode` variables
- `:class` — conditionally applies the CSS constraint class
- `x-effect` — runs whenever `devicePreview` changes:
  1. Sets body background to dark (`#111`) or clears it
  2. Mutates `tailwind.config.theme.screens` to neutralize all breakpoints (mobile) or restore defaults (desktop)
  3. Appends a space to the `<style type="text/tailwindcss">` element to trigger Tailwind CDN's MutationObserver, forcing style regeneration
  4. Fades wrapper opacity to 0 before the switch, then restores to 1 after 150ms to mask Tailwind regeneration reflow
  5. Re-initializes Lucide icons after the fade delay
- `&quot;` is used for the attribute selector inside the Alpine attribute (HTML entity for double quote)
- The view-switcher component is included before the nav so it renders first

- [ ] **Step 2: Verify in browser**

Open the site in a browser. You should see:
1. A small floating pill in the top-right with monitor and smartphone icons
2. Monitor icon is highlighted orange (desktop is default)
3. Clicking the smartphone icon should:
   - Constrain the site to 390px centered width with a rounded border
   - Background outside the frame turns dark (#111)
   - The site renders its mobile layout (hamburger menu, stacked content)
4. Clicking the monitor icon restores normal desktop layout

- [ ] **Step 3: Commit**

```bash
git add index.php
git commit -m "feat: wire view-switcher with Alpine state and Tailwind breakpoint neutralization"
```

---

### Task 4: Final verification across pages

No code changes — manual verification that the switcher works correctly across different views.

- [ ] **Step 1: Test on home page (`?view=home`)**

Verify: hero carousel, show cards, and all sections render mobile layout when switched. Desktop nav collapses to hamburger menu.

- [ ] **Step 2: Test on calendar page (`?view=calendar`)**

Verify: grid/list toggle (`viewMode` variable) still works independently from `devicePreview`. Calendar filter renders in mobile layout.

- [ ] **Step 3: Test on event page (`?view=event`)**

Verify: event detail layout stacks vertically in mobile mode.

- [ ] **Step 4: Test on comedians page (`?view=comedians`)**

Verify: comedian cards reflow to single column in mobile mode.

- [ ] **Step 5: Test switching back to desktop**

Verify: all breakpoints restore correctly, no lingering mobile styles, body background clears.
