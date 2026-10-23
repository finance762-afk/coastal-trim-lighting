<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Service page — Commercial Holiday Lighting (Phase 4, premium editorial).
 * IMAGE STATE: no client job photos on disk, so the hero is copy | form card
 * on a teal band with a CSS bulb-marquee edge; no gallery, no before/after.
 * Claims: facts trace to build-plan.json / config.php only. Property types the
 * client's old site lists (shopping centers, restaurants, hotels, community
 * entrances), takedown/storage, warranties, insurance certificates and
 * after-hours installs are unconfirmed → /content-confirmations.json.
 * ------------------------------------------------------------------------- */
$pageSvcSlug = 'commercial-holiday-lighting';
$thisService = null;
foreach ($services as $cfgSvc) { if ($cfgSvc['slug'] === $pageSvcSlug) { $thisService = $cfgSvc; break; } }

$pageTitle       = 'Commercial Holiday Lighting San Marcos CA | Coastal Trim Lighting';
$pageDescription = 'Commercial holiday lighting for San Marcos, CA businesses and properties, quoted per site. Send your address and approvals. Call (760) 916-3716.';
$canonicalUrl    = $siteUrl . '/services/' . $pageSvcSlug . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = $pageSvcSlug;
$heroPreloadImage = '';

$schemaMarkup = generateServicePageGraph(
    $thisService,
    $pageTitle,
    'Coastal Trim Lighting puts up holiday lighting on businesses and commercial properties in San Marcos, CA and the surrounding North County San Diego area, quoted for each property.',
    [['name' => 'Services', 'url' => '/services/'], ['name' => $thisService['name'], 'url' => '/services/' . $pageSvcSlug . '/']]
);

/* Four things to settle before install (checklist cards). */
$chlChecks = [
    ['icon' => 'handshake',  'title' => 'Who approves it',
     'text' => 'An owner, a landlord, a property manager, an association board, or some mix of them. The quote moves fastest once the person who signs off is named.'],
    ['icon' => 'route',      'title' => 'Where the power is',
     'text' => 'Exterior outlets on the building, who controls them, and whether any already run on a timer. Lights can only start where power is.'],
    ['icon' => 'clock',      'title' => 'When work can happen',
     'text' => 'Open hours, delivery times and busy parking lots all affect when ladders can go up safely. Tell us the quiet windows.'],
    ['icon' => 'clipboard-list', 'title' => 'What paperwork is needed',
     'text' => 'Some management companies ask outside vendors for forms before work starts. If yours does, say so on the request.'],
];

/* How a commercial job differs from a house — a real multi-variable comparison. */
$chlDiff = [
    ['row' => 'Who signs off', 'home' => 'The homeowner, sometimes after an HOA check.',            'biz' => 'Owner, landlord, property manager or association, often more than one.'],
    ['row' => 'Power',         'home' => 'The exterior outlets on the house.',                       'biz' => 'Outlets on the building, and whoever controls them.'],
    ['row' => 'Work window',   'home' => 'A date that suits the household.',                         'biz' => 'Hours when customers, tenants and the parking lot are quiet.'],
    ['row' => 'What gets lit', 'home' => 'Rooflines, trees, shrubs and walkways.',                   'biz' => 'Building frontage, entries, trees and shared areas.'],
    ['row' => 'Paperwork',     'home' => 'Usually none.',                                            'biz' => 'Whatever vendor forms the management company asks for.'],
];

/* Staff vs hiring — claims intake supports only. */
$chlCompare = [
    ['row' => 'Ladder work', 'staff' => 'Employees on ladders at the workplace.',      'ctl' => 'Coastal Trim Lighting does the ladder and roofline work.'],
    ['row' => 'Staff time',  'staff' => 'Hours pulled away from the usual job.',        'ctl' => 'Your team keeps doing its own work.'],
    ['row' => 'Cost',        'staff' => 'Lights, equipment and paid staff hours.',      'ctl' => 'One quoted price for the property, given before install.'],
    ['row' => 'Schedule',    'staff' => 'Squeezed between shifts.',                     'ctl' => 'An install date agreed in advance.'],
];

