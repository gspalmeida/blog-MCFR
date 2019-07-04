<?php
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';

$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

$fieldCount	 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : '0';
$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";


$amount = $fieldCount; // default for this project layout

for ( $i = 1; $i <= $amount * 3; $i++ ) {
	${"name_" . $i}		 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "Name " . $i;
	${"content_" . $i}	 = ( isset( $instance[ "content_" . $i ] ) ) ? $instance[ "content_" . $i ] : "Content " . $i;
	${"image_" . $i}	 = ( isset( $instance[ "image_" . $i ] ) ) ? $instance[ "image_" . $i ] : "";
	${"job_" . $i}		 = ( isset( $instance[ "job_" . $i ] ) ) ? $instance[ "job_" . $i ] : "Job title" . $i;

	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '<i class=\'fa fa-flag-checkered chosen\'></i>';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : 'fa fa-flag-checkered chosen';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
	${"icon_url_" . $i}			 = ( isset( $instance[ 'icon_url_' . $i ] ) ) ? $instance[ 'icon_url_' . $i ] : '';

	${"slider_" . $i} = ( isset( $instance[ "slider_" . $i ] ) ) ? $instance[ "slider_" . $i ] : "";
}
?>
<div class="<?php echo $box_layout; ?>">
	<!--Section: Team v.5-->
	<section class="section team-section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content ?></p><?php } ?>

		<!--First row-->
		<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
			<div class="row">
				<?php if ( $i % 2 == 0 ) { ?>
					<div class="col-lg-6 text-xs-center mb-3">
						<h4><?php echo ${"name_" . $i} ?></h4>
						<h5><?php echo ${"job_" . $i} ?></h5>
						<p><?php echo ${"content_" . $i} ?></p>

						<?php for ( $j = ($i - 1) * 3 + 1; $j <= ($i - 1) * 3 + 3; $j++ ) { ?>
							<?php if ( ${"icon_container_" . $j} != '' ) { ?>
								<a target="_blank" class="icons-sm" style="<?php echo 'color:' . ${"icon_color_" . $j} ?>" href="<?php echo ${"icon_url_" . $j} ?>"><i class="<?php echo ${"icon_container_" . $j} ?>"> </i></a>
							<?php } ?>
						<?php } ?>
					</div>
					<div class="col-lg-4 offset-lg-1 col-md-5 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" data-post-id="<?php echo $widget_id; ?>">

						<div class="avatar">
							<img src="<?php echo ${"image_" . $i} ?>" class="img-fluid">
						</div>

					</div>
				<?php } else { ?>
					<div class="col-lg-4 offset-lg-1 col-md-5 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" data-post-id="<?php echo $widget_id; ?>">

						<div class="avatar">
							<img src="<?php echo ${"image_" . $i} ?>" class="img-fluid">
						</div>

					</div>
					<div class="col-lg-6 text-xs-center mb-3">
						<h4><?php echo ${"name_" . $i} ?></h4>
						<h5><?php echo ${"job_" . $i} ?></h5>
						<p><?php echo ${"content_" . $i} ?></p>

						<?php for ( $j = ($i - 1) * 3 + 1; $j <= ($i - 1) * 3 + 3; $j++ ) { ?>
							<?php if ( ${"icon_container_" . $j} != '' ) { ?>
								<a target="_blank" class="icons-sm" style="<?php echo 'color:' . ${"icon_color_" . $j} ?>" href="<?php echo ${"icon_url_" . $j} ?>"><i class="<?php echo ${"icon_container_" . $j} ?>"> </i></a>
							<?php } ?>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<br class="hidden-sm-up">
		<?php } ?>
		<!--/First row-->

	</section>
	<!--/Section: Team v.1-->
</div>
