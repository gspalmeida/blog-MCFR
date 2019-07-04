<?php
//    $post = ( isset( $instance['post'] ) ) ? $instance['post'] : '';
$title_text			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$title_description	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$posts_per_page		 = ( isset( $instance[ 'posts_per_page' ] ) ) ? $instance[ 'posts_per_page' ] : '3';
$animation			 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$read_more = ( isset( $instance[ 'read_more' ] ) ) ? $instance[ 'read_more' ] : 'yes';

$fieldCount = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';

$category = ( isset( $instance[ 'category' ] ) ) ? $instance[ 'category' ] : 'No categories';

$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

for ( $i = 1; $i <= $fieldCount; $i++ ) {

	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
	${"link_url_" . $i}			 = ( isset( $instance[ "link_url_" . $i ] ) ) ? $instance[ "link_url_" . $i ] : "Link " . $i;
	${"url_text_" . $i}			 = ( isset( $instance[ "url_text_" . $i ] ) ) ? $instance[ "url_text_" . $i ] : "Text " . $i;
}
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>" >
	<!--Section: Features v.1-->
	<section class="section feature-box">

		<!--Section heading-->
		<?php if ( $title_text != '' ) { ?><h1 class="section-heading"><?php echo $title_text; ?></h1><?php } ?>
		<!--Section sescription-->
		<?php if ( $title_description != '' ) { ?><p class="section-description lead"><?php echo $title_description; ?></p><?php } ?>

		<!--First row-->
		<div class="row features-small">
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
							<div class="col-md-<?php echo floor( 12 / $posts_per_page ) ?> mb-r">
								<div class="col-xs-4">
									<?php if ( has_post_thumbnail() ) { ?>

										<img src="<?php the_post_thumbnail_url() ?>" style="margin:auto;" class="img-fluid <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"></img>
									<?php } ?>
								</div>

								<div class="col-xs-8">
									<h4 class="feature-title <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"><?php echo get_the_title(); ?></h4>
									<p class="grey-text <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"><?php echo the_excerpt(); ?></p>
									<?php
									if ( $read_more == 'yes' ) {
										?>
										<?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', 'mdw' ) ); ?>
										<?php
									}
									?>
								</div>
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
						<div class="col-md-<?php echo floor( 12 / $fieldCount ) ?> mb-r">
							<?php if ( ${'icon_container_' . ($i)} != '' ) { ?>
								<div class="col-xs-2">
									<i class="<?php echo ${"icon_container_" . $i} ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"
									   style="<?php echo 'color:' . ${"icon_color_" . $i} ?>"></i>
								</div>
							<?php } ?>
							<div class="col-xs-10">
								<h4 class="feature-title <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"><?php echo $instance[ 'name_' . $i ]; ?></h4>
								<p class="grey-text <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>"><?php echo $instance[ 'content_' . $i ]; ?></p>
								<?php
								if ( ${"link_url_" . $i} != "" && ${"url_text_" . $i} != "" ) {
									?>
									<?php echo button_custom( 'primary', ${"link_url_" . $i}, ${"url_text_" . $i} ); ?>

									<?php
								}
								?>
							</div>
						</div>
						<?php
					}
				}
			}
			?>
		</div>
		<!--/First row-->

	</section>
	<!--/Section: Features v.1-->
</div>
