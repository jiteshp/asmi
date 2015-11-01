<?php
/**
 *	Theme actions, filters and functions.
 *
 *	@package wphelp
 *	@subpackage	asmi
 *	@since Asmi 1.0
 */
 
/**
 *	Set content width based on the theme's design. Override by hooking into the
 *	'asmi_content_width' filter.
 *
 *	@since Asmi 1.0
 */
function asmi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'asmi_content_width', 720 );
}

add_action( 'after_setup_theme', 'asmi_content_width' );
 
/**
 *	Add support for various theme features. Override by creating your own
 *	asmi_setup() function in the child theme.
 *
 *	@since Asmi 1.0
 */
if( ! function_exists( 'asmi_setup' ) ) {
	function asmi_setup() {
		load_theme_textdomain( 'asmi', get_template_directory() . '/lang' );
		
		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );
		
		add_theme_support( 'post-thumbnails' );
		
		register_nav_menus( array(
			'asmi_header_menu' => __( 'Header Menu', 'asmi' ),
			'asmi_footer_menu' => __( 'Footer Menu', 'asmi' ),
		) );
		
		add_theme_support( 'html5', array(
			'caption', 'comment-form', 'comment-list', 'gallery', 'search-form',
		) );
		
		add_theme_support( 'custom-header', array(
			'flex-height'	=> true,
			'flex-width'	=> true,
			'header-text'	=> false,
			'height'		=> 800,
			'width'			=> 1200,
		) );
	}
}

add_action( 'after_setup_theme', 'asmi_setup' );
 
/**
 *	Register theme image sizes. Override by creating your own 
 *	asmi_image_sizes() function in the child theme.
 *
 *	@since Asmi 1.0
 */
if( ! function_exists( 'asmi_image_sizes' ) ) {
	function asmi_image_sizes() {
		update_option( 'large_size_w', 0 );
		update_option( 'large_size_h', 0 );
		
		update_option( 'medium_size_w', 0 );
		update_option( 'medium_size_h', 0 );
		
		update_option( 'thumbnail_size_w', 0 );
		update_option( 'thumbnail_size_h', 0 );
		
		set_post_thumbnail_size( 1200, 627, true );
	}
}

add_action( 'after_setup_theme', 'asmi_image_sizes' );
 
/**
 *	Enqueue theme styles & scripts. Override by creating your own 
 *	asmi_scripts() function in the child theme.
 *
 *	@since Asmi 1.0
 */
