<?php

function mbqp_duplicate_banner_custom_fields( $original_popup_id, $new_popup_id ) {
	$meta_keys = mbqp_get_banner_carbon_fields();

	foreach ( $meta_keys as $meta_key ) {
		$original_meta_value = carbon_get_post_meta( $original_popup_id, $meta_key );

		carbon_set_post_meta( $new_popup_id, $meta_key, $original_meta_value );
	}

	return true;
}

function mbqp_get_banner_carbon_fields() {
	$fields = [
		'crb_sa_banner_title',
		'crb_sa_message_status',
		'crb_sa_height',
		'crb_sa_logo',
		'crb_sa_logo_link',
		'crb_sa_announcement_text',
		'crb_sa_background_top_color',
		'crb_sa_background_bottom_color',
		'crb_sa_delay',
		'crb_sa_message_color',
		'crb_separator_color',
		'crb_sa_message_position',
		'crb_sa_message_width',
		'crb_sa_show_on',
		'crb_sa_visible_pages',
		'crb_sa_button_style',
		'crb_sa_button_radius',
		'crb_sa_button_text',
		'crb_sa_button_behaviour',
		'crb_sa_button_behaviour',
		'crb_sa_button_link',
		'crb_sa_button_link_new_tab',
		'crb_sa_button_top_color',
		'crb_sa_button_bottom_color',
		'crb_ca_custom_css_code',
		'sa_custom_js_code',
		'crb_sa_fixed_header_selector',
	];

	return $fields;
}