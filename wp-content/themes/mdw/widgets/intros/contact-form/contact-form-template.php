<?php
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$button_text	 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
$button_href	 = ( isset( $instance[ 'button_href' ] ) ) ? $instance[ 'button_href' ] : '';
$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$form			 = ( isset( $instance[ 'form' ] ) ) ? $instance[ 'form' ] : '';
$form_header	 = ( isset( $instance[ 'form_header' ] ) ) ? $instance[ 'form_header' ] : '';

$big_font		 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';
$mask			 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
$filled_buttons	 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
?>



<!--Intro-->
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
							<hr class="hr-light wow fadeInLeft">
							<h3 class="intro-subtext wow fadeInLeft" data-wow-delay="0.4s"><?php echo ( $main_content ); ?></h3>
						<?php } else { ?>
							<h2 class="h2-responsive wow fadeInLeft"><?php echo ( $title ); ?> </h2>
							<hr class="hr-light wow fadeInLeft">
							<p class="wow fadeInLeft" data-wow-delay="0.4s"><?php echo ( $main_content ); ?></p>
						<?php } ?>
						<br>
                        <div class="smooth-scroll">
							<?php if ( $filled_buttons == 'checked' ) { ?>
								<a href="<?php echo $button_href ?>" class="btn btn-primary btn-lg wow fadeInLeft" data-wow-delay="0.7s"><?php echo ( $button_text ); ?></a>
							<?php } else { ?>
								<a href="<?php echo $button_href ?>" class="btn btn-outline-white btn-lg wow fadeInLeft" data-wow-delay="0.7s"><?php echo ( $button_text ); ?></a>
							<?php } ?>
                        </div>    
                    </div>
                </div>
                <!--/.First column-->

                <!--Second column-->
                <div class="col-lg-6">
                    <!--Form-->
                    <div class="card wow fadeInRight">
                        <div class="card-block">
                            <!--Header-->
                            <div class="text-xs-center">
                                <h3><i class="fa fa-envelope"></i> <?php echo ( $form_header ); ?></h3>
                                <hr>
                            </div>

                            <!--Body-->
							<?php echo do_shortcode( ( $form ) ) ?>

                        </div>
                    </div>
                    <!--/.Form-->
                </div>
                <!--/Second column-->
            </div>
        </div>
    </div>

</div>
<!--/.Mask-->
<!--/ & Intro-->
