<?php
$category = get_theme_mod( 'categories' );

$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

$left_amount			 = ( isset( $instance[ 'left_amount' ] ) ) ? $instance[ 'left_amount' ] : 3; // default for this project layout
$left_category			 = ( isset( $instance[ 'left_category' ] ) ) ? $instance[ 'left_category' ] : 'No categories';
$left_words_per_excerpt	 = ( isset( $instance[ 'left_words_per_excerpt' ] ) ) ? $instance[ 'left_words_per_excerpt' ] : 10;

$left_icon			 = ( isset( $instance[ 'left_icon' ] ) ) ? $instance[ 'left_icon' ] : '';
$left_icon_container = ( isset( $instance[ 'left_icon_container' ] ) ) ? $instance[ 'left_icon_container' ] : '';
$left_icon_color	 = ( isset( $instance[ 'left_icon_color' ] ) ) ? $instance[ 'left_icon_color' ] : '';

if ( $left_category != 'No categories' ) {
	$left_args = array( 'numberposts' => $left_amount, 'cat' => $left_category );
} else {
	$left_args = array( 'numberposts' => $left_amount );
}
$left_recent_posts = wp_get_recent_posts( $left_args ); // type = array

if ( count( $left_recent_posts ) < $left_amount ) {
	$left_amount = count( $left_recent_posts );
}



$middle_amount				 = ( isset( $instance[ 'middle_amount' ] ) ) ? $instance[ 'middle_amount' ] : 3; // default for this project layout
$middle_category			 = ( isset( $instance[ 'middle_category' ] ) ) ? $instance[ 'middle_category' ] : 'No categories';
$middle_words_per_excerpt	 = ( isset( $instance[ 'middle_words_per_excerpt' ] ) ) ? $instance[ 'middle_words_per_excerpt' ] : 10;

$middle_icon			 = ( isset( $instance[ 'middle_icon' ] ) ) ? $instance[ 'middle_icon' ] : '';
$middle_icon_container	 = ( isset( $instance[ 'middle_icon_container' ] ) ) ? $instance[ 'middle_icon_container' ] : '';
$middle_icon_color		 = ( isset( $instance[ 'middle_icon_color' ] ) ) ? $instance[ 'middle_icon_color' ] : '';

if ( $middle_category != 'No categories' ) {
	$middle_args = array( 'numberposts' => $middle_amount, 'cat' => $middle_category );
} else {
	$middle_args = array( 'numberposts' => $middle_amount );
}
$middle_recent_posts = wp_get_recent_posts( $middle_args ); // type = array

if ( count( $middle_recent_posts ) < $middle_amount ) {
	$middle_amount = count( $middle_recent_posts );
}



$right_amount			 = ( isset( $instance[ 'right_amount' ] ) ) ? $instance[ 'right_amount' ] : 3; // default for this project layout
$right_category			 = ( isset( $instance[ 'right_category' ] ) ) ? $instance[ 'right_category' ] : 'No categories';
$right_words_per_excerpt = ( isset( $instance[ 'right_words_per_excerpt' ] ) ) ? $instance[ 'right_words_per_excerpt' ] : 10;

$right_icon				 = ( isset( $instance[ 'right_icon' ] ) ) ? $instance[ 'right_icon' ] : '';
$right_icon_container	 = ( isset( $instance[ 'right_icon_container' ] ) ) ? $instance[ 'right_icon_container' ] : '';
$right_icon_color		 = ( isset( $instance[ 'right_icon_color' ] ) ) ? $instance[ 'right_icon_color' ] : '';

if ( $right_category != 'No categories' ) {
	$right_args = array( 'numberposts' => $right_amount, 'cat' => $right_category );
} else {
	$right_args = array( 'numberposts' => $right_amount );
}
$right_recent_posts = wp_get_recent_posts( $right_args ); // type = array

if ( count( $right_recent_posts ) < $right_amount ) {
	$right_amount = count( $right_recent_posts );
}


for ( $i = 1; $i <= $left_amount; $i++ ) {

	${"left_title_" . $i}		 = $left_recent_posts[ $i - 1 ][ 'post_title' ];
	${"left_content_" . $i}		 = $left_recent_posts[ $i - 1 ][ 'post_content' ];
	${"left_image_" . $i}		 = wp_get_attachment_url( get_post_thumbnail_id( $left_recent_posts[ $i - 1 ][ 'ID' ] ) );
	${"left_url_" . $i}			 = get_post_permalink( $left_recent_posts[ $i - 1 ][ 'ID' ] );
	${"left_date_ID_" . $i}		 = $left_recent_posts[ $i - 1 ][ 'ID' ];
	${"left_author_" . $i}		 = $left_recent_posts[ $i - 1 ][ 'post_author' ];
	${"left_categories_" . $i}	 = implode( ", ", wp_get_post_categories( $left_recent_posts[ $i - 1 ][ 'ID' ], array( 'fields' => 'names' ) ) );
}

$left_excerpt_1 = excerpt( ${"left_content_1"}, $left_words_per_excerpt );

for ( $i = 1; $i <= $middle_amount; $i++ ) {

	${"middle_title_" . $i}		 = $middle_recent_posts[ $i - 1 ][ 'post_title' ];
	${"middle_content_" . $i}	 = $middle_recent_posts[ $i - 1 ][ 'post_content' ];
	${"middle_image_" . $i}		 = wp_get_attachment_url( get_post_thumbnail_id( $middle_recent_posts[ $i - 1 ][ 'ID' ] ) );
	${"middle_url_" . $i}		 = get_post_permalink( $middle_recent_posts[ $i - 1 ][ 'ID' ] );
	${"middle_date_ID_" . $i}	 = $middle_recent_posts[ $i - 1 ][ 'ID' ];
	${"middle_author_" . $i}	 = $middle_recent_posts[ $i - 1 ][ 'post_author' ];
	${"middle_categories_" . $i} = implode( ", ", wp_get_post_categories( $middle_recent_posts[ $i - 1 ][ 'ID' ], array( 'fields' => 'names' ) ) );
}

$middle_excerpt_1 = excerpt( ${"middle_content_1"}, $middle_words_per_excerpt );

for ( $i = 1; $i <= $right_amount; $i++ ) {

	${"right_title_" . $i}		 = $right_recent_posts[ $i - 1 ][ 'post_title' ];
	${"right_content_" . $i}	 = $right_recent_posts[ $i - 1 ][ 'post_content' ];
	${"right_image_" . $i}		 = wp_get_attachment_url( get_post_thumbnail_id( $right_recent_posts[ $i - 1 ][ 'ID' ] ) );
	${"right_url_" . $i}		 = get_post_permalink( $right_recent_posts[ $i - 1 ][ 'ID' ] );
	${"right_date_ID_" . $i}	 = $right_recent_posts[ $i - 1 ][ 'ID' ];
	${"right_author_" . $i}		 = $right_recent_posts[ $i - 1 ][ 'post_author' ];
	${"right_categories_" . $i}	 = implode( ", ", wp_get_post_categories( $right_recent_posts[ $i - 1 ][ 'ID' ], array( 'fields' => 'names' ) ) );
}

$right_excerpt_1 = excerpt( ${"right_content_1"}, $right_words_per_excerpt );
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Magazine v.3-->
	<section class="section magazine-section multi-columns">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title ?></h1><?php } ?>

		<!--Section sescription-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content ?></p><?php } ?>

		<!--First row-->
		<div class="row">

			<!--First column-->
			<div class="col-lg-4 col-md-6 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

				<!--Featured news-->
				<div class="single-news">

					<!--Image-->
					<?php
                    $category    = get_theme_mod( 'categories' );
					$categories	 = get_the_category( ${"left_date_ID_1"}    );			// get the categories for current post in the LOOP (array)
					$cat		 = $categories[ 0 ];				  // selects first of the categories
					$icons		 = get_mdw_category( $cat, $category );
					?>

					<a href="<?php echo $icons[ "url" ]; ?>"><h5 style="color:<?php echo $icons[ "color" ]; ?>"><i class="<?php echo $icons[ "icon" ]; ?>"></i>&nbsp;<?php echo $icons[ "name" ]; ?></h5></a>

					<div class="view overlay hm-white-slight">
                        <a href="<?php echo ${"left_url_1"}; ?>">
							<img src="<?php echo ${"left_image_1"}; ?>">
							<?php
							if ( ${"left_image_1"} == null ) {
								print_default_image();
							}
							?>
							<div class="mask"></div>
                        </a>
					</div>
					<a class="text" href="<?php echo ${"left_url_1"}; ?>"><strong><?php echo ${"left_title_1"}; ?></strong>
						<span><i class="fa fa-angle-right"></i></span>
					</a>

				</div>
				<!--/Featured news-->


				<?php for ( $i = 2; $i <= $left_amount; $i++ ) { ?>

				  <!--<?php echo $i; ?> row-->
					<div class="single-news">
						<a class="text" href="<?php echo ${"left_url_" . $i}; ?>"><?php echo ${"left_title_" . $i}; ?>
							<span><i class="fa fa-angle-right"></i></span>
						</a>
					</div>
		  <!--/<?php echo $i; ?> row-->

					<?php if ( $i != $left_amount ) { ?> <hr> <?php } ?>

				<?php } ?>

			</div>
			<!--/First column-->

			<hr>

			<!--Second column-->
			<div class="col-lg-4 col-md-6 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

				<!--Featured news-->
				<div class="single-news">

					<!--Image-->
					<?php
					$categories	 = get_the_category( ${"middle_date_ID_1"} );   // get the categories for current post in the LOOP (array)
					$cat		 = $categories[ 0 ];   // selects first of the categories
					$id			 = $cat->term_id;
					$slug		 = $cat->slug;  // gets category id for $url and for select to wpdb
					$url		 = get_category_link( $id );
					if ( array_key_exists( 'color', $category[ $slug ] ) ) {
						$color = $category[ $slug ][ 'color' ];
					} else {
						$color = "#607d8b";
					}
					if ( array_key_exists( 'icon', $category[ $slug ] ) ) {
						$icon = $category[ $slug ][ 'icon' ];
					} else {
						$icon = "fa fa-font-awesome";
					}
					if ( array_key_exists( 'cat_name', $category[ $slug ] ) ) {
						$name = $category[ $slug ][ 'cat_name' ];
					} else {
						$name = "";
					}
					?>
					<a href="<?php echo $url; ?>"><h5 style="color:<?php echo $color; ?>"><i class="<?php echo $icon; ?>"></i><?php echo $name; ?></h5></a>

					<div class="view overlay hm-white-slight">
						<img src="<?php echo ${"middle_image_1"}; ?>">
						<a href="<?php echo ${"middle_url_1"}; ?>">
							<div class="mask"></div>
						</a>
					</div>

					<a class="text" href="<?php echo ${"middle_url_1"}; ?>"><strong><?php echo ${"middle_title_1"}; ?></strong>
						<span><i class="fa fa-angle-right"></i></span>
					</a>

				</div>
				<!--/Featured news-->

				<?php for ( $i = 2; $i <= $middle_amount; $i++ ) { ?>

				  <!--<?php echo $i; ?> row-->
					<div class="single-news">
						<a class="text" href="<?php echo ${"middle_url_" . $i}; ?>"><?php echo ${"middle_title_" . $i}; ?>
							<span><i class="fa fa-angle-right"></i></span>
						</a>
					</div>
		  <!--/<?php echo $i; ?> row-->

					<?php if ( $i != $middle_amount ) { ?> <hr> <?php } ?>

				<?php } ?>

			</div>
			<!--/Second column-->

			<hr>

			<!--Third column-->
			<div class="col-lg-4 col-md-6 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

				<!--Featured news-->
				<div class="single-news">

					<!--Image-->
					<?php
					$categories	 = get_the_category( ${"right_date_ID_1"} );   // get the categories for current post in the LOOP (array)
					$cat		 = $categories[ 0 ];   // selects first of the categories
					$id			 = $cat->term_id;
					$slug		 = $cat->slug;  // gets category id for $url and for select to wpdb
					$url		 = get_category_link( $id );
					if ( array_key_exists( 'color', $category[ $slug ] ) ) {
						$color = $category[ $slug ][ 'color' ];
					} else {
						$color = "#607d8b";
					}
					if ( array_key_exists( 'icon', $category[ $slug ] ) ) {
						$icon = $category[ $slug ][ 'icon' ];
					} else {
						$icon = "fa fa-font-awesome";
					}
					if ( array_key_exists( 'cat_name', $category[ $slug ] ) ) {
						$name = $category[ $slug ][ 'cat_name' ];
					} else {
						$name = "";
					}
					?>
					<a href="<?php echo $url; ?>"><h5 style="color:<?php echo $color; ?>"><i class="<?php echo $icon; ?>"></i><?php echo $name; ?></h5></a>

					<div class="view overlay hm-white-slight">
						<img src="<?php echo ${"right_image_1"}; ?>">
						<a href="<?php echo ${"right_url_1"}; ?>">
							<div class="mask"></div>
						</a>
					</div>

					<a class="text" href="<?php echo ${"right_url_1"}; ?>"><strong><?php echo ${"right_title_1"}; ?></strong>
						<span><i class="fa fa-angle-right"></i></span>
					</a>

				</div>
				<!--/Featured news-->

				<?php for ( $i = 2; $i <= $right_amount; $i++ ) { ?>

				  <!--<?php echo $i; ?> row-->
					<div class="single-news">
						<a class="text" href="<?php echo ${"right_url_" . $i}; ?>"><?php echo ${"right_title_" . $i}; ?>
							<span><i class="fa fa-angle-right"></i></span>
						</a>
					</div>
		  <!--/<?php echo $i; ?> row-->

					<?php if ( $i != $right_amount ) { ?> <hr> <?php } ?>

				<?php } ?>

			</div>
			<!--/Third column-->

		</div>
		<!--/First row-->

	</section>
	<!--/Section: Magazine v.3-->
</div>
