<?php
/**
 * Template Name: Guia do Visitante
 * Página com os demais tópicos do guia.
 *
 * @package CamaraGuia
 */

get_header();

if ( have_posts() ) {
    the_post();
}

$hero_slides = camara_get_page_hero_slides( 'guia' );

$guia_accessibility_status = isset( $_GET['guia-accessibility-status'] ) ? sanitize_text_field( wp_unslash( $_GET['guia-accessibility-status'] ) ) : '';
$guia_feedback_status      = isset( $_GET['guia-feedback-status'] ) ? sanitize_text_field( wp_unslash( $_GET['guia-feedback-status'] ) ) : '';
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
            <?php
            require get_template_directory() . '/guia/sections.php';
            ?>
        </article>
    </div>
</main>

<?php get_footer(); ?>
