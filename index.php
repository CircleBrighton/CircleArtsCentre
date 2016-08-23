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
} elseif (is_singular('post') || is_singular('circle_aside')) {
    get_template_part('template/post');
} elseif (is_singular('circle_event')) {
    get_template_part('template/event');
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
<hr/>
<div>
    <div class="row">
<?php for ($i = 0; $i < (int)get_theme_mod('feature_box_number', '3'); $i++) : ?>
<?php
$q = new WP_Query(array ('category_name' => 'Feature Box '.$i, 'post_type' => array('post', 'circle_event')));
if ($q->have_posts()) :
    $q->the_post();
?>
<?php
switch (get_theme_mod('feature_box_number', '3')) {
    case '1':
        echo '<div class="col-md-3 col-md-offset-4">';
        break;
    case '2':
        echo '<div class="col-md-3 col-md-offset-2">';
        break;
    case '3':
        echo '<div class="col-md-3 col-md-offset-1 col-xs-4">';
        break;
    case '4':
        echo '<div class="col-md-3">';
        break;
}
?>
            <div class="thumbnail text-justify">
                <div class="thumbnail bg-primary">
                <h3 class="fg-white text-center">
                    <?php echo get_theme_mod('feature_box_'.$i.'_title', 'Title'); ?>
                </h3>
<?php
if (has_post_thumbnail()) {
    the_post_thumbnail();
}
?>
                </div>
                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a></h4>
                <?php wp_trim_words(the_excerpt(), 55); ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    Read More
                </a>
            </div>
        </div>
<?php endif; ?>
<?php endfor; ?>
</div>
<?php get_footer(); ?>
