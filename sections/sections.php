<?php // last updated: 18/07/2014

function tn_section( $args ){

  is_array( $args ) ? extract( $args ) : parse_str( $args );

  // check for required variables
  if ( !isset( $name ) || !$file ) return;

  tn_section_start( $args ); // <-- open the wrapper
  tn_section_content ( $args ); // <-- gets the theme part
  tn_section_end ( $args );  // <-- close the wrapper
  return;

}

function tn_section_start( $args ){

  is_array( $args ) ? extract( $args ) : parse_str( $args );

  if ( !isset( $inner_class ) ) $inner_class = 'full'; // other options include 'row'
  if ( !isset( $type ) ) $type = 'div'; // other options include 'section', 'footer', etc...
  if ( !isset( $class ) ) $class = 'no-class'; // other options include 'section', 'footer', etc...

  // setup the wrapper
  _e( "\n".'<!-- '.$name.' -->'."\n", ns_ );
  _e( '<'.$type.' id="row-'.$name.'" class="row-wrapper '.$class.'">'."\n", ns_ );
  _e( ' <div id="row-inner-'.$name.'" class="row-inner-wrapper '.$inner_class.'">'."\n", ns_ );

}

function tn_section_content( $args ){

  is_array( $args ) ? extract( $args ) : parse_str( $args );

  // check for required variables
  if ( !isset( $dir ) ) $dir = 'sections'; // other options include 'row'
  locate_template( array( $dir. '/' . $file ), true );

}

function tn_section_end ( $args ){

  is_array( $args ) ? extract( $args ) : parse_str( $args );
  if ( !isset( $type ) ) $type = 'div'; // other options include 'section', 'footer', etc...

  _e( ' </div>'."\n", ns_ );
  _e( '</'.$type.'>'."\n", ns_ );
  _e( '<!-- end '.$name.' -->'."\n", ns_ );

}

?>