<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: flex post images
* @type: css
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-16 11:09:53
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_head
* @load_as_file: 
* @condition: {"status":"yes","run_if":"assertive","items":[[{"source":["page","post_type"],"operator":"in","value":["post"]}]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
.et_pb_module.et_pb_post_content.et_pb_post_content_0_tb_body img{
    max-width: 100%;
    height: auto;
    display: flex !important;
    padding-top: 10px !important;
    padding-bottom: 10px !important;

}