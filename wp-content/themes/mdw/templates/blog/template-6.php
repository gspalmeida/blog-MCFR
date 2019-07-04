<?php

/**
 * Blog v6 template
 * @see http://mdbootstrap.com/sections/blog/
 */
function get_mdw_blog_template_6( $params = array() ) {
	global $wpdb;
	$defaults				 = array( // the defaults will be overidden if set in $params
		'words_per_excerpt'	 => 30,
		'category'			 => 'No categories',
		'amount'			 => 3,
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
		<div class="row <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">
		<?php } ?>
		<div class="<?php
		echo $grid[ "grid_class" ];
		echo $params[ 'animation' ] == 'None' ? '' : ( ' wow ' . $params[ 'animation' ] );
		?> <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>" data-post-id="<?php the_ID(); ?>"> <?php // echo (floor(12/$params['amount']) < 3) ? '4' : floor(12/$params['amount'])    ?>
			<!--Card-->
			<div class="card card-cascade narrower">
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

				<!--Card content-->
				<div class="card-block">
					<?php
					if ( esc_attr( $params[ 'category' ] ) == 'No categories' ) {
						$icons = get_mdw_category();
						?>

						<a href="<?php echo $icons[ "url" ]; ?>"><h5 style="color:<?php echo $icons[ "color" ]; ?>"><i class="<?php echo $icons[ "icon" ]; ?>"></i>&nbsp;<?php echo $icons[ "name" ]; ?></h5></a>
					<?php }
					?>

					<!--Title-->
					<h4 class="card-title"><?php the_title(); ?></h4>
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
					<?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', 'mdw' ) ); ?>
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
