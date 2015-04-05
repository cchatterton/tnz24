<?php

// enable featured images
add_theme_support('post-thumbnails');

// set defaults
if ( ! isset( $content_width ) ) $content_width = 1000;

// add_filters
add_filter( 'wp_title', array( 'tn_theme', 'title' ), 10, 2 );

// add actions
add_action( 'admin_bar_menu',  array( 'tn_theme', 'custom_adminbar' ), 999 );
add_action( 'wp_head', array( 'tn_theme', 'style'), 10, 2 );

// the master class
// -----------------------------------
// ::section
// ::style
// ::onclick
// ::field <-- to be replaced by CMB2
// ::title
// ::custom_adminbar

class tn_theme {

  static function section( $args ){

    is_array( $args ) ? extract( $args ) : parse_str( $args );

    // check for required variables
    if ( !isset( $name ) || !$file ) return;
    if ( !isset( $inner_class ) ) $inner_class = 'full-row'; // other options include 'row'
    if ( !isset( $type ) ) $type = 'div'; // other options include 'section', 'footer', etc...
    if ( !isset( $class ) ) $class = 'no-class'; // other options include 'section', 'footer', etc...
    if ( !isset( $dir ) ) $dir = 'sections';

    // setup the wrapper
    echo "\n".'<!-- '.$name.' -->'."\n";
    echo "\n".'<!-- '.$file.' -->'."\n";
    echo '<'.$type.' id="row-'.$name.'" class="row-wrapper '.$class.'">'."\n";
    echo ' <div id="row-inner-'.$name.'" class="row-inner-wrapper '.$inner_class.'">'."\n";

    locate_template( array( $dir. '/' . $file ), true );

    echo ' </div>'."\n";
    echo '</'.$type.'>'."\n";
    echo '<!-- end '.$name.' -->'."\n";

  }

	static function style(){

		if( !empty( $_GET['css'] ) && $_GET['css'] == 'new' ) {
			delete_transient('tn_style');
		}

		// Check for transient. If none, then execute WP_Query
		if ( false === ( $tn_style = get_transient( 'tn_style' ) ) ) {

			$tn_style  = '/* last updated: '.date('c').' */'."\n";
			$tn_style .= file_get_contents( get_template_directory_uri().'/css/default.css' )."\n";
			$tn_style .= file_get_contents( get_template_directory_uri().'/css/style.css' );

			// Put the results in a transient. Expire after 12 hours.
			set_transient( 'tn_style', $tn_style, 12 * HOUR_IN_SECONDS );

		}
		echo '<style>'."\n". $tn_style."\n".'</style>'."\n";
	}

	static function onclick( $args ) {
		// last updated 19/07/2014

		is_array( $args ) ? extract( $args ) : parse_str( $args );
		// $args example: "url="http://techn.com.au&target=_blank&output=echo"

		//set defaults
		if( !$output ) $output = 'echo'; // valid $outputs include 'echo' and 'return'

		// the function
		$location = ( !$target ) ? "location.href='$url';" : "window.open('$url','$target')";
		if( $output == 'echo' ) { echo $location; } else { return $location; };

	}

