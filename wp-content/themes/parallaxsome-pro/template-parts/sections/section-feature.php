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
	$homepage_feature_option = get_theme_mod( 'homepage_feature_option');
	if( $homepage_feature_option != 'hide' ) {
	   $feature_section_title = get_theme_mod('feature_section_title');
       $parallaxsome_all_features_json = get_theme_mod('parallaxsome_all_features_section');
       if($parallaxsome_all_features_json){
       $parallaxsome_all_features = json_decode($parallaxsome_all_features_json);
       $parallaxsome_all_arrays =array_chunk($parallaxsome_all_features, 4);
       $feature_section_image = get_theme_mod('feature_section_image');
	       ?>
            <section class="ps-home-section new-parallax-some" id="section-feature" <?php if($feature_section_image){?> style="background-image: url(<?php echo esc_url($feature_section_image); ?>);"<?php } ?>>
            <div class="ps-section-container">
                <div class="cta-sec-title wow fadeInDown" data-wow-duration="0.5s">
    				<?php parallaxsome_section_header( $feature_section_title,'', '' ); ?>
                </div>
                <div class="section-content clearfix">
                <div class="section-content-contain">
                    <div class="wrap-featurs">
                        <?php foreach($parallaxsome_all_arrays as $parallaxsome_all_array){
                            ?>
                                <div class="second-array-content">
                                    <?php
                                        foreach($parallaxsome_all_array as $parallaxsome_all_content){
                                            $features_page = $parallaxsome_all_content->features_page;
                                            $features_page_query = new WP_Query(array('post_type'=>'post','post__in'=>array($features_page)));
                                            if($features_page_query->have_posts()){
                                                while($features_page_query->have_posts()){
                                                    $features_page_query->the_post();
                                                    if(get_the_title() || get_the_content()){
                                                    ?>
                                                        <div class="final-loop-weap">
                                                            <div class="fa-title">
                                                                <span class="fa-icon"><i class="<?php echo esc_attr($parallaxsome_all_content->features_icon); ?>"></i></span>
                                                                <div class="title-content">
                                                                    <?php if(get_the_title()){ ?><h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php } ?>
                                                                    <?php if(get_the_content()){ ?><div><?php echo esc_attr(wp_trim_words(get_the_content(),20,'...')) ?></div><?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                }
                                            }
                                        }
                                     ?>
                                </div>
                            <?php } ?>
                    </div>
                    </div>
                </div>
                </div>
            </section>
           <?php
       }
    }