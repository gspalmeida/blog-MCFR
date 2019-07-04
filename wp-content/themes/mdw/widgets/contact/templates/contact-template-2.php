<?php
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$form			 = ( isset( $instance[ 'form' ] ) ) ? $instance[ 'form' ] : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";


$amount = 3;
for ( $i = 1; $i <= $amount; $i++ ) {

	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
	${"icon_text_" . $i}		 = ( isset( $instance[ "icon_text_" . $i ] ) ) ? $instance[ "icon_text_" . $i ] : '';
}

$args		 = array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 );
$cf7Forms	 = get_posts( $args );
$forms		 = class_exists( 'WPCF7_Mail' );
if($icon_container_1 != "" && $icon_container_2 != "" && $icon_container_3 != "") {
    $grid_for_CF = "col-md-8";
} else {
    $grid_for_CF = "col-md-12";
}

?>


<?php if ( !empty( $forms ) && !empty( $cf7Forms ) ) { ?>

	<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>">
		<!--Section: Contact v.2-->
		<section class="section contact-form-widget-mdb">

			<!--Section heading-->
			<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
			<!--Section sescription-->
			<?php if ( $main_content != '' ) { ?><p class="section-description mb-5"><?php echo $main_content; ?></p><?php } ?>

			<div class="row">
                
				<!--First column-->
				<div class="<?php echo $grid_for_CF ?><?php echo $animation == 'None' ? '' : ' wow ' . $animation; ?>">
					<?php echo do_shortcode( $form ); ?>
				</div>
				<!--.First column-->
                <?php if($icon_container_1 != "" && $icon_container_2 != "" && $icon_container_3 != "") { ?>
				<!--Second column-->
				<div class="col-md-4 <?php echo $animation == 'None' ? '' : ' wow ' . $animation; ?>">
					<ul class="contact-icons">
						<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
							<?php if ( ${'icon_container_' . ($i)} != '' ) { ?>
								<li style="color:<?php echo ${'icon_color_' . $i}; ?>">
									<i class="<?php echo ${'icon_container_' . $i}; ?>" style="color:<?php echo ${'icon_color_' . $i}; ?>"></i>
									<p><?php echo ${"icon_text_" . $i}; ?></p>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>
				</div>
				<!--.Second column-->
                <?php } ?>
			</div>
		</section>
		<!--/Section: Contact v.2-->
	<?php } else { ?>
		<p><?php _e( 'In order to use this feature, you have to install, activate and configure ContactForm7 in plugin menu first.', 'mdw' ); ?></p>
	<?php } ?>
</div>