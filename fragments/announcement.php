<?php

if ( isset( $_COOKIE['crb_sa_hide_banner_' . strval( $post_id ) ] ) ) {
	return;
}

if ( empty( $post_id ) ) {
	return;
}

// Check if the message is enabled
$enabled = carbon_get_post_meta( $post_id, 'crb_sa_message_status' );

if ( $enabled !== 'enabled' ) {
	return;
}

/*
	Check if Session variable has been set
*/
if ( isset( $_SESSION['crb_sa_message_shown'] ) ) {
	return;
}

$alignment              = carbon_get_post_meta( $post_id, 'crb_sa_message_position' );
$message                = carbon_get_post_meta( $post_id, 'crb_sa_announcement_text' );
$height                 = carbon_get_post_meta( $post_id, 'crb_sa_height' );
$fixed_header_selector  = carbon_get_post_meta( $post_id, 'crb_sa_fixed_header_selector' );

if ( ! is_numeric( $height ) ) {
	$height = 'auto';
}

$logo             = carbon_get_post_meta( $post_id, 'crb_sa_logo' );
$button_text      = carbon_get_post_meta( $post_id, 'crb_sa_button_text' );
$button_behaviour = carbon_get_post_meta( $post_id, 'crb_sa_button_behaviour' );


$button_top_gradient 	= carbon_get_post_meta( $post_id, 'crb_sa_button_top_color' );

if ( empty( $button_top_gradient ) ) {
	$button_top_gradient = '#ea504f';
}

$button_bottom_gradient = carbon_get_post_meta( $post_id, 'crb_sa_button_bottom_color' );

if ( empty( $button_bottom_gradient ) ) {
	$button_bottom_gradient = '#eb3a5e';
}

$bg_top_gradient 	= carbon_get_post_meta( $post_id, 'crb_sa_background_top_color' );

if ( empty( $bg_top_gradient ) ) {
	$bg_top_gradient = '#1184ae';
}

$bg_bottom_gradient = carbon_get_post_meta( $post_id, 'crb_sa_background_bottom_color' );

if ( empty( $bg_bottom_gradient ) ) {
	$bg_bottom_gradient = '#0fa8b4';
}

$delay = carbon_get_post_meta( $post_id, 'crb_sa_delay' );
$delay *= 1000;

$message_color 	  = carbon_get_post_meta( $post_id, 'crb_sa_message_color' );

if ( empty( $message_color ) ) {
	$message_color = '#fff';
}

$message_position = carbon_get_post_meta( $post_id, 'crb_sa_message_position' );

$separator_color = carbon_get_post_meta( $post_id, 'crb_separator_color' );

if ( empty( $separator_color ) ) {
	$separator_color = '#3ed1d6';
}

$button_style = carbon_get_post_meta( $post_id, 'crb_sa_button_style' );

$class = 'sa_bar ' . $message_position;

if ( $button_style === 'floating' ) {
	$class .= ' sa_bar--floating-btn';
}

if ( ! empty( $alignment ) && $alignment === 'centered' ) {
	$class .= ' sa_bar--align-center';
}

$message_shell_width = carbon_get_post_meta( $post_id, 'crb_sa_message_width' );

if ( empty( $message_shell_width ) ) {
	$message_shell_width = 960;
}

$message_shell_width .= 'px';

$snooze_popup   = carbon_get_post_meta( $post_id, 'crb_sa_banner_snooze' );
$number_of_days = carbon_get_post_meta( $post_id, 'crb_sa_number_of_days_snooze' );

$include_counter = carbon_get_post_meta( $post_id, 'crb_sa_counter_include' );
$counter         = carbon_get_post_meta( $post_id, 'crb_sa_counter' );

if ( ! empty( $include_counter ) && ! empty( $counter ) ) {
	$class .= ' sa_bar--has-counter';
}

?>
<div class="
	<?php echo $class; ?>
	<?php echo empty($logo) ? ' no-logo' : ''; ?>"
	data-id="<?php echo $post_id; ?>"
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
	data-snooze="<?php echo ! empty( $snooze_popup ) ? 'true' : ''; ?>"
	data-snooze-days="<?php echo ! empty( $number_of_days ) ? $number_of_days : '0'; ?>"
