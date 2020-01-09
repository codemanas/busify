<?php
/**
 * @author Deepen.
 * @created_on 12/27/19
 */

namespace OCDI;

class PluginsInstaller extends OneClickDemoImport {

	public static function required_plugins() {
		$response = array(
			'active'       => array(),
			'inactive'     => array(),
			'notinstalled' => array(),
		);

		$required_plugins = array(
			'elementor'        => array(
				'init' => 'elementor/elementor.php',
				'name' => 'Elementor Page Builder',
				'slug' => 'elementor',
				'link' => 'https://wordpress.org/plugins/elementor/',
			),
			'wpforms-lite'     => array(
				'init' => 'wpforms-lite/wpforms.php',
				'name' => 'Contact Form by WPForms',
				'slug' => 'wpforms-lite',
				'link' => 'https://wordpress.org/plugins/wpforms-lite/',
			),
		);

		foreach ( $required_plugins as $key => $plugin ) {
			//Is PRO version Installed ?
			$plugin_pro = self::pro_plugin_exist_by_path( $plugin['init'] );
			if ( $plugin_pro ) {
				// Pro - Active.
				if ( is_plugin_active( $plugin_pro['init'] ) ) {
					$response['active'][] = $plugin_pro;
				} else {
					$response['inactive'][] = $plugin_pro;
				}
			} else {
				if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin['init'] ) && is_plugin_inactive( $plugin['init'] ) ) {
					$response['inactive'][] = $plugin;
				} elseif ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin['init'] ) ) {
					$response['notinstalled'][] = $plugin;
				} else {
					$response['active'][] = $plugin;
				}
			}
		}

		return $response;
	}

	/**
	 * Activate request plugins
	 */
	public function activate_plugins() {
		// Verify if the AJAX call is valid (checks nonce and current_user_can).
		Helpers::verify_ajax_call();

		$inactive_plugins = self::required_plugins();
		$inactive_plugins = $inactive_plugins['inactive'];
		if ( ! empty( $inactive_plugins ) ) {

			if ( ! current_user_can( 'install_plugins' ) ) {
				wp_send_json( __( 'User have not plugin install permissions.', CODEMANAS_THEME_DOMAIN ) );
			}

			foreach ( $inactive_plugins as $inactive_plugin ) {
				$activate = activate_plugin( $inactive_plugin['init'], '', false, true );
				if ( is_wp_error( $activate ) ) {
					wp_send_json( $activate->get_error_message() );
				}
			}
		}

		wp_send_json( array( 'status' => 'importXMLContent' ) );
	}

	/**
	 * Check if PRO version exists
	 *
	 * @param string $lite_version
	 *
	 * @return bool
	 */
	protected static function pro_plugin_exist_by_path( $lite_version = '' ) {
		//Lite version to PRO Version
		$plugins = apply_filters( 'busify_pro_plugin_exist', array(
			'elementor/elementor.php'  => array(
				'slug' => 'elementor',
				'init' => 'elementor-pro/elementor-pro.php',
				'name' => 'Elementor Page Builder',
			),
			'wpforms-lite/wpforms.php' => array(
				'slug' => 'wpforms',
				'init' => 'wpforms/wpforms.php',
				'name' => 'Contact Form by WPForms',
			),
		), $lite_version );

		if ( isset( $plugins[ $lite_version ] ) ) {
			// Pro plugin directory exist?
			if ( file_exists( WP_PLUGIN_DIR . '/' . $plugins[ $lite_version ]['init'] ) ) {
				return $plugins[ $lite_version ];
			}
		}

		return false;
	}

	/**
	 * Check if PRO version exists
	 *
	 * @param string $lite_version
	 *
	 * @return bool
	 */
	public static function pro_plugin_exist_by_slug( $lite_version = '' ) {
		//Lite version to PRO Version
		$plugins = apply_filters( 'busify_pro_plugin_exist', array(
			'elementor'    => array(
				'slug' => 'elementor',
				'init' => 'elementor-pro/elementor-pro.php',
				'name' => 'Elementor Page Builder',
			),
			'wpforms-lite' => array(
				'slug' => 'wpforms',
				'init' => 'wpforms/wpforms.php',
				'name' => 'Contact Form by WPForms',
			),
		), $lite_version );

		if ( isset( $plugins[ $lite_version ] ) ) {
			// Pro plugin directory exist?
			if ( file_exists( WP_PLUGIN_DIR . '/' . $plugins[ $lite_version ]['init'] ) ) {
				return $plugins[ $lite_version ];
			}
		}

		return false;
	}

	/**
	 * Check for required plugins
	 * @return bool
	 */
	public static function check_required_plugin_installed_activated() {
		$plugins = apply_filters( 'busify_check_required_activated_plugins', array(
			'elementor'        => array(
				'init' => 'elementor/elementor.php',
				'name' => 'Elementor Page Builder',
				'slug' => 'elementor',
			),
			'wpforms-lite'     => array(
				'init' => 'wpforms-lite/wpforms.php',
				'name' => 'Contact Form by WPForms',
			),
			'busify-elementor' => array(
				'init' => 'busify-elementor/busify-elementor.php',
				'name' => 'Busify Elementor Widgets Bundle',
			)
		) );

		$exists = true;
		if ( ! empty( $plugins ) ) {
			$active_plugins = (array) get_option( 'active_plugins', array() );
			foreach ( $plugins as $plugin ) {
				$plugin_active = in_array( $plugin['init'], $active_plugins ) || array_key_exists( $plugin['init'], $active_plugins );
				if ( $plugin_active === false ) {
					$exists = false;
					break;
				}
			}
		}

		return $exists;
	}

	/**
	 * Check if a plugin is installed or not.
	 *
	 * @param $plugin_init
	 *
	 * @return bool
	 */
	public static function check_plugin_installed( $plugin_init ) {
		$active_plugins = (array) get_option( 'active_plugins', array() );

		return in_array( $plugin_init, $active_plugins ) || array_key_exists( $plugin_init, $active_plugins );
	}
}