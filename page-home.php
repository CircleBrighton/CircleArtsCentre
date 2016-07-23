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
<div id="news-slides" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#news-slides" data-slide-to="0" class="active"></li>
        <li data-target="#news-slide" data-slide-to="1"></li>
        <li data-target="#news-slide" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="<?php bloginfo('template_url'); ?>/upload/slide-1.jpg" alt="slide-1" style="width: 100%;">
            <div class="carousel-caption">
                <h3><strong>Music / </strong></h3>
                <h6><a href="#">Harp Recital With Alexandra King &amp; Evening Meal</a></h6>
                <h6>Fri 22nd Jul</h6>
                <p>Enjoy a special evening of delicious food and wonderful music from harpist
                    Alexandra King. The evening will include a delicious ...</p>
                <p><a href="#">read more</a></p>
            </div>
        </div>
        <div class="item">
            <img src="<?php bloginfo('template_url'); ?>/upload/slide-2.jpg" alt="slide-2" style="width: 100%;">
            <div class="carousel-caption">
                <h3><strong>Music / </strong></h3>
                <h6><a href="#">Harp Recital With Alexandra King &amp; Evening Meal</a></h6>
                <h6>Fri 22nd Jul</h6>
                <p>Enjoy a special evening of delicious food and wonderful music from harpist
                    Alexandra King. The evening will include a delicious ...</p>
                <p><a href="#">read more</a></p>
            </div>
        </div>
        <div class="item">
            <img src="<?php bloginfo('template_url'); ?>/upload/slide-3.jpg" alt="slide-3" style="width: 100%">
            <div class="carousel-caption">
                <h3><strong>Music / </strong></h3>
                <h6><a href="#">Harp Recital With Alexandra King &amp; Evening Meal</a></h6>
                <h6>Fri 22nd Jul</h6>
                <p>Enjoy a special evening of delicious food and wonderful music from harpist
                    Alexandra King. The evening will include a delicious ...</p>
                <p><a href="#">read more</a></p>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#news-slides" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
</div>
