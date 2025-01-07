<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: Replace Contact Form 7 shortcodes with Fluent Forms shortcodes ONCE
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2024-12-17 14:29:05
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
        '4'     => '22',    // Contact form 1 -> FluentForm ID 1
        '356'   => '24',   // Volunteer -> FluentForm ID 24
        '357'   => '23',   // Contact Page -> FluentForm ID 25
        '749'   => '21',   // Φόρμα επικοινωνίας -> FluentForm ID 26
        '1848'  => '20',   // test -> FluentForm ID 27
        '2405'  => '19',   // RSVP FORM -> FluentForm ID 28
        '2485'  => '18',   // Contact page en -> FluentForm ID 29
        '3185'  => '17',   // Volunteer_GR -> FluentForm ID 30
        '3270'  => '16',   // Foster_GR_copy -> FluentForm ID 31
        '3728'  => '15',   // Foster_EN_copy -> FluentForm ID 32
        '8036'  => '14',   // Εντάξει -> FluentForm ID 33
        '8057'  => '13',   // ENTAXEI_GR -> FluentForm ID 34
        '8307'  => '12',   // Volunteer_EN_copy -> FluentForm ID 35
        '10422' => '11',   // Report FAQ GR -> FluentForm ID 36
        '10427' => '10',   // Report FAQ EN -> FluentForm ID 37
        '12890' => '9',   // MATHEMATICAL_DICTIONARY_GR -> FluentForm ID 38
        '13546' => '8',   // ENTAXEI_2_GR -> FluentForm ID 39
        '15088' => '7',   // Report FAQ GR_copy -> FluentForm ID 40
        '22394' => '6',   // ENTAXEI_UKR -> FluentForm ID 41
        '23133' => '5',   // ENTAXEI_3_GR -> FluentForm ID 42
        '29767' => '4',   // ENTAXEI_UKR_copy -> FluentForm ID 43
        '29768' => '3',   // ENTAXEI_FR_TUR_SOM -> FluentForm ID 44
    ];

    // WordPress Database functions.
    global $wpdb;
    $table = $wpdb->prefix . 'posts';

    foreach ($form_replacements as $cf7_id => $fluentform_id) {
        // Possible CF7 shortcodes: with and without titles.
        $old_shortcode_with_title    = '[contact-form-7 id="' . $cf7_id . '"';
        $old_shortcode_without_title = '[contact-form-7 id="' . $cf7_id . '"]';
        $new_shortcode               = '[fluentform id="' . $fluentform_id . '"]';

        // Replace shortcodes in post content.
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE $table SET post_content = REPLACE(post_content, %s, %s) WHERE post_content LIKE %s",
                $old_shortcode_without_title,
                $new_shortcode,
                '%' . $wpdb->esc_like($old_shortcode_without_title) . '%'
            )
        );

        $wpdb->query(
            $wpdb->prepare(
                "UPDATE $table SET post_content = REPLACE(post_content, %s, %s) WHERE post_content LIKE %s",
                $old_shortcode_with_title,
                $new_shortcode,
                '%' . $wpdb->esc_like($old_shortcode_with_title) . '%'
            )
        );
    }

    // Set the flag to prevent future runs.
    update_option('cf7_to_fluentforms_replacement_done', true);

    // Optional: Log success message to debug log.
    error_log('CF7 to Fluent Forms replacement script has run successfully.');
}
add_action('init', 'replace_cf7_with_fluentforms_once');
