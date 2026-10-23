<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * About — Phase 5 (archetype: warm-human).
 * IMAGE STATE: build-plan.json holds the logo only — there is no image manifest
 * and no client job photo on disk, so the story split uses the real logo badge
 * (same treatment as the homepage about frame). Swap in a photo of the owner or
 * a lit job when the client uploads them (logged in /content-confirmations.json).
 * Claims: every fact traces to build-plan.json / config.php (owner, 2016,
 * address, services, ~25-mile radius). No licence, insurance, team size,
 * awards or dated milestones beyond the founding year — none were supplied.
 * Credentials render only from config ($licenseLabel); none exist yet.
 * ------------------------------------------------------------------------- */
$pageTitle       = 'About Coastal Trim Lighting | San Marcos, CA Since 2016';
$pageDescription = 'Coastal Trim Lighting is a San Marcos, CA lighting company owned by Jacob Akbari since 2016: holiday lighting for homes and businesses plus landscape lighting.';
$canonicalUrl    = $siteUrl . '/about/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'about';
$pageType        = 'about';
$heroPreloadImage = '';

$schemaMarkup = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => 'AboutPage',
            '@id'         => $canonicalUrl . '#webpage',
            'url'         => $canonicalUrl,
            'name'        => $pageTitle,
            'description' => $pageDescription,
            'isPartOf'    => ['@type' => 'WebSite', 'url' => $siteUrl . '/'],
            'about'       => ['@id' => $siteUrl . '/#organization'],
            'breadcrumb'  => ['@id' => $canonicalUrl . '#breadcrumb'],
        ],
        ['@id' => $canonicalUrl . '#breadcrumb'] + array_diff_key(generateBreadcrumbSchema([['name' => 'About', 'url' => '/about/']]), ['@context' => 1]),
    ],
];

/* What working with the company looks like — facts only (services, pricing per property, base, property types). */
$abValues = [
    ['icon' => 'sparkles', 'title' => 'Holiday and year-round lighting',
     'text' => 'Coastal Trim Lighting puts up seasonal holiday lighting and installs permanent landscape and outdoor lighting, so one company can handle both on the same property.'],
    ['icon' => 'clipboard-list', 'title' => 'Priced for your property',
     'text' => 'There are no flat packages. Each job is priced for the address, the parts you want lit and the date, and you see the price before anything goes up.'],
    ['icon' => 'map-pin', 'title' => 'Based in San Marcos',
     'text' => 'The company works from Topanga Drive in San Marcos and takes jobs in nearby North County San Diego towns within about 25 miles.'],
    ['icon' => 'building-2', 'title' => 'Homes and businesses',
     'text' => 'Houses, businesses and commercial properties are all on the list. Tell us the property type when you get in touch so the follow-up covers the right service.'],
];

