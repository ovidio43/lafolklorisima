<?php
/*
 * template name: display News
 */
get_header();
?>

<section class="main-content home-news">
    <div id="content-wrapper">
        <section class="news-wrap">
            <?php query_posts('category_name=news&paged=' . $paged . 'posts_per_page=' . get_option('posts_per_page')); ?>
            <?php if (have_posts()) : ?>
                <?php
                while (have_posts()) : the_post();
                    $url = get_image_catch(get_the_ID(), 'large');
                    ?>
                    <article id="post-<?php the_ID(); ?>" class="news-post">
                        <div class="entry-image">
                            <img src="<?php echo $url; ?>">
                        </div>
                        <div class="caption-news">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </div>          
                    </article>
                <?php endwhile; ?>
                <?php custom_page_nav();?>
            <?php endif; ?>
        </section>
        <?php get_sidebar(); ?>
    </div>
</section>

<?php
get_footer();
