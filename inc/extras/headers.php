<?php
/**
 * Head Render hook add action here
 *
 * @package busify
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'busify_masthead_content', 'busify_masthead_logo', 10 );
add_action( 'busify_masthead_content', 'busify_masthead_nav', 20 );
function busify_masthead_logo() {
	$display_site_title   = get_bloginfo( 'name' );
	$display_site_tagline = get_bloginfo( 'description' );
	$custom_logo          = has_custom_logo();

	$site_title_enable   = Busify_Theme_Options::get_option( 'field-identity-display-site-title' );
	$site_tagline_enable = Busify_Theme_Options::get_option( 'field-identity-display-site-tagline' );
	?>
    <div class="site-branding">
		<?php
		//If we have a logo
		if ( $custom_logo ) {
			//Filter out the sizes first
			add_filter( 'wp_get_attachment_image_src', 'busify_header_logo_attr', 10, 4 );
			?>
            <div class="site-logo">
				<?php echo get_custom_logo(); ?>
            </div>
			<?php
			//UNhook to remove any errors that might be caused in other images
			remove_filter( 'wp_get_attachment_image_src', 'busify_header_logo_attr', 10 );
		}

		if ( ! empty( $site_title_enable ) ) {
			?>
            <h3 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $display_site_title; ?></a></h3>
			<?php
		}

		if ( ! empty( $site_tagline_enable ) ) { ?>
            <p class="site-tagline"><?php echo $display_site_tagline; ?></p>
		<?php } ?>
    </div>
	<?php
}

/**
 * Head navigation primary menu
 */
function busify_masthead_nav() {
	?>
    <div class="busify-mobile-menu-buttons">
        <div class="busify-button-wrap">
            <div class="navigation-toggler-icon"><span class="icon"></span></div>
        </div>
    </div>
    <nav id="site-navigation" class="main-navigation" role="navigation">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary-menu',
			'menu_id'        => 'primary-menu',
			'menu_class'     => 'primary-menu',
		) );
		?>
    </nav>
	<?php
}

/**
 * Customize Width According to settings from customizer.
 *
 * @param $image
 * @param $attachment_id
 * @param $size
 * @param $icon
 *
 * @return mixed
 */
function busify_header_logo_attr( $image, $attachment_id, $size, $icon ) {
	$logo_width = Busify_Theme_Options::get_option( 'field-identity-logo-width' );
	if ( ! empty( $logo_width ) ) {
		$image[1] = $logo_width;
		$image[2] = 0;
	}

	return $image;
}

/**
 * Check if transparent header and add class
 *
 * @param array $data
 *
 * @return mixed
 */
function busify_transparent_header( $data = array() ) {
	$transparent_header = Busify_Theme_Options::get_option( 'field-header-transparent' );
	$busify_options     = array(
		'field-header-transparent-blog-page'    => Busify_Theme_Options::get_option( 'field-header-transparent-blog-page' ),
		'field-header-transparent-singular'     => Busify_Theme_Options::get_option( 'field-header-transparent-singular' ),
		'field-header-transparent-single-page'  => Busify_Theme_Options::get_option( 'field-header-transparent-single-page' ),
		'field-header-transparent-single-post'  => Busify_Theme_Options::get_option( 'field-header-transparent-single-post' ),
		'field-header-transparent-archive-page' => Busify_Theme_Options::get_option( 'field-header-transparent-archive-page' ),
		'field-header-transparent-404'          => Busify_Theme_Options::get_option( 'field-header-transparent-404' ),
		'field-header-transparent-search-page'  => Busify_Theme_Options::get_option( 'field-header-transparent-search-page' ),
	);

	//Check if transparent headers setting is on.
	// $check = flag
	if ( ! empty( $transparent_header ) ) {
		$check = true;

		if ( is_front_page() ) {
			$check = true;
		} else if ( is_home() ) {
			//Disable on Blog Listing page
			if ( ! empty( $busify_options['field-header-transparent-blog-page'] ) ) {
				$check = false;
			}
		} else if ( ! empty( $busify_options['field-header-transparent-singular'] ) ) {
			//Override Setting on all single pages and posts
			if ( is_singular() ) {
				$check = false;
			}
		} else if ( is_page() ) {
			//Disable on Single pages
			if ( ! empty( $busify_options['field-header-transparent-single-page'] ) ) {
				$check = false;
			}
		} else if ( is_single() ) {
			//Disable on Single post
			if ( ! empty( $busify_options['field-header-transparent-single-post'] ) ) {
				$check = false;
			}
		} else if ( is_archive() ) {
			//Disable on Archives
			if ( ! empty( $busify_options['field-header-transparent-archive-page'] ) ) {
				$check = false;
			}
		} else if ( is_404() ) {
			//Disable on 404
			if ( ! empty( $busify_options['field-header-transparent-404'] ) ) {
				$check = false;
			}
		} else if ( is_search() ) {
			//Disable on Search
			if ( ! empty( $busify_options['field-header-transparent-search-page'] ) ) {
				$check = false;
			}
		}
	} else {
		$check = false;
	}

	if ( $check ) {
		$data[] = 'busify-header-transparent';
	} else {
		$data[] = 'busify-no-transparent';
	}

	$result = apply_filters( 'busify_masthead_main_class', $data );
	if ( ! empty( $result ) ) {
		return implode( " ", $result );
	} else {
		return false;
	}
}

add_action( 'busify_body_top', 'busify_preloader', 1 );
add_action( 'busify_body_top', 'busify_scrollToTop', 2 );
/*
 * Add Preloader
 */
function busify_preloader() {
	?>
    <div class="preloader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
	<?php
}

/*
 * Add Scroll to Top functionality
 */
function busify_scrollToTop() {
	$scroller = Busify_Theme_Options::get_option( 'field-footer-bar-enable-scrollup' );
	if ( ! empty( $scroller ) ) {
		?>
        <div class="busify-scrolltop">
            <div class="busify-scroll"><i class="fa fa-angle-up"></i></div>
        </div>
		<?php
	}
}

/**
 * Sub menu indicator add
 *
 * @param $item_output
 * @param $item
 * @param $depth
 * @param $args
 *
 * @return string
 */
function busify_add_submenu_indicator( $item_output, $item, $depth, $args ) {

	if ( $args->theme_location == 'primary-menu' ) {
		//var_dump($item);
		if ( in_array( 'menu-item-has-children', $item->classes ) ) {
			$item_output .= '<span class="sub-menu-toggle"><i class="fas fa-caret-down"></i></span>';
		}
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'busify_add_submenu_indicator', 10, 4 );

add_action( 'busify_top_banner_image', 'busify_pageshow_title_in_banner' );
/**
 * Show Page title banner in inner pages
 */
function busify_pageshow_title_in_banner() {
	$enable_title        = Busify_Theme_Options::get_option( 'field-banner-image-background-page-title' );
	$breadcrumb_position = Busify_Theme_Options::get_option( 'field-breadcrumb-type' );
	if ( ! empty( $enable_title ) ) {
		?>
        <h1 class="busify-image-banner-title"><?php single_post_title(); ?></h1>
		<?php
		if ( ! empty( $breadcrumb_position ) && $breadcrumb_position === "after-header" ) {
			Busify_Template_Functions::get_breadcrumbs( 'breadcrumb-after-header', 'after-header' );
		}
	}
}
