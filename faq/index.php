<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * FAQ — Phase 5 (archetype: warm-human). Directory page: /faq/index.php.
 * 18 questions in four categories (General, Services, Pricing, Process).
 * VISIBLE FAQ TEXT ONLY — schema is WebPage + BreadcrumbList; no FAQ JSON-LD.
 * Answers use only facts from build-plan.json / config.php and statements
 * already on the service pages. Unconfirmed topics (free estimates, licence,
 * insurance, takedown/storage, booking cutoff, price ranges, reply time) are
 * deliberately not answered — see /content-confirmations.json.
 * ------------------------------------------------------------------------- */
$pageTitle       = 'Lighting FAQ | San Marcos, CA | Coastal Trim Lighting';
$pageDescription = 'Answers about holiday and landscape lighting in San Marcos, CA from Coastal Trim Lighting: services, service area, pricing, permits and how booking works.';
$canonicalUrl    = $siteUrl . '/faq/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'faq';
$pageType        = 'faq';
$heroPreloadImage = '';

$schemaMarkup = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => 'WebPage',
            '@id'         => $canonicalUrl . '#webpage',
            'url'         => $canonicalUrl,
            'name'        => $pageTitle,
            'description' => $pageDescription,
            'isPartOf'    => ['@type' => 'WebSite', 'url' => $siteUrl . '/'],
            'about'       => ['@id' => $siteUrl . '/#organization'],
            'breadcrumb'  => ['@id' => $canonicalUrl . '#breadcrumb'],
            'speakable'   => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1', '.hero-answer', '.answer-block']],
        ],
        ['@id' => $canonicalUrl . '#breadcrumb'] + array_diff_key(generateBreadcrumbSchema([['name' => 'FAQ', 'url' => '/faq/']]), ['@context' => 1]),
    ],
];

$fqTel  = '<a href="tel:' . e($phoneRaw) . '">' . e($phone) . '</a>';
$fqMail = '<a href="mailto:' . e($email) . '">' . e($email) . '</a>';
$fqRes  = e(serviceUrl(['slug' => 'residential-holiday-lighting']));
$fqCom  = e(serviceUrl(['slug' => 'commercial-holiday-lighting']));
$fqLsl  = e(serviceUrl(['slug' => 'landscape-lighting']));

