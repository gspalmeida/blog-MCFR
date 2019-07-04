<?php
/* General variables */
$image				 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content		 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$box_layout			 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$amount				 = 4; // default for this project layout
$amount_to_display	 = 0;

/* Icon texts */

for ( $i = 1; $i <= $amount; $i++ ) {
	${"icon_text_" . $i}		 = ( isset( $instance[ "icon_text_" . $i ] ) ) ? $instance[ "icon_text_" . $i ] : "Icon text " . $i;
	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? str_replace( 'fa-4x', '', $instance[ 'icon_container_' . $i ] ) : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
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
		if ( count( $recent_posts ) < $amount ) {
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
<div class="<?php echo $box_layout; ?>">
	<!--Projects section v.3-->
	<section class="section text-xs-center">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo ( $title ); ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( $main_content != '' ) { ?><p class="section-description"><?php echo ( $main_content ); ?></p><?php } ?>

		<?php
		for ( $i = 1; $i <= 4; $i++ ) {
			if ( ${"title_" . $i} != '' || ${"content_" . $i} != '' || ${"image_" . $i} != '' || ${"button_text_" . $i} != '' || ${"button_url_" . $i} != '' || ${'icon_container_button_' . $i} != '' ) {
				$amount_to_display ++;
			}
		}
		for ( $i = 1; $i <= $amount_to_display; $i++ ) {

			$even = ( $i % 2 == 0 );
			?>



						  <!--<?php echo $i ?> column-->
			<div class="col-md-6 mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">

				<!--Featured image-->
				<div class="view overlay hm-white-slight z-depth-2">
					<img src="<?php echo esc_attr( ${'image_' . $i} ); ?>">
					<a>
						<div class="mask"></div>
					</a>
				</div>

				<!--Excerpt-->
				<div class="card-block"> 
					<?php if ( ${"icon_container_" . $i} != '' ) { ?>
						<h5 style="color: <?php echo esc_attr( ${'icon_color_' . $i} ); ?>"><i class="<?php echo esc_attr( ${'icon_container_' . $i} ) ?>"></i> <?php echo ( ${'icon_text_' . $i} ); ?></h5>
					<?php } ?>
					<h3><?php echo ( ${'title_' . $i} ); ?></h3>
					<p><?php echo ( ${'content_' . $i} ); ?></p>
					<?php if ( ${"button_text_" . $i} != '' ) { ?>
						<a class="btn btn-primary" href="<?php echo esc_attr( ${'button_url_' . $i} ); ?>"><i class="<?php echo esc_attr( ${'icon_container_button_' . $i} ); ?> left"></i><?php echo esc_attr( ${'button_text_' . $i} ); ?></a>
						<?php } ?>
				</div>

			</div>
			<!--/<?php echo $i ?> column-->



		<?php } ?>

	</section>
	<!--/Projects section v.3-->
</div>
