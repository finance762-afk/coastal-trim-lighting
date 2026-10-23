<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---------------------------------------------------------------------------
 * Area page — San Marcos, CA (Phase 6). The only area in build-plan.json
 * service_areas; it is also the company's home base (1326 Topanga Drive).
 *
 * RESEARCH SOURCES (checked 2026-10-23):
 *   https://en.wikipedia.org/wiki/San_Marcos,_California
 *     - incorporated Jan 28, 1963; 2020 population 94,833
 *     - neighborhoods: Buenavida, Coronado Hills, Discovery Hills, Rancho Santalina,
 *       Richland, San Elijo Hills, Twin Oaks Valley, University District/North City
 *     - Lake San Marcos = unincorporated enclave in the city's southwest
 *     - landmarks: illuminated cross above Lake San Marcos, Williams Barn in
 *       Walnut Grove Park, Palomar College hillside "P" ("visible miles away")
 *     - SR 78 "with six interchanges"; Sprinter stations Palomar College,
 *       San Marcos Civic Center, Cal State San Marcos, Nordahl Road
 *     - climate: rarely below freezing; May gray / June gloom; Santa Ana winds
 *       "can strike any month"; ~13 in. of rain a year
 *   https://en.wikipedia.org/wiki/Lake_San_Marcos,_California
 *     - dam built 1946-1951; elevation 520 ft; 2020 population 5,328;
 *       governed by the Lake San Marcos Community Association (nonprofit)
 *   https://en.wikipedia.org/wiki/Double_Peak_(San_Diego_County,_California)
 *   https://www.summitpost.org/double-peak/695201
 *     - summit 1,644 ft (SummitPost, local sources) vs 1,646 ft (Wikipedia, NAVD 88)
 *     - reached from Discovery Lake Park (north) or by Double Peak Drive from San Elijo Hills
 *   https://www.sdbj.com/?p=57775  (San Elijo Hills: HomeFed master plan, first homes sold ~2000)
 *   https://phzmapi.org/92069.json + /92078.json (2023 USDA PHZM by ZIP): both zone 10a
 *
 * ELEVATION is a RANGE on purpose: ~520 ft (Lake San Marcos) to ~1,645 ft
 *   (Double Peak; sources say 1,644 or 1,646 depending on datum). The city's own
 *   GNIS point and ZIP centroids (581-776 ft) fall inside that range.
 * LEFT OUT (could not verify): "Restaurant Row", any city permit rule for
 *   decorative lighting, the street location of Topanga Drive within the city,
 *   any claim about past jobs in a given neighborhood.
 * Company claims: only build-plan.json / config.php facts. "Free" estimate,
 *   license, insurance, takedown/storage remain unconfirmed (content-confirmations.json).
 * ------------------------------------------------------------------------- */
$pageAreaSlug = 'san-marcos';
$thisArea = null;
foreach ($serviceAreas as $cfgArea) { if ($cfgArea['slug'] === $pageAreaSlug) { $thisArea = $cfgArea; break; } }

$pageTitle       = 'Holiday & Outdoor Lighting San Marcos, CA | Coastal Trim Lighting';
$pageDescription = 'Holiday and outdoor lighting for San Marcos, CA homes and businesses, from San Elijo Hills to Lake San Marcos. Est. 2016. Call (760) 916-3716.';
$canonicalUrl    = $siteUrl . '/service-areas/' . $pageAreaSlug . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'service-areas';
$pageType        = 'city';
$citySlug        = $pageAreaSlug;
$heroPreloadImage = '';   // no photo hero — the H1 is the LCP element

$schemaMarkup = generateAreaPageGraph(
    $thisArea,
    $pageTitle,
    'Coastal Trim Lighting, based on Topanga Drive in San Marcos, CA since 2016, installs residential and commercial holiday lighting and landscape and outdoor lighting across San Marcos, including San Elijo Hills, Lake San Marcos, Twin Oaks Valley and the University District.',
    [['name' => 'Service Areas', 'url' => '/service-areas/'], ['name' => $thisArea['name'] . ', ' . $address['state'], 'url' => '/service-areas/' . $pageAreaSlug . '/']]
);

/* Neighborhood cards — every name confirmed on the city's Wikipedia article;
 * the "plan" line is what to check before booking, never a claim of past work. */
