<?php
    get_header();

    $hero_slides = camara_get_page_hero_slides( 'home' );
    $tour_image      = camara_get_theme_image( 'tour_image' );
    $discover_hex_id = camara_get_theme_option( 'discover_hex_image' );
    $discover_hex_image = $discover_hex_id ? wp_get_attachment_image_url( absint( $discover_hex_id ), 'full' ) : '';
    $tour_media_type  = camara_get_theme_option( 'tour_media_type', 'gallery' );
    $tour_gallery_ids = camara_get_theme_option( 'tour_media_gallery', [] );
    $tour_video_url   = camara_get_theme_option( 'tour_video_url', '' );

    $calendar_labels = [
        __( 'Dom', 'camara-hotsite' ),
        __( 'Seg', 'camara-hotsite' ),
        __( 'Ter', 'camara-hotsite' ),
        __( 'Qua', 'camara-hotsite' ),
        __( 'Qui', 'camara-hotsite' ),
        __( 'Sex', 'camara-hotsite' ),
        __( 'Sáb', 'camara-hotsite' ),
    ];

    $calendar_weeks = [
        [ '', 1, 2, 3, 4, 5, 6 ],
        [ 7, 8, 9, 10, 11, 12, 13 ],
        [ 14, 15, 16, 17, 18, 19, 20 ],
        [ 21, 22, 23, 24, 25, 26, 27 ],
        [ 28, 29, 30, 31, '', '', '' ],
    ];

    $calendar_highlights = [
        4  => 'is-gold',
        5  => 'is-blue',
        6  => 'is-green',
        7  => 'is-purple',
        11 => 'is-gold',
        12 => 'is-blue',
        13 => 'is-green',
        14 => 'is-green',
    ];

    $tour_gallery_ids = is_array( $tour_gallery_ids ) ? array_filter( array_map( 'absint', $tour_gallery_ids ) ) : [];
    $tour_slides      = [];

    if ( $tour_gallery_ids ) {
        foreach ( $tour_gallery_ids as $index => $attachment_id ) {
            $image_large = wp_get_attachment_image_url( $attachment_id, 'large' );
            if ( ! $image_large ) {
                continue;
            }

            $image_thumb = wp_get_attachment_image_url( $attachment_id, 'medium' ) ?: $image_large;
            $alt_text    = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
            $tour_slides[] = [
                'image' => $image_large,
                'thumb' => $image_thumb,
                'alt'   => $alt_text ?: sprintf( esc_html__( 'Slide %d do tour', 'camara-hotsite' ), $index + 1 ),
            ];
        }
    }

    if ( empty( $tour_slides ) ) {
        $fallback_image = $tour_image ?: camara_placeholder_image( __( 'Tour virtual', 'camara-hotsite' ) );
        $tour_slides[]  = [
            'image' => $fallback_image,
            'thumb' => $fallback_image,
            'alt'   => __( 'Tour virtual', 'camara-hotsite' ),
        ];
    }

    $tour_video_embed = '';
    if ( 'video' === $tour_media_type && ! empty( $tour_video_url ) ) {
        $video_url_data = wp_parse_url( $tour_video_url );
        $is_vimeo       = $video_url_data && ! empty( $video_url_data['host'] ) && false !== stripos( $video_url_data['host'], 'vimeo.com' );

        if ( $is_vimeo ) {
            $video_src = '';

            if ( 'player.vimeo.com' === strtolower( $video_url_data['host'] ) ) {
                $video_src = $tour_video_url;
            } else {
                $path = isset( $video_url_data['path'] ) ? trim( $video_url_data['path'], '/' ) : '';
                if ( $path ) {
                    $segments = explode( '/', $path );
                    $candidate = reset( $segments );
                    if ( ctype_digit( $candidate ) ) {
                        $video_src = sprintf( 'https://player.vimeo.com/video/%s', $candidate );
                    }
                }
            }

            if ( $video_src ) {
                $video_src = add_query_arg(
                    [
                        'autoplay'   => 1,
                        'muted'      => 1,
                        'title'      => 0,
                        'byline'     => 0,
                        'portrait'   => 0,
                        'controls'   => 0,
                        'background' => 1,
                        'playsinline'=> 1,
                        'loop'       => 1,
                        'autopause'  => 0,
                        'dnt'        => 1,
                    ],
                    $video_src
                );

                $tour_video_embed = sprintf(
                    '<iframe width="640" height="360" src="%s" allow="autoplay; fullscreen; picture-in-picture" loading="lazy" allowfullscreen title="%s"></iframe>',
                    esc_url( $video_src ),
                    esc_attr__( 'Tour virtual', 'camara-hotsite' )
                );
            }
        } else {
            $tour_video_embed = wp_oembed_get( $tour_video_url );

            if ( ! $tour_video_embed && $video_url_data ) {
                $extension     = isset( $video_url_data['path'] ) ? strtolower( pathinfo( $video_url_data['path'], PATHINFO_EXTENSION ) ) : '';
                $supported_ext = [ 'mp4', 'm4v', 'webm', 'ogv', 'flv' ];

                if ( $extension && in_array( $extension, $supported_ext, true ) ) {
                    $tour_video_embed = wp_video_shortcode( [ 'src' => esc_url( $tour_video_url ) ] );
                }
            }
        }
    }

    if ( 'video' === $tour_media_type && empty( $tour_video_embed ) ) {
        $tour_media_type = 'gallery';
    }

    $tour_has_multiple_slides = count( $tour_slides ) > 1;
    $contact_status = isset( $_GET['contact-status'] ) ? sanitize_text_field( wp_unslash( $_GET['contact-status'] ) ) : '';
