<?php
$favicon = get_theme_mod( "favicon", "" );

$color_scheme	 = get_theme_mod( 'color_scheme', 'default' );
$hash_colors	 = array(
	'default'			 => '',
    'navy-blue-skin'             => '#293756',
	'light-blue-skin'			 => '#1f567d',
	'deep-purple-skin'		 => '#372e5f',
	'grey-skin'			 => '#393b44',
	'mdb-skin'			 => '#3F729B',
    'pink-skin'          => '#532a3c',
    'black-skin'          => '#0F0F0F',
    'white-skin'             => '#fff',
    'cyan-skin'          => '#053638',
	'indigo-skin'			 => '#13204a',
);


$color_scheme		 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$background_color	 = get_theme_mod( "background_color", "#ffffff" );

$navigation = get_post_meta( get_the_ID(), 'meta-navigation-type', TRUE );
if ( $navigation == "inherit" ) {
	$navigation_type = get_theme_mod( 'navigation_type', 'navbar' );
} else {
	if ( get_post_meta( get_the_ID(), 'meta-navigation-type', FALSE ) ) {
		$navigation_type = get_post_meta( get_the_ID(), 'meta-navigation-type', FALSE );
		$navigation_type = $navigation_type[ 0 ];
	} else {
		$navigation_type = get_theme_mod( 'navigation_type', 'navbar' );
	}
}

$navbar = get_post_meta( get_the_ID(), 'meta-navbar-type', TRUE );
if ( $navbar == "inherit" ) {
	$navbar_type = get_theme_mod( 'navbar_type', 'basic' );
} else if ( get_post_meta( get_the_ID(), 'meta-navbar-type', FALSE ) ) {
	$navbar_type = get_post_meta( get_the_ID(), 'meta-navbar-type', FALSE );
	$navbar_type = $navbar_type[ 0 ];
} else {
	$navbar_type = get_theme_mod( 'navbar_type', 'basic' );
}

$sidenav = get_post_meta( get_the_ID(), 'meta-sidenav-type', TRUE );
if ( $sidenav == "inherit" ) {
	$sidenav_type = get_theme_mod( 'sidenav_type', 'fixed' );
} else if ( get_post_meta( get_the_ID(), 'meta-sidenav-type', FALSE ) ) {
	$sidenav_type	 = get_post_meta( get_the_ID(), 'meta-sidenav-type', FALSE );
	$sidenav_type	 = $sidenav_type[ 0 ];
} else {
	$sidenav_type = get_theme_mod( 'sidenav_type', 'fixed' );
}

$transparent = get_post_meta( get_the_ID(), 'meta-transparent-type' );
if ( $transparent == "inherit" ) {
	$nav_transparent = get_theme_mod( 'nav_transparent', 'no' );
} else if ( isset( $transparent[ 0 ] ) ) {
	$nav_transparent = get_post_meta( get_the_ID(), 'meta-transparent-type' );
	$nav_transparent = $nav_transparent[ 0 ];
} else {
	$nav_transparent = get_theme_mod( 'nav_transparent', 'no' );
}

$layout = get_post_meta( get_the_ID(), 'custom-layout-meta-box-dropdown', TRUE );
if ( $layout == "inherit" ) {
	$layout_type = get_theme_mod( 'layout_type', 'container_sidebar' );
} else if ( get_post_meta( get_the_ID(), 'custom-layout-meta-box-dropdown', FALSE ) ) {
	$layout_type = get_post_meta( get_the_ID(), 'custom-layout-meta-box-dropdown', FALSE );
	$layout_type = $layout_type[ 0 ];
} else {
	$layout_type = get_theme_mod( 'layout_type', 'container_sidebar' );
}

if ( $navigation_type == 'sidenav' || $navigation_type == 'both' ) {
	$nav = $sidenav_type == 'fixed' ? ' fixed-sn ' : ' hidden-sn ';
} else {
	$nav = '';
}
?>



<!DOCTYPE html>
<html style="margin-top: 0px !important;" <?php language_attributes(); ?>>

	<head>
		<link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon">
		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="theme-color" content="<?php echo $hash_colors[ $color_scheme ]; ?>">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<title>
			<?php bloginfo( 'name' ); ?> | <?php is_front_page() ? bloginfo( 'description' ) : wp_title( '' ); ?>
		</title>
		<?php
		$ga_id	 = get_option( 'google_analytics_id' );
		if ( !empty( $ga_id ) ) {
			echo print_google_analytics_call();
		}
?>
		<?php
		$navbar	 = get_theme_mod( 'nav_transparent' );
		?>
		<?php if ( $navbar ) : ?>
			<style>
				.navbar {
					background-color: transparent;
				}
				.top-nav-collapse {
					background-color: #4285F4;
				}
				@media only screen and (max-width: 768px) {
					.navbar {
						background-color: #4285F4;
					}
				}
			</style>
		<?php endif; ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class( array( $color_scheme, $nav ) ); ?> style= " background-color: <?php echo $background_color ?>">