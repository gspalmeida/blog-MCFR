<?php
/* Template Name: Half Carousel Page */
include(locate_template( "header.php" ));
$new_footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
$color_scheme	 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$back_to_the_top = get_theme_mod( 'back_to_the_top', 'no' );
if ( $new_footer_type == 'inherit' || $new_footer_type == "" ) {
	$footer_type = get_theme_mod( 'footer_type', 'advanced' );
} else {
	$footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
}
?>

<header>
	<?php
	if ( $navigation_type != '' ) {
		include(locate_template( "components/navigation.php" ));
	}
	?>
</header>
<?php if ( $back_to_the_top == 'yes' ) { ?>
	<div class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px;">
		<a href="#carousel-example-1" class="btn-floating btn-large btn-primary">
			<i class="fa fa-arrow-up"></i>
		</a>
	</div>
<?php } ?>
<!--Carousel Wrapper-->
<div id="carousel-example-1" class="carousel slide carousel-fade half-carousel" data-ride="carousel">
	<!--Indicators-->
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-1" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-1" data-slide-to="1"></li>
		<li data-target="#carousel-example-1" data-slide-to="2"></li>
	</ol>
	<!--/.Indicators-->

	<!--Slides-->
	<div class="carousel-inner" role="listbox">

		<?php
		$args = array(
			'posts_per_page' => '3',
			'order'			 => 'DESC',
			'orderby'		 => 'date',
		);

		$query	 = new WP_Query( $args );
		$counter = 1;
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				?>

				<div class="carousel-item <?php echo ($counter == 1) ? 'active' : ''; ?> " style='background-image: url("<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>");'>
					<!--Caption-->
					<div class="flex-center animated fadeInDown">
						<ul>
							<li>
								<h1 class="h1-responsive"><?php echo get_the_title(); ?></h1></li>
							<li>
								<p><?php the_excerpt(); ?></p>
							</li>
							<li>
								<?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', "mdw" ) ); ?>
							</li>
						</ul>
					</div>
					<!--Caption-->
				</div>

				<?php
				$counter++;
			}
		} else {
			_e( "No posts found", "mdw" );
		}

		wp_reset_postdata();
		?>

	</div>
	<!--/.Slides-->

	<!--Controls-->
	<a class="left carousel-control" href="#carousel-example-1" role="button" data-slide="prev">
		<span class="icon-prev" aria-hidden="true"></span>
		<span class="sr-only"><?php _e( "Previous", "mdw" ); ?></span>
	</a>
	<a class="right carousel-control" href="#carousel-example-1" role="button" data-slide="next">
		<span class="icon-next" aria-hidden="true"></span>
		<span class="sr-only"><?php _e( "Next", "mdw" ); ?></span>
	</a>
	<!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->

<br>

<!--Content-->
<div class="container">
	<div class="row">
		<?php
		$args	 = array(
			'posts_per_page' => '3',
			'order'			 => 'DESC',
			'orderby'		 => 'date',
			'offset'		 => '3'
		);
		$query	 = new WP_Query( $args );
		$counter = 1;
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
				<div class="col-md-4">
					<?php get_template_part( 'components/basic-card' ); ?>
				</div>
				<?php
				$counter++;
			}
		} else {
			_e( "No posts found", "mdw" );
		}
		wp_reset_postdata();
		?>

	</div>
</div>
<!--/.Content-->

<?php
if ( $footer_type != 'none' ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
