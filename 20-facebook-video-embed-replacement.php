<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: facebook video embed replacement
* @type: PHP
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-08 14:02:26
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
function replace_facebook_video_urls_with_clean_iframe_in_db_once() {
    global $wpdb;

    // Query all posts containing Facebook video URLs in the content
    $posts = $wpdb->get_results("
        SELECT ID, post_content 
        FROM {$wpdb->posts} 
        WHERE post_content LIKE '%facebook.com/metadrasi/videos/%'
    ");

    if (!empty($posts)) {
        foreach ($posts as $post) {
            // Use regex to find Facebook video URLs and replace with cleaned iframe embed code
            $updated_content = preg_replace_callback(
                '/https:\/\/www\.facebook\.com\/[^\/]+\/videos\/[^\/?&]+/',
                function ($matches) {
                    // Extract and clean the Facebook video URL
                    $raw_url = $matches[0];
                    $clean_url = strtok($raw_url, '?'); // Remove query parameters

                    // Generate iframe embed code with cleaned URL
                    return sprintf(
                        '<iframe src="https://www.facebook.com/plugins/video.php?href=%s&show_text=0&width=560" width="560" height="315" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>',
                        urlencode($clean_url)
                    );
                },
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
    update_option('replace_facebook_video_urls_clean_done', true);
}

// Run the function only once
if (!get_option('replace_facebook_video_urls_clean_done')) {
    replace_facebook_video_urls_with_clean_iframe_in_db_once();
}
