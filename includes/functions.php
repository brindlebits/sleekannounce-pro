<?php

function mbqp_duplicate_popup_custom_fields($original_popup_id, $new_popup_id) {
	$meta_keys = mbqp_get_popup_carbon_fields();

	foreach ( $meta_keys as $meta_key ) {
		$original_meta_value = carbon_get_post_meta( $original_popup_id, $meta_key );

		carbon_set_post_meta( $new_popup_id, $meta_key, $original_meta_value );
	}

	return true;
}

function mbqp_get_popup_carbon_fields() {
	$fields = [
		'qp_title',
		'qp_body',
		'qp_embed_forms',
		'qp_mailchimp_form',
		'qp_hubspot_form_id',
		'qp_hubspot_form_region',
		'qp_hubspot_form_portal',
		'qp_button_text',
		'qp_button_link',
		'qp_button_new_tab',
		'qp_acknoledgement_title',
		'qp_acknoledgement_include',
		'qp_acknoledgement_required',
		'qp_acknoledgement_checked',
		'qp_acknoledgement',
		'qp_email_include',
		'qp_email_required',
		'qp_email_placeholder',
		'qp_name_include',
		'qp_name_required',
		'qp_field_name_placeholder',
		'qp_phone_include',
		'qp_phone_required',
		'qp_field_phone_placeholder',
		'qp_field_form_button_text',
		'qp_field_form_message',
		'qp_popup_close_link_include',
		'qp_popup_close_link_message',
		'qp_popup_close_link_message_alignment',
		'qp_include_button',
		'qp_include_form',
		'qp_text_color',
		'qp_fields_color',
		'qp_popup_width_type',
		'qp_popup_width',
		'qp_popup_container_radius',
		'qp_popup_bg_type',
		'qp_popup_bg',
		'qp_popup_exit_button_styling',
		'qp_popup_gradient_color_1',
		'qp_popup_gradient_color_2',
		'qp_popup_gradient_direction',
		'qp_popup_border_width',
		'qp_popup_border_color',
		'qp_popup_overlay_bg',
		'qp_popup_overlay_gradient_color_1',
		'qp_popup_overlay_gradient_color_2',
		'qp_popup_overlay_gradient_direction',
		'qp_overlay_opacity',
		'qp_btn_radius',
		'qp_standard_button_color',
		'qp_standard_button_alignment',
		'qp_form_button_color',
		'qp_form_field_background',
		'qp_form_field_border',
		'qp_custom_css_code',
		'qp_status',
		'qp_settings_form_title',
		'qp_form_title',
		'qp_settings_display_pages',
		'qp_popup_visible_pages',
		'qp_position',
		'qp_event_type',
		'qp_settings_delay',
		'qp_snooze_popup',
		'qp_number_of_days_snooze',
		'qp_animation_type',
		'qp_animation_speed',
	];

	return $fields;
}