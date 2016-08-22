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
<div class="list-group">
<?php while (have_posts()) :
    the_post();
    if (!has_category('Blog')) {
        continue;
    } ?>
        <a href="<?php the_permalink() ?>" class="list-group-item">
            <h4 class="list-group-item-heading"><?php the_title() ?></h4>
            <p class="list-group-item-text"><?php the_excerpt() ?></p>
        </a>
<?php endwhile; ?>
</div>
