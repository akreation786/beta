<?php

/** 
 * Template Name: Custom Query
 */

?>
<?php get_header(); ?>

<body <?php body_class(array("second_class")); ?>>
    <?php get_template_part("/template-parts/common/hero") ?>
    <div class="posts text-center">
        <h1>Post Under <?php single_tag_title(); ?></h1>
        <?php
        $paged = get_query_var("paged") ? get_query_var("paged") : 1;
        $posts_per_page = 2;
        $post_ids = array(116, 11, 1, 100, 98, 103, 93);
        $_p = get_posts(array(
            'posts_per_page' => $posts_per_page,
            'post__in' => $post_ids,
            'orderby' => 'post__in',
            'paged' => $paged,
        ));
        foreach ($_p as $post) {
            setup_postdata($post);
        ?>
            <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>
        <?php
            wp_reset_postdata();
        };
        ?>
        <div class="container post_pagination">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <?php
                    echo paginate_links(array(
                        'total' => ceil(count($post_ids) / $posts_per_page)
                    ));
                    ?>
                </div>
            </div>
        </div>

    </div>
    <?php get_footer(); ?>