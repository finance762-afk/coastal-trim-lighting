<?php
/**
 * includes/head.php — <!DOCTYPE> through <body>.
 * Pages set, BEFORE including this file (all optional, sensible fallbacks below):
 *   $pageTitle, $pageDescription, $canonicalUrl, $ogImage, $ogType, $currentPage,
 *   $pageType (home|service|city|blog|about|faq|contact|other), $serviceSlug, $citySlug,
 *   $noindex (bool), $heroPreload (['srcset' => '…-480.avif 480w, …', 'sizes' => '100vw']),
 *   $schemaMarkup (array | array of arrays | pre-rendered <script> string), $bodyClass.
 * The LocalBusiness node (@id #organization) is emitted here on every page; pages
 * reference it via provider/@id and never duplicate it.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$pageTitle       = $pageTitle ?? (ucwords($primaryKeyword) . ' in ' . cityStateLine() . ' | ' . $siteName);
$pageDescription = $pageDescription ?? ($metaDescription ?? (
    $siteName . ' installs holiday, landscape and outdoor lighting for ' . cityStateLine()
    . ' homes and businesses since ' . $yearEstablished . '. Call ' . $phone . ' for an estimate.'
));

if (empty($canonicalUrl)) {
    $p1Path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $p1Path = preg_replace('#/index\.php$#', '/', $p1Path);
    $p1Path = preg_replace('#\.php$#', '', $p1Path);
    if ($p1Path !== '/' && substr($p1Path, -1) !== '/' && strpos(basename($p1Path), '.') === false) $p1Path .= '/';
    $canonicalUrl = $siteUrl . $p1Path;
}
$ogImage   = $ogImage ?? '';
$ogType    = $ogType ?? 'website';
$noindex   = $noindex ?? false;
$bodyClass = $bodyClass ?? '';
$pageType  = $pageType ?? (($currentPage ?? '') === 'home' ? 'home' : 'other');

/* Hero preload — $heroPreload (v6.3 AVIF srcset) is the standard; $heroPreloadImage (single URL) is tolerated. */
if (empty($heroPreload) && !empty($heroPreloadImage)) {
    $heroPreload = ['href' => $heroPreloadImage];
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php echo generateMetaTags($pageTitle, $pageDescription, $canonicalUrl, $ogImage, $ogType); ?>
<?php if ($noindex): ?>
  <meta name="robots" content="noindex, nofollow">
<?php endif; ?>
  <meta name="theme-color" content="#185a6c">
  <meta name="format-detection" content="telephone=no">

  <!-- Self-hosted heading face (above the fold) — no Google Fonts CDN -->
  <link rel="preload" href="/assets/fonts/bricolage-grotesque.woff2" as="font" type="font/woff2" crossorigin>
  <style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/critical.css'; ?></style>
  <link rel="preload" href="/assets/css/framework.css?v=<?php echo $cssVersion; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="/assets/css/framework.css?v=<?php echo $cssVersion; ?>"></noscript>
<?php if (!empty($heroPreload['srcset'])): ?>
  <link rel="preload" as="image" type="image/avif" imagesrcset="<?php echo $heroPreload['srcset']; ?>" imagesizes="<?php echo $heroPreload['sizes'] ?? '100vw'; ?>" fetchpriority="high">
<?php elseif (!empty($heroPreload['href'])): ?>
  <link rel="preload" as="image" href="<?php echo e($heroPreload['href']); ?>" fetchpriority="high">
<?php endif; ?>

  <!-- Favicons -->
  <link rel="icon" href="/assets/images/favicon.svg" type="image/svg+xml">
  <link rel="icon" href="/assets/images/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/assets/images/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">

  <!-- Google Analytics 4 — placeholder. Replace G-XXXXXXXXXX ($googleAnalyticsId in config.php) post-launch, then uncomment.
  <script defer src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($googleAnalyticsId); ?>"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?php echo e($googleAnalyticsId); ?>');</script>
  -->

  <?php echo schemaScript(generateLocalBusinessSchema()); ?>

<?php
if (!empty($schemaMarkup)) {
    if (is_string($schemaMarkup)) {
        echo stripos(ltrim($schemaMarkup), '<script') === 0 ? $schemaMarkup : '<script type="application/ld+json">' . $schemaMarkup . '</script>';
    } elseif (is_array($schemaMarkup)) {
        $p1Nodes = array_is_list($schemaMarkup) ? $schemaMarkup : [$schemaMarkup];
        foreach ($p1Nodes as $p1Node) {
            if (is_array($p1Node)) echo schemaScript($p1Node) . "\n";
            elseif (is_string($p1Node)) echo $p1Node . "\n";
        }
    }
}
?>
</head>
<body<?php echo $bodyClass !== '' ? ' class="' . e($bodyClass) . '"' : ''; ?>>
