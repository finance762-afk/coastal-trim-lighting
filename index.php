<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Homepage — Phase 3 (archetype: warm-human; section script: editorial).
 * IMAGE STATE: build-plan.json assets hold the logo only — no client job photos
 * are on disk and no hero was allocated. So: copy | form-card hero (the
 * warm-human no-photo fallback), no recent-work gallery (< 8 photos), icon-led
 * service cards, and the logo badge in the about frame. Swap in real photos
 * when the client uploads them (hero, service cards, about frame, gallery).
 * Every fact below traces to build-plan.json / config.php. Unconfirmed facts
 * (licence, insurance, hours, free estimates, takedown/storage, pricing, reply
 * time) are left out of the copy and listed in /content-confirmations.json.
 * ------------------------------------------------------------------------- */
$pageTitle       = 'Holiday Lighting in San Marcos, CA | Coastal Trim Lighting';
$pageDescription = 'Coastal Trim Lighting installs holiday lighting for San Marcos, CA homes and businesses, plus landscape and outdoor lighting. Call (760) 916-3716 for a price.';
$canonicalUrl    = $siteUrl . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'home';
$pageType        = 'home';

/* No allocated hero photo exists (logo-only asset list) — nothing to preload.
 * The H1 is the LCP element until real photos arrive. */
$heroPreloadImage = '';

/* Services grid — config.php $services (3), with card copy per slug.
 * No client photo exists for any service, so cards are icon-led (the
 * documented no-photo fallback; never stock, never a gradient block). */
$homeServiceCards = [
    'residential-holiday-lighting' => [
        'icon'    => 'house',
        'desc'    => 'Holiday lights put up on San Marcos homes for the season.',
        'bullets' => ['No ladder work for you', 'Lit for the whole season', 'Priced for your house'],
    ],
    'commercial-holiday-lighting' => [
        'icon'    => 'building-2',
        'desc'    => 'Holiday lighting for businesses and commercial properties.',
        'bullets' => ['Your staff stays off ladders', 'A lit frontage all season', 'Quoted for your property'],
    ],
    'landscape-lighting' => [
        'icon'    => 'trees',
        'desc'    => 'Permanent landscape and outdoor lighting for homes and businesses.',
        'bullets' => ['Stays up year-round', 'Light for paths and yards', 'Residential and commercial'],
    ],
];

/* Signature section: which service fits which property (a real comparison, so a <table>). */
$fitRows = [
    [
        'slug'  => 'residential-holiday-lighting',
        'who'   => 'Houses in San Marcos and nearby',
        'up'    => 'For the holiday season',
        'ready' => 'Your address, the parts of the house you want lit (rooflines, trees, walkways) and the date you want them on.',
    ],
    [
        'slug'  => 'commercial-holiday-lighting',
        'who'   => 'Businesses and commercial properties',
        'up'    => 'For the holiday season',
        'ready' => 'The property address, who manages the site, and any landlord or association rules on exterior decorations.',
    ],
    [
        'slug'  => 'landscape-lighting',
        'who'   => 'Homes and commercial properties',
        'up'    => 'Permanent fixtures, used all year',
        'ready' => 'The areas you want lit (paths, trees, patio, entry) and whether any outdoor lighting is already there.',
    ],
];

/* Ticker — service types and place facts from intake only (no ratings: none in intake). */
$tickerItems = [
    ['icon' => 'sparkles',   'text' => 'Holiday lighting'],
    ['icon' => 'house',      'text' => 'Residential holiday lights'],
    ['icon' => 'building-2', 'text' => 'Commercial holiday lights'],
    ['icon' => 'trees',      'text' => 'Landscape lighting'],
    ['icon' => 'sun',        'text' => 'Outdoor lighting'],
    ['icon' => 'map-pin',    'text' => 'San Marcos, CA'],
    ['icon' => 'navigation', 'text' => 'North County San Diego'],
    ['icon' => 'phone',      'text' => $phone],
];

/* FAQs — visible text only. NEVER FAQPage JSON-LD (QA blocker).
 * Q1 and Q2 come from the research brief; the rest are answered from intake facts only. */
