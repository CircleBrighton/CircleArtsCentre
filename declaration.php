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
function circle_excerpt_length($length)
{
    return 10;
}

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function circle_excerpt_more($more)
{
    return '';
}

/**
 * Register new post type(s).
 */
function circle_register_post_type()
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
function circle_register_meta()
{
    add_meta_box('event-info', __('Event Info', 'textdomain'), 'circle_display_event_meta', 'circle_event');
}

function circle_save_event_meta($post_id, $post)
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

    /* Provide handler function as closure */
    $wpdocs_save_meta = function ($post_id, $post, $meta_key, $post_key) {
        /* Get the posted data. */
        $new_meta_value = (isset($_POST[$post_key]) ? $_POST[$post_key] : '');

        /* Get the meta value of the custom field key. */
        $meta_value = get_post_meta($post_id, $meta_key, true);

        /* If a new meta value was added and there was no previous value, add it. */
        if ($new_meta_value && $meta_value == '') {
            add_post_meta($post_id, $meta_key, $new_meta_value, true);
        } /* If the new meta value does not match the old value, update it. */
        elseif ($new_meta_value && $new_meta_value != $meta_value) {
            update_post_meta($post_id, $meta_key, $new_meta_value);
        } /* If there is no new meta value but an old value exists, delete it. */
        elseif ($new_meta_value == '' && $meta_value) {
            delete_post_meta($post_id, $meta_key, $meta_value);
        }
    };

    $wpdocs_save_meta($post_id, $post, 'perfomed_date', 'circle-event-performed-data');
    $wpdocs_save_meta($post_id, $post, 'perfomed_time', 'circle-event-performed-time');
    $wpdocs_save_meta($post_id, $post, 'price', 'circle-event-price');
    $wpdocs_save_meta($post_id, $post, 'buy_link', 'circle-event-buy-link');
    $wpdocs_save_meta($post_id, $post, 'status', 'circle-event-status');
}

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function circle_display_event_meta($post)
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
    <label for="circle-event-price">Price: </label>
    <input type="text" name="circle-event-price" id="circle-event-price"
         value="<?php echo esc_attr(get_post_meta($post->ID, 'price', true)); ?>"/>
  </div>
  <div>
    <label for="circle-event-buy-link">Buy Ticket Link: </label>
    <input type="url" name="circle-event-buy-link" id="circle-event-buy-link"
         value="<?php echo esc_attr(get_post_meta($post->ID, 'buy_link', true)); ?>"/>
  </div>
  <div>
    <label for="circle-event-status">Status: </label>
    <select name="circle-event-status" id="circle-event-status">
        <option value="1"
            <?php echo get_post_meta($post->ID, 'status', true) == '1' ? 'selected' : '' ?>>on Sell</option>
        <option value="2"
            <?php echo get_post_meta($post->ID, 'status', true) == '2' ? 'selected' : '' ?>>Finished</option>
        <option value="3"
            <?php echo get_post_meta($post->ID, 'status', true) == '3' ? 'selected' : '' ?>>Cancelled</option>
        <option value="4"
            <?php echo get_post_meta($post->ID, 'status', true) == '4' ? 'selected' : '' ?>>Free Entry</option>
        <option value="5"
            <?php echo get_post_meta($post->ID, 'status', true) == '5' ? 'selected' : '' ?>>Members Only</option>
    </select>
  </div>
<?php
}

/**
 * Register circle theme menu
 */
function circle_register_menu()
{
    register_nav_menu('top-menu', __('Top Menu'));
}

/**
 * Theme customization callback.
 *
 * @param WP_Customize $wp_customize Customization object.
 */
function circle_customize_register($wp_customize)
{
    /* Address */
    $wp_customize->add_setting('address_box_office', array(
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'address_box_office_c', array(
        'label'        => __('Box Office', 'circle'),
        'section'    => 'title_tagline',
        'settings'   => 'address_box_office',
    )));

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

    /* SlideShow */
    $wp_customize->add_section('slideshow', array(
        'title'      => __('SlideShow', 'circle'),
        'priority'   => 30,
    ));
    $wp_customize->add_setting('slideshow_interval', array(
        'default'     => '5000',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'slideshow_interval_c', array(
        'label'        => __('SlideShwo Interval', 'circle'),
        'section'    => 'slideshow',
        'settings'   => 'slideshow_interval',
    )));
}


/**
 * Enqueue a script in the WordPress admin, excluding edit.php.
 *
 * @param string $hook Hook suffix for the current admin page.
 */
function circle_enqueue_admin_script($hook)
{
    wp_enqueue_script('modernizer', get_template_directory_uri().'/js/webshim/extras/modernizr-custom.js');
    wp_enqueue_script('polyfiller', get_template_directory_uri().'/js/webshim/polyfiller.js');
    wp_enqueue_script('admin.js', get_template_directory_uri().'/js/admin.js');
}

/**
 * Handling events shortcode
 *
 @ @param Array $attrs attributes passed into shortcode.
 */
function circle_events_shortcode($attrs)
{
    $n = shortcode_atts(array(
        'number' => 50,
    ), $attrs)['number'];
    ob_start();
?>
<?php $q = new WP_Query(array ('post_type' => 'circle_event'));
$i = 0; ?>
<table class="table table-striped table-hover table-clickable table-sortable">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Name</th>
            <th>Time</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
<?php while ($q->have_posts() && $i < $n) :
    $q->the_post();
    $i++; ?>
        <tr data-url="<?php the_permalink(); ?>">
            <td><?php echo $i ?></td>
            <td><?php echo get_post_meta(get_the_ID(), 'performed_date', true); ?>
            <td><?php the_title(); ?></td>
            <td><?php echo get_post_meta(get_the_ID(), 'performed_time', true); ?>
            <td><?php echo get_post_meta(get_the_ID(), 'price', true); ?>
        </tr>
<?php endwhile; ?>
    </tbody>
</table>
<?php
return ob_get_clean();
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function circle_widgets_init()
{
    register_sidebar(array(
        'name' => 'Tweets',
        'id' => 'tweets',
        'before_widget' =>
        '<div class="well well-sm cycle-slideshow" data-cycle-slides="> ul > li"'.
        'data-cycle-center-horz="true" data-cycle-center-vert="true">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="hidden">',
        'after_title' => '</h2>',
    ));
}
