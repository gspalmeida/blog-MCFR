<?php
$box_layout			 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$background_color	 = ( isset( $instance[ 'background_color' ] ) ) ? $instance[ 'background_color' ] : '';
$animation			 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
$name				 = ( isset( $instance[ "name" ] ) ) ? $instance[ "name" ] : "";
$text   = ( isset( $instance[ 'text' ] ) ) ? $instance[ 'text' ] : '';
$title   = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
for ( $i = 1; $i <= 3; $i++ ) {
	${"category_" . $i}		 = ( isset( $instance[ "category_" . $i ] ) ) ? $instance[ "category_" . $i ] : "";
	${"post_number_" . $i}	 = ( isset( $instance[ "post_number_" . $i ] ) ) ? $instance[ "post_number_" . $i ] : "";
}
?>

<div class="<?php echo $box_layout; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?>" id="<?php echo $widget_id; ?>">
    <div class="row">
		<section class="section widget-content">
			<?php if ( $title != '' ) { ?>
				<h1 class="section-heading"><?php echo $title; ?></h1>
			<?php } ?>
			<?php if($text != '') { ?>
				<p class="section-description lead"><?php echo $text; ?></p>
			<?php } ?>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs navbar tabs-3 widget-tabs" role="tablist">
				<?php for ( $i = 1; $i <= 3; $i++ ) { ?>
					<li class="nav-item waves-effect waves-light">
						<a class="nav-link <?php echo ($i == 1) ? 'active' : '' ?>" data-toggle="tab" href="#<?php echo $widget_id . '-panel' . $i; ?>" role="tab" aria-expanded="true"><?php echo get_cat_name( ${"category_" . $i} ) ? get_cat_name( ${"category_" . $i} ) : "All categories"; ?></a>
					</li>
				<?php } ?>
			</ul>

			<!-- Tab panels -->
			<div class="tab-content widget-tabs-content">    
				<?php for ( $i = 1; $i <= 3; $i++ ) { ?>
					<!-- Panel <?php echo $i; ?> -->
					<div class="tab-pane fade <?php echo ($i == 1) ? 'active in' : '' ?>" id="<?php echo $widget_id . '-panel' . $i; ?>" role="tabpanel" aria-expanded="true">
						<?php
						$query = new WP_Query( array( 'post_type' => 'post', 'cat' => ${"category_" . $i}, 'posts_per_page' => ${"post_number_" . $i} ) );
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								?>
								<div class="single-post">
									<div class="row">
										<!--Image-->
										<div class="col-xs-4">
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
										</div>

										<!-- Excerpt -->
										<div class="col-xs-8">
											<div class="post-data">
												<p><i class="fa fa-clock-o"></i> 
                                                    <?php
													$archive_year	 = get_the_time( 'Y' );
													$archive_month	 = get_the_time( 'm' );
													$archive_day	 = get_the_time( 'd' );
													?>
													&nbsp;<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
													<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", get_the_ID() ); ?></a>
													<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", get_the_ID() ); echo ' '; ?></a></h6>
													
												</p>
												<?php if ( get_theme_mod( 'fb_comments' ) != 1 ) { ?>
														<a><i class="fa fa-comments-o"></i> <?php echo ' ' . comments_number( ' ', '1', '%' ) . ' '; ?>&nbsp;</a>
													<?php } ?>
											</div>

											<h6 id="tabs-title"><?php the_title(); ?></h6>
										</div>                        
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
					<!--/ Panel <?php echo $i; ?>-->
					<?php wp_reset_query(); ?>
				<?php } ?>
			</div>
		</section>
	</div>
</div>