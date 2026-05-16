<?php
/**
 * Option pages
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

if (function_exists('acf_add_options_page') ) {
        
    acf_add_options_page(
        array(
        'page_title' => 'Theme Options',
        'menu_title' => 'Theme Options',
        'menu_slug' => 'theme-options',
        'capability' => 'edit_posts',
        'parent_slug' => '',
        'position' => false,
        'icon_url' => false,
        'redirect' => false,
        )
    );

    acf_add_options_sub_page(
        array(
        'page_title' => 'Theme Styles',
        'menu_title' => 'Theme Styles',
        'menu_slug' => 'theme-styles',
        'capability' => 'edit_posts',
        'parent_slug' => 'theme-options',
        'icon_url' => false,
        'redirect' => false,
        )
    );

    acf_add_options_sub_page(
        array(
        'page_title' => 'General',
        'menu_title' => 'General',
        'menu_slug' => 'general-settings',
        'capability' => 'edit_posts',
        'parent_slug' => 'theme-options',
        'icon_url' => false,
        'redirect' => false,
        )
    );
}
