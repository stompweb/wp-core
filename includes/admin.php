<?php

/**
 * Disallow file editing
 *
 * @since 0.1.0
 */
define('DISALLOW_FILE_EDIT', true);

/**
 * Keep more post revisions
 *
 * @since 0.1.0
 */
define( 'WP_POST_REVISIONS', 10 );

/**
 * Remove dashboard widgets
 *
 * @since 0.1.0
 */
function sj_remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);		

}
add_action('wp_dashboard_setup', 'sj_remove_dashboard_widgets' );

/**
 * Remove clutter from edit post screen
 *
 * @since 0.1.0
 */
function sj_remove_meta_boxes() {
	remove_meta_box( 'tagsdiv-post_tag','post','normal' );
	remove_meta_box( 'postcustom', 'post' , 'normal' ); 
	remove_meta_box( 'postcustom', 'page' , 'normal' ); 
	remove_meta_box( 'trackbacksdiv', 'post' , 'normal' );
	remove_meta_box( 'trackbacksdiv', 'page' , 'normal' );
	remove_meta_box( 'slugdiv','post','normal' ); 
	remove_meta_box( 'slugdiv','page','normal' );
}
add_action( 'admin_menu' , 'sj_remove_meta_boxes' );

/**
 * Remove comments & tags from the Admin Menu
 *
 * @since 0.1.0
 */
function sj_remove_menu_pages() {
	remove_menu_page('edit-comments.php');
	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}
add_action( 'admin_menu', 'sj_remove_menu_pages' );

/**
 * Reorder items in Admin menu
 *
 * @since 0.1.0
 */
function sj_custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;
       return array(
        'index.php',                 		
        'edit.php?post_type=page', 
        'edit.php',
                     
    );
}
add_filter('custom_menu_order', 'sj_custom_menu_order');
add_filter('menu_order', 'sj_custom_menu_order');

/**
 * Reorder items in Admin menu
 *
 * @since 0.1.0
 */
add_filter( 'wpseo_use_page_analysis', '__return_false' );

/**
 * Ensure that SEO by Yoast metabox is below all custom meta boxes
 *
 * @since 0.1.0
 */
add_filter( 'wpseo_metabox_prio', 'low' ); 

/**
 * Ensure that SEO by Yoast metabox is below all ACF metaboxes
 *
 * @since 0.1.0
 */
function sj_relegate_yoast_meta() { ?>

	<script type="text/javascript">
	
		(function($) {
			$(document).ready(function(){
				$('#wpseo_meta').insertAfter('#normal-sortables');
			});
		})(jQuery);

	</script>
	
<?php 
}
add_action('admin_footer', 'sj_relegate_yoast_meta');