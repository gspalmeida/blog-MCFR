<?php
$load_more_posts = get_theme_mod( 'load_more_posts', 'no' );
$category_mod	 = get_theme_mod( 'categories' );
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content		 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$amount				 = ( isset( $instance[ 'amount' ] ) ) ? $instance[ 'amount' ] : 3; // default for this project layout
$category			 = ( isset( $instance[ 'category' ] ) ) ? $instance[ 'category' ] : 'No categories';
$words_per_excerpt	 = ( isset( $instance[ 'words_per_excerpt' ] ) ) ? $instance[ 'words_per_excerpt' ] : 10;

$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$display_date	 = isset( $instance[ 'display_date' ] ) ? $instance[ 'display_date' ] : '';
$display_author	 = isset( $instance[ 'display_author' ] ) ? $instance[ 'display_author' ] : '';
$columns_amount	 = isset( $instance[ 'columns_amount' ] ) ? $instance[ 'columns_amount' ] : '1';
if($display_author == 'checked'){
	$display_author = 'on';
}
if($display_date == 'checked'){
	$display_date = 'on'; 
}

$orderby			 = isset( $instance[ 'orderby' ] ) ? $instance[ 'orderby' ] : 'date';
$order				 = isset( $instance[ 'order' ] ) ? $instance[ 'order' ] : 'DESC';
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
$query = new WP_Query( $args ); // type = array
?>
<div class="<?php echo $box_layout;?>" id="<?php echo $widget_id; ?>">
	<!--Section: Blog v.2-->
	<section class="section extra-margins text-xs-center <?php
	if ( get_theme_mod( 'layout_type' ) == 'full' ) {
		echo 'col-md-10 offset-md-1';
	};
	?>" data-template-version="blog_template_2">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo ( $title ); ?></h1><?php } ?>
		<!--Section description-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo ( $main_content ); ?></p><?php
		}
		if ( $query->have_posts() ) {
			$counter = 0;

			while ( $query->have_posts() ) {
				$query->the_post();
				get_mdw_blog_template_2( array(
					'words_per_excerpt'	 => $words_per_excerpt,
					'category'			 => $category,
					'counter'			 => $counter,
					'animation'			 => $animation,
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
	<!--/Section: Blog v.2-->
	<div id="dataForAjaxLoadMore">
		<div data-words-per-excerpt="<?php echo $words_per_excerpt; ?>"></div>
		<div data-category="<?php echo $category; ?>"></div>
		<div data-counter="<?php echo $counter; ?>"></div>
		<div data-cols="<?php echo $columns_amount; ?>"></div>
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