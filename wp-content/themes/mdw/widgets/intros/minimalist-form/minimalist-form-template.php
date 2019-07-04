<?php
$bg_image			 = ( isset( $instance[ 'background_image' ] ) ) ? $instance[ 'background_image' ] : '';
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$title_description	 = ( isset( $instance[ 'title_description' ] ) ) ? $instance[ 'title_description' ] : '';
$button_text		 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
$button_url			 = ( isset( $instance[ 'button_url' ] ) ) ? $instance[ 'button_url' ] : '';
$filled_buttons		 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
$form				 = ( isset( $instance[ 'form' ] ) ) ? $instance[ 'form' ] : '';
$big_font			 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';

$select_form = ( isset( $instance[ 'select_form' ] ) ) ? $instance[ 'select_form' ] : '';

wp_register_style( 'custom_styles', get_template_directory_uri() . '/widgets//css/admin.css' );
wp_enqueue_style( 'custom_styles' );
?>

<!--Mask-->
<div class="view hm-black-light intro" style='background: url("<?php echo esc_url( $bg_image ); ?>")no-repeat center center fixed; background-size: cover;'>
    <div class="full-bg-img flex-center">
        <div class="container">
            <div class="row" id="home">

                <!--First column-->
                <div class="col-lg-6">
                    <div class="description">
						<?php if ( $big_font == 'checked' ) { ?>
							<h2 class="intro-heading wow fadeInLeft"><?php echo ( $title ); ?></h2>
							<hr class="hr-light wow fadeInLeft">
							<h3 class="intro-subtext wow fadeInLeft" data-wow-delay="0.4s"><?php echo ( $title_description ); ?></h3>
						<?php } else { ?>
							<h2 class="h2-responsive wow fadeInLeft"><?php echo ( $title ); ?></h2>
							<hr class="hr-light wow fadeInLeft">
							<p class="wow fadeInLeft" data-wow-delay="0.4s"><?php echo ( $title_description ); ?></p>
						<?php } ?>
                        <br>
                        <div class="smooth-scroll">
							<?php if ( $filled_buttons == 'checked' ) { ?>
								<a href="<?php echo esc_url( $button_url ); ?>"
								   class="btn btn-primary btn-lg wow fadeInLeft"
								   data-wow-delay="0.7s"><?php echo ( $button_text ); ?></a>
							   <?php } else { ?>
								<a href="<?php echo esc_url( $button_url ); ?>"
								   class="btn btn-outline-white btn-lg wow fadeInLeft"
								   data-wow-delay="0.7s"><?php echo ( $button_text ); ?></a>
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

							<?php echo do_shortcode( $form ); ?>

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
