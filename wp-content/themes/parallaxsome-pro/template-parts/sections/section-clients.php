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
	$parallaxsome_section_option = get_theme_mod( 'homepage_clients_option', 'show' );
	if( $parallaxsome_section_option != 'hide' ) {
		$parallaxsome_section_title = get_theme_mod( 'clients_section_title', esc_html__( 'Our Clients', 'parallaxsome-pro' ) );
		$parallaxsome_section_sub_title = get_theme_mod( 'clients_section_sub_title', esc_html__( 'Latest News', 'parallaxsome-pro' ) );
		$parallaxsome_section_bg_image = get_theme_mod( 'clients_bg_image', '' );
?>
		<section <?php if($parallaxsome_section_bg_image){?> style="background-image: url(<?php echo esc_url($parallaxsome_section_bg_image); ?>);"<?php } ?> class="ps-home-section" id="section-clients">			
			<div class="ps-section-container">
				<div class="client-title wow fadeInDown" data-wow-duration="0.5s">
					<?php parallaxsome_section_header( $parallaxsome_section_title, $parallaxsome_section_sub_title, $parallaxsome_section_description = null ); ?>
				</div>
				<div class="section-content-wrapper wow fadeInUp clearfix" data-wow-duration="1s">
				<?php
					$parallaxsome_clients_cat_id = get_theme_mod( 'clients_cat_id', '0' );
					if( !empty( $parallaxsome_clients_cat_id ) ) {
						$parallaxsome_client_args = array(
											'category_name' => $parallaxsome_clients_cat_id,
											'posts_per_page' => 8
											);
						$parallaxsome_client_query = new WP_Query( $parallaxsome_client_args );
						if( $parallaxsome_client_query->have_posts() ) {
							while( $parallaxsome_client_query->have_posts() ) {
								$parallaxsome_client_query->the_post();
								if( has_post_thumbnail() ) {
				?>
									<div class="ps-single-client clearfix">
										<figure><?php the_post_thumbnail( 'medium' ); ?></figure>
									</div><!-- .ps-single-client -->
				<?php
								}
							}
						}
						wp_reset_postdata();
					}
				?>
				</div><!-- .section-content-wrapper -->	
			</div>			
		</section>
<?php } ?>