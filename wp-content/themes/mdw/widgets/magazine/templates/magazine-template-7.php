<?php
$category = get_theme_mod( 'categories' );

$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$what_to_feed	 = ( isset( $instance[ 'what_to_feed' ] ) ) ? $instance[ 'what_to_feed' ] : 'posts';

$left_amount			 = ( isset( $instance[ 'left_amount' ] ) ) ? $instance[ 'left_amount' ] : 3; // default for this project layout
$left_category			 = ( isset( $instance[ 'left_category' ] ) ) ? $instance[ 'left_category' ] : 'No categories';
$left_words_per_excerpt	 = ( isset( $instance[ 'left_words_per_excerpt' ] ) ) ? $instance[ 'left_words_per_excerpt' ] : 10;

$left_icon			 = ( isset( $instance[ 'left_icon' ] ) ) ? $instance[ 'left_icon' ] : '';
$left_icon_container = ( isset( $instance[ 'left_icon_container' ] ) ) ? $instance[ 'left_icon_container' ] : '';
$left_icon_color	 = ( isset( $instance[ 'left_icon_color' ] ) ) ? $instance[ 'left_icon_color' ] : '';

$b_color	 = ( isset( $instance[ 'b_color' ] ) ) ? $instance[ 'b_color' ] : "";
$b_color_1	 = ( isset( $instance[ 'b_color_1' ] ) ) ? $instance[ 'b_color_1' ] : "";
$b_color_2	 = ( isset( $instance[ 'b_color_2' ] ) ) ? $instance[ 'b_color_2' ] : "";

$title	 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : "";
$title_1 = ( isset( $instance[ 'title_1' ] ) ) ? $instance[ 'title_1' ] : "";
$title_2 = ( isset( $instance[ 'title_2' ] ) ) ? $instance[ 'title_2' ] : "";

$title_url	 = ( isset( $instance[ 'title_url' ] ) ) ? $instance[ 'title_url' ] : "";
$title_url_1 = ( isset( $instance[ 'title_url_1' ] ) ) ? $instance[ 'title_url_1' ] : "";
$title_url_2 = ( isset( $instance[ 'title_url_2' ] ) ) ? $instance[ 'title_url_2' ] : "";

$text	 = ( isset( $instance[ 'text' ] ) ) ? $instance[ 'text' ] : "";
$image_1 = ( isset( $instance[ 'image_1' ] ) ) ? $instance[ 'image_1' ] : "";
$image_2 = ( isset( $instance[ 'image_2' ] ) ) ? $instance[ 'image_2' ] : "";

$image_url	 = ( isset( $instance[ 'image_url' ] ) ) ? $instance[ 'image_url' ] : "";
$image_url_1 = ( isset( $instance[ 'image_url_1' ] ) ) ? $instance[ 'image_url_1' ] : "";
$image_url_2 = ( isset( $instance[ 'image_url_2' ] ) ) ? $instance[ 'image_url_2' ] : "";

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
	${"left_categories_" . $i}	 = implode( ", ", wp_get_post_categories( $left_recent_posts[ $i - 1 ][ 'ID' ], array( 'fields' => 'names' ) ) );
}

$left_excerpt_1 = excerpt( ${"left_content_1"}, $left_words_per_excerpt );

for ( $i = 1; $i <= $middle_amount; $i++ ) {

	${"middle_title_" . $i}		 = $middle_recent_posts[ $i - 1 ][ 'post_title' ];
	${"middle_image_" . $i}		 = wp_get_attachment_url( get_post_thumbnail_id( $middle_recent_posts[ $i - 1 ][ 'ID' ] ) );
	${"middle_url_" . $i}		 = get_post_permalink( $middle_recent_posts[ $i - 1 ][ 'ID' ] );
	${"middle_date_ID_" . $i}	 = $middle_recent_posts[ $i - 1 ][ 'ID' ];
	${"middle_categories_" . $i} = implode( ", ", wp_get_post_categories( $middle_recent_posts[ $i - 1 ][ 'ID' ], array( 'fields' => 'names' ) ) );
}


for ( $i = 1; $i <= $right_amount; $i++ ) {

	${"right_title_" . $i}		 = $right_recent_posts[ $i - 1 ][ 'post_title' ];
	${"right_image_" . $i}		 = wp_get_attachment_url( get_post_thumbnail_id( $right_recent_posts[ $i - 1 ][ 'ID' ] ) );
	${"right_url_" . $i}		 = get_post_permalink( $right_recent_posts[ $i - 1 ][ 'ID' ] );
	${"right_date_ID_" . $i}	 = $right_recent_posts[ $i - 1 ][ 'ID' ];
	${"right_categories_" . $i}	 = implode( ", ", wp_get_post_categories( $right_recent_posts[ $i - 1 ][ 'ID' ], array( 'fields' => 'names' ) ) );
}
?>

