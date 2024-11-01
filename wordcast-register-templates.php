<?php
add_filter('single_template', function($single_template){
  global $post;
  if($post->post_type == 'wordcastchannel'){
    $single_template = dirname(__FILE__) . '/templates/single-wc-channel.php';
  }
  return $single_template;
});