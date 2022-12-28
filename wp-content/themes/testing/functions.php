<?php 

// add the action
/*add_action('wp_mail_failed', 'action_wp_mail_failed', 10, 1);*/

// configure PHPMailer to send through SMTP
/*
add_action('phpmailer_init', function ($phpmailer) {
    $phpmailer->isSMTP();
    
    // host details
    $phpmailer->SMTPAuth = WORDPRESS_SMTP_AUTH;
    $phpmailer->SMTPSecure = WORDPRESS_SMTP_SECURE;
    $phpmailer->SMTPAutoTLS = false;
    $phpmailer->Host = WORDPRESS_SMTP_HOST;
    $phpmailer->Port = WORDPRESS_SMTP_PORT;
    // from details
    $phpmailer->From = WORDPRESS_SMTP_FROM;
    $phpmailer->FromName = WORDPRESS_SMTP_FROM_NAME;
    // login details
    $phpmailer->Username = WORDPRESS_SMTP_USERNAME;
    $phpmailer->Password = WORDPRESS_SMTP_PASSWORD;
});
*/

/**
 * 
 * crtheme_setup
 * 
 */
if ( ! function_exists( 'crtheme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various
	 * WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme
	 * hook, which runs before the init hook. The init hook is too late
	 * for some features, such as indicating support post thumbnails.
	 */
	function crtheme_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be placed in the /languages/ directory.
		 */
		load_theme_textdomain( 'crtheme', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to <head>.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for post thumbnails and featured images.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add support for two custom navigation menus.
		 */
		register_nav_menus([
			'primary'   => __( 'Primary Menu', 'crttheme' ),
			'secondary' => __( 'Secondary Menu', 'crtheme' ),
		]);

		/**
		 * Enable support for the following post formats:
		 * aside, gallery, quote, image, and video
		 */
		add_theme_support( 'post-formats', [ 'aside', 'gallery', 'quote', 'image', 'video' ] );
	}

}
add_action( 'after_setup_theme', 'crtheme_setup' );

if ( ! isset ( $content_width) ) {
    $content_width = 800;
}

/**
 * 
 * CodingRock Theme Sidebar Registering
 *   
 */
function crtheme_register_sidebars() {
	register_sidebar([
		'name' => 'Primary Sidebar',
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	]);
}
add_action( 'widgets_init', 'crtheme_register_sidebars' );

/*
* 
* Customizing the WP-Login Form(Admin)
*
*/
function my_login_logo() { 
?>
    <style type="text/css">
	#login h1 a, .login h1 a {
		background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/site-login-logo.png);
		height:65px;
		width:320px;
		background-size: 320px 65px;
		background-repeat: no-repeat;
       	padding-bottom: 30px;
	}
    </style>
<?php
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/**
 * 
 */
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

/**
 * 
 */
function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );

/**
 * 
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('base-style', get_template_directory_uri() . '/assets/css/base.css');
	
	if ( is_front_page() && is_home() )
		wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/scripts.js');

	if ( is_customize_preview() ){
		wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/customize.js');
		wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/customize-preview.js');
	}
});

/**
 * 
 */
function my_excerpt_length($length){ return 50; } 
add_filter('excerpt_length', 'my_excerpt_length');

/**
 *
 * It register a new Custom Post Type: Services
 * displayed in the site theme
 *  
 */
function wporg_custom_post_type() {
	register_post_type('wporg_service',
		[
			'labels' => [
				'name' => 'Services',
				'singular_name' => 'Service',
			],
			'public'      => true,
			'has_archive' => true,
			'supports' => [ 
				'title', 
				'editor', 
				'custom-fields', 
			]
		]
	);
}
add_action('init', 'wporg_custom_post_type');

/**
 * 
 * Customizer Registering
 * 
 * @param - $wp_customize - It allows to add panels, 
 * settings and controls to the Wp Theme Customizer
 * 
 * @return Void - It appends a new Custom Panel to the WP Theme Customizer
 *
 */
