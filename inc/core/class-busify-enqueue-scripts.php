<?php
/**
 * Script enqueue
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Enqueue Scripts
 */
if ( ! class_exists( 'Busify_Enqueue_Scripts' ) ) {

	/**
	 * Theme Enqueue Scripts
	 */
	class Busify_Enqueue_Scripts {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Load Assets into array
		 *
		 * @return mixed
		 */
		private function theme_assets() {
			$default_assets = array(
				'js' => array(
					'busify-js' => 'main',
				),

				'css' => array(
					'busify' => 'main',
				),

				'vendors' => array(
					'busify-fontawesome'         => 'fontawesome/css/fontawesome',
					'busify-fontawesome-solid'   => 'fontawesome/css/solid',
				)
			);

			return apply_filters( 'busify_theme_assets', $default_assets );
		}

		/**
		 * Enqueue Scripts
		 */
		public function enqueue_scripts() {

			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';

			$js_uri     = CODEMANAS_THEME_URL . 'assets/scripts/';
			$css_uri    = CODEMANAS_THEME_URL . 'assets/styles/';
			$vendor_uri = CODEMANAS_THEME_URL . 'assets/vendors/';

			// All assets.
			$all_assets = $this->theme_assets();
			$styles     = $all_assets['css'];
			$scripts    = $all_assets['js'];
			$vendors    = $all_assets['vendors'];

			if ( is_array( $styles ) && ! empty( $styles ) ) {
				// Register & Enqueue Styles.
				foreach ( $styles as $key => $style ) {

					$uri = filter_var( $style, FILTER_VALIDATE_URL ) ? $style : $css_uri . $style;

					// Generate CSS URL.
					$css_file = $uri . $file_prefix . '.css';

					// Register.
					wp_register_style( $key, $css_file, false, CODEMANAS_THEME_VERSION, 'all' );

					// Enqueue.
					wp_enqueue_style( $key );
				}
			}

			if ( is_array( $scripts ) && ! empty( $scripts ) ) {
				// Register & Enqueue Scripts.
				foreach ( $scripts as $key => $script ) {

					// Register.
					wp_register_script( $key, $js_uri . $script . $file_prefix . '.js', array( 'jquery' ), CODEMANAS_THEME_VERSION, true );

					// Enqueue.
					wp_enqueue_script( $key );
				}
			}

			//Only show if elementor is not used
			if ( ! busify_check_elementor_builtwith() ) {
				if ( is_array( $vendors ) && ! empty( $vendors ) ) {
					// Register & Enqueue Scripts.
					foreach ( $vendors as $key => $vendor ) {

						// Register.
						wp_register_style( $key, $vendor_uri . $vendor . $file_prefix . '.css', false, CODEMANAS_THEME_VERSION, 'all' );

						// Enqueue.
						wp_enqueue_style( $key );
					}
				}
			}

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			$this->localize_scripts();
		}

		/**
		 * Script Localizations
		 */
		function localize_scripts() {
			$options = array(
				'sticky_header'       => array(
					'enable'         => boolval( Busify_Theme_Options::get_option( 'field-header-menu-sticky' ) ),
					'disable_mobile' => boolval( Busify_Theme_Options::get_option( 'field-header-menu-sticky-mobile-disable' ) )
				),
				'menu_settings'       => array(
					'disable_search' => false
				),
				'ajaxurl'             => esc_url( admin_url( 'admin-ajax.php' ) ),
				'ajaxButtonType'      => esc_html( Busify_Theme_Options::get_option( 'field-blog-post-pagination' ) ),
				'ajaxLoadMoreLocales' => array(
					'loading'   => __( 'Loading...', 'busify' ),
					'load_more' => __( 'Load More', 'busify' ),
					'error'     => __( 'Error loading the posts.', 'busify' )
				)
			);

			wp_localize_script( 'busify-js', 'busify_options', $options );
		}
	}

	new Busify_Enqueue_Scripts();
}
