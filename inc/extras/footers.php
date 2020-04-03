<?php
/**
 * Footer Section Hooks
 *
 * @package busify
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! function_exists( 'busify_get_footer_widgets' ) ) {
	/**
	 * Get Sidebar
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function busify_get_footer_widgets() {
		$layout = 'wd-four';
		switch ( $layout ) {
			case 'wd-four':
				$footer_widgets = array(
					'footer-one'   => esc_html__( 'Footer 1', 'busify' ),
					'footer-two'   => esc_html__( 'Footer 2', 'busify' ),
					'footer-three' => esc_html__( 'Footer 3', 'busify' ),
					'footer-four'  => esc_html__( 'Footer 4', 'busify' ),
				);

				foreach ( $footer_widgets as $k => $footer_widget ) {
					if ( is_active_sidebar( $k ) ) {
						?>
                        <section class="col-md-3 widget-<?php echo esc_attr( $k ); ?> busify-widget-<?php echo esc_attr( $k ); ?> widget-section-wrap">
							<?php dynamic_sidebar( $k ); ?>
                        </section>
						<?php
					}
				}
				break;
		}
	}
}