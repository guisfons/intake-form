<?php
/**
 * Hook global custom styles
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
  * Hook global custom styles
  *
  * @return void
  */
function Hook_Global_Custom_styles()
{
    $theme_options_custom_styles = get_field(
        'theme_options_custom_styles_editor', 
        'option'
    );

    echo '<style type="text/css">'.$theme_options_custom_styles.'</style>';
}
add_action('wp_head', 'Hook_Global_Custom_styles');
