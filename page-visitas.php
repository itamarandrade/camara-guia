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

$hero_slides = camara_get_page_hero_slides( 'visitas' );

$visitas_intro = [
    __( 'O prédio que abriga a Câmara Municipal de São Paulo é um marco arquitetônico do centro da capital paulista e está de portas abertas para receber visitantes interessados em conhecer um pouco mais sobre o Poder Legislativo municipal.', 'camara-hotsite' ),
    __( 'Aqui, vereadoras e vereadores, representantes do povo, dedicam-se a discutir e elaborar leis, a fiscalizar e controlar os atos do Poder Executivo, a aprovar o Orçamento da Cidade, entre outras atribuições de fundamental importância para a cidade de São Paulo.', 'camara-hotsite' ),
    __( 'Esperamos que a visita à Câmara Municipal de São Paulo amplie a compreensão sobre a história e o papel da Instituição.', 'camara-hotsite' ),
    __( 'Nosso endereço é: Viaduto Jacareí, 100 - CEP: 01319-900 - Bela Vista, no centro de São Paulo. Estamos próximos ao Metrô Anhangabaú (Linha Vermelha do Metrô) e Terminal Bandeira de Ônibus.', 'camara-hotsite' ),
];

$visitas_status = isset( $_GET['visitas-status'] ) ? sanitize_text_field( wp_unslash( $_GET['visitas-status'] ) ) : '';
?>

