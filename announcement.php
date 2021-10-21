<?php 
add_action( 'wp_footer', 'sa_message_html' );

function sa_message_html() {
	include SA_PLUGIN_DIR . 'fragments/announcement.php';
}