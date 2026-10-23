<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Service areas hub — /service-areas/ (Phase 6). Lists every config.php
 * $serviceAreas entry (San Marcos only — build-plan service_areas). Other
 * North County towns are NOT named: the client has not confirmed them
 * (content-confirmations.json "Service area towns"). Coverage is described as
 * San Marcos + about $targetRadiusMiles miles, confirmed per address.
 * No GBP map embed in intake → coverage diagram (SVG, not to scale) + a
 * Google Maps directions link built from the real place_id.
 * Zip checker is Flagship-only → not used on this Premium build.
 * ------------------------------------------------------------------------- */
$pageTitle       = 'Service Areas Near San Marcos, CA | Coastal Trim Lighting';
$pageDescription = 'Coastal Trim Lighting installs holiday and outdoor lighting in San Marcos, CA and nearby North County towns within about 25 miles. Call (760) 916-3716.';
$canonicalUrl    = $siteUrl . '/service-areas/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'service-areas';
$pageType        = 'other';
$heroPreloadImage = '';

$sahPrimary = $serviceAreas[0];
foreach ($serviceAreas as $sahCfg) { if (!empty($sahCfg['primary'])) { $sahPrimary = $sahCfg; break; } }

/* Neighborhood shortcuts into the primary area page (#neighborhoods on that page). */
$sahHoods = ['San Elijo Hills', 'Lake San Marcos', 'Twin Oaks Valley', 'Discovery Hills', 'University District', 'Richland', 'Coronado Hills'];

/* One line per service for the numbered rows (page copy, not the config placeholder). */
$sahSvcLines = [
    'residential-holiday-lighting' => 'Rooflines, trees and walkways lit for the season, from a lakeside home to a hillside two-story.',
    'commercial-holiday-lighting'  => 'Storefronts, offices and managed properties, planned around who approves the display.',
    'landscape-lighting'           => 'Paths, trees, entries and patios lit every night, in a climate where the plants never stop growing.',
];

$sahItems = [];
$sahPos = 1;
foreach ($serviceAreas as $sahSchemaArea) {
    $sahItems[] = ['@type' => 'ListItem', 'position' => $sahPos++, 'name' => $sahSchemaArea['name'] . ', ' . $address['state'],
                   'url' => $siteUrl . '/service-areas/' . $sahSchemaArea['slug'] . '/'];
}
$sahCrumb = generateBreadcrumbSchema([['name' => 'Service Areas', 'url' => '/service-areas/']]);
unset($sahCrumb['@context']);
$schemaMarkup = ['@context' => 'https://schema.org', '@graph' => [
    [
        '@type'       => 'CollectionPage',
        '@id'         => $canonicalUrl . '#webpage',
        'url'         => $canonicalUrl,
        'name'        => $pageTitle,
        'description' => $pageDescription,
        'isPartOf'    => ['@type' => 'WebSite', 'url' => $siteUrl . '/'],
        'about'       => ['@id' => $siteUrl . '/#organization'],
        'mainEntity'  => ['@type' => 'ItemList', 'name' => $siteName . ' service areas', 'itemListElement' => $sahItems],
    ],
    $sahCrumb,
]];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   Service areas hub — warm-human. Prefix .sah-. Tokens only.
   =================================================================== */
.sah-page h1, .sah-page h2, .sah-page h3 { text-wrap: balance; }
.sah-page p { text-wrap: pretty; }

/* -- Hero: deep teal band, compass glow (::before), grain (::after), contour rings -- */
section.sah-hero { padding-bottom: calc(var(--space-12) + var(--space-6)); }
.sah-hero {
  background:
    repeating-radial-gradient(circle at 88% 40%, transparent 0 46px, color-mix(in srgb, var(--color-white) 6%, transparent) 46px 47px),
    linear-gradient(160deg, var(--color-primary-deep) 0%, var(--color-dark) 65%);
}
.sah-hero::before {
  content: "";
  position: absolute;
  inset: auto auto -40% -12%;
  width: 58%;
  aspect-ratio: 1;
  z-index: -1;
  border-radius: var(--radius-full);
  background: radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 22%, transparent), transparent);
  pointer-events: none;
}
.sah-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .45;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.sah-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.sah-hero .breadcrumb li { display: inline-flex; align-items: center; min-height: 44px; }
.sah-hero .breadcrumb a:hover { color: var(--color-accent-bright); }
.sah-hero .breadcrumb [aria-current] { color: var(--color-white); }
.sah-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.sah-hero .hero-chips li { background: color-mix(in srgb, var(--color-white) 8%, transparent); border-color: color-mix(in srgb, var(--color-white) 20%, transparent); color: var(--color-white); }
.sah-hero .hero-chips svg { color: var(--color-accent-bright); }
.sah-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.sah-hero .link-call svg { color: var(--color-accent-bright); }
.sah-hero .hero-form-open { background: var(--color-accent); color: var(--color-ink); }
.sah-hero .hero-form-card { border-top: 4px solid var(--color-secondary); }

