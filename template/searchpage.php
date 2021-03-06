<?php
/**
 * In The Name Of God
 *
 * PHP Version 5
 *
 * This file provides a view for search result page.
 *
 * @category CircleTheme
 * @file searchpage.php
 * @package
 * @author   Parham Alvani <parham.alvani@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 *
 */
?>
<?php
global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

if (strlen($query_string) > 0) {
    foreach ($query_args as $key => $string) {
        $query_split = explode("=", $string);
        $search_query[$query_split[0]] = urldecode($query_split[1]);
    }
}

$search = new WP_Query($search_query);
?>
<div class="list-group">
<?php while ($search->have_posts()) :
    $search->the_post(); ?>
        <a href="<?php the_permalink() ?>" class="list-group-item">
            <h4 class="list-group-item-heading"><?php the_title() ?></h4>
            <p class="list-group-item-text"><?php the_excerpt() ?></p>
        </a>
<?php endwhile; ?>
</div>