$chlFaqs = [
    ['q' => 'How is holiday lighting priced for a commercial property in San Marcos?',
     'a' => 'Coastal Trim Lighting quotes each commercial property on its own. The building frontage, the height of the work, the trees and shared areas on the list, and the power available are what move the number. Send the site address and what you want lit, or call ' . $phone . ', and the quote comes back for that property.'],
    ['q' => 'When should a business get holiday lighting on the calendar?',
     'a' => 'As soon as the approvals are moving. Commercial jobs often wait on a landlord, owner or association sign-off, so start that conversation and send Coastal Trim Lighting the request at the same time. The earlier it arrives, the more install dates are still open.'],
];

$chlRelatedCards = [
    'residential-holiday-lighting' => ['icon' => 'house', 'desc' => 'Holiday lights on rooflines, trees and walkways at San Marcos houses.',
        'bullets' => ['You stay off the ladder', 'Priced for your house', 'Installed on your date']],
    'landscape-lighting' => ['icon' => 'trees', 'desc' => 'Year-round outdoor lighting for entries, paths and trees.',
        'bullets' => ['Lit every night of the year', 'Entries, paths and trees', 'For homes and businesses']],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   Commercial Holiday Lighting — warm-human editorial service page.
   Prefix .chl-. Tokens only.
   =================================================================== */
.chl-page h1, .chl-page h2, .chl-page h3 { text-wrap: balance; }
.chl-page p { text-wrap: pretty; }

/* -- Hero: teal band, diagonal light (::before), grain (::after), bulb marquee edge -- */
section.chl-hero { padding-bottom: calc(var(--space-16) + var(--space-6)); }
.chl-hero {
  background:
    linear-gradient(105deg, var(--color-primary-deep) 0%, var(--color-primary-dark) 45%, var(--color-secondary) 100%);
}
.chl-hero::before {
  content: "";
  position: absolute;
  inset: -20% auto auto 38%;
  width: 46%;
  height: 160%;
  z-index: -1;
  transform: rotate(18deg);
  background: linear-gradient(90deg, transparent, color-mix(in srgb, var(--color-accent) 16%, transparent), transparent);
  pointer-events: none;
}
.chl-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .45;
  mix-blend-mode: soft-light;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.22'/%3E%3C/svg%3E");
}
.chl-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 72%, transparent); }
.chl-hero .breadcrumb a:hover { color: var(--color-accent-bright); }
.chl-hero .breadcrumb [aria-current] { color: var(--color-white); }
.chl-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.chl-hero .hero-chips li { background: color-mix(in srgb, var(--color-dark) 30%, transparent); border-color: color-mix(in srgb, var(--color-white) 25%, transparent); color: var(--color-white); }
.chl-hero .hero-chips svg { color: var(--color-accent-bright); }
.chl-hero .link-call { color: var(--color-white); }
.chl-hero .link-call svg { color: var(--color-accent-bright); }
.chl-hero .hero-form-open { background: var(--color-accent); color: var(--color-ink); }
.chl-hero .hero-form-card { border-radius: var(--radius-lg) var(--radius-lg) var(--radius-lg) 0; box-shadow: var(--shadow-lg), 0 0 0 1px color-mix(in srgb, var(--color-accent) 40%, transparent); }

.chl-marquee {
  position: absolute;
  left: 0;
  right: 0;
  bottom: var(--space-lg);
  height: 18px;
  z-index: 0;
  pointer-events: none;
  border-top: 2px solid color-mix(in srgb, var(--color-dark) 55%, transparent);
  background:
    radial-gradient(circle 5px at 50% 9px, var(--color-accent-bright) 60%, transparent 66%) 0 0 / 36px 18px repeat-x,
    radial-gradient(circle 9px at 50% 9px, color-mix(in srgb, var(--color-accent) 45%, transparent), transparent 70%) 0 0 / 36px 18px repeat-x;
  animation: chl-chase 1.6s steps(2) infinite;
}
@keyframes chl-chase { to { background-position: 36px 0, 36px 0; } }

