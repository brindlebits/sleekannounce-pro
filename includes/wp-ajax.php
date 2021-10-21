<?php

add_action( 'wp_ajax_sa_duplicate_banner', 'sa_duplicate_banner' );
add_action( 'wp_ajax_nopriv_sa_duplicate_banner', 'sa_duplicate_banner' );

function sa_duplicate_banner() {
	$id = isset( $_POST['id'] ) ? strip_tags( $_POST['id'] ) : '';

	$status = 'fail';
	$new_popup_html = '';

	if ( ! empty( $id ) ) {
		$popup = get_post( intval( $id ) );

		$new_post = array(
			'post_type' => 'qp_popup',
			'post_title' => get_the_title( $id ) . ' - ' . Date('Y-m-d H:i:s'),
			'post_date' => Date( 'Y-m-d H:i:s' ),
			'post_status' => 'publish',
		);

		$post_id = wp_insert_post( $new_post );

		mbqp_duplicate_popup_custom_fields($id, $post_id);

		$status = 'success';
	}

	if ( ! empty( $post_id ) ) {
		ob_start();

		$post = get_post( $post_id );

		$post_status = $post->post_status;

		if ( $post_status === 'publish' ) {
			$post_status = 'live';
		} else {
			$post_status = 'draft';
		}

		$post_disabled = carbon_get_post_meta( $post->ID, 'qp_status' );

		if ( $post_disabled === 'qp_disabled' ) {
			$post_status = 'disabled';
		}

		include QP_PLUGIN_DIR . 'templates/parts/popup-list-item.php';

		$new_popup_html = ob_get_contents();

		ob_end_clean();
	}

	wp_send_json( [
		'status' => $status,
		'new_popup_html' => $new_popup_html,
	] );

	wp_die();
}

add_action( 'wp_ajax_qp_update_popup_status', 'qp_update_popup_status' );
add_action( 'wp_ajax_nopriv_qp_update_popup_status', 'qp_update_popup_status' );

function qp_update_popup_status() {
	$id = isset( $_POST['id'] ) ? strip_tags( $_POST['id'] ) : '';
	$new_status = isset( $_POST['status'] ) ? strip_tags( $_POST['status'] ) : '';

	$request_status = 'fail';

	if ( ! empty( $id ) || ! empty( $new_status ) ) {
		$post = get_post( $id );

		if ( ! empty( $post ) ) {
			if ( $new_status === 'live' ) {
				wp_update_post([
					'ID' => $post->ID,
					'post_status' => 'publish'
				]);

				carbon_set_post_meta( $post->ID, 'qp_status', 'qp_enabled' );
			} else {
				carbon_set_post_meta( $post->ID, 'qp_status', 'qp_disabled' );
			}

			$request_status = 'success';
		}
	}

	wp_send_json( [
		'status' => $request_status,
	] );

	wp_die();
}