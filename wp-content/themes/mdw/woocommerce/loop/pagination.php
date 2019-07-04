<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @version     3.3.1
 * @package     WooCommerce/Templates
 *
 * @author         WooThemes
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>
<nav id="mdb-navigation" class="text-xs-center">
	<?php
	$pages = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
		'base'		 => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
		'format'	 => '',
		'add_args'	 => false,
		'current'	 => max( 1, get_query_var( 'paged' ) ),
		'total'		 => $wp_query->max_num_pages,
		'prev_text'	 => '«',
		'next_text'	 => '»',
		'type'		 => 'array',
		'end_size'	 => 3,
		'mid_size'	 => 3
	) ) );

	if ( is_array( $pages ) ) {
		$paged = (get_query_var( 'paged' ) == 0) ? 1 : get_query_var( 'paged' );

		echo '<ul class="pagination">';

		foreach ( $pages as $page ) {

			$current_page_number = strip_tags( $page );

			$page = str_replace( 'page-numbers', 'page-link', $page );

			$page = str_replace( 'current', 'active', $page );

			if ( $current_page_number == $paged ) {
				echo "<li class='page-item active'>$page</li>";
			} else {
				echo "<li class='page-item'>$page</li>";
			}
		}

		echo '</ul>';
	}
	?>
</nav>