<?php

register_post_type( 'sa_banner', array(
	'labels' => array(
		'name' => __( 'Banner', 'mb-qp' ),
		'singular_name' => __( 'Banner', 'mb-qp' ),
		'add_new' => __( 'Add New', 'mb-qp' ),
		'add_new_item' => __( 'Add new Banner', 'mb-qp' ),
		'view_item' => __( 'View Banner', 'mb-qp' ),
		'edit_item' => __( 'Edit Banner', 'mb-qp' ),
		'new_item' => __( 'New Banner', 'mb-qp' ),
		'view_item' => __( 'View Banner', 'mb-qp' ),
		'search_items' => __( 'Search Banners', 'mb-qp' ),
		'not_found' =>__( 'No banners found', 'mb-qp' ),
		'not_found_in_trash' => __( 'No banners found in trash', 'mb-qp' ),
	),
	'public' => false,
	'exclude_from_search' => true,
	'show_ui' => true,
	'show_in_menu' => false,
	'capability_type' => 'post',
	'hierarchical' => false,
	'_edit_link' => 'post.php?post=%d',
	'rewrite' => array(
		'slug' => 'banners',
		'with_front' => false,
	),
	'query_var' => true,
	'menu_icon' => '',
	'supports' => array( 'title' ),
) );