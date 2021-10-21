<?php 

if ( isset( $_COOKIE['crb_sa_hide_cookie_notice'] ) ) {
	return;
}

$status = carbon_get_theme_option( 'crb_sa_cookie_policy_status' );

if ( $status === 'crb_disabled' ) {
	return;
}

/*
	Check if this page is allowed to show the notice bar from the admin
*/
$show_message_on = carbon_get_theme_option( 'crb_sa_cookie_show_on' );
if ( $show_message_on === 'particular-pages' ) {
	
	$visible_pages = carbon_get_theme_option( 'crb_sa_cookie_visible_pages' );
	$visible_pages_ids = [];

	foreach ($visible_pages as $key => $page) {
		$visible_pages_ids[$key] = $page['id'];
	}

	if ( ! empty( $visible_pages ) && ! in_array( get_the_ID(), $visible_pages_ids ) ) {
		return;
	}

}

$delay = carbon_get_theme_option( 'crb_sa_cookie_delay' );
$background_color = carbon_get_theme_option( 'crb_sa_cookie_policy_background' );
$text_color = carbon_get_theme_option( 'crb_sa_cookie_policy_text_color' );
$shadow_color = carbon_get_theme_option( 'crb_sa_cookie_policy_shadow_color' );
$shadow_opacity = carbon_get_theme_option( 'crb_sa_cookie_policy_shadow_opacity' );
$shadow_intensity = carbon_get_theme_option( 'crb_sa_cookie_policy_shadow_intensity' );
$entry = carbon_get_theme_option( 'crb_sa_cookie_policy_entry' );
$buttons = carbon_get_theme_option( 'crb_sa_cookie_policy_btns' );

$background_color = ! empty( $background_color ) ? $background_color : '#075c64';

if ($text_color === 'crb_dark') {
	$text_color = '#000';
} else {
	$text_color = '#fff';
}

$shadow_opacity = ! empty( $shadow_opacity ) ? $shadow_opacity : '15';
$shadow_opacity = str_replace('%', '', $shadow_opacity);

$shadow_color = ! empty( $shadow_color ) ? $shadow_color : '#000000';
$shadow_color = str_replace('#', '', $shadow_color);

$shadow_color_parts = str_split( $shadow_color, 2 ); 
$shadow_rgb1 = hexdec( $shadow_color_parts[0] ); 
$shadow_rgb2 = hexdec( $shadow_color_parts[1] ); 
$shadow_rgb3 = hexdec( $shadow_color_parts[2] );

$shadow_color_rgb = 'rgba(' . $shadow_rgb1 . ',' . $shadow_rgb2 . ',' . $shadow_rgb3 . ',' . '.' . $shadow_opacity . ')';

$shadow = 'box-shadow: ';
$shadow = ! empty( $shadow_intensity ) ? $shadow . '0 0 ' . $shadow_intensity . 'px' : $shadow . '0 0 ' . '54px';
$shadow = $shadow . ' ' . $shadow_color_rgb . ';';

$snooze_popup   = carbon_get_theme_option( 'crb_sa_cookie_snooze' );
$number_of_days = carbon_get_theme_option( 'crb_sa_number_of_days_snooze' );

?>

<section
class="section-sa-cookie-notice"
style="background-color: <?php echo $background_color; ?>;
<?php echo $shadow; ?>
color: <?php echo $text_color; ?>;"
data-snooze="<?php echo ! empty( $snooze_popup ) ? 'true' : ''; ?>"
data-snooze-days="<?php echo ! empty( $number_of_days ) ? $number_of_days : '0'; ?>"
data-delay="<?php echo ! empty( $delay ) ? $delay : '0'; ?>">
	<div class="section__inner">
		<div class="section__content">
			<?php echo apply_filters( 'the_content', $entry ); ?>
		</div><!-- /.section__content -->

		<div class="section__actions">
			<ul>
				<?php foreach ( $buttons as $button ) : ?>
					<?php 

					$type            = array_key_exists( '_type' , $button ) ? $button['_type'] : '';
					$url             = array_key_exists( 'url' , $button ) ? $button['url'] : '';
					$label           = array_key_exists( 'label' , $button ) ? $button['label'] : '';
					$primary_color   = array_key_exists( 'primary_color' , $button ) ? $button['primary_color'] : '';
					$text_color      = array_key_exists( 'text_color' , $button ) ? $button['text_color'] : '';
					$new_tab         = array_key_exists( 'new_tab' , $button ) ? $button['new_tab'] : '';
					$style           = '';

					if ( $text_color === 'crb_light' ) {
						$text_color = '#fff';
					} else {
						$text_color = '#000';
					}
					
					$style = 'style="color: ' . $text_color . ';' . 'border-color: ' . $primary_color . ';';

					if ( $type === 'close_banner_btn' ) {
						$style = $style . 'background: ' . $primary_color . ';' . '"';
					} else {
						$style = $style . '"';
					}

					?>

					<li<?php echo $type === 'link_action_button' ? ' class="hollow"' : '' ?>>
						<a<?php echo $new_tab ? ' target="_BLANK" ' : '' ?><?php echo $type === 'close_banner_btn' ? ' class="js-sa-close-cookie" ' : ''; ?><?php echo $type === 'link_action_button' ? ' data-hover-color="' . $primary_color . '" ' : ''; ?> <?php echo $style; ?> href="<?php echo $url ? $url : '#' ?>">
							<?php echo esc_html( $label ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div><!-- /.section__actions -->
	</div><!-- /.section__inner -->
</section><!-- /.section-cookie -->