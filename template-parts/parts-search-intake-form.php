<section class="section-cols" id="section-intake-form-page">
    <div class="shell">
        <div class="section__inner">
            <div class="section-content">
                <div class="grid-intake-form-page">
                    <?php 
                        $seach_query = get_search_query();
                        $allsearch   = new WP_Query("s=$s&showposts=0"); 
                        if ( !empty( $seach_query ) ){
                            if( $wp_query->found_posts < 2 ) {
                                $result = "item";
                              } else {
                                $result = "items";
                            }
                            ?>
                            <div class="output-message">
                                <h2>
                                    <?php echo 'We found <strong>' . $allsearch ->found_posts . ' ' . $result . '</strong> which matched your search term "<strong>' . esc_html( get_search_query() ) . '</strong>":'; ?>
                                </h2>
                            </div>
                            <?php 
                        }
                        if ( have_posts() ) : 
                            while ( have_posts() ) : the_post();
                                $post_type = get_post_type();
                                if ( $post_type === 'intake-form' || $post_type === 'new-intake-form' ): 
                                    get_template_part('template-parts/intake-form-item/intake-form-item' ); 
                                endif;
                            endwhile; 
                            wp_reset_postdata();
                        else:  
                            ?>
                            <div class="output-message">
                                <h2><?php _e( 'Sorry, no intake forms matched your criteria.' ); ?></h2>
                            </div>
                            <?php 
                        endif; 
                    ?>
                </div>
                <div class="pagination">
                    <?php custom_pagination(); ?>
                </div>
            </div>
        </div>
    </div>
</section>