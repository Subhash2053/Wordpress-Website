<?php
/**
* Blog Single Page
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
        $parallaxsome_count_image = 1;
		while ( have_posts() ) : the_post();

			$image_blog = wp_get_attachment_image_src(get_post_thumbnail_id(),'');
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                			<div class="blog-page-wrap">
                                <div class="image-wrap">
                                     <?php
                                		if( has_post_thumbnail() ){
                                			the_post_thumbnail( 'parallaxsome_single_thumb' );
                                		}
                                	 ?>
                                     <?php
                                        $parallaxsome_post_images = get_post_meta(get_the_ID(),'post_images',true);
                                        if($parallaxsome_post_images){
                                     ?>
                                            <ul class="gallery clearfix">
                                                <?php
                                                    $image_forst = 1; 
                                                    foreach($parallaxsome_post_images as $parallaxsome_post_image){ 
                                                    $attachment_id = parallaxsome_attachment_id_by_url( $parallaxsome_post_image );
                                                    $img_url = wp_get_attachment_image_src( $attachment_id, '' );
                                                    if($img_url[0]){
                                                    ?>
                                    				    <li><a href="<?php echo esc_url($img_url[0]); if($image_forst == 1){?>?lol=lol<?php } ?>" rel="prettyPhoto[gallery<?php echo $parallaxsome_count_image; ?>]"><?php  if($image_forst == 1){?><i class="fa fa-search-plus"></i><?php } ?></a></li>
                                                    <?php 
                                                    $image_forst++; }
                                                } ?>
                	                       </ul>
                                   <?php } ?>
                                   <span class="date-blog"><?php echo '<span>'.absint(get_the_date('d')).'</span>'.esc_attr(get_the_date('F Y')); ?></span>
                                </div>
                        	<div class="article-content-wrapper">
                        		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                        		
                        		<div class="entry-content">
                        			<?php the_content(); ?>
                        		</div><!-- .entry-content -->
                        		<div class="comment-author-readmore">
                                    <span class="author"><?php echo esc_html__('BY ','parallaxsome-pro').esc_attr(get_the_author()); ?></span>
                                    <span class="comment"><i class="fa fa-comments"></i><span><?php echo absint(get_comments_number()); ?></span></span>
                                    <span class="readmore"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','parallaxsome-pro'); ?></a></span>
                                </div>
                        	</div><!-- .article-content-wrapper -->	
                			</div>	
                        </article><!-- #post-## -->
            <?php
			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
parallaxsome_get_sidebar();
get_footer();