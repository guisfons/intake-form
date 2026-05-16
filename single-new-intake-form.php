<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php
    $current_user = wp_get_current_user();
    $current_roles = ( array ) $current_user->roles;
    $current_user_rol = $current_roles[0];
?>

    <div id="primary" class="shell">
        <h1 class="intake-form-title">
            <?php the_title(); ?> 
            <div class="status <?php echo esc_attr(get_post_status(get_the_ID()) === 'submitted' ? 'submitted' : 'progress'); ?>">
                <label><?php echo esc_html(get_post_status(get_the_ID())); ?></label>        
            </div
        ></h1>
        <?php
        if(is_user_logged_in() 
            && $current_user_rol == 'onboarding_specialist'
            && get_post_status(get_the_ID()) === 'submitted'
        ) :
            ?>
            <div class="info-notice">
                <p>Great news! The form was submitted successfully which means the information is now locked. If you'd like to make any edits please contact a form administrator.</p>
            </div>
            <?php
        endif;
        ?>
        <div class="controls">
            <button class="show-sitemap-btn" id="showSitemapBtn" data-intake-form-id="<?php echo esc_attr(get_the_ID()); ?>"><i class="fa-solid fa-sitemap fa-fw" aria-hidden="true"></i></button>
            <?php
            if (is_user_logged_in() 
                && $current_user_rol == 'administrator'
                && get_post_status(get_the_ID()) === 'submitted' 
            ) {
                ?>
            <button class="unlock-form-btn" id="unlockFormBtn" data-intake-form-id="<?php echo esc_attr(get_the_ID()); ?>"><i class="fa-solid fa-unlock" aria-hidden="true"></i></button>
                <?php
            }
            ?>
            <button id="scrollToTopBtn" class="scroll-to-top-btn"><i class="fa-solid fa-arrow-up" aria-hidden="true"></i></button>
        </div>
        <div id="content" role="main">
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="intake-form-container" data-post-status="<?php echo esc_attr(get_post_status(get_the_ID())); ?>">
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
                        <?php acfe_form('new-intake-form-update');  ?>
                    </div>
                </div>
            </div>

            <?php endwhile; ?>

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

<?php get_footer(); ?>
