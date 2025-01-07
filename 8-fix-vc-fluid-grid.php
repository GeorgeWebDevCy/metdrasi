<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: fix vc fluid grid in content
* @type: css
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2024-12-09 16:21:04
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_head
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
.vc_row.wpb_row.vc_inner.vc_row-fluid {
    display: inline-grid !important;
    padding: 10px !important;
}