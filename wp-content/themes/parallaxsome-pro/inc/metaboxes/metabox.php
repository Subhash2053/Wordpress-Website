<?php
/**
 * Create a metabox to added some custom filed in posts.
 *
 * @package AccessPress Themes
 * @subpackage ParallaxSome
 * @since 1.0.0
 */

 add_action( 'add_meta_boxes', 'parallaxsome_post_meta_options' );
 
 if( ! function_exists( 'parallaxsome_post_meta_options' ) ):
 function  parallaxsome_post_meta_options() {
    add_meta_box(
        'parallaxsome_post_meta', // $id
        esc_html__( 'Post Options', 'parallaxsome-pro' ), // $title
        'parallaxsome_post_meta_callback', // $callback
        array('post', 'page', 'blog'), // $page
        'normal', // $context
        'high'
    ); // $priority
 }
 endif;

 $parallaxsome_post_sidebar_options = array(
    'default-layout' => array(
        'id'		=> 'post-defalut-layout',
        'value'     => 'default_sidebar_layout',
        'label'     => esc_html__( 'Default Sidebar', 'parallaxsome-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/default-sidebar.png'
    ), 
    'left-sidebar' => array(
        'id'		=> 'post-right-sidebar',
        'value'     => 'left_sidebar',
        'label'     => esc_html__( 'Left sidebar', 'parallaxsome-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png'
    ), 
    'right-sidebar' => array(
        'id'		=> 'post-left-sidebar',
        'value' => 'right_sidebar',
        'label' => esc_html__( 'Right sidebar', 'parallaxsome-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png'
    ),
    'no-sidebar' => array(
        'id'		=> 'post-no-sidebar',
        'value'     => 'no_sidebar',
        'label'     => esc_html__( 'No sidebar Full width', 'parallaxsome-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png'
    ),        
    'no-sidebar-center' => array(
        'id'		=> 'post-no-sidebar-center',
        'value'     => 'no_sidebar_center',
        'label'     => esc_html__( 'No sidebar Content Centered', 'parallaxsome-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png'
    )
);

/**
 * Callback function for post option
 */
if( ! function_exists( 'parallaxsome_post_meta_callback' ) ):
	function parallaxsome_post_meta_callback() {
		global $post, $parallaxsome_post_sidebar_options;
		wp_nonce_field( basename( __FILE__ ), 'parallaxsome_post_meta_nonce' );
        ?>
		<div class="ps-meta-container clearfix">
			<ul class="ps-meta-menu-wrapper">
				<li class="ps-meta-tab active" id="ps-info-tab"><span class="dashicons dashicons-clipboard"></span><?php esc_html_e( 'Information', 'parallaxsome-pro' ); ?></li>
				<li class="ps-meta-tab" id="ps-sidebar-tab"><span class="dashicons dashicons-exerpt-view"></span><?php esc_html_e( 'Sidebars', 'parallaxsome-pro' ); ?></li>
			</ul><!-- .ps-meta-menu-wrapper -->
			<div class="ps-metabox-content-wrapper">
				
				<!-- Info tab content -->
				<div class="ps-single-meta active" id="ps-info-content">
					<div class="content-header">
						<h4><?php esc_html_e( 'About Metabox Options', 'parallaxsome-pro' ) ;?></h4>
					</div><!-- .content-header -->
					<div class="meta-options-wrap"><?php esc_html_e('If we choose sidebar layout from the metabox optiin the page or post will show sidebar layout form the metabox and if we leave empty the sidebar layout will display form customizer->Design Setting.','parallaxsome-pro') ?></div><!-- .meta-options-wrap  -->
				</div><!-- #ps-info-content -->

				<!-- Sidebar tab content -->
				<div class="ps-single-meta" id="ps-sidebar-content">
					<div class="content-header">
						<h4><?php esc_html_e( 'Available Sidebars', 'parallaxsome-pro' ) ;?></h4>
						<span class="section-desc"><em><?php esc_html_e( 'Select sidebar from available options which replaced sidebar layout from customizer settings.', 'parallaxsome-pro' ); ?></em></span>
					</div><!-- .content-header -->
					<div class="ps-meta-options-wrap">
						<div class="buttonset">
							<?php
			                   	foreach ( $parallaxsome_post_sidebar_options as $field ) {
			                    	$parallaxsome_post_sidebar = get_post_meta( $post->ID, 'ps_post_sidebar_layout', true );
                                    $parallaxsome_post_sidebar = !empty($parallaxsome_post_sidebar) ? $parallaxsome_post_sidebar : 'default_sidebar_layout';
			                ?>
			                    	<input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo $field['value']; ?>" name="ps_post_sidebar_layout" <?php checked( $field['value'], $parallaxsome_post_sidebar ); ?> />
			                    	<label for="<?php echo esc_attr( $field['id'] ); ?>">
			                    		<span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
			                    		<img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
			                    	</label>
			                    
			                <?php } ?>
						</div><!-- .buttonset -->
					</div><!-- .meta-options-wrap  -->
				</div><!-- #ps-sidebar-content -->
			</div><!-- .ps-metabox-content-wrapper -->
		</div><!-- .ps-meta-container -->
    <?php		
	}
endif;

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Function for save value of meta opitons
 *
 * @since 1.0.0
 */

add_action( 'save_post', 'parallaxsome_save_post_meta' );

if( ! function_exists( 'parallaxsome_save_post_meta' ) ):
function parallaxsome_save_post_meta( $post_id ) {

    global $post;

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'parallaxsome_post_meta_nonce' ] ) || !wp_verify_nonce( wp_unslash($_POST['parallaxsome_post_meta_nonce'] ), basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;

    //Execute this saving function
    $old = get_post_meta( $post_id, 'ps_post_sidebar_layout', true ); 
    $new = sanitize_text_field( wp_unslash( $_POST['ps_post_sidebar_layout'] ));
    if ( $new && $new != $old ) {  
        update_post_meta ( $post_id, 'ps_post_sidebar_layout', $new );  
    }
}
endif;