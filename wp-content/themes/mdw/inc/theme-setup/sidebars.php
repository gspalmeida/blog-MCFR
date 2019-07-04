<?php

/* MDW IS IN THE HOUSE BABY */

function add_my_awesome_widgets_collection( $folders ) {
	$folders[] = plugin_dir_path( __FILE__ ) . 'pb_widgets/';
	return $folders;
}

add_filter( 'siteorigin_widgets_widget_folders', 'add_my_awesome_widgets_collection' );

/*  Register our sidebars and widgetized areas. */

function arphabet_widgets_init() {
	register_sidebar( array(
		'name'			 => 'Sidebar',
		'id'			 => 'sidebar',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h4 class="widgettitle">',
		'after_title'	 => '</h4>',
	) );
	register_sidebar( array(
		'name'			 => 'Footer: Left column',
		'id'			 => 'footer-left',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h5 class="title">',
		'after_title'	 => '</h5>',
	) );
	register_sidebar( array(
		'name'			 => 'Footer: Middle column',
		'id'			 => 'footer-middle',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h5 class="title">',
		'after_title'	 => '</h5>',
	) );
	register_sidebar( array(
		'name'			 => 'Footer: Right column',
		'id'			 => 'footer-right',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h5 class="title">',
		'after_title'	 => '</h5>',
	) );
	register_sidebar( array(
		'name'			 => 'Landing page intro area',
		'id'			 => 'landing-page-intro',
		'before_widget'	 => '<div id="%1$s" class="widget-item" style="height: 100%%;" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
	register_sidebar( array(
		'name'			 => 'Landing page widget area',
		'id'			 => 'landing-page',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
	register_sidebar( array(
		'name'			 => 'Portfolio page intro area',
		'id'			 => 'portfolio-page-intro',
		'before_widget'	 => '<div id="%1$s" class="widget-item" style="height: 100%%;" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
	register_sidebar( array(
		'name'			 => 'Portfolio page widget area',
		'id'			 => 'portfolio-page',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
	register_sidebar( array(
		'name'			 => 'Ecommerce page widget area',
		'id'			 => 'ecommerce-page',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
	register_sidebar( array(
		'name'			 => 'Ecommerce sidebar',
		'id'			 => 'ecommerce-sidebar',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
	register_sidebar( array(
		'name'			 => 'Magazine header',
		'id'			 => 'magazine-header',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
	register_sidebar( array(
		'name'			 => 'Magazine page widget area',
		'id'			 => 'magazine-page',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
	register_sidebar( array(
		'name'			 => 'Magazine sidebar',
		'id'			 => 'magazine-sidebar',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
	register_sidebar( array(
		'name'			 => 'Blog page widget area',
		'id'			 => 'blog-homepage',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
	register_sidebar( array(
		'name'			 => 'Blog sidebar',
		'id'			 => 'blog-sidebar',
		'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
		'after_widget'	 => '</div>',
	) );
}

add_action( 'widgets_init', 'arphabet_widgets_init' );
?>
