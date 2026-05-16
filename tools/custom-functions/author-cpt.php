<?php
/**
 * Custom functions for Authors on Intake Form CPT
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

function post_types_author_archives($query) {
    if ($query->is_author)
        $query->set( 'post_type', array('intake-form', 'new-intake-form', 'posts') );
    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}
add_action('pre_get_posts', 'post_types_author_archives');