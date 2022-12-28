<?php
/**
 * Customizer settings for CR theme.
 *
 * @package WordPress
 * @subpackage CodingRock
 * @since CodingRock Theme 1.0
 */

if ( ! class_exists( 'CR_Customize' ) ) {
	/**
	 * Customizer Settings.
	 *
	 * @since CodingRock 1.0
	 */
	class CR_Customize {
		/**
		 * Constructor. Instantiate the object.
		 *
		 * @since CodingRock 1.0
		 */
		public function __construct() {
			add_action( 'customize_register', [ $this, 'register' ] );
            add_action( 'wp_head', [ $this, 'custom_color_theme_output'] );
		}

		/**
		 * Register customizer options.
		 *
		 * @since CodingRock Theme 1.0
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 * @return void
		 */
		public function register( $wp_customize ) {
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

        /**
         * 
         *	Retrieves Theme Footer Value
         *
         */
        public function custom_footer_output() {
            return get_theme_mod( 'footer_text', 'Copyright © '.date('Y').' Distributed By CodingRock - Made with WP' );
        }

        /**
         * 
         *	Retrieve Theme Header Logo Value
         *
         */
        public function custom_logo_output() {
            echo 'aaa';echo '<pre>';var_dump($wp_customize->get_setting('logo_image'));exit();
            return get_theme_mod( 'logo_image', '' );
        }

        /**
         *
         *	Retrieve Color Theme Value
         *
         */
        public function custom_color_theme_output() {
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
    }
}