/* -- Checklist: 2x2 cut-corner cards beside a pull quote -- */
.chl-checks { background: var(--color-paper); }
.chl-checks .grid-asymmetric--reverse { align-items: start; gap: clamp(2rem, 5vw, 4rem); }
.chl-check-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-md); counter-reset: chk; }
.chl-check {
  counter-increment: chk;
  position: relative;
  display: grid;
  gap: var(--space-xs);
  padding: var(--space-lg) var(--space-lg) var(--space-xl);
  background: var(--color-surface);
  border: 1px solid var(--color-line);
  clip-path: polygon(0 0, calc(100% - 26px) 0, 100% 26px, 100% 100%, 0 100%);
  transition: background var(--transition), transform var(--transition);
}
.chl-check::after { content: counter(chk, decimal-leading-zero); position: absolute; right: var(--space-md); bottom: var(--space-sm); font-family: var(--font-accent); font-size: 2.2rem; line-height: 1; color: var(--color-primary); opacity: .12; }
.chl-check:hover { background: var(--color-card-tint-1); transform: translateY(-2px); }
.chl-check svg { color: var(--color-secondary); }
.chl-check h3 { font-size: var(--fs-h3); margin: 0; }
.chl-check p { margin: 0; font-size: var(--font-size-sm); color: var(--color-ink-2); }
.chl-checks-copy { display: grid; gap: var(--space-md); }
.chl-checks-copy .pull-quote { max-width: 18ch; margin: var(--space-sm) 0 0; }

/* -- Expert band: big number + three differentiator columns (white) -- */
.chl-expert { background: var(--color-surface); }
.chl-expert .section-head { max-width: 66ch; }
.chl-expert-row { display: grid; grid-template-columns: minmax(200px, .6fr) repeat(3, minmax(0, 1fr)); gap: var(--space-lg); align-items: stretch; }
.chl-expert-stat { display: grid; align-content: center; gap: var(--space-xs); padding: var(--space-lg); border-radius: var(--radius-lg); background: var(--color-card-tint-3); border: 1px solid color-mix(in srgb, var(--color-accent) 30%, var(--color-line)); }
.chl-expert-stat .big-number { font-size: clamp(3.5rem, 2.5rem + 3vw, 5.5rem); color: var(--color-accent-dark); }
.chl-expert-stat span { font-size: var(--font-size-sm); color: var(--color-ink-2); }
.chl-diff { display: grid; gap: var(--space-xs); align-content: start; padding: var(--space-lg); border-top: 3px solid var(--color-primary); background: var(--color-paper); border-radius: 0 0 var(--radius-lg) var(--radius-lg); }
.chl-diff:nth-child(3) { border-top-color: var(--color-secondary); }
.chl-diff:nth-child(4) { border-top-color: var(--color-accent); }
.chl-diff h3 { font-size: var(--font-size-base); margin: 0; }
.chl-diff p { margin: 0; font-size: var(--font-size-sm); color: var(--color-ink-2); }

