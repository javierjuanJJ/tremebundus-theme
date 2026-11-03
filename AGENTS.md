# tremebundus-theme

> Compact guidance for OpenCode sessions building this WordPress theme.

## ⚠️ Without this, agents will miss

### Image references
- All 5 images in `img/` are **design references**, not just assets:
  - `Bio--11-03-2026_02_22_PM.png`
  - `Contacto--11-03-2026_02_22_PM.png`
  - `Cortometrajes--11-03-2026_02_20_PM.png`
  - `image home.png`
  - `Poemas--11-03-2026_02_21_PM.png`
- Use them as visual benchmarks for layout, color palette, typography, and imagery style.
- When adding new templates or components, compare against these images to maintain visual consistency.

### WordPress theme structure
- This is a PHP-based WordPress theme. Expected root files:
  - `style.css` with theme header comment
  - `index.php` (main template)
  - `header.php`, `footer.php`, `sidebar.php` (template parts)
  - `single.php`, `page.php` (content templates)
  - `functions.php` (theme setup, enqueues, etc.)
- **Never** hard-code paths; use `get_template_directory_uri()` / `get_template_directory()` for assets.
- Register navigation menus in `functions.php` using `register_nav_menus()`.

### Accessibility (WCAG 2.2)
- The `.agents/skills/accessibility/` skill is the source of truth for a11y.
- **Images require alt text**: never render an `<img>` without an `alt` attribute.
  - Descriptive alt for informative images.
  - Empty `alt=""` with `role="presentation"` for decorative images.
- Use the `.agents/skills/accessibility/SKILL.md` WCAG principles (POUR) and checklist.
- Color contrast must meet AA minimum (4.5:1 normal, 3:1 UI components).
- Focus indicators: never remove outlines with `*:focus { outline: none }`; use `:focus-visible` instead.
- Keyboard navigation: all functionality must be operable via Tab/Enter/Space.
- Use native HTML elements (`<button>`, `<a>`, form controls) over `<div role="button">`.

### Frontend design
- The `.agents/skills/frontend-design/` skill guides visual decisions.
- **Ground designs in the subject matter** — identify the theme's purpose, audience, and primary job before designing.
- Use one typeface family (or two distinct ones) with a deliberate type scale.
- Line length < 80 chars for body text; avoid: single-word accenting in headlines, all-caps labels, unnecessary labels.
- Visual structure = information: use borders, dividers, numbering only if content is actually a sequence.
- Motion: one orchestrated page-load reveal is better than scattered hover effects. Respect `prefers-reduced-motion`.
- Restraction: make one element the memorable thing; keep surrounding discipline. Cut decoration that does not serve the brief.

### Responsiveness
- The theme **must be responsive**. Mobile-first CSS approach.
- Test layout breakpoints against the 5 reference images.
- Use flexible units (rem, %, max-width) rather than fixed pixels where possible.
- Ensure target sizes: interactive elements minimum 24×24 CSS pixels (AA).

### Development workflow
- No build pipeline is configured yet. If adding CSS/JS:
  - Enqueue via `wp_enqueue_style()` / `wp_enqueue_script()` in `functions.php`.
  - Use `get_template_directory_uri()` for asset URLs.
- Lint/typecheck: not yet configured. Add if/when build tools are introduced.
- Before committing: verify visual consistency against `img/` references and run accessibility checks on rendered pages.

### References
- `.agents/skills/accessibility/SKILL.md` — full WCAG 2.2 a11y guidance
- `.agents/skills/frontend-design/SKILL.md` — deliberate visual design principles
- `img/` — 5 reference images for layout, palette, and style
- WCAG 2.2 Quick Reference: <https://www.w3.org/WAI/WCAG22/quickref/>
