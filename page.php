<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header(); 
?>

<section class="section-default">
    <div class="shell">
        <div class="section__inner">
            <?php 
            while ( have_posts() ) : the_post(); 
                get_template_part('template-parts/content', 'page');
            endwhile; 
            ?>
        </div><!-- /.section__inner -->
    </div><!-- /.shell -->
</section><!-- /.section-default -->

<?php
get_footer();
