<section class="section-cols" id="section-intake-form-page">
    <div class="shell">
        <div class="section__inner">
            <div class="section-content">
                <div class="grid-intake-form-page">
                    <div class="output-message">
                        <?php
                            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
                        ?>
                            <h2>
                                <?php echo '<strong>Intake forms</strong> which matched with author: <strong>' . $curauth->nickname . '</strong>'; ?>
                            </h2>
                        </div>
                    <?php
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
                                <h2><?php _e( 'Sorry, no intake forms matched by this author.' ); ?></h2>
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