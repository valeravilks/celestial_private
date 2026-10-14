<?php
/**
 * Plugin Name: Celestial
 * Description: Base plugin for Celestial site functionality.
 * Version: 0.1.0
 * Text Domain: celestial
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/includes/landing-pages/index.php';
require_once __DIR__ . '/includes/editor-policy/index.php';
require_once __DIR__ . '/includes/icons/index.php';

/**
 * Load shared editor extensions when their build is available.
 */
function celestial_enqueue_editor_assets(): void {
	$build_dir = __DIR__ . '/build/editor/';
	if ( ! file_exists( $build_dir . 'index.js' ) || ! file_exists( $build_dir . 'index.asset.php' ) ) {
		return;
	}

	$asset = require $build_dir . 'index.asset.php';
	wp_enqueue_script(
		'celestial-editor',
		plugins_url( 'build/editor/index.js', __FILE__ ),
		$asset['dependencies'],
		$asset['version'],
		true
	);
}

add_action( 'enqueue_block_editor_assets', 'celestial_enqueue_editor_assets' );

/**
 * Register built custom blocks from their metadata manifest.
 */
function celestial_register_blocks(): void {
	$build_dir = __DIR__ . '/build/blocks';
	$manifest  = $build_dir . '/blocks-manifest.php';
	if ( ! file_exists( $manifest ) ) {
		return;
	}

	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( $build_dir, $manifest );
		return;
	}

	if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
		wp_register_block_metadata_collection( $build_dir, $manifest );
	}

	$manifest_data = require $manifest;
	foreach ( array_keys( $manifest_data ) as $block_type ) {
		register_block_type( "{$build_dir}/{$block_type}" );
	}
}

add_action( 'init', 'celestial_register_blocks' );
