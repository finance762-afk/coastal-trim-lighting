<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Service page — Residential Holiday Lighting (Phase 4, premium editorial).
 * IMAGE STATE: no client job photos on disk (logo-only asset list), so the hero
 * is copy | form card on a dark band with a CSS/SVG roofline decoration, no
 * gallery strip, no before/after. Swap in real photos when the client uploads.
 * Claims: every fact traces to build-plan.json / config.php. Takedown, storage,
 * own-lights, mockups, install season and pricing ranges are unconfirmed and
 * listed in /content-confirmations.json — never in the copy below.
 * ------------------------------------------------------------------------- */
$pageSvcSlug = 'residential-holiday-lighting';
$thisService = null;
foreach ($services as $cfgSvc) { if ($cfgSvc['slug'] === $pageSvcSlug) { $thisService = $cfgSvc; break; } }

$pageTitle       = 'Residential Holiday Lighting San Marcos CA | Coastal Trim Lighting';
$pageDescription = 'Holiday lights put up on San Marcos, CA homes: rooflines, trees and walkways, priced for your house. Coastal Trim Lighting, est. 2016. Call (760) 916-3716.';
$canonicalUrl    = $siteUrl . '/services/' . $pageSvcSlug . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = $pageSvcSlug;
$heroPreloadImage = '';   // no photo hero — the H1 is the LCP element

$schemaMarkup = generateServicePageGraph(
    $thisService,
    $pageTitle,
    'Coastal Trim Lighting puts up holiday lighting on houses in San Marcos, CA and the surrounding North County San Diego area: rooflines, trees, shrubs and walkways, priced for each house.',
    [['name' => 'Services', 'url' => '/services/'], ['name' => $thisService['name'], 'url' => '/services/' . $pageSvcSlug . '/']]
);

/* Telltale signs (bento) — the parts of a house that make DIY lighting hard. */
$rhlSigns = [
    ['icon' => 'house',  'size' => 'wide', 'title' => 'Second-story eaves',
     'text' => 'The upper roofline is the part most people skip, and the part that makes a house read as lit from the street. It is also the run that needs the tall ladder.'],
    ['icon' => 'layers', 'size' => 'std',  'title' => 'Tile roofs',
     'text' => 'Concrete and clay tile cover a lot of San Marcos homes, from San Elijo Hills to Lake San Marcos. Tile takes a different attachment method than shingle, so say which one you have.'],
    ['icon' => 'trees',  'size' => 'std',  'title' => 'Tall trees and palms',
     'text' => 'Wrapping a trunk and lighting a canopy are two different jobs. Note the height, and whether you want the trunk, the crown or both.'],
    ['icon' => 'route',  'size' => 'wide',  'title' => 'Few outdoor outlets',
     'text' => 'Every run of lights has to start at power. Where your exterior outlets sit, and whether any are on a switch, shapes the layout.'],
];

/* What to tell us — a real multi-variable comparison, so a <table>. */
$rhlScope = [
    ['part' => 'Rooflines',          'tell' => 'Which sides of the house, and whether any of it is second-story.',           'why' => 'Roofline length and height are usually the largest part of the job.'],
    ['part' => 'Roof surface',       'tell' => 'Tile, shingle, or a mix.',                                                    'why' => 'It decides how the lights are fastened along the edge.'],
    ['part' => 'Trees and palms',    'tell' => 'How many, roughly how tall, trunk wrap or canopy.',                           'why' => 'Taller trees take more strands and more ladder time.'],
    ['part' => 'Shrubs and walkways','tell' => 'Which hedges, beds or paths you want lit.',                                   'why' => 'Ground-level pieces add to the light count, not the height.'],
    ['part' => 'Power',              'tell' => 'Where the exterior outlets are, and any on a switch or timer.',               'why' => 'Outlet location sets where each run starts and ends.'],
    ['part' => 'Community rules',    'tell' => 'Whether your HOA has rules on exterior decorations.',                          'why' => 'Several San Marcos neighborhoods, San Elijo Hills among them, have an HOA.'],
];

/* DIY vs hiring — only claims intake supports (no takedown/storage row until confirmed). */
$rhlCompare = [
    ['row' => 'Ladder work',  'diy' => 'You climb, second-story eaves included.',                 'ctl' => 'Coastal Trim Lighting does the ladder work.'],
    ['row' => 'Planning',     'diy' => 'You work out where each strand starts and ends.',         'ctl' => 'You say what you want lit; the install follows that list.'],
    ['row' => 'Cost',         'diy' => 'Lights, clips, cords, a ladder and a weekend.',            'ctl' => 'One price for your house, given before anything goes up.'],
    ['row' => 'Timing',       'diy' => 'Whenever the weekend frees up.',                          'ctl' => 'An install date you agree on in advance.'],
];