/* Milestones — only the founding year is dated in intake; the rest are the services, undated on purpose. */
$abMilestones = [
    ['mark' => (string) $yearEstablished, 'title' => 'Opens in San Marcos',
     'text' => 'Coastal Trim Lighting opens for business in San Marcos, California.'],
    ['mark' => 'Homes', 'title' => 'Holiday lights on houses',
     'text' => 'Rooflines, trees and walkways on San Marcos homes, lit for the holiday season.'],
    ['mark' => 'Business', 'title' => 'Commercial holiday lighting',
     'text' => 'Holiday displays for businesses and commercial properties across North County.'],
    ['mark' => 'All year', 'title' => 'Landscape and outdoor lighting',
     'text' => 'Permanent fixtures for paths, trees, entries and patios that stay up all year.'],
    ['mark' => date('Y'), 'title' => $yearsInBusiness . ' years in business',
     'text' => 'Owned by ' . $ownerName . ' and based on ' . $address['street'] . ' in San Marcos.'],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   About — warm-human. Prefix .ab-. Tokens only.
   Signature: string-light milestone line (bulbs as timeline markers).
   =================================================================== */
.ab-page h1, .ab-page h2, .ab-page h3 { text-wrap: balance; }
.ab-page p { text-wrap: pretty; }

/* -- Hero: night band, warm glow (::before), grain (::after), string-light garland -- */
section.ab-hero { padding-bottom: calc(var(--space-12) + var(--space-4)); }
.ab-hero {
  background:
    radial-gradient(55% 70% at 85% 0%, color-mix(in srgb, var(--color-secondary) 38%, transparent), transparent 70%),
    linear-gradient(160deg, var(--color-dark) 0%, var(--color-dark-alt) 65%, var(--color-primary-deep) 100%);
}
.ab-hero::before {
  content: "";
  position: absolute;
  inset: auto 0 0 0;
  height: 45%;
  z-index: -1;
  background: radial-gradient(60% 100% at 20% 100%, color-mix(in srgb, var(--color-accent) 20%, transparent), transparent 70%);
  pointer-events: none;
}
.ab-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .45;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.ab-garland { position: absolute; left: 0; right: 0; bottom: var(--space-lg); height: 64px; z-index: -1; pointer-events: none; }
.ab-garland svg { width: 100%; height: 100%; }
.ab-garland path { fill: none; stroke: color-mix(in srgb, var(--color-white) 22%, transparent); stroke-width: 1.5; }
.ab-garland circle { fill: var(--color-accent-bright); filter: drop-shadow(0 0 6px var(--color-accent)); animation: ab-twinkle 3.2s ease-in-out infinite alternate; }
.ab-garland circle:nth-of-type(3n+2) { fill: var(--color-secondary); filter: drop-shadow(0 0 6px var(--color-secondary)); animation-delay: -1.1s; }
.ab-garland circle:nth-of-type(3n) { fill: color-mix(in srgb, var(--color-accent) 70%, var(--color-danger)); animation-delay: -2.2s; }
@keyframes ab-twinkle { from { opacity: .55; } to { opacity: 1; } }
.ab-hero .hero-copy { max-width: 44rem; }
.ab-hero .hero-title { max-width: 24ch; }
.ab-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.ab-hero .hero-answer { max-width: 40rem; }
.ab-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.ab-hero .breadcrumb a:hover { color: var(--color-accent-bright); }
.ab-hero .breadcrumb [aria-current] { color: var(--color-white); }
.ab-hero .hero-chips li { background: color-mix(in srgb, var(--color-white) 7%, transparent); border-color: color-mix(in srgb, var(--color-accent) 35%, transparent); color: var(--color-white); }
.ab-hero .hero-chips svg { color: var(--color-accent-bright); }
.ab-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.ab-hero .link-call svg { color: var(--color-accent-bright); }

/* -- Story: asymmetric split, offset badge frame -- */
.ab-story { background: var(--color-paper); }
.ab-story-grid { display: grid; grid-template-columns: minmax(0, 1.45fr) minmax(0, 1fr); gap: clamp(2rem, 6vw, 5rem); align-items: start; }
.ab-story-copy { display: grid; gap: var(--space-md); }
.ab-story-copy > p { margin: 0; max-width: var(--measure); color: var(--color-ink-2); }
.ab-story-copy .lead { color: var(--color-ink); }
.ab-story-copy .answer-block { margin: 0; }
.ab-story-copy .pull-quote { margin: var(--space-md) 0 0; max-width: 26ch; }
.ab-figure { position: relative; margin: var(--space-3xl) 0 0; }
.ab-figure::before {
  content: "";
  position: absolute;
  inset: calc(-1 * var(--space-lg)) calc(-1 * var(--space-lg)) var(--space-lg) var(--space-lg);
  z-index: 0;
  border: 2px solid color-mix(in srgb, var(--color-accent) 55%, transparent);
  border-radius: var(--radius-xl);
}
.ab-badge {
  position: relative;
  z-index: 1;
  aspect-ratio: 4 / 4.4;
  display: grid;
  place-items: center;
  padding: var(--space-xl);
  border-radius: var(--radius-xl);
  overflow: hidden;
  clip-path: polygon(0 0, 100% 0, 100% 90%, 88% 100%, 0 100%);
  background:
    radial-gradient(60% 50% at 50% 45%, color-mix(in srgb, var(--color-accent) 30%, transparent), transparent 70%),
    linear-gradient(160deg, var(--color-dark) 0%, var(--color-dark-alt) 60%, var(--color-primary-deep) 100%);
  box-shadow: var(--shadow-lg);
}
.ab-badge picture, .ab-badge img { width: min(100%, 320px); height: auto; }
.ab-badge img { filter: drop-shadow(0 12px 28px color-mix(in srgb, var(--color-black) 45%, transparent)); transition: transform var(--transition-slow); }
.ab-figure:hover .ab-badge img { transform: scale(1.03) rotate(-2deg); }
.ab-figure figcaption { position: relative; z-index: 1; margin-top: var(--space-md); font-size: var(--font-size-sm); color: var(--color-muted); }
.ab-since { position: absolute; z-index: 2; left: calc(-1 * var(--space-lg)); bottom: var(--space-3xl); display: grid; gap: var(--space-1); padding: var(--space-sm) var(--space-md); background: var(--color-surface); border-left: 4px solid var(--color-accent); border-radius: var(--radius); box-shadow: var(--shadow); }
.ab-since b { font-family: var(--font-accent); font-size: 2rem; line-height: 1; color: var(--color-primary); }
.ab-since span { font-size: var(--font-size-sm); color: var(--color-muted); }

/* -- Values + owner (white, curved top) -- */
.ab-values { background: var(--color-surface); }
.ab-values-grid { display: grid; grid-template-columns: minmax(0, 2fr) minmax(0, 1fr); gap: var(--space-xl); align-items: start; }
.ab-value-list { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-lg); margin: 0; padding: 0; list-style: none; }
.ab-value { display: grid; gap: var(--space-xs); align-content: start; padding: var(--space-lg); border-radius: var(--radius-lg); border: 1px solid var(--color-line); box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition); }
.ab-value:hover { transform: translateY(-4px); box-shadow: var(--shadow); }
.ab-value:nth-child(4n+1) { background: var(--color-card-tint-1); }
.ab-value:nth-child(4n+2) { background: var(--color-card-tint-3); }
.ab-value:nth-child(4n+3) { background: var(--color-card-tint-2); }
.ab-value:nth-child(4n) { background: var(--color-card-tint-neutral); }
.ab-value-icon { width: 48px; height: 48px; display: grid; place-items: center; border-radius: var(--radius-lg) var(--radius-lg) var(--radius-lg) var(--radius-sm); background: var(--color-surface); color: var(--color-accent-dark); box-shadow: var(--shadow-sm); }
.ab-value h3 { margin: 0; font-size: var(--fs-h3); color: var(--color-primary); }
.ab-value p { margin: 0; font-size: var(--font-size-sm); color: var(--color-ink-2); }
.ab-owner { position: sticky; top: calc(var(--nav-height) + var(--space-lg)); display: grid; gap: var(--space-sm); padding: var(--space-xl) var(--space-lg); border-radius: var(--radius-xl); color: var(--color-white); background: linear-gradient(160deg, var(--color-primary) 0%, var(--color-primary-deep) 100%); box-shadow: var(--shadow-lg); overflow: hidden; isolation: isolate; }
.ab-owner::after { content: ""; position: absolute; right: calc(-1 * var(--space-2xl)); top: calc(-1 * var(--space-2xl)); width: 180px; height: 180px; z-index: -1; border-radius: var(--radius-full); background: radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 35%, transparent), transparent); }
.ab-monogram { width: 72px; height: 72px; display: grid; place-items: center; border-radius: var(--radius-full); font-family: var(--font-heading); font-weight: 800; font-size: 1.5rem; color: var(--color-ink); background: var(--color-accent); box-shadow: 0 0 0 6px color-mix(in srgb, var(--color-white) 14%, transparent); }
.ab-owner h3 { margin: 0; color: var(--color-white); font-size: var(--fs-h3); }
.ab-owner .ab-role { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .14em; text-transform: uppercase; color: var(--color-accent-bright); }
.ab-owner p { margin: 0; font-size: var(--font-size-sm); color: color-mix(in srgb, var(--color-white) 85%, transparent); }
.ab-owner a { color: var(--color-white); font-weight: 600; }

