<footer class="site-footer">
    <div class="container site-footer__inner">
        <div class="site-footer__about">
            <h4><?php esc_html_e('Visite o Palácio Anchieta', 'camara-hotsite'); ?></h4>
            <p><?php esc_html_e('Praça da Sé, s/nº — Centro Histórico, São Paulo - SP', 'camara-hotsite'); ?></p>
            <p><?php esc_html_e('Central telefônica: (11) 3396-4000', 'camara-hotsite'); ?></p>
        </div>

        <div class="site-footer__links">
            <?php
                $camara_side_links = camara_get_side_menu_links();
                if ( ! empty( $camara_side_links ) ) :
            ?>
                <ul class="footer-links footer-links--grid" aria-label="<?php esc_attr_e( 'Links úteis', 'camara-hotsite' ); ?>">
                    <?php foreach ( $camara_side_links as $link ) :
                        $is_external = ! empty( $link['external'] );
                        $target      = $is_external ? '_blank' : '_self';
                        $rel         = $is_external ? 'noreferrer noopener' : '';
                    ?>
                        <li>
                            <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>" <?php echo $rel ? 'rel="' . esc_attr( $rel ) . '"' : ''; ?>>
                                <?php echo esc_html( $link['label'] ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
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
