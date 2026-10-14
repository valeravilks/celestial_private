<?php
/**
 * Theme setup for Celestial.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Disable the bundled WordPress Core block patterns.
 */
function celestial_disable_core_patterns(): void {
	remove_theme_support( 'core-block-patterns' );
}

add_action( 'after_setup_theme', 'celestial_disable_core_patterns' );

/**
 * Attach theme CSS files to their corresponding Core blocks.
 */
function celestial_theme_register_block_styles(): void {
	$styled_blocks = array( 'button' );

	foreach ( $styled_blocks as $block_name ) {
		$path = "assets/blocks/{$block_name}.css";

		wp_enqueue_block_style(
			"core/{$block_name}",
			array(
				'handle' => "celestial-{$block_name}",
				'src'    => get_theme_file_uri( $path ),
				'path'   => get_theme_file_path( $path ),
			)
		);
	}
}

add_action( 'init', 'celestial_theme_register_block_styles' );

/**
 * Register section categories for reusable patterns.
 */
function celestial_theme_register_pattern_categories(): void {
	$categories = array(
		'hero'     => __( 'Hero', 'celestial' ),
		'benefits' => __( 'Benefits', 'celestial' ),
		'features' => __( 'Features', 'celestial' ),
		'process'  => __( 'Process', 'celestial' ),
		'faq'      => __( 'FAQ', 'celestial' ),
		'contact'  => __( 'Contact', 'celestial' ),
	);

	foreach ( $categories as $slug => $label ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $slug ) ) {
			register_block_pattern_category( $slug, array( 'label' => $label ) );
		}
	}
}

add_action( 'init', 'celestial_theme_register_pattern_categories' );