/* -- Milestones: string-light line on a dark band (signature) -- */
.ab-history .section-head { max-width: 62ch; }
.ab-lights { position: relative; display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: var(--space-lg); margin: var(--space-xl) 0 0; padding: 0; list-style: none; }
.ab-lights::before { content: ""; position: absolute; left: 0; right: 0; top: 22px; height: 2px; background: repeating-linear-gradient(90deg, color-mix(in srgb, var(--color-white) 35%, transparent) 0 10px, transparent 10px 16px); }
.ab-light { position: relative; display: grid; gap: var(--space-xs); align-content: start; padding-top: var(--space-3xl); }
.ab-light::before { content: ""; position: absolute; top: 8px; left: 0; width: 18px; height: 26px; border-radius: 50% 50% 46% 46% / 40% 40% 60% 60%; background: var(--color-accent-bright); box-shadow: 0 0 18px 4px color-mix(in srgb, var(--color-accent) 55%, transparent); }
.ab-light::after { content: ""; position: absolute; top: 4px; left: 4px; width: 10px; height: 7px; border-radius: var(--radius-sm); background: color-mix(in srgb, var(--color-white) 45%, var(--color-ink)); }
.ab-light:nth-child(2)::before { background: var(--color-secondary); box-shadow: 0 0 18px 4px color-mix(in srgb, var(--color-secondary) 60%, transparent); }
.ab-light:nth-child(3)::before { background: color-mix(in srgb, var(--color-accent) 70%, var(--color-danger)); box-shadow: 0 0 18px 4px color-mix(in srgb, var(--color-accent) 40%, transparent); }
.ab-light:nth-child(4)::before { background: color-mix(in srgb, var(--color-secondary) 50%, var(--color-white)); box-shadow: 0 0 18px 4px color-mix(in srgb, var(--color-secondary) 45%, transparent); }
.ab-light-mark { font-family: var(--font-accent); font-size: 1.6rem; font-weight: 700; letter-spacing: .04em; line-height: 1; text-transform: uppercase; color: var(--color-accent-bright); }
.ab-light h3 { margin: 0; font-size: var(--font-size-base); color: var(--color-white); }
.ab-light p { margin: 0; font-size: var(--font-size-sm); }

