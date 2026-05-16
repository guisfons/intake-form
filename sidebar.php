<?php
/**
 * The template for displaying sidebar
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

if (! is_active_sidebar('default-sidebar') ) :
    return;
endif;

?>

<div class="sidebar">
    <ul class="widgets">
        <?php
        dynamic_sidebar('default-sidebar');
        ?>
    </ul><!-- /.widgets -->
</div><!-- /.sidebar -->
