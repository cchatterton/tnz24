<?php

register_nav_menus( array(
	'top' => 'Top',
	'main' => 'Main',
	'footer' => 'Footer',
) );

function tn_menu( $args ){
	// last updated 23/10/2014

	is_array( $args ) ? extract( $args ) : parse_str( $args );

	//set defaults

	if( !isset( $menu ) && strpos( $args, '=') == false ) $menu = $args;
	if( !isset( $menu ) ) return;
	if( !isset( $modal ) ) $modal = 'tnz_modal';
	if( !isset( $li_class ) ) $li_class = 's-no-class';
	if( !isset( $class ) ) $class = 's-no-class';
	unset( $ourmenu );

	global $post; $menu_name = $menu;
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[$menu_name] ) ) {
		$menu = wp_get_nav_menu_object( $locations[$menu_name] );
		$menu_items = wp_get_nav_menu_items( $menu->term_id );
		foreach ( (array) $menu_items as $key => $menu_item ) {
		    $li_class = ( $post->ID == $menu_item->object_id ) ? 'active' : '';
		    if( $menu_item->menu_item_parent == 0 ) {
							$ourmenu .= '<li class="'.$li_class.' menu-item menu-item-'.$menu_item->ID. ' ' . $menu_item->classes[0] .'">';
							if( strpos( $menu_item->url, $modal ) > 0 ) {
								$ourmenu .= '<a data-reveal-id="'.$modal.'_'. $menu_item->object_id .'" href="#">' . strtolower( $menu_item->title ). '</a>';
							} else {
								$ourmenu .= '<a class="'.$class.'" href="' . $menu_item->url .'">' . strtolower( $menu_item->title ) . '</a>';
							}
							$ourmenu .= '</li>';
		    }
		}
	}

if( isset( $ourmenu ) ) echo $ourmenu;
return;

}

?>