$smaHoods = [
    ['icon' => 'mountain', 'name' => 'San Elijo Hills',
     'fact' => 'Master-planned community on the slopes below Double Peak; its first homes sold around 2000.',
     'plan' => 'Check the HOA rules on exterior decorations and permanent fixtures before install day.'],
    ['icon' => 'waves', 'name' => 'Lake San Marcos',
     'fact' => 'Unincorporated lakeside community of 5,328 people (2020 census), surrounded by the city.',
     'plan' => 'It answers to the Lake San Marcos Community Association, so ask the association, not City Hall.'],
    ['icon' => 'trees', 'name' => 'Twin Oaks Valley',
     'fact' => 'The northern stretch of the city along Twin Oaks Valley Road.',
     'plan' => 'On a large lot or a long drive, note how far the lit areas sit from the nearest outdoor outlet.'],
    ['icon' => 'route', 'name' => 'Discovery Hills',
     'fact' => 'Homes around Discovery Lake Park, the north-side trail start for the climb to Double Peak.',
     'plan' => 'If the yard steps down a slope, say so; slope changes how path lights are spaced.'],
    ['icon' => 'graduation-cap', 'name' => 'University District',
     'fact' => 'The North City area around Cal State San Marcos and its Sprinter station.',
     'plan' => 'For a storefront or managed building, find out who signs off on exterior lighting first.'],
    ['icon' => 'map-pin', 'name' => 'Richland, Coronado Hills and more',
     'fact' => 'Buenavida, Rancho Santalina, Richland, Coronado Hills and the rest of the city.',
     'plan' => 'Send the address and your list; the request works the same anywhere in town.'],
];

/* Conditions table — sourced conditions in col 1, planning notes in cols 2-3. */
$smaConditions = [
    ['icon' => 'wind', 'cond' => 'Santa Ana winds', 'note' => 'Hot, dry, and possible in any month',
     'holiday' => 'Strands and clips are planned for a gusty night, not only a calm one.',
     'land'    => 'Stakes and cable runs are set to stay put when the ground is dry and loose.'],
    ['icon' => 'droplets', 'cond' => 'Winter rain', 'note' => 'About 13 inches a year, mostly while the holiday lights are up',
     'holiday' => 'Plugs and connections are kept off the ground and away from downspouts.',
     'land'    => 'Connections go in for wet soil, since the rain arrives in the same few months.'],
    ['icon' => 'sun', 'cond' => 'Mild winters', 'note' => '2023 USDA zone 10a; rarely below freezing',
     'holiday' => 'Ice is not the worry in December. Wind and rain are.',
     'land'    => 'Plants grow all year, so fixtures are placed with room for the shrubs around them.'],
    ['icon' => 'mountain', 'cond' => 'Hillside lots', 'note' => 'About 520 ft at the lake to roughly 1,645 ft at Double Peak',
     'holiday' => 'A hillside roofline is seen from the valley below as well as from the curb.',
     'land'    => 'Uplights on a slope are aimed at the tree, not into the house next door.'],
    ['icon' => 'users', 'cond' => 'HOA and association rules', 'note' => 'San Elijo Hills HOA; Lake San Marcos Community Association',
     'holiday' => 'Some communities limit what goes on the house and when it comes down.',
     'land'    => 'Permanent fixtures can need design approval before anything is installed.'],
];

/* Services available here — required services-grid card pattern (icon-led, no client photos yet). */
$smaCards = [
    'residential-holiday-lighting' => ['icon' => 'house', 'desc' => 'Rooflines, trees and walkways lit on your house for the season.',
        'bullets' => ['Tile and shingle rooflines', 'Second-story eaves handled', 'Priced for your house']],
    'commercial-holiday-lighting' => ['icon' => 'building-2', 'desc' => 'Storefronts, offices and managed properties lit for the holidays.',
        'bullets' => ['Frontage, entries and trees', 'Planned around approvals', 'Quoted for each property']],
    'landscape-lighting' => ['icon' => 'trees', 'desc' => 'Paths, trees, entries and patios lit every night of the year.',
        'bullets' => ['Lit year-round', 'Spaced for hillside yards', 'Homes and commercial grounds']],
];

$smaFaqs = [
    ['q' => 'Do I need HOA approval for holiday lights in San Elijo Hills or Lake San Marcos?',
     'a' => 'It depends on your community. San Elijo Hills is a master-planned community with an HOA, and Lake San Marcos is governed by the Lake San Marcos Community Association. Check their rules on exterior decorations before install day and mention any limits in your request, so Coastal Trim Lighting can plan around them.'],
    ['q' => 'Does Coastal Trim Lighting work in Lake San Marcos, even though it is not part of the city?',
     'a' => 'Yes. Lake San Marcos is an unincorporated community surrounded by the City of San Marcos, well inside the roughly ' . (int) $targetRadiusMiles . '-mile area Coastal Trim Lighting covers from Topanga Drive. Send the address and what you want lit, the same as for any other home in the city.'],
    ['q' => 'What time of year is best for landscape lighting in San Marcos?',
     'a' => 'Any month works. The city sits in USDA zone 10a and rarely freezes, so the ground can be worked year-round and the install date comes down to your schedule. Booking outside the holiday season simply keeps it separate from the busiest stretch for holiday installs.'],
];

