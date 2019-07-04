<?php
/* General variables */
$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

/* Posts feed variables */
$category		 = ( isset( $instance[ 'category' ] ) ) ? $instance[ 'category' ] : 'No categories';
$posts_amount	 = ( isset( $instance[ 'posts_amount' ] ) ) ? $instance[ 'posts_amount' ] : 3;
$text_align		 = ( isset( $instance[ 'text_align' ] ) ) ? $instance[ 'text_align' ] : 'center';
$img_align		 = ( isset( $instance[ 'img_align' ] ) ) ? $instance[ 'img_align' ] : 'left';

if ( $text_align == "top" ) {
	$text_align_img = "bottom";
} elseif ( $text_align == "bottom" ) {
	$text_align_img = "top";
} else {
	$text_align_img = $text_align;
}

/* Custom feed variables */
$fieldCount	 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
$amount		 = 3;

for ( $i = 1; $i <= $amount; $i++ ) {

	${"post_icon_" . $i}			 = ( isset( $instance[ 'post_icon_' . $i ] ) ) ? $instance[ 'post_icon_' . $i ] : '';
	${"post_icon_container_" . $i}	 = ( isset( $instance[ 'post_icon_container_' . $i ] ) ) ? $instance[ 'post_icon_container_' . $i ] : '';
	${"post_icon_color_" . $i}		 = ( isset( $instance[ 'post_icon_color_' . $i ] ) ) ? $instance[ 'post_icon_color_' . $i ] : '';
}

for ( $i = 1; $i <= $fieldCount; $i++ ) {
	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
}


if ( isset( $instance[ 'what_to_feed' ] ) ) {

	$what_to_feed = $instance[ 'what_to_feed' ];
	if ( $what_to_feed == 'posts' ) {

		$amount			 = $posts_amount;
		$args			 = array(
			'numberposts'	 => $amount,
			'cat'			 => $category
		);
		$recent_posts	 = wp_get_recent_posts( $args ); // type = array
		if ( count( $recent_posts ) < 3 ) {
			$amount = count( $recent_posts );
		}

		for ( $i = 1; $i <= $amount; $i++ ) {

			${"name_" . $i}				 = $recent_posts[ $i - 1 ][ 'post_title' ];
			${"content_" . $i}			 = $recent_posts[ $i - 1 ][ 'post_content' ];
			${"icon_" . $i}				 = ${"post_icon_" . $i};
			${"icon_container_" . $i}	 = ${"post_icon_container_" . $i};
			${"icon_color_" . $i}		 = ${"post_icon_color_" . $i};
		}
	} else if ( $what_to_feed == 'custom' ) {

		$amount = $fieldCount;

		for ( $i = 1; $i <= $amount; $i++ ) {

			${"name_" . $i}		 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "Title " . $i;
			${"content_" . $i}	 = ( isset( $instance[ "content_" . $i ] ) ) ? $instance[ "content_" . $i ] : "Content " . $i;
		}
	}
} else {

	$what_to_feed	 = 'custom';
	$amount			 = 3;

	for ( $i = 1; $i <= $amount; $i++ ) {

		${"name_" . $i}		 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "Title " . $i;
		${"content_" . $i}	 = ( isset( $instance[ "content_" . $i ] ) ) ? $instance[ "content_" . $i ] : "Content " . $i;
	}
}
?>

<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >

	<!--Section: Features v.3-->
	<section class="section feature-box">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo esc_html( $title ); ?></h1><?php } ?>
		<!--Section description-->
		<?php if ( $main_content != '' ) { ?><p class="section-description lead"><?php echo esc_html( $main_content ); ?></p><?php } ?>

		<!--First row-->
		<div class="row features-small features-widget-flex <?php if ( $img_align == "right" ) echo "features-widget-reverse"; ?>">

			<!--First column-->
			<div class="col-md-5 center-on-small-only features-widget-<?php echo $text_align_img; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
				<p><img src="<?php echo $image ?>" alt="" class="z-depth-0 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"></p>
			</div>
			<!--/First column-->

			<!--Second column-->
			<div class="col-md-7 center-on-small features-widget-<?php echo $text_align; ?> features-widget <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
				<?php for ( $i = 1, $counter = 1; $i <= $amount; $i++, $counter++ ) { ?>
					<!--Feature <?php $i ?> -->
					<div class="row">
						<?php if ( ${'icon_container_' . ($i)} != '' ) { ?>
							<div class="col-xs-1">
								<i style="color:<?php echo ${'icon_color_' . ($i)}; ?>"
								   class="<?php echo ${'icon_container_' . ($i)}; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
								</i>
							</div>
						<?php } ?>
						<div class="col-xs-10">
							<h4 class="feature-title <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"><?php echo esc_html( ${'name_' . $i} ); ?></h4>
							<p class="grey-text <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"><?php echo esc_html( ${'content_' . $i} ); ?></p>
						</div>
					</div>
					<!--Feature <?php $i ?> -->

					<?php if ( $counter != $amount ) { ?>
						<div style="height:50px;width:100%"></div>
					<?php } ?>

				<?php } ?>


			</div>
			<!--/Second column-->
		</div>
		<!--/First row-->

	</section>
	<!--/Section: Features v.3-->
</div>
