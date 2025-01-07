<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: Fix number counter on homepage
* @type: css
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2024-12-09 10:49:40
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_head
* @load_as_file: 
* @condition: {"status":"yes","run_if":"assertive","items":[[{"source":["page","page_type"],"operator":"in","value":["is_front_page"]}]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
span.percent-value {
        font-size: calc(1.5rem + 1vw) !important;
}

.et_pb_number_counter.et_pb_with_title .percent {
    margin-bottom: 10px !important;
}
.et_pb_number_counter .percent {
    height: 45px !important;
    position: relative;
}