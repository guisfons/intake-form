<?php
 /**
  * Admin Login Functions
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
 * Change the login header logo href attribute to open the homepage
 *
 * @param string $login_header_url Login header logo URL.
 *
 * @return string Homepage URL.
 */
function Change_Login_Header_url( $login_header_url )
{
    return home_url('/');
}
add_filter('login_headerurl', 'Change_Login_Header_url');

/**
 * Change the login header logo title attribute to display the Site Title
 * instead of the default "Powered by WordPress".
 *
 * @param string $login_header_title Login header logo URL.
 *
 * @return string Site Title.
 */
function Change_Login_Header_title( $login_header_title )
{
    return get_bloginfo('name');
}
add_filter('login_headertext', 'Change_Login_Header_title');

/**
 * Added styles to login page
 *
 * @return void
 */
function Login_logo()
{
    ?>
    <style type="text/css">
        body.login {
            position: relative;
            background: 
                url(<?php echo get_stylesheet_directory_uri() .
                '/dist/images/background-intake-form.jpg' ?>);
            background-size: 100% 100%;
        }

        #login h1 a, .login h1 a {
            background-image: 
                url(<?php echo get_stylesheet_directory_uri() .
                '/dist/images/logo-intake-form.svg' ?>);
            width: 192px;
            height: 91px;
            background-size: 192px 91px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }

        #nav a, #backtoblog a {
            color: #fff !important;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'Login_logo');
