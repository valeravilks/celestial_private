<?php
/** Use an explicitly supplied excerpt as the singular page description. */
defined( 'ABSPATH' ) || exit;
function celestial_output_page_description(): void {
	if ( ! is_singular() ) { return; }
	$post = get_queried_object();
	if ( ! $post instanceof WP_Post || post_password_required( $post ) || '' === trim( $post->post_excerpt ) ) { return; }
	echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $post->post_excerpt ) ) . '">' . "\n";
}
add_action( 'wp_head', 'celestial_output_page_description', 2 );
