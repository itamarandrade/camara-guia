<?php

function camara_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');

    register_nav_menus([
        'header_menu' => 'Menu Superior',
        'footer_menu' => 'Menu Rodapé'
    ]);
}
add_action('after_setup_theme', 'camara_setup');


function camara_scripts() {
    wp_enqueue_style('camara-style', get_template_directory_uri() . '/assets/css/style.css', [], '1.0');
}
add_action('wp_enqueue_scripts', 'camara_scripts');

?>
