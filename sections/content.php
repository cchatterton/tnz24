<?php

global $post;
//$content = apply_filters('the_content', $post->post_content );

echo '<article class="small-12 medium-9 large-9 columns">'."\n";

	_e( '<h1>'.strtoupper( $post->post_title ).'</h1>'."\n" );
	// the content
	while ( have_posts() ) : the_post();
	the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', ns_ ) );
	endwhile;

echo '</article>'."\n";
echo '<aside class="small-12 medium-3 large-3 columns">'."\n";
get_sidebar();
echo '</aside>'."\n"; 

?>