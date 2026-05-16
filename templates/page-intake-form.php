<?php
/**
 * Template Name: Page Intake Form
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

acf_form_head();
get_header();
?>

    <div id="primary" class="content-area shell">
        <div class="controls">
            <button id="scrollToTopBtn" class="scroll-to-top-btn"><i class="fa-solid fa-arrow-up" aria-hidden="true"></i></button>
        </div>
        <div id="content" class="site-content" role="main">
            <div class="intake-form-container">
                <?php get_template_part('template-parts/sticky-menu');  ?>
                <div class="intake-form-box">
                    <div class="intake-form-box--menu">
                        <ul class="menu-list">
                            <li><a href="#" data-href="all" class="active">All</a></li>
                            <li><a href="#" data-href="field_649376c46650f">Account</a></li>
                            <li><a href="#" data-href="field_64937896fcd25">Introduction</a></li>
                            <li><a href="#" data-href="field_6495de7ddad20">Business details</a></li>
                            <li><a href="#" data-href="field_6493793f80bd0">Content Notes</a></li>
                            <li><a href="#" data-href="field_6494c543f63ce">Design</a></li>
                            <li><a href="#" data-href="field_6495cd17c65f2">Plugins/Other Tools</a></li>
                            <li><a href="#" data-href="field_649b12ad63fd6">Google Business Profile</a></li>
                            <li><a href="#" data-href="field_649b16d0525f6">Domain Information</a></li>
                        </ul>
                    </div>
                    <div class="intake-form-box--content">
                        <?php acfe_form('intake-form');  ?>
                    </div>
                </div>
            </div>
        </div><!-- #content -->
        <?php $icons = get_field('theme_options_general_icons', 'option'); ?>
        <?php if( $icons ) : ?>
            <div class="custom-floating-btns">
                <ul>
                    <?php foreach( $icons as $icon ): ?>
                        <li>
                            <a href="<?=( $icon['link'] );?>" <?=( $icon['open_in_new_tab'] ? 'target="_blank"' : '' );?> data-tooltip="<?= $icon['title']; ?>">
                                <?php if( $icon['icon_type'] === 'image' ) : ?>
                                    <img src="<?= wp_get_attachment_url( $icon['image'] ) ;?>" />
                                <?php else : ?> 
                                    <?=( $icon['font_awesome'] );?>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div><!-- #primary -->    

<?php
get_footer();
?>
