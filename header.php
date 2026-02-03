<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class('site-body'); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#primary"><?php esc_html_e( 'Pular para o conteúdo principal', 'camara-hotsite' ); ?></a>

<header class="site-header">
    <div class="top-bar">
        <div class="container top-bar__inner">
            <div class="top-bar__social" aria-label="<?php esc_attr_e('Redes sociais oficiais', 'camara-hotsite'); ?>">
                <a class="social-link" href="https://www.facebook.com/camarasaopaulo" target="_blank" rel="noreferrer" aria-label="Facebook da Câmara Municipal">
                    <svg class="social-link__icon" aria-hidden="true" viewBox="0 0 24 24" focusable="false">
                        <path fill="currentColor" d="M22.675 0h-21.35C.597 0 0 .597 0 1.326v21.348C0 23.403.597 24 1.326 24h11.495v-9.294H9.691V11.01h3.13V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.464.099 2.796.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.31h3.587l-.467 3.696h-3.12V24h6.116C23.403 24 24 23.403 24 22.674V1.326C24 .597 23.403 0 22.675 0z"/>
                    </svg>
                </a>
                <a class="social-link" href="https://x.com/camarasaopaulo" target="_blank" rel="noreferrer" aria-label="X da Câmara Municipal">
                    <svg class="social-link__icon" aria-hidden="true" viewBox="0 0 24 24" focusable="false">
                        <path fill="currentColor" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.65l-5.202-6.8-5.95 6.8H1.716l7.73-8.84L1.27 2.25h6.82l4.7 6.2 5.454-6.2z"/>
                    </svg>
                </a>
                <a class="social-link" href="https://www.youtube.com/camarasaopaulo" target="_blank" rel="noreferrer" aria-label="YouTube da Câmara Municipal">
                    <svg class="social-link__icon" aria-hidden="true" viewBox="0 0 24 24" focusable="false">
                        <path fill="currentColor" d="M23.498 6.186a2.958 2.958 0 00-2.078-2.078C19.633 3.6 12 3.6 12 3.6s-7.633 0-9.42.508A2.958 2.958 0 00.502 6.186C0 7.974 0 12 0 12s0 4.026.502 5.814a2.958 2.958 0 002.078 2.078C4.367 20.4 12 20.4 12 20.4s7.633 0 9.42-.508a2.958 2.958 0 002.078-2.078C24 16.026 24 12 24 12s0-4.026-.502-5.814zM9.75 15.568V8.432L15.818 12 9.75 15.568z"/>
                    </svg>
                </a>
            </div>
            <div class="top-bar__external">
                <button class="external-links-toggle" type="button" aria-controls="external-links-panel" aria-expanded="false">
                    <span class="sr-only"><?php esc_html_e('Abrir menu de menu', 'camara-hotsite'); ?></span>
                    <span class="external-links-toggle__icon" aria-hidden="true"><span></span></span>
                </button>
            </div>
        </div>
    </div>

    <div class="external-links-panel" id="external-links-panel" aria-hidden="true">
        <div class="external-links-panel__overlay" data-panel-close></div>
        <aside class="external-links-panel__content" aria-label="<?php esc_attr_e('Menu', 'camara-hotsite'); ?>">
            <button class="external-links-panel__close" type="button" data-panel-close>
                <span aria-hidden="true"></span>
                <span class="sr-only"><?php esc_html_e('Fechar menu de menu', 'camara-hotsite'); ?></span>
            </button>
            <strong class="external-links-panel__title"><?php esc_html_e('Menu', 'camara-hotsite'); ?></strong>
            <nav class="external-links-menu">
                <?php
                    if ( has_nav_menu( 'external_links_menu' ) ) {
                        wp_nav_menu([
                            'theme_location' => 'external_links_menu',
                            'container'      => false,
                            'menu_class'     => 'external-links-menu__list',
                            'depth'          => 2,
                        ]);
                    } else {
                        echo '<ul class="external-links-menu__list"><li class="external-links-menu__notice">' . esc_html__( 'Cadastre os links externos em Aparência > Menus', 'camara-hotsite' ) . '</li></ul>';
                    }
                ?>
            </nav>
        </aside>
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
            <a href="https://www.saopaulo.sp.leg.br/" class="logo-link" target="_blank" rel="noreferrer">
                <?php if ( $logo_src ) : ?>
                    <img src="<?php echo esc_url( $logo_src ); ?>" class="logo" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
                <?php else : ?>
                    <span class="logo-placeholder">CMSP</span>
                <?php endif; ?>
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
