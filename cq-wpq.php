<?php

/** 
 * Template Name: Custom Query WP Query
 */

?>
<?php get_header(); ?>

<body <?php body_class(array("second_class")); ?>>
    <?php get_template_part("/template-parts/common/hero") ?>
    <div class="posts text-center">
        <h1>Post Under <?php single_tag_title(); ?></h1>
        <?php
        $paged = get_query_var("paged") ? get_query_var("paged") : 1;
        $posts_per_page = 3;
        // $post_ids = array(1, 116, 11, 100, 98, 103, 93);
        $_p = new WP_Query(array(
            // 'category_name' => 'bangla',
            // 'tag' => 'dhaka',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'text_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => array('BANGLA')
                ),
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'slug',
                    'terms' => array('blog')
                ),
            ),
        ));
        while ($_p->have_posts()) {
            $_p->the_post();
        ?>
            <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>
        <?php
        };
        wp_reset_query();
        ?>
        <div class="container post_pagination">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <?php
                    echo paginate_links(array(
                        'total' => $_p->max_num_pages,
                        'current' => $paged,
                        'prev_text' => __('New Posts', 'bt'),
                        'next_text' => __('Old Posts', 'bt'),

                    ));
                    ?>
                </div>
            </div>
        </div>

    </div>
    <?php get_footer(); ?>