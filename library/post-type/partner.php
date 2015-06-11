<?php


// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'flush_rewrite_rules' );



// let's create the function for the custom type
function leverage_partner_post_type() { 


	// creating (registering) the custom type 
	register_post_type( 'partner', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 
			'labels' => array(
				'name' => __( 'Partner', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Partner', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All Partners', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Partner', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Partner', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Partner', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View Partner', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search Partners', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'Nothing found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Manage the partners listed on the site.', 'ptheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/img/icon-admin-partner.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 
				'slug' => 'partner', 
				'with_front' => false 
			), /* you can specify its url slug */
			'has_archive' => false, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor' )
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'partner' );
	

}

// adding the function to the Wordpress init
add_action( 'init', 'leverage_partner_post_type');



function the_partner_logos() {

	// args
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'partner',
		'orderby' => 'meta_value_num',
		'meta_key' => '_p_partner_sort'
	);

	// get results
	$the_query = new WP_Query( $args );

	// loop through the partners
	if ( $the_query->have_posts() ) { 
		while ( $the_query->have_posts() ) : $the_query->the_post();
			// make sure there are logo and website set before displaying.
			if ( has_cmb_value( 'partner_website' ) && has_cmb_value( 'partner_logo' ) ) {
				?><a href="<?php show_cmb_value( 'partner_website' ); ?>" target="_blank"><img src="<?php show_cmb_value( 'partner_logo' ) ?>"></a><?php 
			}
		endwhile;
	}

	// Restore global post data stomped by the_post().
	wp_reset_query();

}


?>