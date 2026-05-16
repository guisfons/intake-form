<?php
/**
 * Walker Nav Class
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

if (! class_exists('Walker_Nav') ) :
    /**
     * Walker_Nav class.
     *
     * @category Walker_Navs
     * @package  Theme_Acf
     * @author   Product Developers <productdev@ollyolly.com>
     * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
     * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
     */
    class Walker_Nav extends Walker_Nav_menu
    {
        /**
         * Func startLvl
         *
         * @param $output Expected output
         * @param $depth  Depth level of the navigation
         * @param $args   Extra arguments
         *
         * @return void
         */
        function startLvl( &$output, $depth = 0, $args = Array())
        {
            // ul
            $indent = str_repeat("\t", $depth);
            $submenu = ($depth > 0) ? ' sub-menu' : '';
            $output .="\n$indent<ul class=\"sub-menu\">\n";
        }

        /**
         * Func startEl
         *
         * @param $output Expected output
         * @param $item   Specific menu item
         * @param $depth  Depth level of the navigation
         * @param $args   Extra arguments
         * @param $id     Navigation Id
         *
         * @return void
         */
        function startEl(&$output, $item, $depth = 0, $args = Array(), $id = 0)
        {
            $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

            $li_attributes = '';
            $class_names = $value = '';

            $classes = empty($item->classes) ? array() : (array) $item->classes;

            $classes[] = ($args->walker->has_children) ? '' : '';
            $classes[] = ( $item->current || 
            $item->current_item_anchestor ) ? 
            'active' : 
            '';
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join(
                ' ', 
                apply_filters(
                    'nav_menus_css_class', 
                    array_filter($classes), 
                    $item, 
                    $args
                )
            );
            $class_names = ' class="'. esc_attr($class_names) .'"';

            $id= apply_filters(
                'nav_menu_item_id', 
                'menu-item-'.$item->ID, 
                $item, 
                $args
            );
            $id = strlen($id) ? ' id="'. esc_attr($id) .'"' : '';

            $output .= $indent. '<li '.$id. 
            $value . $class_names . $li_attributes . '>';
            $attributes = ! empty($item->attr_title) ? 
            'title="'. esc_attr($item->attr_title) .'"' : '';
            $attributes .= ! empty($item->target) ? 
            'target="'. esc_attr($item->target) .'"' : '';
            $attributes .= ! empty($item->xfn) ? 
            'rel="'. esc_attr($item->xfn) .'"' : '';

            if ($depth == 0  && $args->walker->has_children) {
                $attributes .= ! empty($item->url) ? 'href="#"' : '';
            } else if ($depth == 1  && $args->walker->has_children) {
                $attributes .= ! empty($item->url) ? 'href="#"' : '';
            } else {
                $attributes .= ! empty($item->url) ? 
                'href="'. esc_attr($item->url) .'"' : '';
            }
        
            $attributes .= ($args->walker->has_children ) ? ' ' : '';
            $attributes .= ($args->walker->has_children ) ? 
            ' class="has-child"' : 
            '';

            $item_output = $args->before;
            $item_output .= '<a ' . $attributes . '>';
            $item_output .= $args->link_before . 
            apply_filters('the_title', $item->title, $item->ID) .$args->link_after;
            //imprimo el icono
            $item_output .= '</a>';

            $item_output .= $args->after;

            $output .= apply_filters(
                'walker_nav_menu_start_el', 
                $item_output, 
                $item, 
                $depth, 
                $args
            );
        }
    }
endif;
