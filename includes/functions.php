<?php
/**
 * includes/functions.php — shared helpers for Coastal Trim Lighting.
 * Pages: require_once config.php, then this file, BEFORE head.php.
 * head.php also require_once's it, so double inclusion is safe.
 * NO FAQPage helper on purpose: FAQPage JSON-LD is never emitted (visible FAQs only).
 */

require_once __DIR__ . '/p1-form-helpers.php';

if (!function_exists('e')) {
    /** HTML-escape shorthand. */
    function e($value): string {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

/* ---------------------------------------------------------------------------
 * Navigation + URLs
 * ------------------------------------------------------------------------- */

/** True when $page matches the current page key ($currentPage set by each page). */
function isActivePage(string $page): bool {
    global $currentPage;
    return isset($currentPage) && $currentPage === $page;
}

/** aria-current attribute for nav links. */
function ariaCurrent(string $page): string {
    return isActivePage($page) ? ' aria-current="page"' : '';
}

/** True when a page directory (with index.php) exists on disk — link-integrity gate. */
function pageExists(string $path): bool {
    $dir = rtrim($_SERVER['DOCUMENT_ROOT'] . '/' . trim($path, '/'), '/');
    return is_file($dir . '/index.php') || is_file($dir . '.php');
}

/** Service page URL, or the services hub anchor until the page is built. */
function serviceUrl(array $service): string {
    $slug = $service['slug'] ?? getServiceSlug($service['name'] ?? '');
    if (pageExists('/services/' . $slug)) return '/services/' . $slug . '/';
    return '/services/#' . $slug;
}

/** Area page URL, or the service-areas hub anchor until the page is built. */
function areaUrl(array $area): string {
    $slug = $area['slug'] ?? getAreaSlug($area['name'] ?? '');
    if (pageExists('/areas/' . $slug)) return '/areas/' . $slug . '/';
    return '/service-areas/#' . $slug;
}

/* ---------------------------------------------------------------------------
 * Formatting
 * ------------------------------------------------------------------------- */

/** Any phone string → "(760) 916-3716". Returns the input unchanged if it is not 10/11 digits. */
function formatPhone(string $phone): string {
    $d = preg_replace('/\D+/', '', $phone);
    if (strlen($d) === 11 && $d[0] === '1') $d = substr($d, 1);
    if (strlen($d) !== 10) return $phone;
    return sprintf('(%s) %s-%s', substr($d, 0, 3), substr($d, 3, 3), substr($d, 6));
}

/** Any phone string → "+17609163716" for tel: links. */
function phoneE164(string $phone): string {
    $d = preg_replace('/\D+/', '', $phone);
    if (strlen($d) === 10) $d = '1' . $d;
    return '+' . $d;
}

/** Lowercase hyphenated slug. */
function slugify(string $text): string {
    $text = strtolower(trim($text));
    $text = str_replace('&', 'and', $text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

/** Slug for a service name — prefers the slug defined in config.php $services. */
function getServiceSlug(string $name): string {
    global $services;
    foreach ((array) $services as $s) {
        if (strcasecmp($s['name'] ?? '', $name) === 0 && !empty($s['slug'])) return $s['slug'];
    }
    return slugify($name);
}

/** Slug for an area/city name — prefers the slug defined in config.php $serviceAreas. */
function getAreaSlug(string $city): string {
    global $serviceAreas;
    foreach ((array) $serviceAreas as $a) {
        if (strcasecmp($a['name'] ?? '', $city) === 0 && !empty($a['slug'])) return $a['slug'];
    }
    return slugify($city);
}

/** City, ST [ZIP] — never the street (safe for address_public:false builds). */
function cityStateLine(bool $withZip = false): string {
    global $address;
    $line = $address['city'] . ', ' . $address['state'];
    return $withZip && !empty($address['zip']) ? $line . ' ' . $address['zip'] : $line;
}

/* ---------------------------------------------------------------------------
 * Icons — inline Lucide SVG at render time from references/lucide-icons/.
 * No runtime injection, no CDN. Unknown names return '' (never a broken tag).
 * ------------------------------------------------------------------------- */
function icon(string $name, int $size = 20, string $class = ''): string {
    static $cache = [];
    $name = preg_replace('/[^a-z0-9-]/', '', strtolower($name));
    if (!isset($cache[$name])) {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/references/lucide-icons/' . $name . '.svg';
        $svg = is_file($file) ? (string) file_get_contents($file) : '';
        $svg = preg_replace('/<!--.*?-->/s', '', $svg);
        $svg = preg_replace('/\s*\n\s*/', ' ', trim($svg));
        $cache[$name] = $svg;
    }
    $svg = $cache[$name];
    if ($svg === '') return '';
    // Some source files ship without width/height (e.g. navigation.svg) — strip and always set both.
    $svg = preg_replace('/^(<svg\b[^>]*?)\s(?:width|height)="[^"]*"/', '$1', $svg);
    $svg = preg_replace('/^(<svg\b[^>]*?)\s(?:width|height)="[^"]*"/', '$1', $svg);
    $extra = ' aria-hidden="true" focusable="false" width="' . $size . '" height="' . $size . '"';
    if ($class !== '') {
        $svg = preg_replace('/class="([^"]*)"/', 'class="$1 ' . e($class) . '"', $svg, 1);
    }
    return preg_replace('/<svg\b/', '<svg' . $extra, $svg, 1);
}

/* ---------------------------------------------------------------------------
 * Schema helpers — return arrays; render with schemaScript().
 * NEVER aggregateRating / ratingValue. NEVER FAQPage.
 * ------------------------------------------------------------------------- */

/** <script type="application/ld+json"> for one schema array (or @graph list). */
function schemaScript(array $data): string {
    if (!isset($data['@context'])) $data = ['@context' => 'https://schema.org'] + $data;
    return '<script type="application/ld+json">'
         . json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
         . '</script>';
}

/** PostalAddress — omits streetAddress when $addressPublic is false. */
function schemaPostalAddress(): array {
    global $address, $addressPublic;
    $pa = ['@type' => 'PostalAddress'];
    if (!empty($addressPublic) && !empty($address['street'])) $pa['streetAddress'] = $address['street'];
    $pa['addressLocality'] = $address['city'];
    $pa['addressRegion']   = $address['state'];
    $pa['postalCode']      = $address['zip'];
    $pa['addressCountry']  = 'US';
    return $pa;
}

/** Site-wide LocalBusiness node (@id #organization). Only facts present in config.php. */
function generateLocalBusinessSchema(): array {
    global $siteName, $siteUrl, $phone, $email, $services, $serviceAreas, $gbpMapsUrl,
           $geo, $openingHoursSpec, $yearEstablished, $ownerName, $socialLinks, $address;

    $intro = $siteName . ' installs holiday lighting and landscape and outdoor lighting for residential and commercial properties in '
           . cityStateLine() . ' and the surrounding area.';

    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        '@id'         => $siteUrl . '/#organization',
        'name'        => $siteName,
        'url'         => $siteUrl . '/',
        'telephone'   => phoneE164($phone),
        'email'       => $email,
        'description' => $intro,
        'image'       => $siteUrl . '/assets/images/logo-v1.png',
        'logo'        => $siteUrl . '/assets/images/logo-v1.png',
        'address'     => schemaPostalAddress(),
    ];
    if (!empty($yearEstablished)) $schema['foundingDate'] = (string) $yearEstablished;
    if (!empty($ownerName)) $schema['founder'] = ['@type' => 'Person', 'name' => $ownerName];
    if (is_array($geo) && isset($geo['lat'], $geo['lng'])) {
        $schema['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => (float) $geo['lat'], 'longitude' => (float) $geo['lng']];
    }
    if (!empty($gbpMapsUrl)) $schema['hasMap'] = $gbpMapsUrl;
    if (!empty($openingHoursSpec)) $schema['openingHoursSpecification'] = $openingHoursSpec;

    $schema['areaServed'] = [];
    foreach ((array) $serviceAreas as $a) {
        $schema['areaServed'][] = ['@type' => 'City', 'name' => $a['name'] . ', ' . $address['state']];
    }

    $offers = [];
    foreach ((array) $services as $s) {
        $offers[] = ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $s['name'], 'description' => $s['description']]];
    }
    if ($offers) {
        $schema['hasOfferCatalog'] = ['@type' => 'OfferCatalog', 'name' => $siteName . ' services', 'itemListElement' => $offers];
    }

    $same = [];
    foreach ((array) $socialLinks as $url) if (!empty($url)) $same[] = $url;
    if ($same) $schema['sameAs'] = $same;

    return $schema;
}

/** Service node for a service page. $service = one entry from config.php $services. */
function generateServiceSchema(array $service): array {
    global $siteUrl, $serviceAreas, $address;
    $slug = $service['slug'] ?? getServiceSlug($service['name']);
    $areas = [];
    foreach ((array) $serviceAreas as $a) $areas[] = ['@type' => 'City', 'name' => $a['name'] . ', ' . $address['state']];
    return [
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        '@id'         => $siteUrl . '/services/' . $slug . '/#service',
        'name'        => $service['name'],
        'serviceType' => $service['name'],
        'description' => $service['description'] ?? '',
        'url'         => $siteUrl . '/services/' . $slug . '/',
        'provider'    => ['@id' => $siteUrl . '/#organization'],
        'areaServed'  => $areas,
    ];
}

/**
 * One @graph for a service page: WebPage (speakable) + Service (@id #service-{slug},
 * provider → the sitewide #organization node head.php emits) + BreadcrumbList.
 * $description is the page-specific service description (not the config placeholder).
 * NEVER FAQPage, NEVER aggregateRating.
 */
function generateServicePageGraph(array $service, string $pageName, string $description, array $crumbs): array {
    global $siteUrl;
    $slug = $service['slug'] ?? getServiceSlug($service['name']);
    $url  = $siteUrl . '/services/' . $slug . '/';

    $svcNode = generateServiceSchema($service);
    unset($svcNode['@context']);
    $svcNode['@id']         = $url . '#service-' . $slug;
    $svcNode['description'] = $description;

    $crumbNode = generateBreadcrumbSchema($crumbs);
    unset($crumbNode['@context']);
    $crumbNode['@id'] = $url . '#breadcrumb';

    $pageNode = [
        '@type'       => 'WebPage',
        '@id'         => $url . '#webpage',
        'url'         => $url,
        'name'        => $pageName,
        'description' => $description,
        'isPartOf'    => ['@type' => 'WebSite', 'url' => $siteUrl . '/'],
        'about'       => ['@id' => $svcNode['@id']],
        'breadcrumb'  => ['@id' => $crumbNode['@id']],
        'speakable'   => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1', '.hero-answer', '.answer-block']],
    ];

    return ['@context' => 'https://schema.org', '@graph' => [$pageNode, $svcNode, $crumbNode]];
}

/** BreadcrumbList. $crumbs = [['name' => 'Services', 'url' => '/services/'], ...] (Home is prepended). */
function generateBreadcrumbSchema(array $crumbs): array {
    global $siteUrl;
    $items = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteUrl . '/']];
    $pos = 2;
    foreach ($crumbs as $c) {
        $url = $c['url'] ?? '';
        $items[] = ['@type' => 'ListItem', 'position' => $pos++, 'name' => $c['name'],
                    'item' => preg_match('#^https?://#', $url) ? $url : $siteUrl . $url];
    }
    return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items];
}

