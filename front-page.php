<?php get_header(); ?>

<main>

    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <span class="hero-subtitle">Guia do Visitante</span>
            <h1>Palácio Anchieta</h1>
        </div>
    </section>

    <section class="bloco bloco-intro">
        <div class="container">
            <h2>VENHA CONHECER A CÂMARA MUNICIPAL DE SÃO PAULO</h2>
            <p>
                O Palácio Anchieta convida você para uma viagem no tempo! Arquitetura única, obras de arte e uma aula sobre o passado
                político, social e cultural de São Paulo.
            </p>
        </div>
    </section>

    <section class="bloco bloco-visita">
        <div class="container grid-2">
            <div>
                <h3>VOCÊ É NOSSO CONVIDADO ESPECIAL!</h3>
                <h2>AGENDE A SUA VISITA</h2>
                <p>Escolha o melhor dia e horário para conhecer de perto o Palácio Anchieta.</p>
                <div class="agenda-placeholder">
                    <p>Aqui você pode inserir um plugin de agenda ou tabela de horários.</p>
                </div>
            </div>
            <div class="tour-card">
                <h3>NÃO CONSEGUIU AGENDAR?</h3>
                <h2>FAÇA UM TOUR VIRTUAL</h2>
                <p>Está longe da cidade ou sem tempo para visitar presencialmente? Conheça o Palácio Anchieta em um passeio virtual.</p>
                <a href="#" class="btn">TOUR VIRTUAL</a>
            </div>
        </div>
    </section>

    <section class="bloco bloco-fale">
        <div class="container">
            <h2>FALE COM A CÂMARA!</h2>
            <p>
                Bem-vindo ao canal de comunicação “Fale Conosco” da Câmara Municipal de São Paulo.
                Esse canal ajudará você a dar seu feedback e a resolver suas dúvidas.
            </p>
            <p class="central-telefonica">
                Central Telefônica: <strong>(11) 3396-4000</strong><br>
                Atendimento das 10:00 às 19:00.
            </p>

            <form class="form-fale">
                <div class="grid-3">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input id="nome" type="text" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input id="telefone" type="text" name="telefone">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mensagem">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn">Enviar</button>
            </form>

            <p class="lgpd">
                Seus dados estão seguros e protegidos de acordo com a LGPD.
            </p>
        </div>
    </section>

</main>

<?php get_footer(); ?>