if( ! function_exists( 'asmi_scripts' ) ) {
	function asmi_scripts() {
		wp_enqueue_style( 'asmi-fonts', asmi_get_fonts_uri() );
		
		wp_enqueue_style( 'asmi-icons', asmi_get_icons_uri() );
		
		wp_enqueue_style( 'asmi-style', get_stylesheet_uri() );
		
		if( is_singular() && 
			comments_open() && 
			get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		wp_enqueue_script( 'asmi-fitvids', 
			get_template_directory_uri() . '/js/jquery.fitvids.js',
			array( 'jquery' ), null, true );
		
		wp_enqueue_script( 'asmi-match-height', 
			get_template_directory_uri() . '/js/jquery.matchHeight.js',
			array( 'jquery' ), null, true );
		
		wp_enqueue_script( 'asmi-scroll-to', 
			get_template_directory_uri() . '/js/jquery.scrollTo.js',
			array( 'jquery' ), null, true );
		
		wp_enqueue_script( 'asmi-script', 
			get_template_directory_uri() . '/js/script.js',
			array( 
				'asmi-fitvids', 
				'asmi-match-height', 
				'asmi-scroll-to' 
			), null, true );
	}
}

add_action( 'wp_enqueue_scripts', 'asmi_scripts' );
 
/**
 *	Register theme widget areas. Override by creating your own 
 *	asmi_sidebars() function in the child theme.
 *
 *	@since Asmi 1.0
 */
if( ! function_exists( 'asmi_sidebars' ) ) {
	function asmi_sidebars() {
		register_sidebar( array(
			'id'			=> 'asmi_header_widgets',
			'name'			=> __( 'Header Widgets', 'asmi' ),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s"><div class="container">',
			'after_widget'	=> '</div></aside>',
			'before_title'	=> '<h4 class="widget-title">',
			'after-title'	=> '</h4>',
		) );
		
		register_sidebar( array(
			'id'			=> 'asmi_footer_widgets',
			'name'			=> __( 'Footer Widgets', 'asmi' ),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s"><div class="container">',
			'after_widget'	=> '</div></aside>',
			'before_title'	=> '<h4 class="widget-title">',
			'after-title'	=> '</h4>',
		) );
		
		register_sidebar( array(
			'id'			=> 'asmi_after_post_widgets',
			'name'			=> __( 'After Post Widgets', 'asmi' ),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="widget-title">',
			'after-title'	=> '</h3>',
		) );
	}
}

add_action( 'widgets_init', 'asmi_sidebars' );
 
/**
 *	Register theme customizer options. Override by creating your own 
 *	asmi_customizer_options() function in the child theme.
 *
 *	@param WP_Customize_Manager $wp_customize object.
 *	@since Asmi 1.0
 */
if( ! function_exists( 'asmi_customizer_options' ) ) {
	function asmi_customizer_options( $wp_customize ) {
		$wp_customize->add_setting( 'asmi_accent_color', array(
			'default'	=> '#1e73be',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'asmi_accent_color', array(
				'label'		=> __( 'Accent Color', 'asmi' ),
				'section'	=> 'colors',
			)
		) );

		$wp_customize->add_setting( 'asmi_header_palette', array(
			'default'	=> 'dark-on-light-header',
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize, 'asmi_header_palette', array(
				'choices'	=> array(
					'dark-on-light-header'	=> __( 'Dark on Light', 'asmi' ),
					'light-on-dark-header'	=> __( 'Light on dark', 'asmi' ),
				),
				'label'		=> __( 'Header Palette', 'asmi' ),
				'section'	=> 'colors',
				'type'		=> 'select',
			)
		) );
		
		$wp_customize->add_setting( 'asmi_logo_image', array(
			'default'	=> false,
		) );
		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
			$wp_customize, 'asmi_logo_image', array(
				'height'	=> 90,
				'label'		=> __( 'Logo', 'asmi' ),
				'section'	=> 'title_tagline',
				'width'		=> 300,
			)
		) );
	}
}

add_action( 'customize_register', 'asmi_customizer_options' );
 
/**
 *	Output the theme customizer options. Override by creating your own
 *	asmi_customizer_output() function in the child theme.
 *
 *	@since Asmi 1.0
 */
if( ! function_exists( 'asmi_customizer_output' ) ) {
	function asmi_customizer_output() {
		$accent_color = get_theme_mod( 'asmi_accent_color', '#1e73be' );
		$header_image = get_header_image();
		
		ob_start(); ?>
<style id="asmi-custom-styles" type="text/css">
	<?php if( $header_image ): ?>
	#header-widgets .widget:first-child {
		background-image: url( '<?php echo esc_url( $header_image ) ?>' );
	}
	<?php endif; ?>
	a, h1 a:hover, h2 a:hover {
		color: <?php echo $accent_color ?>;
	}
	a:hover {
		border-bottom-color: <?php echo $accent_color ?>;
	}
	.button, input[type=submit] {
		background-color: <?php echo $accent_color ?>;
		border-color: <?php echo $accent_color ?>;
	}
	#header-nav .toggle, #header-widgets .widget:first-child, #footer-widgets {
		background-color: <?php echo $accent_color ?>;
	}
</style> <?php
		echo ob_get_clean() . "\n\n";
	}
}

add_action( 'wp_head', 'asmi_customizer_output' );
 
/**
 *	Provide custom body classes for the theme styles. Override by hooking into 
 *	the 'body_class' filter.
 *
 *	@param array $classes default classes defined by WordPress.
 *	@return array classes required by the theme.
 *	@since Asmi 1.0
 */
function asmi_body_class( $classes ) {
	if( is_active_sidebar( 'asmi_header_widgets' ) ) {
		$classes[] = 'has-header-widgets';
	}
	
	$classes[] = get_theme_mod( 'asmi_header_palette', 
		'dark-on-light-header' );
	
	return $classes;
}

