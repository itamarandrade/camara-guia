<?php
    get_header();

    $hero_image      = camara_get_theme_image('hero_image');
    $calendar_image  = camara_get_theme_image('calendar_image');
    $gallery_one     = camara_get_theme_image('gallery_image_one');
    $gallery_two     = camara_get_theme_image('gallery_image_two');
    $gallery_three   = camara_get_theme_image('gallery_image_three');
    $tour_image      = camara_get_theme_image('tour_image');

    $hero_style = $hero_image
        ? 'style="background-image: linear-gradient(120deg, rgba(5,5,10,0.95), rgba(5,5,10,0.4)), url(' . esc_url( $hero_image ) . ');"'
        : '';
    $tour_style = $tour_image
        ? 'style="background-image: linear-gradient(rgba(0,0,0,0.15), rgba(0,0,0,0.15)), url(' . esc_url( $tour_image ) . ');"'
        : '';
?>

<main id="primary" class="site-main">

    <section class="hero" <?php echo $hero_style; ?>>
        <div class="hero__wave" aria-hidden="true"></div>
        <div class="container hero__content">
            <span class="hero__badge"><?php esc_html_e('Guia do Visitante', 'camara-hotsite'); ?></span>
            <h1>
                <strong><?php esc_html_e('Guia do Visitante', 'camara-hotsite'); ?></strong>
                <span><?php esc_html_e('Palácio Anchieta', 'camara-hotsite'); ?></span>
            </h1>
            <p><?php esc_html_e('Conheça cada detalhe do Legislativo paulistano com roteiros guiados e experiências completas.', 'camara-hotsite'); ?></p>
            <div class="hero__dots" role="presentation">
                <span class="is-active"></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </section>

    <section class="section discover">
        <div class="container discover__grid">
            <div class="discover__content">
                <p class="section-eyebrow"><?php esc_html_e('Venha conhecer a Câmara Municipal de São Paulo', 'camara-hotsite'); ?></p>
                <div class="discover__card">
                    <p><?php esc_html_e('O Palácio Anchieta convida você para uma viagem no tempo! Arquitetura única, obras de arte e uma aula sobre o passado político, social e cultural de São Paulo.', 'camara-hotsite'); ?></p>
                </div>
                <div class="discover__invite">
                    <p class="section-eyebrow"><?php esc_html_e('Você é nosso convidado especial!', 'camara-hotsite'); ?></p>
                    <h2><?php esc_html_e('Agende a sua visita', 'camara-hotsite'); ?></h2>
                    <p><?php esc_html_e('Escolha o melhor dia para viver essa experiência. Nossa equipe está pronta para receber grupos, escolas e visitantes individuais com roteiros personalizados.', 'camara-hotsite'); ?></p>
                    <a class="btn" href="#contato"><?php esc_html_e('Agendar agora', 'camara-hotsite'); ?></a>
                </div>
            </div>

            <div class="discover__media">
                <figure class="calendar-card">
                    <img src="<?php echo esc_url( $calendar_image ?: camara_placeholder_image('Calendário') ); ?>" alt="<?php esc_attr_e('Calendário de visitas', 'camara-hotsite'); ?>">
                </figure>
                <div class="discover__gallery">
                    <figure class="gallery-hex">
                        <img src="<?php echo esc_url( $gallery_one ?: camara_placeholder_image('Arquitetura') ); ?>" alt="<?php esc_attr_e('Detalhes arquitetônicos da Câmara', 'camara-hotsite'); ?>">
                    </figure>
                    <figure class="gallery-hex">
                        <img src="<?php echo esc_url( $gallery_two ?: camara_placeholder_image('Memória') ); ?>" alt="<?php esc_attr_e('Galeria de ex-presidentes', 'camara-hotsite'); ?>">
                    </figure>
                    <figure class="gallery-hex">
                        <img src="<?php echo esc_url( $gallery_three ?: camara_placeholder_image('Arte') ); ?>" alt="<?php esc_attr_e('Obras em exposição no Palácio', 'camara-hotsite'); ?>">
                    </figure>
                </div>
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
