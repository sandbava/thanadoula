<?php
/**
 * Template Name: Liste des événements
 * Template Post Type: page
 */

get_header();

$paged = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );

$query_args = [
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'category_name'       => 'mes-evenements',
    'meta_key'            => 'event_date',
    'orderby'             => 'meta_value_num',
    'order'               => 'ASC',
    'posts_per_page'      => 6,
    'paged'               => $paged,
    'ignore_sticky_posts' => true,
];

$events_query = new WP_Query( $query_args );
?>
    <main class="listing-page">
        <h1 class="text-align-center"><?php the_title(); ?></h1>

        <?php if ( trim( get_the_content() ) ) : ?>
            <div class="listing-introduction"><?php the_content(); ?></div>
        <?php endif; ?>

        <?php if ( $events_query->have_posts() ) : ?>
            <div class="listing-grid listing-grid--count-<?php echo esc_attr( min( 3, $events_query->post_count ) ); ?>">
                <?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
                    <?php get_template_part( 'template-parts/listing-card', null, [ 'link_label' => 'Découvrir', 'is_event' => true ] ); ?>
                <?php endwhile; ?>
            </div>

            <nav class="listing-pagination" aria-label="Pagination des événements">
                <?php
                echo wp_kses_post(
                    paginate_links(
                        [
                            'current'   => $paged,
                            'total'     => $events_query->max_num_pages,
                            'mid_size'  => 1,
                            'prev_text' => '← Précédent',
                            'next_text' => 'Suivant →',
                        ]
                    ) ?: ''
                );
                ?>
            </nav>
        <?php else : ?>
            <p class="listing-empty-state">Aucun événement n’est actuellement programmé.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </main>

    <?php get_template_part( 'template-parts/page-cta' ); ?>
<?php get_footer(); ?>
