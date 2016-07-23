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
<head>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
</head>
<body>
    <header>
        <div class="row">
            <div class="col-md-4 col-xs-6 text-left">
                <a href="/"><img class="img-responsive" src="<?php bloginfo('template_url'); ?>/img/circle-logo.png" width="240" height="103" alt="Circle"></a>
            </div>
            <div class="col-md-offset-4 col-md-4 col-xs-6 text-right">
                <h5>BOX OFFICE: ...</h5>
                <form action="/" method="get" class="form-inline">
                    <input type="text" name="search" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </button>
                </form>
            </div>
        </div>
    </header>
