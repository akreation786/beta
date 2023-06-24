<?php get_header(); ?>

<body <?php body_class(array("second_class")); ?>>
    <?php get_template_part("/template-parts/common/hero") ?>
    <div class="container">
        <div class="author_section author_page">
            <div class="row">
                <div class="col-md-2">
                    <?php
                    echo get_avatar(get_the_author_meta("ID"));
                    ?>
                </div>
                <div class="col-md-10">
                    <h4>
                        <?php echo get_the_author_meta("display_name"); ?>
                    </h4>
                    <p>
                        <?php echo get_the_author_meta("description"); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="posts text-center">
        <?php
        while (have_posts()) {
            the_post();
        ?>
            <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>
        <?php
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