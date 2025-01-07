<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: hide menu caret on child and language fixes
* @type: css
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2024-12-09 09:37:51
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_head
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
.et-menu .menu-item-has-children>a:first-child:after {
    font-family: ETmodules;
    content: "\35" !important;
    font-size: clamp(0.8rem, 0.5em + 0.3vw, 1rem);
    position: absolute;
    right: 0;
    top: auto !important;
    display:none !important;
}

.et_pb_module.et_pb_code.et_pb_code_0_tb_header {
    padding-top: 0 !important;
