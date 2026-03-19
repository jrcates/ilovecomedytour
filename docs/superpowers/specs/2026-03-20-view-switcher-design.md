# View Switcher Component — Design Spec

## Purpose

A floating UI component for client demos that lets stakeholders toggle between mobile and desktop views of the site without resizing the browser.

## Approach

**CSS Override with Tailwind breakpoint neutralization:** A floating Alpine.js widget toggles a CSS class (`cc-force-mobile`) on the root wrapper, constraining the site to 390px width. JavaScript mutates Tailwind CDN's config to set ALL responsive breakpoints (`sm`, `md`, `lg`, `xl`, `2xl`) to `9999px`, then forces the CDN to regenerate styles. This disables every responsive utility at once, making the entire site render its mobile-first layout faithfully.

## Component: `components/view-switcher.php`

- Floating widget positioned **top-right of the viewport** (outside the phone frame in mobile mode)
- Two icon buttons using Lucide icons: `monitor` (Desktop) and `smartphone` (Mobile)
- Active choice highlighted in orange (`#F15A29`), inactive in neutral gray
- `z-index: 80` — above all content including mobile drawer (`z-[70]`)
- Reads/writes `devicePreview` state from parent Alpine.js scope via Alpine's scope chain resolution

## Integration

### `index.php`

- Root `<div>` gets Alpine.js `x-data="{ devicePreview: 'desktop' }"`
- `:class="{ 'cc-force-mobile': devicePreview === 'mobile' }"` applied to the wrapper
- `x-effect` on the wrapper handles two things:
  1. Sets `document.body.style.background` to `#111` when mobile, empty when desktop
  2. Mutates Tailwind CDN config and forces style regeneration (see mechanism below)
- `components/view-switcher.php` included inside the root `<div>`

**Note:** The variable is named `devicePreview` (not `viewMode`) to avoid collision with existing `viewMode` variables used for grid/list toggles in `show-grid.php`, `calendar.php`, and `promodates.php`.

### Tailwind CDN Breakpoint Neutralization — Exact Mechanism

The Tailwind CDN Play script uses a MutationObserver on `<style type="text/tailwindcss">` elements. Mutating one of these elements triggers a full style regeneration using the current `tailwind.config`.

```javascript
// Activate mobile mode — disable all responsive breakpoints
tailwind.config.theme.screens = {
  sm: '9999px', md: '9999px', lg: '9999px', xl: '9999px', '2xl': '9999px'
};
// Force CDN to regenerate by touching the existing <style type="text/tailwindcss"> block in head.php
document.querySelector('style[type="text/tailwindcss"]').textContent += ' ';

// Deactivate mobile mode — restore default breakpoints
tailwind.config.theme.screens = {
  sm: '640px', md: '768px', lg: '1024px', xl: '1280px', '2xl': '1536px'
};
document.querySelector('style[type="text/tailwindcss"]').textContent += ' ';
```

The existing `<style type="text/tailwindcss">` block in `components/layout/head.php` (lines 24-37) is the target for the MutationObserver trigger.

**Performance note:** Regenerating all utility CSS may cause a brief layout reflow. A short opacity fade (e.g., 150ms) during the switch can mask this.

### `css/custom.css`

New `.cc-force-mobile` ruleset:

- `max-width: 390px` + `margin: 0 auto` — constrains site to phone width
- `border-radius: 20px`, `border: 2px solid rgba(255,255,255,0.1)`, `box-shadow` — device frame appearance
- `overflow: hidden` on the wrapper (prevents content spilling outside the rounded frame)
- `min-height: 100vh` — ensures the frame fills the viewport height
- `transition: max-width 0.3s ease, opacity 0.15s ease` — smooth switching animation

### Body background

When mobile mode is active, `<body>` background is set to `#111` via Alpine `x-effect` (CSS cannot style a parent from a child class). This creates the dark backdrop outside the phone frame.

### Mobile drawer compatibility

The mobile drawer (`z-[70]`) and backdrop (`z-[60]`) have `md:hidden` classes. When all responsive breakpoints are neutralized (set to 9999px), these elements render as if the viewport is below `sm` (the mobile-first state). They remain hidden by Alpine's `x-cloak` and only show when the hamburger menu is tapped. No special overrides needed.

### Alpine.js scope chain

The `devicePreview` variable on the root `<div>` is accessible inside nested Alpine scopes (e.g., `nav.php`'s `{ mobileOpen: false }`) via Alpine's scope chain resolution. The view-switcher component reads it from the parent scope the same way.

### Changes to existing files

- `index.php` — Add Alpine `devicePreview` state, class binding, x-effect, and view-switcher component include
- `css/custom.css` — Add `.cc-force-mobile` styles

**No changes to any view files or existing components.**

## UI Details

- Default state: Desktop (site renders normally)
- Switcher is always visible (no hide trigger)
- Smooth transition when switching modes with brief opacity fade to mask Tailwind regeneration
- Mobile mode centers the constrained site with a device frame border
- Switcher stays at viewport top-right, outside the phone frame

## Out of Scope

- Tablet view (may be added later)
- Hiding the switcher behind a query param or keyboard shortcut
- iframe-based viewport simulation
