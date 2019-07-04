<?php
$image		 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$box_layout	 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$title		 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_title	 = ( isset( $instance[ 'main_title' ] ) ) ? $instance[ 'main_title' ] : '';
$content	 = ( isset( $instance[ 'content' ] ) ) ? $instance[ 'content' ] : '';

$img_align	 = ( isset( $instance[ 'img_align' ] ) ) ? $instance[ 'img_align' ] : '';
$text_align	 = ( isset( $instance[ 'text_align' ] ) ) ? $instance[ 'text_align' ] : '';

$button_text		 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
$button_href		 = ( isset( $instance[ 'button_href' ] ) ) ? $instance[ 'button_href' ] : '';
$icon				 = ( isset( $instance[ 'icon' ] ) ) ? $instance[ 'icon' ] : '';
$icon_container_1	 = ( isset( $instance[ 'icon_container_1' ] ) ) ? $instance[ 'icon_container_1' ] : '';
$icon_color_1		 = ( isset( $instance[ 'icon_color_1' ] ) ) ? $instance[ 'icon_color_1' ] : '';
$filled_buttons		 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
?>

<div class="<?php echo $box_layout; ?> mt-1" id="<?php echo $widget_id; ?>"  >
	<div class=" <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

		<!-- twoj kod -->
		<section class="section features-5">

			<!--First row-->
			<div class="row">
				<?php if ( $img_align == 'right' ) { ?>
					<!--First column-->
					<?php if ( $text_align == 'left' ) { ?>
						<div class="col-lg-7 col-md-12 center-on-small mb-2 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn; text-align: left;">
							<h3 class="text" style="<?php echo 'color:' . ${"icon_color_1"} ?>"><?php echo $main_title ?></h3>
							<h1 class="bold-font mb-2"><?php echo $title ?></h1>
							<p class="grey-text info-section"><?php echo $content ?></p>
							<?php if ( $filled_buttons == 'checked' ) { ?>

								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-primary btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'background-color:' . ${"icon_color_1"} ?>; font-weight: 400; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } else { ?>
								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-outline-white btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'border-color:' . ${"icon_color_1"} ?>; font-weight: 500; <?php echo 'color:' . ${"icon_color_1"} . '!important' ?>; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>" style="<?php echo 'color:' . ${"icon_color_1"} ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } ?>

						</div>
						<!--/First column-->
					<?php } elseif ( $text_align == 'right' ) { ?>

						<div class="col-lg-7 col-md-12 center-on-small mb-2 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn; text-align: right;">
							<h3 class="text" style="<?php echo 'color:' . ${"icon_color_1"} ?>"><?php echo $main_title ?></h3>
							<h1 class="bold-font mb-2"><?php echo $title ?></h1>
							<p class="grey-text info-section"><?php echo $content ?></p>
							<?php if ( $filled_buttons == 'checked' ) { ?>

								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-primary btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'background-color:' . ${"icon_color_1"} ?>; font-weight: 400; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } else { ?>
								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-outline-white btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'border-color:' . ${"icon_color_1"} ?>; font-weight: 500; <?php echo 'color:' . ${"icon_color_1"} . '!important' ?>; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>" style="<?php echo 'color:' . ${"icon_color_1"} ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } ?>

						</div>

					<?php } elseif ( $text_align == 'center' ) { ?>
						<div class="col-lg-7 col-md-12 center-on-small mb-2 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn; text-align: center;">
							<h3 class="text" style="<?php echo 'color:' . ${"icon_color_1"} ?>"><?php echo $main_title ?></h3>
							<h1 class="bold-font mb-2"><?php echo $title ?></h1>
							<p class="grey-text info-section"><?php echo $content ?></p>
							<?php if ( $filled_buttons == 'checked' ) { ?>

								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-primary btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'background-color:' . ${"icon_color_1"} ?>; font-weight: 400; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } else { ?>
								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $icon_container_1 != '' ) { ?>  
										<a class="btn btn-outline-white btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'border-color:' . ${"icon_color_1"} ?>; font-weight: 500; <?php echo 'color:' . ${"icon_color_1"} . '!important' ?>; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>" style="<?php echo 'color:' . ${"icon_color_1"} ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } ?>

						</div>
					<?php } ?>

					<!--Second column-->
					<div class="col-lg-4 col-md-12 offset-lg-1 center-on-small-only wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
						<?php if(!empty($image)){ ?>
						<img src="<?php echo $image ?>" alt="" class="img z-depth-0" style="margin: auto;">
						<?php } ?>
					</div>
					<!--/Second column-->
				<?php } elseif ( $img_align == 'left' ) { ?>

					<!--Second column-->
					<div class="col-lg-4 col-md-12 offset-lg-1 center-on-small-only wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
						<?php if(!empty($image)) { ?>
						<img src="<?php echo $image ?>" alt="" class="img z-depth-0" style="margin: auto;">
						<?php } ?>
					</div>



					<?php if ( $text_align == 'left' ) { ?>
						<div class="col-lg-7 col-md-12 center-on-small mb-2 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn; text-align: left;">
							<h3 class="text" style="<?php echo 'color:' . ${"icon_color_1"} ?>"><?php echo $main_title ?></h3>
							<h1 class="bold-font mb-2"><?php echo $title ?></h1>
							<p class="grey-text info-section"><?php echo $content ?></p>
							<?php if ( $filled_buttons == 'checked' ) { ?>

								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-primary btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'background-color:' . ${"icon_color_1"} ?>; font-weight: 400; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } else { ?>
								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-outline-white btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'border-color:' . ${"icon_color_1"} ?>; font-weight: 500; <?php echo 'color:' . ${"icon_color_1"} . '!important' ?>; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>" style="<?php echo 'color:' . ${"icon_color_1"} ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } ?>

						</div>
						<!--/First column-->
					<?php } elseif ( $text_align == 'right' ) { ?>

						<div class="col-lg-7 col-md-12 center-on-small mb-2 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn; text-align: right;">
							<h3 class="text" style="<?php echo 'color:' . ${"icon_color_1"} ?>"><?php echo $main_title ?></h3>
							<h1 class="bold-font mb-2"><?php echo $title ?></h1>
							<p class="grey-text info-section"><?php echo $content ?></p>
							<?php if ( $filled_buttons == 'checked' ) { ?>

								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-primary btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'background-color:' . ${"icon_color_1"} ?>; font-weight: 400; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } else { ?>
								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-outline-white btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'border-color:' . ${"icon_color_1"} ?>; font-weight: 500; <?php echo 'color:' . ${"icon_color_1"} . '!important' ?>; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>" style="<?php echo 'color:' . ${"icon_color_1"} ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } ?>

						</div>

					<?php } elseif ( $text_align == 'center' ) { ?>
						<div class="col-lg-7 col-md-12 center-on-small mb-2 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn; text-align: center;">
							<h3 class="text" style="<?php echo 'color:' . ${"icon_color_1"} ?>"><?php echo $main_title ?></h3>
							<h1 class="bold-font mb-2"><?php echo $title ?></h1>
							<p class="grey-text info-section"><?php echo $content ?></p>
							<?php if ( $filled_buttons == 'checked' ) { ?>

								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-primary btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'background-color:' . ${"icon_color_1"} ?>; font-weight: 400; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } else { ?>
								<div class="wow fadeInUp" data-wow-delay="0.4s">
									<?php if ( $button_text != '' ) { ?>  
										<a class="btn btn-outline-white btn-lg smooth-scroll" href="<?php echo esc_url( $button_href ) ?>" style="<?php echo 'border-color:' . ${"icon_color_1"} ?>; font-weight: 500; <?php echo 'color:' . ${"icon_color_1"} . '!important' ?>; "><i class="<?php echo esc_attr( $icon_container_1 ); ?>" style="<?php echo 'color:' . ${"icon_color_1"} ?>"></i>&nbsp;<?php echo ( $button_text ); ?></a>
									<?php } ?>
								</div>
							<?php } ?>

						</div>
					<?php } ?>


				<?php } ?>
			</div>
			<!--/First row-->

		</section>


	</div>
</div>