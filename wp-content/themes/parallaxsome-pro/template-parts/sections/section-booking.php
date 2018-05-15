<?php
/**
 * Template part for displaying section content in template-home.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AccessPress Themes
 * @subpackage ParallaxSome
 * @since 1.0.0
 */

$parallaxsome_homepage_booking_option = get_theme_mod( 'homepage_booking_option', 'hide' );
if( $parallaxsome_homepage_booking_option != 'hide' ) {
    $parallaxsome_booking_section_title = get_theme_mod('booking_section_title');
    $parallaxsome_booking_section_sub_title = get_theme_mod( 'booking_section_sub_title');
    $parallaxsome_booking_section_description = get_theme_mod('booking_section_description');
    $parallaxsome_booking_section_phone_number = get_theme_mod('booking_section_phone_number');
    $parallaxsome_booking_section_image = get_theme_mod('booking_section_image');
    $parallaxsome_booking_section_form_page = get_theme_mod('booking_section_form_page');
?>
	<section <?php if($parallaxsome_booking_section_image){?> style="background-image: url(<?php echo esc_url($parallaxsome_booking_section_image); ?>);"<?php } ?> class="ps-home-section new-parallax-some" id="section-booking">
		<div class="ps-section-container">
	        <div class="left-content-booking ">
                <div class="title-section">
                
                    <?php if($parallaxsome_booking_section_title || $parallaxsome_booking_section_sub_title){ ?>
                    <div class="title-sub-title">
                        <?php if($parallaxsome_booking_section_title){ ?>
                            <span class="main-title"><?php echo esc_attr($parallaxsome_booking_section_title); ?></span>
                        <?php } ?>
                        
                        <?php if($parallaxsome_booking_section_sub_title){ ?>
                            <h2><?php echo esc_attr($parallaxsome_booking_section_sub_title); ?></h2>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    
                    <?php if($parallaxsome_booking_section_description){ ?> 
                        <div class="desc-left-booking"><?php echo esc_attr($parallaxsome_booking_section_description); ?></div>
                    <?php } ?>
                    
                    <?php if($parallaxsome_booking_section_phone_number){ ?> 
                        <div class="number-left-booking"><?php echo esc_attr($parallaxsome_booking_section_phone_number); ?></div>
                    <?php } ?>
                    
                </div>
                <div class="right-booking-content">
                
                    <?php if($parallaxsome_booking_section_title || $parallaxsome_booking_section_sub_title){ ?>
                        <div class="title-sub-title">
                            <?php if($parallaxsome_booking_section_title){ ?>
                                <span class="main-title"><?php echo esc_attr($parallaxsome_booking_section_title); ?></span>
                            <?php } ?>
                            
                            <?php if($parallaxsome_booking_section_sub_title){ ?>
                                <h2><?php echo esc_attr($parallaxsome_booking_section_sub_title); ?></h2>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php if($parallaxsome_booking_section_form_page){ ?>
                        <div class="form-booking">
                            <?php 
                                $parallaxsome_booking_section_form_query = new WP_Query(array('post_type'=>'page','post__in'=>array($parallaxsome_booking_section_form_page)));
                                if($parallaxsome_booking_section_form_query->have_posts()){
                                    while($parallaxsome_booking_section_form_query->have_posts()){
                                        $parallaxsome_booking_section_form_query->the_post();
                                        the_content();
                                    }
                                }
                            ?>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </section>
<?php } ?>