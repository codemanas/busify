<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package busify
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! function_exists( 'busify_post_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function busify_post_posted_on() {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			$time_string = sprintf( $time_string, esc_attr( get_the_date( DATE_W3C ) ), esc_html( get_the_date() ) );

			$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

			echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'busify_post_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function busify_post_posted_by() {
		if ( ! empty( get_the_author() ) ) {
			echo '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'; // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'busify_post_category_links' ) ) :
	/**
	 * Prints Category for Current Post
	 */
	function busify_post_category_links() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'busify' ) );
			if ( $tags_list ) {
				echo '<span class="cat-tags-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'busify' ) );
			if ( $categories_list ) {
				echo '<span class="blog-type-category">' . $categories_list . '</span>'; // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'busify_post_leave_comment' ) ) :
	/**
	 * Prints Comment string on post
	 */
	function busify_post_leave_comment() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */
				__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'busify' ), array(
				'span' => array(
					'class' => array(),
				),
			) ), esc_html( get_the_title() ) ) );
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'busify_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function busify_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

            <div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

		<?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail( 'post-thumbnail', array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
				) );
				?>
            </a>

		<?php
		endif; // End is_singular().
	}
endif;


/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function busify_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#content">' . __( 'Skip to the content', 'busify' ) . '</a>';
}

add_action( 'wp_body_open', 'busify_skip_link', 5 );