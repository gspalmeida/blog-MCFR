<?php

/**
 * Blog v4 template
 * @see http://mdbootstrap.com/sections/blog/
 */
function get_mdw_blog_template_4( $params = array() ) {
	global $wpdb;
	$defaults		 = array( // the defaults will be overidden if set in $params
		'words_per_excerpt'	 => 30,
		'animation'			 => 'None',
		'display_date'		 => 'on',
		'display_author'	 => 'on',
	);
	$params			 = array_merge( $defaults, $params );
	$post_format	 = get_post_format() ?: 'standard';
	$featured		 = 'featured';
	$content_where	 = 'content';

	$have_categories = get_the_category();

	if ( $have_categories != null ) {
		$mdw_category_table	 = get_theme_mod( 'categories' );
		; // mdw category table
		$first_category		 = get_the_category();
		$first_category		 = $first_category[ 0 ];
		$category_url		 = get_category_link( $first_category->term_id );
		$category_name		 = $first_category->name;
		$display_category	 = ( __( ' in ', 'mdw' ) . '<a href="' . $category_url . '">' . $category_name . '</a>' );
	} else {
		$display_category = '';
	}
	?>
	<div class="row" data-post-id="<?php the_ID(); ?>" >
		<div class="col-md-12 <?php echo $params[ 'animation' ] == 'None' ? '' : ( ' wow ' . $params[ 'animation' ] ); ?>">

			<div class="view overlay hm-white-slight z-depth-1">
				<?php echo posts_format( $post_format, $featured ); ?>
				<?php if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' && $post_format != 'link' ) { ?>
					<a href="<?php the_permalink(); ?>">
						<img src="<?php the_post_thumbnail_url( 'full' ); ?>" class="img-fluid z-depth-1">
						<div class="mask"></div>
					</a>
				<?php } ?>
			</div>
			<p>
				<?php ?>
			</p>
			<!--Post data-->
			<div class="jumbotron z-depth-1-half">
				<h2><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>
				<p><?php
					$archive_year	 = get_the_time( 'Y' );
					$archive_month	 = get_the_time( 'm' );
					$archive_day	 = get_the_time( 'd' );
					echo $params[ 'display_author' ] == 'on' ? ( __( 'Written by ', 'mdw' ) . '<strong>' . get_the_author_posts_link() . '</strong>' ) : '';
					if($params[ 'display_author' ] == 'on' && $params[ 'display_date' ] == 'on'){ ?>
					<a href="<?php echo get_year_link( $archive_year ); ?>">, <?php echo get_the_date( "Y", get_the_ID() ); ?></a>
					<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", get_the_ID() ); ?></a>
					<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", get_the_ID() ); ?></a>
				<?php } else if ($params[ 'display_date' ] == 'on') { ?>
					<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
					<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", get_the_ID() ); ?></a>
					<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", get_the_ID() ); ?></a>
				<?php } ?>
					<?php
					echo $params[ 'display_author' ] == 'on' || $params[ 'display_date' ] == 'on' ? ' ' : '';
					echo $display_category;
					?></p>
				<?php echo social_buttons( get_permalink() ); ?>
			</div>
			<!--Excerpt-->
			<div class="excerpt">
				<p data-content="true">
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
			</div>

			<!--/Excerpt-->
		</div> <!-- /.column -->
	</div> <!-- /.row -->
	<hr>

	<?php
	$postedID									 = get_the_id();
	$_COOKIE[ 'paginationSelect' ][ 'postID' ][] = $postedID;
}
?>