/* -- Credentials / check us out (paper, wave top) -- */
.ab-creds { background: var(--color-paper); }
.ab-creds .section-head { max-width: 64ch; }
.ab-cred-list { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: var(--space-md); margin: 0; padding: 0; list-style: none; }
.ab-cred { display: grid; gap: var(--space-xs); align-content: start; padding: var(--space-lg); background: var(--color-surface); border: 1px solid var(--color-line); border-top: 3px solid var(--color-primary); border-radius: var(--radius); box-shadow: var(--shadow-sm); }
.ab-cred:nth-child(even) { border-top-color: var(--color-accent); }
.ab-cred svg { color: var(--color-primary); }
.ab-cred b { font-family: var(--font-heading); font-size: var(--font-size-base); color: var(--color-ink); }
.ab-cred span { font-size: var(--font-size-sm); color: var(--color-ink-2); }
.ab-cred a { color: var(--color-primary); font-weight: 600; font-size: var(--font-size-sm); }
.ab-reviews { background: var(--color-paper-2); }

/* -- Closing CTA -- */
.ab-cta .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.ab-cta h2 { margin: 0; }
.ab-cta .answer-block { margin: 0 auto; text-align: left; background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.ab-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.ab-cta .link-call { color: var(--color-white); }
.ab-cta .link-call svg { color: var(--color-accent-bright); }

/* -- Responsive -- */
@media (max-width: 1100px) {
  .ab-lights { grid-template-columns: repeat(3, minmax(0, 1fr)); row-gap: var(--space-xl); }
  .ab-lights::before { display: none; }
  .ab-cred-list { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 900px) {
  .ab-story-grid, .ab-values-grid { grid-template-columns: 1fr; }
  .ab-figure { margin: var(--space-lg) var(--space-lg) 0; max-width: 420px; }
  .ab-owner { position: relative; top: auto; }
}
@media (max-width: 640px) {
  .ab-value-list, .ab-cred-list, .ab-lights { grid-template-columns: 1fr; }
  .ab-lights { padding-left: var(--space-xl); border-left: 2px dashed color-mix(in srgb, var(--color-white) 30%, transparent); }
  .ab-light { padding-top: 0; }
  .ab-light::before { top: 0; left: calc(-1 * var(--space-xl) - 10px); }
  .ab-light::after { top: -4px; left: calc(-1 * var(--space-xl) - 6px); }
  .ab-since { left: calc(-1 * var(--space-sm)); }
  .ab-hero .hero-answer { font-size: var(--font-size-base); }
  .ab-garland { display: none; }
}
@media (prefers-reduced-motion: reduce) {
  .ab-garland circle { animation: none; }
}
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.php'; ?>

<div class="ab-page">

  <!-- 1. HERO — night band with a string-light garland -->
  <section class="hero hero--interior ab-hero" aria-labelledby="ab-title">
    <div class="ab-garland" aria-hidden="true">
      <svg viewBox="0 0 1200 64" preserveAspectRatio="none">
        <path d="M0 8 Q150 60 300 18 T600 18 T900 18 T1200 8"/>
        <circle cx="60" cy="27" r="5"/><circle cx="140" cy="38" r="5"/><circle cx="220" cy="33" r="5"/>
        <circle cx="360" cy="22" r="5"/><circle cx="450" cy="34" r="5"/><circle cx="540" cy="24" r="5"/>
        <circle cx="660" cy="22" r="5"/><circle cx="750" cy="34" r="5"/><circle cx="840" cy="24" r="5"/>
        <circle cx="960" cy="22" r="5"/><circle cx="1050" cy="32" r="5"/><circle cx="1140" cy="18" r="5"/>
      </svg>
    </div>
    <div class="container">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li aria-current="page">About</li>
          </ol>
        </nav>
        <span class="eyebrow"><?php echo e(cityStateLine()); ?> · Since <?php echo (int) $yearEstablished; ?></span>
        <h1 class="hero-title" id="ab-title">About <span class="text-accent">Coastal Trim Lighting</span> in San Marcos, CA</h1>
        <p class="hero-answer">Coastal Trim Lighting is a San Marcos lighting company, open since <?php echo (int) $yearEstablished; ?> and owned by <?php echo e($ownerName); ?>. It puts up holiday lighting on homes and businesses and installs year-round landscape lighting.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
          <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('calendar', 16); ?> Est. <?php echo (int) $yearEstablished; ?></li>
          <li><?php echo icon('users', 16); ?> Owner <?php echo e($ownerName); ?></li>
          <li><?php echo icon('map-pin', 16); ?> Based in <?php echo e($address['city']); ?></li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 2. STORY — asymmetric split, logo badge frame (no client photos yet) -->
  <section class="section ab-story" aria-labelledby="ab-story-title">
    <div class="container-wide">
      <div class="ab-story-grid">
        <div class="ab-story-copy reveal-left">
          <span class="eyebrow-label">Our story</span>
          <h2 id="ab-story-title">Who is <span class="text-accent">Coastal Trim Lighting</span>, and what does it do?</h2>
          <p class="answer-block">Coastal Trim Lighting is a lighting contractor based in San Marcos, California, open since <?php echo (int) $yearEstablished; ?> and owned by <?php echo e($ownerName); ?>. It puts up holiday lighting on houses and commercial properties and installs landscape and outdoor lighting that stays up all year, within about <?php echo (int) $targetRadiusMiles; ?> miles of San Marcos.</p>
          <p class="lead">Coastal Trim Lighting works from <?php echo e($address['street']); ?> in San Marcos. The homes and businesses it lights are in San Marcos and the North County San Diego towns around it.</p>
          <p>The work comes in two kinds. Holiday lighting is seasonal: lights go up on rooflines, trees and walkways so a house or a storefront is lit for the holidays. Landscape and outdoor lighting is permanent: fixtures along paths, under trees, at the entry and around the patio that come on every night of the year. Coastal Trim Lighting does both, which means a San Marcos property can get its December display and its everyday outdoor lighting from the same company.</p>
          <p>Every job starts with the property rather than a package. Tell Coastal Trim Lighting the address, whether it is a home or a business, what you want lit and when you need it. The company prices the job for that property and follows up by phone or email with open dates and a price, and nothing goes up until you agree to it.</p>
          <p class="pull-quote">Every job starts with the property, not a package.</p>
        </div>
        <figure class="ab-figure reveal-right">
          <div class="ab-badge">
            <picture>
              <source type="image/webp" srcset="/assets/images/logo-v1-192.webp 192w, /assets/images/logo-v1.webp 440w" sizes="(max-width: 900px) 70vw, 320px">
              <img src="/assets/images/logo-v1.png" srcset="/assets/images/logo-v1-192.png 192w, /assets/images/logo-v1.png 440w" sizes="(max-width: 900px) 70vw, 320px" alt="Coastal Trim Lighting badge: script lettering over a sunset coastline with palm trees, ringed by colored string lights" width="440" height="440" loading="lazy" decoding="async">
            </picture>
          </div>
          <div class="ab-since"><b><?php echo (int) $yearsInBusiness; ?> years</b><span>lighting <?php echo e($address['city']); ?> properties</span></div>
          <figcaption>The Coastal Trim Lighting badge: coastline, palms and a ring of string lights.</figcaption>
        </figure>
      </div>
    </div>
  </section>

  <!-- 3. CTA BAND — compact mid-page form (form id: cta-band) -->
  <?php echo p1_cta_band(
      'Get a price',
      'What would you like <span class="text-accent">lit</span> this year?',
      'Send the address and the service you need. Coastal Trim Lighting follows up with open dates and a price for your San Marcos home or business.'
  ); ?>

  <!-- 4. VALUES + OWNER — rotated tint cards, sticky owner card -->
  <section class="section ab-values edge-curve-top" aria-labelledby="ab-values-title">
    <div class="container-wide">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Working with us</span>
        <h2 id="ab-values-title">What can you expect when you hire <span class="text-accent">Coastal Trim Lighting</span>?</h2>
        <p class="answer-block">Coastal Trim Lighting handles holiday and year-round lighting from one San Marcos base, prices every job for the property it is on, and works on homes and businesses alike.</p>
      </div>
      <div class="ab-values-grid">
        <ul class="ab-value-list">
          <?php foreach ($abValues as $abI => $abValue): ?>
          <li class="ab-value reveal-<?php echo ['left', 'up', 'down', 'right'][$abI % 4]; ?> reveal-delay-<?php echo ($abI % 4) + 1; ?>">
            <span class="ab-value-icon"><?php echo icon($abValue['icon'], 24); ?></span>
            <h3><?php echo e($abValue['title']); ?></h3>
            <p><?php echo e($abValue['text']); ?></p>
          </li>
          <?php endforeach; ?>
        </ul>
        <aside class="ab-owner reveal-scale" aria-labelledby="ab-owner-name">
          <span class="ab-monogram" aria-hidden="true"><?php echo e(implode('', array_map(fn($w) => mb_substr($w, 0, 1), explode(' ', $ownerName)))); ?></span>
          <span class="ab-role">Owner</span>
          <h3 id="ab-owner-name"><?php echo e($ownerName); ?></h3>
          <p><?php echo e($ownerName); ?> owns Coastal Trim Lighting, a San Marcos business since <?php echo (int) $yearEstablished; ?>. Questions about a holiday display or a landscape lighting job go to the company directly.</p>
          <p><a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a><br><a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a></p>
        </aside>
      </div>
    </div>
  </section>

  <!-- 5. MILESTONES — string-light line (signature), dark slant band -->
  <section class="section ab-history texture-grain slant-top" aria-labelledby="ab-history-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container-wide">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Milestones</span>
        <h2 id="ab-history-title">What has <span class="text-accent">Coastal Trim Lighting</span> built since <?php echo (int) $yearEstablished; ?>?</h2>
        <p>Coastal Trim Lighting opened in San Marcos in <?php echo (int) $yearEstablished; ?> and now offers three lighting services: holiday lighting for homes, holiday lighting for businesses, and permanent landscape and outdoor lighting. <?php echo date('Y'); ?> marks <?php echo (int) $yearsInBusiness; ?> years in business.</p>
      </div>
      <ol class="ab-lights">
        <?php foreach ($abMilestones as $abMI => $abMs): ?>
        <li class="ab-light reveal-<?php echo $abMI % 2 ? 'down' : 'up'; ?> reveal-delay-<?php echo min($abMI + 1, 4); ?>">
          <span class="ab-light-mark"><?php echo e($abMs['mark']); ?></span>
          <h3><?php echo e($abMs['title']); ?></h3>
          <p><?php echo e($abMs['text']); ?></p>
        </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <!-- 6. CREDENTIALS — verifiable facts only; licence card renders when config supplies one -->
  <section class="section ab-creds edge-wave-top" aria-labelledby="ab-creds-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Check us out</span>
        <h2 id="ab-creds-title">How can you check out <span class="text-accent">Coastal Trim Lighting</span> before you hire?</h2>
        <p class="answer-block">Coastal Trim Lighting has a public Google Business Profile, a published San Marcos business address, and a named owner, and it has been in business since <?php echo (int) $yearEstablished; ?>. Each of those can be checked before you book.</p>
      </div>
      <ul class="ab-cred-list">
        <li class="ab-cred reveal-up reveal-delay-1"><?php echo icon('globe', 24); ?><b>Google Business Profile</b><span>Coastal Trim Lighting's listing on Google, with location and contact details.</span><a href="<?php echo e($gbpMapsUrl); ?>" target="_blank" rel="noopener">View the listing</a></li>
        <li class="ab-cred reveal-up reveal-delay-2"><?php echo icon('map-pin', 24); ?><b>Business address</b><span><?php echo e($address['street']); ?>, <?php echo e(cityStateLine(true)); ?></span><a href="<?php echo e($directionsUrl); ?>" target="_blank" rel="noopener">Get directions</a></li>
        <li class="ab-cred reveal-up reveal-delay-3"><?php echo icon('calendar-check', 24); ?><b>In business since <?php echo (int) $yearEstablished; ?></b><span><?php echo (int) $yearsInBusiness; ?> years of lighting work in and around <?php echo e($address['city']); ?>.</span></li>
        <?php if (!empty($licenseLabel)): ?>
        <li class="ab-cred reveal-up reveal-delay-4"><?php echo icon('badge-check', 24); ?><b>Licensed</b><span><?php echo e($licenseLabel); ?></span></li>
        <?php else: ?>
        <li class="ab-cred reveal-up reveal-delay-4"><?php echo icon('users', 24); ?><b>Named owner</b><span><?php echo e($ownerName); ?> owns and runs the company.</span><a href="tel:<?php echo e($phoneRaw); ?>">Call <?php echo e($phone); ?></a></li>
        <?php endif; ?>
      </ul>
    </div>
  </section>

  <!-- 7. PROOF — Google reviews feed (renders nothing until reviews exist) -->
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
  $abReviews = p1_google_reviews($slug, ['heading' => 'What do customers say about Coastal Trim Lighting on Google?']);
  if ($abReviews !== ''): ?>
  <section class="section ab-reviews" aria-label="Google reviews"><div class="container-narrow"><?php echo $abReviews; ?></div></section>
  <?php endif; ?>

  <!-- 8. CLOSING CTA -->
  <section class="section closing-cta texture-grain edge-curve-top ab-cta" aria-labelledby="ab-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <span class="eyebrow-label"><?php echo e($address['city']); ?> and North County</span>
      <h2 id="ab-cta-title">Ready to talk about your <span class="text-accent">property</span>?</h2>
      <p class="answer-block">Call Coastal Trim Lighting at <?php echo e($phone); ?> or send the estimate form with your address and what you want lit. You get open dates and a price for your San Marcos home or business, for holiday lighting, landscape lighting, or both.</p>
      <div class="actions">
        <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
      <p><a href="/services/">See all lighting services</a> · <a href="/faq/">Read the FAQ</a></p>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
