<?php 
/**
 * Users Roles
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
 * Adding custom user roles
 *
 * @return void
 */
function Add_Custom_roles()
{
    add_role(
        'onboarding_specialist', 
        'Onboarding Specialist', 
        array( 
        'read' => true, 
        'level_0' => true,
        'upload_files' => true
        )
    );

    add_role(
        'viewer',
        'Viewer', 
        array( 
        'read' => true, 
        'level_0' => true 
        )
    );
}
add_action('init', 'Add_Custom_roles');

/**
 * Adding custom user roles
 *
 * @param string $url     Url
 * @param string $request Request
 * @param string $user    User
 *
 * @return $url URL
 */
function Login_redirect( $url, $request, $user )
{
    if ($user && is_object($user) && is_a($user, 'WP_User') ) {
        if ($user->has_cap('administrator')) {
            $url = home_url('/new-intake-form/');
        } elseif ($user->has_cap('onboarding_specialist')) {
            $url = home_url('/new-intake-form/');
        } else {
            $url = home_url('/intake-form/');
        }
    }
    return $url;
}
add_filter('login_redirect', 'Login_redirect', 10, 3);

/**
 * Remove Admin Bar
 *
 * @return void
 */
function Remove_Admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'Remove_Admin_bar');


/**
 * User Roles Redirect Restrictions
 *
 * @return void
 */
function User_Roles_Redirect_restrictions()
{
    $current_user = wp_get_current_user();
    $current_roles = ( array ) $current_user->roles;
    $current_user_rol = $current_roles[0];

    // Validate Non Logged In Users
    if (!is_user_logged_in() || (!is_user_logged_in() && is_front_page()) 
        || (!is_user_logged_in() && is_page('new-intake-form')) 
    ) {
        wp_redirect(wp_login_url());
        exit;
    }

    // Avoid Viewer users get to the New Intake Form Page
    if ((is_user_logged_in() 
        && $current_user_rol == 'viewer'
        && is_page('new-intake-form')) 
        || (is_user_logged_in() 
        && $current_user_rol == 'viewer' 
        && is_front_page())
    ) {
        wp_redirect(get_post_type_archive_link('intake-form'));
        exit;
    }


}
add_action('template_redirect', 'User_Roles_Redirect_restrictions');

 /**
  * Block wp-admin access for non-admins
  *
  * @return void
  */
function Block_Wp_Admin_Non_admins()
{
    $current_user = wp_get_current_user();
    $current_roles = ( array ) $current_user->roles;
    $current_user_rol = $current_roles[0];

    if (is_admin() 
        && ! current_user_can('administrator') 
        && $current_user_rol == 'viewer' 
    ) {
        wp_safe_redirect(get_post_type_archive_link('intake-form'));
        exit;
    }

    if (is_admin() 
        && ! current_user_can('administrator') 
        && $current_user_rol == 'onboarding_specialist' 
        && ( ! defined('DOING_AJAX') || ! DOING_AJAX )
    ) {
        wp_safe_redirect(get_permalink(get_page_by_path('new-intake-form')));
        exit;
    }
}
add_action('admin_init', 'Block_Wp_Admin_Non_admins');
