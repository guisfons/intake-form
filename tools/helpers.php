<?php
/**
 * Helpers functions
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
 * @param string $number Phone number to validate
 *
 * @return string Validated phone number
 */
function Validate_Phone_number( $number )
{
    $pattern = "/[^0-9]/";
    return preg_replace($pattern, '', $number);
}

/**
 * Converting hexadecimal color to rgb
 *
 * @param string  $hex_value Hexadecimal color code
 * @param boolean $opacity   Opacity percentage
 *
 * @return string RGB color
 */
function Hex_To_rgb( $hex_value, $opacity = false )
{
    list($r, $g, $b) = sscanf($hex_value, "#%02x%02x%02x");
    if ($opacity ) {
        return "$r, $g, $b, {$opacity}";
    }

    return "$r, $g, $b";
}

/**
 * Hide Editor From Templates
 *
 * @return void
 */
function Hide_editor()
{
    $post_id = false;
    if (isset($_GET['post']) ) {
        $post_id = $_GET['post'];
    } else if (isset($_POST['post_ID']) ) {
        $post_id = $_POST['post_ID'];
    }

    $post_id = intval($post_id);
    if (! $post_id ) {
        return;
    }

    $current_template = get_page_template_slug($post_id);
    $exclude_on       = [
    'templates/page-builder.php',
    ];

    if (in_array($current_template, $exclude_on) ) {
        remove_post_type_support('page', 'editor');
        remove_post_type_support('page', 'thumbnail');
    }
}
add_action('admin_init', 'Hide_editor');

/**
 * Returning mime type for svg images
 *
 * @param $mimes Mime type
 *
 * @return string Mime type
 */
function Mime_types( $mimes )
{
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}
add_filter('upload_mimes', 'Mime_types');

/**
 * Getting global contact data
 *
 * @param $type Contact data type
 *
 * @return array
 */
function Get_Contact_data(string $type=''):array
{
    if ($type == '') {
        return [];
    }

    $global_contacts = get_field(
        'theme_options_general_contacts', 
        'option'
    );

    $filtered = array_filter(
        $global_contacts, 
        function ($value) use ($type) {
            return strpos($value['acf_fc_layout'], $type) !== false;
        }
    );

    $filtered = array_values($filtered);
    
    if (count($filtered) <= 0) {
        return [];
    }
    
    return $filtered[0];
}


/**
 * Luminance Dark
 *
 * @param $hexcolor Hex Color
 * @param $percent  Percent
 *
 * @return string
 */
function Luminance_dark($hexcolor, $percent)
{
    if (strlen($hexcolor) < 6 ) {
        $hexcolor = $hexcolor[0] . $hexcolor[0] . $hexcolor[1] . $hexcolor[1] . $hexcolor[2] . $hexcolor[2];
    }
    $hexcolor = array_map(
        'hexdec', str_split(
            str_pad(
                str_replace(
                    '#', 
                    '', 
                    $hexcolor
                ), 
                6, 
                '0'
            ), 
            2
        )
    );

    foreach ($hexcolor as $i => $color) {
        $from = $percent < 0 ? 0 : $color;
        $to = $percent < 0 ? $color : 0;
        $pvalue = ceil(($to - $from) * $percent);
        $hexcolor[$i] = str_pad(dechex($color + $pvalue), 2, '0', STR_PAD_LEFT);
    }

    return '#' . implode($hexcolor);
}

/**
 * Luminance Light
 *
 * @param $hexcolor Hex Color
 * @param $percent  Percent
 *
 * @return string
 */
function Luminance_light($hexcolor, $percent)
{
    if (strlen($hexcolor) < 6 ) {
        $hexcolor = $hexcolor[0] . $hexcolor[0] . $hexcolor[1] . $hexcolor[1] . $hexcolor[2] . $hexcolor[2];
    }
    $hexcolor = array_map('hexdec', str_split(str_pad(str_replace('#', '', $hexcolor), 6, '0'), 2));

    foreach ($hexcolor as $i => $color) {
        $from = $percent < 0 ? 0 : $color;
        $to = $percent < 0 ? $color : 255;
        $pvalue = ceil(($to - $from) * $percent);
        $hexcolor[$i] = str_pad(dechex($color + $pvalue), 2, '0', STR_PAD_LEFT);
    }

    return '#' . implode($hexcolor);
}

/**
 * Rgb2hex2rgb
 *
 * @param $color Color
 *
 * @return string
 */
function rgb2hex2rgb($color)
{
    if (empty($color) ) { 
        return false; 
    } 
    
    $color = trim($color); 
    $result = false; 

    if (preg_match("/^[0-9ABCDEFabcdef\#]+$/i", $color)) {
        $hex = str_replace('#', '', $color);
        if (!$hex) { 
            return false;
        }
            
        if(strlen($hex) == 3) :
            $result['r'] = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
            $result['g'] = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
            $result['b'] = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
     else:
         $result['r'] = hexdec(substr($hex, 0, 2));
         $result['g'] = hexdec(substr($hex, 2, 2));
         $result['b'] = hexdec(substr($hex, 4, 2));
     endif;      

     return $result['r'] . ',' . $result['g'] . ',' . $result['b'];

    } elseif (preg_match("/^[0-9]+(,| |.)+[0-9]+(,| |.)+[0-9]+$/i", $color)) { 

        $rgbstr = str_replace(array(',',' ','.'), ':', $color); 
        $rgbarr = explode(":", $rgbstr);
        $result = '#';
        $result .= str_pad(dechex($rgbarr[0]), 2, "0", STR_PAD_LEFT);
        $result .= str_pad(dechex($rgbarr[1]), 2, "0", STR_PAD_LEFT);
        $result .= str_pad(dechex($rgbarr[2]), 2, "0", STR_PAD_LEFT);
        $result = strtoupper($result); 
            
    } else {
        $result = false;
    }
                
    return $result; 
}
