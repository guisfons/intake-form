<?php
/**
 * Custom functions for rendering buttons
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
 * Rendering custom button
 *
 * @param $text          Text
 * @param $url           Url
 * @param $new_tab       Target
 * @param $classes       Classnames
 * @param $icon_type     Icon Type
 * @param $icon          Icon
 * @param $w_before_icon Before Icon
 * @param $w_after_icon  After Icon
 *
 * @return void|string
 */
function Render_btn(
    string $text = '', 
    string $url = '', 
    bool $new_tab = false, 
    array $classes = array(), 
    string $icon_type = '',
    string $icon = '', 
    string $w_before_icon = '', 
    string $w_after_icon = '' 
) {
    if (empty($text) ) :
        return;
    endif;
    
    $target = $new_tab && !empty($url) ? '_blank' : '_self';

    $url = !empty($url) ? esc_url($url) : 'javascript:void(0)';

    $class_attr = is_array($classes) ? 
    ' class="cta ' . implode(' ', $classes) . '"' 
    : '';
    ?>
    <a
        href="<?php echo $url; ?>"
    <?php echo $class_attr; ?> 
        target="<?php echo $target; ?>"
    >
    <?php 
    if (!empty($icon)) :
        if (!empty($w_before_icon) && empty($w_after_icon) ) : 
            echo $w_before_icon;
        endif;

        if(!empty($icon_type) && $icon_type === 'icon-image') :
            echo "<span class='icon' style='mask:url($icon) no-repeat center;
					-webkit-mask: url($icon) no-repeat center;'></span>";
        endif;

        if(!empty($icon_type) && $icon_type === 'icon-font') :
            echo "<span class='icon-font'><i class='$icon'></i></span>";
        endif;

        if (empty($w_before_icon) && !empty($w_after_icon) ) : 
            echo $w_after_icon; 
        endif;
    endif;
    echo '<span class="text">' . nl2br(esc_html($text)) .'</span>'; 
    ?>
    </a>
    <?php
}
