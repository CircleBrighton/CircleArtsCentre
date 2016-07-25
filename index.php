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
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="main">
    <div class="row">
        <div id="content" class="col-md-8 col-xs-12">
<?php
if (is_home())
    get_template_part('welcome');
elseif (is_single())
    get_template_part('post');
elseif (is_page('About'))
    get_template_part('about');
elseif (is_page('Contact'))
    get_template_part('contact');
elseif (is_page('Visit'))
    get_template_part('visit');
?>
        </div>
        <div class="col-md-4 col-xs-12">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="active">
                    <a href="#">
                        <h5 class="text-uppercase">Volunteering
                            <span class="glyphicon glyphicon-play"></span>
                        </h5>
                        <small>Get involved! You'll love it</small>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#">
                        <h5 class="text-uppercase">Workshops &amp; Classes
                            <span class="glyphicon glyphicon-play"></span>
                        </h5>
                        <small>Come along and learn</small>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#">
                        <h5 class="text-uppercase">Hire Circle
                            <span class="glyphicon glyphicon-play"></span>
                        </h5>
                        <small>Venue hire details</small>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#">
                        <h5 class="text-uppercase">Outreach
                            <span class="glyphicon glyphicon-play"></span>
                        </h5>
                        <small>Circle in the community</small>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#">
                        <h5 class="text-uppercase">Past events
                            <span class="glyphicon glyphicon-play"></span>
                        </h5>
                        <small>Who's performed at Circle</small>
                    </a>
                </li>
            </ul>
            <form class="form-inline">
                <div class="form-group">
                    <input type="email" class="form-control" id="join-email" placeholder="Email Address">
                    <button type="submit" class="btn btn-primary"> Join</button>
                </div>
            </form>
        </div>
    </div>
</div>
<hr/>
<div>
    <div class="row">
<?php
query_posts('category_name=Coming Soon');
if (have_posts()) : the_post();
?>
        <div class="col-md-3 col-xs-4">
            <div class="thumbnail text-justify">
                <div class="thumbnail bg-primary">
                    <h3 class="fg-white text-center">Comming Soon</h3>
<?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url(); ?>"/>
<?php endif; ?>
                </div>
                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a></h4>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    Read More
                </a>
            </div>
        </div>
<?php endif; ?>
<?php
query_posts('category_name=This Week');
if (have_posts()) : the_post();
?>
        <div class="col-md-3 col-md-offset-1 col-xs-4">
            <div class="thumbnail text-justify">
                <div class="thumbnail bg-primary">
                    <h3 class="fg-white text-center">This Week</h3>
<?php if ( has_post_thumbnail() ) : ?>
                    <img src="<?php the_post_thumbnail_url(); ?>"/>
<?php endif; ?>
                </div>
                <p>
                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a></h4>
                </p>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    Read More
                </a>
            </div>
        </div>
<?php endif; ?>
<?php
query_posts('category_name=Featured');
if (have_posts()) : the_post();
?>
        <div class="col-md-3 col-md-offset-1 col-xs-4">
            <div class="thumbnail text-justify">
                <div class="thumbnail bg-primary">
                    <h3 class="fg-white text-center">Featured</h3>
<?php if ( has_post_thumbnail() ) : ?>
                    <img src="<?php the_post_thumbnail_url(); ?>"/>
<?php endif; ?>
                </div>
                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a></h4>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    Read More
                </a>
            </div>
        </div>
<?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
