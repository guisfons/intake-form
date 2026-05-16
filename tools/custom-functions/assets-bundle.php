<?php
/**
 * Assets Bundle Functions
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
 * Get the path to a versioned bundle relative to the theme directory.
 *
 * @param string $path Path
 *
 * @return string
 */
function Theme_Assets_bundle( $path )
{
    static $manifest = null;

    if (is_null($manifest) ) {
        $manifest_path = THEME_DIR . 'dist/manifest.json';

        if (file_exists($manifest_path) ) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
            $manifest = array();
        }
    }

    $path = isset($manifest[ $path ]) ? $manifest[ $path ] : $path;

    return '/dist/' . $path;
}
