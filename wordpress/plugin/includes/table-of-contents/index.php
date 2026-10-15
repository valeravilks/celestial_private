<?php
/** Heading extraction and runtime anchors for the Table of Contents block. */
defined( 'ABSPATH' ) || exit;

/** Prepare the same heading IDs for both the navigation and rendered content. */
function celestial_toc_prepare( string $content, int $post_id ): array {
	$blocks = parse_blocks( $content );
	$items = array();
	$used = array();
	$collect = function ( array $nodes ) use ( &$collect, &$used ): void {
		foreach ( $nodes as $node ) {
			if ( ! empty( $node['attrs']['anchor'] ) ) {
				$used[ $node['attrs']['anchor'] ] = true;
			}
			$collect( $node['innerBlocks'] ?? array() );
		}
	};
	$collect( $blocks );
	$index = 0;
	$walk = function ( array &$nodes ) use ( &$walk, &$items, &$used, &$index, $post_id ): void {
		foreach ( $nodes as &$node ) {
			$walk( $node['innerBlocks'] );
			if ( 'core/heading' !== $node['blockName'] ) {
				continue;
			}
			$level = (int) ( $node['attrs']['level'] ?? 2 );
			if ( $level < 2 || $level > 3 ) {
				continue;
			}
			$text = trim( html_entity_decode( wp_strip_all_tags( $node['innerHTML'] ), ENT_QUOTES, 'UTF-8' ) );
			if ( '' === $text ) {
				continue;
			}
			$id = $node['attrs']['anchor'] ?? '';
			if ( '' === $id ) {
				do {
					$id = 'celestial-toc-' . $post_id . '-' . ++$index;
				} while ( isset( $used[ $id ] ) );
				$used[ $id ] = true;
				$node['attrs']['anchor'] = $id;
				$processor = new WP_HTML_Tag_Processor( $node['innerHTML'] );
				if ( $processor->next_tag() ) {
					$processor->set_attribute( 'id', $id );
					$node['innerHTML'] = $processor->get_updated_html();
					$node['innerContent'] = array( $node['innerHTML'] );
				}
			}
			$items[] = array( 'id' => $id, 'text' => $text, 'level' => $level );
		}
	};
	$walk( $blocks );
	return array( 'content' => serialize_blocks( $blocks ), 'items' => $items );
}

/** Only add anchors when the current single post actually uses the TOC block. */
function celestial_toc_content_anchors( string $content ): string {
	if ( ! is_singular() || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$post_id = get_the_ID();
	$template = get_block_template( get_stylesheet() . '//single', 'wp_template' );
	$part = get_block_template( get_stylesheet() . '//content-single', 'wp_template_part' );
	$has_toc = has_block( 'celestial/table-of-contents', $content )
		|| ( $template && has_block( 'celestial/table-of-contents', $template->content ) )
		|| ( $part && has_block( 'celestial/table-of-contents', $part->content ) );
	if ( ! $has_toc ) {
		return $content;
	}
	return celestial_toc_prepare( $content, $post_id )['content'];
}
add_filter( 'the_content', 'celestial_toc_content_anchors', 8 );
