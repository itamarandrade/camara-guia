<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="header">
    <div class="container header-top">
        <div class="logo-wrap">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" class="logo" alt="Câmara Municipal de São Paulo">
            </a>
        </div>
        <nav class="menu-principal" aria-label="<?php esc_attr_e('Menu principal', 'camara-hotsite'); ?>">
            <?php
                wp_nav_menu([
                    'theme_location' => 'header_menu',
                    'container'      => false,
                    'fallback_cb'    => false
                ]);
            ?>
        </nav>
    </div>
</header>
