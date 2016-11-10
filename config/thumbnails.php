<?php
/**
 * Thumbnails configuration.
 *
 * @package Cherry
 */

add_action( 'after_setup_theme', 'cherry_register_image_sizes', 5 );
function cherry_register_image_sizes() {
	set_post_thumbnail_size( 370, 230, true );

	// Registers a new image sizes.
	add_image_size( 'cherry-thumb-s', 150, 150, true );
	add_image_size( 'cherry-thumb-m', 400, 400, true );
	add_image_size( 'cherry-thumb-l', 1170, 780, true );
	add_image_size( 'cherry-thumb-xl', 1920, 1080, true );
	add_image_size( 'cherry-author-avatar', 512, 512, true );
	add_image_size( 'cherry-thumb-560-350', 560, 350, true );
}
