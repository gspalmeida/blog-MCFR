<?php
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$members_per_row = ( isset( $instance[ 'members_per_row' ] ) ) ? $instance[ 'members_per_row' ] : '1';

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
	<!--Section: Team v.3-->
	<section class="section team-section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content ?></p><?php } ?>

		<?php
		$row_count = ($amount / $members_per_row < 1) ? 1 : ceil( $amount / $members_per_row );

		for ( $j = 1; $j <= $row_count; $j++ ) {
			?>

			<div class="row">

				<?php for ( $i = ($j - 1) * $members_per_row + 1; $i <= ($j - 1) * $members_per_row + $members_per_row; $i++ ) { ?>

					<?php if ( $i <= $amount ) { ?>
						<!--First column-->
						<div class="col-lg-6 col-md-12 col-md-<?php echo ($i > ($row_count - 1) * $members_per_row) ? floor( 12 / ($amount - ($row_count - 1) * $members_per_row) ) : floor( 12 / $members_per_row ); ?> mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" data-post-id="<?php echo $widget_id; ?>" style="">

							<div class="col-md-6">
								<div class="avatar">
									<img src="<?php echo ${"image_" . $i} ?>" >
								</div>
							</div>

							<div class="col-md-6 text-xs-center text-md-left">
								<h4><?php echo ${"name_" . $i} ?></h4>
								<h5><?php echo ${"job_" . $i} ?></h5>
								<p><?php echo ${"content_" . $i} ?></p>

								<?php for ( $k = ($i - 1) * 3 + 1; $k <= ($i - 1) * 3 + 3; $k++ ) { ?>
									<?php if ( ${"icon_container_" . $j} != '' ) { ?>
										<a  target="_blank" class="icons-sm" style="<?php echo 'color:' . ${"icon_color_" . $k} ?>" href="<?php echo ${"icon_url_" . $k} ?>"><i class="<?php echo ${"icon_container_" . $k} ?>"> </i></a>
									<?php } ?>
								<?php } ?>
							</div>

						</div>
						<!--/First column-->
					<?php } ?>
				<?php } ?>

			</div>

		<?php } ?>

	</section>
	<!--/Section: Team v.3-->
</div>
