<?php
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content		 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$amount				 = ( isset( $instance[ 'amount' ] ) ) ? $instance[ 'amount' ] : 4; // default for this project layout
$prod_category		 = ( isset( $instance[ 'prod_category' ] ) ) ? $instance[ 'prod_category' ] : 'All categories';
$words_per_excerpt	 = ( isset( $instance[ 'words_per_excerpt' ] ) ) ? $instance[ 'words_per_excerpt' ] : 10;
$box_layout			 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation			 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Products v.1-->
	<section class="section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo ( $title ); ?></h1><?php } ?>
		<!--Section description-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo ( $main_content ); ?></p><?php } ?>

		<div class="row">



			<?php
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

				// The Loop

				while ( $query->have_posts() ) {

					$query->the_post();

					$counter++;
					?>

					<!--Column-->
					<!--Card-->
					<style>
						.picture {
							padding: 3% 0;
						}
						.picture img{
							margin-left: -5px;
						}
					</style>

					<div class="col-xs-12">
						<div class="row card ">
							<div class="col-lg-7 col-md-6 card-block text-xs-center <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
								<h5 class="card-title"><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></h5>
								<?php
								if ( get_post_meta( get_the_ID(), '_sale_price', true ) == NULL ) {
									echo wc_price( get_post_meta( get_the_ID(), '_regular_price', true ) );
								} else {
									?>
									<del><?php echo wc_price( get_post_meta( get_the_ID(), '_regular_price', true ) ); ?></del>
									<strong><?php echo wc_price( get_post_meta( get_the_ID(), '_sale_price', true ) ); ?></strong><?php
								}
								?>
							</div>
							<?php if ( has_post_thumbnail() ) { ?>
								<!--Card image-->
								<div class="col-lg-5 col-md-6 picture" style="">
									<img src="<?php the_post_thumbnail_url( "full" ); ?>" class="img-fluid" alt="">
									<a href="<?php the_permalink(); ?>">
										<div class="mask"></div>
									</a>
								</div>
								<!--/.Card image-->
							<?php } ?>
						</div>

					</div>
					<!--/.Card-->
					<!--/.Column-->


					<?php
					if ( $counter % 4 == 0 ) {
						?>

					</div>
					<!--/.Row -->
					<div class="row">

						<?php
					}
				}
			}
			wp_reset_query();
			?>
		</div>

    </section>
	<!--/Section: Products v.1-->
</div>