/* Hero ridge decoration: a stylised Cerro de las Posas ridgeline with Double Peak, bulbs along it. */
$smaRidge = [[0, 84], [170, 58], [320, 70], [450, 30], [520, 46], [590, 22], [740, 62], [920, 48], [1060, 66], [1200, 54]];
$smaBulbs = [];
for ($smaI = 0; $smaI < count($smaRidge) - 1; $smaI++) {
    [$smaX1, $smaY1] = $smaRidge[$smaI];
    [$smaX2, $smaY2] = $smaRidge[$smaI + 1];
    for ($smaJ = 0; $smaJ < 4; $smaJ++) {
        $smaT = $smaJ / 4;
        $smaBulbs[] = [round($smaX1 + ($smaX2 - $smaX1) * $smaT, 1), round($smaY1 + ($smaY2 - $smaY1) * $smaT, 1)];
    }
}
$smaRidgePoints = implode(' ', array_map(fn($p) => $p[0] . ',' . $p[1], $smaRidge));
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<style>
/* ===================================================================
   Area page — San Marcos, CA. Warm-human. Prefix .sma-. Tokens only;
   framework.css carries the base components.
   =================================================================== */
.sma-page h1, .sma-page h2, .sma-page h3 { text-wrap: balance; }
.sma-page p { text-wrap: pretty; }

/* -- Hero: dusk band, layered glow (::before) + grain (::after) + lit ridgeline -- */
section.sma-hero { padding-bottom: calc(var(--space-16) + var(--space-12)); }
.sma-hero {
  background:
    radial-gradient(120% 90% at 0% 100%, color-mix(in srgb, var(--color-accent) 18%, transparent), transparent 55%),
    linear-gradient(185deg, var(--color-dark) 0%, var(--color-dark-alt) 50%, var(--color-primary-deep) 100%);
}
.sma-hero::before {
  content: "";
  position: absolute;
  inset: -20% -15% auto auto;
  width: 55%;
  aspect-ratio: 1;
  z-index: -1;
  border-radius: var(--radius-full);
  background: radial-gradient(closest-side, color-mix(in srgb, var(--color-secondary) 34%, transparent), transparent);
  pointer-events: none;
}
.sma-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  opacity: .5;
  mix-blend-mode: overlay;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.2'/%3E%3C/svg%3E");
}
.sma-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.sma-hero .breadcrumb li { display: inline-flex; align-items: center; min-height: 44px; }
.sma-hero .breadcrumb a:hover { color: var(--color-accent-bright); }
.sma-hero .breadcrumb [aria-current] { color: var(--color-white); }
.sma-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.sma-hero .hero-chips li {
  background: color-mix(in srgb, var(--color-white) 8%, transparent);
  border-color: color-mix(in srgb, var(--color-white) 22%, transparent);
  color: var(--color-white);
}
.sma-hero .hero-chips svg { color: var(--color-accent-bright); }
.sma-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.sma-hero .link-call svg { color: var(--color-accent-bright); }
.sma-hero .hero-form-open { background: var(--color-accent); color: var(--color-ink); }
.sma-hero .hero-form-card { border-top: 4px solid var(--color-accent); }

.sma-ridge { position: absolute; left: 0; right: 0; bottom: 0; height: 110px; z-index: 0; pointer-events: none; }
.sma-ridge svg { width: 100%; height: 100%; }
.sma-ridge .ridge-back { fill: color-mix(in srgb, var(--color-primary) 30%, transparent); }
.sma-ridge .ridge-front { fill: var(--color-paper); }
.sma-ridge .ridge-line { fill: none; stroke: color-mix(in srgb, var(--color-accent) 55%, transparent); stroke-width: 1.5; }
.sma-ridge .bulb { fill: var(--color-accent-bright); filter: drop-shadow(0 0 4px var(--color-accent)); animation: sma-glow 3.6s ease-in-out infinite; }
.sma-ridge .bulb:nth-child(2n) { fill: var(--color-accent); animation-delay: -1.2s; }
.sma-ridge .bulb:nth-child(5n) { fill: color-mix(in srgb, var(--color-secondary) 55%, var(--color-white)); animation-delay: -2.4s; }
@keyframes sma-glow { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }

