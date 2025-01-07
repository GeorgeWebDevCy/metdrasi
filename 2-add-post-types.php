<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: Add Post Types
* @type: PHP
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2024-11-30 16:16:36
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
/* ----------------------------------------------------- */
/* Custom Post Types 							         */
/* ----------------------------------------------------- */

if ( ! function_exists( 'sd_register_post_types' ) ) {
	function sd_register_post_types() {
		
		global $sd_data;
		
		// Staff Post Type
	
		$staff_labels = array(
			'name'               => __( 'Staff', 'sd-framework' ),
			'singular_name'      => __( 'Staff', 'sd-framework' ),
			'add_new'            => __( 'Add New Staff Member', 'sd-framework' ),
			'add_new_item'       => __( 'Add New Staff Member', 'sd-framework' ),
			'edit_item'          => __( 'Edit Staff Member', 'sd-framework' ),
			'new_item'           => __( 'Add New Staff Member', 'sd-framework' ),
			'view_item'          => __( 'View Staff Member', 'sd-framework' ),
			'search_items'       => __( 'Search Staff Member', 'sd-framework' ),
			'not_found'          => __( 'No staff members found', 'sd-framework' ),
			'not_found_in_trash' => __( 'No staff members found in trash', 'sd-framework' ),
		);

		$custom_staff_slug = ( !empty( $sd_data[ 'sd_staff_slug'] ) ? $sd_data['sd_staff_slug'] : 'staff-page' );

		$staff_args = array(
			'public'              => true,
			'publicly_queryable'  => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'exclude_from_search' => false,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-businessman',
			'can_export'          => true,
			'delete_with_user'    => false,
			'labels'              => $staff_labels,
			'public'              => true,
			'show_ui'             => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'rewrite'             => array( 'slug' => $custom_staff_slug, 'with_front' => false ), // Permalinks format
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		);

		register_post_type( 'staff' , $staff_args );

		
		// Events Post Type
		
		$sd_events_slug = ( !empty( $sd_data[ 'sd_events_slug'] ) ? $sd_data['sd_events_slug'] : 'events-page' );

		$events_labels = array(
			'name'               => __( 'Events', 'sd-framework' ),
			'singular_name'      => __( 'Events', 'sd-framework' ),
			'add_new'            => __( 'Add Event', 'sd-framework' ),
			'add_new_item'       => __( 'Add New Event', 'sd-framework' ),
			'edit_item'          => __( 'Edit Event', 'sd-framework' ),
			'new_item'           => __( 'Add New Event', 'sd-framework' ),
			'view_item'          => __( 'View Event', 'sd-framework' ),
			'search_items'       => __( 'Search Events', 'sd-framework' ),
			'not_found'          => __( 'No events found', 'sd-framework' ),
			'not_found_in_trash' => __( 'No events found in trash', 'sd-framework' ),
		);

		$events_args = array(
			'public'              => true,
			'publicly_queryable'  => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'exclude_from_search' => false,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-calendar',
			'can_export'          => true,
			'delete_with_user'    => false,
			'labels'              => $events_labels,
			'public'              => true,
			'show_ui'             => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'rewrite'             => array( 'slug' => $sd_events_slug, 'with_front' => false ), // Permalinks format
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		);

		register_post_type( 'events' , $events_args );

		// Sermons Post Type
		
		$church_enabled = ( ! empty( $sd_data['sd_enable_church'] ) ? $sd_data['sd_enable_church'] : '' );
		
		if ( $church_enabled == '1' ) {
			
			$sd_sermons_slug = ( ! empty( $sd_data[ 'sd_sermons_slug'] ) ? $sd_data['sd_sermons_slug'] : 'sermons-page' );
	
			$sermons_labels = array(
				'name'               => __( 'Sermons', 'sd-framework' ),
				'singular_name'      => __( 'Sermons', 'sd-framework' ),
				'add_new'            => __( 'Add Sermon', 'sd-framework' ),
				'add_new_item'       => __( 'Add New Sermon', 'sd-framework' ),
				'edit_item'          => __( 'Edit Sermon', 'sd-framework' ),
				'new_item'           => __( 'Add New Sermon', 'sd-framework' ),
				'view_item'          => __( 'View Sermon', 'sd-framework' ),
				'search_items'       => __( 'Search Sermons', 'sd-framework' ),
				'not_found'          => __( 'No sermons found', 'sd-framework' ),
				'not_found_in_trash' => __( 'No sermons found in trash', 'sd-framework' ),
			);
	
			$sermons_args = array(
				'public'              => true,
				'publicly_queryable'  => true,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => true,
				'exclude_from_search' => false,
				'show_in_menu'        => true,
				'menu_icon'           => 'dashicons-book-alt',
				'can_export'          => true,
				'delete_with_user'    => false,
				'labels'              => $sermons_labels,
				'public'              => true,
				'show_ui'             => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'rewrite'             => array( 'slug' => $sd_sermons_slug, 'with_front' => false ), // Permalinks format
				'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' )
			);
	
			register_post_type( 'sermons' , $sermons_args );
		
		}
		
	}
	// Add Custom Post Types
	add_action('init', 'sd_register_post_types');
}