/* Answers are trusted HTML (links only); every fact traces to config.php. */
$fqCategories = [
    'general' => [
        'label' => 'General', 'icon' => 'info',
        'title' => 'What should you know about <span class="text-accent">Coastal Trim Lighting</span>?',
        'intro' => 'Coastal Trim Lighting is a San Marcos, CA lighting contractor, open since ' . (int) $yearEstablished . ' and owned by ' . e($ownerName) . '. These answers cover what the company does, where it works and who it works for.',
        'items' => [
            ['q' => 'What does Coastal Trim Lighting do?',
             'a' => 'Coastal Trim Lighting installs three kinds of lighting in San Marcos, CA: <a href="' . $fqRes . '">holiday lighting for homes</a>, <a href="' . $fqCom . '">holiday lighting for businesses and commercial properties</a>, and <a href="' . $fqLsl . '">landscape and outdoor lighting</a> that stays up all year.'],
            ['q' => 'Where is Coastal Trim Lighting based, and how far does it travel?',
             'a' => 'Coastal Trim Lighting is based at ' . e($address['street']) . ', ' . e(cityStateLine(true)) . ', and works on properties in San Marcos and the surrounding North County San Diego area, within about ' . (int) $targetRadiusMiles . ' miles. Not sure your address is in range? Put it on the form or call ' . $fqTel . '.'],
            ['q' => 'How long has Coastal Trim Lighting been in business, and who owns it?',
             'a' => 'Coastal Trim Lighting has been in business since ' . (int) $yearEstablished . ' (' . (int) $yearsInBusiness . ' years) and is owned by ' . e($ownerName) . '. The <a href="/about/">About page</a> has the rest of the story.'],
            ['q' => 'Does Coastal Trim Lighting work on homes and businesses?',
             'a' => 'Yes. Coastal Trim Lighting puts up holiday lighting on houses and on businesses and commercial properties, and installs landscape and outdoor lighting for both. Note the property type on the form so the follow-up covers the right service.'],
        ],
    ],
    'services' => [
        'label' => 'Services', 'icon' => 'sparkles',
        'title' => 'Which <span class="text-accent">lighting services</span> questions come up most?',
        'intro' => 'Coastal Trim Lighting answers the service questions San Marcos homeowners and business owners ask about holiday lights, landscape lighting, coastal weather and permits.',
        'items' => [
            ['q' => 'What can Coastal Trim Lighting light on a house for the holidays?',
             'a' => 'Coastal Trim Lighting puts holiday lights on the parts of a house you choose, such as rooflines, trees and walkways. Tell us which parts you want lit and the date you want them on, and the price covers those areas. See <a href="' . $fqRes . '">residential holiday lighting</a>.'],
            ['q' => 'Does Coastal Trim Lighting put up holiday lighting for businesses?',
             'a' => 'Yes. Coastal Trim Lighting puts up holiday lighting on businesses and commercial properties in and around San Marcos, so your staff stays off the ladders. Send the property address, who manages the site, and any landlord or association rules on exterior decorations. See <a href="' . $fqCom . '">commercial holiday lighting</a>.'],
            ['q' => 'What is the difference between holiday lighting and landscape lighting?',
             'a' => 'Holiday lighting is seasonal and landscape lighting is permanent. Coastal Trim Lighting puts holiday lights up for the holiday season on rooflines, trees and walkways, while landscape and outdoor lighting uses fixtures that stay in place and light paths, trees, entries and patios every night of the year.'],
            ['q' => 'Which parts of a yard can landscape lighting cover?',
             'a' => 'Landscape lighting from Coastal Trim Lighting can cover paths and steps, trees and palms, the entry and front of the house, and patio and seating areas. Start with the areas you use after dark; the quote covers only what you pick. See <a href="' . $fqLsl . '">landscape and outdoor lighting</a>.'],
            ['q' => 'Will outdoor light fixtures hold up to salt air near the coast?',
             'a' => 'Salt air is hardest on fixtures close to the beach. San Marcos sits inland, east of Carlsbad, so most properties here see much less of it than coastal streets do. If your property is nearer the ocean, tell Coastal Trim Lighting when you request a quote so fixture finish and hardware are part of the conversation.'],
            ['q' => 'Do I need a permit for new outdoor lighting in San Marcos?',
             'a' => 'It depends on the work. Plug-in low-voltage landscape lighting and new hardwired circuits can be treated differently, so check with the City of San Marcos Building Division before any job that adds wiring. Tell Coastal Trim Lighting what you want lit and the follow-up will explain what the install involves.'],
        ],
    ],
    'pricing' => [
        'label' => 'Pricing', 'icon' => 'clipboard-list',
        'title' => 'How does <span class="text-accent">pricing</span> work at Coastal Trim Lighting?',
        'intro' => 'Coastal Trim Lighting prices every job for the property it is on, with no flat packages. What moves the number depends on the service, so each answer lists the details that matter.',
        'items' => [
            ['q' => 'How much does holiday lighting cost in San Marcos?',
             'a' => 'Coastal Trim Lighting prices holiday lighting for each property, so there is no single flat price. For a house, roofline length and height, a tile or shingle roof, and the trees, shrubs and walkways on your list are what move the number. Call ' . $fqTel . ' or send the form for a price.'],
            ['q' => 'How is commercial holiday lighting priced?',
             'a' => 'Commercial holiday lighting from Coastal Trim Lighting is quoted per property. The building frontage and shared areas, who has to approve the display, and where the power is and when work can safely happen all shape the quote.'],
            ['q' => 'What affects the price of landscape lighting?',
             'a' => 'A landscape lighting price from Coastal Trim Lighting follows the areas you want lit, the fixtures already in the yard, where the exterior outlets are, and how you want the lights switched on: at dusk, on a schedule, or by a switch.'],
            ['q' => 'What should I send to get a price?',
             'a' => 'Send Coastal Trim Lighting the property address, whether it is a home or a business, the parts you want lit, and the date you want the lights on. For landscape lighting, add any outdoor fixtures already in place.'],
        ],
    ],
    'process' => [
        'label' => 'Process', 'icon' => 'calendar-check',
        'title' => 'How do you get on the <span class="text-accent">Coastal Trim Lighting</span> schedule?',
        'intro' => 'Coastal Trim Lighting books each job after a call or a form request, then follows up with open dates and a price. These answers walk through that process.',
        'items' => [
            ['q' => 'How do I get on the holiday lighting schedule?',
             'a' => 'Call ' . $fqTel . ' or send the estimate form with your address and what you want lit. Coastal Trim Lighting follows up with open install dates and a price for your property, and the install goes on the calendar once you agree to it.'],
            ['q' => 'When should I contact Coastal Trim Lighting about holiday lights?',
             'a' => 'As early as you can. Coastal Trim Lighting puts holiday installs on the calendar one property at a time, so an earlier request leaves more dates to choose from.'],
            ['q' => 'What happens after I send the form?',
             'a' => 'Your request goes to Coastal Trim Lighting, which follows up by phone or email. You get open dates and a price for your property, and nothing goes up until you agree to it.'],
            ['q' => 'Can I call or email instead of using the form?',
             'a' => 'Yes. Call Coastal Trim Lighting at ' . $fqTel . ' or email ' . $fqMail . '. Have the property address and the parts you want lit ready, and the call can cover dates and pricing.'],
        ],
    ],
];
$fqCount = array_sum(array_map(fn($c) => count($c['items']), $fqCategories));
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   FAQ — warm-human. Prefix .fq-. Tokens only.
   Signature: pricing questions as lit "tag" cards on a night band.
   =================================================================== */
