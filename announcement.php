<?php 
add_action('wp_footer', 'sa_banner_html');

function sa_banner_html() {
	$current_page_id  = get_the_ID();

	$query = new WP_Query( array(
		'post_type' => 'sa_banner',
		'post_status' => 'publish',
		'posts_per_page' => -1
	) );

	$posts = $query->posts;

	foreach ( $posts as $post ) {
		$post_id = $post->ID;

		$visibility = carbon_get_post_meta( $post_id, 'crb_sa_show_on' );

		if ( $visibility === 'all-pages' ) {
			include SA_PLUGIN_DIR . 'fragments/announcement.php';
		} else {
			$visible_pages    = carbon_get_post_meta( $post_id, 'crb_sa_visible_pages' );
			$visible_page_ids = [];

			foreach ( $visible_pages as $page ) {
				$visible_page_ids[] = $page['id'];
			}

			if ( in_array( $current_page_id, $visible_page_ids ) ) {
				include SA_PLUGIN_DIR . 'fragments/announcement.php';
			}
		}
	}
}