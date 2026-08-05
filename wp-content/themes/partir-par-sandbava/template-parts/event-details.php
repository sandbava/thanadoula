<?php
$event_details    = thanadoula_get_event_details();
$show_registration = $args['show_registration'] ?? false;
?>
<div class="event-details">
    <?php if ( $event_details['date'] ) : ?>
        <p class="event-detail event-date">
            <span>Date de l’événement&nbsp;:</span>
            <time datetime="<?php echo esc_attr( $event_details['datetime'] ); ?>"><?php echo esc_html( $event_details['date'] ); ?></time>
        </p>
    <?php endif; ?>

    <?php if ( $event_details['start_time'] ) : ?>
        <p class="event-detail event-time">
            <span>Horaire&nbsp;:</span>
            <?php echo esc_html( $event_details['start_time'] ); ?><?php if ( $event_details['end_time'] ) : ?>–<?php echo esc_html( $event_details['end_time'] ); ?><?php endif; ?>
        </p>
    <?php endif; ?>

    <?php if ( $event_details['location'] ) : ?>
        <p class="event-detail event-location">
            <span>Lieu&nbsp;:</span> <?php echo esc_html( $event_details['location'] ); ?>
        </p>
    <?php endif; ?>

    <?php if ( $show_registration && $event_details['registration_url'] ) : ?>
        <a class="btn event-registration" href="<?php echo esc_url( $event_details['registration_url'] ); ?>">S’inscrire à l’événement</a>
    <?php endif; ?>
</div>
