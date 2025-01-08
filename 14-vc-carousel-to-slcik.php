<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: VC filters for content fixes
* @name: vc carousel to slcik slider
* @type: PHP
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-08 12:09:40
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
    // Get all public post types
    $post_types = get_post_types(['public' => true], 'names');

    // Prepare for browser console logging
    $console_log = [
        'processed_posts' => 0,
        'total_posts'     => 0,
        'remaining_posts' => 0,
    ];

    foreach ($post_types as $post_type) {
        // Args for WP_Query for the current post type
        $args = [
            'post_type'      => $post_type,
            'posts_per_page' => 50, // Batch size for processing
            'offset'         => (int) get_option('replace_vc_images_carousel_offset_' . $post_type, 0),
            's'              => '[vc_images_carousel', // Search for posts containing the shortcode
        ];

        // Execute WP_Query with args
        $query = new WP_Query($args);

        $console_log['total_posts'] += $query->found_posts;

        while ($query->have_posts()) {
            $query->the_post();

            // Get Post Content
            $post_id = get_the_ID();
            $original_content = get_post_field('post_content', $post_id);

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

            // Update the post if the content has changed
            if ($updated_content !== $original_content) {
                wp_update_post([
                    'ID'           => $post_id,
                    'post_content' => $updated_content,
                ]);
            }

            $console_log['processed_posts']++;
        }

        // Update offset for batch processing
        $processed_posts = $query->post_count;
        $current_offset = (int) get_option('replace_vc_images_carousel_offset_' . $post_type, 0);
        $new_offset = $current_offset + $processed_posts;

        if ($new_offset >= $query->found_posts) {
            update_option('replace_vc_images_carousel_done_' . $post_type, true);
            delete_option('replace_vc_images_carousel_offset_' . $post_type);
        } else {
            update_option('replace_vc_images_carousel_offset_' . $post_type, $new_offset);
        }

        $console_log['remaining_posts'] += $query->found_posts - $new_offset;

        // Reset Post Data
        wp_reset_postdata();
    }

    // Output browser console log
    echo '<script>';
    echo 'console.log(' . json_encode($console_log) . ');';
    echo '</script>';
}

// Run the function in batches when needed
add_action('init', function () {
    // Process in batches until all posts are done
    $done_for_all_post_types = true;

    $post_types = get_post_types(['public' => true], 'names');
    foreach ($post_types as $post_type) {
        if (!get_option('replace_vc_images_carousel_done_' . $post_type)) {
            $done_for_all_post_types = false;
            replace_vc_images_carousel_with_slick_slider();
            break; // Process one post type at a time per request
        }
    }

    if ($done_for_all_post_types) {
        echo '<script>console.log("All post types processed successfully, [vc_images_carousel] replaced with [slick_slider].");</script>';
    }
});
