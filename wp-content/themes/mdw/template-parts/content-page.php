<?php
/**
 * The template used for displaying page content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	// Page thumbnail and title.
	if ( has_post_thumbnail() ) {
		the_post_thumbnail();
	}
	?>
	<h2><?php the_title(); ?></h2>

	<div>
		<?php
		the_content();
		wp_link_pages( array(
			'before'		 => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'mdw' ) . '</span>',
			'after'			 => '</div>',
			'link_before'	 => '<span>',
			'link_after'	 => '</span>',
		) );
		?>
	</div>
</article><!-- #post-## -->
