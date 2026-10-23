<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Contact — Phase 5 (archetype: warm-human). Full lead form (form id: contact).
 * FORM: posts to the Page One leads endpoint ($formAction = build-plan form_action).
 *   The endpoint reads `service` (stored as portal_leads.service_requested), `_honey`,
 *   and `_consent_version` / `_consent_page` — so the dropdown is name="service",
 *   p1_lead_hidden_fields() supplies _honey/_next/attribution/spam shield, and the
 *   underscore consent fields are added explicitly below. `_honeypot` is a second trap.
 * MAP: integrations.gbp_map_embed is null → click-to-load map of the published
 *   address (no Google request until the visitor asks for it). When $gbpMapEmbed is
 *   set in config.php, that embed renders instead.
 * HOURS: business_hours is empty → no hours published (logged for the client).
 * ------------------------------------------------------------------------- */
$pageTitle       = 'Contact Coastal Trim Lighting | San Marcos, CA Lighting';
$pageDescription = 'Contact Coastal Trim Lighting in San Marcos, CA for holiday, landscape and outdoor lighting. Call (760) 916-3716, email us, or send the form for a price.';
$canonicalUrl    = $siteUrl . '/contact/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'contact';
$pageType        = 'contact';
$heroPreloadImage = '';

$schemaMarkup = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => 'ContactPage',
            '@id'         => $canonicalUrl . '#webpage',
            'url'         => $canonicalUrl,
            'name'        => $pageTitle,
            'description' => $pageDescription,
            'isPartOf'    => ['@type' => 'WebSite', 'url' => $siteUrl . '/'],
            'about'       => ['@id' => $siteUrl . '/#organization'],
            'breadcrumb'  => ['@id' => $canonicalUrl . '#breadcrumb'],
        ],
        ['@id' => $canonicalUrl . '#breadcrumb'] + array_diff_key(generateBreadcrumbSchema([['name' => 'Contact', 'url' => '/contact/']]), ['@context' => 1]),
    ],
];

$ctFullAddress = $address['street'] . ', ' . cityStateLine(true);
$ctMapSrc      = 'https://www.google.com/maps?q=' . rawurlencode($siteName . ', ' . $ctFullAddress) . '&output=embed';

