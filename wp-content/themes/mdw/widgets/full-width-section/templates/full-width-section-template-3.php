<?php
$bg_image_2			 = ( isset( $instance[ 'background_image_2' ] ) ) ? $instance[ 'background_image_2' ] : '';
$title_2			 = ( isset( $instance[ 'title_2' ] ) ) ? $instance[ 'title_2' ] : '';
$title_description_2 = ( isset( $instance[ 'title_description_2' ] ) ) ? $instance[ 'title_description_2' ] : '';
$button_text_2		 = ( isset( $instance[ 'button_text_2' ] ) ) ? $instance[ 'button_text_2' ] : '';
$filled_buttons		 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
$bg_color_2			 = ( isset( $instance[ 'bg_color_2' ] ) ) ? $instance[ 'bg_color_2' ] : '';
$icon_container_1	 = ( isset( $instance[ 'icon_container_1' ] ) ) ? $instance[ 'icon_container_1' ] : '';
$icon_color_1		 = ( isset( $instance[ 'icon_color_1' ] ) ) ? $instance[ 'icon_color_1' ] : '';
$button_href		 = ( isset( $instance[ 'button_href' ] ) ) ? $instance[ 'button_href' ] : '';
$form				 = ( isset( $instance[ 'form' ] ) ) ? $instance[ 'form' ] : '';
$form_header		 = ( isset( $instance[ 'form_header' ] ) ) ? $instance[ 'form_header' ] : '';
$animation = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$text_color_3 = ( isset( $instance[ 'text_color_3' ] ) ) ? $instance[ 'text_color_3' ] : '';



wp_register_style( 'custom_styles', get_template_directory_uri() . '/widgets/css/admin.css' );
wp_enqueue_style( 'custom_styles' );
?>

<!--Footer Links-->
<div class="container-fluid">
    <!--First row-->
    <div class="row mb-2 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?> ">
        <!--First column-->
        <div class="col-lg-6 offset-lg-3 text-xs-center smooth-scroll">

            <!--Icon-->
            <i style="color:<?php echo $icon_color_1 ?>" class="<?php echo $icon_container_1 ?> fa-4x pt-1 pb-2"></i>

            <!--Title-->
            <h2 style="color: <?php echo $text_color_3 ;?>" class="mb-2 bold-font"><?php echo $title_2 ?></h2>
            <!--Description-->
            <p class="text-muted" ><?php echo $title_description_2 ?></p>
            <!--Reservation button-->

			<?php if ( $filled_buttons == 'checked' ) { ?>

				<div class="wow fadeInUp" data-wow-delay="0.4s">
					<?php if ( $button_text_2 != '' ) { ?>  
						<a class="btn btn-primary btn-lg" href="<?php echo esc_url( $button_href ) ?>" data-toggle="modal" data-target="#modal-subscription" style="<?php echo 'background-color:' . ${"icon_color_1"} ?>; font-weight: 400; ">&nbsp;<?php echo ( $button_text_2 ); ?></a>
					<?php } ?>
				</div>
			<?php } else { ?>
				<div class="wow fadeInUp" data-wow-delay="0.4s">
					<?php if ( $button_text_2 != '' ) { ?>  
						<a class="btn btn-outline-white btn-lg" href="<?php echo esc_url( $button_href ) ?>" data-toggle="modal" data-target="#modal-subscription" style="<?php echo 'border-color:' . ${"icon_color_1"} ?>; font-weight: 500; <?php echo 'color:' . ${"icon_color_1"} . '!important' ?>; ">&nbsp;<?php echo ( $button_text_2 ); ?></a>
					<?php } ?>
				</div>
			<?php } ?>

			<!-- Modal Subscription -->


        </div>
        <!--/First column-->
    </div>
    <!--/First row-->
    <hr>
</div>
<br>

<!--/Footer Links-->



<div class="modal fade modal-ext" id="modal-subscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<!--Form-->
		<div class="card wow fadeInRight">
			<div class="card-block" style="color: black;">
				<!--Header-->
				<div class="text-xs-center">
					<h3><i class="fa fa-envelope"></i> <?php echo ( $form_header ); ?></h3>
					<hr>
				</div>

				<!--Body-->

				<?php echo do_shortcode( ( $form ) ) ?>

			</div>
		</div>
    </div>
    <!--/.Form-->
</div>