.fq-page h1, .fq-page h2, .fq-page h3 { text-wrap: balance; }
.fq-page p { text-wrap: pretty; }
.fq-page section[id] { scroll-margin-top: calc(var(--nav-height) + var(--space-md)); }

/* -- Hero: night band, question-mark glow (::before), grain (::after) -- */
.fq-hero {
  background:
    radial-gradient(50% 70% at 10% 100%, color-mix(in srgb, var(--color-secondary) 34%, transparent), transparent 70%),
    linear-gradient(170deg, var(--color-dark) 0%, var(--color-dark-alt) 70%, var(--color-primary-deep) 100%);
}
.fq-hero::before {
  content: "?";
  position: absolute;
  right: clamp(0rem, 6vw, 8rem);
  bottom: calc(-1 * var(--space-2xl));
  z-index: -1;
  font-family: var(--font-heading);
  font-weight: 800;
  font-size: clamp(10rem, 22vw, 20rem);
  line-height: 1;
  color: transparent;
  -webkit-text-stroke: 2px color-mix(in srgb, var(--color-accent) 35%, transparent);
  text-shadow: 0 0 60px color-mix(in srgb, var(--color-accent) 25%, transparent);
  pointer-events: none;
}
.fq-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .45;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.fq-hero .hero-copy { max-width: 44rem; }
.fq-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.fq-hero .hero-answer { max-width: 40rem; }
.fq-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.fq-hero .breadcrumb a:hover { color: var(--color-accent-bright); }
.fq-hero .breadcrumb [aria-current] { color: var(--color-white); }
.fq-hero .hero-chips li { background: color-mix(in srgb, var(--color-white) 7%, transparent); border-color: color-mix(in srgb, var(--color-accent) 35%, transparent); color: var(--color-white); }
.fq-hero .hero-chips svg { color: var(--color-accent-bright); }
.fq-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.fq-hero .link-call svg { color: var(--color-accent-bright); }

