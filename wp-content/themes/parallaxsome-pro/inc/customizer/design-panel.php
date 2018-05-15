<?php
/**
 * ParallaxSome Theme Customizer for Design panel.
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

if( ! function_exists( 'parallaxsome_design_panel_register' ) ):
	function parallaxsome_design_panel_register( $wp_customize ) {
		
		// Register the radio image control class as a JS control type.
    	$wp_customize->register_control_type( 'Parallaxsome_Customize_Control_Radio_Image' );

		/**
		 * Design Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'parallaxsome_design_settings_panel', 
	        	array(
	        		'priority'       => 20,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'Design Settings', 'parallaxsome-pro' ),
	            ) 
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Archive Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'archive_settings_section',
	        array(
	            'title'		=> esc_html__( 'Archive Settings', 'parallaxsome-pro' ),
	            'panel'     => 'parallaxsome_design_settings_panel',
	            'priority'  => 5,
	        )
	    );	    

	    /**
	     * Field for Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ps_archive_sidebar_layout',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new Parallaxsome_Customize_Control_Radio_Image(
	        $wp_customize,
	        'ps_archive_sidebar_layout',
	            array(
	                'label'    => esc_html__( 'Archive Sidebars', 'parallaxsome-pro' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'parallaxsome-pro' ),
	                'section'  => 'archive_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );

	    /**
	     * Field for Archive read more button text
	     *
	     * @since 1.0.0
	     */
	    
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Page Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'page_settings_section',
	        array(
	            'title'		=> esc_html__( 'Page Settings', 'parallaxsome-pro' ),
	            'panel'     => 'parallaxsome_design_settings_panel',
	            'priority'  => 10,
	        )
	    );	    

	    /**
	     * Field for sidebar Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ps_default_page_sidebar',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new Parallaxsome_Customize_Control_Radio_Image(
	        $wp_customize,
	        'ps_default_page_sidebar',
	            array(
	                'label'    => esc_html__( 'Page Sidebars', 'parallaxsome-pro' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'parallaxsome-pro' ),
	                'section'  => 'page_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Post Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'post_settings_section',
	        array(
	            'title'		=> esc_html__( 'Post Settings', 'parallaxsome-pro' ),
	            'panel'     => 'parallaxsome_design_settings_panel',
	            'priority'  => 15,
	        )
	    );	    

	    /**
	     * Field for sidebar Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ps_default_post_sidebar',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new Parallaxsome_Customize_Control_Radio_Image(
	        $wp_customize,
	        'ps_default_post_sidebar',
	            array(
	                'label'    => esc_html__( 'Post Sidebars', 'parallaxsome-pro' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'parallaxsome-pro' ),
	                'section'  => 'post_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
        /**
		 * Post Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'blog_settings_section',
	        array(
	            'title'		=> esc_html__( 'Blog Settings', 'parallaxsome-pro' ),
	            'panel'     => 'parallaxsome_design_settings_panel',
	            'priority'  => 15,
	        )
	    );	    

	    /**
	     * Field for sidebar Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ps_default_blog_sidebar',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new Parallaxsome_Customize_Control_Radio_Image(
	        $wp_customize,
	        'ps_default_blog_sidebar',
	            array(
	                'label'    => esc_html__( 'Blog Sidebars', 'parallaxsome-pro' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'parallaxsome-pro' ),
	                'section'  => 'blog_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );
        
/*--------------------------------------------------------------------------------------------------------------*/
        /**
		 * Post Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'team_settings_section',
	        array(
	            'title'		=> esc_html__( 'Team Settings', 'parallaxsome-pro' ),
	            'panel'     => 'parallaxsome_design_settings_panel',
	            'priority'  => 15,
	        )
	    );	    

	    /**
	     * Field for sidebar Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ps_default_team_sidebar',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new Parallaxsome_Customize_Control_Radio_Image(
	        $wp_customize,
	        'ps_default_team_sidebar',
	            array(
	                'label'    => esc_html__( 'Team Sidebars', 'parallaxsome-pro' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'parallaxsome-pro' ),
	                'section'  => 'team_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'parallaxsome-pro' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );

	} //close fucntion
endif;
add_action( 'customize_register', 'parallaxsome_design_panel_register' );