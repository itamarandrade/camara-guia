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
    wp_enqueue_style('adobe-fonts', 'https://use.typekit.net/qlv7cqp.css', [], null);
    wp_enqueue_style('camara-style', get_template_directory_uri() . '/assets/css/style.css', ['adobe-fonts'], $version);
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

function camara_render_embed( $html ) {
    if ( empty( $html ) ) {
        return '';
    }

    $allowed = wp_kses_allowed_html( 'post' );
    $allowed['iframe'] = [
        'src'             => true,
        'width'           => true,
        'height'          => true,
        'frameborder'     => true,
        'allow'           => true,
        'allowfullscreen' => true,
        'loading'         => true,
        'referrerpolicy'  => true,
        'title'           => true,
    ];

    return wp_kses( $html, $allowed );
}

function camara_get_theme_option( $key, $default = '' ) {
    $options = get_option( 'camara_theme_settings', [] );
    if ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) {
        return $options[ $key ];
    }

    return $default;
}

function camara_get_side_menu_links() {
    $links = [
        [
            'label'    => __( 'Visitas', 'camara-hotsite' ),
            'slug'     => 'visitas',
            'url'      => home_url( '/visitas/' ),
            'external' => false,
            'target'   => '_self',
        ],
    ];

    $external_base  = 'https://www.saopaulo.sp.leg.br/';
    $external_items = [
        'Visitas Guiadas'                           => '',
        'Visitas Institucionais'                    => '',
        'Visitas Técnicas'                          => '',
        'Acompanhe'                                 => '',
        'Galeria do Plenário 1o de Maio'            => '',
        'Audiências Públicas'                       => '',
        'Atendimento ao cidadão'                    => '',
        'Horário'                                   => '',
        'Procedimentos de Segurança e Identificação'=> '',
        'Ouvidoria'                                 => '',
        'Acesso à biblioteca'                       => '',
        'Espaços culturais e exposições temporárias'=> '',
        'Fotografias e vídeos'                      => '',
        'Acessibilidade'                            => '',
        'Contato'                                   => '',
        'Deixe sua manifestação'                    => '',
        'Entre em Contato'                          => '',
        'Visita Virtual'                            => '',
        'Galeria de vídeos'                         => '',
        'Rede Câmara SP'                            => '',
        'Centro de Memória'                         => '',
        'Portal da Biblioteca e Documentação'       => '',
        'Portal da Legislação Paulistana'           => '',
        'SPLegis'                                   => '',
        'Publicações Institucionais'                => '',
        'Revista Apartes'                           => '',
        'Revista da Procuradoria'                   => '',
        'Revista Parlamento e Sociedade'            => '',
    ];

    foreach ( $external_items as $label => $slug ) {
        $slug = $slug ?: sanitize_title( $label );

        if ( preg_match( '#^https?://#i', $slug ) ) {
            $url = esc_url_raw( $slug );
        } else {
            $url = trailingslashit( $external_base . ltrim( $slug, '/' ) );
        }

        $links[] = [
            'label'    => $label,
            'slug'     => sanitize_title( $label ),
            'url'      => esc_url_raw( $url ),
            'external' => true,
            'target'   => '_blank',
        ];
    }

    return apply_filters( 'camara_side_menu_links', $links );
}

