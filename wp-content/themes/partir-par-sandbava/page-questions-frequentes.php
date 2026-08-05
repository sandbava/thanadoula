<?php
/**
 * Template Name: Questions fréquentes
 * Template Post Type: page
 */

get_header();

$faq_status = isset( $_GET['faq_status'] ) ? sanitize_key( wp_unslash( $_GET['faq_status'] ) ) : '';
$faq_query  = new WP_Query(
    [
        'post_type'      => 'faq',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => [
            'menu_order' => 'ASC',
            'title'      => 'ASC',
        ],
    ]
);
?>
    <main class="faq-page">
        <header class="faq-page-header">
            <h1><?php the_title(); ?></h1>
            <?php if ( trim( get_the_content() ) ) : ?>
                <div class="faq-page-introduction"><?php the_content(); ?></div>
            <?php endif; ?>
        </header>

        <section class="faq-list" aria-labelledby="faq-list-title">
            <h2 id="faq-list-title" class="screen-reader-text">Questions et réponses</h2>

            <?php if ( $faq_query->have_posts() ) : ?>
                <?php while ( $faq_query->have_posts() ) : $faq_query->the_post(); ?>
                    <details class="faq-item">
                        <summary><?php the_title(); ?></summary>
                        <div class="faq-answer"><?php the_content(); ?></div>
                    </details>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="faq-empty-state">Les premières réponses seront bientôt disponibles.</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </section>

        <section class="faq-submission" id="poser-une-question" aria-labelledby="faq-form-title">
            <div class="faq-submission-heading">
                <p class="faq-eyebrow">Une question reste sans réponse&nbsp;?</p>
                <h2 id="faq-form-title">Posez votre question</h2>
                <p>Votre question sera relue avant publication. Votre nom et votre adresse e-mail resteront confidentiels.</p>
            </div>

            <?php if ( 'success' === $faq_status ) : ?>
                <p class="contact-notice contact-notice--success" role="status">Merci. Votre question a bien été transmise et sera examinée prochainement.</p>
            <?php elseif ( 'too-many' === $faq_status ) : ?>
                <p class="contact-notice contact-notice--error" role="alert">Une question vient déjà d’être envoyée avec cette adresse. Veuillez patienter avant de recommencer.</p>
            <?php elseif ( in_array( $faq_status, [ 'invalid', 'error' ], true ) ) : ?>
                <p class="contact-notice contact-notice--error" role="alert">La question n’a pas pu être envoyée. Vérifiez les champs puis réessayez.</p>
            <?php endif; ?>

            <form class="faq-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <input type="hidden" name="action" value="thanadoula_faq">
                <input type="hidden" name="faq_page_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
                <?php wp_nonce_field( 'thanadoula_faq_form', 'faq_nonce' ); ?>

                <div class="faq-form-field">
                    <label for="faq-name">Nom <span class="field-optional">(facultatif)</span></label>
                    <input id="faq-name" name="faq_name" type="text" autocomplete="name">
                </div>

                <div class="faq-form-field">
                    <label for="faq-email">Adresse e-mail <span aria-hidden="true">*</span></label>
                    <input id="faq-email" name="faq_email" type="email" autocomplete="email" required>
                </div>

                <div class="faq-form-field faq-form-field--full">
                    <label for="faq-question">Votre question <span aria-hidden="true">*</span></label>
                    <textarea id="faq-question" name="faq_question" rows="6" minlength="10" maxlength="1000" required></textarea>
                </div>

                <div class="contact-honeypot" aria-hidden="true">
                    <label for="faq-website">Site internet</label>
                    <input id="faq-website" name="website" type="text" tabindex="-1" autocomplete="off">
                </div>

                <label class="faq-consent faq-form-field--full">
                    <input name="faq_consent" type="checkbox" value="1" required>
                    <span>J’accepte que ces informations soient utilisées pour traiter ma question. <span aria-hidden="true">*</span></span>
                </label>

                <div class="faq-form-submit faq-form-field--full">
                    <button class="btn" type="submit">Envoyer ma question</button>
                </div>
            </form>
        </section>
    </main>
<?php get_footer(); ?>
