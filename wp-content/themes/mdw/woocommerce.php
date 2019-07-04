<?php
include(locate_template( "header.php" ));
$new_footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
$color_scheme	 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$back_to_the_top = get_theme_mod( 'back_to_the_top', 'no' );
$font_style		 = get_theme_mod( 'font_style', '400' );
if ( $new_footer_type == 'inherit' ) {
	$footer_type = get_theme_mod( 'footer_type', 'advanced' );
} else {
	$footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
}

if ( $navigation_type == 'sidenav' || $navigation_type == 'both' ) {
	$nav = $sidenav_type == 'fixed' ? ' fixed-sn ' : ' hidden-sn ';
} else {
	$nav = '';
}
?>
<body <?php body_class( array( $color_scheme, $nav ) ); ?> <?php echo $back_to_the_top == "yes" ? " id='top-section'" : ""; ?>>
	<?php if ( $back_to_the_top == 'yes' ) { ?>
		<div class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px;">
			<a href="#top-section" class="btn-floating btn-large btn-primary">
				<i class="fa fa-arrow-up"></i>
			</a>
		</div>
	<?php } ?>
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

	$main_class		 .= 'mf-' . ($font_style / 100);
	?>

	<main class="<?php echo $main_class; ?>">
		<!--Main layout-->
		<div class="<?php echo ($layout_type == 'container' || $layout_type == 'container_sidebar') ? 'container' : 'container-fluid' ?>">
			<div class="<?php echo ($layout_type == 'container_sidebar' || $layout_type == 'full_sidebar' ? 'col-md-8' : 'col-md-12') ?>">

				<?php $count_products	 = 1; ?>

				<?php woocommerce_content(); ?>

			</div>
			<!--Sidebar-->
			<?php
			global $post;
			$page_slug		 = $post->post_name;
			$theme_name		 = wp_get_theme()->get( "Name" );
			$theme_settings	 = get_option( 'theme_mods_' . $theme_name );
			if ( !$theme_settings || !isset( $theme_settings ) ) {
				$theme_settings = array();
			}
			$match		 = preg_grep( '/' . $page_slug . '$/', array_keys( $theme_settings ) );
			$match		 = array_values( $match );
			$found_sth	 = false;
			foreach ( $match as $m ) {
				$found_sth = false;
				if ( get_theme_mod( $m ) == 1 ) {
					$found_sth = true;

					$sidebar_name = substr( $m, strpos( $m, '_' ) + 1, strpos( $m, '_' . $page_slug ) - strpos( $m, '_' ) - 1 );

					if ( is_active_sidebar( $sidebar_name ) ) {
						?>
						<div class='col-md-4' data-sidebar-type='<?php echo $sidebar_name; ?>'>
							<?php dynamic_sidebar( $sidebar_name ); ?>
						</div>
						<?php break;
					} else {
						?>
						<div class='col-md-4' data-sidebar-type='<?php echo $sidebar_name; ?>'>
						<?php _e( "Please assign some widgets", "mdw" ); ?>
						</div>
						<?php
						break;
					}
				} else {
					continue;
				}
			}


			if ( ($layout_type == 'container_sidebar' || $layout_type == 'full_sidebar') && $found_sth == false ) {
				?>
				<div class='col-md-4' data-sidebar-type='sidebar'>
					<?php
					if ( is_active_sidebar( 'sidebar' ) )
						dynamic_sidebar( 'sidebar' );
					else
						_e( "Please assign some widgets", "mdw" );
					?>
				</div>
<?php } ?>
			<!--/.Sidebar-->

		</div>
		<!--/.Main layout-->
	</main>

	<?php
	if ( $footer_type != 'none' ) {
		get_template_part( 'components/footer' );
	}
	get_footer();
	?>
