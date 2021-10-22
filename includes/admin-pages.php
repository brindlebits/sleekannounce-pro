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

add_action( 'admin_menu', 'sa_register_custom_submenu_popup_library', 16 );
function sa_register_custom_submenu_popup_library() {
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