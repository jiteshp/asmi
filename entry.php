<?php
/**
 *	This template part is used to displays an entry in the archive or blog 
 *	index.
 *	
 *	@package wphelp
 *	@subpackage	asmi
 *	@since Asmi 1.0
 */

if( '' != get_the_title() || '' != get_the_content() ) { ?>
	<article <?php post_class(); ?>>
		<header class="entry-header">
			<?php
			if( ! is_search() ) { ?>
			<div class="entry-time">
				<?php the_time( 'F j, Y' ); ?>
			</div> <?php
			}
			 
			if( '' != get_the_title() ) { ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>"
				   rel="bookmark"><?php the_title(); ?></a>
			</h1> <?php
			} ?>
		</header>
		
		<?php
		if( has_post_thumbnail() ) { ?>
		<div class="entry-featured-image">
			<a href="<?php the_permalink(); ?>"
			   rel="bookmark"><?php the_post_thumbnail(); ?></a>
		</div> <?php
		}
		
		if( '' != get_the_content() ) { ?>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div> <?php
		} ?>
	</article> <?php
}