/* FAQs — visible text only, never FAQPage JSON-LD. Q1 adapts the research-brief
 * cost question; Q2 is the booking question the client's own site answers. */
$rhlFaqs = [
    ['q' => 'How much does it cost to have holiday lights put up on a house in San Marcos?',
     'a' => 'Coastal Trim Lighting does not use a flat per-house price. The cost depends on how much roofline you want lit, how high it sits, the roof surface, and how many trees, shrubs and walkways are on the list. Send those details through the form or call ' . $phone . ' and you get a price for your house.'],
    ['q' => 'When should I get my house on the holiday lighting schedule?',
     'a' => 'As soon as you know the date you want the lights on. Coastal Trim Lighting books holiday installs one property at a time, so the earlier your request comes in, the more install dates are still open. Include your ideal date on the form and the follow-up will say what is available.'],
];

/* Related services — the other config services, icon-led (no client photos yet). */
$rhlRelatedCards = [
    'commercial-holiday-lighting' => ['icon' => 'building-2', 'desc' => 'Holiday lighting for businesses and commercial properties in North County.',
        'bullets' => ['Staff stay off the ladders', 'Quoted for the whole property', 'Lit through the season']],
    'landscape-lighting' => ['icon' => 'trees', 'desc' => 'Permanent outdoor lighting for paths, trees, entries and yards.',
        'bullets' => ['Stays up all year', 'Paths, trees and entries', 'Homes and commercial sites']],
];

/* Hero roofline decoration: a gable outline with bulbs at even steps (aria-hidden). */
$rhlRoofBulbs = [];
foreach ([[0, 70, 300, 18], [300, 18, 600, 70], [600, 70, 760, 40], [760, 40, 920, 70], [920, 70, 1200, 30]] as $rhlSeg) {
    for ($rhlI = 0; $rhlI < 6; $rhlI++) {
        $rhlT = $rhlI / 6;
        $rhlRoofBulbs[] = [round($rhlSeg[0] + ($rhlSeg[2] - $rhlSeg[0]) * $rhlT, 1), round($rhlSeg[1] + ($rhlSeg[3] - $rhlSeg[1]) * $rhlT, 1)];
    }
}
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   Residential Holiday Lighting — warm-human editorial service page.
   Prefix .rhl-. Tokens only; framework.css carries the base components.
   =================================================================== */
.rhl-page h1, .rhl-page h2, .rhl-page h3 { text-wrap: balance; }
.rhl-page p { text-wrap: pretty; }

/* -- Hero: dark interior band, layered glow (::before) + grain (::after) + roofline -- */
section.rhl-hero { padding-bottom: calc(var(--space-16) + var(--space-10)); }
.rhl-hero {
  background:
    radial-gradient(90% 120% at 100% 0%, color-mix(in srgb, var(--color-secondary) 38%, transparent), transparent 60%),
    linear-gradient(160deg, var(--color-dark) 0%, var(--color-dark-alt) 55%, var(--color-primary-deep) 100%);
}
.rhl-hero::before {
  content: "";
  position: absolute;
  inset: auto auto -30% -10%;
  width: 60%;
  aspect-ratio: 1;
  z-index: -1;
  border-radius: var(--radius-full);
  background: radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 22%, transparent), transparent);
  pointer-events: none;
}
.rhl-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .5;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.rhl-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.rhl-hero .breadcrumb a:hover { color: var(--color-accent-bright); }
.rhl-hero .breadcrumb [aria-current] { color: var(--color-white); }
.rhl-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.rhl-hero .hero-chips li {
  background: color-mix(in srgb, var(--color-white) 8%, transparent);
  border-color: color-mix(in srgb, var(--color-white) 22%, transparent);
  color: var(--color-white);
}
.rhl-hero .hero-chips svg { color: var(--color-accent-bright); }
.rhl-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.rhl-hero .link-call svg { color: var(--color-accent-bright); }
.rhl-hero .hero-form-open { background: var(--color-accent); color: var(--color-ink); }
.rhl-hero .hero-form-card { border-top: 4px solid var(--color-accent); }

