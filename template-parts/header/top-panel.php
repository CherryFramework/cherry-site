<?php
/**
 * Template part for top panel in header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cherry
 */

// Don't show top panel if all elements are disabled.
if ( ! cherry_is_top_panel_visible() ) {
	return;
} ?>

<div class="top-panel">
	<div <?php echo cherry_get_container_classes( array( 'top-panel__wrap' ), 'header' ); ?>><?php
		cherry_top_message( '<div class="top-panel__message">%s</div>' );
		cherry_top_search( '<div class="top-panel__search">%s</div>' );
		cherry_top_menu();
	?></div>
</div><!-- .top-panel -->