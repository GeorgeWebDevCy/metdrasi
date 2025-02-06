<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: button replacer
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-02-05 10:33:15
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
if (!function_exists('fully_decode_url')) {
    function fully_decode_url($url) {
        $decoded_url = rawurldecode($url);
        while (strpos($decoded_url, '%') !== false) {
            $decoded_url = rawurldecode($decoded_url);
        }
        return esc_url($decoded_url);
    }
}

function batch_replace_vc_with_divi() {
    if (get_option('_vc_to_divi_conversion_done')) {
        return;
    }

    global $wpdb;
    $batch_size = 5; // Process posts in batches
    $public_post_types = get_post_types(['public' => true], 'names');

    $placeholders = implode(',', array_fill(0, count($public_post_types), '%s'));
    $like_conditions = ['%[vc_btn%', '%<a class="vc_general vc_btn3%', '%issuu.com/embed%'];

    $query = $wpdb->prepare(
        "SELECT ID, post_content FROM {$wpdb->posts} 
        WHERE post_type IN ($placeholders) 
        AND (" . implode(' OR ', array_fill(0, count($like_conditions), "post_content LIKE %s")) . ")
        AND NOT EXISTS (
            SELECT 1 FROM {$wpdb->postmeta} 
            WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id 
            AND {$wpdb->postmeta}.meta_key = '_vc_to_divi_done'
        ) 
        LIMIT %d",
        array_merge($public_post_types, $like_conditions, [$batch_size])
    );

    $posts = $wpdb->get_results($query);

    if (empty($posts)) {
        update_option('_vc_to_divi_conversion_done', true);
        return;
    }

    foreach ($posts as $post) {
        $old_content = $post->post_content;
        $new_content = $old_content;

        echo "<script>console.log('Processing Post ID: {$post->ID}');</script>";

        // Handle VC buttons (MP3, ZIP, PDF)
        $new_content = preg_replace_callback('/\[vc_btn\s(.*?)\]/', function ($matches) {
            $attributes = shortcode_parse_atts($matches[1]);
            if (!$attributes) return $matches[0];

            $button_text = isset($attributes['title']) ? esc_attr($attributes['title']) : 'Download';
            $raw_url = isset($attributes['link']) ? preg_replace('/^url:(.*?)(\|\|.*)?$/', '$1', $attributes['link']) : '#';
            $button_url = fully_decode_url($raw_url);

            echo "<script>console.log('Converted VC Button: " . addslashes($button_text) . " => " . addslashes($button_url) . "');</script>";

            if (strpos($button_url, '.mp3') !== false) {
                return '[et_pb_audio title="' . $button_text . '" audio_url="' . esc_url($button_url) . '" play_pause="on" show_image="off"]';
            }

            return '[et_pb_button button_text="' . $button_text . '" button_url="' . esc_url($button_url) . '" button_alignment="center" button_bg_color="#007bff" button_text_color="#FFFFFF" custom_button="on" icon="%%198%%"]';
        }, $new_content);

        // Convert <a> buttons (MP3, ZIP, PDF)
        $new_content = preg_replace_callback('/<a\s[^>]*href="([^"]+)"[^>]*>\s*(?:<i[^>]*class="([^"]+)">)?\s*([^<]+)\s*<\/a>/i', function ($matches) {
            $button_url = fully_decode_url($matches[1]);
            $button_icon = !empty($matches[2]) ? esc_attr($matches[2]) : '%%198%%';
            $button_text = esc_attr(trim($matches[3]));

            echo "<script>console.log('Converted Link: " . addslashes($button_text) . " => " . addslashes($button_url) . "');</script>";

            if (strpos($button_url, '.mp3') !== false) {
                return '[et_pb_audio title="' . $button_text . '" audio_url="' . esc_url($button_url) . '" play_pause="on" show_image="off"]';
            }

            return '[et_pb_button button_text="' . $button_text . '" button_url="' . esc_url($button_url) . '" button_alignment="center" button_bg_color="#6A5ACD" button_text_color="#FFFFFF" custom_button="on" icon="' . $button_icon . '"]';
        }, $new_content);

        // Convert Issuu iframe embeds
        $new_content = preg_replace_callback('/\[vc_raw_html\](.*?)\[\/vc_raw_html\]/s', function ($matches) {
            if (empty($matches[1])) return $matches[0];

            $decoded_html = html_entity_decode(trim($matches[1]));
            while (strpos($decoded_html, '%') !== false) {
                $decoded_html = rawurldecode($decoded_html);
            }

            if (strpos($decoded_html, 'issuu.com') !== false) {
                echo "<script>console.log('Converted Issuu Embed');</script>";
                return '[et_pb_code]' . esc_html($decoded_html) . '[/et_pb_code]';
            }

            return $matches[0];
        }, $new_content);

        // Fix MP3 buttons that were not captured
        $new_content = preg_replace_callback('/\[vc_btn\s[^]]*title="([^"]+)"[^]]*link="url:([^"]+)\|\|target:[^"]+"[^]]*\]/', function ($matches) {
            $button_text = esc_attr(trim($matches[1]));
            $button_url = fully_decode_url($matches[2]);

            echo "<script>console.log('Fixed MP3: " . addslashes($button_text) . " => " . addslashes($button_url) . "');</script>";

            return '[et_pb_audio title="' . $button_text . '" audio_url="' . esc_url($button_url) . '" play_pause="on" show_image="off"]';
        }, $new_content);

        // Log before updating
        echo "<script>console.log('Old Content: " . addslashes(substr($old_content, 0, 500)) . "');</script>";
        echo "<script>console.log('New Content: " . addslashes(substr($new_content, 0, 500)) . "');</script>";

        if ($old_content !== $new_content) {
            $wpdb->update(
                $wpdb->posts,
                ['post_content' => $new_content],
                ['ID' => $post->ID],
                ['%s'],
                ['%d']
            );

            update_post_meta($post->ID, '_vc_to_divi_done', true);
        }
    }
}

add_action('init', 'batch_replace_vc_with_divi');
