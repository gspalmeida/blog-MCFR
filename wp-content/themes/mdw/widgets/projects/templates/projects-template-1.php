<?php
/* General variables */
$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$amount			 = 3; // default for this project layout

/* Icon texts */

for ( $i = 1; $i <= $amount; $i++ ) {
	${"icon_text_" . $i}					 = ( isset( $instance[ "icon_text_" . $i ] ) ) ? $instance[ "icon_text_" . $i ] : "";
	${'icon_' . $i}							 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${'icon_container_' . $i}				 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
	${'icon_color_' . $i}					 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
	${'custom_button_icon_container_' . $i}	 = ( isset( $instance[ "custom_button_icon_container_" . $i ] ) ) ? $instance[ "custom_button_icon_container_" . $i ] : "";
	${'custom_button_icon_' . $i}			 = ( isset( $instance[ "custom_button_icon_" . $i ] ) ) ? $instance[ "custom_button_icon_" . $i ] : "";
	${'custom_button_collor_' . $i}			 = ( isset( $instance[ "custom_button_collor_" . $i ] ) ) ? $instance[ "custom_button_collor_" . $i ] : "";
}
/* Posts feed variables */
$category = ( isset( $instance[ 'category' ] ) ) ? $instance[ 'category' ] : 'No categories';

if ( isset( $instance[ 'what_to_feed' ] ) ) {

	$what_to_feed = $instance[ 'what_to_feed' ];

	if ( $what_to_feed == 'posts' ) {

		$args			 = array(
			'numberposts'	 => $amount,
			'cat'			 => $category
		);
		$recent_posts	 = wp_get_recent_posts( $args ); // type = array
		if ( count( $recent_posts ) < 3 ) {
			$amount = count( $recent_posts );
		}

		for ( $i = 1; $i <= $amount; $i++ ) {

			${"title_" . $i}				 = $recent_posts[ $i - 1 ][ 'post_title' ];
			${"content_" . $i}				 = $recent_posts[ $i - 1 ][ 'post_content' ];
			${"image_" . $i}				 = wp_get_attachment_url( get_post_thumbnail_id( $recent_posts[ $i - 1 ][ 'ID' ] ) );
			${"button_text_" . $i}			 = 'View post';
			${"button_url_" . $i}			 = $recent_posts[ $i - 1 ][ 'guid' ];
			${'icon_container_button_' . $i} = ( isset( $instance[ 'icon_container_button_' . $i ] ) ) ? $instance[ 'icon_container_button_' . $i ] : 'fa fa-clone ';
		}
	} else {

		$what_to_feed = 'custom';

		for ( $i = 1; $i <= $amount; $i++ ) {

			${"title_" . $i}				 = ( isset( $instance[ "title_" . $i ] ) ) ? $instance[ "title_" . $i ] : "Title " . $i;
			${"content_" . $i}				 = ( isset( $instance[ "content_" . $i ] ) ) ? $instance[ "content_" . $i ] : "Content " . $i;
			${"image_" . $i}				 = ( isset( $instance[ "image_" . $i ] ) ) ? $instance[ "image_" . $i ] : "Image " . $i;
			${"button_text_" . $i}			 = ( isset( $instance[ "button_text_" . $i ] ) ) ? $instance[ "button_text_" . $i ] : "Button text " . $i;
			${"button_url_" . $i}			 = ( isset( $instance[ "button_url_" . $i ] ) ) ? $instance[ "button_url_" . $i ] : "http://mdbootstrap.com/";
			${"button_color_" . $i}			 = ( isset( $instance[ "button_color_" . $i ] ) ) ? $instance[ "button_color_" . $i ] : "";
			${'icon_container_button_' . $i} = ( isset( $instance[ 'icon_container_button_' . $i ] ) ) ? $instance[ 'icon_container_button_' . $i ] : 'fa fa-clone ';
		}
	}
} else {

	$what_to_feed = 'custom';

	for ( $i = 1; $i <= $amount; $i++ ) {

		${"title_" . $i}				 = ( isset( $instance[ "title_" . $i ] ) ) ? $instance[ "title_" . $i ] : "Title " . $i;
		${"content_" . $i}				 = ( isset( $instance[ "content_" . $i ] ) ) ? $instance[ "content_" . $i ] : "Content " . $i;
		${"image_" . $i}				 = ( isset( $instance[ "image_" . $i ] ) ) ? $instance[ "image_" . $i ] : "Image " . $i;
		${"button_text_" . $i}			 = ( isset( $instance[ "button_text_" . $i ] ) ) ? $instance[ "button_text_" . $i ] : "Button text " . $i;
		${"button_url_" . $i}			 = ( isset( $instance[ "button_url_" . $i ] ) ) ? $instance[ "button_url_" . $i ] : "http://mdbootstrap.com/";
		${'icon_container_button_' . $i} = ( isset( $instance[ 'icon_container_button_' . $i ] ) ) ? $instance[ 'icon_container_button_' . $i ] : 'fa fa-clone ';
	}
}
?>

