<section class="section-cols" id="section-intake-form-page">
    <div class="shell">
        <div class="section__inner">
            <div class="section-content">
                <div class="grid-intake-form-page">
                    <?php
                        $args = array(
                            'post_type' => array('intake-form', 'new-intake-form'),
                            'posts_per_page' => 10,
                            'paged' => get_query_var('paged') ? get_query_var('paged') : 1
                        );

                        $intake_query = new WP_Query($args);

                        if ( $intake_query->have_posts() ) :
                            while ( $intake_query->have_posts() ) : $intake_query->the_post();
                                $post_type = get_post_type();
                                if ( $post_type === 'intake-form' || $post_type === 'new-intake-form' ): 
                                    get_template_part('template-parts/intake-form-item/intake-form-item' ); 
                                endif;
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <div class="output-message">
                                <h2><?php _e( 'Sorry, no intake forms matched your criteria.' ); ?></h2>
                            </div>
                            <?php
                        endif;
                        ?>
                </div>
                <div class="pagination">
                    <?php custom_pagination($intake_query); ?>
                </div>
            </div>
        </div>
    </div>
</section>