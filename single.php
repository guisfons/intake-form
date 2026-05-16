<?php 
/**
 * The template for displaying all single posts
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

while ( have_posts() ) :
    the_post();
    get_template_part('template-parts/content', get_post_type());
endwhile; // End of the loop.

get_footer();
