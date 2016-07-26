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
add_filter('excerpt_more', 'wpdocs_excerpt_more');

/**
 * Register new post type(s).
 */
add_action('init', 'create_post_type');
function create_post_type() {
  register_post_type('circle_event',
    array(
      'labels' => array(
        'name' => __('Events'),
        'singular_name' => __('Event')
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'events'),
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    )
  );
}

/**
 * Register meta box(es).
 */
function wpdocs_register_meta_boxes() {
    add_meta_box( 'performed-date', __( 'Performed Date', 'textdomain' ), 'wpdocs_my_display_callback', 'circle_event' );
}
add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function wpdocs_my_display_callback($post) {
    wp_nonce_field(basename( __FILE__ ), 'circle_event_nonce');
?>
  <p>
    <input type="date" name="circle-event-performed-date" id="circle-event-performed-date"
         value="<?php echo esc_attr(get_post_meta($object->ID,'performed-date',true)); ?>"/>
  </p>
<?php
}
