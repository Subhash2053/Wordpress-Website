<?php
	if(!class_exists('Parallaxsome_Pro_Welcome')) :

		class Parallaxsome_Pro_Welcome {

			public $tab_sections = array();

			public $theme_name = ''; // For storing Theme Name
			public $theme_version = ''; // For Storing Theme Current Version Information
			public $documentation_link = ''; // Theme Documentation Link
			public $free_plugins = array(); // For Storing the list of the Recommended Free Plugins
			public $pro_plugins = array(); // For Storing the list of the Recommended Pro Plugins
			public $req_plugins = array(); // For Storing the list of the Required Plugins
			public $companion_plugins = array(); // For Storing the list of the Companion Plugins

			/**
			 * Constructor for the Welcome Screen
			 */
			public function __construct() {
				
				/** Useful Variables **/
				$theme = wp_get_theme();
				$this->theme_name = $theme->Name;
				$this->theme_version = $theme->Version;

				$this->companion_plugins = array(

					'parallaxsome-custom-post-type' => array(
						'slug' => 'parallaxsome-custom-post-type',
						'name' => esc_html__('Custom Post Types', 'parallaxsome-pro'),
						'filename' =>'parallaxsome-custom-post-type.php',
						'bundled' => true,
						'location' => get_template_directory().'/welcome/plugins/parallaxsome-custom-post-type.zip',
						'info' => esc_html__('Parallaxsome Custom Post type plugin allows you to have option of custom post types for Teams and Blogs.', 'parallaxsome-pro'),
					),

				);

				/** List of required Plugins **/
				$this->req_plugins = array(
					
					'instant-demo-importer' => array(
						'slug' => 'instant-demo-importer',
						'name' => esc_html__('Instant Demo Importer', 'parallaxsome-pro'),
						'filename' =>'instant-demo-importer.php',
						'bundled' => true,
						'location' => get_template_directory().'/welcome/plugins/instant-demo-importer.zip',
						'info' => esc_html__('Instant Demo Importer Plugin adds the feature to Import the Demo Conent with a single click.', 'parallaxsome-pro'),
					)

				);

				/** Define Tabs Sections **/
				$this->tab_sections = array(
					'getting_started' => esc_html__('Getting Started', 'parallaxsome-pro'),
					'actions_required' => esc_html__('Recommended Actions', 'parallaxsome-pro'),
					'recommended_plugins' => esc_html__('Recommended Plugins', 'parallaxsome-pro'),
					'demo_import' => esc_html__('Import Demo', 'parallaxsome-pro'),
					'support' => esc_html__('Support', 'parallaxsome-pro'),
				);

				/** List of Recommended Free Plugins **/
				$this->free_plugins = array(

					'wp-popup-banners' => array(
						'slug' => 'wp-popup-banners',
						'filename' => 'wp-popup-banners.php',
					),

					'ultimate-form-builder-lite' => array(
						'slug' => 'ultimate-form-builder-lite',
						'filename' => 'ultimate-form-builder-lite.php',
					),

					'wp-floating-menu' => array(
						'slug' => 'wp-floating-menu',
						'filename' => 'wp-floating-menu.php',
					),

					'contact-form-7' => array(
						'slug' => 'contact-form-7',
						'filename' => 'contact-form-7.php',
					),

				);

				/** List of Recommended Pro Plugins **/
				$this->pro_plugins = array(

					'accesspress-social-pro' => array(
						'slug' => 'accesspress-social-pro',
						'name' => esc_html__('Accesspress Social Pro', 'parallaxsome-pro'),
						'version' => '1.0.0',
						'author' => 'AccessPress Themes',
						'filename' =>'accesspress-social-pro.php',
						'bundled' => true,
						'location' => get_template_directory().'/welcome/plugins/accesspress-social-pro/accesspress-social-pro.zip',
						'screenshot' => get_template_directory_uri().'/welcome/plugins/accesspress-social-pro/screen.png
						'
					),

					'smart-logo-showcase' => array(
						'slug' => 'smart-logo-showcase',
						'name' => esc_html__('Smart Logo Showcase', 'parallaxsome-pro'),
						'version' => '1.0.0',
						'author' => 'AccessPress Themes',
						'filename' =>'smart-logo-showcase.php',
						'bundled' => true,
						'location' => get_template_directory().'/welcome/plugins/smart-logo-showcase/smart-logo-showcase.zip',
						'screenshot' => get_template_directory_uri().'/welcome/plugins/smart-logo-showcase/screen.png
						'
					),

					'wp-mega-menu-pro' => array(
						'slug' => 'wp-mega-menu-pro',
						'name' => esc_html__('WP Mega Menu Pro', 'parallaxsome-pro'),
						'version' => '1.0.0',
						'author' => 'AccessPress Themes',
						'filename' =>'wp-mega-menu-pro.php',
						'bundled' => true,
						'location' => get_template_directory().'/welcome/plugins/wp-mega-menu-pro/wp-mega-menu-pro.zip',
						'screenshot' => get_template_directory_uri().'/welcome/plugins/wp-mega-menu-pro/screen.png
						'
					),

					'revslider' => array(
						'slug' => 'revslider',
						'name' => esc_html__('Revolution Slider', 'parallaxsome-pro'),
						'version' => '5.2.5.1',
						'author' => 'ThemePunch',
						'filename' =>'revslider.php',
						'bundled' => true,
						'location' => get_template_directory().'/welcome/plugins/revslider/revslider.zip',
						'screenshot' => get_template_directory_uri().'/welcome/plugins/revslider/screen.png
						'
					),

				);

				/** Links **/

				/* Theme Activation Notice */
				add_action( 'load-themes.php', array( $this, 'parallaxsome_activation_admin_notice' ) );

				/* Create a Welcome Page */
				add_action( 'admin_menu', array( $this, 'parallaxsome_welcome_register_menu' ) );

				/* Enqueue Styles & Scripts for Welcome Page */
				add_action( 'admin_enqueue_scripts', array( $this, 'parallaxsome_welcome_styles_and_scripts' ) );

				/** Plugin Installation Ajax **/
				add_action( 'wp_ajax_parallaxsome_plugin_installer', array( $this, 'parallaxsome_plugin_installer_callback' ) );

				/** Plugin Installation Ajax **/
				add_action( 'wp_ajax_parallaxsome_plugin_offline_installer', array( $this, 'parallaxsome_plugin_offline_installer_callback' ) );

				/** Plugin Activation Ajax **/
				add_action( 'wp_ajax_parallaxsome_plugin_activation', array( $this, 'parallaxsome_plugin_activation_callback' ) );

				/** Plugin Activation Ajax (Offline) **/
				add_action( 'wp_ajax_parallaxsome_plugin_offline_activation', array( $this, 'parallaxsome_plugin_offline_activation_callback' ) );

				add_action( 'init', array( $this, 'get_required_plugin_notification' ));

			}

			public function get_required_plugin_notification() {
				
				$req_plugins = $this->companion_plugins;
				$notif_counter = count($this->req_plugins);
				$parallaxsome_plugin_installed_notif = get_option('parallaxsome_plugin_installed_notif');

				foreach($req_plugins as $plugin) {
					$folder_name = $plugin['slug'];
					$file_name = $plugin['filename'];
					$path = WP_PLUGIN_DIR.'/'.esc_attr($folder_name).'/'.esc_attr($file_name);
					if(file_exists( $path )) {
						if(is_plugin_active($folder_name.'/'.$file_name)) {
							$notif_counter--;
						}
					}
				}
				update_option('parallaxsome_plugin_installed_notif', absint($notif_counter));
				return $notif_counter;
			}

			/** Welcome Message Notification on Theme Activation **/
			public function parallaxsome_activation_admin_notice() {
				global $pagenow;

				if( is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated'])) ) {
					?>
					<div class="notice notice-success is-dismissible">
						<p><?php printf( wp_kses_post( 'Welcome! Thank you for choosing %1$s! Please make sure you visit our <a href="%2$s">Welcome page</a> to get started with ParallaxSome Pro.', 'parallaxsome-pro' ), $this->theme_name, admin_url( 'themes.php?page=parallaxsome-welcome' )  ); ?></p>
						<p><a class="button" href="<?php echo admin_url( 'themes.php?page=parallaxsome-welcome' ) ?>"><?php _e( 'Lets Get Started', 'parallaxsome-pro' ); ?></a></p>
					</div>
					<?php
				}
			}

			/** Register Menu for Welcome Page **/
			public function parallaxsome_welcome_register_menu() {
				$action_count = get_option('parallaxsome_plugin_installed_notif');
				$title        = $action_count > 0 ? esc_html__( 'Welcome', 'parallaxsome-pro' ) . '<span class="badge pending-tasks">' . esc_html( $action_count ) . '</span>' : esc_html__( 'Welcome', 'parallaxsome-pro' );
				add_theme_page( 'Welcome', $title , 'edit_theme_options', 'parallaxsome-welcome', array( $this, 'parallaxsome_welcome_screen' ));
			}

			/** Welcome Page **/
			public function parallaxsome_welcome_screen() {
				$tabs = $this->tab_sections;

				$current_section = isset($_GET['section']) ? $_GET['section'] : 'getting_started';
				$section_inline_style = '';
				?>
				<div class="wrap about-wrap access-wrap">
					<h1><?php printf( esc_html__( 'Welcome to %s - Version %s', 'parallaxsome-pro' ), $this->theme_name, $this->theme_version ); ?></h1>
					<div class="about-text"><?php printf( esc_html__( '%s is a Simple, Creative, Modern One Page WordPress theme with awesome parallax scrolling effect. It is a highly customizable and flexible WP template suitable for multipurpose websites like business, agency, blog, portfolio, eCommerce etc. The theme features 3 predefined demo that can be imported with just single click.', 'parallaxsome-pro' ), $this->theme_name ); ?></div>

					<a target="_blank" href="http://www.accesspressthemes.com" class="accesspress-badge wp-badge"><span><?php echo esc_html('AccessPressThemes'); ?></span></a>

				<div class="nav-tab-wrapper clearfix">
					<?php foreach($tabs as $id => $label) : ?>
						<?php
							$section = isset($_REQUEST['section']) ? esc_attr($_REQUEST['section']) : 'getting_started';
							$nav_class = 'nav-tab';
							if($id == $section) {
								$nav_class .= ' nav-tab-active';
							}
						?>
						<a href="<?php echo admin_url('themes.php?page=parallaxsome-welcome&section='.$id); ?>" class="<?php echo $nav_class; ?>" >
							<?php echo esc_html( $label ); ?>
							<?php if($id == 'actions_required') : $not = $this->get_required_plugin_notification(); ?>
								<?php if($not) : ?>
							   		<span class="pending-tasks">
						   				<?php echo esc_html($not); ?>
						   			</span>
				   				<?php endif; ?>
						   	<?php endif; ?>
					   	</a>
					<?php endforeach; ?>
			   	</div>

		   		<div class="welcome-section-wrapper">
	   				<?php $section = isset($_REQUEST['section']) ? $_REQUEST['section'] : 'getting_started'; ?>
   					
   					<div class="welcome-section <?php echo esc_attr($section); ?> clearfix">
   						<?php require_once get_template_directory() . '/welcome/sections/'.esc_html($section).'.php'; ?>
					</div>
			   	</div>
			   	</div>
				<?php
			}

			/** Enqueue Necessary Styles and Scripts for the Welcome Page **/
			public function parallaxsome_welcome_styles_and_scripts() {
				wp_enqueue_style( 'parallaxsome-welcome-screen', get_template_directory_uri() . '/welcome/css/welcome.css' );
				wp_enqueue_script( 'parallaxsome-welcome-screen', get_template_directory_uri() . '/welcome/js/welcome.js', array( 'jquery' ) );

				wp_localize_script( 'parallaxsome-welcome-screen', 'parallaxsomeWelcomeObject', array(
					'admin_nonce'	=> wp_create_nonce('parallaxsome_plugin_installer_nonce'),
					'activate_nonce'	=> wp_create_nonce('parallaxsome_plugin_activate_nonce'),
					'ajaxurl'		=> esc_url( admin_url( 'admin-ajax.php' ) ),
					'activate_btn' => esc_html__('Activate', 'parallaxsome-pro'),
					'installed_btn' => esc_html__('Activated', 'parallaxsome-pro'),
					'demo_installing' => esc_html__('Installing Demo', 'parallaxsome-pro'),
					'demo_installed' => esc_html__('Demo Installed', 'parallaxsome-pro'),
					'demo_confirm' => esc_html__('Are you sure to import demo content ?', 'parallaxsome-pro'),
				) );
			}

			/** Plugin API **/
			public function parallaxsome_call_plugin_api( $plugin ) {
				include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

				$call_api = plugins_api( 'plugin_information', array(
					'slug'   => $plugin,
					'fields' => array(
						'downloaded'        => false,
						'rating'            => false,
						'description'       => false,
						'short_description' => true,
						'donate_link'       => false,
						'tags'              => false,
						'sections'          => true,
						'homepage'          => true,
						'added'             => false,
						'last_updated'      => false,
						'compatibility'     => false,
						'tested'            => false,
						'requires'          => false,
						'downloadlink'      => false,
						'icons'             => true
					)
				) );

				return $call_api;
			}

			/** Check For Icon **/
			public function parallaxsome_check_for_icon( $arr ) {
				if ( ! empty( $arr['svg'] ) ) {
					$plugin_icon_url = $arr['svg'];
				} elseif ( ! empty( $arr['2x'] ) ) {
					$plugin_icon_url = $arr['2x'];
				} elseif ( ! empty( $arr['1x'] ) ) {
					$plugin_icon_url = $arr['1x'];
				} else {
					$plugin_icon_url = $arr['default'];
				}

				return $plugin_icon_url;
			}

			/** Check if Plugin is active or not **/
			public function parallaxsome_plugin_active($plugin) {
				$folder_name = $plugin['slug'];
				$file_name = $plugin['filename'];
				$status = 'install';

				$path = WP_PLUGIN_DIR.'/'.esc_attr($folder_name).'/'.esc_attr($file_name);

				if(file_exists( $path )) {
					$status = is_plugin_active(esc_attr($folder_name).'/'.esc_attr($file_name)) ? 'inactive' : 'active';
				}

				return $status;
			}

			/** Generate Url for the Plugin Button **/
			public function parallaxsome_plugin_generate_url($status, $plugin) {
				$folder_name = $plugin['slug'];
				$file_name = $plugin['filename'];

				switch ( $status ) {
					case 'install':
						return wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'install-plugin',
									'plugin' => esc_attr($folder_name)
								),
								network_admin_url( 'update.php' )
							),
							'install-plugin_' . esc_attr($folder_name)
						);
						break;

					case 'inactive':
						return add_query_arg( array(
							                      'action'        => 'deactivate',
							                      'plugin'        => rawurlencode( esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
							                      'plugin_status' => 'all',
							                      'paged'         => '1',
							                      '_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
						                      ), network_admin_url( 'plugins.php' ) );
						break;

					case 'active':
						return add_query_arg( array(
							                      'action'        => 'activate',
							                      'plugin'        => rawurlencode( esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
							                      'plugin_status' => 'all',
							                      'paged'         => '1',
							                      '_wpnonce'      => wp_create_nonce( 'activate-plugin_' . esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
						                      ), network_admin_url( 'plugins.php' ) );
						break;
				}
			}

			/* ========== Plugin Installation Ajax =========== */
			public function parallaxsome_plugin_installer_callback(){

				if ( ! current_user_can('install_plugins') )
					wp_die( esc_html__( 'Sorry, you are not allowed to install plugins on this site.', 'parallaxsome-pro' ) );

				$nonce = $_POST["nonce"];
				$plugin = $_POST["plugin"];
				$plugin_file = $_POST["plugin_file"];

				// Check our nonce, if they don't match then bounce!
				if (! wp_verify_nonce( $nonce, 'parallaxsome_plugin_installer_nonce' ))
					wp_die( esc_html__( 'Error - unable to verify nonce, please try again.', 'parallaxsome-pro') );


         		// Include required libs for installation
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
				require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

				// Get Plugin Info
				$api = $this->parallaxsome_call_plugin_api($plugin);

				$skin     = new WP_Ajax_Upgrader_Skin();
				$upgrader = new Plugin_Upgrader( $skin );
				$upgrader->install($api->download_link);

				$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin_file);

				if($api->name) {
					$main_plugin_file = $this->get_plugin_file($plugin);
					if($main_plugin_file){
						activate_plugin($main_plugin_file);
						echo "success";
						die();
					}
				}
				echo "fail";

				die();
			}

			/** Plugin Offline Installation Ajax **/
			public function parallaxsome_plugin_offline_installer_callback() {
				
				$file_location = $_POST['file_location'];
				$file = $_POST['file'];
				$plugin_directory = ABSPATH . 'wp-content/plugins/';

				$zip = new ZipArchive;
				if ($zip->open(esc_html($file_location)) === TRUE) {

				    $zip->extractTo($plugin_directory);
				    $zip->close();
				    
				    activate_plugin($file);
					echo "success";
					die();
				} else {
				    echo 'failed';
				}

				die();
			}

			/** Plugin Offline Activation Ajax **/
			public function parallaxsome_plugin_offline_activation_callback() {

				$plugin = $_POST['plugin'];
				$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin).'.php';

				if(file_exists($plugin_file)) {
					activate_plugin($plugin_file);
				} else {
					echo "Plugin Doesn't Exists";
				}

				die();
				
			}

			/** Plugin Activation Ajax **/
			public function parallaxsome_plugin_activation_callback(){

				if ( ! current_user_can('install_plugins') )
					wp_die( esc_html__( 'Sorry, you are not allowed to activate plugins on this site.', 'parallaxsome-pro' ) );

				$nonce = $_POST["nonce"];
				$plugin = $_POST["plugin"];

				// Check our nonce, if they don't match then bounce!
				if (! wp_verify_nonce( $nonce, 'parallaxsome_plugin_activate_nonce' ))
					die( esc_html__( 'Error - unable to verify nonce, please try again.', 'parallaxsome-pro' ) );


	         	// Include required libs for activation
				require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';


				// Get Plugin Info
				$api = $this->parallaxsome_call_plugin_api(esc_attr($plugin));


				if($api->name){
					$main_plugin_file = $this->get_plugin_file(esc_attr($plugin));
					$status = 'success';
					if($main_plugin_file){
						activate_plugin($main_plugin_file);
						$msg = $api->name .' successfully activated.';
					}
				} else {
					$status = 'failed';
					$msg = esc_html__('There was an error activating $api->name', 'parallaxsome-pro');
				}

				$json = array(
					'status' => $status,
					'msg' => $msg,
				);

				wp_send_json($json);

			}

			public function all_required_plugins_installed() {

		      	$companion_plugins = $this->companion_plugins;
				$show_success_notice = false;

				foreach($companion_plugins as $plugin) {

					$path = WP_PLUGIN_DIR.'/'.esc_attr($plugin['slug']).'/'.esc_attr($plugin['filename']);

					if(file_exists($path)) {
						if(is_plugin_active(esc_attr($plugin['slug']).'/'.esc_attr($plugin['filename']))) {
							$show_success_notice = true;
						} else {
							$show_success_notice = false;
							break;
						}
					} else {
						$show_success_notice = false;
						break;
					}
				}

				return $show_success_notice;
	      	}

			public static function get_plugin_file( $plugin_slug ) {
		         require_once ABSPATH . '/wp-admin/includes/plugin.php'; // Load plugin lib
		         $plugins = get_plugins();

		         foreach( $plugins as $plugin_file => $plugin_info ) {

			         // Get the basename of the plugin e.g. [askismet]/askismet.php
			         $slug = dirname( plugin_basename( $plugin_file ) );

			         if($slug){
			            if ( $slug == $plugin_slug ) {
			               return $plugin_file; // If $slug = $plugin_name
			            }
		            }
		         }
		         return null;
		      }

		}

		new Parallaxsome_Pro_Welcome();

	endif;

	/** Initializing Demo Importer if exists **/
	if(class_exists('Instant_Demo_Importer')) :
		$demoimporter = new Instant_Demo_Importer();

		$demoimporter->demos = array(
			'classical-demo' => array(
				'title' => esc_html__('Classic Demo', 'parallaxsome-pro'),
				'name' => 'classical-demo',
				'screenshot' => get_template_directory_uri().'/welcome/demos/classical-demo/screen.png',
				'home_page' => 'home',
				'menus' => array()
			),
			'corporate-demo' => array(
				'title' => esc_html__('Corporate Demo', 'parallaxsome-pro'),
				'name' => 'corporate-demo',
				'screenshot' => get_template_directory_uri().'/welcome/demos/corporate-demo/screen.png',
				'home_page' => 'home',
				'menus' => array(
					'Top Menu' => 'parallaxsome_primary_menu',
				)
			),
			'restaurant-demo' => array(
				'title' => esc_html__('Restaurant Demo', 'parallaxsome-pro'),
				'name' => 'restaurant-demo',
				'screenshot' => get_template_directory_uri().'/welcome/demos/restaurant-demo/screen.png',
				'home_page' => 'home',
				'menus' => array()
			),
		);

		$demoimporter->demo_dir = get_template_directory().'/welcome/demos/'; // Path to the directory containing demo files
		$demoimporter->options_replace_url = 'http://demo.accesspressthemes.com/parallaxsome-pro/parallaxsome-lite'; // Set the url to be replaced with current siteurl
		$demoimporter->option_name = ''; // Set the the name of the option if the theme is based on theme option
	endif;
?>