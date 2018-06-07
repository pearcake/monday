<?php
// Theme functions

// Global textdomain for i18e
define('THEME_TEXTDOMAIN', 'monday');

$includes = array(
  '/lib/cleanup.php',
  '/lib/setup_theme.php',
  '/lib/enqueue.php',
  '/lib/bem_menu_walker.php'
);
foreach($includes as $i){
  require_once(__DIR__ . $i);
}

register_nav_menus( array(
  'main'    => __( 'Main navigation', THEME_TEXTDOMAIN )
) );