/* -- Coverage: copy | coverage diagram (paper) -- */
.sah-coverage { background: var(--color-paper); }
.sah-coverage .split { grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); align-items: center; gap: clamp(2rem, 6vw, 5rem); }
.sah-coverage-copy { display: grid; gap: var(--space-md); }
.sah-coverage-copy > p { margin: 0; max-width: var(--measure); color: var(--color-ink-2); }
.sah-map { position: relative; margin: 0; padding: var(--space-lg); border-radius: var(--radius-xl); background: var(--color-dark); box-shadow: var(--shadow-lg); isolation: isolate; overflow: hidden; }
.sah-map::before { content: ""; position: absolute; inset: 0; z-index: -1; background: radial-gradient(60% 60% at 50% 50%, color-mix(in srgb, var(--color-secondary) 35%, transparent), transparent 70%); }
.sah-map svg { display: block; width: 100%; height: auto; }
.sah-map .ring { fill: none; stroke: color-mix(in srgb, var(--color-white) 22%, transparent); stroke-dasharray: 4 6; }
.sah-map .ring--outer { stroke: color-mix(in srgb, var(--color-accent) 70%, transparent); stroke-dasharray: none; stroke-width: 2; }
.sah-map .ring--city { fill: color-mix(in srgb, var(--color-primary) 45%, transparent); stroke: color-mix(in srgb, var(--color-secondary) 80%, transparent); stroke-width: 1.5; stroke-dasharray: none; }
.sah-map .hood { fill: var(--color-accent-bright); filter: drop-shadow(0 0 4px var(--color-accent)); animation: sah-pulse 3.4s ease-in-out infinite; }
.sah-map .hood:nth-of-type(2n) { animation-delay: -1.3s; }
.sah-map .base { fill: var(--color-white); stroke: var(--color-accent); stroke-width: 4; }
.sah-map text { fill: color-mix(in srgb, var(--color-white) 86%, transparent); font-family: var(--font-accent); font-size: 15px; letter-spacing: .08em; text-transform: uppercase; }
.sah-map .label-strong { fill: var(--color-accent-bright); font-size: 17px; }
.sah-map figcaption { margin-top: var(--space-sm); font-size: var(--font-size-sm); color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.sah-map figcaption a { color: var(--color-accent-bright); text-decoration: underline; text-underline-offset: .15em; }
@keyframes sah-pulse { 0%, 100% { opacity: 1; } 50% { opacity: .45; } }

/* -- Area cards (white, curved top) -- */
.sah-areas { background: var(--color-surface); }
.sah-areas .section-head { max-width: 64ch; }
.sah-area-grid { display: grid; grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr); gap: var(--space-lg); margin-top: var(--space-xl); align-items: stretch; }
.sah-area-card { position: relative; display: grid; gap: var(--space-md); align-content: start; padding: var(--space-xl); border-radius: var(--radius-xl); box-shadow: var(--shadow); transition: transform var(--transition), box-shadow var(--transition); overflow: hidden; isolation: isolate; }
.sah-area-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
.sah-area-card--primary { background: var(--color-card-tint-1); border-left: 6px solid var(--color-accent); }
.sah-area-card--primary::after { content: ""; position: absolute; right: calc(var(--space-xl) * -1); bottom: calc(var(--space-xl) * -1); width: 220px; aspect-ratio: 1; z-index: -1; border-radius: var(--radius-full); border: 30px solid color-mix(in srgb, var(--color-primary) 7%, transparent); }
.sah-area-card--ask { background: var(--color-card-tint-3); border: 2px dashed color-mix(in srgb, var(--color-primary) 30%, transparent); box-shadow: none; }
.sah-area-card .sah-tag { justify-self: start; padding: var(--space-1) var(--space-sm); border-radius: var(--radius-full); background: var(--color-primary); color: var(--color-white); font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .12em; text-transform: uppercase; }
.sah-area-card h3 { margin: 0; font-size: var(--fs-h2); color: var(--color-ink); }
.sah-area-card--ask h3 { font-size: var(--fs-h3); }
.sah-area-card p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
.sah-hood-links { display: flex; flex-wrap: wrap; gap: var(--space-xs); margin: 0; padding: 0; list-style: none; }
.sah-hood-links a { display: inline-flex; align-items: center; min-height: 44px; padding: 0 var(--space-md); border-radius: var(--radius-full); background: var(--color-surface); border: 1px solid var(--color-line); font-size: var(--font-size-sm); color: var(--color-ink); transition: border-color var(--transition), color var(--transition); }
.sah-hood-links a:hover { border-color: var(--color-accent); color: var(--color-primary); }
.sah-area-card .sah-actions { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-md); }

