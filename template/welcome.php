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
    data-interval="<?php echo get_option('slide_interval', 5000) ?>"
    data-wrap=<?php echo get_option('slide_wrap', true) ? "true" : "false" ?>>
<?php $q = new WP_Query(['post_type' => 'circle_slide']);
    $i = 0; ?>
    <!-- Indicators -->
    <ol class="carousel-indicators">
<?php while ($q->have_posts()) :
    $q->the_post(); ?>
        <li class=<?php echo $i == 0 ? "active" : "" ?>
            data-target="#news-slides" data-slide-to="<?php echo $i++ ?>"></li>
<?php endwhile; ?>
    </ol>

<?php rewind_posts();
    $i = 0; ?>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
<?php while ($q->have_posts()) :
    $q->the_post(); ?>
        <div class="item <?php echo $i++ == 0 ? "active" : "" ?>"
            style="height: <?php echo get_option('slide_height', '') ?>;">
<?php
    the_post_thumbnail(
        'post-thumbnail',
        ['style' => 'height: '.get_option('slide_height', '').';']
    );
?>
            <div class="carousel-caption"
                    style="background-color: <?php echo esc_attr(get_post_meta($post->ID, 'bgcolor', true)); ?>">
                <h3><a class="deco-none" href="<?php the_permalink() ?>">
<?php
    echo circle_htmlp_trim_words(
        get_post_meta($post->ID, 'header', true),
        get_option('slide_header_char_limit', 10)
    );
?>
                </a></h3>
<?php
    echo circle_htmlp_trim_words(
        get_post_meta($post->ID, 'content', true),
        get_option('slide_content_char_limit', 120)
    );
?>
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
