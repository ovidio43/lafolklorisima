
<?php get_header(); ?>

<section class="main-content">
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post();
        the_title();
        the_content();
        ?>

        <?php endwhile; ?>
      <?php endif; ?>
</section>

<?php get_footer(); ?>