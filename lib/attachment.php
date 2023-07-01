<?php
define('ATTACHMENTS_SETTINGS_SCREEN', false);
add_filter('attachments_default_instance', '__return_false');


function beta_attachments($attachments)
{
 $fields = array(
  array(
   'name' => 'title',
   'type' => 'text',
   'lebel' => __('Title', 'beta'),
  ),
  array(
   'name' => 'Caption',
   'type' => 'textarea',
   'label' => __('Caption', 'beta'),
  )
 );

 $args = array(
  'label' => 'Featured Slider',
  'post_type' => array('post'),
  'filetype' => array('image'),
  'note' => 'Add Slider Image',
  'button_text' => __('attach files', 'beta'),
  'fields' => $fields,
 );
 $attachments->register('slider', $args);
}
add_action('attachments_register', 'beta_attachments');



function beta_testimonial_attachments($attachments)
{
 $fields = array(
  array(
   'name' => 'Name',
   'type' => 'text',
   'label' => __('Name', 'beta'),
  ),
  array(
   'name' => 'Position',
   'type' => 'text',
   'label' => __('Position', 'beta'),
  ),
  array(
   'name' => 'Company',
   'type' => 'text',
   'label' => __('Company', 'beta'),
  ),
  array(
   'name' => 'Testimonial',
   'type' => 'textarea',
   'label' => __('Testimonial', 'beta'),
  )
 );

 $args = array(
  'label' => 'Testimonials',
  'post_type' => array('page'),
  'filetype' => array('image'),
  'note' => 'Reviewer',
  'button_text' => __('attach files', 'beta'),
  'fields' => $fields,
 );
 $attachments->register('testimonials', $args);
}
add_action('attachments_register', 'beta_testimonial_attachments');


function beta_team_attachments($attachments)
{
 $fields = array(
  array(
   'name' => 'Name',
   'type' => 'text',
   'label' => __('Name', 'beta'),
  ),
  array(
   'name' => 'Position',
   'type' => 'text',
   'label' => __('Position', 'beta'),
  ),
  array(
   'name' => 'email',
   'type' => 'text',
   'label' => __('Email', 'beta'),
  ),
  array(
   'name' => 'Bio',
   'type' => 'textarea',
   'label' => __('bio', 'beta'),
  )
 );

 $args = array(
  'label' => 'Team',
  'post_type' => array('page'),
  'filetype' => array('image'),
  'note' => 'Reviewer',
  'button_text' => __('attach files', 'beta'),
  'fields' => $fields,
 );
 $attachments->register('team', $args);
}
add_action('attachments_register', 'beta_team_attachments');
