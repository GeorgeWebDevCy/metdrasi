<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: vc buttons to divi buttons
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-27 15:59:47
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
function gn_vc2divi_convert_buttons() {
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
            'offset'         => (int) get_option('gn_vc2divi_conversion_offset_' . $post_type, 0),
        ];

        // Execute WP_Query with args
        $query = new WP_Query($args);

        $console_log['total_posts'] += $query->found_posts;

        while ($query->have_posts()) {
            $query->the_post();

            // Get Post Content
            $post_id = get_the_ID();
            $content = get_post_field('post_content', $post_id);

            // Convert [vc_btn] shortcodes to Divi buttons
            $updated_content = gn_vc2divi_replace_buttons($content);

            // Only update the post if the content has changed
            if ($updated_content !== $content) {
                wp_update_post([
                    'ID'           => $post_id,
                    'post_content' => $updated_content,
                ]);
            }

            $console_log['processed_posts']++;
        }

        // Update offset for batch processing
        $processed_posts = $query->post_count;
        $current_offset = (int) get_option('gn_vc2divi_conversion_offset_' . $post_type, 0);
        $new_offset = $current_offset + $processed_posts;

        if ($new_offset >= $query->found_posts) {
            update_option('gn_vc2divi_conversion_done_' . $post_type, true);
            delete_option('gn_vc2divi_conversion_offset_' . $post_type);
        } else {
            update_option('gn_vc2divi_conversion_offset_' . $post_type, $new_offset);
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

// Function to replace [vc_btn] with Divi [et_pb_button]
function gn_vc2divi_replace_buttons($content) {
    $pattern = '/\[vc_btn\s+.*?title="(.*?)"\s+.*?color="(.*?)"\s+.*?link="url:(.*?)\|\|target:%20_blank\|".*?\]/';

    $content = preg_replace_callback($pattern, function ($matches) {
        $title = esc_html($matches[1]);
        $vc_color = esc_attr($matches[2]);
        $url = esc_url(urldecode($matches[3]));

        // Map VC colors to Divi colors (defaulting to green)
        $color_map = [
            'green' => '#4CAF50',
            'blue' => '#2196F3',
            'danger' => '#F44336',
            'warning' => '#FF9800',
            'purple' => '#9C27B0',
            'sky' => '#03A9F4',
            'peacoc' => '#009688',
            'turquoise' => '#40E0D0',
            'vista-blue' => '#1E88E5'
        ];
        $divi_color = isset($color_map[$vc_color]) ? $color_map[$vc_color] : '#4CAF50';

        return '[et_pb_button button_url="' . $url . '" button_text="' . $title . '" button_alignment="center" button_bg_color="' . $divi_color . '" custom_icon="on" button_icon="fa fa-download" button_icon_placement="right" button_target="_blank"]';
    }, $content);

    return $content;
}

// Run the function in batches when needed
add_action('init', function () {
    // Process in batches until all posts are done
    $done_for_all_post_types = true;

    $post_types = get_post_types(['public' => true], 'names');
    foreach ($post_types as $post_type) {
        if (!get_option('gn_vc2divi_conversion_done_' . $post_type)) {
            $done_for_all_post_types = false;
            gn_vc2divi_convert_buttons();
            break; // Process one post type at a time per request
        }
    }

    if ($done_for_all_post_types) {
        echo '<script>console.log("All post types processed successfully, [vc_btn] converted to Divi buttons.");</script>';
    }
});
