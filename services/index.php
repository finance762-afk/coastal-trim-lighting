<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Services hub — /services/ (Phase 4). Lists every config.php service in the
 * required services-grid pattern (icon-led: no client photos on disk yet),
 * a "which service fits" chooser (signature), a mid-page CTA and a closing CTA.
 * Estimate tool not authorized (build-plan) → not referenced. Claims trace to
 * build-plan.json / config.php only.
 * ------------------------------------------------------------------------- */
$pageTitle       = 'Lighting Services in San Marcos, CA | Coastal Trim Lighting';
$pageDescription = 'Residential and commercial holiday lighting plus year-round landscape and outdoor lighting in San Marcos, CA from Coastal Trim Lighting. Call (760) 916-3716.';
$canonicalUrl    = $siteUrl . '/services/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'services';
$pageType        = 'other';
$heroPreloadImage = '';

/* Card copy per slug (required pattern: 1-sentence desc ≤ 14 words, exactly 3 bullets of 3-6 words). */
$svhCards = [
    'residential-holiday-lighting' => ['icon' => 'house', 'desc' => 'Holiday lights put up on San Marcos houses for the season.',
        'bullets' => ['Rooflines, trees and walkways', 'You stay off the ladder', 'Priced for your house'],
        'fit' => 'You want your house lit for the holidays, without the ladder work.'],
    'commercial-holiday-lighting' => ['icon' => 'building-2', 'desc' => 'Holiday lighting for businesses and commercial properties in North County.',
        'bullets' => ['Quoted for each property', 'Employees stay off ladders', 'Planned around approvals'],
        'fit' => 'You run or manage a business and want the property lit for the season.'],
    'landscape-lighting' => ['icon' => 'trees', 'desc' => 'Permanent outdoor lighting for paths, trees, entries and patios.',
        'bullets' => ['Lit every night, all year', 'Homes and commercial grounds', 'Quoted for your yard'],
        'fit' => 'You want paths, trees or the entry lit every night of the year.'],
];

$schemaItems = [];
$svhPos = 1;
foreach ($services as $svhSchemaSvc) {
    $schemaItems[] = ['@type' => 'ListItem', 'position' => $svhPos++, 'name' => $svhSchemaSvc['name'],
                      'url' => $siteUrl . '/services/' . $svhSchemaSvc['slug'] . '/'];
}
$svhCrumb = generateBreadcrumbSchema([['name' => 'Services', 'url' => '/services/']]);
unset($svhCrumb['@context']);
$svhCrumb['@id'] = $siteUrl . '/services/#breadcrumb';
$schemaMarkup = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => 'CollectionPage',
            '@id'         => $siteUrl . '/services/#webpage',
            'url'         => $siteUrl . '/services/',
            'name'        => $pageTitle,
            'description' => $pageDescription,
            'isPartOf'    => ['@type' => 'WebSite', 'url' => $siteUrl . '/'],
            'about'       => ['@id' => $siteUrl . '/#organization'],
            'breadcrumb'  => ['@id' => $svhCrumb['@id']],
            'mainEntity'  => ['@type' => 'ItemList', 'itemListElement' => $schemaItems],
            'speakable'   => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1', '.hero-answer', '.answer-block']],
        ],
        $svhCrumb,
    ],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   Services hub — warm-human. Prefix .svh-. Tokens only.
   =================================================================== */
.svh-page h1, .svh-page h2, .svh-page h3 { text-wrap: balance; }
.svh-page p { text-wrap: pretty; }

/* -- Hero: night-sky band, string-light glow (::before), grain (::after), star field -- */
section.svh-hero { padding-bottom: calc(var(--space-12) + var(--space-6)); }
.svh-hero {
  background:
    radial-gradient(1.5px 1.5px at 12% 22%, color-mix(in srgb, var(--color-white) 70%, transparent), transparent),
    radial-gradient(1.5px 1.5px at 34% 12%, color-mix(in srgb, var(--color-white) 55%, transparent), transparent),
    radial-gradient(2px 2px at 58% 30%, color-mix(in srgb, var(--color-accent-bright) 80%, transparent), transparent),
    radial-gradient(1.5px 1.5px at 76% 16%, color-mix(in srgb, var(--color-white) 60%, transparent), transparent),
    radial-gradient(1.5px 1.5px at 90% 40%, color-mix(in srgb, var(--color-white) 50%, transparent), transparent),
    linear-gradient(200deg, var(--color-primary-deep) 0%, var(--color-dark) 60%);
}
.svh-hero::before {
  content: "";
  position: absolute;
  inset: auto -10% -45% 30%;
  height: 110%;
  z-index: -1;
  background: radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 20%, transparent), transparent 70%);
  pointer-events: none;
}
.svh-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .45;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.svh-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.svh-hero .breadcrumb a:hover { color: var(--color-accent-bright); }
.svh-hero .breadcrumb [aria-current] { color: var(--color-white); }
.svh-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.svh-hero .hero-chips li { background: color-mix(in srgb, var(--color-white) 8%, transparent); border-color: color-mix(in srgb, var(--color-white) 20%, transparent); color: var(--color-white); }
.svh-hero .hero-chips svg { color: var(--color-accent-bright); }
.svh-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.svh-hero .link-call svg { color: var(--color-accent-bright); }
.svh-hero .hero-form-open { background: var(--color-accent); color: var(--color-ink); }
.svh-hero .hero-form-card { border-top: 4px solid var(--color-secondary); }

