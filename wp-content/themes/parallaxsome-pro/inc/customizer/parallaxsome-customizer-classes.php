<?php
/**
 * Define some custom classes for parallaxsome.
 * 
 * https://codex.wordpress.org/Class_Reference/WP_Customize_Control
 *
 * @package AccessPress Themes
 * @subpackage ParallaxSome
 * @since 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
     * Switch button customize control.
     *
     * @since 1.0.0
     * @access public
     */
    class Parallaxsome_Customize_Switch_Control extends WP_Customize_Control {

    	/**
	     * The type of customize control being rendered.
	     *
	     * @since  1.0.0
	     * @access public
	     * @var    string
	     */
		public $type = 'switch';

		/**
	     * Displays the control content.
	     *
	     * @since  1.0.0
	     * @access public
	     * @return void
	     */
		public function render_content() {
	?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
		        <div class="switch_options">
		        	<?php 
		        		$show_choices = $this->choices;
		        		foreach ( $show_choices as $key => $value ) {
		        			echo '<span class="switch_part '.esc_attr($key).'" data-switch="'.esc_attr($key).'">'. esc_attr($value).'</span>';
		        		}
		        	?>
                  	<input type="hidden" id="ap_switch_option" <?php $this->link(); ?> value="<?php echo $this->value(); ?>" />
                </div>
            </label>
	<?php
		}
	}
    
    class parallaxsome_Section_Re_Order extends WP_Customize_Control {
      
          public $type = 'dragndrop';
            /**
             * Render the content of the category dropdown
             *
             * @return HTML
             */
            public function render_content() {
    
                if ( empty( $this->choices ) ){
                  return;
                }
            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                  <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <ul class="controls" id ="tm-sections-reorder">
                <?php
                    $default_short_array = array();
                    foreach ( $this->choices as $value => $label ) {
                          $default_short_array[$value] = $label;
                    }
                    $order_save_value = get_theme_mod( $this->id );
                    
                    if( !empty( $order_save_value ) ) {
                      $order_save_array = explode( ',' , $order_save_value);
                      foreach ($order_save_array as $key => $value) {?>
        
                        <li class="tm-section-element" data-section-name="<?php echo esc_attr( $value );?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_attr( $default_short_array[$value] ); ?></li>
                <?php      
                      }
                      $section_order_list = $order_save_value;
                    }
                    else {
                        $order_array = array();
                        foreach ( $this->choices as $value => $label ) {
                            $order_array[] = $value;            ?>
                            <li class="tm-section-element" data-section-name="<?php echo esc_attr( $value );?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_attr( $label ); ?></li>
                            <?php
                        }
                        $section_order_list = implode ( "," , $order_array );
                  }?>
                <input id="shortui-order" type="hidden" <?php $this->link(); ?> value="<?php echo $section_order_list; ?>" />  
            </ul>        
            <?php
        }
      }

  	class parallaxsome_Section_Re_Order_Menu extends WP_Customize_Control {
      
          public $type = 'dragndrop';
            /**
             * Render the content of the category dropdown
             *
             * @return HTML
             */
            public function render_content() {
    
                if ( empty( $this->choices ) ){
                  return;
                }
            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                  <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <ul class="controls" id ="tm-sections-reorder-menu">
                <?php
                    $default_short_array = array();
                    foreach ( $this->choices as $value => $label ) {
                          $default_short_array[$value] = $label;
                    }
                    $order_save_value = get_theme_mod( $this->id );
                    
                    if( !empty( $order_save_value ) ) {
                      $order_save_array = explode( ',' , $order_save_value);
                      foreach ($order_save_array as $key => $value) {?>
        
                        <li class="tm-section-element" data-section-name="<?php echo esc_attr( $value );?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_attr( $default_short_array[$value] ); ?></li>
                <?php      
                      }
                      $section_order_list = $order_save_value;
                    }
                    else {
                        $order_array = array();
                        foreach ( $this->choices as $value => $label ) {
                            $order_array[] = $value;            ?>
                            <li class="tm-section-element" data-section-name="<?php echo esc_attr( $value );?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_attr( $label ); ?></li>
                            <?php
                        }
                        $section_order_list = implode ( "," , $order_array );
                  } ?>
                <input id="shortui-order-menu" type="hidden" <?php $this->link(); ?> value="<?php echo $section_order_list; ?>" />
            </ul>        
            <?php
        }
      }

	/**
	 * A class to create a dropdown for all categories in your wordpress site
	 *
	 * @since 1.0.0
	 * @access public
	 */
	class Parallaxsome_Customize_Category_Control extends WP_Customize_Control {
		
		/**
		 * Render the control's content.
		 *
		 * @return HTML
		 * @since 1.0.0
		 */
		public function render_content() {
			$dropdown = wp_dropdown_categories(
					array(
						'name'              => '_customize-dropdown-categories-' . $this->id,
						'echo'              => 0,
						'show_option_none'  => esc_html__( '&mdash; Select Category &mdash;', 'parallaxsome-pro' ),
						'option_none_value' => '0',
						'selected'          => $this->value(),
                        'value_field'       => 'slug',
					)
			);

			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s </label>',
				$this->label,
				$this->description,
				$dropdown
			);
		}
	}

	/**
	 * A class to create a list of icons in customizer field
	 *
	 * @since 1.0.0
	 * @access public
	 */
	class Parallaxsome_Customize_Icons_Control extends WP_Customize_Control {

		/**
	     * The type of customize control being rendered.
	     *
	     * @since  1.0.0
	     * @access public
	     * @var    string
	     */
		public $type = 'parallaxsome_icons';

		/**
	     * Displays the control content.
	     *
	     * @since  1.0.0
	     * @access public
	     * @return void
	     */
		public function render_content() {

			$saved_icon_value = $this->value();
	?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<div class="ap-customize-icons">
					<div class="selected-icon-preview"><?php if( !empty( $saved_icon_value ) ) { echo '<i class="fa '. esc_attr($saved_icon_value) .'"></i>'; } ?></div>
					<ul class="icons-list-wrapper">
						<?php 
							$parallaxsome_icons_list = parallaxsome_icons_array();
							foreach ( $parallaxsome_icons_list as $key => $icon_value ) {
								if( $saved_icon_value == $icon_value ) {
									echo '<li class="selected"><i class="fa '. esc_attr($icon_value) .'"></i></li>';
								} else {
									echo '<li><i class="fa '. esc_attr($icon_value) .'"></i></li>';
								}
							}
						?>
					</ul>
					<input type="hidden" class="ap-icon-value" value="" <?php $this->link(); ?>>
				</div>

			</label>
	<?php
		}
	}

	/**
	 * A class to create a option separator in customizer section 
	 *
	 *@since 1.0.0
	 */
	class Parallaxsome_Customize_Section_Separator extends WP_Customize_Control {
		/**
	     * The type of customize control being rendered.
	     *
	     * @since  1.0.0
	     * @access public
	     * @var    string
	     */
		public $type = 'parallaxsome_separator';

		/**
	     * Displays the control content.
	     *
	     * @since  1.0.0
	     * @access public
	     * @return void
	     */
		public function render_content() {
	?>
		<div class="ap-customize-section-wrap">
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			</label>
		</div>
	<?php
		}
	}

	/**
	 * Multiple checkbox customize control class.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class Parallaxsome_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

	    /**
	     * The type of customize control being rendered.
	     *
	     * @since  1.0.0
	     * @access public
	     * @var    string
	     */
	    public $type = 'checkbox-multiple';

	    /**
	     * Displays the control content.
	     *
	     * @since  1.0.0
	     * @access public
	     * @return void
	     */
	    public function render_content() {

	        if ( empty( $this->choices ) )
	            return; ?>

	        <?php if ( !empty( $this->label ) ) : ?>
	            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <?php endif; ?>

	        <?php if ( !empty( $this->description ) ) : ?>
	            <span class="description customize-control-description"><?php echo esc_textarea($this->description); ?></span>
	        <?php endif; ?>

	        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

	        <ul>
	            <?php foreach ( $this->choices as $value => $label ) : ?>

	                <li>
	                    <label>
	                        <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
	                        <?php echo esc_html( $label ); ?>
	                    </label>
	                </li>

	            <?php endforeach; ?>
	        </ul>

	        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
	    <?php }
	}

	/**
	 * Class to create a custom editor field in customizer section
	 *
	 * @access public
	 * @since 1.0.0
	 */
	class Parallaxsome_Text_Editor_Custom_Control extends WP_Customize_Control {
	    /**
	     * The type of customize control being rendered.
	     *
	     * @since  1.0.0
	     * @access public
	     * @var    string
	     */
	    public $type = 'parallaxsome-editor';

		/**
	     * Displays the control content.
	     *
	     * @since  1.0.0
	     * @access public
	     * @return void
	     */
		public function render_content() { ?>
			
			<label>
				<span class="customize-control-title">
					<?php echo esc_attr( $this->label ); ?>
				</span>
				<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
			</label>

		<?php
			$settings = array(
				'textarea_name'    => $this->id,
				'teeny'            => true,
			);
			wp_editor( esc_textarea( $this->value() ), $this->id, $settings );

			do_action('admin_print_footer_scripts');
		}
	}

	/**
	 * Radio image customize control.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class Parallaxsome_Customize_Control_Radio_Image extends WP_Customize_Control {
	    /**
	     * The type of customize control being rendered.
	     *
	     * @since  1.0.0
	     * @access public
	     * @var    string
	     */
	    public $type = 'radio-image';

	    /**
	     * Loads the jQuery UI Button script and custom scripts/styles.
	     *
	     * @since  1.0.0
	     * @access public
	     * @return void
	     */
	    /*public function enqueue() {
	        wp_enqueue_script( 'jquery-ui-button' );
	    }*/

	    /**
	     * Add custom JSON parameters to use in the JS template.
	     *
	     * @since  1.0.0
	     * @access public
	     * @return void
	     */
	    public function to_json() {
	        parent::to_json();

	        // We need to make sure we have the correct image URL.
	        foreach ( $this->choices as $value => $args )
	            $this->choices[ $value ]['url'] = esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) );

	        $this->json['choices'] = $this->choices;
	        $this->json['link']    = $this->get_link();
	        $this->json['value']   = $this->value();
	        $this->json['id']      = $this->id;
	    }


	    /**
	     * Underscore JS template to handle the control's output.
	     *
	     * @since  1.0.0
	     * @access public
	     * @return void
	     */

	    public function content_template() { ?>
	        <# if ( data.label ) { #>
	            <span class="customize-control-title">{{ data.label }}</span>
	        <# } #>

	        <# if ( data.description ) { #>
	            <span class="description customize-control-description">{{{ data.description }}}</span>
	        <# } #>

	        <div class="buttonset">

	            <# for ( key in data.choices ) { #>

	                <input type="radio" value="{{ key }}" name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" {{{ data.link }}} <# if ( key === data.value ) { #> checked="checked" <# } #> /> 

	                <label for="{{ data.id }}-{{ key }}">
	                    <span class="screen-reader-text">{{ data.choices[ key ]['label'] }}</span>
	                    <img src="{{ data.choices[ key ]['url'] }}" title="{{ data.choices[ key ]['label'] }}" alt="{{ data.choices[ key ]['label'] }}" />
	                </label>
	            <# } #>

	        </div><!-- .buttonset -->
	    <?php }
	}
    
    /**
     * Repeater Custom Control
    */
    class parallaxsome_Repeater_Controler extends WP_Customize_Control {
    	/**
    	 * The control type.
    	 *
    	 * @access public
    	 * @var string
    	*/
    	public $type = 'repeater';

    	public $parallaxsome_box_label = '';

    	public $parallaxsome_box_add_control = '';

    	private $cats = '';

    	/**
    	 * The fields that each container row will contain.
    	 *
    	 * @access public
    	 * @var array
    	 */
    	public $fields = array();

    	/**
    	 * Repeater drag and drop controler
    	 *
    	 * @since  1.0.0
    	 */
    	public function __construct( $manager, $id, $args = array(), $fields = array() ) {
    		$this->fields = $fields;
    		$this->parallaxsome_box_label = $args['parallaxsome_box_label'] ;
    		$this->parallaxsome_box_add_control = $args['parallaxsome_box_add_control'];
    		$this->cats = get_categories(array( 'hide_empty' => false ));
    		parent::__construct( $manager, $id, $args );
    	}

    	public function render_content() {

    		$values = json_decode($this->value());
    		?>
    		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

    		<?php if($this->description){ ?>
    			<span class="description customize-control-description">
    			<?php echo wp_kses_post($this->description); ?>
    			</span>
    		<?php } ?>

    		<ul class="parallaxsome-repeater-field-control-wrap">
    			<?php
    			$this->parallaxsome_get_fields();
    			?>
    		</ul>

    		<input type="hidden" <?php esc_attr( $this->link() ); ?> class="parallaxsome-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
    		<button type="button" class="button parallaxsome-add-control-field"><?php echo esc_html( $this->parallaxsome_box_add_control ); ?></button>
    		<?php
    	}

    	private function parallaxsome_get_fields(){
    		$fields = $this->fields;
    		$values = json_decode($this->value());

    		if(is_array($values)){
    		foreach($values as $value){
    		?>
    		<li class="parallaxsome-repeater-field-control">
    		<h3 class="parallaxsome-repeater-field-title"><?php echo esc_html( $this->parallaxsome_box_label ); ?></h3>
    		
    		<div class="parallaxsome-repeater-fields">
    		<?php
    			foreach ($fields as $key => $field) {
    			$class = isset($field['class']) ? $field['class'] : '';
    			?>
    			<div class="parallaxsome-fields parallaxsome-type-<?php echo esc_attr($field['type']).' '.$class; ?>">
	    			<?php 
	    				$label = isset($field['label']) ? $field['label'] : '';
	    				$description = isset($field['description']) ? $field['description'] : '';
	    				if($field['type'] != 'checkbox'){ ?>
	    					<span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
	    					<span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
	    				<?php 
	    				}

	    				$new_value = isset($value->$key) ? $value->$key : '';
	    				$default = isset($field['default']) ? $field['default'] : '';

	    				switch ($field['type']) {
	    					case 'text':
	    						echo '<input data-default="'.esc_attr($default).'" data-name="'.esc_attr($key).'" type="text" value="'.esc_attr($new_value).'"/>';
	    						break;

	    					case 'textarea':
	    						echo '<textarea data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">'.esc_textarea($new_value).'</textarea>';
	    						break;

	    					case 'upload':
	    						$image = $image_class= "";
	    						if($new_value){	
	    							$image = '<img src="'.esc_url($new_value).'" style="max-width:100%;"/>';	
	    							$image_class = ' hidden';
	    						}
	    						echo '<div class="parallaxsome-fields-wrap">';
	    						echo '<div class="attachment-media-view">';
	    						echo '<div class="placeholder'.$image_class.'">';
	    						_e('No image selected', 'parallaxsome-pro');
	    						echo '</div>';
	    						echo '<div class="thumbnail thumbnail-image">';
	    						echo $image;
	    						echo '</div>';
	    						echo '<div class="actions clearfix">';
	    						echo '<button type="button" class="button parallaxsome-delete-button align-left">'.esc_html__('Remove', 'parallaxsome-pro').'</button>';
	    						echo '<button type="button" class="button parallaxsome-upload-button alignright">'.esc_html__('Select Image', 'parallaxsome-pro').'</button>';
	    						echo '<input data-default="'.esc_attr($default).'" class="upload-id" data-name="'.esc_attr($key).'" type="hidden" value="'.esc_attr($new_value).'"/>';
	    						echo '</div>';
	    						echo '</div>';
	    						echo '</div>';							
	    						break;

	    					case 'category':
	    						echo '<select data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">';
	    						echo '<option value="0">'.esc_html__('Select Category', 'parallaxsome-pro').'</option>';
	    						echo '<option value="-1">'.esc_html__('Latest Posts', 'parallaxsome-pro').'</option>';
	                                foreach ( $this->cats as $cat )
	                                {
	                                    printf('<option value="%s" %s>%s</option>', esc_attr($cat->term_id), selected($new_value, $cat->term_id, false), esc_html($cat->name));
	                                }
	                      		echo '</select>';
	    						break;

	    					case 'select':
	    						$options = $field['options'];
	    						echo '<select  data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">';
	                                foreach ( $options as $option => $val )
	                                {
	                                    printf('<option value="%s" %s>%s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
	                                }
	                      		echo '</select>';
	    						break;

	    					case 'checkbox':
	    						echo '<label>';
	    						echo '<input data-default="'.esc_attr($default).'" value="'.$new_value.'" data-name="'.esc_attr($key).'" type="checkbox" '.checked($new_value, 'yes', false).'/>';
	    						echo esc_html( $label );
	    						echo '<span class="description customize-control-description">'.esc_html( $description ).'</span>';
	    						echo '</label>';
	    						break;
	    					
	    					case 'colorpicker':
	    						echo '<input data-default="'.esc_attr($default).'" class="parallaxsome-color-picker" data-alpha="true" data-name="'.esc_attr($key).'" type="text" value="'.esc_attr($new_value).'"/>';
	    						break;

	    					case 'selector':
	    						$options = $field['options'];
	    						echo '<div class="selector-labels">';
	    						foreach ( $options as $option => $val ){
	    							$class = ( $new_value == $option ) ? 'selector-selected': '';
	    							echo '<label class="'.$class.'" data-val="'.esc_attr($option).'">';
	    							echo '<img src="'.esc_url($val).'"/>';
	    							echo '</label>'; 
	    						}
	    						echo '</div>';
	    						echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
	    						break;

	    					case 'radio':
	    						$options = $field['options'];
	    						echo '<div class="radio-labels">';
	    						foreach ( $options as $option => $val ){
	    							echo '<label>';
	    							echo '<input value="'.esc_attr($option).'" type="radio" '.checked($new_value, $option, false).'/>';
	    							echo $val;
	    							echo '</label>'; 
	    						}
	    						echo '</div>';
	    						echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
	    						break;

	    					case 'switch':
	    						$switch = $field['switch'];
	    						$switch_class = ($new_value == 'on') ? 'switch-on' : '';
	    						echo '<div class="onoffswitch '.$switch_class.'">';
	    	                        echo '<div class="onoffswitch-inner">';
	    	                            echo '<div class="onoffswitch-active">';
	    	                                echo '<div class="onoffswitch-switch">'.esc_html($switch["on"]).'</div>';
	    	                            echo '</div>';
	    	                            echo '<div class="onoffswitch-inactive">';
	    	                                echo '<div class="onoffswitch-switch">'.esc_html($switch["off"]).'</div>';
	    	                            echo '</div>';
	    	                        echo '</div>';
	    		                echo '</div>';
	    		                echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
	    						break;

	    					case 'range':
	    						$options = $field['options'];
	    						$new_value = $new_value ? $new_value : $options['val'];
	    						echo '<div class="parallaxsome-range-slider" >';
	    						echo '<div class="range-input" data-defaultvalue="'. esc_attr($options['val']) .'" data-value="' . esc_attr($new_value) . '" data-min="' . esc_attr($options['min']) . '" data-max="' . esc_attr($options['max']) . '" data-step="' . esc_attr($options['step']) . '"></div>';
	    						echo '<input  class="range-input-selector" type="text" value="'.esc_attr($new_value).'"  data-name="'.esc_attr($key).'"/>';
	    						echo '<span class="unit">' . esc_html($options['unit']) . '</span>';
	    						echo '</div>';
	    						break;

	    					case 'icon':
	    						echo '<div class="parallaxsome-selected-icon">';
	    						echo '<i class="'.esc_attr($new_value).'"></i>';
	    						echo '<span><i class="fa fa-chevron-down"></i></span>';
	    						echo '</div>';
	    						echo '<ul class="parallaxsome-icon-list clearfix">';
	    						$parallaxsome_icons_array = parallaxsome_icons_array();
	    						foreach ($parallaxsome_icons_array as $parallaxsome_font_awesome_icon) {
	    							$icon_class = $new_value == $parallaxsome_font_awesome_icon ? 'icon-active' : '';
	    							echo '<li class='.$icon_class.'><i class="fa '.$parallaxsome_font_awesome_icon.'"></i></li>';
	    						}
	    						echo '</ul>';
	    						echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
	    						break;

	    					case 'multicategory':
	    						$new_value_array = !is_array( $new_value ) ? explode( ',', $new_value ) : $new_value;
	    						echo '<ul class="parallaxsome-multi-category-list">';
	    						echo '<li><label><input type="checkbox" value="-1" '. checked('-1', $new_value, false ) .'/>'.esc_html__( 'Latest Posts', 'parallaxsome-pro' ).'</label></li>';
	    						foreach ( $this->cats as $cat ){
	    							$checked = in_array( $cat->term_id, $new_value_array) ? 'checked="checked"' : '';
	    							echo '<li>';
	    							echo '<label>';
	    	                        echo '<input type="checkbox" value="'.esc_attr($cat->term_id).'" '. $checked .'/>'; 
	    	                        echo esc_html( $cat->name );
	    	                    	echo '</label>';
	    							echo '</li>';
	    						}
	    						echo '</ul>';
	    						echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr(implode( ',', $new_value_array )).'" data-name="'.esc_attr($key).'"/>';
	    						break;

	    					default:
	    						break;
	    				}
	    			?>
    			</div>
    			<?php
    			} ?>

    			<div class="clearfix parallaxsome-repeater-footer">
    				<div class="alignright">
    				<a class="parallaxsome-repeater-field-remove" href="#remove"><?php _e('Delete', 'parallaxsome-pro') ?></a> |
    				<a class="parallaxsome-repeater-field-close" href="#close"><?php _e('Close', 'parallaxsome-pro') ?></a>
    				</div>
    			</div>
    		</div>
    		</li>
    		<?php	
    		}
    		}
    	}

    }
    
    
    /** Pre Loader **/
    class parallaxsome_Ploader_Control extends WP_Customize_Control {
    		public $type = 'preload_icons';
     
    		public function render_content() {?>
    			<label>
                    <?php $image_pre = get_theme_mod('parallaxsome_pre_loader');
                    if($image_pre == ''){
                        $image_pre = 'loader1';
                    }?>
                    
                    <img  class="pre_loader_image_preview" src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/'.$image_pre.'.gif'; ?>" />
                    <?php if ( ! empty( $this->label ) ) : ?>
    				    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php endif; ?>
                    <div class="pre-icon-container">
                        <span ploader="loader1" class="active"><img class="ploader_img" src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader1.gif'; ?>" /></span>
                        <span ploader="loader2"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader2.gif'; ?>" /></span>
                        <span ploader="loader3"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader3.gif'; ?>" /></span>
                        <span ploader="loader4"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader4.gif'; ?>" /></span>
                        <span ploader="loader5"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader5.gif'; ?>" /></span>
                        <span ploader="loader6"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader6.gif'; ?>" /></span>
                        <span ploader="loader7"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader7.gif'; ?>" /></span>
                        <span ploader="loader8"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader8.gif'; ?>" /></span>
                        <span ploader="loader9"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader9.gif'; ?>" /></span>
                        <span ploader="loader10"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader10.gif'; ?>" /></span>
                        <span ploader="loader11"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader11.gif'; ?>" /></span>
                        <span ploader="loader12"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader12.gif'; ?>" /></span>
                        <span ploader="loader13"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader13.gif'; ?>" /></span>
                        <span ploader="loader14"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader14.gif'; ?>" /></span>
                        <span ploader="loader15"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader15.gif'; ?>" /></span>
                        <span ploader="loader16"><img src="<?php echo get_template_directory_uri().'/assets/images/pre-loader/loader16.gif'; ?>" /></span>
                    </div>
                    <input type="hidden" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
    			</label><?php
    		}
    	}
}