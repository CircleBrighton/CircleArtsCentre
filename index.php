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
    get_template_part('welcome');
} elseif (is_singular('post') || is_singular('circle_aside')) {
    get_template_part('post');
} elseif (is_singular('circle_event')) {
    get_template_part('event');
} elseif (is_page(get_option('event_page_name', "What's On"))) {
    get_template_part('won');
} elseif (is_page()) {
    get_template_part('general');
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
            </ul>
            <form class="form-inline">
                <div class="form-group">
                    <input type="email" class="form-control" id="join-email" placeholder="Email Address">
                    <button type="submit" class="btn btn-primary"> Join</button>
                </div>
            </form>
        </div>
    </div>
</div>
<hr/>
<div>
    <div class="row">
<?php
$q = new WP_Query(array ('category_name' => 'Feature Left Box', 'post_type' => array('post', 'circle_event')));
if ($q->have_posts()) :
    $q->the_post();
?>
        <div class="col-md-3 col-xs-4">
            <div class="thumbnail text-justify">
                <div class="thumbnail bg-primary">
                <h3 class="fg-white text-center">
                    <?php echo get_theme_mod('feature_left_box_title', 'Coming Soon'); ?>
                </h3>
<?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url(); ?>"/>
<?php endif; ?>
                </div>
                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a></h4>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    Read More
                </a>
            </div>
        </div>
<?php endif; ?>
<?php
$q = new WP_Query(array ('category_name' => 'Feature Middle Box', 'post_type' => array('post', 'circle_event')));
if ($q->have_posts()) :
    $q->the_post();
?>
        <div class="col-md-3 col-md-offset-1 col-xs-4">
            <div class="thumbnail text-justify">
                <div class="thumbnail bg-primary">
                    <h3 class="fg-white text-center">
                        <?php echo get_theme_mod('feature_middle_box_title', 'This Week'); ?>
                    </h3>
<?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url(); ?>"/>
<?php endif; ?>
                </div>
                <p>
                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a></h4>
                </p>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    Read More
                </a>
            </div>
        </div>
<?php endif; ?>
<?php
$q = new WP_Query(array ('category_name' => 'Feature Right Box', 'post_type' => array('post', 'circle_event')));
if ($q->have_posts()) :
    $q->the_post();
?>
        <div class="col-md-3 col-md-offset-1 col-xs-4">
            <div class="thumbnail text-justify">
                <div class="thumbnail bg-primary">
                    <h3 class="fg-white text-center">
                        <?php echo get_theme_mod('feature_right_box_title', 'Featured'); ?>
                    </h3>
<?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url(); ?>"/>
<?php endif; ?>
                </div>
                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a></h4>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    Read More
                </a>
            </div>
        </div>
<?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
