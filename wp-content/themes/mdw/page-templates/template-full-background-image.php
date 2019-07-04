<?php
/* Template Name: Full Background Page */
include(locate_template( "header.php" ));
$new_footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
$back_to_the_top = get_theme_mod( 'back_to_the_top', 'no' );
$color_scheme	 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$font_style		 = get_theme_mod( 'font_style', '400' );
if ( $new_footer_type == 'inherit' || $new_footer_type == "" ) {
	$footer_type = get_theme_mod( 'footer_type', 'advanced' );
} else {
	$footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
}
?>
<style type="">

	footer{
		margin-top: 0!important;
	}
	h1, p{
		color: white!important;
	}

</style>


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


$heading		 = get_post_meta( get_the_ID(), 'background-meta-box-text', TRUE );
$secondary		 = get_post_meta( get_the_ID(), 'background-meta-box-textarea-secondary', TRUE );
$button_name	 = get_post_meta( get_the_ID(), 'background-meta-box-button-name', TRUE );
$button_link	 = get_post_meta( get_the_ID(), 'background-meta-box-button-link', TRUE );
$button_name_1	 = get_post_meta( get_the_ID(), 'background-meta-box-button-name_1', TRUE );
$button_link_1	 = get_post_meta( get_the_ID(), 'background-meta-box-button-link_1', TRUE );
?>
<!--Content-->
<div class="view hm-black-strong" style="background: url(<?php the_post_thumbnail_url( "full" ); ?>) repeat center center fixed; background-size: cover; height:100vh">
	<div class="full-bg-img flex-center">
		<ul class="animated fadeInUp">
			<li>
				<?php if ( $heading != '' ) { ?>
					<h1 class="h1-responsive"><?php echo $heading; ?></h1>
				<?php } else { ?>
					<h1 class="h1-responsive">Material Design for WordPress</h1>
				<?php } ?>
			</li>
			<li>
				<?php
				if ( $secondary != '' ) {
					?>
					<p><?php echo $secondary; ?></p>
				<?php } else { ?>
					<p>Powerful and free Material Design for WordPress Theme</p>
				<?php } ?>
			</li>
			<li>
				<?php if ( $button_name != '' ) { ?>
					<a target="_blank" href="<?php echo ( "http://" . $button_link ) ?>" type="button" class="btn btn-primary btn-stc">
						<?php echo $button_name ?>
					</a>
				<?php } ?>

				<?php if ( $button_name_1 != '' ) { ?>
					<a target="_blank" href="<?php echo ( "http://" . $button_link_1 ) ?>" type="button" class="btn btn-secondary btn-stc">
						<?php echo $button_name_1 ?>
					</a>
				<?php } ?>
			</li>
		</ul>
	</div>
</div>
<!--/.Content-->
<?php
if ( $footer_type != 'none' ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
