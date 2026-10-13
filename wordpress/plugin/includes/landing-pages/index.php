<?php
/**
 * Landing page content type.
 *
 * @package Celestial
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the landing page custom post type.
 *
 * @return void
 */
function celestial_register_landing_page_post_type(): void {
	register_post_type(
		'landing-page',
		array(
			'labels'        => array(
				'name'               => __( 'Landing Pages', 'celestial' ),
				'singular_name'      => __( 'Landing Page', 'celestial' ),
				'add_new'            => __( 'Add New', 'celestial' ),
				'add_new_item'       => __( 'Add New Landing Page', 'celestial' ),
				'edit_item'          => __( 'Edit Landing Page', 'celestial' ),
				'new_item'           => __( 'New Landing Page', 'celestial' ),
				'view_item'          => __( 'View Landing Page', 'celestial' ),
				'search_items'       => __( 'Search Landing Pages', 'celestial' ),
				'not_found'          => __( 'No landing pages found', 'celestial' ),
				'not_found_in_trash' => __( 'No landing pages found in Trash', 'celestial' ),
				'all_items'          => __( 'All Landing Pages', 'celestial' ),
				'menu_name'          => __( 'Landing Pages', 'celestial' ),
			),
			'public'        => true,
			'show_in_rest'  => true,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'has_archive'   => false,
			'rewrite'       => array( 'slug' => 'landing-page' ),
			'menu_icon'     => 'dashicons-welcome-write-blog',
			'menu_position' => 20,
		)
	);
}
add_action( 'init', 'celestial_register_landing_page_post_type' );
