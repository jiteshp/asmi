<?php
/**
 *	This template display's the author's biography.
 *	
 *	@package wphelp
 *	@subpackage	asmi
 *	@since Asmi 1.0
 */

if( '' != get_the_author_meta( 'description' ) ) { ?>
<div id="author-bio" class="media">
	<div class="media-image">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?>
	</div>
	
	<div class="media-body">
		<h4 class="author-title">
			<?php _e( 'About', 'asmi' ); ?>
			<span class="author-name">
				<?php echo get_the_author(); ?>
			</span>
		</h4>
		
		<div class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</div>
	</div>
</div> <?php
}