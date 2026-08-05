<?php

function mon_theme_assets() {

    wp_enqueue_style(
        'style',
        get_stylesheet_uri(),
        [],
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    wp_enqueue_script(
        'navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        [],
        filemtime( get_template_directory() . '/assets/js/navigation.js' ),
        true
    );

}

add_action(
    'wp_enqueue_scripts',
    'mon_theme_assets'
);

function mon_theme_setup(){

    add_theme_support( 'post-thumbnails' );

    register_nav_menus([
        'principal' => 'Menu principal'
    ]);

}

add_action(
    'after_setup_theme',
    'mon_theme_setup'
);

function thanadoula_format_event_time( $time ) {
    foreach ( [ 'H:i:s', 'H:i' ] as $format ) {
        $date = DateTimeImmutable::createFromFormat( '!' . $format, (string) $time );

        if ( $date ) {
            return $date->format( 'H\hi' );
        }
    }

    return (string) $time;
}

function thanadoula_get_event_details( $post_id = null ) {
    $post_id    = $post_id ?: get_the_ID();
    $date_value = (string) get_post_meta( $post_id, 'event_date', true );
    $date       = DateTimeImmutable::createFromFormat( '!Ymd', $date_value );

    return [
        'date'             => $date ? wp_date( 'l j F Y', $date->getTimestamp() ) : '',
        'datetime'         => $date ? $date->format( 'Y-m-d' ) : '',
        'start_time'       => thanadoula_format_event_time( get_post_meta( $post_id, 'event_start_time', true ) ),
        'end_time'         => thanadoula_format_event_time( get_post_meta( $post_id, 'event_end_time', true ) ),
        'location'         => (string) get_post_meta( $post_id, 'event_location', true ),
        'registration_url' => (string) get_post_meta( $post_id, 'event_registration_url', true ),
    ];
}

function thanadoula_contact_redirect( $status, $page_id ) {
    $redirect_url = $page_id ? get_permalink( $page_id ) : home_url( '/prendre-contact/' );
    $redirect_url = add_query_arg( 'contact_status', $status, $redirect_url ) . '#contact-form';

    wp_safe_redirect( $redirect_url );
    exit;
}

function thanadoula_handle_contact_form() {
    $page_id = isset( $_POST['contact_page_id'] ) ? absint( $_POST['contact_page_id'] ) : 0;
    $nonce   = isset( $_POST['contact_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_nonce'] ) ) : '';

    if ( ! wp_verify_nonce( $nonce, 'thanadoula_contact_form' ) ) {
        thanadoula_contact_redirect( 'invalid', $page_id );
    }

    // Les robots remplissent souvent ce champ, invisible pour les visiteurs.
    if ( ! empty( $_POST['website'] ) ) {
        thanadoula_contact_redirect( 'success', $page_id );
    }

    $name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
    $email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
    $phone   = isset( $_POST['contact_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_phone'] ) ) : '';
    $reason  = isset( $_POST['contact_reason'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_reason'] ) ) : '';
    $message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';
    $consent = ! empty( $_POST['contact_consent'] );

    if ( ! $name || ! is_email( $email ) || strlen( $message ) < 20 || ! $consent ) {
        thanadoula_contact_redirect( 'invalid', $page_id );
    }

    $recipient = sanitize_email( get_option( 'admin_email' ) );
    $subject   = sprintf( 'Nouveau message – %s', $reason ?: 'Prise de contact' );
    $body      = implode(
        "\n",
        [
            'Nom : ' . $name,
            'E-mail : ' . $email,
            'Téléphone : ' . ( $phone ?: 'Non renseigné' ),
            'Motif : ' . ( $reason ?: 'Non renseigné' ),
            '',
            'Message :',
            $message,
        ]
    );

    $sent = wp_mail( $recipient, $subject, $body, [ 'Reply-To: ' . $email ] );

    thanadoula_contact_redirect( $sent ? 'success' : 'send-error', $page_id );
}

add_action( 'admin_post_nopriv_thanadoula_contact', 'thanadoula_handle_contact_form' );
add_action( 'admin_post_thanadoula_contact', 'thanadoula_handle_contact_form' );

function thanadoula_register_faq_post_type() {
    register_post_type(
        'faq',
        [
            'labels' => [
                'name'               => 'Questions fréquentes',
                'singular_name'      => 'Question fréquente',
                'add_new'            => 'Ajouter une question',
                'add_new_item'       => 'Ajouter une question',
                'edit_item'          => 'Répondre à la question',
                'new_item'           => 'Nouvelle question',
                'view_item'          => 'Voir la question',
                'search_items'       => 'Rechercher une question',
                'not_found'          => 'Aucune question trouvée',
                'menu_name'          => 'FAQ',
            ],
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'menu_icon'           => 'dashicons-editor-help',
            'supports'            => [ 'title', 'editor', 'page-attributes' ],
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'exclude_from_search' => true,
            'rewrite'             => false,
        ]
    );
}

add_action( 'init', 'thanadoula_register_faq_post_type' );

function thanadoula_faq_redirect( $status, $page_id ) {
    $redirect_url = $page_id ? get_permalink( $page_id ) : home_url( '/questions-frequentes/' );
    $redirect_url = add_query_arg( 'faq_status', $status, $redirect_url ) . '#poser-une-question';

    wp_safe_redirect( $redirect_url );
    exit;
}

function thanadoula_handle_faq_submission() {
    $page_id = isset( $_POST['faq_page_id'] ) ? absint( $_POST['faq_page_id'] ) : 0;
    $nonce   = isset( $_POST['faq_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['faq_nonce'] ) ) : '';

    if ( ! wp_verify_nonce( $nonce, 'thanadoula_faq_form' ) ) {
        thanadoula_faq_redirect( 'invalid', $page_id );
    }

    if ( ! empty( $_POST['website'] ) ) {
        thanadoula_faq_redirect( 'success', $page_id );
    }

    $name     = isset( $_POST['faq_name'] ) ? sanitize_text_field( wp_unslash( $_POST['faq_name'] ) ) : '';
    $email    = isset( $_POST['faq_email'] ) ? sanitize_email( wp_unslash( $_POST['faq_email'] ) ) : '';
    $question = isset( $_POST['faq_question'] ) ? sanitize_textarea_field( wp_unslash( $_POST['faq_question'] ) ) : '';
    $consent  = ! empty( $_POST['faq_consent'] );

    if ( ! is_email( $email ) || strlen( $question ) < 10 || strlen( $question ) > 1000 || ! $consent ) {
        thanadoula_faq_redirect( 'invalid', $page_id );
    }

    $rate_limit_key = 'faq_submission_' . md5( strtolower( $email ) );

    if ( get_transient( $rate_limit_key ) ) {
        thanadoula_faq_redirect( 'too-many', $page_id );
    }

    $faq_id = wp_insert_post(
        [
            'post_type'    => 'faq',
            'post_status'  => 'pending',
            'post_title'   => $question,
            'post_content' => '',
            'meta_input'   => [
                '_faq_submitter_name'  => $name,
                '_faq_submitter_email' => $email,
                '_faq_question'        => $question,
            ],
        ],
        true
    );

    if ( is_wp_error( $faq_id ) ) {
        thanadoula_faq_redirect( 'error', $page_id );
    }

    set_transient( $rate_limit_key, 1, MINUTE_IN_SECONDS );

    $recipient = sanitize_email( get_option( 'admin_email' ) );
    $body      = implode(
        "\n",
        [
            'Une nouvelle question attend votre validation.',
            '',
            'Nom : ' . ( $name ?: 'Non renseigné' ),
            'E-mail : ' . $email,
            'Question : ' . $question,
            '',
            'Répondre dans WordPress : ' . admin_url( 'post.php?post=' . $faq_id . '&action=edit' ),
        ]
    );

    wp_mail( $recipient, 'Nouvelle question pour la FAQ', $body, [ 'Reply-To: ' . $email ] );

    thanadoula_faq_redirect( 'success', $page_id );
}

add_action( 'admin_post_nopriv_thanadoula_faq', 'thanadoula_handle_faq_submission' );
add_action( 'admin_post_thanadoula_faq', 'thanadoula_handle_faq_submission' );

function thanadoula_add_faq_submitter_meta_box() {
    add_meta_box(
        'thanadoula-faq-submitter',
        'Informations de la personne',
        'thanadoula_render_faq_submitter_meta_box',
        'faq',
        'side',
        'default'
    );
}

add_action( 'add_meta_boxes_faq', 'thanadoula_add_faq_submitter_meta_box' );

function thanadoula_render_faq_submitter_meta_box( $post ) {
    $name  = get_post_meta( $post->ID, '_faq_submitter_name', true );
    $email = get_post_meta( $post->ID, '_faq_submitter_email', true );
    ?>
    <p><strong>Nom</strong><br><?php echo esc_html( $name ?: 'Non renseigné' ); ?></p>
    <p><strong>E-mail</strong><br><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ?: 'Non renseigné' ); ?></a></p>
    <?php
}
