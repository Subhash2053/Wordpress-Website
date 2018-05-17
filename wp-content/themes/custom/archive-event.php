<?php
get_header();
if (have_posts()) :


    ?>
<!-- site-content -->
<div class="site-content clearfix">

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php
                if(is_category()){
                    single_cat_title();

                }elseif(is_tag()){
                    single_tag_title();

                }elseif(is_author()){
                    the_post();
                    echo 'Author Archives: '. get_the_author();
                    rewind_posts();
                }elseif(is_day()){
                    echo 'Daily Archives: '. get_the_date();
                }
                elseif(is_month()){
                    echo 'Monthly Archives: '. get_the_date('F Y');
                }
                elseif(is_year()){
                    echo 'Yearly Archives: '. get_the_date('Y');
                }
                else{
                    echo 'Archives: '.get_post_type();
                }

                ?>
            </h1>
            <div class="page-banner__intro">
                <p><?php the_archive_description(); ?></p>
            </div>
        </div>
    </div>
    <div class="container container--narrow page-section">


<?php
    while (have_posts()) :the_post();
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


else:
    echo "Article not found";
endif;
?>
</div>

<?php
get_footer();

?>
