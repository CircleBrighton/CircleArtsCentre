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
 * Filter the except length to 10 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
    return 10;
}

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more($more)
{
    return '';
}

/**
 * Register new post type(s).
 */
function create_post_type()
{
    register_post_type(
        'circle_event',
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

    register_post_type(
        'circle_aside',
        array(
            'labels' => array(
                'name' => __('Asides'),
                'singular_name' => __('Aside')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'asides'),
            'supports' => array('title', 'editor', 'excerpt'),
        )
    );
}

/**
 * Register meta box(es).
 */
function wpdocs_register_meta_boxes()
{
    add_meta_box('event-info', __('Event Info', 'textdomain'), 'wpdocs_display_event_callback', 'circle_event');
}

function wpdocs_save_meta($post_id, $post)
{
    /* Verify the nonce before proceeding. */
    if (!isset($_POST['circle_event_nonce']) || !wp_verify_nonce($_POST['circle_event_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    /* Get the post type object. */
    $post_type = get_post_type_object($post->post_type);

    /* Check if the current user has permission to edit the post. */
    if (!current_user_can($post_type->cap->edit_post, $post_id)) {
        return $post_id;
    }

    /* Get the posted data. */
    $new_meta_value = (isset($_POST['circle-event-performed-date']) ? $_POST['circle-event-performed-date'] : '');

    /* Get the meta key. */
    $meta_key = 'performed_date';

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta($post_id, $meta_key, true);

    /* If a new meta value was added and there was no previous value, add it. */
    if ($new_meta_value && '' == $meta_value) {
        add_post_meta($post_id, $meta_key, $new_meta_value, true);
    } /* If the new meta value does not match the old value, update it. */
    elseif ($new_meta_value && $new_meta_value != $meta_value) {
        update_post_meta($post_id, $meta_key, $new_meta_value);
    } /* If there is no new meta value but an old value exists, delete it. */
    elseif ('' == $new_meta_value && $meta_value) {
        delete_post_meta($post_id, $meta_key, $meta_value);
    }

    /* Get the posted data. */
    $new_meta_value = (isset($_POST['circle-event-performed-time']) ? $_POST['circle-event-performed-time'] : '');

    /* Get the meta key. */
    $meta_key = 'performed_time';

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta($post_id, $meta_key, true);

    /* If a new meta value was added and there was no previous value, add it. */
    if ($new_meta_value && '' == $meta_value) {
        add_post_meta($post_id, $meta_key, $new_meta_value, true);
    } /* If the new meta value does not match the old value, update it. */
    elseif ($new_meta_value && $new_meta_value != $meta_value) {
        update_post_meta($post_id, $meta_key, $new_meta_value);
    } /* If there is no new meta value but an old value exists, delete it. */
    elseif ('' == $new_meta_value && $meta_value) {
        delete_post_meta($post_id, $meta_key, $meta_value);
    }

    /* Get the posted data. */
    $new_meta_value = (isset($_POST['circle-event-price']) ? $_POST['circle-event-price'] : '');

    /* Get the meta key. */
    $meta_key = 'price';

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta($post_id, $meta_key, true);

    /* If a new meta value was added and there was no previous value, add it. */
    if ($new_meta_value && '' == $meta_value) {
        add_post_meta($post_id, $meta_key, $new_meta_value, true);
    } /* If the new meta value does not match the old value, update it. */
    elseif ($new_meta_value && $new_meta_value != $meta_value) {
        update_post_meta($post_id, $meta_key, $new_meta_value);
    } /* If there is no new meta value but an old value exists, delete it. */
    elseif ('' == $new_meta_value && $meta_value) {
        delete_post_meta($post_id, $meta_key, $meta_value);
    }
}

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function wpdocs_display_event_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'circle_event_nonce');
?>
  <div>
    <label for="circle-event-performed-date">Performed Date: </label>
    <input type="date" name="circle-event-performed-date" id="circle-event-performed-date"
         value="<?php echo esc_attr(get_post_meta($post->ID, 'performed_date', true)); ?>"/>
  </div>
  <div>
    <label for="circle-event-performed-time">Performed Time: </label>
    <input type="time" name="circle-event-performed-time" id="circle-event-performed-time"
         value="<?php echo esc_attr(get_post_meta($post->ID, 'performed_time', true)); ?>"/>
  </div>
  <div>
    <label for="circle-event-price">Performed Date: </label>
    <input type="text" name="circle-event-price" id="circle-event-price"
         value="<?php echo esc_attr(get_post_meta($post->ID, 'price', true)); ?> $"/>
  </div>
<?php
}

/**
 * Register circle theme menu
 */
function register_circle_menu()
{
    register_nav_menu('top-menu', __('Top Menu'));
}

/**
 * Meta box display callback.
 *
 * @param WP_Customize $wp_customize Customization object.
 */
function circle_customize_register($wp_customize)
{
    /* Feature Boxes */
    $wp_customize->add_section('feature_boxes', array(
        'title'      => __('Feature Boxes', 'circle'),
        'priority'   => 30,
    ));
    $wp_customize->add_setting('feature_left_box_title', array(
        'default'     => 'Coming Soon',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'feature_left_box_title_c', array(
        'label'        => __('Feature Left Box Title', 'circle'),
        'section'    => 'feature_boxes',
        'settings'   => 'feature_left_box_title',
    )));
    $wp_customize->add_setting('feature_middle_box_title', array(
        'default'     => 'This Week',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'feature_middle_box_title_c', array(
        'label'        => __('Feature Middle Box Title', 'circle'),
        'section'    => 'feature_boxes',
        'settings'   => 'feature_middle_box_title',
    )));
    $wp_customize->add_setting('feature_right_box_title', array(
        'default'     => 'Featured',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'feature_right_box_title_c', array(
        'label'        => __('Feature Right Box Title', 'circle'),
        'section'    => 'feature_boxes',
        'settings'   => 'feature_right_box_title',
    )));
}