.rhl-roofline { position: absolute; left: 0; right: 0; bottom: 0; height: 92px; z-index: 0; pointer-events: none; }
.rhl-roofline svg { width: 100%; height: 100%; }
.rhl-roofline .eave { fill: none; stroke: color-mix(in srgb, var(--color-white) 30%, transparent); stroke-width: 2; stroke-linejoin: round; }
.rhl-roofline .bulb { fill: var(--color-accent); filter: drop-shadow(0 0 5px var(--color-accent)); animation: rhl-twinkle 3.2s ease-in-out infinite; }
.rhl-roofline .bulb:nth-child(3n) { fill: var(--color-accent-bright); animation-delay: -1.1s; }
.rhl-roofline .bulb:nth-child(4n) { fill: color-mix(in srgb, var(--color-secondary) 60%, var(--color-white)); animation-delay: -2.2s; }
@keyframes rhl-twinkle { 0%, 100% { opacity: 1; } 50% { opacity: .55; } }

/* -- Signs: pull quote beside a bento of four tiles (paper) -- */
.rhl-signs { background: var(--color-paper); }
.rhl-signs .rhl-signs-grid { display: grid; grid-template-columns: minmax(0, .8fr) minmax(0, 1.4fr); gap: clamp(2rem, 5vw, 4rem); align-items: start; }
.rhl-signs .rhl-signs-intro { display: grid; gap: var(--space-md); position: sticky; top: calc(var(--nav-height) + var(--space-lg)); }
.rhl-signs .pull-quote { font-style: italic; margin: var(--space-sm) 0 0; padding-left: var(--space-md); border-left: 4px solid var(--color-accent); }
.rhl-bento { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-md); }
.rhl-bento .bento-item { display: grid; gap: var(--space-xs); align-content: start; padding: var(--space-lg); box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition); }
.rhl-bento .bento-item:hover { transform: translateY(-3px); box-shadow: var(--shadow); }
.rhl-bento .bento-item--wide { grid-column: span 2; }
.rhl-bento .bento-item--tall { grid-row: span 2; background: var(--color-card-tint-1); }
.rhl-bento .bento-item:nth-child(2) { background: var(--color-card-tint-1); }
.rhl-bento .bento-item:nth-child(3) { background: var(--color-card-tint-3); }
.rhl-bento .bento-item:nth-child(4) { background: var(--color-card-tint-2); }
.rhl-bento h3 { font-size: var(--fs-h3); color: var(--color-primary); margin: 0; }
.rhl-bento p { margin: 0; color: var(--color-ink-2); font-size: var(--font-size-sm); }
.rhl-bento .rhl-tile-icon { width: 44px; height: 44px; display: grid; place-items: center; border-radius: var(--radius); background: var(--color-surface); color: var(--color-accent-dark); box-shadow: var(--shadow-sm); }

/* -- Local: asymmetric big number + differentiators (white, curved top) -- */
.rhl-local { background: var(--color-surface); }
.rhl-local .grid-asym { grid-template-columns: minmax(0, .7fr) minmax(0, 1.3fr); align-items: start; gap: clamp(2rem, 6vw, 5rem); }
.rhl-stat { position: relative; padding: var(--space-xl); border-radius: var(--radius-xl); background: var(--color-dark); color: var(--color-white); overflow: hidden; isolation: isolate; }
.rhl-stat::after { content: ""; position: absolute; inset: auto -30% -40% auto; width: 80%; aspect-ratio: 1; z-index: -1; border-radius: var(--radius-full); background: radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 35%, transparent), transparent); }
.rhl-stat .big-number { font-size: clamp(4rem, 3rem + 4vw, 6.5rem); color: var(--color-accent-bright); display: block; }
.rhl-stat p { margin: var(--space-xs) 0 0; color: color-mix(in srgb, var(--color-white) 82%, transparent); }
.rhl-local .rhl-local-copy { display: grid; gap: var(--space-md); }
.rhl-local .rhl-local-copy > p { margin: 0; max-width: var(--measure); color: var(--color-ink-2); }
.rhl-diffs { display: grid; gap: var(--space-md); margin: var(--space-sm) 0 0; padding: 0; list-style: none; }
.rhl-diffs li { display: grid; grid-template-columns: 40px 1fr; gap: var(--space-1) var(--space-md); padding: var(--space-md) 0; border-top: 1px solid var(--color-line); }
.rhl-diffs svg { grid-row: span 2; color: var(--color-primary); margin-top: var(--space-1); }
.rhl-diffs b { font-family: var(--font-heading); color: var(--color-ink); }
.rhl-diffs span { color: var(--color-ink-2); font-size: var(--font-size-sm); }

