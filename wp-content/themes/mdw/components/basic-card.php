<!--Card-->
<div class="card">
	<?php
	$post_format	 = get_post_format() ?: 'standard';
	$featured		 = 'featured';
	$content_where	 = 'content';
	echo posts_format( $post_format, $featured );
	?>
	<?php if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' && $post_format != 'link' ) { ?>
		<!--Card image-->
		<div class="view overlay hm-white-slight">
			<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
			<a href="<?php echo get_permalink(); ?>">
				<div class="mask"></div>
			</a>
		</div>
		<!--/.Card image-->
	<?php } ?>

    <!--Card content-->
    <div class="card-block">
        <!--Title-->
        <a href="<?php echo get_permalink(); ?>"><h4 class="card-title"><?php echo get_the_title(); ?></h4></a>
        <!--Text-->
        <p class="card-text"><?php echo the_excerpt(); ?> </p>
        <p class="text-sm-right"> <?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', 'mdw' ) ); ?></p>
    </div>
    <!--/.Card content-->
</div>
<!--/.Card-->