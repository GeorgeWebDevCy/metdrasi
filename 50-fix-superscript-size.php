<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: fix superscript size
* @type: css
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-16 13:19:14
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_head
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
sup {
    vertical-align: top !important;
    position: relative !important;
    top: -0.2em !important;
    font-size: small !important;
}