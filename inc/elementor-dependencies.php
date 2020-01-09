<?php
/**
 * Check if elementor is active
 *
 * @return bool
 */
function busify_elementor_active() {
	$active_plugins = (array) get_option( 'active_plugins', array() );

	return in_array( 'elementor/elementor.php', $active_plugins ) || array_key_exists( 'elementor/elementor.php', $active_plugins );
}