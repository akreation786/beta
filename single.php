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
                  <?php if (comments_open()) : ?>
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