<article class="post page <?php if(has_post_thumbnail()){?>has-thumbnail<?php } ?>">
    <!--Thumbnail-->
    <div class="post-thumbnail">
        <a href="<?php  the_permalink(); ?>"> <?php
            the_post_thumbnail('small-thumbnail')
            ?>
        </a>



    </div>
    <!--Thumbnail end-->


    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

    <p class="post-info"><?php the_time('F j, Y g:i a') ?> | by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> |

        <?php
        $categories =get_the_category();
        $separator= ",";
        $output = '';

        if($categories){
            foreach ($categories as $category){
                $output .='<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>'  . $separator;
            }
        }
        echo trim($output, $separator);

        ?>


    </p>



    <p>
        <?php
        if(is_search() OR is_archive()){?>

        <?php echo get_the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" >Read more</a>
        <?php
        }
        else{
            ?>
        }
             <?php echo get_the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" >Read more1</a>
<?php
        }
        ?>

    </p>
</article>