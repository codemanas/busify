<?php
/**
 * Register widget sections
 *
 * @since 1.0.0
 * @author CodeManas
 * @copyright 2019 CodeManas. All Rights Reserved !
 */

add_action( 'widgets_init', 'codemanas_busify_widgets_init' );
function codemanas_busify_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', CODEMANAS_THEME_DOMAIN ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', CODEMANAS_THEME_DOMAIN ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Footer widgets
	$footer_widgets = array(
		'footer-one'   => 'Footer 1',
		'footer-two'   => 'Footer 2',
		'footer-three' => 'Footer 3',
		'footer-four'  => 'Footer 4',
	);
	foreach ( $footer_widgets as $k => $footer_widget ) {
		register_sidebar( array(
			'name'          => esc_html__( $footer_widget, CODEMANAS_THEME_DOMAIN ),
			'id'            => $k,
			'description'   => esc_html__( 'Add widgets here.', CODEMANAS_THEME_DOMAIN ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}

}