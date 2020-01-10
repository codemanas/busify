<?php
/**
 * Sidebar Functions Here
 *
 * @package busify
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fetch type of sidebar style
 *
 * @param $sidebar
 *
 * @return mixed
 */
function get_busify_sidebar_style( $sidebar ) {
	if ( $sidebar === "left" ) {
		$result = 'left-sidebar';
	} else if ( $sidebar === "right" ) {
		$result = 'right-sidebar';
	} else if ( $sidebar === "default" ) {
		$result = Busify_Theme_Options::get_option( 'field-sidebar-type' );
		$result = get_busify_sidebar_style( $result );
	} else {
		$result = 'none';
	}

	return apply_filters( 'busify_sidebar_layout_style', $result );
}

/**
 * Fetch sidebar layout
 */
function get_busify_sidebar_layout() {
	if ( ! busify_search_results() ) {
		return;
	}

	if ( ! busify_check_elementor_builtwith() ) {
		//Global Sidebar
		$sidebar_layout = array(
			'field-sidebar-type'    => Busify_Theme_Options::get_option( 'field-sidebar-type' ),
		);

		//Post Sidebar
		$global_sidebar = ! empty( $sidebar_layout['field-sidebar-type'] ) ? $sidebar_layout['field-sidebar-type'] : false;
		//Return global sidebar
		$sidebar = $global_sidebar;

		if ( $global_sidebar !== "none" ) {
			$sidebar = get_busify_sidebar_style( $sidebar );
		}

		return apply_filters( 'busify_sidebar_layout', $sidebar, $sidebar_layout );
	} else {
		return false;
	}
}

add_action( 'busify_before_main_content', 'busify_before_main_content_wrapper_start' );
function busify_before_main_content_wrapper_start() {
	if ( ! busify_search_results() ) {
		echo "<div class='col-md-12'>";
	} else if ( ! busify_check_elementor_builtwith() ) {
		$sidebar_layout = get_busify_sidebar_layout();
		if ( $sidebar_layout !== 'none' ) {
			echo "<div class='col-md-9'>";
		} else {
			echo "<div class='col-md-12'>";
		}
	}
}

add_action( 'busify_after_main_content', 'busify_after_main_content_wrapper_end' );
function busify_after_main_content_wrapper_end() {
	if ( ! busify_check_elementor_builtwith() ) {
		echo "</div>";
	}
}

/**
 * Return row as a class if its not built with elementor builder
 * @return string
 */
function busify_page_post_class_row_class() {
	if ( ! busify_check_elementor_builtwith() ) {
		$data = 'class="row"';
	} else {
		$data = 'class="busify-elementor-start"';
	}

	return $data;
}

/**
 * Make Content Sortable Here
 */
add_action( 'busify_main_content', 'busify_content_post_sortable', 10 );
if ( ! function_exists( 'busify_content_post_sortable' ) ) {
	function busify_content_post_sortable() {
		if ( is_singular() ) {
			//Blog Single pages
			$post_content = Busify_Theme_Options::get_option( 'field-single-post-structure' );
		} else {
			//Blog Archive Page
			$post_content = Busify_Theme_Options::get_option( 'field-blog-page-layout' );
		}

		if ( ! empty( $post_content ) ) {
			foreach ( $post_content as $cont ) {
				switch ( $cont ) {
					case 'title':
						?>
                        <div class="busify-post-content-section busify-post-content-title">
							<?php
							if ( is_singular() ) :
								the_title( '<h1 class="entry-title">', '</h1>' );
							else :
								the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
							endif;
							?>
                        </div>
						<?php
						break;

					case 'image':
						if ( has_post_thumbnail() ) {
							?>
                            <div class="busify-post-content-section busify-post-content-featured-img">
								<?php busify_post_thumbnail(); ?>
                            </div>
							<?php
						}
						break;

					case 'meta':
						?>
                        <div class="busify-post-content-section busify-post-content-meta">
							<?php
							if ( 'post' === get_post_type() ) :
								?>
                                <div class="entry-meta">
									<?php
									busify_post_posted_on();
									busify_post_posted_by();
									busify_post_category_links();
									busify_post_leave_comment();
									?>
                                </div>
							<?php endif; ?>
                        </div>
						<?php
						break;

					case 'content':
						?>
                        <div class="busify-post-content-section busify-post-entry-content">
							<?php
							if ( is_singular() ) :
								the_content();
							else:
								the_excerpt();
							endif;
							?>
                        </div>
						<?php
						break;
				}
			}
		}
	}
}

