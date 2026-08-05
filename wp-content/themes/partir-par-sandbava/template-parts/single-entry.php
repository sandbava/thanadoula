<?php
$is_event = ( $args['entry_type'] ?? 'article' ) === 'event';
$label    = $is_event ? 'Événement' : 'Article';
?>
<main class="single-entry-page">
    <article <?php post_class( 'single-entry' ); ?>>
        <header class="single-entry-header">
            <p class="single-entry-type"><?php echo esc_html( $label ); ?></p>
            <h1><?php the_title(); ?></h1>
            <?php if ( $is_event ) : ?>
                <?php get_template_part( 'template-parts/event-details', null, [ 'show_registration' => true ] ); ?>
            <?php else : ?>
                <p class="single-entry-meta"><?php echo esc_html( get_the_date() ); ?></p>
            <?php endif; ?>
        </header>

        <figure class="single-entry-image">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large' ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/barque.jpg' ); ?>" alt="" loading="lazy">
            <?php endif; ?>
        </figure>

        <div class="single-entry-content">
            <?php the_content(); ?>
        </div>

        <?php
        wp_link_pages(
            [
                'before' => '<nav class="single-entry-pages" aria-label="Pages du contenu">',
                'after'  => '</nav>',
            ]
        );
        ?>

        <nav class="single-entry-navigation" aria-label="Navigation entre les publications">
            <div class="single-entry-previous"><?php previous_post_link( '%link', '← %title' ); ?></div>
            <div class="single-entry-next"><?php next_post_link( '%link', '%title →' ); ?></div>
        </nav>
    </article>
</main>
