<?php
/* Template Name: Full Carousel Page */
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
<style>
	/* TEMPLATE STYLES */


	/* Necessary for full page carousel*/

	html,
	body,
	.view {
		height: 100%;
	}


	/* Navigation*/


	.scrolling-navbar {
		-webkit-transition: background .5s ease-in-out, padding .5s ease-in-out;
		-moz-transition: background .5s ease-in-out, padding .5s ease-in-out;
		transition: background .5s ease-in-out, padding .5s ease-in-out;
	}

	.top-nav-collapse {
		background-color: #1C2331;
	}

	footer.page-footer {
		background-color: #1C2331;
		margin-top: 0;
	}

	@media only screen and (max-width: 768px) {
		.navbar {
			background-color: #1C2331;
		}
	}


	/* Carousel*/

	.carousel,
	.carousel-item,
	.active {
		height: 100%;
	}

	.carousel-inner {
		height: 100%;
	}

	.carousel-item:nth-child(1) {
		background-image: url("http://mdbootstrap.com/images/regular/nature/img%20(54).jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}

	.carousel-item:nth-child(2) {
		background-image: url("http://mdbootstrap.com/images/regular/nature/img%20(4).jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}

	.carousel-item:nth-child(3) {
		background-image: url("http://mdbootstrap.com/images/regular/nature/img%20(3).jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}


	/*Caption*/

	.flex-center {
		color: #fff;
	}

	@media (min-width: 776px) {
		.carousel .view ul li {
			display: inline;
		}
		.carousel .view .full-bg-img ul li .flex-item {
			margin-bottom: 1.5rem;
		}
	}
</style>
<?php
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
<div id="carousel-example-1" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
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
					<!--Mask-->
					<div class="view hm-black-light">
						<div class="full-bg-img flex-center">
							<ul class="animated fadeInUp col-md-12">
								<h1 class="h1-responsive"><?php echo get_the_title(); ?></h1></li>
								<li>
									<p><?php the_excerpt(); ?></p>
								</li>
								<li>
									<?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', 'mdw' ) ); ?>
								</li>
							</ul>
						</div>
					</div>
					<!--/.Mask-->
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
<!--/.Main layout-->


<?php
if ( $footer_type != 'none' ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
