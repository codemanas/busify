<?php
/**
 * Theme options for getters and setters
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Busify_Theme_Options
 *
 * Busify Theme options pull class
 */
class Busify_Theme_Options {

	public function __construct() {
		add_action( 'after_theme_setup', array( $this, 'load_defaults' ) );
	}

	/**
	 * Get singular theme data
	 *
	 * @param $option
	 *
	 * @return mixed
	 */
	static function get_option( $option ) {
		$defaults = self::load_defaults();

		$theme_options = ! empty( $defaults[ $option ] ) ? get_theme_mod( $option, $defaults[ $option ] ) : get_theme_mod( $option );

		$theme_options = apply_filters( 'busify_filter_get_option', $theme_options, $option );

		return $theme_options;
	}

	/**
	 * Get all theme data
	 *
	 * @param $option
	 *
	 * @return mixed
	 */
	static function get_options( $option = '' ) {
		$theme_options = get_theme_mods();

		$theme_options = apply_filters( 'busify_filter_get_options', $theme_options, $option );

		$value = ! empty( $theme_options[ $option ] ) ? $theme_options[ $option ] : $theme_options;

		return apply_filters( "busify_get_option_{$option}", $value, $option );
	}

	/**
	 * Load Default data in initial setup process
	 */
	static function load_defaults() {
		$defaults = array(
			'field-color-body-font-family'                    => array(
				'color'          => '#dd3333',
				'font-size'      => '16px',
				'line-height'    => '1.6',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-global-typography-headings'                => 'h3',
			'field-global-heading-color'                      => '#ed6d6d',
			'field-header-mobile-menu-background'             => '#ffffff',
			'field-header-mobile-menu-text-color'             => '#000000',
			'field-header-mobile-menu-hamburger'              => '#ffffff',
			'field-header-layout'                             => 'busify-left-logo',
			'field-header-menu-sticky'                        => true,
			'field-header-menu-sticky-mobile-disable'         => true,
			'field-footer-bar-enable-scrollup'                => true,
			'field-footer-bar-enable-scrollup-color'          => '#000000',
			'field-footer-bar-background-color'               => '#ffffff',
			'field-global-container-width'                    => 1140,
			'field-global-typography-body'                    => array(
				'font-size'      => '16px',
				'line-height'    => '1.8',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-global-typography-headings-h1-typo'        => array(
				'font-size'      => '40px',
				'line-height'    => '1.6',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'color'          => '#000000',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-global-typography-headings-h2-typo'        => array(
				'font-size'      => '32px',
				'line-height'    => '1.6',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'color'          => '#000000',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-global-typography-headings-h3-typo'        => array(
				'font-size'      => '28px',
				'line-height'    => '1.6',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'color'          => '#000000',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-global-typography-headings-h4-typo'        => array(
				'font-size'      => '24px',
				'line-height'    => '1.6',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'color'          => '#000000',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-global-typography-headings-h5-typo'        => array(
				'font-size'      => '20px',
				'line-height'    => '1.6',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'color'          => '#000000',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-global-typography-headings-h6-typo'        => array(
				'font-size'      => '16px',
				'line-height'    => '1.6',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'color'          => '#000000',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-identity-logo-width'                       => '140',
			'field-identity-display-site-title'               => true,
			'field-identity-display-site-tagline'             => true,
			'field-header-color-menu'                         => '#ffffff',
			'field-header-color-menu-hover'                   => '#85bdef',
			'field-header-color-sub-menu'                     => '#222222',
			'field-header-color-submenu-hover'                => '#ffffff',
			'field-header-color-submenu-hover-background'     => '#ffffff',
			'field-header-color-submenu-hover-text'           => '#000000',
			'field-header-color-submenu-bordr-color'          => '#333333',
			'field-header-color-active-menu'                  => '#85bdef',
			'field-header-transparent'                        => true,
			'field-header-transparent-blog-page'              => false,
			'field-header-transparent-search-page'            => false,
			'field-header-transparent-archive-page'           => false,
			'field-header-transparent-single-post'            => false,
			'field-header-transparent-404'                    => false,
			'field-header-transparent-singular'               => false,
			'field-header-transparent-single-page'            => false,
			'field-header-transparent-background-color'       => 'rgba(255,255,255,0)',
			'field-header-color-background'                   => '#ffffff',
			'field-header-bottom-border-size'                 => '0',
			'field-header-border-color'                       => '#d6d6d6',
			'field-header-menu-sticky-background'             => 'rgba(10,10,10,0.75)',
			'field-blog-page-layout'                          => array(
				0 => 'title',
				1 => 'meta',
				2 => 'image',
				3 => 'content',
			),
			'field-blog-date'                                 => true,
			'field-blog-title-typo'                           => array(
				'color'          => '#0a0a0a',
				'font-size'      => '40px',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'line-height'    => '1.2',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-blog-content-typo'                         => array(
				'color'          => '#0a0a0a',
				'font-size'      => '16px',
				'line-height'    => '1.8',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-blog-meta'                                 => array(
				'color'          => '#545454',
				'font-size'      => '14px',
				'line-height'    => '1',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-blog-author-enable'                        => true,
			'field-blog-tag-enable'                           => true,
			'field-blog-category-enable'                      => true,
			'field-blog-comments-enable'                      => true,
			'field-single-post-structure'                     => array(
				0 => 'image',
				1 => 'title',
				2 => 'meta',
				3 => 'content',
			),
			'field-blog-single-post-title-typo'               => array(
				'color'          => '#0a0a0a',
				'font-size'      => '40px',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-blog-single-post-content-typo'             => array(
				'color'          => '#0a0a0a',
				'font-size'      => '16px',
				'line-height'    => '1.8',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-blog-single-post-layout'                   => array(
				'color'          => '#545454',
				'font-size'      => '14px',
				'line-height'    => '1.8',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-blog-post-pagination'                      => 'load-more',
			'field-blog-post-pagination-typo'                 => array(
				'color'          => '#0a0a0a',
				'font-size'      => '16px',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-pagination-alignment'                      => 'center-align-pagination',
			'field-pagination-background-color'               => '#ffffff',
			'field-pagination-hover-color'                    => '#0085ba',
			'field-pagination-active-link-color'              => '#254099',
			'field-footer-bar-enable'                         => true,
			'field-footer-bar-copyright'                      => '<p>Copyright © 2019 CodeManas. All rights reserved.</p><p>Powered by <strong>WordPress</strong></p>',
			'field-footer-bar-copyright-text-typo'            => array(
				'color'          => '#0a0a0a',
				'font-size'      => '16px',
				'line-height'    => '1.5',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'variant'        => '300',
				'text-align'     => 'left',
				'font-backup'    => '',
				'font-weight'    => 400,
				'font-style'     => 'normal',
			),
			'field-footer-widget-layout'                      => 'wd-four',
			'field-footer-widget-border-top'                  => '0',
			'field-footer-widget-border-top-color'            => '#d6d6d6',
			'field-footer-widget-background-color'            => '#ffffff',
			'field-footer-widget-typography-headings'         => array(
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-size'      => '24px',
				'letter-spacing' => '0px',
				'color'          => '#000000',
				'text-transform' => 'none',
				'text-align'     => 'left',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-footer-widget-typography-content'          => array(
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-size'      => '16px',
				'line-height'    => '1.5',
				'letter-spacing' => '0px',
				'color'          => '#0a0a0a',
				'text-transform' => 'none',
				'text-align'     => 'left',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-footer-widget-typography-links'            => array(
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-size'      => '16px',
				'letter-spacing' => '0px',
				'color'          => '#0a0a0a',
				'text-transform' => 'none',
				'font-backup'    => '',
				'font-weight'    => 300,
				'font-style'     => 'normal',
			),
			'field-footer-widget-typography-link-hover-color' => '#254099',
			'field-sidebar-type'                              => 'right',
			'field-sidebar-post'                              => 'default',
			'field-sidebar-page'                              => 'none',
			'field-sidebar-archive'                           => 'default',
			'field-sidebar-heading-color'                     => '#0a0a0a',
			'field-sidebar-text-color'                        => '#000000',
			'field-header-menu-last-item-btn-link'            => 'https://www.codemanas.com/',
			'field-header-menu-last-item-btn-color'           => '#254099',
			'field-header-menu-last-item-btn-text-color'      => '#ffffff',
			'field-header-menu-last-item-btn-vertical'        => '15',
			'field-header-menu-last-item-btn-horizontal'      => '15',
			'field-header-menu-last-item-btn-border'          => '0',
			'field-header-menu-last-item-button-texxt'        => 'Get a Quote',
			'field-header-menu-last-item-btn-custom-text'     => '<button>Register</button>',
			'field-header-menu-sticky-hide-logo-mobile'       => false,
			'field-breadcrumb-seperator'                      => '»',
			'field-breadcrumb-background'                     => 'rgba(10,10,10,0)',
			'field-breadcrumb-type'                           => 'after-header',
			'field-breadcrumb-disable-homepage'               => true,
			'field-breadcrumb-disable-blog'                   => false,
			'field-breadcrumb-disable-single-page'            => false,
			'field-breadcrumb-disable-single-post'            => false,
			'field-breadcrumb-disable-single'                 => false,
			'field-breadcrumb-disable-search'                 => false,
			'field-breadcrumb-disable-archive'                => false,
			'field-breadcrumb-disable-404'                    => false,
			'field-breadcrumb-alignment'                      => 'center',
			'field-breadcrumb-typography'                     => array(
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-size'      => '16px',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-backup'    => '',
				'font-weight'    => 400,
				'font-style'     => 'normal',
			),
			'field-breadcrumb-link-color'                     => '#254099',
			'field-breadcrumb-hover-color'                    => '#0085ba',
			'field-breadcrumb-text-color'                     => '#000000',
			'field-breadcrumb-seperator-color'                => '#000000',
			'field-banner-image-background-enable'            => true,
			'field-banner-image-top-height'                   => 150,
			'field-banner-image-bottom-height'                => 50,
			'field-banner-image-background-control'           => '#254099',
			'field-banner-image-background-overlay'           => 'rgba(0,0,0,0.7)',
			'field-banner-image-background-page-title'        => true,
			'field-banner-image-background-title-color'       => array(
				'font-family'    => 'Ubuntu',
				'variant'        => '300',
				'font-size'      => '40px',
				'letter-spacing' => '0',
				'color'          => '#ffffff',
				'text-transform' => 'none',
				'text-align'     => 'center',
			),
		);

		return apply_filters( 'busify_theme_defaults', $defaults );
	}
}

new Busify_Theme_Options();