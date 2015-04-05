<?php

// find'n replace Mycpts & Mycpt (as cpt). *Remember to preseve case
// remember to include in functions.php

function cpt_mycpt() {
	$labels = array(
		'name'               => _x( 'Mycpts', 'post type general name', 'tn_' ),
		'singular_name'      => _x( 'Mycpt', 'post type singular name', 'tn_' ),
		'add_new'            => _x( 'Add New', 'Mycpt', 'tn_' ),
		'add_new_item'       => __( 'Add New Mycpt', 'tn_' ),
		'edit_item'          => __( 'Edit Mycpt', 'tn_' ),
		'new_item'           => __( 'New Mycpt', 'tn_' ),
		'all_items'          => __( 'All Mycpts', 'tn_' ),
		'view_item'          => __( 'View Mycpt', 'tn_' ),
		'search_items'       => __( 'Search Mycpts', 'tn_' ),
		'not_found'          => __( 'No Mycpts found', 'tn_' ),
		'not_found_in_trash' => __( 'No Mycpts found in the Trash', 'tn_' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Mycpts'
	);

	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our Mycpt posts',
		'public'        => true,
		'menu_position' => 20,
	 	'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes'),
		'has_archive'   => true,
		'hierarchical' 	=> true
	);
	register_post_type( 'mycpt', $args );
}
add_action( 'init', 'cpt_mycpt' );

// Set Messages
function cpt_mycpt_messages( $messages ) {
//http://codex.wordpress.org/Function_Reference/register_post_type

  global $post, $post_ID;

  $messages['mycpt'] = array(
	0 => '', // Unused. Messages start at index 1.
	1 => sprintf( __('Mycpt Post updated.', 'your_text_domain'), esc_url( get_permalink($post_ID) ) ),
	2 => __('Mycpt updated.', 'your_text_domain'),
	3 => __('CMycpt deleted.', 'your_text_domain'),
	4 => __('Mycpt Post updated.', 'your_text_domain'),
	/* translators: %s: date and time of the revision */
	5 => isset($_GET['revision']) ? sprintf( __('Mycpt Post restored to revision from %s', 'your_text_domain'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	6 => sprintf( __('Mycpt Post published. <a href="%s">View Mycpt Post</a>', 'your_text_domain'), esc_url( get_permalink($post_ID) ) ),
	7 => __('Mycpt Post saved.', 'your_text_domain'),
	8 => sprintf( __('Mycpt Post submitted. <a target="_blank" href="%s">Preview Mycpt Post</a>', 'your_text_domain'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	9 => sprintf( __('Mycpt Post scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Mycpt Post</a>', 'your_text_domain'),
	  // translators: Publish box date format, see http://php.net/date
	  date_i18n( __( 'M j, Y @ G:i', 'tn_' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	10 => sprintf( __('Mycpt Post draft updated. <a target="_blank" href="%s">Preview Mycpt Post</a>', 'your_text_domain'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}
add_filter( 'post_updated_messages', 'cpt_mycpt_messages' );

?>