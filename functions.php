<?php
/**
 * Functions and definitions
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

// Constants
define('THEME_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);

if (! function_exists('Setup_theme')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @return void
     */
    function Setup_theme()
    {
        // Make this theme available for translation.
        load_theme_textdomain('theme-acf', get_template_directory() . '/languages');

        // Theme supports
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('menus');
        add_theme_support('html5', array( 'gallery' ));

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        // Register Theme Menu Locations
        register_nav_menus(
            array(
            'main-menu' => __('Main Menu', 'theme-acf'),
            ) 
        );

        add_action('widgets_init', 'Widgets_Init_load');
        add_filter('use_block_editor_for_post', '__return_false');
        add_filter('use_widgets_block_editor', '__return_false');
        add_filter('wpcf7_autop_or_not', '__return_false');

        // Add Filters
        add_filter('excerpt_more', 'Excerpt_More_load');
        add_filter('excerpt_length', 'Excerpt_Length_load', 999);
    }

    // Add image sizes
    //add_image_size( 'crb_full_width', 1980, 0, false );
    //add_image_size( 'crb_medium_to_large', 500, 0, false );
    //add_image_size( 'crb_hero_image', 1920, 800, true );
    //add_image_size( 'crb_badge', 150, 80, true );
}
add_action('after_setup_theme', 'Setup_theme');

/**
 * Register Sidebars
 *
 * @return void
 */
function Widgets_Init_load()
{
    $sidebar_options = array_merge(
        Get_Default_Sidebar_options(), array(
        'name' => __('Default Sidebar', 'theme-acf'),
        'id'   => 'default-sidebar',
        ) 
    );

    register_sidebar($sidebar_options);

    $services_sidebar_options = array_merge(
        Get_Default_Sidebar_options(), array(
        'name' => __('Services Sidebar', 'theme-acf'),
        'id'   => 'service-sidebar',
        ) 
    );

    register_sidebar($services_sidebar_options);
}

/**
 * Sidebar Options
 *
 * @return void
 */
function Get_Default_Sidebar_options()
{
    return array(
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="widget__title">',
    'after_title'   => '</h2>',
    );
}

// Attach Custom Post Types
require_once THEME_DIR . 'inc/post-types.php';

/* Extra functions  */
require_once THEME_DIR . 'inc/users-roles-redirection.php';
require_once THEME_DIR . 'inc/populate-cos-users-select-input.php';
require_once THEME_DIR . 'inc/services_repeater_field.php';
require_once THEME_DIR . 'inc/re-added-data.php';
require_once THEME_DIR . 'tools/acf-fields-default-values.php';
require_once THEME_DIR . 'tools/enqueue.php';
require_once THEME_DIR . 'tools/hook-header-footer-scripts.php';
require_once THEME_DIR . 'tools/hook-global-custom-styles.php';
require_once THEME_DIR . 'tools/walker-nav.php';
require_once THEME_DIR . 'tools/custom-functions/main.php';
require_once THEME_DIR . 'tools/acf-json-registration.php';
require_once THEME_DIR . 'tools/plugins-import.php';

// Additional libraries and includes
require_once THEME_DIR . 'tools/admin-login.php';
require_once THEME_DIR . 'tools/helpers.php';
require_once THEME_DIR . 'tools/google-fonts.php';
require_once THEME_DIR . 'inc/theme-options/options-page.php';

// Attach custom widgets
require_once THEME_DIR . 'tools/widgets.php';

// Attach custom shortcodes
require_once THEME_DIR . 'tools/shortcodes.php';

add_action('admin_init', 'allow_onboarding_specialist_uploads');
function allow_onboarding_specialist_uploads() {
    $onboarding_specialist = get_role('onboarding_specialist');
    $onboarding_specialist->add_cap('upload_files');
}