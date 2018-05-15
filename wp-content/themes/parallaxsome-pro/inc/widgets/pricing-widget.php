<?php
/**
 * Testimonial post/page widget
 *
 * @package parallaxsome lite
 */
/**
 * Adds parallaxsome_Testimonial widget.
 */
 if(!function_exists('parallaxsome_register_pricing_widget')){
add_action('widgets_init', 'parallaxsome_register_pricing_widget');

function parallaxsome_register_pricing_widget() {
    register_widget('parallaxsome_pricing');
}
}
if(!class_exists('parallaxsome_pricing')){
class parallaxsome_pricing extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'parallaxsome_pricing', esc_html__('Parallaxsome : Pricing Table','parallaxsome-pro'), array(
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
            'ps_offer_title' => array(
                'parallaxsome_widgets_name' => 'ps_offer_title',
                'parallaxsome_widgets_title' => esc_html__('Offer Title', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_pricing_currecy' => array(
                'parallaxsome_widgets_name' => 'ps_pricing_currecy',
                'parallaxsome_widgets_title' => esc_html__('Currency', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_pricing_price' => array(
                'parallaxsome_widgets_name' => 'ps_pricing_price',
                'parallaxsome_widgets_title' => esc_html__('Price', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_service_duration' => array(
                'parallaxsome_widgets_name' => 'ps_service_duration',
                'parallaxsome_widgets_title' => esc_html__('Service Duration', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_service_feature_1' => array(
                'parallaxsome_widgets_name' => 'ps_service_feature_1',
                'parallaxsome_widgets_title' => esc_html__('Service Feature One', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_service_feature_2' => array(
                'parallaxsome_widgets_name' => 'ps_service_feature_2',
                'parallaxsome_widgets_title' => esc_html__('Service Feature Two', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_service_feature_3' => array(
                'parallaxsome_widgets_name' => 'ps_service_feature_3',
                'parallaxsome_widgets_title' => esc_html__('Service Feature Three', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_service_feature_4' => array(
                'parallaxsome_widgets_name' => 'ps_service_feature_4',
                'parallaxsome_widgets_title' => esc_html__('Service Feature Four', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_service_feature_5' => array(
                'parallaxsome_widgets_name' => 'ps_service_feature_5',
                'parallaxsome_widgets_title' => esc_html__('Service Feature Five', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_service_feature_6' => array(
                'parallaxsome_widgets_name' => 'ps_service_feature_6',
                'parallaxsome_widgets_title' => esc_html__('Service Feature Six', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_service_feature_7' => array(
                'parallaxsome_widgets_name' => 'ps_service_feature_7',
                'parallaxsome_widgets_title' => esc_html__('Service Feature Seven', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_service_feature_8' => array(
                'parallaxsome_widgets_name' => 'ps_service_feature_8',
                'parallaxsome_widgets_title' => esc_html__('Service Feature Eight', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_offer_link_button_title' => array(
                'parallaxsome_widgets_name' => 'ps_offer_link_button_title',
                'parallaxsome_widgets_title' => esc_html__('Link Button Text', 'parallaxsome-pro'),
                'parallaxsome_widgets_field_type' => 'text',
            ),
            'ps_offer_button_link' => array(
                'parallaxsome_widgets_name' => 'ps_offer_button_link',
                'parallaxsome_widgets_title' => esc_html__('Button Link', 'parallaxsome-pro'),
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
            $ps_offer_title = $instance['ps_offer_title'];
            $ps_pricing_currecy = $instance['ps_pricing_currecy'];
            $ps_pricing_price = $instance['ps_pricing_price'];
            $ps_service_duration = $instance['ps_service_duration'];
            $ps_service_feature_1 = $instance['ps_service_feature_1'];
            $ps_service_feature_2 = $instance['ps_service_feature_2'];
            $ps_service_feature_3 = $instance['ps_service_feature_3'];
            $ps_service_feature_4 = $instance['ps_service_feature_4'];
            $ps_service_feature_5 = $instance['ps_service_feature_5'];
            $ps_service_feature_6 = $instance['ps_service_feature_6'];
            $ps_service_feature_7 = $instance['ps_service_feature_7'];
            $ps_service_feature_8 = $instance['ps_service_feature_8'];
            $ps_offer_link_button_title = $instance['ps_offer_link_button_title'];
            $ps_offer_button_link = $instance['ps_offer_button_link'];
        ?>
            <div class="pricing-wrap">
                <div class="top-pricing">
                    <?php if($ps_offer_title){ ?>
                        <div class="sticker-title"><?php echo esc_attr($ps_offer_title); ?></div>
                    <?php } ?>
                    <?php if($ps_pricing_currecy || $ps_pricing_price){ ?>
                        <div class="pricing-price-title">
                            <?php if($ps_pricing_currecy){ ?><span class="currency"><?php echo esc_html($ps_pricing_currecy); ?></span> <?php }?>
                            <?php if($ps_pricing_price){ ?><span class="ptice"><?php echo esc_html($ps_pricing_price); ?></span> <?php }?>
                        </div>
                    <?php }?>
                    <?php if($ps_service_duration){?>
                        <div class="duration-pricing"><?php echo esc_html($ps_service_duration); ?></div>
                    <?php } ?>
                </div>
                <div class="mid-pricong">
                    <?php if($ps_service_feature_1){ ?>
                        <div class="feature-title"><?php echo esc_html($ps_service_feature_1); ?></div>
                    <?php } ?>
                    <?php if($ps_service_feature_2){ ?>
                        <div class="feature-title"><?php echo esc_html($ps_service_feature_2); ?></div>
                    <?php } ?>
                    <?php if($ps_service_feature_3){ ?>
                        <div class="feature-title"><?php echo esc_html($ps_service_feature_3); ?></div>
                    <?php } ?>
                    <?php if($ps_service_feature_4){ ?>
                        <div class="feature-title"><?php echo esc_html($ps_service_feature_4); ?></div>
                    <?php } ?>
                    <?php if($ps_service_feature_5){ ?>
                        <div class="feature-title"><?php echo esc_html($ps_service_feature_5); ?></div>
                    <?php } ?>
                    <?php if($ps_service_feature_6){ ?>
                        <div class="feature-title"><?php echo esc_html($ps_service_feature_6); ?></div>
                    <?php } ?>
                    <?php if($ps_service_feature_7){ ?>
                        <div class="feature-title"><?php echo esc_html($ps_service_feature_7); ?></div>
                    <?php } ?>
                    <?php if($ps_service_feature_8){ ?>
                        <div class="feature-title"><?php echo esc_html($ps_service_feature_8); ?></div>
                    <?php } ?>
                </div>
                <?php if($ps_offer_button_link || $ps_offer_link_button_title){ ?>
                    <div class="button-pricing">
                        <a href="<?php echo esc_url($ps_offer_button_link); ?>" target="_blank"><?php echo esc_html($ps_offer_link_button_title); ?></a>
                    </div>
                <?php } ?>
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