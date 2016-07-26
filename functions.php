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
			'taxonomies' => array('category'),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'events'),
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
		)
	);
}

/**
 * Show posts of 'post' and 'circle_event' post types on all quires.
 */
add_action( 'pre_get_posts', 'add_circle_event_to_query');
function add_circle_event_to_query($query) {
	$query->set('post_type', array('post', 'circle_event'));
	return $query;
}

/**
 * Register meta box(es).
 */
function wpdocs_register_meta_boxes() {
	add_meta_box('performed-date', __('Performed Date', 'textdomain'), 'wpdocs_display_event_callback', 'circle_event' );
}
add_action('add_meta_boxes', 'wpdocs_register_meta_boxes');

function wpdocs_save_meta($post_id, $post) {
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['circle_event_nonce'] ) || !wp_verify_nonce( $_POST['circle_event_nonce'], basename( __FILE__ )))
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object($post->post_type);

	/* Check if the current user has permission to edit the post. */
	if (!current_user_can($post_type->cap->edit_post, $post_id))
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = (isset( $_POST['circle-event-performed-date'] ) ? sanitize_html_class( $_POST['circle-event-performed-date'] ) : '');

	/* Get the meta key. */
	$meta_key = 'performed_date';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta($post_id, $meta_key, true);

	/* If a new meta value was added and there was no previous value, add it. */
	if ($new_meta_value && '' == $meta_value)
		add_post_meta($post_id, $meta_key, $new_meta_value, true);

	/* If the new meta value does not match the old value, update it. */
	elseif ($new_meta_value && $new_meta_value != $meta_value)
		update_post_meta($post_id, $meta_key, $new_meta_value);

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ('' == $new_meta_value && $meta_value)
		delete_post_meta($post_id, $meta_key, $meta_value);
}
add_action('save_post', 'wpdocs_save_meta', 10, 2);

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function wpdocs_display_event_callback($post) {
	wp_nonce_field(basename( __FILE__ ), 'circle_event_nonce');
?>
  <p>
	<input type="date" name="circle-event-performed-date" id="circle-event-performed-date"
		 value="<?php echo esc_attr(get_post_meta($post->ID,'performed_date',true)); ?>"/>
  </p>
<?php
}

