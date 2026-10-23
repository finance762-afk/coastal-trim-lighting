<?php
/**
 * includes/header.php — skip link, fixed glass header, desktop nav, mobile overlay, opens <main>.
 * Loop variables are prefixed ($navSvc, $navArea) — never $svc/$area, which pages own.
 * Service + area links are gated on disk (serviceUrl()/areaUrl()) until those pages exist.
 */
$navLogoAlt = $siteName . ' logo';
?>
<a href="#main-content" class="skip-link">Skip to main content</a>

<header class="site-header" data-header>
  <nav class="navbar" aria-label="Main navigation">
    <div class="navbar-inner container">
      <a href="/" class="site-logo" aria-label="<?php echo e($siteName); ?> — home">
        <picture>
          <source type="image/webp" srcset="/assets/images/logo-v1-192.webp 192w, /assets/images/logo-v1.webp 440w" sizes="96px">
          <img src="/assets/images/logo-v1-192.png" alt="<?php echo e($navLogoAlt); ?>" width="96" height="96" decoding="async">
        </picture>
      </a>

      <ul class="navbar-links">
        <li><a href="/"<?php echo ariaCurrent('home'); ?>>Home</a></li>
        <li class="has-dropdown">
          <a href="/services/"<?php echo ariaCurrent('services'); ?> aria-haspopup="true">Services <?php echo icon('chevron-down', 14); ?></a>
          <ul class="dropdown" style="display:none">
            <?php foreach ($services as $navSvc): ?>
            <li><a href="<?php echo e(serviceUrl($navSvc)); ?>"<?php echo (isset($serviceSlug) && $serviceSlug === $navSvc['slug']) ? ' aria-current="page"' : ''; ?>><?php echo e($navSvc['name']); ?></a></li>
            <?php endforeach; ?>
            <li><a href="/services/">All Services</a></li>
          </ul>
        </li>
        <li class="has-dropdown">
          <a href="/service-areas/"<?php echo ariaCurrent('service-areas'); ?> aria-haspopup="true">Service Areas <?php echo icon('chevron-down', 14); ?></a>
          <ul class="dropdown" style="display:none">
            <?php foreach ($serviceAreas as $navArea): ?>
            <li><a href="<?php echo e(areaUrl($navArea)); ?>"<?php echo (isset($citySlug) && $citySlug === $navArea['slug']) ? ' aria-current="page"' : ''; ?>><?php echo e($navArea['name']); ?>, <?php echo e($address['state']); ?></a></li>
            <?php endforeach; ?>
            <li><a href="/service-areas/">All Service Areas</a></li>
          </ul>
        </li>
        <li><a href="/about/"<?php echo ariaCurrent('about'); ?>>About</a></li>
        <li><a href="/blog/"<?php echo ariaCurrent('blog'); ?>>Blog</a></li>
        <li><a href="/contact/"<?php echo ariaCurrent('contact'); ?>>Contact</a></li>
      </ul>

      <div class="navbar-cta">
        <a href="tel:<?php echo e($phoneRaw); ?>" class="btn btn-secondary navbar-phone"><?php echo icon('phone', 18); ?><span><?php echo e($phone); ?></span></a>
        <a href="/contact/" class="btn btn-primary" data-open-estimate><?php echo e($estimateCtaLabel); ?></a>
      </div>

      <button type="button" class="hamburger" aria-label="Open menu" aria-controls="mobile-menu" aria-expanded="false">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
      </button>
    </div>
  </nav>
</header>

<!-- Mobile overlay lives OUTSIDE <header>: the header's backdrop-filter would become its containing block. -->
<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
  <div class="mobile-menu-inner">
    <nav aria-label="Mobile navigation">
      <ul class="mobile-menu-links">
        <li><a href="/"<?php echo ariaCurrent('home'); ?>>Home</a></li>
        <li>
          <a href="/services/"<?php echo ariaCurrent('services'); ?>>Services</a>
          <ul class="mobile-submenu">
            <?php foreach ($services as $navSvc): ?>
            <li><a href="<?php echo e(serviceUrl($navSvc)); ?>"><?php echo e($navSvc['name']); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li>
          <a href="/service-areas/"<?php echo ariaCurrent('service-areas'); ?>>Service Areas</a>
          <ul class="mobile-submenu">
            <?php foreach ($serviceAreas as $navArea): ?>
            <li><a href="<?php echo e(areaUrl($navArea)); ?>"><?php echo e($navArea['name']); ?>, <?php echo e($address['state']); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li><a href="/about/"<?php echo ariaCurrent('about'); ?>>About</a></li>
        <li><a href="/blog/"<?php echo ariaCurrent('blog'); ?>>Blog</a></li>
        <li><a href="/faq/"<?php echo ariaCurrent('faq'); ?>>FAQ</a></li>
        <li><a href="/contact/"<?php echo ariaCurrent('contact'); ?>>Contact</a></li>
      </ul>
    </nav>
    <div class="mobile-menu-cta">
      <a href="tel:<?php echo e($phoneRaw); ?>" class="btn btn-accent btn-lg btn-block"><?php echo icon('phone', 18); ?> Call <?php echo e($phone); ?></a>
      <a href="/contact/" class="btn btn-outline-white btn-lg btn-block" data-open-estimate><?php echo e($estimateCtaLabel); ?></a>
    </div>
  </div>
</div>

<main id="main-content">
