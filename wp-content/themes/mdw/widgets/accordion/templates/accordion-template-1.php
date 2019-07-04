<?php
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$fieldCount		 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';

for ( $i = 1; $i <= $fieldCount; $i++ ) {
	${"name_" . $i}		 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "";
	${"content_" . $i}	 = ( isset( $instance[ "content_" . $i ] ) ) ? $instance[ "content_" . $i ] : "";
}
?>
<div class="<?php echo $box_layout; ?> mt-1" id="<?php echo $widget_id; ?>" >
	<!--Accordion wrapper-->
    <section class="section">
		<div class="accordion <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="accordion" role="tablist" aria-multiselectable="true">
			<?php if ( $title != '' ) { ?>
				<h1 class="section-heading"><?php echo $title; ?></h1> 
			<?php } ?>
			<?php if ( $main_content != '' ) { ?>
				<p class="section-description"><?php echo $main_content; ?></p>
			<?php } ?>
			<?php for ( $i = 1; $i <= $fieldCount; $i++ ) { ?>

				<div class="panel panel-default">
					<!--Panel heading-->
					<div class="panel-heading" role="tab" id="heading-<?php echo $i; ?>">
						<h5 class="panel-title">
							<a class="arrow-r" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne"><?php echo ${"name_" . $i}; ?><i class="fa fa-angle-down <?php echo ($i == 1) ? 'rotate-icon rotate-element' : '' ?> rotate-icon"></i>
							</a>
						</h5>
					</div>

					<!--Panel body-->
					<div id="collapse-<?php echo $i; ?>" class="panel-collapse collapse <?php echo ($i == 1) ? 'in' : '' ?>" role="tabpanel" aria-labelledby="heading-<?php echo $i; ?>"><?php echo ${"content_" . $i}; ?></div>
				</div>
			<?php } ?>
		</div>
		<!--/.Accordion wrapper-->
    </section>
</div>
