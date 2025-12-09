<?php

function camara_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'header_menu'        => __('Menu Superior', 'camara-hotsite'),
        'footer_menu'        => __('Menu Rodapé', 'camara-hotsite'),
        'external_links_menu'=> __('Links externos', 'camara-hotsite'),
    ]);
}
add_action('after_setup_theme', 'camara_setup');


function camara_scripts() {
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('camara-style', get_template_directory_uri() . '/assets/css/style.css', [], $version);
    wp_enqueue_script('camara-theme', get_template_directory_uri() . '/assets/js/theme.js', [], $version, true);
}
add_action('wp_enqueue_scripts', 'camara_scripts');


function camara_customize_register( $wp_customize ) {
    $wp_customize->add_section('camara_hotsite_images', [
        'title'       => __('Imagens do hotsite', 'camara-hotsite'),
        'description' => __('Envie as imagens para o destaque e para as galerias. Basta publicar aqui e o site será atualizado automaticamente.', 'camara-hotsite'),
        'priority'    => 30,
    ]);

    $images = [
        'hero_image'         => __('Imagem do destaque principal', 'camara-hotsite'),
        'calendar_image'     => __('Imagem do calendário/agenda', 'camara-hotsite'),
        'gallery_image_one'  => __('Galeria hexagonal 1', 'camara-hotsite'),
        'gallery_image_two'  => __('Galeria hexagonal 2', 'camara-hotsite'),
        'gallery_image_three'=> __('Galeria hexagonal 3', 'camara-hotsite'),
        'tour_image'         => __('Imagem do tour virtual', 'camara-hotsite'),
    ];

    foreach ( $images as $setting => $label ) {
        $wp_customize->add_setting( $setting, [
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $setting,
            [
                'label'   => $label,
                'section' => 'camara_hotsite_images',
            ]
        ));
    }
}
add_action('customize_register', 'camara_customize_register');


function camara_get_theme_image( $setting ) {
    $image = get_theme_mod( $setting );
    return $image ? esc_url( $image ) : '';
}


function camara_placeholder_image( $text = 'Imagem' ) {
    $text = sanitize_text_field( $text );
    $svg  = '<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">'
        . '<rect width="800" height="600" fill="#e1e5eb" />'
        . '<text x="50%" y="50%" fill="#6c7587" font-size="32" font-family="Arial, sans-serif" text-anchor="middle" dominant-baseline="middle">'
        . esc_html( $text )
        . '</text></svg>';

    return 'data:image/svg+xml;utf8,' . rawurlencode( $svg );
}

?>
