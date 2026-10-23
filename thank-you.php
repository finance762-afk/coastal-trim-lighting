<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Thank-you — Phase 5. Every lead form's _next points here ($siteUrl/thank-you).
 * Noindexed ($noindex = true) and left out of sitemap.php. No reply-time promise:
 * intake does not say how fast the company answers web requests.
 * Review request link (build-phases.md / design-system F5) uses the GBP place_id.
 * ------------------------------------------------------------------------- */
$pageTitle       = 'Thank You | Coastal Trim Lighting | San Marcos, CA';
$pageDescription = 'Thanks for contacting Coastal Trim Lighting in San Marcos, CA. Your lighting request is in, and the company will follow up by phone or email.';
$canonicalUrl    = $siteUrl . '/thank-you';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'thank-you';
$pageType        = 'other';
$noindex         = true;
$heroPreloadImage = '';

$tyCards = [
    'residential-holiday-lighting' => ['icon' => 'house',      'line' => 'What shapes a holiday lighting price for a house.'],
    'commercial-holiday-lighting'  => ['icon' => 'building-2', 'line' => 'How approvals and power shape a commercial quote.'],
    'landscape-lighting'           => ['icon' => 'trees',      'line' => 'Which parts of a yard to light first, and why.'],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   Thank-you — warm-human. Prefix .ty-. Tokens only.
   Signature: the string lights all switch on.
   =================================================================== */
.ty-page h1, .ty-page h2, .ty-page h3 { text-wrap: balance; }
.ty-page p { text-wrap: pretty; }

/* -- Hero: night band, glow (::before), grain (::after), lights switching on -- */
.ty-hero {
  background:
    radial-gradient(60% 70% at 50% 110%, color-mix(in srgb, var(--color-accent) 28%, transparent), transparent 70%),
    linear-gradient(180deg, var(--color-dark) 0%, var(--color-dark-alt) 70%, var(--color-primary-deep) 100%);
}
.ty-hero::before {
  content: "";
  position: absolute;
  inset: 0 0 auto 0;
  height: 50%;
  z-index: -1;
  background: radial-gradient(40% 80% at 80% 0%, color-mix(in srgb, var(--color-secondary) 30%, transparent), transparent 70%);
  pointer-events: none;
}
.ty-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .45;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.ty-grid { display: grid; grid-template-columns: minmax(0, 1.2fr) minmax(0, .8fr); gap: clamp(2rem, 5vw, 4rem); align-items: center; }
.ty-hero .hero-copy { max-width: 40rem; }
.ty-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.ty-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.ty-hero .link-call svg { color: var(--color-accent-bright); }
.ty-check { width: 64px; height: 64px; display: grid; place-items: center; border-radius: var(--radius-full); background: var(--color-accent); color: var(--color-ink); box-shadow: 0 0 0 10px color-mix(in srgb, var(--color-accent) 20%, transparent); }
.ty-lights { display: flex; gap: var(--space-md); padding-top: var(--space-md); border-top: 2px dashed color-mix(in srgb, var(--color-white) 25%, transparent); }
.ty-lights i { width: 16px; height: 22px; border-radius: 50% 50% 46% 46% / 40% 40% 60% 60%; background: color-mix(in srgb, var(--color-white) 18%, transparent); animation: ty-on .5s var(--ease) forwards; }
.ty-lights i:nth-child(1) { animation-delay: .2s; --ty-c: var(--color-accent-bright); }
.ty-lights i:nth-child(2) { animation-delay: .45s; --ty-c: var(--color-secondary); }
.ty-lights i:nth-child(3) { animation-delay: .7s; --ty-c: var(--color-accent); }
.ty-lights i:nth-child(4) { animation-delay: .95s; --ty-c: var(--color-secondary); }
.ty-lights i:nth-child(5) { animation-delay: 1.2s; --ty-c: var(--color-accent-bright); }
@keyframes ty-on { to { background: var(--ty-c); box-shadow: 0 0 16px 4px color-mix(in srgb, var(--ty-c) 55%, transparent); } }

/* Next-steps card in the hero */
.ty-next { display: grid; gap: var(--space-sm); padding: var(--space-xl) var(--space-lg); border-radius: var(--radius-xl); background: var(--color-surface); color: var(--color-ink); border-top: 4px solid var(--color-accent); box-shadow: var(--shadow-lg); }
.ty-next h2 { margin: 0; font-size: var(--fs-h3); color: var(--color-ink); }
.ty-next .next-steps { margin: 0; }
.ty-next .next-steps li { color: var(--color-ink-2); }
.ty-next .ty-note { margin: 0; font-size: var(--font-size-sm); color: var(--color-muted); }
.ty-next .ty-note a { color: var(--color-primary); font-weight: 600; }

/* -- Services: link cards (paper, curved top) -- */
.ty-services { background: var(--color-paper); }
.ty-services .section-head { max-width: 62ch; }
.ty-cards { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); margin: 0; padding: 0; list-style: none; }
.ty-card { display: grid; gap: var(--space-xs); height: 100%; padding: var(--space-lg); border-radius: var(--radius-lg); border: 1px solid var(--color-line); color: var(--color-ink); text-decoration: none; box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition); }
.ty-card:hover { transform: translateY(-4px); box-shadow: var(--shadow); border-color: var(--color-accent); }
.ty-cards li:nth-child(3n+1) .ty-card { background: var(--color-card-tint-1); }
.ty-cards li:nth-child(3n+2) .ty-card { background: var(--color-card-tint-3); }
.ty-cards li:nth-child(3n) .ty-card { background: var(--color-card-tint-2); }
.ty-card svg { color: var(--color-accent-dark); }
.ty-card b { font-family: var(--font-heading); color: var(--color-primary); }
.ty-card span { font-size: var(--font-size-sm); color: var(--color-ink-2); }
.ty-more { margin: var(--space-xl) 0 0; display: flex; flex-wrap: wrap; gap: var(--space-sm) var(--space-lg); }
.ty-more a { color: var(--color-primary); font-weight: 600; }

