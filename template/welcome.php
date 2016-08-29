<?php
/**
 * In The Name Of God
 *
 * PHP Version 5
 *
 * This file provides a slideshow view for welcome page.
 *
 * @category CircleTheme
 * @file welcome.php
 * @package
 * @author   Parham Alvani <parham.alvani@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 *
 */
?>
<div id="news-slides" class="carousel slide" data-ride="carousel"
    data-interval="<?php echo get_theme_mod('slideshow_interval', 5000) ?>"
    data-wrap=<?php echo get_theme_mod('slideshow_wrap', true) ? "true" : "false" ?>>
<?php $q = new WP_Query(['post_type' => 'circle_slide']); ?>
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#news-slides" data-slide-to="0" class="active"></li>
<?php while ($q->have_posts()) :
    $q->the_post();
    $i = 1; ?>
        <li data-target="#news-slides" data-slide-to="<?php $i++ ?>"></li>
<?php endwhile; ?>
    </ol>

<? rewind_posts(); ?>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active" style="height: <?php echo get_theme_mod('slideshow_height', '') ?>;">
            <img src="<?php echo get_theme_mod('slideshow_initial', '%s/img/welcome.jpg') ?>"
                style="height: <?php echo get_theme_mod('slideshow_height', '') ?>;"
                alt="welcome">
        </div>
<?php while ($q->have_posts()) :
    $q->the_post(); ?>
        <div class="item" style="height: <?php echo get_theme_mod('slideshow_height', '') ?>;">
<?php
    the_post_thumbnail(
        'post-thumbnail',
        ['style' => 'height: '.get_theme_mod('slideshow_height', '').';']
    );
?>
            <div class="carousel-caption"
                    style="background-color: <?php echo esc_attr(get_post_meta($post->ID, 'bgcolor', true)); ?>">
                <h3><a class="deco-none" href="<?php the_permalink() ?>">
                    <?php echo get_post_meta($post->ID, 'header', true); ?>
                </a></h3>
                <?php echo get_post_meta($post->ID, 'content', true); ?>
            </div>
        </div>
<?php endwhile; ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#news-slides" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#news-slides" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
