<?php
/**
 * Página personalizada de Visitas.
 *
 * @package CamaraGuia
 */

get_header();

if ( have_posts() ) {
    the_post();
}

$hero_slides     = [];
$hero_slider_ids = camara_get_theme_option( 'hero_slider_images', [] );

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

$visit_modes = [
    [
        'title'   => __( 'Visitas institucionais', 'camara-hotsite' ),
        'content' => __( 'Ligue para o Cerimonial no número (11) 3396-4696 e confirme o agendamento por e-mail para agenda@saopaulo.sp.leg.br.', 'camara-hotsite' ),
    ],
    [
        'title'   => __( 'Visitas guiadas', 'camara-hotsite' ),
        'content' => __( 'A Câmara Municipal de São Paulo possui o projeto “Câmara Aberta”. A proposta é abrir o legislativo paulistano, suas obras de arte, arquitetura e história para quem visita o Palácio Anchieta. As visitas podem acontecer às sextas, sábados e domingos. São gratuitas e livres para qualquer faixa etária. O projeto é em parceria com o time do “Vai de Roteiro” e os ingressos podem ser reservados pelo Sympla. Acesse o site dedicado, confira as próximas datas, o roteiro completo e reserve a sua vaga. </br> O projeto “Câmara Aberta” conta, ainda, com um espaço infantil dedicado ao lazer e à convivência das crianças. No térreo do Palácio Anchieta, o Pátio Papa Francisco recebe um playground especialmente preparado para o público infantil, disponível durante o evento. Para garantir a segurança, as crianças devem estar sempre acompanhadas por um responsável.', 'camara-hotsite' ),
    ],
    [
        'title'   => __( 'Tour Virtual', 'camara-hotsite' ),
        'content' => __( 'Nossa Tour Virtual é guiada para que você receba a mesma experiência das visitas presenciais.', 'camara-hotsite' ),
    ],
];

$calendar_header = [
    __( 'Dom', 'camara-hotsite' ),
    __( 'Seg', 'camara-hotsite' ),
    __( 'Ter', 'camara-hotsite' ),
    __( 'Qua', 'camara-hotsite' ),
    __( 'Qui', 'camara-hotsite' ),
    __( 'Sex', 'camara-hotsite' ),
    __( 'Sáb', 'camara-hotsite' ),
];

$calendar_weeks = [
    [ '', '', '', '', '', 1, 2 ],
    [ 3, 4, 5, 6, 7, 8, 9 ],
    [ 10, 11, 12, 13, 14, 15, 16 ],
    [ 17, 18, 19, 20, 21, 22, 23 ],
    [ 24, 25, 26, 27, 28, 29, 30 ],
    [ 31, '', '', '', '', '', '' ],
];

$calendar_highlights = [
    4  => 'is-gold',
    5  => 'is-blue',
    6  => 'is-green',
    7  => 'is-purple',
    11 => 'is-gold',
    12 => 'is-blue',
    13 => 'is-green',
    18 => 'is-gold',
    19 => 'is-blue',
    20 => 'is-green',
    26 => 'is-purple',
];

$agendar_items = [
    __( 'Onde retirar: Sympla.', 'camara-hotsite' ),
    __( 'Informações obrigatórias: nome completo, telefone, e-mail, RG e CPF (serão confirmadas na recepção).', 'camara-hotsite' ),
    __( 'Horários: sábados e domingos (exceto feriados e dias de Projeto Câmara na Rua); às 11h e às 12h30.', 'camara-hotsite' ),
    __( 'Duração aproximada: 1 hora.', 'camara-hotsite' ),
    __( 'Limite por grupo: 30 pessoas.', 'camara-hotsite' ),
    __( 'Ingressos são liberados no Sympla com uma semana de antecedência.', 'camara-hotsite' ),
];

$roteiro = [
    __( 'Térreo: recepção, apresentação das inscrições comemorativas em mármore e história da inauguração (1969).', 'camara-hotsite' ),
    __( '8º andar: Galeria dos Presidentes, Sala Tiradentes, Sala Nobre e Sala da Presidência.', 'camara-hotsite' ),
    __( '2º andar: painel fotográfico de Sebastião Salgado.', 'camara-hotsite' ),
    __( '1º andar: Auditório Prestes Maia e Plenário 1º de Maio (ou Galeria, caso haja evento).', 'camara-hotsite' ),
    __( 'Durante o tour você conhece o funcionamento das sessões plenárias, reuniões de comissões e audiências públicas.', 'camara-hotsite' ),
];

$modalidades = [
    [
        'title' => __( 'Visita Escolar (10 anos ou mais)', 'camara-hotsite' ),
        'lines' => [
            __( 'Terça a quinta-feira, das 14h às 16h.', 'camara-hotsite' ),
            __( 'Capacidade: 15 a 40 alunos.', 'camara-hotsite' ),
            __( 'Agendamento: visitas@saopaulo.sp.leg.br', 'camara-hotsite' ),
        ],
    ],
    [
        'title' => __( 'Visita à Horta', 'camara-hotsite' ),
        'lines' => [
            __( 'Segunda a sexta-feira, das 8h às 16h.', 'camara-hotsite' ),
            __( 'Acesso pela Rua Santo Amaro, 45.', 'camara-hotsite' ),
            __( 'Agendamento: sampamaisrural.prefeitura.sp.gov.br/contato', 'camara-hotsite' ),
        ],
    ],
];

