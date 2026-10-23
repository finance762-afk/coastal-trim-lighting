<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Service page — Landscape & Outdoor Lighting (Phase 4, premium editorial).
 * IMAGE STATE: no client job photos on disk, so the hero is copy | form card
 * on a night band with CSS uplight beams; no gallery, no before/after.
 * Claims: facts trace to build-plan.json / config.php only. Fixture types,
 * brands, warranties, permit handling, LED retrofits and the client's
 * "Permanent Trim Lighting" (roofline track) product are unconfirmed →
 * /content-confirmations.json. FAQ topics come from the research brief.
 * ------------------------------------------------------------------------- */
$pageSvcSlug = 'landscape-lighting';
$thisService = null;
foreach ($services as $cfgSvc) { if ($cfgSvc['slug'] === $pageSvcSlug) { $thisService = $cfgSvc; break; } }

$pageTitle       = 'Landscape & Outdoor Lighting San Marcos CA | Coastal Trim Lighting';
$pageDescription = 'Year-round landscape and outdoor lighting for San Marcos, CA homes and commercial properties: paths, trees, entries, patios. Call (760) 916-3716.';
$canonicalUrl    = $siteUrl . '/services/' . $pageSvcSlug . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = $pageSvcSlug;
$heroPreloadImage = '';

$schemaMarkup = generateServicePageGraph(
    $thisService,
    $pageTitle,
    'Coastal Trim Lighting installs permanent landscape and outdoor lighting for paths, trees, entries and patios on homes and commercial properties in San Marcos, CA and the surrounding North County San Diego area.',
    [['name' => 'Services', 'url' => '/services/'], ['name' => $thisService['name'], 'url' => '/services/' . $pageSvcSlug . '/']]
);

/* Where to start — four yard zones (arch cards). */
$lslZones = [
    ['icon' => 'footprints', 'title' => 'Paths and steps',
     'text' => 'The walk from the driveway or sidewalk to the front door, and any steps along it. It is the part of the yard people actually use after dark.'],
    ['icon' => 'trees',      'title' => 'Trees and palms',
     'text' => 'Oaks, palms and other feature trees are common in San Marcos yards. Lit from below, one good tree can anchor the whole front of a property.'],
    ['icon' => 'home',       'title' => 'Entry and house front',
     'text' => 'Light at the front door and across the face of the building helps visitors find the entrance and keeps the façade from going dark at night.'],
    ['icon' => 'sun',        'title' => 'Patio and seating areas',
     'text' => 'Back patios, seating areas and garden beds you use on mild evenings, which in inland North County covers a large part of the year.'],
];

/* What shapes a landscape lighting quote — a real multi-variable table. */
$lslScope = [
    ['item' => 'Areas to light',      'tell' => 'Which of paths, trees, entry and patio you want lit.',                'why' => 'Each area adds its own set of fixtures.'],
    ['item' => 'Existing lighting',   'tell' => 'Fixtures already in the yard, and whether they still work.',          'why' => 'What is there now changes what a new layout needs.'],
    ['item' => 'Power',               'tell' => 'Where the exterior outlets are on the house or building.',             'why' => 'An outdoor system has to start from a power source near the yard.'],
    ['item' => 'On and off',          'tell' => 'At dusk, on a set schedule, or by a switch.',                          'why' => 'It decides how the system is controlled.'],
    ['item' => 'Property type',       'tell' => 'A home, or commercial grounds with a manager or association.',         'why' => 'Commercial grounds may need someone else to approve the plan.'],
    ['item' => 'Distance to the coast','tell' => 'Inland San Marcos, or a street close to the beach.',                  'why' => 'Salt air near the ocean is harder on fixture finishes.'],
];

