<?php
$fieldCount		 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$amount			 = $fieldCount;
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";



for ( $i = 1; $i <= $amount; $i++ ) {
	${"name_" . $i}	 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "Name " . $i;
	${'quote_' . $i} = ( isset( $instance[ 'quote_' . $i ] ) ) ? $instance[ 'quote_' . $i ] : 'Quote ' . $i;
	${'color_' . $i} = ( isset( $instance[ 'color_' . $i ] ) ) ? $instance[ 'color_' . $i ] : '';
	${'image_' . $i} = ( isset( $instance[ 'image_' . $i ] ) ) ? $instance[ 'image_' . $i ] : '';
}
?>


<div class="<?php echo $box_layout; ?>" >
	<!--Section: Testimonials v.1-->
	<section class="section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content; ?></p><?php } ?>


		<?php
		$sidebar = is_active_widget( false, $this->id, 'mdw_testimonials', false );
		if ( strpos( $sidebar, 'sidebar' ) === false ) {
			?> 
			<div class="row flex-center">


				<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
					<?php if ( ${'image_' . $i} != '' ) { ?>
								  <!--<?php $i; ?> column -->
						<div class="col-md-4 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>">

							<!--Card-->
							<div class="card testimonial-card">

								<!--Background color-->
								<div class="card-up" style="background-color:<?php echo ${'color_' . $i}; ?>"><!--1:teal lighten-2 || 2: indigo darken-2 || 3:purple darken-2 -->
								</div>

								<!--Avatar-->
								<div class="avatar"><img src="<?php echo ${'image_' . $i}; ?>" class="rounded-circle img-responsive">
								</div>

								<div class="card-block">
									<!--Name-->
									<h4 class="card-title"><?php echo ${'name_' . $i}; ?></h4>
									<hr>
									<!--Quotation-->
									<p><i class="fa fa-quote-left"></i> <?php echo ${'quote_' . $i}; ?></p>
								</div>

							</div>
							<!--/.Card-->

						</div>
						<!--/<?php $i; ?> column -->

					<?php } ?>
				<?php } ?>
			</div>


		<?php } else { ?>

			<div id="carousel-example-<?php echo $widget_id; ?>" class="carousel testimonial-carousel slide carousel-fade <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" data-ride="carousel" data-interval="false">

				<div class="carousel-inner" role="listbox" style="text-align: center;">


					<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
						<?php if ( ${'image_' . $i} != '' ) { ?>
							<div class="carousel-item <?php echo $i == '1' ? ' active ' : '' ?>"> 
							  <!--<?php $i; ?> column -->
								<div class="col-md-12 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>">

									<!--Card-->
									<div class="card testimonial-card">

										<!--Background color-->
										<div class="card-up" style="background-color:<?php echo ${'color_' . $i}; ?>"><!--1:teal lighten-2 || 2: indigo darken-2 || 3:purple darken-2 -->
										</div>

										<!--Avatar-->
										<div class="avatar"><img src="<?php echo ${'image_' . $i}; ?>" class="rounded-circle img-responsive">
										</div>

										<div class="card-block">
											<!--Name-->
											<h4 class="card-title"><?php echo ${'name_' . $i}; ?></h4>
											<hr>
											<!--Quotation-->
											<p><i class="fa fa-quote-left"></i> <?php echo ${'quote_' . $i}; ?></p>
										</div>

									</div>
									<!--/.Card-->

								</div>
								<!--/<?php $i; ?> column -->
							</div>
						<?php } ?>
					<?php } ?>
				</div>
				<?php if ( $amount > 1 ) { ?>
					<a class="left carousel-control " href="#carousel-example-<?php echo $widget_id; ?>" role="button" data-slide="prev" style="background-image: none;">
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

	</section>
	<!--Section: Testimonials v.1-->
</div>
