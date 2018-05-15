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

$homepage_video_option = get_theme_mod( 'homepage_video_option', 'hide' );
if( $homepage_video_option != 'hide' ) {
    $video_section_video_iframe = get_theme_mod('video_section_video_iframe');
    $video_section_title = get_theme_mod('video_section_title');
    $video_section_bg_image = get_theme_mod('video_section_bg_image');
?>
	<section <?php if($video_section_bg_image){?> style="background-image: url(<?php echo esc_url($video_section_bg_image); ?>);"<?php } ?> class="ps-home-section new-parallax-some" id="section-video">
        <div class="ps-section-container">
            <?php if($video_section_video_iframe || $video_section_title){ ?>
            <div class="video-wrap wow fadeInUp">
                <?php if($video_section_video_iframe){ ?>
                    <div class="left-video">
                        <?php
                            $video_iframe_args = array(
                                'post_type' => 'page',
                                'post__in' => array($video_section_video_iframe),
                            );
                            $video_iframe_query = new WP_Query($video_iframe_args);
                            if($video_iframe_query->have_posts()){
                                while($video_iframe_query->have_posts()){
                                    $video_iframe_query->the_post();
                                    the_content();
                                }
                            }
                        ?>
                    </div>
                <?php } ?>
                
                <?php if($video_section_title){ ?>
                    <h2 class="right-desc"><?php echo esc_attr($video_section_title); ?></h2>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>