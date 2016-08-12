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
?>
<div class="page-header">
    <h1><?php echo apply_filters('the_title', get_post()->post_title); ?>
    <a class="btn pull-right
        <?php echo get_post_meta(get_post()->ID, 'status_disabled', true) ? 'disabled' : '' ?>"
        style="color: #FFF;
            background-color: <?php echo esc_attr(get_post_meta(get_post()->ID, 'status_color', true)) ?>"
        href="<?php echo esc_attr(get_post_meta(get_post()->ID, 'buy_link', true)) ?>">
            <?php echo get_post_meta(get_post()->ID, 'status_label', true); ?>
    </a>
    </h1>
    <h5><?php echo apply_filters('the_date', get_post()->post_date); ?></h5>
</div>
<table class="table table-bordered">
    <tr>
        <td>Date:</td>
        <td><?php echo get_post_meta(get_post()->ID, 'date', true); ?>
    </tr>
    <tr>
        <td>Time:</td>
        <td><?php echo get_post_meta(get_post()->ID, 'time', true); ?>
    </tr>
    <tr>
        <td>Price:</td>
        <td><?php echo get_post_meta(get_post()->ID, 'price', true); ?>
    </tr>
</table>
<?php
echo apply_filters('the_content', get_post()->post_content);
?>
