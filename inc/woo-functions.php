<?php
/**
 * Functions used by plugins
 *
 * @package busify
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! class_exists( 'WC_Dependencies' ) ) {
	require_once CODEMANAS_THEME_DIR . 'inc/class-wc-dependencies.php';
}

/**
 * WC Detection
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {
	function is_woocommerce_active() {
		return WC_Dependencies::woocommerce_active_check();
	}
}