/* -- Breakdown: dark parallelogram band with the home-vs-business table -- */
.chl-diffs .chl-diffs-head { max-width: 62ch; display: grid; gap: var(--space-sm); margin-bottom: var(--space-xl); }
.chl-diffs .answer-block { background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.chl-table-wrap { overflow-x: auto; border-radius: var(--radius-lg); background: color-mix(in srgb, var(--color-white) 5%, transparent); border: 1px solid color-mix(in srgb, var(--color-white) 12%, transparent); }
.chl-table { width: 100%; min-width: 660px; border-collapse: collapse; font-size: var(--font-size-sm); }
.chl-table caption { text-align: left; padding: var(--space-md) var(--space-lg) 0; font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .12em; text-transform: uppercase; color: var(--color-accent-bright); }
.chl-table th, .chl-table td { text-align: left; vertical-align: top; padding: var(--space-md) var(--space-lg); border-bottom: 1px solid color-mix(in srgb, var(--color-white) 10%, transparent); }
.chl-table thead th { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .1em; text-transform: uppercase; color: color-mix(in srgb, var(--color-white) 66%, transparent); }
.chl-table thead th:last-child { color: var(--color-accent-bright); }
.chl-table tbody th { font-family: var(--font-heading); color: var(--color-white); width: 20%; }
.chl-table td { color: color-mix(in srgb, var(--color-white) 76%, transparent); }
.chl-table td:last-child { color: var(--color-white); background: color-mix(in srgb, var(--color-accent) 8%, transparent); }
.chl-table tbody tr:last-child > * { border-bottom: 0; }

/* -- Process: horizontal stepper with a connecting rail (paper) -- */
.chl-process { background: var(--color-paper); }
.chl-process .section-head { max-width: 62ch; }
.chl-stepper { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: var(--space-lg); margin: 0; padding: 0; list-style: none; counter-reset: stp; position: relative; }
.chl-stepper::before { content: ""; position: absolute; top: 22px; left: 22px; right: 22px; height: 2px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); z-index: 0; }
.chl-stepper li { counter-increment: stp; position: relative; z-index: 1; display: grid; gap: var(--space-xs); align-content: start; }
.chl-stepper li::before { content: counter(stp); width: 46px; height: 46px; display: grid; place-items: center; border-radius: var(--radius-full); font-family: var(--font-accent); font-size: 1.25rem; color: var(--color-white); background: var(--color-primary); box-shadow: 0 0 0 6px var(--color-paper); }
.chl-stepper li:nth-child(even)::before { background: var(--color-secondary); }
.chl-stepper li:last-child::before { background: var(--color-accent); color: var(--color-ink); }
.chl-stepper h3 { font-size: var(--font-size-base); margin: var(--space-xs) 0 0; }
.chl-stepper p { margin: 0; font-size: var(--font-size-sm); color: var(--color-ink-2); }

/* -- Reviews -- */
.chl-reviews { background: var(--color-paper-2); }

/* -- Compare: staff vs Coastal Trim (white, torn top) -- */
.chl-compare { background: var(--color-surface); }
.chl-compare .section-head { max-width: 64ch; }
.chl-compare-scroll { overflow-x: auto; }
.chl-compare-table { width: 100%; min-width: 560px; border-collapse: separate; border-spacing: var(--space-xs) 0; font-size: var(--font-size-sm); }
.chl-compare-table th, .chl-compare-table td { padding: var(--space-md); text-align: left; vertical-align: top; }
.chl-compare-table thead th { font-family: var(--font-heading); font-size: var(--font-size-base); border-radius: var(--radius-lg) var(--radius-lg) 0 0; background: var(--color-paper-2); }
.chl-compare-table thead th:last-child { background: var(--color-accent); color: var(--color-ink); }
.chl-compare-table tbody th { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .12em; text-transform: uppercase; color: var(--color-muted); width: 16%; }
.chl-compare-table td { background: var(--color-paper); border-bottom: 1px solid var(--color-line); color: var(--color-ink-2); }
.chl-compare-table td:last-child { background: var(--color-card-tint-3); color: var(--color-ink); font-weight: 600; }
.chl-compare-table td:last-child svg { color: var(--color-primary); vertical-align: -3px; margin-right: var(--space-xs); }
.chl-compare-note { margin: var(--space-lg) 0 0; max-width: var(--measure); color: var(--color-ink-2); }

/* -- FAQ: single column with a side label -- */
.chl-faq { background: var(--color-paper); }
.chl-faq .chl-faq-grid { display: grid; grid-template-columns: minmax(0, .8fr) minmax(0, 1.2fr); gap: clamp(2rem, 5vw, 4rem); align-items: start; }
.chl-faq .faq[open] summary { color: var(--color-primary); }
.chl-faq .chl-updated { margin: var(--space-md) 0 0; font-size: var(--font-size-sm); color: var(--color-muted); }

