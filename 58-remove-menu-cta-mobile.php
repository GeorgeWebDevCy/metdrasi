<?php
// <Internal Doc Start>
/*
*
* @description:
* @tags:
* @group:
* @name: remove menu-cta class on tablet and mobile
* @type: PHP
* @status: published
* @created_by:
* @created_at:
* @updated_at: 2025-02-06 12:00:00
* @is_valid:
* @updated_by:
* @priority: 10
* @run_at: wp_head
* @load_as_file:
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
<?php
function remove_menu_cta_class_script() {
    ?>
    <script type="text/javascript">
    (function($) {
        function toggleMenuCTA() {
            if ($(window).width() <= 980) {
                $('li.menu-cta').removeClass('menu-cta');
            } else {
                $('li.et_pb_menu_page_id-26107970').addClass('menu-cta');
            }
        }
        $(document).ready(toggleMenuCTA);
        $(window).on('resize', toggleMenuCTA);
    })(jQuery);
    </script>
    <?php
}
add_action('wp_footer', 'remove_menu_cta_class_script', 100);
?>
