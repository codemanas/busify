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


/*Import content data*/
if ( ! function_exists( 'busify_import_files' ) ) :
	/**
	 * Define import paths for import ready content
	 */
	function busify_import_files() {
		return array(
			array(
				'import_file_name'             => 'busify-theme',
				'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/demo-data/demo-content.xml',
				'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/demo-data/widgets.wie',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'assets/demo-data/customizer.dat',
			)
		);
	}

	add_filter( 'pt-ocdi/import_files', 'busify_import_files' );
endif;

if ( ! function_exists( 'busify_after_import' ) ) :
	/**
	 * Import theme options after import of content widgets and plugins are completed.
	 *
	 * @param $selected_import
	 */
	function busify_after_import( $selected_import ) {

		if ( 'busify-theme' === $selected_import['import_file_name'] ) {
			$site_options = array(
				'custom_logo'                          => false,
				'nav_menu_locations'                   => 'primary-menu',
				'show_on_front'                        => 'page',
				'page_on_front'                        => 'Home',
				'page_for_posts'                       => 'Blog',
				'contact_page'                         => 'Contact',

				// Plugin: Elementor.
				'elementor_container_width'            => '1140',
				'elementor_css_print_method'           => 'external',
				'elementor_disable_color_schemes'      => 'yes',
				'elementor_disable_typography_schemes' => 'yes',
			);

			busify_import_theme_options( $site_options );

			//Clear Cache
			if ( busify_elementor_active() ) {
				\Elementor\Plugin::$instance->files_manager->clear_cache();
			}
		}
	}

	add_action( 'pt-ocdi/after_import', 'busify_after_import' );
endif;

/**
 * Set imported options to theme
 *
 * @param array $options
 */
function busify_import_theme_options( $options = array() ) {
	if ( ! isset( $options ) ) {
		return;
	}

	foreach ( $options as $option_name => $option_value ) {

		if ( ! empty( $option_value ) ) {

			switch ( $option_name ) {

				case 'page_for_posts':
				case 'page_on_front':
					$page = get_page_by_title( $option_value );
					if ( is_object( $page ) ) {
						update_option( $option_name, $page->ID );
					}
					break;

				// nav menu locations.
				case 'nav_menu_locations':
					$menu_locations = array();

					// Update menu locations.
					if ( isset( $option_value ) ) {

						$term = get_term_by( 'slug', $option_value, 'nav_menu' );
						if ( is_object( $term ) ) {
							$menu_locations[ $option_value ] = $term->term_id;
						}

						set_theme_mod( 'nav_menu_locations', $menu_locations );
					}
					break;

				case 'contact_page':
					$page = get_page_by_title( $option_value );
					if ( ! empty( $page ) ) {
						$data = get_post_meta( $page->ID, '_elementor_data', true );

						//Import WP Forms
						OCDI\WpFormsImport::import_wpforms();

						// Update WP form IDs.
						$ids_mapping = get_option( 'busify_tpl_wpforms_ids_mapping', array() );
						if ( $ids_mapping ) {
							foreach ( $ids_mapping as $old_id => $new_id ) {
								$data = str_replace( '[wpforms id=\"' . $old_id, '[wpforms id=\"' . $new_id, $data );
							}
						}
					}

					break;

				default:
					update_option( $option_name, $option_value );
					break;
			}
		}
	}
}