$visitas_status = isset( $_GET['visitas-status'] ) ? sanitize_text_field( wp_unslash( $_GET['visitas-status'] ) ) : '';
?>

<main id="primary" class="visitas-page" tabindex="-1">
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
        <article class="visitas-content">
            <section class="visitas-intro">
                <header>
                    <h2><?php esc_html_e( 'Guia do visitante', 'camara-hotsite' ); ?></h2>
                    <p><?php esc_html_e( 'Boas-vindas ao Palácio Anchieta, sede da Câmara Municipal de São Paulo!', 'camara-hotsite' ); ?></p>
                    <p><?php esc_html_e( 'O prédio que abriga a Câmara Municipal de São Paulo é um marco arquitetônico do centro da capital paulista e está de portas abertas para receber visitantes interessados em conhecer um pouco mais sobre o Poder Legislativo municipal.', 'camara-hotsite' ); ?></p>
                    <p><?php esc_html_e( 'Aqui, vereadoras e vereadores, representantes do povo, dedicam-se a discutir e elaborar leis, a fiscalizar e controlar os atos do Poder Executivo, a aprovar o Orçamento da Cidade, entre outras atribuições de fundiamental importância para a cidade de São Paulo.', 'camara-hotsite' ); ?></p>
                    <p><?php esc_html_e( 'Esperamos que a visita à Câmara Municipal de São Paulo amplie a compreensão sobre a história e o papel da Instituição', 'camara-hotsite' ); ?></p>
                    <p><?php esc_html_e( 'Nosso endereço é: Viaduto Jacareí, 100 - CEP: 01319-900 - Bela Vista, no centro de São Paulo. Estamos próximos ao Metrô Anhangabaú (Linha Vermelha do Metrô) e Terminal Bandeira de Ônibus.', 'camara-hotsite' ); ?></p>
                    <p><?php esc_html_e( 'Para que você aproveite ao máximo a visita à Câmara Municipal, observe estas orientações:', 'camara-hotsite' ); ?></p>
                </header>

                <div class="visitas-modes">
                    <?php foreach ( $visit_modes as $mode ) : ?>
                        <article class="visitas-card">
                            <h3><?php echo esc_html( $mode['title'] ); ?></h3>
                            <p><?php echo esc_html( $mode['content'] ); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="visitas-section">
                <div class="visitas-section__title">
                    <span><?php esc_html_e( 'Como agendar', 'camara-hotsite' ); ?></span>
                </div>
                <div class="visitas-section__content">
                    <ul class="visitas-list">
                        <?php foreach ( $agendar_items as $item ) : ?>
                            <li><?php echo esc_html( $item ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>

            <section class="visitas-section visitas-section--calendar">
                <div class="visitas-section__title">
                    <span><?php esc_html_e( 'Agende a sua visita', 'camara-hotsite' ); ?></span>
                </div>
                <div class="visitas-section__content">
                    <p><?php esc_html_e( 'Consulte o cronograma, conheça os projetos e garanta sua vaga.', 'camara-hotsite' ); ?></p>
                    <div class="visitas-calendar">
                        <header>
                            <strong><?php esc_html_e( 'Dezembro 2025', 'camara-hotsite' ); ?></strong>
                        </header>
                        <div class="visitas-calendar__grid" role="grid">
                            <div class="visitas-calendar__row visitas-calendar__row--head" role="row">
                                <?php foreach ( $calendar_header as $label ) : ?>
                                    <span role="columnheader"><?php echo esc_html( $label ); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php foreach ( $calendar_weeks as $week ) : ?>
                                <div class="visitas-calendar__row" role="row">
                                    <?php foreach ( $week as $day ) :
                                        $classes = [ 'visitas-calendar__cell' ];
                                        if ( isset( $calendar_highlights[ $day ] ) ) {
                                            $classes[] = $calendar_highlights[ $day ];
                                        }
                                        if ( '' === $day ) {
                                            $classes[] = 'is-empty';
                                        }
                                    ?>
                                        <span class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" role="gridcell">
                                            <?php echo '' !== $day ? esc_html( $day ) : ''; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="visitas-calendar__legend">
                            <span><i class="is-gold"></i><?php esc_html_e( 'Institucional', 'camara-hotsite' ); ?></span>
                            <span><i class="is-blue"></i><?php esc_html_e( 'Guiada', 'camara-hotsite' ); ?></span>
                            <span><i class="is-green"></i><?php esc_html_e( 'Projetos especiais', 'camara-hotsite' ); ?></span>
                            <span><i class="is-purple"></i><?php esc_html_e( 'Feiras e eventos', 'camara-hotsite' ); ?></span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="visitas-section">
                <div class="visitas-section__title">
                    <span><?php esc_html_e( 'Roteiro da visita', 'camara-hotsite' ); ?></span>
                </div>
                <div class="visitas-section__content">
                    <ul class="visitas-list">
                        <?php foreach ( $roteiro as $item ) : ?>
                            <li><?php echo esc_html( $item ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>

            <section class="visitas-section visitas-section--modalidades">
                <div class="visitas-section__title">
                    <span><?php esc_html_e( 'Outras modalidades', 'camara-hotsite' ); ?></span>
                </div>
                <div class="visitas-section__content visitas-section__content--cards">
                    <?php foreach ( $modalidades as $modalidade ) : ?>
                        <article class="visitas-card visitas-card--stacked">
                            <h3><?php echo esc_html( $modalidade['title'] ); ?></h3>
                            <?php foreach ( $modalidade['lines'] as $line ) : ?>
                                <p><?php echo esc_html( $line ); ?></p>
                            <?php endforeach; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="visitas-section">
                <div class="visitas-section__title">
                    <span><?php esc_html_e( 'Feiras', 'camara-hotsite' ); ?></span>
                </div>
                <div class="visitas-section__content">
                    <h3><?php esc_html_e( 'Feira de Artesanato e Gastronomia', 'camara-hotsite' ); ?></h3>
                    <p><?php esc_html_e( 'Quem não garantir vaga nas visitas poderá aproveitar outras atrações na Câmara. Em parceria com a Secretaria Municipal de Desenvolvimento Econômico, realizamos no térreo a feira de gastronomia e artesanato.', 'camara-hotsite' ); ?></p>
                    <p><?php esc_html_e( 'Os empreendedores do projeto Mãos e Mentes Paulistanas expõem produtos e o público descobre diversas opções.', 'camara-hotsite' ); ?></p>
                </div>
            </section>

            <section class="visitas-section visitas-section--contact">
                <div class="visitas-section__title">
                    <span><?php esc_html_e( 'Contato e dúvida', 'camara-hotsite' ); ?></span>
                </div>
                <div class="visitas-contact">
                    <div>
                        <p><?php esc_html_e( 'Em caso de dúvidas e informações adicionais, escreva para visitas@saopaulo.sp.leg.br ou ligue para (11) 3396-4692.', 'camara-hotsite' ); ?></p>
                        <p><?php esc_html_e( 'Estamos ansiosos para receber você!', 'camara-hotsite' ); ?></p>
                    </div>
                    <form class="visitas-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                        <?php if ( 'success' === $visitas_status ) : ?>
                            <div class="form-alert form-alert--success" role="status" aria-live="polite">
                                <?php esc_html_e( 'Recebemos sua mensagem. Nossa equipe retornará em breve.', 'camara-hotsite' ); ?>
                            </div>
                        <?php elseif ( 'error' === $visitas_status ) : ?>
                            <div class="form-alert form-alert--error" role="alert" aria-live="assertive">
                                <?php esc_html_e( 'Não conseguimos enviar sua mensagem. Por favor, tente novamente.', 'camara-hotsite' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php wp_nonce_field( 'camara_contact_form', 'camara_contact_form_nonce' ); ?>
                        <input type="hidden" name="action" value="camara_contact_form">
                        <input type="hidden" name="camara_form_id" value="visitas-contato">
                        <input type="hidden" name="camara_form_context" value="<?php esc_attr_e( 'Contato sobre visitas', 'camara-hotsite' ); ?>">
                        <input type="hidden" name="camara_status_param" value="visitas-status">
                        <input type="hidden" name="camara_redirect_to" value="<?php echo esc_url( get_permalink() ); ?>">
                        <label>
                            <span><?php esc_html_e( 'Nome', 'camara-hotsite' ); ?></span>
                            <input type="text" name="nome" required>
                        </label>
                        <label>
                            <span><?php esc_html_e( 'Telefone', 'camara-hotsite' ); ?></span>
                            <input type="tel" name="telefone">
                        </label>
                        <label>
                            <span><?php esc_html_e( 'E-mail', 'camara-hotsite' ); ?></span>
                            <input type="email" name="email" required>
                        </label>
                        <label>
                            <span><?php esc_html_e( 'Mensagem', 'camara-hotsite' ); ?></span>
                            <textarea name="mensagem" rows="4"></textarea>
                        </label>
                        <div class="visitas-form__consent">
                            <input type="checkbox" id="visitas-lgpd" name="lgpd_consent" value="1" required>
                            <label for="visitas-lgpd">
                                <?php esc_html_e( 'Autorizo o uso dos meus dados para receber retorno da Câmara, conforme a LGPD.', 'camara-hotsite' ); ?>
                            </label>
                        </div>
                        <button type="submit" class="btn"><?php esc_html_e( 'Enviar', 'camara-hotsite' ); ?></button>
                    </form>
                </div>
            </section>
        </article>
    </div>
</main>

<?php get_footer(); ?>
