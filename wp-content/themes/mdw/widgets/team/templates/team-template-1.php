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
$i		 = 1;
?>
<div class="<?php echo $box_layout; ?>">
	<!--Section: Team v.1-->
	<section class="section team-section">
		<?php
		$sidebar = is_active_widget( false, $this->id, 'mdw_team', false );
		if ( strpos( $sidebar, 'sidebar' ) === false ) {
			?> 
			<!--Section heading-->
			<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
			<!--Section sescription-->
			<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content ?></p><?php } ?>

			<!--First row-->
			<div class="row text-xs-center">
				<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
					<div class="col-lg-<?php echo floor( 12 / $amount ) ?> col-md-6 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" data-post-id="<?php echo $widget_id; ?>">

						<div class="avatar">
							<img src="<?php echo ${"image_" . $i} ?>" class="rounded-circle">
						</div>
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
			<!--/First row-->
		<?php } else { ?>


			<!--Carousel Wrapper-->
			<div id="carousel-example-<?php echo $widget_id; ?>" class="carousel slide carousel-fade" data-ride="carousel">


				<!--Slides-->
				<div class="carousel-inner" role="listbox" style="text-align: center;">
					<!--First slide-->
					<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
						<div class="carousel-item <?php echo $i == '1' ? ' active ' : '' ?>">    
							<div class="col-lg-<?php echo floor( 12 / $amount ) ?> col-md-6 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" data-post-id="<?php echo $widget_id; ?>">

								<div class="avatar">
									<img src="<?php echo ${"image_" . $i} ?>" class="rounded-circle">
								</div>
								<h4><?php echo ${"name_" . $i} ?></h4>
								<h5><?php echo ${"job_" . $i} ?></h5>
								<p><?php echo ${"content_" . $i} ?></p>

								<?php
								for ( $j = ($i - 1) * 3 + 1; $j <= ($i - 1) * 3 + 3; $j++ ) {
									if ( ${"icon_container_" . $j} != '' ) {
										?>

										<a target="_blank" class="icons-sm" style="<?php echo 'color:' . ${"icon_color_" . $j} ?>" href="<?php echo ${"icon_url_" . $j} ?>"><i class="<?php echo ${"icon_container_" . $j} ?>"> </i></a>



									<?php }
								}
								?>
							</div>
						</div>
						<!--/First slide-->
	<?php } ?>
				</div>
				<!--/.Slides-->
				<!--Controls-->
	<?php if ( $amount > 1 ) { ?>
					<a class="left carousel-control" href="#carousel-example-<?php echo $widget_id; ?>" role="button" data-slide="prev">
						<span class="icon-prev" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-<?php echo $widget_id; ?>" role="button" data-slide="next">
						<span class="icon-next" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
	<?php } ?>
				<!--/.Controls-->
			</div>
			<!--/.Carousel Wrapper-->
<?php } ?>
	</section>
	<!--/Section: Team v.1-->
</div>
