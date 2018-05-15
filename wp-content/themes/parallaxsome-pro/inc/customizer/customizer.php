<?php
/**
 * ParallaxSome Theme Customizer.
 *
 * @package AccessPress Themes
 * @subpackage ParallaxSome
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function parallaxsome_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /**
		 * Theme Info section
		 */
		$wp_customize->add_section(
	        'parallaxsome_theme_info_section',
	        array(
	            'title'		=> esc_html__( 'Theme Info', 'parallaxsome-pro' ),
	            'priority'  => 1,
	        )
	    );

        function parallaxsome_layout_active_one($control){
            if($control->manager->get_setting('about_section_layout')->value() == 'layout-1'){
                return true;
            }else{
                return false;
            }
        }
        function parallaxsome_layout_active_two($control){
            if($control->manager->get_setting('about_section_layout')->value() == 'layout-2'){
                return true;
            }else{
                return false;
            }
        }
        function parallaxsome_layout_active_one_team($control){
            if($control->manager->get_setting('team_section_layout')->value() == 'layout-1'){
                return true;
            }else{
                return false;
            }
        }
        function parallaxsome_layout_active_one_portfolio($control){
            if($control->manager->get_setting('portfolio_section_layout')->value() == 'layout-1'){
                return true;
            }else{
                return false;
            }
        }
}
add_action( 'customize_register', 'parallaxsome_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function parallaxsome_customize_preview_js() {
	wp_enqueue_script( 'parallaxsome_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20160714', true );
}
add_action( 'customize_preview_init', 'parallaxsome_customize_preview_js' );

/**
 *
 */
function parallaxsome_customize_backend_scripts() {
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'parallaxsome_admin_customizer_style', get_template_directory_uri() . '/inc/customizer/css/customizer-style.css' );
	wp_enqueue_script( 'parallaxsome_admin_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer-scripts.js', array( 'jquery', 'customize-controls' ), '20160714', true );
}
add_action( 'customize_controls_enqueue_scripts', 'parallaxsome_customize_backend_scripts', 10 );