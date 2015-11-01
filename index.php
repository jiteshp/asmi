<?php
/**
 *	This template is the only template used in the theme. It displays the 
 *	appropriate template part based on conditional functions.
 *	
 *	@package wphelp
 *	@subpackage	asmi
 *	@since Asmi 1.0
 */

if( have_posts() ) {
	while( have_posts() ) {
		the_post();
		
		if( is_singular() ) {
			get_template_part( 'entry', 'singular' );
		}
		else {
			get_template_part( 'entry' );
		}
	}
	
	the_posts_navigation( array(
		'prev_text'	=> '<i class="fa fa-chevron-left"></i>' .
			sprintf( '<span class="screen-reader-text">%s</span>', 
				__( 'Previous Page', 'asmi' ) ),
		'next_text'	=> '<i class="fa fa-chevron-right"></i>' .
			sprintf( '<span class="screen-reader-text">%s</span>', 
				__( 'Next Page', 'asmi' ) ),
	) );
}
else {
	get_template_part( 'entry', 'none' );
}