/* -- Related services -- */
.chl-related { background: var(--color-paper-2); }
.chl-related .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-lg); max-width: 880px; }
.chl-related .service-card-with-image { border: 1px solid color-mix(in srgb, var(--color-secondary) 16%, var(--color-line)); }
.chl-related .service-card__body { padding: var(--space-xl) var(--space-lg) var(--space-lg); }
.chl-related .service-card__icon { margin-top: 0; width: 56px; height: 56px; border-radius: var(--radius-full); background: var(--color-surface); color: var(--color-secondary); box-shadow: var(--shadow); transition: transform var(--transition-slow); }
.chl-related .service-card-with-image:hover .service-card__icon { transform: translateY(-4px); }

/* -- Closing CTA: split, phone card on the right -- */
.chl-cta .container { grid-template-columns: minmax(0, 1.3fr) minmax(260px, .7fr); }
.chl-cta .chl-cta-copy { display: grid; gap: var(--space-sm); }
.chl-cta h2 { margin: 0; }
.chl-cta .answer-block { margin: 0; background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.chl-cta .chl-cta-card { display: grid; gap: var(--space-sm); padding: var(--space-lg); border-radius: var(--radius-lg); background: color-mix(in srgb, var(--color-white) 8%, transparent); border: 1px solid color-mix(in srgb, var(--color-white) 18%, transparent); backdrop-filter: blur(8px); }
.chl-cta .chl-cta-card .chl-cta-phone { font-family: var(--font-accent); font-size: 2rem; line-height: 1; color: var(--color-accent-bright); text-decoration: none; }
.chl-cta .chl-cta-card span { font-size: var(--font-size-sm); color: color-mix(in srgb, var(--color-white) 75%, transparent); }
.chl-cta .chl-hub-link { color: var(--color-accent-bright); }
.chl-cta .floating-ring { bottom: -130px; left: -110px; border-color: var(--color-secondary); }

/* -- Responsive -- */
@media (max-width: 1100px) {
  .chl-expert-row { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 1000px) {
  .chl-checks .grid-asymmetric--reverse, .chl-faq .chl-faq-grid, .chl-cta .container { grid-template-columns: 1fr; }
  .chl-checks-copy { order: -1; }
  .chl-stepper { grid-template-columns: repeat(2, minmax(0, 1fr)); row-gap: var(--space-xl); }
  .chl-stepper::before { display: none; }
}
@media (max-width: 640px) {
  .chl-check-grid, .chl-expert-row, .chl-stepper, .chl-related .services-grid { grid-template-columns: 1fr; }
  section.chl-hero { padding-bottom: calc(var(--space-12) + var(--space-6)); }
}
@media (prefers-reduced-motion: reduce) {
  .chl-marquee { animation: none; }
}

/* -- Breadcrumb row alignment + compact hero answer on phones -- */
.chl-hero .breadcrumb li { display: inline-flex; align-items: center; min-height: 44px; }
@media (max-width: 640px) {
  .chl-hero .hero-answer { font-size: var(--font-size-base); }
}
.chl-page .pull-quote::after { content: "\201D"; color: var(--color-accent-dark); }
.chl-checks .grid-asymmetric--reverse { grid-template-columns: minmax(0, 1.3fr) minmax(0, .9fr); }
@media (max-width: 1000px) { .chl-checks .grid-asymmetric--reverse { grid-template-columns: 1fr; } }
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>

<div class="chl-page">
<article class="chl-article" aria-labelledby="chl-title">

  <!-- 1. HERO — teal band, copy | form card, bulb marquee along the bottom edge -->
  <section class="hero hero--interior chl-hero">
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
          <span class="eyebrow">North County San Diego · Businesses</span>
          <h1 class="hero-title" id="chl-title">Commercial <span class="text-accent">holiday lighting</span> in San Marcos, CA</h1>
          <p class="hero-answer">Coastal Trim Lighting puts up holiday lighting on businesses and commercial properties in San Marcos and the surrounding North County San Diego area. Owners and property managers send the site address, what they want lit and any landlord or association rules, then get install dates and a quote for that property.</p>
          <div class="hero-actions">
            <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
            <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
          </div>
          <ul class="hero-chips">
            <li><?php echo icon('building-2', 16); ?> Commercial properties</li>
            <li><?php echo icon('clipboard-check', 16); ?> Quoted per site</li>
            <li><?php echo icon('map-pin', 16); ?> ~<?php echo (int) $targetRadiusMiles; ?>-mile service area</li>
          </ul>
        </div>
        <?php echo p1_hero_form_card('hero', $thisService['name'], 'Need a quote for your property?', 'Send the site address and what you want lit.'); ?>
      </div>
    </div>
    <div class="chl-marquee" aria-hidden="true"></div>
  </section>

  <!-- 2. PROBLEM — four things to settle before install + pull quote -->
  <section class="section chl-checks" aria-labelledby="chl-checks-title">
    <div class="container-wide">
      <div class="grid-asymmetric--reverse grid-asymmetric">
        <div class="chl-check-grid">
          <?php foreach ($chlChecks as $chlI => $chlCheck): ?>
          <div class="chl-check reveal-<?php echo $chlI < 2 ? 'down' : 'up'; ?> reveal-delay-<?php echo ($chlI % 3) + 1; ?>">
            <?php echo icon($chlCheck['icon'], 26); ?>
            <h3><?php echo e($chlCheck['title']); ?></h3>
            <p><?php echo e($chlCheck['text']); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="chl-checks-copy reveal-right">
          <span class="eyebrow-label">Before the ladders go up</span>
          <h2 id="chl-checks-title">What does a property manager need to settle before <span class="text-accent">holiday lights</span> go up?</h2>
          <p class="answer-block">Four things: who approves the display, where the power is, when work can happen, and what vendor paperwork the site needs. Coastal Trim Lighting asks for those up front, because a commercial quote is only as good as the answers behind it.</p>
          <p class="pull-quote">The lights are the easy part. The sign-off is the schedule.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. EXPERT POSITIONING — big number + three differentiators -->
  <section class="section chl-expert edge-curve-top" aria-labelledby="chl-expert-title">
    <div class="container-wide">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Homes and businesses</span>
        <h2 id="chl-expert-title">Does Coastal Trim Lighting light <span class="text-accent">commercial properties</span> as well as homes?</h2>
        <p class="answer-block">Yes. Coastal Trim Lighting, in business in San Marcos since <?php echo (int) $yearEstablished; ?>, puts up holiday lighting on businesses and commercial properties as well as houses, and installs permanent landscape and outdoor lighting for both. Jobs are taken within about <?php echo (int) $targetRadiusMiles; ?> miles of the company's base on <?php echo e($address['street']); ?>.</p>
      </div>
      <div class="chl-expert-row">
        <div class="chl-expert-stat reveal-scale">
          <span class="big-number">~<?php echo (int) $targetRadiusMiles; ?></span>
          <span>miles around San Marcos, covering much of North County San Diego</span>
        </div>
        <div class="chl-diff reveal-up reveal-delay-1">
          <?php echo icon('users', 22); ?>
          <h3>A named, local owner</h3>
          <p>Coastal Trim Lighting is owned by <?php echo e($ownerName); ?>, so a property manager knows exactly which local company is on the site.</p>
        </div>
        <div class="chl-diff reveal-up reveal-delay-2">
          <?php echo icon('sun', 22); ?>
          <h3>Seasonal and year-round lighting</h3>
          <p>The holiday display and the <a href="<?php echo e(serviceUrl(['slug' => 'landscape-lighting'])); ?>">permanent landscape lighting for entries and grounds</a> can come from the same company.</p>
        </div>
        <div class="chl-diff reveal-up reveal-delay-3">
          <?php echo icon('clipboard-check', 22); ?>
          <h3>A quote for this site</h3>
          <p>No packages. The quote follows the frontage, the trees and the shared areas you list for the property.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 4a. SERVICE BREAKDOWN — how a commercial job differs from a house (dark band, table) -->
  <section class="section chl-diffs texture-grain edge-parallelogram-top" aria-labelledby="chl-diffs-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container">
      <div class="chl-diffs-head reveal-left">
        <span class="eyebrow-label">What changes on a commercial job</span>
        <h2 id="chl-diffs-title">How is <span class="text-accent">commercial holiday lighting</span> different from lighting a house?</h2>
        <p class="answer-block">A commercial job has more people to sign off, power someone else may control, and a tighter window for safe work around customers and tenants. The lights themselves are similar; the planning around them is where a commercial quote differs from a residential one.</p>
      </div>
      <div class="chl-table-wrap reveal-up" tabindex="0" role="region" aria-labelledby="chl-diffs-caption">
        <table class="chl-table">
          <caption id="chl-diffs-caption">Residential vs commercial holiday lighting</caption>
          <thead>
            <tr><th scope="col">Item</th><th scope="col">A house</th><th scope="col">A commercial property</th></tr>
          </thead>
          <tbody>
            <?php foreach ($chlDiff as $chlRow): ?>
            <tr>
              <th scope="row"><?php echo e($chlRow['row']); ?></th>
              <td><?php echo e($chlRow['home']); ?></td>
              <td><?php echo e($chlRow['biz']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- 4b. PROCESS — horizontal stepper -->
  <section class="section chl-process" aria-labelledby="chl-process-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">From request to lit</span>
        <h2 id="chl-process-title">What are the steps to get a <span class="text-accent">business</span> lit for the holidays?</h2>
        <p class="answer-block">There are four steps: send the site details, name who approves the work, review the quote and install dates Coastal Trim Lighting sends back, then the lights go up on the agreed date. Nothing goes up until the quote is agreed.</p>
      </div>
      <ol class="chl-stepper">
        <li class="reveal-left reveal-delay-1"><h3>Send the site details</h3><p>Address, property type, what you want lit, and the date you need it lit by. Call <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a> or use the form.</p></li>
        <li class="reveal-left reveal-delay-2"><h3>Name the decision-maker</h3><p>Who approves the display, plus any landlord, tenant or association rules for the building.</p></li>
        <li class="reveal-left reveal-delay-3"><h3>Get the quote and dates</h3><p>Coastal Trim Lighting follows up with a quote for the property and the install dates still open.</p></li>
        <li class="reveal-left reveal-delay-4"><h3>Lights go up</h3><p>Installed on the agreed date, and the property is lit through the season.</p></li>
      </ol>
    </div>
  </section>

  <!-- 5. PROOF — Google reviews feed (renders nothing until reviews exist) -->
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
  $chlReviews = p1_google_reviews($slug, ['heading' => 'What do North County customers say about Coastal Trim Lighting on Google?']);
  if ($chlReviews !== ''): ?>
  <section class="section chl-reviews" aria-label="Google reviews"><div class="container-narrow"><?php echo $chlReviews; ?></div></section>
  <?php endif; ?>

  <!-- 6. COMPARISON — staff hanging the lights vs hiring Coastal Trim Lighting -->
  <section class="section chl-compare edge-torn-top" aria-labelledby="chl-compare-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">In-house or hired</span>
        <h2 id="chl-compare-title">Should your own staff hang the <span class="text-accent">holiday lights</span>, or should you hire it out?</h2>
        <p class="answer-block">Hiring Coastal Trim Lighting keeps employees off ladders and on their usual work, and turns an open-ended staff project into one quoted price. A small storefront with a single strand at eye level can stay in-house; rooflines and tall trees are a different job.</p>
      </div>
      <div class="chl-compare-scroll reveal-up" tabindex="0" role="region" aria-labelledby="chl-compare-title">
        <table class="chl-compare-table">
          <thead>
            <tr><td></td><th scope="col">Your staff does it</th><th scope="col">Coastal Trim Lighting does it</th></tr>
          </thead>
          <tbody>
            <?php foreach ($chlCompare as $chlCmp): ?>
            <tr>
              <th scope="row"><?php echo e($chlCmp['row']); ?></th>
              <td><?php echo e($chlCmp['staff']); ?></td>
              <td><?php echo icon('check-circle', 16); ?><?php echo e($chlCmp['ctl']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <p class="chl-compare-note reveal-up">Own a house as well as the business? The <a href="<?php echo e(serviceUrl(['slug' => 'residential-holiday-lighting'])); ?>">residential holiday lighting page</a> covers what to send for a home quote.</p>
    </div>
  </section>

  <!-- 7. FAQ — real questions only, visible text -->
  <section class="section chl-faq" aria-labelledby="chl-faq-title">
    <div class="container">
      <div class="chl-faq-grid">
        <div class="section-head reveal-left">
          <span class="eyebrow-label">Questions</span>
          <h2 id="chl-faq-title">What do businesses ask before booking <span class="text-accent">commercial holiday lighting</span>?</h2>
          <p class="answer-block">Business owners and property managers want to know how Coastal Trim Lighting prices a commercial property and how early to get on the install calendar. Both answers depend on the property itself and on how quickly the approvals come through.</p>
          <p class="chl-updated">Last updated: <?php echo date('F Y'); ?></p>
        </div>
        <div>
          <?php foreach ($chlFaqs as $chlFaqI => $chlFaq): ?>
          <details class="faq reveal-right reveal-delay-<?php echo $chlFaqI + 1; ?>" open>
            <summary><?php echo e($chlFaq['q']); ?></summary>
            <p class="faq-answer"><?php echo e($chlFaq['a']); ?></p>
          </details>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

</article>

  <!-- RELATED SERVICES -->
  <section class="section chl-related" aria-label="Other lighting services">
    <div class="container">
      <div class="section-title reveal-up">
        <span class="eyebrow-label">What We Do</span>
        <h2>What else can <span class="text-accent">Coastal Trim Lighting</span> light for you?</h2>
        <p class="hero-answer">Besides commercial holiday lighting, Coastal Trim Lighting puts up holiday lights on San Marcos houses and installs permanent landscape and outdoor lighting for entries, paths and trees at homes and businesses. See every option on the <a href="/services/">full list of lighting services</a>.</p>
      </div>
      <div class="services-grid">
        <?php
        $chlTint = 1;
        foreach ($services as $chlRel):
            if ($chlRel['slug'] === $pageSvcSlug || !isset($chlRelatedCards[$chlRel['slug']])) continue;
            $chlCard = $chlRelatedCards[$chlRel['slug']];
            $chlTint = ($chlTint % 3) + 1;
        ?>
        <article class="service-card-with-image card-tint-<?php echo $chlTint; ?> reveal-up reveal-delay-<?php echo $chlTint; ?>">
          <div class="service-card__body">
            <div class="service-card__icon"><?php echo icon($chlCard['icon'], 26); ?></div>
            <h3><?php echo e($chlRel['name']); ?></h3>
            <p class="service-card__desc"><?php echo e($chlCard['desc']); ?></p>
            <ul>
              <?php foreach ($chlCard['bullets'] as $chlBullet): ?>
              <li><?php echo e($chlBullet); ?></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?php echo e(serviceUrl($chlRel)); ?>" class="service-card__cta" aria-label="Learn more about <?php echo e($chlRel['name']); ?>">Learn more</a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 8. FINAL CTA — split with a phone card -->
  <section class="section closing-cta texture-grain slant-top chl-cta" aria-labelledby="chl-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate" aria-hidden="true"></span>
    <div class="container">
      <div class="chl-cta-copy reveal-left">
        <span class="eyebrow-label">This holiday season</span>
        <h2 id="chl-cta-title">Want your property lit before the <span class="text-accent">holiday rush</span>?</h2>
        <p class="answer-block">Send Coastal Trim Lighting the site address, what you want lit and who approves it. You get a quote for the property and the open install dates, so the approval, the budget and the install schedule can all move forward together.</p>
        <div class="actions">
          <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        </div>
      </div>
      <div class="chl-cta-card reveal-right">
        <span>Prefer to talk it through?</span>
        <a class="chl-cta-phone" href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a>
        <span><?php echo e($siteName); ?>, <?php echo e($address['street']); ?>, <?php echo e(cityStateLine(true)); ?></span>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
