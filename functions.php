<?php
// attachment plugin check 
if (class_exists('Attachments')) {
  require_once("lib/attachment.php");
}


//dynamic Style CSS Version for cache.
if (site_url() == "http://localhost/beta") {
  define("VERSION", time());
} else {
  define("VERSION", wp_get_theme()->get("version"));
}


function bt_bootstrapping()
{
  load_theme_textdomain("bt");
  add_theme_support("post-thumbnails");
  add_theme_support("post-formats", array("image", "quote", "video", "audio", "link"));
  add_theme_support("dashicons");
  add_theme_support("title-tag)");
  $bt_custom_header_details = array(
    'header-text' => true,
    'default-text-color' => '#222',
    'width' => '1200',
    'height' => '600',
    'flex-width' => true,
    'flex-height' => true,
  );
  add_theme_support("custom-header", $bt_custom_header_details);
  $bt_custom_logo_size = array(
    'width' => '100',
    'height' => '100',
  );
  add_theme_support("custom-background");
  add_theme_support("custom-logo", $bt_custom_logo_size);
  register_nav_menu("topMenu", __("Header Menu", "bt"));
  register_nav_menu("footerMenu", __("Footer Menu", "bt"));
}
add_action("after_setup_theme", "bt_bootstrapping");

// All Custom Header details customization 
function bt_about_page_template_banner()
{
  if (is_page()) {
    $bt_feat_image = get_the_post_thumbnail_url(null, "large");
?>
    <style>
      .page-header {
        background-image: url(<?php echo $bt_feat_image; ?>)
      }
    </style>
    <?php
  }
  if (is_front_page()) {
    if (current_theme_supports("custom-header")) {
    ?>
      <style>
        .header {
          background-image: url(<?php echo header_image(); ?>);
          background-repeat: no-repeat;
          background-size: cover;
          margin-bottom: 40px;
        }

        .header h1.heading a,
        h3.tagline {
          color: #<?php echo get_header_textcolor(); ?>;
          <?php
          if (!display_header_text()) {
            echo "display: none";
          }
          ?>
        }
      </style>
<?php
    }
  }
}
add_action("wp_head", "bt_about_page_template_banner", 11);

function bt_assets()
{
  wp_enqueue_style("bootstrap", "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
  wp_enqueue_style("feather-light", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css");
  wp_enqueue_style("tns-slider", "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css");
  wp_enqueue_style("bt", get_stylesheet_uri(), null, VERSION);

  wp_enqueue_script("tns-js", "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js", null, "0.0.1", false);
  wp_enqueue_script("feather-light-js", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js", array("jquery"), "0.0.1", false);
  wp_enqueue_script("bt-main-js", get_theme_file_uri() . "/assets/main.js", null, VERSION, false);
}
add_action("wp_enqueue_scripts", "bt_assets");


function bt_sidebar()
{
  register_sidebar(
    array(
      'id'            => 'sidebar_1',
      'name'          => __('Single Post Sidebar', 'bt'),
      'description'   => __('Single Post Right sidebar.', 'bt'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );

  register_sidebar(
    array(
      'id'            => 'footer_left',
      'name'          => __('Footer Left Sidebar', 'bt'),
      'description'   => __('Widgetized area on the Left Footer', 'bt'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '',
      'after_title'   => '',
    )
  );

  register_sidebar(
    array(
      'id'            => 'footer_right',
      'name'          => __('Footer Right Sidebar', 'bt'),
      'description'   => __('Widgetized area on the Right Footer', 'bt'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '',
      'after_title'   => '',
    )
  );
}
add_action("widgets_init", "bt_sidebar");


// Password Protected Post filter

function bt_the_excerpt($excerpt)
{
  if (!post_password_required()) {
    return $excerpt;
  } else {
    echo get_the_password_form();
  }
}
add_filter("the_excerpt", "bt_the_excerpt");


function bt_protected_title_change()
{
  return "%s";
}
add_filter("protected_title_format", "bt_protected_title_change");

function bt_menu_item_class($classes, $item)
{
  $classes[] = "list-inline-item";
  return $classes;
}
add_filter("nav_menu_css_class", "bt_menu_item_class", 10, 2);

// filter for class remove from body_class and post_class

function bt_body_class($classes)
{
  unset($classes[array_search("custom-background", $classes)]);
  unset($classes[array_search("single-format-audio", $classes)]);
  return $classes;
}
add_filter("body_class", "bt_body_class");


function bt_post_class($classes)
{
  unset($classes[array_search("format-standard", $classes)]);
  return $classes;
}
add_filter("post_class", "bt_post_class");
