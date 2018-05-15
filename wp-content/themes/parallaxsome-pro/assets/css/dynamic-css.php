<?php
/**
 * Dynamic CSS
 */
 if(! function_exists('parallaxsome_dynamic_css')){
     function parallaxsome_dynamic_css(){
     $parallaxsome_style_css = '';
    $p_font_family = get_theme_mod( 'p_font_family');
    $h1_font_family = get_theme_mod( 'h1_font_family');
    $h2_font_family = get_theme_mod( 'h2_font_family');
    $h3_font_family = get_theme_mod( 'h3_font_family');
    $h4_font_family = get_theme_mod( 'h4_font_family');
    $h5_font_family = get_theme_mod( 'h5_font_family');
    $h6_font_family = get_theme_mod( 'h6_font_family');
    $hm_sec_title_font_family = get_theme_mod( 'hm_sec_title_font_family', 'sans-serif');
    $hm_sec_subtitle_font_family = get_theme_mod( 'hm_sec_subtitle_font_family', 'sans-serif');
    
    $p_font_style = get_theme_mod('p_font_style');
    $h1_font_style = get_theme_mod('h1_font_style');
    $h2_font_style = get_theme_mod('h2_font_style');
    $h3_font_style = get_theme_mod('h3_font_style');
    $h4_font_style = get_theme_mod('h4_font_style');
    $h5_font_style = get_theme_mod('h5_font_style');
    $h6_font_style = get_theme_mod('h6_font_style');
    
    $p_text_transform = get_theme_mod('p_text_transform');
    $h1_text_transform = get_theme_mod('h1_text_transform');
    $h2_text_transform = get_theme_mod('h2_text_transform');
    $h3_text_transform = get_theme_mod('h3_text_transform');
    $h4_text_transform = get_theme_mod('h4_text_transform');
    $h5_text_transform = get_theme_mod('h5_text_transform');
    $h6_text_transform = get_theme_mod('h6_text_transform');
    $hm_sec_title_text_transform = get_theme_mod('hm_sec_title_text_transform', 'none');
    $hm_sec_subtitle_text_decoration = get_theme_mod('hm_sec_subtitle_text_decoration', 'none');
    
    $p_text_decoration = get_theme_mod('p_text_decoration');
    $h1_text_decoration = get_theme_mod('h1_text_decoration');
    $h2_text_decoration = get_theme_mod('h2_text_decoration');
    $h3_text_decoration = get_theme_mod('h3_text_decoration');
    $h4_text_decoration = get_theme_mod('h4_text_decoration');
    $h5_text_decoration = get_theme_mod('h5_text_decoration');
    $h6_text_decoration = get_theme_mod('h6_text_decoration');
    $hm_sec_title_text_decoration = get_theme_mod('hm_sec_title_text_decoration', 'none');
    $hm_sec_subtitle_text_transform = get_theme_mod('hm_sec_subtitle_text_transform', 'none');
    
    $p_font_size = get_theme_mod('p_font_size', 16).'px';
    $h1_font_size = get_theme_mod('h1_font_size', 38).'px';
    $h2_font_size = get_theme_mod('h2_font_size', 34).'px';
    $h3_font_size = get_theme_mod('h3_font_size', 30).'px';
    $h4_font_size = get_theme_mod('h4_font_size', 26).'px';
    $h5_font_size = get_theme_mod('h5_font_size', 22).'px';
    $h6_font_size = get_theme_mod('h6_font_size', 18).'px';
    $hm_sec_title_font_size = get_theme_mod('hm_sec_title_font_size', 30).'px';
    $hm_sec_subtitle_font_size = get_theme_mod('hm_sec_subtitle_font_size', 18).'px';
    
    $p_color = get_theme_mod('p_color');
    $h1_color = get_theme_mod('h1_color');
    $h2_color = get_theme_mod('h2_color');
    $h3_color = get_theme_mod('h3_color');
    $h4_color = get_theme_mod('h4_color');
    $h5_color = get_theme_mod('h5_color');
    $h6_color = get_theme_mod('h6_color');
    $hm_sec_title_color = get_theme_mod('hm_sec_title_color');
    $hm_sec_subtitle_color = get_theme_mod('hm_sec_subtitle_color');
    
    $p_line_height = get_theme_mod('p_line_height');
    $h1_line_height = get_theme_mod('h1_line_height');
    $h2_line_height = get_theme_mod('h2_line_height');
    $h3_line_height = get_theme_mod('h3_line_height');
    $h4_line_height = get_theme_mod('h4_line_height');
    $h5_line_height = get_theme_mod('h5_line_height');
    $h6_line_height = get_theme_mod('h6_line_height');
    $hm_sec_title_line_height = get_theme_mod('hm_sec_title_line_height', '1.5');
    $hm_sec_subtitle_line_height = get_theme_mod('hm_sec_subtitle_line_height', '1.5');

    /**
     * Background
    */
    
    if($p_font_style){ $parallaxsome_style_css .= "p, .ps-header-wrapper .site-title-wrapper p.site-description, .faq_ans p, .section-content-wrapper p{font-weight:$p_font_style }"; }
    if($h1_font_style){ $parallaxsome_style_css .= "h1{font-weight:$h1_font_style}";}
    if($h2_font_style){ $parallaxsome_style_css .= "h2, #section-pricing .pricing-title-desc .section-title, h2.entry-title a{font-weight:$h2_font_style}";}
    if($h3_font_style){ $parallaxsome_style_css .= "h3, .widget-title{font-weight:$h3_font_style}";}
    if($h4_font_style){ $parallaxsome_style_css .= "h4{font-weight:$h4_font_style}";}
    if($h5_font_style){ $parallaxsome_style_css .= "h5{font-weight:$h5_font_style}";}
    if($h6_font_style){ $parallaxsome_style_css .= "h6{font-weight:$h6_font_style}";}
    
    if($p_text_transform){ $parallaxsome_style_css .= "p, .ps-header-wrapper .site-title-wrapper p.site-description, .faq_ans p, .section-content-wrapper p{text-transform:$p_text_transform }";}
    if($h1_text_transform){ $parallaxsome_style_css .= "h1{text-transform:$h1_text_transform}";}
    if($h2_text_transform){ $parallaxsome_style_css .= "h2, #section-pricing .pricing-title-desc .section-title, h2.entry-title a{text-transform:$h2_text_transform}";}
    if($h3_text_transform){ $parallaxsome_style_css .= "h3, .widget-title{text-transform:$h3_text_transform}";}
    if($h4_text_transform){ $parallaxsome_style_css .= "h4{text-transform:$h4_text_transform}";}
    if($h5_text_transform){ $parallaxsome_style_css .= "h5{text-transform:$h5_text_transform}";}
    if($h6_text_transform){ $parallaxsome_style_css .= "h6{text-transform:$h6_text_transform}";}
    
    if($p_font_family){
       wp_register_style('parallaxsome-pro-p-font', '//fonts.googleapis.com/css?family='.esc_attr($p_font_family));
               wp_enqueue_style( 'parallaxsome-pro-p-font');
               $parallaxsome_style_css .= "body, p, .ps-header-wrapper .site-title-wrapper p.site-description, .faq_ans p, .section-content-wrapper p, .team-info-wrapper .team-bio, .section-content-wrapper, .section-description, .service-tab-content .tab-pane p, .service-tab-content .content-right, .ps-blog-excerpt, a.ps-more-button, #section-contact .ps-num-label, #section-contact .ps-add-label, #section-contact .ps-contant-info .ps-ctn, #section-contact .ps-contant-map, .single-slide-wrap .slider-desc p{font-family:$p_font_family }";
    }
    if($h1_font_family){
       wp_register_style('parallaxsome-pro-h1-font', '//fonts.googleapis.com/css?family='.esc_attr($h1_font_family));
               wp_enqueue_style( 'parallaxsome-pro-p-font');
               $parallaxsome_style_css .= "h1{font-family:$h1_font_family}";
    }
    if($h2_font_family){
       wp_register_style('parallaxsome-pro-h2-font', '//fonts.googleapis.com/css?family='.esc_attr($h2_font_family));
               wp_enqueue_style( 'parallaxsome-pro-h2-font');
               $parallaxsome_style_css .= "h2, #section-pricing .pricing-title-desc .section-title, h2.entry-title a{font-family:$h2_font_family}";
    }
    if($h3_font_family){
       wp_register_style('parallaxsome-pro-h3-font', '//fonts.googleapis.com/css?family='.esc_attr($h3_font_family));
               wp_enqueue_style( 'parallaxsome-pro-h3-font');
               $parallaxsome_style_css .= "h3, .widget-title, .ps-blog-info .ps-blog-title{font-family:$h3_font_family}";
    }
    if($h4_font_family){
       wp_register_style('parallaxsome-pro-h4-font', '//fonts.googleapis.com/css?family='.esc_attr($h4_font_family));
               wp_enqueue_style( 'parallaxsome-pro-h4-font');
               $parallaxsome_style_css .= "h4{font-family:$h4_font_family}";
    }
    if($h5_font_family){
       wp_register_style('parallaxsome-pro-h5-font', '//fonts.googleapis.com/css?family='.esc_attr($h5_font_family));
               wp_enqueue_style( 'parallaxsome-pro-h5-font');
               $parallaxsome_style_css .= "h5{font-family:$h5_font_family}";
    }
    if($h6_font_family){
       wp_register_style('parallaxsome-pro-h6-font', '//fonts.googleapis.com/css?family='.esc_attr($h6_font_family));
               wp_enqueue_style( 'parallaxsome-pro-h6-font');
               $parallaxsome_style_css .= "h6{font-family:$h6_font_family}";
    }
    
    if($p_text_decoration){ $parallaxsome_style_css .= "p, .ps-header-wrapper .site-title-wrapper p.site-description, .faq_ans p, .section-content-wrapper p{text-decoration:$p_text_decoration }";}
    if($h1_text_decoration){ $parallaxsome_style_css .= "h1{text-decoration:$h1_text_decoration}";}
    if($h2_text_decoration){ $parallaxsome_style_css .= "h2, #section-pricing .pricing-title-desc .section-title, h2.entry-title a{text-decoration:$h2_text_decoration}";}
    if($h3_text_decoration){ $parallaxsome_style_css .= "h3, .widget-title{text-decoration:$h3_text_decoration}";}
    if($h4_text_decoration){ $parallaxsome_style_css .= "h4{text-decoration:$h4_text_decoration}";}
    if($h5_text_decoration){ $parallaxsome_style_css .= "h5{text-decoration:$h5_text_decoration}";}
    if($h6_text_decoration){ $parallaxsome_style_css .= "h6{text-decoration:$h6_text_decoration}";}
    
    if($p_font_size){ $parallaxsome_style_css .= "p, .ps-header-wrapper .site-title-wrapper p.site-description, .faq_ans p, .section-content-wrapper p{font-size:$p_font_size }";}
    if($h1_font_size){ $parallaxsome_style_css .= "h1{font-size:$h1_font_size}";}
    if($h2_font_size){ $parallaxsome_style_css .= "h2, #section-pricing .pricing-title-desc .section-title, h2.entry-title a{font-size:$h2_font_size}";}
    if($h3_font_size){ $parallaxsome_style_css .= "h3, .widget-title{font-size:$h3_font_size}";}
    if($h4_font_size){ $parallaxsome_style_css .= "h4{font-size:$h4_font_size}";}
    if($h5_font_size){ $parallaxsome_style_css .= "h5{font-size:$h5_font_size}";}
    if($h6_font_size){ $parallaxsome_style_css .= "h6{font-size:$h6_font_size}";}
    
    if($p_line_height){ $parallaxsome_style_css .= "p, .ps-header-wrapper .site-title-wrapper p.site-description, .faq_ans p, .section-content-wrapper p{line-height:$p_line_height }";}
    if($h1_line_height){ $parallaxsome_style_css .= "h1{line-height:$h1_line_height}";}
    if($h2_line_height){ $parallaxsome_style_css .= "h2, #section-pricing .pricing-title-desc .section-title, h2.entry-title a{line-height:$h2_line_height}";}
    if($h3_line_height){ $parallaxsome_style_css .= "h3, .widget-title{line-height:$h3_line_height}";}
    if($h4_line_height){ $parallaxsome_style_css .= "h4{line-height:$h4_line_height}";}
    if($h5_line_height){ $parallaxsome_style_css .= "h5{line-height:$h5_line_height}";}
    if($h6_line_height){ $parallaxsome_style_css .= "h6{line-height:$h6_line_height}";}
    
    if($p_color){ $parallaxsome_style_css .= "p, .ps-header-wrapper .site-title-wrapper p.site-description, .faq_ans p, .section-content-wrapper p{color:$p_color }";}
    if($h1_color){ $parallaxsome_style_css .= "h1{color:$h1_color}";}
    if($h2_color){ $parallaxsome_style_css .= "h2, #section-pricing .pricing-title-desc .section-title, h2.entry-title a{color:$h2_color}";}
    if($h3_color){ $parallaxsome_style_css .= "h3, .widget-title{color:$h3_color}";}
    if($h4_color){ $parallaxsome_style_css .= "h4{color:$h4_color}";}
    if($h5_color){ $parallaxsome_style_css .= "h5{color:$h5_color}";}
    if($h6_color){ $parallaxsome_style_css .= "h6{color:$h6_color}";}

    /** Home Section Title Font Settings **/
        $parallaxsome_style_css .= ".ps-home-section .section-title{
            font-family: {$hm_sec_title_font_family};
            text-decoration: {$hm_sec_title_text_decoration};
            text-transform: {$hm_sec_title_text_transform};
            font-size: {$hm_sec_title_font_size};
            line-height: {$hm_sec_title_line_height};
        }";

        $parallaxsome_style_css .= ".section-sub-title{
            font-family: {$hm_sec_subtitle_font_family};
            text-decoration: {$hm_sec_subtitle_text_decoration};
            text-transform: {$hm_sec_subtitle_text_transform};
            font-size: {$hm_sec_subtitle_font_size};
            line-height: {$hm_sec_subtitle_line_height};
        }";
    
    wp_add_inline_style( 'parallaxsome-style', $parallaxsome_style_css );
     }
}
 add_action('wp_enqueue_scripts','parallaxsome_dynamic_css',1000);