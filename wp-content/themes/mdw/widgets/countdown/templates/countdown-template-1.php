<?php
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$background_color	 = ( isset( $instance[ 'background_color' ] ) ) ? $instance[ 'background_color' ] : '';
$font_color			 = ( isset( $instance[ 'font_color' ] ) ) ? $instance[ 'font_color' ] : '';
$box_layout			 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$day				 = ( ( isset( $instance[ 'day' ] ) ) ) ? $instance[ 'day' ] : '';
$month				 = ( ( isset( $instance[ 'month' ] ) ) ) ? $instance[ 'month' ] : '';
$year				 = ( ( isset( $instance[ 'year' ] ) ) ) ? $instance[ 'year' ] : '0';
$hour				 = ( ( isset( $instance[ 'hour' ] ) ) ) ? $instance[ 'hour' ] : '0';
$minute				 = ( ( isset( $instance[ 'minute' ] ) ) ) ? $instance[ 'minute' ] : '';
$animation			 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
?>

<div class="<?php echo $box_layout; ?> mt-1" id="<?php echo $widget_id; ?>">
	<section class="section countdown-widget" style="background:<?php echo $background_color; ?>;color:<?php echo $font_color; ?>;">



		<div id="clockdiv" class="z-depth-1 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
			<!--Section description--><!--Section heading-->
			<h3><?php echo $title; ?></h3>
			<div>
				<div class="smalltext"><?php _e( 'Days', 'mdw' ); ?></div>
				<span class="days"></span>
			</div>
			<div class='colon'>:</div>
			<div>
				<div class="smalltext"><?php _e( 'Hours', 'mdw' ); ?></div>
				<span class="hours"></span>
			</div>
			<div class='colon'>:</div>
			<div>
				<div class="smalltext"><?php _e( 'Minutes', 'mdw' ); ?></div>
				<span class="minutes"></span>
			</div>
			<div class='colon'>:</div>
			<div>
				<div class="smalltext"><?php _e( 'Seconds', 'mdw' ); ?></div>
				<span class="seconds"></span>
			</div>
		</div>
	</section>
</div>


<script>
    document.addEventListener( 'DOMContentLoaded', function () {
        var day = parseInt( "<?php echo $day; ?>" );
        var month = parseInt( "<?php echo $month; ?>" ) - 1;
        var year = parseInt( "<?php echo $year; ?>" );
        var hour = parseInt( "<?php echo $hour; ?>" ) || 0;
        var minute = parseInt( "<?php echo $minute; ?>" ) || 0;
        var deadline = new Date( year, month, day, hour, minute, 0, 0 );
        initializeClock( 'clockdiv', deadline );
    } );

</script>
