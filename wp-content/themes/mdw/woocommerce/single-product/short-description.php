<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( !$post->post_excerpt ) {
	return;
}
?>
<div class="product-accordion accordion mb-r" id="accordion" role="tablist" aria-multiselectable="true">

	<!--First panel-->
	<div class="panel panel-default">

		<!--Panel heading-->
		<div class="panel-heading" role="tab" id="headingOne">
			<h5 class="panel-title">
				<a class="arrow-r" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?php _e( 'Description', 'mdw' ); ?> <i class="fa fa-angle-down rotate-icon rotate-element"></i></a>
			</h5>
		</div>

		<!--Panel body-->
		<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			<?php echo $post->post_excerpt; ?>
		</div>
	</div>
	<!--/.First panel-->

</div>