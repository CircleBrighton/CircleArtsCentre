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
<form action="<?php echo home_url('/') ?>" method="get" class="form-inline">
    <input type="text" name="s" class="form-control"
        value="<?php echo get_search_query() ?>" placeholder="Search...">
    <button type="submit" class="btn btn-default">
        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
    </button>
</form>
