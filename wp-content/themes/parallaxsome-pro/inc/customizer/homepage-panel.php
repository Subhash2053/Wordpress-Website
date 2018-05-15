<?php
/**
 * ParallaxSome Theme Customizer for homepage panel.
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

if( ! function_exists( 'parallaxsome_homepage_panel_register' ) ):
	function parallaxsome_homepage_panel_register( $wp_customize ) {
	   $parallaxsome_post_lists = parallaxsome_post_lists();
       $parallaxsome_Category_list = parallaxsome_Category_list();
       $parallaxsome_section_re_order_list = array(
        'about' => esc_html__('About Section','parallaxsome-pro') ,
        'feature' => esc_html__('Feature Section','parallaxsome-pro') ,
        'team' => esc_html__('Team Section','parallaxsome-pro'),
        'booking' => esc_html__('Booking Section','parallaxsome-pro'),
        'cta' => esc_html__('Call To Action','parallaxsome-pro'),
        'services' => esc_html__('Service Countdown','parallaxsome-pro'),
        'testimonials' => esc_html__('Testimonial Section','parallaxsome-pro'),
        'fact' => esc_html__('Fact Section','parallaxsome-pro'),
        'portfolio' => esc_html__('Portfolio Section','parallaxsome-pro'),
        'quicklink' => esc_html__('Quick Link Section','parallaxsome-pro'),
        'faq' => esc_html__('FAQ Section','parallaxsome-pro'),
        'pricing' => esc_html__('Pricing Section','parallaxsome-pro'),
        'skill' => esc_html__('Skill Section','parallaxsome-pro'),
        'item' => esc_html__('Item Section','parallaxsome-pro'),
        'video' => esc_html__('Video Section','parallaxsome-pro'),
        'blog'=> esc_html__('Blog Section','parallaxsome-pro'),
        'clients' => esc_html__('Client Section','parallaxsome-pro'),
        'contact' => esc_html__('Contact Schedule','parallaxsome-pro'),
        
    );
		/**
		 * HomePage Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'parallaxsome_homepage_settings_panel', 
	        	array(
	        		'priority'       => 15,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'HomePage Settings', 'parallaxsome-pro' ),
	            ) 
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Slider Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_slider_section',
		        array(
		            'title'		=> esc_html__( 'Slider Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 5,
		        )
	    );

	    /**
	     * Switch option for Homepage Slider Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_slider_option',
		        array(
		            'default' => 'hide',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
            'homepage_slider_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Slider Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for homepage Slider Section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_slider_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );

	    /**
	     * Switch option for Displaying Either Revolution Slider or Category Slider
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_slider_type',
		        array(
		            'default' => 'default',
		            'sanitize_callback' => 'sanitize_text_field',
		        )
	    );

	    $wp_customize->add_control( 'homepage_slider_type', array(
	    	'type' => 'select',
	    	'label' 	=> esc_html__( 'Slider Type', 'parallaxsome-pro' ),
	    	'description' 	=> esc_html__( 'Select the type of slider you wish to display.', 'parallaxsome-pro' ),
	    	'section' 	=> 'parallaxsome_slider_section',
	    	'choices' => array(
			    'default' => __( 'Default', 'parallaxsome-pro' ),
			    'revolution' => __( 'Revolution', 'parallaxsome-pro' ),
		  	),
    	));

	    /**
	     * Dropdown available category for homepage slider
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'slider_cat_id',
		        array(
		            'default' => '0',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_text_field'
		        )
	    );

	    $wp_customize->add_control( new Parallaxsome_Customize_Category_Control(
	        $wp_customize,
	        'slider_cat_id', 
		        array(
		            'label' => esc_html__( 'Slider Category', 'parallaxsome-pro' ),
		            'description' => esc_html__( 'Select cateogry for Homepage Slider Section', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_slider_section',
		            'active_callback' => 'parallaxsome_is_default_slider',
		            'priority' => 10
		        )
		    )
	    );

	    /** Active Callback for default slider **/
	    function parallaxsome_is_default_slider( $control ) {
	        if ( 'default' == $control->manager->get_setting( 'homepage_slider_type' )->value() ) {
	            return true;
	        } else {
	            return false;
	        }
	    }

	    /**
	     * Shortcode Option for Revolution Slider
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'parallaxsome_revslider_scode',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_text_field'
		        )
	    );

	    $wp_customize->add_control( 'parallaxsome_revslider_scode', array(
	    	'type' => 'text',
	    	'label' 	=> esc_html__( 'Slider Shortcode', 'parallaxsome-pro' ),
	    	'description' 	=> esc_html__( 'Enter the Shortcode for the Revolution Slider.', 'parallaxsome-pro' ),
	    	'section' 	=> 'parallaxsome_slider_section',
	    	'active_callback' => 'parallaxsome_is_revolution_slider',
    	));

	    /** Active Callback for default slider **/
	    function parallaxsome_is_revolution_slider( $control ) {
	        if ( 'revolution' == $control->manager->get_setting( 'homepage_slider_type' )->value() ) {
	            return true;
	        } else {
	            return false;
	        }
	    }

