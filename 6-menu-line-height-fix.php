<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: menu line height fix
* @type: css
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2024-12-09 09:49:13
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_head
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>

.et_pb_menu_0_tb_header.et_pb_menu ul li.current-menu-item a, .et_pb_menu_0_tb_header.et_pb_menu .nav li ul.sub-menu a {
    color: #3c434a !important;
    line-height: 1.2rem !important;
}