<?php

//Custom pagination
function mdw_pagination() {
	if ( is_singular() ) {
		return;
	}
	global $wp_query;
	/** Stop execution if there's only 1 page */
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}
	$paged	 = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max	 = intval( $wp_query->max_num_pages );
	/** Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}
	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	echo '<nav id="mdb-navigation" class="text-xs-center">' . "\n";
	echo '<ul class="pagination">' . "\n";
	/** Previous Post Link */
	if ( get_previous_posts_link() ) {
		printf( ' <li class="page-item">%s</li>
      ' . "\n", str_replace( '<a', '<a class="page-link"', get_previous_posts_link( '
      <span aria-hidden="true">&laquo;</span>
      <span class="sr-only">Previous</span>
      ' ) ) );
	}
	/** Link to first page, plus ellipses if necessary */
	if ( !in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="page-item active"' : ' class="page-item"';
		printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( !in_array( 2, $links ) ) {
			echo '<li class="page-item"><a class="disable-hover page-link">...</a></li>';
		}
	}
	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="page-item active"' : ' class="page-item"';
		printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}
	/** Link to last page, plus ellipses if necessary */
	if ( !in_array( $max, $links ) ) {
		if ( !in_array( $max - 1, $links ) ) {
			echo '<li class="page-item"><a class="disable-hover page-link">...</a></li>' . "\n";
		}

		$class = $paged == $max ? ' class="page-item active"' : ' class="page-item"';
		printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	/** Next Post Link */
	if ( get_next_posts_link() ) {
		printf( '<li class="page-item">%s</li>
      ' . "\n", str_replace( '<a', '<a class="page-link"', get_next_posts_link( '<span aria-hidden="true">&raquo;</span>
      <span class="sr-only">Next</span>' ) ) );
	}

	echo '</ul>' . "\n";
	echo '</nav>' . "\n";
	echo '<!--/.Pagination-->' . "\n";
}

function custom_pagination( $numpages = '', $paged = '' ) {


	/** Stop execution if there's only 1 page */
	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}
	if ( $numpages == '' ) {
		global $wp_query;
		$numpages = $wp_query->max_num_pages;
		if ( !$numpages ) {
			$numpages = 1;
		}
	}/** Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}
	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $numpages ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	echo '<nav id="mdb-navigation" class="text-xs-center">' . "\n";
	echo '<ul class="pagination">' . "\n";
	/** Previous Post Link */
	if ( get_previous_posts_link() ) {
		printf( ' <li class="page-item">%s</li>
      ' . "\n", str_replace( '<a', '<a class="page-link"', get_previous_posts_link( '
      <span aria-hidden="true">&laquo;</span>
      <span class="sr-only">Previous</span>
      ' ) ) );
	}
	/** Link to first page, plus ellipses if necessary */
	if ( !in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="page-item active"' : ' class="page-item"';
		printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( !in_array( 2, $links ) ) {
			echo '<li class="page-item"><a class="disable-hover page-link">...</a></li>';
		}
	}
	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="page-item active"' : ' class="page-item"';
		printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}
	/** Link to last page, plus ellipses if necessary */
	if ( !in_array( $numpages, $links ) ) {
		if ( !in_array( $numpages - 1, $links ) ) {
			echo '<li class="page-item"><a class="disable-hover page-link">...</a></li>' . "\n";
		}

		$class = $paged == $numpages ? ' class="page-item active"' : ' class="page-item"';
		printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $numpages ) ), $numpages );
	}
	/** Next Post Link */
	if ( get_next_posts_link() ) {
		printf( '<li class="page-item">%s</li>
      ' . "\n", str_replace( '<a', '<a class="page-link"', get_next_posts_link( '<span aria-hidden="true">&raquo;</span>
      <span class="sr-only">Next</span>' ) ) );
	}

	echo '</ul>' . "\n";
	echo '</nav>' . "\n";
	echo '<!--/.Pagination-->' . "\n";
}

function load_more_response() {
	if ( isset( $_REQUEST[ 'action' ] ) && !empty( $_REQUEST[ 'action' ] ) && $_REQUEST[ 'action' ] == 'load_more_response' ) {
		$already_loaded		 = json_decode( $_REQUEST[ 'already_in' ] );
		$template_version	 = $_REQUEST[ 'template' ];
		$args				 = array(
			'post__not_in'	 => $already_loaded,
			'showposts'		 => ( $_REQUEST[ 'column_count' ] ),
			'order'			 => ( $_REQUEST[ 'order' ] ),
			'orderby'		 => ( $_REQUEST[ 'order_by' ] ),
		);
		if ( $_REQUEST[ 'category' ] != 'No categories' ) {
			$args[ 'cat' ] = $_REQUEST[ 'category' ];
		}
		$query					 = new WP_Query( $args );
		$get_mdw_template_part	 = "get_mdw_" . $template_version;

		$template_arguments = array(
			'words_per_excerpt'	 => $_REQUEST[ 'words_per_excerpt' ], // 1, 2, 3, 4, 5, 6, 7, 8, 9
			'category'			 => $_REQUEST[ 'category' ], // 1, 2, 3, 6, 7, 8, 9
			'amount'			 => $_REQUEST[ 'amount' ], // 5, 6, 7, 8, 9
			'social_buttons'	 => $_REQUEST[ 'social_buttons' ], // 7, 8
			'share_animation'	 => $_REQUEST[ 'share_animation' ], // 7
			'counter'			 => $_REQUEST[ 'counter' ],
			'columns_amount'	 => $_REQUEST[ 'column_count' ]
		);
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$get_mdw_template_part( $template_arguments );
				$template_arguments[ 'counter' ] ++;
			}
		} else {
			echo '';
		}
	} else {
		echo '.';
	}
	die();
}

add_action( 'wp_ajax_load_more_response', 'load_more_response' );
add_action( 'wp_ajax_nopriv_load_more_response', 'load_more_response' );
?>
