<?php
/**
 * Menus configuration.
 *
 * @package Cherry
 */

add_action( 'after_setup_theme', 'cherry_register_menus', 5 );
function cherry_register_menus() {

	register_nav_menus( array(
		'top'    => esc_html__( 'Top', 'cherry' ),
		'main'   => esc_html__( 'Main', 'cherry' ),
		'footer' => esc_html__( 'Footer', 'cherry' ),
		'social' => esc_html__( 'Social', 'cherry' ),
	) );
}
