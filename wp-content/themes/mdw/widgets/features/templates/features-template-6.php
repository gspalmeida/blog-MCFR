<?php
/* General variables */
$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? nl2br( $instance[ 'main_content' ] ) : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

$img_title	 = ( isset( $instance[ 'img_title' ] ) ) ? $instance[ 'img_title' ] : 'left';
$img_align	 = ( isset( $instance[ 'img_align' ] ) ) ? $instance[ 'img_align' ] : 'left';
$text_align	 = ( isset( $instance[ 'text_align' ] ) ) ? $instance[ 'text_align' ] : 'left';

if ( $text_align == "top" ) {
	$text_align_img = "bottom";
} elseif ( $text_align == "bottom" ) {
	$text_align_img = "top";
} else {
	$text_align_img = $text_align;
}
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>">
	<section class="section pt-3 pb-4">
		<!-- Section title -->
		<div class="state-programs-top-fellowship-card grid-fade">
			<div class="card-horizontal" style="height: 553px;">
				<div class="card-horizontal-media" style="background-image: url( <?php echo $image ?>);"></div>
				<div class="card-horizontal-content">
					<div class="card-horizontal-content-category ">  </div>
					<div class="card-horizontal-content-title"><p> <?php echo $title ?> </p></div>
					<div class="card-horizontal-content-body"> <?php echo $main_content ?> </div>
				</div>
			</div>
		</div>
	</section>
</div>