/** WebPage node (legal pages, generic pages). */
function generateWebPageSchema(string $name, string $description, string $url): array {
    global $siteUrl;
    return [
        '@context'    => 'https://schema.org',
        '@type'       => 'WebPage',
        'name'        => $name,
        'description' => $description,
        'url'         => $url,
        'isPartOf'    => ['@type' => 'WebSite', 'url' => $siteUrl . '/'],
        'about'       => ['@id' => $siteUrl . '/#organization'],
    ];
}

/* ---------------------------------------------------------------------------
 * SEO helper — title, description, canonical, Open Graph.
 * NO meta keywords, NO twitter:* tags (both forbidden).
 * ------------------------------------------------------------------------- */
function generateMetaTags(string $title, string $description, string $canonical, string $ogImage = '', string $ogType = 'website'): string {
    global $siteName, $siteUrl;
    if ($ogImage === '') $ogImage = $siteUrl . '/assets/images/og-default-v1.jpg';
    if (!preg_match('#^https?://#', $ogImage)) $ogImage = $siteUrl . '/' . ltrim($ogImage, '/');
    $out  = '<title>' . e($title) . '</title>' . "\n";
    $out .= '  <meta name="description" content="' . e($description) . '">' . "\n";
    $out .= '  <link rel="canonical" href="' . e($canonical) . '">' . "\n";
    $out .= '  <meta property="og:type" content="' . e($ogType) . '">' . "\n";
    $out .= '  <meta property="og:title" content="' . e($title) . '">' . "\n";
    $out .= '  <meta property="og:description" content="' . e($description) . '">' . "\n";
    $out .= '  <meta property="og:url" content="' . e($canonical) . '">' . "\n";
    $out .= '  <meta property="og:image" content="' . e($ogImage) . '">' . "\n";
    $out .= '  <meta property="og:site_name" content="' . e($siteName) . '">' . "\n";
    $out .= '  <meta property="og:locale" content="en_US">' . "\n";
    return $out;
}

