<?php
/**
 *	This template wraps all the content templates in the theme. See 
 *	asmi_templating() in functions.php for implementation details.
 *	
 *	@package wphelp
 *	@subpackage	asmi
 *	@since Asmi 1.0
 */ ?><!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header id="site-header" role="banner">
		<div class="container clr">
			<div id="site-brand" class="col-xs-12 col-md-4">
				<a href="<?php echo esc_url( home_url( '/' ) )?>"
				   title="<?php _e( 'Home', 'asmi' ); ?>" 
				   rel="home"><?php asmi_logo(); ?></a>
			</div>
			
			<nav id="header-nav" class="col-xs-12 col-md-8" role="navigation">
				<a href="#" class="toggle"><i class="fa fa-bars"></i></a>
			
				<?php
				wp_nav_menu( array(
					'container' 	 => false,
					'depth' 	 	 => -1,
					'theme_location' => 'asmi_header_menu',
				) ); ?>
			</nav>
		</div>
	</header>
	
	<?php
	if( is_active_sidebar( 'asmi_header_widgets' ) ) { ?>
	<div id="header-widgets">
		<?php dynamic_sidebar( 'asmi_header_widgets' ); ?>
	</div> <?php
	} ?>
	
	<div id="site-content" role="main">
		<div class="container">
			<?php load_template( $asmi_content_template ); ?>
		</div>
	</div>

	<?php
	if( is_active_sidebar( 'asmi_footer_widgets' ) ) { ?>
	<div id="footer-widgets">
		<?php dynamic_sidebar( 'asmi_footer_widgets' ); ?>
	</div> <?php
	} ?>
	
	<footer id="site-footer" role="contentinfo">
		<div class="container clr">
			<?php
			if( has_nav_menu( 'asmi_footer_menu' ) ) { ?>
			<nav id="footer-nav" class="col-xs-12" role="navigation">
				<?php
				wp_nav_menu( array(
					'container' 	 => false,
					'depth' 	 	 => -1,
					'theme_location' => 'asmi_footer_menu',
				) ); ?>
			</nav> <?php
			} ?>
			
			<div id="site-info" class="col-xs-12">
				<span id="copyright">
					&copy; <?php echo Date( 'Y' ); ?>
					<a href="<?php echo esc_url( home_url( '/' ) )?>"
					   rel="home"><?php bloginfo( 'name' ); ?></a>
				</span>
				
				<span id="generator">
					Powered by
					<a href="http://wordpress.org/" 
					   rel="generator">WordPress</a>
				</span>
				
				<span id="designer">
					Designed by
					<a href="http://wphelp.in/" 
					   rel="generator">WPHelp.in</a>
				</span>
			</div>
		</div>
	</footer>
	
	<?php wp_footer(); ?>
</body>
</html>