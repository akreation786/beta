<?php get_header(); ?>

<body <?php body_class(); ?>>
 <?php get_template_part("/template-parts/common/hero") ?>
 <div class="posts">
  <?php
  while (have_posts()) {
   the_post();
  ?>
   <div class="post" <?php post_class(); ?>>
    <div class="container">
     <div class="row">
      <div class="col-md-10 offset-md-1">
       <h2 class="post-title text-center"><?php the_title() ?></h2>
       <p class="text-center">
        <strong><?php the_author() ?></strong><br />
        <?php echo get_the_date(); ?>
       </p>
      </div>
     </div>
     <div class="row">
      <div class="col-md-10 offset-md-1 text-center">
       <p>
        <?php
        //$thumbnail_url = get_the_post_thumbnail_url(null, "large");
        // echo '<a href="'.$thumbnail_url.'" data-featherlight="myimage.png">';
        echo '<a class="popup" href="#" data-featherlight="image">';
        the_post_thumbnail("large", array("class" => "img-fluid"));
        echo '</a>';
        ?>
       </p>
       <?php
       the_content();
       ?>
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