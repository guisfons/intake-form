<?php
/**
 * Custom functions for Contact Form 7 filters & actions
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
 * Enable shortcodes in Contact Form 7 editor
 *
 * @param string $form Form
 *
 * @return string shortcode
 */
function Delicious_Wpcf7_Form_elements( $form )
{
    $form = do_shortcode($form);
    return $form;
}
add_filter('wpcf7_form_elements', 'Delicious_Wpcf7_Form_elements');
