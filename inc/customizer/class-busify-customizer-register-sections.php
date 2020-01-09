<?php
/**
 * Registering section for customizer
 *
 * @package     busify
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Busify_Customizer_Register_Sections extends Busify_Customizer_Conifg_Base {

	public function register_configuration( $configs ) {
		$global_sections = array(
			//Container
			array(
				'name'     => 'section-global-container-layout',
				'category' => 'section',
				'priority' => 1,
				'title'    => esc_html__( 'Container', CODEMANAS_THEME_DOMAIN ),
				'panel'    => 'panel-global'
			),

			//Typography
			array(
				'name'     => 'section-global-typography',
				'category' => 'section',
				'priority' => 2,
				'title'    => esc_html__( 'Typography', CODEMANAS_THEME_DOMAIN ),
				'panel'    => 'panel-global'
			),

			//Colors
			array(
				'name'        => 'section-global-colors',
				'category'    => 'section',
				'priority'    => 3,
				'title'       => esc_html__( 'Colors', CODEMANAS_THEME_DOMAIN ),
				'panel'       => 'panel-global',
				'description' => __( 'This can be overridden via elementor custom colors. Except for body background color.', CODEMANAS_THEME_DOMAIN )
			),

			//Buttons
			array(
				'name'     => 'section-global-buttons',
				'category' => 'section',
				'priority' => 4,
				'title'    => esc_html__( 'Buttons', CODEMANAS_THEME_DOMAIN ),
				'panel'    => 'panel-global'
			),
		);

		$header_sections = array(
			//Site Identity
			array(
				'name'               => 'title_tagline',
				'category'           => 'section',
				'priority'           => 2,
				'title'              => __( 'Site Identity', CODEMANAS_THEME_DOMAIN ),
				'panel'              => 'panel-header',
				'description_hidden' => true,
			),

			//Primary Header
			array(
				'name'     => 'section-header-primary',
				'category' => 'section',
				'priority' => 2,
				'title'    => esc_html__( 'Primary Header & Menus', CODEMANAS_THEME_DOMAIN ),
				'panel'    => 'panel-header'
			),

			//Transparent Header
			array(
				'name'     => 'section-header-transparent-header',
				'category' => 'section',
				'priority' => 4,
				'title'    => esc_html__( 'Transparent Header', CODEMANAS_THEME_DOMAIN ),
				'panel'    => 'panel-header'
			),

			//Sticky Header
			array(
				'name'     => 'section-header-sticky',
				'category' => 'section',
				'priority' => 5,
				'title'    => esc_html__( 'Sticky Header', CODEMANAS_THEME_DOMAIN ),
				'panel'    => 'panel-header'
			),

			//Transparent Header
			array(
				'name'     => 'section-header-banner-image',
				'category' => 'section',
				'priority' => 6,
				'title'    => esc_html__( 'Inner Banner Image', CODEMANAS_THEME_DOMAIN ),
				'panel'    => 'panel-header'
			),
		);

		$breadrumb_sections = array(
			array(
				'name'               => 'section-breadcrumbs',
				'category'           => 'section',
				'priority'           => 30,
				'title'              => __( 'Breadcrumbs', CODEMANAS_THEME_DOMAIN ),
				'description_hidden' => false,
				'description'        => __( 'Breadcrumbs are automatically hidden on elementor pages.', CODEMANAS_THEME_DOMAIN )
			)
		);

		$blog_sections = array(
			array(
				'name'        => 'section-blog-archive',
				'category'    => 'section',
				'priority'    => 40,
				'panel'       => 'panel-blog',
				'description' => esc_html__( 'Note: This option will effect archive/blog listing page.', CODEMANAS_THEME_DOMAIN ),
				'title'       => __( 'Blog/Archive Page', CODEMANAS_THEME_DOMAIN ),
			),
			array(
				'name'        => 'section-single-post',
				'category'    => 'section',
				'priority'    => 45,
				'panel'       => 'panel-blog',
				'description' => esc_html__( 'Note: This option will effect only in single posts.', CODEMANAS_THEME_DOMAIN ),
				'title'       => __( 'Single Posts', CODEMANAS_THEME_DOMAIN ),
			),
			array(
				'name'     => 'section-blog-pagination',
				'category' => 'section',
				'priority' => 46,
				'panel'    => 'panel-blog',
				'title'    => __( 'Pagination', CODEMANAS_THEME_DOMAIN ),
			)
		);

		$sidebar_sections = array(
			array(
				'name'               => 'section-sidebar',
				'category'           => 'section',
				'priority'           => 50,
				'title'              => __( 'Sidebar', CODEMANAS_THEME_DOMAIN ),
				'description_hidden' => true,
			)
		);

		$footer_sections = array(
			//Footer Widgets
			array(
				'name'               => 'section-footer-widgets',
				'category'           => 'section',
				'priority'           => 50,
				'title'              => __( 'Footer Widgets', CODEMANAS_THEME_DOMAIN ),
				'description_hidden' => true,
				'panel'              => 'panel-footer'
			),
			array(
				'name'               => 'section-footer-bar',
				'category'           => 'section',
				'priority'           => 55,
				'title'              => __( 'Last Footer Bar', CODEMANAS_THEME_DOMAIN ),
				'description_hidden' => true,
				'panel'              => 'panel-footer'
			)
		);

		return array_merge( $configs, $global_sections, $header_sections, $breadrumb_sections, $blog_sections, $sidebar_sections, $footer_sections );
	}
}

new Busify_Customizer_Register_Sections();