<main id="primary" class="visitas-page visitas-page--guide" tabindex="-1">
    <section class="hero hero--visitas" data-hero>
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
        <div class="hero__wave" aria-hidden="true"></div>
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
                <h2 class="visitas-intro__title">
                    <?php esc_html_e( 'Boas-vindas ao Palácio Anchieta, sede da Câmara Municipal de São Paulo!', 'camara-hotsite' ); ?>
                </h2>
                <?php foreach ( $visitas_intro as $paragraph ) : ?>
                    <p><?php echo esc_html( $paragraph ); ?></p>
                <?php endforeach; ?>
            </section>

            <section class="visitas-topics" aria-labelledby="visitas-topics-title">
                <h2 id="visitas-topics-title" class="sr-only"><?php esc_html_e( 'Visitas', 'camara-hotsite' ); ?></h2>

                <article class="visitas-topic" id="visitas-guiadas">
                    <header class="visitas-topic__title">
                        <span><?php esc_html_e( 'Visitas guiadas', 'camara-hotsite' ); ?></span>
                    </header>
                    <div class="visitas-topic__content">
                        <p>
                            <?php
                            printf(
                                wp_kses_post( __( 'A Câmara Municipal de São Paulo possui o projeto “Câmara Aberta”. A proposta é abrir o legislativo paulistano, suas obras de arte, arquitetura e história para quem visita o Palácio Anchieta. As visitas podem acontecer às sextas, sábados e domingos. São gratuitas e livres para qualquer faixa etária. O projeto é em parceria com o time do <a href="%s" target="_blank" rel="noopener">“Vai de Roteiro”</a> e os ingressos podem ser reservados pelo Sympla. Acesse o <a href="%s" target="_blank" rel="noopener">site dedicado</a>, confira as próximas datas, o roteiro completo e reserve a sua vaga.', 'camara-hotsite' ) ),
                                esc_url( 'https://prefeitura.sp.gov.br/web/turismo/w/menu/vai-de-roteiro-melhor-forma-de-conhecer-sp','https://www.saopaulo.sp.leg.br/camaraaberta/'  )
                            );
                            ?>
                        </p>
                        <p><?php esc_html_e( 'O projeto “Câmara Aberta” conta, ainda, com um espaço infantil dedicado ao lazer e à convivência das crianças. No térreo do Palácio Anchieta, o Pátio Papa Francisco recebe um playground especialmente preparado para o público infantil, disponível durante o evento. Para garantir a segurança, as crianças devem estar sempre acompanhadas por um responsável.', 'camara-hotsite' ); ?></p>
                        <p><?php esc_html_e( 'https://www.saopaulo.sp.leg.br/camaraaberta/', 'camara-hotsite' ); ?></p>
                    </div>
                </article>

                <article class="visitas-topic" id="visitas-institucionais">
                    <header class="visitas-topic__title">
                        <span><?php esc_html_e( 'Visitas institucionais', 'camara-hotsite' ); ?></span>
                    </header>
                    <div class="visitas-topic__content">
                        <p><?php esc_html_e( 'A Câmara promove o Programa de Visita Institucional de caráter educativo, conduzido pela Equipe de Eventos da Câmara Municipal de São Paulo, composto de:', 'camara-hotsite' ); ?></p>
                        <ul class="visitas-topic__list">
                            <li><?php esc_html_e( 'Palestra sobre a história da cidade, da Câmara Municipal e sobre o processo legislativo.', 'camara-hotsite' ); ?></li>
                            <li><?php esc_html_e( 'Visita à galeria do Plenário 1º de Maio.', 'camara-hotsite' ); ?></li>
                        </ul>
                        <p><?php esc_html_e( 'Podem participar grupos organizados, com 15 a 40 pessoas, a partir de 10 anos, de escolas, universidades, associações de bairro, organizações, institutos, entre outros. É recomendável que os grupos sejam acompanhados por dois responsáveis.', 'camara-hotsite' ); ?></p>
                        <p><?php esc_html_e( 'As visitas ocorrem de 3ª, 4ª e 5ª, das 14h às 16h.', 'camara-hotsite' ); ?></p>
                        <p><?php esc_html_e( 'Todos os grupos recebem um exemplar da Lei Orgânica do Município, um exemplar do Regimento Interno e folder a respeito dos prêmios institucionais.', 'camara-hotsite' ); ?></p>
                        <p><?php esc_html_e( 'Observação: Não fornecemos transporte.', 'camara-hotsite' ); ?></p>
                        <p>
                            <?php
                            printf(
                                wp_kses_post( __( 'O pré-agendamento deve ser feito por contato telefônico no: (11) 3396-4667 ou (11) 3396-4486 e, posteriormente, confirmado por e-mail no endereço: <a href="%s">visitas@saopaulo.sp.leg.br</a>.', 'camara-hotsite' ) ),
                                esc_url( 'mailto:visitas@saopaulo.sp.leg.br' )
                            );
                            ?>
                        </p>
                    </div>
                </article>

                <article class="visitas-topic" id="visitas-tecnicas">
                    <header class="visitas-topic__title">
                        <span><?php esc_html_e( 'Visitas técnicas', 'camara-hotsite' ); ?></span>
                    </header>
                    <div class="visitas-topic__content">
                        <p>
                            <?php
                            printf(
                                wp_kses_post( __( 'Para visitas às Equipes Técnicas da Câmara Municipal de São Paulo, como: Rede Câmara São Paulo, Biblioteca, Ouvidoria do Parlamento, Equipe de Eventos, entre outras, agende por meio da Equipe do Cerimonial - <a href="%s">cerimonial@saopaulo.sp.leg.br</a>.', 'camara-hotsite' ) ),
                                esc_url( 'mailto:cerimonial@saopaulo.sp.leg.br' )
                            );
                            ?>
                        </p>
                        <?php if ( 'success' === $visitas_status ) : ?>
                            <div class="form-alert form-alert--success" role="status" aria-live="polite">
                                <?php esc_html_e( 'Recebemos seus dados! Em breve retornaremos o contato.', 'camara-hotsite' ); ?>
                            </div>
                        <?php elseif ( 'error' === $visitas_status ) : ?>
                            <div class="form-alert form-alert--error" role="alert" aria-live="assertive">
                                <?php esc_html_e( 'Não foi possível enviar seus dados. Tente novamente em instantes.', 'camara-hotsite' ); ?>
                            </div>
                        <?php endif; ?>
                        <form class="visitas-form visitas-form--light" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                            <?php wp_nonce_field( 'camara_contact_form', 'camara_contact_form_nonce' ); ?>
                            <input type="hidden" name="action" value="camara_contact_form">
                            <input type="hidden" name="camara_form_id" value="visitas-tecnicas">
                            <input type="hidden" name="camara_form_context" value="<?php esc_attr_e( 'Visitas técnicas', 'camara-hotsite' ); ?>">
                            <input type="hidden" name="camara_status_param" value="visitas-status">
                            <input type="hidden" name="camara_redirect_to" value="<?php echo esc_url( get_permalink() ); ?>">
                            <input type="hidden" name="lgpd_consent" value="1">
                            <div class="visitas-form__row">
                                <label for="visitas-nome"><?php esc_html_e( 'Nome:', 'camara-hotsite' ); ?></label>
                                <input type="text" id="visitas-nome" name="nome" required>
                            </div>
                            <div class="visitas-form__row">
                                <label for="visitas-telefone"><?php esc_html_e( 'Telefone:', 'camara-hotsite' ); ?></label>
                                <input type="tel" id="visitas-telefone" name="telefone">
                            </div>
                            <div class="visitas-form__row">
                                <label for="visitas-email"><?php esc_html_e( 'E-mail:', 'camara-hotsite' ); ?></label>
                                <input type="email" id="visitas-email" name="email" required>
                            </div>
                            <div class="visitas-form__actions">
                                <button type="submit" class="btn visitas-form__submit">
                                    <?php esc_html_e( 'Enviar', 'camara-hotsite' ); ?>
                                </button>
                            </div>
                        </form>
                        <p class="visitas-form__note">
                            <?php esc_html_e( 'O seu contato é muito importante para nós! Ao preencher os dados, você autoriza receber os conteúdos da Câmara Municipal de São Paulo.', 'camara-hotsite' ); ?>
                        </p>
                        <p class="visitas-form__note">
                            <?php esc_html_e( 'A Câmara Municipal de São Paulo respeita sua privacidade. Seus dados são tratados com segurança e conforme a LGPD.', 'camara-hotsite' ); ?>
                        </p>
                    </div>
                </article>
            </section>
        </article>
    </div>
</main>

<?php get_footer(); ?>