	static function field( $args ){
		// last updated 19/07/2014

		is_array( $args ) ? extract( $args ) : parse_str( $args );
		// $args example: "url="http://techn.com.au&target=_blank&output=echo"

		//set defaults
		if( !$title && !$field_name) return;
		if( !$title && $field_name) $title = $field_name; $title = ucfirst( strtolower( $title ) );
		if( !$field_name && $title ) $field_name = $title; $field_name = strtolower( str_replace( ' ', '_', $field_name ) );
		if( !$size ) $size = '100%'; // accepts valid css for all types expect textarea. Text array expects an array where [0] is width and [1] is height
		if( !$max_width ) $max_width = '100%';
		if( !$type ) $type = 'text'; // accepts 'text', 'textarea', 'checkox', 'select'

		$script = substr( $_SERVER['PHP_SELF'], strrpos( $_SERVER['PHP_SELF'], '/')+1 );
		$source = ( $script == 'post.php' || $script == 'post-new.php' ) ? 'meta' : 'option';
		if ( !$source == 'option' && !$group ) return;
		$field_name = ( $source == 'option' ) ? $group."[".$name."]" : $field_name;

		echo ' <div style="display:block;width:100%;padding-bottom:5px;">'."\n";
		switch ($type) {

			case 'checkbox':
				$checked = ( $source == 'meta' && get_post_meta( $_GET[post], $field_name, true ) == 'true') ? 'checked="checked"' : '' ;
				if( $source == 'option' ) {
					$option = get_option( $group );
				 	$value = $option[$name];
				 	$checked = ( $value == 'true' ) ? 'checked="checked"' : '';
				 }
				echo '   <input type="checkbox" name="'.$field_name.'" value="true" '.$checked.' style="margin: 0 5px 0px 0;"/><label style="color:rgba(0,0,0,0.75);">'.$title.'</label>'."\n";
				break;

			case 'textarea':
				if( $source == 'meta' ) $value = get_post_meta( $_GET[post], $field_name, true );
				if( $source == 'option' ) {
					$option = get_option( $group );
				 	$value = $option[$name];
				 }
			 	if( $default && !$value ) $value = $default;
				echo '	<label for="'.$field_name.'">'."\n";
				echo '   	<sub style="color:rgba(0,0,0,0.75);display:block;">'.$title.'</sub>'."\n";
				echo '   </label>'."\n";
				if( !is_array( $size ) ) $size = explode(',', $size);
				$style = 'width:'.$size[0].';height:'.$size[1].';max-width:'.$max_width.';';
				echo '   <textarea id="'.$field_name.'" name="'.$field_name.'" style="'.$style.';" placeholder="'.$placeholder.'" >'.esc_attr( $value ).'</textarea>'."\n";
				break;

			case 'select':
			// expects an $options array of arrays as follows
			// $options = array (
			//		array ( 'label' => 'aaa', 'value' => '1' ),
			//		array ( 'label' => 'aaa', 'value' => '1' ),
			//		);
				$current = get_post_meta( $_GET[post], $field_name, true ) ;
				echo '	<sub style="color:rgba(0,0,0,0.75);display:block;width:100%;max-width:'.$max_width.';">'.$title.'</sub>'."\n";
				echo '  	<select name="'.$field_name.'" id="'.$field_name.'">'."\n";
				foreach( $options as $option ) echo '		<option value="'.$option['value'].'" '.selected( $option['value'], $current, false ).'>'.$option['label'].'</option>'."\n";
				echo '	</select>'."\n";
				break;

			case 'color-picker':
				echo '	<label for="meta-color" class="prfx-row-title" style="display:block;width:100%;max-width:'.$max_width.';">'.$title.'</label>'."\n";
	    		echo '	<input name="'.$field_name.'" type="text" value="'.get_post_meta( $_GET[post], $field_name, true ).'" class="meta-color" />'."\n";
				break;

			case 'wp-editor':
				if( $source == 'meta' ) $value = get_post_meta( $_GET[post], $field_name, true );
				if( $source == 'option' ) {
					$option = get_option( $group );
				 	$value = $option[$name];
				 }
			 	if( $default && !$value ) $value = $default;
				wp_editor( $value, $field_name, $settings );
				break;

			case 'text':
			default:
				if( $source == 'meta' ) $value = get_post_meta( $_GET[post], $field_name, true );
				if( $source == 'option' ) {
					$option = get_option( $group );
				 	$value = $option[$name];
				 }
			 	if( $default && !$value ) $value = $default;
				echo '	<label for="'.$field_name.'">'."\n";
				echo '		<sub style="color:rgba(0,0,0,0.75);display:block;">'.$title.'</sub>'."\n";
				echo '	</label>'."\n";
				echo '   <input type="'.$type.'" id="'.$field_name.'" name="'.$field_name.'" style="display:block;max-width:'.$max_width.';width:'.$size.';" placeholder="'.$placeholder.'" value="'.esc_attr( $value ).'" />'."\n";
				break;

		}
		if( $description ) echo '   <div style="position:relative;top:-3px;display:block;width:100%;color:#ddd;font-size:0.8em;">'.$description.'</div>'."\n";
		echo ' </div>'."\n";
		return $field_name;

	}

	static function title( $title, $sep ) {
		global $paged, $page;
		if ( is_feed() ) return $title;
		// Add the site name.
		$title .= get_bloginfo( 'name' );
		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) $title = "$title $sep $site_description";
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) $title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );
		return $title;
	}

	static function custom_adminbar( $wp_admin_bar ) {

		$qs = $_SERVER["QUERY_STRING"]; parse_str($qs); parse_str($qs, $atts);

		$atts['css'] = 'new';
		$qs = http_build_query( $atts );

		$args = array(
			'id'    => 'css',
			'title' => 'Refresh CSS',
			'href'  => '?'.$qs,
			'meta'  => array( 'class' => 'css ' )
		);
		$wp_admin_bar->add_node( $args );
	}
}

?>