<?php

/*
 * Creates MDW database for custom colors and icons for categories
 *
 */
global $mdw_taxonomy_category_db_version;
$mdw_taxonomy_category_db_version = '1.0';

function mdw_taxonomy_category_install() {
    global $wpdb;
    global $mdw_taxonomy_category_db_version;

    $mdw_category_table  = $wpdb->prefix . "mdw_taxonomy_category";
    $charset_collate     = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $mdw_category_table (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    cat_id mediumint(9) NOT NULL,
    cat_slug varchar(200) NOT NULL,
    cat_name varchar(200) NOT NULL,
    color varchar(7) DEFAULT '#607d8b' NOT NULL,
    icon varchar(55) DEFAULT 'fa fa-font-awesome' NOT NULL,
    UNIQUE KEY id (id)
  ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'mdw_taxonomy_category_db_version', $mdw_taxonomy_category_db_version );
}

add_action( 'init', 'mdw_taxonomy_category_install' );

function theme_mod() {
    $categories  = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false, 'orderby' => 'term_id', 'order' => 'DESC' ) );
    $old_value   = get_theme_mod( 'categories' );
    if(!is_array($old_value)){
        $old_value = array();
    }
    $category    = array();
    foreach ( $categories as $cat ) {
        $id      = get_category( $cat->term_id )->cat_ID;
        $slug    = get_category( $cat->term_id )->slug;
        $name    = get_category( $cat->term_id )->name;
        if ( array_key_exists( $slug, $old_value ) ) {
            if ( array_key_exists( 'color', $old_value[ $slug ] ) ) {
                $color = $old_value[ $slug ][ 'color' ];
            } else {
                $color = "#607d8b";
            }
            if ( array_key_exists( 'icon', $old_value[ $slug ] ) ) {
                $icon = $old_value[ $slug ][ 'icon' ];
            } else {
                $icon = "fa fa-font-awesome";
            }
        } else {
            $color   = "#607d8b";
            $icon    = "fa fa-font-awesome";
        }

        $category[ $slug ] = array(
            'cat_id'     => $id,
            'cat_slug'   => $slug,
            'cat_name'   => $name,
            'color'      => $color,
            'icon'       => $icon,
        );
    }

    $old_value = get_theme_mod( 'categories' );
    if ( $old_value == "" ) {
        $old_value = explode( ',', $old_value );
    }
    $result = array_unique( array_merge( $old_value, $category ), SORT_REGULAR );

    set_theme_mod( 'categories', $result );
}

add_action( 'create_category', 'theme_mod' );
add_action( 'after_switch_theme', 'theme_mod' );

function mdw_taxonomy_category_removal( $category_id ) {

    $categories = get_theme_mod( 'categories' );

    foreach ( $categories as $category => $arr ) {
        if ( $arr[ 'cat_id' ] == $category_id ) {
            $option = get_theme_mod( 'categories' );
            unset( $option[ $category ] );
            set_theme_mod( 'categories', $option );
        }
    }
}

add_action( 'delete_term_taxonomy', 'mdw_taxonomy_category_removal' );

/**
 * SAVE_NAV_SETTINGS IS CALLED WHEN USER SAVES NAVIGATION SETTINGS FROM MDW CONFIG
 */
function save_nav_settings() {

	foreach ( $_POST as $theme_mod => $value ) {

		if ( 'action' != $theme_mod ) {
			set_theme_mod( $theme_mod, $value );
		}
	}

	echo 'Saved!';

	exit();
}

add_action( 'wp_ajax_save_nav_settings', 'save_nav_settings' );

/**
 * Save general settings set in ThemeSettings->General tab
 */
function save_general_settings() {

	$settings = array(
		'back_to_the_top'		 => $_POST[ 'back_to_the_top' ],
		'background_attachment'	 => $_POST[ 'background_attachment' ],
		'background_image'		 => $_POST[ 'background_image' ],
		'background_position_x'	 => $_POST[ 'background_position_x' ],
		'background_repeat'		 => $_POST[ 'background_repeat' ],
		'color_scheme'			 => $_POST[ 'color_scheme' ],
		'default_button'		 => $_POST[ 'default_button' ],
		'font_style'			 => $_POST[ 'font_style' ],
		'layout_type'			 => $_POST[ 'layout_type' ],
		'flex_cols'				 => $_POST[ 'flex_cols' ],
		'background_color'		 => $_POST[ 'background_color' ],
		'theme_status'			 => $_POST[ 'theme_status' ],
		'post_listing_version'	 => $_POST[ 'post_listing_version' ]
	);

	foreach ( $settings as $theme_mod => $value ) {
		set_theme_mod( $theme_mod, $value );
	}

	echo 'Saved!';

	exit();
}

add_action( 'wp_ajax_save_general_settings', 'save_general_settings' );

function save_site_identity_settings() {

	if ( isset( $_POST[ 'sitetitle' ] ) ) {
		update_option( 'blogname', $_POST[ 'sitetitle' ] );
		unset( $_POST[ 'sitetitle' ] );
	}

	foreach ( $_POST as $theme_mod => $value ) {
		set_theme_mod( $theme_mod, $value );
	}

	echo 'Saved!';

	exit();
}

add_action( 'wp_ajax_save_site_identity_settings', 'save_site_identity_settings' );

