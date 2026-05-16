<?php
/**
 * Template part for displaying intake forms items
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
<div class="item">
    <article>
    <div class="box-shadow">
        <?php $current_post_status = get_post_status(); ?>
        <div class="status <?php if ( $current_post_status == 'in-progress' ) : echo 'in-progress'; endif;?>">
            <?php
                if ( $current_post_status == 'submitted' ) {
                    echo '<label>Submitted</label>';
                } else if ( $current_post_status == 'in-progress' ){
                    echo '<label>In Progress</label>';
                }
            ?>
        </div>
        <div class="title">
            <h3>
                <?php the_title(); ?>
            </h3>
        </div>
        <div class="post-data">
            <ul>
                <li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );?>"><?php the_author();?></a></li>
                <li><i class="far fa-calendar"></i> <?php echo get_the_date( 'F jS, Y' ); ?></li>
            </ul>
            
        </div>
        <div class="cta">
            <a href="<?php the_permalink();?>" class="btn-intake-form">
                Go to form
            </a>
        </div>
    </div>
    </article>
</div>