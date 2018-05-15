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
	$parallaxsome_section_option = get_theme_mod( 'homepage_contact_option', 'show' );
	if( $parallaxsome_section_option != 'hide' ) {
		$parallaxsome_section_title = get_theme_mod( 'contact_section_title', esc_html__( 'Contact Us', 'parallaxsome-pro' ) );
		$parallaxsome_section_sub_title = get_theme_mod( 'contact_section_sub_title', esc_html__( 'More Info', 'parallaxsome-pro' ) );
		$parallaxsome_section_ctn_num = get_theme_mod( 'contact_section_phone', esc_html__( '(44) 123 456 7894', 'parallaxsome-pro' ) );		
		$parallaxsome_phone_num = preg_replace( "/[^0-9]/","",$parallaxsome_section_ctn_num );
		$parallaxsome_section_ctn_address = get_theme_mod( 'contact_section_address', esc_html__( 'Alaxender Avenue, Harrow, Middlesex, UK', 'parallaxsome-pro' ) );
		$parallaxsome_map_caption = get_theme_mod( 'contact_map_caption', esc_html__( 'Locate Us on Map', 'parallaxsome-pro' ) );
?>
		<section class="ps-home-section" id="section-contact">
			<div class="ps-section-container wow fadeInDown" data-wow-duration="0.5s">
				<?php parallaxsome_section_header( $parallaxsome_section_title, $parallaxsome_section_sub_title, $parallaxsome_section_description = null ); ?>
			</div><!-- .ps-section-container -->
			<div class="section-content-wrapper wow fadeInUp" data-wow-duration="1s">
				<div class="ps-contact-form clearfix">
					<?php
                    $parallaxsome_contact_section_form_page = get_theme_mod('contact_section_form_page');
					$parallaxsome_contact_fotm_query = new WP_Query(array('post_type' => 'page','post__in'=>array($parallaxsome_contact_section_form_page)));
                    if($parallaxsome_contact_fotm_query->have_posts()){
                        while($parallaxsome_contact_fotm_query->have_posts()){
                            $parallaxsome_contact_fotm_query->the_post();
                            the_content();
                        }
                    }
					?>
				</div><!-- .ps-contact-form -->
				<div class="ps-contant-info clearfix">
					<div class="ps-ctn">
						<span class="ps-num-label"><?php esc_html_e('Call us:','parallaxsome-pro') ?></span>
						<span><a href="tel:<?php echo esc_attr( $parallaxsome_phone_num ); ?>"><?php echo esc_html( $parallaxsome_section_ctn_num ); ?></a></span>
					</div>
					<div class="ps-address">
						<span class="ps-add-label"><?php esc_html_e('visit us:','parallaxsome-pro') ?></span>
						<span class="address-home"><?php echo esc_html( $parallaxsome_section_ctn_address ); ?></span>
					</div>
				</div><!-- .ps-contant-info -->
				<div class="ps-contant-map">
					<div class="ps-mag-caption"><?php echo esc_html( $parallaxsome_map_caption ); ?></div>
				</div><!-- .ps-contant-map -->
				<div class="ps-map-frame" style="display: none;">
					<?php
			        	if( is_active_sidebar( 'parallaxsome_map_sidebar' ) ) {
			            	if ( !dynamic_sidebar( 'parallaxsome_map_sidebar' ) ):
			            	endif;
			         	}
			        ?>
				</div><!-- .ps-map-frame -->
				<div class="footer-social-wrap">
					<?php do_action( 'parallaxsome_top_social_icons' ); ?>
				</div><!-- .footer-social-wrap -->
			</div><!-- .section-content-wrapper -->		
		</section>
<?php } ?>