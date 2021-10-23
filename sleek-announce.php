<?php

/**
 * Plugin Name: SleekAnnounce Pro
 * Plugin URI: https://mybrindle.com/
 * Description: Custom announcements, promotions and cookie notices, somehow made sexy.
 * Version: 1.0
 * Author: Brindle
 * Author URI: https://mybrindle.com/
 */
define( 'SA_PLUGIN_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR );
define( 'SA_PLUGIN_URL', plugin_dir_url(__FILE__) );

include_once SA_PLUGIN_DIR . 'load.php';

add_filter( 'wp_head', 'sa_custom_css_code' );
function sa_custom_css_code() {

	$custom_css = carbon_get_theme_option( 'crb_ca_custom_css_code' );
	$custom_js  = carbon_get_theme_option( 'sa_custom_js_code' );

	if ( !empty($custom_css) ) : ?>

		<style>
			<?php echo $custom_css; ?>
		</style>

	<?php endif;

	if ( !empty($custom_js) ) : ?>

		<script>
			<?php echo $custom_js; ?>
		</script>

	<?php endif;

}
