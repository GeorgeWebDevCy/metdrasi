<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: vc replace v2
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-15 15:40:26
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
function process_vc_single_image_shortcodes_optimized_v2() {
    $batch_size = 10; // Number of posts to process per batch
    $post_types = get_post_types(['public' => true]);

    $args = [
        'post_type'      => $post_types,
        'posts_per_page' => $batch_size,
        'post_status'    => 'publish',
        'meta_query'     => [
            ['key' => '_vc_image_shortcode_processed_v2222', 'compare' => 'NOT EXISTS'],
        ],
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $content = get_post_field('post_content', $post_id);

            preg_match_all('/\[vc_single_image\s+.*?image=["“”](\d+)["“”]\s+.*?img_size=["“”](\w+)["“”][^\]]*\]/', $content, $matches, PREG_SET_ORDER);

            if (!empty($matches)) {
                foreach ($matches as $shortcode) {
                    $image_id = (int) $shortcode[1];
                    $img_size = $shortcode[2];
                    $url = wp_get_attachment_image_url($image_id, $img_size);

                    if ($url) {
                        $img_tag = sprintf('<img src="%s" />', esc_url($url));
                        $content = str_replace($shortcode[0], $img_tag, $content);
                    } else {
                        error_log("Failed to retrieve URL for image ID {$image_id} with size {$img_size}");
                    }
                }

                wp_update_post([
                    'ID'           => $post_id,
                    'post_content' => $content,
                ]);

                update_post_meta($post_id, '_vc_image_shortcode_processed_v2222', true);
            }
        }

        wp_reset_postdata();
    }
}

// Hook the function to init
add_action('init', 'process_vc_single_image_shortcodes_optimized_v2');
