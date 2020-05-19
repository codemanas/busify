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

class Busify_Customizer_Register_Fields extends Busify_Customizer_Conifg_Base {

	public function register_configuration( $configs ) {
		$primary_color    = '#254099';
		$black_color      = '#000000';
		$white_color      = '#ffffff';
		$hover_color      = '#0085ba';
		$border_color     = '#d6d6d6';
		$breadcrumb_hover = '#85bdef';

		$global_fields = array(
			//Container Section
			array(
				'category'    => 'field',
				'type'        => 'slider',
				'settings'    => 'field-global-container-width',
				'label'       => esc_html__( 'Width', 'busify' ),
				'description' => esc_html__( 'Changing this will change width of content container.', 'busify' ),
				'section'     => 'section-global-container-layout',
				'default'     => 1140,
				'transport' => 'auto',
				'priority'    => 1,
				'choices'     => [
					'min'  => 600,
					'max'  => 1920,
					'step' => 1,
				],
				'output'      => [
					[
						'element'       => '.container',
						'property'      => 'max-width',
						'units' => 'px',
					],
				],
			),
			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-1',
				'section'  => 'section-global-container-layout',
				'default'  => '<hr>',
				'priority' => 2,
			),

			//Typography
			array(
				'category'  => 'field',
				'type'      => 'typography',
				'settings'  => 'field-global-typography-body',
				'transport' => 'auto',
				'label'     => '<span class="customizer-busify-title wp-ui-text-highlight nomargin">' . esc_html__( 'Body Font', 'busify' ) . '</span>',
				'section'   => 'section-global-typography',
				'default'   => array(
					'font-size'      => '16px',
					'line-height'    => '1.8',
					'letter-spacing' => '0px',
					'text-transform' => 'none',
					'font-family'    => 'Ubuntu',
					'variant'        => '300',
				),
				'output'    => [
					[
						'element' => 'body, button, input, select, textarea',
					]
				],
			),
		);

		$header_fields = array(
			//Site Identity
			array(
				'category' => 'field',
				'type'     => 'slider',
				'settings' => 'field-identity-logo-width',
				'label'    => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Site Logo Width & Site Titles', 'busify' ) . '</span>',
				'section'  => 'title_tagline',
				'default'  => 140,
				'choices'  => [
					'min'  => 1,
					'max'  => 600,
					'step' => 1,
				],
			),
			array(
				'category' => 'field',
				'type'     => 'checkbox',
				'settings' => 'field-identity-display-site-title',
				'label'    => esc_html__( 'Display Site Title', 'busify' ),
				'section'  => 'title_tagline',
				'default'  => true,
			),
			array(
				'category' => 'field',
				'type'     => 'checkbox',
				'settings' => 'field-identity-display-site-tagline',
				'label'    => esc_html__( 'Display Site Tagline', 'busify' ),
				'section'  => 'title_tagline',
				'default'  => true,
			),

			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-favicon',
				'section'  => 'title_tagline',
				'default'  => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Site Favicon', 'busify' ) . '</span>',
			),

