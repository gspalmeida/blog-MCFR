<?php
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$fieldCount		 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$amount			 = $fieldCount;
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$skin_color = get_theme_mod('color_scheme');


for ( $i = 1; $i <= $amount; $i++ ) {
	${"name_" . $i}	 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "Name " . $i;
	${'quote_' . $i} = ( isset( $instance[ 'quote_' . $i ] ) ) ? $instance[ 'quote_' . $i ] : 'Quote ' . $i;
	${'image_' . $i} = ( isset( $instance[ 'image_' . $i ] ) ) ? $instance[ 'image_' . $i ] : '';
	${'job_' . $i}	 = ( isset( $instance[ 'job_' . $i ] ) ) ? $instance[ 'job_' . $i ] : '';

	${'rate_' . $i} = ( isset( $instance[ 'rate_' . $i ] ) ) ? $instance[ 'rate_' . $i ] : 0;
}
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Testimonials v.2-->
	<section class="section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title ?></h1><?php } ?>
		<!--Section sescription-->

		<!--Carousel Wrapper-->
		<div id="carousel-example-<?php echo $widget_id; ?>" class="carousel testimonial-carousel slide carousel-fade <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" data-ride="carousel" data-interval="false">
			<?php $m = 0; ?>
			<!--Slides-->
			<div class="carousel-inner" role="listbox">
				<!-- Slide list -->
				<?php
				for ( $i = 1; $i <= $amount; $i++ ) {
					$m++;
					?>
					<!-- Slide <?php echo $i ?> -->
					<div class="carousel-item <?php echo ($i == 1) ? 'active' : '' ?>">
						<div class="testimonial">
							<!--Avatar-->
							<div class="avatar">
								<img src="<?php echo ${'image_' . $i} ?>" class="rounded-circle img-fluid">
							</div>
							<!--Content-->
							<p><i class="fa fa-quote-left"></i> <?php echo ${'quote_' . $i} ?> </p>

							<h4><?php echo ${"name_" . $i} ?></h4>
							<h5><?php echo ${'job_' . $i} ?></h5>

							<!--Review-->
							<?php
							for ( $k = 0; $k <= 5; $k++ ) {

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
					<!-- /Slide <?php echo $i ?> -->
<?php } ?>
			</div>
			<!--/.Slides-->

			<!--Controls-->
<?php if ( $amount > 1 ) { ?>
				<a class="left carousel-control" href="#carousel-example-<?php echo $widget_id; ?>" role="button" data-slide="prev" style="background-image: none;">
					<span class="icon-prev" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-example-<?php echo $widget_id; ?>" role="button" data-slide="next" style="background-image: none;">
					<span class="icon-next " aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
<?php } ?>
			<!--/.Controls-->
		</div>
		<!--/.Carousel Wrapper-->

	</section>
	<!--Section: Testimonials v.2-->
</div>
