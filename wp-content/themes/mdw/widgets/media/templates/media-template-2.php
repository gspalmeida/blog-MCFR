<?php
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$button_text	 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
$button_href	 = ( isset( $instance[ 'button_href' ] ) ) ? $instance[ 'button_href' ] : '';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$video			 = ( isset( $instance[ 'video' ] ) ) ? $instance[ 'video' ] : '';
$caption		 = ( isset( $instance[ 'caption' ] ) ) ? $instance[ 'caption' ] : '';
?>
<div class="container">
	<!--Section: Media Video v.1-->
	<section class="section magazine-section">
		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title ?></h1><?php } ?>

		<!--Section description-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content ?></p><?php } ?>
		<!--First row-->
		<div class="row" id="home">

			<!--First column-->
			<div class="col-md-8 offset-md-2 extra-margins">
				<!--/First column-->    
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="<?php echo str_replace( 'watch?v=', 'embed/', esc_attr( $video ) ); ?>" allowfullscreen></iframe>
				</div>
			</div>
		</div>
</div>