<?php
/* General variables */
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$left_or_right	 = ( isset( $instance[ 'left_or_right' ] ) ) ? $instance[ 'left_or_right' ] : 'left';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$amount			 = 3; // default for this project layout

for ( $i = 1; $i <= $amount; $i++ ) {

	${"icon_text_" . $i}		 = ( isset( $instance[ "icon_text_" . $i ] ) ) ? $instance[ "icon_text_" . $i ] : "Icon text " . $i;
	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? str_replace( 'fa-4x', '', $instance[ 'icon_container_' . $i ] ) : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';

	${"content_" . $i} = ( isset( $instance[ "content_" . $i ] ) ) ? $instance[ "content_" . $i ] : "Content " . $i;
}
?>
<div class="<?php echo $box_layout; ?>">
	<!--Projects section v.4-->
	<section class="section extra-margins">

		<!--Section heading-->
		<?php if ( esc_attr( $title ) != '' ) { ?><h1 class="section-heading"><?php echo ( $title ); ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( esc_attr( $main_content ) != '' ) { ?><p class="section-description"><?php echo ( $main_content ); ?></p><?php } ?>

		<!--Row-->
		<div class="row">

			<?php if ( esc_attr( $left_or_right ) == 'left' ) { ?>
				<!--Left image column-->
				<div class="col-md-6 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
					<!--Image-->
					<img src="<?php echo esc_attr( $image ); ?>">
				</div>
				<!--/Left image column-->
			<?php } ?>

			<!--Content column-->
			<div class="col-md-5 <?php echo ( esc_attr( $left_or_right ) == 'left' ) ? ( ' col-md-offset-1' ) : ( ' mb-r' ) ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

				<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>

				   <!--<?php echo $i; ?> row-->
					<?php if ( ${"icon_container_" . $i} != '' ) { ?>
						<div class="row">
							<div class="col-xs-1 mr-1" style="color: <?php echo esc_attr( ${'icon_color_' . $i} ); ?>">
								<i class="<?php echo esc_attr( ${'icon_container_' . $i} ) ?> fa-2x"></i>
							</div>
							<div class="col-xs-10">
								<h4 class="feature-title"><?php echo ( ${'icon_text_' . $i} ); ?></h4>
								<p class="grey-text"><?php echo ( ${'content_' . $i} ); ?></p>
							</div>
						</div>
					<?php } ?>
				<!--/<?php echo $i; ?> row-->

					<?php if ( $i != $amount ) { ?> <div style="height:20px"></div> <?php } ?>

				<?php } ?>


			</div>
			<!--/Content column-->

			<?php if ( esc_attr( $left_or_right ) == 'right' ) { ?>
				<!--Right image column-->
				<div class="col-md-6  col-md-offset-1 mb-2 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
					<img src="<?php echo esc_attr( $image ); ?>">
				</div>
				<!--/Right image column-->
			<?php } ?>

		</div>
		<!--/Row-->

	</section>
	<!--/Projects section v.4-->
</div>
