<?php
function setup_theme(){
  
  load_theme_textdomain(THEME_TEXTDOMAIN, get_template_directory() . '/languages');

  add_theme_support('menus');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support( 'custom-logo', array(
    'height'      => 175,
    'width'       => 400,
    'flex-height' => true,
    'flex-width' => true,
 ) );
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ));
  add_filter('widget_text', 'do_shortcode');
  add_theme_support('woocommerce');
          
}

add_action( 'after_setup_theme', 'setup_theme' );