<?php
get_header();
?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php
                                                                    echo get_theme_file_uri('/images/ocean.jpg')
                                                                    ?>)">
    </div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"> -->
            <!-- rendering category dymanically on a post  -->
            <?php
            // if (is_category()) {
            //     single_cat_title();
            // }
            // rending author of a posy dynamically 
            // if (is_author()) {
            //     echo 'Posts by ';
            //     the_author();
            // }
            // single function 
            the_archive_title();
            ?>
        </h1>
        <div class="page-banner__intro">
            <!-- description below the blog title  -->
            <p><?php
                the_archive_description();
                ?></p>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post(); ?>
        <div class="post-item">
            <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <div class="metabox">
                <!-- make name, date, and blog location dynamic  -->
                <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y') ?> in <?php echo get_the_category_list(', ') ?></p>
            </div>

            <div class="generic-content">
                <?php the_excerpt(); ?>
                <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue Reading</a></p>
            </div>
        </div>
    <?php }
    echo paginate_links();
    ?>
</div>
<?php
get_footer();
