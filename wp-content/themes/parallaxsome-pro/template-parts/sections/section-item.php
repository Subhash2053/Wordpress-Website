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
	$section_option = get_theme_mod( 'homepage_item_option', 'show' );
	if( $section_option != 'hide' ) {
		$section_title = get_theme_mod( 'item_section_title');
		$section_sub_title = get_theme_mod( 'item_section_sub_title');
        $section_description = '';
        $section_title1 = get_theme_mod( 'item_section_content_title');
		$section_sub_title1 = get_theme_mod( 'item_section_content_sub_title');
        $section_description1 = '';
        $parallaxsome_our_item_section = get_theme_mod('parallaxsome_our_item_section');
        $item_section_image = get_theme_mod('item_section_background_image');
?>
		<section class="ps-home-section" id="section-item">
            <div class="wrap-main-title-item" <?php if($item_section_image){ ?> style="background-image: url(<?php echo esc_url($item_section_image); ?>);" <?php } ?> >
    			<div class="ps-section-container">
    				<div class="team-title  wow fadeInUp" data-wow-duration="0.5s">
    				    <?php parallaxsome_section_header( $section_title, $section_sub_title, $section_description ); ?>
                    </div>
                </div>
            </div>
            <div class="ps-section-container">
				<div class="section-content-wrapper wow fadeInUp" data-wow-duration="1s">
    				<div class="team-title  wow fadeInUp" data-wow-duration="0.5s">
    				    <?php parallaxsome_section_header( $section_title1, $section_sub_title1, $section_description1 ); ?>
                    </div>
                    <?php 
                    if($parallaxsome_our_item_section){
                    $parallaxsome_our_item_section_decodes = json_decode($parallaxsome_our_item_section);
                    ?>
                        <div class="item-posts clearfix">
                            <?php
                                foreach($parallaxsome_our_item_section_decodes as $parallaxsome_our_item_section_decode){
                                    $parallaxsome_post_id = $parallaxsome_our_item_section_decode->items_post;
                                    $parallaxsome_item_price = $parallaxsome_our_item_section_decode->item_price;
                                    if($parallaxsome_post_id){
                                        $parallaxsome_post_args = array(
                                            'post_type' => 'post',
                                            'post__in' => array($parallaxsome_post_id),
                                        );
                                        $parallaxsome_post_query = new WP_Query($parallaxsome_post_args);
                                        if($parallaxsome_post_query->have_posts()){
                                            while($parallaxsome_post_query->have_posts()){
                                                $parallaxsome_post_query->the_post();
                                                
                                                ?>
                                                    <div class="posts-items">
                                                            <div class="clearfix">
                                                            	<?php if ( has_post_thumbnail() ) { ?>
                                                                <div class="image-item">
                                                                    <?php the_post_thumbnail( 'parallaxsome_item_home' ); ?>
                                                                </div>
                                                                <?php } ?>
                                                                <div class="posts-items-title">
                                                                	<div class="title-desc">
                                                                		<div class="post-title-dish-wrap clearfix">
                                                                		<div class="post-title-dish-wrap-bg">
                                                                			<?php if(get_the_title()){ ?>
                                                                				<h2>
                                                                					<?php the_title(); ?>
                                                                				</h2>
                                                                			<?php } ?>

                                                                			<?php if($parallaxsome_item_price){ ?>
                                                                			
        	                                                        			<div class="price-dish">
        	                                                        				<?php echo esc_attr($parallaxsome_item_price); ?>
        	                                                        			</div>
        	                                                        		<?php } ?>
        	                                                        		</div>
                                                                		</div>
        	                                                            <?php if(get_the_content()){ ?>
        		                                                            <div class="desc">
        		                                                            	<?php echo esc_attr(wp_trim_words(get_the_content(),15,'...')); ?>
        		                                                            </div>
        	                                                            <?php } ?>
                                                                	</div>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                    </div>
                                                <?php
                                                
                                        }
                                    }
                                }
                            ?>
                        </div>
                    <?php } ?>
				</div><!-- .section-content-wrapper -->
                
			</div><!-- .ps-section-container -->
		</section>
<?php } ?>