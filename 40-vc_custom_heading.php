<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: [vc_custom_heading]
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-15 15:40:00
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
function replace_vc_custom_heading_shortcode($content) {
    // Regex pattern to match [vc_custom_heading] shortcodes
    preg_match_all('/\[vc_custom_heading([^\]]*)\]/', $content, $matches, PREG_SET_ORDER);

    if (!empty($matches)) {
        foreach ($matches as $match) {
            $shortcode = $match[0]; // The full shortcode
            $attributes_string = $match[1]; // The attributes string

            // Parse attributes into an associative array
            preg_match_all('/(\w+)="([^"]*)"/', $attributes_string, $attr_matches, PREG_SET_ORDER);
            $attributes = [];
            foreach ($attr_matches as $attr) {
                $attributes[$attr[1]] = $attr[2];
            }

            // Extract specific attributes (with fallbacks)
            $text = isset($attributes['text']) ? $attributes['text'] : '';
            $tag = 'h2'; // Default tag
            $text_align = '';
            $color = '';
            $animation_class = isset($attributes['css_animation']) ? $attributes['css_animation'] : '';

            if (isset($attributes['font_container'])) {
                // Parse the font_container string
                $font_container_parts = explode('|', $attributes['font_container']);
                foreach ($font_container_parts as $part) {
                    list($key, $value) = explode(':', $part) + [null, null];
                    if ($key === 'tag') {
                        $tag = $value;
                    } elseif ($key === 'text_align') {
                        $text_align = 'text-align:' . $value . ';';
                    } elseif ($key === 'color') {
                        $color = 'color:' . $value . ';';
                    }
                }
            }

            // Generate the replacement HTML
            $style = $text_align . $color;
            $replacement = sprintf(
                '<%1$s style="%2$s" class="%3$s">%4$s</%1$s>',
                esc_html($tag),         // Tag (e.g., h2)
                esc_attr($style),       // Inline styles
                esc_attr($animation_class), // Animation class
                esc_html($text)         // Text content
            );

            // Replace the shortcode with the generated HTML
            $content = str_replace($shortcode, $replacement, $content);
        }
    }

    return $content;
}

// Hook into content processing
add_filter('the_content', 'replace_vc_custom_heading_shortcode');
