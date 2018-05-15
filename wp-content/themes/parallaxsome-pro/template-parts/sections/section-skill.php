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

$homepage_skill_option = get_theme_mod( 'homepage_skill_option', 'hide' );
if( $homepage_skill_option != 'hide' ) {
    $skill_section_title = get_theme_mod('skill_section_title');
    $skill_section_description = get_theme_mod('skill_section_description');
    $parallaxsome_skill_bar = get_theme_mod('parallaxsome_skill_bar');
    $parallaxsome_skill_arrays = json_decode($parallaxsome_skill_bar);
?>
	<section class="ps-home-section new-parallax-some" id="section-skill">
        <div class="skill-wrap">
        <div class="ps-section-container">
            <?php if($skill_section_title || $skill_section_description){ ?>
            <div class="skill-title-desc wow fadeInUp">
                <?php if($skill_section_title){ ?><h2 class="section-title"><?php echo esc_attr($skill_section_title); ?></h2><?php } ?>
    			<?php if($skill_section_description){ ?><p class="section-description"><?php echo wp_kses_post($skill_section_description); ?></p><?php } ?>
            </div>
            <?php } ?>
            <?php if($parallaxsome_skill_arrays){ ?>
                <div class="skill-bar  wow fadeInUp">
                    <?php foreach($parallaxsome_skill_arrays as $parallaxsome_skill_array){
                        $progress_bar_title = $parallaxsome_skill_array->slill_title;
                        $progress_bar_percentage = $parallaxsome_skill_array->skill_percentage;
                        ?>
                        <div class="pbar-container clearfix">
                            <div class="pbar-title"><?php echo esc_attr($progress_bar_title); ?></div>
                            <span class="percent"><?php echo esc_attr($progress_bar_percentage.'%'); ?></span>
                            <div class="progressBar" data-label="<?php echo absint($progress_bar_percentage); ?>" id="max<?php echo absint($progress_bar_percentage); ?>" data-width="<?php echo absint($progress_bar_percentage); ?>"><div></div></div>
                        </div>
                        <?php
                    } ?>
                </div>
            <?php } ?>
        </div>
        </div>
    </section>
<?php } ?>