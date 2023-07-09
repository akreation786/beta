<div class="comment">
 <h3><?php
     $bt_cn = get_comments_number();
     if (1 == $bt_cn) {
      _e("1 Comment", "bt");
     } else {
      echo $bt_cn . " " . __("Comments", "bt");
     }
     ?>
 </h3>
 <?php
 wp_list_comments();
 if (!comments_open()) {
  _e("Comment are Closed", "bt");
 }
 comment_form();
 ?>

</div>