<?php
$title						 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content				 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$counter_background_image	 = ( isset( $instance[ 'counter_background_image' ] ) ) ? $instance[ 'counter_background_image' ] : '';
$fieldCount					 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$box_layout					 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation					 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id					 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

for ( $i = 1; $i <= $fieldCount; $i++ ) {
	${"name_" . $i}		 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "";
	${"number_" . $i}	 = ( isset( $instance[ "number_" . $i ] ) ) ? $instance[ "number_" . $i ] : "";
	${"size_" . $i}		 = ( isset( $instance[ "size_" . $i ] ) ) ? $instance[ "size_" . $i ] : "";
	${"color_" . $i}	 = ( isset( $instance[ "color_" . $i ] ) ) ? $instance[ "color_" . $i ] : "";
}
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<section class="col-md-12 counter-widget <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"
			 style="background: url('<?php echo $counter_background_image; ?>') center center no-repeat; background-size: 100%;">    
				 <?php for ( $i = 1; $i <= $fieldCount; $i++ ) { ?>
			<div class="text-xs-center col-md-<?php echo floor( 12 / $fieldCount ); ?>">
				<span class="min-chart"
					  data-percent="<?php echo ${"number_" . $i}; ?>"
					  data-color="<?php echo ${"color_" . $i}; ?>"
					  data-size="<?php echo ${"size_" . $i}; ?>"
					  style="height:<?php echo ${"size_" . $i} ?>px; width:<?php echo ${"size_" . $i} ?>px;">
					<span class="percent" style="line-height:<?php echo ${"size_" . $i}; ?>px; font-size:<?php echo ${"size_" . $i} / 5; ?>px;"></span>
				</span>
			</div>
		<?php } ?>
	</section>
</div>
