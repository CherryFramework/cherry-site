<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package Cherry
 */
?>

<div class="footer-area-wrap invert">
	<div class="container">
		<?php do_action( 'cherry_render_widget_area', 'footer-area' ); ?>
	</div>
</div>

<div class="footer-container">
	<div <?php echo cherry_get_container_classes( array( 'site-info' ), 'footer' ); ?>>
		<div class="site-info__flex">
			<?php cherry_footer_logo(); ?>
			<div class="site-info__mid-box"><?php
				cherry_footer_menu();
				cherry_footer_copyright();
			?></div>
			<?php cherry_social_list( 'footer' ); ?>
		</div>
	</div><!-- .site-info -->
</div><!-- .container -->