>
	<?php if ( $button_behaviour === 'new-page' ) : ?>

		<a href="#" class="sa_bar-btn-close"></a>

	<?php endif; ?>

	<div class="sa_bar-shell" style="max-width: <?php echo $message_shell_width; ?>">

		<ul class="sa_bar__container">
			<?php

			$logo_link = carbon_get_post_meta( $post_id, 'crb_sa_logo_link' );

			if ( empty( $logo_link ) ) {
				$logo_link = '#';
			}

			?>

			<?php if ( ! empty( $logo ) ) :

			$width  = carbon_get_post_meta( $post_id, 'crb_sa_logo_width' );
			$height = carbon_get_post_meta( $post_id, 'crb_sa_logo_height' );

			if ( ! is_numeric( $width ) || empty( $width ) ) {
				$width = 'auto';
			}

			if ( ! is_numeric( $height ) || empty( $height ) ) {
				$height = 'auto';
			}

			?>
				<li class="sa_bar__logo">
					<a href="<?php echo $logo_link; ?>" class="sa_logo-bar" target="_blank">
						<?php echo wp_get_attachment_image( $logo, 'medium_large', false, [
							'style' => sprintf( 'width: %spx; height: %spx', $width, $height )
						] ); ?>
					</a>

					<span class="sa_bar-separator"></span>
				</li>
			<?php endif; ?>

			<?php

			if ( ! empty( $message ) || ( ! empty( $include_counter ) && ! empty( $counter ) ) ) : ?>

				<li class="sa_bar__message">
					<div class="sa_bar__message-text">
						<?php echo mbsa_content( $message ); ?>
					</div><!-- /.sa_bar__message-text -->

					<?php if ( ! empty( $include_counter ) && ! empty( $counter ) ) :

					$timestamp_now     = strtotime( wp_date( 'Y-m-d H:i:s' ) );
					$timestamp_counter = strtotime( $counter );

					$remainder         = $timestamp_counter - $timestamp_now;

					$counter_array     = secondsToTime( $remainder );

					?>
						<?php if ( $remainder > 0 ): ?>
							<div class="sa_bar__counter">
								<div
								class="counter sa_js-counter"
								data-date="<?php echo $counter; ?>"
								data-date-start="<?php echo wp_date( 'Y-m-d H:i:s' ); ?>">
									<ul>
										<li>
											<div class="counter__text">
												<strong class="sa_js-days"><?php echo $counter_array['d']; ?></strong>

												<span><?php _e( 'Days', 'mb-sa' ) ?></span>
											</div><!-- /.counter__text -->
										</li>

										<li>
											<div class="counter__text">
												<strong class="sa_js-hours"><?php echo $counter_array['h']; ?></strong>

												<span><?php _e( 'Hrs', 'mb-sa' ) ?></span>
											</div><!-- /.counter__text -->
										</li>

										<li>
											<div class="counter__text">
												<strong class="sa_js-minutes"><?php echo $counter_array['m']; ?></strong>

												<span><?php _e( 'Min', 'mb-sa' ) ?></span>
											</div><!-- /.counter__text -->
										</li>

										<li>
											<div class="counter__text">
												<strong class="sa_js-seconds"><?php echo $counter_array['s']; ?></strong>

												<span><?php _e( 'Sec', 'mb-sa' ) ?></span>
											</div><!-- /.counter__text -->
										</li>
									</ul>
								</div><!-- /.counter -->
							</div><!-- /.sa_bar__counter -->
						<?php endif ?>
					<?php endif ?>
				</li>

			<?php endif;

			$button_radius = carbon_get_post_meta( $post_id, 'crb_sa_button_radius' );

			if ( empty( $button_radius ) ) {
				$button_radius = '0';
			}

			if ( $button_behaviour === 'new-page' ) :

				$button_link = carbon_get_post_meta( $post_id, 'crb_sa_button_link' );

				if ( ! empty( $button_link ) && ! empty( $button_text ) ) :

					$button_new_tab = carbon_get_post_meta( $post_id, 'crb_sa_button_link_new_tab' );
					$button_link    = carbon_get_post_meta( $post_id, 'crb_sa_button_link' );

					if ( ! empty( $button_new_tab ) && $button_new_tab[0] === 'yes' ) {
						$target = 'target="_blank"';
					} else {
						$target = '';
					}
					?>

					<li class="sa_bar__btn">
						<a style="<?php printf( 'border-radius: %s', $button_radius ); ?>" href="<?php echo $button_link; ?>" class="sa_bar-btn" <?php echo $target; ?>>
							<span><?php echo $button_text; ?></span>
						</a>
					</li>

				<?php endif;

			else : ?>

				<li class="sa_bar__btn">
					<a href="#" class="sa_bar-btn sa-close-btn">
						<span><?php echo $button_text; ?></span>
					</a>
				</li>

			<?php endif; ?>
		</ul>
	</div><!-- /.sa_bar-shell -->
</div><!-- /.sa_bar -->