<?php

/**
 * Blog v4 template
 * @see http://mdbootstrap.com/sections/blog/
 */
function get_mdw_blog_template_10( $params = array() ) {
	$defaults			 = array( // the defaults will be overidden if set in $params
		'words_per_excerpt'	 => 30,
		'counter'			 => 0,
		'animation'			 => 'None',
		'display_date'		 => 'on',
		'display_author'	 => 'on',
		'columns_amount'	 => '2'
	);
	$params				 = array_merge( $defaults, $params );
	$post_format		 = get_post_format() ?: 'standard';
	$featured			 = 'featured';
	$content_where		 = 'content';
	$grid				 = createGridClass( $params );
	$grid[ "grid_class" ]	 .= ' mb-r ';
	if ( $grid[ "row_open_condition" ] ) {
		?>
		<div class="row">
		<?php } ?>

		<div class="<?php echo $grid[ "grid_class" ]; ?> <?php echo $params[ 'animation' ] == 'None' ? '' : ( ' wow ' . $params[ 'animation' ] ); ?>"  data-post-id="<?php the_ID(); ?>">
			<div class="row">
				<div class="col-md-4">
					<!--Card image/video-->
					<div class="view overlay hm-white-slight">
						<?php echo posts_format( $post_format, $featured ); ?>
						<?php if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' && $post_format != 'link' ) { ?>
							<a href="<?php the_permalink(); ?>">
								<img src="<?php the_post_thumbnail_url( 'full' ); ?>" class="img-fluid z-depth-1">
								<div class="mask"></div>
							</a>
						<?php } ?>
					</div>
					<!--/.Card image/video-->
					<div class="view overlay hm-white-slight">
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php echo the_permalink(); ?>">

								<div class="mask"></div>
							</a>
						<?php } ?>
					</div>
				</div><!-- /.inner col  -->
				<div class="col-md-8" data-post-id="<?php the_ID(); ?>">
					<h2 class=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?><a></h2>
								<hr>
								<p><i style="padding-right: 0.5rem" class="fa fa-calendar"></i>
									<?php
									$archive_year	 = get_the_time( 'Y' );
									$archive_month	 = get_the_time( 'm' );
									$archive_day	 = get_the_time( 'd' );
									if($params[ 'display_author' ] == 'on' && $params[ 'display_date' ] == 'on'){ ?>
										<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
										<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", get_the_ID() ); ?></a>
										<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", get_the_ID() ); ?></a>
									<?php } else if ($params[ 'display_date' ] == 'on') { ?>
										<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
										<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", get_the_ID() ); ?></a>
										<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", get_the_ID() ); ?></a>
									<?php } ?>
									
									<?php if ( get_theme_mod( 'fb_comments' ) != 1 ) { ?>
										<a href="<?php comments_link(); ?>"><i style="padding:0 .4rem;" class="fa fa-comments-o"></i><?php comments_number(); ?></a></p> <?php } ?>
								<hr>
								<p>
									<?php
									if ( has_excerpt() ) {
										the_excerpt();
									} else {
										if ( $post_format == 'quote' ) {
											echo post_format_content( $post_format );
										} else {
											echo excerpt( get_the_content(), $params[ 'words_per_excerpt' ] );
										}
									}
									?>
								</p>
								</div><!-- /.inner col  -->
								</div>
								</div><!-- /.outer col -->

								<?php if ( $grid[ "row_close_condition" ] ) { ?>
									</div>
									<?php
								}
								$postedID									 = get_the_id();
								$_COOKIE[ 'paginationSelect' ][ 'postID' ][] = $postedID;
							}
							
