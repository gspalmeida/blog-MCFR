<?php
//    $post = ( isset( $instance['post'] ) ) ? $instance['post'] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$posts_per_page	 = ( isset( $instance[ 'posts_per_page' ] ) ) ? $instance[ 'posts_per_page' ] : '3';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$fieldCount = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';

$read_more = ( isset( $instance[ 'read_more' ] ) ) ? $instance[ 'read_more' ] : 'yes';

$category = ( isset( $instance[ 'category' ] ) ) ? $instance[ 'category' ] : 'No categories';

$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';


for ( $i = 1; $i <= $fieldCount; $i++ ) {

	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
	${"content_" . $i}			 = ( isset( $instance[ "content_" . $i ] ) ) ? $instance[ "content_" . $i ] : "";
	${"name_" . $i}				 = ( isset( $instance[ "name_" . $i ] ) ) ? $instance[ "name_" . $i ] : "";
}
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Features v.1-->
	<section class="section feature-box">

		<!--Section heading-->
		<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( $main_content != '' ) { ?><p class="section-description lead"><?php echo $main_content; ?></p><?php } ?>

		<!--First row-->
		<div class="row features-big" style="display:flex;">
			<div class="col-md-12">
				<?php
				if ( isset( $instance[ 'what_to_feed' ] ) ) {

					$what_to_feed = $instance[ 'what_to_feed' ];

					if ( $what_to_feed == 'posts' ) {
						$args	 = array(
							'posts_per_page' => $posts_per_page,
							'order'			 => 'DESC',
							'orderby'		 => 'date',
							'cat'			 => $category,
						);
						$query	 = new WP_Query( $args );
						$counter = 1;
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								?>
								<div class="col-md-<?php echo floor( 12 / $posts_per_page ) ?> mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
									<?php if ( has_post_thumbnail() ) { ?>

										<img src="<?php the_post_thumbnail_url() ?>" style="margin:auto;" class="img-fluid"></img>

									<?php } ?>

									<h4 class="feature-title"><?php echo get_the_title(); ?></h4>
									<p class="grey-text"><?php echo the_excerpt(); ?></p>
									<?php
									if ( $read_more == 'yes' ) {
										?>
										<?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', 'mdw' ) ); ?>
										<?php
									}
									?>
								</div>
								<?php
								$counter++;
							}
						} else {
							echo "No post found :(";
						}
						wp_reset_postdata();
					} else if ( $what_to_feed == "custom" ) {

						for ( $i = 1; $i <= $instance[ 'fieldCount' ]; $i++ ) {
							?>
							<div class="col-md-<?php echo floor( 12 / $fieldCount ) ?> mb-r <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>">
								<i class="<?php echo ${"icon_container_" . $i} ?>"
								   style="<?php echo 'color:' . ${"icon_color_" . $i} ?>"></i>
								<h4 class="feature-title"><?php echo ${"name_" . $i}; ?></h4>
								<p class="grey-text"><?php echo ${"content_" . $i}; ?></p>
							</div>
							<?php
						}
					}
				}
				?>
			</div>
		</div>
		<!--/First row-->

	</section>
	<!--/Section: Features v.1-->
</div>
