<footer class="site-footer">
    <div class="container site-footer__inner">
        <div class="site-footer__links">
            <?php
                $camara_side_links = camara_get_side_menu_links();
                if ( ! empty( $camara_side_links ) ) :
                    $link_columns = array_chunk( $camara_side_links, 5 );
            ?>
                <nav class="footer-links footer-links--grid" aria-label="<?php esc_attr_e( 'Links úteis', 'camara-hotsite' ); ?>">
                    <?php foreach ( $link_columns as $column ) : ?>
                        <ul class="footer-links__column">
                            <?php foreach ( $column as $link ) :
                                $target = ! empty( $link['target'] ) ? $link['target'] : ( ! empty( $link['external'] ) ? '_blank' : '_self' );
                                $rel    = ! empty( $link['rel'] ) ? $link['rel'] : '';
                                if ( '_blank' === $target ) {
                                    $rel = trim( $rel . ' noreferrer noopener' );
                                    $rel = implode( ' ', array_unique( preg_split( '/\s+/', $rel ) ) );
                                }
                            ?>
                                <li>
                                    <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>" <?php echo $rel ? 'rel="' . esc_attr( $rel ) . '"' : ''; ?>>
                                        <?php echo esc_html( $link['label'] ); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                </nav>
            <?php endif; ?>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php esc_html_e('Câmara Municipal de São Paulo. Todos os direitos reservados.', 'camara-hotsite'); ?></p>
        </div>
    </div>
</footer>

<?php
    $lgpd_cookie         = isset( $_COOKIE['camaraLgpdConsent'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['camaraLgpdConsent'] ) ) : '';
    $lgpd_should_display = '1' !== $lgpd_cookie;
?>

<div
    class="lgpd-banner <?php echo $lgpd_should_display ? 'is-visible' : 'is-hidden'; ?>"
    id="lgpd-banner"
    role="dialog"
    aria-live="polite"
    aria-modal="true"
    aria-label="<?php esc_attr_e( 'Aviso de privacidade e LGPD', 'camara-hotsite' ); ?>"
    aria-describedby="lgpd-banner-text"
    aria-hidden="<?php echo $lgpd_should_display ? 'false' : 'true'; ?>"
    tabindex="-1"
>
    <div class="lgpd-banner__text" id="lgpd-banner-text">
        <p>
            <?php
                $lgpd_message = sprintf(
                    __( 'Utilizamos cookies e guardamos seus dados apenas para melhorar sua experiência e responder seus contatos. Leia nossa %s para saber mais.', 'camara-hotsite' ),
                    '<a class="lgpd-banner__link" href="https://www.saopaulo.sp.leg.br/institucional/lei-geral-de-protecao-de-dados-lgpd/" target="_blank" rel="noreferrer noopener">' . esc_html__( 'Política de Privacidade', 'camara-hotsite' ) . '</a>'
                );

                echo wp_kses(
                    $lgpd_message,
                    [
                        'a' => [
                            'href'   => [],
                            'target' => [],
                            'rel'    => [],
                            'class'  => [],
                        ],
                    ]
                );
            ?>
        </p>
    </div>
    <div class="lgpd-banner__actions">
        <button type="button" class="btn lgpd-banner__button" data-lgpd-accept>
            <?php esc_html_e( 'Aceitar e continuar', 'camara-hotsite' ); ?>
        </button>
    </div>
</div>

<script>
(function () {
    var banner = document.getElementById('lgpd-banner');
    if (!banner) {
        return;
    }

    var acceptButton = banner.querySelector('[data-lgpd-accept]');
    if (!acceptButton) {
        return;
    }

    var cookieName = 'camaraLgpdConsent';
    var cookieValue = '1';
    var cookieDays = 365;
    var hideTimeout = null;

    function setConsentCookie() {
        var expires = new Date();
        expires.setDate(expires.getDate() + cookieDays);
        document.cookie = cookieName + '=' + cookieValue + ';expires=' + expires.toUTCString() + ';path=/;SameSite=Lax';
    }

    function hideBanner() {
        banner.classList.remove('is-visible');
        banner.setAttribute('aria-hidden', 'true');
        if (hideTimeout) {
            window.clearTimeout(hideTimeout);
        }
        hideTimeout = window.setTimeout(function () {
            banner.classList.add('is-hidden');
        }, 400);
    }

    function focusBanner() {
        banner.focus();
    }

    if (banner.classList.contains('is-visible') && banner.getAttribute('aria-hidden') === 'false') {
        window.setTimeout(focusBanner, 50);
    }

    acceptButton.addEventListener('click', function () {
        setConsentCookie();
        hideBanner();
        acceptButton.blur();
    });
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
