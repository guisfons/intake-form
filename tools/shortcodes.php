<?php
/**
 * Registration of custom shortcodes
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
 * Returns current year
 *
 * @uses [year]
 *
 * @return string Current year
 */
function Shortcode_year()
{
    return current_time('Y');
}
add_shortcode('year', 'Shortcode_year');
