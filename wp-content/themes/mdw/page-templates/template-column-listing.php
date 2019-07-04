<?php
/* Template Name: Column Listing Page */
include(locate_template( "header.php" ));
$new_footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true);
$color_scheme	 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$back_to_the_top = get_theme_mod( 'back_to_the_top', 'no' );
$font_style		 = get_theme_mod( 'font_style', '400' );
if ( $new_footer_type == 'inherit' || $new_footer_type == "" ) {
	$footer_type = get_theme_mod( 'footer_type', 'advanced' );
} else {
	$footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
}

// if (get_post_meta( get_the_ID(), 'custom-layout-meta-box-dropdown', FALSE )) {
//   $layout_type = get_post_meta( get_the_ID(), 'custom-layout-meta-box-dropdown', FALSE );
//   $layout_type = $layout_type[0];
// }
// else {
// $layout_type = get_theme_mod( 'layout_type', 'container_sidebar' );
// }
?>
<style>
	.lead {
		text-align: justify;
	}
	@media only screen and (max-width: 768px) {
		.post-title {
			margin-top: 1rem;
		}
	}
	@media only screen and (max-width: 768px) {
		.read-more {
			text-align: center;
		}
	}
	.extra-margin {
		margin-top: 2rem;
		margin-bottom: 2rem;
	}
</style>
<?php
?>
<?php
if ( $navigation_type != '' ) {
	echo $back_to_the_top == 'yes' ? "<header id='top-section'>" : "<header>";
	include(locate_template( "components/navigation.php" ));
	echo "</header>";
}
if ( $back_to_the_top == 'yes' ) {
	?>
	<div class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px;">
		<a href="#top-section" class="btn-floating btn-large btn-primary">
			<i class="fa fa-arrow-up"></i>
		</a>
	</div>
	<?php
}

$heading	 = get_post_meta( get_the_ID(), 'column-meta-box-text', TRUE );
$columns	 = get_post_meta( get_the_ID(), 'column-meta-box-dropdown', TRUE );

$postPerPage = ( get_post_meta( get_the_ID(), 'column-meta-box-counter', TRUE ) != '' ) ? get_post_meta( get_the_ID(), 'column-meta-box-counter', TRUE ) : 6;

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
?>

<main class="<?php echo $main_class; ?>">
	<!--Main layout-->
	<div class="container">
		<?php if ( $heading != '' ) { ?>
			<!--Page heading-->
			<div class="row">
				<div class="col-md-12">
					<h1 class="h1-responsive"><?php echo $heading; ?>
					</h1>
				</div>
			</div>
			<!--/.Page heading-->
			<hr>

		<?php } ?>
		<div class="row <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">

			<?php
			if ( is_front_page() )
				$paged	 = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
			else
				$paged	 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args	 = array(
				'posts_per_page' => $postPerPage,
				'order'			 => 'DESC',
				'orderby'		 => 'date',
				'paged'			 => $paged,
				'page'			 => $paged
			);

			$query	 = new WP_Query( $args );
			$counter = 1;
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();

					if ( $columns == 1 ) {
						$post_format	 = get_post_format() ?: 'standard';
						$featured		 = 'featured';
						$content_where	 = 'content';
						?>

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
						<?php } else { ?>
							<div class="col-md-7">
								<div class="view overlay hm-white-light z-depth-1-half">
									<?php echo posts_format( $post_format, $featured ); ?>
									<a href="<?php echo get_permalink(); ?>">
										<div class="mask"></div>
									</a>
								</div>
							</div>
						<?php } ?>

						<!--/.Post excerpt-->
						<div class="col-md-5">
							<a href="?php echo get_permalink();?>"><h2 class="post-title"><?php echo get_the_title(); ?></h2></a>
							<p class="lead"><?php echo the_excerpt(); ?></p>
							<div class="read-more">
								<?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', "mdw" ) ); ?>
							</div>
						</div>
						<!--/.Post excerpt-->
					</div>
					<hr>
					<div class="row <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">

						<?php
					} elseif ( $columns == 2 ) {
						?>
						<div class="col-md-6 <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">
							<?php get_template_part( 'components/basic-card' ); ?>
						</div>
						<?php
						if ( $counter % 2 == 0 ) {
							?>
						</div>
						<div class="row <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">
							<?php
						}
					} elseif ( $columns == 3 ) {
						?>
						<div class="col-md-4 <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">
							<?php get_template_part( 'components/basic-card' ); ?>
						</div>
						<?php
						if ( $counter % 3 == 0 ) {
							?>
						</div>
						<div class="row <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">
							<?php
						}
					} else {
						?>
						<div class="col-md-3 <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">
							<?php get_template_part( 'components/basic-card' ); ?>
						</div>
						<?php if ( $counter % 4 == 0 ) { ?>
						</div>
						<div class="row <?php echo get_theme_mod( "flex_cols", "no" ) == 'yes' ? 'flex-cols' : ''; ?>">
							<?php
						}
					}

					$counter++;
				}
			} else {
				_e( "No posts found", "mdw" );
			}
			?>
		</div>

		<?php
		if ( function_exists( 'custom_pagination' ) ) {
			custom_pagination( $query->max_num_pages, "", $paged );
		}
		wp_reset_postdata();
		?>


	</div>
	<!--/.Main layout-->
</main>

<?php
if ( $footer_type != 'none' ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
