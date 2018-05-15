<?php
/**
 * ParallaxSome Theme Customizer for header panel.
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

if( ! function_exists( 'parallaxsome_header_panel_register' ) ):
	function parallaxsome_header_panel_register( $wp_customize ) {

		$wp_customize->get_section( 'header_image' )->panel = 'parallaxsome_header_settings_panel';
		$wp_customize->get_section( 'header_image' )->title = esc_html__( 'Innerpages Header Image', 'parallaxsome-pro' );
    	$wp_customize->get_section( 'header_image' )->priority = '25';

    	global $parallaxsome_single_menu_fields;

		/**
		 * Header Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'parallaxsome_header_settings_panel', 
	        	array(
	        		'priority'       => 10,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'Header Settings', 'parallaxsome-pro' ),
	            ) 
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Top Header Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'top_header_section',
	        array(
	            'title'		=> esc_html__( 'Top Header Settings', 'parallaxsome-pro' ),
	            'panel'     => 'parallaxsome_header_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    /**
	     * Switch option for Top Header Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'top_header_option',
	        array(
	            'default' => 'hide',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'top_header_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Top Header Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Top Header Section.', 'parallaxsome-pro' ),
	                'section' 	=> 'top_header_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );

	    /**
	     * Switch option for social icons at top header section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'top_header_social_option',
	        array(
	            'default' => 'show',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'top_header_social_option', 
	            array(
	                'type' 		=> 'switch',
	                'label' 	=> esc_html__( 'Social Icons Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Top Header Social Icon Section.', 'parallaxsome-pro' ),
	                'section' 	=> 'top_header_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 10,
	            )
	        )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Menu Settings Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'menu_settings_section',
	        array(
	            'title'		=> esc_html__( 'Menu Settings', 'parallaxsome-pro' ),
	            'panel'     => 'parallaxsome_header_settings_panel',
	            'priority'  => 15,
	        )
	    );

	    /**
	     * Switch option for primary menu
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'primary_menu_type',
	        array(
	            'default' => 'parallax',
	            'sanitize_callback' => 'parallaxsome_sanitize_menu_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'primary_menu_type', 
	            array(
	                'type' 		=> 'switch',
	                'label' 	=> esc_html__( 'Primary Menu Type', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Please Disable Primery menu first to enable parallax menu', 'parallaxsome-pro' ),
	                'section' 	=> 'menu_settings_section',
	                'choices'   => array(
	                    'parallax' 	=> esc_html__( 'Parallax', 'parallaxsome-pro' ),
	                    'default' 	=> esc_html__( 'Default', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );

	    /**
	     * Switch option for parallax menu layout
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'parallax_menu_type',
	        array(
	            'default' => 'default',
	            'sanitize_callback' => 'parallaxsome_sanitize_p_menu_type_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'parallax_menu_type', 
	            array(
	                'type' 		=> 'switch',
	                'label' 	=> esc_html__( 'Parallax Menu Type', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Choose type of Parallax Menu.', 'parallaxsome-pro' ),
	                'section' 	=> 'menu_settings_section',
	                'choices'   => array(
	                    'default' 	=> esc_html__( 'Default', 'parallaxsome-pro' ),
	                    'float' 	=> esc_html__( 'Float Menu', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	                'active_callback' => 'parallaxsome_primary_menu_type_callback'
	            )
	        )
	    );
        /**
	     * Switch option for parallax menu layout
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'menu_background_header',
	        array(
	            'default' => 'transparent',
	            'sanitize_callback' => 'parallaxsome_sanitize_p_menu_background_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'menu_background_header', 
	            array(
	                'type' 		=> 'switch',
	                'label' 	=> esc_html__( 'Menu Background', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Choose Menu Background Transparent or White Background', 'parallaxsome-pro' ),
	                'section' 	=> 'menu_settings_section',
	                'choices'   => array(
	                    'transparent' 	=> esc_html__( 'Transparent', 'parallaxsome-pro' ),
	                    'white' 	=> esc_html__( 'White', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,	                
	            )
	        )
	    );
     
        
        /**
	     * Switch option for Homepage Slider Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'enable_hidden_sidebar_right',
		        array(
		            'default' => 'hide',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
            'enable_hidden_sidebar_right', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Hidden Sidebar', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'This hidden sidebar featue not available on folating menu.', 'parallaxsome-pro' ),
	                'section' 	=> 'menu_settings_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        $wp_customize->add_setting(
	        'service_icon_sec_separator_menu',
		        array(
		            'default' => '',
		            'sanitize_callback' => 'sanitize_text_field',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Section_Separator(
	        $wp_customize, 
	            'service_icon_sec_separator_menu', 
	            array(
	                'type' 		=> 'parallaxsome_separator',
	                'label' 	=> esc_html__('Menu Text For Parallax Menu','parallaxsome-pro'),
	                'section' 	=> 'menu_settings_section',
	                'priority'  => 6,
	            )	            	
	        )
	    );
        
	    /**
	     * Field for parallax Menu
	     *
	     * @since 1.0.0
	     */
	    $count = 10;
	    foreach ( $parallaxsome_single_menu_fields as $menu_key => $section_value ) {
	    	$wp_customize->add_setting(
		        $menu_key.'_menu_title',
		            array(
		                'default' => $section_value['default'],
		                'sanitize_callback' => 'sanitize_text_field',
		                'transport' => 'postMessage'
			       )
		    );    
		    $wp_customize->add_control(
		        $menu_key.'_menu_title',
		            array(
		            'type' => 'text',
		            'label' => $section_value['label'],
		            'section' => 'menu_settings_section',
		            'priority' => $count,
		            'active_callback' => 'parallaxsome_primary_menu_type_callback'
		            )
		    );
		    $count++;
	    }

	    /**
	     * Switch option for search icon in primary section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'primary_menu_search_option',
	        array(
	            'default' => 'show',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'primary_menu_search_option', 
	            array(
	                'type' 		=> 'switch',
	                'label' 	=> esc_html__( 'Search Icon', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide search icons on primary menu section.', 'parallaxsome-pro' ),
	                'section' 	=> 'menu_settings_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 35,
	            )
	        )
	    );

	    /**
	     * Switch option for sticky menu
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'sticky_header_option',
	        array(
	            'default' => 'enable',
	            'sanitize_callback' => 'parallaxsome_sanitize_enable_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'sticky_header_option', 
	            array(
	                'type' 		=> 'switch',
	                'label' 	=> esc_html__( 'Header Sticky', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Enable/disable option for header sticky.', 'parallaxsome-pro' ),
	                'section' 	=> 'menu_settings_section',
	                'choices'   => array(
	                    'enable' 	=> esc_html__( 'Enable', 'parallaxsome-pro' ),
	                    'disable' 	=> esc_html__( 'Disable', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 40,
	            )
	        )
	    );


    /** Menu Order Section **/
    	$wp_customize->add_section(
	        'menu_order_section',
	        array(
	            'title'		=> esc_html__( 'Parallax Menu Order', 'parallaxsome-pro' ),
	            'panel'     => 'parallaxsome_header_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    // Parallax Menu Order
        $wp_customize->add_setting(
            'parallaxsome_plx_menu_orders',
            array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field'
                )
        );

        global $parallaxsome_plx_menu;
        $wp_customize->add_control( new parallaxsome_Section_Re_Order_Menu( $wp_customize, 'parallaxsome_plx_menu_orders',
            array(
                'type' => 'dragndrop',
                'setting' => 'parallaxsome_plx_menu_orders',
                'priority'  => 3,
                'label' => esc_html__( 'Menu Re-order', 'parallaxsome-pro' ),
                'description' => esc_html__( 'Menu Re-order by using Drag and Drop', 'parallaxsome-pro' ),
                'section' => 'menu_order_section',
                'choices' => $parallaxsome_plx_menu
            ))
        );


	} //close fucntion
endif;
add_action( 'customize_register', 'parallaxsome_header_panel_register' );