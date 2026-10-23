<?php
/**
 * includes/cta-band.php — mid-page compact lead form band (v6.3 placement standard).
 * Used ONCE on About, FAQ and blog posts, after the first content section:
 *   <section class="cta-band" id="estimate"> — copy ≈1/3 | form card ≈2/3, fields three-up
 *   (name | phone | email / service | button / consent | footnote). Form id: "cta-band".
 * Hidden fields (_next, _honey, form_location, consent_version/page, attribution,
 * spam shield) come from p1_lead_hidden_fields(). Styles live in framework.css (.cta-band).
 */
if (!function_exists('p1_cta_band')) {
    /**
     * @param string $eyebrow  short label above the heading
     * @param string $heading  H2 — may contain a <span class="text-accent"> (trusted markup, not escaped)
     * @param string $copy     one or two sentences (escaped)
     * @param string $service  service name to preselect ('' = none)
     */
    function p1_cta_band(string $eyebrow, string $heading, string $copy, string $service = ''): string {
        global $formAction, $phone, $phoneRaw;
        ob_start(); ?>
<section class="cta-band texture-grain" id="estimate" aria-labelledby="cta-band-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container-wide cta-band__grid">
    <div class="cta-band__copy">
      <span class="eyebrow-label"><?php echo e($eyebrow); ?></span>
      <h2 id="cta-band-title"><?php echo $heading; ?></h2>
      <p><?php echo e($copy); ?></p>
      <a class="link-call" href="tel:<?php echo e($phoneRaw); ?>"><?php echo icon('phone', 18); ?> Or call <?php echo e($phone); ?></a>
    </div>
    <div class="cta-band__card">
      <form action="<?php echo e($formAction); ?>" method="POST" class="cta-band__form" id="cta-band-form">
<?php echo p1_lead_hidden_fields('cta-band'); ?>
        <div class="cta-band__field"><label for="cta-band-name">Name *</label><input id="cta-band-name" type="text" name="name" autocomplete="name" required></div>
        <div class="cta-band__field"><label for="cta-band-phone">Phone *</label><input id="cta-band-phone" type="tel" name="phone" autocomplete="tel" required></div>
        <div class="cta-band__field"><label for="cta-band-email">Email *</label><input id="cta-band-email" type="email" name="email" autocomplete="email" required></div>
        <div class="cta-band__field cta-band__field--wide"><label for="cta-band-service">Service needed</label><select id="cta-band-service" name="service"><?php echo p1_service_options($service); ?></select></div>
        <div class="cta-band__submit"><button type="submit" class="btn btn-primary btn-block">Send my request</button></div>
        <label class="consent cta-band__consent" for="cta-band-terms"><input id="cta-band-terms" type="checkbox" name="terms_accepted" value="yes" required><span>I agree to the <a href="/terms/" target="_blank" rel="noopener">Terms</a> and <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and consent to be contacted about my request. *</span></label>
        <p class="form-footnote cta-band__note">Coastal Trim Lighting follows up by phone or email.</p>
      </form>
    </div>
  </div>
</section>
<?php
        return (string) ob_get_clean();
    }
}
