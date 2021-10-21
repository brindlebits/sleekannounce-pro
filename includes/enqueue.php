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

add_action( 'admin_enqueue_scripts', 'crb_enqueue_files_admin' );

function crb_enqueue_files_admin() {
	$styles_url  = SA_PLUGIN_URL . 'css/utils/admin.css';
	$styles_path = SA_PLUGIN_DIR . 'css/utils/admin.css';

	$admin_js_url  = SA_PLUGIN_URL . 'js/utils/admin.js';
	$admin_js_path = SA_PLUGIN_DIR . 'js/utils/admin.js';

	wp_enqueue_script( 'sa-admin-js', $admin_js_url, array(), filemtime( $admin_js_path ) );
	wp_enqueue_style( 'sa-admin-styles', $styles_url, array(), filemtime( $styles_path ) );
}