<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: remove font-family froms spans
* @type: PHP
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-14 15:51:21
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
function remove_font_family_from_spans($content) {
    // Use a regex to find <span> tags with a style attribute
    $pattern = '/<span\s+style="([^"]*font-family:[^;"]*;?[^"]*)">/';
    
    // Replace the matches with a cleaned version of the style attribute
    $content = preg_replace_callback($pattern, function ($matches) {
        // Extract the style attribute
        $style = $matches[1];
        
        // Remove the font-family property from the style
        $cleaned_style = preg_replace('/font-family:[^;"]*;?/', '', $style);
        
        // Return the updated <span> tag
        return str_replace($style, $cleaned_style, $matches[0]);
    }, $content);
    
    return $content;
}

// Hook into WordPress content filtering
add_filter('the_content', 'remove_font_family_from_spans');
