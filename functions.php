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

add_filter('excerpt_length', 'wpdocs_custom_excerpt_length');

add_filter('excerpt_more', 'wpdocs_excerpt_more');

add_action('init', 'create_post_type');

add_action('init', 'register_circle_menu');

add_action('add_meta_boxes', 'wpdocs_register_meta_boxes');

add_action('save_post', 'wpdocs_save_meta', 10, 2);

add_action('customize_register', 'circle_customize_register');

add_action('admin_enqueue_scripts', 'wpdocs_enqueue_admin_script');

add_shortcode('events', 'circle_events_shortcode');
