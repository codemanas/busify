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
			add_action( 'busify_after_masthead_content', [ $this, 'breadcrumbs_inside_header' ], 10 );
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
		 * Show Breadcrumbs accordingly
		 *
		 * @since 1.0.0
		 * @author Deepen
		 */
		function breadcrumbs_inside_header() {
			$this->get_breadcrumbs( 'breadcrumb-after-header', 'inside-header' );
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
			} else {
				$this->get_breadcrumbs( 'breadcrumb-after-header', 'after-header' );
			}
		}

		/**
		 * Get type of breadcrumb and layout
		 *
		 * @param $part
		 * @param string $type
		 */
		static function get_breadcrumbs( $part, $type = "after-header" ) {
			$breacrumbs = self::breadcrumb_conditions();
			if ( ! empty( $breacrumbs['field-breadcrumb-type'] ) && $breacrumbs['field-breadcrumb-type'] === $type && ! busify_check_elementor_builtwith() ) {
				get_template_part( 'template-parts/header/' . $part );
			}
		}

		/**
		 * Breadcrumb conditions
		 * @return mixed
		 */
		static function breadcrumb_conditions() {
			$breacrumbs = array(
				'field-breadcrumb-type'                => Busify_Theme_Options::get_option( 'field-breadcrumb-type' ),
				'field-breadcrumb-disable-homepage'    => Busify_Theme_Options::get_option( 'field-breadcrumb-disable-homepage' ),
				'field-breadcrumb-disable-blog'        => Busify_Theme_Options::get_option( 'field-breadcrumb-disable-blog' ),
				'field-breadcrumb-disable-single'      => Busify_Theme_Options::get_option( 'field-breadcrumb-disable-single' ),
				'field-breadcrumb-disable-single-page' => Busify_Theme_Options::get_option( 'field-breadcrumb-disable-single-page' ),
				'field-breadcrumb-disable-single-post' => Busify_Theme_Options::get_option( 'field-breadcrumb-disable-single-post' ),
				'field-breadcrumb-disable-archive'     => Busify_Theme_Options::get_option( 'field-breadcrumb-disable-archive' ),
				'field-breadcrumb-disable-404'         => Busify_Theme_Options::get_option( 'field-breadcrumb-disable-404' ),
				'field-breadcrumb-disable-search'      => Busify_Theme_Options::get_option( 'field-breadcrumb-disable-search' ),
			);

			//Disable on homepage
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-homepage'] ) ) {
				if ( is_front_page() ) {
					return;
				}
			}

			//Disable on Blog Listing page
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-blog'] ) ) {
				if ( is_home() ) {
					return;
				}
			}

			//Override Setting on all single pages and posts
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-single'] ) ) {
				if ( is_singular() ) {
					return;
				}
			}

			//Disable on Single pages
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-single-page'] ) ) {
				if ( is_page() ) {
					return;
				}
			}

			//Disable on Single post
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-single-post'] ) ) {
				if ( is_single() ) {
					return;
				}
			}

			//Disable on Archive post
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-archive'] ) ) {
				if ( is_archive() ) {
					return;
				}
			}

			//Disable on Archive post
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-404'] ) ) {
				if ( is_404() ) {
					return;
				}
			}

			//Disable on Search page
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-search'] ) ) {
				if ( is_search() ) {
					return;
				}
			}

			return $breacrumbs;
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

