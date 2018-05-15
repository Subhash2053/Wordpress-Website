<?php

/*function get_resource(){

    wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts','get_resource');*/
/*function create_post_type() {
    register_post_type( 'acme_product',
        array(
            'labels' => array(
                'name' => __( 'Products' ),
                'singular_name' => __( 'Product' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}*/
//add_action( 'init', 'create_post_type' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
function ad_bootstrap_enqueue() {
   /* wp_enqueue_script( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array('jquery'), NULL, true );
    wp_enqueue_script( 'bootstrap', '//code.jquery.com/jquery-3.3.1.slim.min.js', array('jquery'), NULL, true );
    wp_enqueue_script( 'bootstrap', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array('jquery'), NULL, true );*/


    wp_enqueue_style( 'custom_google_font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i', false, NULL, 'all' );
    wp_enqueue_style( 'fa_font', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, NULL, 'all' );

    wp_enqueue_style('style', get_stylesheet_uri());



    wp_enqueue_script( 'university-js', get_template_directory_uri() . '/js/scripts-bundled.js', NULL, '1.0', true );
    wp_enqueue_style( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css', false, NULL, 'all' );
}
add_action( 'wp_enqueue_scripts', 'ad_bootstrap_enqueue' );

/*Get Ancestor*/

function get_top_ancestor_id(){
    global $post;
    if($post->post_parent){
      $ancestors=  array_reverse( get_post_ancestors($post->ID));
      return $ancestors[0];
    }

    return $post->ID;
}

/*Does page have children*/

function has_children(){
    global $post;
    $pages=get_pages('child_of='.$post->ID);
    return count($pages);
}

// Customize excerpt word count length
function custom_excerpt_length() {
    return 50;
}

add_filter('excerpt_length', 'custom_excerpt_length');



// Theme setup
function learningWordPress_setup() {

    /*navigation menu*/

    register_nav_menus(
        array(
            'primary' => __('Primary Menu'),
            'footer1' => __('Footer1 Menu'),
            'footer2' => __('Footer2 Menu')
        )
    );

    // Add featured image support
    add_theme_support('post-thumbnails');
    add_image_size('small-thumbnail', 180, 120, true);
    add_image_size('square-thumbnail', 80, 80, true);
    add_image_size('banner-image', 920, 210, array('left', 'top'));

    // Add post type support
    add_theme_support('post-formats', array('aside', 'gallery', 'link'));
}

add_action('after_setup_theme', 'learningWordPress_setup');

// Add Widget Areas
function ourWidgetsInit() {

    register_sidebar( array(
        'name' => 'Sidebar',
        'id' => 'sidebar1',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar( array(
        'name' => 'Footer Area 1',
        'id' => 'footer1',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar( array(
        'name' => 'Footer Area 2',
        'id' => 'footer2',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar( array(
        'name' => 'Footer Area 3',
        'id' => 'footer3',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar( array(
        'name' => 'Footer Area 4',
        'id' => 'footer4',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

}

add_action('widgets_init', 'ourWidgetsInit');




// Add Footer callout section to admin appearance customize screen
function lwp_footer_callout($wp_customize) {
    $wp_customize->add_section('lwp-footer-callout-section', array(
        'title' => 'Footer Callout'
    ));

    $wp_customize->add_setting('lwp-footer-callout-display', array(
        'default' => 'No'
    ));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-display-control', array(
        'label' => 'Display this section?',
        'section' => 'lwp-footer-callout-section',
        'settings' => 'lwp-footer-callout-display',
        'type' => 'select',
        'choices' => array('No' => 'No', 'Yes' => 'Yes')
    )));

    $wp_customize->add_setting('lwp-footer-callout-headline', array(
        'default' => 'Example Headline Text!'
    ));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-headline-control', array(
        'label' => 'Headline',
        'section' => 'lwp-footer-callout-section',
        'settings' => 'lwp-footer-callout-headline'
    )));

    $wp_customize->add_setting('lwp-footer-callout-text', array(
        'default' => 'Example paragraph text.'
    ));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-text-control', array(
        'label' => 'Text',
        'section' => 'lwp-footer-callout-section',
        'settings' => 'lwp-footer-callout-text',
        'type' => 'textarea'
    )));

    $wp_customize->add_setting('lwp-footer-callout-link');

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-link-control', array(
        'label' => 'Link',
        'section' => 'lwp-footer-callout-section',
        'settings' => 'lwp-footer-callout-link',
        'type' => 'dropdown-pages'
    )));

    $wp_customize->add_setting('lwp-footer-callout-image');

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'lwp-footer-callout-image-control', array(
        'label' => 'Image',
        'section' => 'lwp-footer-callout-section',
        'settings' => 'lwp-footer-callout-image',
        'width' => 750,
        'height' => 500
    )));
}

add_action('customize_register', 'lwp_footer_callout');


