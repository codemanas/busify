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
				'label'       => esc_html__( 'Width', CODEMANAS_THEME_DOMAIN ),
				'description' => esc_html__( 'Changing this will change width of content container.', CODEMANAS_THEME_DOMAIN ),
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
				'label'     => '<span class="customizer-busify-title wp-ui-text-highlight nomargin">' . esc_html__( 'Body Font', CODEMANAS_THEME_DOMAIN ) . '</span>',
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
				'label'    => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Site Logo Width & Site Titles', CODEMANAS_THEME_DOMAIN ) . '</span>',
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
				'label'    => esc_html__( 'Display Site Title', CODEMANAS_THEME_DOMAIN ),
				'section'  => 'title_tagline',
				'default'  => true,
			),
			array(
				'category' => 'field',
				'type'     => 'checkbox',
				'settings' => 'field-identity-display-site-tagline',
				'label'    => esc_html__( 'Display Site Tagline', CODEMANAS_THEME_DOMAIN ),
				'section'  => 'title_tagline',
				'default'  => true,
			),

			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-favicon',
				'section'  => 'title_tagline',
				'default'  => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Site Favicon', CODEMANAS_THEME_DOMAIN ) . '</span>',
			),

			//Sticky Header
			array(
				'category'    => 'field',
				'type'        => 'toggle',
				'settings'    => 'field-header-menu-sticky',
				'label'       => __( 'Enable Sticky Header ?', CODEMANAS_THEME_DOMAIN ),
				'description' => esc_html__( 'Enabling it will make the header stick to the top.', CODEMANAS_THEME_DOMAIN ),
				'section'     => 'section-header-sticky',
				'default'     => true,
			),
			array(
				'category'        => 'field',
				'type'            => 'toggle',
				'settings'        => 'field-header-menu-sticky-mobile-disable',
				'label'           => __( 'Disable on Mobile ?', CODEMANAS_THEME_DOMAIN ),
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
				'label'           => __( 'Sticky Background color', CODEMANAS_THEME_DOMAIN ),
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
				'default'         => '<span class="customizer-busify-title wp-ui-text-highlight nomargin">' . __( 'Menu Section', CODEMANAS_THEME_DOMAIN ) . '</span>',
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-menu-disable-search',
				'label'           => esc_html__( 'Disable Search', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-header-primary',
				'default'         => false,
			),
			array(
				'category'        => 'field',
				'type'            => 'select',
				'settings'        => 'field-header-menu-last-item',
				'transport'       => 'auto',
				'label'           => esc_html__( 'Last item in menu', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-header-primary',
				'default'         => 'none',
				'choices'         => $this->lastMenuItems(),
			),
			array(
				'category'        => 'field',
				'type'            => 'text',
				'settings'        => 'field-header-menu-last-item-button-texxt',
				'label'           => esc_html__( 'Button Text', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-header-primary',
				'default'         => 'Get a Quote',
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
				'label'           => esc_html__( 'Button Link', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-header-primary',
				'default'         => 'https://www.codemanas.com/',
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
				'label'           => __( 'Button Background Color', CODEMANAS_THEME_DOMAIN ),
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
				'label'           => __( 'Button Text Color', CODEMANAS_THEME_DOMAIN ),
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
				'label'           => __( 'Vertical Padding', CODEMANAS_THEME_DOMAIN ),
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
				'label'           => __( 'Horizontal Padding', CODEMANAS_THEME_DOMAIN ),
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
				'label'           => esc_html__( 'Border Width', CODEMANAS_THEME_DOMAIN ),
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
				'label'           => __( 'Button Border Color', CODEMANAS_THEME_DOMAIN ),
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
				'label'           => esc_html__( 'Custom Text/HTML', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-header-primary',
				'default'         => '<button>Register</button>',
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
				'label'       => esc_html__( 'Enable Banner', CODEMANAS_THEME_DOMAIN ),
				'section'     => 'section-header-banner-image',
				'description' => esc_html__( 'Shows a banner image below header for non elementor pages. If transparent header is used. Banner will be behind the header.', CODEMANAS_THEME_DOMAIN ),
				'default'     => true,
			),
			array(
				'category'        => 'field',
				'type'            => 'background',
				'settings'        => 'field-banner-image-background-control',
				'label'           => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Background & Overlay', CODEMANAS_THEME_DOMAIN ) . '</span>',
				'section'         => 'section-header-banner-image',
				'description'     => esc_html__( 'This is only applied in pages where elementor builder is not used !', CODEMANAS_THEME_DOMAIN ),
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
				'label'           => esc_html__( 'Background Overlay Color', CODEMANAS_THEME_DOMAIN ),
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

		$breadcrumb_fields = array(
			array(
				'category' => 'field',
				'type'     => 'select',
				'settings' => 'field-breadcrumb-type',
				'label'    => esc_html__( 'Position Selection', CODEMANAS_THEME_DOMAIN ),
				'section'  => 'section-breadcrumbs',
				'default'  => 'after-header',
				'priority' => 1,
				'multiple' => 1,
				'choices'  => [
					'none'          => esc_html__( 'Disable', CODEMANAS_THEME_DOMAIN ),
					'after-header'  => esc_html__( 'After Header', CODEMANAS_THEME_DOMAIN ),
					'inside-header' => esc_html__( 'Inside Header', CODEMANAS_THEME_DOMAIN ),
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'text',
				'settings'        => 'field-breadcrumb-seperator',
				'label'           => esc_html__( 'Seperator', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 2,
				'default'         => '»',
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-breadcrumb-background',
				'label'           => __( 'Breadcrumb Background color', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 3,
				'choices'         => [
					'alpha' => true,
				],
				'description'     => __( 'Only applicable when Header > Inner banner image is disabled.', CODEMANAS_THEME_DOMAIN ),
				'default'         => 'rgba(10,10,10,0)',
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.busify-breadcrumbs-container',
						'property' => 'background'
					]
				],
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '===',
						'value'    => 'after-header',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-breadcrumb-disable-homepage',
				'label'           => esc_html__( 'Disable on Homepage', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'default'         => true,
				'priority'        => 5,
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-breadcrumb-disable-blog',
				'label'           => esc_html__( 'Disable on Blog Listing Page', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 6,
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-breadcrumb-disable-single-page',
				'label'           => esc_html__( 'Disable on Single Page', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 7,
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-breadcrumb-disable-single-post',
				'label'           => esc_html__( 'Disable on Single Post', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 8,
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-breadcrumb-disable-single',
				'label'           => esc_html__( 'Disable on all single post/pages', CODEMANAS_THEME_DOMAIN ),
				'description'     => __( 'This will override single page or post options if enabled.', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 9,
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-breadcrumb-disable-search',
				'label'           => esc_html__( 'Disable on Search page', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 10,
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-breadcrumb-disable-archive',
				'label'           => esc_html__( 'Disable on Archive page', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 12,
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-breadcrumb-disable-404',
				'label'           => esc_html__( 'Disable on 404 page', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 13,
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'select',
				'settings'        => 'field-breadcrumb-alignment',
				'label'           => esc_html__( 'Alignment', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'default'         => 'center',
				'priority'        => 14,
				'multiple'        => 1,
				'choices'         => [
					'left'   => esc_html__( 'Left', CODEMANAS_THEME_DOMAIN ),
					'right'  => esc_html__( 'Right', CODEMANAS_THEME_DOMAIN ),
					'center' => esc_html__( 'Center', CODEMANAS_THEME_DOMAIN ),
				],
				'transport'       => 'auto',
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
				'output'          => [
					[
						'element'  => '.breadcrumbs',
						'property' => 'text-align',
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'custom',
				'settings'        => 'field-horizontal-line-container-5',
				'section'         => 'section-breadcrumbs',
				'default'         => '<span class="customizer-busify-title wp-ui-text-highlight nomargin">Typography</span>',
				'priority'        => 15,
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'typography',
				'settings'        => 'field-breadcrumb-typography',
				'section'         => 'section-breadcrumbs',
				'default'         => [
					'font-family'    => 'Ubuntu',
					'variant'        => '300',
					'font-size'      => '16px',
					'letter-spacing' => '0',
					'text-transform' => 'none',
				],
				'priority'        => 16,
				'transport'       => 'auto',
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
				'output'          => [
					[
						'element'  => '.breadcrumbs span',
						'property' => 'text-align',
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'custom',
				'settings'        => 'field-horizontal-line-container-6',
				'section'         => 'section-breadcrumbs',
				'default'         => '<span class="customizer-busify-title wp-ui-text-highlight nomargin">Colors</span>',
				'priority'        => 17,
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-breadcrumb-link-color',
				'label'           => esc_html__( 'Link Color', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 18,
				'default'         => $white_color,
				'choices'         => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.breadcrumbs span a',
						'property' => 'color',
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-breadcrumb-hover-color',
				'label'           => esc_html__( 'Link Hover Color', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 19,
				'default'         => $breadcrumb_hover,
				'choices'         => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.breadcrumbs span a:hover',
						'property' => 'color',
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-breadcrumb-text-color',
				'label'           => esc_html__( 'Text Color', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 21,
				'default'         => $white_color,
				'choices'         => [
					'alpha' => false,
				],
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.breadcrumbs > span',
						'property' => 'color',
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-breadcrumb-seperator-color',
				'label'           => esc_html__( 'Seperator Color', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-breadcrumbs',
				'priority'        => 22,
				'default'         => $white_color,
				'choices'         => [
					'alpha' => false,
				],
				'active_callback' => array(
					array(
						'setting'  => 'field-breadcrumb-type',
						'operator' => '!==',
						'value'    => 'none',
					)
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.breadcrumbs .seperator',
						'property' => 'color',
					]
				]
			),

		);

		$blog_fields = array(
			//Arhive page fields
			array(
				'category' => 'field',
				'type'     => 'sortable',
				'settings' => 'field-blog-page-layout',
				'label'    => esc_html__( 'Post Structure', CODEMANAS_THEME_DOMAIN ),
				'section'  => 'section-blog-archive',
				'default'  => [
					'image',
					'title',
					'meta',
					'content',
				],
				'choices'  => [
					'title'   => esc_html__( 'Title', CODEMANAS_THEME_DOMAIN ),
					'meta'    => esc_html__( 'Meta', CODEMANAS_THEME_DOMAIN ),
					'image'   => esc_html__( 'Featured Image', CODEMANAS_THEME_DOMAIN ),
					'content' => esc_html__( 'Content', CODEMANAS_THEME_DOMAIN ),
				],
			),

			//Pagination
			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-9',
				'section'  => 'section-blog-pagination',
				'default'  => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Pagination', CODEMANAS_THEME_DOMAIN ) . '</span>',
			),
			array(
				'category' => 'field',
				'type'     => 'radio-buttonset',
				'settings' => 'field-blog-post-pagination',
				'section'  => 'section-blog-pagination',
				'default'  => 'load-more',
				'choices'  => array(
					'numeric'          => esc_html__( 'Numeric Pagination', CODEMANAS_THEME_DOMAIN ),
					'load-more'        => esc_html__( 'Load More Button Pagination', CODEMANAS_THEME_DOMAIN ),
					'load-more-scroll' => esc_html__( 'Load More on Scroll', CODEMANAS_THEME_DOMAIN ),
					'legacy'           => esc_html__( 'Legacy Old/New', CODEMANAS_THEME_DOMAIN ),
				),
			),
			array(
				'category'  => 'field',
				'type'      => 'typography',
				'settings'  => 'field-blog-post-pagination-typo',
				'transport' => 'auto',
				'label'     => esc_html__( 'Typography', CODEMANAS_THEME_DOMAIN ),
				'section'   => 'section-blog-pagination',
				'default'   => array(
					'color'          => $black_color,
					'font-size'      => '16px',
					'letter-spacing' => '0px',
					'text-transform' => 'none',
					'font-family'    => 'Ubuntu',
					'variant'        => '300',
				),
				'output'    => [
					[
						'element' => '.busify-pagination .nav-links a, .busify-pagination .nav-links span, .busify-pagination a'
					]
				]
			),
			array(
				'category' => 'field',
				'type'     => 'radio-buttonset',
				'settings' => 'field-pagination-alignment',
				'label'    => esc_html__( 'Pagination Alignment', CODEMANAS_THEME_DOMAIN ),
				'section'  => 'section-blog-pagination',
				'default'  => 'center-align-pagination',
				'choices'  => [
					'left-align-pagination'   => esc_html__( 'Left', CODEMANAS_THEME_DOMAIN ),
					'center-align-pagination' => esc_html__( 'Center', CODEMANAS_THEME_DOMAIN ),
					'right-align-pagination'  => esc_html__( 'Right', CODEMANAS_THEME_DOMAIN ),
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'color',
				'settings'    => 'field-pagination-background-color',
				'label'       => esc_html__( 'Background Color', CODEMANAS_THEME_DOMAIN ),
				'section'     => 'section-blog-pagination',
				'default'     => $white_color,
				'transport'   => 'auto',
				'description' => esc_html__( 'This is only applied on numeric pagination.', CODEMANAS_THEME_DOMAIN ),
				'output'      => [
					[
						'element'  => '.busify-pagination .page-numbers',
						'property' => 'background-color'
					]
				]
			),
			array(
				'category'  => 'field',
				'type'      => 'color',
				'settings'  => 'field-pagination-hover-color',
				'label'     => esc_html__( 'Hover Color', CODEMANAS_THEME_DOMAIN ),
				'section'   => 'section-blog-pagination',
				'default'   => $hover_color,
				'transport' => 'auto',
				'output'    => [
					[
						'element'  => '.busify-pagination a:hover, .busify-pagination span:hover',
						'property' => 'color'
					]
				]
			),
			array(
				'category'    => 'field',
				'type'        => 'color',
				'settings'    => 'field-pagination-active-link-color',
				'label'       => esc_html__( 'Active Pagination Link', CODEMANAS_THEME_DOMAIN ),
				'section'     => 'section-blog-pagination',
				'description' => esc_html__( 'This is only applied on numeric pagination.', CODEMANAS_THEME_DOMAIN ),
				'default'     => $primary_color,
				'transport'   => 'auto',
				'output'      => [
					[
						'element'  => '.busify-pagination .page-numbers.current',
						'property' => 'background-color'
					]
				]
			),

			//Single Post
			array(
				'category' => 'field',
				'type'     => 'sortable',
				'settings' => 'field-single-post-structure',
				'label'    => esc_html__( 'Structure', CODEMANAS_THEME_DOMAIN ),
				'section'  => 'section-single-post',
				'default'  => [
					'image',
					'title',
					'meta',
					'content',
				],
				'choices'  => [
					'image'   => esc_html__( 'Featured Image', CODEMANAS_THEME_DOMAIN ),
					'title'   => esc_html__( 'Title', CODEMANAS_THEME_DOMAIN ),
					'meta'    => esc_html__( 'Meta Fields', CODEMANAS_THEME_DOMAIN ),
					'content' => esc_html__( 'Content', CODEMANAS_THEME_DOMAIN ),
				],
				'priority' => 1,
			),
		);

		$sidebar_fields = array(
			array(
				'category'  => 'field',
				'type'      => 'select',
				'settings'  => 'field-sidebar-type',
				'label'     => esc_html__( 'Default Sidebar', CODEMANAS_THEME_DOMAIN ),
				'section'   => 'section-sidebar',
				'default'   => 'right',
				'transport' => 'refresh',
				'priority'  => 1,
				'multiple'  => 1,
				'choices'   => [
					'none'  => esc_html__( 'No Sidebar', CODEMANAS_THEME_DOMAIN ),
					'left'  => esc_html__( 'Left Sidebar', CODEMANAS_THEME_DOMAIN ),
					'right' => esc_html__( 'Right Sidebar', CODEMANAS_THEME_DOMAIN ),
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
			array(
				'category'        => 'field',
				'type'            => 'select',
				'settings'        => 'field-sidebar-post',
				'label'           => esc_html__( 'Posts Sidebar', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-sidebar',
				'default'         => 'default',
				'priority'        => 3,
				'multiple'        => 1,
				'transport'       => 'refresh',
				'choices'         => [
					'default' => esc_html__( 'Default', CODEMANAS_THEME_DOMAIN ),
					'none'    => esc_html__( 'No Sidebar', CODEMANAS_THEME_DOMAIN ),
					'left'    => esc_html__( 'Left Sidebar', CODEMANAS_THEME_DOMAIN ),
					'right'   => esc_html__( 'Right Sidebar', CODEMANAS_THEME_DOMAIN ),
				],
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'select',
				'settings'        => 'field-sidebar-page',
				'label'           => esc_html__( 'Pages Sidebar', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-sidebar',
				'default'         => 'none',
				'priority'        => 4,
				'multiple'        => 1,
				'transport'       => 'refresh',
				'choices'         => [
					'default' => esc_html__( 'Default', CODEMANAS_THEME_DOMAIN ),
					'none'    => esc_html__( 'No Sidebar', CODEMANAS_THEME_DOMAIN ),
					'left'    => esc_html__( 'Left Sidebar', CODEMANAS_THEME_DOMAIN ),
					'right'   => esc_html__( 'Right Sidebar', CODEMANAS_THEME_DOMAIN ),
				],
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'select',
				'settings'        => 'field-sidebar-archive',
				'label'           => esc_html__( 'Archive or Search Sidebar', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-sidebar',
				'default'         => 'default',
				'priority'        => 4,
				'multiple'        => 1,
				'transport'       => 'refresh',
				'choices'         => [
					'default' => esc_html__( 'Default', CODEMANAS_THEME_DOMAIN ),
					'none'    => esc_html__( 'No Sidebar', CODEMANAS_THEME_DOMAIN ),
					'left'    => esc_html__( 'Left Sidebar', CODEMANAS_THEME_DOMAIN ),
					'right'   => esc_html__( 'Right Sidebar', CODEMANAS_THEME_DOMAIN ),
				],
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-sidebar-heading-color',
				'label'           => esc_html__( 'Sidebar Heading Color', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-sidebar',
				'default'         => $black_color,
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.busify-sidebar h2.widget-title',
						'property' => 'color'
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-sidebar-text-color',
				'label'           => esc_html__( 'Sidebar Text Color', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-sidebar',
				'default'         => $black_color,
				'active_callback' => [
					[
						'setting'  => 'field-sidebar-type',
						'operator' => '!==',
						'value'    => 'none',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '.busify-sidebar a, .busify-sidebar p, .busify-sidebar span',
						'property' => 'color'
					]
				]
			),
		);

		$footer_fields = array(
			array(
				'category' => 'field',
				'type'     => 'radio-image',
				'settings' => 'field-footer-widget-layout',
				'label'    => esc_html__( 'Widget Layout Columns', CODEMANAS_THEME_DOMAIN ),
				'section'  => 'section-footer-widgets',
				'default'  => 'wd-four',
				'choices'  => array(
					'no-widget' => get_theme_file_uri( '/assets/images/no-widget.svg' ),
					'wd-four'   => get_theme_file_uri( '/assets/images/widget-4.svg' ),
					'wd-three'  => get_theme_file_uri( '/assets/images/widget-3.svg' ),
					'wd-two'    => get_theme_file_uri( '/assets/images/widget-2.svg' ),
					'wd-one'    => get_theme_file_uri( '/assets/images/widget-1.svg' ),
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'slider',
				'settings'        => 'field-footer-widget-border-top',
				'label'           => esc_html__( 'Footer Top Border Width', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-footer-widgets',
				'default'         => 0,
				'choices'         => [
					'min'  => 0,
					'max'  => 40,
					'step' => 1,
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'       => 'footer.site-main-footer',
						'property'      => 'border-top',
						'value_pattern' => '$px solid'
					]
				],
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-widget-border-top-color',
				'label'           => __( 'Footer Top border Color', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-footer-widgets',
				'default'         => $border_color,
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => 'footer.site-main-footer',
						'property' => 'border-color'
					]
				]
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-widget-background-color',
				'label'           => __( 'Background Color', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-footer-widgets',
				'default'         => $white_color,
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => 'footer.site-main-footer',
						'property' => 'background',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'typography',
				'settings'        => 'field-footer-widget-typography-headings',
				'label'           => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Heading Typography', CODEMANAS_THEME_DOMAIN ) . '</span>',
				'section'         => 'section-footer-widgets',
				'default'         => [
					'font-family'    => 'Ubuntu',
					'variant'        => '300',
					'font-size'      => '24px',
					'letter-spacing' => '0',
					'color'          => $black_color,
					'text-transform' => 'none',
					'text-align'     => 'left',
				],
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element' => 'footer.site-main-footer .widget-section-wrap h1, footer.site-main-footer .widget-section-wrap h2, footer.site-main-footer .widget-section-wrap h3, footer.site-main-footer .widget-section-wrap h4, footer.site-main-footer .widget-section-wrap h5, footer.site-main-footer .widget-section-wrap h6'
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'typography',
				'settings'        => 'field-footer-widget-typography-content',
				'label'           => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Content Typography', CODEMANAS_THEME_DOMAIN ) . '</span>',
				'section'         => 'section-footer-widgets',
				'default'         => [
					'font-family'    => 'Ubuntu',
					'variant'        => '300',
					'font-size'      => '16px',
					'line-height'    => '1.5',
					'letter-spacing' => '0',
					'color'          => $black_color,
					'text-transform' => 'none',
					'text-align'     => 'left',
				],
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element' => 'footer.site-main-footer .widget-section-wrap p, footer.site-main-footer .widget-section-wrap span, footer.site-main-footer .widget-section-wrap div'
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'typography',
				'settings'        => 'field-footer-widget-typography-links',
				'label'           => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Link Typography', CODEMANAS_THEME_DOMAIN ) . '</span>',
				'section'         => 'section-footer-widgets',
				'default'         => [
					'font-family'    => 'Ubuntu',
					'variant'        => '300',
					'font-size'      => '16px',
					'letter-spacing' => '0',
					'color'          => $black_color,
					'text-transform' => 'none',
				],
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element' => 'footer.site-main-footer .widget-section-wrap a'
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-widget-typography-link-hover-color',
				'label'           => __( 'Link Hover Color', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-footer-widgets',
				'default'         => $primary_color,
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => 'footer.site-main-footer .widget-section-wrap a:hover',
						'property' => 'color'
					]
				],
			),

			//Footer Bar
			array(
				'category'    => 'field',
				'type'        => 'toggle',
				'settings'    => 'field-footer-bar-enable',
				'label'       => esc_html__( 'Enable Bottom Footer Bar', CODEMANAS_THEME_DOMAIN ),
				'description' => esc_html__( 'This option toggles the footer bar.', CODEMANAS_THEME_DOMAIN ),
				'section'     => 'section-footer-bar',
				'default'     => 1,
			),
			array(
				'category'        => 'field',
				'type'            => 'textarea',
				'settings'        => 'field-footer-bar-copyright',
				'label'           => esc_html__( 'Footer content', CODEMANAS_THEME_DOMAIN ),
				'description'     => esc_html__( 'HTML allowed', CODEMANAS_THEME_DOMAIN ),
				'section'         => 'section-footer-bar',
				'default'         => '<p>Copyright © ' . date( 'Y' ) . ' CodeManas. All rights reserved.</p><p>Powered by <strong>WordPress</strong></p>',
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
				'label'           => esc_html__( 'Background Color', CODEMANAS_THEME_DOMAIN ),
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
				'label'           => esc_html__( 'Enable scroll up', CODEMANAS_THEME_DOMAIN ),
				'description'     => esc_html__( 'This option toggles the "Scroll to top" arrow.', CODEMANAS_THEME_DOMAIN ),
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
				'label'           => esc_html__( 'Scroll up color', CODEMANAS_THEME_DOMAIN ),
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
				'default'         => '<span class="customizer-busify-title wp-ui-text-highlight">' . __( 'Colors & Typography', CODEMANAS_THEME_DOMAIN ) . '</span>',
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
			),

			// Add footer copyright typography option
			array(
				'category'        => 'field',
				'type'            => 'typography',
				'settings'        => 'field-footer-bar-copyright-text-typo',
				'transport'       => 'auto',
				'section'         => 'section-footer-bar',
				'default'         => array(
					'color'          => $black_color,
					'font-size'      => '16px',
					'line-height'    => '1.5',
					'letter-spacing' => '0px',
					'text-transform' => 'none',
					'variant'        => '300',
					'text-align'     => 'left'
				),
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
				'output'          => [
					[
						'element' => '.busify-super-footer p, .busify-super-footer span',
					]
				]
			),
		);

		return array_merge( $configs, $global_fields, $this->heading_typography(), $header_fields, $breadcrumb_fields, $blog_fields, $sidebar_fields, $footer_fields );
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
				'label'     => '<span class="customizer-busify-title wp-ui-text-highlight">Heading Font: ' . $h . '</span>',
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
			'none'      => __( 'None', CODEMANAS_THEME_DOMAIN ),
			'button'    => __( 'Button', CODEMANAS_THEME_DOMAIN ),
			'text/html' => __( 'Text/HTML', CODEMANAS_THEME_DOMAIN )
		);

		$items = apply_filters( 'busify_customer_last_item_menus', $items );

		return $items;
	}
}

new Busify_Customizer_Register_Fields();