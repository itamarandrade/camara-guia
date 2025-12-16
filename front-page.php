<?php
    get_header();

    $hero_slides     = [];
    $hero_slider_ids = camara_get_theme_option( 'hero_slider_images', [] );
    $tour_image      = camara_get_theme_image('tour_image');
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

    if ( ! empty( $hero_slider_ids ) && is_array( $hero_slider_ids ) ) {
        foreach ( $hero_slider_ids as $index => $attachment_id ) {
            $attachment_id = absint( $attachment_id );
            if ( ! $attachment_id ) {
                continue;
            }

            $image_url = wp_get_attachment_image_url( $attachment_id, 'full' );
            if ( ! $image_url ) {
                continue;
            }

            $hero_slides[] = [
                'image' => $image_url,
                'label' => sprintf( esc_html__( 'Slide %d', 'camara-hotsite' ), $index + 1 ),
            ];
        }
    }

    if ( empty( $hero_slides ) ) {
        $hero_sources = [
            camara_get_theme_image('hero_image'),
            camara_get_theme_image('hero_image_two'),
            camara_get_theme_image('hero_image_three'),
        ];

        foreach ( $hero_sources as $index => $source ) {
            $placeholder_label = sprintf( __( 'Destaque %d', 'camara-hotsite' ), $index + 1 );
            $hero_slides[] = [
                'image' => $source ?: camara_placeholder_image( $placeholder_label ),
                'label' => sprintf( esc_html__( 'Slide %d', 'camara-hotsite' ), $index + 1 ),
            ];
        }
    }

    $hero_badge          = camara_get_theme_option( 'hero_badge_text', __( 'Guia do Visitante', 'camara-hotsite' ) );
    $hero_title_primary  = camara_get_theme_option( 'hero_title_primary', __( 'Guia do Visitante', 'camara-hotsite' ) );
    $hero_title_secondary= camara_get_theme_option( 'hero_title_secondary', __( 'Palácio Anchieta', 'camara-hotsite' ) );
    $hero_description    = camara_get_theme_option( 'hero_description', __( 'Conheça cada detalhe do Legislativo paulistano com roteiros guiados e experiências completas.', 'camara-hotsite' ) );

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
?>