/* Solar stake lights vs a wired system — general, verifiable differences only. */
$lslCompare = [
    ['row' => 'Power',      'solar' => 'Each light runs off its own small panel.',                    'wired' => 'The whole system runs from one power source.'],
    ['row' => 'Brightness', 'solar' => 'Depends on how much sun the panel got that day.',            'wired' => 'The same output every night.'],
    ['row' => 'Placement',  'solar' => 'Only where the panel sees sun.',                             'wired' => 'Wherever the light is needed, shade under trees included.'],
    ['row' => 'Control',    'solar' => 'On when charged, off when the battery runs down.',           'wired' => 'On at dusk or on a schedule you set.'],
];

/* FAQs — research-brief topics (permits, salt air), answered from facts only. */
$lslFaqs = [
    ['q' => 'Do I need a permit for new outdoor lighting in San Marcos?',
     'a' => 'It depends on the work. Plug-in low-voltage landscape lighting and new hardwired circuits can be treated differently, so check with the City of San Marcos Building Division before any job that adds wiring. Tell Coastal Trim Lighting what you want lit and the follow-up will explain what the install involves.'],
    ['q' => 'Will outdoor light fixtures hold up to salt air near the coast?',
     'a' => 'Salt air is hardest on fixtures close to the beach. San Marcos sits inland, east of Carlsbad, so most properties here see much less of it than coastal streets do. If your property is nearer the ocean, say so when you request a quote so fixture finish and hardware are part of the conversation.'],
];

$lslRelatedCards = [
    'residential-holiday-lighting' => ['icon' => 'house', 'desc' => 'Seasonal holiday lights on San Marcos rooflines, trees and walkways.',
        'bullets' => ['Rooflines, trees and walkways', 'One price for your house', 'Up for the whole season']],
    'commercial-holiday-lighting' => ['icon' => 'building-2', 'desc' => 'Seasonal holiday lighting for businesses and commercial properties.',
        'bullets' => ['Quoted for each property', 'Employees stay off ladders', 'Planned around approvals']],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   Landscape & Outdoor Lighting — warm-human editorial service page.
   Prefix .lsl-. Tokens only.
   =================================================================== */
.lsl-page h1, .lsl-page h2, .lsl-page h3 { text-wrap: balance; }
.lsl-page p { text-wrap: pretty; }

/* -- Hero: night band, ground glow (::before), grain (::after), uplight beams -- */
section.lsl-hero { padding-bottom: calc(var(--space-16) + var(--space-4)); }
.lsl-hero {
  background:
    radial-gradient(70% 60% at 20% 110%, color-mix(in srgb, var(--color-accent) 22%, transparent), transparent 70%),
    linear-gradient(180deg, var(--color-dark) 0%, var(--color-dark-alt) 70%, var(--color-primary-deep) 100%);
}
.lsl-hero::before {
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 26%;
  z-index: -1;
  background: linear-gradient(0deg, color-mix(in srgb, var(--color-primary) 35%, transparent), transparent);
  pointer-events: none;
}
.lsl-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .5;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.lsl-beams { position: absolute; inset: 0; z-index: -1; pointer-events: none; overflow: hidden; }
.lsl-beams span {
  position: absolute;
  bottom: 0;
  width: 220px;
  height: 78%;
  transform-origin: 50% 100%;
  background: linear-gradient(0deg, color-mix(in srgb, var(--color-accent-bright) 26%, transparent), transparent 85%);
  clip-path: polygon(46% 100%, 54% 100%, 100% 0, 0 0);
  filter: blur(6px);
  opacity: .55;
  animation: lsl-breathe 7s ease-in-out infinite alternate;
}
.lsl-beams span:nth-child(1) { left: 4%; transform: rotate(-6deg); }
.lsl-beams span:nth-child(2) { left: 30%; height: 62%; transform: rotate(4deg); animation-delay: -2.5s; }
.lsl-beams span:nth-child(3) { right: 32%; height: 54%; transform: rotate(-3deg); animation-delay: -4s; opacity: .35; }
@keyframes lsl-breathe { from { opacity: .3; } to { opacity: .6; } }
.lsl-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.lsl-hero .breadcrumb a:hover { color: var(--color-accent-bright); }
.lsl-hero .breadcrumb [aria-current] { color: var(--color-white); }
.lsl-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.lsl-hero .hero-chips li { background: color-mix(in srgb, var(--color-white) 7%, transparent); border-color: color-mix(in srgb, var(--color-accent) 35%, transparent); color: var(--color-white); }
.lsl-hero .hero-chips svg { color: var(--color-accent-bright); }
.lsl-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.lsl-hero .link-call svg { color: var(--color-accent-bright); }
.lsl-hero .hero-form-open { background: var(--color-accent); color: var(--color-ink); }
.lsl-hero .hero-form-card { border-bottom: 4px solid var(--color-accent); }

/* -- Zones: arch-topped cards (paper) -- */
.lsl-zones { background: var(--color-paper); }
.lsl-zones .section-head { max-width: 64ch; }
.lsl-zone-row { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: var(--space-lg); margin: 0; padding: 0; list-style: none; }
.lsl-zone { display: grid; gap: var(--space-sm); align-content: start; padding: var(--space-xl) var(--space-lg) var(--space-lg); background: var(--color-surface); border: 1px solid var(--color-line); border-radius: 999px 999px var(--radius-lg) var(--radius-lg); text-align: center; justify-items: center; box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition); }
.lsl-zone:hover { transform: translateY(-4px); box-shadow: var(--shadow); }
.lsl-zone:nth-child(2) { background: var(--color-card-tint-1); }
.lsl-zone:nth-child(3) { background: var(--color-card-tint-3); }
.lsl-zone:nth-child(4) { background: var(--color-card-tint-2); }
.lsl-zone-icon { width: 64px; height: 64px; display: grid; place-items: center; border-radius: var(--radius-full); color: var(--color-accent-dark); background: radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 30%, transparent), transparent); }
.lsl-zone h3 { font-size: var(--fs-h3); margin: 0; color: var(--color-primary); }
.lsl-zone p { margin: 0; font-size: var(--font-size-sm); color: var(--color-ink-2); text-align: left; }
.lsl-zones .pull-quote { margin: var(--space-2xl) auto 0; max-width: 30ch; text-align: center; font-style: italic; }

