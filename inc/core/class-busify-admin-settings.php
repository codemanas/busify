<?php
/**
 * Admin settings for Busify theme
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Busify_Admin_Settings {

	public static $menu_title = 'Busify Theme';
	public static $page_title = 'Busify';
	public static $slug = 'busify-theme';
	public static $theme_updates_slug = 'busify-multi-purpose-responsive-theme';
	public static $menu_position_screen = 'themes.php';
	public $license_key;

	/**
	 * Constructor
	 */
	function __construct() {

		$this->license_key = get_option( self::$theme_updates_slug . '_license_key' );

		if ( ! is_admin() ) {
			return;
		}

		add_action( 'after_setup_theme', array( $this, 'init_settings' ), 99 );
	}

	/**
	 * Init
	 */
	public function init_settings() {

		if ( isset( $_REQUEST['page'] ) && ( strpos( $_REQUEST['page'], self::$slug ) !== false || self::$theme_updates_slug . '-license' === $_REQUEST['page'] ) ) {
			add_action( 'admin_enqueue_scripts', [ $this, 'styles_scripts' ] );
		}

		add_action( 'admin_menu', [ $this, 'show_admin_menu' ], 1 );
		add_filter( 'pt-ocdi/plugin_page_setup', [ $this, 'importer_page' ] );
	}

	/**
	 * Show Admin Menu in admin
	 */
	public function show_admin_menu() {
		$page_title = self::$page_title;
		$capability = 'manage_options';
		$slug       = self::$slug;

		add_menu_page( $page_title, $page_title, $capability, $slug, array( $this, 'render_menu' ), 'dashicons-smiley', 2 );
		if ( ! empty( $this->license_key ) ) {
			add_submenu_page( 'busify-theme', 'Theme Customizer', 'Theme Customizer', 'manage_options', 'customize.php' );
		}
	}

	/**
	 * Move importer setting into Admin Busify Page
	 *
	 * @param $importer
	 *
	 * @return array
	 */
	public function importer_page( $importer ) {
		if ( ! empty( $this->license_key ) ) {
			$importer['parent_slug'] = self::$slug;
		} else {
			$importer['parent_slug'] = false;
		}

		return $importer;
	}

	/**
	 * Render Admin settings HTML
	 */
	public function render_menu() {
		?>
        <div class="busify-menu-page-wrapper">
            <div class="busify-page-header">
                <div class="container busify-center">
                    <div class="busify-theme-logo">
                        <img src="<?php echo CODEMANAS_THEME_URL . 'assets/images/logo.png'; ?>" width="140"> <span class="busify-theme-version">v<?php echo CODEMANAS_THEME_VERSION; ?></span>
                    </div>
                </div>
            </div>
            <div class="busify-page-content">
                <div class="container">
                    <div class="busify-theme-border-palete-w-padding busify-theme-text-center">
                        <h3><?php esc_html_e( 'Welcome to Busify Theme', CODEMANAS_THEME_DOMAIN ); ?></h3>
                        <p><?php esc_html_e( 'Busify is clean responsive multi-purpose theme that\'s versatile and easy to use. Built with speed and flexibility. Easily customizable from a developer perspective or a normal user perspective. Busify is suitable for both corporate and creative business. Busify supports elementor which gives you extra extendability with drag and drop elements to build pages without coding knowledge.', CODEMANAS_THEME_DOMAIN ); ?></p>
                    </div>
                    <div class="busify-theme-options-container">
                        <div class="busify-theme-wrap-left">
                            <div class="busify-theme-border-palete-without-padding busify-theme-heading-box-style">
                                <h3><i class="dashicons dashicons-admin-site-alt2"></i> <?php esc_html_e( 'Customizer Settings', CODEMANAS_THEME_DOMAIN ); ?></h3>
                                <div class="busify-row">
                                    <div class="busify-column"><i class="dashicons dashicons-editor-kitchensink"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-global-container-width' ) ); ?>"><?php esc_html_e( 'Global Layouts', CODEMANAS_THEME_DOMAIN ); ?></a></div>
                                    <div class="busify-column"><i class="dashicons dashicons-editor-textcolor"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-header-menu-disable-search' ) ); ?>"><?php esc_html_e( 'Menu Layouts', CODEMANAS_THEME_DOMAIN ); ?></a></div>
                                </div>
                                <div class="busify-row">
                                    <div class="busify-column"><i class="dashicons dashicons-format-image"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=custom_logo' ) ); ?>"><?php esc_html_e( 'Upload Logo', CODEMANAS_THEME_DOMAIN ); ?></a></div>
                                </div>
                                <div class="busify-row">
                                    <div class="busify-column"><i class="dashicons dashicons-layout"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-blog-page-layout' ) ); ?>"><?php esc_html_e( 'Blog Page Styles', CODEMANAS_THEME_DOMAIN ); ?></a></div>
                                    <div class="busify-column"><i class="dashicons dashicons-slides"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-blog-post-pagination' ) ); ?>"><?php esc_html_e( 'Pagination Styles', CODEMANAS_THEME_DOMAIN ); ?></a></div>
                                </div>
                                <div class="busify-row">
                                    <div class="busify-column"><i class="dashicons dashicons-excerpt-view"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-sidebar-type' ) ); ?>"><?php esc_html_e( 'Sidebar Settings', CODEMANAS_THEME_DOMAIN ); ?></a></div>
                                </div>
                                <div class="busify-row">
                                    <div class="busify-column"><i class="dashicons dashicons-admin-appearance"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-footer-bar-enable' ) ); ?>"><?php esc_html_e( 'Last Footer Bar', CODEMANAS_THEME_DOMAIN ); ?></a></div>
                                </div>
                            </div>
							<?php if ( ! empty( $this->license_key ) ) { ?>
                                <div class="busify-theme-border-palete-without-padding busify-theme-heading-box-style">
                                    <h3><i class="dashicons dashicons-admin-network"></i> <?php esc_html_e( 'Get Started by Importing Demo Contents', CODEMANAS_THEME_DOMAIN ); ?></h3>
                                    <div class="busify-theme-knowledge-base">
                                        <p><?php esc_html_e( 'Import existing contents and design to get started with just one click.', CODEMANAS_THEME_DOMAIN ); ?></p>
                                        <p><a href="<?php echo admin_url( 'admin.php?page=pt-one-click-demo-import' ); ?>"><?php esc_html_e( 'Take me to demo import page', CODEMANAS_THEME_DOMAIN ); ?> »</a></p>
                                    </div>
                                </div>
							<?php } ?>
                        </div>
                        <div class="busify-theme-wrap-right">
                            <div class="busify-theme-border-palete-without-padding busify-theme-heading-box-style ">
                                <h3><i class="dashicons dashicons-welcome-learn-more"></i> <?php esc_html_e( 'Knowledge Base', CODEMANAS_THEME_DOMAIN ); ?></h3>
                                <div class="busify-theme-knowledge-base">
                                    <p><?php esc_html_e( 'Having issues with theme or installation ? Take some time to explore our knowledge base to explore and learn about possiblities.', CODEMANAS_THEME_DOMAIN ); ?></p>
                                    <p><a href="https://codemanas.com"><?php esc_html_e( 'Visit Knowledge Base', CODEMANAS_THEME_DOMAIN ); ?> »</a></p>
                                </div>
                            </div>
                            <div class="busify-theme-border-palete-without-padding busify-theme-heading-box-style ">
                                <h3><i class="dashicons dashicons-info"></i> <?php esc_html_e( 'Support', CODEMANAS_THEME_DOMAIN ); ?></h3>
                                <div class="busify-theme-knowledge-base">
                                    <p><?php esc_html_e( 'Did not find what you are looking for on knowledge base ? Ask us directly.', CODEMANAS_THEME_DOMAIN ); ?></p>
                                    <p><a href="https://codemanas.com"><?php esc_html_e( 'Visit Support Forum', CODEMANAS_THEME_DOMAIN ); ?> »</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

	/**
	 * Get and return page URL
	 *
	 * @param string $menu_slug Menu name.
	 *
	 * @since 1.0
	 * @return  string page url
	 */
	public static function get_page_url( $menu_slug ) {

		$parent_page = self::$menu_position_screen;

		if ( strpos( $parent_page, '?' ) !== false ) {
			$query_var = '&page=' . self::$slug;
		} else {
			$query_var = '?page=' . self::$slug;
		}

		$parent_page_url = admin_url( $parent_page . $query_var );

		$url = $parent_page_url . '&action=' . $menu_slug;

		return esc_url( $url );
	}

	/**
	 * Enqueue Scripts into Admin Page
	 */
	public function styles_scripts() {
		wp_enqueue_style( 'busify-admin-styles', CODEMANAS_THEME_URL . 'assets/admin/css/busify-admin-styles.css', false, CODEMANAS_THEME_VERSION );

		do_action( 'busify_admin_settings_enqueue_style' );
	}

}

new Busify_Admin_Settings();