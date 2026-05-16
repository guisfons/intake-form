<?php 
/**
 * COS Users Select Input
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
 * @param array $field COS Users select input
 *
 * @return $field Array
 */
function Acf_Load_Cos_Users_Field_choices( $field )
{
    
    // reset choices
    $field['choices'] = array();

    // Users Role Query
    $users_role_query = new WP_User_Query(array( 'role__in' => array( 'administrator', 'onboarding_specialist','viewer' ) ));
    $users_role_results = $users_role_query->get_results();

    if (is_array($users_role_results) && count($users_role_results) > 0) {
        foreach ($users_role_results as $user_key => $user_value) {
            
            // vars
            $user_id = $user_value->data->ID;
            $user_name = $user_value->data->display_name;
        
            // append to choices
            $field['choices'][ $user_id ] = $user_name;        
        }
    }

    // return the field
    return $field;
    
}

add_filter('acf/load_field/name=account_details_client_onboarding_specialist', 'Acf_Load_Cos_Users_Field_choices');
