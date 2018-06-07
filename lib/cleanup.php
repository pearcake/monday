<?php

function start_cleanup() {
  add_action( 'init', 'cleanup_head' );
  add_action( 'init', 'disable_emojis' );
  add_filter( 'the_generator', function() { return ''; } );
  add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
  add_action( 'wp_head', 'remove_recent_comments_style', 1 );
  
}
add_action( 'after_setup_theme','start_cleanup' );

function cleanup_head() {
  // EditURI link.
  remove_action( 'wp_head', 'rsd_link' );
  // Category feed links.
  remove_action( 'wp_head', 'feed_links_extra', 3 );
  // Post and comment feed links.
  remove_action( 'wp_head', 'feed_links', 2 );
  // Windows Live Writer.
  remove_action( 'wp_head', 'wlwmanifest_link' );
  // Index link.
  remove_action( 'wp_head', 'index_rel_link' );
  // Previous link.
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  // Start link.
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  // Canonical.
  remove_action( 'wp_head', 'rel_canonical', 10, 0 );
  // Shortlink.
  remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
  // Links for adjacent posts.
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  // WP version.
  remove_action( 'wp_head', 'wp_generator' );
}

function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

function remove_recent_comments_style() {
  global $wp_widget_factory;
  if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}
function remove_thumbnail_dimensions( $html ) {
  $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
  return $html;
}