<?php
/**
 * Template Name: Page New Intake Form
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
            <button class="show-sitemap-btn" id="showSitemapBtn"><i class="fa-solid fa-sitemap fa-fw" aria-hidden="true"></i></button>
            <button id="scrollToTopBtn" class="scroll-to-top-btn"><i class="fa-solid fa-arrow-up" aria-hidden="true"></i></button>
        </div>
        <div id="content" class="site-content" role="main">
            <div class="intake-form-container">
                <?php get_template_part('template-parts/new-sticky-menu');  ?>
                <div class="intake-form-box">
                    <div class="intake-form-box--menu">
                        <ul class="menu-list">
                            <li><a href="#" data-href="all" class="active">All</a></li>
                            <li><a href="#" data-href="field_6812442cb2949">Pre-Call Information</a></li>
                            <li><a href="#" data-href="field_6812442cb2987">Getting to Know the Client/ Business</a></li>
                            <li><a href="#" data-href="field_6812442cb29c4">Google Business Profile</a></li>
                            <li><a href="#" data-href="field_6812442cb2a3e">Website Service Pages + Build</a></li>
                            <li><a href="#" data-href="field_6818e3bb803bf">Website Design</a></li>
                            <li><a href="#" data-href="field_6812442cb2af6">Domain + Access</a></li>
                            <li><a href="#" data-href="field_6818eb66381ec">NAP Information</a></li>
                        </ul>
                    </div>
                    <div class="intake-form-box--content">
                        <?php acfe_form('new-intake-form');  ?>
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
