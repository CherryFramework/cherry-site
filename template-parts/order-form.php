<?php
/**
 * Order Popup with form.
 *
 * @package Cherry
 */
?>

<section id="cherry-orderpopup" class="cherry-order-popup">
	<div class="cherry-order-popup__overlay"></div>
	<div class="cherry-order-popup__container container-fill-color-type">
		<div class="cherry-order-popup__container-inner">
			<span id="cherry-orderpopup-close" class="cherry-order-popup__close">&#215;</span>
			<h1 class="cherry-order-popup__title"><?php echo esc_html__( 'Order Details', 'cherry' ); ?></h1>
			<div class="cherry-order-popup__content">
				<?php echo do_shortcode( '[contact-form-7 id="95" title="Order Form"]' ); ?>
			</div>
		</div>
	</div>
</section>