$ctServiceLinks = [
    'residential-holiday-lighting' => ['icon' => 'house',      'line' => 'Holiday lights on your house: rooflines, trees and walkways.'],
    'commercial-holiday-lighting'  => ['icon' => 'building-2', 'line' => 'Holiday lighting for a business or commercial property.'],
    'landscape-lighting'           => ['icon' => 'trees',      'line' => 'Permanent lighting for paths, trees, entries and patios.'],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   Contact — warm-human. Prefix .ct-. Tokens only.
   Signature: lantern-lit contact rail beside the full form.
   =================================================================== */
.ct-page h1, .ct-page h2, .ct-page h3 { text-wrap: balance; }
.ct-page p { text-wrap: pretty; }

/* -- Hero: compact night band, porch-light glow (::before), grain (::after) -- */
.ct-hero {
  background:
    radial-gradient(40% 80% at 92% 30%, color-mix(in srgb, var(--color-accent) 26%, transparent), transparent 70%),
    linear-gradient(150deg, var(--color-dark) 0%, var(--color-dark-alt) 60%, var(--color-primary-deep) 100%);
}
.ct-hero::before {
  content: "";
  position: absolute;
  right: clamp(1rem, 8vw, 9rem);
  top: calc(var(--nav-height) + var(--space-lg));
  width: 180px;
  height: 180px;
  z-index: -1;
  border-radius: var(--radius-full);
  background: radial-gradient(closest-side, color-mix(in srgb, var(--color-accent-bright) 45%, transparent), transparent);
  filter: blur(4px);
  animation: ct-glow 6s ease-in-out infinite alternate;
  pointer-events: none;
}
.ct-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .45;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
@keyframes ct-glow { from { opacity: .55; transform: scale(.94); } to { opacity: 1; transform: scale(1.04); } }
.ct-hero .hero-copy { max-width: 44rem; }
.ct-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.ct-hero .hero-answer { max-width: 40rem; }
.ct-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.ct-hero .breadcrumb a:hover { color: var(--color-accent-bright); }
.ct-hero .breadcrumb [aria-current] { color: var(--color-white); }
.ct-hero .hero-chips li { background: color-mix(in srgb, var(--color-white) 7%, transparent); border-color: color-mix(in srgb, var(--color-accent) 35%, transparent); color: var(--color-white); }
.ct-hero .hero-chips a { color: inherit; text-decoration: none; }
.ct-hero .hero-chips svg { color: var(--color-accent-bright); }
.ct-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.ct-hero .link-call svg { color: var(--color-accent-bright); }

/* -- Main: form card | contact rail (asymmetric) -- */
.ct-main { background: var(--color-paper); }
.ct-grid { display: grid; grid-template-columns: minmax(0, 1.35fr) minmax(0, .85fr); gap: clamp(2rem, 5vw, 4rem); align-items: start; }
.ct-form-card { position: relative; display: grid; gap: var(--space-md); padding: clamp(1.5rem, 3vw, 2.5rem); background: var(--color-surface); border-radius: var(--radius-xl); border-top: 5px solid var(--color-primary); box-shadow: var(--shadow-lg); }
.ct-form-card::after { content: ""; position: absolute; right: var(--space-lg); top: calc(-1 * var(--space-md)); width: 28px; height: 28px; border-radius: 50% 50% 46% 46% / 40% 40% 60% 60%; background: var(--color-accent); box-shadow: 0 0 22px 6px color-mix(in srgb, var(--color-accent) 45%, transparent); }
.ct-form-card h2 { margin: 0; }
.ct-form-card > p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
.ct-form .form-grid { gap: var(--space-md); }
.ct-form .field label { transition: color var(--transition); }
.ct-form .field:focus-within label { color: var(--color-primary); }
.ct-form .field input, .ct-form .field select, .ct-form .field textarea { background: var(--color-paper); transition: border-color var(--transition), box-shadow var(--transition), background var(--transition); }
.ct-form .field input:focus, .ct-form .field select:focus, .ct-form .field textarea:focus { background: var(--color-surface); }
.ct-form textarea { min-height: 120px; resize: vertical; }
.ct-form .form-consent-fieldset { display: grid; gap: var(--space-xs); padding: var(--space-md); border: 1px solid var(--color-line); border-radius: var(--radius); background: var(--color-paper-2); }
.ct-form .form-consent-item { margin: 0; font-size: var(--font-size-xs); line-height: 1.5; }
.ct-form .form-consent-required { padding-top: var(--space-xs); border-top: 1px dashed var(--color-line); }
.ct-form .required-star { color: var(--color-danger); font-weight: 700; }
.ct-form .form-footnote a { color: var(--color-primary); font-weight: 600; }

.ct-rail { display: grid; gap: var(--space-md); }
.ct-rail h2 { font-size: var(--fs-h3); margin: 0; }
.ct-methods { display: grid; gap: var(--space-sm); margin: 0; padding: 0; list-style: none; }
.ct-method { display: grid; grid-template-columns: auto minmax(0, 1fr); gap: var(--space-md); align-items: center; padding: var(--space-md) var(--space-lg); border-radius: var(--radius-lg); background: var(--color-surface); border: 1px solid var(--color-line); box-shadow: var(--shadow-sm); transition: transform var(--transition), border-color var(--transition); }
.ct-method:hover { transform: translateX(4px); border-color: var(--color-accent); }
.ct-method:nth-child(3n+1) { background: var(--color-card-tint-1); }
.ct-method:nth-child(3n+2) { background: var(--color-card-tint-3); }
.ct-method:nth-child(3n) { background: var(--color-card-tint-2); }
.ct-method-icon { width: 48px; height: 48px; display: grid; place-items: center; border-radius: var(--radius-full); color: var(--color-accent-dark); background: radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 30%, transparent), transparent); }
.ct-method b { display: block; font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .14em; text-transform: uppercase; color: var(--color-muted); }
.ct-method a, .ct-method span.ct-val { font-weight: 600; color: var(--color-ink); text-decoration: none; overflow-wrap: anywhere; }
.ct-method a:hover { color: var(--color-primary); }
.ct-next { padding: var(--space-lg); border-radius: var(--radius-lg); background: var(--color-surface); border: 1px dashed color-mix(in srgb, var(--color-primary) 35%, var(--color-line)); }
.ct-next h3 { font-size: var(--font-size-base); margin: 0; }

