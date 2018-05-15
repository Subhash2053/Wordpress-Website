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

$homepage_pricing_option = get_theme_mod( 'homepage_pricing_option', 'hide' );
if( $homepage_pricing_option != 'hide' ) {
    $pricing_section_title = get_theme_mod('pricing_section_title');
    $pricing_section_description = get_theme_mod('pricing_section_description');
    $pricing_section_feature_image = get_theme_mod('pricing_section_feature_image');
?>
	<section <?php if($pricing_section_feature_image){?> style="background-image: url(<?php echo esc_url($pricing_section_feature_image); ?>);"<?php } ?> class="ps-home-section new-parallax-some" id="section-pricing">
		<div class="ps-section-container">
	        <div class="pricing-wrap-main wow fadeInUp clearfix">
	            <?php if($pricing_section_title || $pricing_section_description){ ?>
	            <div class="pricing-title-desc">
	                <?php if($pricing_section_title){ ?>
	                	<h2 class="section-title"><?php echo esc_attr($pricing_section_title); ?></h2>
	                <?php } ?>
	    			<?php if($pricing_section_description){ ?>
	    				<p class="section-description"><?php echo wp_kses_post($pricing_section_description); ?></p>
	    			<?php } ?>
	            </div>
	            <?php } ?>
	            <?php if(is_active_sidebar('parallaxsome-pricing-widget-area')){ ?>
	                <div class="pricing-table-home">
	                    <div class="pricing-table-home-wrap"><?php dynamic_sidebar('parallaxsome-pricing-widget-area'); ?></div>
	                </div>
	            <?php } ?>
	        </div>
        </div>
    </section>
<?php } ?>