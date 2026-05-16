<?php 
/**
 * Re-adding Data from Deleted Questions
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
 * @param array $field - Content Notes Group Field
 *
 * @return $field Array
 */

function content_notes_group_field($field) {

    $id = get_the_ID();

    foreach( $field['sub_fields'] as $sub_fields ) {
        //Question: Does the client want to include a specific town name or surrounding areas relevant to the business?
        if( $sub_fields['key'] === 'field_65de38c6ddb4d' ) {
            //Get the previous data
            $prevDataA = get_post_meta($id, 'business_details_group_business_details_include_specific_town_areas');
            if( $prevDataA ) {
                if (!get_post_meta($id, 'content_notes_group_field_content_notes_include_specific_town_areas', true)) {
                    // Add a custom post meta if the meta key doesn't exist or has an empty value
                    add_post_meta($id, 'content_notes_group_field_content_notes_include_specific_town_areas', $prevDataA[0], true);
                }
            }
        }
        //Question: Town name or surrounding areas
        if( $sub_fields['key'] === 'field_65e21dfcbfbd3' ) {
            //Get the previous data
            $prevDataB = get_post_meta($id, 'business_details_group_business_details_town_name_or_surrounding_areas');

            if( !empty($prevDataB) ) {
                if (!get_post_meta($id, 'content_notes_group_field_content_notes_town_name_or_surrounding_areas', true)) {
                    // Add a custom post meta if the meta key doesn't exist or has an empty value
                    add_post_meta($id, 'content_notes_group_field_content_notes_town_name_or_surrounding_areas', $prevDataB[0], true);
                }
            }
        }
    }

    return $field;
}

add_filter('acf/load_field/key=field_6493793f80bd0', 'content_notes_group_field');

function ollyolly_app_connections($field) {

    $id = get_the_ID();

    foreach( $field['sub_fields'] as $sub_fields ) {
        //Question: Does the client want to include a specific town name or surrounding areas relevant to the business?
        if( $sub_fields['key'] === 'field_65de38c6ddb4d' ) {
            //Get the previous data
            $prevDataA = get_post_meta($id, 'business_details_group_business_details_include_specific_town_areas');
            if( $prevDataA ) {
                if (!get_post_meta($id, 'ollyolly_app_connections_content_notes_include_specific_town_areas', true)) {
                    // Add a custom post meta if the meta key doesn't exist or has an empty value
                    add_post_meta($id, 'ollyolly_app_connections_content_notes_include_specific_town_areas', $prevDataA[0], true);
                }
            }
        }
        //Question: Town name or surrounding areas
        if( $sub_fields['key'] === 'field_65e21dfcbfbd3' ) {
            //Get the previous data
            $prevDataB = get_post_meta($id, 'business_details_group_business_details_town_name_or_surrounding_areas');

            if( !empty($prevDataB) ) {
                if (!get_post_meta($id, 'ollyolly_app_connections_content_notes_town_name_or_surrounding_areas', true)) {
                    // Add a custom post meta if the meta key doesn't exist or has an empty value
                    add_post_meta($id, 'ollyolly_app_connections_content_notes_town_name_or_surrounding_areas', $prevDataB[0], true);
                }
            }
        }
    }

    return $field;
}

add_filter('acf/load_field/key=field_6812442cb2a01', 'ollyolly_app_connections');