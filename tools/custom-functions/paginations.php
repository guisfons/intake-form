<?php
/**
 * Custom paginations
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

// pagination blog
if (!function_exists('custom_pagination') ) :
    /**
     * Breadcrumbs
     *
     * @param $the_query Query
     *
     * @return void
     */
    
    function custom_pagination($query = null) {

        if( is_singular() )
        return;
    
        global $wp_query;
    
        // Stop execution if there's only 1 page
        if( $wp_query->max_num_pages <= 1 )
        return;
    
        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
        $max   = intval( $wp_query->max_num_pages );
    
        // Add current page to the array 
        if ( $paged >= 1 )
        $links[] = $paged;
    
        // Add the pages around the current page to the array 
        if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
        }
    
        if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
        }
    
        echo '<div class="container">' . "\n";
    
        // Previous Post Link 
        if ( get_previous_posts_link() )
        printf( '<span class="btn-page next-previus">%s</span>' . "\n", get_previous_posts_link('<i class="fas fa-arrow-left"></i>', '', 'yes') );
    
        // Link to first page, plus ellipses if necessary 
        if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? 'active' : '';
    
        printf( '<a href="%s" class="btn-page %s">%s</a>&nbsp;' . "\n", esc_url( get_pagenum_link( 1 ) ), $class, '1' );
    
        if ( ! in_array( 2, $links ) )
            echo '&nbsp;<strong> . . . </strong>&nbsp;';
        }
    
        // Link to current page, plus 2 pages in either direction if necessary 
        sort( $links );
        foreach ( (array) $links as $link ) {
        $class = $paged == $link ? 'active' : '';
        printf( '<a href="%s" class="btn-page %s">%s</a>&nbsp;' . "\n", esc_url( get_pagenum_link( $link ) ), $class, $link );
        }
    
        // Link to last page, plus ellipses if necessary 
        if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '&nbsp;<strong> . . . </strong>&nbsp;' . "\n";
    
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<a href="%s" class="btn-page %s">%s</a>&nbsp;' . "\n", esc_url( get_pagenum_link( $max ) ), $class, $max );
        }
    
        // Next Post Link 
        if ( get_next_posts_link() )
        printf( '<span class="btn-page next-previus">%s</span>' . "\n", get_next_posts_link('<i class="fas fa-arrow-right"></i>', '', 'yes') );
    
        echo '</div>' . "\n";
    
    }
endif;
