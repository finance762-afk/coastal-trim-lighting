<?php
/**
 * includes/footer.php — closes <main>, site footer, mobile CTA bar, cookie bar,
 * sitewide estimate <dialog> (form id "dialog"), scripts, </body></html>.
 * Loop variables are prefixed ($footSvc, $footArea) — never $svc/$area/$c/$card.
 * Hours are omitted until intake supplies them; no license/insurance/"free estimate"
 * claims until the client confirms them (config.php).
 */
$footAddressLine = (!empty($addressPublic) && !empty($address['street']) ? $address['street'] . ', ' : '') . cityStateLine(true);
?>
</main>

<footer class="site-footer">
  <div class="grain-layer" aria-hidden="true"></div>
  <div class="footer-top">
    <div class="container">
      <div class="footer-grid">

        <div class="footer-col footer-brand">
          <a href="/" class="footer-logo" aria-label="<?php echo e($siteName); ?> — home">
            <picture>
              <source type="image/webp" srcset="/assets/images/logo-v1-192.webp 192w, /assets/images/logo-v1.webp 440w" sizes="132px">
              <img src="/assets/images/logo-v1-192.png" alt="<?php echo e($siteName); ?> logo" width="132" height="132" loading="lazy" decoding="async">
            </picture>
          </a>
          <p><?php echo e($siteName); ?> installs holiday lighting and landscape and outdoor lighting for homes and businesses in <?php echo e(cityStateLine()); ?> and the surrounding area.</p>
          <div class="footer-badges">
            <span>Est. <?php echo (int) $yearEstablished; ?></span>
            <span>Residential &amp; Commercial</span>
            <span>Based in <?php echo e($address['city']); ?></span>
          </div>
        </div>

        <div class="footer-col">
          <h4>Services</h4>
          <ul>
            <?php foreach ($services as $footSvc): ?>
            <li><a href="<?php echo e(serviceUrl($footSvc)); ?>"><?php echo e($footSvc['name']); ?></a></li>
            <?php endforeach; ?>
            <li><a href="/services/">All Services</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Service Areas</h4>
          <ul>
            <?php foreach ($serviceAreas as $footArea): ?>
            <li><a href="<?php echo e(areaUrl($footArea)); ?>"><?php echo e($footArea['name']); ?>, <?php echo e($address['state']); ?></a></li>
            <?php endforeach; ?>
            <li><a href="/service-areas/">View All Areas</a></li>
          </ul>
          <h4 class="footer-subhead">Company</h4>
          <ul>
            <li><a href="/about/">About</a></li>
            <li><a href="/faq/">FAQ</a></li>
            <li><a href="/blog/">Blog</a></li>
            <li><a href="/contact/">Contact</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Contact</h4>
          <div class="footer-nap">
            <div><?php echo icon('phone', 18); ?><a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a></div>
            <div><?php echo icon('mail', 18); ?><a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a></div>
            <div><?php echo icon('map-pin', 18); ?><span><?php echo e($footAddressLine); ?></span></div>
            <?php if (!empty($businessHours)): ?>
            <div><?php echo icon('clock', 18); ?><span><?php echo e($businessHours); ?></span></div>
            <?php endif; ?>
            <?php if (!empty($directionsUrl)): ?>
            <div><?php echo icon('navigation', 18); ?><a href="<?php echo e($directionsUrl); ?>" target="_blank" rel="noopener">Get directions</a></div>
            <?php endif; ?>
          </div>
          <a href="/contact/" class="btn btn-accent footer-cta" data-open-estimate><?php echo e($estimateCtaLabel); ?></a>
        </div>

      </div>

      <!-- AEO entity block: consistent NAP on every page -->
      <div class="footer-entity" itemscope itemtype="https://schema.org/LocalBusiness" itemid="<?php echo e($siteUrl); ?>/#organization">
        <meta itemprop="name" content="<?php echo e($siteName); ?>">
        <meta itemprop="url" content="<?php echo e($siteUrl); ?>/">
        <meta itemprop="telephone" content="<?php echo e($phoneRaw); ?>">
        <meta itemprop="email" content="<?php echo e($email); ?>">
        <meta itemprop="image" content="<?php echo e($siteUrl); ?>/assets/images/logo-v1.png">
        <meta itemprop="foundingDate" content="<?php echo (int) $yearEstablished; ?>">
        <?php if (!empty($gbpMapsUrl)): ?><meta itemprop="hasMap" content="<?php echo e($gbpMapsUrl); ?>"><?php endif; ?>
        <?php foreach ($serviceAreas as $footArea): ?><meta itemprop="areaServed" content="<?php echo e($footArea['name'] . ', ' . $address['state']); ?>"><?php endforeach; ?>
        <p itemprop="description"><strong><?php echo e($siteName); ?></strong> is a lighting contractor based in <?php echo e(cityStateLine()); ?>, in business since <?php echo (int) $yearEstablished; ?><?php if (!empty($ownerName)): ?> and owned by <span itemprop="founder" itemscope itemtype="https://schema.org/Person"><span itemprop="name"><?php echo e($ownerName); ?></span></span><?php endif; ?>. <?php echo e($siteName); ?> installs residential and commercial holiday lighting and landscape and outdoor lighting for properties in <?php echo e($address['city']); ?> and the surrounding area<?php echo !empty($targetRadiusMiles) ? ' within about ' . (int) $targetRadiusMiles . ' miles' : ''; ?>. Reach <?php echo e($siteName); ?> at <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a>, <a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a>, or <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress"><?php if (!empty($addressPublic) && !empty($address['street'])): ?><span itemprop="streetAddress"><?php echo e($address['street']); ?></span>, <?php endif; ?><span itemprop="addressLocality"><?php echo e($address['city']); ?></span>, <span itemprop="addressRegion"><?php echo e($address['state']); ?></span> <span itemprop="postalCode"><?php echo e($address['zip']); ?></span></span>.</p>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <div class="footer-legal-row" role="navigation" aria-label="Legal">
        <a href="/privacy-policy/">Privacy Policy</a>
        <span class="divider">|</span>
        <a href="/terms/">Terms of Service</a>
        <span class="divider">|</span>
        <a href="/cookie-policy/">Cookie Policy</a>
        <span class="divider">|</span>
        <a href="/accessibility/">Accessibility</a>
        <span class="divider">|</span>
        <a href="/privacy-policy/#ccpa-rights">Do Not Sell or Share My Personal Information</a>
        <span class="divider">|</span>
        <a href="/sitemap.xml">Sitemap</a>
      </div>
      <div class="footer-bottom-bar">
        <p class="footer-copy">&copy; <?php echo date('Y'); ?> <?php echo e($siteName); ?>. All rights reserved.</p>
        <p class="footer-credit"><a href="https://pageoneinsights.com" rel="dofollow" target="_blank">Web Design & Hosting by Page One Insights, LLC</a></p>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/partner-badge.php'; ?>
