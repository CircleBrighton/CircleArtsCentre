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
<div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#circle-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="circle-navbar-collapse">
<?php
wp_nav_menu(array(
    'theme_location' => 'top-menu',
    'container' => 'ul',
    'menu_class' => 'nav navbar-nav'
));
?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="http://thecirclebrighton.com">Circle</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(get_category_link(get_cat_ID('Blog'))); ?>">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/<?php echo get_theme_mod('address_twitter', 'circleartscentre'); ?>" target="_blank">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.facebook.com/<?php echo get_theme_mod('address_facebook', 'circleartscentre'); ?>" target="_blank">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php if (is_active_sidebar('tweets')) : ?>
    <div class="latest-tweets-container well well-sm">
        <?php dynamic_sidebar('tweets'); ?>
    </div>
<?php endif; ?>
</div>
