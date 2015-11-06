<?php
/**
 * Change admin columns for pages
 *
 * @since 0.1.0
 */
function sj_page_columns($columns) {
	unset($columns['author']); 
	unset($columns['date']); 
	unset($columns['comments']); 	
	$columns['template'] = 'Page Template';
	$columns['last_updated'] = 'Last Updated'; 	  
    return $columns;
}
add_filter('manage_edit-page_columns' , 'sj_page_columns');

/**
 * Populated new admin columns for pages
 *
 * @since 0.1.0
 */
function sj_custom_page_columns( $column, $post_id ) {
    
    switch ( $column ) {
		case 'template' :
	   	 	$page_template = get_post_meta( $post_id , '_wp_page_template' , true ); 
			$template = preg_replace("/\\.[^.\\s]{3,4}$/", "", $page_template);
			$template = str_replace("templates/","",$template);
			$template = str_replace("-"," ",$template);
			echo ucwords($template);
	    	break;
	    case 'last_updated' :
	    	$post = get_post($post_id); 
	    	echo date('d F Y - h:i:s a', strtotime($post->post_modified));
	    break;
    }
}
add_action( 'manage_page_posts_custom_column' , 'sj_custom_page_columns', 10, 2 );

/**
 * Login Logo
 *
 * @since 0.1.0
 */
function sj_login_logo() {
	$logo = get_bloginfo( 'stylesheet_directory' ) . '/images/logo.png'; ?>

    <style type="text/css">
        h1 a { 
        	background-image: url('<?php echo $logo; ?>')!important; 
       	}
    </style>'
<?php }
add_action('login_head', 'sj_login_logo');

/**
 * Make sure the logo links to your site, not WordPress.org
 *
 * @since 0.1.0
 */
function sj_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'sj_login_logo_url' );

/**
 * Remove link to images in WP Editor
 *
 * @since 0.1.0
 */
function sj_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );
    
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'sj_imagelink_setup', 10);

/**
 * Remove emoji support
 *
 * @since 0.1.0
 */
function disable_wp_emojicons() {

	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );