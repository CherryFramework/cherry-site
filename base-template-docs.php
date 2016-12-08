<?php get_header( cherry_template_base() ); ?>

	<?php do_action( 'cherry_render_widget_area', 'full-width-header-area' ); ?>

	<div <?php echo cherry_get_container_classes( array( 'site-content_wrap' ), 'content' ); ?>>

		<?php do_action( 'cherry_render_widget_area', 'before-content-area' ); ?>

		<div class="row">

			<div id="primary" <?php cherry_primary_content_class(); ?>>

				<?php do_action( 'cherry_render_widget_area', 'before-loop-area' ); ?>

				<main id="main" class="site-main" role="main">

					<?php include cherry_template_path(); ?>

				</main><!-- #main -->

				<?php do_action( 'cherry_render_widget_area', 'after-loop-area' ); ?>

			</div><!-- #primary -->

			<?php get_sidebar(); // Loads the sidebar.php template.  ?>

		</div><!-- .row -->

		<?php do_action( 'cherry_render_widget_area', 'after-content-area' ); ?>

	</div><!-- .container -->

	<?php do_action( 'cherry_render_widget_area', 'after-content-full-width-area' ); ?>

<?php get_footer( cherry_template_base() ); ?>