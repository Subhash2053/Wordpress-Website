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
	$section_option = get_theme_mod( 'homepage_team_option', 'show' );
	if( $section_option != 'hide' ) {
		$section_title = get_theme_mod( 'team_section_title', esc_html__( 'Our Team', 'parallaxsome-pro' ) );
		$section_sub_title = get_theme_mod( 'team_section_sub_title', esc_html__( 'Group Together', 'parallaxsome-pro' ) );
		$section_description = get_theme_mod( 'team_section_description', '' );
        $team_section_layout = get_theme_mod('team_section_layout','layout-1');
        if($team_section_layout == 'layout-2'){
            $section_sub_title = '';
        }
?>
		<section class="ps-home-section <?php echo esc_attr($team_section_layout); ?>" id="section-team">
			<div class="ps-section-container <?php echo esc_attr($team_section_layout); ?>">
				<div class="team-title  wow fadeInUp" data-wow-duration="0.5s">
				    <?php parallaxsome_section_header( $section_title, $section_sub_title, $section_description ); ?>
                </div>
				<div class="section-content-wrapper wow fadeInUp" data-wow-duration="1s">
					<?php 
                        if($team_section_layout == 'layout-2'){
        							$home_team_args = array( 
        												'post_type' => 'team-members',
        												'posts_per_page' => 10,
                                                        'post_status' => 'publish'
        											);
        							$home_team_query = new WP_Query( $home_team_args );
        							if( $home_team_query->have_posts() ) {
        					       ?>
        							<div class="team-wrapper">
        								<ul class="team-wraper-carousel clearfix">
        					       <?php
        								while( $home_team_query->have_posts() ) {
        									$home_team_query->the_post();
                                            $team_designation = get_post_meta( get_the_ID(), 'parallaxsome_member_designation', true );
                                            $parallaxsome_member_contact = get_post_meta( get_the_ID(), 'parallaxsome_member_contact', true );
        									$image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'parallaxsome_team_circle', true );
        					       ?>
        									<li class="team-box-item">
            									<div class="team-box-item-wrap">
            										<div class="weap-team">
                                                        <div class="image-team">
                                                            <?php if($image_path[0]){ ?><figure><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php esc_attr(get_the_title()); ?>"/></figure><?php } ?>
                                                        </div>
                                                        <div class="title-designation-number">
                                                            <?php if(get_the_title()){ ?><h4 class="team-name"><?php the_title(); ?></h4><?php } ?>
                                                            <?php if($team_designation){?><span><?php echo esc_attr($team_designation); ?></span><?php } ?>
                                                            <?php if($parallaxsome_member_contact){?> <span class="number-team"><i class="fa fa-phone" aria-hidden="true"></i><?php echo esc_attr($parallaxsome_member_contact); ?></span> <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="team-flip">
                                                        <div class="title-designation-number">
                                                            <?php if(get_the_title()){ ?><h4 class="team-name"><?php the_title(); ?></h4><?php } ?>
                                                            <?php if($team_designation){?><span><?php echo esc_attr($team_designation); ?></span><?php } ?>
                                                        </div>
                                                        <?php if(get_the_content()){ ?><div class="team-bio"><?php echo esc_attr(wp_trim_words(get_the_content(),20,'...')); ?></div><?php } ?>
                                                        <?php parallaxsome_team_social_link(); ?>
                                                    </div>
                                                </div>
        									</li><!-- .team-box-item -->
        					       <?php
        								}
        					       ?>
        								</ul>
        							</div><!-- .team-wrapper -->
        					       <?php
        							}
        							wp_reset_postdata();
                        }else{
							$home_team_args = array( 
												'post_type' => 'team-members',
												'posts_per_page' => 10,
                                                'post_status' => 'publish'
											);
							$home_team_query = new WP_Query( $home_team_args );
							if( $home_team_query->have_posts() ) {
					       ?>
							<div class="team-wrapper">
								<ul class="team-wraper-carousel clearfix">
					               <?php
        								while( $home_team_query->have_posts() ) {
        									$home_team_query->the_post();
                                            $team_designation = get_post_meta( get_the_ID(), 'parallaxsome_member_designation', true );
        									$image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'parallaxsome_team_thumb', true );
        					       ?>
        									<li class="team-box-item">
        										<div class="team-image-container">
        											<?php if($image_path[0]){ ?><figure><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" /></figure><?php } ?>
        											<div class="team-info-wrapper">
        												<div class="team-info-hover">
        													<?php if(get_the_title()){ ?><h4 class="team-name"><?php the_title(); ?></h4><?php } ?>
                                                            <?php if($team_designation){?><span><?php echo esc_attr($team_designation); ?></span><?php } ?>
        													<div class="team-bio"><?php echo esc_attr(wp_trim_words(get_the_content(),20,'...')); ?></div>
                                                            
                                                                <?php parallaxsome_team_social_link(); ?>
                                                                
        												</div>
        											</div><!-- .team-info-wrapper -->
        										</div><!-- .team-image-container -->
        									</li><!-- .team-box-item -->
        					       <?php
        								}
        					       ?>
								</ul>
							</div><!-- .team-wrapper -->
					       <?php
							}
							wp_reset_postdata();
                    }
					?>
				</div><!-- .section-content-wrapper -->
				<?php 
					$team_view_more_text = get_theme_mod( 'team_view_more_txt', esc_html__( 'View All', 'parallaxsome-pro' ) )
				?>
				<div class="ps-section-viewall">
					<a href="<?php echo esc_url( get_post_type_archive_link('team-members')); ?>"><?php echo esc_html( $team_view_more_text ); ?></a>
				</div>
			</div><!-- .ps-section-container -->
		</section>
<?php } ?>