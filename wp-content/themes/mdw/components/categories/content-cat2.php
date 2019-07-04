<div class="col-lg-6 col-md-12 mb-r text-xs-center">
    <!--Featured image-->
    <div class="view overlay hm-white-slight mb-2">
		<?php
		$post_format = get_post_format() ?: 'standard';
		$featured = 'featured';
		$content_where = 'content';
		echo posts_format( $post_format, $featured );
		?>
		<?php if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' && $post_format != 'link' ) { ?>
		<?php the_post_thumbnail( 'full' ); ?>
		<?php if (!is_single() ) { ?>
		<a href="<?php the_permalink(); ?>">
			<div class="mask waves-effect waves-light"></div>
		</a>
		<?php } else { ?>
		<div class="mask waves-effect waves-light"></div>
		<?php } ?>
		<?php } ?>
    </div>

    <!--Excerpt-->
	<?php
	$icons = get_mdw_category();
	?>

	<a href="<?php echo $icons[ "url" ]; ?>"><h5 style="color:<?php echo $icons[ "color" ]; ?>"><i class="<?php echo $icons[ "icon" ]; ?>"></i>&nbsp;<?php echo $icons[ "name" ]; ?></h5></a>
    <h4><?php the_title(); ?></h4>
    <p>
		<?php if ( get_theme_mod( 'display_post_author' ) == 'yes' && get_theme_mod( 'display_post_date' ) == 'yes' ) { ?>
		<p>
			<?php
			$archive_year	 = get_the_time( 'Y' );
			$archive_month	 = get_the_time( 'm' );
			$archive_day	 = get_the_time( 'd' );
			echo ( __( 'by ', 'mdw' ) . '<strong>' . get_the_author_posts_link() . '</strong>');
			?>
			<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
			<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "-m-", get_the_ID() ); ?></a>
			<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "d", get_the_ID() ); ?></a>
			<?php
			?>
		</p>
		<?php
	} elseif ( get_theme_mod( 'display_post_author' ) == 'yes' ) {
		echo ( __( 'by ', 'mdw' ) . '<strong>' . get_the_author_posts_link() . '</strong>');
	} elseif ( get_theme_mod( 'display_post_date' ) == 'yes' ) {
		echo get_the_date();
	}
	?>
</p>
<p>
	<?php
	if ( has_excerpt() ) {
		if ( $post_format == 'quote' || $post_format == "chat" ) {

			echo post_format_content( $post_format );
		} else {
			the_excerpt();
		}
	} else {
		if ( $post_format == 'quote' || $post_format == "chat" ) {
			echo post_format_content( $post_format );
		} else {
			echo excerpt( get_the_content(), 30 );
		}
	}
	?>
</p>
<?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', 'mdw' ) ); ?>
</div>