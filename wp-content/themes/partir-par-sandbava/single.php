<?php
/**
 * Modèle d’un événement ou d’un autre contenu individuel.
 */

get_header();

while ( have_posts() ) :
    the_post();

    $event_post_types = [ 'event', 'events', 'evenement', 'evenements' ];
    $entry_type       = in_array( get_post_type(), $event_post_types, true ) ? 'event' : 'article';

    get_template_part( 'template-parts/single-entry', null, [ 'entry_type' => $entry_type ] );
endwhile;

get_template_part(
    'template-parts/page-cta',
    null,
    [
        'show_featured'   => false,
        'divider_variant' => $entry_type,
    ]
);
get_footer();
