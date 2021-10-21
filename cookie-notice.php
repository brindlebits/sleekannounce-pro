<?php 
add_action('wp_head', 'sa_cookie_notice_css');
add_action('wp_footer', 'sa_cookie_notice_html');

function sa_cookie_notice_html() {
	require_once(SA_PLUGIN_DIR . 'fragments' . DIRECTORY_SEPARATOR . 'cookie-notice.php');
}

function sa_cookie_notice_css() {
	?>
		<link rel="stylesheet" href="https://use.typekit.net/eip0gix.css">
	<?php
}