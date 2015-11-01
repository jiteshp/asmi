<?php
/**
 *	This template part is used to displays a single post or page entry and it's 
 *	comments along with after post widgets.
 *	
 *	@package wphelp
 *	@subpackage	asmi
 *	@since Asmi 1.0
 */

if( '' != get_the_title() || '' != get_the_content() ) { ?>
	<article <?php post_class(); ?>>
		<?php
		if( '' != get_the_title() ) { ?>
		<header class="entry-header">
			<?php 
			if( is_single() ) { ?> 
			<div class="entry-time">
				<?php the_time( 'F j, Y' ); ?>
			</div> <?php
			} ?>
			
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
		</header> <?php
		} ?>
		
		<?php
		if( has_post_thumbnail() ) { ?>
		<div class="entry-featured-image">
			<?php the_post_thumbnail(); ?>
		</div> <?php
		}
		
		if( '' != get_the_content() ) { ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div> <?php
		} ?>
	</article> <?php
		
	if( is_active_sidebar( 'asmi_after_post_widgets' ) ) { ?>
	<div id="after-post-widgets">
		<?php dynamic_sidebar( 'asmi_after_post_widgets' ); ?>
	</div> <?php
	}
	
	if( is_single() ) {
		get_template_part( 'biography' );
	}

	if( comments_open() || get_comments_number() ) {
		comments_template();
	}
}