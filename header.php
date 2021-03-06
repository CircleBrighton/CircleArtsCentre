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
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title>
        <?php echo get_bloginfo('name'); ?>
        <?php wp_title(); ?>
    </title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
</head>
<body>
<div class="container" style="padding-top: 40px">
    <header>
        <div class="row">
            <div class="col-md-4 col-xs-6 text-left">
                <a href="<?php echo home_url() ?>">
                    <img class="img-responsive"
                        src="<?php bloginfo('template_url'); ?>/img/circle-logo.png"
                        width="240" height="103" alt="Circle">
                </a>
            </div>
            <div class="col-md-offset-4 col-md-4 col-xs-6 text-right">
                <h5>BOX OFFICE: <?php echo get_theme_mod('address_box_office', true); ?></h5>
                <?php get_search_form() ?>
            </div>
        </div>
    </header>