			//Sticky Header
			array(
				'category'    => 'field',
				'type'        => 'toggle',
				'settings'    => 'field-header-menu-sticky',
				'label'       => __( 'Enable Sticky Header ?', 'busify' ),
				'description' => esc_html__( 'Enabling it will make the header stick to the top.', 'busify' ),
				'section'     => 'section-header-sticky',
				'default'     => true,
			),
			array(
				'category'        => 'field',
				'type'            => 'toggle',
				'settings'        => 'field-header-menu-sticky-mobile-disable',
				'label'           => __( 'Disable on Mobile ?', 'busify' ),
				'section'         => 'section-header-sticky',
				'default'         => true,
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-sticky',
						'operator' => '===',
						'value'    => true,
					),
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-header-menu-sticky-background',
				'label'           => __( 'Sticky Background color', 'busify' ),
				'section'         => 'section-header-sticky',
				'default'         => 'rgba(10,10,10,0.75)',
				'choices'         => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-sticky',
						'operator' => '===',
						'value'    => true,
					),
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => 'header.sticky-header',
						'property' => 'background'
					]
				]
			),

			array(
				'category'        => 'field',
				'type'            => 'custom',
				'settings'        => 'field-horizontal-line-container-3',
				'section'         => 'section-header-primary',
				'default'         => '<span class="customizer-busify-title wp-ui-text-highlight nomargin">' . __( 'Menu Section', 'busify' ) . '</span>',
			),
			array(
				'category'        => 'field',
				'type'            => 'select',
				'settings'        => 'field-header-menu-last-item',
				'transport'       => 'auto',
				'label'           => esc_html__( 'Last item in menu', 'busify' ),
				'section'         => 'section-header-primary',
				'default'         => 'none',
				'choices'         => $this->lastMenuItems(),
			),
			array(
				'category'        => 'field',
				'type'            => 'text',
				'settings'        => 'field-header-menu-last-item-button-texxt',
				'label'           => esc_html__( 'Button Text', 'busify' ),
				'section'         => 'section-header-primary',
				'default'         => esc_html( 'Get a Quote', 'busify' ),
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'link',
				'settings'        => 'field-header-menu-last-item-btn-link',
				'label'           => esc_html__( 'Button Link', 'busify' ),
				'section'         => 'section-header-primary',
				'default'         => esc_url( 'https://www.codemanas.com/' ),
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-header-menu-last-item-btn-color',
				'label'           => __( 'Button Background Color', 'busify' ),
				'section'         => 'section-header-primary',
				'default'         => $primary_color,
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.busify-theme-btn',
						'property' => 'background'
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-header-menu-last-item-btn-text-color',
				'label'           => __( 'Button Text Color', 'busify' ),
				'section'         => 'section-header-primary',
				'default'         => $white_color,
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.busify-theme-btn',
						'property' => 'color',
						'suffix'   => '!important'
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'slider',
				'settings'        => 'field-header-menu-last-item-btn-vertical',
				'label'           => __( 'Vertical Padding', 'busify' ),
				'section'         => 'section-header-primary',
				'default'         => 10,
				'choices'         => [
					'min'  => 1,
					'max'  => 40,
					'step' => 1,
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'       => '.busify-theme-btn',
						'property'      => 'padding-top',
						'value_pattern' => '$px',
					],
					[
						'element'       => '.busify-theme-btn',
						'property'      => 'padding-bottom',
						'value_pattern' => '$px',
					],
				],
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				)
			),
			array(
				'category'        => 'field',
				'type'            => 'slider',
				'settings'        => 'field-header-menu-last-item-btn-horizontal',
				'label'           => __( 'Horizontal Padding', 'busify' ),
				'section'         => 'section-header-primary',
				'default'         => 20,
				'choices'         => [
					'min'  => 1,
					'max'  => 40,
					'step' => 1,
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'       => '.busify-theme-btn',
						'property'      => 'padding-left',
						'value_pattern' => '$px',
					],
					[
						'element'       => '.busify-theme-btn',
						'property'      => 'padding-right',
						'value_pattern' => '$px',
					],
				],
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				)
			),
			array(
				'category'        => 'field',
				'type'            => 'slider',
				'settings'        => 'field-header-menu-last-item-btn-border',
				'label'           => esc_html__( 'Border Width', 'busify' ),
				'section'         => 'section-header-primary',
				'default'         => 0,
				'choices'         => [
					'min'  => 0,
					'max'  => 40,
					'step' => 1,
				],
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'       => '.busify-theme-btn',
						'property'      => 'border',
						'value_pattern' => '$px solid'
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-header-menu-last-item-btn-border-color',
				'label'           => __( 'Button Border Color', 'busify' ),
				'section'         => 'section-header-primary',
				'default'         => $black_color,
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'button',
					),
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.busify-theme-btn',
						'property' => 'border-color',
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'textarea',
				'settings'        => 'field-header-menu-last-item-btn-custom-text',
				'label'           => esc_html__( 'Custom Text/HTML', 'busify' ),
				'section'         => 'section-header-primary',
				'default'         => '<button>' . __( 'Register', 'busify' ) . '</button>',
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-last-item',
						'operator' => '===',
						'value'    => 'text/html',
					),
				),
			),
		
			//Banner Image
			array(
				'category'    => 'field',
				'type'        => 'toggle',
				'settings'    => 'field-banner-image-background-enable',
				'label'       => esc_html__( 'Enable Banner', 'busify' ),
				'section'     => 'section-header-banner-image',
				'description' => esc_html__( 'Shows a banner image below header for non elementor pages. If transparent header is used. Banner will be behind the header.', 'busify' ),
				'default'     => true,
			),
			array(
				'category'        => 'field',
				'type'            => 'background',
				'settings'        => 'field-banner-image-background-control',
				'label'           => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Background & Overlay', 'busify' ) . '</span>',
				'section'         => 'section-header-banner-image',
				'description'     => esc_html__( 'This is only applied in pages where elementor builder is not used !', 'busify' ),
				'default'         => [
					'background-color'      => $primary_color,
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				],
				'active_callback' => [
					[
						'setting'  => 'field-banner-image-background-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element' => '.busify-image-banner-container',
					],
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-banner-image-background-overlay',
				'label'           => esc_html__( 'Background Overlay Color', 'busify' ),
				'default'         => 'rgba(0,0,0,0.7)',
				'choices'         => [
					'alpha' => true,
				],
				'section'         => 'section-header-banner-image',
				'active_callback' => [
					[
						'setting'  => 'field-banner-image-background-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.busify-image-banner-overlay',
						'property' => 'background-color'
					],
				],
			),
		);

		$blog_fields = array(
			//Arhive page fields
			array(
				'category' => 'field',
				'type'     => 'sortable',
				'settings' => 'field-blog-page-layout',
				'label'    => esc_html__( 'Post Structure', 'busify' ),
				'section'  => 'section-blog-archive',
				'default'  => [
					'image',
					'title',
					'meta',
					'content',
				],
				'choices'  => [
					'title'   => esc_html__( 'Title', 'busify' ),
					'meta'    => esc_html__( 'Meta', 'busify' ),
					'image'   => esc_html__( 'Featured Image', 'busify' ),
					'content' => esc_html__( 'Content', 'busify' ),
				],
			),

			//Pagination
			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-9',
				'section'  => 'section-blog-pagination',
				'default'  => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Pagination', 'busify' ) . '</span>',
			),
			array(
				'category' => 'field',
				'type'     => 'radio-buttonset',
				'settings' => 'field-blog-post-pagination',
				'section'  => 'section-blog-pagination',
				'default'  => 'load-more',
				'choices'  => array(
					'load-more'        => esc_html__( 'Load More Button Pagination', 'busify' ),
					'legacy'           => esc_html__( 'Legacy Old/New', 'busify' ),
				),
			),

			//Single Post
			array(
				'category' => 'field',
				'type'     => 'sortable',
				'settings' => 'field-single-post-structure',
				'label'    => esc_html__( 'Structure', 'busify' ),
				'section'  => 'section-single-post',
				'default'  => [
					'image',
					'title',
					'meta',
					'content',
				],
				'choices'  => [
					'image'   => esc_html__( 'Featured Image', 'busify' ),
					'title'   => esc_html__( 'Title', 'busify' ),
					'meta'    => esc_html__( 'Meta Fields', 'busify' ),
					'content' => esc_html__( 'Content', 'busify' ),
				],
				'priority' => 1,
			),
		);

		$sidebar_fields = array(
			array(
				'category'  => 'field',
				'type'      => 'select',
				'settings'  => 'field-sidebar-type',
				'label'     => esc_html__( 'Default Sidebar', 'busify' ),
				'section'   => 'section-sidebar',
				'default'   => 'right',
				'transport' => 'refresh',
				'priority'  => 1,
				'multiple'  => 1,
				'choices'   => [
					'none'  => esc_html__( 'No Sidebar', 'busify' ),
					'left'  => esc_html__( 'Left Sidebar', 'busify' ),
					'right' => esc_html__( 'Right Sidebar', 'busify' ),
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'custom',
				'settings'        => 'field-horizontal-line-container-7',
				'section'         => 'section-sidebar',
				'default'         => '<hr>',
				'priority'        => 2,
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
			),
		);

		$footer_fields = array(
			//Footer Bar
			array(
				'category'    => 'field',
				'type'        => 'toggle',
				'settings'    => 'field-footer-bar-enable',
				'label'       => esc_html__( 'Enable Bottom Footer Bar', 'busify' ),
				'description' => esc_html__( 'This option toggles the footer bar.', 'busify' ),
				'section'     => 'section-footer-bar',
				'default'     => 1,
			),
			array(
				'category'        => 'field',
				'type'            => 'textarea',
				'settings'        => 'field-footer-bar-copyright',
				'label'           => esc_html__( 'Footer content', 'busify' ),
				'description'     => esc_html__( 'HTML allowed', 'busify' ),
				'section'         => 'section-footer-bar',
				'default'         => '<p>' . __( 'Copyright &#169; ', 'busify' ) . date( 'Y' ) . __( '. All rights reserved.</p><p>Powered by <strong>WordPress</strong></p>', 'busify' ),
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
			),
			// Add footer background option
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-bar-background-color',
				'label'           => esc_html__( 'Background Color', 'busify' ),
				'section'         => 'section-footer-bar',
				'default'         => $white_color,
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.busify-super-footer',
						'property' => 'background'
					]
				]
			),

			// Add scroll up enable option
			array(
				'category'        => 'field',
				'type'            => 'toggle',
				'settings'        => 'field-footer-bar-enable-scrollup',
				'label'           => esc_html__( 'Enable scroll up', 'busify' ),
				'description'     => esc_html__( 'This option toggles the "Scroll to top" arrow.', 'busify' ),
				'section'         => 'section-footer-bar',
				'default'         => true,
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
			),
			// Add scroll up color option
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-bar-enable-scrollup-color',
				'transport'       => 'auto',
				'label'           => esc_html__( 'Scroll up color', 'busify' ),
				'section'         => 'section-footer-bar',
				'default'         => $black_color,
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable-scrollup',
						'operator' => '===',
						'value'    => true,
					],
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
				'output'          => [
					[
						'element'  => '.busify-scroll',
						'property' => 'background'
					]
				]
			),


			array(
				'category'        => 'field',
				'type'            => 'custom',
				'settings'        => 'field-horizontal-line-container-15',
				'section'         => 'section-footer-bar',
				'default'         => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Colors & Typography', 'busify' ) . '</span>',
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
			),
		);

		return array_merge( $configs, $global_fields, $this->heading_typography(), $header_fields, $blog_fields, $sidebar_fields, $footer_fields );
	}

	/**
	 * Creating typography options array instead of repeating
	 */
	private function heading_typography() {
		$font_sizes = array( 'h1' => '40px', 'h2' => '32px', 'h3' => '28px', 'h4' => '24px', 'h5' => '20px', 'h6' => '16px' );
		$headings   = array();
		foreach ( $font_sizes as $h => $size ) {
			$headings[] = array(
				'category'  => 'field',
				'type'      => 'typography',
				'settings'  => 'field-global-typography-headings-' . $h . '-typo',
				'transport' => 'auto',
				'label'     => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Heading Font: ', 'busify' ) . $h . '</span>',
				'section'   => 'section-global-typography',
				'default'   => array(
					'font-size'      => $size,
					'line-height'    => '1.6',
					'letter-spacing' => '0',
					'text-transform' => 'none',
					'font-family'    => 'Ubuntu',
					'variant'        => '300',
					'color'          => '#000000',
				),
				'output'    => [
					[
						'element' => $h . ', .entry-content ' . $h . ', .entry-content ' . $h . ' a, .entry-header ' . $h . ', .entry-header ' . $h . ' a',
					]
				]
			);
		}

		return $headings;
	}

	/**
	 * For Adding last item menus
	 *
	 * @return array|mixed
	 */
	public function lastMenuItems() {
		$items = array(
			'none'      => __( 'None', 'busify' ),
			'button'    => __( 'Button', 'busify' ),
			'text/html' => __( 'Text/HTML', 'busify' )
		);

		$items = apply_filters( 'busify_customer_last_item_menus', $items );

		return $items;
	}
}

new Busify_Customizer_Register_Fields();