<?php
/**
 * Requiring all custom functions
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

foreach( glob(
    THEME_DIR . 'tools/custom-functions/*.php' 
)
    as $custom_functions 
):
    @include_once $custom_functions;
endforeach;
