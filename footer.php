<footer class="site-footer">
    <div class="container site-footer__inner">
        <div class="site-footer__about">
            <h4><?php esc_html_e('Visite o Palácio Anchieta', 'camara-hotsite'); ?></h4>
            <p><?php esc_html_e('Praça da Sé, s/nº — Centro Histórico, São Paulo - SP', 'camara-hotsite'); ?></p>
            <p><?php esc_html_e('Central telefônica: (11) 3396-4000', 'camara-hotsite'); ?></p>
        </div>

        <div class="site-footer__links">
            <?php
                if ( has_nav_menu( 'footer_menu' ) ) {
                    wp_nav_menu([
                        'theme_location' => 'footer_menu',
                        'container'      => false,
                        'menu_class'     => 'footer-links',
                        'depth'          => 1
                    ]);
                } else {
                    echo '<ul class="footer-links">'
                        . '<li>' . esc_html__( 'Visitas', 'camara-hotsite' ) . '</li>'
                        . '<li>' . esc_html__( 'Audiências públicas', 'camara-hotsite' ) . '</li>'
                        . '<li>' . esc_html__( 'Galeria do Plenário 1º de Maio', 'camara-hotsite' ) . '</li>'
                        . '<li>' . esc_html__( 'Rede Câmara SP', 'camara-hotsite' ) . '</li>'
                        . '<li>' . esc_html__( 'Centro de Memória', 'camara-hotsite' ) . '</li>'
                        . '<li>' . esc_html__( 'Biblioteca e documentação', 'camara-hotsite' ) . '</li>'
                        . '<li>' . esc_html__( 'SPLegis', 'camara-hotsite' ) . '</li>'
                        . '</ul>';
                }
            ?>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php esc_html_e('Câmara Municipal de São Paulo. Todos os direitos reservados.', 'camara-hotsite'); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
