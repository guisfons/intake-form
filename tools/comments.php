<?php
 /**
  * Renders a single comments; Called for each comment
  *
  * PHP version 8
  *
  * @category Themes
  * @package  Theme_Acf
  * @author   Product Developers <productdev@ollyolly.com>
  * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
  * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
  */

/**
 * Render Comment
 *
 * @param $comment Comments
 * @param $args    Arguments
 * @param $depth   Depth
 *
 * @return void
 */
function Render_comment( $comment, $args, $depth )
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment__entry">
            <div class="comment__author vcard">
                <?php echo get_avatar(
                    $comment, 
                    48, 
                    '', 
                    '', 
                    [ 'class' => "comment__author-avatar" ]
                ); ?>
                <?php comment_author_link(); ?>
                <span class="comment__author-says">
                <?php _e('says:', 'theme-acf'); ?>
                </span>
            </div><!-- /.comment__author -->

    <?php if ($comment->comment_approved === '0' ) : ?>
        <em class="moderation-notice">
        <?php _e('Your comment is awaiting moderation.', 'theme-acf'); ?>
        </em><br />
    <?php endif; ?>

            <div class="comment__meta">
                <a href="
                    <?php 
                    echo htmlspecialchars(get_comment_link($comment->comment_ID)); 
                    ?>">
                    <?php printf(
                        __('%1$s at %2$s', 'theme-acf'), 
                        get_comment_date(), 
                        get_comment_time()
                    ); ?>
                </a>

                <?php edit_comment_link(__('(Edit)', 'theme-acf'), '  ', ''); ?>
            </div><!-- /.comment__meta -->

            <div class="comment__text">
                <?php comment_text(); ?>
            </div><!-- /.comment__text -->

            <div class="comment__reply">
                <?php
                comment_reply_link(
                    array_merge(
                        $args, array(
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth']
                        ) 
                    ) 
                );
                ?>
            </div><!-- /.comment__reply -->
        </div><!-- /.comment__entry -->
    <?php
}

/**
 * Disable support for comments and trackbacks in post types
 *
 * @return void
 */
function Disable_Comments_Post_Types_support()
{
    $post_types = get_post_types();
    foreach ( $post_types as $post_type ) {
        if (post_type_supports($post_type, 'comments') ) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'Disable_Comments_Post_Types_support');

/**
 * Close comments on the front-end
 *
 * @return bool
 */
function Disable_Comments_status()
{
    return false;
}
add_filter('comments_open', 'Disable_Comments_status', 20);
add_filter('pings_open', 'Disable_Comments_status', 20);

/**
 * Hide existing comments
 *
 * @param $comments Comments
 *
 * @return array
 */
function Disable_Comments_Hide_Existing_comments( $comments )
{
    return array();
}
add_filter('comments_array', 'Disable_Comments_Hide_Existing_comments');

/**
 * Remove comments page in menu
 *
 * @return void
 */
function Disable_Comments_Admin_menu()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'Disable_Comments_Admin_menu');

/**
 * Redirect any user trying to access comments page
 *
 * @return void
 */
function Disable_Comments_Admin_Menu_redirect()
{
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url('/'));
        exit;
    }
}
add_action('admin_init', 'Disable_Comments_Admin_Menu_redirect');

/**
 * Remove comments metabox from dashboard
 *
 * @return void
 */
function Disable_Comments_dashboard()
{
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'Disable_Comments_dashboard');

/**
 * Remove comments links from admin bar
 *
 * @return void
 */
function Disable_Comments_Admin_bar()
{
    if (is_admin_bar_showing() ) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'Disable_Comments_Admin_bar');
