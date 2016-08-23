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
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="main">
    <div class="row">
        <div id="content" class="col-md-8 col-xs-12">
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
        <div class="col-md-4 col-xs-12">
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
    $a = wp_list_categories(
        ['separator' => "\n", 'style' => '', 'echo' => '0',
        'exclude' => [get_cat_ID('Slide'), get_cat_ID('Blog'), get_cat_ID('Feature Left Box'),
                        get_cat_ID('Feature Middle Box'), get_cat_ID('Feature Right Box')]]
    );
    $a = str_replace('href', 'class="list-group-item" href', $a);
    echo $a;
?>
        </div>
    </div>
</div>
<hr>
<div>
    <div class="row">
<?php for ($i = 0; $i < (int)get_theme_mod('feature_box_number', '3'); $i++) : ?>
<?php
$boxes = ['Left', 'Middle', 'Right'];
$q = new WP_Query(['category_name' => 'Feature '.$boxes[$i].' Box', 'post_type' => ['post', 'circle_event']]);
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
