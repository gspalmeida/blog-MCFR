<?php
include(locate_template( "header.php" ));
$footer_type	 = get_theme_mod( 'footer_type', 'advanced' );
$color_scheme	 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$font_style		 = get_theme_mod( 'font_style', '400' );
?>

<header>
	<?php
	if ( $navigation_type != '' ) {
		include(locate_template( "components/navigation.php" ));
	}
	?>
</header>
<?php
	if ( $navbar_type == 'top' || $navbar_type == 'scrolling' ) {
	$main_class = ' pt-6 ';
}

if ( $navbar_type == 'basic' || $navbar_type == 'bottom' || $navigation_type == '' ) {
	$main_class = ' pt-3 ';
}

if ( basename( get_page_template() ) == 'template-landing-page.php' && is_active_sidebar( 'landing-page-intro' ) ) {
	$main_class = '';
}

if ( $navigation_type == 'sidenav' || $navigation_type == 'both' ) {
	if ( $navbar_type == 'bottom' ) {
		$main_class = ' pt-3 ';
	} else {
		$main_class = '';
	}
}

$main_class .= 'mf-' . ($font_style / 100);
?>

<main class="<?php echo $main_class; ?>">

	<!--Main layout-->
	<div class="<?php echo ($layout_type == 'container' || $layout_type == 'container_sidebar') ? 'container' : 'container-fluid' ?>">

		<!--Search header-->
		<h2>
			<?php
			if ( $wp_query->found_posts == 0 ) {
				_e( 'No results for: ', "mdw" );
				?> "<?php the_search_query(); ?>"
			<?php
			} else {
				echo $wp_query->found_posts;
				?> <?php _e( 'results for', 'mdw' ); ?>: "<?php esc_html( the_search_query() ); ?>"
<?php } ?>
		</h2>
		<!--/.Search header-->

		<div class="row">
			<!--Main column-->
			<div class="<?php echo ($layout_type == 'container_sidebar' || $layout_type == 'full_sidebar' ? 'col-md-8' : 'col-md-12') ?>">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						?>
						<!--Post-->
						<div class="row" data-post-id="<?php the_ID(); ?>">
							<div class="col-md-3 mb-r wow fadeInLeft">
								<?php if ( has_post_thumbnail() ) { ?>
								<?php the_post_thumbnail( 'post-thumbnail', 'class="z-depth-2"' ); ?>
									<a href="<?php the_permalink(); ?>">
										<div class="mask"></div>
									</a>
								<?php } ?>
							</div>
							<div class="col-md-9 mb-r wow fadeInRight">
								<div class="row">
									<h5 class="col-sm-6"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?>  </a></h5>
									<p class="col-sm-6">
										<?php echo get_the_date(); ?>,
										<?php _e( 'by', 'mdw' ); ?> <?php echo get_the_author(); ?>
									</p>
								</div>

								<div style="clear:both;"></div>
								<p><?php echo substr( excerpt( get_the_content(), 30 ), 0, count( excerpt( get_the_content(), 30 ) ) - 5 ); ?><a href="<?php the_permalink(); ?>">[...]</a></p>
							</div>
						</div>
						<!--/.Post-->
						<?php
					} // end while
				} // end if
				?>
<?php mdw_pagination(); ?>
			</div>
			<!--Sidebar-->
				<?php if ( is_active_sidebar( 'sidebar' ) ) { ?>
				<div class="col-md-4" data-sidebar-type='sidebar'>
				<?php dynamic_sidebar( 'sidebar' ); ?>
				</div>
<?php } ?>
			<!--/.Sidebar-->
		</div>
	</div>
	<!--/.Main layout-->
</main>

<?php
if ( $footer_type ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
