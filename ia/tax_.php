<?php

// find'n replace Mytaxs & Mytax (as tax) and Mycpt (as cpt). *Remember to preseve case
// remember to include in functions.php

add_post_type_support( 'mycpt', 'page-attributes' );

function tax_mytax() {
	$labels = array(
		'name'              => _x( 'Mytax', 'taxonomy general name', 'tn_' ),
		'singular_name'     => _x( 'Mytax', 'taxonomy singular name', 'tn_' ),
		'search_items'      => __( 'Search Mytaxs', 'tn_' ),
		'all_items'         => __( 'All Mytaxs', 'tn_' ),
		'parent_item'       => __( 'Parent Mytax', 'tn_' ),
		'parent_item_colon' => __( 'Parent Mytax:', 'tn_' ),
		'edit_item'         => __( 'Edit Mytax', 'tn_' ),
		'update_item'       => __( 'Update Mytax', 'tn_' ),
		'add_new_item'      => __( 'Add New Mytax', 'tn_' ),
		'new_item_name'     => __( 'New Mytax', 'tn_' ),
		'menu_name'         => __( 'Mytaxs', 'tn_' ),
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
		'query_var'             => 'mytax',
		'rewrite'               => array( 'slug' => 'mytax', 'tn_' ),
	);
	register_taxonomy( 'mytax', array( 'mycpt', 'tn_' ), $args );
}
add_action( 'init', 'tax_mytax', 0 );

?>