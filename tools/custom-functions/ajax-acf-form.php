<?php
/**
 * AJAX ACF Form
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

function save_intake_form_data()
{

    $user_id = get_current_user_id();

    if($user_id ) {
        $client_business_name = 'field_64a4329fea877';
        $account_details_group_field = 'field_649376c46650f';
        $content_notes_group_field = 'field_6493793f80bd0';
        $designs_group_field = 'field_6494c543f63ce';
        $plugins_group_field = 'field_6495cd17c65f2';
        $business_details_group_field = 'field_6495de7ddad20';
        $google_business_profile_group_field = 'field_649b12ad63fd6';
        $domain_group_field = 'field_649b16d0525f6';
        
        $data = $_POST['info'];
        $title = '';

        $account_details = array();
        $content_notes = array();
        $designs = array();
        $plugins = array();
        $sitemap = array();
        $business_details = array();
        $google_business_profile = array();
        $domain = array();

        $parseData = array();
        parse_str($data, $parseData);

        $finalData = $parseData['acf'];

        foreach ($finalData as $key => $value) {
            if($key === $client_business_name ) {
                $title = $value;
            }
            foreach ($value as $value_key => $value_data) {
                if($key === $account_details_group_field ) {
                    $account_details[$value_key] = $value_data;
                }
                if($key === $content_notes_group_field ) {
                    $content_notes[$value_key] = $value_data;
                }
                if($key === $designs_group_field ) {
                    $designs[$value_key] = $value_data;
                }
                if($key === $plugins_group_field ) {
                    $plugins[$value_key] = $value_data;
                }
                if($key === $business_details_group_field ) {
                    $business_details[$value_key] = $value_data;
                }
                if($key === $google_business_profile_group_field ) {
                    $google_business_profile[$value_key] = $value_data;
                }
                if($key === $domain_group_field ) {
                    $domain[$value_key] = $value_data;
                }
            }
        }

        $message = 'Saved!';
        $type = 'insert';

        $post = array(
            'post_type'                 => 'intake-form',
            'post_title'                => $title,
            'post_status'               => 'in-progress',
        );

        if($_POST['ifid'] != 0 && get_post_type($_POST['ifid']) === 'intake-form' ) {
            $post_id = $_POST['ifid'];

            $post['ID'] = $post_id;
            
            wp_update_post($post);
            $message = 'Updated!';
            $type = 'update';
        }
        else {
            $post['post_author'] = $user_id;
    
            $post_id = wp_insert_post($post);
        }

        //Add/Update Client Business Name (Post Title)
        update_field($client_business_name, $title, $post_id);

        //Add/Update Account Details Fields
        update_field($account_details_group_field, $account_details, $post_id);

        //Add/Update Content Notes Fields
        update_field($content_notes_group_field, $content_notes, $post_id);

        //Add/Update Design Fields
        update_field($designs_group_field, $designs, $post_id);

        //Add/Update Plugins / Other Tools
        update_field($plugins_group_field, $plugins, $post_id);

        //Add/Update Business Details
        update_field($business_details_group_field, $business_details, $post_id);

        //Add/Update Google Business Profile
        update_field($google_business_profile_group_field, $google_business_profile, $post_id);

        //Add/Update Domain Information
        update_field($domain_group_field, $domain, $post_id);

        $permalink = get_permalink($post_id);

        $response = array(
            'success' => true,
            'post_id' => $post_id,
            'link'    => $permalink,
            'message' => $message,
            'type'    => $type
        );
        wp_send_json($response);
    }
    else {
        $response = array(
            'success' => false,
            'message' => "Error: Something went wrong!"
        );
        wp_send_json($response);
    }
}
add_action('wp_ajax_save_intake_form_data', 'save_intake_form_data');
add_action('wp_ajax_nopriv_save_intake_form_data', 'save_intake_form_data');

function save_new_intake_form_data()
{
    $user_id = get_current_user_id();

    if($user_id ) {
        $client_business_name = 'field_6812442cb2904';
        $pre_call_information_group_field = 'field_6812442cb2949';
        $getting_to_know_group_field = 'field_6812442cb2987';
        $google_business_profile_group_field = 'field_6812442cb29c4';
        $ollyolly_app_group_field = 'field_6812442cb2a01';
        $website_service_pages_group_field = 'field_6812442cb2a3e';
        $website_personalization_group_field = 'field_6812442cb2a7c';
        $website_design_group_field = 'field_6818e3bb803bf';
        $domain_access_group_field = 'field_6812442cb2af6';
        $nap_information_group_field = 'field_6818eb66381ec';
        $closing_items_group_field = 'field_6818ee56381fe';

        $data = $_POST['info'];
        $title = '';

        $pre_call_information = array();
        $getting_to_know = array();
        $google_business_profile = array();
        $ollyolly_app = array();
        $website_service_pages = array();
        $website_personalization = array();
        $website_design = array();
        $domain_access = array();
        $nap_information = array();
        $closing_items = array();

        $parseData = array();
        parse_str($data, $parseData);

        $finalData = $parseData['acf'];

        foreach ($finalData as $key => $value) {
            foreach ($value as $value_key => $value_data) {
                // Extract title from inside the pre_call_information group field
                if (isset($finalData[$pre_call_information_group_field][$client_business_name])) {
                    $title = $finalData[$pre_call_information_group_field][$client_business_name];
                }

                if($key === $pre_call_information_group_field) {
                    $pre_call_information[$value_key] = $value_data;
                }
                if($key === $getting_to_know_group_field) {
                    $getting_to_know[$value_key] = $value_data;
                }
                if($key === $google_business_profile_group_field) {
                    $google_business_profile[$value_key] = $value_data;
                }
                if($key === $ollyolly_app_group_field) {
                    $ollyolly_app[$value_key] = $value_data;
                }
                if($key === $website_service_pages_group_field) {
                    $website_service_pages[$value_key] = $value_data;
                }
                if($key === $website_personalization_group_field) {
                    $website_personalization[$value_key] = $value_data;
                }
                if($key === $website_design_group_field) {
                    $website_design[$value_key] = $value_data;
                }
                if($key === $domain_access_group_field) {
                    $domain_access[$value_key] = $value_data;
                }
                if($key === $nap_information_group_field) {
                    $nap_information[$value_key] = $value_data;
                }
                if($key === $closing_items_group_field) {
                    $closing_items[$value_key] = $value_data;
                }
            }
        }

        $message = 'Saved!';
        $type = 'insert';

        $post = array(
            'post_type'   => 'new-intake-form',
            'post_title'  => $title,
            'post_status' => 'in-progress',
        );

        if($_POST['ifid'] != 0 && get_post_type($_POST['ifid']) === 'new-intake-form') {
            $post['ID'] = $_POST['ifid'];
            wp_update_post($post);
            $post_id = $post['ID'];
            $message = 'Updated!';
            $type = 'update';
        } else {
            $post['post_author'] = $user_id;
            $post_id = wp_insert_post($post);
        }

        // Save ACF fields
        // update_field($client_business_name, $title, $post_id);
        update_field($pre_call_information_group_field, $pre_call_information, $post_id);
        update_field($getting_to_know_group_field, $getting_to_know, $post_id);
        update_field($google_business_profile_group_field, $google_business_profile, $post_id);
        update_field($ollyolly_app_group_field, $ollyolly_app, $post_id);
        update_field($website_service_pages_group_field, $website_service_pages, $post_id);
        update_field($website_personalization_group_field, $website_personalization, $post_id);
        update_field($website_design_group_field, $website_design, $post_id);
        update_field($domain_access_group_field, $domain_access, $post_id);
        update_field($nap_information_group_field, $nap_information, $post_id);
        update_field($closing_items_group_field, $closing_items, $post_id);

        $response = array(
            'success' => true,
            'post_id' => $post_id,
            'link'    => get_permalink($post_id),
            'message' => $message,
            'type'    => $type
        );

        wp_send_json($response);
    } else {
        wp_send_json(array(
            'success' => false,
            'message' => "Error: Something went wrong!"
        ));
    }
}
add_action('wp_ajax_new_save_intake_form_data', 'save_new_intake_form_data');
add_action('wp_ajax_nopriv_new_save_intake_form_data', 'save_new_intake_form_data');

/**
 * Unlock Submitted Form
 *
 * @return void
 */
function Unlock_Submitted_form()
{
    $intake_form_id = $_POST['intakeFormId'];

    if (empty($intake_form_id)) {
        wp_send_json(
            array(
            'data' => null,
            'message' => 'Bad client request!',
            'status_code' => 403
            )
        );
    } else {
        $post_type = get_post_type($intake_form_id); 
        $updated_intake_form = array(
            'ID' => intval($intake_form_id),
            'post_type' => $post_type,
            'post_status' => 'in-progress',
        );

        $updated_intake_form_result = wp_update_post($updated_intake_form);

        if (is_wp_error($updated_intake_form_result) || intval($updated_intake_form_result) === 0) {
            wp_send_json(
                array(
                'data' => null,
                'message' => 'The intake form does not exist!',
                'status_code' => 404
                )
            );
        } else {
            wp_send_json(
                array(
                'data' => array('updated_intake_form_id' => $updated_intake_form_result),
                'message:' => 'The intake form was sucessfully unlocked!',
                'status_code' => 200
                )
            );
        }
    }    
}
add_action('wp_ajax_unlock_submitted_form', 'Unlock_Submitted_form');
add_action('wp_ajax_nopriv_unlock_submitted_form', 'Unlock_Submitted_form');
