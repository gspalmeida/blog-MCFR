<?php
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$fieldCount		 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$amount			 = $fieldCount;
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";


for ( $i = 1; $i <= $amount; $i++ ) {

	${"name_" . $i}		 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : '';
	${"quote_" . $i}	 = ( isset( $instance[ "quote_" . $i ] ) ) ? $instance[ "quote_" . $i ] : '';
	${"image_" . $i}	 = ( isset( $instance[ "image_" . $i ] ) ) ? $instance[ "image_" . $i ] : "";
	${"bg_image_" . $i}	 = ( isset( $instance[ "bg_image_" . $i ] ) ) ? $instance[ "bg_image_" . $i ] : "";

	// Depending on loopMultiplier creates specified amount of icons
	for ( $j = ($i - 1) * 3 + 1; $j <= ($i - 1) * 3 + 3; $j++ ) {
		${"icon_" . $j}				 = ( isset( $instance[ 'icon_' . $j ] ) ) ? $instance[ 'icon_' . $j ] : '';
		${"icon_container_" . $j}	 = ( isset( $instance[ 'icon_container_' . $j ] ) ) ? $instance[ 'icon_container_' . $j ] : '';
		${"icon_color_" . $j}		 = ( isset( $instance[ 'icon_color_' . $j ] ) ) ? $instance[ 'icon_color_' . $j ] : '#607d8b';
	}
}
?>

<div class="<?php echo $box_layout; ?>">
    <div class="row">
	<!--Section: Testimonials v.1-->
	<section class="section">
		<!--Section heading-->
		<?php if ( $title != '' ) { ?>
			<h1 class="section-heading"><?php echo $title; ?></h1>
		<?php } ?>
        <!--Section sescription-->
		<?php if ( $main_content != '' ) { ?>
			<p class="section-description">
				<?php echo $main_content; ?>
			</p>
		<?php } ?>

		<?php
		$sidebar = is_active_widget( false, $this->id, 'mdw_testimonials', false );
		if ( strpos( $sidebar, 'sidebar' ) === false ) {
			?> 

					<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
						<?php if ( ${'image_' . $i} != '' ) { ?>
							<!--Sidebar 1-->
							<div class="col-xl-4 col-md-12">
								<!--Author card-->
								<section class="wow fadeIn">
									<!--Card-->
									<div class="card author-card">
										<!--Background image-->
										<div class="card-up" > <img src="<?php echo ${'bg_image_' . $i}; ?>" class="img-fluid"> </div>
										<!--Avatar-->
										<div class="avatar"> <img src="<?php echo ${'image_' . $i}; ?>" class="img-fluid img-author"> </div>
										<div class="card-block">
											<!--Name-->
											<h4 class="card-title"><strong><?php echo ${'name_' . $i}; ?></strong></h4>
											<!--Description-->
											<p>
												<?php echo ${"quote_1"}; ?>
											</p>
											<?php for ( $j = ($i - 1) * 3 + 1; $j <= ($i - 1) * 3 + 3; $j++ ) { ?>
												<!--Dribbble--><a class="icons-sm" style="color:<?php echo ${"icon_color_" . $j} ?>"><i class="<?php echo ${"icon_container_" . $j}; ?>"> </i></a>
											<?php } ?>
										</div>
									</div>
									<!--/Card-->
								</section>
								<!--/Author card-->
							</div>
						<?php } ?>
					<?php } ?>
					<!--/Sidebar 1-->

		<?php } else {
			$k = 0;
			?>
			<div id="carousel-example-<?php echo $widget_id; ?>" class="carousel testimonial-carousel slide carousel-fade <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" data-ride="carousel" data-interval="false">

				<div class="carousel-inner" role="listbox" style="text-align: center;">
					<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
						<?php
						if ( ${'image_' . $i} != '' ) {
							$k++;
							?>
							<div class="carousel-item <?php echo $i == '1' ? ' active ' : '' ?>"> 
								<!--Sidebar 1-->
								
                                
									<!--Author card-->
                                
									
										<!--Card-->
										<div class="card author-card">
											<!--Background image-->
											<div class="card-up" > <img src="<?php echo ${'bg_image_' . $i}; ?>" class="img-fluid"> </div>
											<!--Avatar-->
											<div class="avatar"> <img src="<?php echo ${'image_' . $i}; ?>" class="img-fluid img-author"> </div>
											<div class="card-block">
												<!--Name-->
												<h4 class="card-title"><strong><?php echo ${'name_' . $i}; ?></strong></h4>
												<!--Description-->
												<p>
												<?php echo ${"quote_1"}; ?>
												</p>
												<?php for ( $j = ($i - 1) * 3 + 1; $j <= ($i - 1) * 3 + 3; $j++ ) { ?>
													<!--Dribbble--><a class="icons-sm" style="color:<?php echo ${"icon_color_" . $j} ?>"><i class="<?php echo ${"icon_container_" . $j}; ?>"> </i></a>
                                    			<?php } ?>
											</div>
										</div>
										<!--/Card-->
									
									<!--/Author card-->
                                
								
							</div>
		<?php } ?>
				<?php } ?>
					<!--/Sidebar 1-->
				</div>
	<?php if ( $amount > 1 ) { ?>
					<a class="left carousel-control" href="#carousel-example-<?php echo $widget_id; ?>" role="button" data-slide="prev" style="background-image: none;">
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
    </div>
</div>