<?php
$color_scheme		 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$search_form		 = get_theme_mod( 'search_form', 'navbar' );
$navbar_social_icons = get_theme_mod( 'navbar_social_icons', 'navbar' );

$nav_fb_icon	 = get_theme_mod( "nav_fb_icon", "" );
$nav_fb_link	 = get_theme_mod( "nav_fb_link", "" );
$nav_gp_icon	 = get_theme_mod( "nav_gp_icon", "" );
$nav_gp_link	 = get_theme_mod( "nav_gp_link", "" );
$nav_tw_icon	 = get_theme_mod( "nav_tw_icon", "" );
$nav_tw_link	 = get_theme_mod( "nav_tw_link", "" );
$nav_insta_icon	 = get_theme_mod( "nav_insta_icon", "" );
$nav_insta_link	 = get_theme_mod( "nav_insta_link", "" );
$navbar_logo	 = get_theme_mod( "navbar_logo", "" );
$sidenav_opacity = get_theme_mod( 'sidenav_opacity', '');
$default_sidenav_img = get_theme_mod('default_sidenav_img', '');
$mask_power = get_theme_mod( 'sidenav_opacity', 'strong');
$background_sidenav_image = get_theme_mod('default_sidenav_image', '');
$custom_image_option = get_theme_mod('custom_sidenav', 'no');
$custom_sidenav_image = "";
$sidenav_logo = get_theme_mod('logo_image', get_template_directory_uri(). '/img/mdw_logo.jpg');
if($custom_image_option == "yes"){
    $custom_sidenav_image = 'background:url(' . get_theme_mod( 'sidenav_image' ) . ') 0% 0% no-repeat;';
} 
$default_sidenav_image = "";
if($custom_image_option == "no"){
      $default_sidenav_image = "sn-bg-".$background_sidenav_image;
} 
?>
<!-- Sidebar navigation -->
<?php if ( $navigation_type == 'sidenav' || $navigation_type == 'both' ) { ?>
	<ul id="slide-out" class="<?php echo $default_sidenav_image; ?>
    side-nav custom-scrollbar <?php echo ($sidenav_type == 'fixed') ? 'fixed' : ''; ?> default-side-nav" style="<?php echo $custom_sidenav_image; ?>">

		<!-- Logo -->
		<li>
			<?php if($sidenav_logo != '') { ?>
			<div class="logo-wrapper waves-light">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $sidenav_logo; ?>" class="img-fluid flex-center"></a>
			</div>
			<?php } ?>
		</li>
			
		<!--/. Logo -->

		<!--Search Form-->
		<li>
			<?php ($search_form == 'sidenav') ? get_search_form() : ''; ?>
		</li>
		<!--/.Search Form-->
		<?php
		if ( has_nav_menu( 'sidenav' ) ) {
			$args = array(
				'theme_location' => 'sidenav',
				'container'		 => 'false',
				'echo'			 => true,
				'menu_class'	 => 'collapsible collapsible-accordion',
				'menu_id'		 => 'side-menu',
				'fallback_cb'	 => 'wp_page_menu',
				'walker'		 => new CSS_Menu_Walker2()
			);
			wp_nav_menu( $args );
		} else {
			?>
			<p class="assign-info"><?php _e( 'Please assign Sidebar Menu in Wordpress Admin -> Appearance -> Menus -> Manage Locations', 'mdw' ); ?></p>
		<?php } ?>
        <div class="sidenav-bg mask-<?php echo $mask_power; ?>"></div>
	</ul>
	<!--/. Sidebar navigation -->
<?php } ?>
<?php if ( $navigation_type == "navbar" || $navigation_type == 'both' ) { ?>
	<!--Navbar-->
	<nav data-skin="<?php echo ($nav_transparent == 'yes') ? $color_scheme : '' ?>"
		 class="navbar <?php
		 echo ($navbar_type == 'scrolling') ? 'navbar-fixed-top scrolling-navbar ' : '';
		 echo ($navbar_type == 'top') ? 'navbar-fixed-top ' : '';
		 echo ($navbar_type == 'bottom') ? 'navbar-fixed-bottom ' : '';
		 echo ($navigation_type == 'both') ? 'double-nav ' : '';
		 ?> navbar-dark">
		<!-- Collapse button-->
		<button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx">
			<i class="fa fa-bars"></i>
		</button>

		<!-- SideNav slide-out button -->
		<?php if ( $navigation_type == 'both' ) { ?>
			<div class="pull-left">
				<a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
			</div>
		<?php } ?>
		<div class="navbar-logo">
			<!--Navbar Brand-->

			<?php echo ($navigation_type == 'both') ? '<p>' : '' ?>
			<?php if ( $navbar_logo != '' ) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"  class="waves-effect waves-light logo-wrapper"><img src="<?php echo $navbar_logo ?>"></a>
			<?php } else { ?>
				<a class="<?php echo ($navigation_type == "navbar") ? 'navbar-brand' : '' ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>


			<?php } ?>
			<?php echo ($navigation_type == 'both') ? '</p>' : '' ?>


		</div>
		<?php
		if ( get_theme_mod( 'display_navbar_breadcrumbs' ) == 'yes' ) {
			custom_breadcrumbs();
		}
		?>

		<div class="container">




			<!--Search form-->
			<?php ($search_form == 'navbar') ? get_search_form() : ''; ?>
			<!--/.Search form-->
			<!--Collapse content-->
			<div class="collapse navbar-toggleable-xs" id="collapseEx">

				<!--Links-->
				<?php
				$menu_class = ($navigation_type == 'both') ? 'nav navbar-nav' : 'nav navbar-nav';

				if ( has_nav_menu( 'navbar' ) ) {
					wp_nav_menu( array(
						'menu'			 => 'navbar',
						'theme_location' => 'navbar',
						'depth'			 => 0,
						'menu_class'	 => $menu_class,
						'fallback_cb'	 => 'wp_bootstrap_navwalker::fallback',
						'walker'		 => new MDWBootstrapNavMenuWalker()
					)
					);
				} else {
					?>
					<p class="assign-info"><?php _e( 'Please assign Horizontal Menu in Wordpress Admin -> Appearance -> Menus -> Manage Locations', 'mdw' ); ?></p>
				<?php } ?>
				<!--/.Links-->
				<?php if ( $nav_fb_icon || $nav_gp_icon || $nav_tw_icon || $nav_insta_icon ) { ?>
					<!--Icons-->
					<div class="mobile-social-icon">
						<ul class="nav navbar-nav nav-flex-icons">
							<?php if ( $nav_fb_icon ) { ?>
								<li class="nav-item">
									<a class="nav-link waves-effect waves-light" href="<?php echo $nav_fb_link; ?>"><i class="fa fa-facebook"></i></a>
								</li>
							<?php } ?>
							<?php if ( $nav_gp_icon ) { ?>
								<li class="nav-item">
									<a class="nav-link waves-effect waves-light" href="<?php echo $nav_gp_link; ?>"><i class="fa fa-google-plus"></i></a>
								</li>
							<?php } ?>
							<?php if ( $nav_tw_icon ) { ?>
								<li class="nav-item">
									<a class="nav-link waves-effect waves-light" href="<?php echo $nav_tw_link; ?>"><i class="fa fa-twitter"></i></a>
								</li>
							<?php } ?>
							<?php if ( $nav_insta_icon ) { ?>
								<li class="nav-item">
									<a class="nav-link waves-effect waves-light" href="<?php echo $nav_insta_link; ?>"><i class="fa fa-instagram"></i></a>
								</li>
							<?php } ?>
						</ul>
						<!--/.Icons-->
                        </div>
					<?php } ?>
				
				<!--/.Collapse content-->

			</div>
	</nav>
	<!--/.Navbar-->
<?php } ?>
