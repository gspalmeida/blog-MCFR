<?php
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
<div class="row">
	<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>" >
		<section class="section widget-content">
			<!-- Heading -->
			<?php if ( $title != '' ) { ?>
				<nav class="navbar navbar-dark sidebar-heading">
					<div class="flex-center">
						<p class=""><?php echo $title ?></p>
					</div>
				</nav>
			<?php } ?>
			<!--/ Heading -->

			<?php
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					?>
					<div class="single-post">
						<div class="row">
							<div class="col-xs-4">
								<div class="view overlay hm-white-slight">
									<?php
									$post_format	 = get_post_format() ?: 'standard';
									$featured		 = 'featured';
									$content_where	 = 'content';
									if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'link' && $post_format != "audio" ) {
										the_post_thumbnail( false, array( 'class' => 'img-fluid' ) );
									} else {
										echo posts_format( $post_format, $featured );
									}
									?>
									<a href="<?php the_permalink(); ?>">
										<div class="mask waves-effect waves-light"></div>
									</a>
								</div>
							</div>

							<!-- Excerpt -->
							<div class="col-xs-8">
								<div class="post-data">
									<p><i class="fa fa-clock-o"></i> &nbsp;<?php
										$archive_year	 = get_the_time( 'Y' );
										$archive_month	 = get_the_time( 'm' );
										$archive_day	 = get_the_time( 'd' );
										?>
										<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
										<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", get_the_ID() ); ?></a>
										<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", get_the_ID() ); ?></a></p>
									<?php if ( get_theme_mod( 'fb_comments' ) != 1 ) { ?>
										<a><i class="fa fa-comments-o"></i> <?php comments_number( '', '1', '%' ); ?></a>
									<?php } ?>
								</div>

								<h6 class="widget-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
							</div>   
							<!--/ Excerpt -->
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
</div>