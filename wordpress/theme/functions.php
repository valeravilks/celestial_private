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
