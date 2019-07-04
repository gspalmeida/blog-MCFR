<?php

/**
 * Blog v8 template
 * @see http://mdbootstrap.com/sections/blog/
 */
function get_mdw_blog_template_8( $params = array() ) {
	$defaults			 = array( // the defaults will be overidden if set in $params
		'words_per_excerpt'	 => 30,
		'category'			 => 'No categories',
		'amount'			 => 3,
		'social_buttons'	 => 'yes',
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
		<div class="row <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">
		<?php } ?>
		<div class="<?php
		echo $grid[ "grid_class" ];
		echo $params[ 'animation' ] == 'None' ? '' : ( ' wow ' . $params[ 'animation' ] );
		?> <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>" data-post-id="<?php the_ID(); ?>">
			<!--Card-->
			<div class="card">
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

	<?php if ( $params[ 'social_buttons' ] == "yes" ) { ?>
					<!--Social buttons-->
					<div class="card-share">
						<div class="social-reveal">
							<!--Facebook-->
							<a type="button" class="btn-floating btn-fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
							<!--Twitter-->
							<a type="button" class="btn-floating btn-tw" href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
							<!--Google -->
							<a type="button" class="btn-floating btn-gplus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
						</div>
						<a class="btn-floating btn-action share-toggle"><i class="fa fa-share-alt"></i></a>
					</div>
					<!--/Social buttons-->
	<?php } ?>
				<!--Card content-->
				<div class="card-block">

					<!--Title-->
					<h4 class="card-title"><?php the_title(); ?></h4>
					<hr>
					<!--Text-->
					<p class="card-text" data-content="true">
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
					<div class="text-xs-center">
						<a class="btn btn-primary" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'mdw' ) ?></a>
					</div>
				</div>
				<!--/.Card content-->
				</div>
			<!--/.Card-->
		</div>
	<?php if ( $grid[ "row_close_condition" ] ) { ?>
		</div>
		<?php
	}
	$postedID									 = get_the_id();
	$_COOKIE[ 'paginationSelect' ][ 'postID' ][] = $postedID;
}
