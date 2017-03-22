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
<?php the_post() ?>
<div class="page-header">
    <h1><?php the_title() ?>
    <br>
    <h5><?php the_date() ?></h5></h1>
</div>
<?php the_content() ?>
