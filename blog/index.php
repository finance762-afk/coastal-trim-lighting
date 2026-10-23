<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Blog — "coming soon" placeholder (Phase 6, Premium). The build writes NO
 * posts; real posts arrive later through the design-portal Blogs tab, which
 * adds includes/blog-data.php + /blog/{slug}/index.php. Until then this page
 * is noindex, follow and sitemap.php leaves /blog/ out. No homepage
 * "From the Blog" section.
 * ------------------------------------------------------------------------- */
$pageTitle       = 'Lighting Blog (Coming Soon) | Coastal Trim Lighting';
$pageDescription = 'Holiday and outdoor lighting articles from Coastal Trim Lighting in San Marcos, CA are coming soon. Call (760) 916-3716 with a lighting question now.';
$canonicalUrl    = $siteUrl . '/blog/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'blog';
$pageType        = 'blog';
$robotsContent   = 'noindex, follow';
$heroPreloadImage = '';

$schemaMarkup = [generateBreadcrumbSchema([['name' => 'Blog', 'url' => '/blog/']])];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   Blog placeholder — warm-human. Prefix .blg-. Tokens only.
   =================================================================== */
.blg-page h1, .blg-page h2, .blg-page h3 { text-wrap: balance; }
.blg-page p { text-wrap: pretty; }

/* -- Hero: night band, warm glow (::before), grain (::after), hanging bulbs -- */
section.blg-hero { padding-bottom: calc(var(--space-12) + var(--space-8)); }
.blg-hero { background: linear-gradient(170deg, var(--color-dark) 0%, var(--color-primary-deep) 100%); }
.blg-hero::before {
  content: "";
  position: absolute;
  inset: -30% -10% auto auto;
  width: 50%;
  aspect-ratio: 1;
  z-index: -1;
  border-radius: var(--radius-full);
  background: radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 24%, transparent), transparent);
  pointer-events: none;
}
.blg-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .45;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.blg-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.blg-hero .breadcrumb li { display: inline-flex; align-items: center; min-height: 44px; }
.blg-hero .breadcrumb [aria-current] { color: var(--color-white); }
.blg-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.blg-hero .hero-copy { display: grid; gap: var(--space-md); max-width: 46rem; }
.blg-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.blg-hero .link-call svg { color: var(--color-accent-bright); }
.blg-bulbs { position: absolute; left: 0; right: 0; bottom: var(--space-md); height: 56px; pointer-events: none; }
.blg-bulbs svg { width: 100%; height: 100%; }
.blg-bulbs .wire { fill: none; stroke: color-mix(in srgb, var(--color-white) 28%, transparent); stroke-width: 1.5; }
.blg-bulbs .bulb { fill: var(--color-accent); filter: drop-shadow(0 0 5px var(--color-accent)); animation: blg-twinkle 3s ease-in-out infinite; }
.blg-bulbs .bulb:nth-of-type(3n) { fill: var(--color-accent-bright); animation-delay: -1s; }
.blg-bulbs .bulb:nth-of-type(4n) { fill: color-mix(in srgb, var(--color-secondary) 60%, var(--color-white)); animation-delay: -2s; }
@keyframes blg-twinkle { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }

/* -- Coming-soon note + start-here links (paper, curved top) -- */
.blg-soon { background: var(--color-paper); }
.blg-soon .grid-asym { grid-template-columns: minmax(0, 1fr) minmax(0, 1.1fr); gap: clamp(2rem, 6vw, 5rem); align-items: start; }
.blg-soon-copy { display: grid; gap: var(--space-md); }
.blg-soon-copy p { margin: 0; max-width: var(--measure); color: var(--color-ink-2); }
.blg-links { display: grid; gap: var(--space-md); margin: 0; padding: 0; list-style: none; }
.blg-links a { display: grid; grid-template-columns: 48px minmax(0, 1fr) auto; gap: var(--space-md); align-items: center; padding: var(--space-lg); border-radius: var(--radius-lg); background: var(--color-surface); box-shadow: var(--shadow-sm); border: 1px solid var(--color-line); transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition); }
.blg-links a:hover { transform: translateX(4px); box-shadow: var(--shadow); border-color: var(--color-accent); }
.blg-links li:nth-child(1) a { background: var(--color-card-tint-1); }
.blg-links li:nth-child(2) a { background: var(--color-card-tint-2); }
.blg-links li:nth-child(3) a { background: var(--color-card-tint-3); }
.blg-links .blg-icon { width: 48px; height: 48px; display: grid; place-items: center; border-radius: var(--radius); background: var(--color-surface); color: var(--color-primary); box-shadow: var(--shadow-sm); }
.blg-links b { display: block; font-family: var(--font-heading); color: var(--color-ink); }
.blg-links span.blg-sub { font-size: var(--font-size-sm); color: var(--color-ink-2); }
.blg-links .blg-arrow { color: var(--color-accent-dark); }

/* -- Topics: three numbered columns (white, wave top) -- */
.blg-topics { background: var(--color-surface); }
.blg-topics .section-head { max-width: 62ch; }
.blg-topic-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); margin: var(--space-xl) 0 0; padding: 0; list-style: none; counter-reset: blg; }
.blg-topic-grid li { counter-increment: blg; position: relative; display: grid; gap: var(--space-xs); align-content: start; padding: var(--space-xl) var(--space-lg) var(--space-lg); border-radius: var(--radius-lg); background: var(--color-paper); border-top: 4px solid var(--color-secondary); box-shadow: var(--shadow-sm); }
.blg-topic-grid li::before { content: counter(blg, decimal-leading-zero); font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .14em; color: var(--color-accent-dark); }
.blg-topic-grid h3 { margin: 0; font-size: var(--fs-h3); color: var(--color-primary); }
.blg-topic-grid p { margin: 0; font-size: var(--font-size-sm); color: var(--color-ink-2); }

