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

/**
 * Filter the except length to 10 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length) {
    return 10;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length');

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more($more) {
    /* uncomment following code in order to have button for read more. */
    /*
    return sprintf('<div><a class="btn btn-primary" href="%1$s">%2$s</a></div>',
        get_the_permalink(),
        __('Read More', 'textdomain')
    );
     */
    return '';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more');

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'circle_event',
    array(
      'labels' => array(
        'name' => __('Events'),
        'singular_name' => __('Event')
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'events'),
    )
  );
}
