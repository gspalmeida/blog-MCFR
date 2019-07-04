<?php
$title						 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content				 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$counter_background_image	 = ( isset( $instance[ 'counter_background_image' ] ) ) ? $instance[ 'counter_background_image' ] : '';
$fieldCount					 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$box_layout					 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation					 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id					 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$title_color				 = ( isset( $instance[ 'title_color' ] ) ) ? $instance[ 'title_color' ] : "";
$content_color				 = ( isset( $instance[ 'content_color' ] ) ) ? $instance[ 'content_color' ] : "";

for ( $i = 1; $i <= $fieldCount; $i++ ) {
	${"name_" . $i}		 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "";
	${"number_" . $i}	 = ( isset( $instance[ "number_" . $i ] ) ) ? $instance[ "number_" . $i ] : "";
	${"color_" . $i}	 = ( isset( $instance[ "color_" . $i ] ) ) ? $instance[ "color_" . $i ] : "";
}
?>

<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
<div class="row">
	<section class="col-md-12 counter-widget <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"
			 style="background: url('<?php echo $counter_background_image; ?>') center center no-repeat; background-size: 100%;">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><br><h1 class="section-heading" style="padding-top: 1rem; color:<?php echo $title_color; ?>"><?php echo $title; ?></h1><?php } ?>
		<!--Section description-->
		<?php if ( $main_content != '' ) { ?><div><p class="section-description" style="color:<?php echo $content_color; ?>"><?php echo $main_content; ?></p></div><?php } ?>

		<div class="row">
			<div class="container" style="margin-bottom: 2rem;">
				<?php for ( $i = 1; $i <= $fieldCount; $i++ ) { ?>
					<div class="mobile-responsive col-md-<?php echo floor( 12 / $fieldCount ); ?> col-xs-6" style="color:<?php echo ${"color_" . $i}; ?>">
						<span data-counter="<?php echo $i; ?>"><?php echo ${"number_" . $i}; ?></span>
						<h4><?php echo ${"name_" . $i} ?></h4>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
</div>
</div>
