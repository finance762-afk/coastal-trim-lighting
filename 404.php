<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * 404 — Phase 5. Served by .htaccess `ErrorDocument 404 /404.php`.
 * Sends a real 404 status (200 only when showing on-site search results) and
 * is noindexed. The search box filters the site's own page list in PHP — no
 * third-party search, no JavaScript. Links are gated on disk (pageExists /
 * serviceUrl) so the error page never links to another missing page.
 * ------------------------------------------------------------------------- */
$nfQuery = trim((string) ($_GET['q'] ?? ''));
$nfQuery = mb_substr($nfQuery, 0, 80);
http_response_code($nfQuery === '' ? 404 : 200);

$pageTitle       = 'Page Not Found | Coastal Trim Lighting | San Marcos, CA';
$pageDescription = 'This page could not be found. Find holiday, landscape and outdoor lighting information from Coastal Trim Lighting in San Marcos, CA, or call (760) 916-3716.';
$canonicalUrl    = $siteUrl . '/404';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = '404';
$pageType        = 'other';
$noindex         = true;
$heroPreloadImage = '';

/* Searchable page list: title, URL, keywords/description. */
$nfPages = [
    ['title' => 'Home', 'url' => '/', 'icon' => 'home', 'desc' => 'Holiday lighting, landscape lighting and outdoor lighting in San Marcos, CA.'],
    ['title' => 'All lighting services', 'url' => '/services/', 'icon' => 'sparkles', 'desc' => 'Holiday lighting for homes and businesses, plus landscape and outdoor lighting.'],
];
$nfIcons = ['residential-holiday-lighting' => 'house', 'commercial-holiday-lighting' => 'building-2', 'landscape-lighting' => 'trees'];
foreach ($services as $nfSvc) {
    $nfPages[] = ['title' => $nfSvc['name'], 'url' => serviceUrl($nfSvc), 'icon' => $nfIcons[$nfSvc['slug']] ?? 'sparkles', 'desc' => $nfSvc['description'], 'kw' => implode(' ', $nfSvc['keywords'] ?? [])];
}
$nfPages = array_merge($nfPages, [
    ['title' => 'About Coastal Trim Lighting', 'url' => '/about/', 'icon' => 'users', 'desc' => 'Owner ' . $ownerName . ', in business in San Marcos since ' . $yearEstablished . '.'],
    ['title' => 'FAQ', 'url' => '/faq/', 'icon' => 'message-square', 'desc' => 'Questions about pricing, permits, salt air, scheduling and service area.'],
    ['title' => 'Contact', 'url' => '/contact/', 'icon' => 'phone', 'desc' => 'Phone, email, address, map and the estimate request form.'],
    ['title' => 'Privacy Policy', 'url' => '/privacy-policy/', 'icon' => 'shield-check', 'desc' => 'How personal information, SMS consent and California privacy rights are handled.'],
    ['title' => 'Terms of Service', 'url' => '/terms/', 'icon' => 'clipboard-list', 'desc' => 'Terms for using this website and hiring Coastal Trim Lighting.'],
    ['title' => 'Cookie Policy', 'url' => '/cookie-policy/', 'icon' => 'info', 'desc' => 'Cookies, analytics and the cookie notice.'],
    ['title' => 'Accessibility Statement', 'url' => '/accessibility/', 'icon' => 'eye', 'desc' => 'WCAG 2.1 AA accessibility and how to report a barrier.'],
]);
$nfPages = array_values(array_filter($nfPages, fn($p) => $p['url'] === '/' || strpos($p['url'], '#') !== false || pageExists($p['url'])));

$nfResults = [];
if ($nfQuery !== '') {
    $nfTerms = array_filter(preg_split('/\s+/', mb_strtolower($nfQuery)));
    foreach ($nfPages as $nfP) {
        $hay = mb_strtolower($nfP['title'] . ' ' . $nfP['desc'] . ' ' . ($nfP['kw'] ?? ''));
        foreach ($nfTerms as $nfT) {
            if (mb_strlen($nfT) > 2 && mb_strpos($hay, $nfT) !== false) { $nfResults[] = $nfP; break; }
        }
    }
}
$nfPopular = array_slice($nfPages, 1, 6);   // skip Home (the hero button covers it) and the legal pages
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   404 — warm-human. Prefix .nf-. Tokens only.
   Signature: a string of lights with one bulb out.
   =================================================================== */
.nf-page h1, .nf-page h2, .nf-page h3 { text-wrap: balance; }
.nf-page p { text-wrap: pretty; }

