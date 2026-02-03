<?php
if ( ! isset( $guia_accessibility_status ) ) {
    $guia_accessibility_status = '';
}

if ( ! isset( $guia_feedback_status ) ) {
    $guia_feedback_status = '';
}
?>

<section class="visitas-topics guia-topics" aria-labelledby="guia-topics-title">
    <h2 id="guia-topics-title" class="sr-only"><?php esc_html_e( 'Guia do Visitante', 'camara-hotsite' ); ?></h2>

    <article class="visitas-topic" id="guia-galeria-plenario">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Galeria do Plenário 1º de Maio', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'Você pode acompanhar as Sessões Plenárias, Reuniões, Eventos e Audiências Públicas que ocorrem no Plenário 1º de Maio. Temos uma galeria reservada para você! Todavia, alguns cuidados relacionados à segurança devem ser observados: não é permitida a entrada na Galeria do Plenário com objetos arremessáveis, como garrafas, guarda-chuva e etc.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'Além disso, a equipe de Segurança da Câmara Municipal de São Paulo estará sempre junto com você, te orientando em relação ao uso seguro do espaço.', 'camara-hotsite' ); ?></p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-audiencias-publicas">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Audiências públicas', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'As audiências públicas são instrumentos de participação regimentais que integram o processo legislativo e garantem a participação popular. Você pode se inscrever para se manifestar nas audiências, sobre o tema ou Projeto de Lei em pauta.', 'camara-hotsite' ); ?></p>
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'Para participar de uma audiência, de forma remota ou presencial, ou verificar a agenda de audiências públicas da Câmara Municipal de São Paulo, acesse o site dedicado: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/audienciaspublicas/</a>.', 'camara-hotsite' ) ),
                    esc_url( 'https://www.saopaulo.sp.leg.br/audienciaspublicas/' )
                );
                ?>
            </p>
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'Você também pode se inscrever para participar presencialmente nos auditórios em que as audiências são realizadas, basta comparecer ao auditório no dia agendado e se inscrever junto à Secretaria da Comissão. Atente-se para o calendário na <a href="%s" target="_blank" rel="noopener">Agenda Oficial da Câmara</a> e participe!', 'camara-hotsite' ) ),
                    esc_url( 'https://www.saopaulo.sp.leg.br/atividade-legislativa/agenda-da-camara/' )
                );
                ?>
            </p>
            <p><?php esc_html_e( 'Em caso de dúvidas, entre em contato com a Secretaria das Comissões: (11) 3396-4449.', 'camara-hotsite' ); ?></p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-horario">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Horário', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <ul class="visitas-topic__list">
                <li><?php esc_html_e( 'Unidades Administrativas - Das 10h às 19h - Segunda à sexta-feira.', 'camara-hotsite' ); ?></li>
                <li><?php esc_html_e( 'Ouvidoria do Parlamento - Das 9h às 18h – Segunda à sexta-feira - Sala da Ouvidoria, na Câmara Municipal de São Paulo, Viaduto Jacareí, 100 – 2º andar.', 'camara-hotsite' ); ?></li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Para falar com a Ouvidoria por outros meios, acesse <a href="%s" target="_blank" rel="noopener">aqui</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/fale-conosco/ouvidoria/' )
                    );
                    ?>
                </li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Eventos - As salas e auditórios do Palácio Anchieta poderão ser utilizados para eventos: nos dias úteis entre 9h e 22h, nos sábados entre 9h e 17h e nos domingos e feriados, com prévia e expressa autorização da Mesa, no período entre 9h e 17h. Você pode acompanhar a agenda de eventos da Câmara Municipal de São Paulo na <a href="%s" target="_blank" rel="noopener">Agenda Oficial</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/atividade-legislativa/agenda-da-camara/' )
                    );
                    ?>
                </li>
            </ul>
        </div>
    </article>

    <article class="visitas-topic" id="guia-ouvidoria">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Ouvidoria', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'Caso deseje fazer uma sugestão, um elogio, uma manifestação ou uma reclamação, a equipe da Ouvidoria estará disponível pelo telefone 0800 322 6272 ou através do e-mail <a href="%s">ouvidoria@saopaulo.sp.leg.br</a>.', 'camara-hotsite' ) ),
                    esc_url( 'mailto:ouvidoria@saopaulo.sp.leg.br' )
                );
                ?>
            </p>
            <p><?php esc_html_e( 'A equipe da Ouvidoria analisará sua manifestação e a encaminhará ao departamento responsável.', 'camara-hotsite' ); ?></p>
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'Para mais informações: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/fale-conosco/ouvidoria/</a>.', 'camara-hotsite' ) ),
                    esc_url( 'https://www.saopaulo.sp.leg.br/fale-conosco/ouvidoria/' )
                );
                ?>
            </p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-biblioteca">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Acesso à biblioteca', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'A Biblioteca da Câmara Municipal de São Paulo mantém um acervo de livros com mais de 23.000 volumes e disponibiliza coleções de livros, periódicos, artigos de jornais, diários oficiais, informações sobre vereadores e outros documentos bibliográficos.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'Usuários externos podem realizar consultas locais em dias úteis, das 10h às 18h30. A Biblioteca está localizada no 2º andar do Palácio Anchieta, na sala 207.', 'camara-hotsite' ); ?></p>
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'Para checar o acervo disponível, acesse: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/biblioteca/</a>.', 'camara-hotsite' ) ),
                    esc_url( 'https://www.saopaulo.sp.leg.br/biblioteca/' )
                );
                ?>
            </p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-procedimentos">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Procedimentos de segurança e identificação', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'Todos os visitantes, bem como seus pertences, devem passar pelo detector de metais e equipamento de raio-X. Armas de qualquer tipo ou objetos como tesouras e alicates devem ser deixados sob a custódia temporária da ICAM - Inspetoria da Câmara Municipal de São Paulo (GCM).', 'camara-hotsite' ); ?></p>
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'O sistema de segurança da Câmara Municipal de São Paulo é integrado ao <a href="%s" target="_blank" rel="noopener">Smart Sampa</a>, que usa o reconhecimento facial de câmeras inteligentes para identificação de casos de violência urbana e foragidos da justiça.', 'camara-hotsite' ) ),
                    esc_url( 'https://smartsampa.prefeitura.sp.gov.br/' )
                );
                ?>
            </p>
            <p><?php esc_html_e( 'O acesso ao Palácio Anchieta é liberado após identificação, com apresentação de documento oficial com foto. Não serão aceitas cópias não autenticadas ou fotos dos documentos.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'Segue a relação de documentos públicos, aceitos na identificação:', 'camara-hotsite' ); ?></p>
            <ul class="visitas-topic__list">
                <li><?php esc_html_e( 'RG;', 'camara-hotsite' ); ?></li>
                <li><?php esc_html_e( 'CNH - mesmo com validade vencida (Ofício Circular nº 2/2017/CONTRAN);', 'camara-hotsite' ); ?></li>
                <li><?php esc_html_e( 'CNH digital;', 'camara-hotsite' ); ?></li>
                <li><?php esc_html_e( 'Identidade Funcional (exceto crachás);', 'camara-hotsite' ); ?></li>
                <li><?php esc_html_e( 'Carteira de Conselho de Classe (OAB, CREA, CONRERP etc.);', 'camara-hotsite' ); ?></li>
                <li><?php esc_html_e( 'E-Título;', 'camara-hotsite' ); ?></li>
                <li><?php esc_html_e( 'Passaporte (estrangeiros e brasileiros).', 'camara-hotsite' ); ?></li>
            </ul>
            <p><?php esc_html_e( 'Obs.: Para estrangeiros, será aceito o passaporte ou documento de identificação oficial do país de origem, quando se tratar de cidadão de país integrante do Mercosul.', 'camara-hotsite' ); ?></p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-procuradoria-mulher">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Procuradoria Especial da Mulher', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'A Procuradoria Especial da Mulher da Câmara Municipal de São Paulo oferece atendimento a pessoas que queiram denunciar situações de violência ou discriminação contra mulheres, tirar dúvidas sobre direitos ou receber orientação e encaminhamento para a rede de proteção. A equipe recebe, examina e encaminha denúncias aos órgãos competentes, orienta sobre canais de apoio e informa sobre políticas públicas e ações da Câmara voltadas às mulheres.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'Atendimento presencial: Viaduto Jacareí, nº 100, Sala 132A, Palácio Anchieta, das 10h às 19h.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'Telefone: (11) 3396-4180', 'camara-hotsite' ); ?></p>
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'E-mail: <a href="%s">procuradoriadamulher@saopaulo.sp.leg.br</a>.', 'camara-hotsite' ) ),
                    esc_url( 'mailto:procuradoriadamulher@saopaulo.sp.leg.br' )
                );
                ?>
            </p>
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'Mais informações: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/procuradoriadamulher/</a>.', 'camara-hotsite' ) ),
                    esc_url( 'https://www.saopaulo.sp.leg.br/procuradoriadamulher/' )
                );
                ?>
            </p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-procuradoria-crianca">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Procuradoria da Criança e do Adolescente', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'A Procuradoria da Criança e do Adolescente da Câmara Municipal de São Paulo é um órgão independente voltado à proteção dos direitos da infância e da juventude. O espaço oferece acolhimento, escuta qualificada e orientação para pessoas que queiram denunciar situações de violência, negligência ou outras violações de direitos contra crianças e adolescentes. A Procuradoria recebe, examina e encaminha denúncias aos órgãos competentes, acompanha políticas e programas do governo municipal e promove ações de conscientização sobre o tema.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'Atendimento presencial: Viaduto Jacareí, nº 100, Sala 132, Palácio Anchieta, das 10h às 19h.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'Telefone: (11) 3396-4068', 'camara-hotsite' ); ?></p>
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'E-mail: <a href="%s">procuradoriadacrianca@saopaulo.sp.leg.br</a>.', 'camara-hotsite' ) ),
                    esc_url( 'mailto:procuradoriadacrianca@saopaulo.sp.leg.br' )
                );
                ?>
            </p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-espacos-culturais">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Espaços culturais e exposições temporárias', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'A Câmara Municipal de São Paulo realiza, durante o ano, várias exposições institucionais, históricas, artísticas e fotográficas de caráter temporário.', 'camara-hotsite' ); ?></p>
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'Fique atento à programação divulgada na <a href="%s" target="_blank" rel="noopener">Agenda Oficial</a>, no Portal da Câmara e em nossas <a href="%s" target="_blank" rel="noopener">notícias</a>.', 'camara-hotsite' ) ),
                    esc_url( 'https://www.saopaulo.sp.leg.br/atividade-legislativa/agenda-da-camara/' ),
                    esc_url( 'https://www.saopaulo.sp.leg.br/comunicacao/noticias/' )
                );
                ?>
            </p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-galeria-lilas">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Galeria Lilás', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'Localizada no Saguão de Entrada José Mentor, no térreo do Palácio Anchieta, a Galeria Lilás é um espaço permanente aberto ao público, com fotografias e biografias das 65 mulheres que exerceram e que exercem mandatos como vereadoras no Legislativo paulistano.', 'camara-hotsite' ); ?></p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-exposicoes">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Exposições no Saguão de Entrada José Mentor', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p>
                <?php
                printf(
                    wp_kses_post( __( 'Acompanhe as <a href="%s" target="_blank" rel="noopener">notícias</a> e a <a href="%s" target="_blank" rel="noopener">agenda da Câmara</a> para saber quais exposições estão sendo realizadas no Térreo do Palácio Anchieta.', 'camara-hotsite' ) ),
                    esc_url( 'https://www.saopaulo.sp.leg.br/comunicacao/noticias/' ),
                    esc_url( 'https://www.saopaulo.sp.leg.br/atividade-legislativa/agenda-da-camara/' )
                );
                ?>
            </p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-fotografias">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Fotografias e vídeos', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'O registro dos espaços e obras da Câmara Municipal de São Paulo é livre, porém, não realize, sem observar os cuidados e caso seja necessário, com prévia e expressa autorização:', 'camara-hotsite' ); ?></p>
            <ol class="visitas-topic__list">
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Registros com finalidade comercial (para uso comercial de materiais consulte o <a href="%s" target="_blank" rel="noopener">Ato nº 1182/2012</a> e entre em contato com a Secretaria Geral Administrativa - sga@saopaulo.sp.leg.br).', 'camara-hotsite' ) ),
                        esc_url( 'https://app-plpconsulta-prd.azurewebsites.net/Forms/MostrarArquivo?TIPO=Ato&NUMERO=1182&ANO=2012&DOCUMENTO=Atualizado' )
                    );
                    ?>
                </li>
                <li><?php esc_html_e( 'Registros com uso de flash.', 'camara-hotsite' ); ?></li>
            </ol>
        </div>
    </article>

    <article class="visitas-topic" id="guia-acessibilidade">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Acessibilidade', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'A Câmara Municipal de São Paulo dispõe de cadeiras de rodas para atendimento aos visitantes.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'Em caso de necessidade, entre em contato com a GCM pelo telefone 3396-4153 ou procure diretamente um servidor da GCM no Palácio Anchieta.', 'camara-hotsite' ); ?></p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-gt-acessibilidade">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Grupo de Trabalho Permanente de Acessibilidade e Inclusão da Pessoa com Deficiência', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'A Câmara Municipal de São Paulo possui um Grupo de Trabalho Permanente de Acessibilidade e Inclusão da Pessoa com Deficiência.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'Se você é uma pessoa com deficiência, ou acompanhante, e tem alguma dúvida ou receio em relação a visitas na Câmara Municipal de São Paulo, entre em contato por meio do formulário abaixo, queremos te receber com a dignidade que você merece.', 'camara-hotsite' ); ?></p>
            <form class="visitas-form visitas-form--light" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <?php wp_nonce_field( 'camara_contact_form', 'camara_contact_form_nonce' ); ?>
                <input type="hidden" name="action" value="camara_contact_form">
                <input type="hidden" name="camara_form_id" value="guia-acessibilidade">
                <input type="hidden" name="camara_form_context" value="<?php esc_attr_e( 'Acessibilidade', 'camara-hotsite' ); ?>">
                <input type="hidden" name="camara_status_param" value="guia-accessibility-status">
                <input type="hidden" name="camara_redirect_to" value="<?php echo esc_url( get_permalink() . '#guia-acessibilidade' ); ?>">
                <input type="hidden" name="lgpd_consent" value="1">
                <div class="visitas-form__row">
                    <label for="guia-acess-nome"><?php esc_html_e( 'Nome:', 'camara-hotsite' ); ?></label>
                    <input type="text" id="guia-acess-nome" name="nome" required>
                </div>
                <div class="visitas-form__row">
                    <label for="guia-acess-telefone"><?php esc_html_e( 'Telefone:', 'camara-hotsite' ); ?></label>
                    <input type="tel" id="guia-acess-telefone" name="telefone">
                </div>
                <div class="visitas-form__row">
                    <label for="guia-acess-email"><?php esc_html_e( 'E-mail:', 'camara-hotsite' ); ?></label>
                    <input type="email" id="guia-acess-email" name="email" required>
                </div>
                <div class="visitas-form__row">
                    <label for="guia-acess-mensagem"><?php esc_html_e( 'Mensagem:', 'camara-hotsite' ); ?></label>
                    <textarea id="guia-acess-mensagem" name="mensagem"></textarea>
                </div>
                <div class="visitas-form__actions">
                    <button type="submit" class="btn visitas-form__submit">
                        <?php esc_html_e( 'Enviar', 'camara-hotsite' ); ?>
                    </button>
                </div>
            </form>
            <?php if ( 'success' === $guia_accessibility_status ) : ?>
                <div class="form-alert form-alert--success" role="status" aria-live="polite">
                    <?php esc_html_e( 'Recebemos sua mensagem! Em breve retornaremos o contato.', 'camara-hotsite' ); ?>
                </div>
            <?php elseif ( 'error' === $guia_accessibility_status ) : ?>
                <div class="form-alert form-alert--error" role="alert" aria-live="assertive">
                    <?php esc_html_e( 'Não foi possível enviar sua mensagem. Tente novamente em instantes.', 'camara-hotsite' ); ?>
                </div>
            <?php endif; ?>
            <p class="visitas-form__note">
                <?php esc_html_e( 'O seu contato é muito importante para nós! Ao preencher os dados, você autoriza receber os conteúdos da Câmara Municipal de São Paulo.', 'camara-hotsite' ); ?>
            </p>
            <p class="visitas-form__note">
                <?php esc_html_e( 'A Câmara Municipal de São Paulo respeita sua privacidade. Seus dados são tratados com segurança e conforme a LGPD.', 'camara-hotsite' ); ?>
            </p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-sala-azul">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Sala Azul', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'No 1º subsolo (-1) do Palácio Anchieta existe um espaço dedicado ao acolhimento, descompressão e autorregulação de, principalmente, pessoas com neurodivergências.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'O espaço fica aberto ao público no horário de funcionamento da Câmara Municipal e sob a gestão da Secretaria de Saúde - SGA.8.', 'camara-hotsite' ); ?></p>
            <p><?php esc_html_e( 'Contato: (11) 3396-4364', 'camara-hotsite' ); ?></p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-manifestacao">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Deixe a sua manifestação', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'Esteve no Palácio Anchieta? Preencha o formulário e nos ajude a melhorar ainda mais o nosso atendimento ao cidadão.', 'camara-hotsite' ); ?></p>
            <form class="visitas-form visitas-form--light" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <?php wp_nonce_field( 'camara_contact_form', 'camara_contact_form_nonce' ); ?>
                <input type="hidden" name="action" value="camara_contact_form">
                <input type="hidden" name="camara_form_id" value="guia-manifestacao">
                <input type="hidden" name="camara_form_context" value="<?php esc_attr_e( 'Manifestação', 'camara-hotsite' ); ?>">
                <input type="hidden" name="camara_status_param" value="guia-feedback-status">
                <input type="hidden" name="camara_redirect_to" value="<?php echo esc_url( get_permalink() . '#guia-manifestacao' ); ?>">
                <input type="hidden" name="lgpd_consent" value="1">
                <div class="visitas-form__row">
                    <label for="guia-feedback-nome"><?php esc_html_e( 'Nome:', 'camara-hotsite' ); ?></label>
                    <input type="text" id="guia-feedback-nome" name="nome" required>
                </div>
                <div class="visitas-form__row">
                    <label for="guia-feedback-telefone"><?php esc_html_e( 'Telefone:', 'camara-hotsite' ); ?></label>
                    <input type="tel" id="guia-feedback-telefone" name="telefone">
                </div>
                <div class="visitas-form__row">
                    <label for="guia-feedback-email"><?php esc_html_e( 'E-mail:', 'camara-hotsite' ); ?></label>
                    <input type="email" id="guia-feedback-email" name="email" required>
                </div>
                <div class="visitas-form__row">
                    <label for="guia-feedback-motivo"><?php esc_html_e( 'O que te trouxe à Câmara Municipal de São Paulo:', 'camara-hotsite' ); ?></label>
                    <textarea id="guia-feedback-motivo" name="motivo"></textarea>
                </div>
                <div class="visitas-form__row">
                    <label for="guia-feedback-mensagem"><?php esc_html_e( 'Mensagem:', 'camara-hotsite' ); ?></label>
                    <textarea id="guia-feedback-mensagem" name="mensagem"></textarea>
                </div>
                <div class="visitas-form__actions">
                    <button type="submit" class="btn visitas-form__submit">
                        <?php esc_html_e( 'Enviar', 'camara-hotsite' ); ?>
                    </button>
                </div>
            </form>
            <?php if ( 'success' === $guia_feedback_status ) : ?>
                <div class="form-alert form-alert--success" role="status" aria-live="polite">
                    <?php esc_html_e( 'Recebemos sua manifestação! Obrigado pelo retorno.', 'camara-hotsite' ); ?>
                </div>
            <?php elseif ( 'error' === $guia_feedback_status ) : ?>
                <div class="form-alert form-alert--error" role="alert" aria-live="assertive">
                    <?php esc_html_e( 'Não foi possível enviar sua manifestação. Tente novamente em instantes.', 'camara-hotsite' ); ?>
                </div>
            <?php endif; ?>
            <p class="visitas-form__note">
                <?php esc_html_e( 'O seu contato é muito importante para nós! Ao preencher os dados, você autoriza receber os conteúdos da Câmara Municipal de São Paulo.', 'camara-hotsite' ); ?>
            </p>
            <p class="visitas-form__note">
                <?php esc_html_e( 'A Câmara Municipal de São Paulo respeita sua privacidade. Seus dados são tratados com segurança e conforme a LGPD.', 'camara-hotsite' ); ?>
            </p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-central">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Central telefônica', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'Para um atendimento imediato e personalizado, nossa equipe da central telefônica está disponível das 10h às 19h pelo número (11) 3396-4000.', 'camara-hotsite' ); ?></p>
        </div>
    </article>

    <article class="visitas-topic" id="guia-visita-virtual">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Visita virtual', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <p><?php esc_html_e( 'Acesse o conteúdo virtual:', 'camara-hotsite' ); ?></p>
            <ul class="visitas-topic__list">
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Galeria de vídeos: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/comunicacao/multimidia/galeria-de-videos/</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/comunicacao/multimidia/galeria-de-videos/' )
                    );
                    ?>
                </li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Rede Câmara SP: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/redecamara/</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/redecamara/' )
                    );
                    ?>
                </li>
                <li><?php esc_html_e( 'Redes Sociais: siga a Câmara nas redes e acompanhe tudo que acontece na política da cidade, siga: @camarasaopaulo (IG, Fb, X).', 'camara-hotsite' ); ?></li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Newsletters - Boletim Semanal “Câmara em Ação”: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/comunicacao/camaraemacao</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/comunicacao/camaraemacao/' )
                    );
                    ?>
                </li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Visita 360º: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/institucional/visita-virtual</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/institucional/visita-virtual/' )
                    );
                    ?>
                </li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Centro de Memória: Grupo de Trabalho permanente responsável pela organização, preservação e difusão dos materiais históricos produzidos pela instituição, acesse: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/memoria</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/memoria/' )
                    );
                    ?>
                </li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Portal da Biblioteca e Documentação: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/biblioteca</a> e <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/documentacao</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/biblioteca/' ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/documentacao/' )
                    );
                    ?>
                </li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Portal da Legislação Paulistana: Legislação Paulistana atualizada, se virou Lei/ Norma está no PLP, acesse: <a href="%s" target="_blank" rel="noopener">app-plpconsulta-prd.azurewebsites.net</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://app-plpconsulta-prd.azurewebsites.net' )
                    );
                    ?>
                </li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'SPLegis: Sistema do Processo Legislativo Digital, se está tramitando na CMSP, está no SPLegis: <a href="%s" target="_blank" rel="noopener">splegisconsulta.saopaulo.sp.leg.br</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://splegisconsulta.saopaulo.sp.leg.br/' )
                    );
                    ?>
                </li>
            </ul>
        </div>
    </article>

    <article class="visitas-topic" id="guia-publicacoes">
        <header class="visitas-topic__title">
            <span><?php esc_html_e( 'Publicações institucionais', 'camara-hotsite' ); ?></span>
        </header>
        <div class="visitas-topic__content">
            <ul class="visitas-topic__list">
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Revista Apartes: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/apartes</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/apartes/' )
                    );
                    ?>
                </li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Revista da Procuradoria: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/institucional/procuradoria/revista-procuradoria</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/institucional/procuradoria/revista-procuradoria/' )
                    );
                    ?>
                </li>
                <li>
                    <?php
                    printf(
                        wp_kses_post( __( 'Revista Parlamento e Sociedade: <a href="%s" target="_blank" rel="noopener">www.saopaulo.sp.leg.br/escoladoparlamento/publicacoes/parlamento-e-sociedade</a>.', 'camara-hotsite' ) ),
                        esc_url( 'https://www.saopaulo.sp.leg.br/escoladoparlamento/publicacoes/parlamento-e-sociedade/' )
                    );
                    ?>
                </li>
            </ul>
        </div>
    </article>
</section>
