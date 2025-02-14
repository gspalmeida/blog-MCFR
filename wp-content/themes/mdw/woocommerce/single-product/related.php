<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * @version     3.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;

if ( empty( $product ) || !$product->exists() ) {
	return;
}

if ( !$related = $product->get_related( $posts_per_page ) ) {
	return;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'				 => 'product',
	'ignore_sticky_posts'	 => 1,
	'no_found_rows'			 => 1,
	'posts_per_page'		 => 3,
	'orderby'				 => $orderby,
	'post__in'				 => $related,
	'post__not_in'			 => array( $product->id )
) );

$products						 = new WP_Query( $args );
$woocommerce_loop[ 'name' ]		 = 'related';
$woocommerce_loop[ 'columns' ]	 = apply_filters( 'woocommerce_related_products_columns', $columns );

if ( $products->have_posts() ) :
	?>

	<div class="related products">

		<div class="divider-new">
			<h2 class="h2-responsive"><?php _e( 'Related Products', 'mdw' ); ?></h2>
		</div>

		<?php woocommerce_product_loop_start(); ?>

		<?php global $count_products; ?>

		<?php $count_products = 1; ?>

		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

			<?php wc_get_template_part( 'content', 'product' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

	<?php
endif;

wp_reset_postdata();
