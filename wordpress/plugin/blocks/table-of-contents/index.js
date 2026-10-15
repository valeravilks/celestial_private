import { registerBlockType, parse } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import metadata from './block.json';

function Edit( { context } ) {
	const content = useSelect( ( select ) => {
		const editor = select( 'core/editor' );
		if ( editor?.getCurrentPostId?.() === context.postId ) {
			return editor.getEditedPostContent();
		}
		const post = select( 'core' ).getEntityRecord( 'postType', context.postType || 'post', context.postId );
		return post?.content?.raw || '';
	}, [ context.postId, context.postType ] );
	const headings = [];
	function walk( blocks ) {
		for ( const block of blocks ) {
			const level = block.attributes.level || 2;
			if ( block.name === 'core/heading' && level >= 2 && level <= 3 ) {
				const doc = new DOMParser().parseFromString( block.attributes.content || '', 'text/html' );
				const text = doc.body.textContent.trim();
				if ( text ) headings.push( { text, level } );
			}
			walk( block.innerBlocks || [] );
		}
	}
	walk( parse( content || '' ) );
	return <nav { ...useBlockProps( { 'aria-label': 'Оглавление' } ) }>
		<p className="celestial-toc__title">На этой странице</p>
		{ headings.length ? <ul className="celestial-toc__list">{ headings.map( ( item, i ) =>
			<li key={ i } className={ `celestial-toc__item celestial-toc__item--level-${ item.level }` }>{ item.text }</li>
		) }</ul> : <p>Оглавление появится, когда в записи будут заголовки H2 и H3.</p> }
	</nav>;
}
registerBlockType( metadata.name, { edit: Edit, save: () => null } );
