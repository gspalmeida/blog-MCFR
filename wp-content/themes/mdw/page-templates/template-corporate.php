<?php
/* Template Name: Corporate Page */
include(locate_template( "header.php" ));
$new_footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
$color_scheme	 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$back_to_the_top = get_theme_mod( 'back_to_the_top', 'no' );
$font_style		 = get_theme_mod( 'font_style', '400' );
if ( $new_footer_type == 'inherit' || $new_footer_type == "" ) {
	$footer_type = get_theme_mod( 'footer_type', 'advanced' );
} else {
	$footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
}

$post_format	 = get_post_format() ?: 'standard';
$featured		 = 'featured';
$content_where	 = 'content';
?>

<header <?php echo $back_to_the_top == 'yes' ? ' id="top-section"' : ""; ?>>
	<?php
	if ( $navigation_type != '' ) {
		include(locate_template( "components/navigation.php" ));
	}
	?>
</header>

<?php if ( $back_to_the_top == 'yes' ) { ?>
	<div class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px;">
		<a href="#top-section" class="btn-floating btn-large btn-primary">
			<i class="fa fa-arrow-up"></i>
		</a>
	</div>
	<?php
}

if ( $navbar_type == 'top' || $navbar_type == 'scrolling' )
	$main_class = ' pt-6 ';

if ( $navbar_type == 'basic' || $navbar_type == 'bottom' || $navigation_type == '' )
	$main_class = ' pt-3 ';

if ( basename( get_page_template() ) == 'template-landing-page.php' && is_active_sidebar( 'landing-page-intro' ) )
	$main_class = '';

if ( $navigation_type == 'sidenav' || $navigation_type == 'both' ) {
	if ( $navbar_type == 'bottom' )
		$main_class	 = ' pt-3 ';
	else
		$main_class	 = '';
}

$main_class .= 'mf-' . ($font_style / 100);

$args = array(
	'posts_per_page' => '4',
	'order'			 => 'DESC',
	'orderby'		 => 'date',
);

$query	 = new WP_Query( $args );
$counter = 1;
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();


		if ( $counter == 1 ) {
			?>
			<main class="<?php echo $main_class; ?>">
				<!--Main layout-->
				<div class="container">
					<!--First row-->
					<div class="row">
						<?php echo posts_format( $post_format, $featured ); ?>
						<?php if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' && $post_format != 'link' ) { ?>
							<!--Featured image-->
							<div class="col-md-7">
								<div class="view overlay hm-white-light z-depth-1-half">
									<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
									<a href="<?php echo get_permalink(); ?>">
										<div class="mask"></div>
									</a>
								</div>
							</div>
							<!--Featured image-->
						<?php } ?>

						<!--Main information-->
						<div class="col-md-5">
							<h2 class="h2-responsive"><?php echo get_the_title(); ?></h2>
							<hr>
							<p><?php echo post_format_content( $post_format ); ?></p>
							<p class="text-sm-right"><?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', "mdw" ) ); ?></p>
						</div>
					</div>
					<!--/.First row-->

					<hr class="extra-margins">

					<!--Second row-->
					<div class="row">

						<?php
					} else {
						?>

						<div class="col-md-4">
							<?php get_template_part( 'components/basic-card' ); ?>
						</div>


						<?php
					}
					$counter++;
				}
			} else {
				_e( "No posts found", "mdw" );
			}

			wp_reset_postdata();
			?>


		</div>
		<!--/.Second row-->
	</div>
	<!--/.Main layout-->

</main>

<?php
if ( $footer_type != 'none' ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
