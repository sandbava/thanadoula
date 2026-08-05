<?php
$fallback_image = get_template_directory_uri() . '/assets/images/barque.jpg';
$link_label     = $args['link_label'] ?? 'Découvrir';
$is_event       = $args['is_event'] ?? false;
?>
<article <?php post_class( 'footer-card listing-card' ); ?>>
    <a class="footer-card-image" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy' ] ); ?>
        <?php else : ?>
            <img src="<?php echo esc_url( $fallback_image ); ?>" alt="" loading="lazy">
        <?php endif; ?>
    </a>
    <div class="footer-card-body">
        <?php if ( $is_event ) : ?>
            <?php get_template_part( 'template-parts/event-details' ); ?>
        <?php else : ?>
            <p class="footer-card-meta"><?php echo esc_html( get_the_date() ); ?></p>
        <?php endif; ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="footer-card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
        <a class="footer-card-link" href="<?php the_permalink(); ?>"><?php echo esc_html( $link_label ); ?> <span aria-hidden="true">→</span></a>
    </div>
</article>
