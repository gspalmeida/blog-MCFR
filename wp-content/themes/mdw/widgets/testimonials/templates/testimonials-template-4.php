<?php
$title		 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$fieldCount	 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$box_layout	 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$amount = $fieldCount; // default for this project layou

for ( $i = 1; $i <= $amount * 3; $i++ ) {

	${"name_" . $i}	 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "";
	${'quote_' . $i} = ( isset( $instance[ 'quote_' . $i ] ) ) ? $instance[ 'quote_' . $i ] : "";
	${'image_' . $i} = ( isset( $instance[ 'image_' . $i ] ) ) ? $instance[ 'image_' . $i ] : '';
	${'job_' . $i}	 = ( isset( $instance[ 'job_' . $i ] ) ) ? $instance[ 'job_' . $i ] : '';
	${'rate_' . $i}	 = ( isset( $instance[ 'rate_' . $i ] ) ) ? $instance[ 'rate_' . $i ] : "";
}
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Testimonials v.4-->
	<section class="section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title ?></h1><?php } ?>

		<div class="row">
			<?php
			$sidebar = is_active_widget( false, $this->id, 'mdw_testimonials', false );
			if ( strpos( $sidebar, 'sidebar' ) === false ) {
				?> 
				<!--Carousel Wrapper-->
				<div id="multi-item-example" class="carousel testimonial-carousel slide carousel-multi-item wow fadeIn <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" data-ride="carousel">
					<?php if ( $amount != 1 ) { ?>
						<!--Controls-->
						<div class="controls-top">
							<a class="btn-floating btn-small mdb-color" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
							<a class="btn-floating btn-small mdb-color" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
						</div>
						<!--/.Controls-->
					<?php } ?>
					<!--Indicators-->
					<ol class="carousel-indicators">
						<?php
						if ( $amount != 1 ) {
							for ( $i = 0; $i <= $amount - 1; $i++ ) {
								?>
								<li data-target="#multi-item-example" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? 'active' : '' ?> mdb-color"></li>
							<?php
							}
						}
						?>
					</ol>
					<!--/.Indicators-->

					<!--Slides-->
					<div class="carousel-inner" role="listbox">
							<?php for ( $j = 1; $j <= $amount; $j++ ) { ?>
							<div class="carousel-item <?php echo ($j == 1) ? 'active' : '' ?>">
		<?php for ( $i = 3 * $j - 3 + 1; $i <= 3 * $j; $i++ ) { ?>
									<!--First column-->
									<div class="col-md-4">
										<div class="testimonial">
											<!--Avatar-->
											<div class="avatar">
												<img src="<?php echo ${'image_' . $i}; ?>" class="rounded-circle img-fluid">
											</div>
											<!--Content-->
											<h4><?php echo ${"name_" . $i} ?></h4>
											<h5><?php echo ${'job_' . $i} ?></h5>
											<p><i class="fa fa-quote-left"></i> <?php echo ${'quote_' . $i} ?></p>

											<!--Review-->
											<div class="orange-text">
												<?php
												for ( $k = 0; $k <= 5 - 1; $k++ ) { //It's because loop is counting from 0
													$rate = ${'rate_' . $i};
													if ( $rate == 0 )
														break;

													if ( $rate == floor( $rate ) ) {

														if ( $rate > $k ) {
															?> <i class="fa fa-star"></i> <?php } else {
															?> <i class="fa fa-star-o"></i> <?php } ?>

													<?php
													} else {

														if ( $rate == ($k + 0.5) ) {
															?> <i class="fa fa-star-half-full"></i> <?php } else if ( $rate > ($k + 0.5) ) {
															?> <i class="fa fa-star"></i> <?php } else {
									?> <i class="fa fa-star-o"></i> <?php } ?>

				<?php } ?>

			<?php } ?>
											</div>
										</div>

									</div>
									<!--/First column-->
		<?php } ?>
							</div>
	<?php } ?>
					</div>

				</div>
				<!--/.Slides-->
<?php } else { ?>
				<div id="carousel-example-<?php echo $widget_id; ?>" class="carousel testimonial-carousel slide carousel-fade <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" data-ride="carousel" data-interval="false">

	<?php if ( $image_2 != ""  ) { ?>
						<!--Controls-->
						<div class="controls-top">
							<a class="btn-floating btn-primary btn-small " href="#carousel-example-<?php echo $widget_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
							<a class="btn-floating btn-primary btn-small " href="#carousel-example-<?php echo $widget_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
						</div>
						<!--/.Controls-->
	<?php } ?>

					<!--Slides-->
					<div class="carousel-inner" role="listbox">


	<?php for ( $i = 1; $i <= $amount * 3; $i++ ) { ?>
		<?php if ( ${"name_" . $i} != '' || ${"image_" . $i} != '' || ${"job_" . $i} != '' ) { ?>
								<div class="carousel-item <?php echo ($i == 1) ? 'active' : '' ?>">
									<!--First column-->

									<div class="col-md-12">
										<div class="testimonial">
											<!--Avatar-->
											<div class="avatar">
												<img src="<?php echo ${'image_' . $i}; ?>" class="rounded-circle img-fluid">
											</div>
											<!--Content-->
											<h4><?php echo ${"name_" . $i} ?></h4>
											<h5><?php echo ${'job_' . $i} ?></h5>
											<p><i class="fa fa-quote-left"></i> <?php echo ${'quote_' . $i} ?></p>

											<!--Review-->
											<div class="orange-text">
												<?php
												for ( $k = 0; $k <= 5 - 1; $k++ ) { //It's because loop is counting from 0
													$rate = ${'rate_' . $i};
										
													if ( $rate == 0 )
														break;

													if ( $rate == floor( $rate ) ) {

														if ( $rate > $k ) {
															?> <i class="fa fa-star"></i> <?php } else {
															?> <i class="fa fa-star-o"></i> <?php } ?>

													<?php
													} else {

														if ( $rate == ($k + 0.5) ) {
															?> <i class="fa fa-star-half-full"></i> <?php } else if ( $rate > ($k + 0.5) ) {
									?> <i class="fa fa-star"></i> <?php } else {
															?> <i class="fa fa-star-o"></i> <?php } ?>

				<?php } ?>

									<?php } ?>
											</div>
										</div>

									</div>
		<?php } ?>
								<!--/First column-->
							</div>
				<?php } ?>
					</div>

				</div>
<?php } ?>

        </div>
        <!--/.Carousel Wrapper-->
	</section>
</div>

<!--/Section: Testimonials v.4-->
