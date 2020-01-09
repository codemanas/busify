<?php
/**
 * A custom WordPress comment walker class to implement comment list
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */
class Busify_Comment_Walker extends Walker_Comment {

	/**
	 * Output a comment in the HTML5 format.
	 *
	 * @since 1.0.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param object $comment the comments list.
	 * @param int $depth Depth of comments.
	 * @param array $args An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( $args['style'] === 'div' ) ? 'div' : 'li';
		?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'has-children' : '' ); ?>>

        <div class="comment-header">
			<?php if ( $args['avatar_size'] != 0 ): ?>
                <div class="media-img">
					<?php echo get_avatar( $comment, $args['avatar_size'], 'mm', '', array( 'class' => "comment_avatar rounded-circle" ) ); ?>
                </div>
			<?php endif; ?>
            <div class="comment-metadata">
                <span class="comment-author"><i class="fa fa-user"></i> <strong><?php echo get_comment_author_link() ?></strong></span>
                <span class="comment-meta"><i class="fa fa-clock"></i><time class="small" datetime="<?php comment_time( 'c' ); ?>"><?php comment_date() ?>, <?php comment_time() ?></time></span>
            </div>
            <div class="comment-content-reply">
				<?php
				edit_comment_link( __( 'Edit' ), '<div class="edit-link list-inline-item"><i class="fa fa-edit"></i> ', '</div>' );

				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply-link list-inline-item"><i class="fa fa-reply"></i> ',
					'after'     => '</div>'
				) ) );
				?>
            </div>
        </div>
        <div class="comment-body" id="div-comment-<?php comment_ID(); ?>">
			<?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
			<?php endif; ?>
            <div class="comment-content">
				<?php comment_text(); ?>
            </div>
        </div>
		<?php
	}
}

/**
 * Filter Comment Author data according to your needs
 */
if ( ! function_exists( 'busify_comment_author_link' ) ) {
	add_filter( 'get_comment_author_link', 'busify_comment_author_link', 10, 3 );
	function busify_comment_author_link( $result, $author, $comment_id ) {
		$comment = get_comment( $comment_id );
		$url     = get_comment_author_url( $comment );

		if ( ! empty( $comment->user_id ) ) {
			$user = $comment->user_id ? get_userdata( $comment->user_id ) : false;
			if ( $user ) {
				$author = ! empty( $user->first_name ) && ! empty( $user->last_name ) ? $user->first_name . ' ' . $user->last_name : $user->display_name;
			} else {
				$author = __( 'Anonymous' );
			}
		}

		$valid_uri = filter_var( $url, FILTER_VALIDATE_URL );
		if ( ( empty( $url ) || 'http://' == $url ) && ! $valid_uri ) {
			$result = $author;
		} else {
			$result = "<a href='$url' rel='external nofollow ugc' class='url'>$author</a>";
		}

		return apply_filters( 'busify_get_comment_author_link', $result, $author, $comment_id );
	}
}

if ( ! function_exists( 'busify_show_comments' ) ) {
	add_action( 'busify_main_comments', 'busify_show_comments' );
	/**
	 * Show main Comments section
	 */
	function busify_show_comments() {
		?>
        <h4 class="comments-title-section">
				<span>
				<?php
				$code_manas_comment_count = get_comments_number();
				if ( '1' === $code_manas_comment_count ) {
					printf( /* translators: 1: title. */
						esc_html__( '1 comment', 'code-manas' ), '<span>' . get_the_title() . '</span>' );
				} else {
					printf( esc_html( _nx( '%1$s comment', '%1$s comments', $code_manas_comment_count, 'comments title', 'code-manas' ) ), number_format_i18n( $code_manas_comment_count ), '<span>' . get_the_title() . '</span>' );
				}
				?>
				</span>
        </h4>

        <ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'max_depth'   => 4,
				'short_ping'  => true,
				'avatar_size' => '50',
				'walker'      => new Busify_Comment_Walker(),
			) );
			?>
        </ol>
		<?php
	}
}