/* -- Hero: night band, glow (::before), grain (::after), string with a dead bulb -- */
.nf-hero {
  text-align: center;
  background:
    radial-gradient(50% 60% at 50% 0%, color-mix(in srgb, var(--color-secondary) 34%, transparent), transparent 70%),
    linear-gradient(180deg, var(--color-dark) 0%, var(--color-dark-alt) 75%, var(--color-primary-deep) 100%);
}
.nf-hero::before {
  content: "";
  position: absolute;
  inset: auto 0 0 0;
  height: 40%;
  z-index: -1;
  background: radial-gradient(50% 100% at 50% 100%, color-mix(in srgb, var(--color-accent) 18%, transparent), transparent 70%);
  pointer-events: none;
}
.nf-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .45;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.nf-hero .container-narrow { display: grid; gap: var(--space-md); justify-items: center; }
.nf-string { display: flex; justify-content: center; gap: clamp(1rem, 4vw, 2.5rem); margin: 0 0 var(--space-sm); padding: var(--space-md) 0 0; border-top: 2px dashed color-mix(in srgb, var(--color-white) 25%, transparent); }
.nf-string i { position: relative; width: 18px; height: 26px; border-radius: 50% 50% 46% 46% / 40% 40% 60% 60%; background: var(--color-accent-bright); box-shadow: 0 0 18px 4px color-mix(in srgb, var(--color-accent) 55%, transparent); }
.nf-string i::before { content: ""; position: absolute; top: -8px; left: 4px; width: 10px; height: 8px; border-radius: var(--radius-sm); background: color-mix(in srgb, var(--color-white) 45%, var(--color-ink)); }
.nf-string i:nth-child(2) { background: var(--color-secondary); box-shadow: 0 0 18px 4px color-mix(in srgb, var(--color-secondary) 55%, transparent); }
.nf-string i:nth-child(4) { background: color-mix(in srgb, var(--color-accent) 70%, var(--color-danger)); }
.nf-string i.nf-out { background: color-mix(in srgb, var(--color-white) 18%, transparent); box-shadow: none; animation: nf-flicker 4s steps(1) infinite; }
@keyframes nf-flicker { 0%, 88% { opacity: .5; } 90% { opacity: 1; } 92% { opacity: .4; } 94% { opacity: .9; } 96%, 100% { opacity: .5; } }
.nf-code { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .18em; text-transform: uppercase; color: var(--color-accent-bright); }
.nf-hero .hero-title { margin-inline: auto; }
.nf-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.nf-hero .hero-answer { margin-inline: auto; max-width: 38rem; }
.nf-hero .hero-actions { justify-content: center; }
.nf-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.nf-hero .link-call svg { color: var(--color-accent-bright); }

/* -- Search -- */
.nf-search-form { display: flex; gap: var(--space-xs); width: min(100%, 520px); margin-top: var(--space-sm); padding: var(--space-xs); border-radius: var(--radius-full); background: var(--color-surface); box-shadow: var(--shadow-lg); }
.nf-search-form input { flex: 1; min-width: 0; min-height: 46px; padding: 0 var(--space-md); font: inherit; font-size: 16px; color: var(--color-ink); background: transparent; border: 0; border-radius: var(--radius-full); }
.nf-search-form input:focus { outline: 2px solid var(--color-primary); outline-offset: 0; }
.nf-search-form .btn { border-radius: var(--radius-full); }
.nf-results { width: min(100%, 520px); margin: 0; padding: var(--space-md) var(--space-lg); list-style: none; text-align: left; border-radius: var(--radius-lg); background: color-mix(in srgb, var(--color-white) 7%, transparent); border: 1px solid color-mix(in srgb, var(--color-accent) 30%, transparent); }
.nf-results li + li { margin-top: var(--space-xs); }
.nf-results a { color: var(--color-white); font-weight: 600; }
.nf-results p { margin: 0; font-size: var(--font-size-sm); }

/* -- Popular pages: tinted link cards (paper, curved top) -- */
.nf-popular { background: var(--color-paper); }
.nf-popular .section-head { margin-inline: auto; text-align: center; justify-items: center; }
.nf-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); margin: 0; padding: 0; list-style: none; }
.nf-card { display: grid; grid-template-columns: auto minmax(0, 1fr); gap: var(--space-xs) var(--space-md); align-items: start; align-content: start; height: 100%; padding: var(--space-lg); border-radius: var(--radius-lg); border: 1px solid var(--color-line); color: var(--color-ink); text-decoration: none; box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition); }
.nf-card:hover { transform: translateY(-4px); box-shadow: var(--shadow); border-color: var(--color-accent); }
.nf-grid li:nth-child(3n+1) .nf-card { background: var(--color-card-tint-1); }
.nf-grid li:nth-child(3n+2) .nf-card { background: var(--color-card-tint-2); }
.nf-grid li:nth-child(3n) .nf-card { background: var(--color-card-tint-3); }
.nf-card svg { grid-row: span 2; color: var(--color-accent-dark); }
.nf-card b { font-family: var(--font-heading); color: var(--color-primary); }
.nf-card span { font-size: var(--font-size-sm); color: var(--color-ink-2); }

/* -- CTA -- */
.nf-cta .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.nf-cta h2 { margin: 0; }
.nf-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.nf-cta .link-call { color: var(--color-white); }
.nf-cta .link-call svg { color: var(--color-accent-bright); }

@media (max-width: 900px) { .nf-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 600px) {
  .nf-grid { grid-template-columns: 1fr; }
  .nf-search-form { flex-direction: column; border-radius: var(--radius-lg); }
  .nf-search-form .btn { border-radius: var(--radius); }
}
@media (prefers-reduced-motion: reduce) { .nf-string i.nf-out { animation: none; } }
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="nf-page">

  <!-- 1. HERO — friendly message + search -->
  <section class="hero hero--interior nf-hero" aria-labelledby="nf-title">
    <div class="container-narrow">
      <div class="nf-string" aria-hidden="true"><i></i><i></i><i class="nf-out"></i><i></i><i></i></div>
      <span class="nf-code"><?php echo $nfQuery === '' ? 'Error 404 · Page not found' : 'Site search'; ?></span>
      <h1 class="hero-title" id="nf-title"><?php if ($nfQuery === ''): ?>Looks like this light <span class="text-accent">burned out</span><?php else: ?>Results for <span class="text-accent">“<?php echo e($nfQuery); ?>”</span><?php endif; ?></h1>
      <p class="hero-answer"><?php if ($nfQuery === ''): ?>The page you were after is not on the Coastal Trim Lighting site. It may have moved, or the link had a typo. Search below or pick a page.<?php else: ?><?php echo count($nfResults); ?> page<?php echo count($nfResults) === 1 ? '' : 's'; ?> on the Coastal Trim Lighting site matched your search.<?php endif; ?></p>

      <form class="nf-search-form" action="/404.php" method="get" role="search" aria-label="Search this site">
        <label for="nf-q" class="sr-only">Search the Coastal Trim Lighting site</label>
        <input id="nf-q" type="search" name="q" value="<?php echo e($nfQuery); ?>" placeholder="Try “holiday”, “landscape” or “pricing”" maxlength="80">
        <button type="submit" class="btn btn-primary"><?php echo icon('search', 18); ?> Search</button>
      </form>

      <?php if ($nfQuery !== ''): ?>
        <?php if ($nfResults): ?>
        <ul class="nf-results">
          <?php foreach ($nfResults as $nfR): ?>
          <li><a href="<?php echo e($nfR['url']); ?>"><?php echo e($nfR['title']); ?></a><p><?php echo e($nfR['desc']); ?></p></li>
          <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p class="hero-answer">Nothing matched. Try a shorter word, or call <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a> and ask.</p>
        <?php endif; ?>
      <?php endif; ?>

      <div class="hero-actions">
        <a class="btn btn-accent btn-lg" href="/">Back to the homepage</a>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
      </div>
    </div>
  </section>

  <!-- 2. POPULAR PAGES -->
  <section class="section nf-popular edge-curve-top" aria-labelledby="nf-popular-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Popular pages</span>
        <h2 id="nf-popular-title">Where would you like to go on the <span class="text-accent">Coastal Trim Lighting</span> site?</h2>
        <p>Start with the Coastal Trim Lighting services, the company story, or answers to common questions about holiday and landscape lighting in San Marcos.</p>
      </div>
      <ul class="nf-grid">
        <?php foreach ($nfPopular as $nfI => $nfP): ?>
        <li class="reveal-<?php echo ['left', 'up', 'right'][$nfI % 3]; ?> reveal-delay-<?php echo ($nfI % 3) + 1; ?>">
          <a class="nf-card" href="<?php echo e($nfP['url']); ?>">
            <?php echo icon($nfP['icon'], 26); ?>
            <b><?php echo e($nfP['title']); ?></b>
            <span><?php echo e($nfP['desc']); ?></span>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- 3. CTA -->
  <section class="section closing-cta texture-grain slant-top nf-cta" aria-labelledby="nf-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <span class="eyebrow-label">Skip the search</span>
      <h2 id="nf-cta-title">Looking for a <span class="text-accent">lighting price</span>?</h2>
      <p>Tell Coastal Trim Lighting the address and what you want lit, and the follow-up covers open dates and a price for your San Marcos home or business.</p>
      <div class="actions">
        <a class="btn btn-accent btn-lg" href="/contact/" data-open-estimate><?php echo e($estimateCtaLabel); ?></a>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