/* -- Category jump nav (sits on the General section) -- */
.fq-jump { display: flex; flex-wrap: wrap; gap: var(--space-sm); margin: 0 0 var(--space-2xl); padding: 0; list-style: none; }
.fq-jump a { display: inline-flex; align-items: center; gap: var(--space-xs); min-height: 44px; padding: var(--space-xs) var(--space-md); border-radius: var(--radius-full); border: 1px solid var(--color-line); background: var(--color-surface); color: var(--color-ink); font-weight: 600; text-decoration: none; box-shadow: var(--shadow-sm); transition: border-color var(--transition), transform var(--transition), color var(--transition); }
.fq-jump a:hover { border-color: var(--color-accent); color: var(--color-primary); transform: translateY(-2px); }
.fq-jump svg { color: var(--color-accent-dark); }
.fq-jump small { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .1em; color: var(--color-muted); }

/* -- Shared question styling -- */
.fq-page .faq summary { gap: var(--space-md); }
.fq-page .faq[open] summary { color: var(--color-primary); }
.fq-page .faq-answer a, .fq-card p a { color: var(--color-primary); font-weight: 600; }

/* -- General: paper, two-column details -- */
.fq-general { background: var(--color-paper); }
.fq-general .section-head { max-width: 64ch; }

/* -- Services: white, curved top, sticky heading column -- */
.fq-services { background: var(--color-surface); }
.fq-split { display: grid; grid-template-columns: minmax(0, .8fr) minmax(0, 1.4fr); gap: clamp(2rem, 5vw, 4rem); align-items: start; }
.fq-split .section-head { position: sticky; top: calc(var(--nav-height) + var(--space-lg)); margin-bottom: 0; }
.fq-split .fq-list .faq { padding-inline: var(--space-md); border-radius: var(--radius); transition: background var(--transition); }
.fq-split .fq-list .faq[open] { background: var(--color-card-tint-1); }
.fq-split .fq-list .faq:nth-child(even)[open] { background: var(--color-card-tint-3); }

/* -- Pricing: night band, lit tag cards (signature) -- */
.fq-pricing .section-head { max-width: 64ch; }
.fq-cards { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-lg); margin: 0; padding: 0; list-style: none; }
.fq-card { position: relative; display: grid; gap: var(--space-sm); align-content: start; padding: var(--space-xl) var(--space-lg) var(--space-lg); border-radius: var(--radius-sm) var(--radius-xl) var(--radius-xl) var(--radius-xl); background: color-mix(in srgb, var(--color-white) 6%, transparent); border: 1px solid color-mix(in srgb, var(--color-accent) 28%, transparent); transition: transform var(--transition), border-color var(--transition), background var(--transition); }
.fq-card:hover { transform: translateY(-4px); border-color: var(--color-accent); background: color-mix(in srgb, var(--color-white) 9%, transparent); }
.fq-card::before { content: ""; position: absolute; left: var(--space-lg); top: calc(-1 * var(--space-xs)); width: 14px; height: 20px; border-radius: 50% 50% 46% 46% / 40% 40% 60% 60%; background: var(--color-accent-bright); box-shadow: 0 0 16px 4px color-mix(in srgb, var(--color-accent) 50%, transparent); }
.fq-card:nth-child(2)::before { background: var(--color-secondary); box-shadow: 0 0 16px 4px color-mix(in srgb, var(--color-secondary) 55%, transparent); }
.fq-card:nth-child(3)::before { background: color-mix(in srgb, var(--color-accent) 70%, var(--color-danger)); }
.fq-card:nth-child(4)::before { background: color-mix(in srgb, var(--color-secondary) 50%, var(--color-white)); }
.fq-card h3 { margin: 0; font-size: var(--fs-h3); }
.fq-card p { margin: 0; font-size: var(--font-size-sm); }
.fq-pricing .fq-card p a { color: var(--color-accent-bright); }

