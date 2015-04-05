<?php // last updated: 28/04/2015

define('ns_', 'tn_');

$theme_files = array(

	// theme elements
	array( 'file' => 'scripts.php',         'dir' => 'theme' ), // <-- enques our scripts to header
	array( 'file' => 'menus.php',           'dir' => 'theme' ), // <-- registers our menus
	array( 'file' => 'fonts.php',           'dir' => 'theme' ), // <-- lets us link up to three google fonts
	array( 'file' => 'functions.php',       'dir' => 'theme' ), // <-- our theme functions
	array( 'file' => 'customizer.php',      'dir' => 'theme' ), // <-- our customizer fields & settings

	);

foreach ($theme_files as $theme_file ) tn_init::include_file( $theme_file );

class tn_init {
	static function include_file( $args ) {
		is_array( $args ) ? extract( $args ) : parse_str( $args );
		// check for required variables
		if( !$dir && !$file ) return;
		// include required theme part
		$dir == '' ? locate_template( array( $file ), true ) : locate_template( array( $dir. '/' . $file ), true );
		return;
	}
}

?>