<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
        <!-- Matomo -->
        <script>
            var _paq = window._paq = window._paq || [];
            /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                var u="//matomo.sandbava.fr/";
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', '5']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
        <!-- End Matomo Code -->
    </head>

    <body <?php body_class(); ?>>
        <div class="container content">
            <header class="site-header">
                <div id="navigation">
                    <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Retour à l’accueil">
                        <div class="brand-col brand-logo">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo_arbre_tao.png'); ?>"
                                 alt="Logo">
                        </div>
                        <div class="brand-col brand-text">
                            <h1>Sylvie Albouze, Thanadoula.</h1>
                            <h2>Accompagnement de fin de vie.</h2>
                        </div>
                    </a>
                    <div class="navigation-actions">
                        <?php $contact_page = get_page_by_path( 'prendre-contact' ); ?>
                        <a
                            class="navigation-contact"
                            href="<?php echo esc_url(
                                    $contact_page
                                            ? get_permalink( $contact_page )
                                            : home_url( '/prendre-contact/' )
                            ); ?>"
                        >
                            Prendre contact
                        </a>
                        <details class="navigation-menu">
                            <summary aria-label="Ouvrir le menu de navigation">
                                <span>Menu</span>
                                <span class="menu-icon" aria-hidden="true"></span>
                            </summary>
                            <nav aria-label="Navigation principale">
                                <?php
                                wp_nav_menu(
                                    [
                                        'theme_location' => 'principal',
                                        'container'      => false,
                                        'menu_class'     => 'main-menu',
                                        'fallback_cb'    => false,
                                        'depth'          => 2,
                                    ]
                                );
                                ?>
                            </nav>
                        </details>
                    </div>
                </div>
            </header>