/* -- Expert: ring stat + copy (white, curved top) -- */
.lsl-expert { background: var(--color-surface); }
.lsl-expert .split-reverse { grid-template-columns: minmax(0, 1.25fr) minmax(0, .75fr); align-items: center; }
.lsl-expert .split-reverse > :first-child { order: 0; }
.lsl-ring { position: relative; aspect-ratio: 1; max-width: 320px; margin-inline: auto; display: grid; place-items: center; text-align: center; border-radius: var(--radius-full); background: conic-gradient(from 200deg, var(--color-primary), var(--color-secondary), var(--color-accent), var(--color-primary)); padding: var(--space-md); }
.lsl-ring-inner { width: 100%; height: 100%; display: grid; place-content: center; gap: var(--space-xs); border-radius: var(--radius-full); background: var(--color-dark); color: var(--color-white); padding: var(--space-lg); }
.lsl-ring .big-number { font-size: clamp(3.2rem, 2.4rem + 2.6vw, 4.8rem); color: var(--color-accent-bright); }
.lsl-ring span { font-size: var(--font-size-sm); color: color-mix(in srgb, var(--color-white) 80%, transparent); max-width: 18ch; margin-inline: auto; }
.lsl-expert-copy { display: grid; gap: var(--space-md); }
.lsl-expert-copy > p { margin: 0; max-width: var(--measure); color: var(--color-ink-2); }
.lsl-links { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-md); }
.lsl-link-card { display: grid; gap: var(--space-xs); padding: var(--space-md) var(--space-lg); border-radius: var(--radius-lg); border: 1px solid var(--color-line); background: var(--color-paper); text-decoration: none; color: var(--color-ink); transition: border-color var(--transition), transform var(--transition); }
.lsl-link-card:hover { border-color: var(--color-accent); transform: translateY(-2px); }
.lsl-link-card b { font-family: var(--font-heading); color: var(--color-primary); display: inline-flex; align-items: center; gap: var(--space-xs); }
.lsl-link-card span { font-size: var(--font-size-sm); color: var(--color-ink-2); }

