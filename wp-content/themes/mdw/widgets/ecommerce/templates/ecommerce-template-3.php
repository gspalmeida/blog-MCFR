<?php
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content		 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$amount				 = ( isset( $instance[ 'amount' ] ) ) ? $instance[ 'amount' ] : 3; // default for this project layout
$prod_category		 = ( isset( $instance[ 'prod_category' ] ) ) ? $instance[ 'prod_category' ] : 'All categories';
$words_per_excerpt	 = ( isset( $instance[ 'words_per_excerpt' ] ) ) ? $instance[ 'words_per_excerpt' ] : 10;
$box_layout			 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation			 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$cat_listing		 = get_theme_mod( 'cat_listing_version', '1' );
$columns_amount		 = isset( $instance[ 'columns_amount' ] ) ? $instance[ 'columns_amount' ] : '1';
switch ( $columns_amount ) {
	case '1':
		$grid_class	 = " col-xs-12 ";
		break;
	case '2':
		$grid_class	 = " col-md-6 ";
		break;
	case '3':
		$grid_class	 = " col-md-4 ";
		break;
	case '4':
		$grid_class	 = " col-md-3 ";
		break;
	default:
		$grid_class	 = " col-md-12 ";
		break;
}
$grid_class .= ' mb-r ';
global $wishlists;
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Products v.1-->
	<section class="section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo ( $title ); ?></h1><?php } ?>
		<!--Section description-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo ( $main_content ); ?></p><?php
		}
		if ( $prod_category == 'All categories' ) {
			$args = array(
				'post_type'	 => 'product',
				'showposts'	 => $amount,
			);
		} else {
			$args = array(
				'post_type'	 => 'product',
				'showposts'	 => $amount,
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

		if ( $query->have_posts() ) {
			$counter = 0;
			while ( $query->have_posts() ) {

				$query->the_post();
				switch ( $columns_amount ) {
					case '1':
						$row_open_condition	 = true;
						$row_close_condition = true;
						break;
					case '2':
						$row_open_condition	 = $counter % 2 == 0;
						$row_close_condition = ( $counter % 2 ) != 0;
						break;
					case '3':
						$row_open_condition	 = $counter % 3 == 0;
						$row_close_condition = ( ( $counter + 1 ) % 3 ) == 0;
						break;
					case '4':
						$row_open_condition	 = $counter % 4 == 0;
						$row_close_condition = ( $counter + 1 ) % 4 == 0;
						break;
					default:
						$row_open_condition	 = $counter % 4 == 0;
						$row_close_condition = ( $counter + 1 ) % 4 == 0;
						break;
				}

				if ( $row_open_condition ) {
					?>
					<div class='row <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>'>
					<?php } ?>

					<!--Column-->
					<div class="<?php echo $grid_class; ?> <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

						<!--Card-->
						<div class="card card-cascade shorter">

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
								<h4 class="card-title"><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></h4>


								<!--Description-->
								<p class="card-text"><?php the_excerpt(); ?>
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
								</div>

							</div>
							<!--/.Card content-->

						</div>
						<!--/.Card-->

					</div>

					<!--/.Column-->


					<?php if ( $row_close_condition ) { ?>
					</div>
					<?php
				}

				$counter++;
			}

			wp_reset_query();
		}
		?>

	</section>
</div>
