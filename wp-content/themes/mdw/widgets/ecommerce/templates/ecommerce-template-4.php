<?php
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content		 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$amount				 = ( isset( $instance[ 'amount' ] ) ) ? $instance[ 'amount' ] : 4; // default for this project layout
$prod_category		 = ( isset( $instance[ 'prod_category' ] ) ) ? $instance[ 'prod_category' ] : 'All categories';
$words_per_excerpt	 = ( isset( $instance[ 'words_per_excerpt' ] ) ) ? $instance[ 'words_per_excerpt' ] : 10;
$box_layout			 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$cat_listing = get_theme_mod( 'cat_listing_version', '1' );
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Products v.4-->
	<section class="section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo ( $title ); ?></h1><?php } ?>
		<!--Section description-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo ( $main_content ); ?></p><?php } ?>

		<div class="row">

			<?php
			$prod_categories = get_terms( 'product_cat', array(
				'orderby'	 => 'term_id',
				'order'		 => 'DESC',
				'hide_empty' => false,
				'number'	 => $amount
			) );
			$counter		 = 1;
			foreach ( $prod_categories as $prod_cat ) {
				$thumbnail_id	 = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
				$image			 = wp_get_attachment_url( $thumbnail_id );
				$counter++;
				?>
				<!--First column-->
				<div class="col-lg-3 col-md-6 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

					<!--Collection card-->
					<div class="card collection-card z-depth-1-half">
						<!--Card image-->
						<div class="view hm-zoom">
							<img src="<?php echo $image; ?>" class="img-fluid" alt="">
							<div class="stripe dark">
								<a href="<?php echo get_category_link( $prod_cat->term_id ) ?>">
									<p> <?php
										if ( $cat_listing == '2' ) {
											$breadcrumbs = get_category_parents( $prod_cat->term_id, true, ' <i class="fa fa-angle-right" aria-hidden="true"></i> ' );
											echo $breadcrumbs;
										} else {
											echo $prod_cat->name;
										}
										?> 
										<i class="fa fa-chevron-right"></i>
									</p>
								</a>
							</div>
						</div>
						<!--/.Card image-->
					</div>
					<!--/.Collection card-->

				</div>
				<!--/First column-->
				<?php
			}
			wp_reset_query();
			?>

		</div>


	</section>
	<!--/Section: Products v.4-->
</div>
