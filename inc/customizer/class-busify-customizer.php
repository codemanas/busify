<?php
/**
 * Customizer API customization class
 *
 * @package     busify
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//Require Kirki
require CODEMANAS_THEME_DIR . 'inc/kirki/kirki.php';

class Busify_Customizer {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object
	 */
	private static $instance;

	/**
	 * Initiator
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->include_configurations();
		//Kirki Init
		add_action( 'init', array( $this, 'register_customizer_settings' ), 99 );

		add_filter( 'kirki_output_inline_styles', '__return_false' );
		#add_filter( 'kirki_config', array( $this, 'load_kirki_fast' ) );

		if ( is_admin() || is_customize_preview() ) {
			add_action( 'customize_controls_print_styles', array( $this, 'control_styles' ), 99 );
			#add_action( 'customize_save_after', array( $this, 'on_customizer_save' ) );
		}
	}

	function load_kirki_fast( $priority ) {
		$priority['styles_priority'] = 10;

		return $priority;
	}

	/**
	 * Kirki Function initialization and add
	 *
	 * @since 1.0.0
	 * @author CodeManas
	 */
	public function kirki_init() {
		Kirki::add_config( 'busify_theme_config', array(
			'capability'  => 'edit_theme_options',
			'option_type' => 'theme_mod',
			'url_path'    => get_theme_file_uri( '/inc/kirki' ),
		) );
	}

	public function include_configurations() {
		require CODEMANAS_THEME_DIR . 'inc/customizer/class-busify-customizer-config-base.php';
		require CODEMANAS_THEME_DIR . 'inc/customizer/class-busify-customizer-register-panels.php';
		require CODEMANAS_THEME_DIR . 'inc/customizer/class-busify-customizer-register-sections.php';
		require CODEMANAS_THEME_DIR . 'inc/customizer/class-busify-customizer-register-fields.php';
	}

	public function register_customizer_settings() {
		//Kirki Initialize
		$this->kirki_init();

		$configurations = $this->get_kirk_customizer_settings();
		foreach ( $configurations as $key => $config ) {

			switch ( $config['category'] ) {
				case 'panel':
					unset( $config['category'] );
					Kirki::add_panel( $config['name'], $config );

					break;

				case 'section':
					unset( $config['category'] );
					Kirki::add_section( $config['name'], $config );

					break;

				case 'field':
					unset( $config['category'] );
					Kirki::add_field( 'busify_theme_config', $config );

					break;
			}
		}
	}

	public function get_kirk_customizer_settings() {
		return apply_filters( 'busify_customizer_configs', array() );
	}

	public function control_styles() {
		?>
        <style>
            .customizer-busify-title.nomargin {
                margin-top: 0;
            }

            .customizer-busify-title {
                display: block;
                padding: 13px 12px;
                border-width: 1px 0;
                border-style: solid;
                border-color: #ddd;
                background-color: #fff;
                font-weight: 500;
                letter-spacing: 1px;
                line-height: 2;
                text-transform: uppercase;
                font-size: 12px;
                margin: 15px -18px;
                text-align: center;
            }

            #accordion-panel-nav_menus {
                margin-top: 30px;
            }

            #input_field-footer-widget-layout label {
                margin-right: 10px;
                margin-bottom: 10px;
            }
        </style>
		<?php
	}
}

Busify_Customizer::get_instance();