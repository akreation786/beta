 <?php
    /*
 * Template Name: About Page Template 
 */


    get_header(); ?>

 <body <?php body_class(); ?>>
  <?php get_template_part("/template-parts/about-page/hero-page") ?>
  <div class="posts">
   <?php
            while (have_posts()) {
                the_post();
            ?>
   <div class="post" <?php post_class(); ?>>
    <div class="container">
     <div class="row">
      <div class="col-md-12">
       <h2 class="post-title">
        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
       </h2>
      </div>
     </div>
     <div class="row">
      <?php
                            if (class_exists("Attachments")) {
                            ?>
      <h3><?php echo _e("Testimonials", "bt"); ?></h3>

      <?php
                            }
                            ?>
      <div class="col-md-8 offset-md-2">
       <div class="testimonials slider text-center">
        <?php
                                    if (class_exists("Attachments")) {
                                        $attachments = new Attachments('testimonials');
                                        if ($attachments->exist()) {
                                            while ($attachment = $attachments->get()) { ?>
        <div>
         <?php echo $attachments->image('thumbnail'); ?>
         <h4><?php echo esc_html($attachments->field("name")); ?></h4>
         <p><?php echo esc_html($attachments->field("testimonial")); ?></p>
         <p><?php echo esc_html($attachments->field("position")); ?>
          <strong></strong><?php echo esc_html($attachments->field("company")); ?></strong>
         </p>
        </div>
        <?php
                                            }
                                        }
                                    }
                                    ?>
       </div>
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

     <?php
                        if (class_exists("Attachments")) {
                        ?>
     <h3><?php echo _e("Team Member", "bt"); ?></h3>

     <?php
                        }
                        ?>
     <?php
                        if (class_exists("Attachments")) {
                        ?>
     <div class="row text-center">
      <?php
                                $attachments = new Attachments('team');
                                if ($attachments->exist()) {
                                    while ($attachment = $attachments->get()) { ?>
      <div class="col-md-4 ">
       <?php echo $attachments->image('medium'); ?>
       <h4><?php echo esc_html($attachments->field("name")); ?></h4>
       <p><?php echo esc_html($attachments->field("position")); ?></p>
       <p><?php echo esc_html($attachments->field("email")); ?></p>
       <p><?php echo esc_html($attachments->field("bio")); ?></p>
      </div>
      <?php
                                    }
                                }
                                ?>
     </div>
     <?php
                        }
                        ?>

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