/* -- Scope: dark slant band with the "what to tell us" table -- */
.rhl-scope .rhl-scope-head { max-width: 62ch; display: grid; gap: var(--space-sm); margin-bottom: var(--space-xl); }
.rhl-scope .rhl-scope-head p { margin: 0; }
.rhl-scope .answer-block { background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.rhl-table-wrap { overflow-x: auto; border-radius: var(--radius-lg); border: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); background: color-mix(in srgb, var(--color-white) 4%, transparent); backdrop-filter: blur(6px); }
.rhl-table { width: 100%; min-width: 680px; border-collapse: collapse; font-size: var(--font-size-sm); }
.rhl-table caption { text-align: left; padding: var(--space-md) var(--space-lg) 0; font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .12em; text-transform: uppercase; color: var(--color-accent-bright); }
.rhl-table th, .rhl-table td { text-align: left; vertical-align: top; padding: var(--space-md) var(--space-lg); border-bottom: 1px solid color-mix(in srgb, var(--color-white) 10%, transparent); }
.rhl-table thead th { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .1em; text-transform: uppercase; color: color-mix(in srgb, var(--color-white) 68%, transparent); }
.rhl-table tbody th { font-family: var(--font-heading); font-size: var(--font-size-base); color: var(--color-white); width: 22%; }
.rhl-table td { color: color-mix(in srgb, var(--color-white) 84%, transparent); }
.rhl-table tbody tr:last-child > * { border-bottom: 0; }
.rhl-table tbody tr { transition: background var(--transition); }
.rhl-table tbody tr:hover { background: color-mix(in srgb, var(--color-accent) 7%, transparent); }

/* -- Process: sticky heading column + vertical timeline (paper) -- */
.rhl-process { background: var(--color-paper); }
.rhl-process .split { grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr); align-items: start; }
.rhl-process .rhl-process-head { display: grid; gap: var(--space-md); position: sticky; top: calc(var(--nav-height) + var(--space-lg)); }
.rhl-process .rhl-process-head p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
.rhl-steps.timeline { gap: var(--space-lg); margin: 0; border-left-color: color-mix(in srgb, var(--color-accent) 45%, var(--color-line)); }
.rhl-steps > li { padding: var(--space-lg); border-radius: var(--radius-lg); background: var(--color-surface); border: 1px solid var(--color-line); box-shadow: var(--shadow-sm); }
.rhl-steps > li::before { top: var(--space-lg); box-shadow: 0 0 0 4px var(--color-paper), 0 0 10px var(--color-accent); }
.rhl-steps h3 { font-size: var(--fs-h3); margin: 0 0 var(--space-xs); color: var(--color-primary); }
.rhl-steps p { margin: 0; color: var(--color-ink-2); }
.rhl-steps .rhl-step-no { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .14em; text-transform: uppercase; color: var(--color-accent-dark); }

/* -- Reviews (feed; renders nothing until GBP reviews exist) -- */
.rhl-reviews { background: var(--color-paper-2); }

/* -- Compare: DIY vs Coastal Trim (white, wave top) -- */
.rhl-compare { background: var(--color-surface); }
.rhl-compare .section-head { max-width: 64ch; }
.rhl-table-scroll { overflow-x: auto; }
.rhl-compare-table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: var(--font-size-sm); }
.rhl-compare-table th, .rhl-compare-table td { padding: var(--space-md) var(--space-lg); text-align: left; vertical-align: top; border-bottom: 1px solid var(--color-line); }
.rhl-compare-table thead th { font-family: var(--font-heading); font-size: var(--font-size-base); }
.rhl-compare-table thead th:last-child { background: var(--color-primary); color: var(--color-white); border-radius: var(--radius-lg) var(--radius-lg) 0 0; }
.rhl-compare-table tbody th { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .12em; text-transform: uppercase; color: var(--color-muted); width: 18%; }
.rhl-compare-table td:nth-child(2) { color: var(--color-muted); }
.rhl-compare-table td:last-child { background: var(--color-card-tint-1); color: var(--color-ink); font-weight: 600; border-left: 3px solid var(--color-accent); }
.rhl-compare-table td:last-child svg { color: var(--color-accent-dark); vertical-align: -3px; margin-right: var(--space-xs); }
.rhl-compare-table tbody tr:last-child td:last-child { border-radius: 0 0 var(--radius-lg) var(--radius-lg); }
.rhl-compare-note { margin: var(--space-lg) 0 0; max-width: var(--measure); color: var(--color-ink-2); }

