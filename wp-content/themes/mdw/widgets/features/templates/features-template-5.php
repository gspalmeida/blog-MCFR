<?php
/* General variables */
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? nl2br( $instance[ 'main_content' ] ) : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

$img_title	 = ( isset( $instance[ 'img_title' ] ) ) ? $instance[ 'img_title' ] : 'left';
$img_align	 = ( isset( $instance[ 'img_align' ] ) ) ? $instance[ 'img_align' ] : 'left';
$text_align	 = ( isset( $instance[ 'text_align' ] ) ) ? $instance[ 'text_align' ] : 'left';
$image1	 = ( isset( $instance[ 'image1' ] ) ) ? $instance[ 'image1' ] : '';

if ( $text_align == "top" ) {
	$text_align_img = "bottom";
} elseif ( $text_align == "bottom" ) {
	$text_align_img = "top";
} else {
	$text_align_img = $text_align;
}
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >
	<section class="section pt-3 pb-4">
		<!-- Section title -->
		<h1 class="section-heading"><?php echo $title; ?></h1>

		<!-- First row -->
		<div class="row">
			<?php if ( $img_align == 'left' ) { ?>
				<!-- Place for photo -->
				<div class="col-lg-4 mb-r">
					<div class="view">
						<img src="<?php echo $image1; ?>" class="img-fluid" alt="">
					</div>
				</div>

				<!-- Text content -->
				<div class="col-lg-8" style="text-align:<?php echo $text_align; ?>">
					<p class="lead"><?php echo $img_title; ?></p>
					<?php echo $main_content; ?>
				</div>
			<?php } else { ?>
				<!-- Text content -->
				<div class="col-lg-8" style="text-align:<?php echo $text_align; ?>">
					<p class="lead"><?php echo $img_title; ?></p>
					<?php echo $main_content; ?>
				</div>

				<!-- Place for photo -->
				<div class="col-lg-4 mb-r">
					<div class="view">
						<img src="<?php echo $image1; ?>" class="img-fluid" alt="">
					</div>
				</div>
			<?php } ?>
		</div>
		<!-- /.First row -->

	</section>
</div>