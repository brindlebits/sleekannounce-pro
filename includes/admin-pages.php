<?php

/**
 * Register My Brindle Tab.
 */
if ( ! function_exists( 'mb_register_menu_page_brindle' ) ) {
	function mb_register_menu_page_brindle() {
		$capabilities = 'manage_options';

		$user = wp_get_current_user();

		if ( in_array( 'mbbb_staff_member', $user->roles ) ) {
			$capabilities = 'read';
		}

		add_menu_page(
			'My Brindle',
			'My Brindle',
			$capabilities,
			'my-brindle.php',
			'',
			SA_PLUGIN_URL . 'images/menu-icon.png',
			75
		);
	}

	add_action( 'admin_menu', 'mb_register_menu_page_brindle' );
}

add_action( 'admin_menu', 'mbsa_register_custom_submenu_page', 16 );
function mbsa_register_custom_submenu_page() {
	$query = new WP_Query( array(
		'post_type' => 'sa_banner',
	) );

	$url        = 'sa-banners-library.php';
	$callback = function() {
		include_once SA_PLUGIN_DIR . 'templates/banners-listing.php';
	};

	add_submenu_page(
		'my-brindle.php',
		'SleekAnnounce',
		'SleekAnnounce',
		'manage_options',
		$url,
		$callback,
		3
	);
}

add_action( 'admin_menu', 'mbsa_register_custom_submenu_banner_library', 15 );
function mbsa_register_custom_submenu_banner_library() {
	$query = new WP_Query( array(
		'post_type' => 'sa_banner',
	) );

	$url        = 'sa-banners-library.php';

	$callback = function() {
		include_once SA_PLUGIN_DIR . 'templates/banners-listing.php';
	};

	add_submenu_page(
		'my-brindle.php',
		'Banners Library',
		'Banners Library',
		'manage_options',
		$url,
		$callback,
		3
	);
}

/**
 * Fix Parent Admin Menu Item
 */
add_filter( 'parent_file', 'mbsa_cpt_parent_file_fix' );
function mbsa_cpt_parent_file_fix( $parent_file ){

	/* Get current screen */
	global $current_screen, $self;

	/**
	 * Add upload.php as parent file/menu if
	 * it's Post Type list Screen or Edit screen of our post type.
	 */
	if ( in_array( $current_screen->base, array( 'post', 'edit' ) ) && in_array( $current_screen->post_type, array( 'sa_banner' ) ) ) {
		$parent_file = 'my-brindle.php';
	}

	return $parent_file;
}

/**
 * Fix Sub Menu Item Highlights
 */
add_filter( 'submenu_file', 'mbsa_submenu_file_fix' );
function mbsa_submenu_file_fix( $submenu_file ){

    /* Get current screen */
    global $current_screen, $self;

    if ( in_array( $current_screen->base, array( 'post', 'edit' ) ) ) {
        if ( $current_screen->post_type == 'sa_banner' ) {
	        $submenu_file = 'sa-banners-library.php';
        }
	}

    return $submenu_file;
}