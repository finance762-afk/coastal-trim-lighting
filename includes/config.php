<?php
/**
 * includes/config.php — site-wide configuration for Coastal Trim Lighting.
 * All pages: require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php'; before head.php.
 * Generated Phase 1 (scaffold) from build-plan.json (research brief generated 2026-10-23).
 * Pages set their own $canonicalUrl, $pageType, $serviceSlug / $citySlug — never here.
 */

/* ---------------------------------------------------------------------------
 * Identity
 * ------------------------------------------------------------------------- */
$slug            = 'coastal-trim-lighting';                 // exact build directory name
$siteName        = 'Coastal Trim Lighting';
$tagline         = '';                                      // none supplied at intake — do not invent one
$ownerName       = 'Jacob Akbari';
$phone           = '(760) 916-3716';
$phoneRaw        = '+17609163716';                          // tel: friendly (E.164)
$phoneSecondary  = '';
$email           = 'holidaylightpro760@gmail.com';
$tier            = 'premium';

$address = [
    'street' => '1326 Topanga Drive',
    'city'   => 'San Marcos',
    'state'  => 'CA',
    'zip'    => '92069',
];
$addressPublic = true;

/* ---------------------------------------------------------------------------
 * Domain / URL
 *   build-plan.json has no production_domain → default to the preview domain.
 *   (build-plan "domain" holds the slug, not a hostname; the client's existing
 *   site coastaltrimlighting.com is listed only under web_sources.)
 *   $domain must NEVER be blank; $siteUrl must always be a valid absolute URL.
 * ------------------------------------------------------------------------- */
$domain   = $slug . '.pageone.cloud';                       // coastal-trim-lighting.pageone.cloud
$siteUrl  = 'https://' . $domain;                           // absolute site root, no trailing slash
$industry = 'Lighting Contractor';

/* ---------------------------------------------------------------------------
 * Keywords — build-plan seo.primary_keyword / seo.secondary_keywords, verbatim
 * ------------------------------------------------------------------------- */
$primaryKeyword = 'holiday lighting';
$secondaryKeywords = [
    'commercial',
    'residential',
    'landscape lighting',
    'outdoor lighting',
    'Lighting Contractor',
];

/* ---------------------------------------------------------------------------
 * Services — build-plan "services" is empty. This list comes from the intake
 *   description ("holiday lighting, commercial, residential and landscape
 *   lighting") plus the secondary keywords. Each: name, slug (dir under
 *   /services/), description, keywords. Descriptions are factual placeholders —
 *   the copywriter owns final client-facing copy.
 *   CONFIRM WITH OWNER: whether "commercial, residential" means holiday
 *   lighting for each, or year-round commercial/residential lighting work.
 *   The research brief's electrical topics (Title 24, LED retrofits, permits)
 *   are generic and unverified for this business — do not build services
 *   from them without confirmation.
 * ------------------------------------------------------------------------- */
$services = [
    [
        'name'        => 'Residential Holiday Lighting',
        'slug'        => 'residential-holiday-lighting',
        'description' => 'Holiday lighting installation for homes in San Marcos and the surrounding area.',
        'keywords'    => ['holiday lighting', 'residential'],
    ],
    [
        'name'        => 'Commercial Holiday Lighting',
        'slug'        => 'commercial-holiday-lighting',
        'description' => 'Holiday lighting installation for businesses and commercial properties.',
        'keywords'    => ['holiday lighting', 'commercial'],
    ],
    [
        'name'        => 'Landscape & Outdoor Lighting',
        'slug'        => 'landscape-lighting',
        'description' => 'Landscape and outdoor lighting installation for residential and commercial properties.',
        'keywords'    => ['landscape lighting', 'outdoor lighting', 'Lighting Contractor'],
    ],
];

/* ---------------------------------------------------------------------------
 * Service areas — build-plan service_areas holds San Marcos only. Add a town
 *   here only after the client confirms it. Area pages live at /areas/<slug>/.
 * ------------------------------------------------------------------------- */
$serviceAreas = [
    ['name' => 'San Marcos', 'slug' => 'san-marcos', 'zip' => '92069', 'county' => 'San Diego', 'primary' => true],
];
$targetRadiusMiles = 25;   // build-plan seo.target_radius

/* ---------------------------------------------------------------------------
 * Social links (only platforms the client uses; none supplied at intake)
 * ------------------------------------------------------------------------- */
$socialLinks = [];

/* ---------------------------------------------------------------------------
 * Analytics (placeholder — replace with client GA4 ID post-launch)
 * ------------------------------------------------------------------------- */
$googleAnalyticsId = 'G-XXXXXXXXXX';

