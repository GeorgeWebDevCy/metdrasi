<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: ultimate google map shortcode fix
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-15 15:43:53
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
function replace_ultimate_google_map_with_embed_cleanly() {
    global $wpdb;

    // Get all posts with [ultimate_google_map] in the content
    $posts = $wpdb->get_results("
        SELECT ID, post_content 
        FROM {$wpdb->posts} 
        WHERE post_content LIKE '%[ultimate_google_map%'
    ");

    if (!empty($posts)) {
        foreach ($posts as $post) {
            // Use regex to clean up the entire [ultimate_google_map] shortcode
            $updated_content = preg_replace_callback(
                '/\[ultimate_google_map\s+([^]]+)\]/',
                function ($matches) {
                    // Parse the attributes to extract the necessary ones
                    $attributes = shortcode_parse_atts($matches[1]);

                    // Extract the required values (default if not present)
                    $lat = isset($attributes['lat']) ? $attributes['lat'] : '0';
                    $lng = isset($attributes['lng']) ? $attributes['lng'] : '0';
                    $zoom = isset($attributes['zoom']) ? $attributes['zoom'] : '15';

                    // Build the Google Maps embed iframe
                    return sprintf(
                        '<iframe width="100%%" height="280" frameborder="0" style="border:0" src="https://www.google.com/maps?q=%s,%s&z=%s&output=embed" allowfullscreen></iframe>',
                        esc_attr($lat),
                        esc_attr($lng),
                        esc_attr($zoom)
                    );
                },
                $post->post_content
            );

            // Update the post content if it has been changed
            if ($updated_content !== $post->post_content) {
                $wpdb->update(
                    $wpdb->posts,
                    ['post_content' => $updated_content],
                    ['ID' => $post->ID],
                    ['%s'],
                    ['%d']
                );
            }
        }
    }

    // Mark the function as complete so it doesn't run again
    update_option('replace_ultimate_google_map_with_embed_cleanly_done', true);
}

// Run the function only once
if (!get_option('replace_ultimate_google_map_with_embed_cleanly_done')) {
    replace_ultimate_google_map_with_embed_cleanly();
}
