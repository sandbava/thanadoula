<?php
$divider_variant = $args['divider_variant'] ?? 'page';
$section_classes  = 'sale-content section-divider-host';

if ( $args['compact_top_spacing'] ?? false ) {
    $section_classes .= ' sale-content--compact-top';
}
?>
<section class="<?php echo esc_attr( $section_classes ); ?>">
    <?php if ( $args['show_top_divider'] ?? true ) : ?>
    <div class="sale-top-divider sale-top-divider--<?php echo esc_attr( $divider_variant ); ?>" aria-hidden="true">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <?php if ( 'article' === $divider_variant ) : ?>
                <path d="M0 0H1200V45C1000 120 800 0 600 55S200 120 0 45Z" class="shape-fill"></path>
            <?php elseif ( 'event' === $divider_variant ) : ?>
                <path d="M0 0H1200V30L760 115 420 55 0 105Z" class="shape-fill"></path>
            <?php else : ?>
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120Z" class="shape-fill"></path>
            <?php endif; ?>
        </svg>
    </div>
    <?php endif; ?>

    <div class="sale-content-inner">
        <h2>Vous souhaitez en parler&nbsp;?</h2>
        <p>
            Je vous propose un premier échange confidentiel et sans engagement
            pour écouter votre situation et répondre à vos questions.
        </p>

        <div id="sale-cta">
            <a id="hero-cta-contact" class="btn" href="<?php echo esc_url( get_permalink( get_page_by_path( 'prendre-contact' ) ) ); ?>">Prendre contact</a>
            <a id="hero-cta-discover" class="btn" href="<?php echo esc_url( get_permalink( get_page_by_path( 'prestation-et-tarifs' ) ) ); ?>">Découvrir mon accompagnement</a>
        </div>
    </div>

    <?php if ( ( $args['show_featured'] ?? true ) && has_post_thumbnail() ) : ?>
        <div class="page-featured-image">
            <?php the_post_thumbnail( 'large' ); ?>
        </div>
    <?php endif; ?>

    <?php get_template_part( 'template-parts/section-divider' ); ?>
</section>
