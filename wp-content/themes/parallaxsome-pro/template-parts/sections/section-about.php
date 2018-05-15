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
?>

<?php
	$parallaxsome_section_option = get_theme_mod( 'homepage_about_option', 'show' );
	if( $parallaxsome_section_option != 'hide' ) {
		$parallaxsome_section_title = get_theme_mod( 'about_section_title', esc_html__( 'About', 'parallaxsome-pro' ) );
		$parallaxsome_section_sub_title = get_theme_mod( 'about_section_sub_title', esc_html__( 'Who We Are', 'parallaxsome-pro' ) );
		$parallaxsome_section_image = get_theme_mod( 'about_section_image', '' );
        $parallaxsome_about_section_layout = get_theme_mod('about_section_layout');
        $parallaxsome_section_page_id = get_theme_mod( 'about_page_id', '0' );
        $parallaxsome_about_section_readmore_text = get_theme_mod('about_section_readmore_text',esc_html__('Get Started','parallaxsome-pro'));
?>
		<section class="ps-home-section <?php echo esc_attr($parallaxsome_about_section_layout); ?>" id="section-about">
        
			<div class="ps-section-container">
                <?php if($parallaxsome_about_section_layout == 'layout-1'){ ?>
				<?php parallaxsome_section_header( $parallaxsome_section_title, $parallaxsome_section_sub_title, $description = null ); ?>
				<div class="section-content-wrapper">
					<?php
						if( !empty( $parallaxsome_section_page_id ) ) {
							$page_query = new WP_Query( 'page_id='.$parallaxsome_section_page_id );
							if( $page_query->have_posts() ) {
								while( $page_query->have_posts() ) {
									$page_query->the_post();
									the_excerpt();
									if( !empty( $parallaxsome_section_image ) ) {
					?>
										<div class="about-image wow fadeInUp" data-wow-duration="0.7s">
											<figure><img src="<?php echo esc_url( $parallaxsome_section_image ); ?>"  alt="<?php esc_attr_e('About Image','parallaxsome-pro'); ?>" /></figure>
										</div>
					<?php
									}
								}
							}
							wp_reset_postdata();
						}
					?>
				</div><!-- .section-content-wrapper -->
                <?php }else{
                    ?>
                        <div class="ps-about-section">
                                <?php
            						if( !empty( $parallaxsome_section_page_id ) ) {
            							$page_query = new WP_Query( array('post_type'=>'page','post__in'=>array($parallaxsome_section_page_id) ));
            							if( $page_query->have_posts() ) {
            								while( $page_query->have_posts() ) {
            									$page_query->the_post();
                                                if(get_the_title() || get_the_content()){
                                                    ?><div class="left-about">
                                                        <?php if(get_the_title()){?>
                                                            <h2 class="section-title">
                                                                <?php the_title(); ?>
                                                            </h2>
                                                        <?php } ?>
                                                        
                                                        <?php if(get_the_content()){ ?>
                                                            <div class="about-left-desc">
                                                                <?php echo wp_trim_words(get_the_content(),20,'...'); ?>
                                                                <?php if($parallaxsome_about_section_readmore_text){ ?><span class="read-more"><a href="<?php the_permalink(); ?>"><?php echo esc_attr($parallaxsome_about_section_readmore_text); ?></a></span><?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php }
            								}
            							}
            							wp_reset_postdata();
            						}
            					?>
                            <div class="right-about">
                            <?php
                                if( !empty( $parallaxsome_section_image ) ) {
            					?>
									<div class="about-image-right wow fadeInUp">
										<figure><img src="<?php echo esc_url( $parallaxsome_section_image ); ?>" alt="<?php esc_attr_e('About Image','parallaxsome-pro'); ?>" /></figure>
									</div>
                            <?php } ?>
                            </div>
                        </div>
                    <?php
                } ?>
			</div><!-- .ps-section-container -->
		</section>
<?php
	}
?>