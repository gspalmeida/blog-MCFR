<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || !$product->is_visible() ) {
	return;
}
?>

<li <?php post_class(); ?>>

	<?php
	$ecommerce_layout = get_theme_mod( 'ecommerce_layout', 'cards' );

	if ( $ecommerce_layout == 'cards' ) {
		get_template_part( 'woocommerce/content', 'cards' );
	} elseif ( $ecommerce_layout == 'cards-narrower' ) {
		get_template_part( 'woocommerce/content', 'cards-narrower' );
	} elseif ( $ecommerce_layout == 'cards-wider' ) {
		get_template_part( 'woocommerce/content', 'cards-wider' );
	} else {
		get_template_part( 'woocommerce/content', 'list' );
	}
	?>

</li>

<?php global $count_products; ?>

<?php if ( $count_products % 2 == 0 ) { ?>

	</ul>
	<ul class="products <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">

	<?php } ?>

	<?php $count_products++; ?>