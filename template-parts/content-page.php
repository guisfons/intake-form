<?php
/**
 * Template part for displaying page content in page.php
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

<div <?php post_class('section__content'); ?>>
    <?php if (has_post_thumbnail() ) : ?>
        <div class="section__image">
        <?php the_post_thumbnail(); ?>
        </div><!-- /.section__image -->
    <?php endif; ?>

    <?php the_title('<h2 class="section__title">', '</h2>'); ?>

    <div class="section__body richtext-entry">
        <?php
        the_content();

        edit_post_link(__('Edit this entry.', 'theme-acf'), '<p>', '</p>');
        ?>
    </div><!-- /.section__body -->
</div><!-- /.section__content -->
