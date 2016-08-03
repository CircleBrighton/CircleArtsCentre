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
                <span class="navbar-brand">Circle</span>
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
                        <a href="https://twitter.com/circleartscentre" target="_blank">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.facebook.com/circleartscentre" target="_blank">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php if (is_active_sidebar('tweets')) : ?>
    <?php dynamic_sidebar('tweets'); ?>
<?php endif; ?>
</div>