/* -- FAQ -- */
.rhl-faq { background: var(--color-paper); }
.rhl-faq .faq[open] summary { color: var(--color-primary); }
.rhl-faq .rhl-updated { margin: var(--space-xl) 0 0; font-size: var(--font-size-sm); color: var(--color-muted); }

/* -- Related services (icon-led tinted cards) -- */
.rhl-related { background: var(--color-paper-2); }
.rhl-related .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-lg); max-width: 880px; }
.rhl-related .service-card-with-image { border: 1px solid color-mix(in srgb, var(--color-primary) 14%, var(--color-line)); }
.rhl-related .service-card__body { padding: var(--space-xl) var(--space-lg) var(--space-lg); }
.rhl-related .service-card__icon { margin-top: 0; width: 56px; height: 56px; border-radius: var(--radius-lg); background: var(--color-surface); color: var(--color-primary); box-shadow: var(--shadow); transition: transform var(--transition-slow); }
.rhl-related .service-card-with-image:hover .service-card__icon { transform: rotate(-6deg) scale(1.06); }

/* -- Closing CTA: dark, grain, wave edge -- */
.rhl-cta .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.rhl-cta h2 { margin: 0; }
.rhl-cta .answer-block { margin: 0 auto; background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); text-align: left; }
.rhl-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.rhl-cta .link-call { color: var(--color-white); }
.rhl-cta .link-call svg { color: var(--color-accent-bright); }
.rhl-cta .rhl-hub-link { color: var(--color-accent-bright); }
.rhl-cta .floating-ring { top: -110px; right: -90px; }

/* -- Responsive -- */
@media (max-width: 1000px) {
  .rhl-signs .rhl-signs-grid, .rhl-local .grid-asym, .rhl-process .split { grid-template-columns: 1fr; }
  .rhl-signs .rhl-signs-intro, .rhl-process .rhl-process-head { position: static; }
}
@media (max-width: 700px) {
  .rhl-bento, .rhl-related .services-grid { grid-template-columns: 1fr; }
  .rhl-bento .bento-item--wide { grid-column: auto; }
  .rhl-bento .bento-item--tall { grid-row: auto; }
  .rhl-roofline { height: 60px; }
  section.rhl-hero { padding-bottom: calc(var(--space-12) + var(--space-8)); }
  .rhl-compare-table th, .rhl-compare-table td { padding: var(--space-sm); }
  .rhl-compare-table tbody th { width: auto; }
}
@media (prefers-reduced-motion: reduce) {
  .rhl-roofline .bulb { animation: none; }
}

/* -- Breadcrumb row alignment + compact hero answer on phones -- */
.rhl-hero .breadcrumb li { display: inline-flex; align-items: center; min-height: 44px; }
@media (max-width: 640px) {
  .rhl-hero .hero-answer { font-size: var(--font-size-base); }
}
.rhl-page .pull-quote::after { content: "\201D"; color: var(--color-accent-dark); }
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>