/* -- Review request (dark, slant) -- */
.ty-review .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.ty-review h2 { margin: 0; }
.ty-stars { display: flex; gap: var(--space-xs); color: var(--color-star); }
.ty-review .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.ty-review .link-call { color: var(--color-white); }
.ty-review .link-call svg { color: var(--color-accent-bright); }

@media (max-width: 900px) {
  .ty-grid { grid-template-columns: 1fr; }
  .ty-cards { grid-template-columns: 1fr; }
}
@media (prefers-reduced-motion: reduce) {
  .ty-lights i { animation-duration: .01ms; animation-delay: 0s; }
}
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="ty-page">

  <!-- 1. HERO — confirmation + what happens next -->
  <section class="hero hero--interior ty-hero" aria-labelledby="ty-title">
    <div class="container">
      <div class="ty-grid">
        <div class="hero-copy">
          <span class="ty-check" aria-hidden="true"><?php echo icon('check', 32); ?></span>
          <span class="eyebrow">Request received</span>
          <h1 class="hero-title" id="ty-title">Thanks, your request is <span class="text-accent">in</span></h1>
          <p class="hero-answer">Your lighting request has reached Coastal Trim Lighting in San Marcos. The company will follow up by phone or email about open dates and a price for your property.</p>
          <div class="hero-actions">
            <a class="btn btn-accent btn-lg" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
            <a class="link-call" href="/">Back to the homepage</a>
          </div>
          <div class="ty-lights" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></div>
        </div>
        <aside class="ty-next" aria-labelledby="ty-next-title">
          <h2 id="ty-next-title">What happens next</h2>
          <ol class="next-steps">
            <li><strong>Coastal Trim Lighting reviews your request</strong>The address, the service and what you want lit.</li>
            <li><strong>You hear back by phone or email</strong>Watch for a call from <?php echo e($phone); ?> or an email from <?php echo e($email); ?>.</li>
            <li><strong>You get dates and a price</strong>Nothing goes up until you agree to it.</li>
          </ol>
          <p class="ty-note">Need to add something? Call <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a> or email <a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a>.</p>
        </aside>
      </div>
    </div>
  </section>

  <!-- 2. SERVICES — links back into the site -->
  <section class="section ty-services edge-curve-top" aria-labelledby="ty-services-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">While you wait</span>
        <h2 id="ty-services-title">Want to read up on your <span class="text-accent">lighting service</span>?</h2>
        <p>Each Coastal Trim Lighting service page explains what shapes the price and what to have ready, so your follow-up call goes quickly.</p>
      </div>
      <ul class="ty-cards">
        <?php $tyI = 0; foreach ($services as $tySvc): if (!isset($tyCards[$tySvc['slug']])) continue; $tyI++; ?>
        <li class="reveal-up reveal-delay-<?php echo $tyI; ?>">
          <a class="ty-card" href="<?php echo e(serviceUrl($tySvc)); ?>">
            <?php echo icon($tyCards[$tySvc['slug']]['icon'], 28); ?>
            <b><?php echo e($tySvc['name']); ?></b>
            <span><?php echo e($tyCards[$tySvc['slug']]['line']); ?></span>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
      <p class="ty-more reveal-up"><a href="/services/">All lighting services</a><a href="/faq/">Lighting FAQ</a><a href="/about/">About Coastal Trim Lighting</a></p>
    </div>
  </section>

  <!-- 3. REVIEW REQUEST — Google review link (GBP place_id) -->
  <section class="section closing-cta texture-grain slant-top ty-review" aria-labelledby="ty-review-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <span class="ty-stars" aria-hidden="true"><?php echo str_repeat(icon('star', 22), 5); ?></span>
      <h2 id="ty-review-title">Already a <span class="text-accent">Coastal Trim Lighting</span> customer?</h2>
      <p>Happy with our work? A Google review helps other San Marcos homeowners and businesses find Coastal Trim Lighting.</p>
      <div class="actions">
        <a class="btn btn-accent btn-lg" href="<?php echo e($reviewRequestUrl); ?>" target="_blank" rel="noopener">Leave us a Google review</a>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