?>

<main id="primary" class="site-main visitas-page" tabindex="-1">

    <section class="hero" data-hero>
        <div class="hero__slider" data-hero-slider>
        <?php foreach ( $hero_slides as $index => $slide ) : ?>
            <?php
                $desktop_image  = $slide['desktop'] ?: $slide['fallback'];
                $mobile_image   = $slide['mobile'] ?: $slide['fallback'];
                $fallback_image = $slide['fallback'];
            ?>
            <div
                class="hero__slide <?php echo 0 === $index ? 'is-active' : ''; ?>"
                data-hero-slide
                data-desktop-image="<?php echo esc_attr( $desktop_image ); ?>"
                data-mobile-image="<?php echo esc_attr( $mobile_image ); ?>"
                data-fallback-image="<?php echo esc_attr( $fallback_image ); ?>"
                style="background-image: url('<?php echo esc_url( $fallback_image ); ?>');"
            >
                <span class="sr-only"><?php echo esc_html( $slide['label'] ); ?></span>
            </div>
        <?php endforeach; ?>
        </div>
        <div class="hero__dots" role="tablist" data-hero-dots aria-label="<?php esc_attr_e('Controle do destaque principal', 'camara-hotsite'); ?>">
            <?php foreach ( $hero_slides as $index => $slide ) : ?>
                <button
                    type="button"
                    class="<?php echo 0 === $index ? 'is-active' : ''; ?>"
                    data-hero-dot="<?php echo esc_attr( $index ); ?>"
                    aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
                    aria-label="<?php printf( esc_attr__( 'Ir para o slide %d', 'camara-hotsite' ), $index + 1 ); ?>"
                    role="tab"
                ></button>
            <?php endforeach; ?>
        </div>
    </section>

    <div class="container visitas-layout">
        <div class="visitas-content">
            <section class="section discover">
                <div class="container discover__layout">
                    <div class="discover__intro">
                        <p class="discover__headline"><?php esc_html_e('Venha conhecer a Câmara Municipal de São Paulo', 'camara-hotsite'); ?></p>
                        <div class="discover__message">
                            <div class="discover__message-text">
                                <p><?php esc_html_e('O prédio que abriga a Câmara Municipal de São Paulo é um marco arquitetônico do centro da capital paulista e está de portas abertas para receber visitantes interessados em conhecer um pouco mais sobre o Poder Legislativo municipal.', 'camara-hotsite'); ?></p>
                                <p><?php esc_html_e('Aqui, vereadoras e vereadores, representantes do povo, dedicam-se a discutir e elaborar leis, a fiscalizar e controlar os atos do Poder Executivo, a aprovar o Orçamento da Cidade, entre outras atribuições de fundamental importância para a cidade de São Paulo.', 'camara-hotsite'); ?></p>
                                <p><strong><?php esc_html_e('Nosso endereço:', 'camara-hotsite'); ?></strong> <?php esc_html_e('Viaduto Jacareí, 100', 'camara-hotsite'); ?><br><?php esc_html_e('CEP: 01319-900 - Bela Vista, São Paulo.', 'camara-hotsite'); ?></p>
                                <p><?php esc_html_e('Estamos próximos ao Metrô Anhangabaú e Terminal Bandeira de Ônibus.', 'camara-hotsite'); ?></p>
                            </div>
                            <figure class="discover__hex discover__hex--inline">
                                <img src="<?php echo esc_url( $discover_hex_image ?: camara_placeholder_image( __( 'Hexágonos', 'camara-hotsite' ) ) ); ?>" alt="<?php esc_attr_e('Composição de imagens em formato de hexágono da Câmara Municipal', 'camara-hotsite'); ?>">
                            </figure>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section contact-panel" id="contato">
                <div class="container">
                    <div class="contact-panel__banner">
                        <span><?php esc_html_e('Fale com a Câmara!', 'camara-hotsite'); ?></span>
                    </div>
                    <div class="contact-panel__grid">
                        <div class="contact-panel__text">
                            <p><?php esc_html_e('Esse é o canal de comunicação “Fale Conosco” da Câmara Municipal de São Paulo. Esse canal o ajudará a dar seu feedback e a resolver suas dúvidas.', 'camara-hotsite'); ?></p>
                            <p><strong><?php esc_html_e('Central Telefônica:', 'camara-hotsite'); ?></strong></p>
                            <p><?php esc_html_e('Para um atendimento imediato e personalizado, nossa equipe da central telefônica está disponível das 10h às 19h pelo número (11) 3396-4000.', 'camara-hotsite'); ?></p>
                        </div>

                        <div class="contact-panel__card">
                        <form class="contact-form contact-form--compact" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                            <?php wp_nonce_field( 'camara_contact_form', 'camara_contact_form_nonce' ); ?>
                            <input type="hidden" name="action" value="camara_contact_form">
                            <input type="hidden" name="camara_form_id" value="contato-home">
                            <input type="hidden" name="camara_form_context" value="<?php esc_attr_e( 'Contato geral', 'camara-hotsite' ); ?>">
                            <input type="hidden" name="camara_status_param" value="contact-status">
                                <input type="hidden" name="camara_redirect_to" value="<?php echo esc_url( home_url( '/#contato' ) ); ?>">
                            <div class="form-row">
                                <label for="contact-name"><?php esc_html_e('Nome', 'camara-hotsite'); ?></label>
                                <input type="text" id="contact-name" name="nome" required>
                            </div>
                            <div class="form-row">
                                <label for="contact-phone"><?php esc_html_e('Telefone', 'camara-hotsite'); ?></label>
                                <input type="tel" id="contact-phone" name="telefone">
                            </div>
                            <div class="form-row">
                                <label for="contact-email"><?php esc_html_e('E-mail', 'camara-hotsite'); ?></label>
                                <input type="email" id="contact-email" name="email" required>
                            </div>
                            <div class="form-row form-row--checkbox">
                                <input type="checkbox" id="contact-lgpd" name="lgpd_consent" value="1" required>
                                <label for="contact-lgpd">
                                    <?php esc_html_e('Autorizo o uso dos meus dados para receber retorno da Câmara, conforme a LGPD.', 'camara-hotsite'); ?>
                                </label>
                            </div>
                            <div class="form-row form-row--button">
                                <button type="submit" class="btn contact-form__submit">
                                    <?php esc_html_e( 'Enviar mensagem', 'camara-hotsite' ); ?>
                                </button>
                            </div>
                        </form>
                        <?php if ( 'success' === $contact_status ) : ?>
                            <div class="form-alert form-alert--success" role="status" aria-live="polite">
                                <?php esc_html_e( 'Recebemos sua mensagem! Em breve retornaremos o contato.', 'camara-hotsite' ); ?>
                            </div>
                        <?php elseif ( 'error' === $contact_status ) : ?>
                            <div class="form-alert form-alert--error" role="alert" aria-live="assertive">
                                <?php esc_html_e( 'Não foi possível enviar sua mensagem. Tente novamente em instantes.', 'camara-hotsite' ); ?>
                            </div>
                        <?php endif; ?>
                        <p class="contact-panel__note"><?php esc_html_e('O seu contato é muito importante para nós! Ao preencher os dados, você autoriza receber os conteúdos da Câmara Municipal de São Paulo.', 'camara-hotsite'); ?></p>
                        <p class="contact-panel__note"><?php esc_html_e('A Câmara Municipal de São Paulo respeita sua privacidade. Seus dados são tratados com segurança e conforme a LGPD.', 'camara-hotsite'); ?></p>
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</main>

<?php get_footer(); ?>
