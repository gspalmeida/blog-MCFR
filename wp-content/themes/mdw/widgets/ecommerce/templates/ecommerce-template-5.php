<?php
$title					 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content			 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$prod_category			 = ( isset( $instance[ 'prod_category' ] ) ) ? $instance[ 'prod_category' ] : 'All categories';
$words_per_excerpt		 = ( isset( $instance[ 'words_per_excerpt' ] ) ) ? $instance[ 'words_per_excerpt' ] : 10;
$box_layout				 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation				 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id				 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$product_cards_number	 = ( isset( $instance[ 'product_cards_number' ] ) ) ? $instance[ 'product_cards_number' ] : 9;

$cat_listing = get_theme_mod( 'cat_listing_version', '1' );


if ( $prod_category == 'All categories' ) {
	$args = array(
		'post_type'	 => 'product',
		'showposts'	 => $product_cards_number,
	);
} else {
	$args = array(
		'post_type'	 => 'product',
		'showposts'	 => $product_cards_number,
		'tax_query'	 => array(
			array(
				'taxonomy'	 => 'product_cat',
				'field'		 => 'id',
				'terms'		 => $prod_category,
			),
		),
	);
}
$query = new WP_Query( $args );
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Products v.5-->
	<section class="section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo ( $title ); ?></h1><?php } ?>
		<!--Section description-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo ( $main_content ); ?></p><?php } ?>


		<!--Carousel Wrapper-->
		<div id="multi-item-example" class="carousel slide carousel-multi-item <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" data-ride="carousel">
			<?php if ( count( $query->posts ) / 3 > 1 ) { ?>
				<!--Controls-->
				<div class="controls-top">
					<a class="btn-floating btn-small primary-color" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
					<a class="btn-floating btn-small primary-color" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
				</div>
				<!--/.Controls-->
			<?php } ?>
			<?php if ( count( $query->posts ) / 3 > 1 ) { ?>
				<!--Indicators-->
				<ol class="carousel-indicators">
					<?php for ( $i = 0; $i < ceil( $product_cards_number / 3 ); $i++ ) { ?>
						<li class="primary-color" data-target="#multi-item-example" data-slide-to="<?php echo $i; ?>"></li>
					<?php } ?>
				</ol>
				<!--/.Indicators-->
			<?php } ?>
			<!--Slides-->
			<div class="carousel-inner" role="listbox">

				<?php
				if ( $query->have_posts() ) {
					
					$row	 = 1;
					$slides	 = 1;

					// The Loop

					while ( $query->have_posts() ) {

						$query->the_post();
						

						if ( $row == 1 ) {
							?>

							<div class="carousel-item <?php
							if ( $slides == 1 ) {
								echo "active";
								$slides++;
							}
							?>">

								<?php
							}
							?>
								
							<div class="col-md-4">

								<!--Card-->
								<div class="card card-cascade narrower">

									<?php if ( has_post_thumbnail() ) { ?>
										<!--Card image-->
										<div class="view overlay hm-white-slight">
											<img src="<?php the_post_thumbnail_url( "full" ); ?>" class="img-fluid" alt="">
											<a href="<?php the_permalink(); ?>">
												<div class="mask"></div>
											</a>
										</div>
										<!--/.Card image-->
									<?php } ?>

									<!--Card content-->
									<div class="card-block text-xs-center">
										<!--Category & Title-->
										<a href="" class="text-muted">
											<h5>
												<?php
												$terms		 = get_the_terms( $query->id, 'product_cat' );
												$terms_count = count( $terms );

												if ( $terms ) {
													foreach ( $terms as $term ) {
														?>
														<a href="<?php echo get_category_link( $term->term_id ); ?>">
															<?php
															if ( $cat_listing == '2' ) {
																$breadcrumbs = get_category_parents( $term->term_id, true, ' <i class="fa fa-angle-right" aria-hidden="true"></i> ' );
																echo $breadcrumbs;
															} else {
																echo $term->name;
															}
															if ( $terms_count != 1 ) {
																echo ", ";
															}
															?>
														</a>
														<?php
														$terms_count--;
													}
												} else {
													echo "No category";
												}
												?>
											</h5>
										</a>
										<h4 class="card-title"><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></h4>

										<!--Description-->
										<p class="card-text"><?php echo excerpt( get_the_content(), $words_per_excerpt ); ?>
										</p>

										<!--Card footer-->
										<div class="card-footer">
											<span class="left">
												<?php
												if ( get_post_meta( get_the_ID(), '_sale_price', true ) == NULL ) {
													echo wc_price( get_post_meta( get_the_ID(), '_regular_price', true ) );
												} else {
													echo wc_price( get_post_meta( get_the_ID(), '_sale_price', true ) );
													?>
													<del><sup><?php echo wc_price( get_post_meta( get_the_ID(), '_regular_price', true ) ); ?><sup/></del>
													<?php
												}
												?>
											</span>
											<span class="right">
									<!-- <a class="" data-toggle="tooltip" data-placement="top" title="Quick Look"><i class="fa fa-eye"></i></a> -->
									<!-- <a class="" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><i class="fa fa-heart"></i></a> -->
											</span>
										</div>

									</div>
									<!--/.Card content-->

								</div>
								<!--/.Card-->

							</div>


							<?php
							if ( $row == 3 ) {
								?>

							</div>
							<!--/.Row -->

							<?php
							$row = 1;
						} else {

							$row++;
						}
					
					}
				}
				wp_reset_query();
				?>


			</div>
			<!--/.Slides-->

		</div>
		<!--/.Carousel Wrapper-->


	</section>
	<!--/Section: Products v.5-->
</div>
