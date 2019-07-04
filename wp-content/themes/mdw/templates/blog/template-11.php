<?php

/**
 * Blog v1 template
 * @see http://mdbootstrap.com/sections/blog/
 */
function get_mdw_blog_template_11( $params = array() ) {
	global $wpdb;
	$defaults		 = array( // the defaults will be overidden if set in $params
		'words_per_excerpt'	 => 30,
		'counter'			 => 0,
		'display_date'		 => 'on',
		'display_author'	 => 'on',
		'animation'			 => '',
		
	);
	$params			 = array_merge( $defaults, $params );
	$post_format	 = get_post_format() ?: 'standard';
	$featured		 = 'featured';
	$content_where	 = 'content';
	?>

	<!--Post-->
	<div class="row widget-spacing" data-post-id="<?php the_ID(); ?>">
		<div class="col-md-3 mb-r">
			<div class="view overlay hm-white-slight">
				<?php echo posts_format( $post_format, $featured ); ?>
				<?php if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' && $post_format != 'link' ) { ?>
					<a href="<?php the_permalink(); ?>">
						<img src="<?php the_post_thumbnail_url( 'full' ); ?>" class="img-fluid z-depth-1">
						<div class="mask"></div>
					</a>
				<?php } ?>
			</div>
		</div>
		<div class="col-md-9 mb-r">
			<h5 style="float:left;"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?>  </a></h5>
			<p style="float:right;">
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

			
				<?php
				echo ($params[ 'display_author' ] == 'on' && $params[ 'display_date' ] == 'on') ? ', ' : '';
				echo $params[ 'display_author' ] == 'on' ? ( __( 'by ', 'mdw' ) . '<strong>' . get_the_author_posts_link() . '</strong>' ) : '';
				?>
			</p>
			<div style="clear:both;"></div>
			<p>
				<?php
				if ( has_excerpt() ) {
					echo get_the_excerpt();
				} else {
					echo substr( excerpt( get_the_content(), $params[ 'words_per_excerpt' ] ), 0, count( excerpt( get_the_content(), $params[ 'words_per_excerpt' ] ) ) - 5 );
				}
				?>
				<a href="<?php the_permalink(); ?>">&nbsp;[...]</a>
			</p>
		</div>
	</div>
	<!--/.Post-->
	<?php
	$postedID									 = get_the_id();
	$_COOKIE[ 'paginationSelect' ][ 'postID' ][] = $postedID;
}
?>
