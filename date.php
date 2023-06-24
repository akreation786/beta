<?php get_header(); ?>

<body <?php body_class(array("second_class")); ?>>
    <?php get_template_part("/template-parts/common/hero") ?>
    <div class="posts text-center">
        <h1>Post Under
            <!-- month number to month name convert. -->
            <?php
            if (is_month()) {
                $month = get_query_var("monthnum");
                $dateobj = DateTime::createFromFormat("!m", $month);
                echo $dateobj->format("F");
            } else if (is_year()) {
                echo get_query_var("year");
            } else if (is_day()) {
                printf("%s/%s/%s", get_query_var("day"), get_query_var("monthnum"), get_query_var("year"));
                // alt 
                // echo get_query_var("day"), "/" . get_query_var("monthnum") . "/" . get_query_var("year");
            }
            ?>
        </h1>
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