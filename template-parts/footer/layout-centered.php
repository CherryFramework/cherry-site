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
<?php
	cherry_social_list( 'footer' );
?>
<div class="footer-container">
	<div <?php echo cherry_get_container_classes( array( 'site-info' ), 'footer' ); ?>>
		<?php
			cherry_footer_logo();
			cherry_footer_copyright();
			cherry_footer_menu();
		?>
	</div><!-- .site-info -->
</div><!-- .container -->
