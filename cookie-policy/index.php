<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Cookie Policy — Phase 5 (legal-compliance.md "Cookie Policy" template).
 * Lists what this build actually sets: p1_ft (includes/attribution.php, 30 days),
 * cookieBannerDismissed_v1 (localStorage, main.js), GA4 cookies only once the
 * placeholder ID is replaced, Google Maps only after the visitor clicks "Show the
 * map" on /contact/. Fonts are self-hosted (no Google Fonts requests).
 * ------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-vars.php';

$pageTitle       = 'Cookie Policy | Coastal Trim Lighting | San Marcos, CA';
$pageDescription = 'Which cookies and similar technologies the Coastal Trim Lighting website for San Marcos, CA uses, why, how long they last, and how to control or block them.';
$canonicalUrl    = $siteUrl . '/cookie-policy/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'cookie-policy';
$pageType        = 'other';
$heroPreloadImage = '';
$schemaMarkup    = p1_legal_schema($pageTitle, $pageDescription, $canonicalUrl, 'Cookie Policy');

$ckToc = [
    'what-are-cookies' => 'What cookies are', 'cookies-we-use' => 'Cookies we use', 'third-party' => 'Third-party content',
    'control' => 'Controlling cookies', 'ga-opt-out' => 'Google Analytics opt-out', 'notice' => 'Our cookie notice',
    'gpc' => 'Global Privacy Control', 'changes' => 'Changes', 'contact' => 'Contact us',
];

