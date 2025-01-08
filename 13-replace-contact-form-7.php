<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: Replace Contact Form 7 shortcodes with Fluent Forms shortcodes ONCE
* @type: PHP
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-08 14:45:18
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: all
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
<?php
/**
 * Replace Contact Form 7 shortcodes with Fluent Forms shortcodes ONCE.
 */
function replace_cf7_with_fluentforms_once() {
    // Check if the replacement has already run.
    if (get_option('cf7_to_fluentforms_replacement_done')) {
        return; // Exit if already run.
    }

    // Define mapping of old CF7 IDs to new Fluent Forms IDs.
    $form_replacements = [
        '4'     => '22',    // Contact form 1 -> FluentForm ID 22
        '356'   => '24',    // Volunteer -> FluentForm ID 24
        '357'   => '23',    // Contact Page -> FluentForm ID 23
        '749'   => '21',    // Φόρμα επικοινωνίας -> FluentForm ID 21
        '1848'  => '20',    // test -> FluentForm ID 20
        '2405'  => '19',    // RSVP FORM -> FluentForm ID 19
        '2485'  => '18',    // Contact page en -> FluentForm ID 18
        '3185'  => '17',    // Volunteer_GR -> FluentForm ID 17
        '3270'  => '16',    // Foster_GR_copy -> FluentForm ID 16
        '3728'  => '15',    // Foster_EN_copy -> FluentForm ID 15
        '8036'  => '14',    // Εντάξει -> FluentForm ID 14
        '8057'  => '13',    // ENTAXEI_GR -> FluentForm ID 13
        '8307'  => '12',    // Volunteer_EN_copy -> FluentForm ID 12
        '10422' => '11',    // Report FAQ GR -> FluentForm ID 11
        '10427' => '10',    // Report FAQ EN -> FluentForm ID 10
        '12890' => '9',     // MATHEMATICAL_DICTIONARY_GR -> FluentForm ID 9
        '13546' => '8',     // ENTAXEI_2_GR -> FluentForm ID 8
        '15088' => '7',     // Report FAQ GR_copy -> FluentForm ID 7
        '22394' => '6',     // ENTAXEI_UKR -> FluentForm ID 6
        '23133' => '5',     // ENTAXEI_3_GR -> FluentForm ID 5
        '29767' => '4',     // ENTAXEI_UKR_copy -> FluentForm ID 4
        '29768' => '3',     // ENTAXEI_FR_TUR_SOM -> FluentForm ID 3
    ];

    // WordPress Database functions.
    global $wpdb;
    $table = $wpdb->prefix . 'posts';

    foreach ($form_replacements as $cf7_id => $fluentform_id) {
        $new_shortcode = '[fluentform id="' . $fluentform_id . '"]';

        // Define the regex pattern for CF7 shortcode variants.
        $shortcode_pattern = '\[contact-form-7\s+id="' . $cf7_id . '".*?\]';

        // Use a regex to replace all variants of the shortcode.
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE $table SET post_content = REGEXP_REPLACE(post_content, %s, %s) WHERE post_content REGEXP %s",
                $shortcode_pattern,
                $new_shortcode,
                $shortcode_pattern
            )
        );
    }

    // Set the flag to prevent future runs.
    update_option('cf7_to_fluentforms_replacement_done', true);

    // Optional: Log success message to debug log.
    error_log('CF7 to Fluent Forms replacement script has run successfully.');
}
add_action('init', 'replace_cf7_with_fluentforms_once');
