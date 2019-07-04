<?php
/* Template Name: Jumbotron Page */
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

<header>
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


$heading		 = get_post_meta( get_the_ID(), 'jumbotron-meta-box-text', TRUE );
$top_content	 = get_post_meta( get_the_ID(), 'jumbotron-meta-box-textarea-top-content', TRUE );
$bottom_content	 = get_post_meta( get_the_ID(), 'jumbotron-meta-box-textarea-bottom-content', TRUE );
$button_name	 = get_post_meta( get_the_ID(), 'jumbotron-meta-box-button-name', TRUE );
$button_link	 = get_post_meta( get_the_ID(), 'jumbotron-meta-box-button-link', TRUE );

$button_link = get_post_meta( get_the_ID(), 'jumbotron-meta-box-button-link', TRUE );
?>
<main class="<?php echo $main_class; ?>">
    <!--Content-->
    <div class="container" <?php echo $back_to_the_top == "yes" ? "id='top-section'" : ""; ?>>

        <!--First row-->
		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron">
					<?php if ( $heading != '' ) { ?>
						<h2 class="h2-responsive"><?php echo $heading; ?></h2>
					<?php } else { ?>
						<h2 class="h2-responsive">Material Design for WordPress</h2>
					<?php } ?>
					<br>
					<?php
					if ( $top_content != '' ) {
						?>
						<p><?php echo $top_content; ?></p>
					<?php } else { ?>
						<p>Powerful and free Material Design for WordPress Theme</p>
					<?php } ?>
					<hr>
					<?php
					if ( $bottom_content != '' ) {
						?>
						<p><?php echo $bottom_content; ?></p>
					<?php } else { ?>
						<p><?php _e( "Register for free and get access to amazing framework and beautiful components", "mdw" ); ?></p>
					<?php } ?>
					<?php if ( $button_link != '' ) { ?>
						<a target="_blank" href="<?php echo ( "http://" . $button_link ) ?>" type="button" class="btn btn-primary btn-stc">
						<?php } else { ?>
							<a target="_blank" href="http://www.mdwp.io" type="button" class="btn btn-primary btn-stc">
							<?php } ?>
							<?php
							if ( $button_name != '' ) {
								echo $button_name;
							} else {
								_e( "Download", "mdw" );
							}
							?>
							<i class="fa fa-download right"></i>
						</a>
				</div>
			</div>
		</div>
		<!--/.First row-->

        <hr class="extra-margins">

        <div class="row">
			<?php
			$args	 = array(
				'posts_per_page' => '3',
				'order'			 => 'DESC',
				'orderby'		 => 'date',
			);
			$query	 = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					?>
					<div class="col-md-4">
						<?php get_template_part( 'components/basic-card' ); ?>
					</div>
					<?php
				}
			} else {
				_e( "No posts found", "mdw" );
			}
			wp_reset_postdata();
			?>

        </div>
    </div>
    <!--/.Content-->
</main>
<?php
if ( $footer_type != 'none' ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
