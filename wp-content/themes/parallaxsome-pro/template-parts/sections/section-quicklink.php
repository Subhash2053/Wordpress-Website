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

$homepage_quick_link_option = get_theme_mod( 'homepage_quick_link_option', 'hide' );
if( $homepage_quick_link_option != 'hide' ) {
	$quick_link_section_title = get_theme_mod( 'quick_link_section_title');
    $quick_link_section_subject_title = get_theme_mod('quick_link_section_subject_title');
    $quick_link_section_subject_description = get_theme_mod('quick_link_section_subject_description');
    $quick_link_section_button_text = get_theme_mod('quick_link_section_button_text',esc_html__('Purchase Now','parallaxsome-pro'));
    $quick_link_section_button_link = get_theme_mod('quick_link_section_button_link');
    $quick_link_section_bg_image = get_theme_mod('quick_link_section_bg_image');
?>
	<section  <?php if($quick_link_section_bg_image){?> style="background-image: url(<?php echo esc_url($quick_link_section_bg_image); ?>);"<?php } ?> class="ps-home-section new-parallax-some" id="section-quicklink">
	<div class="ps-section-container">
        <div class="all-content-wrap wow fadeInUp clearfix">
            <?php if($quick_link_section_title){ ?><div class="section-title"><?php echo esc_attr($quick_link_section_title); ?></div><?php } ?>
            <?php if($quick_link_section_subject_title || $quick_link_section_subject_description){ ?>
                <div class="subject-link">
                    <?php if($quick_link_section_subject_title){ ?><div><h3><?php echo esc_attr($quick_link_section_subject_title); ?></h3></div><?php } ?>
                    <?php if($quick_link_section_subject_description){ ?><div class="quick-desc"><?php echo esc_attr($quick_link_section_subject_description); ?></div><?php } ?>
                </div>
                <div class="link-button">
                <?php if($quick_link_section_button_text || $quick_link_section_button_link){ ?><a href="<?php echo esc_url($quick_link_section_button_link); ?>"><?php echo esc_attr($quick_link_section_button_text); ?></a><?php } ?>
                </div>
            <?php } ?>
        </div>
        </div>
    </section>
<?php } ?>