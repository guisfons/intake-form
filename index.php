<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
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
            if (have_posts() ) :
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    get_template_part('template-parts/content', get_post_type());
                endwhile;
            endif;
            ?>
        </div><!-- /.section__inner -->
    </div><!-- /.shell -->
</section><!-- /.section-default -->

<?php
get_footer();
