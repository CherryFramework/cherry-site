<?php
/**
 * Template part for minimal Header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cherry
 */
?>

<div class="header-container__flex">
	<?php cherry_social_list( 'header' ); ?>
	<div class="site-branding">
		<?php cherry_header_logo() ?>
		<?php cherry_site_description(); ?>
	</div>
	<?php cherry_main_menu(); ?>
	<?php cherry_menu_toggle( 'main-menu' ); ?>
</div>