/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * About Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_about_section',
		        array(
		            'title'		=> esc_html__( 'About Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 10,
		        )
	    );

	    /**
	     * Switch option for Homepage About Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_about_option',
		        array(
		            'default' => 'show',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_about_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage About Section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_about_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        /**
	     * Section Layout
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'about_section_layout', 
	            array(
	                'default' => 'layout-1',
	                'sanitize_callback' => 'sanitize_text_field',
		       	)
	    );
	    $wp_customize->add_control(
	        'about_section_layout',
	            array(
		            'type' => 'radio',
		            'label' => esc_html__( 'About Section Layout', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_about_section',
		            'priority' => 6,
                    'choices' => array(
                        'layout-1' => esc_html__('Layout One','parallaxsome-pro'),
                        'layout-2' => esc_html__('Layout Two','parallaxsome-pro'),
                    )
	            )
	    );
        
	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'about_section_title', 
	            array(
	                'default' => esc_html__( 'About', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'about_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_about_section',
		            'priority' => 10,
                    'active_callback' => 'parallaxsome_layout_active_one'
	            )
	    );

	    /**
	     * Field for section sub title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'about_section_sub_title', 
	            array(
	                'default' => esc_html__( 'Who We Are', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'about_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_about_section',
		            'priority' => 15,
                    'active_callback' => 'parallaxsome_layout_active_one'
	            )
	    );

	    /**
	     * Dropdown available pages for homepage about section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'about_page_id',
		        array(
		            'default' => '0',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'absint'
		        )
	    );
	    $wp_customize->add_control(
	        'about_page_id', 
		        array(
		        	'type' => 'dropdown-pages',
		            'label' => esc_html__( 'About us Page', 'parallaxsome-pro' ),
		            'description' => esc_html__( 'Select page for Homepage About Section', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_about_section',
		            'priority' => 20
		        )
	    );
        
        /**
	     * Read More Text
	     *
	     * @since 1.0.0
	     */
        $wp_customize->add_setting(
	        'about_section_readmore_text', 
	            array(
	                'default' => esc_html__( 'Get Started', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'about_section_readmore_text',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Button Text', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_about_section',
		            'priority' => 21,
                    'active_callback' => 'parallaxsome_layout_active_two'
	            )
	    );
        
	    /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'about_section_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'about_section_image',
	        	array(
	            	'label'      => esc_html__( 'Section Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_about_section',
	               	'priority' => 25
	           	)
	       	)
	   	);