<main id="primary" class="site-main visitas-page">

    <section class="hero" data-hero>
        <div class="hero__slider" data-hero-slider>
            <?php foreach ( $hero_slides as $index => $slide ) : ?>
                <div
                    class="hero__slide <?php echo 0 === $index ? 'is-active' : ''; ?>"
                    data-hero-slide
                    style="background-image: url('<?php echo esc_url( $slide['image'] ); ?>');"
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
                            <p><?php esc_html_e('O Palácio Anchieta convida você para uma viagem no tempo! Arquitetura única, obras de arte e uma aula sobre o passado político, social e cultural de São Paulo.', 'camara-hotsite'); ?></p>
                        </div>
                    </div>

                    <figure class="discover__hex discover__hex--floating">
                        <img src="<?php echo esc_url( $discover_hex_image ?: camara_placeholder_image( __( 'Hexágonos', 'camara-hotsite' ) ) ); ?>" alt="<?php esc_attr_e('Composição de imagens em formato de hexágono da Câmara Municipal', 'camara-hotsite'); ?>">
                    </figure>

                    <div class="discover__cta">
                        <p class="discover__cta-eyebrow"><?php esc_html_e('Você é nosso convidado especial!', 'camara-hotsite'); ?></p>
                        <p class="discover__cta-main"><?php esc_html_e('Agende a sua visita', 'camara-hotsite'); ?></p>
                    </div>

                    <div class="discover__visual">
                        <div class="calendar-card discover__calendar" aria-label="<?php esc_attr_e('Calendário de visitas', 'camara-hotsite'); ?>">
                            <div class="calendar" role="grid">
                                <div class="calendar__labels" role="row">
                                    <?php foreach ( $calendar_labels as $label ) : ?>
                                        <span role="columnheader"><?php echo esc_html( $label ); ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <?php foreach ( $calendar_weeks as $week ) : ?>
                                    <div class="calendar__week" role="row">
                                        <?php foreach ( $week as $day ) :
                                            $day_value = $day ? absint( $day ) : '';
                                            $day_classes = ['calendar__day'];
                                            if ( '' === $day ) {
                                                $day_classes[] = 'is-empty';
                                            } elseif ( isset( $calendar_highlights[ $day_value ] ) ) {
                                                $day_classes[] = $calendar_highlights[ $day_value ];
                                            }
                                        ?>
                                            <span class="<?php echo esc_attr( implode( ' ', $day_classes ) ); ?>" role="gridcell">
                                                <?php echo '' !== $day ? esc_html( $day ) : ''; ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section virtual-tour">
                <div class="container virtual-tour__grid">
                    <div class="virtual-tour__media">
                        <?php if ( 'video' === $tour_media_type ) : ?>
                            <div class="tour-video">
                                <?php echo camara_render_embed( $tour_video_embed ); ?>
                            </div>
                        <?php else : ?>
                            <div class="tour-slider" data-tour-slider>
                                <div class="tour-slider__stage">
                                    <?php foreach ( $tour_slides as $index => $slide ) : ?>
                                        <figure class="tour-slider__slide <?php echo 0 === $index ? 'is-active' : ''; ?>" data-tour-slide>
                                            <img src="<?php echo esc_url( $slide['image'] ); ?>" alt="<?php echo esc_attr( $slide['alt'] ); ?>">
                                        </figure>
                                    <?php endforeach; ?>
                                </div>
                                <?php if ( $tour_has_multiple_slides ) : ?>
                                    <div class="tour-slider__thumbs" role="tablist">
                                        <?php foreach ( $tour_slides as $index => $slide ) : ?>
                                            <button
                                                type="button"
                                                class="tour-slider__thumb <?php echo 0 === $index ? 'is-active' : ''; ?>"
                                                data-tour-thumb="<?php echo esc_attr( $index ); ?>"
                                                role="tab"
                                                aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
                                                aria-label="<?php printf( esc_attr__( 'Ver imagem %d do tour', 'camara-hotsite' ), $index + 1 ); ?>"
                                            >
                                                <img src="<?php echo esc_url( $slide['thumb'] ); ?>" alt="">
                                            </button>
                                        <?php endforeach; ?>
                                    </div>
                                    <button type="button" class="tour-slider__control tour-slider__control--prev" data-tour-nav="prev">
                                        <span class="sr-only"><?php esc_html_e('Slide anterior', 'camara-hotsite'); ?></span>
                                    </button>
                                    <button type="button" class="tour-slider__control tour-slider__control--next" data-tour-nav="next">
                                        <span class="sr-only"><?php esc_html_e('Próximo slide', 'camara-hotsite'); ?></span>
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="virtual-tour__content">
                        <p class="virtual-tour__eyebrow"><?php esc_html_e('Não conseguiu agendar?', 'camara-hotsite'); ?></p>
                        <h2 class="virtual-tour__title"><?php esc_html_e('Faça um tour virtual', 'camara-hotsite'); ?></h2>
                        <p><?php esc_html_e('Está longe da cidade? Não tem tempo de visitar o Palácio Anchieta pessoalmente?', 'camara-hotsite'); ?></p>
                        <p><?php esc_html_e('Vamos fazer o Tour Virtual!', 'camara-hotsite'); ?></p>
                        <a class="btn virtual-tour__button" href="#" target="_blank" rel="noreferrer"><?php esc_html_e('Tour virtual', 'camara-hotsite'); ?></a>
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
                            <p><?php esc_html_e('Bem-vindo ao canal de comunicação “Fale Conosco” da Câmara Municipal de São Paulo. Esse canal o ajudará a dar seu feedback e a resolver suas dúvidas.', 'camara-hotsite'); ?></p>
                            <p><strong><?php esc_html_e('Central Telefônica:', 'camara-hotsite'); ?></strong></p>
                            <p><?php esc_html_e('Para um atendimento imediato e personalizado, nossa equipe da central telefônica está disponível das 10h às 19h pelo número (11) 3396-4000.', 'camara-hotsite'); ?></p>
                        </div>

                        <div class="contact-panel__card">
                            <form class="contact-form contact-form--compact" action="#" method="post">
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
                            </form>
                            <p class="contact-panel__note"><?php esc_html_e('O seu contato é muito importante para nós! Seus dados estão seguros e protegidos com a', 'camara-hotsite'); ?> <strong><?php esc_html_e('LGPD', 'camara-hotsite'); ?></strong></p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</main>

<?php get_footer(); ?>
