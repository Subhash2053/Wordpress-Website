<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AccessPress Themes
 * @subpackage ParallaxSome
 * @since 1.0.0
 */

get_header(); ?>

	<div id="home-primary" class="content-area">
		<main id="main" class="site-main">

			<?php
                $parallaxsome_section_order_list = get_theme_mod('parallaxsome_section_order_list_final');
                $parallaxsome_section_order_lists = explode(',',$parallaxsome_section_order_list);
                if(empty($parallaxsome_section_order_list)){
                    $parallaxsome_section_order_lists = array('about','feature','team','booking','cta','services','testimonials','fact','portfolio','quicklink','faq','pricing','skill','item','video','blog','clients','contact');
                }
                
                foreach($parallaxsome_section_order_lists as $parallaxsome_section_order_list){
                    
                    if($parallaxsome_section_order_list == 'about'){
        				/**
        				 * About Us section
        				 */
        				get_template_part( 'template-parts/sections/section', 'about' );
                    }
                                        
                    if($parallaxsome_section_order_list == 'feature'){
                        /**
        				 * Feature section
        				 */
        				get_template_part( 'template-parts/sections/section', 'feature' );
                    }
                    
                    if($parallaxsome_section_order_list == 'team'){
        				/**
        				 * Our Team section
        				 */
        				get_template_part( 'template-parts/sections/section', 'team' );
                    }
                    
                    if($parallaxsome_section_order_list == 'booking'){
        				/**
        				 * Our Team section
        				 */
        				get_template_part( 'template-parts/sections/section', 'booking' );
                    }
                    
                    if($parallaxsome_section_order_list == 'cta'){
                        /**
        				 * Our CTA section
        				 */
        				get_template_part( 'template-parts/sections/section', 'cta' );
                    }
                    
                    if($parallaxsome_section_order_list == 'services'){
        				/**
        				 * Our Services section
        				 */
        				get_template_part( 'template-parts/sections/section', 'services' );
                    }
                    
                    if($parallaxsome_section_order_list == 'testimonials'){
        				/**
        				 * Testimonials section
        				 */
        				get_template_part( 'template-parts/sections/section', 'testimonials' );
                    }
                    
                    if($parallaxsome_section_order_list == 'fact'){
        				/**
        				 * Fact Counter section
        				 */
        				get_template_part( 'template-parts/sections/section', 'fact' );
                    }
                    
                    if($parallaxsome_section_order_list == 'portfolio'){
        				/**
        				 * Portfolio section
        				 */
        				get_template_part( 'template-parts/sections/section', 'portfolio' );
                    }
                    
                    if($parallaxsome_section_order_list == 'quicklink'){
                        /**
        				 * Quick Link section
        				 */
        				get_template_part( 'template-parts/sections/section', 'quicklink' );
                    }
                    
                    if($parallaxsome_section_order_list == 'faq'){
                        /**
        				 * FAQ section
        				 */
        				get_template_part( 'template-parts/sections/section', 'faq' );
                    }
                    
                    if($parallaxsome_section_order_list == 'pricing'){
                        /**
        				 * Pricing section
        				 */
        				get_template_part( 'template-parts/sections/section', 'pricing' );
                    }
                    
                    if($parallaxsome_section_order_list == 'skill'){
                        /**
        				 * Skill section
        				 */
        				get_template_part( 'template-parts/sections/section', 'skill' );
                    }
                    
                    if($parallaxsome_section_order_list == 'item'){
                        /**
        				 * Item section
        				 */
        				get_template_part( 'template-parts/sections/section', 'item' );
                    }
                    
                    if($parallaxsome_section_order_list == 'video'){
                        /**
        				 * Video section
        				 */
        				get_template_part( 'template-parts/sections/section', 'video' );
                    }
    
                    if($parallaxsome_section_order_list == 'blog'){
        				/**
        				 * Blog section
        				 */
        				get_template_part( 'template-parts/sections/section', 'blog' );
                    }
                    
                    if($parallaxsome_section_order_list == 'clients'){
        				/**
        				 * Clients section
        				 */
        				get_template_part( 'template-parts/sections/section', 'clients' );
                    }
                    
                    if($parallaxsome_section_order_list == 'contact'){
        				/**
        				 * Contact Us section
        				 */
        				get_template_part( 'template-parts/sections/section', 'contact' );
                    }
                    
                }
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();