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
<?php
$about = get_page_by_title('About');
$contact = get_page_by_title('Contact');
$visit = get_page_by_title('Visit');
?>
<div>
    <ul class="nav nav-pills">
        <li role="presentation" class="<?php echo is_home() ? 'active' : ''?>">
            <a href="<?php echo get_home_url(); ?>">Home</a>
        </li>

        <li role="presentation" class="<?php echo is_page('About') ? 'active' : ''?> <?php echo ! $about ? 'disabled' : '' ?>">
            <a href="<?php echo get_page_link($about->ID); ?>">About</a>
        </li>

        <li role="presentation"><a href="#">What's On</a></li>

        <li role="presentation" class="<?php echo is_page('Visit') ? 'active' : ''?> <?php echo ! $visit ? 'disabled' : '' ?>">
            <a href="<?php echo get_page_link($visit->ID); ?>">Visit</a>
        </li>

        <li role="presentation"><a href="#">Cafe</a></li>

        <li role="presentation"><a href="#">Box Office</a></li>

        <li role="presentation"><a href="#">Support Us</a></li>

        <li role="presentation"><a href="#">Film Club</a></li>

        <li role="presentation" class="<?php echo is_page('Contact') ? 'active' : ''?> <?php echo ! $contact ? 'disabled' : '' ?>">
            <a href="<?php echo get_page_link($contact->ID); ?>">Contact</a>
        </li>

        <li role="presentation" class="pull-right">
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
    <div class="well well-sm">
        Last Tweets
        <!-- Twitter -->
    </div>
</div>
