<?php

// find'n replace Categories & Category (as tax) and Attachment (as cpt). *Remember to preseve case
// remember to include in functions.php

add_post_type_support( 'attachment', 'page-attributes' );

function tax_img_cat() {
	$labels = array(
		'name'              => _x( 'Category', 'taxonomy general name', 'tn_' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'tn_' ),
		'search_items'      => __( 'Search Categories', 'tn_' ),
		'all_items'         => __( 'All Categories', 'tn_' ),
		'parent_item'       => __( 'Parent Category', 'tn_' ),
		'parent_item_colon' => __( 'Parent Category:', 'tn_' ),
		'edit_item'         => __( 'Edit Category', 'tn_' ),
		'update_item'       => __( 'Update Category', 'tn_' ),
		'add_new_item'      => __( 'Add New Category', 'tn_' ),
		'new_item_name'     => __( 'New Category', 'tn_' ),
		'menu_name'         => __( 'Categories', 'tn_' ),
	);
	$args = array(
		'labels'                => $labels,
		'hierarchical'          => true, // true = categories & false = tags
		'public' 															=> true,
		'show_ui' 														=> true,
		'show_tagcloud' 								=> true,
		'show_in_nav_menus' 				=> true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_generic_term_count',
		'query_var'             => 'img_cat',
		'rewrite'               => array( 'slug' => 'img_cat', 'tn_' ),
	);
	register_taxonomy( 'img_cat', array( 'attachment', 'tn_' ), $args );
}
add_action( 'init', 'tax_img_cat', 0 );

?>