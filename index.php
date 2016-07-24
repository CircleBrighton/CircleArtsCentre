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
<div>
    <div class="row">
        <div class="col-md-8 col-xs-12">
<?php
if (is_home())
    get_template_part('welcome');
elseif (is_page('About'))
    get_template_part('about');
elseif (is_page('Contact'))
    get_template_part('contact');
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
<div>
    <div class="row">
<?php
$args = array('category_name' => 'Coming Soon');
$posts = get_posts($args);
$post = isset($posts[0]) ? $posts[0] : null;
if ($post) :
?>
        <div class="col-md-4 col-xs-6">
            <div class="thumbnail">
<?php if ( has_post_thumbnail() ) : ?>
    <img src="<?php the_post_thumbnail_url(); ?>"/>
<?php endif; ?>
                <h3>Coming soon</h3>
                <p>
                    <span class="text-danger"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php $post->post_title ?></a>
                    <?php the_content('', true); ?>
                </p>
                <p>
                    <a class="btn btn-primary" href="#">read more</a>
                </p>
            </div>
        </div>
<?php endif; ?>
<?php
$args = array('category_name' => 'This Week');
$posts = get_posts($args);
$post = isset($posts[0]) ? $posts[0] : null;
if ($post) :
?>
        <div class="col-md-4 col-xs-6">
            <div class="thumbnail">
<?php if ( has_post_thumbnail() ) : ?>
    <img src="<?php the_post_thumbnail_url(); ?>"/>
<?php endif; ?>
                <h3>This Week</h3>
                <p>
                    <span class="text-danger"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php $post->post_title ?></a>
                    <?php the_content('', true); ?>
                </p>
                <p>
                    <a class="btn btn-primary" href="#">read more</a>
                </p>
            </div>
        </div>
<?php endif; ?>
<?php
$args = array('category_name' => 'Featured');
$posts = get_posts($args);
$post = isset($posts[0]) ? $posts[0] : null;
if ($post) :
?>
        <div class="col-md-4 col-xs-6">
            <div class="thumbnail">
<?php if ( has_post_thumbnail() ) : ?>
    <img src="<?php the_post_thumbnail_url(); ?>"/>
<?php endif; ?>
                <h3>Featured</h3>
                <p>
                    <span class="text-danger"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php $post->post_title ?></a>
                    <?php the_content('', true); ?>
                </p>
                <p>
                    <a class="btn btn-primary" href="#">read more</a>
                </p>
            </div>
        </div>
<?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
