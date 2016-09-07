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
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="main">
    <div class="row">
        <div id="content" class="col-md-8 col-xs-12">
<?php
if (is_home()) {
    get_template_part('template/welcome');
} elseif (is_singular('circle_event')) {
    get_template_part('template/event');
} elseif (is_singular()) {
    get_template_part('template/post');
} elseif (is_search()) {
    get_template_part('template/searchpage');
} elseif (is_page()) {
    get_template_part('template/general');
}
?>
        </div>
        <div class="col-md-4 col-xs-12">
            <ul class="nav nav-pills nav-stacked">
<?php
$q = new WP_Query(array ('post_type' => 'circle_aside'));
$i = 0;
while ($q->have_posts() && $i < 5) :
    $i++;
    $q->the_post();
?>
                <li role="presentation">
                    <a href="<?php the_permalink(); ?>">
                        <h5 class="text-uppercase"><?php the_title(); ?>
                            <span class="glyphicon glyphicon-play"></span>
                        </h5>
                        <small><?php the_excerpt(); ?></small>
                    </a>
                </li>
<?php endwhile; ?>
                <li>
<?php if (is_active_sidebar('newsletter')) : ?>
                    <?php dynamic_sidebar('newsletter'); ?>
<?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php get_footer(); ?>
