<?php
/* Template Name: Under Construction */
include(locate_template( "header.php" ));
$new_footer_type = get_post_meta( get_the_ID(), 'meta-footer-type',true);
$color_scheme	 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$back_to_the_top = get_theme_mod( 'back_to_the_top', 'no' );
$font_style		 = get_theme_mod( 'font_style', '400' );
if ( $new_footer_type == 'inherit' || $new_footer_type == "" ) {
	$footer_type = get_theme_mod( 'footer_type', 'advanced' );
} else {
	$footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
}
?>

<!-- <style>

  body{
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    justify-content: space-between;
  }

</style> -->
<?php if ( $navbar_type == "fixed" || $navbar_type == "scrolling" ) { ?>

	<style>
		body {
			margin-top: 62px;
		}
	</style>

<?php } ?>
<?php
?>
<header <?php echo $back_to_the_top == 'yes' ? ' id="top-section"' : '' ?>>

	<?php
	if ( $navigation_type != '' ) {
		include(locate_template( "components/navigation.php" ));
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

</header>
<main class="<?php echo $main_class; ?>">

	<div class="<?php echo ($layout_type == 'container' || $layout_type == 'container_sidebar') ? 'container' : 'container-fluid' ?> text-xs-center">
		<h1 class="my-3"><?php echo get_post_meta( get_the_ID(), 'under-construction-meta-box-text', TRUE ); ?></h1>
		<h3>You can go back to <a href="<?php echo home_url(); ?>">home</a></h3>
	</div>

</main>


<?php
if ( $footer_type != 'none' ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>