/* -- Services by area: numbered rows (dark slant band) -- */
.sah-svc .sah-svc-head { max-width: 62ch; display: grid; gap: var(--space-sm); margin-bottom: var(--space-xl); }
.sah-svc .answer-block { background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.sah-svc-list { display: grid; gap: 0; margin: 0; padding: 0; list-style: none; counter-reset: sah; border-top: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); }
.sah-svc-list li { counter-increment: sah; display: grid; grid-template-columns: 64px minmax(0, 1fr) auto; gap: var(--space-md); align-items: center; padding: var(--space-lg) 0; border-bottom: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); transition: background var(--transition); }
.sah-svc-list li:hover { background: color-mix(in srgb, var(--color-accent) 6%, transparent); }
.sah-svc-list li::before { content: counter(sah, decimal-leading-zero); font-family: var(--font-accent); font-size: var(--fs-h3); letter-spacing: .06em; color: var(--color-accent-bright); }
.sah-svc-list h3 { margin: 0 0 var(--space-1); font-size: var(--fs-h3); color: var(--color-white); }
.sah-svc-list p { margin: 0; color: color-mix(in srgb, var(--color-white) 78%, transparent); font-size: var(--font-size-sm); }
.sah-svc-list a.sah-svc-link { display: inline-flex; align-items: center; gap: var(--space-xs); min-height: 44px; color: var(--color-accent-bright); font-weight: 600; white-space: nowrap; }
.sah-svc-list a.sah-svc-link svg { transition: transform var(--transition); }
.sah-svc-list a.sah-svc-link:hover svg { transform: translateX(4px); }

/* -- Closing CTA -- */
.sah-cta .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.sah-cta h2 { margin: 0; }
.sah-cta .answer-block { margin: 0 auto; background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); text-align: left; }
.sah-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.sah-cta .link-call { color: var(--color-white); }
.sah-cta .link-call svg { color: var(--color-accent-bright); }
.sah-cta .floating-ring { bottom: -120px; right: -100px; }

