<?php
$category = get_theme_mod( 'categories' ); // mdw category table

$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

$middle_amount				 = ( isset( $instance[ 'middle_amount' ] ) ) ? $instance[ 'middle_amount' ] : 3; // default for this project layout
$middle_category			 = ( isset( $instance[ 'middle_category' ] ) ) ? $instance[ 'middle_category' ] : 'No categories';
$middle_words_per_excerpt	 = ( isset( $instance[ 'middle_words_per_excerpt' ] ) ) ? $instance[ 'middle_words_per_excerpt' ] : 10;

$middle_icon			 = ( isset( $instance[ 'middle_icon' ] ) ) ? $instance[ 'middle_icon' ] : '';
$middle_icon_container	 = ( isset( $instance[ 'middle_icon_container' ] ) ) ? $instance[ 'middle_icon_container' ] : '';
$middle_icon_color		 = ( isset( $instance[ 'middle_icon_color' ] ) ) ? $instance[ 'middle_icon_color' ] : '';

if ( $middle_category != 'No categories' ) {
	$args = array( 'numberposts' => $middle_amount, 'cat' => $middle_category );
} else {
	$args = array( 'numberposts' => $middle_amount );
}
$recent_posts = wp_get_recent_posts( $args ); // type = array

if ( count( $recent_posts ) < $middle_amount ) {
	$middle_amount = count( $recent_posts );
}


for ( $i = 1; $i <= $middle_amount; $i++ ) {

	${"title_" . $i}		 = $recent_posts[ $i - 1 ][ 'post_title' ];
	${"content_" . $i}		 = $recent_posts[ $i - 1 ][ 'post_content' ];
	${"image_" . $i}		 = wp_get_attachment_url( get_post_thumbnail_id( $recent_posts[ $i - 1 ][ 'ID' ] ) );
	${"url_" . $i}			 = get_post_permalink( $recent_posts[ $i - 1 ][ 'ID' ] );
	${"date_ID_" . $i}		 = $recent_posts[ $i - 1 ][ 'ID' ];
	${"author_" . $i}		 = $recent_posts[ $i - 1 ][ 'post_author' ];
	${"categories_" . $i}	 = implode( ", ", wp_get_post_categories( $recent_posts[ $i - 1 ][ 'ID' ], array( 'fields' => 'names' ) ) );
}

$excerpt_1 = excerpt( ${"content_1"}, $middle_words_per_excerpt );
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Magazine v.2-->
	<section class="section magazine-section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title ?></h1><?php } ?>

		<!--Section sescription-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content ?></p><?php } ?>

		<!--First row-->
		<div class="row">

			<!--First column-->
			<div class="col-md-6">

				<!--Featured news-->
				<div class="single-news <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

					<!--Image-->
					<div class="view overlay hm-white-slight">
                        <a href="<?php echo ${"url_1"}; ?>">
							<img src="<?php echo ${'image_1'} ?>">
							<?php
							if ( ${'image_1'} == null ) {
								print_default_image();
							}
							?>
							<div class="mask"></div>
                        </a>
					</div>

					<!--Excerpt-->
					<div class="news-data">
						<?php
                        $category    = get_theme_mod( 'categories' );
						$categories     = get_the_category( ${"date_ID_1"} );            // get the categories for current post in the LOOP (array)
                        $cat         = $categories[ 0 ];                  // selects first of the categories
						$icons = get_mdw_category($cat, $category);
						?>

						<a href="<?php echo $icons[ "url" ]; ?>"><h5 style="color:<?php echo $icons[ "color" ]; ?>"><i class="<?php echo $icons[ "icon" ]; ?>"></i>&nbsp;<?php echo $icons[ "name" ]; ?>&nbsp;&nbsp;</h5></a>

						<p><strong><i class="fa fa-clock-o"></i>
						<?php
						$archive_year	 = get_the_time( 'Y' );
						$archive_month	 = get_the_time( 'm' );
						$archive_day	 = get_the_time( 'd' );
						?>
						<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", ${"date_ID_1"} ); ?></a>
						<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", ${"date_ID_1"} ); ?></a>
						<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", ${"date_ID_1"} ); ?></a></strong></p>
					</div>

					<h3 class="title-padding"><a href="<?php echo ${"url_1"}; ?>"><?php echo ${"title_1"}; ?></a></h3>

					<p><?php echo ${"excerpt_1"}; ?></p>

				</div>
				<!--/Featured news-->

			</div>
			<!--/First column-->

			<!--Second column-->
			<div class="col-md-6">
				<?php for ( $i = 2; $i <= $middle_amount; $i++ ) { ?>

			  <!--<?php echo $i; ?> row-->
					<div class="single-news">
						<div class="row">

							<!--First column-->
							<div class="col-md-3 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
								<!--Featured image-->
								<div class="view overlay hm-white-slight">
                                    <a href="<?php echo ${"url_" . $i}; ?>">
										<img src="<?php echo ${"image_" . $i}; ?>">
										<?php
										if ( ${"image_" . $i} == null ) {
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
										<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", ${"date_ID_" . $i} ); ?>
											<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", ${"date_ID_" . $i} ); ?>
												<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", ${"date_ID_" . $i} ); ?></a></strong></p>
												<a class="text" href="<?php echo ${"url_" . $i}; ?>"><?php echo ${"title_" . $i}; ?>
													<span><i class="fa fa-angle-right"></i></span>
												</a>
												</div>
												<!--/Second column-->

												</div>
												</div>
									  <!--/<?php echo $i; ?> row-->

												<?php if ( $i != $middle_amount ) { ?> <hr> <?php } ?>

											<?php } ?>


											</div>
											<!--/Second column-->

											</div>
											<!--/First row-->

											</section>
											<!--/Section: Magazine v.2-->
											</div>
