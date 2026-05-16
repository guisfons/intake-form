<?php
/**
 * The template for displaying search form
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<form 
    role="search" 
    method="get" 
    class="search-form" 
    action="<?php echo esc_url(home_url('/')); ?>"
>
    <label>
        <input 
            type="search" 
            class="search-field form-control" 
            placeholder="
                <?php 
                    echo esc_attr_x(
                        'Enter Keyword &hellip;', 
                        'placeholder', 
                        'base-theme'
                    ); 
                    ?>" 
            value="<?php echo esc_attr(get_search_query()); ?>" 
            name="s" 
            title="<?php _ex('Enter Keyword', 'label', 'base-theme'); ?>" 
            id="blogSearchInput"
        >
    </label>
    <input 
        type="hidden" 
        class="search-submit" 
        value="<?php echo esc_attr_x('Search', 'submit button', 'base-theme'); ?>"
    >
    <button class="search-submit">
        <span 
            style="mask:url(
                <?php 
                    echo esc_attr(
                        get_template_directory_uri().
                        '/dist/images/svgs/search-icon.svg'
                    ); 
                    ?>)'.
                'no-repeat center; -webkit-mask:url(
                <?php 
                    echo esc_attr(
                        get_template_directory_uri().
                        '/dist/images/svgs/search-icon.svg'
                    ); 
                    ?>) no-repeat center;"
            ></span>
    </button>
</form>
