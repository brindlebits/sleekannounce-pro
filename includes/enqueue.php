<?php

# Enqueue JS and CSS assets on the front-end
add_action('wp_enqueue_scripts', 'sa_wp_enqueue_scripts');
function sa_wp_enqueue_scripts() {
	$functions_js_url  = SA_PLUGIN_URL . 'js/functions.js';
	$functions_js_path = SA_PLUGIN_DIR . 'js/functions.js';

	$styles_url  = SA_PLUGIN_URL . 'css/style.css';
	$styles_path = SA_PLUGIN_DIR . 'css/style.css';

	# Enqueue Custom JS files
	# @crb_enqueue_script attributes -- id, location, dependencies, in_footer = false
	wp_enqueue_script('sa-functions', $functions_js_url, array( 'jquery' ), filemtime( $functions_js_path ) );
	wp_localize_script('sa-functions', 'sa_options', array(
		'ajax_url' => admin_url('admin-ajax.php')
	));

	# Enqueue Custom CSS files
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	wp_enqueue_style('sa-styles', $styles_url, array(), filemtime( $styles_path ) );

}

add_action( 'admin_enqueue_scripts', 'sa_enqueue_files_admin' );

function sa_enqueue_files_admin() {
	$styles_url  = SA_PLUGIN_URL . 'css/utils/admin.css';
	$styles_path = SA_PLUGIN_DIR . 'css/utils/admin.css';

	$admin_js_url  = SA_PLUGIN_URL . 'js/admin/admin.js';
	$admin_js_path = SA_PLUGIN_DIR . 'js/admin/admin.js';

	$duplicate_js_dir = SA_PLUGIN_DIR . 'js/admin/modules/duplicate-banner.js';
	$update_status_js_dir = SA_PLUGIN_DIR . 'js/admin/modules/update-banner-status.js';

	$duplicate_js_url = SA_PLUGIN_URL . 'js/admin/modules/duplicate-banner.js';
	$update_status_js_url = SA_PLUGIN_URL . 'js/admin/modules/update-banner-status.js';

	wp_enqueue_script( 'sa-admin-js', $admin_js_url, [ 'jquery' ], filemtime( $admin_js_path ) );
	wp_enqueue_script( 'sa-admin-duplicate-banner-js', $duplicate_js_url, [ 'jquery', 'sa-admin-js' ], filemtime( $duplicate_js_dir ) );
	wp_enqueue_script( 'sa-admin-update-status-js', $update_status_js_url, [ 'jquery', 'sa-admin-js' ], filemtime( $update_status_js_dir ) );

	wp_localize_script( 'sa-admin-js', 'sa_options', array(
		'ajax_url' => admin_url('admin-ajax.php')
	));

	wp_enqueue_style( 'sa-admin-styles', $styles_url, array(), filemtime( $styles_path ) );
}