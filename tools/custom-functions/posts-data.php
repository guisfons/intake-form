<?php
/**
 * Custom Post Data functions
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
 * Adding elipsis to excerpt content
 *
 * @return string Elipsis returned
 */
function Excerpt_More_load()
{
    return '...';
}

/**
 * Specifying length of excerpt 
 *
 * @return int Length desired
 */
function Excerpt_Length_load()
{
    return 16;
}
