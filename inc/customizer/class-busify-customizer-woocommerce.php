<?php
/**
 * Registering section for customizer
 *
 * @package     busify
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Busify_Customizer_WooCommerce extends Busify_Customizer_Conifg_Base {

	public function __construct() {
		parent::__construct();

		add_filter( 'busify_customer_last_item_menus', array( $this, 'add_last_item_option' ) );
	}

	public function register_configuration( $configs ) {
		$global_sections = array(
			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-2',
				'section'  => 'section-global-container-layout',
				'default'  => '<hr>',
				'priority' => 1,
			),
			array(
				'category' => 'field',
				'type'     => 'select',
				'settings' => 'field-global-woocommerce-layout-selection',
				'label'    => esc_html__( 'WooCommerce Layout', CODEMANAS_THEME_DOMAIN ),
				'section'  => 'section-global-container-layout',
				'default'  => 'boxed',
				'priority' => 10,
				'multiple' => 1,
				'choices'  => [
					'boxed'      => esc_html__( 'Boxed', CODEMANAS_THEME_DOMAIN ),
					'full-width' => esc_html__( 'Full width', CODEMANAS_THEME_DOMAIN ),
				],
			),
		);

		$sidebar_sections = array(
			array(
				'category' => 'field',
				'type'     => 'select',
				'settings' => 'field-sidebar-woocommerce',
				'label'    => esc_html__( 'WooCommerce Products Page', CODEMANAS_THEME_DOMAIN ),
				'section'  => 'section-sidebar',
				'default'  => 'none',
				'priority' => 6,
				'multiple' => 1,
				'choices'  => [
					'none'  => esc_html__( 'No Sidebar', CODEMANAS_THEME_DOMAIN ),
					'left'  => esc_html__( 'Left Sidebar', CODEMANAS_THEME_DOMAIN ),
					'right' => esc_html__( 'Right Sidebar', CODEMANAS_THEME_DOMAIN ),
				],
			),
			array(
				'category' => 'field',
				'type'     => 'select',
				'settings' => 'field-sidebar-woocommerce-single',
				'label'    => esc_html__( 'WooCommerce Single Product Page', CODEMANAS_THEME_DOMAIN ),
				'section'  => 'section-sidebar',
				'default'  => 'none',
				'priority' => 7,
				'multiple' => 1,
				'choices'  => [
					'none'  => esc_html__( 'No Sidebar', CODEMANAS_THEME_DOMAIN ),
					'left'  => esc_html__( 'Left Sidebar', CODEMANAS_THEME_DOMAIN ),
					'right' => esc_html__( 'Right Sidebar', CODEMANAS_THEME_DOMAIN ),
				],
			),
		);

		//WooCommerce Panel Register
		$woocommerce = array(
			array(
				'category' => 'panel',
				'name'     => 'woocommerce',
				'priority' => 80,
				'title'    => esc_html__( 'WooCommerce', CODEMANAS_THEME_DOMAIN ),
			)
		);

		return array_merge( $configs, $global_sections, $sidebar_sections, $woocommerce );
	}

	function add_last_item_option( $items ) {
		$items['woocommerce'] = __( 'WooCommerce', CODEMANAS_THEME_DOMAIN );

		return $items;
	}
}

new Busify_Customizer_WooCommerce();