/* ---------------------------------------------------------------------------
 * Full lead form — contact-form-standard.md markup (name/phone/email required,
 * service + message, three unbundled consent checkboxes). Hidden fields come from
 * p1_lead_hidden_fields(). $formId is the form_location/attribution id and must be
 * unique on the page; $prefix keeps element ids unique.
 * ------------------------------------------------------------------------- */
function p1_full_lead_form(string $formId, string $prefix, string $submitLabel = 'Send my request', string $messagePlaceholder = ''): string {
    global $formAction, $siteName, $email;
    $p = e($prefix);
    ob_start(); ?>
<form action="<?php echo e($formAction); ?>" method="POST" class="estimate-form" id="<?php echo $p; ?>-form">
<?php echo p1_lead_hidden_fields($formId); ?>
  <div class="form-grid">
    <div class="field"><label for="<?php echo $p; ?>-name">Your name *</label><input id="<?php echo $p; ?>-name" type="text" name="name" autocomplete="name" required></div>
    <div class="field"><label for="<?php echo $p; ?>-phone">Phone *</label><input id="<?php echo $p; ?>-phone" type="tel" name="phone" autocomplete="tel" required></div>
    <div class="field full"><label for="<?php echo $p; ?>-email">Email *</label><input id="<?php echo $p; ?>-email" type="email" name="email" autocomplete="email" required></div>
    <div class="field full"><label for="<?php echo $p; ?>-service">Service needed</label><select id="<?php echo $p; ?>-service" name="service"><?php echo p1_service_options(); ?></select></div>
    <div class="field full"><label for="<?php echo $p; ?>-message">Tell us about the property</label><textarea id="<?php echo $p; ?>-message" name="message" rows="3"<?php echo $messagePlaceholder !== '' ? ' placeholder="' . e($messagePlaceholder) . '"' : ''; ?>></textarea></div>
  </div>
  <fieldset class="form-consent-fieldset">
    <legend class="form-consent-legend">Communication consent</legend>
    <label class="form-consent-item" for="<?php echo $p; ?>-email-opt">
      <input id="<?php echo $p; ?>-email-opt" type="checkbox" name="email_opt_in" value="yes" class="consent-checkbox">
      <span class="consent-label"><strong>Email updates (optional):</strong> I agree to receive emails from <?php echo e($siteName); ?> about my inquiry, services, promotions and news. I can unsubscribe anytime via the link in any email or by emailing <?php echo e($email); ?>. Message frequency varies.</span>
    </label>
    <label class="form-consent-item" for="<?php echo $p; ?>-sms-opt">
      <input id="<?php echo $p; ?>-sms-opt" type="checkbox" name="sms_opt_in" value="yes" class="consent-checkbox">
      <span class="consent-label"><strong>SMS/Text messages (optional):</strong> I agree to receive text messages from <?php echo e($siteName); ?> at the phone number I provided. Message types may include appointment reminders, service updates and promotional offers. Message frequency varies. Message and data rates may apply. Reply STOP to unsubscribe, HELP for help. <strong>Consent is not a condition of purchase.</strong></span>
    </label>
    <label class="form-consent-item form-consent-required" for="<?php echo $p; ?>-terms">
      <input id="<?php echo $p; ?>-terms" type="checkbox" name="terms_accepted" value="yes" class="consent-checkbox" required>
      <span class="consent-label">I have read and agree to the <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and <a href="/terms/" target="_blank" rel="noopener">Terms of Service</a>. <span class="required-star">*</span></span>
    </label>
  </fieldset>
  <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo e($submitLabel); ?></button>
</form>
<?php
    return (string) ob_get_clean();
}
