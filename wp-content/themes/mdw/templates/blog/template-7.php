<?php

/**
 * Blog v7 template
 * @see http://mdbootstrap.com/sections/blog/
 */
function get_mdw_blog_template_7( $params = array() ) {
	$defaults						 = array( // the defaults will be overidden if set in $params
		'words_per_excerpt'	 => 30,
		'category'			 => 'No categories',
		'amount'			 => 3,
		'social_buttons'	 => 'yes',
		'share_animation'	 => 'rotating',
		'counter'			 => 0,
		'animation'			 => 'None',
		'display_date'		 => 'on',
		'display_author'	 => 'on',
		'columns_amount'	 => '1'
	);
	$params							 = array_merge( $defaults, $params );
	$post_format					 = get_post_format() ?: 'standard';
	$featured						 = 'featured';
	$content_where					 = 'content';
	$grid							 = createGridClass( $params );
	$grid[ "grid_class" ]				 .= ' mb-r ';
	$params[ 'words_per_excerpt' ]	 = $params[ 'words_per_excerpt' ] > 20 ? 20 : $params[ 'words_per_excerpt' ];
	if ( $grid[ "row_open_condition" ] ) {
		?>
		<div class="row <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">
		<?php } ?>
		<div class="<?php
		echo $grid[ "grid_class" ];
		echo $params[ 'animation' ] == 'None' ? '' : ( ' wow ' . $params[ 'animation' ] );
		?>" data-post-id="<?php the_ID(); ?>">
				 <?php if ( $params[ 'share_animation' ] == 'reveal' || $params[ 'social_buttons' ] == 'no' ) { ?>
				<!--Card-->
				<div class="card ovf-hidden">
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

					<!--Social shares button-->
					<a class="activator"><i class="fa fa-share-alt"></i></a>

					<!--Card content-->
					<div class="card-block">

						<!--Title-->
						<h4 class="card-title"><?php the_title(); ?></h4>
						<hr>
						<!--Text-->
						<p class="card-text" data-content="true">
							<?php
							if ( has_excerpt() ) {
								if ( $post_format == 'quote' ) {
									echo post_format_content( $post_format );
								} else {
									the_excerpt();
								}
							} else {
								if ( $post_format == 'quote' ) {
									echo post_format_content( $post_format );
								} else {
									echo excerpt( get_the_content(), $params[ 'words_per_excerpt' ] );
								}
							}
							?>
						</p>
						<a href="<?php the_permalink(); ?>" class="link-text"><h5><?php _e( 'Read more ', 'mdw ' ); ?><i class="fa fa-chevron-right"></i></h5></a>
					</div>
					<!--/.Card content-->

					<!--Card reveal-->
					<div class="card-reveal">
						<!--Content-->
						<div class="content text-xs-center">

							<h4 class="card-title"><?php _e( 'Social shares ', 'mdw' ) ?><i class="fa fa-close"></i></h4>
							<hr>

							<?php echo social_buttons( get_permalink() ); ?>

							<h5><?php _e( 'Join our community ', 'mdw' ) ?></h5>
							<hr>

							<!--Social Icons-->
							<ul class="inline-ul">
								<li><a class="btn btn-fb"><i class="fa fa-facebook"> </i></a></li>
								<li><a class="btn btn-tw"><i class="fa fa-twitter"> </i></a></li>
								<li><a class="btn btn-li"><i class="fa fa-linkedin"> </i></a></li>
								<li><a class="btn btn-ins"><i class="fa fa-instagram"> </i></a></li>
							</ul>

						</div>
						<!--/.Content-->

					</div>
					<!--/.Card reveal-->

				</div>
				<!--/.Card-->
			<?php } else { ?>

				<!--Rotating card-->
				<div class="card-wrapper">
					<div id="card-<?php echo $params[ 'counter' ]; ?>" class="card-rotating effect__click">

						<!--Front Side-->
						<div class="face front card">

							<!--Card image/video-->
							<div class="card-up">
								<div class="view overlay hm-white-slight">
									<?php
									if ( has_post_format( 'video' ) ) {
										$content = get_the_content();
										$video	 = substr( get_the_content(), 0, strpos( get_the_content(), '[/embed]' ) + 8 );
										global $wp_embed;
										?>
										<div class="embed-responsive embed-responsive-1by1">
											<?php echo $wp_embed->run_shortcode( $video ); ?>
										</div>
										<?php
									} elseif ( has_post_format( 'image' ) ) {
										$first_image = catch_that_image();
										?>
										<img src="<?php echo $first_image ?>" class="img-fluid">;

									<?php } else if ( has_post_thumbnail() ) { ?>
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'full' ); ?>
											<div class="mask"></div>
										</a>
									<?php } ?>
								</div>
							</div>
							<!--/.Card image/video-->
							<!--Content-->
							<div class="content">
								<a class="rotate-btn" data-card="card-<?php echo $params[ 'counter' ]; ?>"><i class="fa fa-share-alt"></i></a>
								<h4><?php the_title(); ?></h4>
								<hr>
								<p>
									<?php
									if ( has_excerpt() ) {
										the_excerpt();
									} else {
										echo excerpt( get_the_content(), $params[ 'words_per_excerpt' ] );
									}
									?>
								</p>

								<a class="link-text" href="<?php the_permalink(); ?>"><h5><?php _e( 'Read more ', 'mdw ' ); ?><i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Content-->

						</div>
						<!--/.Front Side-->

						<!--Back Side-->
						<div class="face back">

							<!--Title-->
							
							<h4 class="card-title"><i class="fa fa-close rotate-btn" data-card="card-<?php echo $params[ 'counter' ]; ?>"></i> <?php _e( 'Social shares ', 'mdw ' ); ?></h4>
							<hr>

							<!--Social Icons-->
							<ul class="inline-ul">
								<?php echo social_buttons( get_permalink() ); ?>
							</ul>
							<?php
							$facebook_url	 = get_user_meta( get_current_user_id(), 'facebook_profile' );
							$twitter_url	 = get_user_meta( get_current_user_id(), 'twitter_profile' );
							$linkedin_url	 = get_user_meta( get_current_user_id(), 'linkedin_profile' );
							$instagram_url	 = get_user_meta( get_current_user_id(), 'instagram_profile' );
							?>

							<h5>

								<?php
								if ( $facebook_url[ 0 ] != '' || $twitter_url[ 0 ] != '' || $linkedin_url[ 0 ] != '' || $instagram_url[ 0 ] != '' ) {
									_e( 'Join our community ', 'mdw ' );
								}
								?>
							</h5>
							<hr>

							<!--Social Icons-->

							<ul class="inline-ul">
								<?php if ( $facebook_url[ 0 ] != '' ) { ?> <li><a href='<?php echo $facebook_url[ 0 ]; ?>' class="btn btn-fb"><i class="fa fa-facebook"> </i></a></li><?php } ?>
								<?php if ( $twitter_url[ 0 ] != '' ) { ?> <li><a href='<?php echo $twitter_url[ 0 ] ?>'  class="btn btn-tw"><i class="fa fa-twitter"> </i></a></li><?php } ?>
								<?php if ( $linkedin_url[ 0 ] != '' ) { ?> <li><a href='<?php echo $linkedin_url[ 0 ]; ?>'  class="btn btn-li"><i class="fa fa-linkedin"> </i></a></li> <?php } ?>
								<?php if ( $instagram_url[ 0 ] != '' ) { ?> <li><a href='<?php echo $instagram_url[ 0 ]; ?>'  class="btn btn-ins"><i class="fa fa-instagram"> </i></a></li> <?php } ?>
							</ul>

						</div>
						<!--/.Back Side-->
					</div>	
					
				</div>
				<!--/.Rotating card-->

			<?php } ?>
		</div>
		<?php if ( $grid[ "row_close_condition" ] ) { ?>
		</div>
		<?php
	}
	$postedID									 = get_the_id();
	$_COOKIE[ 'paginationSelect' ][ 'postID' ][] = $postedID;
}

