<?php
/**
 * The template for displaying comments
 *
 * @package wphelp
 * @subpackage asmi
 * @since Asmi 1.0
 */

if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments-area">
	<?php 
	if( have_comments() ) { ?>
	
		<h3 class="comments-title">
			<span class="comments-number">
				<?php comments_number( __( 'No comments yet', 'asmi' ), 
					__( 'One comment', 'asmi' ), __( '% comments', 'asmi' ) ); ?>.
			</span>
			
			<span class="add-comment-link">
				<a href="#respond"><?php _e( 'Add yours', 'asmi' ); ?></a>.
			</span>
		</h3>
		
		<ol class="comments-list">
			<?php
			wp_list_comments( array(
				'style'			=> 'ol',
				'avatar_size'	=> 60,
				'max_depth'		=> 3,
			) ); ?>
		</ol> <?php 
		
	} // have_comments() ?>
	
	<?php 
	if( ! comments_open() && 
		get_comments_number() &&
		post_type_supports( get_post_type(), 'comments' ) ) { ?>
		
		<p class="comments-closed note">
			<?php _e( 'Comments are closed.', 'asmi' ); ?>
		</p> <?php
		
	} ?>
		
	<?php
	comment_form( array(
		'comment_notes_after' 	=> '',
	) ); ?>
</div>