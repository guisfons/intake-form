<?php
/**
 * Main Menu Fragment
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

    wp_nav_menu(
        array(
            'theme_location'    => 'main-menu',
            'container'         => false,
            'depth'             => 3,
            'menu_class'        => 'nav-menu',
            'walker' => new Walker_Nav()
        )
    );
    ?>
