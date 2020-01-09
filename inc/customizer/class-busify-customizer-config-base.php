<?php
/**
 * Customizer pull base class
 *
 * @package     busify
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Busify_Customizer_Conifg_Base {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'busify_customizer_configs', array( $this, 'register_configuration' ), 10 );
	}

	public function register_configuration( $configs ) {
		return $configs;
	}

}

new Busify_Customizer_Conifg_Base();