/* -- Process: paper, wave top, numbered details -- */
.fq-process { background: var(--color-paper); }
.fq-process .section-head { max-width: 64ch; margin-inline: auto; text-align: center; justify-items: center; }
.fq-steps { max-width: 820px; margin: 0 auto; padding: 0; list-style: none; counter-reset: fqstep; }
.fq-steps > li { counter-increment: fqstep; display: grid; grid-template-columns: auto minmax(0, 1fr); gap: var(--space-md); align-items: start; }
.fq-steps > li::before { content: counter(fqstep, decimal-leading-zero); padding-top: var(--space-md); font-family: var(--font-accent); font-size: 1.6rem; font-weight: 700; line-height: 1; color: var(--color-accent-dark); }
.fq-updated { margin: var(--space-xl) 0 0; text-align: center; font-size: var(--font-size-sm); color: var(--color-muted); }

/* -- Closing CTA -- */
.fq-cta .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.fq-cta h2 { margin: 0; }
.fq-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.fq-cta .link-call { color: var(--color-white); }
.fq-cta .link-call svg { color: var(--color-accent-bright); }

/* -- Responsive -- */
@media (max-width: 900px) {
  .fq-split { grid-template-columns: 1fr; }
  .fq-split .section-head { position: static; }
}
@media (max-width: 640px) {
  .fq-cards { grid-template-columns: 1fr; }
  .fq-hero::before { display: none; }
  .fq-hero .hero-answer { font-size: var(--font-size-base); }
}
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.php'; ?>

