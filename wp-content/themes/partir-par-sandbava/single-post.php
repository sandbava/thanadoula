<?php
/**
 * Modèle d’un article individuel.
 */

get_header();

while ( have_posts() ) :
    the_post();

    $event_slugs = [ 'mes-evenements' ];
    $entry_type  = has_category( $event_slugs ) ? 'event' : 'article';

    get_template_part( 'template-parts/single-entry', null, [ 'entry_type' => $entry_type ] );
endwhile;

get_template_part(
    'template-parts/page-cta',
    null,
    [
        'show_featured'  => false,
        'divider_variant' => $entry_type,
    ]
);
get_footer();
