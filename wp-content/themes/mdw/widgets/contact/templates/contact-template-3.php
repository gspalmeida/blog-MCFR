<?php
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$address		 = ( isset( $instance[ 'address' ] ) ) ? $instance[ 'address' ] : '';
$country		 = ( isset( $instance[ 'country' ] ) ) ? $instance[ 'country' ] : '';
$phone			 = ( isset( $instance[ 'phone' ] ) ) ? $instance[ 'phone' ] : '';
$email_1		 = ( isset( $instance[ 'email_1' ] ) ) ? $instance[ 'email_1' ] : '';
$name			 = ( isset( $instance[ 'name' ] ) ) ? $instance[ 'name' ] : '';
$first_title	 = ( isset( $instance[ 'first_title' ] ) ) ? $instance[ 'first_title' ] : '';
$second_title	 = ( isset( $instance[ 'second_title' ] ) ) ? $instance[ 'second_title' ] : '';
$thirt_title	 = ( isset( $instance[ 'third_title' ] ) ) ? $instance[ 'third_title' ] : '';


$amount = 3;
for ( $i = 1; $i <= $amount; $i++ ) {

	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
	${"icon_url_" . $i}			 = ( isset( $instance[ "icon_url_" . $i ] ) ) ? $instance[ "icon_url_" . $i ] : '';
	${"day_" . $i}				 = ( isset( $instance[ "day_" . $i ] ) ) ? $instance[ "day_" . $i ] : '';
	${"hour_" . $i}				 = ( isset( $instance[ "hour_" . $i ] ) ) ? $instance[ "hour_" . $i ] : '';
}
?>

<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>">
	<div class="text-xs-center wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">

		<!--First column-->
		<div class="col-md-4">

			<!--Title-->
			<h5 class="title"><?php echo $first_title ?></h5>

			<!--Opening hours table-->
			<table class="table">
				<tbody>
					<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
						<?php if ( ${"day_" . $i} != '' ) { ?>
							<tr>
								<td><?php echo ${"day_" . $i} ?></td>
								<td><?php echo ${"hour_" . $i} ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>

		</div>
		<!--/First column-->

		<hr class="hidden-md-up">

		<!--Second column-->
		<div class="col-md-4">

			<!--Title-->

			<?php if ( $address == '' && $country == '' ) { ?>

			<?php } else { ?><h5 class="title"><?php echo $second_title ?></h5>

				<!--Address-->
				<p>
					<?php if ( $address != '' ) { ?><?php echo $address ?><br> <?php } ?>
					<?php if ( $country != '' ) { ?><?php echo $country ?><br> <?php } ?>
				</p>
				<!--Title-->
			<?php } ?>
			<?php if ( $name == '' && $phone == '' && $email_1 == '' ) { ?>

			<?php } else { ?><h5 class="title"><?php echo $thirt_title ?></h5>

				<!--Contact info-->
				<p>
					<?php if ( $name != '' ) { ?><?php echo $name ?><br> <?php } ?>
					<?php if ( $phone != '' ) { ?><?php echo $phone ?><br> <?php } ?>
					<?php if ( $email_1 != '' ) { ?><?php echo $email_1 ?> <?php } ?>
				</p>
			<?php } ?>

		</div>
		<!--/Second column-->

		<hr class="hidden-md-up">

		<!--Third column-->
		<div class="col-md-4">

			<!--Title-->
			<h5 class="title">Stay in touch</h5>

			<!--Social buttons-->
			<div class="social-section">

				<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
					<?php if ( ${"icon_container_" . $i} != '' ) { ?>
						<a href="<?php echo ${"icon_url_" . $i} ?>" class=" btn-floating btn-small" style=" background-color: <?php echo ${"icon_color_" . $i} ?>" ><i style="color: white;" class=" <?php echo ${"icon_container_" . $i} ?> "> </i></a>
					<?php } ?>
				<?php } ?>

				<!--/Social buttons-->
			</div>

		</div>
		<!--/Third column-->

	</div>
</div>
