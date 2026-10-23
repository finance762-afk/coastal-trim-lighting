<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Accessibility Statement — Phase 5 (legal-compliance.md template).
 * Features listed are ones this build actually ships (skip link, focus ring,
 * reduced-motion, labelled forms, landmarks, alt text, fail-open reveals,
 * click-to-load map with a text address alternative).
 * The 5-business-day response target is the template default — confirm with the client.
 * ------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-vars.php';

$pageTitle       = 'Accessibility Statement | Coastal Trim Lighting | San Marcos';
$pageDescription = 'The Coastal Trim Lighting accessibility statement: our WCAG 2.1 AA goal, site features, known limitations, and how to report a barrier or get help.';
$canonicalUrl    = $siteUrl . '/accessibility/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'accessibility';
$pageType        = 'other';
$heroPreloadImage = '';
$schemaMarkup    = p1_legal_schema($pageTitle, $pageDescription, $canonicalUrl, 'Accessibility Statement');

$a11yToc = [
    'commitment' => 'Our commitment', 'conformance' => 'Conformance status', 'features' => 'Accessibility features',
    'limitations' => 'Known limitations', 'feedback' => 'Feedback', 'alternatives' => 'Other ways to reach us',
    'assessment' => 'How we assess', 'changes' => 'Changes', 'contact' => 'Contact us',
];
$a11yFeatures = [
    'Semantic HTML with header, navigation, main and footer landmarks',
    'A "Skip to main content" link as the first item on every page',
    'A visible focus outline on every link, button and form field',
    'Text alternatives (alt text) on meaningful images; decorative graphics are hidden from screen readers',
    'Body text and buttons designed to meet WCAG AA color contrast',
    'Layouts that reflow on small screens and at up to 200% zoom',
    'Animations switched off when your device asks for reduced motion, and page content that stays visible if scripts fail to load',
    'Labels tied to every form field, with required fields marked',
    'Keyboard access to the menu, the estimate dialog and the question-and-answer sections',
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* Accessibility Statement — prefix .a11y-. Tokens only. Solid hero, no motion. */
.a11y-hero {
  background: linear-gradient(200deg, var(--color-primary-deep) 0%, var(--color-dark) 65%);
}
.a11y-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  background: radial-gradient(50% 90% at 0% 100%, color-mix(in srgb, var(--color-secondary) 32%, transparent), transparent 70%);
  pointer-events: none;
}
.a11y-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .35;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.a11y-page h1, .a11y-page h2, .a11y-page h3 { text-wrap: balance; }
.a11y-page .legal-toc { border-top: 3px solid var(--color-secondary); }
.a11y-status { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-sm) var(--space-md); padding: var(--space-md) var(--space-lg); margin: 0 0 var(--space-xl); background: var(--color-card-tint-1); border-radius: var(--radius-lg); border: 1px solid color-mix(in srgb, var(--color-primary) 20%, var(--color-line)); }
.a11y-status b { font-family: var(--font-accent); font-size: 1.4rem; letter-spacing: .04em; color: var(--color-primary); }
.a11y-status span { color: var(--color-ink-2); }
.a11y-features { list-style: none; margin-left: 0; }
.a11y-features li { display: grid; grid-template-columns: auto minmax(0, 1fr); gap: var(--space-sm); align-items: start; }
.a11y-features svg { color: var(--color-success); margin-top: var(--space-1); }
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="a11y-page">
  <!-- HERO — 40vh solid legal hero, Last Updated at the top, no reveal classes -->
  <section class="hero hero--legal a11y-hero" aria-labelledby="legal-title">
    <div class="container">
      <div class="hero__copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li aria-current="page">Accessibility Statement</li>
          </ol>
        </nav>
        <span class="eyebrow">Legal</span>
        <h1 id="legal-title">Accessibility Statement</h1>
        <p class="section-subtitle">A site everyone can use</p>
        <p class="legal-updated">Last Updated: <time datetime="<?php echo e(date('Y-m-d', strtotime($lastUpdated))); ?>"><?php echo e($lastUpdated); ?></time></p>
      </div>
    </div>
  </section>

  <section class="section legal-body" aria-label="Accessibility Statement text">
    <div class="container">
      <div class="legal-layout">
        <nav class="legal-toc" aria-label="On this page">
          <b>On this page</b>
          <ol>
            <?php foreach ($a11yToc as $a11yId => $a11yLabel): ?>
            <li><a href="#<?php echo e($a11yId); ?>"><?php echo e($a11yLabel); ?></a></li>
            <?php endforeach; ?>
          </ol>
        </nav>

        <article class="legal-prose content-narrow">
          <div class="a11y-status">
            <b>WCAG 2.1 AA</b>
            <span>Target standard for <?php echo e($companyDomain); ?>. Status: partially conformant.</span>
          </div>

          <h2 id="commitment">1. Our Commitment</h2>
          <p><?php echo e($companyName); ?> wants everyone, including people with disabilities, to be able to find information about our lighting services and contact us through <?php echo e($companyDomain); ?> (the "Site"). We apply recognized accessibility standards to the Site and keep improving it.</p>

          <h2 id="conformance">2. Conformance Status</h2>
          <p>The Web Content Accessibility Guidelines (WCAG) define requirements for making web content more accessible to people with disabilities. The Site is designed to conform with WCAG 2.1 Level AA. It is currently <strong>partially conformant</strong>, meaning some content may not yet fully meet the standard. We are working to address any issues we find or that are reported to us.</p>

          <h2 id="features">3. Accessibility Features</h2>
          <ul class="a11y-features">
            <?php foreach ($a11yFeatures as $a11yF): ?>
            <li><?php echo icon('check-circle', 18); ?><span><?php echo e($a11yF); ?></span></li>
            <?php endforeach; ?>
          </ul>

          <h2 id="limitations">4. Known Limitations</h2>
          <ul>
            <li><strong>Third-party content:</strong> the Google map on our contact page and content from Google, such as reviews, are provided by Google and may not fully meet WCAG. Our full address and a "Get directions" link are always shown as text next to the map.</li>
            <li><strong>Documents:</strong> any PDF or other document we send you may not be fully accessible. Ask us and we will provide the information in another format.</li>
          </ul>

          <h2 id="feedback">5. Feedback and Reporting a Barrier</h2>
          <p>If something on the Site is hard to use, please tell us. Let us know the page address, what you were trying to do, and the device, browser or assistive technology you use. We aim to respond to accessibility feedback within 5 business days.</p>

          <h2 id="alternatives">6. Other Ways to Reach Us</h2>
          <p>If the Site does not work for you, you can get the same information and service by phone at <a href="tel:<?php echo e($companyPhoneE164); ?>"><?php echo e($companyPhone); ?></a>, by email at <a href="mailto:<?php echo e($companyEmail); ?>"><?php echo e($companyEmail); ?></a>, or by mail. We will provide information about our services in an alternative format on request.</p>

          <h2 id="assessment">7. How We Assess Accessibility</h2>
          <p>We assess the Site through self-evaluation: keyboard-only navigation checks, automated accessibility testing, and color contrast checks against WCAG 2.1 AA, repeated when pages change.</p>

          <h2 id="changes">8. Changes to This Statement</h2>
          <p>We review this statement as the Site changes. The "Last Updated" date at the top shows when it last changed.</p>

          <h2 id="contact">9. Contact Us</h2>
          <?php echo p1_legal_contact('To report an accessibility barrier or request an alternative format, contact:'); ?>
        </article>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
