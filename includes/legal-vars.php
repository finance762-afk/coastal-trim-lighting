<?php
/**
 * includes/legal-vars.php — shared variable block + helpers for the four legal pages
 * (privacy-policy, terms, cookie-policy, accessibility). legal-compliance.md "PHP Header Block".
 * Pages require it AFTER config.php/functions.php and BEFORE head.php. Each page carries its own
 * 40vh hero markup (H1 in the page source, Last Updated from $lastUpdated).
 *
 * Intake gaps (logged in /content-confirmations.json):
 *   - Business entity type: not collected → $companyEntityType = '' (name printed without a suffix).
 *   - State of formation: not collected → governing law defaults to California, the state the
 *     business is located and operates in. Change $companyState if the client formed elsewhere.
 * No "general template / attorney review" disclaimer is printed (legal-compliance.md rule, Sep 29 2026).
 */
$companyEntityType = '';                                     // LLC / Corporation / Sole Proprietorship — not in intake
$companyName       = $siteName . ($companyEntityType !== '' ? ' ' . $companyEntityType : '');
$companyState      = 'California';                           // state of formation not in intake; operating state used
$companyCounty     = 'San Diego';                            // county of the business address (venue clause)
$companyEmail      = $email;
$companyPhone      = $phone;
$companyPhoneE164  = $phoneRaw;
$companyAddress    = $address['street'] . ', ' . cityStateLine(true);
$companyDomain     = $domain;
$lastUpdated       = 'October 23, 2026';                     // fixed: bump only when a policy's text changes

if (!function_exists('p1_legal_schema')) {
    /** WebPage + BreadcrumbList @graph for a legal page. */
    function p1_legal_schema(string $name, string $description, string $url, string $crumb): array {
        global $siteUrl;
        $bc = generateBreadcrumbSchema([['name' => $crumb, 'url' => $url]]);
        unset($bc['@context']);
        return [
            '@context' => 'https://schema.org',
            '@graph'   => [
                [
                    '@type'       => 'WebPage',
                    '@id'         => $url . '#webpage',
                    'url'         => $url,
                    'name'        => $name,
                    'description' => $description,
                    'isPartOf'    => ['@type' => 'WebSite', 'url' => $siteUrl . '/'],
                    'about'       => ['@id' => $siteUrl . '/#organization'],
                    'publisher'   => ['@id' => $siteUrl . '/#organization'],
                    'breadcrumb'  => ['@id' => $url . '#breadcrumb'],
                ],
                ['@id' => $url . '#breadcrumb'] + $bc,
            ],
        ];
    }


    /** "Contact Us" block every legal page ends with. */
    function p1_legal_contact(string $lead): string {
        global $companyName, $companyEmail, $companyPhone, $companyPhoneE164, $companyAddress;
        ob_start(); ?>
<p><?php echo e($lead); ?></p>
<address class="legal-contact">
  <strong><?php echo e($companyName); ?></strong><br>
  Email: <a href="mailto:<?php echo e($companyEmail); ?>"><?php echo e($companyEmail); ?></a><br>
  Phone: <a href="tel:<?php echo e($companyPhoneE164); ?>"><?php echo e($companyPhone); ?></a><br>
  Mail: <?php echo e($companyAddress); ?>
</address>
<?php
        return (string) ob_get_clean();
    }
}
