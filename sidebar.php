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
            <div class="collapse navbar-collapse">
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
                            <img src="<?php bloginfo('template_url'); ?>/img/twitter-logo.jpg" width="28" height="28">
                        </a>
                    </li>
                    <li role="presentation" class="pull-right">
                        <a href="http://www.facebook.com/circleartscentre" target="_blank">
                            <img src="<?php bloginfo('template_url'); ?>/img/facebook-logo.jpg" width="28" height="28">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="well well-sm">
        Last Tweets
        <!-- Twitter -->
    </div>
</div>
