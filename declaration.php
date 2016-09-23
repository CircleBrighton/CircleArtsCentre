<?php
/**
 * In The Name Of God
 *
 * PHP Version 5
 *
 * This file provides function declarations that are needed in
 * functions.php
 *
 * @category CircleTheme
 * @file declaration.php
 * @package
 * @author   Parham Alvani <parham.alvani@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 *
 */
/**
 * Filter the except length to 200 words.
 *
 * @param int $length Excerpt length.
 * @return int|null modified excerpt length.
 */
function circle_excerpt_length($length)
{
    return 200;
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
            'supports' => array('title', 'editor', 'thumbnail'),
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

    register_post_type(
        'circle_slide',
        array(
            'labels' => array(
                'name' => __('Slides'),
                'singular_name' => __('Slide')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'slides'),
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
}

/**
 * Registers circle specific meta data box for event and slide post types.
 */
function circle_register_meta()
{
    add_meta_box('event-info', __('Event Info', 'textdomain'), 'circle_display_event_meta', 'circle_event');
    add_meta_box('slide-content', __('Slide Content', 'textdomain'), 'circle_display_slide_meta', 'circle_slide');
}

/**
 * Hanldes circle specific meta data for event post type saving process.
 *
 * @link https://codex.wordpress.org/Class_Reference/WP_Post Documentation of WP_Post
 * @param int $post_id Target event [post] id for saving circle specific meta data
 * @param WP_Post $post Target event [post] object for saving cricle specific meta data
 */
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

    $wpdocs_save_meta($post_id, $post, 'date', 'circle-event-date');
    $wpdocs_save_meta($post_id, $post, 'time', 'circle-event-time');
    $wpdocs_save_meta($post_id, $post, 'price', 'circle-event-price');
    $wpdocs_save_meta($post_id, $post, 'buy_link', 'circle-event-buy-link');
    $wpdocs_save_meta($post_id, $post, 'status_index', 'circle-event-status-index');
    $wpdocs_save_meta($post_id, $post, 'status_disabled', 'circle-event-status-disabled');
}

/**
 * Cicle speficic meta data box display callback for event post type.
 *
 * @link https://codex.wordpress.org/Class_Reference/WP_Post Documentation of WP_Post
 * @param WP_Post $post Current post object.
 */
function circle_display_event_meta($post)
{
    wp_nonce_field(basename(__FILE__), 'circle_event_nonce');
?>
<h4>Timing</h4>
<div>
    <label for="circle-event-date">Date: </label>
    <input type="date" name="circle-event-date" id="circle-event-date"
        value="<?php echo esc_attr(get_post_meta($post->ID, 'date', true)); ?>"/>
</div>
<div>
    <label for="circle-event-time">Time: </label>
    <input type="time" name="circle-event-time" id="circle-event-time"
        value="<?php echo esc_attr(get_post_meta($post->ID, 'time', true)); ?>"/>
</div>
<hr>
<h4>Finance</h4>
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
<hr>
<h4>Status</h4>
<div>
    <label for="circle-event-status-index">Status: </label>
    <select name="circle-event-status-index" id="circle-event-status-index">
<?php
$names = get_option('event_status_names', []);
for ($i = 0; $i < sizeof($names); $i++) :
?>
        <option value=<?php echo $i + 1 ?> <?php selected(get_post_meta($post->ID, 'status_index', true) - 1, $i); ?>>
            <?php echo $names[$i] ?>
        </option>
<?php endfor; ?>
    </select>
</div>
<div>
    <label for="circle-event-status-disabled">Disabled: </label>
    <input type="checkbox" name="circle-event-status-disabled" id="circle-event-status-disabled"
        <?php echo get_post_meta($post->ID, 'status_disabled', true) ? 'checked' : '' ?>
        value="1"/>
</div>

<?php
}

/**
 * Hanldes circle specific meta data for slide post type saving process.
 *
 * @link https://codex.wordpress.org/Class_Reference/WP_Post Documentation of WP_Post
 * @param int $post_id Target event [post] id for saving circle specific meta data
 * @param WP_Post $post Target event [post] object for saving cricle specific meta data
 */
function circle_save_slide_meta($post_id, $post)
{
    /* Verify the nonce before proceeding. */
    if (!isset($_POST['circle_slide_nonce']) || !wp_verify_nonce($_POST['circle_slide_nonce'], basename(__FILE__))) {
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

    $wpdocs_save_meta($post_id, $post, 'header', 'circle-slide-header');
    $wpdocs_save_meta($post_id, $post, 'content', 'circle-slide-content');
    $wpdocs_save_meta($post_id, $post, 'bgcolor', 'circle-slide-bgcolor');
}

/**
 * Cicle speficic meta data box display callback for slide post type.
 *
 * @link https://codex.wordpress.org/Class_Reference/WP_Post Documentation of WP_Post
 * @param WP_Post $post Current post object.
 */
function circle_display_slide_meta($post)
{
    wp_nonce_field(basename(__FILE__), 'circle_slide_nonce');
?>
<div>
<?php
    $content = get_post_meta($post->ID, 'header', true);
    wp_editor($content, 'circle-slide-header', ['media_buttons' => false,
        'textarea_name' => 'circle-slide-header',
        'textarea_rows' => 1
    ]);
?>
</div>
<div>
    <label for="circle-slide-bgcolor">Background Color: </label>
    <input type="color" name="circle-slide-bgcolor" id="circle-slide-bgcolor"
        value="<?php echo esc_attr(get_post_meta($post->ID, 'bgcolor', true)); ?>"/>
</div>
<div>
<?php
    $content = get_post_meta($post->ID, 'content', true);
    wp_editor($content, 'circle-slide-content', ['media_buttons' => false, 'textarea_name' => 'circle-slide-content']);
?>
</div>
<?php
}


/**
 * Register circle theme menus. circle theme provides
 * a menu which names Top Menu.
 */
function circle_register_menu()
{
    register_nav_menu('top-menu', __('Top Menu'));
}

/**
 * Theme customization callback that provides theme specific
 * settings for slideshow, aside menu and your art center
 * address.
 *
 * @link https://codex.wordpress.org/Class_Reference/WP_Customize Documentation of WP_Customize
 * @param WP_Customize $wp_customize Customization object.
 */
function circle_customize_register($wp_customize)
{
    /* Address */
    $wp_customize->add_section('address', array(
        'title'      => __('Address', 'circle'),
        'priority'   => 30,
    ));
    $wp_customize->add_setting('address_box_office', array(
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'address_box_office_c', array(
        'label'      => __('Box Office', 'circle'),
        'section'    => 'address',
        'settings'   => 'address_box_office',
    )));
    $wp_customize->add_setting('address_lines', array(
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'address_lines_c', array(
        'label'      => __('Address', 'circle'),
        'type'       => 'textarea',
        'section'    => 'address',
        'settings'   => 'address_lines',
    )));
    $wp_customize->add_setting('address_charity_no', array(
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'address_charity_no_c', array(
        'label'      => __('Charity No', 'circle'),
        'section'    => 'address',
        'settings'   => 'address_charity_no',
    )));
    $wp_customize->add_setting('address_facebook', array(
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'address_facebook_c', array(
        'label'      => __('Facebook', 'circle'),
        'section'    => 'address',
        'settings'   => 'address_facebook',
    )));
    $wp_customize->add_setting('address_twitter', array(
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'address_twitter_c', array(
        'label'      => __('Twitter', 'circle'),
        'section'    => 'address',
        'settings'   => 'address_twitter',
    )));


    /* Feature Boxes */
    $wp_customize->add_section('feature_boxes', array(
        'title'      => __('Feature Boxes', 'circle'),
        'priority'   => 30,
    ));
    $wp_customize->add_setting('feature_box_0_title', array(
        'default'     => 'Coming Soon',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'feature_box_0_title_c', array(
        'label'        => __('Feature Box Left Title', 'circle'),
        'section'    => 'feature_boxes',
        'settings'   => 'feature_box_0_title',
    )));
    $wp_customize->add_setting('feature_box_0_color', array(
        'default'     => '#008080',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'feature_box_0_color_c', array(
        'label'        => __('Feature Box Left Color', 'circle'),
        'section'    => 'feature_boxes',
        'settings'   => 'feature_box_0_color',
    )));
    $wp_customize->add_setting('feature_box_1_title', array(
        'default'     => 'This Week',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'feature_box_1_title_c', array(
        'label'        => __('Feature Box Middle Title', 'circle'),
        'section'    => 'feature_boxes',
        'settings'   => 'feature_box_1_title',
    )));
    $wp_customize->add_setting('feature_box_1_color', array(
        'default'     => '#008080',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'feature_box_1_color_c', array(
        'label'        => __('Feature Box Middle Color', 'circle'),
        'section'    => 'feature_boxes',
        'settings'   => 'feature_box_1_color',
    )));

    $wp_customize->add_setting('feature_box_2_title', array(
        'default'     => 'Featured',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'feature_box_2_title_c', array(
        'label'        => __('Feature Box Right Title', 'circle'),
        'section'    => 'feature_boxes',
        'settings'   => 'feature_box_2_title',
    )));
    $wp_customize->add_setting('feature_box_2_color', array(
        'default'     => '#008080',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'feature_box_2_color_c', array(
        'label'        => __('Feature Box Right Color', 'circle'),
        'section'    => 'feature_boxes',
        'settings'   => 'feature_box_2_color',
    )));
    $wp_customize->add_setting('feature_box_number', array(
        'default'     => '3',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'feature_box_number_c', array(
        'label'      => __('Feature Box Number', 'circle'),
        'type'       => 'select',
        'section'    => 'feature_boxes',
        'settings'   => 'feature_box_number',
        'choices'    => ['1' => '1', '2' => '2', '3' => '3'],
    )));
}


/**
 * Enqueue a script in the WordPress admin
 *
 * @param string $hook Hook suffix for the current admin page.
 */
function circle_enqueue_admin_script($hook)
{
    wp_enqueue_script('polyfiller', get_template_directory_uri().'/js/webshim/polyfiller.js');
    wp_enqueue_script('vue', get_template_directory_uri().'/js/vue.min.js');
    wp_enqueue_script('admin', get_template_directory_uri().'/js/admin.js');
}

/**
 * Handles events shortcode. Events shortcode provides
 * a signle and easy to use way for showing your events
 * time table.
 *
 * @param array $attrs attributes are passed into shortcode.
 * @return string events time table in HTML.
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
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php while ($q->have_posts() && $i < $n) :
    $q->the_post();
    $i++;
    $names = get_option('event_status_names', []);
    $colors = get_option('event_status_colors', []);
    $index = (int) get_post_meta(get_post()->ID, 'status_index', true);
    if (is_int($index) && $index >= 0) {
        $index--;
        $name = $names[$index];
        $color = $colors[$index];
    }
?>
        <tr data-url="<?php the_permalink(); ?>">
            <td><?php echo $i ?></td>
            <td><?php echo get_post_meta(get_the_ID(), 'date', true); ?></td>
            <td><?php the_title(); ?></td>
            <td><?php echo get_post_meta(get_the_ID(), 'time', true); ?></td>
            <td><?php echo get_post_meta(get_the_ID(), 'price', true); ?></td>
            <td><h4 style="margin-top: 0px"><span
                class="label"
                style="color: #FFF;
                        background-color: <?php echo esc_attr($color); ?>">
                <?php echo $name; ?>
            </span></h4></td>
            <td><a class="btn btn-default
                    <?php echo get_post_meta(get_post()->ID, 'status_disabled', true) ? 'disabled' : '' ?>"
                    href="<?php echo esc_attr(get_post_meta(get_post()->ID, 'buy_link', true)) ?>">
                        Buy Ticket
            </a></td>
        </tr>
<?php endwhile; ?>
    </tbody>
</table>
<?php
return ob_get_clean();
}

/**
 * Registers circle theme sidebars and widgetized areas.
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

    register_sidebar(array(
        'name' => 'Newsletter',
        'id' => 'newsletter',
        'before_widget' => '<a>',
        'after_widget' => '</a>',
        'before_title' => '<h5 class="text-uppercase">',
        'after_title' => '</h5>',
    ));
}

/**
 * Registers circle footer settings menu
 */
function circle_register_footer_settings_menu()
{
    add_menu_page(
        'Footer',
        'Footer',
        'manage_options',
        'circle_footer_settings',
        'circle_footer_settings_menu_display'
    );
    register_setting('circle_footer_settings', 'footer_content');
}

/**
 * Circle footer settings menu display callback
 */
function circle_footer_settings_menu_display()
{
?>
<div class="wrap">
    <h1>Footer :)</h1>
    <form method="post" action="options.php">
        <?php
                settings_fields("circle_footer_settings");
                do_settings_sections("circle_footer_settings");
                $content = get_option('footer_content');
                wp_editor($content, 'footer_content', ['media_buttons' => true, 'textarea_name' => 'footer_content']);
                submit_button();
            ?>
    </form>
</div>
<?php
}

/**
 * Registers circle event settings submenu.
 */
function circle_register_event_settings_submenu()
{
    add_submenu_page(
        'edit.php?post_type=circle_event',
        'Event Settings',
        'Settings',
        'edit_posts',
        'circle_event_settings',
        'circle_event_settings_submenu_display'
    );

    register_setting('circle_event_settings', 'event_status_names');
    register_setting('circle_event_settings', 'event_status_colors');
}

/**
 * Circle event settings submenu display callback.
 */
function circle_event_settings_submenu_display()
{
?>
<div class="wrap">
    <h1>Event Settings</h1>
    <form method="post" action="options.php">
<?php
settings_fields('circle_event_settings');
do_settings_sections('circle_event_settings');
$names = get_option('event_status_names', []);
$colors = get_option('event_status_colors', []);
for ($i = 0; $i < sizeof($names); $i++) :
?>
        <div>
        <label for="event_status_names">Events Status <?php echo $i + 1 ?>: </label>
            <input type="text" name="event_status_names[]" id="event_status_names"
                value="<?php echo $names[$i] ?>"/>
            <input type="color" name="event_status_colors[]" id="event_status_colors"
                value="<?php echo $colors[$i] ?>"/>
        </div>
<?php
endfor;
?>
        <div id="event-status-div">
            <template v-for="i in n">
                <div>
                    <label for="event_status_name">New Events Status {{i + 1}}: </label>
                    <input type="text" name="event_status_names[]" id="event_status_name"
                        placeholder="New Status Name :)"/>
                    <input type="color" name="event_status_colors[]" id="event_status_colors"/>
                </div>
            </template>
            <button type="button" v-on:click="addEventStatus">+</button>
            <button type="button" v-on:click="removeEventStatus">-</button>
        </div>

        <?php submit_button(); ?>
  </form>
</div>
<script>
new Vue({
  el: '#event-status-div',
  data: {
    n: 0
  },
  methods: {
    addEventStatus: function () {
       this.n++
    },
    removeEventStatus: function () {
      if (this.n > 0) {
        this.n--
      }
    }
  }
})
</script>
<?php
}

/**
 * Registers circle slide settings submenu.
 */
function circle_register_slide_settings_submenu()
{
    add_submenu_page(
        'edit.php?post_type=circle_slide',
        'Slide Settings',
        'Settings',
        'edit_posts',
        'circle_slide_settings',
        'circle_slide_settings_submenu_display'
    );

    register_setting('circle_slide_settings', 'slide_header_char_limit');
    register_setting('circle_slide_settings', 'slide_content_char_limit');
    register_setting('circle_slide_settings', 'slide_interval');
    register_setting('circle_slide_settings', 'slide_wrap');
    register_setting('circle_slide_settings', 'slide_height');
}

/**
 * Registers circle specific sizes
 */
function circle_new_sizes($sizes)
{
    return array_merge($sizes, [
        'circle_slide' => __('Circle Slide'),
        'circle_featured_image' => __('Circle Featured Image')
    ]);
}

/**
 * Circle event settings submenu display callback.
 */
function circle_slide_settings_submenu_display()
{
?>
<div class="wrap">
    <h1>Slide Settings</h1>
    <form method="post" action="options.php">
<?php
settings_fields('circle_slide_settings');
do_settings_sections('circle_slide_settings');
?>
        <div>
            <label for="slide_header_char_limit">Slide Header Character Limit </label>
            <input type="text" name="slide_header_char_limit" id="slide_header_char_limit"
                value="<?php echo get_option("slide_header_char_limit", 10) ?>"/>
        </div>
        <div>
            <label for="slide_content_char_limit">Slide Content Character Limit </label>
            <input type="text" name="slide_content_char_limit" id="slide_content_char_limit"
                value="<?php echo get_option("slide_content_char_limit", 120) ?>"/>
        </div>
        <div>
            <label for="slide_interval">Slideshow Interval </label>
            <input type="text" name="slide_interval" id="slide_interval"
                value="<?php echo get_option("slide_interval", 5000) ?>"/>
        </div>
        <div>
            <label for="slide_wrap">Slideshow Wrap </label>
            <input type="checkbox" name="slide_wrap" id="slide_wrap"
                <?php echo get_option("slide_wrap", true) ? 'checked' : '' ?>/>
        </div>
        <div>
            <label for="slide_height">Slideshow Height </label>
            <input type="text" name="slide_height" id="slide_height"
                value="<?php echo get_option('slide_height', '450px') ?>"/>
        </div>
        <?php submit_button(); ?>
  </form>
</div>
<?php
}
