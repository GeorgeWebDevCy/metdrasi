<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: VC filters for content fixes
* @name: VC carousel to Divi slider
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2024-12-19 08:25:09
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
// Replace [vc_images_carousel] shortcode with a custom slider
add_action('init', function () {
    add_filter('the_content', 'replace_vc_images_carousel', 10);
    add_action('wp_enqueue_scripts', 'enqueue_custom_slider_scripts');
});

function enqueue_custom_slider_scripts() {
    // Enqueue Slick slider library and custom script
    wp_enqueue_style('slick-slider-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-slider-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    wp_enqueue_script('slick-slider-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true);
    wp_enqueue_script('custom-slider-init', get_template_directory_uri() . '/js/custom-slider-init.js', array('slick-slider-js'), null, true);
}

function replace_vc_images_carousel($content) {
    // Match the [vc_images_carousel] shortcode
    $pattern = '/\\[vc_images_carousel.*?images="(.*?)".*?\\]/';
    return preg_replace_callback($pattern, 'generate_custom_slider', $content);
}

function generate_custom_slider($matches) {
    // Extract image IDs from the shortcode
    $image_ids = explode(',', $matches[1]);

    // Build Slick slider HTML
    $slider_html = '<div class="custom-slick-slider">';

    foreach ($image_ids as $image_id) {
        $image_url = wp_get_attachment_image_url($image_id, 'full');
        if ($image_url) {
            $slider_html .= '<div class="slider-item">';
            $slider_html .= '<img src="' . esc_url($image_url) . '" alt="">';
            $slider_html .= '</div>';
        }
    }

    $slider_html .= '</div>';

    return $slider_html;
}