/* ---------------------------------------------------------------------------
 * Brand colors — Phase 2 logo analysis (CTL_Logo_2.png, 2026-10-23). Mirrors
 *   framework.css :root. Transparent ~1:1 badge: deep coastal teal ring, aqua
 *   script lettering, string-light amber/orange bulbs, cream "LIGHTING".
 * ------------------------------------------------------------------------- */
$colors = [
    'primary'   => '#185a6c',
    'secondary' => '#23727f',
    'accent'    => '#e0a42a',
    'dark'      => '#0d1f26',
];
$archetype = 'warm-human';   // build-plan design.archetype (Phase 2)

/* Logo — localized Phase 2 (transparent PNG, no background cut needed). Versioned
 *   files in /assets/images/: logo-v1.png/.webp (440px), logo-v1-192.png/.webp
 *   (header/footer), favicon.svg/-32/-16, apple-touch-icon.png, og-default-v1.jpg.
 *   Never hotlink the db.pageone.cloud/storage original (source below). */
$logoSourceUrl = 'https://db.pageone.cloud/storage/v1/object/public/client-assets/coastal-trim-lighting/logo/1792779003250-8tk479-CTL_Logo_2.png';

/* Estimate CTA label — intake does not confirm that estimates are free (the
 *   research brief only says "if offered"), so the sitewide button says
 *   "Request an Estimate" until the client confirms. */
$estimateCtaLabel = 'Request an Estimate';

/* ---------------------------------------------------------------------------
 * Company age — intake: "in business since 2016" (content.years = 10)
 * ------------------------------------------------------------------------- */
$yearEstablished = 2016;
$yearsInBusiness = (int) date('Y') - $yearEstablished;

/* ---------------------------------------------------------------------------
 * Hours — build-plan business_hours is empty. Do not publish hours or build an
 *   OpeningHoursSpecification until the client supplies them.
 * ------------------------------------------------------------------------- */
$businessHours    = '';
$openingHoursSpec = [];

/* ---------------------------------------------------------------------------
 * Credentials — build-plan content.certifications and content.insurance are
 *   empty. Never publish a license number or insurance claim until intake
 *   supplies it.
 * ------------------------------------------------------------------------- */
$licenseLabel = '';

/* ---------------------------------------------------------------------------
 * CSS cache-bust — SINGLE source of truth. Pages MUST NOT set their own.
 * Bump this on every framework.css change.
 * ------------------------------------------------------------------------- */
$cssVersion = '2';

/* ---------------------------------------------------------------------------
 * Forms — Page One leads endpoint (build-plan form_action, verbatim)
 * ------------------------------------------------------------------------- */
$formAction       = 'https://db.pageone.cloud/functions/v1/leads/coastal-trim-lighting';
$leadsFormSecret  = 'bac7714a8f41505ab12d75311ccbb11a6374e38b1a010d69111c84a652cfa0f3'; // spam-shield HMAC (matches leads fn LEADS_FORM_SECRET)
$leadNotificationEmail = 'holidaylightpro760@gmail.com';
$leadNotificationPhone = '(760) 916-3716';

/* ---------------------------------------------------------------------------
 * Google Business Profile (build-plan integrations + google_business_profile_url).
 *   integrations.gbp_map_embed and integrations.geo are null — $gbpMapEmbed and
 *   $geo stay empty until real values are supplied (never guessed).
 * ------------------------------------------------------------------------- */
$gbpPlaceId       = 'ChIJVZCuRDa97AIRSOe0tWvJYvM';
$gbpMapsUrl       = 'https://share.google/iQ5NX8CzGWU1RNutA';
$directionsUrl    = 'https://www.google.com/maps/dir/?api=1&destination=place_id:ChIJVZCuRDa97AIRSOe0tWvJYvM';
$reviewRequestUrl = 'https://search.google.com/local/writereview?placeid=ChIJVZCuRDa97AIRSOe0tWvJYvM';
$gbpMapEmbed      = '';
$geo              = null;
$acceptsSms       = false;   // integrations.accepts_sms = false

/* ---------------------------------------------------------------------------
 * v8 component variables (2026-10-09) — copied from build-plan "integrations".
 *   Empty = component renders nothing. Never fill these without the plan.
 * ------------------------------------------------------------------------- */
$estimateTool   = [];   // integrations.estimate_tool.authorized = false
$bookingWindows = [];   // integrations.booking.authorized = false
$textUsNumber   = '';   // integrations.text_us_number = null
$financing      = [];   // integrations.financing = null
$serviceZips    = [];   // integrations.service_zips not present

/* ---------------------------------------------------------------------------
 * Lead attribution (v6.3) — MUST be last. Sets first-touch cookie and
 * provides p1_attribution_fields(). Never edit includes/attribution.php.
 * ------------------------------------------------------------------------- */
require_once __DIR__ . '/attribution.php';
