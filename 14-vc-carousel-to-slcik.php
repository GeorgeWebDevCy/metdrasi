// Enqueue Slick Slider Scripts and Styles
function enqueue_slick_slider_assets() {
    // Enqueue Slick CSS
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

    // Enqueue Slick JS
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true);

    // Enqueue Custom JS for initializing the slider
    wp_enqueue_script('custom-slick-init', get_template_directory_uri() . '/js/custom-slick-init.js', array('slick-js', 'jquery'), '1.0', true);

    // Ensure jQuery is loaded
    if (!wp_script_is('jquery', 'enqueued')) {
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider_assets');

// Create the [slick_slider] shortcode
function custom_slick_slider_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'images' => '', // Comma-separated list of image IDs
        ),
        $atts,
        'slick_slider'
    );

    if (empty($atts['images'])) {
        return '<p>No images specified.</p>';
    }

    $image_ids = explode(',', $atts['images']);
    $output = '<div class="custom-slick-slider">';

    foreach ($image_ids as $image_id) {
        $image_url = wp_get_attachment_image_url($image_id, '752x450');
        if ($image_url) {
            $output .= '<div><img decoding="async" src="' . esc_url($image_url) . '" alt=""></div>';
        }
    }

    $output .= '</div>';
    return $output;
}
add_shortcode('slick_slider', 'custom_slick_slider_shortcode');

// Add the Slick slider initialization script dynamically
function add_inline_slick_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            console.log('Initializing Slick Slider...');
            if ($('.custom-slick-slider').length) {
                console.log('Slick Slider found, initializing...');
                $('.custom-slick-slider').slick({
                    autoplay: true,
                    autoplaySpeed: 3000,
                    arrows: true,
                    dots: true,
                    infinite: true,
                    speed: 500,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                });
            } else {
                console.log('Slick Slider not found on the page.');
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'add_inline_slick_script', 100);