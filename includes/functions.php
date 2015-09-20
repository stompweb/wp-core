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