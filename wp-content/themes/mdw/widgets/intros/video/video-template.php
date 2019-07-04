<?php
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$button_text	 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
$button_href	 = ( isset( $instance[ 'button_href' ] ) ) ? $instance[ 'button_href' ] : '';
$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$video			 = ( isset( $instance[ 'video' ] ) ) ? $instance[ 'video' ] : '';

$big_font		 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';
$mask			 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
$filled_buttons	 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
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
							<h2 class="intro-heading wow fadeInLeft" data-wow-delay="0.2s"><?php echo ( $title ); ?></h2>
							<hr class="hr-dark wow fadeInLeft">
							<h3 class="intro-subtext twow fadeInLeft" data-wow-delay="0.4s"><?php echo ( $main_content ); ?></h3>
						<?php } else { ?>
							<h2 class="h2-responsive wow fadeInLeft" data-wow-delay="0.2s"><?php echo ( $title ); ?></h2>
							<hr class="hr-dark wow fadeInLeft">
							<h3 class="wow fadeInLeft" data-wow-delay="0.4s"><?php echo ( $main_content ); ?></h3>
						<?php } ?>
						<?php if ( $button_text != '' ) { ?>
							<div class="smooth-scroll">
								<?php if ( $filled_buttons == 'checked' ) { ?>
									<a class="btn btn-primary btn-lg wow fadeInLeft" data-wow-delay="0.7s" href="<?php echo esc_url( $button_href ); ?>"><?php echo ( $button_text ); ?></a>
								<?php } else { ?>
									<a class="btn btn-outline-primary btn-lg wow fadeInLeft" data-wow-delay="0.7s" href="<?php echo esc_url( $button_href ); ?>"><?php echo ( $button_text ); ?></a>
								<?php } ?> 
							</div>
						<?php } else {
							
						}
						?> 
                        <br>

                    </div>
                </div>
                <!--/.First column-->

                <!--Second column-->
                <div class="col-lg-6">

                    <div class="embed-responsive embed-responsive-16by9 wow fadeInRight">
                        <iframe class="embed-responsive-item" src="<?php echo str_replace( 'watch?v=', 'embed/', esc_attr( $video ) ); ?>" allowfullscreen></iframe>
                    </div>


                </div>
                <!--/Second column-->
            </div>
        </div>
    </div>
</div>
<!--/.Mask-->
