<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version     3.1.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
?>
<div class="col-lg-5">
	<?php
	// do_action( 'woocommerce_product_thumbnails' );

	global $product;

	$attachment_ids = $product->get_gallery_attachment_ids();

	$gallery = array();

	$first_image = get_the_post_thumbnail_url( $post->ID, array( 660, 880 ) );

	if ( $first_image != false ) {
		array_push( $gallery, $first_image );
	}



	foreach ( $attachment_ids as $attachment_id ) {
		$image_link = wp_get_attachment_image_src( $attachment_id, array( 660, 880 ) );

		array_push( $gallery, $image_link[ 0 ] );
	}
	?>

	<?php if ( count( $gallery ) > 1 ) { ?>

		<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">

			<!--Slides-->
			<div class="carousel-inner" role="listbox">
				<?php $first = true; ?>
				<?php foreach ( $gallery as $gallery_item ) { ?>

					<div class="carousel-item<?php
					if ( $first ) {
						echo " active";
						$first = false;
					}
					?>">
						<img src="<?php echo $gallery_item; ?>" alt="Slide">
					</div>
				<?php } ?>
			</div>
			<!--/.Slides-->

			<!--Thumbnails-->
			<a class="left carousel-control" href="#carousel-thumb" role="button" data-slide="prev">
				<span class="icon-prev" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-thumb" role="button" data-slide="next">
				<span class="icon-next" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
			<!--/.Thumbnails-->

		</div>

	<?php } else { ?>
		<img src="<?php echo $gallery[ 0 ]; ?>" alt="Slide">
	<?php } ?>


</div>
