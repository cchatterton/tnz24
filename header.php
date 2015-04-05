<!doctype html>
<html>
	<head>
		<title><?php wp_title('|', true, 'right'); ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
// favicon
$favicon = get_theme_mod( ns_.'favicon' );
if( $favicon ) echo '		<link rel="icon" href="'.$favicon.'" type="image/png" />'."\n";

// enable font-icons from wp-admin/appearance/font settings
$theme_fonts = get_option( 'theme_fonts' );
// Font Awesome 4.2.0
if( $theme_fonts[ns_."fa420"] == 'true' ) echo '		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">'."\n";
?>
<?php wp_head(); ?>
	</head>
	<body>
    <!-- start everything -->
    <div class="s-everything">
		<div class="off-canvas-wrap" data-offcanvas>
  			<div class="inner-wrap">
<?php //include('includes/nav_offcanvas.php');
locate_template( array( 'sections/offcanvas.php' ), true );?>
    			<section class="main-section">
<?php //fx_theme_section( 'menu'  , '', 'section_menu.php', 2 ); ?>