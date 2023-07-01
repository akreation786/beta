<?php get_header(); ?>

<body <?php body_class(array("second_class")); ?>>
    <?php get_template_part("/template-parts/common/hero") ?>
    <div class="posts">
        <?php
        if (!have_posts()) {
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3><?php _e("No Result Found", "bt"); ?></h3>
                    </div>
                </div>
            </div>
        <?php
        }
        while (have_posts()) {
            the_post();
            get_template_part("post-formats/content", get_post_format());
        };
        ?>
        <div class="container post_pagination">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <?php
                    the_posts_pagination(array(
                        "screen_reader_text" => " "
                    ))
                    ?>
                </div>
            </div>
        </div>

    </div>
    <?php get_footer(); ?>