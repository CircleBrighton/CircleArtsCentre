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
<?php
echo apply_filters('the_content', get_post()->post_content);
?>
<?php $q = new WP_Query(array ('post_type' => 'circle_event')); ?>
<div class="list-group">
<?php while($q->have_posts()): $q->the_post(); $i = 1; ?>
    <a class="list-group-item" href="<?php the_permalink(); ?>">
        <h4 class="list-group-item-heading"><?php the_title(); ?></h4>
        <p class="list-group-item-text">
            <ul>
                <li>Performed Date: <?php echo get_post_meta(get_the_ID(), 'performed_date', true); ?></li>
            </ul>
        </p>
    </a>
<?php endwhile; ?>
</div>
