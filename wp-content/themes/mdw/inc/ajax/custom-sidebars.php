<?php

/**
 * Get name of custom sidebar and register it in wp theme_settings
 * @throws Exception
 * 
 */
function add_sidebar() {

	try {
		$sidebar_name = $_POST[ 'sidebar_name' ];

		if ( empty( $sidebar_name ) ) {
			throw new Exception( 'Sidebar must have a name!' );
		}

		$id_temp = strtolower( $sidebar_name );
		$id		 = str_replace( ' ', '-', $id_temp );

		$current_sidebars = get_theme_mod( 'custom_sidebars' );

		foreach ( $current_sidebars as $cs ) {
			if ( $cs[ 'id' ] == $id ) {
				throw new Exception( 'Sidebar with that name already exists!' );
			}
		}

		$current_sidebars[] = array(
			'name'	 => $sidebar_name,
			'id'	 => $id
		);

		set_theme_mod( 'custom_sidebars', $current_sidebars );

		echo "Sidebar succesfully added!";
	} catch ( Exception $e ) {

		echo "Something went wrong.<br><b>Error: </b>" . $e->getMessage();
	}
	die();
}

add_action( 'wp_ajax_add_sidebar', 'add_sidebar' );

function delete_sidebar() {

	try {
		$sidebar_id = $_POST[ 'sidebar_id' ];

		$our_sidebars = array(
			'sidebar',
			'footer',
			'footer-left',
			'footer-middle',
			'footer-right',
			'landing-page-intro',
			'landing-page',
			'ecommerce-page',
			'ecommerce-sidebar',
			'magazine-page',
			'magazine-sidebar',
			'blog-homepage',
			'blog-sidebar',
		);
		if ( !in_array( $sidebar_id, $our_sidebars ) ) {
			global $wp_registered_sidebars;

			$all_sidebars = get_theme_mod( 'custom_sidebars' );
			foreach ( $all_sidebars as $key => $value ) {
				if ( $value == $sidebar_id ) {
					unset( $all_sidebars[ $key ] );
					set_theme_mod( 'custom_sidebars', $all_sidebars );
					unregister_sidebar( $sidebar_id );
				}
			}
		} else {
			throw new Exception( 'You cannot delete this sidebar!' );
		}
	} catch ( Exception $e ) {

		echo "Something went wrong.<br><b>Error: </b>" . $e->getMessage();
	}

	die();
}

add_action( 'wp_ajax_delete_sidebar', 'delete_sidebar' );



$sidebars = get_theme_mod( 'custom_sidebars' );
if ( is_array( $sidebars ) ) {
	foreach ( $sidebars as $sidebar ) {
		$sidebars[] = $sidebar;
	}

	foreach ( $sidebars as $sidebar ) {
		if ( isset( $sidebar ) && trim( $sidebar ) != "" ) {

			register_sidebar( array(
				'name'			 => __( $sidebar, 'theme-slug', 'mdw' ),
				'id'			 => $sidebar,
				'before_widget'	 => '<div id="%1$s" class="widget-item" data-instance="%2$s">',
				'after_widget'	 => '</div>',
				'before_title'	 => '<h4 class="widgettitle">',
				'after_title'	 => '</h4>',
			) );
		} else {
			continue;
		}
	}
} else {
	$sidebars = array();
}

