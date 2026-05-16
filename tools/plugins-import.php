<?php 
/**
 * Plugins Import Function
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

require_once get_template_directory() . '/tools/class-tgm-plugin-activation.php';

/**
 * Registering Required Plugins
 *
 * @return void
 */
function Theme_Register_Required_plugins()
{
    /*
    * Array of plugin arrays. Required keys are name and slug.
    * If the source is NOT from the .org repo, then source is also required.
    */
    $plugins = array(
    array(
    'name'               => 'Advanced Custom Fields PRO', // The plugin name.
    'slug'               => 'acf', // The plugin slug (typically the folder name).
    'source'             => get_template_directory() . 
    '/inc/plugins/advanced-custom-fields-pro.zip', // The plugin source.
    // If false, the plugin is only 'recommended' instead of required.
    'required'           => true,
    // E.g. 1.0.0. If set, the active plugin must be this version or higher. 
    // If the plugin version is higher than the plugin version installed, 
    // the user will be notified to update the plugin.
    'version'            => '6.0.7',
    // If true, plugin is activated upon theme activation 
    // and cannot be deactivated until theme switch.
    'force_activation'   => true,
    // If true, plugin is deactivated upon theme switch, 
    // useful for theme-specific plugins.
    'force_deactivation' => false, 
    // If set, overrides default API URL and points to an external URL.
    'external_url'       => '',
    // If set, this callable will be be checked 
    // for availability to determine if a plugin is active.
    'is_callable'        => '',
    ),
    array(
    'name'               => 'Advanced Custom Fields: Font Awesome Field',
    'slug'               => 'acf-font-awesome',
    'source'             => get_template_directory() . 
    '/inc/plugins/advanced-custom-fields-font-awesome.zip',
    'required'           => true,
    'version'            => '4.0.4',
    'force_activation'   => true,
    'force_deactivation' => false, 
    'external_url'       => '',
    'is_callable'        => '',
    ),
    array(
    'name'               => 'Advanced Custom Fields: Extended',
    'slug'               => 'acf-extended',
    'source'             => get_template_directory() . 
    '/inc/plugins/acf-extended.zip',
    'required'           => true,
    'version'            => '0.8.9.2',
    'force_activation'   => true,
    'force_deactivation' => false, 
    'external_url'       => '',
    'is_callable'        => '',
    ),
    array(
        'name'               => 'Extended Post Status',
        'slug'               => 'extended-post-status',
        'source'             => get_template_directory() . 
        '/inc/plugins/extended-post-status.zip',
        'required'           => true,
        'version'            => '1.0.20',
        'force_activation'   => true,
        'force_deactivation' => false, 
        'external_url'       => '',
        'is_callable'        => '',
    ),
        // This is an example of how to include 
    // a plugin from the WordPress Plugin Repository.
    );
    /*
    * Array of configuration settings. Amend each line as needed.
    *
    * TGMPA will start providing localized text strings soon. 
    * If you already have translations of our standard
    * strings available, please help us make 
    * TGMPA even better by giving us access to these translations or by
    * sending in a pull-request with .po file(s) with the translations.
    *
    * Only uncomment the strings in the config array 
    * if you want to customize the strings.
    */
    $config = array(
    // Unique ID for hashing notices for multiple instances of TGMPA.
    'id'           => 'theme-acf',
    // Default absolute path to bundled plugins.
    'default_path' => '',                      
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    // Capability needed to view plugin install page, 
    // should be a capability associated with the parent menu used.
    'capability'   => 'edit_theme_options',    
    'has_notices'  => true,                    // Show admin notices or not.
    // If false, a user cannot dismiss the nag message.
    'dismissable'  => true,                    
    // If 'dismissable' is false, this message will be output at top of nag.
    'dismiss_msg'  => '',                      
    // Automatically activate plugins after installation or not.
    'is_automatic' => true,                   
    // Message to output right before the plugins table.
    'message'      => 'Required plugins for current theme',                      
    'strings'      => array(
    'page_title'                      => __('Install Required Plugins', 'theme-acf'),
    'menu_title'                      => __('Install Plugins', 'theme-acf'),
    /* translators: %s: plugin name. */
    'installing'                      => __('Installing Plugin: %s', 'theme-acf'),
    /* translators: %s: plugin name. */
    'updating'                        => __('Updating Plugin: %s', 'theme-acf'),
    'oops'                            => __(
        'Something went wrong with the plugin API.', 
        'theme-acf'
    ),
    'notice_can_install_required'     => _n_noop(
                /* translators: 1: plugin name(s). */
        'This theme requires the following plugin: %1$s.',
        'This theme requires the following plugins: %1$s.',
        'theme-acf'
    ),
    'notice_can_install_recommended'  => _n_noop(
                /* translators: 1: plugin name(s). */
        'This theme recommends the following plugin: %1$s.',
        'This theme recommends the following plugins: %1$s.',
        'theme-acf'
    ),
    'notice_ask_to_update'            => _n_noop(
                /* translators: 1: plugin name(s). */
        'The following plugin needs to be updated to'. 
        'its latest version to ensure maximum compatibility with this theme: %1$s.',
        'The following plugins need to be updated to their latest version'.
        'to ensure maximum compatibility with this theme: %1$s.',
        'theme-acf'
    ),
    'notice_ask_to_update_maybe'      => _n_noop(
                /* translators: 1: plugin name(s). */
        'There is an update available for: %1$s.',
        'There are updates available for the following plugins: %1$s.',
        'theme-acf'
    ),
    'notice_can_activate_required'    => _n_noop(
                /* translators: 1: plugin name(s). */
        'The following required plugin is currently inactive: %1$s.',
        'The following required plugins are currently inactive: %1$s.',
        'theme-acf'
    ),
    'notice_can_activate_recommended' => _n_noop(
                /* translators: 1: plugin name(s). */
        'The following recommended plugin is currently inactive: %1$s.',
        'The following recommended plugins are currently inactive: %1$s.',
        'theme-acf'
    ),
    'install_link'                    => _n_noop(
        'Begin installing plugin',
        'Begin installing plugins',
        'theme-acf'
    ),
    'update_link'                       => _n_noop(
        'Begin updating plugin',
        'Begin updating plugins',
        'theme-acf'
    ),
    'activate_link'                   => _n_noop(
        'Begin activating plugin',
        'Begin activating plugins',
        'theme-acf'
    ),
    'return'                          => __(
        'Return to Required Plugins Installer', 
        'theme-acf'
    ),
    'plugin_activated'                => __(
        'Plugin activated successfully.', 
        'theme-acf'
    ),
    'activated_successfully'          => __(
        'The following plugin was activated successfully:', 
        'theme-acf'
    ),
    /* translators: 1: plugin name. */
    'plugin_already_active'           => __(
        'No action taken. Plugin %1$s was already active.', 
        'theme-acf'
    ),
    /* translators: 1: plugin name. */
    'plugin_needs_higher_version'     => __(
        'Plugin not activated. A higher version of %s is needed for this theme.'.
        'Please update the plugin.', 
        'theme-acf'
    ),
    /* translators: 1: dashboard link. */
    'complete'                        => __(
        'All plugins installed and activated successfully. %1$s', 
        'theme-acf'
    ),
    'dismiss'                         => __('Dismiss this notice', 'theme-acf'),
    'notice_cannot_install_activate'  => __(
        'There are one or more required or'.
        'recommended plugins to install, update or activate.', 
        'theme-acf'
    ),
    'contact_admin'                   => __(
        'Please contact the administrator of this site for help.', 
        'theme-acf'
    ),
    // Determines admin notice type - 
    // can only be one of the typical WP notice classes, 
    // such as 'updated', 'update-nag', 'notice-warning', 
    // 'notice-info' or 'error'. 
    // Some of which may not  work as expected in older WP versions.
    'nag_type'                        => '',
    ),
        
    );

    tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'Theme_Register_Required_plugins');
