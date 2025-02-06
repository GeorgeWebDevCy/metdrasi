<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: fix audio element grid
* @type: css
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-02-05 11:01:42
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_head
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
/* Apply grid layout to the parent container of audio modules */
.et_pb_audio_module:nth-child(1) {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px; /* Space between items */
}

/* Ensure all audio modules fit properly */
.et_pb_audio_module {
    background: #f8f8f8; /* Optional: Add background */
    padding: 15px;
    border-radius: 5px; /* Optional: Rounded corners */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional: Add shadow */
    width: 100%;
}

/* Responsive Adjustments */
@media (max-width: 1024px) {
    .et_pb_audio_module:nth-child(1) {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .et_pb_audio_module:nth-child(1) {
        grid-template-columns: repeat(1, 1fr);
    }
}