/* -- Closing CTA -- */
.blg-cta .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.blg-cta h2 { margin: 0; }
.blg-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.blg-cta .link-call { color: var(--color-white); }
.blg-cta .link-call svg { color: var(--color-accent-bright); }

@media (max-width: 900px) {
  .blg-soon .grid-asym, .blg-topic-grid { grid-template-columns: 1fr; }
}
@media (prefers-reduced-motion: reduce) {
  .blg-bulbs .bulb { animation: none; }
  .blg-links a { transition: none; }
}
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="blg-page">

  <!-- HERO -->
  <section class="hero hero--interior blg-hero">
    <div class="container">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li aria-current="page">Blog</li>
          </ol>
        </nav>
        <span class="eyebrow">Blog · Coming soon</span>
        <h1 class="hero-title">The Coastal Trim Lighting blog is <span class="text-accent">coming soon</span></h1>
        <p class="hero-answer">Articles on holiday and outdoor lighting for San Marcos homes and businesses are on the way. Until then, the service pages answer the common questions.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
          <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
        </div>
      </div>
    </div>
    <div class="blg-bulbs" aria-hidden="true">
      <svg viewBox="0 0 1200 56" preserveAspectRatio="none" focusable="false">
        <path class="wire" d="M0 8 Q 150 46 300 8 T 600 8 T 900 8 T 1200 8"/>
        <?php foreach ([[60, 22], [150, 30], [240, 22], [360, 22], [450, 30], [540, 22], [660, 22], [750, 30], [840, 22], [960, 22], [1050, 30], [1140, 22]] as $blgB): ?>
        <circle class="bulb" cx="<?php echo $blgB[0]; ?>" cy="<?php echo $blgB[1] + 6; ?>" r="5"/>
        <?php endforeach; ?>
      </svg>
    </div>
  </section>

  <!-- COMING SOON + START HERE -->
  <section class="section blg-soon edge-curve-top" aria-labelledby="blg-soon-title">
    <div class="container">
      <div class="grid-asym">
        <div class="blg-soon-copy reveal-left">
          <span class="eyebrow-label">In the meantime</span>
          <h2 id="blg-soon-title">Where can you read about <span class="text-accent">lighting</span> right now?</h2>
          <p class="answer-block">The Coastal Trim Lighting service pages already explain what shapes a holiday or landscape lighting price, what to tell us about your property, and how an install gets scheduled in San Marcos. Start with the one that matches your property.</p>
          <p>Have a question that is not covered? Ask it in your estimate request or call <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a>; the answers may become the first articles here.</p>
        </div>
        <ul class="blg-links reveal-right">
          <?php
          $blgIcons = ['residential-holiday-lighting' => 'house', 'commercial-holiday-lighting' => 'building-2', 'landscape-lighting' => 'trees'];
          $blgSubs = ['residential-holiday-lighting' => 'What shapes the price on a house, and how installs get scheduled.', 'commercial-holiday-lighting' => 'How a business or managed property gets quoted and approved.', 'landscape-lighting' => 'What to tell us about the paths, trees and patio you want lit.'];
          foreach ($services as $blgSvc): ?>
          <li><a href="<?php echo e(serviceUrl($blgSvc)); ?>">
            <span class="blg-icon"><?php echo icon($blgIcons[$blgSvc['slug']] ?? 'sparkles', 22); ?></span>
            <span><b><?php echo e($blgSvc['name']); ?></b><span class="blg-sub"><?php echo e($blgSubs[$blgSvc['slug']] ?? $blgSvc['description']); ?></span></span>
            <span class="blg-arrow"><?php echo icon('arrow-right', 20); ?></span>
          </a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>

  <!-- TOPICS — what the blog will cover (categories only; no posts until the portal adds them) -->
  <section class="section blg-topics edge-wave-top" aria-labelledby="blg-topics-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">What is coming</span>
        <h2 id="blg-topics-title">What will the Coastal Trim Lighting blog cover?</h2>
        <p class="answer-block">The Coastal Trim Lighting blog will cover three subjects: planning holiday lights for a house or business, choosing landscape and outdoor lighting, and the San Marcos conditions that change both, such as Santa Ana winds, winter rain and HOA rules.</p>
      </div>
      <ul class="blg-topic-grid">
        <li class="reveal-up reveal-delay-1"><h3>Holiday lighting</h3><p>What to light, what shapes the price, and how far ahead to plan for homes and businesses.</p></li>
        <li class="reveal-scale reveal-delay-2"><h3>Landscape and outdoor lighting</h3><p>Paths, trees, entries and patios lit every night of the year.</p></li>
        <li class="reveal-right reveal-delay-3"><h3>San Marcos conditions</h3><p>Hillside lots, wind, rain and community rules, and what each one changes. <a href="<?php echo e(areaUrl($serviceAreas[0])); ?>">Read the San Marcos page</a>.</p></li>
      </ul>
    </div>
  </section>

  <!-- CLOSING CTA -->
  <section class="section closing-cta texture-grain slant-top blg-cta" aria-labelledby="blg-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <span class="eyebrow-label">San Marcos lighting</span>
      <h2 id="blg-cta-title">Rather talk it through?</h2>
      <p>Send Coastal Trim Lighting your address and what you want lit, and you get a price for that property before anything goes up.</p>
      <div class="actions">
        <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