</footer>

<button type="button" class="back-to-top" aria-label="Back to top"><?php echo icon('chevron-down', 20, 'icon-flip'); ?></button>

<!-- Mobile sticky CTA bar (below 760px, appears after the hero). accepts_sms = false → two buttons. -->
<div class="mobile-cta-bar" aria-label="Quick contact">
  <a href="tel:<?php echo e($phoneRaw); ?>" class="mobile-cta-bar__call"><?php echo icon('phone', 18); ?> Call Now</a>
  <a href="/contact/" class="mobile-cta-bar__estimate" data-open-estimate><?php echo icon('calendar-check', 18); ?> Estimate</a>
</div>

<!-- Cookie notice: slim bar, shown after first scroll, dismissal remembered (main.js) -->
<div class="cookie-banner" id="cookie-banner" role="region" aria-label="Cookie notice">
  <p class="cookie-banner__text">We use cookies to understand how this site is used. <a href="/cookie-policy/">Cookie Policy</a></p>
  <button type="button" class="cookie-banner__dismiss" aria-label="Dismiss cookie notice">Got it</button>
</div>

<!-- Sitewide estimate dialog — opened by any [data-open-estimate] (main.js). Form id: dialog. -->
<dialog class="estimate-dialog" id="estimate-dialog" aria-labelledby="estimate-dialog-title">
  <div class="dialog-head">
    <h2 id="estimate-dialog-title"><?php echo e($estimateCtaLabel); ?></h2>
    <button type="button" class="dialog-close" data-close-estimate aria-label="Close"><?php echo icon('x', 20); ?></button>
  </div>
  <div class="dialog-body">
    <p class="hero-form-tagline">Tell <?php echo e($siteName); ?> about your property and we will follow up by phone or email.</p>
    <form id="dialog-form" class="estimate-form" action="<?php echo e($formAction); ?>" method="POST">
      <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
      <input type="hidden" name="_next" value="<?php echo e($siteUrl); ?>/thank-you">
      <input type="hidden" name="form_location" value="dialog">
      <?php echo p1_attribution_fields('dialog'); ?>
      <input type="hidden" name="consent_version" value="v2.1">
      <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/'); ?>">
      <input type="hidden" name="_consent_version" value="v2.1">
      <input type="hidden" name="_consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/'); ?>">

      <div class="form-grid">
        <div class="field">
          <label for="dialog-name">Your name *</label>
          <input id="dialog-name" type="text" name="name" autocomplete="name" required>
        </div>
        <div class="field">
          <label for="dialog-phone">Phone *</label>
          <input id="dialog-phone" type="tel" name="phone" autocomplete="tel" required>
        </div>
        <div class="field full">
          <label for="dialog-email">Email *</label>
          <input id="dialog-email" type="email" name="email" autocomplete="email" required>
        </div>
        <div class="field full">
          <label for="dialog-service">Service needed</label>
          <select id="dialog-service" name="service"><?php echo p1_service_options(); ?></select>
        </div>
      </div>

      <fieldset class="form-consent-fieldset">
        <legend class="form-consent-legend">Communication consent</legend>
        <label class="form-consent-item" for="dialog-email-opt">
          <input id="dialog-email-opt" type="checkbox" name="email_opt_in" value="yes">
          <span><strong>Email updates (optional):</strong> I agree to receive emails from <?php echo e($siteName); ?> about my inquiry, services, promotions, and news. Unsubscribe anytime via the link in any email. Message frequency varies.</span>
        </label>
        <label class="form-consent-item" for="dialog-sms-opt">
          <input id="dialog-sms-opt" type="checkbox" name="sms_opt_in" value="yes">
          <span><strong>Text messages (optional):</strong> I agree to receive text messages from <?php echo e($siteName); ?> at the number I provided, including appointment reminders, service updates, and promotional offers. Message frequency varies. Message and data rates may apply. Reply STOP to unsubscribe, HELP for help. <strong>Consent is not a condition of purchase.</strong></span>
        </label>
        <label class="form-consent-item" for="dialog-terms">
          <input id="dialog-terms" type="checkbox" name="terms_accepted" value="yes" required>
          <span>I have read and agree to the <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and <a href="/terms/" target="_blank" rel="noopener">Terms of Service</a>. *</span>
        </label>
      </fieldset>

      <!-- spam shield: signed render timestamp + JS interaction signal -->
      <?php $__ft_ts = (string) time(); ?>
      <input type="hidden" name="_ft" value="<?php echo $__ft_ts . '.' . hash_hmac('sha256', $__ft_ts, $leadsFormSecret); ?>">
      <input type="hidden" name="_js" value="" class="js-shield-field">
      <?php if (empty($GLOBALS['__js_shield'])) { $GLOBALS['__js_shield'] = 1; ?>
      <script>(function(){var d=document,f=function(){var i,e=d.querySelectorAll('.js-shield-field');for(i=0;i<e.length;i++)e[i].value='1';d.removeEventListener('pointerdown',f);d.removeEventListener('keydown',f);};d.addEventListener('pointerdown',f);d.addEventListener('keydown',f);})();</script>
      <?php } ?>

      <button type="submit" class="btn btn-primary btn-lg btn-block">Send My Request</button>
      <p class="form-footnote">Prefer to talk? Call <a href="tel:<?php echo e($phoneRaw); ?>"><?php echo e($phone); ?></a>.</p>
    </form>
  </div>
</dialog>

<script src="/assets/js/main.js?v=<?php echo $cssVersion; ?>" defer></script>
<script src="/assets/js/animations.js?v=<?php echo $cssVersion; ?>" defer></script>
<script src="/assets/js/effects.js?v=<?php echo $cssVersion; ?>" defer></script>
<script>
/* Back-to-top: show after 600px, smooth-scroll to top (main.js mirrors this; both are idempotent). */
(function () {
  var b = document.querySelector('.back-to-top');
  if (!b) return;
  var t = function () { b.classList.toggle('visible', window.scrollY > 600); };
  window.addEventListener('scroll', t, { passive: true });
  b.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });
})();
</script>
</body>
</html>
