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
		$layout = Busify_Theme_Options::get_option( 'field-footer-widget-layout' );
		switch ( $layout ) {
			case 'wd-four':
				$footer_widgets = array(
					'footer-one'   => 'Footer 1',
					'footer-two'   => 'Footer 2',
					'footer-three' => 'Footer 3',
					'footer-four'  => 'Footer 4',
				);

				foreach ( $footer_widgets as $k => $footer_widget ) {
					if ( is_active_sidebar( $k ) ) {
						?>
                        <section class="col-md-3 widget-<?php echo $k; ?> busify-widget-<?php echo $k; ?> widget-section-wrap">
							<?php dynamic_sidebar( $k ); ?>
                        </section>
						<?php
					}
				}
				break;
			case 'wd-two':
				$footer_widgets = array(
					'footer-one' => 'Footer 1',
					'footer-two' => 'Footer 2',
				);
				foreach ( $footer_widgets as $k => $footer_widget ) {
					if ( is_active_sidebar( $k ) ) {
						?>
                        <section class="col-md-6 widget-<?php echo $k; ?> busify-widget-<?php echo $k; ?> widget-section-wrap">
							<?php dynamic_sidebar( $k ); ?>
                        </section>
						<?php
					}
				}
				break;
			case 'wd-three':
				$footer_widgets = array(
					'footer-one'   => 'Footer 1',
					'footer-two'   => 'Footer 2',
					'footer-three' => 'Footer 3',
				);
				foreach ( $footer_widgets as $k => $footer_widget ) {
					if ( is_active_sidebar( $k ) ) {
						?>
                        <section class="col-md-4 widget-<?php echo $k; ?> busify-widget-<?php echo $k; ?> widget-section-wrap">
							<?php dynamic_sidebar( $k ); ?>
                        </section>
						<?php
					}
				}
				break;
			case 'wd-one':
				if ( is_active_sidebar( 'footer-one' ) ) {
					?>
                    <section class="col-md-12 widget-footer-one busify-widget-footer-one widget-section-wrap">
						<?php dynamic_sidebar( 'footer-one' ); ?>
                    </section>
					<?php
				}
				break;
		}
	}
}