<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Projects section v.1-->
	<section class="section">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo ( esc_attr( $title ) ); ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo ( esc_attr( $main_content ) ); ?></p><?php } ?>


		<!--First row-->
		<div class="row">

			<div class="col-md-12 mb-r  <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
				<!--Card-->
				<div class="card-overlay view hm-black-light " style='background-image: url("<?php echo esc_attr( $image_1 ); ?>");'>	

					<div class="mask" style="z-index: 0"></div>
					<!--Content-->
					<div class="white-text text-xs-center " style="position: relative">

						<div class="white-text text-xs-center ">

							<div class="card-block ">

								<?php if ( $icon_container_1 != '' ) { ?>
									<h5 <?php echo ( esc_attr( $icon_color_1 ) != '' ? ('style="color:' . esc_attr( $icon_color_1 ) . '"') : 'class="red-text"' ); ?>>
										<i class="<?php echo esc_attr( $icon_container_1 ); ?>"></i>
										<?php echo ( $icon_text_1 ); ?>
									</h5>
								<?php } ?>
								<?php if ( esc_attr( $title_1 ) != '' ) { ?><h3><?php echo ( $title_1 ); ?></h3><?php } ?>
								<?php if ( esc_attr( $content_1 ) != '' ) { ?><p><?php echo ( $content_1 ); ?></p><?php } ?>
								<?php if ( $button_text_1 != '' ) { ?>
									<a class="btn btn-lg btn-outline-white" href="<?php echo esc_attr( $button_url_1 ); ?>" style="color: <?php echo $custom_button_collor_1 ?>!important; border-color: <?php echo $custom_button_collor_1 ?>"><i class="<?php echo esc_attr( $custom_button_icon_container_1 ); ?> left" style="color: <?php echo $custom_button_collor_1 ?> "></i><?php echo esc_attr( $button_text_1 ); ?></a>

								<?php } ?>
							</div>
						</div>
					</div>
				</div>

				<!--/.Card-->
			</div>
			<!--First column-->	
			<!--/First column-->

			<?php if ( $amount > 1 ) { ?>
				<!--Second column-->
				<div class="col-md-6 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
					<!--Card-->
					<div class="card-overlay view hm-black-light" style='background-image: url("<?php echo esc_attr( $image_2 ); ?>");'>
						<div class="mask" style="z-index: 0"></div>

						<!--Content-->
						<div class="white-text text-xs-center" style="position: relative">
							<div class="white-text text-xs-center ">
								<div class="card-block">
									<h5 <?php echo ( esc_attr( $icon_color_2 ) != '' ? ('style="color:' . esc_attr( $icon_color_2 ) . '"') : 'class="cyan-text"' ); ?>><i class="<?php echo esc_attr( $icon_container_2 ); ?>"></i><?php echo ( $icon_text_2 ); ?></h5>
									<?php if ( $title_2 != '' ) { ?><h3><?php echo ( $title_2 ); ?></h2><?php } ?>
										<?php if ( $content_2 != '' ) { ?><p><?php echo ( $content_2 ); ?></p><?php } ?>
										<?php if ( $button_text_2 != '' ) { ?>
											<a class="btn btn-lg btn-outline-white" href="<?php echo esc_attr( $button_url_2 ); ?>" style="color: <?php echo $custom_button_collor_2 ?>!important; border-color: <?php echo $custom_button_collor_2 ?>"><i class="<?php echo esc_attr( $custom_button_icon_container_2 ); ?> left" style="color: <?php echo $custom_button_collor_2 ?> "></i><?php echo esc_attr( $button_text_2 ); ?></a>
										<?php } ?>

								</div>
							</div>
						</div>

					</div>
					<!--/.Card-->
				</div>
				<!--/Second column-->
			<?php } ?>
			<?php if ( $amount > 2 ) { ?>
				<!--Third column-->
				<div class="col-md-6 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
					<!--Card-->
					<div class="card-overlay view hm-black-light" style='background-image: url("<?php echo esc_attr( $image_3 ); ?>");'>

						<div class="mask" style="z-index: 0"></div>

						<!--Content-->
						<div class="white-text text-xs-center" style="position: relative">
							<div class="white-text text-xs-center ">
								<div class="card-block">
									<h5 <?php echo ( esc_attr( $icon_color_3 ) != '' ? ('style="color:' . esc_attr( $icon_color_3 ) . '"') : 'class="cyan-text"' ); ?>><i class="<?php echo esc_attr( $icon_container_3 ); ?>"></i><?php echo ( $icon_text_3 ); ?></h5>
									<?php if ( $title_3 != '' ) { ?><h3><?php echo ( $title_3 ); ?></h3><?php } ?>
									<?php if ( $content_3 != '' ) { ?><p><?php echo ( $content_3 ); ?></p><?php } ?>
									<?php if ( $button_text_3 != '' ) { ?>
										<a class="btn btn-lg btn-outline-white" href="<?php echo esc_attr( $button_url_3 ); ?>" style="color: <?php echo $custom_button_collor_3 ?>!important; border-color: <?php echo $custom_button_collor_3 ?>"><i class="<?php echo esc_attr( $custom_button_icon_container_3 ); ?> left" style="color: <?php echo $custom_button_collor_3 ?> "></i><?php echo esc_attr( $button_text_3 ); ?></a>
										<?php } ?>

								</div>
							</div>
						</div>

					</div>
					<!--/.Card-->
				</div>
				<!--/Third column-->
			<?php } ?>
		</div>
		<!--/First row-->
	</section>
	<!--/.Projects section v.1-->
</div>
