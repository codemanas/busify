<?php
/**
 * Helpers to the rescue Here !
 *
 * @package busify
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! function_exists( 'busify_check_elementor_builtwith' ) ) {
	/**
	 * Check if page is built with elementor
	 *
	 * @param $post_id
	 *
	 * @return bool
	 */
	function busify_check_elementor_builtwith( $post_id = false ) {
		if ( empty( $post_id ) ) {
			$post_id = get_the_id();
		}

		if ( busify_is_archive() ) {
			return false;
		}

		if ( busify_elementor_active() ) {
			return \Elementor\Plugin::$instance->db->is_built_with_elementor( $post_id );
		}

		return false;
	}
}

if ( ! function_exists( 'is_navxt_breadcrumbs_enabled' ) ) {
	function is_navxt_breadcrumbs_enabled() {
		$active_plugins = (array) get_option( 'active_plugins', array() );

		return in_array( 'breadcrumb-navxt/breadcrumb-navxt.php', $active_plugins ) || array_key_exists( 'breadcrumb-navxt/breadcrumb-navxt.php', $active_plugins );
	}
}

add_filter( 'body_class', 'busify_elementor_classes' );
function busify_elementor_classes( $body ) {
	$check = busify_check_elementor_builtwith();

	if ( $check ) {
		$body[] = 'busify-elementor-page-template';
	} else {
		$body[] = 'busify-no-builder-page-template';
	}

	return $body;
}

if ( ! function_exists( 'busify_dump' ) ) {
	function busify_dump( $str ) {
		echo "<pre>";
		var_dump( $str );
		echo "</pre>";
	}
}

/**
 * Breadcrumbs apply
 */
if ( ! function_exists( 'busify_breacrumbs' ) ) {
	function busify_breacrumbs() {
		if ( function_exists( 'bcn_display' ) ) {
			$breadcrumb = Busify_Theme_Options::get_option( 'field-breadcrumb-type' );
			if ( ! empty( $breadcrumb ) && $breadcrumb !== "none" ) {
				?>
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					<?php bcn_display(); ?>
                </div>
				<?php
			}
		}
	}
}

/**
 * Check if the current page is archive/search/blog
 *
 * @return bool True if the current page is archive or search or blog
 */
if ( ! function_exists( 'busify_is_archive' ) ) {
	function busify_is_archive() {
		return is_archive() || is_search() || is_home() || wp_doing_ajax();
	}
}

if ( ! function_exists( 'busify_search_results' ) ) {
	/**
	 * Return if search page did not find anything on it
	 * @return bool
	 */
	function busify_search_results() {
		// Checking on search page only
		if ( is_search() ) {
			global $wp_query;

			//If Search doesnot if anything return false
			if ( 0 === $wp_query->found_posts ) {
				return false;
			}
		}

		return true;
	}
}

add_filter( 'bcn_settings_init', 'busify_breadcrumb_trail' );
/**
 * Change Breadcrum seperator to theme
 *
 * @param $trail
 *
 * @return mixed
 */
function busify_breadcrumb_trail( $trail ) {
	$seperator = Busify_Theme_Options::get_option( 'field-breadcrumb-seperator' );
	if ( ! empty( $seperator ) ) {
		$trail['hseparator'] = '<span class="seperator">' . $seperator . '</span>';
	}

	return $trail;
}
