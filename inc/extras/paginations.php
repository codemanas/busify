<?php
/**
 * Pagination Scripts here
 *
 * @package busify
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! function_exists( 'busify_pagination' ) ) {
	/**
	 * Paginate the posts
	 */
	function busify_pagination() {
		$pagination = Busify_Theme_Options::get_option( 'field-blog-post-pagination' );
		echo '<div class="busify-pagination center-align-pagination">';
		if ( ! empty( $pagination ) ) {
			switch ( $pagination ) {
				case 'load-more':
					global $wp_query;
					$filter       = get_query_var( 's' );
					$current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					if ( $wp_query->max_num_pages > 1 ) {
						?>
                        <button data-filter="<?php echo esc_attr( $filter ); ?>" data-current-page="<?php echo absint( $current_page ); ?>" id="busify-ajax-load-more" class="busify-ajax-load-more"><?php echo esc_html__( 'Load More', 'busify' ); ?></button>
						<?php
					}
					break;
				case 'legacy':
					posts_nav_link();
					break;
				default:
					break;
			}
		}
		echo '</div>';
	}
}

add_action( 'wp_ajax_busify_load_more_posts', 'busify_load_more_posts' );
add_action( 'wp_ajax_nopriv_busify_load_more_posts', 'busify_load_more_posts' );
function busify_load_more_posts() {
	// prepare our arguments for the query
	$args = array(
		'posts_per_page' => get_option( 'posts_per_page' ),
		'post_status'    => 'publish',
		'paged'          => $_POST['page'],
	);

	if ( ! empty( $_POST['filter'] ) ) {
		$args['s'] = $_POST['filter'];
	}

	$query = new WP_Query( $args );

	$post_html = '';
	if ( $query->have_posts() ) :
		/* Start the Loop */
		while ( $query->have_posts() ) :
			$query->the_post();

			/*
			 * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			 */
			ob_start();
			get_template_part( 'template-parts/content', get_post_type() );
			$post_html .= ob_get_contents();
			ob_end_clean();

		endwhile;
	endif;

	$response = array(
		'post_html' => $post_html,
		'max_page'  => $query->max_num_pages,
	);
	wp_send_json_success( $response );

	wp_die();
}