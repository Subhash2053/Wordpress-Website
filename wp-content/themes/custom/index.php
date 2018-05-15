<?php

get_header(); ?>

    <!-- site-content -->
    <div class="site-content clearfix">

        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title">Welcome to our blog!
                    </h1>
                <div class="page-banner__intro">
                    <p>Keep up with our latest news.</p>
                </div>
            </div>
        </div>

        <div class="container container--narrow page-section">





        <?php if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
            <div class="post-item">
                <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>" ><?php
                        the_title();
                        ?></a> </h2>
                <div class="metabox">
                    Posted by <?php  the_author_posts_link(); ?> | <?php the_time('F j, Y ') ?> |
                    <?php
                   echo get_the_category_list(', ');
                    ?>
                </div>

                <div class="generic-content">
                    <?php
                    the_excerpt();
                    ?>
                    <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue Reading >></a></p>
                </div>
            </div>


            <?php

            endwhile;
            echo paginate_links();



        else :
            echo '<p>No content found</p>';

        endif;
        ?>
        </div>




    </div><!-- /site-content -->

<?php get_footer();

?>