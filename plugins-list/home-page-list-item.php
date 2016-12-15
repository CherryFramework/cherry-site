<?php
/**
 * Template part for displaying plugins listing
 */

/**
 * Hook fires before item wrapper started.
 */
do_action( 'cherry_site_plugins_before_item', 'list-item' );
?>
<div class="plugins-list-item col-sm-12 col-md-6">
	<div class="inner">
		<div class="plugins-list-item__thumb"><?php
			echo $this->plugin_thumb( $plugin, 'icon-256x256', 'plugins-list-item__thumb-image' );
		?></div>
		<div class="plugins-list-item__info">
			<?php
				$plugin_link = esc_url( 'https://wordpress.org/plugins/' . $plugin->slug );
			?>
			<h5 class="plugins-list-item__title"><a href="<?php echo $plugin_link;?>"><?php echo $plugin->name; ?></a></h5>
			<div class="plugins-list-item__ver">
			<?php
				echo sprintf( '%1$s: <span>%2$s</span>', esc_html__( 'Version', 'cherry' ), $plugin->version );
			?>
			</div>
			<div class="plugins-list-item__content"><?php echo $plugin->short_description; ?></div>
			<div class="plugins-list-item__rating" data-rating="<?php echo $plugin->rating; ?>"></div>
			<div class="plugins-list-item__downloads">
			<?php
				echo sprintf( '%1$s: <span>%2$s</span>', esc_html__( 'Downloads', 'cherry' ), $plugin->downloaded );
			?>
			</div>
			<div class="plugins-list-item__actions">
				<a href="<?php echo $plugin->download_link; ?>" class="plugins-list-item__link btn btn-primary"><?php
					echo esc_html( $atts['download_text'] );
				?></a>
			</div>
		</div>
	</div>
</div>
<?php
/**
 * Hook fires after item wrapper ended.
 */
do_action( 'cherry_site_plugins_after_item', 'list-item' );