$ckRows = [
    ['name' => 'p1_ft', 'kind' => 'First-party cookie', 'purpose' => 'Remembers the page you first landed on, the site that referred you, campaign tags, a random session ID and your device type, so a request you send can be credited to the page or campaign that brought you here.', 'life' => '30 days'],
    ['name' => 'cookieBannerDismissed_v1', 'kind' => 'Local storage (strictly necessary)', 'purpose' => 'Remembers that you dismissed the cookie notice so it is not shown again.', 'life' => 'Until you clear site data'],
    ['name' => '_ga, _ga_&lt;ID&gt;', 'kind' => 'Google Analytics 4 (analytics)', 'purpose' => 'Distinguishes visitors and sessions to measure how the Site is used. Set only if we enable Google Analytics.', 'life' => 'Up to 2 years'],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* Cookie Policy — prefix .ck-. Tokens only. Solid hero, no motion. */
.ck-hero {
  background: linear-gradient(120deg, var(--color-dark) 0%, var(--color-dark-alt) 60%, var(--color-primary-deep) 100%);
}
.ck-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  background: radial-gradient(circle at 88% 30%, color-mix(in srgb, var(--color-accent) 22%, transparent) 0, transparent 22%), radial-gradient(circle at 76% 70%, color-mix(in srgb, var(--color-accent) 14%, transparent) 0, transparent 14%);
  pointer-events: none;
}
.ck-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .35;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.ck-page h1, .ck-page h2, .ck-page h3 { text-wrap: balance; }
.ck-page .legal-toc { border-top: 3px solid var(--color-accent); }
.ck-table { border: 1px solid var(--color-line); border-radius: var(--radius-lg); background: var(--color-surface); }
.ck-table table { margin: 0; }
.ck-table tbody th { font-family: var(--font-accent); font-size: var(--font-size-sm); letter-spacing: .02em; color: var(--color-primary); white-space: nowrap; }
.ck-table tbody tr:nth-child(even) { background: var(--color-card-tint-3); }
.ck-table tbody tr:last-child > * { border-bottom: 0; }
.ck-fonts { padding: var(--space-md) var(--space-lg); margin: var(--space-md) 0; background: var(--color-card-tint-2); border-radius: var(--radius); border-left: 4px solid var(--color-secondary); }
.ck-fonts p { margin: 0; }
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="ck-page">
  <!-- HERO — 40vh solid legal hero, Last Updated at the top, no reveal classes -->
  <section class="hero hero--legal ck-hero" aria-labelledby="legal-title">
    <div class="container">
      <div class="hero__copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li aria-current="page">Cookie Policy</li>
          </ol>
        </nav>
        <span class="eyebrow">Legal</span>
        <h1 id="legal-title">Cookie Policy</h1>
        <p class="section-subtitle">What this site stores in your browser</p>
        <p class="legal-updated">Last Updated: <time datetime="<?php echo e(date('Y-m-d', strtotime($lastUpdated))); ?>"><?php echo e($lastUpdated); ?></time></p>
      </div>
    </div>
  </section>

  <section class="section legal-body" aria-label="Cookie Policy text">
    <div class="container">
      <div class="legal-layout">
        <nav class="legal-toc" aria-label="On this page">
          <b>On this page</b>
          <ol>
            <?php foreach ($ckToc as $ckId => $ckLabel): ?>
            <li><a href="#<?php echo e($ckId); ?>"><?php echo e($ckLabel); ?></a></li>
            <?php endforeach; ?>
          </ol>
        </nav>

        <article class="legal-prose content-narrow">
          <h2 id="what-are-cookies">1. What Are Cookies?</h2>
          <p>Cookies are small text files a website stores on your device. Similar technologies, such as your browser's local storage, do the same job. They help a site work, remember your choices, and tell the site owner how visitors use it. This policy explains what <?php echo e($companyName); ?> uses on <?php echo e($companyDomain); ?> (the "Site") and should be read with our <a href="/privacy-policy/">Privacy Policy</a>.</p>

          <h2 id="cookies-we-use">2. Cookies and Similar Technologies We Use</h2>
          <div class="legal-table-wrap ck-table" tabindex="0" role="region" aria-label="Cookies used on this site">
            <table>
              <thead><tr><th scope="col">Name</th><th scope="col">Type</th><th scope="col">Purpose</th><th scope="col">Lasts</th></tr></thead>
              <tbody>
                <?php foreach ($ckRows as $ckRow): ?>
                <tr><th scope="row"><?php echo $ckRow['name']; ?></th><td><?php echo e($ckRow['kind']); ?></td><td><?php echo e($ckRow['purpose']); ?></td><td><?php echo e($ckRow['life']); ?></td></tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <h3>Strictly necessary</h3>
          <p>These keep the Site working and secure, for example remembering that you dismissed the cookie notice. Our hosting provider may also set short-lived technical cookies to protect the Site from attacks and balance traffic. They cannot be switched off on the Site, but you can block them in your browser.</p>
          <h3>Lead attribution</h3>
          <p>The <code>p1_ft</code> cookie is set by the Site itself, not by an advertising network. It is not used to show you ads or track you on other websites; it only lets us see which page or campaign led to a request you choose to send.</p>
          <h3>Analytics (Google Analytics 4)</h3>
          <p>If we enable Google Analytics 4, it sets cookies beginning with <code>_ga</code> to measure visits and page views. Google Analytics 4 does not log or store IP addresses.</p>
          <div class="ck-fonts">
            <p><strong>Fonts:</strong> the Site's fonts are stored on our own server. Loading a page does not contact Google Fonts or any other font service, and no font cookies are set.</p>
          </div>

          <h2 id="third-party">3. Third-Party Content</h2>
          <p>The map on our <a href="/contact/">contact page</a> loads from Google Maps only after you click "Show the map". Once loaded, Google may set its own cookies under the <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google Privacy Policy</a>. Links to our Google Business Profile, directions and review pages take you to Google's own sites, which follow Google's policies.</p>

          <h2 id="control">4. How to Control Cookies</h2>
          <p>Most browsers let you view, delete and block cookies and site data, either for all sites or only for third parties. Blocking all cookies may stop parts of some websites working. Instructions are in your browser's help pages: Google Chrome, Mozilla Firefox, Apple Safari and Microsoft Edge each have a "cookies and site data" section in their settings.</p>

          <h2 id="ga-opt-out">5. Opt Out of Google Analytics</h2>
          <p>You can stop Google Analytics from collecting data on any website by installing the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Google Analytics Opt-out Browser Add-on</a>.</p>

          <h2 id="notice">6. Our Cookie Notice</h2>
          <p>The Site shows a short cookie notice with a "Got it" button. Once you dismiss it, a local storage entry stops it from appearing again. Clear your browser's site data to see it again.</p>

          <h2 id="gpc">7. Global Privacy Control</h2>
          <p>We do not sell personal information or share it for cross-context behavioral advertising. If your browser sends a Global Privacy Control signal, we treat it as a request to opt out of any sale or sharing, as described in our <a href="/privacy-policy/#ccpa-rights">Privacy Policy</a>.</p>

          <h2 id="changes">8. Changes to This Policy</h2>
          <p>We may update this Cookie Policy when the Site changes. The "Last Updated" date at the top shows when it last changed.</p>

          <h2 id="contact">9. Contact Us</h2>
          <?php echo p1_legal_contact('Questions about cookies on this site? Contact:'); ?>
        </article>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
