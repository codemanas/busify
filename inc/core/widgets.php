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
		'name'          => esc_html__( 'Sidebar', 'busify' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'busify' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Footer widgets
	$footer_widgets = array(
		'footer-one'   => __( 'Footer 1', 'busify' ),
		'footer-two'   => __( 'Footer 2', 'busify' ),
		'footer-three' => __( 'Footer 3', 'busify' ),
		'footer-four'  => __( 'Footer 4', 'busify' )
	);
	foreach ( $footer_widgets as $k => $footer_widget ) {
		register_sidebar( array(
			'name'          => $footer_widget,
			'id'            => $k,
			'description'   => esc_html__( 'Add widgets here.', 'busify' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}

}