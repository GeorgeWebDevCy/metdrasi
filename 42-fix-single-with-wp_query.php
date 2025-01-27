<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: fix single with wp_query
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-15 15:39:34
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
function process_vc_single_image_shortcodes_optimized() {
    $batch_size = 10; // Define the number of posts to process in each batch

    // Get all public post types
    $post_types = get_post_types(['public' => true]);

    // Query to fetch posts that haven't been processed yet
    $args = [
        'post_type'      => $post_types,
        'posts_per_page' => $batch_size,
        'post_status'    => 'publish',
        'meta_query'     => [
            [ // Exclude already processed posts
                'key'     => '_vc_image_shortcode_processed',
                'compare' => 'NOT EXISTS',
            ],
        ],
    ];

    // Fetch posts
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $processed_count = 0;

        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $content = get_post_field('post_content', $post_id);

            // Match all vc_single_image shortcodes in the content
            preg_match_all('/\\[vc_single_image image=\"(\\d+)\" img_size=\"(\\w+)\"[^\\]]*\\]/', $content, $matches, PREG_SET_ORDER);

            if (!empty($matches)) {
                foreach ($matches as $shortcode) {
                    $image_id = (int) $shortcode[1];
                    $img_size = $shortcode[2];

                    // Get the image URL
                    $url = wp_get_attachment_image_url($image_id, $img_size);
                    if ($url) {
                        // Replace the shortcode with an <img> tag
                        $img_tag = sprintf('<img src=\"%s\" />', esc_url($url));
                        $content = str_replace($shortcode[0], $img_tag, $content);
                    }
                }

                // Update the post content only if changes were made
                wp_update_post([
                    'ID'           => $post_id,
                    'post_content' => $content,
                ]);
            }

            // Mark the post as processed
            update_post_meta($post_id, '_vc_image_shortcode_processed', true);

            $processed_count++;
        }

        // Log batch progress
        echo "<script>console.log('Batch processed: {$processed_count} posts.');</script>";
    } else {
        // No more posts to process
        echo "<script>console.log('All posts have been processed.');</script>";
    }

    wp_reset_postdata();
}

// Hook the function to init
add_action('init', 'process_vc_single_image_shortcodes_optimized');
