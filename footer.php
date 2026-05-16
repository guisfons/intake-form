<?php
/**
 * The template for displaying footer
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

</div><!-- /.main -->
            <?php
            $footer = true;
            $is_footer_disabled = get_post_meta(
                get_the_ID(), 
                '_crb_footer_enabled', 
                true
            );

            if (is_page() && $is_footer_disabled == '1' ) {
                $footer = false;
            }

            if ($footer ) : ?>
            <footer class="footer" >
                <div class="footer__bar">
                    <div class="shell shell--sm footer__shell">
                        <div class="footer__bar-inner">
                            <p class="footer__copyright">
                                &copy;<?php echo date('Y'); ?>, 
                                <span class="highlight"> 
                                <?php bloginfo('name'); ?>
                                </span>. 
                            <?php _e('All Rights Reserved.', 'theme-acf'); ?>
                            </p><!-- /.footer__copyright -->
                        </div><!-- /.footer__bar-inner -->
                    </div><!-- /.shell shell--fluid footer__shell -->
                </div><!-- /.footer__bar -->
            </footer><!-- /.footer -->
            <?php endif; ?>
        </div><!-- /.wrapper__inner -->
    </div><!-- /.wrapper -->
    
    <div class="wp-scripts">
        <?php wp_footer(); ?>
    </div>
    
</body>
</html>
