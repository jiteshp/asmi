<?php
/**
 *	This template part is used to display when no entries are found.
 *	
 *	@package wphelp
 *	@subpackage	asmi
 *	@since Asmi 1.0
 */ ?>

<div class="no-results">
	<header>
		<h1><?php _e( 'Nothing found', 'asmi' ); ?></h1>
	</header>
	
	<div>
		<?php
		if( is_home() && current_user_can( 'publish-posts' ) ) { ?>
			<p>
				<?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started 	here</a>.', 'asmi' ), esc_url( admin_url( 'post-new.php' ) ) ) ); ?>
			</p> <?php
		}
		else { ?>
			<p>
				<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'asmi' ); ?>
			</p> <?php
			
			get_search_form();
		} ?>
	</div>
</div>