<div class="<?php echo $box_layout; ?> mt-1" id="<?php echo $widget_id; ?>"  >
	<div class=" <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
		<?php if ( $what_to_feed == 'custom' ) { ?>
			<div class="content-block">
				<div class="content-bleed">
					<section class="hero-three-items">
						<article class="hero-block primary" style="background-color: <?php echo $b_color ?>">
							<a aria-hidden="true" class="img-link bdd-first-article-link" style="background-image: url(<?php echo $image ?>)" href="<?php echo $image_url ?>">
								<?php echo $title ?>
							</a>
							<div class="text-box" style="background-color: <?php echo $b_color ?>">
								<h2>
									<a class="c3" href="<?php echo $title_url ?>">
										<?php echo $title ?>
									</a>
								</h2>
								<p class="secondary-text description c4">
									<?php echo $text ?>
								</p>
							</div>
						</article>
						<article class="hero-block secondary" style="background-color: <?php echo $b_color_1 ?>">
							<a aria-hidden="true" class="img-link bdd-first-article-link" style="background-image: url(<?php echo $image_1 ?>)" href="<?php echo $image_url_1 ?>">
								<?php echo $title_1 ?>
							</a>
							<div class="text-box" style="background-color: <?php echo $b_color_1 ?>">
								<h4>
									<a class="c3" href="<?php echo $title_url_1 ?>">
										<?php echo $title_1 ?>

									</a>
								</h4>
							</div>
						</article>
						<article class="hero-block secondary" style="background-color: <?php echo $b_color_2 ?>">
							<a aria-hidden="true" class="img-link bdd-first-article-link" style="background-image: url(<?php echo $image_2 ?>)" href="<?php echo $image_url_2 ?>">
								<?php echo $title_2 ?>
							</a>
							<div class="text-box" style="background-color: <?php echo $b_color_2 ?>">
								<h4>
									<a class="c3" href="<?php echo $title_url_2 ?>">
										<?php echo $title_2 ?>
									</a>
								</h4>
							</div>
						</article>
					</section>
				</div>
			</div>
			<!-- twoj kod -->
		<?php } else { ?>

			<div class="content-block">
				<div class="content-bleed">
					<section class="hero-three-items">
						<?php
						$categories	 = get_the_category( ${"left_date_ID_1"} );			// get the categories for current post in the LOOP (array)
						$cat		 = $categories[ 0 ];				  // selects first of the categories
						$id			 = $cat->term_id;
						$slug		 = $cat->slug;					// gets category id for $url and for select to wpdb
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
						$category_url	 = get_category_link( $id );
						?>
						<article class="hero-block primary" style="background-color: <?php echo $color ?>">
							<a aria-hidden="true" class="img-link bdd-first-article-link" style="background-image: url(<?php echo $left_image_1 ?>)" href="<?php echo $left_url_1 ?>">
								<?php echo $left_title_1 ?>
							</a>
							<div class="text-box" style="background-color: <?php echo $color ?>">
								<h2>
									<a class="c3" href="<?php echo $left_url_1 ?>">
										<?php echo $left_title_1 ?>
									</a>
								</h2>
								<p class="secondary-text">
									<a class="tag c3" href="<?php $category_url ?>"> <i class="<?php echo $icon ?>"> </i> <?php echo $name ?> </a>
								</p>
								<p class="secondary-text description c4">
									<?php echo ($left_excerpt_1) ?>
								</p>
							</div>
						</article>
						<?php
						$categories		 = get_the_category( ${"middle_date_ID_1"} );			// get the categories for current post in the LOOP (array)
						$cat			 = $categories[ 0 ];				  // selects first of the categories
						$id				 = $cat->term_id;
						$slug			 = $cat->slug;					// gets category id for $url and for select to wpdb
						$url			 = get_category_link( $id );
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
						$category_url_1	 = get_category_link( $id );
						?>
						<article class="hero-block secondary" style="background-color: <?php echo $color ?>">
							<a aria-hidden="true" class="img-link bdd-first-article-link" style="background-image: url(<?php echo $middle_image_1 ?>)" href="<?php echo $image_url_1 ?>">
								<?php echo $middle_title_1 ?>
							</a>
							<div class="text-box" style="background-color: <?php echo $color ?>">
								<h4>
									<a class="c3" href="<?php echo $middle_url_1 ?>">
										<?php echo $middle_title_1 ?>

									</a>
								</h4>
								<p class="secondary-text">
									<a class="tag c3" href="<?php echo $category_url_1 ?>"> <i class="<?php echo $icon ?>"> </i> <?php echo $name ?></a> 
								</p>
							</div>
						</article>
						<?php
						$categories		 = get_the_category( ${"right_date_ID_1"} );			// get the categories for current post in the LOOP (array)
						$cat			 = $categories[ 0 ];				  // selects first of the categories
						$id				 = $cat->term_id;
						$slug			 = $cat->slug;					// gets category id for $url and for select to wpdb
						$url			 = get_category_link( $id );
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
						$category_url_2 = get_category_link( $id );
						?>
						<article class="hero-block secondary" style="background-color: <?php echo $color ?>">
							<a aria-hidden="true" class="img-link bdd-first-article-link" style="background-image: url(<?php echo $right_image_1 ?>)" href="<?php echo $right_url_1 ?>">
								<?php echo $right_title_1 ?>
							</a>
							<div class="text-box" style="background-color: <?php echo $color ?>">
								<h4>
									<a class="c3" href="<?php echo $right_url_1 ?>">
										<?php echo $right_title_1 ?>
									</a>
								</h4>
								<p class="secondary-text">
									<a class="tag c3" href="<?php echo $category_url_2 ?>"> <i class="<?php echo $icon ?>"> </i> <?php echo $name ?></a>
								</p>
							</div>
						</article>
					</section>
				</div>
			</div>


		<?php } ?>
	</div>
</div>