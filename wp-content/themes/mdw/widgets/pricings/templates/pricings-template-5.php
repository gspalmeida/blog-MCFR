<?php
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$fieldCount  = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

for ( $i = 1; $i <= 3; $i++ ) {
	${'pricing_title_' . $i}	 = ( isset( $instance[ 'pricing_title_' . $i ] ) ) ? $instance[ 'pricing_title_' . $i ] : '';
	${'pricing_text_' . $i}		 = ( isset( $instance[ 'pricing_text_' . $i ] ) ) ? $instance[ 'pricing_text_' . $i ] : '';
	${'price_' . $i}			 = ( isset( $instance[ 'price_' . $i ] ) ) ? $instance[ 'price_' . $i ] : '';
	${'icon_' . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${'icon_container_' . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
	${'icon_color_' . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
	${'button_text_' . $i}		 = ( isset( $instance[ 'button_text_' . $i ] ) ) ? $instance[ 'button_text_' . $i ] : '';
	${'button_href_' . $i}		 = ( isset( $instance[ 'button_href_' . $i ] ) ) ? $instance[ 'button_href_' . $i ] : '';
}
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >
<!--Section: Pricing v.3-->
<section class="section col-md-12">

    <!--Section heading-->
	<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
    <!--Section description-->
	<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo $main_content; ?></p><?php } ?>

    <!--First row-->
    <div class="row">
		<?php for ( $i = 1; $i <= $fieldCount; $i++ ) { ?>
			<!--First column-->
			<div class="col-lg-<?php echo floor(12 / $fieldCount); ?> col-md-12 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?> ">
				<!--Card-->
				<div class="card <?php echo $i == 2 ? 'gradient' : ''; ?>" >

					<!--Content-->
					<div class="text-xs-center <?php echo $i == 2 ? ' white-text' : ''; ?>">
						<div class="card-block">
							<h5><?php echo ${'pricing_title_' . $i}; ?></h5>
							<div class="flex-center">
								<div class="card-circle">
									<i class="<?php echo ${'icon_container_' . $i}; ?>" <?php echo ( ${'icon_container_' . $i} != '' ? ( 'style="color:' . ${'icon_color_' . $i} . '"' ) : 'class="blue-text"' ); ?>></i>
								</div>
							</div>

							<!--Price-->
							<h2><strong><?php echo ${'price_' . $i}.' $'; ?></strong></h2>
							<p><?php echo ${'pricing_text_' . $i}; ?></p>
                            <?php if(${'button_text_' . $i} != ""){ ?>
							<a class="btn <?php echo $i == 2 ? ' btn-outline-white' : 'btn-primary'; ?>  btn-rounded" href="<?php echo ${'button_href_' . $i}; ?>" <?php echo ( ( $i != 2 && ${'icon_container_' . $i} != '' ) ? ( 'style=""' ) : '' ); ?> ><?php echo ${'button_text_' . $i}; ?></a>
                            <?php } ?>
						</div>
					</div>

				</div>
				<!--/.Card-->
			</div>
			<!--/First column-->
		<?php } ?>


    </div>
    <!--/First row-->

</section>
<!--/Section: Pricing v.3-->
</div>