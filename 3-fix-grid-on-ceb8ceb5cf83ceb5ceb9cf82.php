<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: Fix grid on Θεσεις Εργασιας
* @type: css
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2024-11-30 18:00:37
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_head
* @load_as_file: 
* @condition: {"status":"yes","run_if":"assertive","items":[[{"source":["page","page_ids"],"operator":"in","value":["751"]}]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>

/*** Responsive Styles Large Desktop And Above ***/
@media all and (min-width: 1405px) {
figure.dp-dfg-image.entry-thumb {
    height: 333px !important;
}  
}
 
/*** Responsive Styles Standard Desktop Only ***/
@media all and (min-width: 1100px) and (max-width: 1405px) {
 figure.dp-dfg-image.entry-thumb {
    height: 333px !important;
}
}
 