<?php
/**
 * Pied de page du thème.
 *
 * @package partir-par-sandbava
 */

$footer_fallback_image = get_template_directory_uri() . '/assets/images/barque.jpg';
$events_page           = get_page_by_path( 'evenements' );
$articles_page         = get_page_by_path( 'articles' );
$events_page_url       = $events_page ? get_permalink( $events_page ) : home_url( '/evenements/' );
$articles_page_url     = $articles_page ? get_permalink( $articles_page ) : home_url( '/articles/' );

$event_query_args = [
    'post_type'           => 'post',
    'category_name'       => 'mes-evenements',
    'meta_key'            => 'event_date',
    'orderby'             => 'meta_value_num',
    'order'               => 'ASC',
    'posts_per_page'      => 3,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
];

$events_query = new WP_Query( $event_query_args );

$article_query_args = [
    'post_type'           => 'post',
    'category_name'       => 'mes-articles',
    'posts_per_page'      => 3,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
];

$articles_query = new WP_Query( $article_query_args );
?>

        <footer class="site-footer">
            <div class="footer-inner">
                <section class="footer-content-section events" aria-labelledby="footer-events-title">
                    <div class="footer-section-heading">
                        <p class="footer-eyebrow">À vivre ensemble</p>
                        <div class="footer-heading-row">
                            <h2 id="footer-events-title">Les événements</h2>
                        </div>
                    </div>

                    <?php if ( $events_query->have_posts() ) : ?>
                        <div class="footer-card-grid footer-card-grid--count-<?php echo esc_attr( min( 3, $events_query->post_count ) ); ?>">
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
                                        <?php get_template_part( 'template-parts/event-details' ); ?>
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <p class="footer-card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?></p>
                                        <a class="footer-card-link" href="<?php the_permalink(); ?>">Découvrir <span aria-hidden="true">→</span></a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                        <?php if ( $events_query->found_posts > 3 ) : ?>
                            <p class="footer-section-link">
                                <a class="footer-all-link" href="<?php echo esc_url( $events_page_url ); ?>">Tous les événements <span aria-hidden="true">→</span></a>
                            </p>
                        <?php endif; ?>
                    <?php else : ?>
                        <p class="footer-empty-state">Les prochains rendez-vous seront bientôt annoncés.</p>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>

                </section>

                <section class="footer-content-section articles" aria-labelledby="footer-articles-title">
                    <div class="footer-section-heading">
                        <p class="footer-eyebrow">À lire et à partager</p>
                        <div class="footer-heading-row">
                            <h2 id="footer-articles-title">Derniers articles</h2>
                        </div>
                    </div>

                    <?php if ( $articles_query->have_posts() ) : ?>
                        <div class="footer-card-grid footer-card-grid--count-<?php echo esc_attr( min( 3, $articles_query->post_count ) ); ?>">
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
                        <?php if ( $articles_query->found_posts > 3 ) : ?>
                            <p class="footer-section-link">
                                <a class="footer-all-link" href="<?php echo esc_url( $articles_page_url ); ?>">Tous les articles <span aria-hidden="true">→</span></a>
                            </p>
                        <?php endif; ?>
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
