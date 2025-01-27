<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: shortcode finder
* @type: PHP
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-24 13:00:19
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
function sidebar_finder_shortcode() {
    global $post;

    // Default sidebar shortcode value
    $default_shortcode = '[showlayout id=26105136]';

    // Get and trim the value of the ACF field 'current-sidebar' using global post
    $custom_shortcode = get_field('current_sidebar', $post->ID);

    // Debugging output to console
    echo '<script>
            console.log("ACF Field Value for Post ID ' . esc_js($post->ID) . ': ' . esc_js($custom_shortcode) . '");

            document.addEventListener("DOMContentLoaded", function() {
                let sidebar = document.querySelector(".et_pb_column_1_3");
                let content = document.querySelector(".et_pb_column_2_3");
                let sidebarValue = "' . esc_js($custom_shortcode) . '".trim();

                if (!sidebarValue || sidebarValue === "null" || sidebarValue === "") {
                    console.log("Sidebar is empty, removing column...");
                    if (sidebar && content) {
                        sidebar.style.display = "none";
                        content.style.width = "100%";
                    }
                } else {
                    console.log("Sidebar shortcode found, displaying sidebar...");
                }
            });
          </script>';

    // Check if the ACF field is empty or not
    if (!empty($custom_shortcode) && trim($custom_shortcode) !== '') {
        return do_shortcode($custom_shortcode);
    } else {
        return do_shortcode($default_shortcode);
    }
}
add_shortcode('sidebar_finder', 'sidebar_finder_shortcode');
