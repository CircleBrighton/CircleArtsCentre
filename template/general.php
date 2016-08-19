<?php
/**
 * In The Name Of God
 *
 * PHP Version 5
 *
 * This file provides a general view for page post type pages.
 *
 * @category CircleTheme
 * @file general.php
 * @package
 * @author   Parham Alvani <parham.alvani@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 *
 */
?>
<?php
echo apply_filters('the_content', get_post()->post_content);