function save_post_page_settings() {

	$settings = array(
		'display_post_thumbnail' => $_POST[ 'display_post_thumbnail' ],
		'display_author_box'	 => $_POST[ 'display_author_box' ],
		'display_post_tags'		 => $_POST[ 'display_post_tags' ],
		'display_post_author'	 => $_POST[ 'display_post_author' ],
		'display_post_date'		 => $_POST[ 'display_post_date' ],
		'display_post_category'	 => $_POST[ 'display_post_category' ],
		'display_copyright_text' => $_POST[ 'display_copyright_text' ],
		'display_sidebar'		 => $_POST[ 'display_sidebar' ],
		'post_page'				 => $_POST[ 'post_page' ],
		'button_image'			 => $_POST[ 'button_image' ],
		'copyright_text'		 => $_POST[ 'copyright_text' ],
		'display_buttons'		 => $_POST[ 'display_buttons' ],
	);

	foreach ( $settings as $theme_mod => $value ) {
		set_theme_mod( $theme_mod, $value );
	}

	echo 'Saved!';

	exit();
}

add_action( 'wp_ajax_save_post_page_settings', 'save_post_page_settings' );

function save_author_page_settings() {

	$settings = array(
		'author_img'	 => $_POST[ 'author_img' ],
        'author_version' => $_POST[ 'author_version' ],
		'display_sidebar_author' => $_POST[ 'display_sidebar_author' ]
	);

	foreach ( $settings as $theme_mod => $value ) {
		set_theme_mod( $theme_mod, $value );
	}

	echo 'Saved!';

	exit();
}

add_action( 'wp_ajax_save_author_page_settings', 'save_author_page_settings' );

function category_settings_save() {
	$categories	 = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false ) );
	$category	 = array();

	foreach ( $categories as $cat ) {
		$id		 = $cat->term_id;
		$name	 = $cat->name;
		$slug	 = $cat->slug;
		$color	 = $_REQUEST[ 'category_color_' . $id ];
		$icon	 = $_REQUEST[ 'category_icon_' . $id ];

		$category[ $slug ] = array(
			'cat_id'	 => $cat->term_id,
			'cat_slug'	 => $cat->slug,
			'cat_name'	 => $cat->name,
			'color'		 => $color,
			'icon'		 => $icon
		);
	}

	$settings = array(
		'cat_version'			 => $_POST[ 'cat_version' ],
		'cat_listing_version'	 => $_POST[ 'cat_listing_version' ]
	);

	foreach ( $settings as $theme_mod => $value ) {
		set_theme_mod( $theme_mod, $value );
	}

	set_theme_mod( 'categories', $category );

	_e( 'Success', 'mdw' );
	exit();
}

add_action( 'wp_ajax_category_settings_save', 'category_settings_save' );

function save_social_settings() {
	update_user_meta( get_current_user_id(), 'facebook_profile', sanitize_text_field( $_REQUEST[ 'facebook_profile' ] ) );
	update_user_meta( get_current_user_id(), 'twitter_profile', sanitize_text_field( $_REQUEST[ 'twitter_profile' ] ) );
	update_user_meta( get_current_user_id(), 'google_profile', sanitize_text_field( $_REQUEST[ 'google_profile' ] ) );
	update_user_meta( get_current_user_id(), 'linkedin_profile', sanitize_text_field( $_REQUEST[ 'linkedin_profile' ] ) );
	update_user_meta( get_current_user_id(), 'instagram_profile', sanitize_text_field( $_REQUEST[ 'instagram_profile' ] ) );
	update_user_meta( get_current_user_id(), 'pinterest_profile', sanitize_text_field( $_REQUEST[ 'pinterest_profile' ] ) );
	update_user_meta( get_current_user_id(), 'vkontakte_profile', sanitize_text_field( $_REQUEST[ 'vkontakte_profile' ] ) );
	update_user_meta( get_current_user_id(), 'youtube_profile', sanitize_text_field( $_REQUEST[ 'youtube_profile' ] ) );
	update_user_meta( get_current_user_id(), 'dribbble_profile', sanitize_text_field( $_REQUEST[ 'dribbble_profile' ] ) );
	update_user_meta( get_current_user_id(), 'stackOverflow_profile', sanitize_text_field( $_REQUEST[ 'stackOverflow_profile' ] ) );
	update_user_meta( get_current_user_id(), 'github_profile', sanitize_text_field( $_REQUEST[ 'github_profile' ] ) );
	update_user_meta( get_current_user_id(), 'display_email', sanitize_text_field( $_REQUEST[ 'display_email' ] ) );
	set_theme_mod( 'twitter_share', $_REQUEST[ 'twitter_share' ] );
	set_theme_mod( 'google_share', $_REQUEST[ 'google_share' ] );
	set_theme_mod( 'facebook_share', $_REQUEST[ 'facebook_share' ] );
	set_theme_mod( 'fb_comments', $_REQUEST[ 'fb_comments' ] );
	set_theme_mod( 'comments_button', $_REQUEST[ 'comments_button' ] );
	set_theme_mod( 'minimal_share_count', $_REQUEST[ 'minimal_share_count' ] );
	set_theme_mod( 'icons_style', $_REQUEST[ 'icons_style' ] );
	set_theme_mod( 'social_icons_text', $_REQUEST[ 'social_icons_text' ] );
	

	_e( 'Success', 'mdw' );
	exit();
}

add_action( 'wp_ajax_save_social_settings', 'save_social_settings' );

function save_blog_settings() {
	$settings = array(
		'load_more_posts' => $_POST[ 'load_more_posts' ]
	);

	foreach ( $settings as $theme_mod => $value ) {
		set_theme_mod( $theme_mod, $value );
	}

	_e( 'Saved', 'mdw' );
	exit();
}

add_action( 'wp_ajax_save_blog_settings', 'save_blog_settings' );

function save_ecommerce_settings() {

	$settings = array(
		'ecommerce_layout' => $_POST[ 'ecommerce_layout' ]
	);

	foreach ( $settings as $theme_mod => $value ) {
		set_theme_mod( $theme_mod, $value );
	}

	_e( 'Saved', 'mdw' );
	exit();
}

add_action( 'wp_ajax_save_ecommerce_settings', 'save_ecommerce_settings' );