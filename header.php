<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class('site-body'); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="top-bar">
        <div class="container top-bar__inner">
            <div class="top-bar__social" aria-label="<?php esc_attr_e('Redes sociais oficiais', 'camara-hotsite'); ?>">
                <a class="social-link" data-icon="F" href="https://www.facebook.com/camarasaopaulo" target="_blank" rel="noreferrer" aria-label="Facebook da Câmara Municipal"><span aria-hidden="true">Facebook</span></a>
                <a class="social-link" data-icon="T" href="https://twitter.com/camarasaopaulo" target="_blank" rel="noreferrer" aria-label="Twitter da Câmara Municipal"><span aria-hidden="true">Twitter</span></a>
                <a class="social-link" data-icon="YT" href="https://www.youtube.com/camarasaopaulo" target="_blank" rel="noreferrer" aria-label="YouTube da Câmara Municipal"><span aria-hidden="true">YouTube</span></a>
            </div>
            <div class="top-bar__external">
                <button class="external-links-toggle" type="button" aria-controls="external-links-menu" aria-expanded="false">
                    <span class="sr-only"><?php esc_html_e('Abrir menu de links externos', 'camara-hotsite'); ?></span>
                    <span class="external-links-toggle__icon" aria-hidden="true"><span></span></span>
                    <span class="external-links-toggle__label"><?php esc_html_e('Links externos', 'camara-hotsite'); ?></span>
                </button>
                <nav class="external-links-menu" id="external-links-menu" aria-label="<?php esc_attr_e('Links externos', 'camara-hotsite'); ?>">
                    <?php
                        if ( has_nav_menu( 'external_links_menu' ) ) {
                            wp_nav_menu([
                                'theme_location' => 'external_links_menu',
                                'container'      => false,
                                'menu_class'     => 'external-links-menu__list',
                                'depth'          => 1,
                            ]);
                        } else {
                            echo '<ul class="external-links-menu__list"><li class="external-links-menu__notice">' . esc_html__( 'Cadastre os links externos em Aparência > Menus', 'camara-hotsite' ) . '</li></ul>';
                        }
                    ?>
                </nav>
            </div>
        </div>
    </div>

    <div class="container nav-wrapper">
        <div class="logo-group">
            <?php
                $logo_src = '';
                $logo_id  = get_theme_mod( 'custom_logo' );
                if ( $logo_id ) {
                    $logo_src = wp_get_attachment_image_url( $logo_id, 'full' );
                }
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
                <?php if ( $logo_src ) : ?>
                    <img src="<?php echo esc_url( $logo_src ); ?>" class="logo" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
                <?php else : ?>
                    <span class="logo-placeholder">CMSP</span>
                <?php endif; ?>
                <span class="logo-text">
                    <strong><?php esc_html_e('Câmara Municipal', 'camara-hotsite'); ?></strong>
                    <span><?php esc_html_e('de São Paulo', 'camara-hotsite'); ?></span>
                </span>
            </a>
        </div>

        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <span class="menu-toggle__label"><?php esc_html_e('Menu', 'camara-hotsite'); ?></span>
            <span class="menu-toggle__icon" aria-hidden="true"><span></span></span>
        </button>

        <nav class="primary-nav" id="primary-menu" aria-label="<?php esc_attr_e('Menu principal', 'camara-hotsite'); ?>">
            <?php
                wp_nav_menu([
                    'theme_location' => 'header_menu',
                    'container'      => false,
                    'menu_class'     => 'primary-nav__list',
                    'fallback_cb'    => function () {
                        echo '<ul class="primary-nav__list"><li><a href="#">' . esc_html__('Defina o Menu Superior em Aparência > Menus', 'camara-hotsite') . '</a></li></ul>';
                    }
                ]);
            ?>
        </nav>
    </div>
</header>
