<?php
$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content		 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$image				 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$transparent_image	 = ( isset( $instance[ 'transparent_image' ] ) ) ? $instance[ 'transparent_image' ] : '';
$icon_container_1	 = ( isset( $instance[ 'icon_container_1' ] ) ) ? $instance[ 'icon_container_1' ] : '';
$icon_1				 = ( isset( $instance[ 'icon_1' ] ) ) ? $instance[ 'icon_1' ] : '';

$big_font		 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';
$mask			 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
$filled_buttons	 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';

$amount = 2;
for ( $i = 1; $i <= $amount; $i++ ) {

	${"button_text_" . $i}	 = ( isset( $instance[ 'button_text_' . $i ] ) ) ? $instance[ 'button_text_' . $i ] : '';
	${"button_href_" . $i}	 = ( isset( $instance[ 'button_href_' . $i ] ) ) ? $instance[ 'button_href_' . $i ] : '';
}
wp_register_style( 'custom_styles', get_template_directory_uri() . '/widgets//css/admin.css' );
wp_enqueue_style( 'custom_styles' );
?>

<!--Mask-->
<div class="view <?php echo ($mask == 'checked') ? 'hm-black-strong' : '' ?> intro"  style="background:url('<?php echo esc_url( $image ); ?>')no-repeat center center fixed;background-size:cover;height:100%;">
    <div class="full-bg-img flex-center">
        <div class="container">
            <div class="row" id="home">

                <!--First column-->
                <div class="col-lg-6">
                    <div class="description">
						<?php if ( $big_font == 'checked' ) { ?>
							<h2 class="intro-heading wow fadeInLeft"><?php echo ( $title ); ?> </h2>
							<hr class="hr-dark">
							<h3 class="intro-subtext pb-1 pt-1 hidden-sm-down wow fadeInLeft" data-wow-delay="0.4s"><?php echo ( $main_content ); ?></h3>
							<br>
						<?php } else { ?>
							<h2 class="h2-responsive wow fadeInLeft"><?php echo ( $title ); ?> </h2>
							<hr class="hr-dark">
							<p class="wow fadeInLeft" data-wow-delay="0.4s"><?php echo ( $main_content ); ?></p>
							<br>
						<?php } ?>
						<?php if ( $filled_buttons == 'checked' ) { ?>
							<?php if ( $button_href_1 != '' ) { ?>
								<a class="btn btn-primary btn-lg wow fadeInLeft" data-wow-delay="0.7s" href='<?php echo esc_url( $button_href_1 ); ?>'><?php echo ( $button_text_1 ); ?></a>
							<?php } ?>
							<?php if ( $button_href_2 != '' ) { ?>
								<a class="btn btn-secondary btn-lg wow fadeInLeft" data-wow-delay="0.7s" href='<?php echo esc_url( $button_href_2 ); ?>'><?php echo ( $button_text_2 ); ?>
									<i class="<?php echo esc_attr( $icon_container_1 ); ?>" aria-hidden="true"></i>
								</a>
							<?php } ?>
						<?php } else { ?>
							<?php if ( $button_href_1 != '' ) { ?>
								<a class="btn btn-outline-white btn-lg wow fadeInLeft" data-wow-delay="0.7s" href='<?php echo esc_url( $button_href_1 ); ?>'><?php echo ( $button_text_1 ); ?></a>
							<?php } ?>
							<?php if ( $button_href_2 != '' ) { ?>
								<a class="btn btn-outline-white btn-lg wow fadeInLeft" data-wow-delay="0.7s" href='<?php echo esc_url( $button_href_2 ); ?>'><?php echo ( $button_text_2 ); ?>
									<i class="<?php echo esc_attr( $icon_container_1 ); ?>" aria-hidden="true"></i>
								</a>
							<?php } ?>
						<?php } ?>


                    </div>
                </div>
                <!--/.First column-->

                <!--Second column-->
                <div class="col-lg-4 col-lg-offset-1 flex-center">
                    <!--Form-->
                    <img src="<?php echo esc_attr( $transparent_image ); ?>" alt="" class="img-fluid wow fadeInRight" id="app-mockup">
                    <!--/.Form-->
                </div>
                <!--/Second column-->
            </div>
        </div>
    </div>
</div>
<!--/.Mask-->
<h2 class="h2-responsive wow fadeInLeft"><?php echo ( $title ); ?> </h2>
<hr class="hr-dark">
<p class="wow fadeInLeft" data-wow-delay="0.4s"><?php echo ( $main_content ); ?></p>
<br>