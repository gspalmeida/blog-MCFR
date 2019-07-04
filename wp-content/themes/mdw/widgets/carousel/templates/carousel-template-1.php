<?php
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$fieldCount		 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$what_to_feed	 = ( isset( $instance[ 'what_to_feed' ] ) ) ? $instance[ 'what_to_feed' ] : 'custom';
$mask			 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
$posts_amount	 = ( isset( $instance[ 'posts_amount' ] ) ) ? $instance[ 'posts_amount' ] : '';

/* Custom feed variables */
$amount = ($what_to_feed == 'custom') ? $fieldCount : $posts_amount; // default for that project layout
$half_carousel   = ( isset( $instance[ 'half_carousel' ] ) ) ? $instance[ 'half_carousel' ] : '';
for ( $i = 1; $i <= $amount; $i++ ) {
	${"image_" . $i}			 = ( isset( $instance[ "image_" . $i ] ) ) ? $instance[ "image_" . $i ] : "";
	${"caption_heading_" . $i}	 = ( isset( $instance[ "caption_heading_" . $i ] ) ) ? $instance[ "caption_heading_" . $i ] : "";
	${"caption_" . $i}			 = ( isset( $instance[ "caption_" . $i ] ) ) ? $instance[ "caption_" . $i ] : "";
}

wp_reset_query();
$query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $posts_amount ) );
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >
	<div class="section">
		
		<?php if ( !empty( $title ) ) { ?>
			<!-- Heading -->
			<nav class="navbar navbar-dark sidebar-heading">
				<div class="flex-center">
					<p ><?php echo $title; ?></p>
				</div> 
			</nav>
			<!--/ Heading -->
		<?php } ?>

		<!-- Carousel Wrapper -->
		<div id="carousel-<?php echo $widget_id; ?>" class="carousel slide carousel-fade z-depth-2 <?php if($half_carousel == "checked"){ echo 'half-carousel';} ?>" data-ride="carousel" <?php if($half_carousel == "checked"){ echo 'style="height: 50vh;"';} ?>>

			<ol class="carousel-indicators">
				<?php for ( $i = 0; $i < $amount; $i++ ) { ?>
					<li data-target="#carousel-<?php echo $widget_id; ?>" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? 'active' : '' ?>"></li>
				<?php } ?>
			</ol>

			<!-- Slides -->
			<div class="carousel-inner" role="listbox">
				<?php if ( $what_to_feed == 'custom' ) { //if custom ?>
					<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
						<!-- Slide <?php echo $i; ?> -->          
						<div class="carousel-item <?php echo ($i == 1) ? 'active' : ''; ?>">
							<?php if ( $mask == 'checked' ) { ?>
								<!--Mask color-->
								<div class="view hm-black-light">
									<img src="<?php echo ${'image_' . $i}; ?>" class="img-fluid img-responsive" alt="Slide <?php echo $i; ?>">
									<div class="full-bg-img"></div>
								</div>
							<?php } else { ?>
								<img src="<?php echo ${"image_" . $i}; ?>" alt="Slide <?php echo $i; ?>">
							<?php } ?>

							<!--Caption-->
							<?php if ( !empty( ${'caption_heading_' . $i} ) || !empty( ${'caption_' . $i} ) ) { ?>
								<div class="carousel-caption">
									<div class="fadeInDown">
										<?php if ( !empty( ${'caption_heading_' . $i} ) )  ?><h3 class="h3-responsive"><?php echo ${'caption_heading_' . $i} ?></h3>
										<?php if ( !empty( ${'caption_' . $i} ) )  ?><p><?php echo ${'caption_' . $i} ?></p>
									</div>
								</div>
							<?php } ?>
						</div>
						<!--/ Slide <?php echo $i; ?> -->
					<?php } ?>
					<?php
				} else { //if posts
					if ( $query->have_posts() ) {
						$i = 1;
						while ( $query->have_posts() ) {
							$query->the_post();
							?>
							<div class="carousel-item <?php echo ($i == 1) ? 'active' : '' ?>">
								<?php if ( $mask == 'checked' ) { ?>
									<!--Mask color-->
									<div class="view hm-black-light">
										<?php the_post_thumbnail( false, array( 'class' => 'img-fluid' ) ); ?>
										<div class="full-bg-img"></div>
									</div>
								<?php } else { ?>
									<?php the_post_thumbnail( false, array( 'class' => 'img-fluid' ) ); ?>
								<?php } ?>

								<!--Caption-->
								<div class="carousel-caption">
									<div class="fadeInDown">
										<h3 class="h3-responsive"><?php the_title(); ?></h3>
										<p><?php the_excerpt(); ?></p>
									</div>
								</div>
							</div>
							<?php
							$i++;
						}
						wp_reset_query();
					}
				}
				?>
			</div>
			<!--/ Slides -->

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-<?php echo $widget_id; ?>" role="button" data-slide="prev">
				<span class="icon-prev" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-<?php echo $widget_id; ?>" role="button" data-slide="next">
				<span class="icon-next" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
			<!--/ Controls -->
		</div>
		<!--/ Carousel Wrapper -->

	</div>
</div>