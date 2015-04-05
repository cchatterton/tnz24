<?php // 20/01/2015

function tn_admin_enqueue_scripts() {
	wp_enqueue_style( 'admin', get_stylesheet_directory_uri().'/css/admin.css','', date('c'));
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'meta-box-color-js', get_template_directory_uri() . '/js/meta-box-color.js', array( 'wp-color-picker' ) );
	wp_enqueue_media();
	 // Registers and enqueues the required javascript.
	wp_register_script( 'meta-box-image', get_template_directory_uri() . '/js/meta-box-image.js', array( 'jquery' ) );
	wp_localize_script( 'meta-box-image', 'meta_image',
	    array(
	        'title' => __( 'Choose or Upload an Image', 'prfx-textdomain' ),
	        'button' => __( 'Use this image', 'prfx-textdomain' ),
	    )
	);
	wp_enqueue_script( 'meta-box-image' );
}
add_action( 'admin_enqueue_scripts', 'tn_admin_enqueue_scripts' );

function tn_wp_enqueue_scripts() {
	// styles
	wp_enqueue_style( 'normalize', get_stylesheet_directory_uri().'/css/normalize.css');
	if (get_option( 'tn_zurb_grid' ) == 12 ) wp_enqueue_style( 'foundation', get_stylesheet_directory_uri().'/css/foundation12.min.css');
	if (get_option( 'tn_zurb_grid' ) == 24 ) wp_enqueue_style( 'foundation', get_stylesheet_directory_uri().'/css/foundation24.min.css');
	//wp_enqueue_style( 'slick', get_stylesheet_directory_uri().'/css/slick.css');
	wp_enqueue_style( 'style', get_stylesheet_directory_uri().'/css/theme.css','', date('c'));

	$theme_fonts = get_option( 'theme_fonts' );
	if( $theme_fonts[ns_.'gf1'] ) wp_enqueue_style( ns_.'gf1', $theme_fonts[ns_.'gf1'] );
	if( $theme_fonts[ns_.'gf2'] ) wp_enqueue_style( ns_.'gf2', $theme_fonts[ns_.'gf2'] );
	if( $theme_fonts[ns_.'gf3'] ) wp_enqueue_style( ns_.'gf3', $theme_fonts[ns_.'gf3'] );

	// header scripts
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', array('jquery'), '1.0.0' );

	// footer sripts
	wp_enqueue_script( 'fastclick', get_template_directory_uri() . '/js/vendor/fastclick.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'zurb', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'tn_wp_enqueue_scripts' );

?>