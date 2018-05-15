<?php
/**
 * Woocommerce Functions
 */
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
add_action('woocommerce_before_main_content','parallaxsome_woocommerce_breadcrumb',20);
remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
add_action('woocommerce_before_main_content','parallaxsome_woocommerce_wrap_start',22);
add_action('woocommerce_after_main_content','parallaxsome_woocommerce_wrap_end',12);
remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end',10);

function parallaxsome_woocommerce_breadcrumb(){
    do_action('parallaxsome-breadcrumb');
}
function parallaxsome_woocommerce_wrap_start(){
    ?>
    	<div id="primary" class="content-area">
		<main id="main" class="site-main">
    <?php
}
function parallaxsome_woocommerce_wrap_end(){
    ?>
            </main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar();
}