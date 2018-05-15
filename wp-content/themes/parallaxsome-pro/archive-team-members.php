<?php
/**
 * Template Name: Team Page
 */
 get_header();

 ?>
 	<div id="primary" class="content-area team-list-page">
		<main id="main" class="site-main">

		<?php
			$ps_team_args = array( 
							'post_type' => 'team-members',
							'posts_per_page' => -1
						);
			$ps_team_query = new WP_Query( $ps_team_args );
			if( $ps_team_query->have_posts() ) {
				while( $ps_team_query->have_posts() ) {
					$ps_team_query->the_post();
                    $image_team = wp_get_attachment_image_src(get_post_thumbnail_id(),'parallaxsome_team_archive');
                    $image_team_detail = wp_get_attachment_image_src(get_post_thumbnail_id(),'parallaxsome_team_light');
                    $team_designation = get_post_meta( get_the_ID(), 'parallaxsome_member_designation', true );
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                           
                           <div class="team-main-wrap">
                                <div class="images-member">
                                <div class="image-team-wrap">
                                    <img src="<?php echo esc_url($image_team[0]); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                                    <div class="zoom-detail"><a href="#detail-zoom<?php the_ID(); ?>" rel="prettyPhoto"><i class="fa fa-search-plus"></i></a></div>
                                    </div>
                                    
                                    <div class="detail-preeti" id="detail-zoom<?php the_ID(); ?>" style="display: none;">
                                        <img src="<?php echo esc_url($image_team_detail[0]); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                                        <div class="details">
                                            <div class="designation-name">
                                                <?php if(get_the_title()){ ?><span class="name-member"><?php the_title(); ?></span><?php } ?>
                                                <?php if($team_designation){ ?><span class="designation-member"><?php echo esc_html($team_designation); ?></span><?php } ?>
                                            </div>
                                            <div class="word-social">
                                                <?php  if(get_the_content()){ ?>
                                                    <div class="member-desc">
                                                        <?php the_content(); ?>
                                                    </div>
                                                <?php } ?>
                                                <?php parallaxsome_team_social_link(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="member-detail">
                                    <div class="designation-name">
                                        <?php if(get_the_title()){ ?><span class="name-member"><?php the_title(); ?></span><?php } ?>
                                        <?php if($team_designation){ ?><span class="designation-member"><?php echo esc_html($team_designation); ?></span><?php } ?>
                                        <div class="desc-team">
                                            <?php echo esc_html(wp_trim_words(get_the_content(),15,'...')); ?>
                                        </div>
                                        <?php parallaxsome_team_social_link(); ?>
                                    </div>
                                    
                                </div>
                           </div>
                        	
                        </article><!-- #post-## -->
                    <?php
                    }
            }
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
 <?php
 parallaxsome_get_sidebar();
 get_footer();