<?php
$load_more_posts	 = get_theme_mod( 'load_more_posts', 'no' );
$words_per_excerpt	 = $instance[ 'words_per_excerpt' ];
$category			 = ( isset( $instance[ 'category' ] ) ) ? $instance[ 'category' ] : 'No categories';
$load_more_posts	 = get_theme_mod( 'load_more_posts', 'no' );
$animation			 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$amount				 = ( isset( $instance[ 'amount' ] ) ) ? $instance[ 'amount' ] : 3; // default for this project layout
$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$display_date		 = isset( $instance[ 'display_date' ] ) ? $instance[ 'display_date' ] : '';
$display_author		 = isset( $instance[ 'display_author' ] ) ? $instance[ 'display_author' ] : '';
$box_layout			 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$columns_amount		 = ( isset( $instance[ 'columns_amount' ] ) ) ? $instance[ 'columns_amount' ] : '1';
$page_layout_type	 = get_post_meta( get_the_ID() )[ 'custom-layout-meta-box-dropdown' ][ 0 ];
if ( $page_layout_type == 'inherit' ) {
	$page_layout_type = get_theme_mod( 'layout_type' );
}
if($display_author == 'checked'){
	$display_author = 'on';
}
if($display_date == 'checked'){
	$display_date = 'on'; 
}

$orderby = isset( $instance[ 'orderby' ] ) ? $instance[ 'orderby' ] : 'date';
$order	 = isset( $instance[ 'order' ] ) ? $instance[ 'order' ] : 'DESC';

if ( !isset( $_COOKIE[ 'paginationSelect' ][ 'postID' ] ) ) {
	$_COOKIE[ 'paginationSelect' ][ 'postID' ] = array();
}
if ( $category != 'No categories' ) {
	$paged	 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args	 = array(
		'posts_per_page' => $amount,
		'cat'			 => $category,
		'orderby'		 => $orderby,
		'order'			 => $order,
		'paged'			 => $paged,
		'page'			 => $paged,
		'post__not_in'	 => $_COOKIE[ 'paginationSelect' ][ 'postID' ]
	);
} else {
	$paged	 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args	 = array(
		'posts_per_page' => $amount,
		'orderby'		 => $orderby,
		'order'			 => $order,
		'paged'			 => $paged,
		'page'			 => $paged,
		'post__not_in'	 => $_COOKIE[ 'paginationSelect' ][ 'postID' ]
	);
}
?>
<div class="<?php
if ( $page_layout_type == 'full' ) {
	echo $box_layout . '-fluid';
} else {
	echo $box_layout;
}
?>"  id="<?php echo $widget_id; ?>">
	<section data-template-version="blog_template_13" class="section classic-blog-listing <?php
	if ( get_theme_mod( 'layout_type' ) == 'full' ) {
		echo 'col-md-10 offset-md-1';
	};
	?>">
				 <?php
				 $numerek = 6467;
				 $query	 = new WP_Query( $args );
				 $counter = 0;
				 if ( $query->have_posts() ) {
					 while ( $query->have_posts() ) {
						 $query->the_post();
						 get_mdw_blog_template_13( array(
							 'words_per_excerpt'	 => $words_per_excerpt,
							 'category'			 => $category,
							 'animation'			 => $animation,
							 'counter'			 => $counter,
							 'display_date'		 => $display_date,
							 'display_author'	 => $display_author,
							 'columns_amount'	 => $columns_amount,
						 ) );
						 $counter++;
					 }
				 }

				 $numPages										 = $query->max_num_pages;
				 $stringNumPages									 = strval( $numPages );
				 $_COOKIE[ "paginationSelect" ][ "numPages" ][]	 = $stringNumPages;
				 wp_reset_postdata();
				 ?>
	</section>
	<div id="dataForAjaxLoadMore">
		<div data-words-per-excerpt="<?php echo $words_per_excerpt; ?>"></div>
		<div data-category="<?php echo $category; ?>"></div>
		<div data-amount="<?php echo $amount; ?>"></div>
		<div data-cols="<?php echo $columns_amount; ?>"></div>
		<div data-counter="<?php echo $counter; ?>"></div>
		<div data-order-by="<?php echo $orderby; ?>"></div>
		<div data-order="<?php echo $order; ?>"></div>
	</div>
	<?php
	$sidebar										 = is_active_widget( false, $this->id, 'mdw_blog', false );
	if ( $load_more_posts == 'no' ) {
		if ( strpos( $sidebar, 'sidebar' ) === false )
			mdw_pagination();
	} else {
		$total_widgets	 = wp_get_sidebars_widgets();
		$use_ajax		 = count( $total_widgets[ 'blog-homepage' ] ) >= 1 ? true : false;
		if ( $use_ajax && ( strpos( $sidebar, 'sidebar' ) === false ) )
			get_template_part( 'inc/infinite-scroll' );
	}
	?>

</div>
