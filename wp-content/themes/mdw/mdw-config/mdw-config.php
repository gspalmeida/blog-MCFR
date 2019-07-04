<?php

function get_tool_name( $tool ) {
	return 'mdw-config-' . $tool;
}

function add_mdw_config_admin_menu() {
	/*
	 * Add a settings page to the Settings menu.
	 *
	 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	 *
	 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
	 *
	 */

	$warnings		 = get_transient( 'update_for_new_version' );
	$warning_count	 = count( $warnings );
	$warning_title	 = esc_attr( sprintf( '%d plugin warnings', $warning_count ) );



	$menu_label = sprintf( __( 'MDW Config %s', 'mdw' ), "<span class='update-plugins count-$warning_count' title='$warning_title'><span class='update-count'>" . number_format_i18n( $warning_count ) . "</span></span>" );
	if ( get_transient( 'update_for_new_version' ) == "1" ) {
		add_menu_page( 'MDW Config', $menu_label, 'manage_options', 'mdw-config', 'config_theme_settings', '', 45 );
	} else {
		add_menu_page( 'MDW Config', 'MDW Config', 'manage_options', 'mdw-config', 'config_theme_settings', '', 45 );
	}




	add_submenu_page( 'mdw-config', 'Theme Settings', 'Theme Settings', 'manage_options', 'mdw-config', 'config_theme_settings' );
	add_submenu_page( 'mdw-config', 'Navigation', 'Navigation', 'manage_options', 'navigation', 'config_navigation' );
	add_submenu_page( 'mdw-config', 'Modules', 'Modules', 'manage_options', 'modules', 'config_modules' );
	add_submenu_page( 'mdw-config', 'Integrations', 'Integrations ', 'manage_options', 'integrations', 'config_integrations' );

	add_action( 'admin_init', 'update_form' );
}

add_action( 'admin_menu', 'add_mdw_config_admin_menu' );

function config_theme_settings() {
	include_once( 'submenus/theme-settings.php' );
}

function config_navigation() {
	include_once( 'submenus/navigation.php' );
}

function config_modules() {
	include_once( 'submenus/modules.php' );
}

function config_integrations() {
	include_once( 'submenus/integrations.php' );
}

function update_form() {
	register_setting( 'mdw-config-ga-optgroup', 'google_analytics_id' );
	register_setting( 'mdw-config-social-optgroup', 'fb-id' );
	register_setting( 'mdw-config-social-optgroup', 'fb-secret' );
	register_setting( 'mdw-config-social-optgroup', 'tw-id' );
	register_setting( 'mdw-config-social-optgroup', 'tw-secret' );
	register_setting( 'mdw-config-social-optgroup', 'gp-id' );
	register_setting( 'mdw-config-social-optgroup', 'gp-secret' );
	register_setting( 'mdw-config-social-optgroup', 'linking-accounts' );
}

?>