/* -- Map: facade / embed + address card (white, curved top) -- */
.ct-map { background: var(--color-surface); }
.ct-map-grid { display: grid; grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr); gap: clamp(1.5rem, 4vw, 3rem); align-items: center; }
.ct-map .map-embed { box-shadow: var(--shadow-lg); border: 1px solid var(--color-line); }
.ct-map-facade {
  position: absolute;
  inset: 0;
  display: grid;
  place-content: center;
  justify-items: center;
  gap: var(--space-sm);
  padding: var(--space-lg);
  text-align: center;
  color: var(--color-white);
  background:
    radial-gradient(circle at 50% 46%, color-mix(in srgb, var(--color-accent) 30%, transparent) 0, transparent 30%),
    repeating-linear-gradient(0deg, color-mix(in srgb, var(--color-white) 6%, transparent) 0 1px, transparent 1px 42px),
    repeating-linear-gradient(90deg, color-mix(in srgb, var(--color-white) 6%, transparent) 0 1px, transparent 1px 42px),
    linear-gradient(160deg, var(--color-dark) 0%, var(--color-primary-deep) 100%);
}
.ct-map-pin { width: 56px; height: 56px; display: grid; place-items: center; border-radius: var(--radius-full); background: var(--color-accent); color: var(--color-ink); box-shadow: 0 0 0 10px color-mix(in srgb, var(--color-accent) 22%, transparent); }
.ct-map-facade p { margin: 0; font-size: var(--font-size-sm); color: color-mix(in srgb, var(--color-white) 82%, transparent); max-width: 36ch; }
.ct-map-copy { display: grid; gap: var(--space-md); }
.ct-map-copy p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
.ct-map-copy .actions { display: flex; flex-wrap: wrap; gap: var(--space-sm); }

/* -- Service routing cards (paper-2, wave top) -- */
.ct-route { background: var(--color-paper-2); }
.ct-route-list { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); margin: 0; padding: 0; list-style: none; }
.ct-route-card { display: grid; gap: var(--space-xs); height: 100%; padding: var(--space-lg); border-radius: var(--radius-lg) var(--radius-lg) var(--radius-lg) var(--radius-sm); background: var(--color-surface); border: 1px solid var(--color-line); text-decoration: none; color: var(--color-ink); box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition); }
.ct-route-card:hover { transform: translateY(-4px); box-shadow: var(--shadow); border-color: var(--color-accent); }
.ct-route-card svg { color: var(--color-accent-dark); }
.ct-route-card b { font-family: var(--font-heading); color: var(--color-primary); }
.ct-route-card span { font-size: var(--font-size-sm); color: var(--color-ink-2); }

/* -- Closing CTA -- */
.ct-cta .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.ct-cta h2 { margin: 0; }
.ct-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.ct-cta .link-call { color: var(--color-white); }
.ct-cta .link-call svg { color: var(--color-accent-bright); }

