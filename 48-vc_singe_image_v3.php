<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: vc_singe_image_v3
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-15 15:58:51
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
function process_vc_single_image_shortcodes_once() {
    global $wpdb;

    // Check if the script has already run
    if (get_option('vc_image_shortcode_processed_sql') === true) {
        return;
    }

    // Step 1: Query posts of all public post types and statuses
    $results = $wpdb->get_results("SELECT ID, post_content FROM {$wpdb->posts} WHERE post_content LIKE '%[vc_single_image%' AND post_type IN ('" . implode("','", get_post_types(['public' => true])) . "')");

    if (!empty($results)) {
        foreach ($results as $post) {
            $post_id = $post->ID;
            $content = $post->post_content;

            // Step 2: Match all [vc_single_image] shortcodes even with preceding tags
            preg_match_all('/(?:<[^>]+>)?\[vc_single_image\s+.*?image=["“”](\d+)["“”]\s+.*?img_size=["“”](\w+)["“”][^\]]*\]/', $content, $matches, PREG_SET_ORDER);

            if (!empty($matches)) {
                foreach ($matches as $shortcode) {
                    $image_id = (int) $shortcode[1];
                    $img_size = $shortcode[2];

                    // Step 3: Get the image URL using WordPress function
                    $url = wp_get_attachment_image_url($image_id, $img_size);
                    if ($url) {
                        $img_tag = sprintf('<img src="%s" />', esc_url($url));

                        // Step 4: Replace the shortcode with the <img> tag
                        $content = str_replace($shortcode[0], $img_tag, $content);
                    }
                }

                // Step 5: Update the post content in the database
                $wpdb->update(
                    $wpdb->posts,
                    ['post_content' => $content],
                    ['ID' => $post_id],
                    ['%s'],
                    ['%d']
                );

                // Optional: Log progress (can be seen in debug.log)
                error_log("Processed post ID: {$post_id}");
            }
        }

        // Clear post caches to ensure changes are reflected
        foreach ($results as $post) {
            clean_post_cache($post->ID);
        }
    }

    // Step 6: Mark as completed
    update_option('vc_image_shortcode_processed_sql', true);

    echo "<script>console.log('Processing complete.');</script>";
}

// Hook the function to `init`
add_action('init', 'process_vc_single_image_shortcodes_once');