function crtheme_customize_register( $wp_customize ) {
	// Add a custom panel.
	$wp_customize->add_panel( 'Theme', [
		'title' => __( 'Theme' ),
		'description' => "Theme customizations",
		'priority' => 160,
		'active_callback' => function(){
			return is_front_page() && is_home();

		},
	]);

	// Add a footer/copyright information section.
	$wp_customize->add_section( 'footer' , [
		'title' => "Footer",
		'panel' => 'Theme',
	]);
	$wp_customize->add_setting('footer_text', [
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'default' => 'Copyright © '.date('Y').' Distributed By CodingRock - Made with WP',
		'transport' => 'refresh',
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	]);
	$wp_customize->add_control( 'footer_text', [
		'label' => __( 'Footer Text' ),
		'type' => 'text',
		'section' => 'footer',
	]);

	// Add a Site Header customization controls.
	$wp_customize->add_section( 'header' , [
		'title' => "Header",
		'panel' => 'Theme',
	]);

	//Logo Upload
	$wp_customize->add_setting('logo_image', [
		'type' => 'theme_mod', 
		'capability' => 'edit_theme_options',
		'theme_supports' => '', 
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => '',
		'sanitize_js_callback' => '', 
	]);
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'logo_image', [
		'label' => __( 'Logo Uploader', 'crtheme_textdomain' ),
		'section' => 'header',
		'mime_type' => 'image',
	]));

	//Color Theme
	$wp_customize->add_setting('color_theme', [
		'type' => 'theme_mod', 
		'capability' => 'edit_theme_options',
		'theme_supports' => '', 
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => '',
		'sanitize_js_callback' => '', 
	]);
	$wp_customize->add_control( 'color_theme', [
		'label' => __( 'Theme Color Scheme' ),
		'type' => 'select',
		'choices' => [
			'blackandwhite' => 'Black & White',
			'whiteandblack' => 'White & Black',
		],
		'section' => 'header',
	]);
}
add_action( 'customize_register', 'crtheme_customize_register' );

/**
 * 
 *	Retrieves Theme Footer Value
 *
 */
function custom_footer_output() {
	return get_theme_mod( 'footer_text', 'Copyright © '.date('Y').' Distributed By CodingRock - Made with WP' );
}

/**
 * 
 *	Retrieve Theme Header Logo Value
 *
 */
function custom_logo_output() {
	$att_id = get_theme_mod('logo_image', '');
	$img_src = false;

	if( $att_id!='' )
		$img_src = wp_get_attachment_image( $att_id, 'medium' );
	else
		$img_src = '<img src="'.get_template_directory_uri().'/assets/img/logo.png" alt="..."/>';

	return $img_src;
}

/**
 *
 *	Retrieve Color Theme Value
 *
*/
function custom_color_theme_output() {
	$colorTheme = get_theme_mod( 'color_theme', '' );

	if($colorTheme == "blackandwhite"){
		echo '<style type="text/css" id="blackandwhite-css">';
		echo '.btn-primary { color: #fff;background-color: #000;border-color: #fff; }';
		echo '.btn-primary:hover { color: #000;background-color: #fff;border-color: #000; }';
		echo '.btn-primary:focus { box-shadow: 0 0 0 0.25rem rgb(130 130 130 / 50%); }';
		echo '.btn-primary:active:focus { color: #fff, background-color: #000; border-color: #000;box-shadow: 0 0 0 0.25rem rgb(130 130 130 / 50%);  }';
		echo '.btn-primary:active { color: #000; background-color: #e8e8e8; border-color: #c5c4c2; }';
		echo '.text-primary { color: #333 !important; }';
		echo '.nav-link { color: #333333; }';
		echo '.navbar-nav .nav-item .nav-link.active, .navbar-nav .nav-item .nav-link:hover { color: #333333; }';
		echo '</style>';
	} else if($colorTheme == "whiteandblack") {
		echo '<style type="text/css" id="whiteandblack-css">';
		echo '.btn-primary { color: #000;background-color: #fff;border-color: #000; }';
		echo '.btn-primary:hover { color: #fff;background-color: #000;border-color: #fff; }';
		echo '.btn-primary:focus { box-shadow: 0 0 0 0.25rem rgb(130 130 130 / 50%); }';
		echo '.btn-primary:active:focus { color: #fff, background-color: #000; border-color: #000;box-shadow: 0 0 0 0.25rem rgb(130 130 130 / 50%);  }';
		echo '.btn-primary:active { color: #fff; background-color: #333; border-color: #fff; }';
		echo '.text-primary { color: #333 !important; }';
		echo '.nav-link { color: #333333; }';
		echo '.navbar-nav .nav-item .nav-link.active, .navbar-nav .nav-item .nav-link:hover { color: #333333; }';
		echo '</style>';
	}
}
add_action( 'wp_head', 'custom_color_theme_output');

// Customizer additions.
/*
require get_template_directory() . '/classes/class-cr-customize.php';
new CR_Customize();
*/

?>