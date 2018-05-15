<?php

/**
 * @package parallaxsome
 */
function parallaxsome_widgets_show_widget_field($instance = '', $widget_field = '', $athm_field_value = '') {
    // Store Posts in array
    $parallaxsome_postlist[0] = array(
        'value' => 0,
        'label' => esc_html__('--choose--','parallaxsome-pro')
    );
    $arg = array('posts_per_page' => -1);
    $parallaxsome_posts = get_posts($arg);
    foreach ($parallaxsome_posts as $parallaxsome_post) :
        $parallaxsome_postlist[$parallaxsome_post->ID] = array(
            'value' => $parallaxsome_post->ID,
            'label' => $parallaxsome_post->post_title
        );
    endforeach;

    extract($widget_field);

    switch ($parallaxsome_widgets_field_type) {

        // Standard text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>"><?php echo wp_kses_post($parallaxsome_widgets_title); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($parallaxsome_widgets_name)); ?>" type="text" value="<?php echo esc_attr($athm_field_value); ?>" />

                <?php if (isset($parallaxsome_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($parallaxsome_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Standard url field
        case 'url' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>"><?php echo wp_kses_post($parallaxsome_widgets_title); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($parallaxsome_widgets_name)); ?>" type="text" value="<?php echo esc_attr($athm_field_value); ?>" />

                <?php if (isset($parallaxsome_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($parallaxsome_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Textarea field
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>"><?php echo wp_kses_post($parallaxsome_widgets_title); ?>:</label>
                <textarea class="widefat" rows="<?php echo $parallaxsome_widgets_row; ?>" id="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($parallaxsome_widgets_name)); ?>"><?php echo wp_kses_post($athm_field_value); ?></textarea>
            </p>
            <?php
            break;

        // Checkbox field
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($parallaxsome_widgets_name)); ?>" type="checkbox" value="1" <?php checked('1', $athm_field_value); ?>/>
                <label for="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>"><?php echo wp_kses_post($parallaxsome_widgets_title); ?></label>

                <?php if (isset($parallaxsome_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($parallaxsome_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Radio fields
        case 'radio' :
            ?>
            <p>
                <?php
                echo wp_kses_post($parallaxsome_widgets_title);
                echo '<br />';
                foreach ($parallaxsome_widgets_field_options as $athm_option_name => $athm_option_title) {
                    ?>
                    <input id="<?php echo esc_attr($instance->get_field_id($athm_option_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($parallaxsome_widgets_name)); ?>" type="radio" value="<?php echo esc_attr($athm_option_name); ?>" <?php checked($athm_option_name, $athm_field_value); ?> />
                    <label for="<?php echo esc_attr($instance->get_field_id($athm_option_name)); ?>"><?php echo wp_kses_post($athm_option_title); ?></label>
                    <br />
                <?php } ?>

                <?php if (isset($parallaxsome_widgets_description)) { ?>
                    <small><?php echo wp_kses_post($parallaxsome_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'select' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>"><?php echo wp_kses_post($parallaxsome_widgets_title); ?>:</label>
                <select name="<?php echo esc_attr($instance->get_field_name($parallaxsome_widgets_name)); ?>" id="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>" class="widefat">
                    <?php foreach ($parallaxsome_widgets_field_options as $athm_option_name => $athm_option_title) { ?>
                        <option value="<?php echo esc_attr($athm_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id($athm_option_name)); ?>" <?php selected($athm_option_name, $athm_field_value); ?>><?php echo wp_kses_post($athm_option_title); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($parallaxsome_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($parallaxsome_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'number' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>"><?php echo wp_kses_post($parallaxsome_widgets_title); ?>:</label><br />
                <input name="<?php echo esc_attr($instance->get_field_name($parallaxsome_widgets_name)); ?>" type="number" step="1" min="1" id="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>" value="<?php echo wp_kses_post($athm_field_value); ?>" class="small-text" />

                <?php if (isset($parallaxsome_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($parallaxsome_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'selectpost' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>"><?php echo wp_kses_post($parallaxsome_widgets_title); ?>:</label>
                <select name="<?php echo esc_attr($instance->get_field_name($parallaxsome_widgets_name)); ?>" id="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>" class="widefat">
                    <?php foreach ($parallaxsome_postlist as $parallaxsome_single_post) { ?>
                        <option value="<?php echo esc_attr($parallaxsome_single_post['value']); ?>" id="<?php echo esc_attr($instance->get_field_id($parallaxsome_single_post['label'])); ?>" <?php selected($parallaxsome_single_post['value'], $athm_field_value); ?>><?php echo wp_kses_post($parallaxsome_single_post['label']); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($parallaxsome_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($parallaxsome_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'upload' :

            $output = '';
            $id = esc_attr($instance->get_field_id($parallaxsome_widgets_name));
            $class = '';
            $int = '';
            $value = $athm_field_value;
            $name = esc_attr($instance->get_field_name($parallaxsome_widgets_name));


            if ($value) {
                $class = ' has-file';
                $value = explode('wp-content',$value);
                $value = content_url().$value[1];
            }
            $output .= '<div class="sub-option widget-upload">';
            $output .= '<label for="' . $instance->get_field_id($parallaxsome_widgets_name) . '">' . $parallaxsome_widgets_title . '</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_attr__('No file chosen', 'parallaxsome-pro') . '" />' . "\n";
            if (function_exists('wp_enqueue_media')) {
                    $output .= '<input id="upload-' . $id . '" class="upload-button button" type="button" value="' . esc_attr__('Upload', 'parallaxsome-pro') . '" />' . "\n";
            } else {
                $output .= '<p><i>' . esc_attr__('Upgrade your version of WordPress for full media support.', 'parallaxsome-pro') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";

            if ($value != '') {
                $remove = '<a class="remove-image">'. esc_attr__('Remove', 'parallaxsome-pro').'</a>';
                $attachment_id = attachment_url_to_postid($value);
                $image_array = wp_get_attachment_image_src($attachment_id, 'medium');
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img width="276px" src="' . esc_url($image_array[0]) . '" alt="" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }

                    // No output preview if it's not an image.
                    $output .= '';

                    // Standard generic output if it's not an image.
                    $title = esc_attr__('View File', 'parallaxsome-pro');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . esc_url($value) . '" target="_blank" rel="external">' . esc_attr($title) . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;

        case 'icon' :
            add_thickbox();
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>"><?php echo wp_kses_post($parallaxsome_widgets_title); ?>:</label><br />
                <span class="icon-receiver"><i class="<?php echo esc_attr($athm_field_value); ?>"></i></span>
                <input class="hidden-icon-input" name="<?php echo esc_attr($instance->get_field_name($parallaxsome_widgets_name)); ?>" type="hidden" id="<?php echo esc_attr($instance->get_field_id($parallaxsome_widgets_name)); ?>" value="<?php echo esc_attr($athm_field_value); ?>" />

                <?php if (isset($parallaxsome_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($parallaxsome_widgets_description); ?></small>
                <?php } ?>
            </p>

            <div id="ap-font-awesome-list">
                <ul class="ap-font-group">
                <?php $parallaxsome_icons = parallaxsome_icons_array(); 
                foreach($parallaxsome_icons as $parallaxsome_icon){?>
                    <li><i class="fa <?php echo esc_attr($parallaxsome_icon); ?>"></i></li>
                <?php } ?>
                </ul>
            </div>

            <?php
            break;
    }
}

function parallaxsome_widgets_updated_field_value($widget_field, $new_field_value) {

    extract($widget_field);

    // Allow only integers in number fields
    if ($parallaxsome_widgets_field_type == 'number') {
        return absint($new_field_value);

        // Allow some tags in textareas
    } elseif ($parallaxsome_widgets_field_type == 'textarea') {
        // Check if field array specifed allowed tags
        return wp_kses_post($new_field_value);

        // No allowed tags for all other fields
    } elseif ($parallaxsome_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    } else {
        return wp_kses_post($new_field_value);
    }
}