/* -- Scope: dark slant band, table -- */
.lsl-scope .lsl-scope-grid { display: grid; grid-template-columns: minmax(0, .8fr) minmax(0, 1.5fr); gap: clamp(2rem, 5vw, 4rem); align-items: start; }
.lsl-scope .lsl-scope-head { display: grid; gap: var(--space-sm); }
.lsl-scope .answer-block { background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.lsl-table-wrap { overflow-x: auto; border-radius: var(--radius-lg); border: 1px solid color-mix(in srgb, var(--color-accent) 25%, transparent); background: color-mix(in srgb, var(--color-white) 4%, transparent); }
.lsl-table { width: 100%; min-width: 600px; border-collapse: collapse; font-size: var(--font-size-sm); }
.lsl-table caption { text-align: left; padding: var(--space-md) var(--space-lg) 0; font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .12em; text-transform: uppercase; color: var(--color-accent-bright); }
.lsl-table th, .lsl-table td { text-align: left; vertical-align: top; padding: var(--space-md) var(--space-lg); border-bottom: 1px dashed color-mix(in srgb, var(--color-white) 14%, transparent); }
.lsl-table thead th { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .1em; text-transform: uppercase; color: color-mix(in srgb, var(--color-white) 66%, transparent); }
.lsl-table tbody th { color: var(--color-accent-bright); font-family: var(--font-heading); width: 24%; }
.lsl-table td { color: color-mix(in srgb, var(--color-white) 84%, transparent); }
.lsl-table tbody tr:last-child > * { border-bottom: 0; }

/* -- Process: stepping stones (zigzag) on paper -- */
.lsl-process { background: var(--color-paper); }
.lsl-process .section-head { max-width: 62ch; margin-inline: auto; text-align: center; justify-items: center; }
.lsl-stones { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: var(--space-lg); margin: 0; padding: 0; list-style: none; counter-reset: stone; }
.lsl-stones li { counter-increment: stone; display: grid; gap: var(--space-xs); padding: var(--space-lg); border-radius: 46% 54% 48% 52% / 22% 26% 74% 78%; background: var(--color-surface); border: 1px solid var(--color-line); box-shadow: var(--shadow-sm); }
.lsl-stones li:nth-child(even) { margin-top: var(--space-2xl); }
.lsl-stones li::before { content: counter(stone, decimal-leading-zero); font-family: var(--font-accent); font-size: 1.5rem; color: var(--color-accent-dark); }
.lsl-stones h3 { font-size: var(--font-size-base); margin: 0; }
.lsl-stones p { margin: 0; font-size: var(--font-size-sm); color: var(--color-ink-2); }

/* -- Reviews -- */
.lsl-reviews { background: var(--color-paper-2); }

/* -- Compare: solar vs wired (white, wave top) -- */
.lsl-compare { background: var(--color-surface); }
.lsl-compare .section-head { max-width: 64ch; }
.lsl-compare-scroll { overflow-x: auto; }
.lsl-compare-table { width: 100%; min-width: 560px; border-collapse: collapse; font-size: var(--font-size-sm); }
.lsl-compare-table th, .lsl-compare-table td { padding: var(--space-md) var(--space-lg); text-align: left; vertical-align: top; border-bottom: 1px solid var(--color-line); }
.lsl-compare-table thead th { font-family: var(--font-heading); font-size: var(--font-size-base); border-bottom: 3px solid var(--color-line); }
.lsl-compare-table thead th:last-child { border-bottom-color: var(--color-accent); color: var(--color-primary); }
.lsl-compare-table tbody th { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .12em; text-transform: uppercase; color: var(--color-muted); width: 16%; }
.lsl-compare-table td:nth-child(2) { color: var(--color-muted); }
.lsl-compare-table td:last-child { color: var(--color-ink); font-weight: 600; background: linear-gradient(90deg, var(--color-card-tint-3), transparent); }
.lsl-compare-table td:last-child svg { color: var(--color-accent-dark); vertical-align: -3px; margin-right: var(--space-xs); }
.lsl-compare-note { margin: var(--space-lg) 0 0; max-width: var(--measure); color: var(--color-ink-2); }

/* -- FAQ -- */
.lsl-faq { background: var(--color-paper); }
.lsl-faq .faq[open] summary { color: var(--color-primary); }
.lsl-faq .lsl-updated { margin: var(--space-xl) 0 0; font-size: var(--font-size-sm); color: var(--color-muted); }

/* -- Related services -- */
.lsl-related { background: var(--color-paper-2); }
.lsl-related .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-lg); max-width: 880px; }
.lsl-related .service-card-with-image { border: 1px solid color-mix(in srgb, var(--color-accent) 22%, var(--color-line)); }
.lsl-related .service-card__body { padding: var(--space-xl) var(--space-lg) var(--space-lg); }
.lsl-related .service-card__icon { margin-top: 0; width: 56px; height: 56px; border-radius: var(--radius-lg) var(--radius-lg) var(--radius-lg) var(--radius-sm); background: var(--color-surface); color: var(--color-accent-dark); box-shadow: var(--shadow); transition: transform var(--transition-slow); }
.lsl-related .service-card-with-image:hover .service-card__icon { transform: scale(1.08); }

