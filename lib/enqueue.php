<?php
function theme_scripts() {

  wp_deregister_script('jquery');
  wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), '3.3.1');

  if (!wp_is_mobile && preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
    wp_enqueue_script('polyfill', 'https://cdn.polyfill.io/v2/polyfill.min.js?features=default,Array.prototype.includes', array('jquery'), null);
  }

  wp_enqueue_script('theme-js', get_stylesheet_directory_uri() . '/assets/dist/js/theme.js', array('jquery'), filemtime( get_theme_file_path('assets/dist/js/theme.js') ), true);

  wp_enqueue_style( 'theme-css', get_stylesheet_directory_uri() . '/assets/dist/css/theme.css', array(), filemtime( get_theme_file_path('assets/dist/css/theme.css') ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );
