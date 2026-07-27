

<?php get_header(); ?>
    <header>
        <div id="navigation">
            <div class="brand">
                <div class="brand-col brand-logo">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo_arbre_tao.png'); ?>"
                         alt="Logo">
                </div>
                <div class="brand-col brand-text">
                    <h1>Sylvie Albouze, Thanadoula.</h1>
                    <h2>Accompagnement de fin de vie.</h2>
                </div>
            </div>
            <div class="navigation-actions">
                <a class="navigation-contact" href="#contact">Prendre contact</a>
                <details class="navigation-menu">
                    <summary aria-label="Ouvrir le menu de navigation">
                        <span>Menu</span>
                        <span class="menu-icon" aria-hidden="true"></span>
                    </summary>
                    <nav aria-label="Navigation principale">
                        <ul class="main-menu">
                            <li class="has-submenu">
                                <details>
                                    <summary>Ma pratique</summary>
                                    <ul class="sub-menu">
                                        <li><a href="#qui-suis-je">Qui suis-je ?</a></li>
                                        <li><a href="#cheminement">Mon cheminement</a></li>
                                        <li><a href="#activite">Mon activité</a></li>
                                    </ul>
                                </details>
                            </li>
                            <li><a href="#prestations-et-tarifs">Prestations et tarifs</a></li>
                            <li><a href="#articles">Articles</a></li>
                            <li><a href="#evenements">Événements</a></li>
                            <li><a href="#questions-frequentes">Questions fréquentes</a></li>
                        </ul>
                    </nav>
                </details>
            </div>
        </div>
        <div id="hero">
            <div class="hero-col" id="value-proposition">
                <h1 id="title">Honorer la vie jusqu'à son dernier souffle.</h1>
                <h2 id="subtitle">
                    J'accompagne les personnes en fin de vie et leurs proches<br>
                    pour vivre cette transition avec présence, sens et douceur.
                </h2>
                <div id="hero-cta">
                    <a id="hero-cta-contact" class="btn" href="#">Prendre contact</a>
                    <a id="hero-cta-discover" class="btn" href="#">Découvrir mon accompagnement</a>
                </div>

            </div>
            <div class="hero-col">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/sylvie_portrait.jpg'); ?>"
                     alt="Sylvie">
            </div>
        </div>
    </header>

    <main>
        <section id="book" aria-label="À propos de Sylvie Albouze et du terme thanadoula">
            <div id="left-page" class="page">
                <h2>A propos</h2>
                <p>Après 36 ans de pratique infirmière, un traumatisme m'a donné l'opportunité de repenser le "prendre soin" en privilégiant le savoir-être au savoir faire.</p>
                <p>Aujourd'hui, j'ai envie de ramener du lien, de la paix entre mourants et vivants, entre soignés et soignants, à la maison comme en établissement d'accueil, que ce lieu si particulier, reste celui ou il fait bon vivre... jusqu'au bout.</p>
            </div>
            <div id="right-page" class="page">
                <h2>Thanadoula ?</h2>
                <p>Depuis la Grèce Antique, du 1er cri au dernier soupir, les doulas sont les femmes au service de la vie, celles qui, au sein de la communauté et au coeur de l'humanité la plus vulnérable mais aussi la plus profonde et la plus authentique, accueillent et soutiennent.</p>
                <p>La "death-doula" apparaît aux Etats-Unis en 2003, le métier s'est développé en Angleterre, Canada, Australie, Mexique, Belgique, Suisse.</p>
            </div>
            <div class="book-shape-divider" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M602.45,3.86h0S572.9,116.24,281.94,120H923C632,116.24,602.45,3.86,602.45,3.86Z"></path>
                </svg>
            </div>
            <span class="book-medallion" aria-hidden="true"></span>
        </section>

    </main>

<?php get_footer(); ?>
