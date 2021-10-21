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
			plugin_dir_url( __FILE__ ) . 'images/menu-icon.png',
			75
		);
	}

	add_action( 'admin_menu', 'mb_register_menu_page_brindle' );
}