/* -- Services grid: three icon-led tinted cards, offset middle card -- */
.svh-services { background: var(--color-surface); }
.svh-services .section-title { max-width: 64ch; }
.svh-services .services-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); align-items: start; }
.svh-services .service-card-with-image:nth-child(2) { margin-top: var(--space-xl); }
.svh-services .service-card-with-image { border: 1px solid color-mix(in srgb, var(--color-primary) 14%, var(--color-line)); position: relative; }
.svh-services .service-card-with-image::after { content: ""; position: absolute; inset: auto var(--space-lg) 0; height: 3px; border-radius: var(--radius-full); background: linear-gradient(90deg, var(--color-accent), transparent); transform: scaleX(.25); transform-origin: left; transition: transform var(--transition-slow); }
.svh-services .service-card-with-image:hover::after { transform: scaleX(1); }
.svh-services .service-card__body { padding: var(--space-xl) var(--space-lg) var(--space-lg); }
.svh-services .service-card__icon { margin-top: 0; width: 60px; height: 60px; border-radius: var(--radius-lg); background: var(--color-surface); color: var(--color-primary); box-shadow: var(--shadow); }
.svh-services .service-card-with-image h3 { font-size: var(--fs-h3); }
.svh-services .prose { color: var(--color-ink-2); }

/* -- Chooser (signature): numbered rows on paper, hover slide -- */
.svh-chooser { background: var(--color-paper); }
.svh-chooser .section-head { max-width: 62ch; }
.svh-choices { display: grid; gap: 0; margin: 0; padding: 0; list-style: none; counter-reset: ch; border-top: 1px solid var(--color-line); }
.svh-choices li { counter-increment: ch; border-bottom: 1px solid var(--color-line); }
.svh-choice { display: grid; grid-template-columns: 72px minmax(0, 1.4fr) minmax(0, 1fr) 40px; gap: var(--space-lg); align-items: center; padding: var(--space-lg) var(--space-sm); color: var(--color-ink); text-decoration: none; transition: background var(--transition), padding var(--transition); }
.svh-choice::before { content: counter(ch, decimal-leading-zero); font-family: var(--font-accent); font-size: 2.4rem; line-height: 1; color: var(--color-accent-dark); }
.svh-choice:hover, .svh-choice:focus-visible { background: var(--color-card-tint-3); padding-left: var(--space-lg); }
.svh-choice .svh-if { font-family: var(--font-heading); font-size: var(--fs-h3); font-weight: 700; }
.svh-choice .svh-then { color: var(--color-primary); font-weight: 600; }
.svh-choice svg { color: var(--color-primary); transition: transform var(--transition); }
.svh-choice:hover svg { transform: translateX(6px); }

/* -- Mid-page CTA: dark band, wave top -- */
.svh-mid .container { grid-template-columns: minmax(0, 1.4fr) auto; }
.svh-mid h2 { margin: 0 0 var(--space-xs); }
.svh-mid .answer-block { margin: 0; background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.svh-mid .actions { flex-direction: column; align-items: stretch; }
.svh-mid .link-call { color: var(--color-white); justify-content: center; }
.svh-mid .link-call svg { color: var(--color-accent-bright); }
.svh-mid .floating-ring { top: -120px; left: 55%; }

/* -- Pricing: answer + three factor columns (white, curve top) -- */
.svh-pricing { background: var(--color-surface); }
.svh-pricing .section-head { max-width: 62ch; }
.svh-factors { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); }
.svh-factor { display: grid; gap: var(--space-sm); align-content: start; padding: var(--space-lg); border-radius: var(--radius-lg); border: 1px solid var(--color-line); background: var(--color-paper); }
.svh-factor:nth-child(2) { background: var(--color-card-tint-2); }
.svh-factor h3 { font-size: var(--font-size-base); margin: 0; color: var(--color-primary); }
.svh-factor ul { margin: 0; padding-left: var(--space-lg); color: var(--color-ink-2); font-size: var(--font-size-sm); display: grid; gap: var(--space-1); }
.svh-factor a { font-weight: 600; color: var(--color-primary); }

