<?php
/**
 * In The Name Of God
 *
 * PHP Version 5
 *
 * This file provides a view for single-event page.
 *
 * @category Theme
 * @package
 * @author   Parham Alvani <parham.alvani@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 *
 */
the_post();
$names = get_option('event_status_names', []);
$colors = get_option('event_status_colors', []);
$index = (int) get_post_meta($post->ID, 'status_index', true);
$name = "";
$color = "";
if (is_int($index) && $index >= 0) {
    $index--;
    $name = $names[$index];
    $color = $colors[$index];
}
?>
<div class="page-header">
    <h1><?php the_title(); ?>
    <span class="label"
        style="color: #FFF;
            background-color: <?php echo esc_attr($color); ?>">
            <?php echo $name; ?>
    </span>
    <a class="btn btn-default pull-right
        <?php echo get_post_meta($post->ID, 'status_disabled', true) ? 'disabled' : '' ?>"
        href="<?php echo esc_attr(get_post_meta($post->ID, 'buy_link', true)) ?>">
            Buy Ticket
    </a>
    </h1>
    <h5><?php the_date() ?></h5>
</div>
<table class="table table-bordered">
    <tr>
        <td>Date:</td>
        <td><?php
        $date = get_post_meta($post->ID, 'date', true);
        echo date(get_option('date_format'), strtotime($date))?>
        </td>
    </tr>
    <tr>
        <td>Time:</td>
        <td><?php echo get_post_meta($post->ID, 'time', true); ?></td>
    </tr>
    <tr>
        <td>Price:</td>
        <td><?php echo get_post_meta($post->ID, 'price', true); ?></td>
    </tr>
</table>
<?php the_content() ?>
