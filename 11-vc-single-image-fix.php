<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: VC filters for content fixes
* @name: VC single image fix
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-07 20:55:12
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
function replace_vc_single_image_shortcode() {
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
            'posts_per_page' => 10, // Batch size for processing
            'offset'         => (int) get_option('replace_vc_single_image_offset_' . $post_type, 0),
        ];

        // Execute WP_Query with args
        $query = new WP_Query($args);

        $console_log['total_posts'] += $query->found_posts;

        while ($query->have_posts()) {
            $query->the_post();

            // Get Post Content
            $post_id = get_the_ID();
            $content = get_post_field('post_content', $post_id);

            // Find all [vc_single_image] shortcodes
            preg_match_all('/\[vc_single_image(?: [^\]]*image="(\d+)")[^\]]*img_size="([^"]+)"[^\]]*\]/', $content, $matches, PREG_SET_ORDER);

            if (!empty($matches)) {
                foreach ($matches as $match) {
                    $image_id = (int) $match[1]; // Image ID
                    $img_size = $match[2];       // Image size (e.g., medium, large)

                    // Get the image URL by attachment ID and size
                    $image_url = wp_get_attachment_image_url($image_id, $img_size);

                    if ($image_url) {
                        // Generate the <img> tag
                        $img_tag = sprintf('<img src="%s" alt="" />', esc_url($image_url));

                        // Replace the shortcode with the generated <img> tag
                        $content = str_replace($match[0], $img_tag, $content);
                    }
                }

                // Only update the post if the content has changed
                if ($content !== get_post_field('post_content', $post_id)) {
                    wp_update_post([
                        'ID'           => $post_id,
                        'post_content' => $content,
                    ]);
                }
            }

            $console_log['processed_posts']++;
        }

        // Update offset for batch processing
        $processed_posts = $query->post_count;
        $current_offset = (int) get_option('replace_vc_single_image_offset_' . $post_type, 0);
        $new_offset = $current_offset + $processed_posts;

        if ($new_offset >= $query->found_posts) {
            update_option('replace_vc_single_image_done_' . $post_type, true);
            delete_option('replace_vc_single_image_offset_' . $post_type);
        } else {
            update_option('replace_vc_single_image_offset_' . $post_type, $new_offset);
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
        if (!get_option('replace_vc_single_image_done_' . $post_type)) {
            $done_for_all_post_types = false;
            replace_vc_single_image_shortcode();
            break; // Process one post type at a time per request
        }
    }

    if ($done_for_all_post_types) {
        echo '<script>console.log("All post types processed successfully.");</script>';
    }
});
