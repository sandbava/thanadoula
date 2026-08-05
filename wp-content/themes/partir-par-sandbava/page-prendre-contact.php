<?php
/**
 * Template Name: Prendre contact
 * Template Post Type: page
 */

get_header();

$contact_status = isset( $_GET['contact_status'] ) ? sanitize_key( wp_unslash( $_GET['contact_status'] ) ) : '';
?>
    <main class="contact-page">
        <header class="contact-page-header">
            <h1><?php the_title(); ?></h1>
            <?php if ( trim( get_the_content() ) ) : ?>
                <div class="contact-page-introduction"><?php the_content(); ?></div>
            <?php endif; ?>
        </header>

        <div class="contact-form-card" id="contact-form">
            <?php if ( 'success' === $contact_status ) : ?>
                <p class="contact-notice contact-notice--success" role="status">Merci pour votre message. Je vous répondrai dans les meilleurs délais.</p>
            <?php elseif ( 'send-error' === $contact_status ) : ?>
                <p class="contact-notice contact-notice--error" role="alert">Le message n’a pas pu être envoyé. Veuillez réessayer ou utiliser directement l’adresse de contact du site.</p>
            <?php elseif ( 'invalid' === $contact_status ) : ?>
                <p class="contact-notice contact-notice--error" role="alert">Certains champs sont invalides ou incomplets. Vérifiez le formulaire puis réessayez.</p>
            <?php endif; ?>

            <form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <input type="hidden" name="action" value="thanadoula_contact">
                <input type="hidden" name="contact_page_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
                <?php wp_nonce_field( 'thanadoula_contact_form', 'contact_nonce' ); ?>

                <div class="contact-form-field">
                    <label for="contact-name">Nom et prénom <span aria-hidden="true">*</span></label>
                    <input id="contact-name" name="contact_name" type="text" autocomplete="name" required>
                </div>

                <div class="contact-form-field">
                    <label for="contact-email">Adresse e-mail <span aria-hidden="true">*</span></label>
                    <input id="contact-email" name="contact_email" type="email" autocomplete="email" required>
                </div>

                <div class="contact-form-field">
                    <label for="contact-phone">Téléphone <span class="field-optional">(facultatif)</span></label>
                    <input id="contact-phone" name="contact_phone" type="tel" autocomplete="tel">
                </div>

                <div class="contact-form-field">
                    <label for="contact-reason">Objet de votre demande</label>
                    <select id="contact-reason" name="contact_reason">
                        <option value="Premier échange">Premier échange</option>
                        <option value="Accompagnement">Accompagnement</option>
                        <option value="Événement">Événement</option>
                        <option value="Autre demande">Autre demande</option>
                    </select>
                </div>

                <div class="contact-form-field contact-form-field--full">
                    <label for="contact-message">Votre message <span aria-hidden="true">*</span></label>
                    <textarea id="contact-message" name="contact_message" rows="8" minlength="20" required></textarea>
                    <p class="contact-field-help">Décrivez simplement votre situation et la manière dont vous souhaitez être recontacté·e.</p>
                </div>

                <div class="contact-honeypot" aria-hidden="true">
                    <label for="contact-website">Site internet</label>
                    <input id="contact-website" name="website" type="text" tabindex="-1" autocomplete="off">
                </div>

                <label class="contact-consent contact-form-field--full">
                    <input name="contact_consent" type="checkbox" value="1" required>
                    <span>J’accepte que mes informations soient utilisées uniquement pour répondre à ma demande. <span aria-hidden="true">*</span></span>
                </label>

                <div class="contact-form-submit contact-form-field--full">
                    <button class="btn" type="submit">Envoyer mon message</button>
                    <p><span aria-hidden="true">*</span> Champs obligatoires</p>
                </div>
            </form>
        </div>
    </main>
    <div class="custom-shape-divider-top-1785891292" aria-hidden="true">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
<?php get_footer(); ?>
