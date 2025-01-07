<?php
if (!defined("ABSPATH")) {return;}
/*
 * This is an auto-generated file by Fluent Snippets plugin.
 * Please do not edit manually.
 */
return array (
  'published' => 
  array (
    '17-vc_row-cleaner.php' => 
    array (
      'name' => 'vc_row cleaner',
      'description' => '',
      'type' => 'PHP',
      'status' => 'published',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2025-01-07 21:00:53',
      'run_at' => 'all',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '17-vc_row-cleaner.php',
    ),
    '2-add-post-types.php' => 
    array (
      'name' => 'Add Post Types',
      'description' => '',
      'type' => 'PHP',
      'status' => 'published',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-11-30 16:16:36',
      'run_at' => 'all',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '2-add-post-types.php',
    ),
    '3-add-taxonomies.php' => 
    array (
      'name' => 'Add Taxonomies',
      'description' => '',
      'type' => 'PHP',
      'status' => 'published',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-11-30 16:17:58',
      'run_at' => 'all',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '3-add-taxonomies.php',
    ),
    '3-fix-grid-on-ceb8ceb5cf83ceb5ceb9cf82.php' => 
    array (
      'name' => 'Fix grid on Θεσεις Εργασιας',
      'description' => '',
      'type' => 'css',
      'status' => 'published',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-11-30 18:00:37',
      'run_at' => 'wp_head',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'yes',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
            0 => 
            array (
              'source' => 
              array (
                0 => 'page',
                1 => 'page_ids',
              ),
              'operator' => 'in',
              'value' => 
              array (
                0 => '751',
              ),
            ),
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '3-fix-grid-on-ceb8ceb5cf83ceb5ceb9cf82.php',
    ),
    '4-fix-number-counter-on.php' => 
    array (
      'name' => 'Fix number counter on homepage',
      'description' => '',
      'type' => 'css',
      'status' => 'published',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-12-09 10:49:40',
      'run_at' => 'wp_head',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'yes',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
            0 => 
            array (
              'source' => 
              array (
                0 => 'page',
                1 => 'page_type',
              ),
              'operator' => 'in',
              'value' => 
              array (
                0 => 'is_front_page',
              ),
            ),
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '4-fix-number-counter-on.php',
    ),
    '5-hide-menu-caret-on.php' => 
    array (
      'name' => 'hide menu caret on child and language fixes',
      'description' => '',
      'type' => 'css',
      'status' => 'published',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-12-09 09:37:51',
      'run_at' => 'wp_head',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '5-hide-menu-caret-on.php',
    ),
    '6-menu-line-height-fix.php' => 
    array (
      'name' => 'menu line height fix',
      'description' => '',
      'type' => 'css',
      'status' => 'published',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-12-09 09:49:13',
      'run_at' => 'wp_head',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '6-menu-line-height-fix.php',
    ),
    '7-read-more-postion-fix.php' => 
    array (
      'name' => 'Read More postion fix',
      'description' => '',
      'type' => 'css',
      'status' => 'published',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-12-09 10:07:38',
      'run_at' => 'wp_head',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '7-read-more-postion-fix.php',
    ),
    '8-fix-vc-fluid-grid.php' => 
    array (
      'name' => 'fix vc fluid grid in content',
      'description' => '',
      'type' => 'css',
      'status' => 'published',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-12-09 16:21:04',
      'run_at' => 'wp_head',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '8-fix-vc-fluid-grid.php',
    ),
    '9-gallery-grid-fix-2x2.php' => 
    array (
      'name' => 'gallery grid fix 2x2',
      'description' => '',
      'type' => 'css',
      'status' => 'published',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-12-10 09:23:03',
      'run_at' => 'wp_head',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '9-gallery-grid-fix-2x2.php',
    ),
  ),
  'draft' => 
  array (
    '11-vc-single-image-fix.php' => 
    array (
      'name' => 'VC single image fix',
      'description' => '',
      'type' => 'PHP',
      'status' => 'draft',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2025-01-07 20:55:12',
      'run_at' => 'all',
      'priority' => 10,
      'group' => 'VC filters for content fixes',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '11-vc-single-image-fix.php',
    ),
    '12-vc-carousel-to-divi.php' => 
    array (
      'name' => 'VC carousel to Divi slider',
      'description' => '',
      'type' => 'PHP',
      'status' => 'draft',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-12-19 08:25:09',
      'run_at' => 'all',
      'priority' => 10,
      'group' => 'VC filters for content fixes',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '12-vc-carousel-to-divi.php',
    ),
    '13-replace-contact-form-7.php' => 
    array (
      'name' => 'Replace Contact Form 7 shortcodes with Fluent Forms shortcodes ONCE',
      'description' => '',
      'type' => 'PHP',
      'status' => 'draft',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-12-17 14:29:05',
      'run_at' => 'all',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '13-replace-contact-form-7.php',
    ),
    '14-vc-carousel-to-slcik.php' => 
    array (
      'name' => 'vc carousel to slcik slider',
      'description' => '',
      'type' => 'PHP',
      'status' => 'draft',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2025-01-06 10:27:07',
      'run_at' => 'all',
      'priority' => 10,
      'group' => 'VC filters for content fixes',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '14-vc-carousel-to-slcik.php',
    ),
    '15-slick-shortcode.php' => 
    array (
      'name' => 'slick shortcode',
      'description' => '',
      'type' => 'PHP',
      'status' => 'draft',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2025-01-06 10:27:39',
      'run_at' => 'all',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '15-slick-shortcode.php',
    ),
    '16-delete-all-posts-once.php' => 
    array (
      'name' => 'delete all posts once',
      'description' => '',
      'type' => 'PHP',
      'status' => 'draft',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2025-01-06 19:09:02',
      'run_at' => 'all',
      'priority' => 10,
      'group' => '',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '16-delete-all-posts-once.php',
    ),
    '10-fix-video-module-from.php' => 
    array (
      'name' => 'Fix video module from VC',
      'description' => '',
      'type' => 'PHP',
      'status' => 'draft',
      'tags' => '',
      'created_at' => '',
      'updated_at' => '2024-12-19 08:25:25',
      'run_at' => 'all',
      'priority' => 99,
      'group' => 'VC filters for content fixes',
      'condition' => 
      array (
        'status' => 'no',
        'run_if' => 'assertive',
        'items' => 
        array (
          0 => 
          array (
          ),
        ),
      ),
      'load_as_file' => '',
      'file_name' => '10-fix-video-module-from.php',
    ),
  ),
  'hooks' => 
  array (
    'all' => 
    array (
      0 => '17-vc_row-cleaner.php',
      1 => '2-add-post-types.php',
      2 => '3-add-taxonomies.php',
    ),
    'wp_head' => 
    array (
      0 => '3-fix-grid-on-ceb8ceb5cf83ceb5ceb9cf82.php',
      1 => '4-fix-number-counter-on.php',
      2 => '5-hide-menu-caret-on.php',
      3 => '6-menu-line-height-fix.php',
      4 => '7-read-more-postion-fix.php',
      5 => '8-fix-vc-fluid-grid.php',
      6 => '9-gallery-grid-fix-2x2.php',
    ),
  ),
  'meta' => 
  array (
    'secret_key' => 'a729df364cbf81d98dbecf6f8e61593c',
    'force_disabled' => 'no',
    'cached_at' => '2025-01-07 21:00:53',
    'cached_version' => '10.34',
    'cashed_domain' => 'https://metadrasi.georgenicolaou.me',
    'legacy_status' => 'new',
    'auto_disable' => 'yes',
    'auto_publish' => 'no',
    'remove_on_uninstall' => 'no',
  ),
  'error_files' => 
  array (
  ),
);