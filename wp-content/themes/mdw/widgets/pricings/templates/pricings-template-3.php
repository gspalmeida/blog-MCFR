<?php
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$fieldCount  = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$background_image_2    = ( isset( $instance[ 'background_image_2' ] ) ) ? $instance[ 'background_image_2' ] : "";
$options_amount = 6;
for ( $i = 1; $i <= 3; $i++ ) {
	${'pricing_title_' . $i}	 = ( isset( $instance[ 'pricing_title_' . $i ] ) ) ? $instance[ 'pricing_title_' . $i ] : '';
	${'price_' . $i}			 = ( isset( $instance[ 'price_' . $i ] ) ) ? $instance[ 'price_' . $i ] : '';
    ${'periodic_time_' . $i}             = ( isset( $instance[ 'periodic_time_' . $i ] ) ) ? $instance[ 'periodic_time_' . $i ] : 'mo';
	${'button_text_' . $i}		 = ( isset( $instance[ 'button_text_' . $i ] ) ) ? $instance[ 'button_text_' . $i ] : '';
	${'button_href_' . $i}		 = ( isset( $instance[ 'button_href_' . $i ] ) ) ? $instance[ 'button_href_' . $i ] : '';

	for ( $j = ($i - 1) * $options_amount + 1; $j <= ($i - 1) * $options_amount + $options_amount; $j++ ) {
		${'feature_' . $j} = ( isset( $instance[ 'feature_' . $j ] ) ) ? $instance[ 'feature_' . $j ] : '';
	}
}
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Pricing v.5-->
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
					<!--Card-->
					<div class="pricing-card <?php echo ($i == 2) ? 'card-overlay pricing-card' : 'pricing-card naked-card' ?>" <?php echo ($i == 2) ? "style='background-image: url(\" ${'background_image_2'} \")'" : '' ?> >

						<!--Content-->
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
							<a class="<?php echo ($i == 2) ? 'btn btn-lg btn-outline-white' : 'btn btn-primary btn-lg' ?>" href="<?php echo ${'button_href_' . $i} ?>"> <?php echo ${'button_text_' . $i} ?></a>
                            <?php } ?>
						</div>
					</div>
					<!--/.Card-->
				</div>
				<!--/First column-->
			<?php } ?>
		</div>
		<!--/First row-->

	</section>
	<!--/Section: Pricing v.5-->
</div>
