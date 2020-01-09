<?php
// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Main plugin class with initialization tasks.
 */
class OCDI_Plugin {
	/**
	 * Constructor for this class.
	 */
	public function __construct() {
		/**
		 * Display admin error message if PHP version is older than 5.3.2.
		 * Otherwise execute the main plugin class.
		 */
		if ( version_compare( phpversion(), '5.3.2', '<' ) ) {
			add_action( 'admin_notices', array( $this, 'old_php_admin_error_notice' ) );
		} else {
			// Set plugin constants.
			$this->set_plugin_constants();

			// Composer autoloader.
			require_once PT_OCDI_PATH . 'vendor/autoload.php';

			// Instantiate the main plugin class *Singleton*.
			$pt_one_click_demo_import = OCDI\OneClickDemoImport::get_instance();

			// Register WP CLI commands
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				WP_CLI::add_command( 'ocdi list', array( 'OCDI\WPCLICommands', 'list_predefined' ) );
				WP_CLI::add_command( 'ocdi import', array( 'OCDI\WPCLICommands', 'import' ) );
			}
		}
	}


	/**
	 * Display an admin error notice when PHP is older the version 5.3.2.
	 * Hook it to the 'admin_notices' action.
	 */
	public function old_php_admin_error_notice() {
		$message = sprintf( esc_html__( 'The %2$sOne Click Demo Import%3$s plugin requires %2$sPHP 5.3.2+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 5.3.2.%4$s Your current version of PHP: %2$s%1$s%3$s', 'pt-ocdi' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}


	/**
	 * Set plugin constants.
	 *
	 * Path/URL to root of this plugin, with trailing slash and plugin version.
	 */
	private function set_plugin_constants() {
		// Path/URL to root of this plugin, with trailing slash.
		if ( ! defined( 'PT_OCDI_PATH' ) ) {
			define( 'PT_OCDI_PATH', trailingslashit( get_stylesheet_directory() . '/inc/importer' ) );
		}
		if ( ! defined( 'PT_OCDI_URL' ) ) {
			define( 'PT_OCDI_URL', trailingslashit( get_stylesheet_directory_uri() . '/inc/importer' ) );
		}

		// Action hook to set the plugin version constant.
		add_action( 'admin_init', array( $this, 'set_plugin_version_constant' ) );
	}

	/**
	 * Set plugin version constant -> PT_OCDI_VERSION.
	 */
	public function set_plugin_version_constant() {
		if ( ! defined( 'PT_OCDI_VERSION' ) ) {
			$plugin_data = get_plugin_data( __FILE__ );
			define( 'PT_OCDI_VERSION', $plugin_data['Version'] );
		}
	}
}

// Instantiate the plugin class.
$ocdi_plugin = new OCDI_Plugin();

/*Import content data*/
if ( ! function_exists( 'busify_import_files' ) ) :
	/**
	 * Define import paths for import ready content
	 */
	function busify_import_files() {
		return array(
			array(
				'import_file_name'             => 'busify-theme',
				'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/demo-data/demo-content.xml',
				'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/demo-data/widgets.wie',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'assets/demo-data/customizer.dat',
			)
		);
	}

	add_filter( 'pt-ocdi/import_files', 'busify_import_files' );
endif;

if ( ! function_exists( 'busify_after_import' ) ) :
	/**
	 * Import theme options after import of content widgets and plugins are completed.
	 *
	 * @param $selected_import
	 */
	function busify_after_import( $selected_import ) {

		if ( 'busify-theme' === $selected_import['import_file_name'] ) {
			$site_options = array(
				'custom_logo'                          => false,
				'nav_menu_locations'                   => 'primary-menu',
				'show_on_front'                        => 'page',
				'page_on_front'                        => 'Home',
				'page_for_posts'                       => 'Blog',
				'contact_page'                         => 'Contact',

				// Plugin: Elementor.
				'elementor_container_width'            => '1140',
				'elementor_css_print_method'           => 'external',
				'elementor_disable_color_schemes'      => 'yes',
				'elementor_disable_typography_schemes' => 'yes',
			);

			busify_import_theme_options( $site_options );

			//Clear Cache
			if ( busify_elementor_active() ) {
				\Elementor\Plugin::$instance->files_manager->clear_cache();
			}
		}
	}

	add_action( 'pt-ocdi/after_import', 'busify_after_import' );
endif;

/**
 * Set imported options to theme
 *
 * @param array $options
 */
function busify_import_theme_options( $options = array() ) {
	if ( ! isset( $options ) ) {
		return;
	}

	foreach ( $options as $option_name => $option_value ) {

		if ( ! empty( $option_value ) ) {

			switch ( $option_name ) {

				case 'page_for_posts':
				case 'page_on_front':
					$page = get_page_by_title( $option_value );
					if ( is_object( $page ) ) {
						update_option( $option_name, $page->ID );
					}
					break;

				// nav menu locations.
				case 'nav_menu_locations':
					$menu_locations = array();

					// Update menu locations.
					if ( isset( $option_value ) ) {

						$term = get_term_by( 'slug', $option_value, 'nav_menu' );
						if ( is_object( $term ) ) {
							$menu_locations[ $option_value ] = $term->term_id;
						}

						set_theme_mod( 'nav_menu_locations', $menu_locations );
					}
					break;

				case 'contact_page':
					$page = get_page_by_title( $option_value );
					if ( ! empty( $page ) ) {
						$data = get_post_meta( $page->ID, '_elementor_data', true );

						//Import WP Forms
						OCDI\WpFormsImport::import_wpforms();

						// Update WP form IDs.
						$ids_mapping = get_option( 'busify_tpl_wpforms_ids_mapping', array() );
						if ( $ids_mapping ) {
							foreach ( $ids_mapping as $old_id => $new_id ) {
								$data = str_replace( '[wpforms id=\"' . $old_id, '[wpforms id=\"' . $new_id, $data );
							}
						}
					}

					break;

				default:
					update_option( $option_name, $option_value );
					break;
			}
		}
	}
}