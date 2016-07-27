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
<?php $q = new WP_Query(array ('post_type' => 'circle_event')); $i = 0; ?>
<table class="table table-stripedi table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Name</th>
            <th>Price</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
<?php while($q->have_posts()): $q->the_post(); $i++; ?>
        <tr data-href="<?php the_permalink(); ?>">
            <td><?php echo $i ?></td>
            <td><?php echo get_post_meta(get_the_ID(), 'performed_date', true); ?>
            <td><?php the_title(); ?></td>
            <td><?php echo get_post_meta(get_the_ID(), 'performed_time', true); ?>
            <td><?php echo get_post_meta(get_the_ID(), 'price', true); ?>
        </tr>
<?php endwhile; ?>
    </tbody>
</table>
