<?php

/**
 * Plugin Name: SleekAnnounce Pro
 * Plugin URI: https://mybrindle.com/
 * Description: Custom announcements, promotions and cookie notices, somehow made sexy.
 * Version: 1.0
 * Author: Brindle
 * Author URI: https://mybrindle.com/
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

require_once( plugin_dir_path( __FILE__ ) . 'mb-bb-api-manager-product-id.php' );

// Load the API Manager PHP Library
// Load WC_AM_Client class if it exists.
if ( ! class_exists( 'WC_AM_Client_MBBB' ) ) {
	/*
	* |---------------------------------------------------------------------
	* | This must be exactly the same for both plugins and themes.
	* |---------------------------------------------------------------------
	*/
	require_once( plugin_dir_path( __FILE__ ) . 'wc-am-client.php' );
}

// Instantiate WC_AM_Client class object if the WC_AM_Client class is loaded.
if ( class_exists( 'WC_AM_Client_MBBB' ) ) {
	/**
	* This file is only an example that includes a plugin header, and this code used to instantiate the client object. The variable $wcam_lib
	* can be used to access the public properties from the WC_AM_Client class,
	but $wcam_lib must have a unique name. To find data saved by
	* the WC_AM_Client in the options table, search for wc_am_client_{product_id},
	so in this example it would be wc_am_client_132967.
	*
	* All data here is sent to the WooCommerce API Manager API, except for the
	$software_title, which is used as a title, and menu label, for
	* the API Key activation form the client will see.
	*
	* ****
	* NOTE
	* ****
	* If $product_id is empty, the customer can manually enter the product_id into a form field on the activation screen.
	*
	* @param string $file Must be __FILE__ from the root plugin file, or theme functions, file locations.
	* @param int $product_id Must match the Product ID number (integer) in the product.
	* @param string $software_version This product's current software version.
	* @param string $plugin_or_theme 'plugin' or 'theme'
	* @param string $api_url The URL to the site that is running the API Manager. Example: https://www.toddlahman.com/ Must be the root URL.
	* @param string $software_title The name, or title, of the product. The title is
	not sent to the API Manager APIs, but is used for menu titles.
	*
	* Example:
	*
	* $wcam_lib = new WC_AM_Client_2_8( $file, $product_id, $software_version, $plugin_or_theme, $api_url, $software_title );
	*/
	// Theme example.
	//$wcam_lib = new WC_AM_Client_2_8( __FILE__, 234, '1.0', 'theme', 'http://wc/', 'WooCommerce API Manager PHP Library for Plugins and Themes' );
	// Second argument must be the Product ID number if used. If left empty the client will need to enter it in the activation form.
	// Plugin example. The $wcam_lib is optional, and must have a unique name if used to check if the API Key has been activated before allowing use of the plugin/ theme.

	$mbbb_wcam_lib = new WC_AM_Client_MBBB( __FILE__, 1149, '1.0.2', 'plugin', 'https://mybrindle.com/product/banners-wordpress-plugin/', 'SleekAnnounce PRO' );
}

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