/* -- Local story: editorial two-column with a sticky fact rail (paper) -- */
.sma-local { background: var(--color-paper); }
.sma-local-grid { display: grid; grid-template-columns: minmax(0, 1.35fr) minmax(0, .65fr); gap: clamp(2rem, 6vw, 5rem); align-items: start; }
.sma-local-copy { display: grid; gap: var(--space-md); }
.sma-local-copy > p { margin: 0; max-width: var(--measure); color: var(--color-ink-2); }
.sma-local-copy > p:first-of-type::first-letter {
  float: left;
  font-family: var(--font-heading);
  font-size: calc(var(--fs-h1) * 1.6);
  line-height: .85;
  padding: var(--space-1) var(--space-sm) 0 0;
  color: var(--color-primary);
}
.sma-facts { position: sticky; top: calc(var(--nav-height) + var(--space-lg)); display: grid; gap: var(--space-sm); padding: var(--space-lg); border-radius: var(--radius-xl); background: var(--color-surface); box-shadow: var(--shadow); border-top: 4px solid var(--color-secondary); }
.sma-facts h3 { margin: 0 0 var(--space-xs); font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .14em; text-transform: uppercase; color: var(--color-accent-dark); }
.sma-facts dl { margin: 0; display: grid; gap: var(--space-sm); }
.sma-facts dl div { display: grid; gap: var(--space-1); padding-bottom: var(--space-sm); border-bottom: 1px dashed var(--color-line); }
.sma-facts dl div:last-child { border-bottom: 0; padding-bottom: 0; }
.sma-facts dt { font-size: var(--font-size-sm); color: var(--color-muted); }
.sma-facts dd { margin: 0; font-family: var(--font-heading); font-size: var(--font-size-lg); color: var(--color-ink); }
.sma-facts .sma-facts-note { margin: var(--space-xs) 0 0; font-size: var(--font-size-sm); color: var(--color-muted); }

/* -- Neighborhoods: staggered tinted cards (white, curved top) -- */
.sma-hoods { background: var(--color-surface); }
.sma-hoods .section-head { max-width: 64ch; }
.sma-hood-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); margin-top: var(--space-xl); }
.sma-hood { position: relative; display: grid; gap: var(--space-sm); align-content: start; padding: var(--space-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition); overflow: hidden; }
.sma-hood:hover { transform: translateY(-4px); box-shadow: var(--shadow); }
.sma-hood:nth-child(3n+1) { background: var(--color-card-tint-1); }
.sma-hood:nth-child(3n+2) { background: var(--color-card-tint-2); transform: translateY(var(--space-lg)); }
.sma-hood:nth-child(3n+2):hover { transform: translateY(calc(var(--space-lg) - 4px)); }
.sma-hood:nth-child(3n) { background: var(--color-card-tint-3); }
.sma-hood-icon { width: 44px; height: 44px; display: grid; place-items: center; border-radius: var(--radius); background: var(--color-surface); color: var(--color-primary); box-shadow: var(--shadow-sm); }
.sma-hood h3 { margin: 0; font-size: var(--fs-h3); color: var(--color-ink); }
.sma-hood p { margin: 0; font-size: var(--font-size-sm); color: var(--color-ink-2); }
.sma-hood .sma-plan { padding-top: var(--space-sm); border-top: 1px solid color-mix(in srgb, var(--color-primary) 18%, transparent); color: var(--color-ink); }
.sma-hood .sma-plan b { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .12em; text-transform: uppercase; color: var(--color-accent-dark); display: block; margin-bottom: var(--space-1); }

/* -- Conditions: dark slant band, condition cards + planning table (signature) -- */
.sma-cond .sma-cond-head { max-width: 62ch; display: grid; gap: var(--space-sm); margin-bottom: var(--space-xl); }
.sma-cond .answer-block { background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.sma-cond-wrap { overflow-x: auto; border-radius: var(--radius-lg); border: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); background: color-mix(in srgb, var(--color-white) 4%, transparent); backdrop-filter: blur(6px); }
.sma-cond-table { width: 100%; min-width: 760px; border-collapse: collapse; font-size: var(--font-size-sm); }
.sma-cond-table caption { text-align: left; padding: var(--space-md) var(--space-lg) 0; font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .12em; text-transform: uppercase; color: var(--color-accent-bright); }
.sma-cond-table th, .sma-cond-table td { text-align: left; vertical-align: top; padding: var(--space-md) var(--space-lg); border-bottom: 1px solid color-mix(in srgb, var(--color-white) 10%, transparent); }
.sma-cond-table thead th { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .1em; text-transform: uppercase; color: color-mix(in srgb, var(--color-white) 68%, transparent); }
.sma-cond-table tbody th { width: 28%; }
.sma-cond-table tbody th .sma-cond-name { display: flex; align-items: center; gap: var(--space-sm); font-family: var(--font-heading); font-size: var(--font-size-base); color: var(--color-white); }
.sma-cond-table tbody th svg { color: var(--color-accent-bright); flex: none; }
.sma-cond-table tbody th small { display: block; margin-top: var(--space-1); padding-left: calc(20px + var(--space-sm)); font-weight: 400; color: color-mix(in srgb, var(--color-white) 62%, transparent); }
.sma-cond-table td { color: color-mix(in srgb, var(--color-white) 84%, transparent); }
.sma-cond-table tbody tr:last-child > * { border-bottom: 0; }
.sma-cond-table tbody tr { transition: background var(--transition); }
.sma-cond-table tbody tr:hover { background: color-mix(in srgb, var(--color-accent) 7%, transparent); }

