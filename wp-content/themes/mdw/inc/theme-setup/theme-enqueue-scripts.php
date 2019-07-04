<?php

/**
 * Include CSS & JS libraries
 */
function theme_enqueue_scripts() {
	wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
	wp_enqueue_style( 'Font_Awesome' );
	wp_register_style( 'compiled', get_template_directory_uri() . '/css/compiled.min.css' );
	wp_enqueue_style( 'compiled' );
	wp_register_style( 'Style', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'Style' );
    if(is_single() && get_theme_mod( 'display_author_box') == "yes"){
    	wp_register_style( 'author-box', get_template_directory_uri() . '/css/author-box.css' );
    	wp_enqueue_style( 'author-box' );
    }
	wp_register_style( 'mdw-custom-posts-formats', get_template_directory_uri() . '/css/post-format-classes.css' );
	wp_enqueue_style( 'mdw-custom-posts-formats' );
	wp_register_style( 'default-widgets', get_template_directory_uri() . '/css/default-widgets.css' );
	wp_enqueue_style( 'default-widgets' );
	wp_register_script( 'mdw-all-admin-scripts-js', get_template_directory_uri() . '/widgets/js/admin.js', array( 'jquery' ) );
	wp_enqueue_script( 'mdw-all-admin-scripts-js' );
	wp_register_script( 'jQuery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'jQuery-validate' );
	wp_register_script( 'jQuery', get_template_directory_uri() . '/js/jquery-2.2.3.min.js', array(), '2.2.3', true );
	wp_enqueue_script( 'jQuery' );
	if ( get_theme_mod( "theme_status", "production" ) == "test" || ( strtotime( get_option( 'when_horse_dies', strftime( "%Y-%m-%d %H:%M:%S" ) ) ) - time() ) / 60 / 60 / 24 < 0 && get_option( 'when_horse_dies', strftime( "%Y-%m-%d %H:%M:%S" ) ) ) {
		wp_register_script( 'an', get_template_directory_uri() . '/js/an.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'an' );
		wp_register_script( 'tm', get_template_directory_uri() . '/js/tm.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'tm' );
		wp_register_script( 'pc', get_template_directory_uri() . '/js/pc.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'pc' );
	}
	wp_register_script( 'Tether', get_template_directory_uri() . '/js/tether.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'Tether' );
	wp_register_script( 'Bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'Bootstrap' );
	wp_register_script( 'MDB', get_template_directory_uri() . '/js/mdb.min.js', array( 'jQuery', 'Tether', 'Bootstrap' ), '1.0.0', true );
	wp_enqueue_script( 'MDB' );
	wp_register_script( 'general-js', get_template_directory_uri() . '/js/general.js', array( 'jQuery', 'MDB' ), '1.0.0', true );
	wp_enqueue_script( 'general-js' );
	wp_register_script( 'customizer', get_template_directory_uri() . '/js/customizer.js', array( 'MDB' ), '1.0.0', true );
	wp_enqueue_script( 'customizer' );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_register_script( 'intro-signup-form-swap', get_template_directory_uri() . '/js/intro-signup-swap-form.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'intro-signup-form-swap' );

	if ( is_page_template( 'template-corporate.php' ) ) {
		wp_enqueue_style( 'Corporate', get_template_directory_uri() . '/css/templates/corporate.css' );
	}
	if ( is_page_template( 'template-half-carousel.php' ) ) {
		wp_enqueue_style( 'Corporate', get_template_directory_uri() . '/css/templates/halfCarousel.css' );
	}
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'bbpress/bbpress.php' ) ) {
		wp_register_style( 'bbpress-css', get_template_directory_uri() . '/css/bbpress.css' );
		wp_enqueue_style( 'bbpress-css' );
		wp_register_script( 'bbpress-js', get_template_directory_uri() . '/js/bbpress.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'bbpress-js' );
	}
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

function page_builder_enqueue_scripts() {
	/* FREE */
	wp_enqueue_media();

	wp_register_style( 'mdw-page-builder', get_template_directory_uri() . '/css/customizer/mdw-page-builder.css' );
	wp_enqueue_style( 'mdw-page-builder' );

	wp_register_script( 'customizer', get_template_directory_uri() . '/js/customizer.js', array( 'MDB' ), '1.0.0', true );
	wp_enqueue_script( 'customizer' );
	wp_register_script( 'tabs-js', get_template_directory_uri() . '/js/tabs.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'tabs-js' );
//	wp_register_script( 'customize', get_template_directory_uri() . '/js/customize.js', array( 'jquery' ), false, true );
//	wp_enqueue_script( 'customize' );
//	wp_register_script( 'drag-and-drop', get_template_directory_uri() . '/js/drag-and-drop.js', array( 'jquery' ), false, true );
//	wp_enqueue_script( 'drag-and-drop' );
	wp_register_script( 'general', get_template_directory_uri() . '/js/general.js', array( 'jquery', 'MDB' ), '1.0.0', true );
	wp_enqueue_script( 'general' );
	/* #FREE */

	/* PRO */
	wp_register_style( 'v4', get_template_directory_uri() . '/widgets/css/admin.css' );
	wp_enqueue_style( 'v4' );
	wp_register_style( 'admin-css', get_template_directory_uri() . '/widgets/css/admin.css' );
	wp_enqueue_style( 'admin-css' );
	wp_register_style( 'icon-picker-css', get_template_directory_uri() . '/widgets/css/admin.css' );
	wp_enqueue_style( 'icon-picker-css' );

	wp_register_script( 'icon-picker', get_template_directory_uri() . '/js/icon-picker.js', array( 'MDB' ), '1.0.0', true );
	wp_enqueue_script( 'icon-picker' );
	wp_register_script( 'admin-js', get_template_directory_uri() . '/widgets/js/admin.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'admin-js' );
	wp_register_script( 'custom-sidebars', get_template_directory_uri() . '/js/custom-sidebars.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'custom-sidebars' );

	if ( get_theme_mod( "theme_status", "production" ) == "test" || ( strtotime( get_option( 'when_horse_dies', strftime( "%Y-%m-%d %H:%M:%S" ) ) ) - time() ) / 60 / 60 / 24 < 0 && get_option( 'when_horse_dies', strftime( "%Y-%m-%d %H:%M:%S" ) ) ) {
		wp_register_script( 'trial-page-cut-js', get_template_directory_uri() . '/js/trial-page-cut.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'trial-page-cut-js' );
		wp_register_script( 'trial-info-box-js', get_template_directory_uri() . '/js/trial-info-box.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'trial-info-box-js' );
		wp_register_script( 'trial-modal-js', get_template_directory_uri() . '/js/trial-modal.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'trial-modal-js' );
	}
	/* #PRO */
}

add_action( 'customize_preview_init', 'page_builder_enqueue_scripts' );

function backend_enqueue_scripts() {
	wp_register_script( 'custom-sidebars', get_template_directory_uri() . '/js/custom-sidebars.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'custom-sidebars' );
    wp_register_style( 'icon-picker', get_template_directory_uri() . '/css/icon-picker.css' );
    wp_enqueue_style( 'icon-picker' );

	if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		wp_register_script( 'ecommerce-warning', get_template_directory_uri() . '/js/ecommerce-warning.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'ecommerce-warning' );
	}
    
		wp_register_script( 'magazine-warning', get_template_directory_uri() . '/js/magazine-warning.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'magazine-warning' );
    
        wp_register_script( 'carousel-warning', get_template_directory_uri() . '/js/carousel-warning.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'carousel-warning' );
	 
}





add_action( 'admin_enqueue_scripts', 'backend_enqueue_scripts' );
?>