add_filter( 'body_class', 'asmi_body_class' );
 
/**
 *	Custom templating to simpligy the WordPress templating logic. Override by 
 *	creating your own asmi_templating() function.
 *
 *	@param string $template requested by WordPress.
 *	@return string base wrapper template.
 *	@since Asmi 1.0
 */
if( ! function_exists( 'asmi_templating' ) ) {
	function asmi_templating( $template ) {
		global $asmi_content_template;
		$asmi_content_template = $template;
		
		return get_template_directory() . '/base.php';
	}
}

add_filter( 'template_include', 'asmi_templating' );
 
/**
 *	Unregister all widgets except text widget. Override by creating your own 
 *	asmi_supported_widgets() function.
 *
 *	@param string $template requested by WordPress.
 *	@return string base wrapper template.
 *	@since Asmi 1.0
 */
if( ! function_exists( 'asmi_supported_widgets' ) ) {
	function asmi_supported_widgets() {
		$widgets_to_unregister = array(
			'WP_Widget_Pages',
			'WP_Widget_Calendar',
			'WP_Widget_Archives',
			'WP_Widget_Links',
			'WP_Widget_Meta',
			'WP_Widget_Search',
			'WP_Widget_Categories',
			'WP_Widget_Recent_Posts',
			'WP_Widget_Recent_Comments',
			'WP_Widget_RSS',
			'WP_Widget_Tag_Cloud',
			'WP_Nav_Menu_Widget',
		);
		
		foreach( $widgets_to_unregister as $widget ) {
			unregister_widget( $widget );
		}
	}
}

add_action( 'widgets_init', 'asmi_supported_widgets' );
 
/**
 *	Unregister plugin styles. Override by hooking on to the 'asmi_remove_styles'
 *	filter.
 *
 *	@since Asmi 1.0
 */
function asmi_remove_styles() {
	$styles_to_remove = apply_filters( 'asmi_remove_styles', array(
		'contact-form-7',
		'contact-form-7-rtl',
	) );
	
	foreach( $styles_to_remove as $style ) {
		wp_deregister_style( $style );
	}
}

add_action( 'wp_print_styles', 'asmi_remove_styles' );
 
/**
 *	Remove category & tag taxonomies.
 *
 *	@since Asmi 1.0
 */
function asmi_remove_taxonomies() {
	register_taxonomy( 'post_tag', array() );
	register_taxonomy( 'category', array() );
}

add_action( 'init', 'asmi_remove_taxonomies' );
 
/**
 *	Display the site logo or site title. Override by creating your own 
 *	asmi_logo() function.
 *
 *	@since Asmi 1.0
 */
if( ! function_exists( 'asmi_logo' ) ) {
	function asmi_logo() {
		$site_title = get_bloginfo( 'name' );
		
		$site_logo = get_theme_mod( 'asmi_logo_image', false );
		if( $site_logo ) {
			$site_logo = wp_get_attachment_src( $site_logo );
			$site_logo = sprintf( '<img src="%1$s" alt="%2$s">', 
				esc_url( $site_logo[0] ), esc_attr( $site_title ) );
			
			echo $site_logo;
		}
		
		echo $site_title;
	}
}

/**
 *	Return Google fonts to be used in the theme. Override by hooking into the 
 *	'asmi_fonts' filter.
 *
 *	@since Asmi 1.0
 */
function asmi_get_fonts_uri() {
	$fonts = apply_filters( 'asmi_fonts', array(
		'Ek Mukta:200,200italic,700',
		'Inconsolata',
	) );
	
	$fonts_url = '';
	if( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
		), 'https://fonts.googleapis.com/css' );
	}
	
	return $fonts_url;
}

/**
 *	Return Fontawesome icons url to be used in the theme. Override by hooking 
 *	into the 'asmi_icons_uri' filter.
 *
 *	@since Asmi 1.0
 */
function asmi_get_icons_uri() {
	return apply_filters( 'asmi_icons_uri',
		'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
}