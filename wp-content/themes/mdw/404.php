<?php
include(locate_template( 'header.php' ));

$footer_type	 = get_theme_mod( 'footer_type', 'advanced' );
$color_scheme	 = get_theme_mod( 'color_scheme', 'mdb-skin' );
?>
<style>
	h1{
		margin-top: 5rem;
	}
</style>
<body <?php body_class( $color_scheme ); ?>>

    <header>
		<?php
		if ( $navbar_type ) {
			include(locate_template( "components/navigation.php" ));
		}
		?>
    </header>

    <main class="container pt-3 text-xs-center">
		<div class="row">
			<h1 class="display-1">404</h1>
			<h2> <?php _e( 'That\'s an error', 'mdw' ); ?> </h2>
			<h3> <?php _e( 'The requested page was not found on this server. That\'s all we know.', 'mdw' ); ?> </h3>
			<a href="<?php echo get_home_url(); ?>" class="btn btn-primary btn-lg ma-3"><?php _e( 'Return to home', 'mdw' ); ?> </a>
		</div>
    </main>

	<?php
	if ( $footer_type ) {
		get_template_part( 'components/footer' );
	}

	get_footer();
	?>
