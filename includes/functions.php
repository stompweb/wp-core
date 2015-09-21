<?php

/**
 * Return the slug from a post. Use within the loop.
 *
 * @since 0.1.0
 */
function get_the_slug() {
	$slug = basename(get_permalink());
	return $slug;
}

/**
 * Display the slug from a post. Use within the loop.
 *
 * @since 0.1.0
 */
function the_slug() {
	echo get_the_slug();
}

/**
 * Unregister a post type
 *
 * @since 0.1.0
 */
function unregister_post_type( $post_type ) {
	global $wp_post_types;
	if ( isset( $wp_post_types[ $post_type ] ) ) {
		unset( $wp_post_types[ $post_type ] );
		return true;
	}
	return false;
}