$homeFaqs = [
    ['q' => 'How much does holiday lighting cost in San Marcos?',
     'a' => 'Coastal Trim Lighting prices each job for the property, so there is no single flat price. The size of the house or building and how much of it you want lit are what move the number. Call ' . $phone . ' or send the estimate form for availability and pricing.'],
    ['q' => 'Do you light commercial properties as well as homes?',
     'a' => 'Yes. Coastal Trim Lighting puts up holiday lighting on homes and on businesses and commercial properties, and installs landscape and outdoor lighting for both. Tell us the property type on the form so the follow-up covers the right service.'],
    ['q' => 'Do you install lighting outside the holiday season?',
     'a' => 'Yes. Alongside holiday lighting, Coastal Trim Lighting installs landscape and outdoor lighting: permanent fixtures for paths, yards, trees and entries that stay up year-round on homes and commercial properties.'],
    ['q' => 'What area does Coastal Trim Lighting serve?',
     'a' => 'Coastal Trim Lighting is based at ' . $address['street'] . ' in ' . cityStateLine(true) . ' and works on properties in San Marcos and the surrounding North County San Diego area, within about ' . (int) $targetRadiusMiles . ' miles.',
     'link' => ['href' => areaUrl($serviceAreas[0]), 'label' => 'San Marcos service area details']],
    ['q' => 'How do I get my holiday lights on the schedule?',
     'a' => 'Call ' . $phone . ' or send the estimate form with your address and what you would like lit. Coastal Trim Lighting follows up with open install dates and a price for your property.'],
    ['q' => 'What should I have ready when I call?',
     'a' => 'The property address, whether it is a home or a business, the parts you want lit, and the date you want the lights on. For landscape lighting, note any outdoor fixtures already in place.'],
];

/* Garland decoration (aria-hidden): bulbs sit on quadratic swags drawn in the SVG below. */
$garlandBulbs = [];
for ($gSwag = 0; $gSwag < 6; $gSwag++) {
    $gX = $gSwag * 200;
    foreach ([[50, 37.5], [100, 45], [150, 37.5]] as $gPt) {
        $garlandBulbs[] = [$gX + $gPt[0], $gPt[1]];
    }
}

/* Schema: head.php emits the LocalBusiness node (@id #organization) on every page.
 * The homepage adds a WebPage node that points at it. No FAQPage, no aggregateRating. */
$schemaMarkup = [
    generateWebPageSchema($pageTitle, $pageDescription, $siteUrl . '/'),
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   Homepage — Coastal Trim Lighting (warm-human, editorial script).
   Tokens only. Scaffold framework.css carries the base components;
   this block composes them for this page.
   =================================================================== */

/* -- Hero: light, copy | form card, layered (radial glow ::before from
      scaffold .hero--light, grain ::after here) + string-light garland -- */
.home-hero {
  background:
    radial-gradient(120% 90% at 0% 0%, color-mix(in srgb, var(--color-accent) 12%, transparent), transparent 55%),
    linear-gradient(180deg, var(--color-paper) 0%, var(--color-paper-2) 100%);
  padding-bottom: calc(var(--space-16) + var(--space-8));
}
section.home-hero { padding-bottom: calc(var(--space-16) + var(--space-8)); }
.home-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  pointer-events: none;
  opacity: .35;
  mix-blend-mode: multiply;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.18'/%3E%3C/svg%3E");
}
.home-hero .hero-grid--form { align-items: center; }
.home-hero .hero-title { max-width: 20ch; }
.home-hero .hero-title .text-accent { color: var(--color-primary); }
.home-hero .hero-answer { max-width: 30rem; }
.home-hero .eyebrow { color: var(--color-secondary); }
.home-hero .hero-chips li { background: color-mix(in srgb, var(--color-surface) 80%, transparent); }
.home-hero .hero-chips svg { color: var(--color-accent-dark); }
.home-hero .hero-form-open { background: var(--color-primary); }

/* Form card: glass over a warm glow, accent rule on top */
.home-hero .hero-form-card {
  position: relative;
  border-top: 4px solid var(--color-accent);
  box-shadow: var(--shadow-lg);
}
.home-hero .hero-form-card::before {
  content: "";
  position: absolute;
  inset: -18% -14% auto auto;
  width: 70%;
  aspect-ratio: 1;
  z-index: -1;
  border-radius: var(--radius-full);
  background: radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 28%, transparent), transparent);
  pointer-events: none;
}
.home-hero .hero-form-card h2 { font-size: var(--font-size-xl); }

/* String-light garland along the bottom edge of the hero (decorative) */
.hero-garland {
  position: absolute;
  left: 0;
  right: 0;
  bottom: var(--space-2);
  height: 76px;
  z-index: 0;
  pointer-events: none;
}
.hero-garland svg { width: 100%; height: 100%; }
.hero-garland .wire { fill: none; stroke: var(--color-dark); stroke-width: 2; opacity: .7; }
.hero-garland .cap { fill: var(--color-dark); opacity: .8; }
.hero-garland .bulb { filter: drop-shadow(0 0 6px currentColor); }
.hero-garland .b1 { fill: var(--color-accent); color: var(--color-accent); }
.hero-garland .b2 { fill: var(--color-secondary); color: var(--color-secondary); }
.hero-garland .b3 { fill: color-mix(in srgb, var(--color-accent) 55%, var(--color-danger)); color: color-mix(in srgb, var(--color-accent) 55%, var(--color-danger)); }
.hero-garland .b4 { fill: color-mix(in srgb, var(--color-secondary) 45%, var(--color-paper)); color: color-mix(in srgb, var(--color-secondary) 45%, var(--color-paper)); }

/* -- Ticker -- */
.home-ticker { padding: var(--space-sm) 0; background: var(--color-dark); border-color: transparent; }
.home-ticker .ticker-track { color: color-mix(in srgb, var(--color-white) 85%, transparent); }
.home-ticker .ticker-track svg { color: var(--color-accent-bright); }
.home-ticker .ticker-track > span::after {
  content: "";
  width: 6px;
  height: 6px;
  margin-left: var(--space-xl);
  border-radius: var(--radius-full);
  background: var(--color-accent);
  box-shadow: 0 0 8px var(--color-accent);
}

/* -- Services: three icon-led tinted cards -- */
.home-services { background: var(--color-surface); }
.home-services .section-title { max-width: 62ch; }
.home-services .services-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); }
.home-services .service-card-with-image { border: 1px solid color-mix(in srgb, var(--color-primary) 14%, var(--color-line)); }
.home-services .service-card-with-image::before {
  content: "";
  height: 5px;
  background: linear-gradient(90deg, var(--color-primary), var(--color-accent));
}
.home-services .card-tint-2::before { background: linear-gradient(90deg, var(--color-secondary), var(--color-primary)); }
.home-services .card-tint-3::before { background: linear-gradient(90deg, var(--color-accent), var(--color-secondary)); }
.home-services .service-card__body { padding: var(--space-xl) var(--space-lg) var(--space-lg); gap: var(--space-sm); }
.home-services .service-card__icon {
  width: 60px;
  height: 60px;
  border-radius: var(--radius-lg);
  background: var(--color-surface);
  color: var(--color-primary);
  box-shadow: var(--shadow);
  transition: transform var(--transition-slow), color var(--transition);
}
.home-services .service-card__icon svg { width: 28px; height: 28px; }
.home-services .service-card-with-image:hover .service-card__icon { transform: rotate(-6deg) scale(1.06); color: var(--color-accent-dark); }
.home-services .service-card-with-image h3 { font-size: var(--fs-h3); color: var(--color-primary); }
.home-services .services-more { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-md) var(--space-lg); margin-top: var(--space-xl); }
.home-services .services-more p { margin: 0; color: var(--color-ink-2); }

