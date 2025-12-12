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

$sidebar_links = camara_get_side_menu_links();
$page_id       = get_the_ID();
$hero_image    = '';

if ( has_post_thumbnail( $page_id ) ) {
    $hero_image = get_the_post_thumbnail_url( $page_id, 'full' );
}

if ( ! $hero_image ) {
    $hero_image = camara_get_theme_image( 'hero_image' );
}

if ( ! $hero_image ) {
    $hero_image = camara_placeholder_image( __( 'Visitas', 'camara-hotsite' ) );
}

$visit_modes = [
    [
        'title'   => __( 'Visitas institucionais', 'camara-hotsite' ),
        'content' => __( 'Ligue para o Cerimonial no número (11) 3396-4696 e confirme o agendamento por e-mail para agenda@saopaulo.sp.leg.br.', 'camara-hotsite' ),
    ],
    [
        'title'   => __( 'Visitas guiadas', 'camara-hotsite' ),
        'content' => __( 'Programa "Câmara Aberta". Verifique o site da Câmara Municipal para o link de inscrição. O agendamento acontece em plataformas como o Sympla e o link fica disponível na página inicial do site.', 'camara-hotsite' ),
    ],
    [
        'title'   => __( 'Visitas online', 'camara-hotsite' ),
        'content' => __( 'Nossa visita online é guiada para que você receba a mesma experiência das visitas presenciais.', 'camara-hotsite' ),
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
?>

<main class="visitas-page">
    <section class="visitas-hero" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');">
        <div class="visitas-hero__overlay"></div>
        <div class="container">
            <div class="visitas-hero__content">
                <span class="visitas-hero__eyebrow"><?php esc_html_e( 'Guia do Visitante', 'camara-hotsite' ); ?></span>
                <h1><?php esc_html_e( 'Palácio Anchieta', 'camara-hotsite' ); ?></h1>
            </div>
        </div>
    </section>

    <div class="container visitas-layout">
        <button class="visitas-sidebar__toggle" type="button" data-visitas-sidebar-toggle aria-controls="visitas-sidebar" aria-expanded="false">
            <span></span>
            <strong><?php esc_html_e( 'Menu Hambúrguer', 'camara-hotsite' ); ?></strong>
        </button>

        <aside class="visitas-sidebar" id="visitas-sidebar" data-visitas-sidebar>
            <div class="visitas-sidebar__header">
                <p><?php esc_html_e( 'Menu Hambúrguer', 'camara-hotsite' ); ?></p>
                <button class="visitas-sidebar__close" type="button" data-visitas-sidebar-close>
                    <span aria-hidden="true"></span>
                    <span class="sr-only"><?php esc_html_e( 'Fechar menu lateral', 'camara-hotsite' ); ?></span>
                </button>
            </div>
            <nav class="visitas-sidebar__nav" aria-label="<?php esc_attr_e( 'Menu lateral', 'camara-hotsite' ); ?>">
                <ul>
                    <?php foreach ( $sidebar_links as $link ) :
                        $is_active = 'visitas' === $link['slug'];
                        $is_external = ! empty( $link['external'] );
                        $rel = $is_external ? 'noreferrer noopener' : '';
                    ?>
                        <li class="<?php echo $is_active ? 'is-active' : ''; ?>">
                            <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" <?php echo $rel ? 'rel="' . esc_attr( $rel ) . '"' : ''; ?>>
                                <?php echo esc_html( $link['label'] ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </aside>
        <div class="visitas-sidebar__overlay" data-visitas-sidebar-close></div>

        <article class="visitas-content">
            <section class="visitas-intro">
                <header>
                    <h2><?php esc_html_e( 'Guia do visitante', 'camara-hotsite' ); ?></h2>
                    <p><?php esc_html_e( 'Seja bem-vindo ao Palácio Anchieta, sede da Câmara Municipal de São Paulo! Aqui você mergulha na história do Parlamento paulistano, cujo marco remonta a 1560. Além dos andares expositivos, o Legislativo possui ambientes grandiosos, como a Galeria dos Presidentes e o Plenário 1º de Maio.', 'camara-hotsite' ); ?></p>
                    <p><?php esc_html_e( 'O Palácio Anchieta fica aberto das 9h às 17h, em fins de semana selecionados, com uma programação dedicada ao público.', 'camara-hotsite' ); ?></p>
                    <p><?php esc_html_e( 'Dispomos de visitas online, guiadas e institucionais. Consulte a nossa agenda e venha conhecer a Câmara Municipal de São Paulo!', 'camara-hotsite' ); ?></p>
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
                    <form class="visitas-form" action="#" method="post">
                        <label>
                            <span><?php esc_html_e( 'Nome', 'camara-hotsite' ); ?></span>
                            <input type="text" name="visitas-nome" required>
                        </label>
                        <label>
                            <span><?php esc_html_e( 'Telefone', 'camara-hotsite' ); ?></span>
                            <input type="tel" name="visitas-telefone">
                        </label>
                        <label>
                            <span><?php esc_html_e( 'E-mail', 'camara-hotsite' ); ?></span>
                            <input type="email" name="visitas-email" required>
                        </label>
                        <button type="submit" class="btn"><?php esc_html_e( 'Enviar', 'camara-hotsite' ); ?></button>
                    </form>
                </div>
            </section>
        </article>
    </div>
</main>

<?php get_footer(); ?>