/*--------------------------------------------------------------------------------------------------------------*/        
        /**
		 * Feature Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_feature_section',
		        array(
		            'title'		=> esc_html__( 'Feature Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 12,
		        )
	    );
        /**
	     * Switch option for Homepage Feature Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_feature_option',
		        array(
		            'default' => 'hide',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_feature_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Feature Section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_feature_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'feature_section_title', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'feature_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_feature_section',
		            'priority' => 10,
	            )
	    );
     /**
     * parallaxsome Features
     */
    $wp_customize->add_setting( 'parallaxsome_all_features_section', array(
	    'sanitize_callback' => 'parallaxsome_sanitize_repeater',
	    'default' => json_encode(
	     	array(
	         	array(
		            'features_icon' => 'fa fa-music' ,
		            'features_page' => '' 
	            )
	     	)
	    )
	));

	$wp_customize->add_control(  new parallaxsome_Repeater_Controler( $wp_customize, 'parallaxsome_all_features_section', 
        array(
            'label'   => esc_html__('Manage Features Section','parallaxsome-pro'),
            'section' => 'parallaxsome_feature_section',
            'settings' => 'parallaxsome_all_features_section',
            'parallaxsome_box_label' => esc_html__('Our Features Section','parallaxsome-pro'),
            'parallaxsome_box_add_control' => esc_html__('Add Features','parallaxsome-pro'),
        ),
        	array(
	        	'features_icon' => array(
	            'type'        => 'icon',
	            'label'       => esc_html__( 'Select Features Icon', 'parallaxsome-pro' ),
	            'default'     => 'fa fa-music',
	            'class'       => 'un-bottom-block-cat1'
	        ),
	        'features_page' => array(
	            'type'        => 'select',
	            'label'       => esc_html__( 'Select Features Posts', 'parallaxsome-pro' ),
	            'options'     => $parallaxsome_post_lists,
	            'class'       => 'un-bottom-block-cat1'
	        )
        )
	));
    
    /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'feature_section_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'feature_section_image',
	        	array(
	            	'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_feature_section',
	               	'priority' => 25
	           	)
	       	)
	   	);
     
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Our Team Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_team_section',
		        array(
		            'title'		=> esc_html__( 'Our Team Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 15,
		        )
	    );

	    /**
	     * Switch option for Homepage Our Team Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_team_option',
		        array(
		            'default' => 'show',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_team_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Our Team Section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_team_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        /**
	     * Section Layout
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'team_section_layout', 
	            array(
	                'default' => 'layout-1',
	                'sanitize_callback' => 'sanitize_text_field',
		       	)
	    );
	    $wp_customize->add_control(
	        'team_section_layout',
	            array(
		            'type' => 'radio',
		            'label' => esc_html__( 'Team Section Layout', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_team_section',
		            'priority' => 6,
                    'choices' => array(
                        'layout-1' => esc_html__('Layout One','parallaxsome-pro'),
                        'layout-2' => esc_html__('Layout Two','parallaxsome-pro'),
                    ),
	            )
	    );
	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'team_section_title', 
	            array(
	                'default' => esc_html__( 'Our Team', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'team_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_team_section',
		            'priority' => 10
	            )
	    );

	    /**
	     * Field for section sub title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'team_section_sub_title', 
	            array(
	                'default' => esc_html__( 'Group Together', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'team_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_team_section',
		            'priority' => 15,
                    'active_callback' => 'parallaxsome_layout_active_one_team'
	            )
	    );

	    /**
	     * Field for section description
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'team_section_description', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );    
	    $wp_customize->add_control(
	        'team_section_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_team_section',
		            'priority' => 20
	            )
	    );

	    /**
	     * Field for view all button text
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'team_view_more_txt', 
	            array(
	                'default' => esc_html__( 'View All', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'team_view_more_txt',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'View All Button', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_team_section',
		            'priority' => 30
	            )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Our booking Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_booking_section',
		        array(
		            'title'		=> esc_html__( 'Our Booking Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 15,
		        )
	    );

	    /**
	     * Switch option for Homepage Our booking Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_booking_option',
		        array(
		            'default' => 'show',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_booking_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Our Booking Section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_booking_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'booking_section_title', 
	            array(
	                'default' => esc_html__( 'Our Booking', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'booking_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_booking_section',
		            'priority' => 10
	            )
	    );

	    /**
	     * Field for section sub title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'booking_section_sub_title', 
	            array(
	                'default' => esc_html__( 'Group Together', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'booking_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_booking_section',
		            'priority' => 15,
	            )
	    );

	    /**
	     * Field for section description
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'booking_section_description', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );    
	    $wp_customize->add_control(
	        'booking_section_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_booking_section',
		            'priority' => 20
	            )
	    );
        /**
	     * Field for section sub title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'booking_section_phone_number', 
	            array(
	                'default' =>'',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'booking_section_phone_number',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Phone Number', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_booking_section',
		            'priority' => 21,
	            )
	    );
        
        $wp_customize->add_setting( 'booking_section_form_page', array(
			'default'           => '',
			'sanitize_callback' => 'absint'
		) );

		$wp_customize->add_control( 'booking_section_form_page', array(
			'label'       => esc_html__( 'Booking Form Page', 'parallaxsome-pro' ),
			'section'     => 'parallaxsome_booking_section',
			'priority'	  =>30,
			'type'     => 'dropdown-pages'
		) );
        
        $wp_customize->add_setting(
	        'booking_section_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'booking_section_image',
	        	array(
	            	'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_booking_section',
	               	'priority' => 35
	           	)
	       	)
	   	);
/*--------------------------------------------------------------------------------------------------------------*/
        /**
		 * Our Call To Action Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_cta_section',
		        array(
		            'title'		=> esc_html__( 'Call To Action Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 16,
		        )
	    );
        /**
	     * Switch option for Homepage Our CTA Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_cta_option',
		        array(
		            'default' => 'hide',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_cta_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Our Call To Action Section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_cta_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 1,
	            )
	        )
	    );
        /**
	     * CTA Title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'cta_title', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'cta_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Call To Action Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_cta_section',
		            'priority' => 3
	            )
	    );
        /**
	     * CTA Section Description
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'cta_section_description', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'cta_section_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Call To Action Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_cta_section',
		            'priority' => 3
	            )
	    );
        /**
	     * CTA Button One Text
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'cta_button_one_text', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'cta_button_one_text',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Call To Action Section Button One Text', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_cta_section',
		            'priority' => 5
	            )
	    );
        /**
	     * CTA Button One Link
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'cta_button_one_link', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'esc_url_raw',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'cta_button_one_link',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Call To Action Section Button One Link', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_cta_section',
		            'priority' => 7
	            )
	    );
        /**
	     * CTA Button Two Text
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'cta_button_two_text', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'cta_button_two_text',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Call To Action Section Button Two Text', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_cta_section',
		            'priority' => 9
	            )
	    );
        /**
	     * CTA Button Two Link
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'cta_button_two_link', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'esc_url_raw',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'cta_button_two_link',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Call To Action Section Button Two Link', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_cta_section',
		            'priority' => 10
	            )
	    );
        /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'cta_section_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'cta_section_image',
	        	array(
	            	'label'      => esc_html__( 'Section Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_cta_section',
	               	'priority' => 25
	           	)
	       	)
	   	);
        
        /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'cta_section_bg_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'cta_section_bg_image',
	        	array(
	            	'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_cta_section',
	               	'priority' => 25
	           	)
	       	)
	   	);
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Our Services Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_services_section',
		        array(
		            'title'		=> esc_html__( 'Our Services Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 20,
		        )
	    );

	    /**
	     * Switch option for Homepage Service Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_service_option',
		        array(
		            'default' => 'show',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_service_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Our Services Section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_services_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        
	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'services_section_title', 
	            array(
	                'default' => esc_html__( 'Our Services', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'services_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_services_section',
		            'priority' => 10
	            )
	    );

	    /**
	     * Field for section sub title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'services_section_sub_title', 
	            array(
	                'default' => esc_html__( 'Our Works', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'services_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_services_section',
		            'priority' => 15
	            )
	    );

	    /**
	     * Field for section description
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'services_section_description', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );    
	    $wp_customize->add_control(
	        'services_section_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_services_section',
		            'priority' => 20
	            )
	    );

	    /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'service_bg_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'service_bg_image',
	        	array(
	            	'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_services_section',
	               	'priority' => 25
	           	)
	       	)
	   	);

	$service_priority = 30;
    $parallaxsome_default_service_icon = array( 'fa-flag', 'fa-database', 'fa-codepen', 'fa-hand-o-left', 'fa-coffee' );
    $prarallaxsome_separator_label = array( 'First', 'Second', 'Third', 'Forth', 'Fifth' );
    
    foreach ( $parallaxsome_default_service_icon as $icon_key => $icon_value ) {    	
		
	    /**
	     * Section separator
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'service_icon_sec_separator_'.$icon_key,
		        array(
		            'default' => '',
		            'sanitize_callback' => 'sanitize_text_field',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Section_Separator(
	        $wp_customize, 
	            'service_icon_sec_separator_'.$icon_key, 
	            array(
	                'type' 		=> 'parallaxsome_separator',
	                'label' 	=> sprintf(esc_html__( '%s Service', 'parallaxsome-pro' ), $prarallaxsome_separator_label[$icon_key] ),
	                'section' 	=> 'parallaxsome_services_section',
	                'priority'  => $service_priority,
	            )	            	
	        )
	    );

	    /**
	     * Icon list for service tab
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'service_icon_'.$icon_key,
		        array(
		            'default' => $icon_value,
		            'sanitize_callback' => 'sanitize_text_field',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Icons_Control(
	        $wp_customize, 
	        'service_icon_'.$icon_key, 
	            array(
	                'type' 		=> 'parallaxsome_icons',	                
	                'label' 	=> esc_html__( 'Service Icon', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Choose the icon from lists.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_services_section',
	                'priority'  => $service_priority,
	            )	            	
	        )
	    );

	    /**
	     * Dropdown available pages for homepage about section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'service_page_id_'.$icon_key,
		        array(
		            'default' => '0',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'absint'
		        )
	    );
	    $wp_customize->add_control(
	        'service_page_id_'.$icon_key,
		        array(
		        	'type' => 'dropdown-pages',
		            'label' => esc_html__( 'Service Page', 'parallaxsome-pro' ),
		            'description' => esc_html__( 'Select page for Homepage Service Section', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_services_section',
		            'priority' => $service_priority
		        )
	    );
	    $service_priority = $service_priority+5;
	}


/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Testimonials Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_testimonials_section',
		        array(
		            'title'		=> esc_html__( 'Testimonials Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 25,
		        )
	    );

	    /**
	     * Switch option for Homepage Testimonials Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_testimonials_option',
	        	array(
		            'default' => 'show',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	        'homepage_testimonials_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Testimonials Section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_testimonials_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'testimonials_section_title', 
	            array(
	                'default' => esc_html__( 'Clients Say', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'testimonials_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_testimonials_section',
		            'priority' => 10
	            )
	    );
        
        /**
	     * Section Layout
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'testimonial_section_layout', 
	            array(
	                'default' => 'layout-1',
	                'sanitize_callback' => 'sanitize_text_field',
		       	)
	    );
	    $wp_customize->add_control(
	        'testimonial_section_layout',
	            array(
		            'type' => 'radio',
		            'label' => esc_html__( 'Testimonial Section Layout', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_testimonials_section',
		            'priority' => 6,
                    'choices' => array(
                        'layout-1' => esc_html__('Layout One','parallaxsome-pro'),
                        'layout-2' => esc_html__('Layout Two','parallaxsome-pro'),
                    )
	            )
	    );

	    /**
	     * Field for section sub title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'testimonials_section_sub_title', 
	            array(
	                'default' => esc_html__( 'Group Together', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'testimonials_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_testimonials_section',
		            'priority' => 15
	            )
	    );

	    /**
	     * Dropdown available category for homepage Testimonials
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'testimonials_cat_id',
		        array(
		            'default' => '0',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_text_field'
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Category_Control(
	        $wp_customize,
	        'testimonials_cat_id', 
		        array(
		            'label' => esc_html__( 'Section Category', 'parallaxsome-pro' ),
		            'description' => esc_html__( 'Select cateogry for Homepage Testimonials Section', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_testimonials_section',
		            'priority' => 20
	            )
	        )
	    );
        
        $wp_customize->add_setting(
	        'testimonial_section_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'testimonial_section_image',
	        	array(
	            	'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_testimonials_section',
	               	'priority' => 25
	           	)
	       	)
	   	);
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Our Fact Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_fact_section',
		        array(
		            'title'		=> esc_html__( 'Our Facts Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 30,
		        )
	    );

	    /**
	     * Switch option for Homepage Our Fact Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_fact_option',
		        array(
		            'default' => 'show',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_fact_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Our Facts.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_fact_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        /**
	     * Section Layout
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'fact_section_layout', 
	            array(
	                'default' => 'layout-1',
	                'sanitize_callback' => 'sanitize_text_field',
		       	)
	    );
	    $wp_customize->add_control(
	        'fact_section_layout',
	            array(
		            'type' => 'radio',
		            'label' => esc_html__( 'Fact Section Layout', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_fact_section',
		            'priority' => 6,
                    'choices' => array(
                        'layout-1' => esc_html__('Layout One','parallaxsome-pro'),
                        'layout-2' => esc_html__('Layout Two','parallaxsome-pro'),
                    )
	            )
	    );
        
	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'fact_section_title', 
	            array(
	                'default' => esc_html__( 'Fact About Us', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'fact_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_fact_section',
		            'priority' => 10
	            )
	    );

	    /**
	     * Field for section sub-title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'fact_section_sub_title', 
	            array(
	                'default' => esc_html__( 'Our Works', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'fact_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_fact_section',
		            'priority' => 15
	            )
	    );

	    /**
	     * Field for section description
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'fact_section_description', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );    
	    $wp_customize->add_control(
	        'fact_section_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_fact_section',
		            'priority' => 20
	            )
	    );

	    /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'fact_bg_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'fact_bg_image',
	        	array(
	            	'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_fact_section',
	               	'priority' => 25
	           	)
	       	)
	   	);

		$fact_priority = 30;
		$prarallaxsome_separator_label = array( 'First', 'Second', 'Third', 'Forth' );
		$parallaxsome_default_fact_icon = array( 'fa-coffee', 'fa-rocket', 'fa-code', 'fa-thumbs-o-up' );
		$parallaxsome_default_fact_title = array( 'Cups Consumed', 'Projects Lunched', 'Lines of Code', 'Satisfied Clients' );
		$parallaxsome_default_fact_number = array( '798', '237', '54871', '25084' );
	foreach ( $parallaxsome_default_fact_icon as $icon_key => $icon_value ) {
		
	    /**
	     * Section separator
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'fact_icon_sec_separator_'.$icon_key,
		        array(
		            'default' => '',
		            'sanitize_callback' => 'sanitize_text_field',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Section_Separator(
	        $wp_customize, 
	            'fact_icon_sec_separator_'.$icon_key, 
	            array(
	                'type' 		=> 'parallaxsome_separator',
	                'label' 	=> sprintf(esc_html__( '%s Fact Counter', 'parallaxsome-pro' ), $prarallaxsome_separator_label[$icon_key] ),
	                'section' 	=> 'parallaxsome_fact_section',
	                'priority'  => $fact_priority,
	            )	            	
	        )
	    );


	    /**
	     * Icon list for fact counter
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'fact_icon_'.$icon_key,
		        array(
		            'default' => $parallaxsome_default_fact_icon[$icon_key],
		            'sanitize_callback' => 'sanitize_text_field',
		            'transport' => 'postMessage'
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Icons_Control(
	        $wp_customize, 
	            'fact_icon_'.$icon_key, 
	            array(
	                'type' 		=> 'parallaxsome_icons',	                
	                'label' 	=> esc_html__( 'Fact Icon', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Choose the icon from lists.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_fact_section',
	                'priority'  => $fact_priority,
	            )	            	
	        )
	    );

	    /**
	     * Field for counter title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'fact_counter_title_'.$icon_key, 
	            array(
	                'default' => sprintf( esc_html( '%s', 'parallaxsome-pro' ), $parallaxsome_default_fact_title[$icon_key] ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );    
	    $wp_customize->add_control(
	        'fact_counter_title_'.$icon_key,
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Fact Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_fact_section',
		            'priority' => $fact_priority
	            )
	    );

	    /**
	     * Field for counter number
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'fact_counter_number_'.$icon_key, 
	            array(
	            	'default' => $parallaxsome_default_fact_number[$icon_key],
	                'sanitize_callback' => 'parallaxsome_sanitize_number',
	                'transport' => 'postMessage'
		       	)
	    );    
	    $wp_customize->add_control(
	        'fact_counter_number_'.$icon_key,
	            array(
		            'type' => 'number',
		            'label' => esc_html__( 'Fact Number', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_fact_section',
		            'priority' => $fact_priority
	            )
	    );
	    $fact_priority = $fact_priority+5;
	}
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Our Portfolio Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_portfolio_section',
		        array(
		            'title'		=> esc_html__( 'Portfolio Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 35,
		        )
	    );

	    /**
	     * Switch option for Homepage Portfolio Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_portfolio_option',
		        array(
		            'default' => 'show',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	        'homepage_portfolio_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Portfolio section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_portfolio_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        /**
	     * Section Layout
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'portfolio_section_layout', 
	            array(
	                'default' => 'layout-1',
	                'sanitize_callback' => 'sanitize_text_field',
		       	)
	    );
	    $wp_customize->add_control(
	        'portfolio_section_layout',
	            array(
		            'type' => 'radio',
		            'label' => esc_html__( 'Portfolio Section Layout', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_portfolio_section',
		            'priority' => 6,
                    'choices' => array(
                        'layout-1' => esc_html__('Layout One','parallaxsome-pro'),
                        'layout-2' => esc_html__('Layout Two','parallaxsome-pro'),
                    )
	            )
	    );

	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'portfolio_section_title', 
	            array(
	                'default' => esc_html__( 'Portfolio', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'portfolio_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_portfolio_section',
		            'priority' => 10
	            )
	    );

	    /**
	     * Field for section sub-title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'portfolio_section_sub_title', 
	            array(
	                'default' => esc_html__( 'Best Porjects', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'portfolio_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_portfolio_section',
		            'priority' => 15,
                    'active_callback' => 'parallaxsome_layout_active_one_portfolio'
	            )
	    );

	    /**
	     * Field for section description
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'portfolio_section_description',
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );    
	    $wp_customize->add_control(
	        'portfolio_section_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_portfolio_section',
		            'priority' => 20
	            )
	    );

	    /**
	     * Dropdown available category for homepage Testimonials
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'portfolio_cat_id',
	        array(
	            'default' => '0',
	            'capability' => 'edit_theme_options',
	            'sanitize_callback' => 'sanitize_text_field'
	        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Category_Control(
	        $wp_customize,
	        'portfolio_cat_id', 
		        array(
		            'label' => esc_html__( 'Section Category', 'parallaxsome-pro' ),
		            'description' => esc_html__( 'Select cateogry for Homepage Portfolio Section', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_portfolio_section',
		            'priority' => 25
	            )
	        )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
/**
		 * Our Quick Link Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_quick_link_section',
		        array(
		            'title'		=> esc_html__( 'Quick Link Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 35,
		        )
	    );
        
        /**
	     * Switch option for Homepage Quick Link Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_quick_link_option',
	        array(
	            'default' => 'hide',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_quick_link_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Latest Quick Link section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_quick_link_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'quick_link_section_title', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'quick_link_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_quick_link_section',
		            'priority' => 10
	            )
	    );
        
        /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'quick_link_section_subject_title', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'quick_link_section_subject_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Subject Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_quick_link_section',
		            'priority' => 10
	            )
	    );
        /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'quick_link_section_subject_description', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'quick_link_section_subject_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Subject Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_quick_link_section',
		            'priority' => 10
	            )
	    );
        /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'quick_link_section_button_text', 
	            array(
	                'default' => esc_html__( 'Purchase Now', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'quick_link_section_button_text',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Button Text', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_quick_link_section',
		            'priority' => 10
	            )
	    );
        /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'quick_link_section_button_link', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'esc_url_raw',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'quick_link_section_button_link',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Button Link', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_quick_link_section',
		            'priority' => 10
	            )
	    );
        /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'quick_link_section_bg_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'quick_link_section_bg_image',
	        	array(
	            	'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_quick_link_section',
	               	'priority' => 25
	           	)
	       	)
	   	);
        
/*--------------------------------------------------------------------------------------------------------------*/
        /** FAQ Section **/
		$wp_customize->add_section(
	        'parallaxsome_faq_section',
		        array(
		            'title'		=> esc_html__( 'FAQ Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 35,
		        )
	    );
        
        /**
	     * Switch option for Homepage FAQ Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_faq_option',
	        array(
	            'default' => 'hide',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_faq_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_faq_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'faq_section_title', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'faq_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_faq_section',
		            'priority' => 10
	            )
	    );
        
        /**
	     * Field for section Description
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'faq_section_description', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'faq_section_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_faq_section',
		            'priority' => 10
	            )
	    );
        /**
	     * Dropdown available category for homepage FAQ
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'faq_post_category',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'parallaxsome_sanitize_post_cat_list'
		        )
	    );
	    $wp_customize->add_control( 
	        'faq_post_category', 
		        array(
		            'label' => esc_html__( 'FAQ Category', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_faq_section',
                    'type' => 'select',
                    'choices' => $parallaxsome_Category_list,
		            'priority' => 10
		        )
	    );
        /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'faq_section_feature_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'faq_section_feature_image',
	        	array(
	            	'label'      => esc_html__( 'Section Feature Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_faq_section',
	               	'priority' => 25
	           	)
	       	)
	   	);
/*--------------------------------------------------------------------------------------------------------------*/
        /** Pricing Section **/
		$wp_customize->add_section(
	        'parallaxsome_pricing_section',
		        array(
		            'title'		=> esc_html__( 'Pricing Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 35,
		        )
	    );
        
        /**
	     * Switch option for Homepage Pricing Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_pricing_option',
	        array(
	            'default' => 'hide',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_pricing_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_pricing_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'pricing_section_title', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'pricing_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_pricing_section',
		            'priority' => 10
	            )
	    );
        
        /**
	     * Field for section Description
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'pricing_section_description', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'pricing_section_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_pricing_section',
		            'priority' => 10
	            )
	    );
        /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'pricing_section_feature_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'pricing_section_feature_image',
	        	array(
	            	'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_pricing_section',
	               	'priority' => 25
	           	)
	       	)
	   	);
/*--------------------------------------------------------------------------------------------------------------*/
        /** Skill Section **/
		$wp_customize->add_section(
	        'parallaxsome_skill_section',
		        array(
		            'title'		=> esc_html__( 'Skill Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 35,
		        )
	    );
        
        /**
	     * Switch option for Homepage Skill Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_skill_option',
	        array(
	            'default' => 'hide',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_skill_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_skill_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'skill_section_title', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'skill_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_skill_section',
		            'priority' => 10
	            )
	    );
        
        /**
	     * Field for section Description
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'skill_section_description', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'skill_section_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_skill_section',
		            'priority' => 10
	            )
	    );
        
     /**
     * parallaxsome Skill
     */
    $wp_customize->add_setting( 'parallaxsome_skill_bar', array(
	    'sanitize_callback' => 'parallaxsome_sanitize_repeater',
	    'default' => json_encode(
	     	array(
	         	array(
		            'slill_title' => '' ,
		            'skill_percentage' => '' 
	            )
	     	)
	    )
	));

	$wp_customize->add_control(  new parallaxsome_Repeater_Controler( $wp_customize, 'parallaxsome_skill_bar', 
        array(
            'label'   => esc_html__('Skill Bar','parallaxsome-pro'),
            'section' => 'parallaxsome_skill_section',
            'settings' => 'parallaxsome_skill_bar',
            'parallaxsome_box_label' => esc_html__('Skills','parallaxsome-pro'),
            'parallaxsome_box_add_control' => esc_html__('Add Skill','parallaxsome-pro'),
        ),
        	array(
	        	'slill_title' => array(
	            'type'        => 'text',
	            'label'       => esc_html__( 'Skill Bar Title', 'parallaxsome-pro' ),
	            'default'     => '',
	            'class'       => 'un-bottom-block-cat1'
	        ),
	        'skill_percentage' => array(
	            'type'        => 'text',
	            'label'       => esc_html__( 'Sill Percentage', 'parallaxsome-pro' ),
	            'default'     => '',
	            'class'       => 'un-bottom-block-cat1'
	        )
        )
	));
/*--------------------------------------------------------------------------------------------------------------*/
        /** Item Section **/
		$wp_customize->add_section(
	        'parallaxsome_item_section',
		        array(
		            'title'		=> esc_html__( 'Item Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 35,
		        )
	    );
        
        
        /**
	     * Switch option for Homepage Items Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_item_option',
	        array(
	            'default' => 'hide',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_item_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_item_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
     /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'item_section_title', 
	            array(
	                'default' => esc_html__( 'Our Item', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'item_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_item_section',
		            'priority' => 10
	            )
	    );

	    /**
	     * Field for section sub title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'item_section_sub_title', 
	            array(
	                'default' => esc_html__( 'Group Together', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'item_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_item_section',
		            'priority' => 15,
	            )
	    );
        
     /**
     * parallaxsome Items
     */
    $wp_customize->add_setting( 'parallaxsome_our_item_section', array(
	    'sanitize_callback' => 'parallaxsome_sanitize_repeater',
	    'default' => json_encode(
	     	array(
	         	array(
		            'features_icon' => 'fa fa-music' ,
		            'features_page' => '' 
	            )
	     	)
	    )
	));

	$wp_customize->add_control(  new parallaxsome_Repeater_Controler( $wp_customize, 'parallaxsome_our_item_section', 
        array(
            'label'   => esc_html__('Our Items Section','parallaxsome-pro'),
            'section' => 'parallaxsome_item_section',
            'priority' => 20,
            'settings' => 'parallaxsome_our_item_section',
            'parallaxsome_box_label' => esc_html__('Our Item Section','parallaxsome-pro'),
            'parallaxsome_box_add_control' => esc_html__('Add Items','parallaxsome-pro'),
        ),
        	array(
    	        'items_post' => array(
    	            'type'        => 'select',
    	            'label'       => esc_html__( 'Select Item Post', 'parallaxsome-pro' ),
    	            'options'     => $parallaxsome_post_lists,
    	            'class'       => 'un-bottom-block-cat1'
    	        ),
                'item_price' => array(
    	            'type'        => 'text',
    	            'label'       => esc_html__( 'Item Price', 'parallaxsome-pro' ),
    	            'class'       => 'un-bottom-block-item'
    	        ),
                
        )
	));
    
    $wp_customize->add_setting(
        'item_section_content_title', 
	            array(
	                'default' =>'',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
        
    $wp_customize->add_control(
        'item_section_content_title',
            array(
	            'type' => 'text',
	            'label' => esc_html__( 'Item Menu Title', 'parallaxsome-pro' ),
	            'section' => 'parallaxsome_item_section',
	            'priority' => 22,
            )
    );
    
    $wp_customize->add_setting(
        'item_section_content_sub_title', 
	            array(
	                'default' =>'',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
        
    $wp_customize->add_control(
        'item_section_content_sub_title',
            array(
	            'type' => 'text',
	            'label' => esc_html__( 'Item Menu Sub Title', 'parallaxsome-pro' ),
	            'section' => 'parallaxsome_item_section',
	            'priority' => 24,
            )
    );
    
    /**
     * Upload image control for section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'item_section_background_image',
	        array(
	            'default' => '',
	            'capability' => 'edit_theme_options',
	            'sanitize_callback' => 'esc_url_raw'
	        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'item_section_background_image',
        	array(
            	'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
               	'section'    => 'parallaxsome_item_section',
               	'priority' => 50
           	)
       	)
   	);
/*--------------------------------------------------------------------------------------------------------------*/
        /** Video Section **/
		$wp_customize->add_section(
	        'parallaxsome_video_section',
		        array(
		            'title'		=> esc_html__( 'Video Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 35,
		        )
	    );
        
        /**
	     * Switch option for Homepage Video Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_video_option',
	        array(
	            'default' => 'hide',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_video_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_video_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );
        
        
        /**
	     * Dropdown available pages for homepage about section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'video_section_video_iframe',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'absint'
		        )
	    );
	    $wp_customize->add_control(
	        'video_section_video_iframe', 
		        array(
		        	'type' => 'dropdown-pages',
		            'label' => esc_html__( 'Video Iframe Page', 'parallaxsome-pro' ),
		            'description' => esc_html__( 'Select page for Homepage Video Iframe', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_video_section',
		            'priority' => 10
		        )
	    );
        
        /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'video_section_title', 
	            array(
	                'default' => '',
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'video_section_title',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_video_section',
		            'priority' => 10
	            )
	    );
        /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'video_section_bg_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'video_section_bg_image',
	        	array(
	            	'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
	               	'section'    => 'parallaxsome_video_section',
	               	'priority' => 25
	           	)
	       	)
	   	);
/*--------------------------------------------------------------------------------------------------------------*/
		/** Our Blog Section **/
		$wp_customize->add_section(
	        'parallaxsome_blog_section',
	        array(
	            'title'		=> esc_html__( 'Blog Section', 'parallaxsome-pro' ),
	            'panel'     => 'parallaxsome_homepage_settings_panel',
	            'priority'  => 35,
	        )
	    );

	    /**
	     * Switch option for Homepage Portfolio Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_blog_option',
	        array(
	            'default' => 'hide',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_blog_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Latest Blog section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_blog_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );

	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'blog_section_title', 
	            array(
	                'default' => esc_html__( 'Our Blog', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'blog_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_blog_section',
		            'priority' => 10
	            )
	    );

	    /**
	     * Field for section sub-title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'blog_section_sub_title', 
	            array(
	                'default' => esc_html__( 'Latest News', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'blog_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_blog_section',
		            'priority' => 15
	            )
	    );
        
        /**
	     * Field for section sub-title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'blog_section_description', 
	            array(
	                'default' => esc_html__( '', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       )
	    );
	    $wp_customize->add_control(
	        'blog_section_description',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Section Description', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_blog_section',
		            'priority' => 15
	            )
	    );

	    /**
	     * Field for Read more button
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'blog_section_read_button', 
	            array(
	                'default' => esc_html__( 'Read More', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );    
	    $wp_customize->add_control(
	        'blog_section_read_button',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Read More Button', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_blog_section',
		            'priority' => 25
	            )
	    );

	    /**
	     * Field for View more button
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'blog_section_view_all_txt', 
	            array(
	                'default' => esc_html__( 'View All', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );    
	    $wp_customize->add_control(
	        'blog_section_view_all_txt',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'View All Button', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_blog_section',
		            'priority' => 30
	            )
	    );

/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Our Clients Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_client_section',
		        array(
		            'title'		=> esc_html__( 'Our Clients Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 40,
		        )
	    );

	    /**
	     * Switch option for Homepage Portfolio Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_clients_option',
		        array(
		            'default' => 'show',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_clients_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Our Clients section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_client_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );

	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'clients_section_title', 
	            array(
	                'default' => esc_html__( 'Our Clients', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'clients_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_client_section',
		            'priority' => 10
	            )
	    );

	    /**
	     * Field for section sub-title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'clients_section_sub_title', 
	            array(
	                'default' => esc_html__( 'Latest News', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'clients_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_client_section',
		            'priority' => 15
	            )
	    );

	    /**
	     * Dropdown available category for homepage clients
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'clients_cat_id',
		        array(
		            'default' => '0',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'sanitize_text_field'
		        )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Category_Control(
	        $wp_customize,
	        'clients_cat_id',
		        array(
		            'label' => esc_html__( 'Section Category', 'parallaxsome-pro' ),
		            'description' => esc_html__( 'Select cateogry for Homepage Our Clients Section', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_client_section',
		            'priority' => 20
	            )
	        )
	    );

	    /**
	     * Upload image control for section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'clients_bg_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'clients_bg_image',
	           	array(
	               'label'      => esc_html__( 'Section Background Image', 'parallaxsome-pro' ),
	               'section'    => 'parallaxsome_client_section',
	               'priority' => 25
	           	)
	       )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Contact Us Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'parallaxsome_contact_section',
		        array(
		            'title'		=> esc_html__( 'Contact Us Section', 'parallaxsome-pro' ),
		            'panel'     => 'parallaxsome_homepage_settings_panel',
		            'priority'  => 45,
		        )
	    );

	    /**
	     * Switch option for Homepage Contact us Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'homepage_contact_option',
		        array(
		            'default' => 'show',
		            'transport' => 'postMessage',
		            'sanitize_callback' => 'parallaxsome_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Parallaxsome_Customize_Switch_Control(
	        $wp_customize, 
	            'homepage_contact_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Section Option', 'parallaxsome-pro' ),
	                'description' 	=> esc_html__( 'Show/hide option for Homepage Contact Us section.', 'parallaxsome-pro' ),
	                'section' 	=> 'parallaxsome_contact_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'parallaxsome-pro' ),
	                    'hide' 	=> esc_html__( 'Hide', 'parallaxsome-pro' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );

	    /**
	     * Field for section title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'contact_section_title', 
	            array(
	                'default' => esc_html__( 'Contact Us', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'contact_section_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_contact_section',
		            'priority' => 10
	            )
	    );

	    /**
	     * Field for section sub-title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'contact_section_sub_title', 
	            array(
	                'default' => esc_html__( 'More Info', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'contact_section_sub_title',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Section Sub Title', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_contact_section',
		            'priority' => 15
	            )
	    );

	    /**
	     * Field for Text editor
	     *
	     * @since 1.0.0
	     */
		
        $wp_customize->add_setting( 'contact_section_form_page', array(
			'default'           => '',
			'sanitize_callback' => 'absint'
		) );

		$wp_customize->add_control( 'contact_section_form_page', array(
			'label'       => esc_html__( 'Contact Form Page', 'parallaxsome-pro' ),
			'description' => esc_html__( 'Use contact form 7 shortcode.', 'parallaxsome-pro' ),
			'section'     => 'parallaxsome_contact_section',
			'priority'	  => 20,
			'type'     => 'dropdown-pages'
		) );
	    /**
	     * Field for section contact number
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'contact_section_phone', 
	            array(
	                'default' => esc_html__( '(44) 123 456 7894', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'contact_section_phone',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Call Us', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_contact_section',
		            'priority' => 25
	            )
	    );

	    /**
	     * Field for section contact address
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'contact_section_address',
	            array(
	                'default' => esc_html__( 'Alaxender Avenue, Harrow, Middlesex, UK', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'contact_section_address',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Address', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_contact_section',
		            'priority' => 30
	            )
	    );

	    /**
	     * Field for contact map caption
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'contact_map_caption', 
	            array(
	                'default' => esc_html__( 'Locate Us on Map', 'parallaxsome-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'contact_map_caption',
	            array(
		            'type' => 'text',
		            'label' => esc_html__( 'Map Caption', 'parallaxsome-pro' ),
		            'section' => 'parallaxsome_contact_section',
		            'priority' => 35
	            )
	    );
        
        $wp_customize->add_section(
        'parallaxsome_reorder_section',
        array(
            'title' => esc_html__('Section Re-Order','parallaxsome-pro'),
            'priority' => 50,
            'capability' => 'edit_theme_options',
            'theme_support' => '',
            'panel' => 'parallaxsome_homepage_settings_panel',
        )
        );
        
        // Section option
        $wp_customize->add_setting(
            'parallaxsome_section_order_list_final',
            array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field'
                )
        );
         $wp_customize->add_control( new parallaxsome_Section_Re_Order(
            $wp_customize, 
                'parallaxsome_section_order_list_final', 
                array(
                    'type' => 'dragndrop',
                    'priority'  => 3,
                    'label' => esc_html__( 'Section Re-order', 'parallaxsome-pro' ),
                    'description' => esc_html__( 'Section Re-order by using Drag and Drop', 'parallaxsome-pro' ),
                    'section' => 'parallaxsome_reorder_section',
                    'choices'   => $parallaxsome_section_re_order_list,
                    )
            )
        );
	} //close fucntion
endif;
add_action( 'customize_register', 'parallaxsome_homepage_panel_register' );