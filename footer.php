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
<hr/>
<div>
    <div class="row">
<?php for ($i = 0; $i < (int)get_theme_mod('feature_box_number', '3'); $i++) : ?>
<?php
$boxes = ['Left', 'Middle', 'Right'];
$q = new WP_Query(['category_name' => 'Feature '.$boxes[$i]. ' Box', 'post_type' => ['post', 'circle_event']]);
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
        if ($i == 0) {
            echo '<div class="col-md-3 col-xs-4">';
        } elseif ($i == 1) {
            echo '<div class="col-md-9 col-xs-8"><div class="col-md-4 col-md-offset-2 col-xs-6">';
        } elseif ($i == 2) {
            echo '<div class="col-md-4 col-md-offset-2 col-xs-6">';
        }
        break;
}
?>
        <div class="thumbnail text-justify">
            <div class="thumbnail bg-primary"
                style="background-color: <?php echo esc_attr(get_theme_mod('feature_box_'.$i.'_color', '')); ?>">
                <h3 class="fg-white text-center">
                    <?php echo get_theme_mod('feature_box_'.$i.'_title', 'Title'); ?>
                </h3>
<?php
if (has_post_thumbnail()) {
    the_post_thumbnail('post-thumbnail');
}
?>
                </div>
                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a></h4>
                <p>
                    <?php echo wp_trim_words(get_the_excerpt(), 20, ''); ?>
                </p>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    Read More
                </a>
            </div>
        </div>
<?php endif; ?>
<?php
if (get_theme_mod('feature_box_number', '3') == '3' && $i == 2) {
    echo '</div>';
}
?>
<?php endfor; ?>
</div>
<hr>
<footer>
    <?php echo apply_filters('circle_the_footer', get_option('footer_content')) ?>
</footer>
</div>
<script src="<?php bloginfo('template_url'); ?>/js/jquery-2.2.4.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.tablesorter.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.cycle2.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.cycle2.center.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>
<?php wp_footer(); ?>
</body>
</html>
