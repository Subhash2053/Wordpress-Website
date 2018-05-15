<?php
	$homepage_faq_option = get_theme_mod( 'homepage_faq_option', 'hide' );
	if( $homepage_faq_option != 'hide' ) {
	   $faq_section_title = get_theme_mod('faq_section_title');
       $faq_section_description = get_theme_mod('faq_section_description');
       $faq_post_category = get_theme_mod('faq_post_category');
       $faq_section_feature_image = get_theme_mod('faq_section_feature_image');
?>
		<section class="ps-home-section new-parallax-some" id="section-faq">
            <div class="ps-section-container">
            <div class="clearfix">
                <div class="left-faq">
                    <?php if($faq_section_feature_image){ ?><img src="<?php echo esc_url($faq_section_feature_image); ?>" alt="<?php echo esc_html__('FAQ Feature Image','parallaxsome-pro'); ?>" title="<?php echo esc_html__('FAQ Feature Image','parallaxsome-pro'); ?>" /><?php } ?>
                </div>
                <div class="right-faq">
    				<div class="team-title wow fadeInUp" data-wow-duration="0.5s">
    				    <?php parallaxsome_section_header( $faq_section_title, '', $faq_section_description ); ?>
                    </div>
                    <?php if($faq_post_category){
                        $faq_post_query = new WP_Query(array('post_type'=>'post','category_name' => $faq_post_category));
                        if($faq_post_query->have_posts()){
                       ?>
                            <ul class="faq-wrap">
                                <?php
                                    $count_faq = 1; 
                                    while($faq_post_query->have_posts()){
                                        $faq_post_query->the_post();
                                        if(get_the_title() || get_the_content()){
                                        ?>
                                            <li class="faq_qa <?php echo absint(get_the_ID()); ?> <?php if($count_faq == 1){ echo "faq_qa_wrap"; }?>">
                                            <div class="clearfix">
                                                    <span id="<?php echo esc_attr(get_the_ID()); ?>" class="plus_minus_wrap"><span></span></span>
                                                    <div class="qa_wrap">
                                                        <span id="title-<?php echo absint(get_the_ID()); ?>" class="faq_question"><?php the_title(); ?></span>
                                                        <div  style="<?php if($count_faq == 1){ ?>display: block; <?php }else{?>display: none; <?php } ?>" class="faq_ans"><div class="faq_dot"></div><?php the_content(); ?></div>
                                                    </div>
                                                    </div>
                                                </li>
                                        <?php
                                        $count_faq++;
                                        }
                                    }
                                ?>
                            </ul>
                       <?php
                       } 
                    }?>
                </div>
                </div>
            </div>
        </section>
        
<?php } ?>