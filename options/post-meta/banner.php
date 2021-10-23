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



Container::make( 'post_meta', __( 'SleekAnnounce', 'mb-sa' ) )
	->where( 'post_type', '=', 'sa_banner' )
	->add_fields( [
		Field::make( 'text', 'crb_sa_banner_title', __( 'Banner Title', 'mb-sa' ) )
			->set_help_text( 'for reference only', 'mb-sa' ),
		Field::make( 'select', 'crb_sa_message_status', __( 'Message Status', 'mb-sa' ) )
			->add_options( array(
				'disabled' => __( 'Disabled', 'mb-sa' ), 
				'enabled'  => __( 'Enabled', 'mb-sa' ),
			) )
			->set_width(50)
			->help_text( 'If you choose "Disabled", the message will not appear.' ),
		Field::make( 'text', 'crb_sa_height', __( 'Height', 'mb-sa' ) )
			->set_width( 50 )
			->set_default_value( '65' )
			->set_help_text( 'Set height (number only, which is rendered in px).' ),
		Field::make( 'image', 'crb_sa_logo', __('Upload Logo', 'mb-sa' ) )
			->help_text( 'Recommended size: 170px x 40px (double the size for retina optimization). Larger images will be automatically resized.' ),

		Field::make( 'text', 'crb_sa_logo_link', __( 'Logo Link', 'mb-sa' ) ),
		Field::make( 'textarea', 'crb_sa_announcement_text', __( 'Announcement Text', 'mb-sa' ) )
			->set_default_value( 'Add a beautiful, fully responsive announcement to your site!' )
			->help_text( __( 'This is the main message that will appear in your banner.', 'mb-sa' ) )
			->set_required(true),

		Field::make('color', 'crb_sa_background_top_color', __('Background Top Gradient Color', 'mb-sa'))
			->set_default_value('#0DB0EC')
			->set_required(true),
		Field::make('color', 'crb_sa_background_bottom_color', __('Background Bottom Gradient Color', 'mb-sa'))
			->set_default_value('#069AE6')
			->set_required(true),

		Field::make('text', 'crb_sa_delay', __('Delay', 'mb-sa'))
			->set_default_value(3)
			->help_text('Enter the number of seconds after which the message will be displayed.'),

		Field::make('color', 'crb_sa_message_color', __('Message Color', 'mb-sa'))
			->set_default_value('#ffffff'),
		Field::make('color', 'crb_separator_color', __('Separator Color', 'mb-sa'))
			->set_default_value('#3EBCF5'),

		Field::make('select', 'crb_sa_message_position', __('Message Position', 'mb-sa'))
			->add_options(array(
				'top' 	 => 'Top',
				'bottom' => 'Bottom'
			))
			->set_default_value('top'),

		Field::make('text', 'crb_sa_message_width', __('Message Width', 'mb-sa'))
			->set_default_value(1040)
			->help_text('You can change the width of the container of the message from this field.'),

		// Visibility Options
		Field::make('separator', 'crb_sa_visibility_option', __('Visibility Options', 'mb-sa')),
		Field::make('select', 'crb_sa_show_on', __('Show the bar on:', 'mb-sa'))
			->add_options(array(
				'all-pages' => 'All Pages',
				'particular-pages' => 'Choose Pages'
			))
			->set_default_value( 'all-pages' ),
		Field::make('association', 'crb_sa_visible_pages', __('Choose Pages', 'mb-sa'))
			->set_types( $choose_pages_types )
			->set_conditional_logic(array(
				array(
					'field'   => 'crb_sa_show_on',
					'value'   => 'particular-pages',
					'compare' => '='
				)
			)),

		// Button Options
		Field::make('separator', 'crb_sa_button_options', __('Button Options', 'mb-sa')),
		Field::make( 'select', 'crb_sa_button_style', __( 'Button Style', 'mb-sa' ) )
			->add_options( [
				'default' => __( 'Default', 'mb-sa' ),
				'floating' => __( 'Floating', 'mb-sa' ),
			] ),
		Field::make( 'text', 'crb_sa_button_radius', __( 'Button Border Radius', 'mb-sa' ) )
			->set_conditional_logic(array(
				array(
					'field'   => 'crb_sa_button_style',
					'value'   => 'floating',
					'compare' => '='
				)
			))
			->set_default_value( '20px' ),
		Field::make('text', 'crb_sa_button_text', __('Button Text', 'mb-sa'))
			->set_default_value('Find Out More'),

		Field::make('select', 'crb_sa_button_behaviour', __('Button Functionality', 'mb-sa'))
			->add_options(array(
				'new-page'   => 'Button links to new page',
				'close-page' => 'Button closes announcement'
			)),
		Field::make('text', 'crb_sa_button_link', __('Button Link', 'mb-sa'))
			->set_default_value('#')
			->set_conditional_logic(array(
				array(
					'field'   => 'crb_sa_button_behaviour',
					'value'   => 'new-page',
					'compare' => '='
				)
			)),
		Field::make('set', 'crb_sa_button_link_new_tab', __('Open Link in new tab', 'mb-sa'))
			->add_options(array('yes' => 'Yes'))
			->set_conditional_logic(array(
				array(
					'field'   => 'crb_sa_button_behaviour',
					'value'   => 'new-page',
					'compare' => '='
				)
			)),
			
		Field::make('color', 'crb_sa_button_top_color', __('Top Gradient Color', 'mb-sa'))
			->set_default_value('#FE7964'),
		Field::make('color', 'crb_sa_button_bottom_color', __('Bottom Gradient Color', 'mb-sa'))
			->set_default_value('#EA504F'),

		// Custom CSS
		Field::make('separator', 'crb_sa_custom_code_section', __('Custom Code', 'mb-sa')),
		Field::make('textarea', 'crb_ca_custom_css_code', __('Custom CSS Code', 'mb-sa'))
			->help_text('Some theme require additional adjustments of their CSS. You can ovverwrite some of the theme styling in this field.'),
		Field::make('textarea', 'sa_custom_js_code', __('Custom JavaScript Code', 'mb-sa'))
			->help_text('You can add custom JavaScript code in this field.'),
		Field::make('separator', 'crb_sa_fixed_header', __('Fixed Header', 'mb-sa')),
		Field::make( 'text', 'crb_sa_fixed_header_selector', __( 'Fixed Header Selector', 'mb-sa' ) )
			->set_help_text('If your website has a fixed header and you experience overlapping issues between the header and the announcement banner please enter a css selector for your header\'s fixed container for an easy fix.'),
		Field::make('separator', 'crb_sa_banner_snooze_settings', __( 'Snooze Settings', 'mb-sa' ) ),
		Field::make( 'checkbox', 'crb_sa_banner_snooze', __( 'Snooze banner after closing.', 'mb-sa' ) )
			->set_default_value( false ),
		Field::make( 'text', 'crb_sa_number_of_days_snooze', '' )
			->set_default_value( '10' )
			->set_help_text( __( 'Number of days to snooze banner', 'mb-sa' ) )
			->set_conditional_logic( array(
				'relation' => 'AND',
				array(
					'field' => 'crb_sa_banner_snooze',
					'value' => true,
					'compare' => '='
				),
			) ),
	] );