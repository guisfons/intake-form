<?php
/**
 * Template part for displaying posts
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$author_name = get_the_author_meta('display_name', $post->post_author);
?>

<section class="single-post-container">
    <div class="shell">
        <div class="single-post-container__heading-wrapper">
            <span class="reading-time">1 minute read</span>
            <div class="richtext-entry">
                <h1 
                    style="text-align: center;"
                >
                    How to design a product that can grow itself 10x in year:
                </h1>
                <p style="text-align: center;">
                    Donec posuere vulputate arcu. Quisque rutrum.
                </p>
            </div>
        </div>
        <div class="single-post-container__author-wrapper">
            <?php echo get_avatar($post->post_author, 48, '', $author_name, null); ?>
            <div class="autor-desc-wrapper">
                <span class="author"><?php echo esc_html($author_name);?></span>
                <span class="date">
                    <?php echo esc_html(get_the_date('F jS, Y')); ?>
                </span>
            </div>
        </div>
        <div class="single-post-container__post-content-wrapper richtext-entry">
            <p>
                <strong>
                    Pellentesque posuere. Phasellus a est. Suspendisse pulvinar
                </strong>
            </p>
            <p>
                <strong>
                    Pellentesque posuere. Phasellus a est. Suspendisse pulvinar
                </strong>
            </p>
            <p>
                <strong>
                    Pellentesque posuere. Phasellus a est. Suspendisse pulvinar
                </strong>
            </p>
            <p>
                <strong>
                    Pellentesque posuere. Phasellus a est. Suspendisse pulvinar
                </strong>
            </p>
        </div>
        <?php
        if (has_tag() ) :
            ?>
                <div class="single-post-container__post-tags-wrapper">
                    <p>Tags: </p>
                    <div class="tags">
            <?php 
            $posttags = get_the_tags();
            if ($posttags) :
                foreach($posttags as $tag):
                    ?>
                    <a 
                        href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                        target="_self"
                    ><?php echo esc_html($tag->name); ?></a>
                    <?php
                endforeach;
            endif;
            ?>
                    </div>
                </div>
            <?php
        endif; 
        ?>
    </div>
</section>
