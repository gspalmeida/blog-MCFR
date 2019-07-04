<?php
$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$text			 = ( isset( $instance[ 'text' ] ) ) ? $instance[ 'text' ] : '';
$icon			 = ( isset( $instance[ 'icon' ] ) ) ? $instance[ 'icon' ] : '';
$icon_container	 = ( isset( $instance[ 'icon_container' ] ) ) ? $instance[ 'icon_container' ] : '';
$icon_color		 = ( isset( $instance[ 'icon_color' ] ) ) ? $instance[ 'icon_color' ] : '';
$icon_url		 = ( isset( $instance[ 'icon_url' ] ) ) ? $instance[ 'icon_url' ] : '';
?>





<div class="<?php echo $box_layout; ?> mt-1" id="<?php echo $widget_id; ?>"  >
	<div class=" <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
		<div class="row">
			<!--Card Light-->
			<div class="col-md-8 offset-md-2 extra-margins text-xs-center">
				<figure class="figure">
					<img src="<?php echo $image ?>" class="figure-img img-fluid text" alt="Responsive image" style="margin: 0 auto">

					<figcaption class="figure-caption text-xs-left" style="font-style: italic; padding-top: 0.3rem;"><?php echo $text ?></figcaption>

				</figure>
			</div>
		</div>
	</div>
</div>
<!--/.Card Light-->
