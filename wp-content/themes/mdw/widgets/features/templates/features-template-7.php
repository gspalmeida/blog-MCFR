<?php
/* General variables */
global $wpdb;
$mdw_category_table = $wpdb->prefix . "mdw_taxonomy_category"; // mdw category table

$title					 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content			 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$image					 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$what_to_feed			 = ( isset( $instance[ 'what_to_feed' ] ) ) ? $instance[ 'what_to_feed' ] : 'posts';
$left_or_right			 = ( isset( $instance[ 'left_or_right' ] ) ) ? $instance[ 'left_or_right' ] : 'left';
$box_layout				 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$amount					 = 3; // default for this project layout
//image


	for ( $i = 1; $i <= 6; $i++ ) {
			${'image_'.$i} = ( isset( $instance['image_'.$i] ) ) ? $instance['image_'.$i] : '';
			${'image_description_'.$i} = ( isset( $instance['image_description_'.$i] ) ) ? $instance['image_description_'.$i] : '';
			${'image_title_'.$i} = ( isset( $instance['image_title_'.$i] ) ) ? $instance['image_title_'.$i] : '';
			${'url_'.$i} = ( isset( $instance['url_'.$i] ) ) ? $instance['url_'.$i] : '';
		}	

?>
<div class="<?php echo $box_layout; ?> mt-1" id="<?php echo $widget_id; ?>"  >
	<div class=" <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

		<section class="section template-7">

			<div class="row">
				<section class="section mt-4 mb-4">

					<!--Section heading-->
					<h1 class="section-heading wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn;"><?php echo $title; ?></h1>
					<!--Section description-->
					<p class="section-description mb-5 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn;"><?php echo $main_content; ?></p>

					<!--First row-->
					<div class="row mb-3 wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">

						<!--First column-->
						<div class="col-md-2 mb-2 flex-center">

							<!--Avatar-->
							<img src="<?php echo ${'image_1'}; ?>" class="img-fluid rounded-circle">

						</div>
						<!--/First column-->

						<!--Second column-->
						<div class="col-md-4 text-xs-center text-md-left mb-3">

							<h4><?php echo ${'image_title_1'}; ?></h4>
							<p><?php echo ${'image_description_1'}; ?></p>

						</div>
						<!--/Second column-->

						<!--Third column-->
						<div class="col-md-2 mb-2 flex-center">

							<!--Avatar-->
							<img src="<?php echo ${'image_2'}; ?>" class="img-fluid rounded-circle">

						</div>
						<!--/Third column-->

						<!--Fourth column-->
						<div class="col-md-4 text-xs-center text-md-left mb-3">

							<h4><?php echo ${'image_title_2'}; ?></h4>
							<p><?php echo ${'image_description_2'}; ?></p>

						</div>
						<!--/Fourth column-->

					</div>
					<!--/First row-->

					<!--Second row-->
					<div class="row mb-3 wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">

						<!--First column-->
						<div class="col-md-2 mb-2 flex-center">

							<!--Avatar-->
							<img src="<?php echo ${'image_3'}; ?>" class="img-fluid rounded-circle">

						</div>
						<!--/First column-->

						<!--Second column-->
						<div class="col-md-4 text-xs-center text-md-left mb-3">

							<h4><?php echo ${'image_title_3'}; ?></h4>
							<p><?php echo ${'image_description_3'}; ?></p>

						</div>
						<!--/Second column-->

						<!--Third column-->
						<div class="col-md-2 mb-2 flex-center">

							<!--Avatar-->
							<img src="<?php echo ${'image_4'}; ?>" class="img-fluid rounded-circle">

						</div>
						<!--/Third column-->

						<!--Fourth column-->
						<div class="col-md-4 text-xs-center text-md-left mb-3">

							<h4><?php echo ${'image_title_4'}; ?></h4>
							<p><?php echo ${'image_description_4'}; ?></p>

						</div>
						<!--/Fourth column-->

					</div>
					<!--/Second row-->

					<!--Third row-->
					<div class="row wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">

						<!--First column-->
						<div class="col-md-2 mb-2 flex-center">

							<!--Avatar-->
							<img src="<?php echo ${'image_5'}; ?>" class="img-fluid rounded-circle">

						</div>
						<!--/First column-->

						<!--Second column-->
						<div class="col-md-4 text-xs-center text-md-left mb-3">

							<h4><?php echo ${'image_title_5'}; ?></h4>
							<p><?php echo ${'image_description_5'}; ?></p>

						</div>
						<!--/Second column-->

						<!--Third column-->
						<div class="col-md-2 mb-2 flex-center">

							<!--Avatar-->
							<img src="<?php echo ${'image_6'}; ?>" class="img-fluid rounded-circle">

						</div>
						<!--/Third column-->

						<!--Fourth column-->
						<div class="col-md-4 text-xs-center text-md-left mb-3">

							<h4><?php echo ${'image_title_6'} ?></h4>
							<p><?php echo ${'image_description_6'}; ?></p>

						</div>
						<!--/Fourth column-->
					</div>
					<!--/Third row-->

				</section>
            </div>
        </section>
        </div>
        </div>