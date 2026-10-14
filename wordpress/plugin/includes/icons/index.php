<?php
/**
 * Local Lucide collection for the native Icon block.
 *
 * @package Celestial
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function celestial_register_lucide_icons() {
	if ( ! function_exists( 'wp_register_icon_collection' ) || ! function_exists( 'wp_register_icon' ) ) {
		return;
	}
	if ( ! wp_register_icon_collection( 'lucide', array(
		'label' => 'Lucide',
		'description' => __( 'Lucide outline icons.', 'celestial' ),
	) ) ) {
		return;
	}
	$icons = require __DIR__ . '/assets/manifest.php';
	foreach ( $icons as $name => $label ) {
		wp_register_icon( 'lucide/' . $name, array(
			'label' => $label,
			'file_path' => __DIR__ . '/assets/icons/' . $name . '.svg',
		) );
	}
}
add_action( 'init', 'celestial_register_lucide_icons' );

function celestial_lucide_icons_compatibility_notice() {
	if ( current_user_can( 'activate_plugins' ) && ( ! function_exists( 'wp_register_icon_collection' ) || ! function_exists( 'wp_register_icon' ) ) ) {
		echo '<div class="notice notice-error"><p>' . esc_html__( 'Celestial icons require WordPress 7.1 or newer with the Icon Registration API.', 'celestial' ) . '</p></div>';
	}
}
add_action( 'admin_notices', 'celestial_lucide_icons_compatibility_notice' );
