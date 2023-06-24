<?php
define('ATTACHMENTS_SETTINGS_SCREEN', false);
add_filter('attachments_default_instance', '__return_false');


function beta_attachments($attachments)
{
 $feilds = array(
  array(
   'name' => 'title',
   'type' => 'text',
   'lebel' => __('Title', 'beta'),
  ),
  array(
   'name' => 'Caption',
   'type' => 'textarea',
   'lebel' => __('Caption', 'beta'),
  )
 );

 $args = array(
  'lebel' => 'Featured Slider',
  'post_type' => array('post'),
  'filetype' => array('image'),
  'note' => 'Add Slider Image',
  'button_text' => __('attach files', 'beta'),
  'feilds' => $feilds,
 );
 $attachments->register('slider', $args);
}
add_action('attachments_register', 'beta_attachments');



function beta_testimonial_attachments($attachments)
{
 $feilds = array(
  array(
   'name' => 'Name',
   'type' => 'text',
   'lebel' => __('Name', 'beta'),
  ),
  array(
   'name' => 'Position',
   'type' => 'textarea',
   'lebel' => __('Position', 'beta'),
  ),
  array(
   'name' => 'Company',
   'type' => 'textarea',
   'lebel' => __('Company', 'beta'),
  ),
  array(
   'name' => 'Testimonial',
   'type' => 'textarea',
   'lebel' => __('Testimonial', 'beta'),
  )
 );

 $args = array(
  'lebel' => 'Testimonials',
  'post_type' => array('page'),
  'filetype' => array('image'),
  'note' => 'Add Testimonials',
  'button_text' => __('attach files', 'beta'),
  'feilds' => $feilds,
 );
 $attachments->register('tetimonial', $args);
}
add_action('attachments_register', 'beta_testimonial_attachments');