function camara_sanitize_theme_settings( $input ) {
    $output = [];
    $fields = [
        'hero_badge_text'       => 'text',
        'hero_title_primary'    => 'text',
        'hero_title_secondary'  => 'text',
        'hero_description'      => 'textarea',
        'hero_slider_images'    => 'images',
        'discover_hex_image'    => 'image',
        'tour_media_type'       => 'choice',
        'tour_media_gallery'    => 'images',
        'tour_video_url'        => 'text',
    ];

    $choice_options = [
        'tour_media_type' => [ 'gallery', 'video' ],
    ];

    foreach ( $fields as $field => $type ) {
        if ( ! isset( $input[ $field ] ) ) {
            continue;
        }

        $value = $input[ $field ];

        switch ( $type ) {
            case 'textarea':
                $output[ $field ] = sanitize_textarea_field( $value );
                break;
            case 'images':
                if ( is_string( $value ) ) {
                    $value = array_filter( array_map( 'trim', explode( ',', $value ) ) );
                }

                $images = [];
                if ( is_array( $value ) ) {
                    foreach ( $value as $image_id ) {
                        $image_id = absint( $image_id );
                        if ( $image_id ) {
                            $images[] = $image_id;
                        }
                    }
                }
                $output[ $field ] = $images;
                break;
            case 'image':
                $output[ $field ] = absint( $value );
                break;
            case 'choice':
                $value = sanitize_text_field( $value );
                $allowed = isset( $choice_options[ $field ] ) ? (array) $choice_options[ $field ] : [];
                if ( $allowed && in_array( $value, $allowed, true ) ) {
                    $output[ $field ] = $value;
                } elseif ( $allowed ) {
                    $output[ $field ] = reset( $allowed );
                }
                break;
            default:
                $output[ $field ] = sanitize_text_field( $value );
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

    add_settings_field(
        'camara_hero_slider_images',
        __( 'Imagens do slider', 'camara-hotsite' ),
        'camara_theme_settings_slider_field',
        'camara_theme_settings',
        'camara_theme_settings_hero',
        [
            'id' => 'hero_slider_images',
        ]
    );

    add_settings_field(
        'camara_discover_hex_image',
        __( 'Imagem dos hexágonos', 'camara-hotsite' ),
        'camara_theme_settings_image_field',
        'camara_theme_settings',
        'camara_theme_settings_hero',
        [
            'id'          => 'discover_hex_image',
            'description'=> __( 'Imagem única que representa o conjunto de hexágonos exibido na seção “Agende a sua visita”.', 'camara-hotsite' ),
        ]
    );

    add_settings_section(
        'camara_theme_settings_tour',
        __( 'Seção Tour Virtual', 'camara-hotsite' ),
        function() {
            echo '<p>' . esc_html__( 'Defina se a área do tour exibe um slide de imagens ou um vídeo e envie o conteúdo correspondente.', 'camara-hotsite' ) . '</p>';
        },
        'camara_theme_settings'
    );

    add_settings_field(
        'camara_tour_media_type',
        __( 'Tipo de mídia', 'camara-hotsite' ),
        'camara_theme_settings_select_field',
        'camara_theme_settings',
        'camara_theme_settings_tour',
        [
            'id'          => 'tour_media_type',
            'choices'     => [
                'gallery' => __( 'Slide de imagens', 'camara-hotsite' ),
                'video'   => __( 'Vídeo incorporado', 'camara-hotsite' ),
            ],
            'description' => __( 'Escolha se o painel mostrará várias imagens ou um vídeo do tour.', 'camara-hotsite' ),
        ]
    );

    add_settings_field(
        'camara_tour_media_gallery',
        __( 'Galeria do tour', 'camara-hotsite' ),
        'camara_theme_settings_slider_field',
        'camara_theme_settings',
        'camara_theme_settings_tour',
        [
            'id' => 'tour_media_gallery',
        ]
    );

    add_settings_field(
        'camara_tour_video_url',
        __( 'URL do vídeo', 'camara-hotsite' ),
        'camara_theme_settings_text_field',
        'camara_theme_settings',
        'camara_theme_settings_tour',
        [
            'id'          => 'tour_video_url',
            'type'        => 'text',
            'description' => __( 'Cole a URL de um vídeo (YouTube, Vimeo ou arquivo MP4) que será exibido quando o tipo for Vídeo.', 'camara-hotsite' ),
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

function camara_theme_settings_select_field( $args ) {
    $options     = get_option( 'camara_theme_settings', [] );
    $value       = isset( $options[ $args['id'] ] ) ? $options[ $args['id'] ] : '';
    $field_id    = esc_attr( $args['id'] );
    $choices     = isset( $args['choices'] ) && is_array( $args['choices'] ) ? $args['choices'] : [];
    $description = isset( $args['description'] ) ? $args['description'] : '';

    echo '<select id="' . $field_id . '" name="camara_theme_settings[' . $field_id . ']">';
    foreach ( $choices as $choice_value => $label ) {
        printf(
            '<option value="%1$s" %2$s>%3$s</option>',
            esc_attr( $choice_value ),
            selected( $value, $choice_value, false ),
            esc_html( $label )
        );
    }
    echo '</select>';

    if ( $description ) {
        printf( '<p class="description">%s</p>', esc_html( $description ) );
    }
}

function camara_theme_settings_slider_field( $args ) {
    $options = get_option( 'camara_theme_settings', [] );
    $value   = [];

    if ( isset( $options[ $args['id'] ] ) ) {
        if ( is_array( $options[ $args['id'] ] ) ) {
            $value = array_map( 'absint', $options[ $args['id'] ] );
        } elseif ( is_string( $options[ $args['id'] ] ) ) {
            $value = array_map( 'absint', explode( ',', $options[ $args['id'] ] ) );
        }
    }

    $value = array_values( array_filter( $value ) );
    $field_id = esc_attr( $args['id'] );
    $serialized_value = implode( ',', $value );
    $media_title = esc_attr__( 'Selecionar imagens do slider', 'camara-hotsite' );
    $media_button = esc_attr__( 'Adicionar ao slider', 'camara-hotsite' );
    $remove_label = esc_attr__( 'Remover imagem', 'camara-hotsite' );
    $empty_label  = esc_html__( 'Nenhuma imagem selecionada ainda.', 'camara-hotsite' );
    ?>
    <div
        class="camara-slider-field"
        data-slider-field
        data-media-title="<?php echo $media_title; ?>"
        data-media-button="<?php echo $media_button; ?>"
        data-remove-label="<?php echo $remove_label; ?>"
    >
        <input type="hidden" id="<?php echo $field_id; ?>" name="camara_theme_settings[<?php echo $field_id; ?>]" value="<?php echo esc_attr( $serialized_value ); ?>" data-slider-input>
        <div class="camara-slider-toolbar">
            <button type="button" class="button button-secondary" data-slider-select><?php esc_html_e( 'Selecionar imagens', 'camara-hotsite' ); ?></button>
            <button type="button" class="button-link" data-slider-clear><?php esc_html_e( 'Limpar todas', 'camara-hotsite' ); ?></button>
        </div>
        <p class="description"><?php esc_html_e( 'Escolha as imagens para o slider e arraste para definir a ordem.', 'camara-hotsite' ); ?></p>
        <ul class="camara-slider-list" data-slider-list>
            <?php if ( $value ) : ?>
                <?php foreach ( $value as $attachment_id ) : ?>
                    <?php
                        $thumb = wp_get_attachment_image_url( $attachment_id, 'thumbnail' );
                        if ( ! $thumb ) {
                            $thumb = camara_placeholder_image( __( 'Slide', 'camara-hotsite' ) );
                        }
                    ?>
                    <li class="camara-slider-item" data-id="<?php echo esc_attr( $attachment_id ); ?>" draggable="true">
                        <span class="camara-slider-item__preview">
                            <img src="<?php echo esc_url( $thumb ); ?>" alt="">
                        </span>
                        <button type="button" class="button-link camara-slider-item__remove" aria-label="<?php echo $remove_label; ?>">&times;</button>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <p class="camara-slider-empty" data-slider-empty <?php echo $value ? 'hidden' : ''; ?>>
            <?php echo $empty_label; ?>
        </p>
    </div>
    <?php
}

function camara_theme_settings_image_field( $args ) {
    $options = get_option( 'camara_theme_settings', [] );
    $value   = isset( $options[ $args['id'] ] ) ? absint( $options[ $args['id'] ] ) : 0;
    $field_id = esc_attr( $args['id'] );
    $description = isset( $args['description'] ) ? $args['description'] : '';
    $button_label = isset( $args['button_label'] ) ? $args['button_label'] : __( 'Selecionar imagem', 'camara-hotsite' );
    $remove_text  = isset( $args['remove_label'] ) ? $args['remove_label'] : __( 'Remover imagem', 'camara-hotsite' );
    $placeholder  = __( 'Nenhuma imagem selecionada.', 'camara-hotsite' );
    $media_title  = __( 'Selecionar imagem', 'camara-hotsite' );
    $media_button = __( 'Usar imagem', 'camara-hotsite' );
    $image_url    = $value ? wp_get_attachment_image_url( $value, 'large' ) : '';
    ?>
    <div
        class="camara-image-field"
        data-image-field
        data-media-title="<?php echo esc_attr( $media_title ); ?>"
        data-media-button="<?php echo esc_attr( $media_button ); ?>"
    >
        <input type="hidden" name="camara_theme_settings[<?php echo $field_id; ?>]" value="<?php echo esc_attr( $value ); ?>" data-image-input>
        <div class="camara-image-preview" data-image-preview data-placeholder="<?php echo esc_attr( $placeholder ); ?>">
            <?php if ( $image_url ) : ?>
                <img src="<?php echo esc_url( $image_url ); ?>" alt="">
            <?php else : ?>
                <span><?php echo esc_html( $placeholder ); ?></span>
            <?php endif; ?>
        </div>
        <div class="camara-image-actions">
            <button type="button" class="button button-secondary" data-image-select><?php echo esc_html( $button_label ); ?></button>
            <button type="button" class="button-link" data-image-remove <?php disabled( ! $value ); ?>><?php echo esc_html( $remove_text ); ?></button>
        </div>
        <?php if ( $description ) : ?>
            <p class="description"><?php echo esc_html( $description ); ?></p>
        <?php endif; ?>
    </div>
    <?php
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

function camara_admin_settings_assets( $hook ) {
    if ( 'appearance_page_camara-theme-settings' !== $hook ) {
        return;
    }

    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_media();
    wp_enqueue_style(
        'camara-admin-settings',
        get_template_directory_uri() . '/assets/css/admin-settings.css',
        [],
        $version
    );
    wp_enqueue_script(
        'camara-admin-settings',
        get_template_directory_uri() . '/assets/js/admin-settings.js',
        [],
        $version,
        true
    );
}
add_action( 'admin_enqueue_scripts', 'camara_admin_settings_assets' );


function camara_contact_form_redirect( $status ) {
    $param = isset( $_POST['camara_status_param'] ) ? sanitize_key( wp_unslash( $_POST['camara_status_param'] ) ) : 'form-status';
    $redirect = isset( $_POST['camara_redirect_to'] ) ? esc_url_raw( wp_unslash( $_POST['camara_redirect_to'] ) ) : '';

    if ( empty( $redirect ) ) {
        $redirect = wp_get_referer();
    }

    if ( empty( $redirect ) ) {
        $redirect = home_url( '/' );
    }

    if ( empty( $param ) ) {
        $param = 'form-status';
    }

    wp_safe_redirect( add_query_arg( $param, $status, $redirect ) );
    exit;
}

function camara_handle_contact_form() {
    if ( empty( $_POST['camara_contact_form_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['camara_contact_form_nonce'] ), 'camara_contact_form' ) ) {
        camara_contact_form_redirect( 'error' );
    }

    $form_id      = isset( $_POST['camara_form_id'] ) ? sanitize_key( wp_unslash( $_POST['camara_form_id'] ) ) : 'formulario';
    $form_context = isset( $_POST['camara_form_context'] ) ? sanitize_text_field( wp_unslash( $_POST['camara_form_context'] ) ) : __( 'Contato', 'camara-hotsite' );

    $name_field   = isset( $_POST['nome'] ) ? $_POST['nome'] : ( isset( $_POST['visitas-nome'] ) ? $_POST['visitas-nome'] : '' );
    $phone_field  = isset( $_POST['telefone'] ) ? $_POST['telefone'] : ( isset( $_POST['visitas-telefone'] ) ? $_POST['visitas-telefone'] : '' );
    $email_field  = isset( $_POST['email'] ) ? $_POST['email'] : ( isset( $_POST['visitas-email'] ) ? $_POST['visitas-email'] : '' );
    $message_field = isset( $_POST['mensagem'] ) ? $_POST['mensagem'] : '';
    $reason_field = isset( $_POST['motivo'] ) ? $_POST['motivo'] : '';

    $name    = $name_field ? sanitize_text_field( wp_unslash( $name_field ) ) : '';
    $phone   = $phone_field ? sanitize_text_field( wp_unslash( $phone_field ) ) : '';
    $email   = $email_field ? sanitize_email( wp_unslash( $email_field ) ) : '';
    $message = $message_field ? sanitize_textarea_field( wp_unslash( $message_field ) ) : '';
    $reason  = $reason_field ? sanitize_textarea_field( wp_unslash( $reason_field ) ) : '';

    $consent  = isset( $_POST['lgpd_consent'] ) ? __( 'Sim', 'camara-hotsite' ) : __( 'Não informado', 'camara-hotsite' );
    $recipient = apply_filters( 'camara_contact_form_recipient', 'comunicacaoexterna@saopaulo.sp.leg.br', $form_id );

    $email_lines = [
        sprintf( __( 'Formulário: %s', 'camara-hotsite' ), $form_context ),
    ];

    if ( $name ) {
        $email_lines[] = sprintf( __( 'Nome: %s', 'camara-hotsite' ), $name );
    }

    if ( $phone ) {
        $email_lines[] = sprintf( __( 'Telefone: %s', 'camara-hotsite' ), $phone );
    }

    if ( $email ) {
        $email_lines[] = sprintf( __( 'E-mail: %s', 'camara-hotsite' ), $email );
    }

    if ( $reason ) {
        $email_lines[] = sprintf( __( 'Motivo da visita: %s', 'camara-hotsite' ), $reason );
    }

    if ( $message ) {
        $email_lines[] = '';
        $email_lines[] = __( 'Mensagem:', 'camara-hotsite' );
        $email_lines[] = $message;
    }

    $email_lines[] = '';
    $email_lines[] = sprintf( __( 'Consentimento LGPD: %s', 'camara-hotsite' ), $consent );

    $subject = sprintf( __( '[Guia do Visitante] Novo contato (%s)', 'camara-hotsite' ), $form_context );
    $headers = [ 'Content-Type: text/plain; charset=UTF-8' ];

    if ( $email ) {
        $headers[] = 'Reply-To: ' . $email;
    }

    $sent = wp_mail( $recipient, $subject, implode( "\n", $email_lines ), $headers );

    camara_contact_form_redirect( $sent ? 'success' : 'error' );
}
add_action( 'admin_post_camara_contact_form', 'camara_handle_contact_form' );
add_action( 'admin_post_nopriv_camara_contact_form', 'camara_handle_contact_form' );

function camara_maybe_create_guia_page() {
    $existing_page = get_page_by_path( 'guia' );

    if ( $existing_page ) {
        if ( 'page' !== $existing_page->post_type ) {
            return;
        }

        $template = get_post_meta( $existing_page->ID, '_wp_page_template', true );
        if ( 'page-guia.php' !== $template ) {
            update_post_meta( $existing_page->ID, '_wp_page_template', 'page-guia.php' );
        }

        return;
    }

    $page_id = wp_insert_post(
        [
            'post_title'  => __( 'Guia do Visitante', 'camara-hotsite' ),
            'post_name'   => 'guia',
            'post_status' => 'publish',
            'post_type'   => 'page',
        ]
    );

    if ( $page_id && ! is_wp_error( $page_id ) ) {
        update_post_meta( $page_id, '_wp_page_template', 'page-guia.php' );
    }
}
add_action( 'admin_init', 'camara_maybe_create_guia_page' );

?>
