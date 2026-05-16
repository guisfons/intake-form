<?php 
/**
 * The header for our theme
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$hero_img = get_field('theme_options_general_hero_image', 'option');
$style = 'style="background-image: url('.wp_get_attachment_url( $hero_img ).')"';
?>
<div class="hero--container" <?=( $style );?>>
    <div class="shell">
        <div class="hero--content">
            <div class="hero--content--text">
                <?php
                    if ( is_page_template( 'templates/page-new-intake-form.php' ) ) {
                        ?>
                        <h1>Create Intake Form</h1>
                        <a href="#acf-intake-form">
                            <span>Start a new form</span>
                            <i class="fa-solid fa-arrow-down fa-fw" aria-hidden="true"></i>
                        </a>
                        <?php
                    } else if ( is_post_type_archive( 'intake-form' ) || is_author() || is_search() ) {
                        ?>
                        <h1>Intake Form Library</h1>
                        <a href="#section-intake-form-page">
                            <span>Review Intake Forms</span>
                            <i class="fa-solid fa-arrow-down fa-fw" aria-hidden="true"></i>
                        </a>
                        <?php
                    } else if ( is_single() ) {
                        ?>
                        <h1><?php the_title();?></h1>
                        <a href="#section-intake-form-page">
                            <span>Review Intake Form</span>
                            <i class="fa-solid fa-arrow-down fa-fw" aria-hidden="true"></i>
                        </a>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>