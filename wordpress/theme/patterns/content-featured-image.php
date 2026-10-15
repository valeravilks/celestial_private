<?php
/**
 * Title: Content: крупное изображение и пояснение
 * Slug: celestial/content-featured-image
 * Categories: features
 * Inserter: true
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface","textColor":"contrast","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained"},"templateLock":"contentOnly"} -->
<section class="wp-block-group alignfull has-contrast-color has-surface-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group">
<!-- wp:paragraph {"className":"is-style-subtitle"} -->
<p class="is-style-subtitle">Общий взгляд</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Результат, в котором всё связано</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"default"}} -->
<div class="wp-block-group">
<!-- wp:image {"className":"furniture-demo-media","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full furniture-demo-media"><img src="<?php echo esc_url( get_theme_file_uri() ); ?>/assets/images/furniture-demo/kitchen-main.jpg" alt="Интерьер кухни с встроенной мебелью"/></figure>
<!-- /wp:image -->
<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Цельная картина</h3>
<!-- /wp:heading -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:paragraph -->
<p>В этом демонстрационном изображении можно оценить пропорции, сочетание поверхностей и ритм линий. В проекте здесь будет фотография вашего продукта или пространства.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
