<?php
/**
 * Hook custom scripts to header & footer
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

 /**
  * Hook script into header
  *
  * @return void
  */
function Hook_Header_scripts()
{
    if(have_rows('theme_options_header_scripts', 'option') ) :
        while( have_rows('theme_options_header_scripts', 'option') ) : the_row();
            echo get_sub_field('script_content');
        endwhile;
    endif;
}
add_action('wp_head', 'Hook_Header_scripts');

 /**
  * Hook script into header
  *
  * @return void
  */
function Hook_Footer_scripts()
{
    if(have_rows('theme_options_footer_scripts', 'option') ) :
        while( have_rows('theme_options_footer_scripts', 'option') ) : the_row();
            echo get_sub_field('script_content');
        endwhile;
    endif;
}
add_action('wp_footer', 'Hook_Footer_scripts');
