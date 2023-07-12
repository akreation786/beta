<?php
$bt_layout_class = "col-md-8";
if (!is_active_sidebar("sidebar_1")) {
  $bt_layout_class = "col-md-10 offset-md-1";
}

?>


<?php get_header(); ?>

<body <?php body_class(); ?>>
  <?php get_template_part("/template-parts/common/hero") ?>
  <div class="container">
    <div class="row">
      <div class="<?php echo $bt_layout_class; ?>">
        <div class="posts">
          <?php
          while (have_posts()) {
            the_post();
          ?>
            <div class="post" <?php post_class(); ?>>
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="post-title "><?php the_title() ?></h2>
                    <p>
                      <strong><?php the_author_posts_link(); ?></strong><br />
                      <?php echo get_the_date(); ?>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="slider">
                      <?php
                      if (class_exists('Attachments')) {
                        $attachments = new Attachments('slider');
                        if ($attachments->exist()) {
                          while ($attachment = $attachments->get()) { ?>
                            <div>
                              <?php echo $attachments->image('large'); ?>
                            </div>
                      <?php
                          }
                        }
                      }
                      ?>
                    </div>
                    <div>
                      <?php
                      // for attachement file plugin 
                      if (!class_exists('Attachments')) {
                        //$thumbnail_url = get_the_post_thumbnail_url(null, "large");
                        // echo '<a href="'.$thumbnail_url.'" data-featherlight="myimage.png">';
                        echo '<a class="popup" href="#" data-featherlight="image">';
                        the_post_thumbnail("large", array("class" => "img-fluid"));
                        echo '</a>';
                      }
                      ?>
                    </div>
                    <?php
                    the_content();

                    ?>
                    if (get_post_format() == "image" && function_exists("the_field")) :
                    ?>
                      <div class="acf_meta_info">
                        <strong> Camera Model: </strong><?php the_field("camera_model"); ?><br>
                        <strong>Location: </strong>
                        <?php
                        $bt_location = get_field("location");
                        echo esc_html($bt_location)
                        ?>
                        <br>
                        <strong>Date: </strong>
                        <?php
                        $bt_image_date = get_field("date");
                        echo esc_html($bt_image_date);
                        ?>
                        <br>
                        <?php if (get_field('licenced')) : ?>
                          <strong>Licenced: </strong>
                          <?php echo apply_filters("the_content", get_field("licence_information")); ?>
                        <?php endif; ?>
                        <p>
                          <?php
                          $bt_image = get_field("image");
                          $bt_image_details = wp_get_attachment_image_src($bt_image);
                          echo "<img src='" . esc_url($bt_image_details[0]) . "'/>";
                          ?>
                        </p>
                        <p>
                          <?php
                          the_field("attachment");
                          ?>
                        </p>

                        <?php if(function_exists("the_field")): ?>
                          <div>
                            <h1><?php _e("Related Posts","bt"); ?></h1>
                            <?php 
                            $related_posts = get_field("related_posts");
                            $bt_rp = new WP_Query(array(
                              'post__in' =>$related_posts,
                              'orderby' =>'post__in',
                            ));

                            while($bt_rp->have_posts()){
                              $bt_rp->the_post();
                              ?>
                              <h4><?php the_title(); ?></h4>
                              <?php
                            }
                            wp_reset_query();
                            ?>
                          </div>
                        <?php endif;?>

                      </div>
                    <?php

                    // page pagination 
                    wp_link_pages();

                    next_post_link();
                    echo "<br/>";
                    previous_post_link();
                    ?>
                  </div>
                  <div class="author_section">
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
                  <?php if (!post_password_required() && comments_open()) : ?>
                    <div class="col-md-12">
                      <?php comments_template(); ?>
                    </div>
                  <?php endif; ?>
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
      </div>
      <?php
      if (is_active_sidebar("sidebar_1")) :
      ?>
        <div class="col-md-4">
          <?php
          if (is_active_sidebar("sidebar_1")) {
            dynamic_sidebar("sidebar_1");
          }
          ?>
        </div>
      <?php
      endif;
      ?>
    </div>
  </div>
  <?php get_footer(); ?>