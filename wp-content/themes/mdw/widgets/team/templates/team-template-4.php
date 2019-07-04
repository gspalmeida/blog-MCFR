<?php
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';

$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

$fieldCount	 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : '0';
$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";


$amount = $fieldCount; // default for this project layout

for ( $i = 1; $i <= $amount; $i++ ) {
	${"name_" . $i}		 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "Name " . $i;
	${"content_" . $i}	 = ( isset( $instance[ "content_" . $i ] ) ) ? $instance[ "content_" . $i ] : "Content " . $i;
	${"avatar_" . $i}	 = ( isset( $instance[ "avatar_" . $i ] ) ) ? $instance[ "avatar_" . $i ] : "";
	${"image_" . $i}	 = ( isset( $instance[ "image_" . $i ] ) ) ? $instance[ "image_" . $i ] : "";
	${"job_" . $i}		 = ( isset( $instance[ "job_" . $i ] ) ) ? $instance[ "job_" . $i ] : "Job title" . $i;

	for ( $j = ($i - 1) * 4 + 1; $j <= ($i - 1) * 4 + 4; $j++ ) {
		${"icon_" . $j}				 = ( isset( $instance[ 'icon_' . $j ] ) ) ? $instance[ 'icon_' . $j ] : '<i class=\'fa fa-flag-checkered chosen\'></i>';
		${"icon_container_" . $j}	 = ( isset( $instance[ 'icon_container_' . $j ] ) ) ? $instance[ 'icon_container_' . $j ] : 'fa fa-flag-checkered chosen';
		${"icon_color_" . $j}		 = ( isset( $instance[ 'icon_color_' . $j ] ) ) ? $instance[ 'icon_color_' . $j ] : '';
		${"icon_url_" . $j}			 = ( isset( $instance[ 'icon_url_' . $j ] ) ) ? $instance[ 'icon_url_' . $j ] : '';
	}
	${"slider_" . $i} = ( isset( $instance[ "slider_" . $i ] ) ) ? $instance[ "slider_" . $i ] : "";
}
?>
<div class="<?php echo $box_layout; ?>">
	<!--Section: Team v.4-->
	<section class="section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content ?></p><?php } ?>
		<br>

		<div class="row">
			<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
				<div class="col-lg-4 col-md-6 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" data-post-id="<?php echo $widget_id; ?>">

					<!--Rotating card-->
					<div class="card-wrapper">
						<div id="card-<?php echo $i; ?>" class="card-rotating effect__click">

							<!--Front Side-->
							<div class="face front">

								<!-- Image-->
								<div class="card-up">
									<img src="<?php echo ${"image_" . $i} ?>">
								</div>
								<!--Avatar-->
								<div class="avatar"><img src="<?php echo ${"avatar_" . $i} ?>" class="rounded-circle img-responsive">
								</div>
								<!--Content-->
								<div class="card-block">
									<h4><?php echo ${"name_" . $i} ?></h4>
									<p><?php echo ${"job_" . $i} ?></p>
									<!--Triggering button-->
									<a class="rotate-btn" data-card="card-<?php echo $i; ?>"><i class="fa fa-repeat"></i> Click here to rotate</a>
								</div>
							</div>
							<!--/.Front Side-->

							<!--Back Side-->
							<div class="face back">

								<!--Content-->
								<h4>About me</h4>
								<hr>
								<p><?php echo ${"content_" . $i} ?></p>
								<hr>
								<!--Social Icons-->
								<ul class="inline-ul">
									<?php for ( $j = ($i - 1) * 4 + 1; $j <= ($i - 1) * 4 + 4; $j++ ) { ?>
										<?php if ( ${"icon_container_" . $j} != '' ) { ?>
											<li><a target="_blank"  class="icons-sm" style="<?php echo 'color:' . ${"icon_color_" . $j} ?>" href="<?php echo ${"icon_url_" . $j} ?>"><i class="<?php echo ${"icon_container_" . $j} ?>"></i></a></li>
										<?php } ?>
									<?php } ?>
								</ul>
								<!--Triggering button-->
								<a  class="rotate-btn" data-card="card-<?php echo $i; ?>"><i class="fa fa-undo"></i> Click here to rotate back</a>

							</div>
							<!--/.Back Side-->

						</div>
					</div>
					<!--/.Rotating card-->
				</div>
			<?php } ?>

		</div>

	</section>
	<!--/Section: Team v.4-->
</div>
