<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

$choose_pages_types = [
	[
		'type'      => 'post',
		'post_type' => 'page',
	],
	[
		'type' => 'post',
		'post_type' => 'post',
	],
];

if ( class_exists( 'woocommerce' ) ) {
	$choose_pages_types[] = [
		'type' => 'post',
		'post_type' => 'product',
	];
}



Container::make('theme_options', __('Cookie Notification', 'mb-sa'))
	->set_page_parent('my-brindle.php')
	->add_fields( array(
		Field::make( 'select', 'crb_sa_cookie_policy_status', __( 'Status', 'mb-sa' ) )
			->add_options(array(
				'crb_disabled' => 'Disabled',
				'crb_enabled' => 'Enabled',
			))
			->set_width(50),
		Field::make('text', 'crb_sa_cookie_delay', __('Delay', 'mb-sa'))
			->set_width(50)
			->set_default_value(0)
			->help_text('Enter the number of seconds after which the message will be displayed.')
			->set_default_value('3'),
		Field::make( 'color', 'crb_sa_cookie_policy_background', __( 'Background Color', 'mb-sa' ) )
			->set_width(25)
			->set_default_value('#075c64'),
		Field::make( 'select', 'crb_sa_cookie_policy_text_color', __( 'Text Color', 'mb-sa' ) )
					->set_width(25)
					->add_options(array(
						'crb_light' => __( 'Light', 'mb-sa' ),
						'crb_dark' => __( 'Dark', 'mb-sa' ),
					)),
		Field::make( 'color', 'crb_sa_cookie_policy_shadow_color', __( 'Drop Shadow Color', 'mb-sa' ) )
			->set_width(16.67)
			->set_default_value('#000000'),
		Field::make( 'text', 'crb_sa_cookie_policy_shadow_opacity', __( 'Drop Shadow Opacity', 'mb-sa' ) )
			->set_help_text('Set drop shadow opacity as a percentage, default is 25.')
			->set_width(16.67)
			->set_default_value('25'),
		Field::make( 'text', 'crb_sa_cookie_policy_shadow_intensity', __( 'Drop Shadow Intensity', 'mb-sa' ) )
			->set_help_text('Set drop shadow intensity as a number, default is 15.')
			->set_width(16.67)
			->set_default_value('15'),
		Field::make( 'rich_text', 'crb_sa_cookie_policy_entry', __( 'Text Entry', 'mb-sa' ) )
			->set_default_value('<p>We use cookies to improve user experience, and analyze website traffic. For these reasons, we may share your site usage data with our analytics partners to better our advertising campaign and to better understand customers like you. By continuing to the site, you consent to store on your device all the technologies described in our <a href="#">Cookie Policy</a>. Please read our <a href="#">Terms and Conditions</a> and <a href="/#">Privacy Policy</a> for full details.</p>'),
		Field::make( 'complex', 'crb_sa_cookie_policy_btns', __( 'Buttons', 'mb-sa' ) )
			->set_max(2)
			->set_layout('tabbed-horizontal')
			->add_fields('link_action_button', __('Link Actions Button', 'mb-sa'), array(
				Field::make( 'text', 'label', __( 'Button Label', 'mb-sa' ) )
					->set_width(33)
					->set_default_value('Cookie Policy'),
				Field::make( 'text', 'url', __( 'Button URL', 'mb-sa' ) )
					->set_width(33)
					->set_default_value('#'),
				Field::make( 'checkbox', 'new_tab', __( 'Open Link In New Tab?', 'mb-sa' ) )
					->set_width(33)
					->set_default_value('yes'),
				Field::make( 'color', 'primary_color', __( "Button's Border Color", 'mb-sa' ) )
					->set_width(50)
					->set_default_value('#117c86'),
				Field::make( 'select', 'text_color', __( "Buttons' Text Color", 'mb-sa' ) )
					->set_width(50)
					->add_options(array(
						'crb_light' => __( 'Light', 'mb-sa' ),
						'crb_dark' => __( 'Dark', 'mb-sa' ),
					)),
				))
			->add_fields('close_banner_btn', __('Close Banner Button', 'mb-sa'), array(
				Field::make( 'text', 'label', __( 'Button Label', 'mb-sa' ) )
					->set_width(33)
					->set_default_value('Agree and Continue'),
				Field::make( 'color', 'primary_color', __( "Button's Primary Color", 'mb-sa' ) )
					->set_width(33)
					->set_default_value('#13ddcc'),
				Field::make( 'select', 'text_color', __( "Button's Text Color", 'mb-sa' ) )
					->set_width(33)
					->add_options(array(
						'crb_light' => __( 'Light', 'mb-sa' ),
						'crb_dark' => __( 'Dark', 'mb-sa' ),
					)),
				)),
		Field::make('separator', 'crb_sa_cookie_visibility_option', __('Visibility Options', 'mb-sa')),
		Field::make('select', 'crb_sa_cookie_show_on', __('Show the bar on:', 'mb-sa'))
			->add_options(array(
				'all-pages' => 'All Pages',
				'particular-pages' => 'Choose Pages'
			)),
		Field::make('association', 'crb_sa_cookie_visible_pages', __('Choose Pages', 'mb-sa'))
			->set_types( $choose_pages_types )
			->set_conditional_logic(array(
				array(
					'field'   => 'crb_sa_cookie_show_on',
					'value'   => 'particular-pages',
					'compare' => '='
				)
			)),
		Field::make('separator', 'crb_sa_cookie_settings', __( 'Cookie Settings', 'mb-sa' ) ),
		Field::make( 'checkbox', 'crb_sa_cookie_snooze', __( 'Snooze notice after form submission or closing.', 'mb-sa' ) )
			->set_default_value( true ),
		Field::make( 'text', 'crb_sa_number_of_days_snooze', '' )
			->set_default_value( '10' )
			->set_help_text( __( 'Number of days to snooze popup', 'mb-sa' ) )
			->set_conditional_logic( array(
				'relation' => 'AND',
				array(
					'field' => 'crb_sa_cookie_snooze',
					'value' => true,
					'compare' => '='
				),
			) ),
	));