<?php get_header(); ?>

<main class="container">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class('post'); ?>>
                <h1><?php the_title(); ?></h1>
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e('Nenhum conteúdo encontrado.', 'camara-hotsite'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
