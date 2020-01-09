<?php
/**
 * Breadcrumb Shortcode
 *
 * @package busify
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
add_shortcode( 'busify_breacrumbs', 'busify_render_breadcrumb_shortcode' );
function busify_render_breadcrumb_shortcode() {
	ob_start();

	if ( function_exists( 'bcn_display' ) ) {
		$breacrumbs = Busify_Theme_Options::get_option( 'field-breadcrumb-type' );
		if ( ! empty( $breacrumbs ) && $breacrumbs !== 'none' ) {
			?>
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php bcn_display(); ?>
            </div>
			<?php
		}
	}

	return ob_get_clean();
}