/* -- Services in San Marcos (required services-grid pattern, paper-2) -- */
.sma-services { background: var(--color-paper-2); }
.sma-services .services-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); }
.sma-services .service-card-with-image { border: 1px solid color-mix(in srgb, var(--color-primary) 14%, var(--color-line)); }
.sma-services .service-card__body { padding: var(--space-xl) var(--space-lg) var(--space-lg); }
.sma-services .service-card__icon { margin-top: 0; width: 56px; height: 56px; border-radius: var(--radius-lg); background: var(--color-surface); color: var(--color-primary); box-shadow: var(--shadow); transition: transform var(--transition-slow); }
.sma-services .service-card-with-image:hover .service-card__icon { transform: rotate(-6deg) scale(1.06); }

/* -- Why local: big number + reasons (white, wave top) -- */
.sma-why { background: var(--color-surface); }
.sma-why .grid-asym { grid-template-columns: minmax(0, 1.25fr) minmax(0, .75fr); align-items: center; gap: clamp(2rem, 6vw, 5rem); }
.sma-why-copy { display: grid; gap: var(--space-md); }
.sma-why-list { display: grid; gap: var(--space-md); margin: var(--space-sm) 0 0; padding: 0; list-style: none; }
.sma-why-list li { display: grid; grid-template-columns: 40px 1fr; gap: var(--space-1) var(--space-md); padding: var(--space-md) 0; border-top: 1px solid var(--color-line); }
.sma-why-list svg { grid-row: span 2; color: var(--color-secondary); margin-top: var(--space-1); }
.sma-why-list b { font-family: var(--font-heading); color: var(--color-ink); }
.sma-why-list span { color: var(--color-ink-2); font-size: var(--font-size-sm); }
.sma-badge { position: relative; aspect-ratio: 1; display: grid; place-content: center; text-align: center; gap: var(--space-xs); padding: var(--space-xl); border-radius: var(--radius-full); background: var(--color-dark); color: var(--color-white); isolation: isolate; box-shadow: var(--shadow-lg); }
.sma-badge::before { content: ""; position: absolute; inset: var(--space-sm); z-index: -1; border-radius: var(--radius-full); border: 2px dashed color-mix(in srgb, var(--color-accent) 60%, transparent); }
.sma-badge::after { content: ""; position: absolute; inset: 0; z-index: -2; border-radius: var(--radius-full); background: radial-gradient(closest-side, color-mix(in srgb, var(--color-secondary) 45%, transparent), transparent); transform: scale(1.25); }
.sma-badge .big-number { font-size: clamp(4rem, 3rem + 4vw, 6rem); line-height: 1; color: var(--color-accent-bright); }
.sma-badge p { margin: 0; max-width: 18ch; color: color-mix(in srgb, var(--color-white) 82%, transparent); font-size: var(--font-size-sm); }

/* -- FAQ -- */
.sma-faq { background: var(--color-paper); }
.sma-faq .faq[open] summary { color: var(--color-primary); }
.sma-faq .sma-updated { margin: var(--space-xl) 0 0; font-size: var(--font-size-sm); color: var(--color-muted); }

/* -- Closing CTA: dark, grain, torn edge -- */
.sma-cta .container-narrow { display: grid; gap: var(--space-md); justify-items: center; text-align: center; }
.sma-cta h2 { margin: 0; }
.sma-cta .answer-block { margin: 0 auto; background: color-mix(in srgb, var(--color-white) 6%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); text-align: left; }
.sma-cta .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }
.sma-cta .link-call { color: var(--color-white); }
.sma-cta .link-call svg { color: var(--color-accent-bright); }
.sma-cta .sma-hub-link { color: var(--color-accent-bright); }
.sma-cta .floating-ring { top: -110px; left: -90px; }

/* -- Responsive -- */
@media (max-width: 1000px) {
  .sma-local-grid, .sma-why .grid-asym { grid-template-columns: 1fr; }
  .sma-facts { position: static; }
  .sma-hood-grid, .sma-services .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .sma-hood:nth-child(3n+2), .sma-hood:nth-child(3n+2):hover { transform: none; }
  .sma-badge { max-width: 320px; justify-self: center; }
}
@media (max-width: 700px) {
  .sma-hood-grid, .sma-services .services-grid { grid-template-columns: 1fr; }
  .sma-ridge { height: 70px; }
  section.sma-hero { padding-bottom: calc(var(--space-12) + var(--space-8)); }
  .sma-hero .hero-answer { font-size: var(--font-size-base); }
  .sma-local-copy > p:first-of-type::first-letter { font-size: calc(var(--fs-h1) * 1.3); }
}
@media (prefers-reduced-motion: reduce) {
  .sma-ridge .bulb { animation: none; }
  .sma-hood, .sma-services .service-card__icon { transition: none; }
}
</style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>

