<?php

add_action('after_setup_theme', 'sa_add_sleek_announce_options', 100);
function sa_add_sleek_announce_options() {

	// Add Image Sizes
	add_image_size( 'logo-image', 340, 80, 1 );

	require_once( SA_PLUGIN_DIR . 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();

	add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );

	include_once( SA_PLUGIN_DIR . 'options/post-types.php' );

	include_once( SA_PLUGIN_DIR . 'announcement.php' );
	include_once( SA_PLUGIN_DIR . 'cookie-notice.php' );
}

function crb_attach_theme_options() {
	# Attach fields
	include_once( SA_PLUGIN_DIR . 'options/plugin-options.php' );
}