<div class="fq-page">

  <!-- 1. HERO -->
  <section class="hero hero--interior fq-hero" aria-labelledby="fq-title">
    <div class="container">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li aria-current="page">FAQ</li>
          </ol>
        </nav>
        <span class="eyebrow"><?php echo e(cityStateLine()); ?> · FAQ</span>
        <h1 class="hero-title" id="fq-title"><span class="text-accent">Holiday and landscape lighting</span> FAQ for San Marcos, CA</h1>
        <p class="hero-answer">Coastal Trim Lighting answers <?php echo (int) $fqCount; ?> common questions about its holiday and landscape lighting in San Marcos: what it installs, where it works, how pricing works and how to book.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
          <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('message-square', 16); ?> <?php echo (int) $fqCount; ?> answers</li>
          <li><?php echo icon('calendar', 16); ?> Est. <?php echo (int) $yearEstablished; ?></li>
          <li><?php echo icon('map-pin', 16); ?> <?php echo e(cityStateLine()); ?></li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 2. GENERAL — category jump nav + two-column questions -->
  <?php $fqCat = $fqCategories['general']; ?>
  <section class="section fq-general" id="general" aria-labelledby="fq-general-title">
    <div class="container">
      <nav aria-label="FAQ categories">
        <ul class="fq-jump">
          <?php foreach ($fqCategories as $fqKey => $fqC): ?>
          <li><a href="#<?php echo e($fqKey); ?>"><?php echo icon($fqC['icon'], 18); ?> <?php echo e($fqC['label']); ?> <small><?php echo count($fqC['items']); ?></small></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>
      <div class="section-head reveal-up">
        <span class="eyebrow-label"><?php echo e($fqCat['label']); ?></span>
        <h2 id="fq-general-title"><?php echo $fqCat['title']; ?></h2>
        <p class="answer-block"><?php echo $fqCat['intro']; ?></p>
      </div>
      <div class="faq-grid">
        <?php foreach ($fqCat['items'] as $fqI => $fqItem): ?>
        <details class="faq reveal-<?php echo $fqI % 2 ? 'right' : 'left'; ?>"<?php echo $fqI < 2 ? ' open' : ''; ?>>
          <summary><?php echo e($fqItem['q']); ?></summary>
          <p class="faq-answer"><?php echo $fqItem['a']; ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 3. CTA BAND — compact mid-page form (form id: cta-band) -->
  <?php echo p1_cta_band(
      'Still have a question?',
      'Want an answer for <span class="text-accent">your property</span>?',
      'Send the address and the service you need. Coastal Trim Lighting follows up by phone or email with dates and a price.'
  ); ?>

  <!-- 4. SERVICES — sticky heading column + questions -->
  <?php $fqCat = $fqCategories['services']; ?>
  <section class="section fq-services edge-curve-top" id="services" aria-labelledby="fq-services-title">
    <div class="container-wide">
      <div class="fq-split">
        <div class="section-head reveal-left">
          <span class="eyebrow-label"><?php echo e($fqCat['label']); ?></span>
          <h2 id="fq-services-title"><?php echo $fqCat['title']; ?></h2>
          <p class="answer-block"><?php echo $fqCat['intro']; ?></p>
          <p><a href="/services/">Compare all three lighting services</a></p>
        </div>
        <div class="fq-list reveal-right">
          <?php foreach ($fqCat['items'] as $fqI => $fqItem): ?>
          <details class="faq"<?php echo $fqI === 0 ? ' open' : ''; ?>>
            <summary><?php echo e($fqItem['q']); ?></summary>
            <p class="faq-answer"><?php echo $fqItem['a']; ?></p>
          </details>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. PRICING — lit tag cards on a night band (signature) -->
  <?php $fqCat = $fqCategories['pricing']; ?>
  <section class="section fq-pricing texture-grain slant-top" id="pricing" aria-labelledby="fq-pricing-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate" aria-hidden="true"></span>
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label"><?php echo e($fqCat['label']); ?></span>
        <h2 id="fq-pricing-title"><?php echo $fqCat['title']; ?></h2>
        <p><?php echo $fqCat['intro']; ?></p>
      </div>
      <ul class="fq-cards">
        <?php foreach ($fqCat['items'] as $fqI => $fqItem): ?>
        <li class="fq-card reveal-<?php echo ['left', 'right', 'left', 'right'][$fqI % 4]; ?> reveal-delay-<?php echo ($fqI % 4) + 1; ?>">
          <h3><?php echo e($fqItem['q']); ?></h3>
          <p><?php echo $fqItem['a']; ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- 6. PROCESS — numbered questions -->
  <?php $fqCat = $fqCategories['process']; ?>
  <section class="section fq-process edge-wave-top" id="process" aria-labelledby="fq-process-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label"><?php echo e($fqCat['label']); ?></span>
        <h2 id="fq-process-title"><?php echo $fqCat['title']; ?></h2>
        <p class="answer-block"><?php echo $fqCat['intro']; ?></p>
      </div>
      <ol class="fq-steps">
        <?php foreach ($fqCat['items'] as $fqI => $fqItem): ?>
        <li class="reveal-up reveal-delay-<?php echo ($fqI % 4) + 1; ?>">
          <details class="faq"<?php echo $fqI === 0 ? ' open' : ''; ?>>
            <summary><?php echo e($fqItem['q']); ?></summary>
            <p class="faq-answer"><?php echo $fqItem['a']; ?></p>
          </details>
        </li>
        <?php endforeach; ?>
      </ol>
      <p class="fq-updated">Last updated: <?php echo date('F Y'); ?></p>
    </div>
  </section>

  <!-- 7. CLOSING CTA -->
  <section class="section closing-cta texture-grain edge-curve-top fq-cta" aria-labelledby="fq-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <span class="eyebrow-label">Didn't see your question?</span>
      <h2 id="fq-cta-title">Have a question that is not <span class="text-accent">on this list</span>?</h2>
      <p>Call Coastal Trim Lighting at <?php echo e($phone); ?> or send the estimate form with your question and your property address, and the follow-up will answer it for your San Marcos home or business.</p>
      <div class="actions">
        <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
      <p><a href="/contact/">All the ways to contact Coastal Trim Lighting</a></p>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
