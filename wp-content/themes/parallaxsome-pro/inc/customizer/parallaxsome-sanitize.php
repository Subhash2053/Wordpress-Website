<?php
/**
 * Define sanitize functions for customizer fields
 *
 * @package AccessPress Themes
 * @subpackage ParallaxSome
 * @since 1.0.0
 */

/**
 * Sanitize number field
 *
 * @since 1.0.0
 */
function parallaxsome_sanitize_number( $input ) {
    $output = intval($input);
     return $output;
}

/**
 * Sanitize checkbox field
 *
 * @since 1.0.0
 */
function parallaxsome_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Sanitize switch button
 *
 * @since 1.0.0
 */
function parallaxsome_sanitize_switch_option( $input ) {
    $valid_keys = array(
            'show'  => esc_html__( 'Show', 'parallaxsome-pro' ),
            'hide'  => esc_html__( 'Hide', 'parallaxsome-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize switch button ( Enable/Disable )
 *
 * @since 1.0.0
 */
function parallaxsome_sanitize_enable_switch_option( $input ) {
    $valid_keys = array(
            'enable'    => esc_html__( 'Enable', 'parallaxsome-pro' ),
            'disable'   => esc_html__( 'Disable', 'parallaxsome-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize switch button for menu
 *
 * @since 1.0.0
 */
function parallaxsome_sanitize_menu_switch_option( $input ) {
    $valid_keys = array(
            'parallax'  => esc_html__( 'Parallax', 'parallaxsome-pro' ),
            'default'   => esc_html__( 'Default', 'parallaxsome-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize switch button for parallax menu type
 *
 * @since 1.0.0
 */
function parallaxsome_sanitize_p_menu_background_switch_option( $input ) {
    $valid_keys = array(
            'transparent' 	=> esc_html__( 'Transparent', 'parallaxsome-pro' ),
            'white' 	=> esc_html__( 'White', 'parallaxsome-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}
function parallaxsome_sanitize_p_menu_type_switch_option( $input ) {
    $valid_keys = array(
            'default'   => esc_html__( 'Default', 'parallaxsome-pro' ),
            'float'     => esc_html__( 'Float Menu', 'parallaxsome-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}
/**
 * Sanitize multiple categories for blog
 *
 * @since 1.0.0
 */
function parallaxsome_multiple_categories_sanitize( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Active Callback function for customizer field
 */
function parallaxsome_primary_menu_type_callback( $control ) {
    if ( $control->manager->get_setting('primary_menu_type')->value() == 'parallax' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Repeater Sanitize
*/
function parallaxsome_sanitize_repeater($input){      
    $input_decoded = json_decode( $input, true );
    $allowed_html = array(
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'a' => array(
            'href' => array(),
            'class' => array(),
            'id' => array(),
            'target' => array()
        ),
        'button' => array(
            'class' => array(),
            'id' => array()
        )
    );    
    
    if(!empty($input_decoded)) {
        foreach ($input_decoded as $boxes => $box ){
            foreach ($box as $key => $value){
                $input_decoded[$boxes][$key] = sanitize_text_field( $value );
            }
        }
        return json_encode($input_decoded);
    }    
    return $input;
}
function parallaxsome_sanitize_post_cat_list($input){
    $parallaxsome_cat_list = parallaxsome_Category_list();
    if(array_key_exists($input,$parallaxsome_cat_list)){
        return $input;
    }
    else{
        return '';
    }
}