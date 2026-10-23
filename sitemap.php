<?php
/**
 * sitemap.php — served at /sitemap.xml (.htaccess rewrite). Emits XML from registries:
 *   - core + legal pages (list below), services from config.php $services,
 *     areas from config.php $serviceAreas, posts from includes/blog-data.php ($blogPosts) when it exists.
 * Every entry is gated on disk (pageExists) so unbuilt pages never appear; lastmod = file mtime.
 * Excluded on purpose: /thank-you (noindex), /404, and the /blog/ "coming soon" placeholder.
 * Trailing-slash URLs match each page's canonical exactly.
 * Priorities: home 1.0, services 0.8, other pages 0.6, legal 0.3 (changefreq yearly).
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$smRoot  = $_SERVER['DOCUMENT_ROOT'];
$smLogo  = ['src' => '/assets/images/logo-v1.png', 'caption' => $siteName . ' logo badge: script lettering over a sunset coastline with palm trees, ringed by colored string lights'];
$smPages = [
    ['path' => '/',                'file' => 'index.php', 'changefreq' => 'weekly',  'priority' => '1.0', 'images' => [$smLogo]],
    ['path' => '/services/',       'changefreq' => 'monthly', 'priority' => '0.8'],
];
foreach ($services as $smSvc) {
    $smPages[] = ['path' => '/services/' . $smSvc['slug'] . '/', 'changefreq' => 'monthly', 'priority' => '0.8'];
}
$smPages[] = ['path' => '/service-areas/', 'changefreq' => 'monthly', 'priority' => '0.6'];
foreach ($serviceAreas as $smArea) {
    $smPages[] = ['path' => '/service-areas/' . $smArea['slug'] . '/', 'changefreq' => 'monthly', 'priority' => '0.6'];
}
$smPages = array_merge($smPages, [
    ['path' => '/about/',          'changefreq' => 'monthly', 'priority' => '0.6', 'images' => [$smLogo]],
    ['path' => '/contact/',        'changefreq' => 'monthly', 'priority' => '0.6'],
    ['path' => '/faq/',            'changefreq' => 'monthly', 'priority' => '0.6'],
    ['path' => '/privacy-policy/', 'changefreq' => 'yearly',  'priority' => '0.3'],
    ['path' => '/terms/',          'changefreq' => 'yearly',  'priority' => '0.3'],
    ['path' => '/cookie-policy/',  'changefreq' => 'yearly',  'priority' => '0.3'],
    ['path' => '/accessibility/',  'changefreq' => 'yearly',  'priority' => '0.3'],
]);

$blogPosts = [];
if (is_file($smRoot . '/includes/blog-data.php')) include $smRoot . '/includes/blog-data.php';

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php foreach ($smPages as $smP):
    $smFile = $smRoot . '/' . ($smP['file'] ?? trim($smP['path'], '/') . '/index.php');
    if ($smP['path'] !== '/' && !pageExists($smP['path'])) continue;
    if (!is_file($smFile)) continue; ?>
  <url>
    <loc><?php echo htmlspecialchars($siteUrl . $smP['path'], ENT_XML1); ?></loc>
    <lastmod><?php echo date('Y-m-d', filemtime($smFile)); ?></lastmod>
    <changefreq><?php echo $smP['changefreq']; ?></changefreq>
    <priority><?php echo $smP['priority']; ?></priority>
<?php foreach ($smP['images'] ?? [] as $smImg): ?>
    <image:image>
      <image:loc><?php echo htmlspecialchars($siteUrl . $smImg['src'], ENT_XML1); ?></image:loc>
      <image:caption><?php echo htmlspecialchars($smImg['caption'], ENT_XML1); ?></image:caption>
    </image:image>
<?php endforeach; ?>
  </url>
<?php endforeach; ?>
<?php foreach ((array) $blogPosts as $smPost): if (empty($smPost['slug']) || !pageExists('/blog/' . $smPost['slug'])) continue; ?>
  <url>
    <loc><?php echo htmlspecialchars($siteUrl . '/blog/' . $smPost['slug'] . '/', ENT_XML1); ?></loc>
    <lastmod><?php echo htmlspecialchars($smPost['dateISO'] ?? date('Y-m-d'), ENT_XML1); ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
<?php endforeach; ?>
</urlset>
