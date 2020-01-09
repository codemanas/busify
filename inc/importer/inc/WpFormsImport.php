<?php
/**
 * @author Deepen.
 * @created_on 12/27/19
 */

namespace OCDI;

if ( ! class_exists( 'WPForms_Template' ) ) {
	return;
}

class WpFormsImport {

	static function import_wpforms() {

		$ids_mapping = array();

		if ( function_exists( 'wpforms_encode' ) ) {

			// Download XML file.
			$form_file = CODEMANAS_THEME_DIR . 'assets/demo-data/wp-forms.json';

			if ( $form_file ) {
				if ( isset( $form_file ) ) {

					$ext = strtolower( pathinfo( $form_file, PATHINFO_EXTENSION ) );

					if ( 'json' === $ext ) {
						$forms = json_decode( file_get_contents( $form_file ), true );

						if ( ! empty( $forms ) ) {

							foreach ( $forms as $form ) {
								$title = ! empty( $form['settings']['form_title'] ) ? $form['settings']['form_title'] : '';
								$desc  = ! empty( $form['settings']['form_desc'] ) ? $form['settings']['form_desc'] : '';

								$new_id = post_exists( $title );

								if ( ! $new_id ) {
									$new_id = wp_insert_post( array(
										'post_title'   => $title,
										'post_status'  => 'publish',
										'post_type'    => 'wpforms',
										'post_excerpt' => $desc,
									) );
								}

								if ( $new_id ) {
									// ID mapping.
									$ids_mapping[ $form['id'] ] = $new_id;

									$form['id'] = $new_id;
									wp_update_post( array(
										'ID'           => $new_id,
										'post_content' => wpforms_encode( $form ),
									) );
								}
							}
						}
					}
				}
			}
		}

		update_option( 'busify_tpl_wpforms_ids_mapping', $ids_mapping );
	}
}
