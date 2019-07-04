<?php
rewind_posts();
include(locate_template( "header.php" ));
$footer_type	 = get_theme_mod( 'footer_type', 'advanced' );
$color_scheme	 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$font_style		 = get_theme_mod( 'font_style', '300' );
$display_sidebar         = get_theme_mod( 'display_sidebar_author', 'yes' );

$post_format	 = get_post_format() ?: 'standard';
$featured		 = 'featured';
$content_where	 = 'content';

if ( $navigation_type == 'sidenav' || $navigation_type == 'both' ) {
	$nav = $sidenav_type == 'fixed' ? ' fixed-sn ' : ' hidden-sn ';
} else {
	$nav = '';
}
?>
<body <?php body_class( array( $color_scheme, $nav ) ); ?>>
	<header>
		<?php
		if ( $navigation_type != '' ) {
			include(locate_template( "components/navigation.php" ));
		}
		?>
	</header>
	<?php
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
		<div class="<?php echo ($layout_type == 'container' || $layout_type == 'container_sidebar' && is_active_sidebar( 'sidebar' ) && $display_sidebar == "yes") ? 'container' : 'container-fluid' ?>">

			<div class="row">
				<!--Main column-->
				<div class="<?php echo (is_active_sidebar( 'sidebar' ) && $display_sidebar == "yes" ? 'col-md-8' : 'col-md-12') ?>">
					<?php if ( is_archive() ) { ?>
						<!--Archive header-->
						<h2 class="main-heading">
							<?php
							if ( !is_author() ) {
								_e( "Browsing:", "mdw" );
							}
							?>
							<strong>
								<?php
								if ( is_category() ) {
									single_cat_title(); // _e("Category ", "mdw")
								} else if ( is_tag() ) {
									single_tag_title(); // _e( "Posts for tag ", "mdw" )
								} else if ( is_day() ) {
									echo __( 'Daily archives ', 'mdw' ) . get_query_var( 'day' ) . ' ' . $GLOBALS[ 'wp_locale' ]->get_month( $monthnum ) . ' ' . get_query_var( 'year' );
								} else if ( is_month() ) {
									echo __( 'Monthly archives ', 'mdw' ) . $GLOBALS[ 'wp_locale' ]->get_month( $monthnum ) . ' ' . get_query_var( 'year' );
								} else if ( is_year() ) {
									_e( 'Annual archives ', "mdw" ) . get_query_var( 'year' );
								} else if ( !is_author() ) {
									_e( 'Archives', "mdw" );
								}
								?>
							</strong>
						</h2>
						<?php
						if ( is_author() ) {
							$authorVersion = 'author' . get_theme_mod( 'author_version', '1' );
							get_template_part( 'components/author/content', $authorVersion );
						}
						if ( category_description() ) {
							?>
							<p class="text-fluid"><?php category_description(); ?></p>
						<?php } ?>
						<?php if ( is_category() || is_author() || is_tag() || is_day() || is_month() || is_year() ) { ?>
							<section class="section extra-margins">
							<?php } ?>
							<!--/.Archive header-->
							<?php
						}
						if ( have_posts() ) {
							$i = 0;
							while ( have_posts() ) {
								$i++;
								the_post();
								if ( function_exists( 'wc_get_page_id' ) && (wc_get_page_id( 'cart' ) == get_the_ID() || wc_get_page_id( 'checkout' ) == get_the_ID()) ) {
									get_template_part( 'content', 'page' );
								} else if ( is_category() ) {
									$categoryVersion = 'cat' . get_theme_mod( 'cat_version', '1' );
									display_archive_page("categories", $categoryVersion , $i);
								} else if ( is_author() ) {
									get_template_part( 'components/author/content', 'author-listing' );
								} else if ( is_day() ) {
									$categoryVersion = 'date' . get_theme_mod( 'cat_version', '1' );
									display_archive_page("bydate", $categoryVersion, $i );
								} else if ( is_month() ) {
									$categoryVersion = 'date' . get_theme_mod( 'cat_version', '1' );
									display_archive_page("bydate", $categoryVersion, $i  );
								} else if ( is_year() ) {
									$categoryVersion = 'date' . get_theme_mod( 'cat_version', '1' );
									display_archive_page("bydate", $categoryVersion, $i  );
								} else if ( is_tag() ) {
									$categoryVersion = 'tag' . get_theme_mod( 'cat_version', '1' );
									display_archive_page("bytag", $categoryVersion, $i  );
								} else {
									get_template_part( 'content', get_post_format() );
								}
								?>
								<!--/.Post-->
								<?php
							} // end while
						} // end if
						?>
						<?php ?>
						<div class="col-md-12">
							<?php mdw_pagination(); ?>
						</div>
						<?php if ( is_category() || is_author() || is_tag() || is_day() || is_month() || is_year() ) { ?>
						</section>
					<?php } ?>
				</div>
				<!--Sidebar-->
				<?php if ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar' && is_active_sidebar( 'sidebar' )) { ?>
					<div class='col-md-4' data-sidebar-type='sidebar'>
						<?php
							dynamic_sidebar( 'sidebar' );
						?>
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
