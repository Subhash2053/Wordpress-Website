<?php
/**
 * ParallaxSome Theme Customizer for Additonal Settings Panel.
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

if( ! function_exists( 'parallaxsome_additional_panel_register' ) ):
	function parallaxsome_additional_panel_register( $wp_customize ) {

		/**
		 * Additional Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'parallaxsome_additional_settings_panel', 
	        	array(
	        		'priority'       => 25,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'Additional Settings', 'parallaxsome-pro' ),
	            ) 
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Social Icons Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'social_icons_section',
	        array(
	            'title'		=> esc_html__( 'Social Icons', 'parallaxsome-pro' ),
	            'panel'     => 'parallaxsome_additional_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    /**
	     * Social icons field
	     *
	     * @since 1.0.0
	     */
	    $ap_social_icons_name = array( 
	    							'fb_link' => esc_html__( 'Facebook', 'parallaxsome-pro' ),
	    							'tw_link' => esc_html__( 'Twitter', 'parallaxsome-pro' ),
	    							'ln_link' => esc_html__( 'Linkedin', 'parallaxsome-pro' ),
	    							'pin_link' => esc_html__( 'Pinterest', 'parallaxsome-pro' ),
	    							'gp_link' => esc_html__( 'Google Plus', 'parallaxsome-pro' ),
	    							'yt_link' => esc_html__( 'Youtube', 'parallaxsome-pro' ),
	    						);
	    $count = 3;
	    foreach ( $ap_social_icons_name as $icon_key => $icon_name ) {
	    	$wp_customize->add_setting(
		        $icon_key,
		            array(
		                'default' => '',
		                'sanitize_callback' => 'esc_url_raw',
		                'transport' => 'postMessage'
			       )
		    );    
		    $wp_customize->add_control(
		        $icon_key,
		            array(
		            'type' => 'text',
		            'label' => $icon_name,
		            'section' => 'social_icons_section',
		            'priority' => $count
		            )
		    );
		    $count++;
	    }
	    

	} //close fucntion
endif;

add_action( 'customize_register', 'parallaxsome_additional_panel_register' );