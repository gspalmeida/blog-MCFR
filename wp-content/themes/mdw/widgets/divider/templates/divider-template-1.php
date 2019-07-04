<?php
$title	 = ( isset( $instance[ "title" ] ) ) ? $instance[ "title" ] : "";
$color	 = ( isset( $instance[ "color" ] ) ) ? $instance[ "color" ] : "";

$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$box_layout	 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';

?>
<style>
	#<?php echo  $widget_id;?> .divider-new::before, #<?php echo  $widget_id;?> .divider-new::after{
		background: <?php echo $color; ?>;
	}
</style>
<div class="<?php echo $box_layout; ?>">
	<div class="row">
		<div class="col-md-12 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
			<?php if ( $title != '' ) { ?>
				<div class="divider-new">
					<h2 class="h2-responsive"><?php echo $title; ?></h2>
				</div>
			<?php } else { ?>
				<hr style="border-top: 1.5px <?php echo $color; ?> solid;" class="mt-3 mb-2">
			<?php } ?>
		</div>
	</div>
</div>