<?php
/** Server-rendered navigation, without frontend JavaScript. */
defined( 'ABSPATH' ) || exit;
$post_id = (int) ( $block->context['postId'] ?? get_the_ID() );
$post = get_post( $post_id );
if ( ! $post || ( ! current_user_can( 'read_post', $post_id ) && ! is_post_publicly_viewable( $post ) ) || post_password_required( $post ) ) {
	return;
}
$items = celestial_toc_prepare( $post->post_content, $post_id )['items'];
if ( ! $items ) {
	return;
}
?>
<nav <?php echo get_block_wrapper_attributes( array( 'aria-label' => __( 'Оглавление', 'celestial' ) ) ); ?>>
	<p class="celestial-toc__title"><?php esc_html_e( 'На этой странице', 'celestial' ); ?></p>
	<ul class="celestial-toc__list">
		<?php foreach ( $items as $item ) : ?>
			<li class="celestial-toc__item celestial-toc__item--level-<?php echo (int) $item['level']; ?>"><a href="#<?php echo esc_attr( rawurlencode( $item['id'] ) ); ?>"><?php echo esc_html( $item['text'] ); ?></a></li>
		<?php endforeach; ?>
	</ul>
</nav>
