<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: facebook iframe parameter cleaner
* @type: PHP
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-08 14:10:49
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
function clean_facebook_iframe_trailing_content_in_db_once() {
    global $wpdb;

    // Query all posts containing Facebook iframe tags with trailing content
    $posts = $wpdb->get_results("
        SELECT ID, post_content 
        FROM {$wpdb->posts} 
        WHERE post_content LIKE '%<iframe%' AND post_content LIKE '%facebook.com/plugins/video.php%'
    ");

    if (!empty($posts)) {
        foreach ($posts as $post) {
            // Use regex to clean the trailing content after the iframe tag
            $updated_content = preg_replace(
                '/(<iframe[^>]+src="[^"]+facebook\.com\/plugins\/video\.php[^"]*"[^>]*><\/iframe>)\/\?__xts__\[0\]=.+$/i',
                '$1',
                $post->post_content
            );

            // Update the post content if it has been modified
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

    // Mark the function as complete to prevent reruns
    update_option('clean_facebook_iframe_trailing_done', true);
}

// Run the function only once
if (!get_option('clean_facebook_iframe_trailing_done')) {
    clean_facebook_iframe_trailing_content_in_db_once();
}
