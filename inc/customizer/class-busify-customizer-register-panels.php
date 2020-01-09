<?php
/**
 * Registering panels for customizer
 *
 * @package     busify
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Busify_Customizer_Register_Panels extends Busify_Customizer_Conifg_Base {

	public function register_configuration( $configs ) {
		$panel = array(
			array(
				'category' => 'panel',
				'name'     => 'panel-global',
				'priority' => 10,
				'title'    => esc_html__( 'Global', CODEMANAS_THEME_DOMAIN ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-header',
				'priority' => 20,
				'title'    => esc_html__( 'Header', CODEMANAS_THEME_DOMAIN ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-blog',
				'priority' => 30,
				'title'    => esc_html__( 'Blog', CODEMANAS_THEME_DOMAIN ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-footer',
				'priority' => 60,
				'title'    => esc_html__( 'Footer', CODEMANAS_THEME_DOMAIN ),
			)
		);

		return array_merge( $configs, $panel );
	}

}

new Busify_Customizer_Register_Panels();