<?php
/**
 * Template Name: Page Builder
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

if (have_rows('page_options') ) :
    while( have_rows('page_options') ): the_row();
        $section_fragment = str_replace('_', '-', get_row_layout());
        get_template_part('fragments/sections/section', $section_fragment);
    endwhile;

    edit_post_link(__('Edit this entry.', 'theme-acf'), '<p>', '</p>');
endif;

get_footer();
