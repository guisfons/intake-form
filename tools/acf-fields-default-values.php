<?php
/**
 * Acf Fields Default Values
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
  * Acf
  *
  * @return void
  */
function Acf_Global_vars()
{
    // Primary Color
    global $theme_styles_primary_color;
    $theme_styles_primary_color = get_field('theme_styles_primary_color', 'option'); 
    if ($theme_styles_primary_color === null) { 
        $theme_styles_primary_color = '#4F908A'; 
    }

    // Secondary Color
    global $theme_styles_secondary_color;
    $theme_styles_secondary_color = get_field(
        'theme_styles_secondary_color', 
        'option'
    ); 
    if ($theme_styles_secondary_color === null) { 
        $theme_styles_secondary_color = '#162D52';
    }

    // Third Color
    global $theme_styles_third_color;
    $theme_styles_third_color = get_field('theme_styles_third_color', 'option'); 
    if ($theme_styles_third_color === null) { 
        $theme_styles_third_color = '#FDAB76';
    }

    // Fourth Color
    global $theme_styles_fourth_color;
    $theme_styles_fourth_color = get_field('theme_styles_fourth_color', 'option'); 
    if ($theme_styles_fourth_color === null) { 
        $theme_styles_fourth_color = '#212B36';
    }

    // Fifth Color
    global $theme_styles_fifth_color;
    $theme_styles_fifth_color = get_field('theme_styles_fifth_color', 'option'); 
    if ($theme_styles_fifth_color === null) { 
        $theme_styles_fifth_color = '#637381';
    }

    // Sixth Color
    global $theme_styles_sixth_color;
    $theme_styles_sixth_color = get_field('theme_styles_sixth_color', 'option'); 
    if ($theme_styles_sixth_color === null) { 
        $theme_styles_sixth_color = '#919EAB';
    }

    // Body Background Primary Color
    global $theme_styles_body_bg_primary;
    $theme_styles_body_bg_primary = get_field(
        'theme_styles_body_bg_primary', 
        'option'
    ); 
    if ($theme_styles_body_bg_primary === null) { 
        $theme_styles_body_bg_primary = '#FBFBFB';
    }

    // Body Background Secondary Color
    global $theme_styles_body_bg_secondary;
    $theme_styles_body_bg_secondary = get_field(
        'theme_styles_body_bg_secondary', 
        'option'
    ); 
    if ($theme_styles_body_bg_secondary === null) { 
        $theme_styles_body_bg_secondary = '#F4F6F8';
    }

    // Primary Font
    global $theme_styles_primary_font;
    $theme_styles_primary_font = get_field(
        'theme_styles_primary_font', 
        'option'
    ); 
    if ($theme_styles_primary_font === null) { 
        $theme_styles_primary_font = 'Ubuntu';
    }

    // Secondary Font
    global $theme_styles_secondary_font;
    $theme_styles_secondary_font = get_field(
        'theme_styles_secondary_font', 
        'option'
    ); 
    if ($theme_styles_secondary_font === null) { 
        $theme_styles_secondary_font = 'Mukta';
    }

    // Breadcrumb Type
    global $header_settings_breadcrumb_type;
    $header_settings_breadcrumb_type = get_field(
        'header_settings_breadcrumb_type', 
        'option'
    ); 
    if ($header_settings_breadcrumb_type === null) { 
        $header_settings_breadcrumb_type = 'Simple Breadcrumb';
    }
    

}
add_action('template_redirect', 'Acf_Global_vars');
