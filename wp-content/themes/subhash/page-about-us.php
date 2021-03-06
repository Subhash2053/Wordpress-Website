<?php

get_header(); ?>

    <!-- site-content -->
    <div class="site-content clearfix">





        <?php if (have_posts()) :
            while (have_posts()) : the_post();
        ?>
                <div class="page-banner">
                    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
                    <div class="page-banner__content container container--narrow">
                        <h1 class="page-banner__title"><?php
                            the_title()
                            ?></h1>
                        <div class="page-banner__intro">
                            <p>Learn how the school of your dreams got started.</p>
                        </div>
                    </div>
                </div>

                <div class="container container--narrow page-section">
                    <?php

            if( $post->post_parent >0) {

                ?>
                <div class="metabox metabox--position-up metabox--with-home-link">
                    <p><a class="metabox__blog-home-link" href="#"><i class="fa fa-home" aria-hidden="true"></i> Back to
                            About Us</a>

                        <span class="metabox__main"><?php the_title() ?></span></p>
                </div>
                <?php
            }
                ?>




                    <div class="page-links">
                        <h2 class="page-links__title"><a href="#">About Us</a></h2>
                        <ul class="min-list">
                            <?php

                            $args=array(
                                'child_of' => get_the_ID(),
                                'title_li' => NULL
                            )


                            ?>



                            <li class="current_page_item"><a href="
                            <?php
                              echo  site_url(wp_list_pages($args))

                                ?>">
                                    <?php
                                    wp_list_pages($args);
                                    ?></a></li>



                        </ul>
                    </div>

                    <div class="generic-content">
                        <p>
                            <?php
                            the_content()
                            ?>
                        </p>
                    </div>

                </div>

        <?php
            endwhile;

        else :
            echo '<p>No content found</p>';

        endif;
        ?>




    </div><!-- /site-content -->

<?php get_footer();

?>