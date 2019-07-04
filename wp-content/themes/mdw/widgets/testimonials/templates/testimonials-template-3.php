<?php
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$fieldCount		 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$amount			 = $fieldCount;
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

for ( $i = 1; $i <= $amount; $i++ ) {
	${"name_" . $i}	 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "Name " . $i;
	${"job_" . $i}	 = ( isset( $instance[ "job_" . $i ] ) ) ? $instance[ "job_" . $i ] : "Job title " . $i;
	${'quote_' . $i} = ( isset( $instance[ 'quote_' . $i ] ) ) ? $instance[ 'quote_' . $i ] : 'Quote ' . $i;
	${'image_' . $i} = ( isset( $instance[ 'image_' . $i ] ) ) ? $instance[ 'image_' . $i ] : '';
	${'rate_' . $i}	 = ( isset( $instance[ 'rate_' . $i ] ) ) ? $instance[ 'rate_' . $i ] : 0;
}
?>

<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Testimonials v.3-->
	<section class="section team-section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content; ?></p><?php } ?>

		<?php
		$sidebar = is_active_widget( false, $this->id, 'mdw_testimonials', false );
		if ( strpos( $sidebar, 'sidebar' ) === false ) {
			?> 
			<!--First row-->
			<div class="row text-xs-center">

				<?php for ( $i = 1; $i <= $amount; $i ++ ) { ?>

					   <!--<?php $i ?> column-->
					<div class="col-md-4 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

						<div class="testimonial">
							<!--Avatar-->
							<div class="avatar">
								<img class="rounded-circle" src="<?php echo ${'image_' . $i}; ?>">
							</div>

							<!--Content-->
							<h4><?php echo ${'name_' . $i}; ?></h4>
							<h5><?php echo ${'job_' . $i}; ?></h5>
							<p><i class="fa fa-quote-left"></i><?php echo ${'quote_' . $i}; ?></p>



							<!--Review-->
							<div class="orange-text">
								<?php
								for ( $j = 0; $j <= 5 - 1; $j++ ) { //It's because loop is counting from 0
									$rate = ${'rate_' . $i};
									if ( $rate == 0 )
										break;

									if ( $rate == floor( $rate ) ) {

										if ( $rate >= $j ) {
											?> <i class="fa fa-star"></i> <?php } else {
											?> <i class="fa fa-star-o"></i> <?php } ?>

									<?php
									} else {

										if ( $rate == ($j + 0.5) ) {
											?> <i class="fa fa-star-half-full"></i> <?php } else if ( $rate > ($j + 0.5) ) {
											?> <i class="fa fa-star"></i> <?php } else {
						?> <i class="fa fa-star-o"></i> <?php } ?>

									<?php } ?>

		<?php } ?>
							</div>

						</div>
					</div>
					<!--/<?php $i ?> column-->

	<?php } ?>

			</div>
		<?php } else {
			$k = 0;
			?>
			<!--First row-->

			<div id="carousel-example-<?php echo $widget_id; ?>" class="carousel testimonial-carousel slide carousel-fade <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" data-ride="carousel" data-interval="false">

				<div class="carousel-inner" role="listbox" style="text-align: center;">

					<?php
					for ( $i = 1; $i <= $amount; $i ++ ) {
						$k++;
						?>

						<div class="carousel-item <?php echo ($i == 1) ? 'active' : '' ?>">

					   <!--<?php $i ?> column-->
							<div class="col-md-12 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

								<div class="testimonial">
									<!--Avatar-->
									<div class="avatar">
										<img class="rounded-circle" src="<?php echo ${'image_' . $i}; ?>">
									</div>

									<!--Content-->
									<h4><?php echo ${'name_' . $i}; ?></h4>
									<h5><?php echo ${'job_' . $i}; ?></h5>
									<p><i class="fa fa-quote-left"></i><?php echo ${'quote_' . $i}; ?></p>



									<!--Review-->
									<div class="orange-text">
										<?php
										for ( $j = 0; $j <= 5 - 1; $j++ ) { //It's because loop is counting from 0
											$rate = ${'rate_' . $i};
											if ( $rate == 0 )
												break;

											if ( $rate == floor( $rate ) ) {

												if ( $rate >= $j ) {
													?> <i class="fa fa-star"></i> <?php } else {
													?> <i class="fa fa-star-o"></i> <?php } ?>

											<?php
											} else {

												if ( $rate == ($j + 0.5) ) {
													?> <i class="fa fa-star-half-full"></i> <?php } else if ( $rate > ($j + 0.5) ) {
								?> <i class="fa fa-star"></i> <?php } else {
													?> <i class="fa fa-star-o"></i> <?php } ?>

			<?php } ?>

		<?php } ?>
									</div>

								</div>
							</div>
							<!--/<?php $i ?> column-->
						</div>
	<?php } ?>

				</div>
	<?php if ( $amount > 1 ) { ?>
					<a class="left carousel-control" href="#carousel-example-<?php echo $widget_id; ?>" role="button" data-slide="prev" style="background-image: none;">
						<span class="icon-prev" aria-hidden="true" style="color: black;"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-<?php echo $widget_id; ?>" role="button" data-slide="next" style="background-image: none;">
						<span class="icon-next" aria-hidden="true" style="color: black;"></span>
						<span class="sr-only">Next</span>
					</a>
	<?php } ?>
			</div>
<?php } ?>
		<!--/First row-->

	</section>
	<!--/Section: Testimonials v.3-->
</div>
