<?php
/* Template Name: Portfolio */
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
?>

<?php if ( is_active_sidebar( 'portfolio-page-intro' ) || is_active_sidebar( 'portfolio-page' ) ) : ?>
	<header <?php echo $back_to_the_top == "yes" ? " id='top-section'" : ""; ?> data-sidebar-type='portfolio-page-intro'>
		<?php if ( $back_to_the_top == 'yes' ) { ?>
			<div class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px;">
				<a href="#top-section" class="btn-floating btn-large red">
					<i class="fa fa-arrow-up"></i>
				</a>
			</div>
			<?php
		}
		if ( $navigation_type != '' ) {
			include(locate_template( "components/navigation.php" ));
		}
		?>
		<?php if ( is_active_sidebar( 'portfolio-page-intro' ) ) : ?>
			<?php dynamic_sidebar( 'portfolio-page-intro' ); ?>
		<?php endif; ?>
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
	<main class="<?php echo $main_class; ?>"
		  data-sidebar-type='portfolio-page'>

		<?php if ( is_active_sidebar( 'portfolio-page' ) ) : ?>
			<?php dynamic_sidebar( 'portfolio-page' ); ?>
		<?php endif; ?>

	</main>
<?php else: ?>
	<header data-sidebar-type='portfolio-page-intro' class="container"><h3><?php _e( "Please assign widgets to this Portfolio Intro Area in admin dashboard.", "mdw" ); ?></h3></header>
	<div data-sidebar-type='portfolio-page' class="container"><h3><?php _e( "Please assign widgets to this portfolio page in admin dashboard.", "mdw" ); ?></h3></div>
		<?php endif; ?>

<?php
if ( $footer_type != 'none' ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
