<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Terms of Service — Phase 5 (legal-compliance.md "Terms of Service" template).
 * Adapted: no "Insurance Claim Work" clause (not an insurance trade); no licence,
 * insurance, workers' comp, employee/subcontractor or financing statements —
 * none are confirmed in intake. Job specifics (lights supplied, how long they
 * stay up, removal, deposits) defer to the written quote/agreement.
 * Governing law: $companyState (state of formation not in intake → California).
 * ------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-vars.php';

$pageTitle       = 'Terms of Service | Coastal Trim Lighting | San Marcos, CA';
$pageDescription = 'Terms of Service for the Coastal Trim Lighting website and for holiday, landscape and outdoor lighting work in San Marcos, CA and North County San Diego.';
$canonicalUrl    = $siteUrl . '/terms/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'terms';
$pageType        = 'other';
$heroPreloadImage = '';
$schemaMarkup    = p1_legal_schema($pageTitle, $pageDescription, $canonicalUrl, 'Terms of Service');

$tosToc = [
    'agreement' => 'Agreement to terms', 'use' => 'Use of this website', 'estimates' => 'Estimates and quotes',
    'project-work' => 'Project work', 'holiday-lighting' => 'Holiday lighting jobs', 'warranties' => 'Warranties',
    'payment' => 'Payment', 'cancellation' => 'Cancellation and weather', 'text-messages' => 'Text messages',
    'liability' => 'Limitation of liability', 'ip' => 'Intellectual property', 'governing-law' => 'Governing law',
    'changes' => 'Changes', 'contact' => 'Contact us',
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* Terms of Service — prefix .tos-. Tokens only. Solid hero, no motion. */
.tos-hero {
  background: linear-gradient(160deg, var(--color-primary-deep) 0%, var(--color-dark) 70%);
}
.tos-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  background: repeating-linear-gradient(135deg, color-mix(in srgb, var(--color-white) 3%, transparent) 0 2px, transparent 2px 22px);
  pointer-events: none;
}
.tos-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .35;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.tos-page h1, .tos-page h2, .tos-page h3 { text-wrap: balance; }
.tos-page .legal-toc { border-top: 3px solid var(--color-primary); }
.tos-page .legal-toc ol { list-style: decimal-leading-zero; }
.tos-note { padding: var(--space-md) var(--space-lg); margin: 0 0 var(--space-xl); background: var(--color-card-tint-1); border-radius: var(--radius-lg); border: 1px solid color-mix(in srgb, var(--color-primary) 20%, var(--color-line)); }
.tos-note p { margin: 0; color: var(--color-ink); }
.tos-caps { font-size: var(--font-size-sm); letter-spacing: .01em; }
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="tos-page">
  <!-- HERO — 40vh solid legal hero, Last Updated at the top, no reveal classes -->
  <section class="hero hero--legal tos-hero" aria-labelledby="legal-title">
    <div class="container">
      <div class="hero__copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li aria-current="page">Terms of Service</li>
          </ol>
        </nav>
        <span class="eyebrow">Legal</span>
        <h1 id="legal-title">Terms of Service</h1>
        <p class="section-subtitle">The ground rules for this site and our work</p>
        <p class="legal-updated">Last Updated: <time datetime="<?php echo e(date('Y-m-d', strtotime($lastUpdated))); ?>"><?php echo e($lastUpdated); ?></time></p>
      </div>
    </div>
  </section>

  <section class="section legal-body" aria-label="Terms of Service text">
    <div class="container">
      <div class="legal-layout">
        <nav class="legal-toc" aria-label="On this page">
          <b>On this page</b>
          <ol>
            <?php foreach ($tosToc as $tosId => $tosLabel): ?>
            <li><a href="#<?php echo e($tosId); ?>"><?php echo e($tosLabel); ?></a></li>
            <?php endforeach; ?>
          </ol>
        </nav>

        <article class="legal-prose content-narrow">
          <div class="tos-note">
            <p>These Terms cover the <?php echo e($companyDomain); ?> website and the general terms of working with <?php echo e($companyName); ?>. The specific scope, price and schedule of any job are set out in the written quote or agreement for that job, and that document controls if it differs from these Terms.</p>
          </div>

          <h2 id="agreement">1. Agreement to Terms</h2>
          <p>By using <?php echo e($companyDomain); ?> (the "Site") or engaging <?php echo e($companyName); ?> ("we", "us", "our") for services, you agree to these Terms of Service. If you do not agree, please do not use the Site or our services.</p>

          <h2 id="use">2. Use of This Website</h2>
          <ul>
            <li>You may use the Site to learn about our services and contact us.</li>
            <li>You may not use the Site for any unlawful purpose, try to access non-public systems, scrape or copy content without written permission, submit false information or someone else's details through our forms, or use automated tools to submit forms or extract data.</li>
            <li>Information on the Site is general. It is not a quote, and it may change without notice.</li>
          </ul>

          <h2 id="estimates">3. Estimates and Quotes</h2>
          <p>Quotes are based on the information you give us and the conditions we can see at the time, such as roofline length and height, roof type, the areas you want lit, and where power is available. The final price may change if the scope changes, site conditions differ from what was described, material costs change before the job starts, or code requirements differ from what was assumed. Verbal estimates are not binding; only a written quote or agreement that you accept is.</p>

          <h2 id="project-work">4. Project Work</h2>
          <ul>
            <li>Each job is governed by the written quote or agreement for that job.</li>
            <li>Work is performed in line with applicable <?php echo e($companyState); ?> and local codes.</li>
            <li>You agree to give safe access to the areas being lit on the agreed dates, to tell us about anything that affects the work (for example fragile roofing, hidden wiring, sprinkler lines, pets or gate codes), and to obtain any landlord, property manager or homeowners association approval your property requires.</li>
            <li>Lighting runs on your property's power. You are responsible for the condition of your existing electrical service, outlets and circuits unless the work order says we will change them.</li>
          </ul>

          <h2 id="holiday-lighting">5. Holiday Lighting Jobs</h2>
          <p>For seasonal holiday lighting, the written quote or agreement states what is included, such as whether lights are supplied by us or by you, the install date, how long the display stays up, and whether removal is included. Please do not alter, move or add to an installed display without talking to us first, as that can affect safety and any warranty.</p>

          <h2 id="warranties">6. Warranties</h2>
          <p>Any workmanship warranty is described in your written quote or agreement. Manufacturer warranties on lights, fixtures and other materials come from those manufacturers and pass through to you where they allow it. Warranties do not cover damage from weather beyond a product's rating, power surges or outages, accidents, neglect, or changes made by others.</p>

          <h2 id="payment">7. Payment</h2>
          <p>Payment terms, including any deposit and when the balance is due, are set out in your written quote or agreement. Past-due balances may accrue interest and collection costs as permitted by <?php echo e($companyState); ?> law.</p>

          <h2 id="cancellation">8. Cancellation, Rescheduling and Weather</h2>
          <p>Cancellation terms are set out in your written quote or agreement. Outdoor lighting work depends on the weather; if rain, wind or other conditions make work unsafe, we may reschedule, and we will contact you to set a new date. If you need to reschedule, tell us as early as you can.</p>

          <h2 id="text-messages">9. Text Messages</h2>
          <p>If you opt in to text messages on our forms, you agree to receive texts from <?php echo e($companyName); ?> at the number you provided, which may include appointment reminders, service updates and promotional offers. Message frequency varies. Message and data rates may apply. Reply STOP to unsubscribe and HELP for help. Consent is not a condition of purchase. Carriers are not liable for delayed or undelivered messages. See our <a href="/privacy-policy/#sms-and-email">Privacy Policy</a> for details.</p>

          <h2 id="liability">10. Limitation of Liability</h2>
          <p class="tos-caps">To the maximum extent permitted by <?php echo e($companyState); ?> law, <?php echo e($companyName); ?>'s total liability for any claim related to the Site or our services will not exceed the amount you paid for the specific service that gave rise to the claim. We are not liable for indirect, incidental, special or consequential damages. The Site is provided "as is" without warranties of any kind. Nothing in these Terms limits any right you have that cannot be limited under applicable law.</p>

          <h2 id="ip">11. Intellectual Property</h2>
          <p>All content on the Site, including text, graphics, photographs and the <?php echo e($siteName); ?> name and logo, is owned by <?php echo e($companyName); ?> or used with permission and is protected by copyright and trademark law. You may not reproduce, distribute or create derivative works from it without written permission.</p>

          <h2 id="governing-law">12. Governing Law and Disputes</h2>
          <p>These Terms are governed by the laws of the State of <?php echo e($companyState); ?>, without regard to conflict-of-laws rules. Any dispute will be resolved in the state or federal courts located in <?php echo e($companyCounty); ?> County, <?php echo e($companyState); ?>, unless the law requires otherwise. Before filing a claim, please contact us so we can try to resolve it informally.</p>

          <h2 id="changes">13. Changes to These Terms</h2>
          <p>We may update these Terms at any time. The "Last Updated" date at the top shows the current version. Continued use of the Site after an update means you accept the revised Terms. Changes do not affect a written agreement already in place for a job.</p>

          <h2 id="contact">14. Contact Us</h2>
          <?php echo p1_legal_contact('Questions about these Terms? Contact:'); ?>
        </article>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
