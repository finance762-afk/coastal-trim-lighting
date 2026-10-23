<?php
/**
 * includes/hero-form.php — compact hero lead form card (.hero-form-card) for
 * service pages and the services hub (Phase 4). Same fields as the homepage
 * card plus email (the leads endpoint rejects a submission without one).
 * Hidden fields (_next, _honey, form_location, consent_version/page,
 * attribution, spam shield) come from p1_lead_hidden_fields().
 * Pages set $pageType / $serviceSlug BEFORE head.php so attribution is right.
 */
if (!function_exists('p1_hero_form_card')) {
    /**
     * @param string $formId   unique on the page ('hero')
     * @param string $service  service name to preselect ('' = none)
     * @param string $title    card heading
     * @param string $tagline  one short line under the heading
     */
    function p1_hero_form_card(string $formId, string $service, string $title, string $tagline): string {
        global $formAction;
        $id = e($formId);
        ob_start(); ?>
<aside class="hero-form-card" id="estimate-form" aria-labelledby="<?php echo $id; ?>-form-title">
  <h2 id="<?php echo $id; ?>-form-title"><?php echo e($title); ?></h2>
  <p class="hero-form-tagline"><?php echo e($tagline); ?></p>
  <form action="<?php echo e($formAction); ?>" method="POST" class="hero-form" id="<?php echo $id; ?>-form">
<?php echo p1_lead_hidden_fields($formId); ?>
    <div class="form-row"><label class="sr-only" for="<?php echo $id; ?>-name">Name</label><input id="<?php echo $id; ?>-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
    <div class="form-row"><label class="sr-only" for="<?php echo $id; ?>-phone">Phone</label><input id="<?php echo $id; ?>-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" required></div>
    <div class="form-row"><label class="sr-only" for="<?php echo $id; ?>-email">Email</label><input id="<?php echo $id; ?>-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
    <div class="form-row"><label class="sr-only" for="<?php echo $id; ?>-service">Service</label><select id="<?php echo $id; ?>-service" name="service"><?php echo p1_service_options($service); ?></select></div>
    <label class="consent" for="<?php echo $id; ?>-terms"><input id="<?php echo $id; ?>-terms" type="checkbox" name="terms_accepted" value="yes" required><span>I agree to the <a href="/terms/" target="_blank" rel="noopener">Terms</a> and <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and consent to be contacted. *</span></label>
    <button type="submit" class="btn btn-primary btn-block">Send my request</button>
  </form>
</aside>
<?php
        return (string) ob_get_clean();
    }
}