/* -- Closing CTA: centred, path-light row -- */
.lsl-cta .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.lsl-cta h2 { margin: 0; }
.lsl-cta .answer-block { margin: 0 auto; text-align: left; background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.lsl-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.lsl-cta .link-call { color: var(--color-white); }
.lsl-cta .link-call svg { color: var(--color-accent-bright); }
.lsl-pathlights { display: flex; gap: var(--space-xl); justify-content: center; margin-bottom: var(--space-sm); }
.lsl-pathlights i { width: 10px; height: 26px; border-radius: var(--radius-sm) var(--radius-sm) 0 0; background: linear-gradient(0deg, var(--color-ink-2), var(--color-muted)); position: relative; }
.lsl-pathlights i::before { content: ""; position: absolute; left: 50%; top: -6px; width: 22px; height: 8px; transform: translateX(-50%); border-radius: var(--radius-sm); background: var(--color-accent-bright); box-shadow: 0 6px 18px 4px color-mix(in srgb, var(--color-accent) 55%, transparent); }

/* -- Responsive -- */
@media (max-width: 1100px) {
  .lsl-zone-row, .lsl-stones { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .lsl-stones li:nth-child(even) { margin-top: 0; }
}
@media (max-width: 1000px) {
  .lsl-expert .split-reverse, .lsl-scope .lsl-scope-grid { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
  .lsl-zone-row, .lsl-stones, .lsl-links, .lsl-related .services-grid { grid-template-columns: 1fr; }
  .lsl-zone { border-radius: 160px 160px var(--radius-lg) var(--radius-lg); }
  .lsl-beams span { width: 140px; }
}
@media (prefers-reduced-motion: reduce) {
  .lsl-beams span { animation: none; }
}

/* -- Breadcrumb row alignment + compact hero answer on phones -- */
.lsl-hero .breadcrumb li { display: inline-flex; align-items: center; min-height: 44px; }
@media (max-width: 640px) {
  .lsl-hero .hero-answer { font-size: var(--font-size-base); }
}
.lsl-page .pull-quote::after { content: "\201D"; color: var(--color-accent-dark); }
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>

<div class="lsl-page">
<article class="lsl-article" aria-labelledby="lsl-title">

  <!-- 1. HERO — night band, uplight beams, copy | form card -->
  <section class="hero hero--interior lsl-hero">
    <div class="lsl-beams" aria-hidden="true"><span></span><span></span><span></span></div>
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
          <span class="eyebrow"><?php echo e(cityStateLine()); ?> · Year-round</span>
          <h1 class="hero-title" id="lsl-title"><span class="text-accent">Landscape and outdoor lighting</span> in San Marcos, CA</h1>
          <p class="hero-answer">Coastal Trim Lighting installs landscape and outdoor lighting that stays up year-round on homes and commercial properties in San Marcos and North County San Diego. Tell us which paths, trees, entries or patio areas you want lit and whether any fixtures are already in place, and we follow up with a price.</p>
          <div class="hero-actions">
            <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
            <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
          </div>
          <ul class="hero-chips">
            <li><?php echo icon('sun', 16); ?> Lit all year</li>
            <li><?php echo icon('trees', 16); ?> Paths, trees, entries</li>
            <li><?php echo icon('building-2', 16); ?> Homes &amp; commercial</li>
          </ul>
        </div>
        <?php echo p1_hero_form_card('hero', $thisService['name'], 'Want a landscape lighting price?', 'List the areas you want lit and we will follow up.'); ?>
      </div>
    </div>
  </section>

  <!-- 2. PROBLEM — where to start: four yard zones + pull quote -->
  <section class="section lsl-zones" aria-labelledby="lsl-zones-title">
    <div class="container-wide">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Where to start</span>
        <h2 id="lsl-zones-title">Which parts of a San Marcos yard are worth <span class="text-accent">lighting first</span>?</h2>
        <p class="answer-block">Start with the areas you use after dark: the path to the front door, one or two feature trees, the entry, and any patio you sit out on. Coastal Trim Lighting builds the quote around the areas you pick, so the price covers only what you want lit.</p>
      </div>
      <ul class="lsl-zone-row">
        <?php foreach ($lslZones as $lslI => $lslZone): ?>
        <li class="lsl-zone reveal-<?php echo ['left', 'up', 'up', 'right'][$lslI]; ?> reveal-delay-<?php echo $lslI + 1; ?>">
          <span class="lsl-zone-icon"><?php echo icon($lslZone['icon'], 28); ?></span>
          <h3><?php echo e($lslZone['title']); ?></h3>
          <p><?php echo e($lslZone['text']); ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
      <p class="pull-quote reveal-scale">Light the places you walk, then the things you want to look at.</p>
    </div>
  </section>

  <!-- 3. EXPERT POSITIONING — ring stat + one company for seasonal and year-round -->
  <section class="section lsl-expert edge-curve-top" aria-labelledby="lsl-expert-title">
    <div class="container">
      <div class="split-reverse">
        <div class="lsl-expert-copy reveal-left">
          <span class="eyebrow-label">Seasonal and permanent</span>
          <h2 id="lsl-expert-title">Why use one company for <span class="text-accent">holiday and landscape lighting</span>?</h2>
          <p class="answer-block">Coastal Trim Lighting puts up holiday lights and installs permanent outdoor lighting, so the same San Marcos company can handle a property's December display and the lights that stay on the rest of the year. One call to <?php echo e($phone); ?> covers both, for a house or for commercial grounds.</p>
          <p>The two services look at the same things: rooflines, trees, walkways and where the power is. Owned by <?php echo e($ownerName); ?> and based on <?php echo e($address['street']); ?>, Coastal Trim Lighting takes landscape lighting jobs in San Marcos and nearby towns within about <?php echo (int) $targetRadiusMiles; ?> miles.</p>
          <div class="lsl-links">
            <a class="lsl-link-card" href="<?php echo e(serviceUrl(['slug' => 'residential-holiday-lighting'])); ?>"><b><?php echo icon('house', 18); ?> Holiday lights for your house</b><span>What to send for a residential holiday lighting quote.</span></a>
            <a class="lsl-link-card" href="<?php echo e(serviceUrl(['slug' => 'commercial-holiday-lighting'])); ?>"><b><?php echo icon('building-2', 18); ?> Holiday lights for a business</b><span>How approvals and power shape a commercial quote.</span></a>
          </div>
        </div>
        <div class="lsl-ring reveal-scale">
          <div class="lsl-ring-inner">
            <span class="big-number"><?php echo (int) $yearEstablished; ?></span>
            <span>the year Coastal Trim Lighting opened in <?php echo e($address['city']); ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4a. SERVICE BREAKDOWN — what shapes the quote (dark slant band, table) -->
  <section class="section lsl-scope texture-grain slant-top" aria-labelledby="lsl-scope-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container-wide">
      <div class="lsl-scope-grid">
        <div class="lsl-scope-head reveal-left">
          <span class="eyebrow-label">What shapes the price</span>
          <h2 id="lsl-scope-title">What goes into a <span class="text-accent">landscape lighting</span> quote in San Marcos?</h2>
          <p class="answer-block">A landscape lighting quote from Coastal Trim Lighting follows the areas you want lit, the fixtures already in the yard, where the power is, and how you want the lights switched on. Each property is priced on its own, so these six details get you to a number fastest.</p>
        </div>
        <div class="lsl-table-wrap reveal-right" tabindex="0" role="region" aria-labelledby="lsl-scope-caption">
          <table class="lsl-table">
            <caption id="lsl-scope-caption">What to tell Coastal Trim Lighting about your yard</caption>
            <thead>
              <tr><th scope="col">Detail</th><th scope="col">What to tell us</th><th scope="col">Why it matters</th></tr>
            </thead>
            <tbody>
              <?php foreach ($lslScope as $lslRow): ?>
              <tr>
                <th scope="row"><?php echo e($lslRow['item']); ?></th>
                <td><?php echo e($lslRow['tell']); ?></td>
                <td><?php echo e($lslRow['why']); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- 4b. PROCESS — stepping stones -->
  <section class="section lsl-process" aria-labelledby="lsl-process-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">From request to lit</span>
        <h2 id="lsl-process-title">How does a <span class="text-accent">landscape lighting</span> project get started?</h2>
        <p class="answer-block">Pick the areas, note what is already in the yard, and send both to Coastal Trim Lighting by form or phone. You get a price for the property, and once you agree on it the lights are installed to stay up year-round.</p>
      </div>
      <ol class="lsl-stones">
        <li class="reveal-up reveal-delay-1"><h3>Pick the areas</h3><p>Paths, trees, the entry, the patio, or any mix of them.</p></li>
        <li class="reveal-down reveal-delay-2"><h3>Note what is there now</h3><p>Existing fixtures, exterior outlets, and how you want the lights turned on.</p></li>
        <li class="reveal-up reveal-delay-3"><h3>Get a price</h3><p>Send it through the form or call <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a>; Coastal Trim Lighting follows up with a price.</p></li>
        <li class="reveal-down reveal-delay-4"><h3>Lights go in</h3><p>Installed on the agreed date, and lit every night from then on.</p></li>
      </ol>
    </div>
  </section>

  <!-- 5. PROOF — Google reviews feed (renders nothing until reviews exist) -->
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
  $lslReviews = p1_google_reviews($slug, ['heading' => 'What do customers say about Coastal Trim Lighting on Google?']);
  if ($lslReviews !== ''): ?>
  <section class="section lsl-reviews" aria-label="Google reviews"><div class="container-narrow"><?php echo $lslReviews; ?></div></section>
  <?php endif; ?>

  <!-- 6. COMPARISON — solar stake lights vs a wired system -->
  <section class="section lsl-compare edge-wave-top" aria-labelledby="lsl-compare-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Solar or wired</span>
        <h2 id="lsl-compare-title">Are solar stake lights good enough, or is a <span class="text-accent">wired system</span> worth it?</h2>
        <p class="answer-block">A wired landscape lighting system gives the same light every night, wherever the fixture sits, while solar stake lights depend on the day's sun and a sunny spot. Solar is fine for a few accents; paths, trees and entries you rely on after dark are better served by a wired system.</p>
      </div>
      <div class="lsl-compare-scroll reveal-up" tabindex="0" role="region" aria-labelledby="lsl-compare-title">
        <table class="lsl-compare-table">
          <thead>
            <tr><td></td><th scope="col">Solar stake lights</th><th scope="col">A wired landscape lighting system</th></tr>
          </thead>
          <tbody>
            <?php foreach ($lslCompare as $lslCmp): ?>
            <tr>
              <th scope="row"><?php echo e($lslCmp['row']); ?></th>
              <td><?php echo e($lslCmp['solar']); ?></td>
              <td><?php echo icon('check', 16); ?><?php echo e($lslCmp['wired']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <p class="lsl-compare-note reveal-up">Comparing every option Coastal Trim Lighting offers, seasonal and permanent? The <a href="/services/">overview of lighting services in San Marcos</a> sets them side by side.</p>
    </div>
  </section>

  <!-- 7. FAQ — research-brief questions, visible text only -->
  <section class="section lsl-faq" aria-labelledby="lsl-faq-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Questions</span>
        <h2 id="lsl-faq-title">What do people ask about <span class="text-accent">outdoor lighting</span> in San Marcos?</h2>
        <p class="answer-block">Two common questions about outdoor lighting in San Marcos are whether the work needs a city permit and whether fixtures survive the coastal climate. The answers below cover what applies inland in San Marcos and what changes nearer the beach.</p>
      </div>
      <div class="faq-grid">
        <?php foreach ($lslFaqs as $lslFaqI => $lslFaq): ?>
        <details class="faq reveal-<?php echo $lslFaqI % 2 ? 'right' : 'left'; ?>" open>
          <summary><?php echo e($lslFaq['q']); ?></summary>
          <p class="faq-answer"><?php echo e($lslFaq['a']); ?></p>
        </details>
        <?php endforeach; ?>
      </div>
      <p class="lsl-updated">Last updated: <?php echo date('F Y'); ?></p>
    </div>
  </section>

</article>

  <!-- RELATED SERVICES -->
  <section class="section lsl-related" aria-label="Other lighting services">
    <div class="container">
      <div class="section-title reveal-up">
        <span class="eyebrow-label">What We Do</span>
        <h2>Need <span class="text-accent">holiday lighting</span> as well?</h2>
        <p class="hero-answer">Coastal Trim Lighting also puts up seasonal holiday lighting, on San Marcos houses and on businesses and commercial properties across North County. Both are quoted per property, and both are listed with landscape lighting on the <a href="/services/">Coastal Trim Lighting services page</a>.</p>
      </div>
      <div class="services-grid">
        <?php
        $lslTint = 2;
        foreach ($services as $lslRel):
            if ($lslRel['slug'] === $pageSvcSlug || !isset($lslRelatedCards[$lslRel['slug']])) continue;
            $lslCard = $lslRelatedCards[$lslRel['slug']];
            $lslTint = ($lslTint % 3) + 1;
        ?>
        <article class="service-card-with-image card-tint-<?php echo $lslTint; ?> reveal-up reveal-delay-<?php echo $lslTint; ?>">
          <div class="service-card__body">
            <div class="service-card__icon"><?php echo icon($lslCard['icon'], 26); ?></div>
            <h3><?php echo e($lslRel['name']); ?></h3>
            <p class="service-card__desc"><?php echo e($lslCard['desc']); ?></p>
            <ul>
              <?php foreach ($lslCard['bullets'] as $lslBullet): ?>
              <li><?php echo e($lslBullet); ?></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?php echo e(serviceUrl($lslRel)); ?>" class="service-card__cta" aria-label="Learn more about <?php echo e($lslRel['name']); ?>">Learn more</a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 8. FINAL CTA -->
  <section class="section closing-cta texture-grain edge-curve-top lsl-cta" aria-labelledby="lsl-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <div class="lsl-pathlights" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></div>
      <span class="eyebrow-label">Lit every night</span>
      <h2 id="lsl-cta-title">Which part of your property should be <span class="text-accent">lit first</span>?</h2>
      <p class="answer-block">Tell Coastal Trim Lighting the paths, trees, entry or patio you want lit and what is already in the yard. You get a price for exactly those areas on your San Marcos home or commercial property, and nothing goes in until you agree to it.</p>
      <div class="actions">
        <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
