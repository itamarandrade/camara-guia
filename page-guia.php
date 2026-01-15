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

$guia_accessibility_status = isset( $_GET['guia-accessibility-status'] ) ? sanitize_text_field( wp_unslash( $_GET['guia-accessibility-status'] ) ) : '';
$guia_feedback_status      = isset( $_GET['guia-feedback-status'] ) ? sanitize_text_field( wp_unslash( $_GET['guia-feedback-status'] ) ) : '';
?>

<main id="primary" class="visitas-page visitas-page--guide" tabindex="-1">
    <section class="hero hero--visitas" data-hero>
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
