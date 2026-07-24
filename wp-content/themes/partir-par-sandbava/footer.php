<?php
/**
 * Pied de page du thème.
 *
 * @package partir-par-sandbava
 */

$footer_fallback_image = get_template_directory_uri() . '/assets/images/barque.jpg';

// Utilise le type de contenu événement fourni par le site, s'il existe.
$event_post_type = '';
foreach ( [ 'event', 'events', 'evenement', 'evenements' ] as $post_type ) {
    if ( post_type_exists( $post_type ) ) {
        $event_post_type = $post_type;
        break;
    }
}

$event_query_args = [
    'posts_per_page'      => 3,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
];

if ( $event_post_type ) {
    $event_query_args['post_type'] = $event_post_type;
} else {
    // Repli pratique pour un site qui classe ses événements comme articles.
    $event_query_args['post_type'] = 'post';
    $event_query_args['tax_query'] = [
        [
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => [ 'evenements', 'evenement', 'events', 'event' ],
            'operator' => 'IN',
        ],
    ];
}

$events_query = new WP_Query( $event_query_args );

$event_category_ids = get_terms(
    [
        'taxonomy'   => 'category',
        'slug'       => [ 'evenements', 'evenement', 'events', 'event' ],
        'fields'     => 'ids',
        'hide_empty' => false,
    ]
);

$article_query_args = [
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
];

if ( ! is_wp_error( $event_category_ids ) && $event_category_ids ) {
    $article_query_args['category__not_in'] = $event_category_ids;
}

$articles_query = new WP_Query( $article_query_args );
?>

        <footer class="site-footer">
            <div class="footer-inner">
                <section class="footer-content-section events" aria-labelledby="footer-events-title">
                    <div class="footer-section-heading">
                        <p class="footer-eyebrow">À vivre ensemble</p>
                        <h2 id="footer-events-title">Les événements</h2>
                    </div>

                    <?php if ( $events_query->have_posts() ) : ?>
                        <div class="footer-card-grid">
                            <?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
                                <article <?php post_class( 'footer-card' ); ?>>
                                    <a class="footer-card-image" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy' ] ); ?>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url( $footer_fallback_image ); ?>" alt="" loading="lazy">
                                        <?php endif; ?>
                                    </a>
                                    <div class="footer-card-body">
                                        <p class="footer-card-meta"><?php echo esc_html( get_the_date() ); ?></p>
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <p class="footer-card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?></p>
                                        <a class="footer-card-link" href="<?php the_permalink(); ?>">Découvrir <span aria-hidden="true">→</span></a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <p class="footer-empty-state">Les prochains rendez-vous seront bientôt annoncés.</p>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </section>

                <section class="footer-content-section articles" aria-labelledby="footer-articles-title">
                    <div class="footer-section-heading">
                        <p class="footer-eyebrow">À lire et à partager</p>
                        <h2 id="footer-articles-title">Derniers articles</h2>
                    </div>

                    <?php if ( $articles_query->have_posts() ) : ?>
                        <div class="footer-card-grid">
                            <?php while ( $articles_query->have_posts() ) : $articles_query->the_post(); ?>
                                <article <?php post_class( 'footer-card' ); ?>>
                                    <a class="footer-card-image" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy' ] ); ?>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url( $footer_fallback_image ); ?>" alt="" loading="lazy">
                                        <?php endif; ?>
                                    </a>
                                    <div class="footer-card-body">
                                        <p class="footer-card-meta"><?php echo esc_html( get_the_date() ); ?></p>
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <p class="footer-card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?></p>
                                        <a class="footer-card-link" href="<?php the_permalink(); ?>">Lire l’article <span aria-hidden="true">→</span></a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <p class="footer-empty-state">De nouveaux articles arrivent prochainement.</p>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </section>
            </div>

            <section class="credits">
                <p>© <?php echo esc_html( wp_date( 'Y' ) ); ?> Sylvie Albouze · Création <a href="https://www.sandbava.fr">Agence SANDBAVA</a></p>
            </section>
        </footer>
    </div><!-- fin de la div.container.content -->
    <?php wp_footer(); ?>

    </body>
</html>
