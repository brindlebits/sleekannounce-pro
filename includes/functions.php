<?php
/**
 * Escape User input from WYSIWYG editors.
 *
 * Calls all filters usually executed on `the_content`.
 *
 * @param  string $content The content that needs to be escaped.
 * @return string The escaped content.
 */
function mbsa_content( $content ) {
	return apply_filters( 'mbsa_content', $content );
}

/**
 * Attach all Hooks from `the_content` on `mbsa_content`.
 */
add_filter( 'mbsa_content', 'wptexturize'                          );
add_filter( 'mbsa_content', 'wpautop'                              );
add_filter( 'mbsa_content', 'shortcode_unautop'                    );
add_filter( 'mbsa_content', 'prepend_attachment'                   );
add_filter( 'mbsa_content', 'wp_filter_content_tags'               );
add_filter( 'mbsa_content', 'do_shortcode',                     12 );
add_filter( 'mbsa_content', 'convert_smilies',                  20 );

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

add_action( 'init', 'mbsa_migrate_theme_option_to_post_meta_banner', 10 );

function mbsa_migrate_theme_option_to_post_meta_banner() {
	$has_been_done = get_site_option( 'mbsa_theme_option_post_meta_migration', false );

	if ( ! empty( $has_been_done ) ) {
		return;
	}

	$banner_id = wp_insert_post( [
		'post_title'  => 'Demo Banner',
		'post_status' => 'publish',
		'post_type'   => 'sa_banner'
	] );

	if ( empty( $banner_id ) ) {
		return;
	}

	$meta_keys = mbqp_get_banner_carbon_fields();

	foreach ( $meta_keys as $meta_key ) {
		$original_meta_value = carbon_get_theme_option( $meta_key );
		
		if ( $meta_key === 'crb_sa_banner_title' ) {
			$original_meta_value = get_the_title( $banner_id );
		}

		carbon_set_post_meta( $banner_id, $meta_key, $original_meta_value );
	}

	update_site_option( 'mbsa_theme_option_post_meta_migration', true );
}

/** 
 * Convert number of seconds into hours, minutes and seconds 
 * and return an array containing those values 
 * 
 * @param integer $inputSeconds Number of seconds to parse 
 * @return array 
 */ 

function secondsToTime($inputSeconds) {

    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;

    // extract days
    $days = floor($inputSeconds / $secondsInADay);

    // extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // return the final array
    $obj = array(
        'd' => (int) $days,
        'h' => (int) $hours,
        'm' => (int) $minutes,
        's' => (int) $seconds,
    );
    return $obj;
}