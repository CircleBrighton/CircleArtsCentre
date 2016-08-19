<?php
/**
 * In The Name Of God
 *
 * PHP Version 5
 *
 * This file provides a view for single-post pages.
 *
 * @category CircleTheme
 * @file post.php
 * @package
 * @author   Parham Alvani <parham.alvani@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 *
 */
?>
<div class="page-header">
    <h1><?php echo apply_filters('the_title', get_post()->post_title); ?>
    <br>
    <h5><?php echo apply_filters('the_date', get_post()->post_date); ?></h5></h1>
</div>
<?php
echo apply_filters('the_content', get_post()->post_content);
?>
