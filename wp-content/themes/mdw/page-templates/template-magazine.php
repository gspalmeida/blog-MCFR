<?php
/* Template Name: Magazine */
include(locate_template( "header.php" ));
$new_footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
$color_scheme	 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$back_to_the_top = get_theme_mod( 'back_to_the_top', 'no' );
$font_style		 = get_theme_mod( 'font_style', '400' );
if ( $new_footer_type == 'inherit' || $new_footer_type == '') {
	$footer_type = get_theme_mod( 'footer_type', 'advanced' );
} else {
	$footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
}
?>

<header <?php echo $back_to_the_top == "yes" ? " id='top-section'" : ""; ?>>
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
	<?php } ?>
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

	<div class="<?php echo ($layout_type == 'container' || $layout_type == 'container_sidebar') ? 'container' : 'container-fluid' ?>">
		<div class="row">
			<?php if ( is_active_sidebar( 'magazine-header' ) ) { ?>
				<div class="col-md-12" data-sidebar-type='magazine-header'>
					<?php dynamic_sidebar( 'magazine-header' ); ?>
				</div>
			<?php } else { ?>
				<div class="col-md-12" data-sidebar-type='magazine-header'>
					<h3><?php _e( "Please assign widgets to this magazine header in admin dashboard.", "mdw" ); ?></h3>
				</div>
			<?php } ?>
		</div>
		<div class="row">
			<?php if ( is_active_sidebar( 'magazine-page' ) ) { ?>
				<div class="<?php echo ( ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar') ) ? 'col-md-8' : ''; ?>" data-sidebar-type='magazine-page'>
					<?php dynamic_sidebar( 'magazine-page' ); ?>
				</div>
			<?php } else { ?>
				<div class="col-xl-8 col-md-12" data-sidebar-type='magazine-page'>
					<h3><?php _e( "Please assign widgets to this magazine page in admin dashboard.", "mdw" ); ?></h3>
				</div>
			<?php } ?>


			<?php
			$sidebar_name = get_post_meta( get_the_ID(), 'meta-sidebar-type' );
			if ( isset( $sidebar_name[ 0 ] ) && trim( $sidebar_name[ 0 ] ) != "" && $sidebar_name[ 0 ] != "default" ) {

				if ( ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar' ) ) {
					?>
					<div class='col-md-4' data-sidebar-type='<?php echo $sidebar_name[ 0 ] ?>'>
						<?php dynamic_sidebar( $sidebar_name[ 0 ] ); ?>
					</div>
					<?php
				}
			} else if ( $sidebar_name[ 0 ] = "default" ) {
				if ( is_active_sidebar( 'magazine-sidebar' ) && ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar') ) {
					?>
					<div class='col-md-4' data-sidebar-type='magazine-sidebar'>
						<?php dynamic_sidebar( 'magazine-sidebar' ); ?>
					</div>
					<?php
				}
			} else {
				if ( is_active_sidebar( 'magazine-sidebar' ) && ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar') ) {
					?>
					<div class='col-md-4' data-sidebar-type='magazine-sidebar'>
						<?php dynamic_sidebar( 'magazine-sidebar' ); ?>
					</div>
					<?php
				}
			}
			?>
		</div>
    </div>
</main>


<?php //echo get_theme_mod( 'navbar_type_control', 'WordPress' );  ?>



<?php
if ( $footer_type != 'none' ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
