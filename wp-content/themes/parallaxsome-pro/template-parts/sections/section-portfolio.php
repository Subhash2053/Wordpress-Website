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
	$section_option = get_theme_mod( 'homepage_portfolio_option', 'show' );
	if( $section_option != 'hide' ) {
		$section_title = get_theme_mod( 'portfolio_section_title', esc_html__( 'Portfolio', 'parallaxsome-pro' ) );
		$section_sub_title = get_theme_mod( 'portfolio_section_sub_title', esc_html__( 'Best Porjects', 'parallaxsome-pro' ) );
		$section_description = get_theme_mod( 'portfolio_section_description', '' );
        $portfolio_section_layout = get_theme_mod('portfolio_section_layout');
        $ps_portfolio_cat_id = get_theme_mod( 'portfolio_cat_id', '0' );
        if($portfolio_section_layout == 'layout-2'){
            $section_sub_title = '';
        }
?>
		<section class="ps-home-section <?php echo esc_attr($portfolio_section_layout); ?>" id="section-portfolio">
			<div class="ps-section-container">
                <div class="portfolio-sec-title wow fadeInUp" data-wow-duration="0.5s">
    				<?php parallaxsome_section_header( $section_title, $section_sub_title, $section_description ); ?>
    			</div>
            </div>
			<div class="section-content-wrapper wow fadeInUp" data-wow-duration="0.5s">
                <?php
                if($portfolio_section_layout == 'layout-2'){
                    $par_cat = get_category_by_slug( $ps_portfolio_cat_id );
                    $ps_portfolio_categories = get_categories(array('type' => 'post', 'parent' => $par_cat->term_id, 'hide_empty' => false)); 
                    if($ps_portfolio_categories){ ?>
                        <div class="portfolio-post-filter">
                            <div class="titles-port wow fadeInUp">
                                <div class="filter active" data-filter="*"><?php esc_html_e('All', 'parallaxsome-pro'); ?></div>
                                <?php foreach ($ps_portfolio_categories as $ps_portfolio_category) : ?>
                                    <div class="filter" data-filter=".category-<?php echo esc_attr($ps_portfolio_category->term_id); ?>"><?php echo esc_attr($ps_portfolio_category->name); ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php 
                        $ps_portfolio_args = array( 
												'category_name' => $ps_portfolio_cat_id,
												'posts_per_page' => -1
											);
						$ps_portfolio_port_query = new WP_Query( $ps_portfolio_args );
                        if ($ps_portfolio_port_query->have_posts() && $ps_portfolio_cat_id) : ?> 
                            <div class="portfolio-postse clearfix">
                                <?php $ps_count = 1;
                                    while ($ps_portfolio_port_query->have_posts()) : $ps_portfolio_port_query->the_post(); 
                                        $ps_cats = get_the_category();
                                        $ps_post_cat_name = $ps_cats[0]->name;
                                        $ps_cat_list = '';
                                        foreach ($ps_cats as $ps_cat) :
                                            if ($ps_cat->term_id != $ps_portfolio_cat_id) {
                                                $ps_cat_list .= 'category-' . $ps_cat->term_id . ' ';
                                            }
                                        endforeach;
                                        $ps_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                                        
                                        <div class="portfolio-post-wrape  <?php echo esc_attr($ps_cat_list); ?> ">
    											<div class="project-img-wrap">
    												<figure><?php the_post_thumbnail( 'parallaxsome_project_thumb' ); ?></figure>
    												<div class="project-icons">
    							                         <div class="btn-holder">   
    							                            <a class="link-icon" href="<?php the_permalink();?>"><i class="fa fa-chain"></i></a>
                                                            <a class="zoom-icon" href="<?php echo esc_url( $ps_img[0] );?>"><i class="fa fa-search-plus"></i></a>
    							                        </div>
    							                    </div>
                                                    <div class="project-info-wrap">
            											<a href="<?php the_permalink(); ?>"><h3 class="project-title"><?php the_title(); ?></h3></a>
            											<span class="post-cat-name"><?php echo esc_html( $ps_post_cat_name ); ?></span>
            										</div><!-- .project-info-wrap -->
    											</div><!-- .project-img-wrap -->
                                        </div>
                                    
                                    <?php $ps_count++; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    <?php
                    }
                    
                }else{
					if( !empty( $ps_portfolio_cat_id ) ) {
				    ?>
						<div class="ps-protfolio-wrapper">
				    <?php
						$ps_portfolio_args = array( 
												'category_name' => $ps_portfolio_cat_id,
												'posts_per_page' => -1
											);
						$ps_portfolio_query = new WP_Query( $ps_portfolio_args );
						if( $ps_portfolio_query->have_posts() ) {
							echo '<ul id="psProjects" class="cs-hidden">';
							while ( $ps_portfolio_query->have_posts() ) {
								$ps_portfolio_query->the_post();
								$ps_post_categories = get_the_category();
								$ps_post_cat_name = $ps_post_categories[0]->name;
								$image_id = get_post_thumbnail_id();
                            	$image_path = wp_get_attachment_image_src( $image_id, 'full', true );
						?>
								<li>
									<div class="single-project-wrap item">
										<?php if( has_post_thumbnail() ) { ?>
											<div class="project-img-wrap">
												<figure><?php the_post_thumbnail( 'parallaxsome_project_thumb' ); ?></figure>
												<div class="project-icons">
							                         <div class="btn-holder">   
							                            <a class="link-icon" href="<?php the_permalink();?>"><i class="fa fa-chain"></i></a>
                                                        <a class="zoom-icon" href="<?php echo esc_url( $image_path[0] );?>" ><i class="fa fa-search-plus"></i></a>
							                        </div>
							                    </div>
											</div><!-- .project-img-wrap -->
										<?php } ?>
										
										<div class="project-info-wrap">
											<h3 class="project-title"><?php the_title(); ?></h3>
											<span class="post-cat-name"><?php echo esc_html( $ps_post_cat_name ); ?></span>
										</div><!-- .project-info-wrap -->
									</div><!-- .single-project-wrap -->
								</li>
						<?php
							}
							echo '</ul>';
						}
						wp_reset_postdata();
				    ?>
						</div><!-- .ps-protfolio-wrapper -->
				    <?php
					}
                }
					
				?>
			</div><!-- .section-content-wrapper -->
		</section>
<?php } ?>