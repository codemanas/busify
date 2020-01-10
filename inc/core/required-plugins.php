<?php
/**
 * Activation Plugn notices for the theme.
 *
 * @since 1.0.0
 * @author CodeManas
 * @copyright 2019 CodeManas. All Rights Reserved !
 */

require_once CODEMANAS_THEME_DIR . 'inc/core/class-busify-tgm-plugina-activation.php';

add_action( 'tgmpa_register', 'busify_register_required_plugins' );

//If PRO VERSION exists remove notice
function busify_check_if_pro_plugin_exists() {
	$plugins = array(
		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'     => 'Elementor Page Builder',
			'slug'     => 'elementor',
			'required' => true,
		),
		array(
			'name'     => 'Contact Form by WPForms',
			'slug'     => 'wpforms-lite',
			'required' => true,
		),
	);

	return $plugins;
}

/**
 * Register the required plugins for this theme.
 */
function busify_register_required_plugins() {

	$plugins = busify_check_if_pro_plugin_exists();

	$config = array(
		'id'           => 'busify',
		'default_path' => CODEMANAS_THEME_DIR . 'assets/plugins/',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'busify-theme',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
	);

	tgmpa( $plugins, $config );
}