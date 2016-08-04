<?php
/**
 * In The Name Of God
 *
 * PHP Version 5
 *
 * Short description for file
 *
 * @category Theme
 * @package  Wordpress\BehWeb
 * @author   Parham Alvani <parham.alvani@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 *
 */
/**
 * Add support for tumbnails in posts :)
 */
add_theme_support('post-thumbnails');

require('declaration.php');

add_filter('excerpt_length', 'circle_excerpt_length');

add_filter('excerpt_more', 'circle_excerpt_more');

add_action('init', 'circle_register_post_type');

add_action('init', 'circle_register_menu');

add_action('add_meta_boxes', 'circle_register_meta');

add_action('save_post', 'circle_save_event_meta', 10, 2);

add_action('customize_register', 'circle_customize_register');

add_action('admin_enqueue_scripts', 'circle_enqueue_admin_script');

add_shortcode('events', 'circle_events_shortcode');

add_action('widgets_init', 'circle_widgets_init');
