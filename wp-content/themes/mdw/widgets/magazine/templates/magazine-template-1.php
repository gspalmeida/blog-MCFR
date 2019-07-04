<?php
$category = get_theme_mod( 'categories' ); // mdw category table

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

$post_format	 = get_post_format() ?: 'standard';
$featured		 = 'featured';
$content_where	 = 'content';

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

	${"left_id_" . $i}			 = $left_recent_posts[ $i - 1 ][ 'ID' ];
	${"left_title_" . $i}		 = $left_recent_posts[ $i - 1 ][ 'post_title' ];
	${"left_content_" . $i}		 = $left_recent_posts[ $i - 1 ][ 'post_content' ];
	${"left_image_" . $i}		 = wp_get_attachment_url( get_post_thumbnail_id( ${"left_id_" . $i} ) );
	${"left_url_" . $i}			 = get_post_permalink( ${"left_id_" . $i} );
	${"left_date_ID_" . $i}		 = $left_recent_posts[ $i - 1 ][ 'ID' ];
	${"left_author_" . $i}		 = $left_recent_posts[ $i - 1 ][ 'post_author' ];
	${"left_categories_" . $i}	 = implode( ", ", wp_get_post_categories( ${"left_id_" . $i}, array( 'fields' => 'names' ) ) );
}

$left_excerpt_1 = excerpt( ${"left_content_1"}, $left_words_per_excerpt );

for ( $i = 1; $i <= $right_amount; $i++ ) {

	${"right_id_" . $i}			 = $right_recent_posts[ $i - 1 ][ 'ID' ];
	${"right_title_" . $i}		 = $right_recent_posts[ $i - 1 ][ 'post_title' ];
	${"right_content_" . $i}	 = $right_recent_posts[ $i - 1 ][ 'post_content' ];
	${"right_image_" . $i}		 = wp_get_attachment_url( get_post_thumbnail_id( ${"right_id_" . $i} ) );
	${"right_url_" . $i}		 = get_post_permalink( ${"right_id_" . $i} );
	${"right_date_ID_" . $i}	 = $right_recent_posts[ $i - 1 ][ 'ID' ];
	${"right_author_" . $i}		 = $right_recent_posts[ $i - 1 ][ 'post_author' ];
	${"right_categories_" . $i}	 = implode( ", ", wp_get_post_categories( ${"right_id_" . $i}, array( 'fields' => 'names' ) ) );
}

