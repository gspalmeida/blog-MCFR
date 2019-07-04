<?php
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$fieldCount  = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$options_amount = 6;
for ( $i = 1; $i <= 6; $i++ ) {
	${'pricing_title_' . $i}	 = ( isset( $instance[ 'pricing_title_' . $i ] ) ) ? $instance[ 'pricing_title_' . $i ] : '';
	${'price_' . $i}			 = ( isset( $instance[ 'price_' . $i ] ) ) ? $instance[ 'price_' . $i ] : '';
    ${'periodic_time_' . $i}             = ( isset( $instance[ 'periodic_time_' . $i ] ) ) ? $instance[ 'periodic_time_' . $i ] : 'mo';
	${'background_image_' . $i}	 = ( isset( $instance[ 'background_image_' . $i ] ) ) ? $instance[ 'background_image_' . $i ] : '';
	${'button_text_' . $i}		 = ( isset( $instance[ 'button_text_' . $i ] ) ) ? $instance[ 'button_text_' . $i ] : '';
	${'button_href_' . $i}		 = ( isset( $instance[ 'button_href_' . $i ] ) ) ? $instance[ 'button_href_' . $i ] : '';

	for ( $j = ($i - 1) * $options_amount + 1; $j <= ($i - 1) * $options_amount + $options_amount; $j++ ) {
		${'feature_' . $j} = ( isset( $instance[ 'feature_' . $j ] ) ) ? $instance[ 'feature_' . $j ] : '';
	}
}
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Pricing v.2-->
	<section class="section col-md-12">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
		<!--Section description-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content; ?></p><?php } ?>

		<!--First row-->
		<div class="row">
			<?php for ( $i = 1; $i <= $fieldCount; $i++ ) { ?>
				<!--First column-->
				<div class="col-lg-<?php echo floor(12 / $fieldCount); ?> col-md-12 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

					<!--Pricing card-->
					<div class="card-overlay pricing-card" style="background-image: url('<?php echo ${'background_image_' . $i} ?>')">

						<!--Content-->
						<div class="white-text text-xs-center">
							<div class="card-block">
								<h5><?php echo ${'pricing_title_' . $i} ?></h5>
								<!--Price-->
								<div class="price">
									<h1><?php echo ${'price_' . $i} ?><span style="position: absolute; margin-top: 3rem; font-size: 30px;">/<?php echo ${'periodic_time_' . $i}; ?></span></h1>
								</div>
								<!--/.Price-->
								<ul class="striped">
									<?php for ( $j = ($i - 1) * $options_amount + 1; $j <= ($i - 1) * $options_amount + $options_amount; $j++ ) { ?>
										<?php if ( !empty( ${'feature_' . $j} ) ) { ?>
											<li>
												<p><?php echo ${'feature_' . $j} ?></p>
											</li>
										<?php } ?>
									<?php } ?>
								</ul>
                                <?php if(${'button_text_' . $i} != ""){ ?>
								<a class="btn btn-lg btn-outline-white" href="<?php echo ${'button_href_' . $i} ?>"> <?php echo ${'button_text_' . $i} ?></a>
                                <?php } ?>
							</div>
						</div>


					</div>
					<!--/.Pricing card-->

				</div>
				<!--/First column-->
			<?php } ?>
		</div>
		<!--/First row-->

	</section>
	<!--/Section: Pricing v.2-->
</div>
