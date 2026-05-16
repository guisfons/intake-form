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
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta 
        http-equiv="Content-Type" 
        content="
            <?php bloginfo('html_type'); ?>; 
            charset=<?php bloginfo('charset'); ?>"
    />
    <meta 
        name="viewport" 
        content="width=device-width, initial-scale=1.0, user-scalable=0"
    >
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php

    /* Fonts */
    global $theme_styles_primary_font, $theme_styles_secondary_font;
    $primary_font_css_var = str_replace('+', ' ', $theme_styles_primary_font);
    $secondary_font_css_var = str_replace('+', ' ', $theme_styles_secondary_font);

    /* Colors */
    global $theme_styles_primary_color, $theme_styles_secondary_color,
    $theme_styles_third_color, $theme_styles_fourth_color, $theme_styles_fifth_color,
    $theme_styles_sixth_color, $theme_styles_body_bg_primary, 
    $theme_styles_body_bg_secondary;

    ?>
    <style type="text/css" media="screen">
        :root {
            --font-primary: '<?php echo $primary_font_css_var ; ?>', sans-serif;
            --font-secondary: '<?php echo $secondary_font_css_var ?>', sans-serif;

            --primary: <?php echo $theme_styles_primary_color; ?>;
            --secondary: <?php echo $theme_styles_secondary_color; ?>;
            --third: <?php echo $theme_styles_third_color; ?>;
            --fourth: <?php echo $theme_styles_fourth_color; ?>;
            --fifth: <?php echo $theme_styles_fifth_color; ?>;
            --sixth: <?php echo $theme_styles_sixth_color; ?>;
            
            --primary-rgb: <?php echo Hex_To_rgb($theme_styles_primary_color); ?>;
            --secondary-rgb: <?php 
            echo Hex_To_rgb(
                $theme_styles_secondary_color
            ); 
            ?>;
            --third-rgba: <?php echo Hex_To_rgb($theme_styles_third_color); ?>;
            --fifth-rgba: <?php echo Hex_To_rgb($theme_styles_fifth_color); ?>;
            --sixth-rgba: <?php echo Hex_To_rgb($theme_styles_sixth_color); ?>;

            --body-background-primary: <?php echo $theme_styles_body_bg_primary; ?>;
            --body-background-secondary: <?php 
            echo $theme_styles_body_bg_secondary; 
            ?>;
            --body-background-primary-rgb: <?php 
            echo Hex_To_rgb(
                $theme_styles_body_bg_primary
            ); 
            ?>;
            --body-background-secondary-rgb: <?php 
            echo Hex_To_rgb(
                $theme_styles_body_bg_secondary
            ); 
            ?>;
            
            --svg-check: url('<?php echo get_template_directory_uri().
            '/dist/images/svgs/check_icon.svg' ?>') no-repeat center;

        }
    </style>
    <?php wp_head(); ?>
</head>

<body <?php body_class('wpexperts-page'); ?>>
    <div class="wrapper">
        <div class="wrapper__inner">
            <?php
            $current_user = wp_get_current_user();
            $current_user_role = $current_user->roles[0];
            
            $header_enabled = true;
            $is_header_disabled = get_post_meta(
                get_the_ID(), 
                '_crb_is_page_header_enabled', 
                true
            );

            if (is_page() && $is_header_disabled == '1' ) {
                $header_enabled = false;
            }

            if ($header_enabled ) : 
                $logo = get_field('theme_options_general_header_logo', 'option');
                $sticky_logo = get_field('theme_options_general_sticky_header_logo', 'option');
                ?>
                <header>
                    <div class="site-header">
                        <div class="shell shell--fluid">
                            <div class="header--container">
                                <div class="header-logo-nav-wrapper">
                                    <div class="header--container--logo header-nav-wrapper">
                                        <a href="<?php echo (site_url());?>" class="logo--main">
                <?php echo ( wp_get_attachment_image($logo, 'full', false,  array('loading' => 'lazy')) );?>
                                        </a>
                <?php if($sticky_logo ) : ?>
                                            <a href="<?php echo (site_url());?>" class="logo--sticky">
                    <?php echo ( wp_get_attachment_image($sticky_logo, 'full', false,  array('loading' => 'lazy')) );?>
                                            </a>
                <?php endif; ?>
                                    </div>
                                    <nav class="navigation">
                                        <ul>
											<?php
											if ($current_user_role !== 'viewer') :
												?>
												<li><a href="<?php echo esc_url(home_url()); ?>">New Intake Form</a></li>
												<?php
											endif;
											?>
                                            <li><a href="<?php echo esc_url(get_post_type_archive_link('intake-form')); ?>">All Intake Forms</a></li>
                                        </ul>
                                    </nav>    
                                </div>
                                <div class="header--container--search">
                                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                                        <label class="search--input">
                                            <i class="fa-solid fa-magnifying-glass fa-fw" aria-hidden="true"></i>
                                            <input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x('Search by business name', 'placeholder', 'base-theme'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" title="<?php _ex('Enter Keyword', 'label', 'base-theme'); ?>" id="blogSearchInput">
                                        </label>
                                        <input type="hidden" class="search-submit" value="<?php echo esc_attr_x('Search', 'submit button', 'base-theme'); ?>">
                                        <button class="search-submit"><i class="fa-solid fa-arrow-right fa-fw" aria-hidden="true"></i></button>
                                    </form>
									<a href="<?php echo wp_logout_url(home_url()); ?>" class="logout-btn">Logout <span>(<?php echo esc_html($current_user->user_firstname);?>)</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            <?php endif ?>

            <?php get_template_part('fragments/hero'); ?>

            <div class="main">