/* -- Closing CTA -- */
.svh-cta .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.svh-cta h2 { margin: 0; }
.svh-cta .answer-block { margin: 0 auto; text-align: left; background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.svh-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.svh-cta .link-call { color: var(--color-white); }
.svh-cta .link-call svg { color: var(--color-accent-bright); }

/* -- Responsive -- */
@media (max-width: 1000px) {
  .svh-services .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .svh-services .service-card-with-image:nth-child(2) { margin-top: 0; }
  .svh-mid .container { grid-template-columns: 1fr; }
  .svh-factors { grid-template-columns: 1fr; }
}
@media (max-width: 700px) {
  .svh-services .services-grid { grid-template-columns: 1fr; }
  .svh-choice { grid-template-columns: 52px minmax(0, 1fr); gap: var(--space-xs) var(--space-md); }
  .svh-choice::before { grid-row: span 2; font-size: 1.8rem; }
  .svh-choice svg { display: none; }
}

/* -- Breadcrumb row alignment + compact hero answer on phones -- */
.svh-hero .breadcrumb li { display: inline-flex; align-items: center; min-height: 44px; }
@media (max-width: 640px) {
  .svh-hero .hero-answer { font-size: var(--font-size-base); }
}
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>

<div class="svh-page">

  <!-- HERO — night-sky band, copy | form card -->
  <section class="hero hero--interior svh-hero">
    <div class="container">
      <div class="hero-grid hero-grid--form">
        <div class="hero-copy">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="/">Home</a></li>
              <li class="breadcrumb-sep" aria-hidden="true">/</li>
              <li aria-current="page">Services</li>
            </ol>
          </nav>
          <span class="eyebrow"><?php echo e(cityStateLine()); ?> · Services</span>
          <h1 class="hero-title"><span class="text-accent">Holiday and outdoor lighting</span> services in San Marcos, CA</h1>
          <p class="hero-answer">Coastal Trim Lighting offers three services in San Marcos and the surrounding North County San Diego area: holiday lighting for homes, holiday lighting for businesses and commercial properties, and landscape and outdoor lighting that stays up all year. Every job is priced for the property it is on.</p>
          <div class="hero-actions">
            <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
            <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
          </div>
          <ul class="hero-chips">
            <li><?php echo icon('calendar', 16); ?> Est. <?php echo (int) $yearEstablished; ?></li>
            <li><?php echo icon('sparkles', 16); ?> <?php echo count($services); ?> lighting services</li>
            <li><?php echo icon('users', 16); ?> Owner <?php echo e($ownerName); ?></li>
          </ul>
        </div>
        <?php echo p1_hero_form_card('hero', '', 'Which service do you need priced?', 'Pick a service and we will follow up.'); ?>
      </div>
    </div>
  </section>

  <!-- SERVICES — required grid pattern, every service (icon-led: no client photos yet) -->
  <section class="section svh-services" aria-label="Lighting services">
    <div class="container">
      <div class="section-title reveal-up">
        <span class="eyebrow-label">What We Do</span>
        <h2>Which <span class="text-accent">lighting services</span> does Coastal Trim Lighting offer in <span class="text-accent">San Marcos</span>?</h2>
        <p class="hero-answer">Coastal Trim Lighting offers residential holiday lighting, commercial holiday lighting, and landscape and outdoor lighting. The first two go up for the holiday season; the third is a permanent install for paths, trees, entries and patios that you use all year, on homes and on commercial grounds.</p>
        <span class="section-subtitle">Seasonal · Year-round · Homes · Businesses</span>
        <p class="prose">Owned by <?php echo e($ownerName); ?> and based on <?php echo e($address['street']); ?> in <?php echo e($address['city']); ?>, the company takes jobs within about <?php echo (int) $targetRadiusMiles; ?> miles. Each service page explains what to send for a quote.</p>
      </div>

      <div class="services-grid">
        <?php
        $svhTint = 0;
        foreach ($services as $svhSvc):
            $svhCard = $svhCards[$svhSvc['slug']] ?? null;
            if (!$svhCard) continue;
            $svhTint = ($svhTint % 3) + 1;
        ?>
        <article class="service-card-with-image card-tint-<?php echo $svhTint; ?> reveal-up reveal-delay-<?php echo $svhTint; ?>" id="<?php echo e($svhSvc['slug']); ?>">
          <div class="service-card__body">
            <div class="service-card__icon"><?php echo icon($svhCard['icon'], 28); ?></div>
            <h3><?php echo e($svhSvc['name']); ?></h3>
            <p class="service-card__desc"><?php echo e($svhCard['desc']); ?></p>
            <ul>
              <?php foreach ($svhCard['bullets'] as $svhBullet): ?>
              <li><?php echo e($svhBullet); ?></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?php echo e(serviceUrl($svhSvc)); ?>" class="service-card__cta" aria-label="Learn more about <?php echo e($svhSvc['name']); ?>">Learn more</a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- SIGNATURE — which service fits (numbered chooser rows) -->
  <section class="section svh-chooser edge-curve-top" aria-labelledby="svh-chooser-title">
    <div class="container">
      <div class="section-head reveal-left">
        <span class="eyebrow-label">Pick the right one</span>
        <h2 id="svh-chooser-title">Which <span class="text-accent">Coastal Trim Lighting</span> service fits what you want lit?</h2>
        <p class="answer-block">Choose by property and by season. A house lit for the holidays is residential holiday lighting; a business or commercial property lit for the holidays is commercial holiday lighting; lights you want on every night of the year are landscape and outdoor lighting.</p>
      </div>
      <ol class="svh-choices">
        <?php foreach ($services as $svhChoiceI => $svhChoiceSvc):
            $svhChoiceCard = $svhCards[$svhChoiceSvc['slug']] ?? null;
            if (!$svhChoiceCard) continue; ?>
        <li class="reveal-<?php echo $svhChoiceI % 2 ? 'right' : 'left'; ?> reveal-delay-<?php echo $svhChoiceI + 1; ?>">
          <a class="svh-choice" href="<?php echo e(serviceUrl($svhChoiceSvc)); ?>">
            <span class="svh-if"><?php echo e($svhChoiceCard['fit']); ?></span>
            <span class="svh-then"><?php echo e($svhChoiceSvc['name']); ?></span>
            <?php echo icon('arrow-right', 24); ?>
          </a>
        </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <!-- MID-PAGE CTA -->
  <section class="section cta-banner texture-grain edge-wave-top svh-mid" aria-labelledby="svh-mid-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate" aria-hidden="true"></span>
    <div class="container reveal-scale">
      <div>
        <span class="eyebrow-label">Not sure yet?</span>
        <h2 id="svh-mid-title">Want both <span class="text-accent">holiday and year-round</span> lighting on one property?</h2>
        <p class="answer-block">Ask for both in the same request. Coastal Trim Lighting handles holiday lighting and landscape lighting for homes and commercial properties in San Marcos and nearby North County towns, so one message with the address and everything you want lit, seasonal or permanent, covers the whole property.</p>
      </div>
      <div class="actions">
        <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> <?php echo e($phone); ?></a>
      </div>
    </div>
  </section>

  <!-- PRICING — how each service is priced, linking to the leaf pages -->
  <section class="section svh-pricing" aria-labelledby="svh-pricing-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">How pricing works</span>
        <h2 id="svh-pricing-title">How does Coastal Trim Lighting price a <span class="text-accent">lighting job</span>?</h2>
        <p class="answer-block">Coastal Trim Lighting prices every job for the property, with no flat packages. What moves the number is different for each service, so the columns below list the details to send with your request, and each service page explains them in full.</p>
      </div>
      <div class="svh-factors">
        <div class="svh-factor reveal-left reveal-delay-1">
          <h3>Holiday lighting on a house</h3>
          <ul><li>Roofline length and height</li><li>Tile or shingle roof</li><li>Trees, shrubs and walkways on the list</li></ul>
          <a href="<?php echo e(serviceUrl(['slug' => 'residential-holiday-lighting'])); ?>">What shapes a home holiday lighting price</a>
        </div>
        <div class="svh-factor reveal-up reveal-delay-2">
          <h3>Holiday lighting on a business</h3>
          <ul><li>Building frontage and shared areas</li><li>Who approves the display</li><li>Power and safe work hours</li></ul>
          <a href="<?php echo e(serviceUrl(['slug' => 'commercial-holiday-lighting'])); ?>">How a commercial holiday lighting quote works</a>
        </div>
        <div class="svh-factor reveal-right reveal-delay-3">
          <h3>Landscape and outdoor lighting</h3>
          <ul><li>Paths, trees, entry and patio</li><li>Fixtures already in the yard</li><li>Outlets and how lights switch on</li></ul>
          <a href="<?php echo e(serviceUrl(['slug' => 'landscape-lighting'])); ?>">What goes into a landscape lighting quote</a>
        </div>
      </div>
    </div>
  </section>

  <!-- CLOSING CTA -->
  <section class="section closing-cta texture-grain slant-top svh-cta" aria-labelledby="svh-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container-narrow reveal-up">
      <span class="eyebrow-label"><?php echo e($address['city']); ?> and North County</span>
      <h2 id="svh-cta-title">Ready to get a price for your <span class="text-accent">property</span>?</h2>
      <p class="answer-block">Send Coastal Trim Lighting the address, the service you need and what you want lit, or call <?php echo e($phone); ?>. The follow-up covers open dates and a price for that property, for a house or a commercial site in San Marcos and nearby towns.</p>
      <div class="actions">
        <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
