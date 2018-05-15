<?php
/**
 * Testimonial post/page widget
 *
 * @package parallaxsome lite
 */
/**
 * Adds parallaxsome_Testimonial widget.
 */
 if(!function_exists('parallaxsome_register_info_widget')){
add_action('widgets_init', 'parallaxsome_register_info_widget');

function parallaxsome_register_info_widget() {
    register_widget('parallaxsome_info');
}
}
if(!class_exists('parallaxsome_info')){
class parallaxsome_info extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'parallaxsome_info', esc_html__('Parallaxsome : Footer Info','parallaxsome-pro'), array(
            'description' => esc_html__('A widget that shows information', 'parallaxsome-pro')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // This widget has no title
            // Other fields
            'title_info' => array(
                'parallaxsome_widgets_name' => 'title_info',
                'parallaxsome_widgets_title' => esc_html__('Info Title', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'location' => array(
                'parallaxsome_widgets_name' => 'location',
                'parallaxsome_widgets_title' => esc_html__('Location', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'phone' => array(
                'parallaxsome_widgets_name' => 'phone',
                'parallaxsome_widgets_title' => esc_html__('Phone', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'fax' => array(
                'parallaxsome_widgets_name' => 'fax',
                'parallaxsome_widgets_title' => esc_html__('Fax', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'email' => array(
                'parallaxsome_widgets_name' => 'email',
                'parallaxsome_widgets_title' => esc_html__('Email', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
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
        $parallaxsome_title_info = $instance['title_info'];
        $parallaxsome_location = $instance['location'];
        $parallaxsome_phome = $instance['phone'];
        $parallaxsome_fax = $instance['fax'];
        $parallaxsome_email = $instance['email'];
            ?>
                <div class="footer_info_wrap">
                    <?php if($parallaxsome_title_info){ ?>
                        <h3 class="widget-title">
                            <?php echo esc_attr($parallaxsome_title_info); ?>
                        </h3>   
                    <?php } ?>
                    <div class="info_wrap">
                        <?php if($parallaxsome_location){ ?>
                            <div class="location_info">
                                <span class="fa_icon_info"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                <span class="location"><?php echo esc_html($parallaxsome_location); ?></span>
                            </div>
                        <?php } ?>
                        <?php if($parallaxsome_phome){ ?>
                            <div class="phone_info">
                                <span class="fa_icon_info"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                <span class="phone"><?php echo esc_html($parallaxsome_phome); ?></span>
                            </div>
                        <?php } ?>
                        <?php if($parallaxsome_fax){ ?>
                            <div class="fax_info">
                                <span class="fa_icon_info"><i class="fa fa-fax" aria-hidden="true"></i></span>
                                <span class="fax"><?php echo esc_html($parallaxsome_fax); ?></span>
                            </div>
                        <?php } ?>
                        <?php if($parallaxsome_email){ ?>
                            <div class="email_info">
                                <span class="fa_icon_info"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <span class="email"><?php echo esc_html($parallaxsome_email); ?></span>
                            </div>
                        <?php } ?>
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