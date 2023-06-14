<?php get_header(); ?>

<body <?php body_class(); ?>>
    <?php get_template_part("/template-parts/common/hero") ?>
    <div class="posts">
        <?php
        while (have_posts()) {
            the_post();
        ?>
            <div <?php post_class(); ?>>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong><?php the_author() ?></strong><br />
                                <?php echo get_the_date(); ?>
                            </p>
                            <?php echo get_the_tag_list("<ul class=\"list-unstyled\">
                        <li>", "</li><li>", "</li>
                        </ul>"); ?>

                            <?php
                            $bt_format = get_post_format();
                            if ($bt_format == "audio") {
                                echo '<span class="dashicons dashicons-playlist-audio"></span>';
                            } else if ($bt_format == "video") {
                                echo '<span class="dashicons dashicons-playlist-video"></span>';
                            } else if ($bt_format == "image") {
                                echo '<span class="dashicons dashicons-format-image"></span>';
                            }else if($bt_format == "quote"){
                                echo '<span class="dashicons dashicons-format-quote"></span>';
                            }else if($bt_format == "link"){
                                echo '<span class="dashicons dashicons-admin-links"></span>';
                            }else{
                                echo '';
                            }
                            ?>
                        </div>
                        <div class="col-md-8">
                            <p>
                                <?php
                                if (has_post_thumbnail()) {
                                    //$thumbnail_url = get_the_post_thumbnail_url(null, "large");
                                    // echo '<a href="'.$thumbnail_url.'" data-featherlight="myimage.png">';
                                    echo '<a class="popup" href="#" data-featherlight="image">';
                                    the_post_thumbnail("large", array("class" => "img-fluid"));
                                    echo '</a>';
                                }
                                // if (!post_password_required()) {
                                //     the_excerpt();
                                // } else {
                                //     echo get_the_password_form();
                                // }
                                the_excerpt();
                                ?>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

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