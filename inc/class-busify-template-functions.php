<?php
/**
 * Template Override functions here
 *
 * @package busify
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Busify_Template_Functions' ) ) {

	class Busify_Template_Functions {

		public function __construct() {
			//Headers
			add_action( 'busify_header', [ $this, 'master_header' ] );
			add_action( 'busify_footer', [ $this, 'master_footer' ] );

			//Breadcrumbs
			add_action( 'busify_after_header', [ $this, 'after_header_contents' ], 10 );

			//Footer
			add_action( 'busify_main_footer', [ $this, 'main_footer' ], 10 );
			add_action( 'busify_super_footer', [ $this, 'super_footer' ], 10 );
		}

		/**
		 * Primary Header
		 *
		 * @author CodeManas
		 * @since 1.0.0
		 */
		function master_header() {
			get_template_part( 'template-parts/header/header-main-layout' );
		}

		/**
		 * Primary Header
		 *
		 * @author CodeManas
		 * @since 1.0.0
		 */
		function master_footer() {
			get_template_part( 'template-parts/footer/footer-main-layout' );
		}

		/**
		 * Show Breadcrumbs and background image
		 *
		 * @since 1.0.0
		 * @author Deepen
		 */
		function after_header_contents() {
			$banner = Busify_Theme_Options::get_option( 'field-banner-image-background-enable' );
			//If banner exists show this instead of breacrumbs only
			if ( ! empty( $banner ) && ! busify_check_elementor_builtwith() ) {
				if ( ! is_front_page() ) {
					get_template_part( 'template-parts/header/top-banner-image' );
				}
			}
		}

		/**
		 * Main footer render
		 */
		function main_footer() {
			$layout = Busify_Theme_Options::get_option( 'field-footer-widget-layout' );
			if ( ! empty( $layout ) && $layout === "no-widget" ) {
				return;
			}

			get_template_part( 'template-parts/footer/footer-main' );
		}

		/**
		 * Super footer render
		 */
		function super_footer() {
			$layout = Busify_Theme_Options::get_option( 'field-footer-bar-enable' );
			if ( empty( $layout ) ) {
				return;
			}

			$footer = Busify_Theme_Options::get_option( 'field-footer-bar-copyright' );
			set_query_var( 'footer', $footer );
			get_template_part( 'template-parts/footer/footer-super' );
		}
	}

	new Busify_Template_Functions();
}

