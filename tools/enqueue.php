<?php
/**
 * Enqueue assets
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
 * Enqueue scripts and styles.
 *
 * @return void
 */
function Enqueue_assets()
{
    $template_dir = get_template_directory_uri();
    $current_user = wp_get_current_user();
    $current_roles = ( array ) $current_user->roles;
    $current_user_rol = $current_roles[0];

    // Global Font Variables
    global $theme_styles_primary_font, $theme_styles_secondary_font;
    $primary_font = str_replace('+', ' ', $theme_styles_primary_font);
    $secondary_font = str_replace('+', ' ', $theme_styles_secondary_font);

    // Enqueue Custom CSS files
    wp_enqueue_style(
        'theme-css-primary-font', 
        'https://fonts.googleapis.com/css2?family='.$primary_font.
        ':ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;'.
        '1,300;1,400;1,500;1,600;1,700;1,800&display=swap', 
        array(),
        null
    );

    wp_enqueue_style(
        'theme-css-secondary-font', 
        'https://fonts.googleapis.com/css2?family='.$secondary_font.
        ':ital,wght@0,400;0,600;0,700;1,400;1,600;'.
        '1,700&display=swap" rel="stylesheet',
        array(),
        null
    );

    wp_enqueue_style(
        'theme-css-bundle', 
        $template_dir . Theme_Assets_bundle('css/bundle.css')
    );
    
    wp_enqueue_style('theme-styles', $template_dir . '/style.css');

    // Enqueue Custom JS files
    wp_enqueue_script(
        'theme-js-bundle',
        $template_dir . Theme_Assets_bundle('js/bundle.js'),
        array( 'jquery' ), // deps
        null, // version -- this is handled by the bundle manifest
        true // in footer
    );

    wp_localize_script(
        'theme-js-bundle', 'templateObj', array(
            'template_dir' => get_template_directory_uri(),
            'isNewIntakeFormPage' => is_page('intake-form') || is_page('new-intake-form'),
            'isIntakeFormSinglePage' => is_singular('intake-form') || is_singular('new-intake-form'),
            'intakeFormRestApiUrl' => (is_page('intake-form')) ? get_rest_url(null, '/wp/v2/new-intake-form') : get_rest_url(null, '/wp/v2/new-intake-form'),
            'isUserLoggedIn' => is_user_logged_in(),
            'loggedUserRole' => $current_user_rol,
            'ajax_url' => admin_url('admin-ajax.php')
        )
    );

    // Enqueue Comments JS file
    if (is_singular()) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'Enqueue_assets');
