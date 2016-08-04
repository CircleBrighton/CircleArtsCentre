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
<div class="list-group">
<?php while (have_posts()) :
    the_post(); ?>
        <a href="<?php the_permalink() ?>" class="list-group-item">
            <h4 class="list-group-item-heading"><?php the_title() ?></h4>
            <p class="list-group-item-text"><?php the_excerpt() ?></p>
        </a>
<?php endwhile; ?>
</div>
<hr>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingArchiveMonth">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#archiveMonth"
                    aria-expanded="falase" aria-controls="archiveMonth">
                    Archives by Month
                </a>
            </h4>
        </div>
        <div id="archiveMonth" class="panel-collapse collapse in" role="tabpanel"
            aria-labelledby="headingArchiveMonth">
            <div class="panel-body">
                <ul>
                    <?php wp_get_archives('type=monthly'); ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingArchiveCategory">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#archiveCategory"
                    aria-expanded="false" aria-controls="archiveCategory">
                    Archives by Category
                </a>
            </h4>
        </div>
        <div id="archiveCategory" class="panel-collapse collapse in" role="tabpanel"
            aria-labelledby="headingArchiveCategory">
            <div class="panel-body">
                <ul>
                    <?php wp_list_categories(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
