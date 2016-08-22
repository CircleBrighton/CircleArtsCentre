<?php
/**
 * In The Name Of God
 *
 * PHP Version 5
 *
 * This file provides view for archive type pages.
 *
 * @category CircleTheme
 * @file archive.php
 * @package
 * @author   Parham Alvani <parham.alvani@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 *
 */
?>
<div class="col-md-9">
<?php while (have_posts()) :
    the_post();
    if (!has_category('Blog')) {
        continue;
    } ?>
        <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        <h4><small>Posted on <?php the_date() ?></small></h4>
        <?php the_content() ?>
<?php endwhile; ?>
</div>
<div class="col-md-3">
    Years
    <hr>
    <div class="list-group">
<?php
    $a = wp_get_archives(['type' => 'yearly', 'format' => 'custom', 'echo' => '0']);
    $a = str_replace('href', 'class="list-group-item" href', $a);
    echo $a;
?>
    </div>
    Categories
    <hr>
    <div class="list-group">
<?php
    $a = wp_list_categories(['separator' => "\n", 'style' => '', 'echo' => '0']);
    $a = str_replace('href', 'class="list-group-item" href', $a);
    echo $a;
?>
    </div>
</div>
