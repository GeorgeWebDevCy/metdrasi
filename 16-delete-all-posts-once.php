<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: delete all posts once
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-06 19:09:02
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: all
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
<?php
function delete_all_category_posts_once() {
    // Check if the function has already been executed
    if (get_option('all_category_posts_deletion_done')) {
        return; // Exit if already executed
    }

    // Get all categories
    $categories = get_categories(array(
        'hide_empty' => false, // Include all categories, even those without posts
    ));

    foreach ($categories as $category) {
        $category_id = $category->term_id;

        // Get all posts in the current category
        $posts = get_posts(array(
            'category'    => $category_id,
            'numberposts' => -1, // Get all posts
            'post_type'   => 'post', // Target only posts
            'post_status' => 'any', // Include all statuses (published, drafts, etc.)
        ));

        // Loop through and delete each post
        foreach ($posts as $post) {
            wp_delete_post($post->ID, true); // 'true' forces deletion without moving to Trash
        }
    }

    // Mark as executed by adding an option
    update_option('all_category_posts_deletion_done', true);
}
add_action('admin_init', 'delete_all_category_posts_once');
