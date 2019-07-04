<?php
$fieldCount	 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$box_layout	 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$text   = ( isset( $instance[ 'text' ] ) ) ? nl2br($instance[ 'text' ]) : '';
$title   = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
for ( $i = 1; $i <= $fieldCount; $i++ ) {
	${"name_" . $i}		 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "";
	${"content_" . $i}	 = ( isset( $instance[ "content_" . $i ] ) ) ? nl2br($instance[ "content_" . $i ]) : "";
    ${"title_" . $i}         = ( isset( $instance[ "title_" . $i ] ) ) ? $instance[ "title_" . $i ] : "";

	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '<i class=\'fa fa-flag-checkered chosen\'></i>';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : 'fa fa-flag-checkered chosen';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '#607d8b';
}
?>
<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >
<div class="row">
    <section id="tabs" class="section col-md-12 team-section pt-3">
		<?php if ( $title != '' ) { ?>
	        <h1 class="section-heading"><?php echo $title; ?></h1>
		<?php } ?>
		<?php if($text != '') { ?>
			<p class="section-description lead"><?php echo $text; ?></p>
		<?php } ?>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs md-pills pills-ins" role="tablist">
		<?php for ( $i = 1; $i <= $fieldCount; $i++ ) { ?>
				<li class="nav-item">
					<a class="nav-link <?php echo ($i == 1) ? 'active' : '' ?>" data-toggle="tab" href="#panel-template4-<?php echo $i; ?>" role="tab"><i class="<?php echo ${"icon_container_" . $i} ?> fa-2x"></i><br> <?php echo ${"name_" . $i}; ?></a>
				</li>
			<?php } ?>
	</ul>

	<!-- Tab panels -->
	<div class="tab-content">

		<?php for ( $i = 1; $i <= $fieldCount; $i++ ) { ?>
			<div class="tab-pane fade <?php echo ($i == 1) ? 'in active' : '' ?>" id="panel-template4-<?php echo $i; ?>" role="tabpanel">
				<br>
                <h4 class="mb-3"><?php echo ${'title_' . $i} ?></h4>
				<p class=""><?php echo ${"content_" . $i} ?></p>

			</div>
		<?php } ?>

	</div>
    </section>
    </div>
</div>
