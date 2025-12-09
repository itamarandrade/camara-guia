<?php
    get_header();

    $hero_slides     = [];
    $hero_slider_ids = camara_get_theme_option( 'hero_slider_images', [] );
    $calendar_image  = camara_get_theme_image('calendar_image');
    $gallery_one     = camara_get_theme_image('gallery_image_one');
    $gallery_two     = camara_get_theme_image('gallery_image_two');
    $gallery_three   = camara_get_theme_image('gallery_image_three');
    $tour_image      = camara_get_theme_image('tour_image');
    $discover_hex_id = camara_get_theme_option( 'discover_hex_image' );
    $discover_hex_image = $discover_hex_id ? wp_get_attachment_image_url( absint( $discover_hex_id ), 'full' ) : '';

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

    $tour_style = $tour_image
        ? 'style="background-image: linear-gradient(rgba(0,0,0,0.15), rgba(0,0,0,0.15)), url(' . esc_url( $tour_image ) . ');"'
        : '';
?>

<main id="primary" class="site-main">

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

    <section class="section discover">
        <div class="container discover__layout">
            <div class="discover__intro">
                <p class="discover__headline"><?php esc_html_e('Venha conhecer a Câmara Municipal de São Paulo', 'camara-hotsite'); ?></p>
                <div class="discover__message">
                    <p><?php esc_html_e('O Palácio Anchieta convida você para uma viagem no tempo! Arquitetura única, obras de arte e uma aula sobre o passado político, social e cultural de São Paulo.', 'camara-hotsite'); ?></p>
                </div>
            </div>

            <div class="discover__cta">
                <p class="discover__cta-eyebrow"><?php esc_html_e('Você é nosso convidado especial!', 'camara-hotsite'); ?></p>
                <p class="discover__cta-main"><?php esc_html_e('Agende a sua visita', 'camara-hotsite'); ?></p>
            </div>

            <div class="discover__visual">
                <figure class="calendar-card discover__calendar">
                    <img src="<?php echo esc_url( $calendar_image ?: camara_placeholder_image('Calendário') ); ?>" alt="<?php esc_attr_e('Calendário de visitas', 'camara-hotsite'); ?>">
                </figure>
                <figure class="discover__hex">
                    <img src="<?php echo esc_url( $discover_hex_image ?: camara_placeholder_image( __( 'Hexágonos', 'camara-hotsite' ) ) ); ?>" alt="<?php esc_attr_e('Composição de imagens em formato de hexágono da Câmara Municipal', 'camara-hotsite'); ?>">
                </figure>
            </div>
        </div>
    </section>

    <section class="section virtual-tour">
        <div class="container virtual-tour__grid">
            <div class="virtual-tour__media" <?php echo $tour_style; ?>>
                <span class="sr-only"><?php esc_html_e('Auditório da Câmara Municipal', 'camara-hotsite'); ?></span>
            </div>
            <div class="virtual-tour__content">
                <p class="section-eyebrow"><?php esc_html_e('Não conseguiu agendar?', 'camara-hotsite'); ?></p>
                <h2><?php esc_html_e('Faça um tour virtual', 'camara-hotsite'); ?></h2>
                <p><?php esc_html_e('Está longe da cidade ou sem tempo para visitar o Palácio Anchieta pessoalmente? Explore cada ambiente através do nosso tour virtual e viva a experiência de conhecer o Legislativo paulistano onde estiver.', 'camara-hotsite'); ?></p>
                <a class="btn" href="#" target="_blank" rel="noreferrer"><?php esc_html_e('Tour virtual', 'camara-hotsite'); ?></a>
            </div>
        </div>
    </section>

    <section class="section contact-panel" id="contato">
        <div class="container contact-panel__grid">
            <div class="contact-panel__content">
                <div class="contact-panel__ribbon"><?php esc_html_e('Fale com a Câmara!', 'camara-hotsite'); ?></div>
                <p><?php esc_html_e('Bem-vindo ao canal “Fale Conosco” da Câmara Municipal de São Paulo. Esse canal ajuda você a enviar feedbacks, tirar dúvidas e acompanhar o seu atendimento.', 'camara-hotsite'); ?></p>
                <p><?php esc_html_e('Central telefônica disponível das 10h às 19h pelo número (11) 3396-4000. Nosso time está pronto para oferecer um atendimento personalizado e seguro.', 'camara-hotsite'); ?></p>
                <ul>
                    <li><strong><?php esc_html_e('Nome'); ?>:</strong> <?php esc_html_e('Informe como deseja ser chamado para facilitar o contato.', 'camara-hotsite'); ?></li>
                    <li><strong><?php esc_html_e('Telefone'); ?>:</strong> <?php esc_html_e('Use um número com WhatsApp para retornos rápidos.', 'camara-hotsite'); ?></li>
                    <li><strong><?php esc_html_e('E-mail'); ?>:</strong> <?php esc_html_e('Receba a confirmação do seu atendimento diretamente na caixa de entrada.', 'camara-hotsite'); ?></li>
                </ul>
                <p class="lgpd"><?php esc_html_e('Seus dados estão protegidos com a LGPD. Utilize esse canal para enviar sugestões, críticas ou solicitações.', 'camara-hotsite'); ?></p>
            </div>

            <form class="contact-form" action="#" method="post">
                <div class="form-row">
                    <label for="contact-name"><?php esc_html_e('Nome', 'camara-hotsite'); ?></label>
                    <input type="text" id="contact-name" name="nome" placeholder="<?php esc_attr_e('Seu nome completo', 'camara-hotsite'); ?>" required>
                </div>
                <div class="form-row">
                    <label for="contact-phone"><?php esc_html_e('Telefone', 'camara-hotsite'); ?></label>
                    <input type="tel" id="contact-phone" name="telefone" placeholder="(11) 0000-0000">
                </div>
                <div class="form-row">
                    <label for="contact-email"><?php esc_html_e('E-mail', 'camara-hotsite'); ?></label>
                    <input type="email" id="contact-email" name="email" placeholder="email@dominio.com" required>
                </div>
                <div class="form-row">
                    <label for="contact-message"><?php esc_html_e('Mensagem', 'camara-hotsite'); ?></label>
                    <textarea id="contact-message" name="mensagem" rows="4" placeholder="<?php esc_attr_e('Digite sua mensagem', 'camara-hotsite'); ?>" required></textarea>
                </div>
                <button class="btn" type="submit"><?php esc_html_e('Enviar mensagem', 'camara-hotsite'); ?></button>
            </form>
        </div>
    </section>

</main>

<?php get_footer(); ?>
