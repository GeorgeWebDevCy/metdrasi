<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: update single image width
* @type: PHP
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-02-05 11:02:40
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
function update_image_width_in_posts_batch() {
    global $wpdb;

    $batch_size = 50; // Adjust batch size as needed
    $last_processed_id = get_option('image_width_update_last_id', 0);

    // Fetch next batch of posts
    $posts = $wpdb->get_results($wpdb->prepare("
        SELECT ID, post_content FROM {$wpdb->posts} 
        WHERE post_type NOT IN ('revision', 'attachment') 
        AND post_content LIKE '%<figure class=\"wp-block-image%' 
        AND ID > %d
        ORDER BY ID ASC
        LIMIT %d", $last_processed_id, $batch_size));

    if (empty($posts)) {
        // No more posts to process, mark as complete
        update_option('image_width_update_done', true);
        return;
    }

    foreach ($posts as $post) {
        $updated_content = preg_replace('/(<figure class="wp-block-image[^>]*>.*?<img [^>]*?)style="width:\s*\d+px;?([^>]*>)/is', '$1style="width:100%;$2', $post->post_content);

        // Only update if changes were made
        if ($updated_content !== $post->post_content) {
            $wpdb->update(
                $wpdb->posts,
                ['post_content' => $updated_content],
                ['ID' => $post->ID],
                ['%s'],
                ['%d']
            );
        }

        // Update last processed ID
        update_option('image_width_update_last_id', $post->ID);
    }
}

// Run on init hook (executed automatically)
add_action('init', 'update_image_width_in_posts_batch');
