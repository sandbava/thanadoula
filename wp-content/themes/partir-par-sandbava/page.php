<?php get_header(); ?>
    <main class="standard-page">
        <h1 class="text-align-center"><?php the_title(); ?></h1>
        <div class="standard-page-content">
            <?php the_content(); ?>
        </div>
    </main>
    <?php get_template_part( 'template-parts/page-cta' ); ?>
<?php get_footer(); ?>
