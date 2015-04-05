<?php // last updated: 28/04/2015

define('ns_', 'tn_');

$includes = array(

	// theme elements
	array( 'file' => 'scripts.php',         'dir' => 'theme' ), // <-- enques our scripts to header
	array( 'file' => 'menus.php',           'dir' => 'theme' ), // <-- registers our menus
	array( 'file' => 'fonts.php',           'dir' => 'theme' ), // <-- lets us link up to three google fonts
	array( 'file' => 'functions.php',       'dir' => 'theme' ), // <-- our theme functions
	array( 'file' => 'customizer.php',      'dir' => 'theme' ), // <-- our customizer fields & settings
	array( 'file' => 'style.php', 					     'dir' => 'css' ), // <-- our dynamic css
	array( 'file' => 'sections.php',        'dir' => 'sections' ), // <-- set-up sections

	);

foreach ($includes as $args ) tn_init::include( $args );

class tn_init {
	static function include( $args ) {
		is_array( $args ) ? extract( $args ) : parse_str( $args );
		// check for required variables
		if( !$dir && !$file ) return;
		// include required theme part
		$dir == '' ? locate_template( array( $file ), true ) : locate_template( array( $dir. '/' . $file ), true );
		return;
	}
}

?>