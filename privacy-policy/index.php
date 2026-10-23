<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Privacy Policy — Phase 5 (legal-compliance.md "Privacy Policy" template).
 * Adapted to this build: forms post to the Page One leads endpoint (Formsubmit is
 * retired), the first-party attribution cookie (p1_ft) is disclosed, consent is
 * three unbundled checkboxes (email / SMS / terms), no photo uploads and no
 * insurance-claim sharing (not an insurance trade). #ccpa-rights is the target of
 * the footer "Do Not Sell or Share My Personal Information" link.
 * ------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-vars.php';

$pageTitle       = 'Privacy Policy | Coastal Trim Lighting | San Marcos, CA';
$pageDescription = 'How Coastal Trim Lighting in San Marcos, CA collects, uses and protects your information, your California privacy rights and our text terms. Questions? Call us.';
$canonicalUrl    = $siteUrl . '/privacy-policy/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'privacy-policy';
$pageType        = 'other';
$heroPreloadImage = '';
$schemaMarkup    = p1_legal_schema($pageTitle, $pageDescription, $canonicalUrl, 'Privacy Policy');

$ppToc = [
    'introduction' => 'Introduction', 'information-we-collect' => 'Information we collect',
    'how-we-use' => 'How we use it', 'how-we-share' => 'How we share it',
    'sms-and-email' => 'Texts and emails', 'your-rights' => 'Your privacy rights',
    'ccpa-rights' => 'California rights', 'retention' => 'Data retention', 'security' => 'Data security',
    'children' => "Children's privacy", 'third-party-links' => 'Third-party links',
    'changes' => 'Changes', 'governing' => 'Governing law', 'contact' => 'Contact us',
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* Privacy Policy — prefix .pp-. Tokens only. Solid hero, no motion. */
.pp-hero {
  background: linear-gradient(135deg, var(--color-dark) 0%, var(--color-primary-deep) 100%);
}
.pp-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  background: radial-gradient(45% 80% at 95% 20%, color-mix(in srgb, var(--color-secondary) 30%, transparent), transparent 70%);
  pointer-events: none;
}
.pp-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .35;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.pp-page h1, .pp-page h2, .pp-page h3 { text-wrap: balance; }
.pp-page .legal-toc { border-top: 3px solid var(--color-secondary); }
.pp-summary { display: grid; gap: var(--space-xs); padding: var(--space-lg); margin: 0 0 var(--space-xl); background: var(--color-card-tint-2); border-radius: var(--radius-lg); border: 1px solid color-mix(in srgb, var(--color-secondary) 25%, var(--color-line)); }
.pp-summary b { font-family: var(--font-heading); color: var(--color-primary); }
.pp-summary ul { margin-bottom: 0; }
.pp-rights { padding: var(--space-lg); margin: var(--space-md) 0; background: var(--color-surface); border: 1px solid var(--color-line); border-left: 4px solid var(--color-primary); border-radius: var(--radius); }
.pp-rights h3 { margin-top: 0; }
.pp-dnss { padding: var(--space-md) var(--space-lg); margin: var(--space-md) 0; background: var(--color-card-tint-3); border-radius: var(--radius); border: 1px dashed color-mix(in srgb, var(--color-accent) 50%, var(--color-line)); }
.pp-dnss p:last-child { margin-bottom: 0; }
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="pp-page">
  <!-- HERO — 40vh solid legal hero, Last Updated at the top, no reveal classes -->
  <section class="hero hero--legal pp-hero" aria-labelledby="legal-title">
    <div class="container">
      <div class="hero__copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li aria-current="page">Privacy Policy</li>
          </ol>
        </nav>
        <span class="eyebrow">Legal</span>
        <h1 id="legal-title">Privacy Policy</h1>
        <p class="section-subtitle">Your information and how we handle it</p>
        <p class="legal-updated">Last Updated: <time datetime="<?php echo e(date('Y-m-d', strtotime($lastUpdated))); ?>"><?php echo e($lastUpdated); ?></time></p>
      </div>
    </div>
  </section>

  <section class="section legal-body" aria-label="Privacy Policy text">
    <div class="container">
      <div class="legal-layout">
        <nav class="legal-toc" aria-label="On this page">
          <b>On this page</b>
          <ol>
            <?php foreach ($ppToc as $ppId => $ppLabel): ?>
            <li><a href="#<?php echo e($ppId); ?>"><?php echo e($ppLabel); ?></a></li>
            <?php endforeach; ?>
          </ol>
        </nav>

        <article class="legal-prose content-narrow">
          <div class="pp-summary">
            <b>The short version</b>
            <ul>
              <li>We collect what you send us through our forms or by phone and email, plus basic information about how you reached and used this site.</li>
              <li>We use it to answer your request, price and schedule your lighting work, and understand which pages bring in inquiries.</li>
              <li>We do <strong>not</strong> sell your personal information or share it for cross-context behavioral advertising.</li>
              <li>Texts and marketing emails are opt-in only. Reply STOP to any text to stop them.</li>
            </ul>
          </div>

          <h2 id="introduction">1. Introduction</h2>
          <p>This Privacy Policy explains how <?php echo e($companyName); ?> ("we", "us", "our"), a lighting contractor located at <?php echo e($companyAddress); ?>, collects, uses, shares and protects personal information when you visit <?php echo e($companyDomain); ?> (the "Site"), submit a form on the Site, or contact us about our holiday lighting and landscape and outdoor lighting services. It also serves as our notice at collection for California residents.</p>

          <h2 id="information-we-collect">2. Information We Collect</h2>
          <h3>Information you give us</h3>
          <ul>
            <li><strong>Contact details:</strong> your name, phone number and email address.</li>
            <li><strong>Request details:</strong> the service you are interested in, your message, and any property address or project details you include.</li>
            <li><strong>Consent choices:</strong> whether you opted in to emails or text messages, your acceptance of our Terms, the consent version and the page where you gave consent, with the date and time.</li>
            <li><strong>Phone, email and in-person communications</strong> with us about a quote or a job.</li>
          </ul>
          <h3>Information collected automatically</h3>
          <ul>
            <li><strong>Visit and referral information:</strong> the page you first landed on, the website or search engine that referred you, advertising campaign tags (UTM parameters) and ad click identifiers (such as a Google click ID), a random session identifier, and your device type (desktop, tablet or phone). This is stored in a first-party cookie for 30 days and sent with any form you submit, so we can tell which pages and campaigns lead to inquiries.</li>
            <li><strong>Technical information:</strong> IP address, browser type, the pages you request and timestamps, recorded in standard server logs by our hosting provider and used to keep the Site secure.</li>
            <li><strong>Analytics:</strong> if we enable Google Analytics 4, it collects information about pages visited and how the Site is used.</li>
            <li><strong>Cookies and similar technologies:</strong> described in our <a href="/cookie-policy/">Cookie Policy</a>.</li>
          </ul>

          <h2 id="how-we-use">3. How We Use Your Information</h2>
          <ul>
            <li>Respond to your inquiry and provide the services you ask for.</li>
            <li>Prepare quotes, schedule installs, and communicate with you before, during and after a job.</li>
            <li>Send emails or text messages, only where you have opted in (see Section 5).</li>
            <li>Understand which pages, searches and advertising campaigns bring in inquiries, and improve the Site.</li>
            <li>Detect and block spam and abuse of our forms.</li>
            <li>Keep business, tax and warranty records and comply with legal obligations.</li>
          </ul>

          <h2 id="how-we-share">4. How We Share Your Information</h2>
          <p>We do <strong>not</strong> sell personal information, and we do not share it for cross-context behavioral advertising. We share it only as follows:</p>
          <ul>
            <li><strong>Service providers</strong> that work on our behalf under confidentiality obligations:
              <ul>
                <li>Page One Insights, LLC, our website design and hosting partner, which operates the system that receives and stores form submissions, forwards them to us by email, and keeps a record of the consent you give on our forms;</li>
                <li>our website hosting provider;</li>
                <li>Google, if we enable Google Analytics, and if you choose to load the map on our contact page;</li>
                <li>the email and phone services we use to reply to you.</li>
              </ul>
            </li>
            <li><strong>Suppliers and subcontractors</strong>, only the details they need to complete your job.</li>
            <li><strong>Legal compliance:</strong> when required by <?php echo e($companyState); ?> or federal law, a court order, or to protect our rights or the safety of others.</li>
            <li><strong>Business transfers:</strong> if the business is sold or merged, personal information may transfer to the new owner under this policy.</li>
          </ul>

          <h2 id="sms-and-email">5. Text Messages, Phone Calls and Email (TCPA)</h2>
          <p>Our forms have three separate checkboxes. None is pre-checked, and only the Terms checkbox is required to send a request.</p>
          <ul>
            <li><strong>Text messages (optional):</strong> if you check the SMS box, you agree to receive text messages from <?php echo e($companyName); ?> at the number you provided. Messages may include appointment reminders, service updates and promotional offers. Message frequency varies. Message and data rates may apply. Reply <strong>STOP</strong> to unsubscribe and <strong>HELP</strong> for help. Consent is not a condition of purchase.</li>
            <li><strong>Email (optional):</strong> if you check the email box, you agree to receive emails about your inquiry, our services, promotions and news. Every marketing email includes an unsubscribe link.</li>
            <li><strong>Calls and replies about your request:</strong> when you send a request, we will contact you by phone or email to respond to it.</li>
          </ul>
          <p>You can withdraw consent at any time by any reasonable method, including replying STOP, using an unsubscribe link, telling us on a call, or emailing <a href="mailto:<?php echo e($companyEmail); ?>"><?php echo e($companyEmail); ?></a>. We do not sell or share your mobile number or text-message consent with third parties for their own marketing.</p>

          <h2 id="your-rights">6. Your Privacy Rights</h2>
          <p>Wherever you live, you may ask us what personal information we hold about you, and ask us to correct or delete it. Contact us using the details in Section 13.</p>

          <div class="pp-rights">
            <h3 id="ccpa-rights">California Residents (CCPA / CPRA)</h3>
            <p>If you are a California resident, the California Consumer Privacy Act, as amended by the California Privacy Rights Act, gives you these rights:</p>
            <ul>
              <li><strong>Right to know</strong> the categories and specific pieces of personal information we collect, use and disclose, and why.</li>
              <li><strong>Right to delete</strong> personal information we collected from you, subject to legal exceptions (for example, records we must keep).</li>
              <li><strong>Right to correct</strong> inaccurate personal information.</li>
              <li><strong>Right to opt out of the sale or sharing</strong> of personal information.</li>
              <li><strong>Right to limit</strong> the use of sensitive personal information. We do not collect sensitive personal information through the Site.</li>
              <li><strong>Right to non-discrimination</strong>: we will not deny service or charge different prices because you exercised a right.</li>
            </ul>
            <p><strong>Categories collected in the past 12 months:</strong> identifiers (name, phone, email, IP address, session ID); commercial information (the services you asked about); internet activity (pages visited, referring site, campaign tags); and any property address you give us. Sources: you, your device, and the services listed in Section 4. Purposes: those in Section 3.</p>

            <div class="pp-dnss">
              <p><strong>Do Not Sell or Share My Personal Information.</strong> We do not sell personal information and do not share it for cross-context behavioral advertising, and we have not done so in the past 12 months. You may still submit an opt-out request for our records by emailing <a href="mailto:<?php echo e($companyEmail); ?>?subject=Do%20Not%20Sell%20or%20Share"><?php echo e($companyEmail); ?></a> or calling <a href="tel:<?php echo e($companyPhoneE164); ?>"><?php echo e($companyPhone); ?></a>. We also treat a Global Privacy Control (GPC) browser signal as a valid opt-out request.</p>
            </div>

            <p><strong>How to exercise your rights:</strong> email <a href="mailto:<?php echo e($companyEmail); ?>"><?php echo e($companyEmail); ?></a> or call <a href="tel:<?php echo e($companyPhoneE164); ?>"><?php echo e($companyPhone); ?></a>. We will verify your request by matching information you give us with information we hold, and we respond within 45 days. We will confirm in writing when an opt-out or deletion request has been carried out. You may use an authorized agent; we may ask for proof of the agent's authority.</p>
          </div>

          <h3 id="state-rights">Residents of Other States</h3>
          <p>Residents of states with comprehensive consumer privacy laws, including Colorado, Connecticut, Delaware, Indiana, Iowa, Kentucky, Maryland, Minnesota, Montana, Nebraska, New Hampshire, New Jersey, Oregon, Rhode Island, Tennessee, Texas, Utah and Virginia, may have similar rights to access, correct, delete and opt out, and to appeal our decision on a request. Contact us the same way to make a request or an appeal.</p>

          <h2 id="retention">7. Data Retention</h2>
          <p>We keep form submissions, consent records and job records for as long as we need them to provide our services and meet legal, tax and warranty obligations, typically 5 to 7 years for business records. Inquiries that do not turn into a job are kept for a shorter period unless the law requires otherwise. The attribution cookie expires after 30 days.</p>

          <h2 id="security">8. Data Security</h2>
          <p>We use reasonable administrative, technical and physical safeguards, including HTTPS encryption on every page and form submission and access-restricted storage for form data. No system is completely secure, so we cannot guarantee absolute security, but we work to limit the risk.</p>

          <h2 id="children">9. Children's Privacy</h2>
          <p>The Site is not directed to children under 13, and we do not knowingly collect personal information from them. We do not sell or share the personal information of anyone under 16. If you believe a child has sent us information, contact us and we will delete it.</p>

          <h2 id="third-party-links">10. Third-Party Links</h2>
          <p>The Site links to third-party sites such as Google Maps and our Google Business Profile. Their privacy practices are their own; please review their policies.</p>

          <h2 id="changes">11. Changes to This Policy</h2>
          <p>We may update this Privacy Policy. The "Last Updated" date at the top shows when it last changed, and material changes will be posted on this page.</p>

          <h2 id="governing">12. Governing Law</h2>
          <p>This policy is governed by the laws of the State of <?php echo e($companyState); ?> and applicable federal law.</p>

          <h2 id="contact">13. Contact Us</h2>
          <?php echo p1_legal_contact('For privacy questions, or to exercise any of the rights above, contact:'); ?>
        </article>
      </div>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
