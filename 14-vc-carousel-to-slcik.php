<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: VC filters for content fixes
* @name: vc carousel to slcik slider
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-08 15:21:23
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
function replace_vc_images_carousel_with_slick_slider() {
    global $wpdb;

    // Check if the replacement has already been executed
    if (get_option('vc_to_slick_replacement_done')) {
        return; // Exit if already executed
    }

    // Fetch all posts containing the [vc_images_carousel] shortcode
    $posts = $wpdb->get_results("
        SELECT ID, post_content
        FROM {$wpdb->posts}
        WHERE post_content LIKE '%[vc_images_carousel%'
    ");

    if ($posts) {
        foreach ($posts as $post) {
            $original_content = $post->post_content;

            // Replace [vc_images_carousel] with [slick_slider] using regex
            $updated_content = preg_replace_callback(
                '/\[vc_images_carousel(.*?)\]/',
                function ($matches) {
                    $shortcode_attributes = shortcode_parse_atts($matches[1]);

                    // Extract 'images' attribute from the shortcode
                    $images = isset($shortcode_attributes['images']) ? $shortcode_attributes['images'] : '';

                    // Build the new [slick_slider] shortcode
                    return '[slick_slider images="' . $images . '"]';
                },
                $original_content
            );

            // Update the post in the database if changes were made
            if ($updated_content !== $original_content) {
                $wpdb->update(
                    $wpdb->posts,
                    array('post_content' => $updated_content),
                    array('ID' => $post->ID),
                    array('%s'),
                    array('%d')
                );
            }
        }

        // Mark the replacement as done
        update_option('vc_to_slick_replacement_done', true);

        echo "Shortcode replacement completed successfully.";
    } else {
        echo "No posts found with the [vc_images_carousel] shortcode.";
    }
}
add_action('admin_init', 'replace_vc_images_carousel_with_slick_slider');