/* -- Signature: "which service fits" comparison table on a dark slant band -- */
.home-fit .fit-head { max-width: 60ch; margin-bottom: var(--space-xl); display: grid; gap: var(--space-sm); }
.home-fit .fit-head p { margin: 0; }
.fit-table-wrap {
  overflow-x: auto;
  border-radius: var(--radius-lg);
  border: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent);
  background: color-mix(in srgb, var(--color-white) 5%, transparent);
  backdrop-filter: blur(6px);
}
.fit-table { width: 100%; border-collapse: collapse; min-width: 720px; font-size: var(--font-size-sm); }
.fit-table caption { text-align: left; padding: var(--space-md) var(--space-lg) 0; font-family: var(--font-accent); letter-spacing: .12em; text-transform: uppercase; font-size: var(--fs-eyebrow); color: var(--color-accent-bright); }
.fit-table th, .fit-table td { text-align: left; vertical-align: top; padding: var(--space-md) var(--space-lg); border-bottom: 1px solid color-mix(in srgb, var(--color-white) 10%, transparent); }
.fit-table thead th { font-family: var(--font-accent); font-weight: 700; letter-spacing: .1em; text-transform: uppercase; font-size: var(--fs-eyebrow); color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.fit-table tbody th { font-family: var(--font-heading); font-size: var(--font-size-base); color: var(--color-white); width: 24%; }
.fit-table tbody th a { color: inherit; text-decoration: none; display: inline-flex; align-items: center; gap: var(--space-xs); }
.fit-table tbody th a:hover { color: var(--color-accent-bright); }
.fit-table tbody th svg { color: var(--color-accent-bright); flex: 0 0 auto; }
.fit-table td { color: color-mix(in srgb, var(--color-white) 84%, transparent); }
.fit-table tbody tr:last-child th, .fit-table tbody tr:last-child td { border-bottom: 0; }
.fit-table tbody tr { transition: background var(--transition); }
.fit-table tbody tr:hover { background: color-mix(in srgb, var(--color-white) 4%, transparent); }
.fit-pill { display: inline-block; padding: var(--space-1) var(--space-sm); border-radius: var(--radius-full); font-weight: 600; white-space: nowrap; background: color-mix(in srgb, var(--color-accent) 18%, transparent); color: var(--color-accent-bright); }
.fit-pill--year { background: color-mix(in srgb, var(--color-secondary) 35%, transparent); color: var(--color-white); }
.home-fit .floating-ring { top: -80px; right: -90px; }

/* -- About + process: asymmetric (60/40), offset frame, staggered steps -- */
.home-about { background: var(--color-paper); }
.home-about .about-split { grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr); align-items: start; gap: clamp(2rem, 6vw, 5rem); }
.home-about .about-left { display: grid; gap: var(--space-md); }
.home-about .about-left > p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
.home-about .about-left .lead { color: var(--color-ink); }
.home-about .process-head { margin-top: var(--space-lg); font-size: var(--fs-h3); }
.home-about .process-steps { margin-top: var(--space-sm); }
.home-about .process-steps li {
  background: var(--color-surface);
  border: 1px solid var(--color-line);
  border-radius: var(--radius-lg);
  padding: var(--space-md);
  box-shadow: var(--shadow-sm);
}
.home-about .process-steps li::before { border-color: color-mix(in srgb, var(--color-accent) 50%, var(--color-line)); background: var(--color-paper); }
.home-about .about-right { margin-top: var(--space-16); }
.home-about .about-right::before {
  content: "";
  position: absolute;
  inset: calc(-1 * var(--space-6)) var(--space-6) var(--space-6) calc(-1 * var(--space-6));
  border: 2px solid var(--color-accent);
  border-radius: var(--radius-xl);
  opacity: .65;
  z-index: 0;
}
.badge-frame {
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
.badge-frame picture, .badge-frame img { width: min(100%, 340px); height: auto; }
.badge-frame img { filter: drop-shadow(0 12px 28px color-mix(in srgb, var(--color-black) 45%, transparent)); }
.home-about .about-stat-card { display: grid; gap: var(--space-1); left: calc(-1 * var(--space-6)); bottom: calc(-1 * var(--space-6)); border-left: 4px solid var(--color-accent); }
.home-about .about-stat-card b { font-family: var(--font-accent); font-size: 2rem; line-height: 1; color: var(--color-primary); }
.home-about .about-stat-card span { font-size: var(--font-size-sm); color: var(--color-muted); }

/* -- Reviews band (Page One feed; light background, never in a reveal) -- */
.home-reviews { background: var(--color-paper-2); }

/* -- Mid-page CTA: dark, grain, wave edge -- */
.home-cta .container-narrow { display: grid; gap: var(--space-lg); text-align: center; justify-items: center; }
.home-cta h2 { margin: 0; }
.home-cta p { margin: 0; max-width: 52ch; }
.home-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.home-cta .link-call { color: var(--color-white); }
.home-cta .link-call svg { color: var(--color-accent-bright); }
.home-cta .floating-ring { bottom: -120px; left: -100px; border-color: var(--color-secondary); }

/* -- FAQ -- */
.home-faq { background: var(--color-paper); }
.home-faq .faq { padding: var(--space-md) 0; }
.home-faq .faq summary { text-wrap: balance; }
.home-faq .faq[open] summary { color: var(--color-primary); }
.home-faq__more { margin-top: var(--space-lg); text-align: center; }
.home-faq .text-link { color: var(--color-primary); font-weight: 600; text-decoration: underline; text-underline-offset: 3px; }
.home-faq .text-link:hover { color: var(--color-secondary); }

/* -- Estimate section: wide container, form card + next steps -- */
.home-estimate { background: var(--color-surface); }
.home-estimate .estimate > .card { border-top: 4px solid var(--color-primary); display: grid; gap: var(--space-sm); }
.home-estimate .estimate > .card h2 { margin-bottom: var(--space-xs); }
.home-estimate .estimate-aside { display: grid; gap: var(--space-md); align-content: start; padding-top: var(--space-md); }
.home-estimate .estimate-aside h3 { font-size: var(--fs-h3); }
.home-estimate .estimate-aside .area-line { margin: 0; color: var(--color-ink-2); }
.home-estimate .nap { padding: var(--space-lg); border-radius: var(--radius-lg); background: var(--color-paper-2); margin-top: 0; }

/* -- Responsive -- */
@media (max-width: 1000px) {
  .home-services .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 900px) {
  .home-about .about-split { grid-template-columns: 1fr; }
  .home-about .about-right { margin: var(--space-xl) var(--space-lg) var(--space-xl) var(--space-lg); max-width: 420px; }
}
@media (max-width: 640px) {
  .home-services .services-grid { grid-template-columns: 1fr; }
  .home-hero .hero-answer { font-size: var(--font-size-base); }
  .hero-garland { height: 56px; }
  section.home-hero { padding-bottom: calc(var(--space-12) + var(--space-6)); }
}
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

  <!-- HERO — warm-human, no allocated photo → copy | form card (.hero-grid--form) -->
  <section class="hero hero--light home-hero" aria-labelledby="home-hero-title">
    <div class="container">
      <div class="hero-grid hero-grid--form">
        <div class="hero-text">
          <span class="eyebrow"><?php echo e(cityStateLine()); ?> · Lighting contractor</span>
          <h1 class="hero-title" id="home-hero-title"><span class="text-accent">Holiday lighting</span> installed in San Marcos, CA</h1>
          <p class="hero-answer">Coastal Trim Lighting installs holiday, landscape and outdoor lighting for homes and businesses in San Marcos and North County San Diego. Send your address and what you want lit, and we will follow up with open dates and pricing.</p>
          <div class="hero-actions">
            <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
            <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
          </div>
          <ul class="hero-chips">
            <li><?php echo icon('calendar', 16); ?> Est. <?php echo (int) $yearEstablished; ?></li>
            <li><?php echo icon('users', 16); ?> Owner <?php echo e($ownerName); ?></li>
            <li><?php echo icon('map-pin', 16); ?> ~<?php echo (int) $targetRadiusMiles; ?>-mile service area</li>
          </ul>
        </div>

        <aside class="hero-form-card" id="estimate-form" aria-labelledby="hero-form-title">
          <h2 id="hero-form-title"><?php echo e($estimateCtaLabel); ?></h2>
          <p class="hero-form-tagline">Tell us the address and what you'd like lit.</p>
          <form action="<?php echo e($formAction); ?>" method="POST" class="hero-form" id="hero-form">
            <input type="hidden" name="_next" value="<?php echo e($siteUrl); ?>/thank-you">
            <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
            <input type="hidden" name="form_location" value="hero">
            <input type="hidden" name="consent_version" value="v2.1">
            <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/'); ?>">
            <input type="hidden" name="_consent_version" value="v2.1">
            <input type="hidden" name="_consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/'); ?>">
            <?php echo p1_attribution_fields('hero'); ?>
            <!-- spam shield: signed render timestamp + JS interaction signal -->
            <?php $heroFt = (string) time(); ?>
            <input type="hidden" name="_ft" value="<?php echo $heroFt . '.' . hash_hmac('sha256', $heroFt, $leadsFormSecret); ?>">
            <input type="hidden" name="_js" value="" class="js-shield-field">
            <div class="form-row"><label class="sr-only" for="hero-name">Name</label><input id="hero-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
            <div class="form-row"><label class="sr-only" for="hero-phone">Phone</label><input id="hero-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" required></div>
            <div class="form-row"><label class="sr-only" for="hero-email">Email</label><input id="hero-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
            <div class="form-row"><label class="sr-only" for="hero-service">Service</label><select id="hero-service" name="service"><?php echo p1_service_options(); ?></select></div>
            <label class="consent" for="hero-terms"><input id="hero-terms" type="checkbox" name="terms_accepted" value="yes" required><span>I agree to the <a href="/terms/" target="_blank" rel="noopener">Terms</a> and <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and consent to be contacted. *</span></label>
            <button type="submit" class="btn btn-primary btn-block">Send my request</button>
          </form>
        </aside>
      </div>
    </div>

    <div class="hero-garland" aria-hidden="true">
      <svg viewBox="0 0 1200 76" preserveAspectRatio="xMidYMin slice" focusable="false">
        <path class="wire" d="M0 15 Q100 75 200 15 Q300 75 400 15 Q500 75 600 15 Q700 75 800 15 Q900 75 1000 15 Q1100 75 1200 15"/>
        <?php foreach ($garlandBulbs as $gI => $gB): ?>
        <g transform="translate(<?php echo $gB[0]; ?> <?php echo $gB[1]; ?>)">
          <rect class="cap" x="-3" y="-2" width="6" height="6" rx="1"/>
          <ellipse class="bulb b<?php echo ($gI % 4) + 1; ?>" cx="0" cy="12" rx="5.5" ry="9"/>
        </g>
        <?php endforeach; ?>
      </svg>
    </div>
  </section>

  <!-- TICKER — service types + place facts, pure CSS loop -->
  <div class="ticker-strip home-ticker" aria-hidden="true">
    <div class="ticker-track">
      <?php for ($tLoop = 0; $tLoop < 2; $tLoop++): foreach ($tickerItems as $tItem): ?>
      <span><?php echo icon($tItem['icon'], 18); ?><?php echo e($tItem['text']); ?></span>
      <?php endforeach; endfor; ?>
    </div>
  </div>

  <!-- SERVICES — tinted cards (icon-led: no client photos on disk yet) -->
  <section class="section home-services" aria-label="Lighting services">
    <div class="container">
      <div class="section-title reveal-up">
        <span class="eyebrow-label">What We Do</span>
        <h2>What <span class="text-accent">lighting</span> does Coastal Trim Lighting install in <span class="text-accent">San Marcos</span>?</h2>
        <p class="hero-answer"><?php echo e($siteName); ?> installs three kinds of lighting in <?php echo e(cityStateLine()); ?>: holiday lighting for homes, holiday lighting for businesses and commercial properties, and landscape and outdoor lighting that stays up all year. Each job is priced for the property, so the first step is a call to <?php echo e($phone); ?> or the estimate form.</p>
        <span class="section-subtitle">Homes · Businesses · Landscapes</span>
      </div>

      <div class="services-grid">
        <?php
        $svcTint = 0;
        foreach ($services as $svc):
            $svcCard = $homeServiceCards[$svc['slug']] ?? null;
            if (!$svcCard) continue;
            $svcTint = ($svcTint % 3) + 1;
        ?>
        <article class="service-card-with-image card-tint-<?php echo $svcTint; ?> reveal-up reveal-delay-<?php echo $svcTint; ?>">
          <div class="service-card__body">
            <div class="service-card__icon"><?php echo icon($svcCard['icon'], 28); ?></div>
            <h3><?php echo e($svc['name']); ?></h3>
            <p class="service-card__desc"><?php echo e($svcCard['desc']); ?></p>
            <ul>
              <?php foreach ($svcCard['bullets'] as $svcBullet): ?>
              <li><?php echo e($svcBullet); ?></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?php echo e(serviceUrl($svc)); ?>" class="service-card__cta" aria-label="Learn more about <?php echo e($svc['name']); ?>">Learn more</a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>

      <div class="services-more reveal-up">
        <?php if (pageExists('/services')): ?>
        <a href="/services/" class="btn btn-secondary">View All Services</a>
        <?php endif; ?>
        <button type="button" class="btn btn-primary" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
      </div>
    </div>
  </section>

  <!-- SIGNATURE — which service fits your property (dark, slant edge, grain) -->
  <section class="section home-fit texture-grain slant-top" aria-labelledby="fit-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
    <div class="container-wide">
      <div class="fit-head reveal-left">
        <span class="eyebrow-label">Before you call</span>
        <h2 id="fit-title">Which <span class="text-accent">lighting service</span> fits your property?</h2>
        <p>Holiday lighting goes up for the season on homes or commercial properties; landscape and outdoor lighting is a permanent install you use all year. The right-hand column lists what to have ready so Coastal Trim Lighting can price the job on the first call.</p>
      </div>
      <div class="fit-table-wrap reveal-up" tabindex="0" role="region" aria-labelledby="fit-title">
        <table class="fit-table">
          <caption>Coastal Trim Lighting services compared</caption>
          <thead>
            <tr>
              <th scope="col">Service</th>
              <th scope="col">Built for</th>
              <th scope="col">How long it stays up</th>
              <th scope="col">What to have ready</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($fitRows as $fitRow):
                $fitSvc = null;
                foreach ($services as $fitCandidate) { if ($fitCandidate['slug'] === $fitRow['slug']) { $fitSvc = $fitCandidate; break; } }
                if (!$fitSvc) continue;
                $fitIcon = $homeServiceCards[$fitRow['slug']]['icon'] ?? 'sparkles';
            ?>
            <tr>
              <th scope="row"><a href="<?php echo e(serviceUrl($fitSvc)); ?>"><?php echo icon($fitIcon, 18); ?><?php echo e($fitSvc['name']); ?></a></th>
              <td><?php echo e($fitRow['who']); ?></td>
              <td><span class="fit-pill<?php echo strpos($fitRow['up'], 'Permanent') === 0 ? ' fit-pill--year' : ''; ?>"><?php echo e($fitRow['up']); ?></span></td>
              <td><?php echo e($fitRow['ready']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ABOUT + PROCESS — asymmetric 60/40, offset accent frame, staggered steps -->
  <section class="section home-about edge-curve-top" aria-labelledby="about-title">
    <div class="container-wide">
      <div class="about-split">
        <div class="about-left reveal-left">
          <span class="eyebrow-label">About Coastal Trim</span>
          <h2 id="about-title">Who is behind <span class="text-accent">Coastal Trim Lighting</span>?</h2>
          <p class="lead"><?php echo e($siteName); ?> is owned by <?php echo e($ownerName); ?> and has been based in <?php echo e(cityStateLine()); ?> since <?php echo (int) $yearEstablished; ?>. The company puts up holiday lighting on homes and commercial properties and installs landscape and outdoor lighting that stays up year-round.</p>
          <p>Every quote starts with your property: the address, the rooflines, trees or garden you want lit, and when you need it. Call <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a> or send the form, and <?php echo e($siteName); ?> will follow up about availability and pricing for your San Marcos home or business.</p>

          <h3 class="process-head">How to get your lights on the calendar</h3>
          <ol class="process-steps">
            <li><b>Call or send the form</b><span>Reach <?php echo e($siteName); ?> at <?php echo e($phone); ?> or through the estimate form.</span></li>
            <li><b>Describe the property</b><span>The address, home or business, and the parts you want lit.</span></li>
            <li><b>Get dates and a price</b><span><?php echo e($siteName); ?> follows up with availability and pricing for your property.</span></li>
            <li><b>Lights go up</b><span>The install happens on the date you agree on.</span></li>
          </ol>
        </div>

        <div class="about-right reveal-right">
          <div class="badge-frame">
            <picture>
              <source type="image/webp" srcset="/assets/images/logo-v1-192.webp 192w, /assets/images/logo-v1.webp 440w" sizes="(max-width: 900px) 70vw, 340px">
              <img src="/assets/images/logo-v1.png" srcset="/assets/images/logo-v1-192.png 192w, /assets/images/logo-v1.png 440w" sizes="(max-width: 900px) 70vw, 340px" alt="Coastal Trim Lighting badge: script lettering over a sunset coastline with palm trees, ringed by colored string lights" width="440" height="440" loading="lazy" decoding="async">
            </picture>
          </div>
          <div class="about-stat-card">
            <b><?php echo (int) $yearsInBusiness; ?> years</b>
            <span>lighting <?php echo e($address['city']); ?> properties</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- REVIEWS — Page One Google reviews feed (renders nothing until the profile has written reviews) -->
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
  $homeReviews = p1_google_reviews($slug, ['heading' => 'What ' . $address['city'] . ' customers say on Google']);
  if ($homeReviews !== ''): ?>
  <section class="section home-reviews" aria-label="Google reviews"><div class="container-narrow"><?php echo $homeReviews; ?></div></section>
  <?php endif; ?>

  <!-- MID-PAGE CTA — dark, grain, wave edge -->
  <section class="section cta-banner texture-grain edge-wave-top home-cta" aria-labelledby="cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <span class="eyebrow-label">Holiday season</span>
      <h2 id="cta-title">Want your lights up <span class="text-accent">before the holidays</span>?</h2>
      <p>Holiday installs go on the calendar one property at a time. Send your address and what you want lit, and <?php echo e($siteName); ?> will tell you which install dates are open and what your property will cost.</p>
      <div class="actions">
        <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
    </div>
  </section>

  <?php /* FAQ — native details, visible text only (never FAQPage JSON-LD). */ ?>
  <section class="section home-faq" aria-labelledby="faq-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Questions</span>
        <h2 id="faq-title">What do San Marcos customers ask <span class="text-accent">Coastal Trim Lighting</span>?</h2>
        <p>Coastal Trim Lighting answers the questions San Marcos homeowners and business owners ask most about holiday, landscape and outdoor lighting: price, property type, timing and service area.</p>
      </div>
      <div class="faq-grid">
        <?php foreach ($homeFaqs as $faqI => $faq): ?>
        <details class="faq reveal-<?php echo $faqI % 2 ? 'right' : 'left'; ?>"<?php echo $faqI < 2 ? ' open' : ''; ?>>
          <summary><?php echo e($faq['q']); ?></summary>
          <p><?php echo e($faq['a']); ?><?php if (!empty($faq['link'])): ?> <a class="text-link" href="<?php echo e($faq['link']['href']); ?>"><?php echo e($faq['link']['label']); ?></a><?php endif; ?></p>
        </details>
        <?php endforeach; ?>
      </div>
      <p class="home-faq__more"><a class="text-link" href="/faq/">Read all lighting questions on the FAQ page</a></p>
    </div>
  </section>

  <!-- ESTIMATE — full form + what happens next + NAP -->
  <section class="section home-estimate" id="estimate" aria-labelledby="estimate-title">
    <div class="container-wide">
      <div class="estimate">
        <div class="card reveal-up">
          <span class="eyebrow-label"><?php echo e($estimateCtaLabel); ?></span>
          <h2 id="estimate-title">Tell us about the job</h2>
          <?php echo p1_full_lead_form('estimate-section', 'est', 'Send my request', 'House or business, what you want lit, and the date you need it'); ?>
        </div>
        <aside class="estimate-aside reveal-right" aria-label="What happens next">
          <h3>What happens next</h3>
          <ol class="next-steps">
            <li><strong>You send the form</strong>Your address and what you want lit reach <?php echo e($siteName); ?> directly.</li>
            <li><strong>We follow up</strong><?php echo e($siteName); ?> gets back to you by phone or email.</li>
            <li><strong>You get dates and a price</strong>Availability and pricing for your property, before anything goes up.</li>
          </ol>
          <div class="nap">
            <div><?php echo icon('phone', 18); ?><a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a></div>
            <div><?php echo icon('mail', 18); ?><a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a></div>
            <div><?php echo icon('map-pin', 18); ?><span><?php echo e($address['street']); ?>, <?php echo e(cityStateLine(true)); ?></span></div>
            <?php if (!empty($directionsUrl)): ?>
            <div><?php echo icon('navigation', 18); ?><a href="<?php echo e($directionsUrl); ?>" target="_blank" rel="noopener">Get directions</a></div>
            <?php endif; ?>
          </div>
          <p class="area-line"><?php echo e($siteName); ?> works in <?php echo e($address['city']); ?> and the surrounding North County San Diego area.</p>
        </aside>
      </div>
    </div>
  </section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