/* -- Responsive -- */
@media (max-width: 1000px) {
  .ct-grid, .ct-map-grid { grid-template-columns: 1fr; }
  .ct-route-list { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
  .ct-hero::before { display: none; }
  .ct-hero .hero-answer { font-size: var(--font-size-base); }
  .ct-map .map-embed { aspect-ratio: 4 / 3; }
}
@media (prefers-reduced-motion: reduce) {
  .ct-hero::before { animation: none; }
}
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="ct-page">

  <!-- 1. HERO — compact, copy only (the full form sits directly below) -->
  <section class="hero hero--interior ct-hero" aria-labelledby="ct-title">
    <div class="container">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li aria-current="page">Contact</li>
          </ol>
        </nav>
        <span class="eyebrow"><?php echo e(cityStateLine()); ?> · Contact</span>
        <h1 class="hero-title" id="ct-title">Contact <span class="text-accent">Coastal Trim Lighting</span> in San Marcos, CA</h1>
        <p class="hero-answer">Call <?php echo e($phone); ?>, email, or send the form below. Coastal Trim Lighting follows up with open dates and a price for your home or business.</p>
        <div class="hero-actions">
          <a class="btn btn-primary btn-lg" href="#contact-form">Send a request</a>
          <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('phone', 16); ?> <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a></li>
          <li><?php echo icon('mail', 16); ?> <a href="mailto:<?php echo e($email); ?>">Email us</a></li>
          <li><?php echo icon('map-pin', 16); ?> <?php echo e(cityStateLine()); ?></li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 2. FORM + CONTACT RAIL -->
  <section class="section ct-main" aria-labelledby="ct-form-title">
    <div class="container-wide">
      <div class="ct-grid">
        <div class="ct-form-card reveal-left">
          <span class="eyebrow-label"><?php echo e($estimateCtaLabel); ?></span>
          <h2 id="ct-form-title">How do I get a lighting price from <span class="text-accent">Coastal Trim Lighting</span>?</h2>
          <p>Fill in the form with your contact details, the service you need and a few words about the property. The request goes to Coastal Trim Lighting, which follows up by phone or email with open dates and a price.</p>

          <form action="<?php echo e($formAction); ?>" method="POST" class="estimate-form ct-form" id="contact-form">
<?php echo p1_lead_hidden_fields('contact'); ?>
            <input type="text" name="_honeypot" style="display:none" tabindex="-1" autocomplete="off">

            <div class="form-grid">
              <div class="field">
                <label for="contact-name">Your name *</label>
                <input id="contact-name" type="text" name="name" autocomplete="name" required>
              </div>
              <div class="field">
                <label for="contact-phone">Phone *</label>
                <input id="contact-phone" type="tel" name="phone" autocomplete="tel" required>
              </div>
              <div class="field full">
                <label for="contact-email">Email *</label>
                <input id="contact-email" type="email" name="email" autocomplete="email" required>
              </div>
              <div class="field full">
                <label for="contact-service">Service needed</label>
                <select id="contact-service" name="service"><?php echo p1_service_options(); ?></select>
              </div>
              <div class="field full">
                <label for="contact-message">Tell us about the property</label>
                <textarea id="contact-message" name="message" rows="4" placeholder="Home or business, what you want lit, and the date you need it"></textarea>
              </div>
            </div>

            <fieldset class="form-consent-fieldset">
              <legend class="form-consent-legend">Communication consent</legend>
              <label class="form-consent-item" for="contact-email-opt">
                <input id="contact-email-opt" type="checkbox" name="email_opt_in" value="yes" class="consent-checkbox">
                <span class="consent-label"><strong>Email updates (optional):</strong> I agree to receive emails from <?php echo e($siteName); ?> about my inquiry, services, promotions and news. I can unsubscribe anytime via the link in any email or by emailing <?php echo e($email); ?>. Message frequency varies.</span>
              </label>
              <label class="form-consent-item" for="contact-sms-opt">
                <input id="contact-sms-opt" type="checkbox" name="sms_opt_in" value="yes" class="consent-checkbox">
                <span class="consent-label"><strong>SMS/Text messages (optional):</strong> I agree to receive text messages from <?php echo e($siteName); ?> at the phone number I provided. Message types may include appointment reminders, service updates and promotional offers. Message frequency varies. Message and data rates may apply. Reply STOP to unsubscribe, HELP for help. <strong>Consent is not a condition of purchase.</strong></span>
              </label>
              <label class="form-consent-item form-consent-required" for="contact-terms">
                <input id="contact-terms" type="checkbox" name="terms_accepted" value="yes" class="consent-checkbox" required>
                <span class="consent-label">I have read and agree to the <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and <a href="/terms/" target="_blank" rel="noopener">Terms of Service</a>. <span class="required-star">*</span></span>
              </label>
            </fieldset>

            <button type="submit" class="btn btn-primary btn-lg btn-block">Send my request</button>
            <p class="form-footnote">Prefer to talk? Call <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a>.</p>
          </form>
        </div>

        <aside class="ct-rail reveal-right" aria-labelledby="ct-rail-title">
          <h2 id="ct-rail-title">Other ways to reach Coastal Trim Lighting</h2>
          <ul class="ct-methods">
            <li class="ct-method"><span class="ct-method-icon"><?php echo icon('phone', 22); ?></span><div><b>Phone</b><a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a></div></li>
            <li class="ct-method"><span class="ct-method-icon"><?php echo icon('mail', 22); ?></span><div><b>Email</b><a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a></div></li>
            <li class="ct-method"><span class="ct-method-icon"><?php echo icon('map-pin', 22); ?></span><div><b>Address</b><span class="ct-val"><?php echo e($ctFullAddress); ?></span></div></li>
            <li class="ct-method"><span class="ct-method-icon"><?php echo icon('clock', 22); ?></span><div><b>Hours</b><?php if (!empty($businessHours)): ?><span class="ct-val"><?php echo e($businessHours); ?></span><?php else: ?><span class="ct-val">Call <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a> to check availability</span><?php endif; ?></div></li>
          </ul>
          <div class="ct-next">
            <h3>What happens after you send the form</h3>
            <ol class="next-steps">
              <li><strong>Your request arrives</strong>Your details and what you want lit go to <?php echo e($siteName); ?>.</li>
              <li><strong>We follow up</strong><?php echo e($siteName); ?> gets back to you by phone or email.</li>
              <li><strong>You get dates and a price</strong>Availability and pricing for your property, before anything goes up.</li>
            </ol>
          </div>
        </aside>
      </div>
    </div>
  </section>

  <!-- 3. MAP — GBP embed when configured, otherwise click-to-load map of the published address -->
  <section class="section ct-map edge-curve-top" aria-labelledby="ct-map-title">
    <div class="container-wide">
      <div class="ct-map-grid">
        <div class="map-embed reveal-left" id="ct-map">
          <?php if (!empty($gbpMapEmbed)): ?>
            <?php if (stripos(ltrim($gbpMapEmbed), '<iframe') === 0): echo $gbpMapEmbed; else: ?>
            <iframe src="<?php echo e($gbpMapEmbed); ?>" title="Map to <?php echo e($siteName); ?> in <?php echo e(cityStateLine()); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            <?php endif; ?>
          <?php else: ?>
          <div class="ct-map-facade">
            <span class="ct-map-pin"><?php echo icon('map-pin', 26); ?></span>
            <strong><?php echo e($ctFullAddress); ?></strong>
            <p>The map loads from Google only when you ask for it.</p>
            <button type="button" class="btn btn-accent" data-map-src="<?php echo e($ctMapSrc); ?>" data-map-title="Map to <?php echo e($siteName); ?> at <?php echo e($ctFullAddress); ?>">Show the map</button>
          </div>
          <?php endif; ?>
        </div>
        <div class="ct-map-copy reveal-right">
          <span class="eyebrow-label">Where we are</span>
          <h2 id="ct-map-title">Where is <span class="text-accent">Coastal Trim Lighting</span> located?</h2>
          <p class="answer-block">Coastal Trim Lighting is at <?php echo e($ctFullAddress); ?>. The company lights homes and businesses in San Marcos and the surrounding North County San Diego area, within about <?php echo (int) $targetRadiusMiles; ?> miles.</p>
          <p>Lighting work happens at your property, so the fastest way to start is a call to <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a> or the form above.</p>
          <div class="actions">
            <a class="btn btn-primary" href="<?php echo e($directionsUrl); ?>" target="_blank" rel="noopener"><?php echo icon('navigation', 18); ?> Get directions</a>
            <a class="btn btn-secondary" href="<?php echo e($gbpMapsUrl); ?>" target="_blank" rel="noopener">View on Google</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. ROUTING — which service is the request about -->
  <section class="section ct-route edge-wave-top" aria-labelledby="ct-route-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Before you call</span>
        <h2 id="ct-route-title">Which <span class="text-accent">lighting service</span> is your request about?</h2>
        <p class="answer-block">Coastal Trim Lighting offers holiday lighting for homes, holiday lighting for businesses, and year-round landscape and outdoor lighting. Each service page lists what to send so your first call can be priced.</p>
      </div>
      <ul class="ct-route-list">
        <?php $ctI = 0; foreach ($services as $ctSvc): if (!isset($ctServiceLinks[$ctSvc['slug']])) continue; $ctI++; ?>
        <li class="reveal-up reveal-delay-<?php echo $ctI; ?>">
          <a class="ct-route-card" href="<?php echo e(serviceUrl($ctSvc)); ?>">
            <?php echo icon($ctServiceLinks[$ctSvc['slug']]['icon'], 28); ?>
            <b><?php echo e($ctSvc['name']); ?></b>
            <span><?php echo e($ctServiceLinks[$ctSvc['slug']]['line']); ?></span>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- 5. CLOSING CTA -->
  <section class="section closing-cta texture-grain slant-top ct-cta" aria-labelledby="ct-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <span class="eyebrow-label">Rather talk it through?</span>
      <h2 id="ct-cta-title">Want to describe the job <span class="text-accent">by phone</span>?</h2>
      <p>Call Coastal Trim Lighting at <?php echo e($phone); ?> with your address and what you want lit, for holiday lighting or landscape lighting on a San Marcos home or business.</p>
      <div class="actions">
        <a class="btn btn-accent btn-lg" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
        <a class="link-call" href="mailto:<?php echo e($email); ?>"><?php echo icon('mail', 18); ?> <?php echo e($email); ?></a>
      </div>
    </div>
  </section>
</div>

<script>
/* Click-to-load map: no request to Google until the visitor asks for the map. */
(function () {
  var b = document.querySelector('[data-map-src]');
  if (!b) return;
  b.addEventListener('click', function () {
    var f = document.createElement('iframe');
    f.src = b.getAttribute('data-map-src');
    f.title = b.getAttribute('data-map-title');
    f.loading = 'lazy';
    f.referrerPolicy = 'no-referrer-when-downgrade';
    f.allowFullscreen = true;
    var wrap = document.getElementById('ct-map');
    wrap.innerHTML = '';
    wrap.appendChild(f);
  });
})();
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
