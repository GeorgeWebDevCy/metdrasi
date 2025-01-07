<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: gallery grid fix 2x2
* @type: css
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2024-12-10 09:23:03
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_head
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
/* Fixed 2-column layout for the gallery */
.et_pb_text_inner > figure.wp-block-gallery {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important; /* Fixed 2 columns */
    gap: 10px !important; /* Reduce the gap between images */
    margin: 0 auto !important; /* Center the gallery */
    padding: 0px 0px 30px 0px !important; /* Padding around the gallery */
}

/* Ensure each figure is styled correctly */
.et_pb_text_inner > figure.wp-block-gallery figure.wp-block-image {
    margin: 0 !important; /* Remove default margins */
    display: block !important; /* Consistent layout without flex */
    width: 100% !important; /* Ensure images fit their grid cells */
}

/* Style the images */
.et_pb_text_inner > figure.wp-block-gallery img {
    width: 100% !important; /* Ensure images take up full column width */
    height: auto !important; /* Maintain aspect ratio */
    display: block !important; /* Ensure block-level display */
    object-fit: cover !important; /* Cover for consistent image filling */
    border: none !important; /* Remove any default borders */
}

/* Optional: Adjust the gallery container for better scaling */
.et_pb_text_inner {
    max-width: 100% !important; /* Allow the container to use full width */
    margin: 0 auto !important; /* Center the content */
    padding: 0 !important; /* Remove unnecessary padding */
}

/* Responsive adjustment: Single column on smaller screens */
@media (max-width: 768px) {
    .et_pb_text_inner > figure.wp-block-gallery {
        grid-template-columns: 1fr !important; /* Single column on mobile */
    }
}
