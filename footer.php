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
<hr>
<footer>
   <address class="text-center">
        <?php echo get_option('footer_content') ?>
        <p>&copy; <?php bloginfo('description') ?></p>
    </address>
</footer>
</div>
<script src="<?php bloginfo('template_url'); ?>/js/jquery-2.2.4.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.tablesorter.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.cycle2.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.cycle2.center.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>
<?php wp_footer(); ?>
</body>
</html>
