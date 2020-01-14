<?php
/**
 * Menu Render hook add action here
 *
 * @package busify
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

add_filter( 'busify_masthead_main_class', 'busify_header_menu_layouts' );
/**
 * Header Layout classes
 *
 * @param $data
 *
 * @return mixed
 */
function busify_header_menu_layouts( $data ) {
	
	$data[] = 'busify-left-logo';
	//Adding further Menus
	add_filter( 'wp_nav_menu_items', 'busify_after_menu_items_adds_last', 10, 2 );
	return $data;
}

/**
 * Add further menus after to main menu
 *
 * @param $items
 * @param $args
 *
 * @return string
 */
function busify_after_menu_items_adds_last( $items, $args ) {
	$header_last_item = Busify_Theme_Options::get_option( 'field-header-menu-last-item' );

	if ( $args->theme_location === "primary-menu" ) {
		$disable_search = Busify_Theme_Options::get_option( 'field-header-menu-disable-search' );
		if ( ! $disable_search ) {
			$items .= '<li id="menu-item-98989" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-98989 menu-item-search"><a href="#"><i class="fa fa-search"></i></a></li>';
			$items .= '<div id="busify-search-overlay" class="busify-search-overlay">
						  <div class="centered">
						    <div id="search-box">
						      <i id="busify-close-btn" class="fa fa-times fa-2x"></i>
						      <form role="search" action="' . esc_url( home_url( '/' ) ) . '" id="search-form" method="get" target="_top">
						        <input id="search-text" value="' . get_search_query() . '" name="s" placeholder="' . __( "Search Something...", 'busify' ) . '" type="text" />
						        <button id="search-button" type="submit"><span>' . __( "Search", 'busify' ) . '</span></button>
						      </form>
						    </div>
						  </div>
						</div>';
		}

		if ( ! empty( $header_last_item ) && $header_last_item === "button" ) {
			$btn_text = Busify_Theme_Options::get_option( 'field-header-menu-last-item-button-texxt' );
			$btn_link = Busify_Theme_Options::get_option( 'field-header-menu-last-item-btn-link' );
			if ( ! empty( $btn_link ) && ! empty( $btn_text ) ) {
				$items .= '<li id="menu-item-989899" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-989899"><a class="busify-theme-btn" title="' . esc_html( $btn_text ) . '" href="' . esc_url( $btn_link ) . '">' . esc_html( $btn_text ) . '</a></li>';
			}
		}

		if ( ! empty( $header_last_item ) && $header_last_item === "text/html" ) {
			$html  = Busify_Theme_Options::get_option( 'field-header-menu-last-item-btn-custom-text' );
			$items .= '<li id="menu-item-9898999" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9898999">' . wp_kses( $html ) . '</li>';
		}
	}

	return $items;
}

/**
 * Add further menus before to main menu
 *
 * @param $items
 * @param $args
 *
 * @return string
 */
function busify_after_menu_items_adds_before( $items, $args ) {
	$header_last_item = Busify_Theme_Options::get_option( 'field-header-menu-last-item' );

	if ( $args->theme_location === "primary-menu" ) {
		$disable_search = Busify_Theme_Options::get_option( 'field-header-menu-disable-search' );
		$new_items      = '';
		if ( ! $disable_search ) {
			$new_items .= '<li id="menu-item-98989" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-98989 menu-item-search"><a href="#"><i class="fa fa-search"></i></a></li>';
			$new_items .= '<div id="busify-search-overlay" class="busify-search-overlay">
						  <div class="centered">
						    <div id="search-box">
						      <i id="busify-close-btn" class="fa fa-times fa-2x"></i>
						      <form role="search" action="' . esc_url( home_url( '/' ) ) . '" id="search-form" method="get" target="_top">
						        <input id="search-text" value="' . get_search_query() . '" name="s" placeholder="' . __( "Search Something...", 'busify' ) . '" type="text" />
						        <button id="search-button" type="submit"><span>' . __( "Search", 'busify' ) . '</span></button>
						      </form>
						    </div>
						  </div>
						</div>';
		}

		if ( ! empty( $header_last_item ) && $header_last_item === "button" ) {
			$btn_text = Busify_Theme_Options::get_option( 'field-header-menu-last-item-button-texxt' );
			$btn_link = Busify_Theme_Options::get_option( 'field-header-menu-last-item-btn-link' );
			if ( ! empty( $btn_link ) && ! empty( $btn_text ) ) {
				$items .= '<li id="menu-item-989899" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-989899"><a class="busify-theme-btn" title="' . esc_html( $btn_text ) . '" href="' . esc_url( $btn_link ) . '">' . esc_html( $btn_text ) . '</a></li>';
			}
		}

		if ( ! empty( $header_last_item ) && $header_last_item === "text/html" ) {
			$html  = Busify_Theme_Options::get_option( 'field-header-menu-last-item-btn-custom-text' );
			$items .= '<li id="menu-item-9898999" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9898999">' . wp_kses( $html ) . '</li>';
		}

		$items = $new_items . $items;
	}

	return $items;
}