$right_excerpt_1 = excerpt( ${"right_content_1"}, $right_words_per_excerpt );
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Magazine v.1-->
	<section class="section magazine-section">
		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title ?></h1><?php } ?>

		<!--Section description-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content ?></p><?php } ?>

		<!--First row-->
		<div class="row">

			<!--First column-->
			<div class="col-md-6 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

				<!--Featured news-->
				<div class="single-news">

					<!--Image-->
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

					<!--Excerpt-->
					<div class="news-data">
						<?php
						$categories		 = get_the_category( ${"left_id_1"} );			// get the categories for current post in the LOOP (array)
						$cat			 = $categories[ 0 ];		 // selects first of the categories
						$icons			 = get_mdw_category( $cat, $category );
						?>

						<a href="<?php echo $icons[ "url" ]; ?>"><h5 style="color:<?php echo $icons[ "color" ]; ?>"><i class="<?php echo $icons[ "icon" ]; ?>"></i>&nbsp;<?php echo $icons[ "name" ]; ?></h5></a>


						<p><strong><i class="fa fa-clock-o"></i> <?php
								$archive_year	 = get_the_time( 'Y' );
								$archive_month	 = get_the_time( 'm' );
								$archive_day	 = get_the_time( 'd' );
								?>
								<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", ${"left_date_ID_1"} ); ?></a>
								<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", ${"left_date_ID_1"} ); ?></a>
								<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", ${"left_date_ID_1"} ); ?></a></strong></p>
					</div>
					<h3 class="title-padding"><a href="<?php echo ${"left_url_1"}; ?>"><?php echo ${"left_title_1"}; ?></a></h3>
					<p><?php echo ${"left_excerpt_1"}; ?></p>

				</div>
				<!--/Featured news-->
				<?php for ( $i = 2; $i <= $left_amount; $i++ ) { ?>

				  <!--<?php echo $i; ?> row-->
					<div class="single-news">
						<div class="row">

							<!--First column-->
							<div class="col-md-3 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
								<!--Featured image-->
								<div class="view overlay hm-white-slight">
                                    <a href="<?php echo ${"right_url_1"}; ?>">
										<img src="<?php echo ${"left_image_" . $i}; ?>">
										<?php
										if ( ${"left_image_" . $i} == null ) {
											print_default_image();
										}
										?>
										<div class="mask"></div>
                                    </a>
								</div>
							</div>
							<!--/First column-->

							<!--Second column-->
							<div class="col-md-9 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
								<!--Excerpt-->
								<p class="small-margin"><strong><?php
										$archive_year	 = get_the_time( 'Y' );
										$archive_month	 = get_the_time( 'm' );
										$archive_day	 = get_the_time( 'd' );
										?>
										<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", ${"left_date_ID_" . $i} ); ?></a>
										<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", ${"left_date_ID_" . $i} ); ?></a>
										<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", ${"left_date_ID_" . $i} ); ?></a></strong></p>
								<a href="<?php echo ${"left_url_" . $i}; ?>"><?php echo ${"left_title_" . $i}; ?>
									<span><i class="fa fa-angle-right"></i></span>
								</a>
							</div>
							<!--/Second column-->

						</div>
					</div>
		  <!--/<?php echo $i; ?> row-->

					<?php if ( $i != $left_amount ) { ?> <hr> <?php } ?>

				<?php } ?>

			</div>
			<!--/First column-->

			<!--Second column-->
			<div class="col-md-6 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

				<!--Featured news-->
				<div class="single-news">

					<!--Image-->
					<div class="view overlay hm-white-slight">
							<img src="<?php echo ${"right_image_1"}; ?>">
							<?php
							if ( ${"right_image_1"} == null ) {
								print_default_image();
							}
							?>
							<div class="mask"></div>
					</div>

					<!--Excerpt-->
					<div class="news-data">
						<?php
						$categories	 = get_the_category( ${"right_id_1"} );   // get the categories for current post in the LOOP (array)
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

						<p><strong><i class="fa fa-clock-o"></i> <?php
								$archive_year	 = get_the_time( 'Y' );
								$archive_month	 = get_the_time( 'm' );
								$archive_day	 = get_the_time( 'd' );
								?>
								<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", ${"right_date_ID_1"} ); ?></a>
								<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", ${"right_date_ID_1"} ); ?></a>
								<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", ${"right_date_ID_1"} ); ?></a></strong></p>
					</div>

					<h3 class="title-padding"><a href="<?php echo ${"right_url_1"}; ?>"><?php echo ${"right_title_1"}; ?></a></h3>

					<p><?php echo ${"right_excerpt_1"}; ?></p>

				</div>
				<!--/Featured news-->
				<?php for ( $i = 2; $i <= $right_amount; $i++ ) { ?>

				  <!--<?php echo $i; ?> row-->
					<div class="single-news">
						<div class="row">

							<!--First column-->
							<div class="col-md-3 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
								<!--Featured image-->
								<div class="view overlay hm-white-slight">
                                    <a href="<?php echo ${"right_url_" . $i}; ?>">
										<img src="<?php echo ${"right_image_" . $i}; ?>">
										<?php
										if ( ${"right_image_" . $i} == null ) {
											print_default_image();
										}
										?>
										<div class="mask"></div>
                                    </a>
								</div>
							</div>
							<!--/First column-->

							<!--Second column-->
							<div class="col-md-9 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
								<!--Excerpt-->
								<p class="small-margin"><strong><?php
										$archive_year	 = get_the_time( 'Y' );
										$archive_month	 = get_the_time( 'm' );
										$archive_day	 = get_the_time( 'd' );
										?>
										<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", ${"right_date_ID_" . $i} ); ?></a>
										<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", ${"right_date_ID_" . $i} ); ?></a>
										<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", ${"right_date_ID_" . $i} ); ?></a></strong></p>
								<a href="<?php echo ${"right_url_" . $i}; ?>"><?php echo ${"right_title_" . $i}; ?>
									<span><i class="fa fa-angle-right"></i></span>
								</a>
							</div>
							<!--/Second column-->

						</div>
					</div>
		  <!--/<?php echo $i; ?> row-->

					<?php if ( $i != $right_amount ) { ?> <hr> <?php } ?>

				<?php } ?>

			</div>
			<!--/Second column-->

		</div>
		<!--/First row-->

	</section>
	<!--/Section: Magazine v.1-->
</div>
