<?php
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content		 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$button_text		 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
$button_url			 = ( isset( $instance[ 'button_url' ] ) ) ? $instance[ 'button_url' ] : '';
$background_image	 = ( isset( $instance[ 'background_image' ] ) ) ? $instance[ 'background_image' ] : '';
$optional_image		 = ( isset( $instance[ 'optional_image' ] ) ) ? $instance[ 'optional_image' ] : '';
$image_position		 = ( isset( $instance[ 'image_position' ] ) ) ? $instance[ 'image_position' ] : 'left';
$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
?>
<!--Mask-->
<div class="view hm-black-strong " id="<?php echo $widget_id; ?>" style="background:url('<?php echo esc_url( $background_image ); ?>')no-repeat center center fixed;background-size:cover;height:50vh">
    <div class="full-bg-img flex-center">
        <div class="container">
            <div class="row">

                <!--First column-->
                <div class="col-lg-6" style="float:<?php echo $image_position == 'left' ? 'right' : 'left'; ?>">
                    <div class="description">
                        <h2 class="h2-responsive wow <?php echo $image_position == 'right' ? 'fadeInLeft' : 'fadeInRight'; ?> text-white"><?php echo $title; ?></h2>
                        <hr class="hr-dark">
                        <p class="wow <?php echo $image_position == 'right' ? 'fadeInLeft' : 'fadeInRight'; ?> text-white" data-wow-delay="0.4s"><?php echo $main_content; ?></p>
                        <br>
						<?php if ( $button_text != '' ) { ?>
							<a class="btn btn-outline-white btn-lg wow <?php echo $image_position == 'right' ? 'fadeInLeft' : 'fadeInRight'; ?>" data-wow-delay="0.7s" href='<?php echo esc_url( $button_url ); ?>'><?php echo ( $button_text ); ?></a>
						<?php } ?>
                    </div>
                </div>
                <!--/.First column-->
                <!-- <div class="col-lg-2" ></div> -->
                <!--Second column-->
                <div class="col-lg-4 flex-center" <?php echo $image_position == 'left' ? 'style="float:left"' : ''; ?>>
                    <!--Form-->
                    <img src="<?php echo esc_attr( $optional_image ); ?>" alt="" class="img-fluid wow <?php echo $image_position == 'right' ? 'fadeInRight' : 'fadeInLeft'; ?>" id="app-mockup">
                    <!--/.Form-->
                </div>
                <!--/Second column-->
            </div>
        </div>
    </div>
</div>
<!--/.Mask-->
