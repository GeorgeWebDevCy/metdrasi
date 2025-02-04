<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: button replacer
* @type: PHP
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-02-04 20:45:51
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
function batch_replace_vc_with_divi() {
    if (get_option('_vc_to_divi_conversion_done')) {
        return; // Stop running if conversion is already completed
    }

    global $wpdb;
    $batch_size = 20; // Process 20 posts at a time

    // Get all public post types dynamically
    $public_post_types = get_post_types(['public' => true], 'names');
    $post_types_placeholders = implode(',', array_fill(0, count($public_post_types), '%s'));

    // Fetch posts from public post types that contain [vc_btn] and haven't been processed
    $query = $wpdb->prepare(
        "SELECT ID, post_content FROM {$wpdb->posts} 
        WHERE post_type IN ($post_types_placeholders) 
        AND post_content LIKE %s 
        AND NOT EXISTS (
            SELECT 1 FROM {$wpdb->postmeta} 
            WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id 
            AND {$wpdb->postmeta}.meta_key = '_vc_to_divi_done'
        ) 
        LIMIT %d",
        array_merge($public_post_types, ['%[vc_btn%', $batch_size])
    );

    $posts = $wpdb->get_results($query);

    if (empty($posts)) {
        update_option('_vc_to_divi_conversion_done', true); // Mark conversion as complete
        return;
    }

    foreach ($posts as $post) {
        $old_content = $post->post_content;
        $new_content = $old_content;

        // Convert [vc_btn] to [et_pb_button]
        $new_content = preg_replace_callback('/\[vc_btn\s(.*?)\]/', function ($matches) {
            $attributes = shortcode_parse_atts($matches[1]);

            // Extract necessary attributes
            $button_text = isset($attributes['title']) ? esc_attr($attributes['title']) : 'Download';

            // Extract and clean the URL
            $raw_url = isset($attributes['link']) ? preg_replace('/^url:(.*?)(\|\|.*)?$/', '$1', $attributes['link']) : '#';
            $decoded_url = rawurldecode($raw_url);

            // Ensure it's a valid URL (supports relative URLs too)
            if (!filter_var($decoded_url, FILTER_VALIDATE_URL) && strpos($decoded_url, '/') !== 0) {
                $button_url = '#'; // Invalid URL fallback
            } else {
                $button_url = esc_url($decoded_url);
            }

            $button_color = isset($attributes['color']) ? esc_attr($attributes['color']) : 'default';
            $button_icon = isset($attributes['i_icon_fontawesome']) ? esc_attr($attributes['i_icon_fontawesome']) : '';

            // Map VC colors to Divi button colors
            $color_map = [
                'green' => '#4CAF50',
                'danger' => '#F44336',
                'blue' => '#2196F3',
                'warning' => '#FFC107',
                'default' => '#007bff'
            ];
            $button_bg_color = isset($color_map[$button_color]) ? $color_map[$button_color] : '#007bff';

            return '[et_pb_button button_text="' . $button_text . '" button_url="' . esc_url($button_url) . '" button_alignment="center" button_bg_color="' . $button_bg_color . '" button_text_color="#FFFFFF" custom_button="on" icon="%%198%%"]';
        }, $new_content);

        // Update the post only if changes were made
        if ($old_content !== $new_content) {
            $wpdb->update(
                $wpdb->posts,
                ['post_content' => $new_content],
                ['ID' => $post->ID],
                ['%s'],
                ['%d']
            );

            // Mark post as processed
            update_post_meta($post->ID, '_vc_to_divi_done', true);
        }
    }
}

// Hook to run on every page load (stops when all are processed)
add_action('init', 'batch_replace_vc_with_divi');