<div class="rhl-page">
<article class="rhl-article" aria-labelledby="rhl-title">

  <!-- 1. HERO — dark interior band, copy | form card, roofline decoration -->
  <section class="hero hero--interior rhl-hero">
    <div class="container">
      <div class="hero-grid hero-grid--form">
        <div class="hero-copy">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="/">Home</a></li>
              <li class="breadcrumb-sep" aria-hidden="true">/</li>
              <li><a href="/services/">Services</a></li>
              <li class="breadcrumb-sep" aria-hidden="true">/</li>
              <li aria-current="page"><?php echo e($thisService['name']); ?></li>
            </ol>
          </nav>
          <span class="eyebrow"><?php echo e(cityStateLine()); ?> · Homes</span>
          <h1 class="hero-title" id="rhl-title"><span class="text-accent">Holiday lighting</span> for San Marcos homes</h1>
          <p class="hero-answer">Coastal Trim Lighting puts up holiday lights on houses in San Marcos and the surrounding North County San Diego area: rooflines, trees, shrubs and walkways. Tell us your address and which parts of the house you want lit, and you get open install dates and a price for that house.</p>
          <div class="hero-actions">
            <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
            <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
          </div>
          <ul class="hero-chips">
            <li><?php echo icon('calendar', 16); ?> Est. <?php echo (int) $yearEstablished; ?></li>
            <li><?php echo icon('house', 16); ?> Priced per house</li>
            <li><?php echo icon('map-pin', 16); ?> Based in <?php echo e($address['city']); ?></li>
          </ul>
        </div>
        <?php echo p1_hero_form_card('hero', $thisService['name'], 'Want a price for your house?', 'Your address and what you want lit is enough to start.'); ?>
      </div>
    </div>
    <div class="rhl-roofline" aria-hidden="true">
      <svg viewBox="0 0 1200 92" preserveAspectRatio="none" focusable="false">
        <polyline class="eave" points="0,70 300,18 600,70 760,40 920,70 1200,30"/>
        <g>
          <?php foreach ($rhlRoofBulbs as $rhlB): ?>
          <circle class="bulb" cx="<?php echo $rhlB[0]; ?>" cy="<?php echo $rhlB[1] + 6; ?>" r="4"/>
          <?php endforeach; ?>
        </g>
      </svg>
    </div>
  </section>

  <!-- 2. PROBLEM — pull quote + bento of four telltale signs -->
  <section class="section rhl-signs" aria-labelledby="rhl-signs-title">
    <div class="container-wide">
      <div class="rhl-signs-grid">
        <div class="rhl-signs-intro reveal-left">
          <span class="eyebrow-label">Before you climb</span>
          <h2 id="rhl-signs-title">Which parts of a house make <span class="text-accent">holiday lights</span> hard to hang yourself?</h2>
          <p class="answer-block">Second-story eaves, tile roofs, tall trees and a shortage of outdoor outlets are what turn a lighting weekend into a ladder problem. Coastal Trim Lighting asks about those four things first, because they shape how the install is planned and what your house will cost.</p>
          <p class="pull-quote">If it needs the tall ladder, put it on the list.</p>
        </div>
        <div class="rhl-bento">
          <?php foreach ($rhlSigns as $rhlSignI => $rhlSign): ?>
          <div class="bento-item bento-item--<?php echo e($rhlSign['size']); ?> reveal-<?php echo $rhlSignI % 2 ? 'right' : 'up'; ?> reveal-delay-<?php echo ($rhlSignI % 3) + 1; ?>">
            <span class="rhl-tile-icon"><?php echo icon($rhlSign['icon'], 22); ?></span>
            <h3><?php echo e($rhlSign['title']); ?></h3>
            <p><?php echo e($rhlSign['text']); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. EXPERT POSITIONING — big number + differentiators with evidence -->
  <section class="section rhl-local edge-curve-top" aria-labelledby="rhl-local-title">
    <div class="container">
      <div class="grid-asym">
        <div class="rhl-stat reveal-scale">
          <span class="big-number"><?php echo (int) $yearsInBusiness; ?></span>
          <p>years since Coastal Trim Lighting opened in <?php echo e($address['city']); ?> in <?php echo (int) $yearEstablished; ?>.</p>
        </div>
        <div class="rhl-local-copy reveal-right">
          <span class="eyebrow-label">Local crew, local houses</span>
          <h2 id="rhl-local-title">Who puts up the lights on a <span class="text-accent">San Marcos</span> house?</h2>
          <p class="answer-block">Coastal Trim Lighting, the San Marcos lighting company owned by <?php echo e($ownerName); ?>, handles the install from start to finish. The business works out of <?php echo e($address['street']); ?> and takes residential holiday lighting jobs in San Marcos and nearby towns within about <?php echo (int) $targetRadiusMiles; ?> miles.</p>
          <ul class="rhl-diffs">
            <li><?php echo icon('map-pin', 22); ?><b>Close to your street</b><span>San Elijo Hills, Lake San Marcos and Twin Oaks Valley are all a short drive from the Topanga Drive base.</span></li>
            <li><?php echo icon('sparkles', 22); ?><b>Holiday and year-round lighting from one company</b><span>The same company also does <a href="<?php echo e(serviceUrl(['slug' => 'landscape-lighting'])); ?>">landscape and outdoor lighting for your yard</a>, so the trees you light in December can be lit the rest of the year too.</span></li>
            <li><?php echo icon('clipboard-check', 22); ?><b>A price for your house, not a package</b><span>Each house is priced on its own rooflines, trees and walkways, so the price follows your list rather than a package.</span></li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- 4a. SERVICE BREAKDOWN — what shapes the price (dark slant band, real table) -->
  <section class="section rhl-scope texture-grain slant-top" aria-labelledby="rhl-scope-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container-wide">
      <div class="rhl-scope-head reveal-up">
        <span class="eyebrow-label">What shapes the price</span>
        <h2 id="rhl-scope-title">What goes into the price of <span class="text-accent">residential holiday lighting</span> in San Marcos?</h2>
        <p class="answer-block">Coastal Trim Lighting prices each house on how much roofline you want lit, how high it sits, the roof surface, and the trees, shrubs and walkways on your list. There is no flat per-house rate, so sending those details is the fastest way to a firm number.</p>
      </div>
      <div class="rhl-table-wrap reveal-up" tabindex="0" role="region" aria-labelledby="rhl-scope-caption">
        <table class="rhl-table">
          <caption id="rhl-scope-caption">What to tell Coastal Trim Lighting about your house</caption>
          <thead>
            <tr><th scope="col">Part of the house</th><th scope="col">What to tell us</th><th scope="col">Why it matters</th></tr>
          </thead>
          <tbody>
            <?php foreach ($rhlScope as $rhlRow): ?>
            <tr>
              <th scope="row"><?php echo e($rhlRow['part']); ?></th>
              <td><?php echo e($rhlRow['tell']); ?></td>
              <td><?php echo e($rhlRow['why']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- 4b. PROCESS — sticky heading + timeline -->
  <section class="section rhl-process" aria-labelledby="rhl-process-title">
    <div class="container">
      <div class="split">
        <div class="rhl-process-head reveal-left">
          <span class="eyebrow-label">Getting on the calendar</span>
          <h2 id="rhl-process-title">How does a <span class="text-accent">home holiday lighting</span> install get scheduled?</h2>
          <p class="answer-block">You send the address and your list, Coastal Trim Lighting follows up with open dates and a price, and the lights go up on the day you pick. Nothing is installed until you have seen the price and picked a date that works for your household.</p>
          <p>If you have a preference for the install day, such as a weekday or a weekend, say so in the request along with the date you want the lights on.</p>
        </div>
        <ol class="timeline rhl-steps">
          <li class="reveal-right reveal-delay-1"><span class="rhl-step-no">Step 1</span><h3>Send the address</h3><p>Use the form on this page or call <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a>. A house in San Marcos or a nearby North County town is all that is needed to start.</p></li>
          <li class="reveal-right reveal-delay-2"><span class="rhl-step-no">Step 2</span><h3>List what you want lit</h3><p>Rooflines, trees, shrubs, walkways, the date you want the lights on, and anything from the table above you already know.</p></li>
          <li class="reveal-right reveal-delay-3"><span class="rhl-step-no">Step 3</span><h3>Get dates and a price</h3><p>Coastal Trim Lighting comes back with the install dates still open and a price for your house.</p></li>
          <li class="reveal-right reveal-delay-4"><span class="rhl-step-no">Step 4</span><h3>Install day</h3><p>The lights go up on the date you agreed on, and the house is lit for the season.</p></li>
        </ol>
      </div>
    </div>
  </section>

  <!-- 5. PROOF — Page One Google reviews feed (renders nothing until the profile has reviews) -->
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
  $rhlReviews = p1_google_reviews($slug, ['heading' => 'What do San Marcos homeowners say about Coastal Trim Lighting on Google?']);
  if ($rhlReviews !== ''): ?>
  <section class="section rhl-reviews" aria-label="Google reviews"><div class="container-narrow"><?php echo $rhlReviews; ?></div></section>
  <?php endif; ?>

  <!-- 6. COMPARISON — doing it yourself vs Coastal Trim Lighting -->
  <section class="section rhl-compare edge-wave-top" aria-labelledby="rhl-compare-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">DIY or hire</span>
        <h2 id="rhl-compare-title">Is it worth hiring someone to hang <span class="text-accent">Christmas lights</span> on your house?</h2>
        <p class="answer-block">Hiring Coastal Trim Lighting pays off most on two-story rooflines, tile roofs and tall trees, where the ladder time and the risk pile up. A single-story house with a few lit shrubs is a reasonable weekend project; a second-story eave usually is not.</p>
      </div>
      <div class="rhl-table-scroll reveal-up" tabindex="0" role="region" aria-labelledby="rhl-compare-title">
        <table class="rhl-compare-table">
          <thead>
            <tr><td></td><th scope="col">Doing it yourself</th><th scope="col">Coastal Trim Lighting</th></tr>
          </thead>
          <tbody>
            <?php foreach ($rhlCompare as $rhlCmp): ?>
            <tr>
              <th scope="row"><?php echo e($rhlCmp['row']); ?></th>
              <td><?php echo e($rhlCmp['diy']); ?></td>
              <td><?php echo icon('check', 16); ?><?php echo e($rhlCmp['ctl']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <p class="rhl-compare-note reveal-up">Lighting a business instead of a house? Approvals, power and work hours change the job, so read <a href="<?php echo e(serviceUrl(['slug' => 'commercial-holiday-lighting'])); ?>">how commercial holiday lighting is quoted</a> before you send the request.</p>
    </div>
  </section>

  <!-- 7. FAQ — real questions only, visible text (never FAQPage JSON-LD) -->
  <section class="section rhl-faq" aria-labelledby="rhl-faq-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Questions</span>
        <h2 id="rhl-faq-title">What do homeowners ask before booking <span class="text-accent">holiday lighting</span>?</h2>
        <p class="answer-block">Before booking, homeowners want to know what holiday lights will cost on their house and how early to get on the Coastal Trim Lighting install calendar. Both answers depend on the same thing: your address and the list of what you want lit.</p>
      </div>
      <div class="faq-grid">
        <?php foreach ($rhlFaqs as $rhlFaqI => $rhlFaq): ?>
        <details class="faq reveal-<?php echo $rhlFaqI % 2 ? 'right' : 'left'; ?>" open>
          <summary><?php echo e($rhlFaq['q']); ?></summary>
          <p class="faq-answer"><?php echo e($rhlFaq['a']); ?></p>
        </details>
        <?php endforeach; ?>
      </div>
      <p class="rhl-updated">Last updated: <?php echo date('F Y'); ?></p>
    </div>
  </section>

</article>

  <!-- RELATED SERVICES — the other services, required card pattern -->
  <section class="section rhl-related" aria-label="Other lighting services">
    <div class="container">
      <div class="section-title reveal-up">
        <span class="eyebrow-label">What We Do</span>
        <h2>What other <span class="text-accent">lighting</span> might your property need?</h2>
        <p class="hero-answer">Coastal Trim Lighting also lights businesses and commercial properties for the holidays and installs permanent landscape and outdoor lighting for paths, trees and entries on homes and commercial sites. All three services are listed on the <a href="/services/">Coastal Trim Lighting services page</a>.</p>
      </div>
      <div class="services-grid">
        <?php
        $rhlTint = 0;
        foreach ($services as $rhlRel):
            if ($rhlRel['slug'] === $pageSvcSlug || !isset($rhlRelatedCards[$rhlRel['slug']])) continue;
            $rhlCard = $rhlRelatedCards[$rhlRel['slug']];
            $rhlTint = ($rhlTint % 3) + 1;
        ?>
        <article class="service-card-with-image card-tint-<?php echo $rhlTint; ?> reveal-up reveal-delay-<?php echo $rhlTint; ?>">
          <div class="service-card__body">
            <div class="service-card__icon"><?php echo icon($rhlCard['icon'], 26); ?></div>
            <h3><?php echo e($rhlRel['name']); ?></h3>
            <p class="service-card__desc"><?php echo e($rhlCard['desc']); ?></p>
            <ul>
              <?php foreach ($rhlCard['bullets'] as $rhlBullet): ?>
              <li><?php echo e($rhlBullet); ?></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?php echo e(serviceUrl($rhlRel)); ?>" class="service-card__cta" aria-label="Learn more about <?php echo e($rhlRel['name']); ?>">Learn more</a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 8. FINAL CTA -->
  <section class="section closing-cta texture-grain edge-wave-top rhl-cta" aria-labelledby="rhl-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <span class="eyebrow-label">Your house, this season</span>
      <h2 id="rhl-cta-title">Ready to get your house on the <span class="text-accent">install calendar</span>?</h2>
      <p class="answer-block">Send Coastal Trim Lighting your address, the rooflines and trees you want lit, and the date you want them on. You get back the open install dates and a price for your house before anything goes up, for a house in San Elijo Hills, Lake San Marcos, Twin Oaks Valley or anywhere else in town.</p>
      <div class="actions">
        <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
