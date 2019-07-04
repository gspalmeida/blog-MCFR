<?php

/**
 * ENQUEUE CUSTOM CSS
 */
function my_enqueue_customizer_stylesheet() {

	wp_register_style( 'my-customizer-css', get_template_directory_uri() . '/css/customizer/customizer.css', null, null, 'all' );
	wp_enqueue_style( 'my-customizer-css' );
	wp_register_style( 'mdw-page-builder', get_template_directory_uri() . '/css/customizer/mdw-page-builder.css', null, null, 'all' );
	wp_enqueue_style( 'mdw-page-builder' );
}

add_action( 'customize_controls_print_styles', 'my_enqueue_customizer_stylesheet' );

/**
 * ENQUEUE CUSTOM JS
 */
function my_enqueue_customizer_scripts() {

	/* FREE */
	wp_register_script( 'jQuery', get_template_directory_uri() . '/js/jquery-2.2.3.min.js', array(), '2.2.3', true );
	wp_enqueue_script( 'jQuery' );
	wp_register_script( 'MDB', get_template_directory_uri() . '/js/mdb.min.js', array( 'jQuery' ), '1.0.0', true );
	wp_enqueue_script( 'MDB' );
	wp_register_script( 'my-customizer-js', get_template_directory_uri() . '/js/customizer.js', array( 'MDB' ), null, 'all' );
	wp_enqueue_script( 'my-customizer-js' );
//	wp_register_script( 'drag-and-drop', get_template_directory_uri() . '/js/drag-and-drop.js', array( 'jquery' ), false, true );
//	wp_enqueue_script( 'drag-and-drop' );

	/* #FREE */

	/* PRO */
	wp_register_script( 'admin-js', get_template_directory_uri() . '/widgets/js/admin.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'admin-js' );
	wp_register_script( 'custom-sidebars', get_template_directory_uri() . '/js/custom-sidebars.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'custom-sidebars' );
	/* #PRO */
}

add_action( 'customize_controls_print_scripts', 'my_enqueue_customizer_scripts' );

/*
 * THEME CONFIGURATION OPTIONS
 */

add_action( 'customize_register', 'mdw_customize_register' );

/**
 * @param  $wp_customize
 * @return null
 */
function mdw_customize_register( $wp_customize ) {

	//social icons
	$wp_customize->add_section( 'social_option', array(
		'title'		 => __( 'Social Options', 'mdw' ),
		'priority'	 => 5
	) );
	$wp_customize->add_setting( 'icons_style', array(
		'default'			 => 'normal',
		'type'				 => 'theme_mod',
		'settings'			 => 'social_option',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_icons_style'
	) );
	$wp_customize->add_control( 'icons_style', array(
		'label'		 => 'Icons style and share providers',
		'section'	 => 'social_option',
		'type'		 => 'select',
		'choices'	 => array(
			'normal'		 => 'Normal',
			'large'			 => 'Large',
			'simple'		 => 'Simple',
			'simple_large'	 => 'Large Simple',
			'floating'		 => 'Floating',
			'floating_small' => 'Small Floating',
			'social_list'	 => 'Social List'
		)
	) );

	// Add settings for output description
	$wp_customize->add_setting( 'facebook_share', array(
		'default'			 => true,
		'settings'			 => 'social_option',
		'capability'		 => 'edit_theme_options',
		'type'				 => 'theme_mod',
		'sanitize_callback'	 => 'sanitize_checkbox'
	) );

	$wp_customize->add_control( 'facebook_share', array(
		'label'		 => 'Facebook',
		'section'	 => 'social_option',
		'type'		 => 'checkbox'
	) );

	// Add settings for output description
	$wp_customize->add_setting( 'twitter_share', array(
		'default'			 => true,
		'settings'			 => 'social_option',
		'capability'		 => 'edit_theme_options',
		'type'				 => 'theme_mod',
		'sanitize_callback'	 => 'sanitize_checkbox'
	) );

	$wp_customize->add_control( 'twitter_share', array(
		'label'		 => 'Twitter',
		'section'	 => 'social_option',
		'type'		 => 'checkbox'
	) );
	// Add settings for output description
	$wp_customize->add_setting( 'google_share', array(
		'default'			 => true,
		'settings'			 => 'social_option',
		'capability'		 => 'edit_theme_options',
		'type'				 => 'theme_mod',
		'sanitize_callback'	 => 'sanitize_checkbox'
	) );

	$wp_customize->add_control( 'google_share', array(
		'label'		 => 'Google',
		'section'	 => 'social_option',
		'type'		 => 'checkbox'
	) );
	// Add settings for output description
	$wp_customize->add_setting( 'comments_button', array(
		'default'			 => true,
		'settings'			 => 'social_option',
		'capability'		 => 'edit_theme_options',
		'type'				 => 'theme_mod',
		'sanitize_callback'	 => 'sanitize_checkbox'
	) );

	$wp_customize->add_control( 'comments_button', array(
		'label'		 => 'Comments button',
		'section'	 => 'social_option',
		'type'		 => 'checkbox'
	) );
	// Add settings for output description
	$wp_customize->add_setting( 'minimal_share_count', array(
		'default'			 => '10',
		'settings'			 => 'social_option',
		'capability'		 => 'edit_theme_options',
		'type'				 => 'theme_mod',
		'sanitize_callback'	 => 'number_int'
	) );

	$wp_customize->add_control( 'minimal_share_count', array(
		'label'		 => 'Minimal share count',
		'section'	 => 'social_option',
		'type'		 => 'number'
	) );


	$wp_customize->add_setting( 'fb_comments', array(
		'default'			 => false,
		'settings'			 => 'social_option',
		'capability'		 => 'edit_theme_options',
		'type'				 => 'theme_mod',
		'sanitize_callback'	 => 'sanitize_checkbox'
	) );
	$wp_customize->add_control( 'fb_comments', array(
		'label'		 => 'Facebook comments',
		'section'	 => 'social_option',
		'type'		 => 'checkbox'
	) );

	// theme settings
	$wp_customize->add_section( 'mdwtheme_option', array(
		'title'		 => 'Theme settings',
		'priority'	 => 1
	) );
	$wp_customize->add_setting( 'color_scheme', array(
		'default'			 => 'mdb-skin',
		'type'				 => 'theme_mod',
		'settings'			 => 'mdwtheme_option',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_color_scheme'
	) );
	$wp_customize->add_control( 'color_scheme', array(
		'label'		 => 'Color scheme',
		'section'	 => 'mdwtheme_option',
		'type'		 => 'radio',
		'choices'	 => array(
			'blue-skin'			 => 'Blue',
			'red-skin'			 => 'Red',
			'green-skin'		 => 'Green',
			'purple-skin'		 => 'Purple',
			'dark-skin'			 => 'Dark',
			'grey-skin'			 => 'Grey',
			'mdb-skin'			 => 'MDB',
			'deep-orange-skin'	 => 'Deep orange',
			'graphite-skin'		 => 'Graphite',
			'pink-skin'			 => 'Pink',
			'light-grey-skin'	 => 'Light Grey',
		)
	) );
	$wp_customize->add_setting( 'font_style', array(
		'default'			 => '400',
		'type'				 => 'theme_mod',
		'settings'			 => 'mdwtheme_option',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_font_style'
	) );
	$wp_customize->add_control( 'font_style', array(
		'label'		 => 'Font style',
		'section'	 => 'mdwtheme_option',
		'type'		 => 'select',
		'choices'	 => array(
			'100'	 => 'Thin',
			'300'	 => 'Light',
			'400'	 => 'Regular',
			'500'	 => 'Medium',
		)
	) );
	$wp_customize->add_setting( 'back_to_the_top', array(
		'default'			 => 'no',
		'type'				 => 'theme_mod',
		'settings'			 => 'mdwtheme_option',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_back_to_the_top'
	) );
	$wp_customize->add_control( 'back_to_the_top', array(
		'label'		 => 'Back to the top button?',
		'section'	 => 'mdwtheme_option',
		'type'		 => 'radio',
		'choices'	 => array(
			'no'	 => 'No',
			'yes'	 => 'Yes'
		)
	) );

	$wp_customize->add_setting( 'default_button', array(
		'default'			 => 'normal',
		'type'				 => 'theme_mod',
		'settings'			 => 'mdwtheme_option',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_default_btn'
	) );
	$wp_customize->add_control( 'default_button', array(
		'label'		 => 'Default button',
		'section'	 => 'mdwtheme_option',
		'type'		 => 'select',
		'choices'	 => array(
			'normal'			 => 'Normal',
			'outline'			 => 'Outline',
			'normal-rounded'	 => 'Normal-Rounded',
			'outline-rounded'	 => 'Outline-Rounded'
		)
	) );

	$wp_customize->add_setting( 'logo_image', array(
		'default'			 => get_template_directory_uri() . '/img/mdw_logo.jpg',
		'sanitize_callback'	 => 'esc_url'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image', array(
		'label'		 => __( 'Change your logo', 'mdw' ),
		'section'	 => 'mdwtheme_option',
		'settings'	 => 'logo_image' )
	) );
	$wp_customize->add_setting( 'sidenav_image', array(
		'default'			 => '',
		'sanitize_callback'	 => 'esc_url'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sidenav_image', array(
		'label'		 => __( 'Change your Sidebar Menu image', 'mdw' ),
		'section'	 => 'mdwtheme_option',
		'settings'	 => 'sidenav_image' )
	) );

	$wp_customize->add_setting( 'navbar_logo', array(
		'default'			 => '',
		'sanitize_callback'	 => 'esc_url'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'navbar_logo', array(
		'label'		 => __( 'Change your Horizontal Menu image', 'mdw' ),
		'section'	 => 'mdwtheme_option',
		'settings'	 => 'navbar_logo' )
	) );


	/*
	 * CONTAINER FLUID OR TRADITIONAL CONFIGURATION OPTIONS
	 */

	$wp_customize->add_setting( 'layout_type', array(
		'default'			 => 'container_sidebar',
		'type'				 => 'theme_mod',
		'settings'			 => 'layout_type',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_layout_type'
	) );
	$wp_customize->add_control( 'layout_type', array(
		'label'		 => __( 'Layout type', 'mdw' ),
		'section'	 => 'mdwtheme_option',
		'settings'	 => 'layout_type',
		'type'		 => 'select',
		'choices'	 => array(
			'container_sidebar'	 => __( 'Margins with sidebar', 'mdw' ),
			'full_sidebar'		 => __( 'Full page with sidebar', 'mdw' ),
			'container'			 => __( 'Margins', 'mdw' ),
			'full'				 => __( 'Full page', 'mdw' )
		)
	) );

	// POST PAGE TYPE
	$wp_customize->add_setting( 'post_page', array(
		'default'			 => '',
		'type'				 => 'theme_mod',
		'settings'			 => 'post_page',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_post_page'
	) );
	$wp_customize->add_control( 'post_page', array(
		'label'		 => __( 'Post page', 'mdw' ),
		'section'	 => 'mdwtheme_option',
		'settings'	 => 'post_page',
		'type'		 => 'select',
		'choices'	 => array(
			''			 => __( 'Cascading', 'mdw' ),
			'default'	 => __( 'Default', 'mdw' ),
			'titleup'	 => __( 'Title up', 'mdw' ),
			'coverphoto' => __( 'Cover photo', 'mdw' )
		)
	) );

	/* LOAD MORE POST WITH AJAX */
	$wp_customize->add_setting( 'load_more_posts', array(
		'default'			 => 'no',
		'type'				 => 'theme_mod',
		'settings'			 => 'load_more_posts',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_load_more_posts'
	) );
	$wp_customize->add_control( 'load_more_posts', array(
		'label'		 => __( 'Load more posts on the bottom of the page?', 'mdw' ),
		'section'	 => 'mdwtheme_option',
		'settings'	 => 'load_more_posts',
		'type'		 => 'radio',
		'choices'	 => array(
			'no'		 => 'No',
			'onscroll'	 => 'On scroll',
			'onclick'	 => 'On button click'
		)
	) );
	/* theme licence key */
	$wp_customize->add_setting( 'license_key', array(
		'default'			 => get_theme_mod( 'license_key', '' ),
		'type'				 => 'theme_mod',
		'settings'			 => 'license_key',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'license_key', array(
		'label'		 => __( 'License key', 'mdw' ),
		'section'	 => 'mdwtheme_option',
		'settings'	 => 'license_key',
		'type'		 => 'text'
	) );
	/* package */
	$wp_customize->add_setting( 'package', array(
		'default'			 => '2',
		'type'				 => 'option',
		'settings'			 => 'package',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'package', array(
		'label'		 => '',
		'section'	 => 'mdwtheme_option',
		'settings'	 => 'package',
		'type'		 => 'text'
	) );

	/*
	  NAVIGATION CONFIGURATION OPTIONS
	 */
	$wp_customize->add_section( 'navigation_section', array(
		'title'		 => 'Navigation settings',
		'priority'	 => 2
	) );
	$wp_customize->add_setting( 'navigation_type', array(
		'default'			 => 'navbar',
		'type'				 => 'theme_mod',
		'settings'			 => 'navigation_section',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_navigation_type'
	) );
	$wp_customize->add_control( 'navigation_type', array(
		'label'		 => 'Navigation',
		'section'	 => 'navigation_section',
		'type'		 => 'select',
		'choices'	 => array(
			''			 => 'None',
			'navbar'	 => 'Horizontal Menu',
			'sidenav'	 => 'Sidebar Menu',
			'both'		 => 'Both'
		)
	) );
	$wp_customize->add_setting( 'navbar_type', array(
		'default'			 => 'basic',
		'type'				 => 'theme_mod',
		'settings'			 => 'navigation_section',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_navabr_type'
	) );
	$wp_customize->add_control( 'navbar_type', array(
		'label'		 => 'Navigation type',
		'section'	 => 'navigation_section',
		'type'		 => 'select',
		'choices'	 => array(
			'basic'		 => 'Basic',
			'top'		 => 'Fixed Top',
			'bottom'	 => 'Fixed Bottom',
			'scrolling'	 => 'Scrolling'
		)
	) );
	$wp_customize->add_setting( 'sidenav_type', array(
		'default'			 => 'fixed',
		'type'				 => 'theme_mod',
		'settings'			 => 'navigation_section',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_sidenav_type'
	) );
	$wp_customize->add_control( 'sidenav_type', array(
		'label'		 => 'Sidebar type',
		'section'	 => 'navigation_section',
		'type'		 => 'select',
		'choices'	 => array(
			'fixed'	 => 'Fixed',
			'hidden' => 'Hidden'
		)
	) );
	$wp_customize->add_setting( 'search_form', array(
		'default'			 => 'navbar',
		'type'				 => 'theme_mod',
		'settings'			 => 'navigation_section',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_search_form'
	) );
	$wp_customize->add_control( 'search_form', array(
		'label'		 => 'Search form',
		'section'	 => 'navigation_section',
		'type'		 => 'radio',
		'choices'	 => array(
			'navbar'	 => 'Horizontal Menu',
			'sidenav'	 => 'Sidebar Menu',
			'hidden'	 => 'Hidden'
		)
	) );
	$wp_customize->add_setting( 'nav_transparent', array(
		'default'			 => 'no',
		'type'				 => 'theme_mod',
		'settings'			 => 'navigation_section',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_nav_transparent'
	) );
	$wp_customize->add_control( 'nav_transparent', array(
		'label'		 => 'Transparent menu',
		'section'	 => 'navigation_section',
		'type'		 => 'radio',
		'choices'	 => array(
			'no'	 => 'No',
			'yes'	 => 'Yes'
		)
	) );

	/*
	 * FOOTER CONFIGURATION OPTIONS
	 */
	$wp_customize->add_section( 'footer_section', array(
		'title'		 => 'Footer settings',
		'priority'	 => 2
	) );
	$wp_customize->add_setting( 'footer_type', array(
		'default'			 => 'advanced',
		'type'				 => 'theme_mod',
		'settings'			 => 'footer_section',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'sanitize_footer_type'
	) );
	$wp_customize->add_control( 'footer_type', array(
		'label'		 => 'Footer type',
		'section'	 => 'footer_section',
		'type'		 => 'select',
		'choices'	 => array(
			''			 => 'None',
			'advanced'	 => 'Advamced'
		)
	) );

	class Page_Builder_Control extends WP_Customize_Control {

		/**
		 * @return null
		 */
		public function render_content() {

			if ( empty( $GLOBALS[ 'wp_widget_factory' ] ) ) {
				return;
			}

			$widgets	 = $GLOBALS[ 'wp_widget_factory' ]->widgets;
			$categories	 = array(
				'intro'		 => 'Intro',
				'blog'		 => 'Blog',
				'ecommerce'	 => 'Ecommerce',
				'magazine'	 => 'Magazine',
				'landing'	 => 'Landing Page',
				'portfolio'	 => 'Portfolio',
				'wp'		 => 'WordPress Default',
				'wc'		 => 'WooCommerce',
				'other'		 => 'Other Widgets'
			);

			echo "<div class='widget-list disabled' name='widget_list'>";

			foreach ( $categories as $cat => $desc ) {

				echo "<div class='group-panel'>
                  <h4>" . $desc . " <i class='fa fa-caret-down pull-right'></i></h4>
                  <div class='group-list'>";

				foreach ( $widgets as $w ) {
					$name = str_replace( '_', ' ', get_class( $w ) );

					if ( array_key_exists( 'category', $w->widget_options ) && $cat == $w->widget_options[ 'category' ] ) {
						echo '<div id="' . get_class( $w ) . '" data-id-base="' . $w->id_base . '" draggable="true" ondragstart="drag(event)">' . $name . '</div>';
					}

					if ( !array_key_exists( 'category', $w->widget_options ) ) {

						if ( 'wp' == $cat && strpos( $name, 'WP' ) !== false ) {
							echo '<div id="' . get_class( $w ) . '" data-id-base="' . $w->id_base . '" draggable="true" ondragstart="drag(event)">' . $name . '</div>';
						}

						if ( 'wc' == $cat && strpos( $name, 'WC' ) !== false ) {
							echo '<div id="' . get_class( $w ) . '" data-id-base="' . $w->id_base . '" draggable="true" ondragstart="drag(event)">' . $name . '</div>';
						}

						if ( 'other' == $cat && strpos( $name, 'WP' ) === false && strpos( $name, 'WC' ) === false ) {
							echo '<div id="' . get_class( $w ) . '" data-id-base="' . $w->id_base . '" draggable="true" ondragstart="drag(event)">' . $name . '</div>';
						}
					}
				}

				echo "</div>";
				echo "</div>";
			}
		}

	}

	$wp_customize->add_section( 'page_builder', array(
		'title'		 => 'Page Builder',
		'priority'	 => 2
	) );
	$wp_customize->add_setting( 'widget_list', array(
		'settings'			 => 'page_builder',
		'capability'		 => 'edit_theme_options',
		'sanitize_callback'	 => 'return_false'
	) );
	$wp_customize->add_control( new Page_Builder_Control( $wp_customize, 'widget_list', array(
		'section' => 'page_builder'
	) ) );
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_color_scheme( $input ) {

	if ( !in_array( $input, array( 'blue-skin', 'red-skin', 'green-skin', 'purple-skin', 'dark-skin', 'grey-skin', 'mdb-skin', 'deep-orange-skin', 'graphite-skin', 'pink-skin', 'light-grey-skin' ) ) ) {
		$input = 'mdb-skin';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_font_style( $input ) {

	if ( !in_array( $input, array( '100', '300', '400', '500' ) ) ) {
		$input = '400';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_default_btn( $input ) {

	if ( !in_array( $input, array( 'normal', 'outline', 'normal-rounded', 'outline-rounded' ) ) ) {
		$input = 'normal';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_layout_type( $input ) {

	if ( !in_array( $input, array( 'container_sidebar', 'full_sidebar', 'container', 'full' ) ) ) {
		$input = '';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_post_page( $input ) {

	if ( !in_array( $input, array( '', 'default', 'titleup', 'coverphoto' ) ) ) {
		$input = '';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_navigation_type( $input ) {

	if ( !in_array( $input, array( '', 'navbar', 'sidenav', 'both' ) ) ) {
		$input = 'navbar';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_navabr_type( $input ) {

	if ( !in_array( $input, array( 'basic', 'top', 'bottom', 'scrolling' ) ) ) {
		$input = 'basic';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_sidenav_type( $input ) {

	if ( !in_array( $input, array( 'fixed', 'hidden' ) ) ) {
		$input = 'fixed';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_search_form( $input ) {

	if ( !in_array( $input, array( 'navbar', 'sidenav', 'hidden' ) ) ) {
		$input = 'navbar';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_nav_transparent( $input ) {

	if ( !in_array( $input, array( 'no', 'yes' ) ) ) {
		$input = 'no';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_footer_type( $input ) {

	if ( !in_array( $input, array( '', 'basic' ) ) ) {
		$input = 'basic';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_icons_style( $input ) {

	if ( !in_array( $input, array( 'normal', 'large', 'simple', 'simple_large', 'floating', 'floating_small', 'social_icons', 'social_list' ) ) ) {
		$input = 'basic';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_load_more_posts( $input ) {

	if ( !in_array( $input, array( 'no', 'onscroll', 'onclick' ) ) ) {
		$input = 'basic';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_back_to_the_top( $input ) {

	if ( !in_array( $input, array( 'no', 'yes' ) ) ) {
		$input = 'basic';
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function sanitize_checkbox( $input ) {

	if ( !empty( $input ) && ( $input != 1 || $input != 0 ) ) {
		$input = 1;
	}

	return $input;
}

/**
 * @param  $input
 * @return mixed
 */
function return_false( $input ) {
	return $input;
}
