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
<div class="page-header">
    <h1><?php echo apply_filters('the_title', get_post()->post_title); echo " "; ?>
    <small><?php echo apply_filters('the_date', get_post()->post_date); ?></small></h1>
<?php if (has_post_thumbnail(get_post())) : ?>
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <img class="img-rounded img-responsive" src="<?php the_post_thumbnail_url(get_post()); ?>">
        </div>
    </div>
<?php endif; ?>
</div>
<article id="post-<?php echo get_post()->ID; ?>" <?php post_class(get_post()); ?>>
<?php
echo apply_filters('the_content', get_post()->post_content);
?>
</article>
