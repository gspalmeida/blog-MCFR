<?php
$category = get_theme_mod( 'categories' );

$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$middle_category = ( isset( $instance[ 'middle_category' ] ) ) ? $instance[ 'middle_category' ] : 'No categories';
$middle_amount	 = ( isset( $instance[ 'middle_amount' ] ) ) ? $instance[ 'middle_amount' ] : '';

wp_reset_postdata();
wp_reset_query();

$query = new WP_Query( array( 'post_type' => 'post', 'cat' => $middle_category, 'posts_per_page' => $middle_amount ) );
?>

<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>">
	<section class="section widget-content">

		<?php
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$icons		 = get_mdw_category();
				?>
				<div class="single-post pb-2">
					<div class="row">
						<div class="col-md-12">
							<div class="view overlay hm-white-slight">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( false, array( 'class' => 'img-fluid' ) );
								}
								?>
								<a href="<?php the_permalink(); ?>">
									<div class="mask waves-effect waves-light"></div>
								</a>
							</div>

							<h2 class="with-border pb-1-half"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

							<div class="news-data with-border">
								<h6 class="post-date"><i class="fa fa-clock-o"></i> <?php
									$archive_year	 = get_the_time( 'Y' );
									$archive_month	 = get_the_time( 'm' );
									$archive_day	 = get_the_time( 'd' );
									?>
									<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
									<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", get_the_ID() ); ?></a>
									<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", get_the_ID() ); ?></a></h6>
								<a href="<?php echo $icons[ "url" ]; ?>"><h5 style="color:<?php echo $icons[ "color" ]; ?>"><i class="<?php echo $icons[ "icon" ]; ?>"></i>&nbsp;<?php echo $icons[ "name" ]; ?></h5></a>
							</div>
							<p><?php echo the_excerpt(); ?></p>
							<?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', 'mdw' ) ); ?>
						</div>
					</div>
					<!--/ First row -->
				</div>
			<?php } ?>
		<?php } ?>
		<?php
		wp_reset_postdata();
		wp_reset_query();
		?>
	</section>
</div>