<div class="sma-page">
<article class="sma-article" aria-labelledby="sma-title">

  <!-- 1. HERO — dusk band, copy | form card, lit Double Peak ridgeline -->
  <section class="hero hero--interior sma-hero">
    <div class="container">
      <div class="hero-grid hero-grid--form">
        <div class="hero-copy">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="/">Home</a></li>
              <li class="breadcrumb-sep" aria-hidden="true">/</li>
              <li><a href="/service-areas/">Service Areas</a></li>
              <li class="breadcrumb-sep" aria-hidden="true">/</li>
              <li aria-current="page"><?php echo e($thisArea['name']); ?>, <?php echo e($address['state']); ?></li>
            </ol>
          </nav>
          <span class="eyebrow">San Marcos · North County San Diego</span>
          <h1 class="hero-title" id="sma-title"><span class="text-accent">Holiday Lighting</span> in San Marcos, CA</h1>
          <p class="hero-answer">A San Marcos lighting contractor for holiday and year-round outdoor lighting on North County homes and businesses.</p>
          <div class="hero-actions">
            <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
            <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> or call <?php echo e($phone); ?></a>
          </div>
          <ul class="hero-chips">
            <li><?php echo icon('calendar', 16); ?> Est. <?php echo (int) $yearEstablished; ?></li>
            <li><?php echo icon('map-pin', 16); ?> Based on Topanga Drive</li>
            <li><?php echo icon('house', 16); ?> Homes &amp; businesses</li>
          </ul>
        </div>
        <?php echo p1_hero_form_card('hero', '', 'Request an estimate in San Marcos', 'Your address and what you want lit is enough to start.'); ?>
      </div>
    </div>
    <div class="sma-ridge" aria-hidden="true">
      <svg viewBox="0 0 1200 110" preserveAspectRatio="none" focusable="false">
        <polygon class="ridge-back" points="0,70 140,40 300,58 430,12 500,30 580,6 760,48 940,30 1080,52 1200,38 1200,110 0,110"/>
        <polygon class="ridge-front" points="<?php echo $smaRidgePoints; ?> 1200,110 0,110" transform="translate(0 20)"/>
        <polyline class="ridge-line" points="<?php echo $smaRidgePoints; ?>" transform="translate(0 20)"/>
        <g transform="translate(0 20)">
          <?php foreach ($smaBulbs as $smaB): ?>
          <circle class="bulb" cx="<?php echo $smaB[0]; ?>" cy="<?php echo $smaB[1] - 4; ?>" r="3.5"/>
          <?php endforeach; ?>
        </g>
      </svg>
    </div>
  </section>

  <!-- 2. LOCAL STORY — terrain, weather and landmarks (editorial + sticky fact rail) -->
  <section class="section sma-local" aria-labelledby="sma-local-title">
    <div class="container-wide">
      <div class="sma-local-grid">
        <div class="sma-local-copy reveal-left">
          <span class="eyebrow-label">Lighting in San Marcos</span>
          <h2 id="sma-local-title">What makes a <span class="text-accent">San Marcos</span> lighting job different?</h2>
          <p class="answer-block">Three things set a lighting job here apart: hills, wind and community rules. The city climbs from about 520 feet at Lake San Marcos to roughly 1,645 feet at Double Peak, Santa Ana winds can arrive in any month, and many neighborhoods answer to an HOA or a community association.</p>
          <p>Coastal Trim Lighting has worked from Topanga Drive since <?php echo (int) $yearEstablished; ?>, inside the same city it lights, and the city is not one flat grid. Lake San Marcos sits low around a reservoir formed by a dam built between 1946 and 1951. San Elijo Hills climbs south toward Double Peak, where Double Peak Drive runs up to the park at the summit. Twin Oaks Valley stretches north along Twin Oaks Valley Road. A lit roofline on a hillside street is seen from the valley below as well as from the curb, and the plan for that house has to account for both views.</p>
          <p>The weather matters as much as the slope. The city averages about 13 inches of rain a year, most of it in the same months the holiday lights are up, and hot, dry Santa Ana winds can blow in at any time of year. For a holiday install, that means strands fastened for a gusty night and connections kept up off wet ground. For landscape lighting it is the opposite problem: in USDA hardiness zone 10a, where it rarely freezes, shrubs and groundcover keep growing through winter and can swallow a path light within a season.</p>
          <p>The city already has lit landmarks of its own. The illuminated cross on the hill above Lake San Marcos and the Palomar College "P", visible from miles away, are part of the local skyline, and the Williams Barn in Walnut Grove Park is one of the city's best-known buildings. If you searched for holiday lighting near me in San Marcos, the route to your street is SR 78 and its six interchanges through the city, whether the address is a house in Richland or a storefront by the Cal State San Marcos Sprinter station.</p>
        </div>
        <aside class="sma-facts reveal-right" aria-labelledby="sma-facts-title">
          <h3 id="sma-facts-title">San Marcos at a glance</h3>
          <dl>
            <div><dt>Incorporated</dt><dd>January 28, 1963</dd></div>
            <div><dt>Population (2020 census)</dt><dd>94,833</dd></div>
            <div><dt>Elevation</dt><dd>About 520 to 1,645 ft</dd></div>
            <div><dt>USDA hardiness zone (2023)</dt><dd>10a (ZIPs 92069, 92078)</dd></div>
            <div><dt>Average rainfall</dt><dd>About 13 in. a year</dd></div>
            <div><dt>Coastal Trim Lighting base</dt><dd><?php echo e($address['street']); ?></dd></div>
          </dl>
          <p class="sma-facts-note">Elevation is a range: Lake San Marcos sits near 520 ft, and Double Peak is listed at 1,644 or 1,646 ft depending on the survey.</p>
        </aside>
      </div>
    </div>
  </section>

  <!-- 3. NEIGHBORHOODS — staggered tinted cards, one planning note each -->
  <section class="section sma-hoods edge-curve-top" id="neighborhoods" aria-labelledby="sma-hoods-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Neighborhoods</span>
        <h2 id="sma-hoods-title">Which <span class="text-accent">San Marcos neighborhoods</span> does Coastal Trim Lighting cover?</h2>
        <p class="answer-block">Coastal Trim Lighting covers every neighborhood in the city, plus the unincorporated Lake San Marcos community the city surrounds. Each card below adds one thing worth checking before you book, because the rules and the terrain change from one side of SR 78 to the other.</p>
      </div>
      <div class="sma-hood-grid">
        <?php foreach ($smaHoods as $smaHoodI => $smaHood): ?>
        <div class="sma-hood reveal-<?php echo ['up', 'scale', 'right'][$smaHoodI % 3]; ?> reveal-delay-<?php echo ($smaHoodI % 3) + 1; ?>">
          <span class="sma-hood-icon"><?php echo icon($smaHood['icon'], 22); ?></span>
          <h3><?php echo e($smaHood['name']); ?></h3>
          <p><?php echo e($smaHood['fact']); ?></p>
          <p class="sma-plan"><b>Before you book</b><?php echo e($smaHood['plan']); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 4. CONDITIONS — signature: what San Marcos weather and terrain change (dark slant band) -->
  <section class="section sma-cond texture-grain slant-top" aria-labelledby="sma-cond-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <div class="container-wide">
      <div class="sma-cond-head reveal-up">
        <span class="eyebrow-label">Local conditions</span>
        <h2 id="sma-cond-title">How do San Marcos <span class="text-accent">weather and terrain</span> change a lighting install?</h2>
        <p class="answer-block">Wind, winter rain, mild temperatures, hillside lots and HOA rules are the five local conditions that change how lights go up. Coastal Trim Lighting plans holiday and landscape installs around each one, and the table shows what each condition means for the two kinds of work.</p>
      </div>
      <div class="sma-cond-wrap reveal-up" tabindex="0" role="region" aria-labelledby="sma-cond-caption">
        <table class="sma-cond-table">
          <caption id="sma-cond-caption">Local conditions and what the install plans around</caption>
          <thead>
            <tr><th scope="col">Condition</th><th scope="col">Holiday lighting</th><th scope="col">Landscape and outdoor lighting</th></tr>
          </thead>
          <tbody>
            <?php foreach ($smaConditions as $smaRow): ?>
            <tr>
              <th scope="row"><span class="sma-cond-name"><?php echo icon($smaRow['icon'], 20); ?><?php echo e($smaRow['cond']); ?></span><small><?php echo e($smaRow['note']); ?></small></th>
              <td><?php echo e($smaRow['holiday']); ?></td>
              <td><?php echo e($smaRow['land']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- 5. SERVICES AVAILABLE IN SAN MARCOS — required services-grid pattern -->
  <section class="section sma-services" aria-labelledby="sma-services-title">
    <div class="container">
      <div class="section-title reveal-up">
        <span class="eyebrow-label">What We Do</span>
        <h2 id="sma-services-title">What <span class="text-accent">lighting services</span> can you book in San Marcos?</h2>
        <p class="hero-answer">Every Coastal Trim Lighting service is available at any address in the city: holiday lighting for houses, holiday lighting for businesses and commercial properties, and landscape and outdoor lighting that stays up all year. Each one is priced for the property, from a San Elijo Hills hillside to a storefront near Cal State San Marcos.</p>
      </div>
      <div class="services-grid">
        <?php
        $smaTint = 0;
        foreach ($services as $smaSvc):
            if (!isset($smaCards[$smaSvc['slug']])) continue;
            $smaCard = $smaCards[$smaSvc['slug']];
            $smaTint = ($smaTint % 3) + 1;
        ?>
        <article class="service-card-with-image card-tint-<?php echo $smaTint; ?> reveal-up reveal-delay-<?php echo $smaTint; ?>">
          <div class="service-card__body">
            <div class="service-card__icon"><?php echo icon($smaCard['icon'], 26); ?></div>
            <h3><?php echo e($smaSvc['name']); ?></h3>
            <p class="service-card__desc"><?php echo e($smaCard['desc']); ?></p>
            <ul>
              <?php foreach ($smaCard['bullets'] as $smaBullet): ?>
              <li><?php echo e($smaBullet); ?></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?php echo e(serviceUrl($smaSvc)); ?>" class="service-card__cta" aria-label="<?php echo e($smaSvc['name']); ?> in San Marcos">Learn more</a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 6. WHY A LOCAL COMPANY — reasons + years badge -->
  <section class="section sma-why edge-wave-top" aria-labelledby="sma-why-title">
    <div class="container">
      <div class="grid-asym">
        <div class="sma-why-copy reveal-left">
          <span class="eyebrow-label">Why Coastal Trim Lighting</span>
          <h2 id="sma-why-title">Why hire a lighting company that is <span class="text-accent">based in San Marcos</span>?</h2>
          <p class="answer-block">Hiring a company based in town means the crew that lights your property already works from town. Coastal Trim Lighting has operated from Topanga Drive since <?php echo (int) $yearEstablished; ?> under owner <?php echo e($ownerName); ?>, prices each property on its own list, and handles both holiday and year-round lighting.</p>
          <ul class="sma-why-list">
            <li><?php echo icon('map-pin', 22); ?><b>Home base in the city</b><span>The business address is <?php echo e($address['street']); ?>, San Marcos <?php echo e($address['zip']); ?>, so a job in town is a local drive.</span></li>
            <li><?php echo icon('sparkles', 22); ?><b>Both seasons from one company</b><span>The trees lit for December can stay lit the rest of the year with <a href="<?php echo e(serviceUrl(['slug' => 'landscape-lighting'])); ?>">landscape and outdoor lighting</a> from the same company.</span></li>
            <li><?php echo icon('clipboard-check', 22); ?><b>A price for your property</b><span>No packages: the quote follows the rooflines, trees, paths or frontage you list.</span></li>
            <li><?php echo icon('navigation', 22); ?><b>About <?php echo (int) $targetRadiusMiles; ?> miles of coverage</b><span>The city is the center. For nearby North County towns, send the address and it is confirmed with your request.</span></li>
          </ul>
        </div>
        <div class="sma-badge reveal-scale">
          <span class="big-number"><?php echo (int) $yearsInBusiness; ?></span>
          <p>years since Coastal Trim Lighting opened in San Marcos in <?php echo (int) $yearEstablished; ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- 7. FAQ — visible text only (never FAQPage JSON-LD) -->
  <section class="section sma-faq" aria-labelledby="sma-faq-title">
    <div class="container">
      <div class="section-head reveal-up">
        <span class="eyebrow-label">Questions</span>
        <h2 id="sma-faq-title">What do San Marcos property owners ask about <span class="text-accent">holiday and outdoor lighting</span>?</h2>
        <p class="answer-block">Property owners here ask Coastal Trim Lighting about HOA rules in San Elijo Hills and Lake San Marcos, whether the unincorporated lake community is covered, and when landscape lighting should go in. The short answers are below.</p>
      </div>
      <div class="faq-grid">
        <?php foreach ($smaFaqs as $smaFaqI => $smaFaq): ?>
        <details class="faq reveal-<?php echo $smaFaqI % 2 ? 'right' : 'left'; ?>"<?php echo $smaFaqI === 0 ? ' open' : ''; ?>>
          <summary><?php echo e($smaFaq['q']); ?></summary>
          <p class="faq-answer"><?php echo e($smaFaq['a']); ?></p>
        </details>
        <?php endforeach; ?>
      </div>
      <p class="sma-updated">Last updated: <?php echo date('F Y'); ?></p>
    </div>
  </section>

</article>

  <!-- 8. CLOSING CTA -->
  <section class="section closing-cta texture-grain edge-torn-top sma-cta" aria-labelledby="sma-cta-title">
    <span class="grain-layer" aria-hidden="true"></span>
    <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
    <div class="container-narrow reveal-scale">
      <span class="eyebrow-label">San Marcos, this season</span>
      <h2 id="sma-cta-title">Request an Estimate in <span class="text-accent">San Marcos</span></h2>
      <p class="answer-block">Send Coastal Trim Lighting your address, what you want lit and when you want it on. You get a price for that property before anything goes up, whether it is a house in Twin Oaks Valley, a lakeside home in Lake San Marcos or a business in the University District.</p>
      <div class="actions">
        <button type="button" class="btn btn-accent btn-lg" data-open-estimate><?php echo e($estimateCtaLabel); ?></button>
        <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      </div>
      <p><a class="sma-hub-link" href="/service-areas/">See all Coastal Trim Lighting service areas</a></p>
    </div>
  </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
