<?php

/**
 * Blog v2 template
 * @see http://mdbootstrap.com/sections/blog/
 */
function get_mdw_blog_template_2( $params = array() ) {
	global $wpdb;
	$defaults = array( // the defaults will be overidden if set in $params
		'words_per_excerpt'	 => 30,
		'category'			 => 'No categories',
		'counter'			 => 0,
		'animation'			 => 'None',
		'display_date'		 => 'on',
		'display_author'	 => 'on',
		'columns_amount'	 => '1'
	);

	$params					 = array_merge( $defaults, $params );
	$post_format			 = get_post_format() ?: 'standard';
	$featured				 = 'featured';
	$content_where			 = 'content';
	$grid					 = createGridClass( $params );
	$grid[ "grid_class" ]	 .= ' mb-r ';
	if ( $grid[ "row_open_condition" ] ) {
		?>
		<div class="row">
		<?php } ?>
		<div class="<?php echo $grid[ "grid_class" ]; ?> <?php echo $params[ 'animation' ] == 'None' ? '' : ( ' wow ' . $params[ 'animation' ] ); ?>" data-post-id="<?php the_ID(); ?>">
			<div class="view overlay hm-white-slight mb-2">
				<?php echo posts_format( $post_format, $featured ); ?>
				<?php if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' && $post_format != 'link' ) { ?>
					<a href="<?php the_permalink(); ?>">
						<img src="<?php the_post_thumbnail_url( 'full' ); ?>" class="img-fluid z-depth-1">
						<div class="mask"></div>
					</a>
				<?php } ?>
			</div>

			<!--Excerpt-->
			<?php
			if ( esc_attr( $params[ 'category' ] ) == 'No categories' ) {
				$icons = get_mdw_category();
				?>

				<a href="<?php echo $icons[ "url" ]; ?>"><h5 style="color:<?php echo $icons[ "color" ]; ?>"><i class="<?php echo $icons[ "icon" ]; ?>"></i>&nbsp;<?php echo $icons[ "name" ]; ?></h5></a>
			<?php }
			?>
			<h4><?php echo get_the_title(); ?></h4>
			<p>
				<?php
				$archive_year	 = get_the_time( 'Y' );
				$archive_month	 = get_the_time( 'm' );
				$archive_day	 = get_the_time( 'd' );
				echo $params[ 'display_author' ] == 'on' ? ( __( 'by ', 'mdw' ) . '<strong>' . get_the_author_posts_link() . '</strong>' ) : '';
				if($params[ 'display_author' ] == 'on' && $params[ 'display_date' ] == 'on'){ ?>
					<a href="<?php echo get_year_link( $archive_year ); ?>">, <?php echo get_the_date( "Y", get_the_ID() ); ?></a>
					<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", get_the_ID() ); ?></a>
					<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", get_the_ID() ); ?></a>
				<?php } else if ($params[ 'display_date' ] == 'on') { ?>
					<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
					<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", get_the_ID() ); ?></a>
					<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", get_the_ID() ); ?></a>
				<?php } ?>
			</p>
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
			<?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', 'mdw' ) ); ?>

		</div>

		<?php if ( $grid[ "row_close_condition" ] ) { ?>
		</div>
		<?php
	}
	$postedID									 = get_the_id();
	$_COOKIE[ 'paginationSelect' ][ 'postID' ][] = $postedID;
}