/* -- Responsive -- */
@media (max-width: 1000px) {
  .sah-coverage .split, .sah-area-grid { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
  .sah-hero .hero-answer { font-size: var(--font-size-base); }
  .sah-svc-list li { grid-template-columns: 44px minmax(0, 1fr); }
  .sah-svc-list a.sah-svc-link { grid-column: 2; }
  .sah-area-card { padding: var(--space-lg); }
}
@media (prefers-reduced-motion: reduce) {
  .sah-map .hood { animation: none; }
}
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>

<div class="sah-page">

  <!-- HERO — deep teal band with contour rings, copy | form card -->
  <section class="hero hero--interior sah-hero">
    <div class="container">
      <div class="hero-grid hero-grid--form">
        <div class="hero-copy">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="/">Home</a></li>
              <li class="breadcrumb-sep" aria-hidden="true">/</li>
              <li aria-current="page">Service Areas</li>
            </ol>
          </nav>
          <span class="eyebrow">Service Areas · North County San Diego</span>
          <h1 class="hero-title"><span class="text-accent">Holiday Lighting</span> in San Marcos &amp; Surrounding Communities</h1>
          <p class="hero-answer">Based in San Marcos, lighting homes and businesses across the city and North County within about <?php echo (int) $targetRadiusMiles; ?> miles.</p>
          <div class="hero-actions">
            <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
            <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
          </div>
          <ul class="hero-chips">
            <li><?php echo icon('map-pin', 16); ?> Based in <?php echo e($address['city']); ?></li>
            <li><?php echo icon('navigation', 16); ?> About <?php echo (int) $targetRadiusMiles; ?> miles</li>
            <li><?php echo icon('calendar', 16); ?> Est. <?php echo (int) $yearEstablished; ?></li>
          </ul>
        </div>
        <?php echo p1_hero_form_card('hero', '', 'Is your address in our area?', 'Send the address and what you want lit; we will confirm and follow up.'); ?>
      </div>
    </div>
  </section>

  <!-- COVERAGE — intro copy | coverage diagram -->
  <section class="section sah-coverage" aria-labelledby="sah-coverage-title">
    <div class="container-wide">
      <div class="split">
        <div class="sah-coverage-copy reveal-left">
          <span class="eyebrow-label">Coverage</span>
          <h2 id="sah-coverage-title">Where does Coastal Trim Lighting install <span class="text-accent">holiday and outdoor lighting</span>?</h2>
          <p class="answer-block">Coastal Trim Lighting installs holiday and outdoor lighting in San Marcos, its home base since <?php echo (int) $yearEstablished; ?>, and in the surrounding North County San Diego area within about <?php echo (int) $targetRadiusMiles; ?> miles of Topanga Drive. Addresses outside San Marcos are confirmed one at a time, so include yours with the request.</p>
          <p>Inside San Marcos, coverage runs from the lakeside streets of Lake San Marcos to the hillside neighborhoods of San Elijo Hills below Double Peak, and from Twin Oaks Valley in the north to the University District around Cal State San Marcos. The same three services are available at every address: holiday lighting for houses, holiday lighting for businesses, and landscape and outdoor lighting that stays up all year.</p>
          <p>Each area page covers the local conditions that change an install, such as Santa Ana winds, winter rain, hillside lots and HOA rules, so you know what to mention before you ask for a price.</p>
        </div>
        <figure class="sah-map reveal-scale">
          <svg viewBox="0 0 520 440" role="img" aria-labelledby="sah-map-title sah-map-desc" focusable="false">
            <title id="sah-map-title">Coastal Trim Lighting coverage diagram</title>
            <desc id="sah-map-desc">Diagram, not to scale: Topanga Drive in San Marcos at the center, San Marcos neighborhoods inside the city ring, and an outer ring marking about <?php echo (int) $targetRadiusMiles; ?> miles of coverage.</desc>
            <circle class="ring ring--outer" cx="260" cy="220" r="200"/>
            <circle class="ring" cx="260" cy="220" r="150"/>
            <circle class="ring ring--city" cx="260" cy="220" r="100"/>
            <circle class="hood" cx="260" cy="140" r="6"/>
            <circle class="hood" cx="330" cy="190" r="6"/>
            <circle class="hood" cx="320" cy="270" r="6"/>
            <circle class="hood" cx="235" cy="295" r="6"/>
            <circle class="hood" cx="180" cy="245" r="6"/>
            <circle class="hood" cx="195" cy="165" r="6"/>
            <circle class="base" cx="260" cy="220" r="11"/>
            <text class="label-strong" x="260" y="252" text-anchor="middle">San Marcos</text>
            <text x="260" y="196" text-anchor="middle">Topanga Dr</text>
            <text x="260" y="58" text-anchor="middle">About <?php echo (int) $targetRadiusMiles; ?> miles</text>
            <text x="260" y="408" text-anchor="middle">North County San Diego</text>
          </svg>
          <figcaption>Diagram, not to scale. Dots mark San Marcos neighborhoods. <a href="<?php echo e($directionsUrl); ?>" target="_blank" rel="noopener">Open Coastal Trim Lighting in Google Maps</a></figcaption>
        </figure>
      </div>
    </div>
  </section>

  <!-- AREA CARDS — every config.php area + an "ask about your town" card -->
  <section class="section sah-areas edge-curve-top" aria-labelledby="sah-areas-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Area pages</span>
        <h2 id="sah-areas-title">Which communities have their own <span class="text-accent">Coastal Trim Lighting</span> page?</h2>
        <p class="answer-block">San Marcos has its own Coastal Trim Lighting page, with neighborhood notes, local weather and terrain, and the services available there. More North County community pages are added as towns are confirmed; until then, any nearby address can be checked through the form or by phone.</p>
      </div>
      <div class="sah-area-grid">
        <?php foreach ($serviceAreas as $sahAreaI => $sahArea): ?>
        <article class="sah-area-card<?php echo !empty($sahArea['primary']) ? ' sah-area-card--primary' : ''; ?> reveal-left reveal-delay-<?php echo ($sahAreaI % 3) + 1; ?>">
          <?php if (!empty($sahArea['primary'])): ?><span class="sah-tag">Home base</span><?php endif; ?>
          <h3><?php echo e($sahArea['name']); ?>, <?php echo e($address['state']); ?></h3>
          <?php if (!empty($sahArea['blurb'])): ?><p><?php echo e($sahArea['blurb']); ?></p><?php endif; ?>
          <?php if ($sahArea['slug'] === $sahPrimary['slug'] && pageExists('/service-areas/' . $sahArea['slug'])): ?>
          <ul class="sah-hood-links" aria-label="San Marcos neighborhoods">
            <?php foreach ($sahHoods as $sahHood): ?>
            <li><a href="<?php echo e(areaUrl($sahArea)); ?>#neighborhoods"><?php echo e($sahHood); ?></a></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <div class="sah-actions">
            <a class="btn btn-primary" href="<?php echo e(areaUrl($sahArea)); ?>">Lighting in <?php echo e($sahArea['name']); ?></a>
          </div>
        </article>
        <?php endforeach; ?>
        <article class="sah-area-card sah-area-card--ask reveal-right reveal-delay-2">
          <h3>Another North County town?</h3>
          <p>Coastal Trim Lighting covers about <?php echo (int) $targetRadiusMiles; ?> miles around San Marcos. Send the address with your request and the follow-up confirms it before anything is quoted.</p>
          <div class="sah-actions">
            <button type="button" class="btn btn-secondary" data-open-estimate>Check my address</button>
            <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> <?php echo e($phone); ?></a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- SERVICES IN EVERY AREA — numbered rows on a dark slant band -->
  <section class="section sah-svc texture-grain slant-top" aria-labelledby="sah-svc-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container">
      <div class="sah-svc-head reveal-up">
        <span class="eyebrow-label">Services</span>
        <h2 id="sah-svc-title">Which <span class="text-accent">lighting services</span> are available in each area?</h2>
        <p class="answer-block">All three Coastal Trim Lighting services are available in San Marcos and across the surrounding coverage area. Each property is priced on its own list of rooflines, trees, frontage or paths, so the service you pick and the address you send are what set the quote.</p>
      </div>
      <ol class="sah-svc-list">
        <?php foreach ($services as $sahSvcI => $sahSvc): ?>
        <li class="reveal-<?php echo $sahSvcI % 2 ? 'right' : 'left'; ?> reveal-delay-<?php echo ($sahSvcI % 3) + 1; ?>">
          <div>
            <h3><?php echo e($sahSvc['name']); ?></h3>
            <p><?php echo e($sahSvcLines[$sahSvc['slug']] ?? $sahSvc['description']); ?></p>
          </div>
          <a class="sah-svc-link" href="<?php echo e(serviceUrl($sahSvc)); ?>" aria-label="Read about <?php echo e($sahSvc['name']); ?>">Read more <?php echo icon('arrow-right', 18); ?></a>
        </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <!-- CLOSING CTA -->
  <section class="section closing-cta texture-grain edge-wave-top sah-cta" aria-labelledby="sah-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <span class="eyebrow-label">San Marcos &amp; nearby</span>
      <h2 id="sah-cta-title">Ready to get a price for your <span class="text-accent">address</span>?</h2>
      <p class="answer-block">Send Coastal Trim Lighting the address, what you want lit and the date you want it on. If the property is in San Marcos or a nearby North County community, you get a price for it before anything goes up.</p>
      <div class="actions">
        <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
