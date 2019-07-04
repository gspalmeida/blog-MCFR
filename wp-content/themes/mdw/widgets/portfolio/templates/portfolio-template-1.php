<?php
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$title_description	 = ( isset( $instance[ 'title_description' ] ) ) ? $instance[ 'title_description' ] : '';
$image1				 = ( isset( $instance[ 'image1' ] ) ) ? $instance[ 'image1' ] : '';
$image2				 = ( isset( $instance[ 'image2' ] ) ) ? $instance[ 'image2' ] : '';
$image3				 = ( isset( $instance[ 'image3' ] ) ) ? $instance[ 'image3' ] : '';
$image4				 = ( isset( $instance[ 'image4' ] ) ) ? $instance[ 'image4' ] : '';
$image5				 = ( isset( $instance[ 'image5' ] ) ) ? $instance[ 'image5' ] : '';
$animation   = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$box_layout			 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
wp_add_inline_script(
 'MDB', '$(function () {
            $("#mdb-lightbox-ui").load("' . get_template_directory_uri() . '/js/mdb-addons/mdb-lightbox-ui.html");
        });', 'after' );
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >

    <section id="portfolio" class="section col-md-12 team-section pt-3">

        <h1 class="section-heading"><?php echo $title; ?></h1>

		<p class="section-description"><?php echo $title_description; ?></p>

		<div class="row boxed-gallery">

			<!-- Boxed gallery -->

			<div id="mdb-lightbox-ui"></div>

			<div class="mdb-lightbox">

				<!-- First, big photo -->
				<?php if(!empty($image1)){ ?>
				<figure class="col-md-6">
					<a href="<?php echo $image1; ?>" data-size="1600x1067">
						<!-- Thumbnail-->
						<img src="<?php echo $image1; ?>" class="img-fluid">
					</a>
				</figure>
				<?php } ?>

				<!-- Small photos -->

				<!-- First row -->
				<?php if(!empty($image2)){ ?>
				<figure class="col-md-3 img-up">
					<a href="<?php echo $image2; ?>" data-size="1600x1067">
                        <!-- Thumbnail-->
						<img src="<?php echo $image2; ?>" class="img-fluid">
					</a>
				</figure>
				<?php } ?>
				
				<?php if(!empty($image3)){ ?>
				<figure class="col-md-3 img-up">
					<a href="<?php echo $image3; ?>" data-size="1600x1067">
                        <!-- Thumbnail-->
						<img src="<?php echo $image3; ?>" class="img-fluid">
					</a>
				</figure>
				<?php } ?>
				
				<?php if(!empty($image4)){ ?>
				<!-- Second row -->
				<figure class="col-md-3 img-down">
					<a href="<?php echo $image4; ?>" data-size="1600x1067">
						<!-- Thumbnail-->
						<img src="<?php echo $image4; ?>" class="img-fluid">
					</a>
				</figure>
				<?php } ?>
				
				<?php if(!empty($image5)){ ?>
				<figure class="col-md-3 img-down">
					<a href="<?php echo $image5; ?>" data-size="1600x1067">
						<!-- Thumbnail-->
						<img src="<?php echo $image5; ?>" class="img-fluid">
					</a>
				</figure>
				<?php } ?>
			</div>

			<!-- /.Boxed gallery -->

		</div>

    </section>

</div>