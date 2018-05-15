<?php
/**
 * ParallaxSome Theme Customizer for General Settings Panel.
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

if( ! function_exists( 'parallaxsome_general_panel_register' ) ):
	function parallaxsome_general_panel_register( $wp_customize ) {

		$wp_customize->get_section( 'title_tagline' )->panel = 'parallaxsome_general_settings_panel';
    	$wp_customize->get_section( 'title_tagline' )->priority = '5';
    	$wp_customize->get_section( 'background_image' )->panel = 'parallaxsome_general_settings_panel';
    	$wp_customize->get_section( 'background_image' )->priority = '10';
    	$wp_customize->get_section( 'colors' )->panel = 'parallaxsome_general_settings_panel';
        $wp_customize->get_section( 'colors' )->priority = '15';
        $wp_customize->get_section( 'static_front_page' )->panel = 'parallaxsome_general_settings_panel';
    	$wp_customize->get_section( 'static_front_page' )->priority = '20';        

		/**
		 * General Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'parallaxsome_general_settings_panel', 
	        	array(
	        		'priority'       => 5,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'General Settings', 'parallaxsome-pro' ),
	            ) 
	    );

    /** Template Color **/
		$wp_customize->add_section(
	        'parallaxsome_tpl_color_section',
	        array(
	            'title' => esc_html__('Template Color','parallaxsome-pro'),
	            'priority' => 5,
	            'capability' => 'edit_theme_options',
	            'theme_support' => '',
	            'panel' => 'parallaxsome_general_settings_panel'
	        )
	    );

	    $wp_customize->add_setting(
	        'parallaxsome_tpl_color',
		        array(
		            'default' => '#E5623B',
		            'sanitize_callback' => 'sanitize_hex_color',
		        )
	    );

	    $wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'parallaxsome_tpl_color', 
			array(
				'label'      => esc_html__( 'Select Template color for your site', 'parallaxsome-pro' ),
				'section'    => 'parallaxsome_tpl_color_section',
				'settings'   => 'parallaxsome_tpl_color',
			) ) 
		);
        
    /** pre Loader **/
        $wp_customize->add_section(
            'parallaxsome_preloader_section',
            array(
                'title' => esc_html__('Pre Loader Setting','parallaxsome-pro'),
                'priority' => 5,
                'capability' => 'edit_theme_options',
                'theme_support' => '',
                'panel' => 'parallaxsome_general_settings_panel'
            )
        );
        
        /**
	     * Switch option for Homepage Slider Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'parallaxsome_enable_pre_loader',
		        array(
		            'default' => 'hide',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
            'parallaxsome_enable_pre_loader', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Enable / Disable Pre Loader', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Enable/Disable option for Pre Loader.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_preloader_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Enable', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Disable', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 3,
	            )
	        )
	    );
        
        $wp_customize->add_setting(
            'parallaxsome_pre_loader', array( 
                'default' => 'loader1',
                'sanitize_callback' => 'sanitize_text_field'
            ));
        
        $wp_customize->add_control( new parallaxsome_Ploader_Control( 
            $wp_customize, 'parallaxsome_pre_loader', array(
                'label' => esc_html__( 'Preloader Icon', 'parallaxsome-pro' ),
                'section' => 'parallaxsome_preloader_section',
                'settings' => 'parallaxsome_pre_loader',
                'priority'=>4,
            )) );

	} //close fucntion
endif;

add_action( 'customize_register', 'parallaxsome_general_panel_register' );