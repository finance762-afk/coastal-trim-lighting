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
