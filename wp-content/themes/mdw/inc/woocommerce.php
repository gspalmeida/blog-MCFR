<?php

add_filter( 'woocommerce_sale_flash', 'woo_custom_hide_sales_flash' );

function woo_custom_hide_sales_flash() {
	return false;
}

add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' ); // 2.1 +

function woo_archive_custom_cart_button_text() {

	return __( 'Add to cart', 'woocommerce' );
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

add_filter( 'loop_shop_columns', 'loop_columns' );

if ( !function_exists( 'loop_columns' ) ) {

	/**
	 * @return int
	 */
	function loop_columns() {
		return 2; // 2 products per row
	}

}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );

/**
 * @return null
 */
function woocommerce_new_images() {
	global $pagenow;

	if ( !isset( $_GET[ 'activated' ] ) || 'themes.php' != $pagenow ) {
		return;
	}

	$catalog	 = array(
		'width'	 => '250', // px
		'height' => '170', // px
		'crop'	 => 1  // true
	);
	$single		 = array(
		'width'	 => '660', // px
		'height' => '880', // px
		'crop'	 => 1  // true
	);
	$thumbnail	 = array(
		'width'	 => '660', // px
		'height' => '880', // px
		'crop'	 => 1  // true
	);
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );  // Catalog product image
	update_option( 'shop_single_image_size', $single ); // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
}

add_action( 'after_switch_theme', 'woocommerce_new_images', 1 );

function woocommerce_template_loop_product_thumbnail_mdw() {
	echo '<div class="view overlay hm-white-slight">' . woocommerce_get_product_thumbnail() . '<div class="mask"></div></div>';
}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail_mdw', 10 );
