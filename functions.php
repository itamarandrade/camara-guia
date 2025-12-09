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
        'hero_image'          => __('Imagem do destaque 1', 'camara-hotsite'),
        'hero_image_two'      => __('Imagem do destaque 2', 'camara-hotsite'),
        'hero_image_three'    => __('Imagem do destaque 3', 'camara-hotsite'),
        'calendar_image'      => __('Imagem do calendário/agenda', 'camara-hotsite'),
        'gallery_image_one'   => __('Galeria hexagonal 1', 'camara-hotsite'),
        'gallery_image_two'   => __('Galeria hexagonal 2', 'camara-hotsite'),
        'gallery_image_three' => __('Galeria hexagonal 3', 'camara-hotsite'),
        'tour_image'          => __('Imagem do tour virtual', 'camara-hotsite'),
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

function camara_get_theme_option( $key, $default = '' ) {
    $options = get_option( 'camara_theme_settings', [] );
    if ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) {
        return $options[ $key ];
    }

    return $default;
}

function camara_sanitize_theme_settings( $input ) {
    $output = [];
    $fields = [
        'hero_badge_text'      => 'text',
        'hero_title_primary'   => 'text',
        'hero_title_secondary' => 'text',
        'hero_description'     => 'textarea',
    ];

    foreach ( $fields as $field => $type ) {
        if ( ! isset( $input[ $field ] ) ) {
            continue;
        }

        if ( 'textarea' === $type ) {
            $output[ $field ] = sanitize_textarea_field( $input[ $field ] );
        } else {
            $output[ $field ] = sanitize_text_field( $input[ $field ] );
        }
    }

    return $output;
}

function camara_register_theme_settings() {
    register_setting( 'camara_theme_settings_group', 'camara_theme_settings', [
        'type'              => 'array',
        'sanitize_callback' => 'camara_sanitize_theme_settings',
        'default'           => [],
    ] );

    add_settings_section(
        'camara_theme_settings_hero',
        __( 'Seção Hero', 'camara-hotsite' ),
        function() {
            echo '<p>' . esc_html__( 'Personalize os textos exibidos no destaque principal da página inicial.', 'camara-hotsite' ) . '</p>';
        },
        'camara_theme_settings'
    );

    add_settings_field(
        'camara_hero_badge_text',
        __( 'Texto do selo', 'camara-hotsite' ),
        'camara_theme_settings_text_field',
        'camara_theme_settings',
        'camara_theme_settings_hero',
        [
            'id'          => 'hero_badge_text',
            'type'        => 'text',
            'description' => __( 'Texto pequeno que aparece acima do título principal.', 'camara-hotsite' ),
        ]
    );

    add_settings_field(
        'camara_hero_title_primary',
        __( 'Título principal', 'camara-hotsite' ),
        'camara_theme_settings_text_field',
        'camara_theme_settings',
        'camara_theme_settings_hero',
        [
            'id'          => 'hero_title_primary',
            'type'        => 'text',
            'description' => __( 'Primeira linha em destaque (em negrito).', 'camara-hotsite' ),
        ]
    );

    add_settings_field(
        'camara_hero_title_secondary',
        __( 'Título secundário', 'camara-hotsite' ),
        'camara_theme_settings_text_field',
        'camara_theme_settings',
        'camara_theme_settings_hero',
        [
            'id'          => 'hero_title_secondary',
            'type'        => 'text',
            'description' => __( 'Segunda linha em destaque.', 'camara-hotsite' ),
        ]
    );

    add_settings_field(
        'camara_hero_description',
        __( 'Descrição', 'camara-hotsite' ),
        'camara_theme_settings_text_field',
        'camara_theme_settings',
        'camara_theme_settings_hero',
        [
            'id'          => 'hero_description',
            'type'        => 'textarea',
            'description' => __( 'Texto exibido abaixo do título.', 'camara-hotsite' ),
        ]
    );
}
add_action( 'admin_init', 'camara_register_theme_settings' );

function camara_theme_settings_text_field( $args ) {
    $options = get_option( 'camara_theme_settings', [] );
    $value   = isset( $options[ $args['id'] ] ) ? $options[ $args['id'] ] : '';
    $field_id = esc_attr( $args['id'] );
    $description = isset( $args['description'] ) ? $args['description'] : '';

    if ( 'textarea' === $args['type'] ) {
        printf(
            '<textarea id="%1$s" name="camara_theme_settings[%1$s]" rows="4" class="large-text">%2$s</textarea>',
            $field_id,
            esc_textarea( $value )
        );
    } else {
        printf(
            '<input type="text" id="%1$s" name="camara_theme_settings[%1$s]" value="%2$s" class="regular-text" />',
            $field_id,
            esc_attr( $value )
        );
    }

    if ( $description ) {
        printf( '<p class="description">%s</p>', esc_html( $description ) );
    }
}

function camara_add_theme_settings_page() {
    add_theme_page(
        __( 'Configurações do Tema', 'camara-hotsite' ),
        __( 'Configurações do Tema', 'camara-hotsite' ),
        'manage_options',
        'camara-theme-settings',
        'camara_render_theme_settings_page'
    );
}
add_action( 'admin_menu', 'camara_add_theme_settings_page' );

function camara_render_theme_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Configurações do Tema', 'camara-hotsite' ); ?></h1>
        <form action="options.php" method="post">
            <?php
                settings_fields( 'camara_theme_settings_group' );
                do_settings_sections( 'camara_theme_settings' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

?>
