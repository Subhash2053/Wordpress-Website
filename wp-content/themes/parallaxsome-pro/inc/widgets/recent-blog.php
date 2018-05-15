<?php
/**
 * Testimonial post/page widget
 *
 * @package parallaxsome lite
 */
/**
 * Adds parallaxsome_Testimonial widget.
 */
 if(!function_exists('parallaxsome_register_recent_blog_widget')){
add_action('widgets_init', 'parallaxsome_register_recent_blog_widget');

function parallaxsome_register_recent_blog_widget() {
    register_widget('parallaxsome_recent_blog');
}
}
if(!class_exists('parallaxsome_recent_blog')){
class parallaxsome_recent_blog extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'parallaxsome_recent_blog', esc_html__('parallaxsome : Recent Blog','parallaxsome-pro'), array(
            'description' => esc_html__('A widget that shows Recent blog', 'parallaxsome-pro')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $categories_list = parallaxsome_category_list();
        $fields = array(
            // This widget has no title
            // Other fields
            'recent_blog_title' => array(
                'parallaxsome_widgets_name' => 'recent_blog_title',
                'parallaxsome_widgets_title' => esc_html__('Recent Posts Title', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'recent_blog_posts' => array(
                'parallaxsome_widgets_name' => 'recent_blog_posts',
                'parallaxsome_widgets_title' => esc_html__('Post To Display', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'number',
            ),
            'recent_blog_image' => array(
                'parallaxsome_widgets_name' => 'recent_blog_image',
                'parallaxsome_widgets_title' => esc_html__('Hide Image', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'checkbox',
            ),
            'recent_enable_date' => array(
                'parallaxsome_widgets_name' => 'recent_enable_date',
                'parallaxsome_widgets_title' => esc_html__('Enable Date', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'checkbox',
            ),
            'recent_disable_contents' => array(
                'parallaxsome_widgets_name' => 'recent_disable_contents',
                'parallaxsome_widgets_title' => esc_html__('Disable Contents', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'checkbox',
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        if($instance){
        $parallaxsome_blog_title = $instance['recent_blog_title'];
        $parallaxsome_recent_blog_posts = $instance['recent_blog_posts'];
        $parallaxsome_image_hide = $instance['recent_blog_image'];
        $parallaxsome_enable_date = $instance['recent_enable_date'];
        $parallaxsome_disable_contents = $instance['recent_disable_contents'];
        


       
        ?>

        <div class="footer_RN_wrap">
            <?php if($parallaxsome_blog_title){ ?>
                <h3 class="widget-title">
                    <?php echo esc_attr($parallaxsome_blog_title); ?>
                </h3>
               
            <?php } ?>  
            <div class="rn_post_wrap <?php if($parallaxsome_image_hide){echo 'no_image';} ?>">
                <?php
                    $parallaxsome_rn_args = array(
                        'post_type' => 'blog',
                        'order' => 'DESC',
                        'posts_per_page' => $parallaxsome_recent_blog_posts
                    );
                    $parallaxsome_rn_query = new WP_Query($parallaxsome_rn_args);
                    if($parallaxsome_rn_query->have_posts()):
                        while($parallaxsome_rn_query->have_posts()):
                            $parallaxsome_rn_query->the_post();
                            ?>
                                <div class="rn_post_loop">
                                    <?php if($parallaxsome_image_hide == ''){ ?>
                                    <?php 
                                        $parallaxsome_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'parallaxsome-footer-recent-news');
                                        $parallaxsome_image = $parallaxsome_image_url['0'];
                                    ?>
                                        <?php if($parallaxsome_image){ ?>
                                            <div class="rn_image"><a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($parallaxsome_image); ?>"  alt="<?php echo esc_attr(get_the_title()); ?>" /></a></div>
                                        <?php } ?>
                                    <?php } ?>
                                    <div class="title_content_wrap">
                                        <?php if(get_the_title()){ ?>
                                            <div class="tn_title"><a href="<?php the_permalink(); ?>"><?php echo wp_kses_post(wp_trim_words(get_the_title(),5,'...')); ?></a></div>
                                        <?php } ?>
                                        <?php 
                                        if(empty($parallaxsome_disable_contents)){
                                        if(get_the_content()){ ?>
                                            <div class="rn_content">
                                                <?php echo wp_kses_post(wp_trim_words(get_the_content(),5,'...')); ?>
                                            </div>
                                        <?php }
                                        }
                                        if($parallaxsome_enable_date){
                                            ?>
                                            <span class="date"><?php echo esc_attr(get_the_date('d F Y')); ?></span>
                                            <?php
                                        } ?>
                                    </div>
                                </div>
                            <?php
                        endwhile;
                    endif;
                ?>
            </div>
        </div>

        <?php
        }
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	parallaxsome_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$parallaxsome_widgets_name] = parallaxsome_widgets_updated_field_value($widget_field, $new_instance[$parallaxsome_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	parallaxsome_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();
        // Loop through fields
        foreach ($widget_fields as $widget_field) {
            // Make array elements available as variables
            extract($widget_field);
            $parallaxsome_widgets_field_value = !empty($instance[$parallaxsome_widgets_name]) ? esc_attr($instance[$parallaxsome_widgets_name]) : '';
            parallaxsome_widgets_show_widget_field($this, $widget_field, $parallaxsome_widgets_field_value);
        }
    }

}
}