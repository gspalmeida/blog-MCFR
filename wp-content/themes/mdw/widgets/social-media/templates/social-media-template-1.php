<?php
$image		 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$box_layout	 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$fieldCount	 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';

for ( $i = 1; $i <= $fieldCount; $i++ ) {

	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
	${"icon_url_" . $i}			 = ( isset( $instance[ "icon_url_" . $i ] ) ) ? $instance[ "icon_url_" . $i ] : "Social url " . $i;
}
?>

<div class="<?php echo $box_layout; ?> mt-1" id="<?php echo $widget_id; ?>"  >
	<div class=" <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

		<!-- twoj kod -->
		<!--Social buttons-->
		<div class="social-section">
			<ul>
				<?php for ( $i = 1; $i <= $fieldCount; $i++ ) { ?>
					<li>
						<a href="<?php echo ${"icon_url_" . $i} ?>" class=" btn-floating btn-small" style=" background-color: <?php echo ${"icon_color_" . $i} ?>" ><i style="color: white;" class=" <?php echo ${"icon_container_" . $i} ?> "> </i></a>
					</li>
				<?php } ?>



            </ul>
		</div>
		<!--/.Social buttons-->

	</div>
</div>

