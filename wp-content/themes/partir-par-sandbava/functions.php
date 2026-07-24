<?php

function mon_theme_assets() {

    wp_enqueue_style(
        'style',
        get_stylesheet_uri(),
        [],
        filemtime(get_stylesheet_directory() . '/style.css')
    );

}

add_action(
    'wp_enqueue_scripts',
    'mon_theme_assets'
);

function mon_theme_setup(){

    register_nav_menus([
        'principal' => 'Menu principal'
    ]);

}

add_action(
    'after_setup_theme',
    'mon_theme_setup'
);
