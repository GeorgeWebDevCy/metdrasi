<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: remove closing gmap
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-15 15:43:46
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
function remove_closing_ultimate_google_map_shortcode() {
    global $wpdb;

    // Get all posts with [/ultimate_google_map] in the content
    $posts = $wpdb->get_results("
        SELECT ID, post_content 
        FROM {$wpdb->posts} 
        WHERE post_content LIKE '%[/ultimate_google_map]%'
    ");

    if (!empty($posts)) {
        foreach ($posts as $post) {
            // Remove [/ultimate_google_map] from the content
            $updated_content = str_replace('[/ultimate_google_map]', '', $post->post_content);

            // Update the post content if it has been changed
            if ($updated_content !== $post->post_content) {
                $wpdb->update(
                    $wpdb->posts,
                    ['post_content' => $updated_content],
                    ['ID' => $post->ID],
                    ['%s'],
                    ['%d']
                );
            }
        }
    }

    // Mark the function as complete so it doesn't run again
    update_option('remove_closing_ultimate_google_map_done', true);
}

// Run the function only once
if (!get_option('remove_closing_ultimate_google_map_done')) {
    remove_closing_ultimate_google_map_shortcode();
}
