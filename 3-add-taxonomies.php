<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: Add Taxonomies
* @type: PHP
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2024-11-30 16:17:58
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
/* Taxonomies 									 */
/* ----------------------------------------------------- */

if ( ! function_exists( 'sd_taxonomies' ) ) {
	function sd_taxonomies() {
		
		global $sd_data;
		
		// staff categories
		
		$sd_staff_slug = ( ! empty( $sd_data['sd_staff_slug'] ) ? $sd_data['sd_staff_slug'] : 'staff-category' );
		
		$staff_labels = array(
			'name'              => __( 'Staff Categories', 'sd-framework' ),
			'singular_name'     => __( 'Staff Category', 'sd-framework' ),
			'search_items'      => __( 'Search Staff Categories', 'sd-framework' ),
			'all_items'         => __( 'All Staff Categories', 'sd-framework' ),
			'edit_item'         => __( 'Edit Staff Category', 'sd-framework' ),
			'update_item'       => __( 'Update Staff  Category', 'sd-framework' ),
			'add_new_item'      => __( 'Add New Staff Category', 'sd-framework' ),
			'new_item_name'     => __( 'New Portfolio Category', 'sd-framework' ),
			'menu_name'         => __( 'Staff Categories', 'sd-framework' )
		);
	
		$staff_args = array(
			'hierarchical'      => true,
			'labels'            => $staff_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $sd_staff_slug )
		);
		
		register_taxonomy( 'staff-category', array( 'staff' ), $staff_args );
		
		// event category
		
		$sd_events_cat_slug = ( ! empty( $sd_data['sd_events_cat_slug'] ) ? $sd_data['sd_events_cat_slug'] : 'event-category' );
		
		$event_labels_category = array(
			'name'              => __( 'Event Categories', 'sd-framework' ),
			'singular_name'     => __( 'Event Category', 'sd-framework' ),
			'search_items'      => __( 'Search Event Categories', 'sd-framework' ),
			'all_items'         => __( 'All Event Categories', 'sd-framework' ),
			'edit_item'         => __( 'Edit Event Category', 'sd-framework' ),
			'update_item'       => __( 'Update Event Category', 'sd-framework' ),
			'add_new_item'      => __( 'Add New Event Category', 'sd-framework' ),
			'new_item_name'     => __( 'New Event Category', 'sd-framework' ),
			'menu_name'         => __( 'Event Categories', 'sd-framework' )
		);
	
		$event_args_categories = array(
			'hierarchical'      => true,
			'labels'            => $event_labels_category,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $sd_events_cat_slug )
		);
		
		register_taxonomy( 'event_category', array( 'events' ), $event_args_categories );
		
		// sermons taxonomies
		
		$church_enabled = ( ! empty( $sd_data['sd_enable_church'] ) ? $sd_data['sd_enable_church'] : '' );
		
		if ( $church_enabled == '1' ) {
		
			// sermon topics
			
			$sd_topics_slug = ( !empty( $sd_data['sd_topics_slug'] ) ? $sd_data['sd_topics_slug'] : 'sermon-topics' );
			
			$labels_topics = array(
				'name'              => __( 'Topics', 'sd-framework' ),
				'singular_name'     => __( 'Topic', 'sd-framework' ),
				'search_items'      => __( 'Search Topics ', 'sd-framework' ),
				'all_items'         => __( 'All Topics', 'sd-framework' ),
				'edit_item'         => __( 'Edit Topic', 'sd-framework' ),
				'update_item'       => __( 'Update Topic', 'sd-framework' ),
				'add_new_item'      => __( 'Add New Topic', 'sd-framework' ),
				'new_item_name'     => __( 'New Topic', 'sd-framework' ),
				'menu_name'         => __( 'Topics', 'sd-framework' )
			);
		
			$args_topics = array(
				'hierarchical'      => true,
				'labels'            => $labels_topics,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $sd_topics_slug )
			);
			
			register_taxonomy( 'sermon_topics', array( 'sermons' ), $args_topics );
			
			// sermon books
			
			$sd_books_slug = ( !empty( $sd_data['sd_books_slug'] ) ? $sd_data['sd_books_slug'] : 'sermon-books' );
			
			$labels_books = array(
				'name'              => __( 'Books', 'sd-framework' ),
				'singular_name'     => __( 'Book', 'sd-framework' ),
				'search_items'      => __( 'Search Books ', 'sd-framework' ),
				'all_items'         => __( 'All Books', 'sd-framework' ),
				'edit_item'         => __( 'Edit Book', 'sd-framework' ),
				'update_item'       => __( 'Update Book', 'sd-framework' ),
				'add_new_item'      => __( 'Add New Book', 'sd-framework' ),
				'new_item_name'     => __( 'New Book', 'sd-framework' ),
				'menu_name'         => __( 'Books', 'sd-framework' )
			);
		
			$args_books = array(
				'hierarchical'      => true,
				'labels'            => $labels_books,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $sd_books_slug )
			);
			
			register_taxonomy( 'sermon_books', array( 'sermons' ), $args_books );
			
			// sermon series
			
			$sd_series_slug = ( !empty( $sd_data['sd_series_slug'] ) ? $sd_data['sd_series_slug'] : 'sermon-series' );
			
			$labels_series = array(
				'name'              => __( 'Series', 'sd-framework' ),
				'singular_name'     => __( 'Series', 'sd-framework' ),
				'search_items'      => __( 'Search Series ', 'sd-framework' ),
				'all_items'         => __( 'All Series', 'sd-framework' ),
				'edit_item'         => __( 'Edit Series', 'sd-framework' ),
				'update_item'       => __( 'Update Series', 'sd-framework' ),
				'add_new_item'      => __( 'Add New Series', 'sd-framework' ),
				'new_item_name'     => __( 'New Series', 'sd-framework' ),
				'menu_name'         => __( 'Series', 'sd-framework' )
			);
		
			$args_series = array(
				'hierarchical'      => true,
				'labels'            => $labels_series,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $sd_series_slug )
			);
			
			register_taxonomy( 'sermon_series', array( 'sermons' ), $args_series );
			
			// sermon speakers
			
			$sd_speakers_slug = ( !empty( $sd_data['sd_speakers_slug'] ) ? $sd_data['sd_speakers_slug'] : 'sermon-speakers' );
			
			$labels_speakers = array(
				'name'              => __( 'Speakers', 'sd-framework' ),
				'singular_name'     => __( 'Speaker', 'sd-framework' ),
				'search_items'      => __( 'Search Speakers ', 'sd-framework' ),
				'all_items'         => __( 'All Speakers', 'sd-framework' ),
				'edit_item'         => __( 'Edit Speaker', 'sd-framework' ),
				'update_item'       => __( 'Update Speaker', 'sd-framework' ),
				'add_new_item'      => __( 'Add New Speaker', 'sd-framework' ),
				'new_item_name'     => __( 'New Speaker', 'sd-framework' ),
				'menu_name'         => __( 'Speakers', 'sd-framework' )
			);
		
			$args_speakers = array(
				'hierarchical'      => true,
				'labels'            => $labels_speakers,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $sd_speakers_slug )
			);
			
			register_taxonomy( 'sermon_speakers', array( 'sermons' ), $args_speakers );
		}
	}
	add_action( 'init', 'sd_taxonomies' );
}