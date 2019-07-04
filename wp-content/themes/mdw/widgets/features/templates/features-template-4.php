<?php
$bg_image			 = ( isset( $instance[ 'background_image' ] ) ) ? $instance[ 'background_image' ] : '';
$title_text			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$title_description	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$box_layout			 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation			 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$amount = 6;
for ( $i = 1; $i <= $amount; $i++ ) {
	${"title_" . $i}			 = ( isset( $instance[ 'title_' . $i ] ) ) ? $instance[ 'title_' . $i ] : '';
	${"desc_" . $i}				 = ( isset( $instance[ 'desc_' . $i ] ) ) ? $instance[ 'desc_' . $i ] : '';
	${"icon_" . $i}				 = ( isset( $instance[ 'post_icon_' . $i ] ) ) ? $instance[ 'post_icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'post_icon_container_' . $i ] ) ) ? $instance[ 'post_icon_container_' . $i ] : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'post_icon_color_' . $i ] ) ) ? $instance[ 'post_icon_color_' . $i ] : '';
}
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Features v.4-->
	<section class="section feature-box">

		<!--Section heading-->
		<?php if ( $title_text != '' ) { ?><h1 class="section-heading"><?php echo $title_text; ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( $title_description != '' ) { ?><p class="section-description lead"><?php echo $title_description; ?></p><?php } ?>

		<div class="container">

			<!--First row-->
			<div class="row features-small">

				<!--First column-->
				<div class="col-md-4 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
					<!--First row-->
					<?php if ( ${'desc_1'} != '' && ${'icon_container_1'} != '' ) { ?>
						<div class="row">
							<?php if ( ${'icon_container_1'} != '' ) { ?>
								<div class="col-xs-2">
									<i class="<?php echo ${'icon_container_1'}; ?>" style="color: <?php echo ${'icon_color_1'}; ?>"></i>
								</div>
							<?php } ?>
							<div class="col-xs-10">
								<h4 class="feature-title"><?php echo $title_1; ?></h4>
								<p class="grey-text"><?php echo $desc_1; ?></p>
								<div style="height:30px"></div>
							</div>
						</div>
					<?php } ?>
					<!--/First row-->

					<!--Second row-->
					<?php if ( $desc_2 != '' && $icon_container_2 != '' ) { ?>
						<div class="row">
							<div class="col-xs-2">
								<?php if ( $icon_container_2 != '' ) { ?>
									<i class="<?php echo $icon_container_2; ?>" style="color: <?php echo $icon_color_2; ?>"></i>
								</div>
							<?php } ?>
							<div class="col-xs-10">
								<h4 class="feature-title"><?php echo $title_2; ?></h4>
								<p class="grey-text"><?php echo $desc_2; ?></p>
								<div style="height:30px"></div>
							</div>
						</div>
					<?php } ?>
					<!--/Second row-->

					<!--Third row-->
					<?php if ( $desc_3 != '' && $icon_container_3 != '' ) { ?>
						<div class="row">
							<?php if ( $icon_container_3 != '' ) { ?>
								<div class="col-xs-2">
									<i class="<?php echo $icon_container_3; ?>" style="color: <?php echo $icon_color_3; ?>"></i>
								</div>
							<?php } ?>
							<div class="col-xs-10">
								<h4 class="feature-title"><?php echo $title_3; ?></h4>
								<p class="grey-text"><?php echo $desc_3; ?></p>
								<div style="height:30px"></div>
							</div>
						</div>
					<?php } ?>
					<!--/Third row-->
				</div>
				<!--/First column-->

				<!--Second column-->
				<div class="col-md-4 mb-r center-on-small-only <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
					<img src="<?php echo $bg_image; ?>" alt="" class="z-depth-0">
				</div>
				<!--/Second column-->

				<!--Third column-->

				<div class="col-md-4 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
					<!--First row-->
					<?php if ( $desc_4 != '' && $icon_container_4 != '' ) { ?>
						<div class="row">
							<?php if ( $icon_container_4 != '' ) { ?>
								<div class="col-xs-2">
									<i class="<?php echo $icon_container_4; ?>" style="color: <?php echo $icon_color_4; ?>"></i>
								</div>
							<?php } ?>
							<div class="col-xs-10">
								<h4 class="feature-title"><?php echo $title_4; ?></h4>
								<p class="grey-text"><?php echo $desc_4; ?></p>
								<div style="height:30px"></div>
							</div>
						</div>
					<?php } ?>
					<!--/First row-->

					<!--Second row-->
					<?php if ( $desc_5 != '' && $icon_container_5 != '' ) { ?>
						<div class="row">
							<?php if ( $icon_container_5 != '' ) { ?>
								<div class="col-xs-2">
									<i class="<?php echo $icon_container_5; ?>" style="color: <?php echo $icon_color_5; ?>"></i>
								</div>
							<?php } ?>
							<div class="col-xs-10">
								<h4 class="feature-title"><?php echo $title_5; ?></h4>
								<p class="grey-text"><?php echo $desc_5; ?></p>
								<div style="height:30px"></div>
							</div>
						</div>
					<?php } ?>
					<!--/Second row-->

					<!--Third row-->
					<?php if ( $desc_6 != '' && $icon_container_6 != '' ) { ?>
						<div class="row">
							<?php if ( $icon_container_6 != '' ) { ?>
								<div class="col-xs-2">
									<i class="<?php echo $icon_container_6; ?>" style="color: <?php echo $icon_color_6; ?>"></i>
								</div>
							<?php } ?>

							<div class="col-xs-10">
								<h4 class="feature-title"><?php echo $title_6; ?></h4>
								<p class="grey-text"><?php echo $desc_6; ?></p>
								<div style="height:30px"></div>
							</div>
						</div>
					<?php } ?>
					<!--/Third row-->
				</div>
				<!--/Third column-->
			</div>
			<!--/First row-->
		</div>

	</section>
	<!--/Section: Features v.4-->
</div>
