<?php
/**
 * Template part for displaying section content in template-home.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package beetech
 */
?>

<?php
	$parallaxsome_homepage_cta_option = get_theme_mod( 'homepage_cta_option');
	if( $parallaxsome_homepage_cta_option != 'hide' ) {
	   $parallaxsome_cta_title = get_theme_mod('cta_title');
       $parallaxsome_cta_section_description = get_theme_mod('cta_section_description');
       $cta_button_one_text = get_theme_mod('cta_button_one_text');
       $cta_button_one_link = get_theme_mod('cta_button_one_link');
       $cta_button_two_text = get_theme_mod('cta_button_two_text');
       $cta_button_two_link = get_theme_mod('cta_button_two_link');
       $cta_section_image = get_theme_mod('cta_section_image');
       $cta_section_bg_image = get_theme_mod('cta_section_bg_image');
	       ?>
            <section <?php if($cta_section_bg_image){?> style="background-image: url(<?php echo esc_url($cta_section_bg_image); ?>);"<?php } ?> class="ps-home-section new-parallax-some" id="section-cta">
                <div class="ps-section-container">
                    <div class="cta-sec-title wow fadeInUp" data-wow-duration="0.5s">
        				<?php parallaxsome_section_header( $parallaxsome_cta_title,'', $parallaxsome_cta_section_description ); ?>
                    </div>
                    <div class="content-cta">
                        <?php if($cta_button_one_text || 
                        $cta_button_one_link || 
                        $cta_button_two_text || 
                        $cta_button_two_link){ ?>
                            <div class="cta-link">
                                <?php if($cta_button_one_link || $cta_button_one_text){ ?><a class="link-1" href="<?php echo esc_url($cta_button_one_link); ?>"><?php echo esc_attr($cta_button_one_text); ?></a><?php } ?>
                                <?php if($cta_button_two_link || $cta_button_two_text){ ?><a class="link-1" href="<?php echo esc_url($cta_button_two_link); ?>"><?php echo esc_attr($cta_button_two_text); ?></a><?php } ?>
                            </div>
                        <?php } ?>
                        <?php if($cta_section_image){ ?>
                            <div class="section-cta-image">
                                <img src="<?php echo esc_url($cta_section_image); ?>" title="<?php echo esc_html__('Call To Action Image','parallaxsome-pro'); ?>" alt="<?php echo esc_html__('Call To Action Image','parallaxsome-pro'); ?>"/>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
           <?php
       }