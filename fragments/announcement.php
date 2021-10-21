<?php

// Check if the message is enabled
$enabled = carbon_get_theme_option('crb_sa_message_status');
if ( $enabled !== 'enabled' ) {
	return;
}

/*
	Check if Session variable has been set
*/
if ( isset($_SESSION['crb_sa_message_shown']) ) {
	return;
}

/*
	Check if this page is allowed to show the notice bar from the admin
*/
$show_message_on = carbon_get_theme_option('crb_sa_show_on');
if ( $show_message_on === 'particular-pages' ) {
	
	$visible_pages = carbon_get_theme_option('crb_sa_visible_pages');
	$visible_pages_ids = [];

	foreach ($visible_pages as $key => $page) {
		$visible_pages_ids[$key] = $page['id'];
	}

	if ( !empty($visible_pages) && !in_array(get_the_ID(), $visible_pages_ids) ) {
		return;
	}

}

$message = carbon_get_theme_option('crb_sa_announcement_text');

$height  = carbon_get_theme_option('crb_sa_height');
$fixed_header_selector  = carbon_get_theme_option('crb_sa_fixed_header_selector');

if (! is_numeric($height)) {
	$height = 'auto';
}

$logo    = carbon_get_theme_option('crb_sa_logo'); 

$button_text = carbon_get_theme_option('crb_sa_button_text'); 
$button_behaviour = carbon_get_theme_option('crb_sa_button_behaviour');


$button_top_gradient 	= carbon_get_theme_option('crb_sa_button_top_color') ? carbon_get_theme_option('crb_sa_button_top_color') : '#ea504f';
$button_bottom_gradient = carbon_get_theme_option('crb_sa_button_bottom_color') ? carbon_get_theme_option('crb_sa_button_bottom_color') : '#eb3a5e'; 

$bg_top_gradient 	= carbon_get_theme_option('crb_sa_background_top_color') ? carbon_get_theme_option('crb_sa_background_top_color') : '#1184ae'; 
$bg_bottom_gradient = carbon_get_theme_option('crb_sa_background_bottom_color') ? carbon_get_theme_option('crb_sa_background_bottom_color') : '#0fa8b4'; 

$delay = carbon_get_theme_option('crb_sa_delay');
$delay *= 1000;

$message_color 	  = carbon_get_theme_option('crb_sa_message_color') ? carbon_get_theme_option('crb_sa_message_color') : '#fff';
$message_position = carbon_get_theme_option('crb_sa_message_position');

$separator_color = carbon_get_theme_option('crb_separator_color') ? carbon_get_theme_option('crb_separator_color') : '#3ed1d6';

$button_style = carbon_get_theme_option( 'crb_sa_button_style' );

$class = 'bar-plugin ' . $message_position;

if ( $button_style === 'floating' ) {
	$class .= ' bar-plugin--floating-btn';
}

$message_shell_width = carbon_get_theme_option('crb_sa_message_width');
if ( empty($message_shell_width) ) {
	$message_shell_width = 960;
}

$message_shell_width .= 'px';

?>
<div class="
	<?php echo $class; ?>
	<?php echo empty($logo) ? ' no-logo' : ''; ?>"
	data-show="true" 
	data-button-gradient-top="<?php echo $button_top_gradient; ?>" 
	data-button-gradient-bottom="<?php echo $button_bottom_gradient; ?>" 
	data-background-gradient-top="<?php echo $bg_top_gradient; ?>" 
	data-background-gradient-bottom="<?php echo $bg_bottom_gradient; ?>"
	data-position="<?php echo $message_position; ?>"
	data-delay="<?php echo $delay; ?>"
	data-color="<?php echo $message_color; ?>"
	data-separator="<?php echo $separator_color; ?>"
	data-height="<?php echo $height; ?>"
	data-fixed-header="<?php echo ! empty( $fixed_header_selector ) ? $fixed_header_selector : ''; ?>"
>
	<div class="bar-plugin-shell" style="max-width: <?php echo $message_shell_width; ?>">

		<?php if ( $button_behaviour === 'new-page' ) : ?>

			<a href="#" class="bar-plugin-btn-close"></a>

		<?php endif; ?>
		
		<ul>
			<?php 

				$logo_link = carbon_get_theme_option('crb_sa_logo_link'); 
				if ( empty($logo_link) ) {
					$logo_link = '#';
				} ?>

				<?php if ( ! empty( $logo ) ) : ?>
					<li class="bar-plugin__logo">
						<div class="bar-plugin-table">
							<div class="bar-plugin-table-cell logo-cell">
								<a href="<?php echo $logo_link; ?>" class="bar-plugin-logo" target="_blank">
									<?php echo wp_get_attachment_image($logo, 'logo-image'); ?>
								</a>		
							</div><!-- /.bar-plugin-table-cell -->
						</div><!-- /.bar-plugin-table -->

						<span class="bar-plugin-separator"></span>
					</li>
				<?php endif; ?>

			<?php 

			if ( !empty($message) ) : ?>

				<li class="bar-plugin__message">
					<div class="bar-plugin-table">
						<div class="bar-plugin-table-cell">
							<?php echo wpautop($message); ?>
						</div><!-- /.bar-plugin-table-cell -->
					</div><!-- /.bar-plugin-table -->
				</li>

			<?php endif; 

			$button_radius = carbon_get_theme_option( 'crb_sa_button_radius' );

			if ( empty( $button_radius ) ) {
				$button_radius = '0';
			}

			if ( $button_behaviour === 'new-page' ) :

				$button_link = carbon_get_theme_option( 'crb_sa_button_link' );

				if ( ! empty( $button_link ) && ! empty( $button_text ) ) : 

					$button_new_tab = carbon_get_theme_option('crb_sa_button_link_new_tab');
					$button_link = carbon_get_theme_option('crb_sa_button_link');

					if ( ! empty( $button_new_tab ) && $button_new_tab[0] === 'yes' ) {
						$target = 'target="_blank"';
					} else {
						$target = '';
					}
					?>

					<li class="bar-plugin__btn">
						<a style="<?php printf( 'border-radius: %s', $button_radius ); ?>" href="<?php echo $button_link; ?>" class="bar-plugin-btn" <?php echo $target; ?>>
							<span><?php echo $button_text; ?></span>
						</a>
					</li>

				<?php endif;

			else : ?>

				<li class="bar-plugin__btn">
					<a href="#" class="bar-plugin-btn sa-close-btn">
						<span><?php echo $button_text; ?></span>
					</a>
				</li>

			<?php endif; ?>
		</ul>
	</div><!-- /.bar-plugin-shell -->
</div><!-- /.bar-plugin -->