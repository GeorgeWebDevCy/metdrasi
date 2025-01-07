<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: VC filters for content fixes
* @name: Fix video module from VC
* @type: PHP
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2024-12-19 08:25:25
* @is_valid: 
* @updated_by: 
* @priority: 99
* @run_at: all
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
<?php
function replace_vc_video_with_embed_in_db_once() {
    global $wpdb;

    // Get all posts with [vc_video link=""] in the content
    $posts = $wpdb->get_results("
        SELECT ID, post_content 
        FROM {$wpdb->posts} 
        WHERE post_content LIKE '%[vc_video link=%'
    ");

    if (!empty($posts)) {
        foreach ($posts as $post) {
            // Replace [vc_video link="URL"] with [embed]URL[/embed] using regex
            $updated_content = preg_replace(
                '/\[vc_video link="([^"]+)"\]/',
                '[embed]$1[/embed]',
                $post->post_content
            );

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
    update_option('replace_vc_video_with_embed_done', true);
}

// Run the function only once
if (!get_option('replace_vc_video_with_embed_done')) {
    replace_vc_video_with_embed_in_db_once();
}