<?php
if(!function_exists('parallaxsome_dynamic_styles')) {

        /** Function to have dynamic changes in template color **/
        function parallaxsome_dynamic_styles() {
                $tpl_color = get_theme_mod( 'parallaxsome_tpl_color' );
                if(!$tpl_color) {
                    $tpl_color = '#e9563d';
                }

                /** Get RGB color value **/
                $rgb = parallaxsome_hex2rgb($tpl_color);
                $r = $rgb[0];
                $g = $rgb[1];
                $b = $rgb[2];

                $custom_css = ".main-navigation ul.menu > li > a:after, .single-slide-wrap .slider-title:before, .single-slide-wrap .slider-title:after, .ps-front-slider-wrapper .bx-wrapper .bx-pager.bx-default-pager a:hover, .ps-front-slider-wrapper .bx-wrapper .bx-pager.bx-default-pager a.active, .team-wrapper .lSSlideOuter .lSPager.lSpg > li a:hover, .team-wrapper .lSSlideOuter .lSPager.lSpg > li.active a, #section-feature  .lSSlideOuter .lSPager.lSpg > li a:hover, #section-feature  .lSSlideOuter .lSPager.lSpg > li.active a, #section-testimonials .owl-carousel .owl-dots .owl-dot.active span, #section-testimonials .owl-carousel .owl-dots .owl-dot span:hover, .ps-section-viewall a:hover, .service-tab-content .content-right .ps-btn, .service-tab-content .tab-pane .ps-btn, .ps-home-section#section-fact .ps-fact-icon, .ps-protfolio-wrapper ul#psProjects li:hover .project-info-wrap, #section-portfolio .project-icons a, .new-parallax-some .ps-section-viewall a:hover, .layout-2 .ps-section-viewall a:hover, #section-blog .ps-section-viewall a:hover, .footer-social-wrap .ps-social-icons-wrapper a:hover, #scroll-up, .widget_search input[type=submit], .archive #primary .search-submit, .comments-area .form-submit input[type=submit], .layout-2 .ps-about-section .left-about .read-more a:hover, .button-pricing a:hover, .woocommerce-account .woocommerce input.button:hover, .woocommerce-checkout .woocommerce input.button.alt:hover, .woocommerce ul.products li.product .button:hover, .woocommerce div.product form.cart .button:hover, .woocommerce .cart .coupon input.button:hover, .woocommerce  .return-to-shop a:hover, .form-booking  input[type=submit]:hover, #section-feature .final-loop-weap:hover .fa-title, .right-faq .faq_qa_wrap .plus_minus_wrap span, .progressBar div, #section-contact input[type=submit], .pp_content .social-icon a:hover, .nav-toggle span{
                        background-color: {$tpl_color};
                }";

                $custom_css .= ".ps-head-search .ps-search-icon:before, .ps-section-viewall a, .service-nav-tab li a:hover, .service-nav-tab li.active a, .service-tab-content .content-right .ps-btn:hover, .service-tab-content .tab-pane .ps-btn:hover, #section-portfolio .project-icons a:hover, a:hover, a:focus, a:active, a.ps-more-button:hover, .ps-blog-poston a:hover, #primary .blog-content-wrap a:hover, #section-contact .ps-num-label:before, #section-contact .ps-add-label:before, #section-contact .ps-mag-caption:hover, footer.site-footer .site-info a, .ps-innerpages-header-wrapper #crumbs a, .widget-title, .widget-area .widget a:hover, .comment-author-readmore .readmore a:hover, .comments-area .comments-title, .comments-area .comment-reply-title, .comment-navigation a:hover:before, .posts-navigation a:hover:before, .post-navigation a:hover:before, #primary article.post .entry-meta a:hover, .arcitle-more-btn a:hover, .arcitle-more-btn a:hover:after, .layout-2  .team-wrapper  .social-icon a:hover, .layout-2#section-portfolio .section-content-wrapper .filter.active, .faq-wrap .faq_question:hover, .faq-wrap .faq_qa_wrap .faq_question, #section-contact input[type=submit]:hover, #section-pricing .sticker-title, .ps-top-footer .ps-footer-widget a:hover, .team-main-wrap .designation-name .designation-member, .team-main-wrap .designation-name .social-icon a:hover, .comments-area a:hover, .comments-area .comment-author .fn a:hover, .team-list-page .team-main-wrap .designation-name .designation-member{
                        color: {$tpl_color};
                }";

                $custom_css .= ".ps-section-viewall a, #section-portfolio .project-icons a, a.ps-more-button:before, a.ps-more-button:after, .footer-social-wrap .ps-social-icons-wrapper a:hover, .widget_search input[type=submit], .archive #primary .search-submit, .comments-area .form-submit input[type=submit], #section-contact input[type=submit]:hover{
                        border-color: {$tpl_color};
                }";

                $custom_css .= ".ps-home-section#section-fact .ps-fact-icon:after{
                        border-color: transparent transparent transparent {$tpl_color};
                }";

                $custom_css .= ".new-parallax-some .ps-section-viewall a, .layout-2 .ps-section-viewall a, #section-blog .ps-section-viewall a, .layout-2 .ps-about-section .left-about .read-more a, .cta-link a, .button-pricing a, .woocommerce-account .woocommerce input.button, .woocommerce-checkout .woocommerce input.button.alt, .woocommerce ul.products li.product .button, .woocommerce div.product form.cart .button, .woocommerce .cart .coupon input.button, .woocommerce  .return-to-shop a, .form-booking  input[type=submit]{
                        background-color: rgba({$r}, {$g}, {$b}, 0.8);
                }";

                $custom_css .= "footer.site-footer .site-info a:hover{
                        color: rgba({$r}, {$g}, {$b}, 0.78);
                }";

                $custom_css .= ".ps-home-section#section-fact.layout-2:before{
                        background-color: rgba({$r}, {$g}, {$b}, 0.8);
                }";

                $custom_css .= "#section-quicklink:before{
                        background-color: rgba({$r}, {$g}, {$b}, 0.9);
                }";
                wp_add_inline_style( 'parallaxsome-style', $custom_css );
        }

        add_action( 'wp_enqueue_scripts', 'parallaxsome_dynamic_styles' );
}

/**
 * Helper Functions for color settings
 */

// Increase / Decrease Color Brightness by certain percentage
function parallaxsome_colourBrightness($hex, $percent) {
        // Work out if hash given
        $hash = '';
        if (stristr($hex, '#')) {
            $hex = str_replace('#', '', $hex);
            $hash = '#';
        }
        /// HEX TO RGB
        $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
        //// CALCULATE 
        for ($i = 0; $i < 3; $i++) {
            // See if brighter or darker
            if ($percent > 0) {
                // Lighter
                $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
            } else {
                // Darker
                $positivePercent = $percent - ($percent * 2);
                $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
            }
            // In case rounding up causes us to go to 256
            if ($rgb[$i] > 255) {
                $rgb[$i] = 255;
            }
        }
        //// RBG to Hex
        $hex = '';
        for ($i = 0; $i < 3; $i++) {
            // Convert the decimal digit to hex
            $hexDigit = dechex($rgb[$i]);
            // Add a leading zero if necessary
            if (strlen($hexDigit) == 1) {
                $hexDigit = "0" . $hexDigit;
            }
            // Append to the hex string
            $hex .= $hexDigit;
        }
        return $hash . $hex;
}

// Change hex color code to rgb
function parallaxsome_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
}
?>