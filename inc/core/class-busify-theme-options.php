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
			'field-header-color-active-menu'                  => '#85bdef',
			'field-header-menu-sticky-background'             => 'rgba(10,10,10,0.75)',
			'field-blog-page-layout'                          => array(
				0 => 'title',
				1 => 'meta',
				2 => 'image',
				3 => 'content',
			),
			'field-single-post-structure'                     => array(
				0 => 'image',
				1 => 'title',
				2 => 'meta',
				3 => 'content',
			),
			'field-blog-post-pagination'                      => 'load-more',
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
			'field-sidebar-type'                              => 'right',
			'field-header-menu-last-item-btn-link'            => 'https://www.codemanas.com/',
			'field-header-menu-last-item-btn-color'           => '#254099',
			'field-header-menu-last-item-btn-text-color'      => '#ffffff',
			'field-header-menu-last-item-btn-vertical'        => '15',
			'field-header-menu-last-item-btn-horizontal'      => '15',
			'field-header-menu-last-item-btn-border'          => '0',
			'field-header-menu-last-item-button-texxt'        => 'Get a Quote',
			'field-header-menu-last-item-btn-custom-text'     => '<button>Register</button>',
			'field-header-menu-sticky-hide-logo-mobile'       => false,
			'field-banner-image-background-enable'            => true,
			'field-banner-image-background-control'           => '#254099',
			'field-banner-image-background-overlay'           => 'rgba(0,0,0,0.7)',
		);

		return apply_filters( 'busify_theme_defaults', $defaults );
	}
}

new Busify_Theme_Options();