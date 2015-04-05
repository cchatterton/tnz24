<!doctype html>
<html>
	<head>
		<title><?php wp_title('|', true, 'right'); ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$favicon = get_theme_mod( ns_.'favicon' );
if( $favicon ) echo '		<link rel="icon" href="'.$favicon.'" type="image/png" />'."\n";

$theme_fonts = get_option( 'theme_fonts' ); // enable font-icons from wp-admin/appearance/font settings
if( $theme_fonts[ns_."fa430"] == 'true' ) echo '		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">'."\n"; // Font Awesome 4.3.0

wp_head(); ?>
	</head>
	<body>
    <!-- start everything -->
    <div class="s-everything">
		<div class="off-canvas-wrap" data-offcanvas>
  			<div class="inner-wrap">
<?php tn_theme::section( 'name=top&file=top.php&&class=hide-for-small&inner_class=row' ); ?>
<?php locate_template( array( 'sections/offcanvas.php' ), true );?>
    			<section class="main-section">