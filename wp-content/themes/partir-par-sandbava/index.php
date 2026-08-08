<?php
$about_page    = get_page_by_path( 'qui-suis-je' );
$activity_page = get_page_by_path( 'mon-activite' );
$about_url     = $about_page ? get_permalink( $about_page ) : home_url( '/qui-suis-je/' );
$activity_url  = $activity_page ? get_permalink( $activity_page ) : home_url( '/mon-activite/' );

get_header();
?>
        <div id="hero">
            <div class="hero-col" id="value-proposition">
                <h1 id="title">Honorer la vie jusqu'à son dernier souffle.</h1>
                <h2 id="subtitle">
                    J'accompagne les personnes en fin de vie et leurs proches<br>
                    pour vivre cette transition avec présence, sens et douceur.
                </h2>
                <div id="hero-cta">
                    <a id="hero-cta-contact" class="btn" href="<?php echo esc_url(
                            get_permalink( get_page_by_path( 'prendre-contact' ) )
                    ); ?>">Prendre contact</a>
                    <a id="hero-cta-discover" class="btn" href="<?php echo esc_url(
                            get_permalink( get_page_by_path( 'prestations-et-tarifs' ) )
                    ); ?>">Découvrir mon accompagnement</a>
                </div>

            </div>
            <div class="hero-col">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/sylvie_portrait.jpg'); ?>"
                     alt="Sylvie">
            </div>
        </div>

    <div id="book-wrapper">
        <section id="book" class="section-divider-host" aria-label="À propos de Sylvie Albouze et du terme thanadoula">
            <div id="left-page" class="book-page">
                <h2>A propos</h2>
                <p>Après 36 ans de pratique infirmière, un traumatisme m'a donné l'opportunité de repenser le "prendre soin" en privilégiant le savoir-être au savoir faire.</p>
                <p>Aujourd'hui, j'ai envie de ramener du lien, de la paix entre mourants et vivants, entre soignés et soignants, à la maison comme en établissement d'accueil, que ce lieu si particulier, reste celui ou il fait bon vivre... jusqu'au bout.</p>
                <a class="book-page-link" href="<?php echo esc_url( $about_url ); ?>">Qui suis-je ?</a>
            </div>
            <div id="right-page" class="book-page">
                <h2>Thanadoula ?</h2>
                <p>Depuis la Grèce Antique, du 1er cri au dernier soupir, les doulas sont les femmes au service de la vie, celles qui, au sein de la communauté et au coeur de l'humanité la plus vulnérable mais aussi la plus profonde et la plus authentique, accueillent et soutiennent.</p>
                <p>La "death-doula" apparaît aux Etats-Unis en 2003, le métier s'est développé en Angleterre, Canada, Australie, Mexique, Belgique, Suisse.</p>
                <a class="book-page-link" href="<?php echo esc_url( $activity_url ); ?>">Mon activité</a>
            </div>
            <?php get_template_part( 'template-parts/section-divider' ); ?>
        </section>
    </div>
<?php get_footer(); ?>
